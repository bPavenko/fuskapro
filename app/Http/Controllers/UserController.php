<?php

namespace App\Http\Controllers;

use App\Models\TaskCategory;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use App\Models\TaskSection;
use App\Models\UserCategories;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\UserPortfolio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Alert;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $sections = TaskSection::with('categories')->get();

        return view('home', ['sections' => $sections]);
    }

    public function saveUserCategories(Request $request)
    {
        UserCategories::where('user_id', Auth::user()->id)->delete();

        foreach ($request->get('category') as $categoryId) {
            UserCategories::create([
                'user_id' => Auth::user()->id,
                'category_id' => $categoryId
            ]);
        }

        return back();
    }

    public function executors(Request $request) {
        $query = User::where('type_id', 2);
        $sections = TaskSection::all()->keyBy('id');
        $categories = [];
        $executors = $query->orderBy('priority', 'ASC');

        if ($request->get('section_id')) {
            $sectionId = $request->get('section_id');
            $categories = TaskCategory::where('parent_id', $sectionId)->get()->keyBy('id');
            $query = $query->where('section_id', $sectionId);
        }

        if ($request->get('category_id')) {
            $categoryId = $request->get('category_id');
            $query = $query->where('category_id', $categoryId);
        }
//        if ($request->get('city')) {
//            $query = $query->where('city', $request->get('city'));
//        }
        $executors = $query->paginate(10);

        return view('executors', [
            'executors' => $executors,
            'sections' => $sections,
            'categories' => $categories
        ]);
    }

    public function addPortfolioImage(Request $request) {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->with('active_tabs', ['portfolio' => true])->withErrors($validator->errors());
        }

        $file = $request->file('image');

        $imageName = time().'.'.str_replace(' ', '_', $file->getClientOriginalName());

        $file->storeAs('public/images/',$imageName);

        UserPortfolio::create([
            'user_id' => Auth::user()->id,
            'path' => $imageName,
            'type' => 'image'
        ]);
        return back()->with(['active_tabs' => ['portfolio' => true]]);
    }

    public function addPortfolioVideo(Request $request) {
        $validator = Validator::make($request->all(), [
            'path' => ['required','regex:/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/'],
        ]);
        if ($validator->fails()) {
            Alert::error('error', 'Не дійсне посилання');
            return back()->with('active_tabs', ['portfolio' => true])->withErrors($validator->errors());
        }
        UserPortfolio::create([
            'user_id' => Auth::user()->id,
            'path' => $request->path,
            'type' => 'video'
        ]);

        return back()->with(['active_tabs' => ['portfolio' => true]]);
    }

    public function deleteMedia(Request $request) {
       UserPortfolio::where('id', $request->media_id)->delete();
       Alert::success('success', 'Медія успішно видалено');

       return back()->with(['active_tabs' => ['portfolio' => true]]);
    }

    public function updatePortfolio (Request $request) {
        $portfolio = UserPortfolio::find($request->id);

        $validator = Validator::make($request->all(), [
            'edit-image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->with('active_modals', ['edit-portfolio-img' => true])->withErrors($validator->errors());
        }

        if($request->hasFile('edit-image')) {
            Storage::delete('public/images/' . $portfolio->path);
            $file = $request->file('edit-image');

            $imageName = time().'.'.str_replace(' ', '_', $file->getClientOriginalName());

            $file->storeAs('public/images/',$imageName);
            $portfolio->path = $imageName;
        }
        $portfolio->description = $request->description;
        $portfolio->section_id = $request->section_id;
        $portfolio->category_id = $request->category_id;
        $portfolio->save();
        return back()->with(['active_tabs' => ['portfolio' => true]]);
    }

    public function getPortfolioMedia(Request $request) {
        $media = UserPortfolio::find($request->id);

        if ($media->type == 'image') {
            $media->path =  asset('storage/images/' . $media->path);
        } else {
            $media->url = 'https://www.youtube.com/embed/' . $media->video_id;
        }
        if ($media->section_id) {
            $media->section_name = TaskSection::find($media->section_id)->name;
        }
        if ($media->category_id) {
            $media->category_name = TaskCategory::find($media->category_id)->name;
        }
        return response()->json(['media' => $media]);
    }

    public function searchExecutors(Request $request) {
        $executors = User::where('type_id', 2);

        if ($request->get('category_id')) {
            $executors = $executors->join('user_categories', 'user_categories.user_id', '=', 'users.id')->where('category_id', $request->get('category_id'));
        } else if ($request->get('section_id')) {
            $executors = $executors->join('user_categories', 'user_categories.user_id', '=', 'users.id')
                ->join('task_categories', 'task_categories.id', '=', 'user_categories.category_id')
                ->where('parent_id', $request->get('section_id'));
        }
        $executors = $executors->orderBy('priority', 'ASC');
        if($request->get('city_id')) {
            $executors = $executors->where('city', $request->get('city_id'));
        }
        if ($request->get('sort')) {
            $sort = $request->get('sort');
            if ($sort == 'rate') {
                $executors = $executors->orderBy('rate', 'desc');
            } else if ($sort == 'rate_counts') {
                $executors = $executors->withCount('rates')->orderBy('rates_count', 'desc');
            } else {
                $executors = $executors->orderBy('users.created_at' , 'desc');
            }
        } else {
            $executors = $executors->orderBy('users.created_at' , 'desc');
        }

        $executors = $executors->paginate(10);
        $view = view('includes.executors', [
            'executors' => $executors
        ])->render();

        return response()->json(['html' => $view]);
    }

    public function changePassword(Request $request) {
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return back()->with('active_tabs', ['password' => true])->withErrors($validator->errors());
        }

        $user = Auth::user();
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect()->back()->with(['active_tabs' => ['password' => true],"success" => "Password successfully changed!"]);
    }

    public function show($id) {
        $user = User::find($id);

        return view('profile', ['user' => $user]);
    }

    public function userRequest(Request $request) {
        UserRequest::create(['profile_id' => $request->profile_id, 'user_id' => Auth::user()->id, 'type' => $request->type]);
        return true;
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users')->ignore(Auth::user()->id)],
            'city' => ['required', 'integer'],
            'birth_date' => ['date'],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->with('active_modals', ['edit-profile' => true])->withErrors($validator->errors());
        }

        if($request->hasFile('image')) {
            $user = Auth::user();
            if ($user->avatar != 'def_user_av.jpg') {
                Storage::delete('public/images/' . $user->avatar);
            }

            $file = $request->file('image');

            $imageName = time().'.'.str_replace(' ', '_', $file->getClientOriginalName());

            $file->storeAs('public/images/',$imageName);
            $user->avatar = $imageName;
            $user->save();
        }


        Auth::user()->update($request->all());
        return redirect(route('home'));
    }

    public function buyVipStatus () {
        $user = Auth::user();
        if (!$user->vip_status) {
            $user->vip_status = date('Y-m-d', strtotime('+1 month'));
        } else {
            $user->vip_status = date('Y-m-d',strtotime('+30 days',strtotime($user->vip_status)));
        }
        $user->priority = 1;
        $user->save();
        Alert::success('success', 'Віп статус куплено до: ' . $user->vip_status);
        return back();
    }

    public function deleteUser () {
        $user = Auth::user();
        $user->delete_request = date('Y-m-d', strtotime('+1 month'));
        $user->save();
        Alert::success('success', 'Ви можете відмінити цю дію протягом 30 днів');
        return back();
    }

    public function recoverDeleteUser() {
        $user = Auth::user();
        $user->delete_request = null;
        $user->save();
        Alert::success('success', trans('alerts.profile_will_not_be_deleted'));
        return back();
    }
}
