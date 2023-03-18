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
use App\Pickup;
use App\Dropcity;
use App\Onewaybookings;
use App\Localbookings;
use App\Onewaydetails;
use App\Local_package;
use App\Cab_master;
use App\Localdetails;
use App\Multicitybookings;
use App\Multicitycabs;
use App\Driver;
use App\Multy_bookings;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use Helpers;
use DB;

class MyaccountController extends Controller
{

    public function index(Request $request )
    {
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);

                 $userdetail_id = session()->get('userdetail_id');
             $usermobile = session()->get('user_mobile');
			      $data['profile'] = User::select('users.*')->where('id',$userdetail_id)->first();
             $data['date'] = onewaybookings::select('onewaybookings.pickup_date')->where('user_id',$userdetail_id)->first();
          
             $data['complate_oneway'] = Multy_bookings::select('users.name','users.email','users.user_mobile','cab_masters.cab','cab_masters.image','multy_bookings.*')
            ->join('users','users.id','multy_bookings.user_id')
            ->join('cab_masters','multy_bookings.cab_type','cab_masters.id')
            ->where('user_id',$userdetail_id)
            ->where('multy_bookings.status',0)
            ->where('multy_bookings.booking_type','Oneway')
            ->where('multy_bookings.status_delete','No')
            ->get();
            //  $data['complate_multyway'] = Multicitybookings::select('multicitybookings.*')->where('user_id',$userdetail_id)->where('status','0')->get();
          
            $data['upcoming_oneway'] = Multy_bookings::select('users.name','users.email','users.user_mobile','cab_masters.cab','cab_masters.image','multy_bookings.*')
            ->join('users','users.id','multy_bookings.user_id')
            ->join('cab_masters','multy_bookings.cab_type','cab_masters.id')
            ->where('user_id',$userdetail_id)
            ->where('multy_bookings.status',1)
            ->where('multy_bookings.booking_type','Oneway')
            ->where('multy_bookings.status_delete','No')
            ->get();


                   $data['complate_localway'] = Multy_bookings::select('users.name','users.email','users.user_mobile','cab_masters.cab','cab_masters.image','multy_bookings.*')
            ->join('users','users.id','multy_bookings.user_id')
            ->join('cab_masters','multy_bookings.cab_type','cab_masters.id')
            ->where('user_id',$userdetail_id)
            ->where('multy_bookings.status',0)
            ->where('multy_bookings.booking_type','Localpackage')
            ->where('multy_bookings.status_delete','No')
            ->get();

                $data['upcoming_localway'] = Multy_bookings::select('users.name','users.email','users.user_mobile','cab_masters.cab','cab_masters.image','multy_bookings.*')
            ->join('users','users.id','multy_bookings.user_id')
            ->join('cab_masters','multy_bookings.cab_type','cab_masters.id')
            ->where('user_id',$userdetail_id)
            ->where('multy_bookings.status',1)
            ->where('multy_bookings.booking_type','Localpackage')
            ->where('multy_bookings.status_delete','No')
            ->get();
              


    $data['complate_multyway'] = Multy_bookings::select('users.name','users.email','users.user_mobile','cab_masters.cab','cab_masters.image','multy_bookings.*')
            ->join('users','users.id','multy_bookings.user_id')
            ->join('cab_masters','multy_bookings.cab_type','cab_masters.id')
            ->where('user_id',$userdetail_id)
            ->where('multy_bookings.status',0)
            ->where('multy_bookings.booking_type','Round-Trip')
            ->where('multy_bookings.status_delete','No')
            ->get();

            $data['upcoming_multyway'] = Multy_bookings::select('users.name','users.email','users.user_mobile','cab_masters.cab','cab_masters.image','multy_bookings.*')
            ->join('users','users.id','multy_bookings.user_id')
            ->join('cab_masters','multy_bookings.cab_type','cab_masters.id')
            ->where('user_id',$userdetail_id)
            ->where('multy_bookings.status',1)
            ->where('multy_bookings.booking_type','Round-Trip')
            ->where('multy_bookings.status_delete','No')
            ->get();

          //   //  $data['complate_oneway'] = Onewaybookings::select('onewaybookings.*')->where('user_id',$userdetail_id)->where('status',0)->get();
		      
