<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;
use App\Models\TaskSection;
use App\Models\UserCategories;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

        if ($request->get('section_id')) {
            $sectionId = $request->get('section_id');
            $categories = TaskCategory::where('parent_id', $sectionId)->get()->keyBy('id');
            $query = $query->where('section_id', $sectionId);
        }

        if ($request->get('category_id')) {
            $categoryId = $request->get('category_id');
            $query = $query->where('category_id', $categoryId);
        }

        $executors = $query->paginate(10);

        return view('executors', [
            'executors' => $executors,
            'sections' => $sections,
            'categories' => $categories
        ]);
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
            'phone' => ['required', 'string', 'regex:/^\+380\d{3}\d{2}\d{2}\d{2}$/'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users')->ignore(Auth::user()->id)],
            'city' => ['required', 'integer'],
            'birth_date' => ['required' , 'date'],
        ]);
        $validator->validate();

        Auth::user()->update($request->all());
        return redirect(route('home'));
    }
}
