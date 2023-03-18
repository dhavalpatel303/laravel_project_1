<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Pickup;
use App\Dropcity;
use App\Onewaybookings;
use App\Onewaydetails;
use App\Localdetails;
use App\Driver;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use Mail;
use DB;

class WebController extends Controller
{

        public function web(Request $request )
    {
    //   return $request;
          $details = ['name'=>$request->name,'email'=>$request->email,'number'=>$request->number,'passengers'=>$request->passengers,'pickup'=>$request->pickup,'drop'=>$request->drop,'datepicker'=>$request->datepicker,'time'=>$request->time];
        
             $mail_to = 'gudducab086@gmail.com';
    
        \Mail::to($mail_to)->send(new \App\Mail\MyTestMail($details));
        
        return redirect()->route('home.index')->with('success','Your Bookig Is Created Succesfully');
    }
          public function mail(Request $request )
    {
    //   return $request;
           $details = ['name'=>$request->form_name,'email'=>$request->form_email,'number'=>$request->form_phone,'subject'=>$request->form_subject,'message'=>$request->form_message];
        
             $mail_to = 'gudducab086@gmail.com';
    
        \Mail::to($mail_to)->send(new \App\Mail\MyContactMail($details));
        
        return redirect()->route('contact.index')->with('success','Your Contact Details Is Submited Succesfully');
    }

     public function trip(Request $request )
    {
    
           $details = ['cab_type'=>$request->car_type,'pickup_city'=>$request->pickup_city,'drop_city'=>$request->drop_city,'sedan_number'=>$request->sedan_number];
        
         $mail_to = 'gudducab086@gmail.com';
    
        \Mail::to($mail_to)->send(new \App\Mail\TripDetails($details));
        
            return redirect()->route('home.index')->with('success','Your Number Submited Succesfully');
    }
      public function suvtrip(Request $request )
    {
    
           $details = ['cab_type'=>$request->car_type,'pickup_city'=>$request->pickup_city,'drop_city'=>$request->drop_city,'suv_number'=>$request->suv_number];
        
         $mail_to = 'gudducab086@gmail.com';
    
        \Mail::to($mail_to)->send(new \App\Mail\SuvTripDetails($details));
        
          $array = array('0');
              $json_arrs = $array;
              echo json_encode($json_arrs);
    }
}
