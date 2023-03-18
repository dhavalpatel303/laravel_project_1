<?php

namespace App\Http\Controllers\Frontend;

use App\Cab_master;
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
use App\Localdetails;
use App\Multicitybookings;
use App\Multy_bookings;
use App\Multicitycabs;
use App\Multicityprices;
use App\Driver;
use App\User;
use App\Local_package;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use DateTime;
use Helpers;
use DB;

class OnewaybookcabController extends Controller
{
    public function index(Request $request,$onewaydetails_id)
    {
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);
        $onewaydetail_id = $onewaydetails_id;
        $user_mobile= session()->get('user_mobile');
        $userid = session()->get('userdetail_id');
        $request= onewaydetails::select('id as onewayid')->where('id',$onewaydetail_id)->where('onewaydetails.status_delete','No')->first();
        if($request == '')
        {
            return view("frontend.about.error");

        }
        else{
            $pick_city_id = Onewaydetails::select('onewaydetails.*')->where('id',$onewaydetail_id)->where('onewaydetails.status_delete','No')->first();
             $cab = Cab_master::select('cab_masters.*')->where('cab_masters.id',$pick_city_id->cab_type)->first();
            $pickcity = Pickup::select('pick_city','id')->where('id',$pick_city_id->pcity_id)->where('pickups.status_delete','No')->first();
            $dropcity = Dropcity::select('drop_city','id')->where('id',$pick_city_id->dcity_id)->where('dropcities.status_delete','No')->first();
            $user_id  =user::select('id','user_mobile','email','name')->where('id',$userid)->where('user_mobile',$user_mobile)->where('users.status_delete','No')->first();


            return view('frontend.onewaybookcab.index',compact('pick_city_id','pickcity','dropcity','user_id','userid','request','cab'));
        }

    }
    public function onewaybookcab(Request $request)
    {
        return view('frontend.about.error');
    }
    public function error_oneway(Request $request)
    {
        return view('frontend.about.error');
    }
    public function localbookcab(Request $request)
    {
        return view('frontend.about.error');
    }

    public function multicitybookcab(Request $request)
    {
        return view('frontend.about.error');
    }



       public function localindex(Request $request,$localdetails_id)
    {
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);
         $request= localdetails::select('id as localid')->where('id',$localdetails_id)->where('localdetails.status_delete','No')->first();
         if($request == '')
         {
             return view("frontend.about.error");

         }
         else{
            $user_mobile= session()->get('user_mobile');
            $userid = session()->get('userdetail_id');


            $local_pick_city = Localdetails::select('localdetails.*')->where('id',$localdetails_id)->where('localdetails.status_delete','No')->first();
            $package = Local_package::select('local_packages.*')->where('local_packages.id', $local_pick_city->dropcity)->first();
                 $cab = Cab_master::select('cab_masters.*')->where('cab_masters.id',$local_pick_city->cab_type)->first();
           $local_pickcity =  Pickup::select('pick_city','id')->where('id',$local_pick_city->pcity_id)->where('pickups.status_delete','No')->first();
          $user_id  =user::select('id','user_mobile','email','name')->where('users.id',$userid)->where('users.user_mobile',$user_mobile)->first();

           return view('frontend.onewaybookcab.index',compact('local_pick_city','local_pickcity','user_id','request','userid','package','cab'));

         }
 }
    public function multyindex(Request $request)
    {
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);
        $request;
        $user_mobile= session()->get('user_mobile');
        $userid = session()->get('userdetail_id');
        $pickcity = Pickup::select('pick_city','id','status_delete')->where('id',$request->pcity_id)->where('status_delete','No')->first();
        $user_id  =user::select('id','user_mobile','email','name')->where('id',$userid)->where('user_mobile',$user_mobile)->first();
              $cab = Cab_master::select('cab_masters.*')->where('cab_masters.id',$request->cab_id)->first();

        return view('frontend.onewaybookcab.multicitybookcab',compact('request','user_mobile','userid','pickcity','user_id','cab'));
    }
    public function store(Request $request)
    {

        // return $request;
        $user_mobile= session()->get('user_mobile');
        $userdetail_id = session()->get('userdetail_id');
          $cab_master = Cab_master::select('cab_masters.*')->where('id',$request->cab_type)->first();
        $this->validate($request, [


          ]);


        //   return $request;
          if($request->user_id == 0) {


            $name = $request->input('customer_name');
             $mobile = $request->input('customer_mobile');
              $email = $request -> input('email');
              $data = array("name"=>$name,"user_mobile"=>$mobile,"email"=>$email);
                   $user_id = User::create($data);

                // DB::table('users')->insert($data);

        } else if($request->user_id != 0) {



            $name = $request->input('customer_name');

            $mobile = $request->input('customer_mobile');
               $email = $request -> input('email');
               User::where('id',$request->user_id)->update([
                   "name"     => $name,
                  "email"      => $email,
                  "user_mobile" => $mobile
                  ]);
        }
         $onewaydetail = onewaydetails::select('id','km','cab_type','km','tax','state_tax','driver_allowance')
                                            ->where('pcity_id',$request->pickupcity_id)
                                            ->where('dcity_id',$request->dropcity_id)
                                            ->where('cab_type',$request->cab_type)
                                            ->first();
              $onewaydetail_id = $onewaydetail->id;
            $km_rate = Cab_master::select('cab_masters.*')->where('id',$onewaydetail->cab_type)->first();
             $dropcity = Dropcity::select('dropcities.*')->where('id',$request->dropcity_id)->first();
              $oneway_orderno = $this->getOrderNo();

             $discount=$request->total_input;
             if($discount != '')
             {
                  $total_amount = $discount;
             }else{
                   $total_amount = $request->gross_total;
             }

              $from =  trim(date_format(date_create($request->pickup_date), 'Y-m-d'));


            $data=array('pickupcity_id'=>$request->input('pickupcity_id'),
                                    'drop_city'=>$request->input('dropcity_id'),
                                    'cab_type' => $cab_master->id,
                                    'flight_number' => $request->input('flight_number'),
                                    'onewaydetail_id'=>$onewaydetail_id,
                                    'pickup_date' =>$from,
                                    'pickup_time' => $request->input('pickup_time'),
                                    'discount' => $request->input('discount'),
                                    'extra_charge' => $request->input('extra_charge'),
                                    'alt_mobile' => $request->input('alternet_mobile'),
                                    'pickup_location' => $request->input('pickup_location'),
                                    'drop_location' => $request->input('drop_location'),
                                    'driver_id' => $request->input('driver_id'),
                                    'status' => $request->input('status'),
                                    'user_id'=> $request->input('user_id'),
                                    'gross_total'=>$request->input('gross_total'),
                                    'total_amount'=>$total_amount,
                                    'orderno'=>$oneway_orderno,
                                    'booking_type'=>'Oneway',
                                    'perkm_rate'=>$km_rate->km_rate,
                                    'estimate_kms'=>$onewaydetail->km,
                                    'travel_city'=>$dropcity->drop_city,
                                    'tall_tax'=>$onewaydetail->tax,
                                    'state_tax'=>$onewaydetail->state_tax,
                                    'driver_allowance'=>$onewaydetail->driver_allowance,
                                    'status'=>'1',
                                    );
                         $this->booking_details_sms($data['user_id'],$data['orderno'],$data['booking_type'],$data['pickupcity_id'],$data['drop_city'],$data['pickup_date'],$data['pickup_time']);
                        $this->booking_details_admin_sms($data['user_id'],$data['orderno'],$data['booking_type'],$data['pickupcity_id'],$data['drop_city'],$data['pickup_date'],$data['pickup_time']);
                     $this->booking_confirm_sms($data['user_id'],$data['orderno']);
                     $request->session()->put('onewaydetail_id',$onewaydetail_id );
                    
                     $onewaybookings = Multy_bookings::create($data);
            // $onewaybookings_id= session()->get('onewaybookings_id');
                    //   $request->session()->put('onewaybookings_id',$onewaybookings->id );
                    // $onewaybookings_id= sessio()->get('onewaybookings_id');
       return redirect()->route('onewayconfirm',['oneway_bookings' => $onewaybookings->id ])->with('success','onewaybookings created successfully');
    }
    public function getOrderNo()
	{

         $getOrderId = Multy_bookings::select('id')->count();

		if ($getOrderId > 0 ){
			//found record
			$orderno = $getOrderId;

			$removeText = str_replace("CABOOK", "", $orderno);
			$plusOne = $removeText + 1001;
			$orderno = 'CABOOK' . $plusOne;

			return $orderno;

		} else {
			//no record
			$taxi = 'CABOOK999';
			$orderno = $taxi;
			return $orderno;
		}

	}
    public function localOrderNo()
	{

         $getOrderId = localbookings::select('id')->count();

		if ($getOrderId > 0 ){
			//found record
			$orderno = $getOrderId;

			$removeText = str_replace("VHNSWA", "", $orderno);
			$plusOne = $removeText + 1001;
			$orderno = 'VHNSWA' . $plusOne;

			return $orderno;

		} else {
			//no record
			$taxi = 'VHNSWA999';
			$orderno = $taxi;
			return $orderno;
		}

	}
    public function multyOrderNo()
	{

         $getOrderId = Multicitybookings::select('id')->count();

		if ($getOrderId > 0 ){
			//found record
			$orderno = $getOrderId;

			$removeText = str_replace("VHNSWA", "", $orderno);
			$plusOne = $removeText + 1001;
			$orderno = 'VHNSWA' . $plusOne;

			return $orderno;

		} else {
			//no record
			$taxi = 'VHNSWA999';
			$orderno = $taxi;
			return $orderno;
		}

	}

    public function localstore(Request $request)
    {
        // return $request;
       $cab_master = Cab_master::select('cab_masters.*')->where('id',$request->cab_type)->first();
                                if($request->user_id == 0) {

                                    $name = $request->input('customer_name');

                                    $mobile = $request->input('customer_mobile');
                                    $email = $request -> input('email');
                                    $data = array('name'=>$name,'user_mobile'=>$mobile,'email'=>$email);

                                    $user_id = User::create($data);

                                    // DB::table('users')->insert($data);

                            } else if($request->user_id != 0) {

                                $name = $request->input('customer_name');

                                $mobile = $request->input('customer_mobile');
                                $email = $request -> input('email');
                                User::where('id',$request->user_id)->update([
                                    "name"     => $name,
                                    "email"      => $email,
                                    "user_mobile" => $mobile
                                    ]);
                            }
                             $local_package = Local_package::select('local_packages.local_package','local_packages.id')->where('local_packages.local_package',$request->dropcity)->first();
           
                            // return $request;
                            $localdetail = localdetails::select('id','kms','ehr','ekr','cab_type')
                                                                ->where('pcity_id',$request->pickupcity_id)
                                                                ->where('dropcity',$local_package->id)
                                                                  ->where('cab_type',$cab_master->id)
                                                                ->first();
                                                                
                                $localdetail_id = $localdetail->id;
                                $km_rate = Cab_master::select('cab_masters.*')->where('id',$localdetail->cab_type)->first();
                                $local_orderno = $this->getOrderNo();
                            // return $request;
                              $discount=$request->total_input;
                                    if($discount != '')
                                    {
                                         $total_amount = $discount;
                                    }else{
                                         $total_amount = $request->gross_total;
                                    }

            // return $request;
                            $from =  trim(date_format(date_create($request->pickup_date), 'Y-m-d'));
                               $local_data=array('pickupcity_id'=>$request->input('pickupcity_id'),
                                        'drop_city'=>$local_package->id,
                                        'cab_type' => $cab_master->id,
                                        'flight_number' => $request->input('flight_number'),
                                        'localdetail_id'=>$localdetail_id,
                                        'pickup_date' =>$from,
                                        'pickup_time' => $request->input('pickup_time'),
                                        'discount' => $request->local_discount,
                                        'extra_charge' => $request->local_extra_charge,
                                        'alt_mobile' => $request->input('alternet_mobile'),
                                        'pickup_location' => $request->input('pickup_location'),
                                        'drop_location' => $request->input('drop_location'),
                                        'driver_id' => $request->input('driver_id'),
                                        'status' => $request->input('status'),
                                        'user_id'=> $request->input('user_id'),
                                        'gross_total'=>$request->gross_total,
                                        'total_amount'=>$total_amount,
                                        'orderno'=>$local_orderno,
                                        'booking_type'=>'Localpackage',
                                        'perkm_rate'=>$km_rate->km_rate,
                                         'estimate_kms'=>$localdetail->kms,
                                         'travel_city'=>$local_package->local_package,
                                        'status'=>'1',


                                        );
                                        if($request->user_id == 0){

                                            $local_data['user_id']= $user_id->id;

                                        }  else if($request->user_id != 0) {
                                            $local_data['user_id']= $request->user_id;
                                        }

                                        // $this->booking_localdetails_sms($data['user_id'],$data['orderno'],$data['pickupcity_id'],$data['dropcity_id'],$data['pickup_date'],$data['pickup_time']);
                                        // $this->booking_localdetails_admin_sms($data['user_id'],$data['orderno'],$data['pickupcity_id'],$data['dropcity_id'],$data['pickup_date'],$data['pickup_time']);
                                        // $this->booking_confirm_sms($data['user_id'],$data['orderno']);
                                    $localbookings = Multy_bookings::create($local_data);

                      $this->booking_details_sms($local_data['user_id'],$local_data['orderno'],$local_data['booking_type'],$local_data['pickupcity_id'],$local_data['drop_city'],$local_data['pickup_date'],$local_data['pickup_time']);
                        $this->booking_details_admin_sms($local_data['user_id'],$local_data['orderno'],$local_data['booking_type'],$local_data['pickupcity_id'],$local_data['drop_city'],$local_data['pickup_date'],$local_data['pickup_time']);
                     $this->booking_confirm_sms($local_data['user_id'],$local_data['orderno']);
                    $request->session()->put('localdetail_id',$localdetail_id );
              
return redirect()->route('localconfirm',['local_bookings' => $localbookings->id ])->with('success','localbookings created successfully');
       
    }
    public function multystore(Request $request)
    { 
         $request;
         $minimum_km = Multicitycabs::select('multicitycabs.*')->where('cab_id',$request->cab_type)->first();
                      $cab = Cab_master::select('cab_masters.*')->where('cab_masters.id',$request->cab_type)->first();
                      if($request->user_id == 0) {


                        $name = $request->input('customer_name');
                         $mobile = $request->input('customer_mobile');
                          $email = $request -> input('email');
                          $data = array("name"=>$name,"user_mobile"=>$mobile,"email"=>$email);
                               $user_id = User::create($data);

                            // DB::table('users')->insert($data);

                    } else if($request->user_id != 0) {



                        $name = $request->input('customer_name');

                        $mobile = $request->input('customer_mobile');
                           $email = $request -> input('email');
                           User::where('id',$request->user_id)->update([
                               "name"     => $name,
                              "email"      => $email,
                              "user_mobile" => $mobile
                              ]);
                    }

                         $multy_orderno = $this->getOrderNo();
                     
                        $data['orderno']  =   $multy_orderno;
                        //   $request;
                        $discount=$request->discount;
                         if($discount != '')
                         {
                              $total_amount = $request->total_amount-$request->discount;
                         }else{
                              $total_amount = $request->total_amount;
                         }

                         $price = $request->cab_type;
                         $price_details = $cab->mkm_rate;

                            // return $request;
                             $h1 = $request->travel_city;

                            $from =  trim(date_format(date_create($request->pickup_date), 'd-m-Y'));
                            // $from =  trim(date_format(date_create($request->pickup_date), 'Y-m-d'));
                             $request;

                              $return_by_date = date('d-m-Y', strtotime($from . ' + ' .($request->journey- 1).' days'));
                              $dropcity =$request->drop_City;
                            //  return $request;
                             $driver_allowance = $request->journey *  $minimum_km->driver_allowance;
                             $min_km =  $minimum_km->minkm;
                            // return $request;
                            $discount=$request->total_input;
                                    if($discount != '')
                                    {
                                          $total_amount = $discount;
                                    }else{
                                          $total_amount = $request->gross_total;
                                    }
                               $data=array('pickupcity_id'=>$request->input('pickupcity_id'),
                             'drop_city'=>$dropcity,
                             'cab_type' =>  $cab->id,
                             'flight_number' => $request->input('flight_number'),
                             'pickup_date' => $from,
                             'return_date'=>$return_by_date,
                             'travel_city'=>$request->travel_city,
                             'pickup_time' => $request->pickup_time,
                             'discount' => $request->discount,
                             'extra_charge' => $request->input('round_extra_charge'),
                              'alt_mobile' => $request->input('alternet_mobile'),
                              'pickup_location' => $request->input('pickup_location'),
                              'drop_location' => $request->input('drop_location'),
                              'driver_id' => $request->input('driver_id'),
                              'status' => '1',
                              'gross_total'=>$request->input('gross_total'),
                              'total_amount'=>$total_amount,
                              's_request'=>$request->input('s_request'),
                              'user_id' => $request->input('user_id'),
                              'minkm'=>$min_km,
                              'seat'=>$minimum_km->seat,
                              'bag'=>$minimum_km->bag,
                              'travelkms'=>$minimum_km->minkm,
                              'estimate_kms'=>$request->estimate_kms,
                             'perkm_rate'=>$price_details,
                              'orderno'=>$multy_orderno,
                              'cupon_id'=>$request->promo_code,
                              'journey'=> $request->journey,
                              'driver_allowance'=> $driver_allowance,
                              'booking_type' =>'Round-Trip',
                              'status'=>1,


                              );
                              if($request->user_id == 0){

                                 $data['user_id']= $user_id->id;

                             }  else if($request->user_id != 0) {
                                 $data['user_id']= $request->user_id;
                             }

                            
                           

                       $this->booking_details_sms($data['user_id'],$data['orderno'],$data['booking_type'],$data['pickupcity_id'],$data['drop_city'],$data['pickup_date'],$data['pickup_time']);
                        $this->booking_details_admin_sms($data['user_id'],$data['orderno'],$data['booking_type'],$data['pickupcity_id'],$data['drop_city'],$data['pickup_date'],$data['pickup_time']);
                     $this->booking_confirm_sms($data['user_id'],$data['orderno']);
                     
                      $multybookings = Multy_bookings::create($data);
               
return redirect()->route('multyconfirm',['multy_bookings' => $multybookings->id ])->with('success','booking created successfully');
       
    }
    public function onewayconfirm(Request $request)
	{
        $url = $_SERVER['REQUEST_URI']; 
        Helpers::visitorUpdate($url);
          $user_mobile= session()->get('user_mobile');
        //   return $request;
          $onewaybookings_id= $request->oneway_bookings;
                 $data = Multy_bookings::select('users.name','users.email','users.user_mobile','cab_masters.cab','cab_masters.image','multy_bookings.*','pickups.pick_city','dropcities.drop_city')
                                        ->join('users','users.id','multy_bookings.user_id')
                                        ->join('cab_masters','multy_bookings.cab_type','cab_masters.id')
                                        ->join('pickups','pickups.id','multy_bookings.pickupcity_id')
                                        ->join('dropcities','dropcities.id','multy_bookings.drop_city')
                                        ->where('multy_bookings.id',$onewaybookings_id)
                                        ->where('multy_bookings.status',1)
                                        ->where('multy_bookings.booking_type','Oneway')
                                        ->where('multy_bookings.status_delete','No')
                                        ->first();
                  $user = User::select('users.*')->where('users.user_mobile',$user_mobile)->first();

        return view('frontend.onewaybookcab.onewayconfirm',compact('data','user'));

	}
    public function localconfirm(Request $request)
	{
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);
        $user_mobile= session()->get('user_mobile');
         $localbookings_id= $request->local_bookings; 
                 $data = Multy_bookings::select('users.name','users.email','users.user_mobile','cab_masters.cab','cab_masters.image','multy_bookings.*','pickups.pick_city','local_packages.local_package')
                                        ->join('users','users.id','multy_bookings.user_id')
                                        ->join('cab_masters','multy_bookings.cab_type','cab_masters.id')
                                        ->join('pickups','pickups.id','multy_bookings.pickupcity_id')
                                        ->join('local_packages','local_packages.id','multy_bookings.drop_city')
                                        ->where('multy_bookings.id',$localbookings_id)
                                        ->where('multy_bookings.status',1)
                                        ->where('multy_bookings.booking_type','Localpackage')
                                        ->where('multy_bookings.status_delete','No')
                                        ->first();
                  $user = User::select('users.*')->where('users.user_mobile',$user_mobile)->first();
         


        return view('frontend.onewaybookcab.localconfirm',compact('data','user'));

	}
    public function multyconfirm(Request $request){
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);
        $user_mobile= session()->get('user_mobile');
        $user = User::select('users.*')->where('users.user_mobile',$user_mobile)->first();
        $multy_bookings_id= $request->multy_bookings; 
                 $data = Multy_bookings::select('users.name','users.email','users.user_mobile','cab_masters.cab','cab_masters.image','multy_bookings.*','pickups.pick_city')
                                        ->join('users','users.id','multy_bookings.user_id')
                                        ->join('cab_masters','multy_bookings.cab_type','cab_masters.id')
                                        ->join('pickups','pickups.id','multy_bookings.pickupcity_id')
                                        ->where('multy_bookings.id',$multy_bookings_id)
                                        ->where('multy_bookings.status',1)
                                        ->where('multy_bookings.booking_type','Round-Trip')
                                        ->where('multy_bookings.status_delete','No')
                                        ->first();
        return view('frontend.onewaybookcab.multyconfirm',compact('user','data'));
    }

    public function booking_details_sms($user_id, $orderno,$booking_type,$pickupcity_id, $dropcity_id, $pickup_date, $pickup_time)
	{
         $booking_type;
		  $user_details = User::select('users.*')->where('id',$user_id)->where('users.status_delete','No')->get();
         $pickupdate= date_format(date_create($pickup_date),'d-M-y');
		$user_name = $user_details[0]['name'];
		$number    = $user_details[0]['user_mobile'];
        if($booking_type=="Oneway"){
             $pickcity = Pickup::select('pickups.*')->where('id',$pickupcity_id)->get();
            $dropcity = Dropcity::select('dropcities.*')->where('id',$dropcity_id)->get();
             $message=urlencode('Dear '.$user_name.', Booking ID '.$orderno.' From '.$pickcity[0]['pick_city'].' To '.$dropcity[0]['drop_city'].' On '.$pickupdate.' At '.$pickup_time.' Has Been confirmed. For any update regarding booking call us on our helpline number +919909151547 or Login @ www.cabbookkaro.com  Team MRSTXI');
        }
        elseif($booking_type=="Localpackage"){
            $pickcity = Pickup::select('pickups.*')->where('id',$pickupcity_id)->get();
            $dropcity = Local_package::select('local_packages.*')->where('id',$dropcity_id)->get();
            $message=urlencode('Dear '.$user_name.', Booking ID '.$orderno.' From '.$pickcity[0]['pick_city'].' To '.$dropcity[0]['local_package'].' On '.$pickupdate.' At '.$pickup_time.' Has Been confirmed. For any update regarding booking call us on our helpline number +919909151547 or Login @ www.cabbookkaro.com  Team MRSTXI');
        }
        else{
             $pickcity = Pickup::select('pickups.*')->where('id',$pickupcity_id)->get();
            $dropcity = $dropcity_id;
               $message=urlencode('Dear '.$user_name.', Booking ID '.$orderno.' From '.$pickcity[0]['pick_city'].' To '.$dropcity.' On '.$pickupdate.' At '.$pickup_time.' Has Been confirmed. For any update regarding booking call us on our helpline number +919909151547 or Login @ www.cabbookkaro.com Team MRSTXI');
                              
        }
       
		
 
        $DLT_TE_ID = '1207166081654342428';

		  $url_a= helpers::get_sms_url();
        $a= $url_a->url;
		$url_b = str_replace('{number}',$number,$a);
		$url_c = str_replace('{message}',$message,$url_b);
		 $url = str_replace('{DLT_TE_ID}',$DLT_TE_ID,$url_c);
		$msg_status=$this->run_urlOnwaycab($url);
		return true;
	}


    public function booking_details_admin_sms($user_id, $orderno,$booking_type, $pickupcity_id, $dropcity_id, $pickup_date, $pickup_time)
	{

		 $user_details = User::select('users.*')->where('id',$user_id)->where('users.status_delete','No')->get();
         $pickupdate= date_format(date_create($pickup_date),'d-M-y');
		 $user_name = $user_details[0]['name'];
		 $m_number  = $user_details[0]['user_mobile'];

         if($booking_type=="Oneway"){
             $pickcity = Pickup::select('pickups.*')->where('id',$pickupcity_id)->get();
            $dropcity = Dropcity::select('dropcities.*')->where('id',$dropcity_id)->get();
             $message = urlencode($user_name.', Booking ID '.$orderno.' From '.$pickcity[0]['pick_city'].' To '.$dropcity[0]['drop_city'].' On ' .$pickupdate.' At '.$pickup_time. ' has been confirmed. www.cabbookkaro.com  Team MRSTXI');
                }
                elseif($booking_type=="Localpackage"){
                      $pickcity = Pickup::select('pickups.*')->where('id',$pickupcity_id)->get();
            $dropcity = Local_package::select('local_packages.*')->where('id',$dropcity_id)->get();
             $message = urlencode($user_name.', Booking ID '.$orderno.' From '.$pickcity[0]['pick_city'].' To '.$dropcity[0]['local_package'].' On ' .$pickupdate.' At '.$pickup_time. ' has been confirmed. www.cabbookkaro.com  Team MRSTXI');
                }
                else{
                      $pickcity = Pickup::select('pickups.*')->where('id',$pickupcity_id)->get();
                     $dropcity = $dropcity_id;
                      $message = urlencode($user_name.', Booking ID '.$orderno.' From '.$pickcity[0]['pick_city'].' To '.$dropcity.' On ' .$pickupdate.' At '.$pickup_time. ' has been confirmed. www.cabbookkaro.com  Team MRSTXI');
                }

           

            $DLT_TE_ID = '1207166081661377959';

		$url_a= helpers::get_sms_url();
        $a= $url_a->url;
		$number=$url_a->mobile;
		 $url_b = str_replace('{number}',$number,$a);
		$url_c = str_replace('{message}', $message, $url_b);
		 $url = str_replace('{DLT_TE_ID}', $DLT_TE_ID, $url_c);

		$msg_status = $this->run_urlOnwaycab($url);
		return true;
	}

    public function booking_confirm_sms($user_id,$orderno)
	{
        $user_details = User::select('users.*')->where('id',$user_id)->get();
        $user_name = $user_details[0]['name'];
        $number  = $user_details[0]['user_mobile'];
		$message=urlencode('Hello '.$user_name.', you will receive your cab/driver details before 2 hours prior for booking ID '.$orderno.'. For any help call us on 24*7 help line number +919909151547. Regards www.cabbookkaro.com  Team MRSTXI');

		$DLT_TE_ID = '1207166081657974268';

        $url_a= helpers::get_sms_url();
        $a= $url_a->url;
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

}
