<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskSection;
use App\Models\TaskCategory;
use App\Models\Order;
use DatePeriod;
use DateTime;
use Auth;
use DateInterval;
use Igaster\LaravelCities\Geo;
use App\Models\OrderRequest;
use App\Models\Notification;
use DB;

class OrdersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $query = new Order;
        $sections = TaskSection::all()->keyBy('id');
        $categories = [];
        $statuses = array_unique(Order::pluck('status')->toArray());
        if ($request->get('section_id')) {
            $sectionId = $request->get('section_id');
            $categories = TaskCategory::where('parent_id', $sectionId)->get()->keyBy('id');
            $query = $query->where('section_id', $sectionId);
        }
        if ($request->get('title')) {
            $term = $request->get('title');
            $query = $query->where('title', 'like', '%'. $term . '%');
        }
        if ($request->get('city_id')) {
            $cityId = $request->get('city_id');
            $query = $query->where('city', $cityId);
        }
        if ($request->get('category_id')) {
            $categoryId = $request->get('category_id');
            $query = $query->where('category_id', $categoryId);
        }
        if ($request->get('execute_to')) {
            $date = $request->get('execute_to');
            $query = $query->where('execution_date', '<', $date);
        }
        if ($request->get('price_from')) {
            $priceFrom = $request->get('price_from');
            $query = $query->where('price', '>=', $priceFrom);
        }
        if ($request->get('price_to')) {
            $priceTo = $request->get('price_to');
            $query = $query->where('price', '<=', $priceTo);
        }
        if ($request->get('status')) {
            $status = $request->get('status');
            $query = $query->where('status', '>=', $status);
        }
        $orders = $query->paginate(10);

        return view('orders.orders', [
            'orders' => $orders,
            'sections' => $sections,
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userOrders()
    {
        if (!Auth::user()->isSpecialist()) {
            $orders = Order::where('by_user', Auth::user()->id)->paginate(7);
        } else {
            $orders = Order::where('executor_id', Auth::user()->id)->paginate(7);
        }

        return view('orders.my-orders', ['orders' => $orders]);
    }

    public function create()
    {
        $sections = TaskSection::all();
        $period = new DatePeriod(
            new DateTime(date('Y-m-d', strtotime('today'))),
            new DateInterval('P1D'),
            new DateTime(date('Y-m-d', strtotime('+14 days'))),
        );
        $dates = [];
        foreach ($period as $value) {
            $dates[] = ['day' => $value->format('d'), 'month' => $value->format('F'), 'format_date' => $value->format('Y-m-d')];
        }

        $times = [];

        for($i=0; $i< 24; $i++){
            $h = $i;
            if ($i <= 9) {
                $h = '0'.$h;
            }
            $m = '00';
            $times[] = $h . ':' . $m;
        }

        return view('orders.create-order', ['sections' => $sections, 'dates' => $dates, 'times' => $times]);
    }

    public function orderRespond (Request $request) {
        $order = Order::find($request->order_id);
        OrderRequest::create(['order_id' => $order->id, 'executor_id' => Auth::user()->id, 'type' => $request->type]);

        if ($request->type == 'request') {
            $data = [
                'notification' => 'Користувач відгукнувся на ваше замовлення',
                'user_id' => $order->by_user,
                'from' => Auth::user()->id,
                'order_id' => $order->id
            ];

            Notification::create($data);
        }
        if ($request->type == 'close') {
            $data = [
                'notification' => 'Користувач виконав ваше замовлення',
                'user_id' => $order->by_user,
                'from' => Auth::user()->id,
                'order_id' => $order->id
            ];

            Notification::create($data);
        }

        return true;
    }

    public function closeOrder (Request $request) {
        $order = Order::find($request->order_id);
        $order->status = 'closed';
        $order->save();
        OrderRequest::where('order_id', $order->id)->where('type', 'close')->delete();

        $authorNotification = [
            'notification' => 'Оцініть користувача',
            'user_id' => $order->by_user,
            'from' => $order->executor_id,
            'order_id' => $order->id,
            'type' => 'rate'
        ];

        Notification::create($authorNotification);

        $executorNotification = [
            'notification' => 'Оцініть користувача',
            'user_id' => $order->executor_id,
            'from' => $order->by_user,
            'order_id' => $order->id,
            'type' => 'rate'
        ];

        Notification::create($executorNotification);

        return view('orders.order-info', ['order' => $order]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['by_user'] = Auth::user()->id;
        $data['status'] = 'open';
        if (isset($data['price_negotiable']) && $data['price_negotiable'] == 'on') {
            $data['price_negotiable'] = true;
        }
        if (!($data['time'])) {
            $data['start_execution_time'] = null;
            $data['end_execution_time'] = null;
        } else {
            $data['start_execution_time'] = $data['execution_date'] . " " . $data['start_execution_time'];
            $data['end_execution_time'] = $data['execution_date'] . " " . $data['end_execution_time'];
        }
        Order::create($data);

        return redirect('/my-orders');
    }

    public function orderRespondAccept (Request $request) {
        OrderRequest::where('executor_id', $request->executor_id)->where('order_id', $request->order_id)->where('type', 'request')->delete();
        Notification::create([
            'from' => $request->author_id,
            'order_id' => $request->order_id,
            'user_id' => $request->executor_id,
            'notification' => 'Підтвердив ваш запит'
        ]);
        $order = Order::find($request->order_id);
        $order->update(['executor_id' => $request->executor_id, 'status' => 'progress']);

        return view('orders.order-info', ['order' => $order]);
    }

    public function orderRespondChange (Request $request) {
        Notification::create([
            'from' => $request->author_id,
            'order_id' => $request->order_id,
            'user_id' => $request->executor_id,
            'notification' => 'Зммінив спеціаліста в задачі'
        ]);
        $order = Order::find($request->order_id);
        $order->update(['executor_id' => null, 'status' => 'open']);

        return view('orders.order-info', ['order' => $order]);
    }

    public function getCategoriesAjax(Request $request) {
        $categories = TaskCategory::where('parent_id', $request->section_id)->get();
        if (count($categories)) {
            return response()->json($categories);
        }
    }


    public function show ($id) {
        $order = Order::find($id);
        $order->update([
            'count_views' => $order->count_views + 1
        ]);

        return view('orders.order-info', ['order' => $order]);
    }
}
