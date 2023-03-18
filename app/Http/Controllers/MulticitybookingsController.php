<?php

namespace App\Http\Controllers;
use App\Pickup;
use App\Dropcity;
use App\Onewaybookings;
use App\Multicitybookings;
use App\Onewaydetails;
use App\Cab_master;
use App\Driver;
use App\Cupon;
use App\Multicitycabs;
use App\Multicityprices;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use Helpers;
use PDF;
use DB;


class MulticitybookingsController extends Controller
{

      public function index(Request $request )
    {

                if ($request->ajax()) {
                    $data = Multicitybookings::select('multicitybookings.*','pickups.pick_city','users.name','users.email','users.user_mobile')
                    ->join( 'pickups','pickups.id','multicitybookings.pickupcity_id')
                    ->join('users','users.id','multicitybookings.user_id')
                    ->orderby('multicitybookings.id','desc')
                    ->get();

                    return Datatables::of($data)
                        ->addIndexColumn()

                        ->addColumn('checkbox', function($row){
                            return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                         })
                         ->addColumn('pdf', function($row){
                            $status = $row->status;
                            if($status == 1)
                            {
                                $html =  '<a class="btn btn-icon btn-outline-primary" href="'.url('admin/multicitybookings/invoice',$row->id).'"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg></a>';

                            }
                            else{
                                $html =  '<a class="btn btn-icon btn-outline-primary" href="'.url('public/multyclose_duty',$row->order_no.'.pdf').'" download ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg></a>';
                            }
                            return $html;
                         })
                         ->addColumn('action', function($row){
                            $status = $row->status;
                            if($status == 1)
                            {
                                $html =  '<a class="btn btn-icon btn-outline-primary" href="'.url('admin/multicitybookings/edit',$row->id).'" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 font-medium-3 text-info me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" style="color:#7367F0;"></path></svg></a>
                                    ';
                            }else{
                                 $html =  '<a class="btn btn-icon btn-outline-primary" disabled ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 font-medium-3 text-info me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" style="color:#7367F0;"></path></svg></a>
                                ';
                            }


                            return $html;
                        })

                         ->setRowAttr([
                            'style' => function($row){
                                return $row->status==0 ? 'background-color: #fbdddd;border-bottom:1px solid #c1c1c1' : 'background-color: #d4f4e2;border-bottom:1px solid #c1c1c1';
                            }
                        ])
                        ->addColumn('orderno',function($row){
                            $orderno= $row->order_no;
                            $html =  '<a class="btn btn-icon bg-primary" href="'.url('admin/multicitybookings/multywayorder',$row->order_no).'" style="padding:5px;color:white">'.$row->order_no.'</a>
                            ';

                    return $html;
                            // '<a onclick=view_more('.$row->orderno.') style="color:#d24076"  data-toggle="modal" href="#order_popup">'.$row->orderno.'</a>';
                            // return '<label id="orderno"><a href="#order_popup" onclick=view_more('.$row->orderno.') data-toggle="modal"class="text-danger">'.$orderno.'</a></label';
                        })

                        ->addColumn('contact_info',function($row){
                            $name = $row->name;
                            $email = $row->email;
                            $mobile = $row->user_mobile;
                            $altmobile = $row->alternet_mobile;
                            return '<label style="font-size:12px;"><a class="font fsize"></a>'. ucwords($name).'</label>
                            <label style="font-size:12px;"><a class="font fsize"></a>'.$email.'</label>
                            <label style="font-size:12px;"><a class="font fsize"></a>'.$mobile.'</label>';


                        })
                        ->addColumn('asign',function($row){
                            if($row->status == 1){
                            return'<div class="btn-group">
                                        <button type="button" class="btn btn-dark me-1 waves-effect  dropdown-toggle budget-dropdown waves-effect " data-bs-toggle="dropdown">Assign</button>
                                        <div class="dropdown-menu " data-popper-placement="top-start" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(0px, -60px);">
                                        <a class="dropdown-item" href="'.route('driver_multy_assign', ['id' => $row->id]).'">Add Driver</a>
                                        <a class="dropdown-item" href="'.url('admin/driver/multyselect/'.$row->id).'">Exits Driver</a>
                                        </div>
                                    </div>';
                                 }else{
                                        return'<div class="btn-group">
                                        <button type="button" class="btn btn-dark me-1 waves-effect  dropdown-toggle budget-dropdown waves-effect " disabled data-bs-toggle="dropdown">Assign</button>

                                    </div>';
                                    }
                                    })

                        ->addColumn('pickDrop',function($row){
                            $from = $row->pick_city;
                            $to = $row->travel_city;
                            return '<label style="font-size:12px;">'.$from.'</label><br><a class="font fsize">To</a><br><label style="font-size:12px;">'.$to.'</label>';

                        })
                        ->addColumn('driver_id',function($row){

                            return '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg><label style="font-size:12px;margin-left:2px"><a class="font fsize"></a>'.$row->driver_name.'</label>';


                        })
                        ->addColumn('dateTime',function($row){
                            $date =  $row['created_at'] = trim(date_format(date_create($row['created_at']),'d-m-Y'));
                            $time = $row->pickup_time;
                            return '<label style="font-size:12px;"><a class="font fsize"></a>'.  $date.'</label><label style="font-size:12px;"><br><a class="font fsize"></a>'.$time.'</label>';
                        })

                        ->addColumn('status',function($row){

                            if($row->status==1){
                                $currentst='OnDuty';
                                $nm='CloseDuty';
                                $btn="btn-success";
                                $click = " ";

                            }else{
                                $currentst='CloseDuty';
                                $nm='OnDuty';
                                $btn="btn-danger";
                                $click = "disabled";

                            }
                            return '<a href="'.url('admin/multicitybookings/changestatus/'.$nm.'/'.$row->id).'" class="statuschange"><button  class="btn '.$btn.' me-1 waves-effect waves-float waves-light" '.$click.'>'.$currentst.'</button></a>';
                        })
                        ->addColumn('created_at',function($row){

                            return $row->created_at->format('d-m-Y');
                        })

                    ->addColumn('cab_type',function($row){

                        $type =$row->cab_type;
                        if($type == 'primesuv')
                        {
                            return '<label><a class="font fsize"></a > Primium Suv</i></label>';
                        }  elseif($type == 'primesedan')
                        {
                            return '<label><a class="font fsize"></a > Primium Sedan</i></label>';
                        }
                        else{
                            return '<label><a class="font fsize"></a > '.$row->cab_type.'</i></label>';
                        }

                        })
                        ->rawColumns(['contact_info','dateTime','cab_type','status','checkbox','pdf','pickDrop','driver_id','asign','orderno','created_at','action'])
                        ->make(true);
                }
                return view('multicitybookings.index');
            }
            public function changestatus($nm,$id)
            {


                if($nm = "CloseDuty")
                {
                    $nm1= 0;
                    $this->trip_completed_sms($id);
                    $this->generate_pdf_invoice_mail($id);
                }
                else{
                    $nm1 = 1;
                }
                 $nowdate = date('Y-m-d H:i:s');

                 $data = Multicitybookings::where('id',$id)->update([
                    "status"     =>$nm1 ,
                    "updated_at" =>$nowdate
                   ]);

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
            public function create()
            {
                $pickupcity_id_data  = Pickup::select('pick_city','id','status_delete')->where('status_delete','No')->get();
                $pickupcity_id = $pickupcity_id_data->pluck('pick_city','id')->all();
                $user_id_data  =user::select('id as u_id','status_delete')->where('status_delete','No')->get();
                $user_id = $user_id_data->pluck('id as u_id')->all();
                $cab = Cab_master::select('cab_masters.*')->where('cab_status',1)->get();
                return view('multicitybookings.create',compact('pickupcity_id','user_id','cab'));
            }
            public function edit($id)
            {
                  $data = Multicitybookings::find($id);
                  $data->travel_city;
                  $cab_type= $data->cab_type;
                  $cab_travel =$data->travel_city;
                // $pickupcity_id_data  = Pickup::select('pick_city','id','status_delete')->where('status_delete','No')->get();
                 $pickupcity_id = Pickup::select('id as p_id','pick_city')->where('pickups.status_delete','No')->get();
                 $user_data = User::select('id','name','email','user_mobile')->where('id',$data->user_id)->where('users.status_delete','No')->first();
                 $cab = Cab_master::select('cab_masters.*')->where('cab_status',1)->get();
                return view('multicitybookings.edit',compact('pickupcity_id','user_data','data','cab','cab_type'));
            }


            public function get_estimate(Request $request)
            {
                 $pcity_id= $request->post('pcity_id');
                $pickup_date   	  = $request->post('pickup_date');
                $pickup_time   	  = $request->post('pickup_time');
                 $jdays   	  	  = $request->post('jdays');
                $cab_type         	= $request->post('cab_type');
                $travel_city_json 	= $request->post('travel_cities');
                   $travel_city_arr 	= explode('|',$travel_city_json);
                 $sql =  Pickup::select('pick_city','id','status_delete')->where('id',$pcity_id)->where('status_delete','No')->get();
                 $full_pick_up_city  = $sql[0]['pick_city'];
                $texifrom 		   	= $sql[0]['pick_city'];
                $tot_dis 	= 0;
                $scity_arr = array();
                $ncity_arr = array();
                for ($i=0;$i<count($travel_city_arr);$i++)
                {
                    $p = $i+1;
                    $scity_arr[0] 	=  $full_pick_up_city;
                    $scity_arr[$p]	= $travel_city_arr[$i];
                    $ncity_arr[]	= $travel_city_arr[$i];
                }
                array_push($ncity_arr,$full_pick_up_city);
                 $mul_start_city_arr = $scity_arr;
                 $mul_next_city_arr  = $ncity_arr;
                 $count_arr 			= count($mul_start_city_arr);
                for ($i=0;$i<$count_arr;$i++) {
                    $start_city = $mul_start_city_arr[$i];
                    $next_city  = $mul_next_city_arr[$i];
                      $coordinates1 = $this->get_coordinates($start_city);
                    $coordinates2 = $this->get_coordinates($next_city);
                    if ( !$coordinates1 || !$coordinates2 ) {
                        echo 'Bad address.';
                    } else {
                         $dist = $this->GetDrivingDistance($coordinates1['lat'], $coordinates2['lat'], $coordinates1['long'], $coordinates2['long']);

                    }
                    $data =  str_replace(",",'',$dist['distance']);

                     $tot_dis = $tot_dis+str_replace(" km",'',$data);
                }
                 $esti_kms = $tot_dis;

                //  return $request;
                 return $this->get_gross_total($esti_kms,$cab_type,$jdays,$pcity_id,$travel_city_arr);
            }

            function get_coordinates($city) { 

                $address = urlencode($city.', India');
                $url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyDSK543R3NXT7utCZbk_Ti3siOSaAtj9bA&libraries&address=$address&sensor=false"; //&language=en&region=India

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                $response = curl_exec($ch);


                $response_a = json_decode($response);

                $status = $response_a->status;


                if ($status == 'ZERO_RESULTS') {
                    return FALSE;
                } else {
                    $return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
                    return $return;
                }
            }

            function GetDrivingDistance($lat1, $lat2, $long1, $long2) {



                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?key=AIzaSyDSK543R3NXT7utCZbk_Ti3siOSaAtj9bA&libraries&origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $response = curl_exec($ch);
                curl_close($ch);
                $response_a = json_decode($response, true);
                $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
                $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

                // echo $dist;
                // echo $time;
                // echo '</br>';
                return array('distance' =>$dist,'time' => $time);
            }



            public function get_gross_total($esti_kms,$cab_type,$jdays,$pcity_id,$travel_city_arr)
            {
                //  $cab_price_list = Multicityprices::select('multicityprices.*')->where('multicityprices.pcity_id',$pcity_id)->get();
                // return $cab_type;
                // return $esti_kms;
                   $cab_price = Multicitycabs::select('multicitycabs.*','cab_masters.cab','cab_masters.mkm_rate','cab_masters.cab_status')
                                            ->join('cab_masters','cab_masters.id','multicitycabs.cab_id')
                                            ->where('multicitycabs.cab_id',$cab_type)
                                            ->get();
                if ($cab_price[0]['cab_id'] != $cab_type) {
                    $arr = array('value_null' => '0');
                    echo json_encode($arr);
                }
                else
                {
                    if($cab_type != '')
                    {
                         $drop_city = end($travel_city_arr);
                        $cab_tax 		    	=  0;
                           $jdayMinkm   			=  $cab_price[0]['minkm'] * $jdays;
                        if ($jdayMinkm > $esti_kms) {
                            $minkm   			=  $cab_price[0]['minkm'] * $jdays;
                            $minkm_jday   	  	    =  $minkm;
                            $cabprice_jday 		    =  $minkm_jday * $cab_price[0]['mkm_rate'];
                            $driver_allowance       =  $cab_price[0]['driver_allowance'] * $jdays;
                            $tax_add                =  $cab_tax;
                            $cab                    =  $cabprice_jday + $tax_add;
                            $cab_total  		    =  $cab;
                            $total 		       	    =  round($cab_total);
                           //include taxi cst
                             $gross_total            =  $total + $driver_allowance;
                        } else if ($jdayMinkm < $esti_kms) {
                            $minkm   				=  $esti_kms;
                            $minkm_jday   	  	    =  $minkm;
                            $cabprice_jday 		    =  $minkm_jday * $cab_price[0]['mkm_rate'];
                            $driver_allowance       =  $cab_price[0]['driver_allowance'] * $jdays;
                            $tax_add                =  $cab_tax;
                            $cab                    =  $cabprice_jday + $tax_add;
                            $cab_total  		    =  $cab;
                            $total 		       	    =  round($cab_total);
                           //include taxi cst
                            $gross_total            =  $total + $driver_allowance;
                        }
                                $arr = array('gross_total' => round($gross_total),'esti_kms' => $esti_kms,'km_rate' => $cab_price[0]['mkm_rate'],'travel' => $travel_city_arr,'dropcity' => $drop_city,'driver'=>$driver_allowance);
                                echo json_encode($arr);
                    }

                }



            }

            public function user_check(Request $request) {
                $customer_mobile= $request->customer_mobile;
                $user_exist= User::select('user_mobile')->where('user_mobile',$customer_mobile)->where('users.status_delete','No')->get();
                $html = '';
                if(count($user_exist) >= 1) {
                     $user_id= User::select('users.*')->where('user_mobile',$customer_mobile)->where('users.status_delete','No')->get();

                      $arr = array('0'=>$user_id[0]['id'],'1'=>$user_id[0]['name'],'2'=>$user_id[0]['email']);
                      return $arr;
                } else {
                    echo 0;
                }
            }

            public function store(Request $request)
            {

                // $user_mobile= session()->get('user_mobile');
                // $userdetail_id = session()->get('userdetail_id');
                 $request;
                $minimum_km = Multicitycabs::select('multicitycabs.*')->where('cab_id',$request->cab_type)->first();
                $cab = Cab_master::select('cab_masters.*')->where('cab_masters.id',$request->cab_type)->first();
                $this->validate($request, [
                    // 'pickcity_id' =>'required',
                    // 'pickup_date'=>'required',
                    // 'pickup_time'=>'required',
                    // 'customer_mobile' => 'required|numeric|digits:10|unique:localbookings,customer_mobile|',
                    // 'customer_email'=> 'required|email|unique:localbookings,customer_email',
                    // 'pickup_location'=>'required',
                    // 'drop_location'=>'required',
                  ]);


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

                     $orderno = $this->multyOrderNo();

                    $data['orderno']  =   $orderno;
                     $discount=$request->total_input;
                     if($discount != '')
                     {
                          $total_amount = $discount;
                     }else{
                          $total_amount = $request->gross_total;
                     }

                     $price = $request->cab_type;
                     $price_details = $cab->mkm_rate;

                      $h1 = $request->travel_cities;

                        $from =  trim(date_format(date_create($request->pickup_date), 'd-m-Y'));
                         $return_by_date = date('d-m-Y', strtotime($from . ' + ' .($request->journy_days- 1).' days'));
                         $dropcity = end($h1);
                         $driver_allowance = $request->journy_days *  $minimum_km->driver_allowance;
                         $min_km =  $minimum_km->minkm;
                        //   return $request;
                        //  $travel_city = implode('||', $travel_city_arr);
                        // return $request->travel;

                 return  $data=array('pickupcity_id'=>$request->input('pickcity_id'),
                            'drop_city'=>$dropcity,
                            'cab_type' => $cab->cab,
                            'flight_number' => $request->input('flight_number'),
                            'pickup_date' => $from,
                            'return_date'=>$return_by_date,
                            'travel_city'=>$request->travel,
                            'pickup_time' => $request->pickup_time,
                            'discount' => $request->input('discount'),
                            'extra_charge' => $request->input('extra_charge'),
                             'alternet_mobile' => $request->input('alternet_mobile'),
                             'pickup_location' => $request->input('pickup_location'),
                             'drop_location' => $request->input('drop_location'),
                             'driver_id' => $request->input('driver_id'),
                             'status' => $request->input('status'),
                             'gross_total'=>$request->input('gross_total'),
                             'total_amount'=>$total_amount,
                             's_request'=>$request->input('s_request'),
                             'user_id' => $request->input('user_id'),
                             'minkm'=>$min_km,
                             'seat'=>$minimum_km->seat,
                             'bag'=>$minimum_km->bag,
                             'travelkms'=>$minimum_km->minkm,
                             'estimate_kms'=>$request->esti_kms,
                            'perkm_rate'=>$price_details,
                             'order_no'=>$orderno,
                             'cupon_id'=>$request->cupon_id,
                             'journey'=> $request->journy_days,
                             'driver_allowance'=> $driver_allowance,
                             'status'=>1


                             );
                             if($request->user_id == 0){

                                $data['user_id']= $user_id->id;

                            }  else if($request->user_id != 0) {
                                $data['user_id']= $request->user_id;
                            }
                                $this->booking_multydetails_sms($data['user_id'],$data['order_no'],$data['pickupcity_id'],$data['drop_city'],$data['pickup_date'],$data['pickup_time']);
                             $this->booking_multydetails_admin_sms($data['user_id'],$data['order_no'],$data['pickupcity_id'],$data['drop_city'],$data['pickup_date'],$data['pickup_time']);
                             $this->booking_confirm_sms($data['user_id'],$data['order_no']);
                            $request->session()->put('multyid');
                         $multybookings = Multicitybookings::create($data);

               return redirect()->route('multicitybookings.index')->with('success','Booking created successfully');
            }


            public function update(Request $request, $id)
            {
                $minimum_km = Multicitycabs::select('multicitycabs.*')->where('cab_id',$request->cab_type)->first();
                $cab = Cab_master::select('cab_masters.*')->where('cab_masters.id',$request->cab_type)->first();
                 $input = $request->all();
                  $multy_id =$id;
                  $multybookings = Multicitybookings::find($id);
                // return $request;
                    $arraydata = User::where('id',$multybookings->user_id)->update([
                        "name"     => $request->customer_name,
                        'email' => $request->email,
                        'user_mobile'=>$request->customer_mobile
                    ]);
                    $discount=$request->total_input;
                    if($discount != '')
                    {
                         $total_amount = $discount;
                    }else{
                         $total_amount = $request->gross_total;
                    }

                    $price = $request->cab_type;
                    $price_details = $cab->mkm_rate;

                     $h1 = $request->travel_cities;
                            //   return $request;
                             $travel_city = implode('||', $h1);

                       $from =  trim(date_format(date_create($request->pickup_date), 'd-m-Y'));
                        $return_by_date = date('d-m-Y', strtotime($from . ' + ' .($request->journy_days- 1).' days'));
                        $dropcity = end($h1);
                        $driver_allowance = $request->journy_days *  $minimum_km->driver_allowance;
                        $min_km =  $minimum_km->minkm;
                        // return $request;

                 $data = Multicitybookings::where('id',$multy_id)->update([
                    'pickupcity_id'=>$request->input('pickcity_id_roundtrip'),
                    'drop_city'=>$dropcity,
                    'cab_type' => $cab->cab,
                    'flight_number' => $request->input('flight_number'),
                    'pickup_date' => $from,
                    'return_date'=>$return_by_date,
                    'travel_city'=>$travel_city,
                    'pickup_time' => $request->pickup_time,
                    'discount' => $request->input('discount'),
                    'extra_charge' => $request->input('extra_charge'),
                     'alt_mobile' => $request->input('alternet_mobile'),
                     'pickup_location' => $request->input('pickup_location'),
                     'drop_location' => $request->input('drop_location'),
                     'driver_id' => $request->input('driver_id'),
                     'status' => $request->input('status'),
                     'gross_total'=>$request->input('gross_total'),
                     'total_amount'=>$total_amount,
                     's_request'=>$request->input('s_request'),
                     'user_id' => $multybookings->user_id,
                     'minkm'=>$min_km,
                     'seat'=>$minimum_km->seat,
                     'bag'=>$minimum_km->bag,
                     'travelkms'=>$minimum_km->minkm,
                     'estimate_kms'=>$request->esti_kms,
                    'perkm_rate'=>$price_details,
                     'order_no'=>$multybookings->order_no,
                     'cupon_id'=>$request->cupon_id,
                     'journey'=> $request->journy_days,
                     'driver_allowance'=> $driver_allowance,
                     'status'=>1

                ]);
                return redirect()->route('multicitybookings.index')->with('success','Booking Updated Successfully');
            }
             public function deleteAll(Request $request)
            {

                $checkedcity_ids = $request->checkedcity_ids;

                Multicitybookings::WhereIn('id',$checkedcity_ids)->delete();
                return response()->json(['code'=>1,'msg'=>'You Selected Data Been Deleted successfully']);

            }
            public function multywayorder(Request $request ,$id)
            {

                $orderno = $request->id;

                 $result  = Multicitybookings::select('users.name','users.email','users.user_mobile','pickups.pick_city','multicitybookings.*')
                ->join('users','users.id','multicitybookings.user_id')
                ->join( 'pickups','pickups.id','multicitybookings.pickupcity_id')
                ->where('multicitybookings.order_no',$orderno)
                ->first();
                $driver = Multicitybookings::select('multicitybookings.*','drivers.driver_name')->join('drivers','drivers.id','multicitybookings.driver_id')->where('multicitybookings.order_no',$orderno)->first();

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
                if($driver == ''){
                    $driver = '-';
                }else{
                    $driver = $driver->driver_name;
                }


                if($result->status == '0') {
                    $status='Confirm';
                    $b_status_color = 'color:#294f75';
                } else if($result->status == '1') {
                    $b_status_color = 'color:#d2408c';
                    $status = "Panding";
                } else {
                    $b_status_color = 'color:#294f75';

                }
                return view('multicitybookings.multywayorder',compact('result','driver','s_request','flight_number','driver','status','b_status_color'));
            }
            protected function generate_invoice($id)
            {

                $book_cab = Multicitybookings::select('multicitybookings.*')->where('id',$id)->where('status',1)->get();

                $user_details = User::select('users.*')->where('id',$book_cab[0]['user_id'])->get();

                $pickupcity    = Pickup::select('pickups.*')->where('id',$book_cab[0]['pickupcity_id'])->get();
                  $sender_mail   = $user_details[0]['email'];
                    $name  	 	   = $user_details[0]['name'];
                    $pickdate = date_format(date_create($book_cab[0]['pickup_date']),'d-m-Y');
                  $bookon = date_format(date_create($book_cab[0]['created_at']),'d-m-Y');
                    $subject       = 'Booking Confirmation';





                  return view('multicitybookings.before_invoice',compact('subject','bookon','pickdate','name','sender_mail','book_cab','pickupcity','user_details'));



        }
            protected function generate_pdf_invoice_mail($id)
            {

                $book_cab = Multicitybookings::select('multicitybookings.*')->where('id',$id)->where('status',1)->get();

                $user_details = User::select('users.*')->where('id',$book_cab[0]['user_id'])->get();

                $pickupcity    = Pickup::select('pickups.*')->where('id',$book_cab[0]['pickupcity_id'])->get();
                  $sender_mail   = $user_details[0]['email'];
                    $name  	 	   = $user_details[0]['name'];
                    $pickdate = date_format(date_create($book_cab[0]['pickup_date']),'d-m-Y');
                  $bookon = date_format(date_create($book_cab[0]['created_at']),'d-m-Y');
                    $subject       = 'Booking Confirmation';

                    $pdf = PDF::loadView('multicitybookings.invoice',compact('subject','bookon','pickdate','name','sender_mail','book_cab','pickupcity','user_details'));
                    $path = public_path('multyclose_duty/');
                    $fileName =$book_cab[0]['order_no']. '.' . 'pdf';
                    $pdf->save($path . '/' . $fileName);

                    return $fileName;

        }



        public function booking_multydetails_sms($user_id, $order_no, $pickupcity_id, $drop_city, $pickup_date, $pickup_time)
        {

          $user_details = User::select('users.*')->where('id',$user_id)->get();
            $user_name = $user_details[0]['name'];
            $number    = $user_details[0]['user_mobile'];
            $pickupdate= date_format(date_create($pickup_date),'d-M-y');
            $pickcity = Pickup::select('pickups.*')->where('id',$pickupcity_id)->get();

            $message=urlencode('Dear '.$user_name.', Booking ID: '.$order_no.' From '.$pickcity[0]['pick_city'].' To '.$drop_city.' On '.$pickupdate.' At '.$pickup_time.' Has Been confirmed. For any update regarding booking call us on our helpline number +919054300083 or Login @ www.vahansewa.net Team MRSTXI');

            $DLT_TE_ID = '1207166081654342428';

            $url_a= helpers::get_sms_url();
            $a= $url_a->url;
            $url_b = str_replace('{number}',$number,$a);
            $url_c = str_replace('{message}',$message,$url_b);
             $url = str_replace('{DLT_TE_ID}',$DLT_TE_ID,$url_c);
            $msg_status=$this->run_urlOnwaycab($url);
            return true;
        }

      public function booking_multydetails_admin_sms($user_id, $order_no, $pickupcity_id, $drop_city, $pickup_date, $pickup_time)
        {

             $user_details = User::select('users.*')->where('id',$user_id)->get();
             $user_name = $user_details[0]['name'];
             $m_number  = $user_details[0]['user_mobile'];
             $pickupdate= date_format(date_create($pickup_date),'d-M-y');
              $pickcity = Pickup::select('pickups.*')->where('id',$pickupcity_id)->get();
            //   $dropcity = Dropcity::select('dropcities.*')->where('drop_city',$dropcity_id)->get();

              $message = urlencode($user_name.', Booking ID '.$order_no.' From '.$pickcity[0]['pick_city'].' To '.$drop_city.' On ' .$pickupdate.' At '.$pickup_time. ' has been confirmed. www.vahansewa.net Team MRSTXI');

              $DLT_TE_ID = '1207166081661377959';

            $url_a= helpers::get_sms_url();
            $a= $url_a->url;
            $number    = $url_a->mobile;
            $url_b = str_replace('{number}', $number, $a);
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

            $message=urlencode('Hello '.$user_name.', you will receive your cab/driver details before 2 hours prior for booking ID '.$orderno.'. For any help call us on 24*7 help line number +919054300083. Regards www.vahansewa.net Team MRSTXI');

            $DLT_TE_ID = '1207166081657974268';

            $url_a= helpers::get_sms_url();
            $a= $url_a->url;
            $url_b = str_replace('{number}',$number,$a);
            $url_c = str_replace('{message}',$message,$url_b);
            $url = str_replace('{DLT_TE_ID}',$DLT_TE_ID,$url_c);
            $msg_status=$this->run_urlOnwaycab($url);
            return true;
        }




    public function trip_completed_sms($id)
	{

		$book_cab = Multicitybookings::select('multicitybookings.*')->where('id',$id)->where('status',1)->get();
		$user_details = User::select('users.*')->where('id',$book_cab[0]['user_id'])->get();
		$user_name = $user_details[0]['name'];
		$number    = $user_details[0]['user_mobile'];


        $message=urlencode('Dear '.$user_name.', Thanks for choosing our services Regards.+919054300083 Team MRSTXI');

		$DLT_TE_ID = '1207166081671744367';

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

