<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;

class AdminHomePageController extends Controller
{

    /**
     * Guard used for admin user
     *
     * @var string
     */
    protected $guard = 'admin';

    public function __construct()
    {
        $this->guard = config('admin-auth.defaults.guard');
    }

    public function index()
    {
        $newUsers = [
            'day' => User::where('created_at', '>=', date('Y-m-d', strtotime("-1 day")))->count(),
            'month' => User::where('created_at', '>=', date('Y-m-d', strtotime("-1 month")))->count(),
            'all' => User::count(),
        ];

        $activeOrders = [
            'day' => Order::whereIn('status', ['open', 'progress'])->where('created_at', '>=', date('Y-m-d', strtotime("-1 day")))->count(),
            'month' => Order::whereIn('status', ['open', 'progress'])->where('created_at', '>=', date('Y-m-d', strtotime("-1 month")))->count(),
            'all' => Order::whereIn('status', ['open', 'progress'])->count(),
        ];

        return view('admin.home.index', ['newUsers' => $newUsers, 'activeOrders' => $activeOrders]);
    }
}
