<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Rate;
use App\Models\User;

class NotificationsController extends Controller
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
        $userNotifications = Notification::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        Notification::where('user_id', Auth::user()->id)->update(['shown' => 1]);
        return view('notification' , ['notifications' => $userNotifications]);
    }

    public function rateUser(Request $request) {
        $notification = Notification::where('order_id', $request->order_id)->where('id', $request->notification_id)->where('type', 'rate')->first();
        if ($notification) {
            $user = User::find($request->user_id);
            Rate::create([
                'user_id' => $request->user_id,
                'rate' => $request->rate,
                'from_user' => Auth::user()->id
            ]);
            Notification::create([
                'notification' => trans('alerts.thanks_for_feedback'),
                'user_id' => Auth::user()->id
            ]);
            $user->rate = $user->getRate();
            $user->save();

            $notification->delete();

        }

        return redirect('/notifications');
    }
}