            //  $data['complate_localway'] = localbookings::select('localbookings.*')->where('user_id',$userdetail_id)->where('status',0)->get();
        return view('frontend.myaccount.myaccount',$data);
    }

    public function complate(Request $request)
    {
        $userdetail_id = session()->get('userdetail_id');
        $usermobile = session()->get('user_mobile');
        $data['complate_oneway'] = Onewaybookings::select('onewaybookings.*')->where('user_id',$userdetail_id)->where('status',0)->where('onewaybookings.status_delete','No')->get();
        $data['complate_localway'] = localbookings::select('localbookings.*')->where('user_id',$userdetail_id)->where('status',0)->where('localbookings.status_delete','No')->get();
         $data['complate_multyway'] = Multicitybookings::select('multicitybookings.*')->where('user_id',$userdetail_id)->where('status',0)->where('multicitybookings.status_delete','No')->get();
        return view('frontend.myaccount.complate',$data);
    }
    function popup_values(Request $request)
    {
          $up_one_id = $request->post('onewayupcoming_id');

         $result  = Multy_bookings::select('users.name','users.email','users.user_mobile','cab_masters.cab','cab_masters.image','multy_bookings.*')
            ->join('users','users.id','multy_bookings.user_id')
            ->join('cab_masters','multy_bookings.cab_type','cab_masters.id')
            ->where('multy_bookings.id',$up_one_id)
            ->where('multy_bookings.booking_type','Oneway')
            ->where('multy_bookings.status_delete','No')
            ->first(); 
       $pcity_id = $result->pickupcity_id;
       $dcity_id = $result->drop_city;
        $cab = $result->cab_type;
       $cab_type = Cab_master::select('cab_masters.*')->where('cab_masters.id',$cab)->first();
 $pickup = Pickup::select('pickups.pick_city')->where('pickups.id',$pcity_id)->first();
 $drop = Dropcity::select('dropcities.drop_city')->where('dropcities.id',$dcity_id)->first();
         if($result->s_request=='') {
			$s_request = '-';
		} else {
			$s_request = $result->s_request;
		}


		if($result->flight_number == '') {
			$flight_number = '-';
		} else {
			$flight_number = $result->flight_number;
		}

        if($result->driver_name ==''){
            $driver_name = '-';
        }else{
            $driver_name = $result->driver_name;
        }

        if($result->status == '0') {
            $status='Completed';
			$b_status_color = 'color:#294f75';
		} else if($result->status == '1') {
			$b_status_color = 'color:#d2408c';
            $status = "Panding";
		} else {
			$b_status_color = 'color:#294f75';

		}

        $html='';

        $html.='

			    <div class="modal-body" padding-top:0px;">
				<table class="table table-bordered table-striped">
		          <thead>
		            <tr style="text-align:left">
		              <th scope="col">Order No</th>
			      	  <th scope="col">:</th>
		              <th scope="col">'.$result->orderno.'</th>
		            </tr>
		          </thead>
		          <tbody>
                  <tr style="text-align:left">
		              <td><b>Customer Name</b></td>
		              <td>:</td>
		              <td>'.$result->name.'</td>
		            </tr>
		            <tr style="text-align:left">
		              <td><b>Mobile</b></td>
		              <td>:</td>
		              <td>'.$result->user_mobile.'</td>
		            </tr>
		            <tr style="text-align:left">
		              <td><b>Email</b></td>
		              <td>:</td>
		              <td>'.$result->email.'</td>
		            </tr>
		            <tr style="text-align:left">
		              <td><b>Pickup City</b></td>
		              <td>:</td>
		              <td>'.$pickup->pick_city.'</td>
		            </tr>
		             <tr style="text-align:left">
		              <td><b>Drop City</b></td>
		              <td>:</td>
		              <td>'.$drop->drop_city.'</td>
		            </tr>

		             <tr style="text-align:left">
		              <td><b>Pickup Date</b></td>
		              <td>:</td>
		              <td>'.date_format(date_create($result->pickup_date),'d-m-Y').'</td>
		            </tr>

		             <tr style="text-align:left">
		              <td><b>Special Request</b></td>
		              <td>:</td>
		              <td>'.$s_request.'</td>
		            </tr>

		             <tr style="text-align:left">
		              <td><b>Seat</b></td>
		              <td>:</td>
		              <td>'.$cab_type->seat.'</td>
		            </tr>

		             <tr style="text-align:left">
		              <td><b>Bags</b></td>
		              <td>:</td>
		              <td>'.$cab_type->bag.'</td>
		            </tr>
                 <tr style="text-align:left">
                    <td><b>Total Km</b></td>
                    <td>:</td>
                        <td>'.$result->estimate_kms.' Km</td>
                    </tr>
                    <tr style="text-align:left">
                    <td><b>Km Rate</b></td>
                    <td>:</td>
                        <td><i class="fa fa-inr"></i> '.$cab_type->km_rate.'/-</td>
                    </tr>


                    <tr style="text-align:left">
                    <td><b>Avaliable Cabs</b></td>
                    <td>:</td>
                        <td>'.$cab_type->av_cabs.'</td>
                    </tr>

		             <tr style="text-align:left">
		              <td><b>Flight Number</b></td>
		              <td>:</td>
		              <td>'.$flight_number.'</td>
		            </tr>
					<tr style="text-align:left">
		              <td><b>Booking status</b></td>
		              <td>:</td>
		              <td><b style='.$b_status_color.'>'.$status.'</td>
		            </tr>

		            <tr style="text-align:left">
		              <td><b>Inclusive rate</b></td>
		              <td>:</td>
		              <td>Rs.'.$result->total_amount.'/-</td>
		            </tr>
		             <tr style="text-align:left">
		              <td><b>Pickup Location</b></td>
		              <td>:</td>
		              <td>'.$result->pickup_location.'</td>
		            </tr>

		             <tr style="text-align:left">
		              <td><b>Drop Location</b></td>
		              <td>:</td>
		              <td>'.$result->drop_location.'</td>
		            </tr>

		             <tr style="text-align:left">
		              <td><b>Pickup Time</b></td>
		              <td>:</td>
		              <td>'.$result->pickup_time.'</td>
		            </tr>

		             <tr style="text-align:left">
		              <td><b>Cab Type</b></td>
		              <td>:</td>
		              <td>'.$result->cab.'</td>
		            </tr>


		             <tr style="text-align:left">
		              <td><b>Driver Name</b></td>
		              <td>:</td>
		              <td>'.$driver_name.'</td>
		            </tr>
		          </tbody>
		          </table>
		        </div>';

        echo $html;

    }

	function local_popup_values(Request $request)
    {
         $up_local_id = $request->post('localwayupcoming_id');
	
          $result  = Multy_bookings::select('users.name','users.email','users.user_mobile','cab_masters.cab','cab_masters.image','multy_bookings.*')
            ->join('users','users.id','multy_bookings.user_id')
            ->join('cab_masters','multy_bookings.cab_type','cab_masters.id')
            ->where('multy_bookings.id',$up_local_id)
            ->where('multy_bookings.booking_type','Localpackage')
            ->where('multy_bookings.status_delete','No')
            ->first();
      $pcity_id = $result->pickupcity_id;
      $dcity_id = $result->drop_city;
      $cab = $result->cab_type;
       $cab_type = Cab_master::select('cab_masters.*')->where('cab_masters.id',$cab)->first();
 $pickup = Pickup::select('pickups.pick_city')->where('pickups.id',$pcity_id)->first();
   $drop = Local_package::select('local_packages.local_package')->where('local_packages.id',$dcity_id)->first();
   $cab_type = Cab_master::select('cab_masters.*')->where('cab_masters.id',$cab)->first();

         if($result->s_request=='') {
			$s_request = '-';
		} else {
			$s_request = $result->s_request;
		}

		if($result->flight_number == '') {
			$flight_number = '-';
		} else {
			$flight_number = $result->flight_number;
		}

        if($result->driver_name ==''){
            $driver_name = '-';
        }else{
            $driver_name = $result->driver_name;
        }

		if($result->status == '0') {
            $status='Completed';
			$b_status_color = 'color:#294f75';
		} else if($result->status == '1') {
			$b_status_color = 'color:#d2408c';
            $status = "Panding";
		} else {
			$b_status_color = 'color:#294f75';

		}

        $html='';

        $html.='    <div class="modal-body" padding-top:0px;">
                <table class="table table-bordered table-striped">
		          <thead>
		            <tr style="text-align:left">
		              <th scope="col">Order No</th>
			      	  <th scope="col">:</th>
		              <th scope="col">'.$result->orderno.'</th>
		            </tr>
		          </thead>
		          <tbody>
                  <tr style="text-align:left">
                  <td><b>Customer Name</b></td>
                  <td>:</td>
                  <td>'.$result->name.'</td>
                </tr>
		            <tr style="text-align:left">
		              <td><b>Mobile</b></td>
		              <td>:</td>
		              <td>'.$result->user_mobile.'</td>
		            </tr>
		            <tr style="text-align:left">
		              <td><b>Email</b></td>
		              <td>:</td>
		              <td>'.$result->email.'</td>
		            </tr>
		            <tr style="text-align:left">
		              <td><b>Pickup City</b></td>
		              <td>:</td>
		              <td>'.$pickup->pick_city.'</td>
		            </tr>
		             <tr style="text-align:left">
		              <td><b>Drop City</b></td>
		              <td>:</td>
		              <td>'.$drop->local_package.'</td>
		            </tr>

		             <tr style="text-align:left">
		              <td><b>Pickup Date</b></td>
		              <td>:</td>
		              <td>'.date_format(date_create($result->pickup_date),'d-m-Y').'</td>
		            </tr>

		             <tr style="text-align:left">
		              <td><b>Special Request</b></td>
		              <td>:</td>
		              <td>'.$s_request.'</td>
		            </tr>

                    <tr style="text-align:left">
                    <td><b>Seat</b></td>
                    <td>:</td>
                    <td>'.$cab_type->seat.' Seats</td>
                  </tr>

                   <tr style="text-align:left">
                    <td><b>Bags</b></td>
                    <td>:</td>
                    <td>'.$cab_type->bag.' Bags</td>
                  </tr>

               

                  <tr style="text-align:left">
                  <td><b>Avaliable Cabs</b></td>
                  <td>:</td>
                      <td>'.$result->av_cabs.'</td>
                  </tr>

		             <tr style="text-align:left">
		              <td><b>Flight Number</b></td>
		              <td>:</td>
		              <td>'.$flight_number.'</td>
		            </tr>
					<tr style="text-align:left">
		              <td><b>Booking status</b></td>
		              <td>:</td>
		              <td><b style='.$b_status_color.'>'.$status.'</td>
		            </tr>

		            <tr style="text-align:left">
		              <td><b>Inclusive rate</b></td>
		              <td>:</td>
		              <td>Rs.'.$result->total_amount.'/-</td>
		            </tr>
		             <tr style="text-align:left">
		              <td><b>Pickup Location</b></td>
		              <td>:</td>
		              <td>'.$result->pickup_location.'</td>
		            </tr>

		             <tr style="text-align:left">
		              <td><b>Drop Location</b></td>
		              <td>:</td>
		              <td>'.$result->drop_location.'</td>
		            </tr>

		             <tr style="text-align:left">
		              <td><b>Pickup Time</b></td>
		              <td>:</td>
		              <td>'.$result->pickup_time.'</td>
		            </tr>

		             <tr style="text-align:left">
		              <td><b>Cab Type</b></td>
		              <td>:</td>
		              <td>'.$result->cab.'</td>
		            </tr>



		             <tr style="text-align:left">
		              <td><b>Driver Name</b></td>
		              <td>:</td>
		              <td>'.$driver_name.'</td>
		            </tr>
		          </tbody>
		          </table>
		        </div>';

        echo $html;

    }

