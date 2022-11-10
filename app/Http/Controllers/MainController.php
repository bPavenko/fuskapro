<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskSection;
use App\Models\TaskCategory;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Igaster\LaravelCities\Geo;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //(?<=^|[^а-я])(([уyu]|[нзnz3][аa]|(хитро|не)?[вvwb][зz3]?[ыьъi]|[сsc][ьъ']|(и|[рpr][аa4])[зсzs]ъ?|([оo0][тбtb6]|[пp][оo0][дd9])[ьъ']?|(.\B)+?[оаеиeo])?-?([еёe][бb6](?!о[рй])|и[пб][ае][тц]).*?|([нn][иеаaie]|([дпdp]|[вv][еe3][рpr][тt])[оo0]|[рpr][аa][зсzc3]|[з3z]?[аa]|с(ме)?|[оo0]([тt]|дно)?|апч)?-?[хxh][уuy]([яйиеёюuie]|ли(?!ган)).*?|([вvw][зы3z]|(три|два|четыре)жды|(н|[сc][уuy][кk])[аa])?-?[бb6][лl]([яy](?!(х|ш[кн]|мб)[ауеыио]).*?|[еэe][дтdt][ь']?)|([рp][аa][сзc3z]|[знzn][аa]|[соsc]|[вv][ыi]?|[пp]([еe][рpr][еe]|[рrp][оиioеe]|[оo0][дd])|и[зс]ъ?|[аоao][тt])?[пpn][иеёieu][зz3][дd9].*?|([зz3][аa])?[пp][иеieu][дd][аоеaoe]?[рrp](ну.*?|[оаoa][мm]|([аa][сcs])?([иiu]([лl][иiu])?[нщктлtlsn]ь?)?|([оo](ч[еиei])?|[аa][сcs])?[кk]([оo]й)?|[юu][гg])[ауеыauyei]?|[мm][аa][нnh][дd]([ауеыayueiи]([лl]([иi][сзc3щ])?[ауеыauyei])?|[оo][йi]|[аоao][вvwb][оo](ш|sh)[ь']?([e]?[кk][ауеayue])?|юк(ов|[ауи])?)|[мm][уuy][дd6]([яyаиоaiuo0].*?|[еe]?[нhn]([ьюия'uiya]|ей))|мля([тд]ь)?|лять|([нз]а|по)х|м[ао]л[ао]фь([яию]|[её]й))(?=($|[^а-я]))

        $sections = TaskSection::withCount('orders')->orderBy('orders_count', 'desc')->limit(8)->get()->keyBy('id');
        $categories = TaskCategory::withCount('orders')->orderBy('orders_count', 'desc')->limit(8)->get()->keyBy('id');
        $lastUserCategoriesOrders = [];

        if (Auth::user()) {
            $lastUserCategoriesOrders = Order::where('by_user', '!=', Auth::user()->id)
                ->whereIn('category_id', Auth::user()->getCategoriesIds())
                ->limit(6)
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('welcome', with(['sections' => $sections, 'categories' => $categories, 'lastUserCategoriesOrders' => $lastUserCategoriesOrders]));
    }

    public function privacyPolicy() {
        return view('privacy-policy.index');
    }

    public function getSearchAjax(Request $request)
    {
        $term = $request->get('term');
        $results = [];
        $sections = TaskSection::where('name', 'like', '%'.$term.'%')->limit(5)->get();
        $categories = TaskCategory::where('name', 'like', '%'.$term.'%')->limit(5)->get();
        $orders = Order::where('title', 'like', '%'.$term.'%')->where('status', 'open')->limit(5)->get();
        $results[] = [
            'label' => $term,
            'link' => '/orders/?title=' . $term,
            'type' => trans('main.search_by_title')
        ];
        foreach ($sections as $section) {
            $results[] = [
                'label' => $section->name,
                'link' => '/orders/?section_id=' . $section->id,
                'type' => trans('main.section')
            ];
        }
        foreach ($categories as $category) {
            $results[] = [
                'label' => $category->name,
                'link' => '/orders/?section_id=' . $category->parent_id . '&category_id=' . $category->id,
                'type' => trans('main.category')
            ];
        }
        foreach ($orders as $order) {
            $results[] = [
                'label' => $order->title,
                'link' => '/order-info/' . $order->id,
                'type' => trans('main.advertisement')
            ];
        }

        if (count($results)) {
            return response()->json($results);
        }
    }

    public function getCitiesAjax(Request $request) {
        $term = $request->get('term');
        $results = [];
        $cities = Geo::where('name', 'like', '%' . $term . '%')->orderBy('population', 'desc')->limit(10)->get();

        foreach ($cities as $city) {
            $results[] = [
                'label' => $city->name,
                'id' => $city->id,
            ];
        }

        if (count($results)) {
            return response()->json($results);
        }
    }
}
