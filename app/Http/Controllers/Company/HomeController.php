<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
class HomeController extends Controller
{
    public function home(Request $request)
    {
        return view('company.home');
    }

    public function login()
    {
        if (!auth()->check()) {
            return view('company.login');
        }
        return redirect()->route('company.home');
    }

    public function login_post(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'credentials' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->credentials, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        // dd($fieldType);
        $user=User::where('email','=',$request->credentials)->orWhere('phone','=',$request->credentials)->first();
        if($user->type == 3)
        {
            if(auth()->attempt(array($fieldType => $input['credentials'], 'password' => $input['password'])))
            {
                return redirect()->route('company.home');
            }else{
                Session::flash('message','Invalid Email or Password');
                return redirect()->back();
            }
        }



    }



    public function lang($lang)
    {
        if (session()->has('company-lang')) {
            session()->forget('company-lang');
            session()->put('company-lang',$lang);
        } else {
            session()->put('company-lang',$lang);
        }

        return redirect()->back();
    }
}
