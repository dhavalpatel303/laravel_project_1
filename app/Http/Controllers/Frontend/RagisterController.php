<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Inquries;
use App\Requestcall;
use App\Pickup;
use App\Dropcity;
use App\Onewaybookings;
use App\Localbookings;
use App\Onewaydetails;
use App\Localdetails;
use App\Driver;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use Helpers;
use DB;



class RagisterController extends Controller
{


    public function ragister (Request $request)
    {



        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);

        // $this->validate($request, [
        //     'user_mobile' => 'required|digits:10|unique:users,user_mobile',
        //     'email' => 'required|unique:users,email',
        //     'name' =>'required',

        // ]);
        // return $request;
            $name = $request->name;
            $email = $request->email;
            $number = $request->number;

             $data = User::select('users.*')->where('user_mobile',$number)->where('users.status_delete','No')->first();
             if($data == '')
                {
                    $arraydata = User::create([
                        'name' => $name,
                        'email' => $email,
                        'user_mobile'=>$number,
                      ]);
                      echo 1;
                }
                else{
                    echo 0;
                }
        //  $input = $request->all();
        //  $user = User::create($input);
        // return redirect()->route('signup')
        //     ->with('success','Your registration has been completed successfully');
    }

    public function loginstore(Request $request )
    {
           $user_data = $request->user_mobile;

           $data = User::select('users.*')->where('user_mobile',$user_data)->where('users.status_delete','No')->first();
        if($data == '')
        {
            $otp = '1234';
                 User::create([
                'otp' => $otp,
                'user_mobile' => $user_data,

            ]);
            return view('frontend.ragister.otp');
        }
        else{
            $otp1= '1234';
            User::where('id',$data->id)->update([
                        "otp"     => $otp1,
                       "id"      => $data->id
                       ]);
                    return view('frontend.ragister.otp');
        }


    }
    public function homelogin(Request $request )
    {

         $user_data  = $request->post('user_mobile');
          $data = User::select('users.*')->where('user_mobile',$user_data)->where('users.status_delete','No')->first();

        if($data == '')
        {
 

                // $otp = rand(1000,9999);
                    $otp = 1234;
                    $arraydata = User::create([
                        'otp' => $otp,
                        'user_mobile' => $user_data,
                      ]);
                      $this->send_otp_sms($otp, $user_data);
                      $this->send_owner_sms($user_data);
                      $array = array('0' => $user_data );
                      $json_arrs = $array;
                        $sess_array = array();
                        // return "dhaval";
                    $sess_array['userdetail_id']	=	$data->id;
                    $sess_array['user_mobile']		=	$data->user_mobile;
                      $request->session()->put($sess_array);
                      echo json_encode($json_arrs);
        }
        else{

            // $otp= rand(1000,9999);
            $otp = 1234;
            $arraydata = User::where('id',$data->id)->update([
                        "otp"     => $otp,
                        'user_mobile' => $user_data,
                       ]);
                       $this->send_otp_sms($otp, $user_data);
                       $this->send_owner_sms($user_data);
                       $array = array('0' => $data->user_mobile);
                      $json_arrs = $array;
                       $sess_array['userdetail_id']	=	$data->id;
                    $sess_array['user_mobile']		=	$data->user_mobile;
                      $request->session()->put($sess_array);
                       echo json_encode($json_arrs);
        }



    }
      public function onewayotp_check(Request $request)
    {
              $user_mobile = $request->post('user_mobile_re');
            $user_otp  = $request->post('user_otp');
           $mobile = user::Select('users.*')->where('user_mobile',$user_mobile)->first();
            $otp = user::Select('users.*')->where('otp',$user_otp)->get();
            $user_data = User::select('users.*')->where('otp',$user_otp)->where('user_mobile',$user_mobile)->first();


            if($user_data !='')
            {
                echo 1;
                $sess_array = array();
                $sess_array['userdetail_id']	=	$user_data->id;
                $sess_array['user_mobile']		=	$user_data->user_mobile;

                $request->session()->put($sess_array);

            }
            else{
                echo 0;
            }


    }
    public function resend_otp(Request $request )
    {
        // return $request;
         $user_data  = $request->post('user_mobile_re');
          $data = User::select('users.*')->where('user_mobile',$user_data)->where('users.status_delete','No')->first();

        if($data == '')
        {


                // $otp = rand(1000,9999);
                    $otp = 1234;
                    $arraydata = User::create([
                        'otp' => $otp,
                        'user_mobile' => $user_data,
                      ]);
                      $this->send_otp_sms($otp, $user_data);
                      $this->send_owner_sms($user_data);
                      $array = array('0' => $user_data );
                      $json_arrs = $array;
                      echo json_encode($json_arrs);
        }
        else{

            // $otp= rand(1000,9999);
            $otp = 1234;
            $arraydata = User::where('id',$data->id)->update([
                        "otp"     => $otp,
                        'user_mobile' => $user_data,
                       ]);
                       $this->send_otp_sms($otp, $user_data);
                       $this->send_owner_sms($user_data);
                       $array = array('0' => $data->user_mobile);
                      $json_arrs = $array;
                       echo json_encode($json_arrs);
        }



    }
    public function send_otp_sms($otp,$user_data){
         $otp   = $otp;

		$number= $user_data;
		$message=urlencode($otp. ' is your mobile verification code. Regards, www.cabbookkaro.com Call: +919909151547 Team MRSTXI');

		$DLT_TE_ID = '1207166081646554203';

		   $url_a=helpers::get_sms_url();
		  $a= $url_a->url;
		 $url_b = str_replace('{number}',$number,$a);
		$url_c = str_replace('{message}',$message,$url_b);
		$url = str_replace('{DLT_TE_ID}',$DLT_TE_ID,$url_c);
		 $msg_status=$this->run_urlOnwaycab($url);
		return true;
    }

    public function send_owner_sms($user_data){
        $user_details = user::select('users.*')->where('user_mobile',$user_data)->get();
        if ($user_details[0]['name'] == '') {
			$getDate    = $user_details[0]['created_at'];
			$getTime    = $user_details[0]['created_at'];
			$date 		= date('d-M-Y', strtotime($getDate));
			$time 		= date('H:i', strtotime($getTime));
		} else {
			$getDate    = $user_details[0]['updated_at'];
			$getTime    = $user_details[0]['updated_at'];
			$date 		= date('d-m-Y', strtotime($getDate));
			$time 		= date('H:i', strtotime($getTime));
		}

       $message=urlencode($user_data.' Number is check cab price on '.$date.' to '.$time.' in www.cabbookkaro.com Team MRSTXI');


       $DLT_TE_ID = '1207166081675348921';

          $url_a=helpers::get_sms_url();
         $a= $url_a->url;
         $number = $url_a->mobile;
        $url_b = str_replace('{number}',$number,$a);
       $url_c = str_replace('{message}',$message,$url_b);
       $url = str_replace('{DLT_TE_ID}',$DLT_TE_ID,$url_c);
        $msg_status=$this->run_urlOnwaycab($url);
       return true;
   }

    public function homeragister(Request $request)
    {
        $user_mobile  = $request->post('user_mobile');
        $user_name   = $request->post('user_name');
        $user_email = $request->post('user_email');

        $arraydata = User::create([
            'user_mobile' => $user_mobile,
            'name'=>$user_name,
            'email' => $user_email,
          ]);
          $array = array('0' => $user_mobile );
          $json_arrs = $array;
          echo json_encode($json_arrs);

   }

  


    public function otp (Request $request)
    {
        return view('frontend.ragister.otp');
    }
    public function otp_check(Request $request)
    {


             $user_data = User::select('users.*')->where('otp',$request->otp)->where('users.status_delete','No')->first();


        if($user_data !='')
        {
            $request->session()->put('user_mobile',$user_data->user_mobile);
            return redirect()->route('home.index');
        }
        else{
            return redirect()->route('otp.index')
            ->with('error','Your Otp Is Wrong ! Please Enter Correct Otp ' );
        }

    }



    public function logout(Request $request)
    {
        if($request->session()->get('user_mobile'))
        {
            $request->session()->flush();
            return redirect()->route('home.index');
        }else{
            return false;
        }
    }
    public function contact_inquiry(Request $request)
    {

          $mobile_no  = $request->post('mobile_no');

            if( $mobile_no != '')
            {
                  $arraydata = Requestcall::create([
                    'status' => 'Active',
                    'contact_number' => $mobile_no,
                  ]);
                     $this->request_call_sms($mobile_no);
                  echo 1;


            }else{
                echo  0;
            }


    }
    public function request_call_sms($mobile_no)
	{
   $url = $_SERVER['REQUEST_URI']; 
          Helpers::visitorUpdate($url);
	      $request = Requestcall::select('requestcalls.*')->where('contact_number',$mobile_no)->get();
	 	$userNumber = $request[0]['contact_number'];
		 $getDate    = $request[0]['created_at'];
		$getTime    = $request[0]['created_at'];
		$date 		= date('d-M-Y', strtotime($getDate)); 
		$time 		= date('H:i', strtotime($getTime));
        	// var number request to callback on Date var at var www.vahansewa.net
        $message=urlencode($userNumber.' number request to callback on Date '.$date.' at '.$time.' www.cabbookkaro.com Team MRSTXI');

		$DLT_TE_ID = '1207166081650489883';
        $url_a=helpers::get_sms_url();
         $a= $url_a->url;
	     $number= $url_a->mobile;
		 $url_b = str_replace('{number}',$number,$a);
		 $url_c = str_replace('{message}',$message,$url_b);
		    $url = str_replace('{DLT_TE_ID}',$DLT_TE_ID,$url_c);
		  $msg_status=$this->run_urlOnwaycab($url);
        return true;

	}


    protected function run_urlOnwaycab($url)
	{
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

public function signup(Request $request)
{
    $url = $_SERVER['REQUEST_URI'];
    Helpers::visitorUpdate($url);
    return view('frontend.ragister.signup');
}
public function faredetails(Request $request)
{

    $id=$request->post('onewaydetail_id');

    $data = Onewaydetails::select('onewaydetails.*')->where('id',$id)->first();
    $html='';
    $html.=' <div class="modal-body" padding-top:0px;">
                <table class="table table-bordered table-striped">
                <thead>
		            <tr>
                        <th scope="col">Base Fare</th>
                        <th scope="col">:</th>
                        <th scope="col">Rs.'.$data->amount.'/-</th>
                    </tr>

                    <tr>
                        <th scope="col">Toll Tax</th>
                        <th scope="col">:</th>
                        <th scope="col">Rs.'.$data->tax.'/-</th>
                    </tr>
                    <tr>
                        <th scope="col">State Tax</th>
                        <th scope="col">:</th>
                        <th scope="col">Rs.'.$data->state_tax.'/-</th>
                    </tr>
                    <tr>
                        <th scope="col">Driver Allownce</th>
                        <th scope="col">:</th>
                        <th scope="col">Rs.'.$data->driver_allowance.'/-</th>
                    </tr>
                    <tr>
                    <th scope="col" style="font-weight:900">Total Amount</th>
                    <th scope="col">:</th>
                    <th scope="col" style="font-weight:900">Rs.'.$data->total_amount.'/-</th>
                </tr>
		          </thead>
                </table>
            </div>';
    echo $html;
}
public function localfaredetails(Request $request)
{

    $id=$request->post('localdetails_id');

    $data = Localdetails::select('localdetails.*')->where('id',7)->first();
    $html='';
    $html.=' <div class="modal-body" padding-top:0px;">
                <table class="table table-bordered table-striped">
                <thead>
		            <tr>
                        <th scope="col">Base Fare</th>
                        <th scope="col">:</th>
                        <th scope="col">Rs.'.$data->amount.'/-</th>
                    </tr>

                    <tr>
                        <th scope="col">Toll Tax</th>
                        <th scope="col">:</th>
                        <th scope="col">'.$data->hours.' Hours</th>
                    </tr>
                    <tr>
                        <th scope="col">State Tax</th>
                        <th scope="col">:</th>
                        <th scope="col">'.$data->kms.'Km</th>
                    </tr>
                    <tr>
                        <th scope="col">Driver Allownce</th>
                        <th scope="col">:</th>
                        <th scope="col">'.$data->ehr.'/Hour</th>
                    </tr>
                    <tr>
                        <th scope="col">Driver Allownce</th>
                        <th scope="col">:</th>
                        <th scope="col">'.$data->ekr.'/Km</th>
                    </tr>
                    <tr>
                    <th scope="col" style="font-weight:900">Total Amount</th>
                    <th scope="col">:</th>
                    <th scope="col" style="font-weight:900">Rs.'.$data->total_amount.'/-</th>
                </tr>
		          </thead>
                </table>
            </div>';
    echo $html;
}

}
