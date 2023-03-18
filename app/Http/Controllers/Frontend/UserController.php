<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Helpers;
class UserController extends Controller
{

    public function showResetEmailForm($token) {
        return view('front-end.Login', ['token' => $token]);
    }
    public function home(){
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);
         return view('frontend.home');
    }
    public function about(){
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);
        return view('frontend.about.index');
   }

   public function sitemap(){
    $url = $_SERVER['REQUEST_URI'];
    Helpers::visitorUpdate($url);
    return view('frontend.emails.sitemap');
}
   public function contact(){
    $url = $_SERVER['REQUEST_URI'];
    Helpers::visitorUpdate($url);
    return view('frontend.contact.index');
    }
    public function routs(){
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);
        return view('frontend.routs.index');
        }
        public function ragister(){
            $url = $_SERVER['REQUEST_URI'];
            Helpers::visitorUpdate($url);
            return view('frontend.ragister.index');
            }
    // public function signOutUser(){

    //     Auth::guard('customer')->logout();
    //     return redirect()->route('home.index');
    // }
}