function multy_popup_values(Request $request)
{

$up_multy_id = $request->post('multyupcoming_id');
    $result  = Multy_bookings::select('users.name','users.email','users.user_mobile','cab_masters.cab','cab_masters.image','multy_bookings.*')
            ->join('users','users.id','multy_bookings.user_id')
            ->join('cab_masters','multy_bookings.cab_type','cab_masters.id')
            ->where('multy_bookings.id',$up_multy_id)
            ->where('multy_bookings.booking_type','Round-Trip')
            ->where('multy_bookings.status_delete','No')
            ->first();
      $pcity_id = $result->pickupcity_id;
      $dcity_id = $result->dropcity_id;
      $cab = $result->cab_type;
       $cab_type = Cab_master::select('cab_masters.*')->where('cab_masters.id',$cab)->first();
 $pickup = Pickup::select('pickups.pick_city')->where('pickups.id',$pcity_id)->first();
   $drop =  $result->travel_city;
   $cab_type = Cab_master::select('cab_masters.*')->where('cab_masters.id',$cab)->first();
   $multy_cab = Multicitycabs::select('multicitycabs.*')->where('cab_id',$cab)->first();

if($result->s_request=='') {
$s_request = '-';
} else {
$s_request = $result->s_request;
}


if($result->flight_number == '') {
$flight_number = '-';
} else {
$flight_number = $result->flight_number;
}

if($result->driver_name ==''){
$driver_name = '-';
}else{
$driver_name = $result->driver_name;
}

if($result->status == '0') {
$status='Completed';
$b_status_color = 'color:#294f75';
} else if($result->status == '1') {
$b_status_color = 'color:#d2408c';
$status = "Panding";
} else {
$b_status_color = 'color:#294f75';

}
$html='';

$html.='

    <div class="modal-body" padding-top:0px;">
	<table class="table table-bordered table-striped">
      <thead>
        <tr style="text-align:left">
          <th scope="col">Order No</th>
      	  <th scope="col">:</th>
          <th scope="col">'.$result->orderno.'</th>
        </tr>
      </thead>
      <tbody>
      <tr style="text-align:left">
      <td><b>Customer Name</b></td>
      <td>:</td>
      <td>'.$result->name.'</td>
    </tr>
        <tr style="text-align:left">
          <td><b>Mobile</b></td>
          <td>:</td>
          <td>'.$result->user_mobile.'</td>
        </tr>
        <tr style="text-align:left">
          <td><b>Email</b></td>
          <td>:</td>
          <td>'.$result->email.'</td>
        </tr>
        <tr style="text-align:left">
          <td><b>Pickup City</b></td>
          <td>:</td>
          <td>'.$pickup->pick_city.'</td>
        </tr>
        <tr style="text-align:left">
        <td><b>Travel City</b></td>
        <td>:</td>
        <td>'.$result->travel_city .'</td>
        </tr>
        <tr style="text-align:left">
        <td><b>Journy Days</b></td>
        <td>:</td>
        <td>'.$result->journey .' Days</td>
        </tr>
        <tr style="text-align:left">
        <td><b>Return Date</b></td>
        <td>:</td>
        <td>'.$result->return_date .'</td>
        </tr>


         <tr style="text-align:left">
          <td><b>Pickup Date</b></td>
          <td>:</td>
          <td>'.date_format(date_create($result->pickup_date),'d-m-Y').'</td>
        </tr>

         <tr style="text-align:left">
          <td><b>Special Request</b></td>
          <td>:</td>
          <td>'.$s_request.'</td>
        </tr>
        <tr style="text-align:left">
        <td><b>Seat</b></td>
        <td>:</td>
        <td>'.$result->seat.' Seats</td>
      </tr>

       <tr style="text-align:left">
        <td><b>Bags</b></td>
        <td>:</td>
        <td>'.$result->bag.' Bags</td>
      </tr>
        <tr style="text-align:left">
        <td><b>Total Km</b></td>
        <td>:</td>
        <td>'.$result->estimate_kms.' Km</td>
      </tr>
      <tr style="text-align:left">
      <td><b>Km Rate</b></td>
      <td>:</td>
          <td><i class="fa fa-inr"></i>'.$cab_type->mkm_rate.'/Km</td>
      </tr>
      <tr style="text-align:left">
      <td><b>Minimun Km </b></td>
      <td>:</td>
          <td>'.$multy_cab->minkm.'/Km</td>
      </tr>

         <tr style="text-align:left">
          <td><b>Flight Number</b></td>
          <td>:</td>
          <td>'.$flight_number.'</td>
        </tr>
		<tr style="text-align:left">
          <td><b>Booking status</b></td>
          <td>:</td>
          <td><b style='.$b_status_color.'>'.$status.'</td>
        </tr>

        <tr style="text-align:left">
          <td><b>Inclusive rate</b></td>
          <td>:</td>
          <td>Rs.'.$result->total_amount.'/-</td>
        </tr>
         <tr style="text-align:left">
          <td><b>Pickup Location</b></td>
          <td>:</td>
          <td>'.$result->pickup_location.'</td>
        </tr>

         <tr style="text-align:left">
          <td><b>Drop Location</b></td>
          <td>:</td>
          <td>'.$result->drop_location.'</td>
        </tr>

         <tr style="text-align:left">
          <td><b>Pickup Time</b></td>
          <td>:</td>
          <td>'.$result->pickup_time.'</td>
        </tr>

         <tr style="text-align:left">
          <td><b>Cab Type</b></td>
          <td>:</td>
          <td>'.$result->cab_type.'</td>
        </tr>



         <tr style="text-align:left">
          <td><b>Driver Name</b></td>
          <td>:</td>
          <td>'.$driver_name.'</td>
        </tr>
      </tbody>
      </table>
    </div>';

echo $html;
}

}

