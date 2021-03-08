<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller{

    public function home(Request $request)
    {
        return view('dashboard.home');
    }

    public function login()
    {
        if (!auth('admin')->check()) {
            return view('dashboard.login');
        }
        return redirect()->route('dashboard.home');
    }

    public function login_post(Request $request)
    {
        $arr = ['email' => $request->get('email'),'password' => $request->get('password')];
        if (auth('admin')->attempt($arr,$request->get('remember_me'))){
            return redirect()->route('dashboard.home');
        }
        Session::flash('message','Invalid Email or Password');
        return redirect()->back();
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('dashboard.login');
    }

    public function lang($lang)
    {
        if (session()->has('dashboard-lang')) {
            session()->forget('dashboard-lang');
            session()->put('dashboard-lang',$lang);
        } else {
            session()->put('dashboard-lang',$lang);
        }

        return redirect()->back();
    }
}
