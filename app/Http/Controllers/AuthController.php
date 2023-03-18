<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Mail\ForgotPasswordMail;
use App\Http\Requests\ResetPassword;
use App\Admin;
use Str;
use Mail;
use Hash;
use Auth;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // if (Auth::check()) {
        //     return redirect('admin/dashbord');

        // }
        // return view('auth.login');
        $data = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        if ($data == 1)
        {
            return redirect()->route('home');
        }
        else{
            return view('auth.login');
        }

    }
    public function login_admin(Request $request)
    {
    //    return $request;
        $email = $request->email;
            $pass  = $request->pass;

             $data = Admin::Select('email','password')->where('email',$email)->where('password',$pass)->first();

        if($data == '')
     {
        echo 0;
     }
     else{
        $request->session()->put('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d',1);

        echo 1 ;
     }
    }

}
