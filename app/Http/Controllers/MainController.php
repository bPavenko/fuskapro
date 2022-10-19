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
