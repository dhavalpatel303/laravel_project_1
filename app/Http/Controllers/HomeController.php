<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Helpers;
use App\User;
use App\Inquries;
use App\Oneway_note;
use App\Settings;
use App\Visitor_details;
use App\Testimonial;
use App\Advertisements;
use App\Driver;
use App\Pickup;
use App\Dropcity;
use App\Localdetails;
use App\Onewaydetails;
use App\Multy_bookings;
use App\Requestcall;

class HomeController extends Controller
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
        $this->notification();
        $data['user'] = User::select('users.*')->where('status_delete','No')->where('name','!=','')->where('email','!=','')->where('user_mobile','!=','')->where('otp','!=','')->orderby('id','desc')->count();
        // $data['user']     = User::select('users.*')->where('users.status_delete','No')->count();
        $data['driver'] = Driver::select('drivers.*')->where('drivers.status_delete','No')->count();
        $data['pick_city'] = Pickup::select('pickups.*')->where('pickups.status_delete','No')->count();
        $data['drop_city'] = Dropcity::select('dropcities')->where('dropcities.status_delete','No')->count();
        $data['localdetail'] = Localdetails::select('localdetails')->where('localdetails.status_delete','No')->count();
        $data['onewaydetails'] = Onewaydetails::select('onewaydetails')->where('onewaydetails.status_delete','No')->count();
        $data['requestcalls'] = Requestcall::select('requestcalls')->where('requestcalls.status_delete','No')->count();
        $data['multy_bookings'] = Multy_bookings::select('multy_bookings')->where('multy_bookings.status_delete','No')->count();
        $data['advertisements'] = Advertisements::select('advertisements.*')->count();
        $data['oneway_note'] = Oneway_note::select('oneway_notes.*')->count();
        $data['visitor_details'] = visitor_details::select('visitor_details.*')->count();
        $data['testimonial'] = Testimonial::select('testimonials.*')->count();
        $data['contact'] = inquries::select('inquries.*')->count(); 
        $data['setting'] = Settings::select('settings.*')->count();
        $data['oneway_amount'] = Multy_bookings::select('multy_bookings.total_amount')->where('multy_bookings.booking_type','Oneway')->sum('total_amount');
        $data['oneway_count'] = Multy_bookings::select('multy_bookings.total_amount')->where('multy_bookings.booking_type','Oneway')->count();
        $data['local_amount'] = Multy_bookings::select('multy_bookings.total_amount')->where('multy_bookings.booking_type','Localpackage')->sum('total_amount'); 
        $data['local_count'] = Multy_bookings::select('multy_bookings.total_amount')->where('multy_bookings.booking_type','Localpackage')->count();
        $data['multy_amount'] = Multy_bookings::select('multy_bookings.total_amount')->where('multy_bookings.booking_type','Round-Trip')->sum('total_amount');
        $data['multy_count'] = Multy_bookings::select('multy_bookings.total_amount')->where('multy_bookings.booking_type','Round-Trip')->count();
        return view('home',$data);

    }
    // public function ecommerce()
    // {
    //     return view('dashboard-ecommerce');
    // }
    public function oneway()
    {
        return view('oneway');
    }
    public function local()
    {
        return view('local');
    }
    public function multycity ()
    {
        return view('multicity-list');
    }
    public function localbooking ()
    {
        return view('localbooking');
    }
    public function admin_logout (Request $request)
    {

        $request->session()->flush();
            return redirect()->route('login');

    }



}
