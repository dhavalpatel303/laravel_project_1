<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class ChangePasswordController extends Controller
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
        return view('change-password');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request;
        $old = $request->current_password;
        $new= $request->new_password;
        $confirm = $request->new_confirm_password;
        $data= Admin:: select('password')->where('password',$old)->first();

            if($data != ''){

                    if($new == $confirm){
                        Admin::find(auth()->user()->id)->update(['password'=> $request->new_password]);
                        echo 1;
                    }
                    else{
                        echo 2;
                    }

            }else{
                echo 0;
            }

        // Admin::find(auth()->user()->id)->update(['password'=> $request->new_password]);
        // return redirect()->route('home')
        // ->with('success','Password Change successfully');
    }
}
