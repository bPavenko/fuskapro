<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function balanceReplenishment(Request $request)
    {
        Auth::user()->balance = Auth::user()->balance + $request->coins;
        Auth::user()->save();
        Alert::success('success', 'Ви придбали  ' . $request->coins . ' монет');

        return back();
    }


}
