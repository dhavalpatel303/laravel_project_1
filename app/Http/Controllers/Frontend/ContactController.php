<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Inquries;
use App\Captcha;
use App\Contact;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use DataTables;
use DB;
use Mail;
use Helpers;
class ContactController extends Controller
{

    protected $captcha;


    public function index(Request $request)
    {
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);
        $url = $_SERVER['REQUEST_URI'];
        $captcha = Captcha::select('captchas.*')->first();
         $code = $captcha->captcha;
        return view('frontend.contact.index',compact('code'));

    }
    public function contactdetails(Request $request)
    {
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);
        $secret_key = '6Lf6fvwkAAAAACN2lTRiGn0B128hSnMK2YT-_q0n';
        $dk = $request->all();;
        
        
         
        // $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
        //       . $secret_key . '&response='.$dk;
      
        // return $url;
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret="
              .$secret_key ."&response=".$dk['g-recaptcha-response']);
      
        
        $response = json_decode($response, true);
        if ($response["success"] === true)
        {
             request()->validate([  
                    'name'=>'required',
                    'email' => 'required |email',
                    'number'=>'required|digits:10',
                    'message'=>'required',]);

         $name =  $request->post('name');
        $number =  $request->post('number');
        $email =  $request->post('email');
        $message =  $request->post('message');

	        $arraydata = Inquries::create([
	            'name' => $name,
	            'mobile_no' => $number,
	            'email_ids'=>$email,
	            'message'=>$message,
	            
	          ]);

          return redirect()->route('contact.index')->with('success','We Will Contact You Soon');
        } 
        else 
        {
         request()->validate([  
                    'name'=>'required',
                    'email' => 'required |email',
                    'number'=>'required|digits:10',
                    'message'=>'required',
                     'captcha' => 'required|g-recaptcha-response',]);

        }
        
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
    public function email_send($name,$number,$email,$message)
    {
        $to = "dhavalt303@gmail.com";
        $subject = "This is a Contact email";
         $message =  view('frontend.emails.email',compact('name','number','email','message'));
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: booking@cabbookkaro.com' . "\r\n";
            $mail = mail($to, $subject, $message, $headers);
        
                if ($mail) {
                    return redirect()->route('home.index')->with('success','We Will Contact You Soon');
                } else {
                    return redirect()->route('home.index')->with('success','We Will Contact You Soon');
                }
    }
    public function send_captcha(Request $request )
    {
         $captcha = $request->post('data');
         $data = Captcha::select('captchas.*')->where('id',1)->first();
         $captcha_number = rand(1000,9999);
         $arraydata = Captcha::where('id',$data->id)->update([
            "captcha"     => $captcha_number,
            ]);
            $html='';
            $html = '<span id="get_captcha" value='.$captcha_number.'>'.$captcha_number.'</span>';
            echo $html;
    }
}
