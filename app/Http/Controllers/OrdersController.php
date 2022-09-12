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

class OrdersController extends Controller
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

    public function index()
    {
        $orders = Order::all();
        return view('orders.orders', ['orders' => $orders]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userOrders()
    {
        $orders = Order::where('by_user', Auth::user()->id)->get();
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
        OrderRequest::create(['order_id' => $order->id, 'executor_id' => Auth::user()->id]);
        $data = [
            'notification' => 'Користувач відгукнувся на ваше замовлення',
            'user_id' => $order->by_user,
            'from' => Auth::user()->id,
            'order_id' => $order->id
        ];
        Notification::create($data);

        return true;
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['by_user'] = Auth::user()->id;
        $data['status'] = 'open';
        if (isset($data['price_negotiable']) && $data['price_negotiable'] == 'on') {
            $data['price_negotiable'] = true;
        }
        if (isset($data['without_execution_time']) && $data['without_execution_time'] == 'on') {
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
        OrderRequest::where('executor_id', $request->executor_id)->where('order_id', $request->order_id)->delete();
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
        return view('orders.order-info', ['order' => $order]);
    }
}
