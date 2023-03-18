<?php

namespace App\Http\Controllers;

use App\Cab_master;
use App\Multy_bookings;
use App\Pickup;
use App\Dropcity;
use App\Onewaybookings;
use App\Multicitybookings;
use App\Local_package;
use App\Onewaydetails;
use App\Localdetails;
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
use File;
use DB;


class Multy_bookingsController extends Controller
{

      public function index(Request $request )
    {

        // return $request;
        $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','users.name','users.email','users.user_mobile','cab_masters.cab','cab_masters.seat','cab_masters.bag')
        ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
        ->join('users','users.id','multy_bookings.user_id')
        ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
        ->orderby('multy_bookings.id','desc')
        ->get();
    //   return  $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','users.name','users.email','users.user_mobile','cab_masters.cab')
    //     ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
    //     ->join('users','users.id','multy_bookings.user_id')
    //     ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
    //      ->orderby('multy_bookings.id','desc')
    //     ->get();
                if ($request->ajax()) {

                if(!empty($request->from_date))
                {

                    $from_date =   trim(date_format(date_create($request->from_date),'Y-m-d'));
                    $to_date = trim(date_format(date_create($request->to_date),'Y-m-d'));

                    $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','users.name','users.email','users.user_mobile','cab_masters.cab')
                    ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                    ->join('users','users.id','multy_bookings.user_id')
                    ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
                    ->whereBetween('pickup_date',[$from_date,$to_date])
                    ->orderby('multy_bookings.id','desc')
                    ->get();
                }
                else
                {
                    $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','users.name','users.email','users.user_mobile','cab_masters.cab')
                    ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                    ->join('users','users.id','multy_bookings.user_id')
                    ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
                    ->orderby('multy_bookings.id','desc')
                    ->get();
                }



                    return Datatables::of($data)
                        ->addIndexColumn()

                        ->addColumn('checkbox', function($row){
                            return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                         })



                         ->setRowAttr([
                            'style' => function($row){
                                return $row->status==0 ? 'background-color: #fbdddd;border-bottom:1px solid #c1c1c1' : 'border-bottom:1px solid #c1c1c1';
                            }
                        ])
                        ->addColumn('orderno',function($row){
                            $orderno= $row->orderno;
                            if($row->booking_type == 'Oneway'){
                                if($row->status==1){
                                    $data =  '<a class="btn btn-icon out_lint" style="padding: 10px 27px; "><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save menu_active1"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg></a>';

                                }
                                else{
                                    $data =  '<a class="btn btn-icon out_lint" href="'.url('public/multyclose_duty',$row->orderno.'.pdf').'" download style="padding: 10px 27px; "><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save menu_active1"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg></a>';
                                }
                                $html =  '

                                <div style="text-align:center;margin-bottom:5px;">
                                <a class="btn btn-icon btn-outline-primary" href="'.url('admin/cab_booking/oneway_order',$row->orderno).'" >'.$row->orderno.'
                                </a>
                                </div>
                                <div  style="text-align:center">
                                '.$data.'
                                </div>

                             ';
                            }elseif($row->booking_type == 'Localpackage'){
                                if($row->status==1){
                                    $data =  '<a class="btn btn-icon out_lint" style="padding: 10px 27px; "><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save menu_active1"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg></a>';

                                }
                                else{
                                    $data =  '<a class="btn btn-icon out_lint" style="padding: 10px 27px; " href="'.url('public/multyclose_duty',$row->orderno.'.pdf').'" download ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save menu_active1"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg></a>';
                                }
                                $html =  '
                                <div style="text-align:center;margin-bottom:5px;">
                                <a class="btn btn-icon btn-outline-primary" href="'.url('admin/cab_booking/localway_order',$row->orderno).'" >'.$row->orderno.'
                                </a>
                                </div>
                                <div  style="text-align:center">
                                '.$data.'
                                </div>
                              ';
                            }else{
                                if($row->status==1){
                                    $data =  '<a class="btn btn-icon out_lint" style="padding: 10px 27px; "><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save menu_active1"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg></a>';

                                }
                                else{
                                    $data =  '<a class="btn btn-icon out_lint" style="padding: 10px 27px; " href="'.url('public/multyclose_duty',$row->orderno.'.pdf').'" download ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save menu_active1"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg></a>';
                                }

                                $html =  '
                                <div style="text-align:center;margin-bottom:5px;">
                                <a class="btn btn-icon btn-outline-primary" href="'.url('admin/cab_booking/multyway_order',$row->orderno).'" >'.$row->orderno.'
                                </a>
                                </div>
                                <div  style="text-align:center">
                                '.$data.'
                                </div>

                              ';
                            }


                    return $html;

                        })


                        ->addColumn('contact_info',function($row){
                            $name = $row->name;
                            $email = $row->email;
                            $mobile = $row->user_mobile;
                            $altmobile = $row->alternet_mobile;
                           return  $this->contact_info($name,$email,$mobile,$altmobile);




                        })
                        ->addColumn('asign',function($row){

                              $btn = '
                                        <div class="btn-group">

                                            <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="font-size:12px">
                                                Assign
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                                            <a class="dropdown-item" href="'.route('driver.assign', ['id' => $row->id]).'">Add Driver</a>
                                            <a class="dropdown-item" href="'.url('admin/driver_details/select/'.$row->id).'">Exits Driver</a>
                                            </div>
                                        </div>';

                                    if($row->driver_id != ''){

                                        $html= ''.$btn.'<a class="btn btn-outline-secondary ml-1 extraCharge" data-toggle="modal" data-target="#extraCharge_'.$row->id.'" type="button" data-placement="top" title="Close Duty" data-original-title="Close Duty"><span class="btn-label"><i class="fa fa-check"></i></span></a>';
                                    }else{
                                            $html = $btn;

                                    }
                                    if($row->status==1)
                                    {
                                        return $html;
                                    }else{

                                    }



                                })

                        ->addColumn('pickDrop',function($row){


                                return '<label style="margin-bottom:0px">'.$row->pick_city.'</label><br>
                                <i class="fas fa-arrow-down"></i>
                                <br><label>'.$row->travel_city.'</label>';


                        })
                        ->addColumn('driver_name',function($row){
                            if($row->driver_id==''){
                                $data = "<h6> </h6>";
                            }else{
                                $driver_name = $row->driver_name;
                                $driver_mobile = $row->driver_mobile;
                                $cab_name = $row->cab_name;
                                $cab_number = $row->cab_number;

                                return  $this->driver_info($driver_name,$driver_mobile,$cab_name,$cab_number);


                            }

                        })
                        ->addColumn('driver_id',function($row){

                                return '<label><a class="font fsize"></a>'.$row->driver_name.'</label>';


                        })
                        ->addColumn('dateTime',function($row){
                            $date = trim(date_format(date_create($row['pickup_date']),'d-m-Y'));
                            $time = $row->pickup_time;
                            return '<h6 class="mb_10 fsize">'.  $date.'</h6>
                                    <h6 class="fsize"><br>'.$time.'</h6>';
                        })

                        ->addColumn('status',function($row){
                            $url = url("public/front-assets/assets/img/share.png");
                            $name = $row->name;
                            $drop_city = $row->travel_city;
                            $from_city = $row->pick_city;
                            $cab  = $row->cab;
                             $pick_date =  trim(date_format(date_create($row->pickup_date),'d-m-Y'));
                             $pick_time = $row->pickup_time;
                            $mobile = $row->user_mobile;
                            $web = 'https://cabbookkaro.com/';

                            $user_data = ' Name : '.$name.'%0a From : '.$drop_city.'%0a To : '.$from_city.'%0a Car Type : '.$cab.'%0a Date : '.$pick_date.'%0a Time : '.$pick_time.'%0a Phone Number : '.$mobile.'%0a web : '.$web.'%0a';
                                
                                           
                            if($row->status==1){
                                $currentst='Active';
                                $nm='Closeduty';
                                $btn="btn-success";
                                $click = " ";
                                $cancel = $row->status_delete;
                                
                                if($cancel=='No'){
                                    $edit =  '

                                    <a class="btn btn-icon out_line " style="margin-left:-60px" href="'.url('admin/cab_booking/edit',$row->id).'" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 font-medium-3 text-info me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" style="color:#7367F0;"></path></svg></a>
                                   
                                   ';
                                }else{
                                    return '<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disable >Cancel</button>';
                                }



                            }else{
                                $currentst='Closeduty';
                                $nm='Active';
                                $btn="btn-danger";
                                $click = "disabled";
                                $edit =  '<a class="btn btn-icon out_line" disabled style="margin-left:-60px;" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 font-medium-3 text-info me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" style="color:#7367F0;"></path></svg></a>
                                ';

                            }

                            return '
                            <div class="btn-group">
                                <button style="font-size:12px" type="button" class="btn '.$btn.' dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" '.$click.'>'.$currentst.'</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                                <li>
                                    <a class="dropdown-item status_cancel" href="'.url('admin/cab_booking/booking_delete',$row->id).'">Cancel</a>
                                </li>
                                    <li>
                                        <a class="dropdown-item" href="'.url('admin/cab_booking/edit',$row->id).'">Edit</a>
                                    </li>

                                </div>
                                </div><br><br>
                                <a href="https://api.whatsapp.com/send?&text='.$user_data.'" target="_blank"><img src="'.$url.'" style="height:15px"></a>

                                    ';
                        })
                        // ->addColumn('dateTime',function($row){

                        //     return $row->created_at->format('d-m-Y');
                        // })

                    ->addColumn('cab_type',function($row){

                        if($row->booking_type == 'Oneway'){
                            $html =  '
                            <a data-toggle="modal" data-target="#order_'.$row->id.'" ><b class="b_color">'.$row->orderno.'</b></a><br>
                            <label class="cab_label_primary"><a class="font fsize"></a > <span style="font-size:11px;">'.$row->cab.'</span></label>

                            <div class="tooltip_2 tool_ml">
                            <i class="fa fa-circle text-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="OnewayBookings"  ></i>


                             </div>
                             <b class="text-success" data-toggle="modal" data-target="#oneway_'.$row->id.'" style="cursor:pointer">Amount Details</b>';


                            return '<p style="margin-bottom:0px;">'.$html.'</p>';
                        }elseif($row->booking_type == 'Localpackage'){
                            $html= '
                            <a  data-toggle="modal" data-target="#localorder_'.$row->id.'"><b class="b_color">'.$row->orderno.'</b></a><br>
                            <label class="cab_label_primary"><a class="font fsize"></a > <span style="font-size:11px;">'.$row->cab.'</span></label>

                            <div class="tooltip_2 tool_ml">
                            <i class="fa fa-circle text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Local Bookings"  ></i>
                            </div>
                                <b class="text-success" data-toggle="modal" data-target="#local_'.$row->id.'" style="cursor:pointer">Amount Details</b>';


                                return '<p style="margin-bottom:0px;">'.$html.'</p>
                                       ';

                        }else{
                            $html =  '
                            <a  data-toggle="modal" data-target="#multyorder_'.$row->id.'"><b class="b_color">'.$row->orderno.'</b></a><br>
                            <label class="cab_label_primary"><a class="font fsize"></a > <span style="font-size:11px;">'.$row->cab.'</span></label>

                            <div class="tooltip_2 tool_ml">
                            <i class="fa fa-circle text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title=" Round Trip Booking"  ></i>

                                </div>
                                <b class="text-success" data-toggle="modal" data-target="#round_'.$row->id.'" style="cursor:pointer">Amount Details</b>';


                                return '<p style="margin-bottom:0px;">'.$html.'</p>
                                       ';
                        }


                            // return '<div class="d-flex align-items-center me-2 popup" id="my_fun">
                            // <span class="bullet bullet-primary font-small-3 me-50 cursor-pointer" style="margin-left:15px;"></span>
                            // </div><h6><a class="font fsize"></a > '.$row->cab_type.'</i></h6>';
                            // return '';

                        })
                        ->rawColumns(['contact_info','action','driver_name','dateTime','cab_type','status','checkbox','pickDrop','driver_id','asign','orderno','created_at','booking_type','data','dateTime'])
                        ->make(true);
                }
                return view('multy_bookings.index',compact('data'));
            }

        public function contact_info($name,$email,$mobile,$altmobile){

            $info = 'Name  :-'.$name.'<br/>
        Mobile :-'.$mobile.'<br/>
        Email  :-'.$email;
        $customerBookingDetails = '<a href="javascript:void(0)" data-html="true" data-toggle="popover" title="Customer Details" data-content="'.$info.'" tabindex="0" data-trigger="focus">Customer Details</a>';
        return $customerBookingDetails;
        }
        public function driver_info($driver_name,$driver_mobile,$cab_name,$cab_number){

            $info = 'Driver Name  :-'.$driver_name.'<br/>
                    Driver Mobile :-'.$driver_mobile.'<br/>
                    Cab Name :-'.$cab_name.'<br/>
                    Cab Number  :-'.$cab_number;
        $driverdetails = '<a href="javascript:void(0)" data-html="true" data-toggle="popover" title="Driver Details" data-content="'.$info.'" tabindex="0" data-trigger="focus">Details</a>';
        return $driverdetails;
        }

            public function changestatus($nm,$id)
            {


                if($nm = "Closeduty")
                {
                    $nm1= 0;
                    // $this->trip_completed_sms($id);
                       $this->generate_pdf_invoice_mail($id);
                }
                else{
                    $nm1 = 1;
                }
                 $nowdate = date('Y-m-d H:i:s');

                 $data = multy_bookings::where('id',$id)->update([
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
                $cab_data = Cab_master::select('cab_masters.*')->where('cab_status',1)->get();
                $cab = Cab_master::select('cab_masters.*')->where('cab_status',1)->get();
                return view('multy_bookings.create',compact('pickupcity_id','user_id','cab_data','cab'));
            }
            public function edit($id)
            {
                  $data = Multy_bookings::find($id);
                     $data->travel_city;
                     $cab_travel =$data->travel_city; 
                     $values = (explode("|",$cab_travel));
                    $pickupcity_id_data  = Pickup::select('pick_city','id','status_delete')->where('status_delete','No')->get();
                    //   $pickupcity_id = $pickupcity_id_data->pluck('pick_city','id')->all();
                      $pickupcity_id  = Pickup::select('id as p_id','pick_city')->where('pickups.status_delete','No')->get();
                      $user_id_data  =user::select('id as u_id','status_delete')->where('status_delete','No')->get();
                      $user_id = $user_id_data->pluck('id as u_id')->all();
                      $cab_data = Cab_master::select('cab_masters.*')->where('cab_status',1)->get();
                      $drop_city = Dropcity::select('id as d_id','drop_city')->where('dropcities.status_delete','No')->get();
                      $user_data = User::select('id','name','email','user_mobile')->where('id',$data->user_id)->where('users.status_delete','No')->first();
                      $local_city = Local_package::select('id as d_id','local_package as drop_city')->get();
                      return view('multy_bookings.edit',compact('pickupcity_id','user_id','cab_data','data','drop_city','user_data','local_city'));
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

                // return $request;

                if($request->booking_type == "Oneway")
                {
                        // return $request;
                        $cab_master = Cab_master::select('cab_masters.*')->where('id',$request->cab_type)->first();
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
                        // return $request;
                        $onewaydetail = onewaydetails::select('id','km','cab_type','km','tax','state_tax','driver_allowance')
                                                            ->where('pcity_id',$request->pickupcity_id)
                                                            ->where('dcity_id',$request->dropcity_id)
                                                            ->where('cab_type',$request->cab_type)
                                                            ->first();
                            $onewaydetail_id = $onewaydetail->id;
                        $km_rate = Cab_master::select('cab_masters.*')->where('id',$onewaydetail->cab_type)->first();
                        $dropcity = Dropcity::select('dropcities.*')->where('id',$request->dropcity_id)->first();
                            $oneway_orderno = $this->getOrderNo();


                            $from =  trim(date_format(date_create($request->pickup_date), 'Y-m-d'));
                            // return $request;
                        $data=array('pickupcity_id'=>$request->input('pickupcity_id'),
                                    'dropcity_id'=>$request->input('dropcity_id'),
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
                                    'total_amount'=>$request->input('total_amount'),
                                    'orderno'=>$oneway_orderno,
                                    'booking_type'=>$request->booking_type,
                                    'perkm_rate'=>$km_rate->km_rate,
                                    'estimate_kms'=>$onewaydetail->km,
                                    'travel_city'=>$dropcity->drop_city,
                                    'tall_tax'=>$onewaydetail->tax,
                                    'state_tax'=>$onewaydetail->state_tax,
                                    'driver_allowance'=>$onewaydetail->driver_allowance,
                                    'status'=>'1',
                                    );
                                    if($request->user_id == 0){

                                        $data['user_id']= $user_id->id;

                                    }  else if($request->user_id != 0) {
                                        $data['user_id']= $request->user_id;
                                    }
                                    $localbookings = Multy_bookings::create($data);
                                     $this->booking_details_sms($data['user_id'],$data['orderno'],$data['booking_type'],$data['pickupcity_id'],$data['drop_city'],$data['pickup_date'],$data['pickup_time']);
                                    $this->booking_details_admin_sms($data['user_id'],$data['orderno'],$data['booking_type'],$data['pickupcity_id'],$data['drop_city'],$data['pickup_date'],$data['pickup_time']);
                                    $this->booking_confirm_sms($data['user_id'],$data['orderno']);  

                    return redirect()->route('multy_bookings.index')->with('success','Bookings Created Successfully !');
            }
                elseif($request->booking_type=="Localpackage")
                {
                            //    return $request;
                        $cab_master = Cab_master::select('cab_masters.*')->where('id',$request->local_cab_type)->first();
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
            // return $request;
                            $localdetail = localdetails::select('id','kms','ehr','ekr','cab_type')
                                                                ->where('pcity_id',$request->pickupcity_id)
                                                                ->where('dropcity',$request->local_dropcity_id)
                                                                ->where('cab_type',$request->local_cab_type)
                                                                ->first();
                                $localdetail_id = $localdetail->id;
                                $km_rate = Cab_master::select('cab_masters.*')->where('id',$localdetail->cab_type)->first();
                                $local_orderno = $this->getOrderNo();

                              $local_package = Local_package::select('local_packages.local_package','local_packages.id')->where('local_packages.id',$request->local_dropcity_id)->first();

            // return $request;
                            $from =  trim(date_format(date_create($request->pickup_date), 'Y-m-d'));
                               $local_data=array('pickupcity_id'=>$request->input('pickupcity_id'),
                                        'dropcity_id'=>$local_package->id,
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
                                        'gross_total'=>$request->local_gross_total,
                                        'total_amount'=>$request->local_total_amount,
                                        'orderno'=>$local_orderno,
                                        'booking_type'=>$request->booking_type,
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

                        return redirect()->route('multy_bookings.index')->with('success','Bookings created Successfully');
                }
                else{
                    // return "hello";
                    // return $request;

                      $minimum_km = Multicitycabs::select('multicitycabs.*')->where('cab_id',$request->round_cab_type)->first();
                      $cab = Cab_master::select('cab_masters.*')->where('cab_masters.id',$request->round_cab_type)->first();
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
                     // return  $request;
                        $data['orderno']  =   $multy_orderno;

                        $discount=$request->round_total_amount;
                         if($discount != '')
                         {
                              $total_amount = $discount;
                         }else{
                              $total_amount = $request->roundgross_total;
                         }

                         $price = $request->round_cab_type;
                         $price_details = $cab->mkm_rate;


                             $h1 = $request->travel_cities;

                            $from =  trim(date_format(date_create($request->pickup_date), 'Y-m-d'));
                            // $from =  trim(date_format(date_create($request->pickup_date), 'Y-m-d'));
                            // return $request;

                             $return_by_date = date('d-m-Y', strtotime($from . ' + ' .($request->journy_days- 1).' days'));
                              $dropcity = end($h1);
                            //  return $request;
                             $driver_allowance = $request->journy_days *  $minimum_km->driver_allowance;
                             $min_km =  $minimum_km->minkm;

                              $data=array('pickupcity_id'=>$request->input('pickupcity_id'),
                             'drop_city'=>$dropcity,
                             'cab_type' =>  $cab->id,
                             'flight_number' => $request->input('flight_number'),
                             'pickup_date' => $from,
                             'return_date'=>$return_by_date,
                             'travel_city'=>$request->travel,
                             'pickup_time' => $request->pickup_time,
                             'discount' => $request->input('round_discount'),
                             'extra_charge' => $request->input('round_extra_charge'),
                              'alt_mobile' => $request->input('alternet_mobile'),
                              'pickup_location' => $request->input('pickup_location'),
                              'drop_location' => $request->input('drop_location'),
                              'driver_id' => $request->input('driver_id'),
                              'status' => '1',
                              'gross_total'=>$request->input('roundgross_total'),
                              'total_amount'=>$total_amount,
                              's_request'=>$request->input('s_request'),
                              'user_id' => $request->input('user_id'),
                              'minkm'=>$min_km,
                              'seat'=>$minimum_km->seat,
                              'bag'=>$minimum_km->bag,
                              'travelkms'=>$minimum_km->minkm,
                              'estimate_kms'=>$request->esti_kms,
                             'perkm_rate'=>$price_details,
                              'orderno'=>$multy_orderno,
                              'cupon_id'=>$request->cupon_id,
                              'journey'=> $request->journy_days,
                              'driver_allowance'=> $driver_allowance,
                              'booking_type' =>$request->booking_type,
                              'status'=>1,


                              );
                              if($request->user_id == 0){

                                 $data['user_id']= $user_id->id;

                             }  else if($request->user_id != 0) {
                                 $data['user_id']= $request->user_id;
                             }

                             $request->session()->put('multyid');
                          $multybookings = Multy_bookings::create($data);
                           $this->booking_details_sms($data['user_id'],$data['orderno'],$data['booking_type'],$data['pickupcity_id'],$data['drop_city'],$data['pickup_date'],$data['pickup_time']);
                            $this->booking_details_admin_sms($data['user_id'],$data['orderno'],$data['booking_type'],$data['pickupcity_id'],$data['drop_city'],$data['pickup_date'],$data['pickup_time']);
                            $this->booking_confirm_sms($data['user_id'],$data['orderno']);  

                return redirect()->route('multy_bookings.index')->with('success','Booking created successfully');
                }
            }


            public function update(Request $request, $id)
            {
                 $id;
                     $DM = Multy_bookings::select('orderno')->where('id',$id)->first();
                 $order= $DM->orderno.'.pdf';
                   if(file_exists(public_path('close_duty/'.$order))){ 
                     file::delete(public_path('close_duty/'.$order));
                     
                    }else{
                     
                    }

                 $input = $request->all();
                 $onewaybookings = Multy_bookings::find($id);
                  $oneway_id = $onewaybookings->id;
                // return $request;
                    $arraydata = User::where('id',$onewaybookings->user_id)->update([
                    "name"     => $request->customer_name,
                    'email' => $request->customer_email,
                    'user_mobile'=>$request->customer_mobile
                ]);

                $cab_master = Cab_master::select('cab_masters.*')->where('id',$request->cab_type)->first();
                $from =  trim(date_format(date_create($request->pickup_date), 'Y-m-d'));
                 
                
                if($request->booking_type == "Oneway")
                {
                    
                 if($request->onewaydetail_id==0){
                    $onewaydetail = Onewaydetails::select('onewaydetails.*')->where('pcity_id',$request->pickupcity_id)->where('dcity_id',$request->dropcity_id)->where('cab_type',$request->cab_type)->first();   
                     $driver = Multy_bookings::select('driver_id','vendor_name','driver_name','driver_mobile','cab_name','cab_number')->where('id',$request->id)->first();
                    $edit_driver_id = $driver->driver_id;
                    $edit_driver_name = $driver->driver_name;
                    $edit_vendor_name = $driver->vendor_name;
                    $edit_driver_mobile = $driver->driver_mobile;
                    $edit_cab_name = $driver->cab_name;
                    $edit_cab_number = $driver->cab_number;
                    $status = '1';
  
                  } 
                  else{
                    $onewaydetail = Onewaydetails::select('onewaydetails.*')->where('id',$request->onewaydetail_id)->first();
                     $edit_driver_id = '';
                    $edit_driver_name = '';
                    $edit_vendor_name = '';
                    $edit_driver_mobile = '';
                    $edit_cab_name = '';
                    $edit_cab_number = '';
                    $status = '1';
                  }
                   $dropcity = Dropcity::select('dropcities.*')->where('id',$request->dropcity_id)->first();
                    
                 $data = Multy_bookings::where('id',$oneway_id)->update([
                    'pickupcity_id'=>$request->input('pickupcity_id'),
                    'dropcity_id'=>$request->input('dropcity_id'),
                     'drop_city'=>$request->input('dropcity_id'),
                    'cab_type' => $cab_master->id,
                    'flight_number' => $request->input('flight_number'),
                    'pickup_date' =>$from,
                    'onewaydetail_id'=>$request->onewaydetail_id,
                    'pickup_time' => $request->input('pickup_time'),
                    'discount' => $request->input('discount'),
                    'extra_charge' => $request->input('extra_charge'),
                    'alt_mobile' => $request->input('alternet_mobile'),
                    'pickup_location' => $request->input('pickup_location'),
                    'drop_location' => $request->input('drop_location'),
                    'driver_id'=> $edit_driver_id,
                    'vendor_name'=> $edit_vendor_name,
                    'driver_name'=>  $edit_driver_name,
                    'driver_mobile'=> $edit_driver_mobile,
                    'cab_name'=>  $edit_cab_name ,
                    'cab_number'=> $edit_cab_number,
                    'status' => $request->input('status'),
                    'user_id'=> $request->input('user_id'),
                    'gross_total'=>$request->input('gross_total'),
                    'total_amount'=>$request->input('total_amount'),
                    'booking_type'=>$request->booking_type,
                    'perkm_rate'=>$cab_master->km_rate,
                    'estimate_kms'=>$onewaydetail->km,
                    'travel_city'=>$dropcity->drop_city,
                    'tall_tax'=>$onewaydetail->tax,
                    'state_tax'=>$onewaydetail->state_tax,
                    'driver_allowance'=>$onewaydetail->driver_allowance,
                    'status'=>$status, 

                ]);
                
                return redirect()->route('multy_bookings.index')
            ->with('success','Data updated successfully');
                }
                elseif($request->booking_type == "Localpackage"){
                    // return $request;
                     $dropcity_id = Local_package::select('local_packages.*')->where('local_packages.id',$request->local_dropcity_id)->first();
                    $km_rate = Cab_master::select('cab_masters.*')->where('id',$request->local_cab_type)->first();
                //  return $request;
                if($request->localdetail_id==0){
                    // return $request;
                         $localdetails = Localdetails::select('localdetails.*')->where('pcity_id',$request->pickupcity_id)->where('dropcity',$request->local_dropcity_id)->where('cab_type',$request->local_cab_type)->first();
                        $driver = Multy_bookings::select('driver_id','vendor_name','driver_name','driver_mobile','cab_name','cab_number')->where('id',$request->id)->first();
                        $edit_driver_id = $driver->driver_id;
                        $edit_driver_name = $driver->driver_name;
                        $edit_vendor_name = $driver->vendor_name;
                        $edit_driver_mobile = $driver->driver_mobile;
                        $edit_cab_name = $driver->cab_name;
                        $edit_cab_number = $driver->cab_number;
                        $status = '1';
                                
                }
                else{
                        $localdetails = Localdetails::select('localdetails.*')->where('id',$request->localdetail_id)->first();
                        $edit_driver_id = '';
                        $edit_driver_name = '';
                        $edit_vendor_name = '';
                        $edit_driver_mobile = '';
                        $edit_cab_name = '';
                        $edit_cab_number = '';
                        $status = '1';

                }
                     
                    
                 $data = Multy_bookings::where('id',$oneway_id)->update([
                        'pickupcity_id'=>$request->input('pickupcity_id'),
                        'dropcity_id'=>$dropcity_id->local_package,
                        'drop_city'=>$dropcity_id->id,
                        'cab_type' => $cab_master->id,
                        'flight_number' => $request->input('flight_number'),
                        'localdetail_id'=>$request->localdetail_id,
                        'pickup_date' =>$from,
                        'pickup_time' => $request->input('pickup_time'),
                        'discount' => $request->local_discount,
                        'extra_charge' => $request->local_extra_charge,
                        'alt_mobile' => $request->input('alternet_mobile'),
                        'pickup_location' => $request->input('pickup_location'),
                        'drop_location' => $request->input('drop_location'),
                        'driver_id'=> $edit_driver_id,
                        'vendor_name'=> $edit_vendor_name,
                        'driver_name'=>  $edit_driver_name,
                        'driver_mobile'=> $edit_driver_mobile,
                        'cab_name'=>  $edit_cab_name ,
                        'cab_number'=> $edit_cab_number,
                        'status' => $request->input('status'),
                        'user_id'=> $request->input('user_id'),
                        'gross_total'=>$request->local_gross_total,
                        'total_amount'=>$request->local_total_amount,
                        'booking_type'=>$request->booking_type,
                        'perkm_rate'=>$km_rate->km_rate,
                        'estimate_kms'=>$localdetails->kms,
                        'travel_city'=>$dropcity_id->local_package,
                        'status'=>$status,

                    ]);
                    return redirect()->route('multy_bookings.index')
                ->with('success','Data updated successfully');
                }
                else{
                    // return $request;
                    $minimum_km = Multicitycabs::select('multicitycabs.*')->where('cab_id',$request->round_cab_type)->first();
                    $cab = Cab_master::select('cab_masters.*')->where('cab_masters.id',$request->round_cab_type)->first();
                    $arraydata = User::where('id',$request->user_id)->update([
                        "name"     => $request->customer_name,
                        'email' => $request->email,
                        'user_mobile'=>$request->customer_mobile
                    ]);
                    $discount=$request->round_total_amount;
                    if($discount != '')
                    {
                         $total_amount = $discount;
                    }else{
                         $total_amount = $request->roundgross_total;
                    }
                    $price = $request->round_cab_type;
                     $price_details = $cab->mkm_rate;


                       $h1 = $request->travel_cities;

                        $from =  trim(date_format(date_create($request->pickup_date), 'Y-m-d'));
                       // $from =  trim(date_format(date_create($request->pickup_date), 'Y-m-d'));
                       // return $request;

                         $return_by_date = date('d-m-Y', strtotime($from . ' + ' .($request->journy_days- 1).' days'));
                         $dropcity = end($h1);
                        // return $request;
                        $driver_allowance = $request->journy_days *  $minimum_km->driver_allowance;
                          $min_km =  $minimum_km->minkm;

                         $data = Multy_bookings::where('id',$oneway_id)->update([

                            'pickupcity_id'=>$request->input('pickupcity_id'),
                            'drop_city'=>$dropcity,
                            'cab_type' =>  $cab->id,
                            'flight_number' => $request->input('flight_number'),
                            'pickup_date' => $from,
                            'return_date'=>$return_by_date,
                            'travel_city'=>$request->travel,
                            'pickup_time' => $request->pickup_time,
                            'discount' => $request->input('round_discount'),
                            'extra_charge' => $request->input('round_extra_charge'),
                             'alt_mobile' => $request->input('alternet_mobile'),
                             'pickup_location' => $request->input('pickup_location'),
                             'drop_location' => $request->input('drop_location'),
                             'driver_id' => $request->input('driver_id'),
                             'status' => '1',
                             'gross_total'=>$request->input('roundgross_total'),
                             'total_amount'=>$total_amount,
                             's_request'=>$request->input('s_request'),
                             'user_id' => $request->input('user_id'),
                             'minkm'=>$min_km,
                             'seat'=>$minimum_km->seat,
                             'bag'=>$minimum_km->bag,
                             'travelkms'=>$minimum_km->minkm,
                             'estimate_kms'=>$request->esti_kms,
                            'perkm_rate'=>$price_details,
                             'cupon_id'=>$request->cupon_id,
                             'journey'=> $request->journy_days,
                             'driver_allowance'=> $driver_allowance,
                             'booking_type' =>$request->booking_type,
                             'status'=>1,
                         ]);
                         return redirect()->route('multy_bookings.index')
                         ->with('success','Data updated successfully');

                }
            }
            public function coupon_check(Request $request) {

                $promocode  = $request->post('promo_code');
                $amount= $request->post('amount');
                  $promo_code = Cupon::select('cupons.*')->where('cupon_code',$promocode)->where('min_amount', '<=' ,$amount)->where('max_amount','>',$amount)->where('status','Avilable')->where('cupons.status_delete','No')->get();
                  $promo_code_id = $promo_code->count();
                if($promo_code_id != '') {
                    return $arr = array('coupon_id' => $promo_code[0]['id'],'coupon_code' => $promo_code[0]['cupon_code'],'coupon_rate' =>$promo_code[0]['cupon_rate']);
                    echo json_encode($arr);
                } else {
                    echo json_encode(0);
            }
        }
             public function deleteAll(Request $request)
            {

                $checkedcity_ids = $request->checkedcity_ids;

                Multy_bookings::WhereIn('id',$checkedcity_ids)->delete();
                return response()->json(['code'=>1,'msg'=>'You Selected Data Been Deleted successfully']);

            }
            public function booking_delete($id)
            {

                 $checkedcity_ids = $id;

                  Multy_bookings::Where('id',$checkedcity_ids)->update(['status_delete'=>'Yes']);
                //  return redirect()->route('multy_bookings.index')->with('success','Bookings Canceled Successfully !');

            }
            public function getOrderNo()
                {
                    $getOrderId =Multy_bookings::select('id')->count();

                    if ($getOrderId > 0 ){
                        //found record
                        $orderno = $getOrderId;

                        $removeText = str_replace("Ocean", "", $orderno);
                        $plusOne = $removeText + 1001;
                        $orderno = 'Ocean' . $plusOne;

                        return $orderno;

                    } else {
                        //no record
                        $taxi = 'Ocean999';
                        $orderno = $taxi;
                        return $orderno;
                    }

                }
     
                public function oneway_order(Request $request ,$id)
                {
                    // return $request;
                    $orderno = $request->id;

                      $result  = Multy_bookings::select('users.name','users.email','users.user_mobile','pickups.pick_city','multy_bookings.*','dropcities.drop_city')
                    ->join('users','users.id','multy_bookings.user_id')
                    ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                    ->join('dropcities','dropcities.id','multy_bookings.dropcity_id')
                    ->where('multy_bookings.orderno',$orderno)
                    ->first();
                    $driver = onewaybookings::select('onewaybookings.*','drivers.driver_name')->join('drivers','drivers.id','onewaybookings.driver_id')->where('onewaybookings.orderno',$orderno)->first();
                     $onewaydetail = Onewaydetails::select('onewaydetails.*')->where('id',$result->onewaydetail_id)->first();
                     if($result->s_request=='') {
                        $s_request = '-';
                    } else {
                        $s_request = $result->s_request;
                    }

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
                    return view('onewaybookings.onewayorder',compact('result','driver','s_request','flight_number','driver','status','b_status_color','onewaydetail'));
                }
                public function localway_order (Request $request ,$id)
                    {
                        $orderno = $request->id;

                          $result  = multy_bookings::select('users.name','users.email','users.user_mobile','pickups.pick_city','multy_bookings.*')
                        ->join('users','users.id','multy_bookings.user_id')
                        ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                        ->where('multy_bookings.orderno',$orderno)
                        ->first();
                          $localdetail = Localdetails::select('localdetails.*')->where('id',$result->localdetail_id)->first();
                            $local_package = Local_package::select('local_packages.*')->where('id',$result->dropcity_id)->first();
                        $driver = multy_bookings::select('multy_bookings.*','drivers.driver_name')->join('drivers','drivers.id','multy_bookings.driver_id')->where('multy_bookings.orderno',$orderno)->first();

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
                        return view('localbookings.localwayorder',compact('result','s_request','flight_number','driver','status','b_status_color','localdetail','local_package'));
                    }

            public function multyway_order(Request $request ,$id)
            {

                $orderno = $request->id;

                  $result  = multy_bookings::select('users.name','users.email','users.user_mobile','pickups.pick_city','multy_bookings.*')
                ->join('users','users.id','multy_bookings.user_id')
                ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                ->where('multy_bookings.orderno',$orderno)
                ->first();
                $driver = multy_bookings::select('multy_bookings.*','drivers.driver_name')->join('drivers','drivers.id','multy_bookings.driver_id')->where('multy_bookings.orderno',$orderno)->first();

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
            protected function generate_pdf_invoice_mail($id)
            {

                  $book_cab = Multy_bookings::select('multy_bookings.*')->where('id',$id)->where('status',1)->get();

                 $user_details = User::select('users.*')->where('id',$book_cab[0]['user_id'])->get();
                 $onewaydetail = Onewaydetails::select('onewaydetails.*')->where('id',$book_cab[0]['onewaydetail_id'])->get();
                     $localdetail = Localdetails::select('localdetails.*')->where('id',$book_cab[0]['localdetail_id'])->get();
                 $pickupcity    = Pickup::select('pickups.*')->where('id',$book_cab[0]['pickupcity_id'])->get();
                $dropcity = Dropcity::select('dropcities.*')->where('id',$book_cab[0]['dropcity_id'])->get();
                  $local_package = Local_package::select('local_package')->where('id',$book_cab[0]['dropcity_id'])->first();

                  $sender_mail   = $user_details[0]['email'];
                    $name  	 	   = $user_details[0]['name'];
                    $pickdate = date_format(date_create($book_cab[0]['pickup_date']),'d-m-Y');
                  $bookon = date_format(date_create($book_cab[0]['created_at']),'d-m-Y');
                    $subject       = 'Booking Confirmation';

                    $pdf = PDF::loadView('multicitybookings.invoice',compact('subject','dropcity','local_package','bookon','pickdate','name','sender_mail','book_cab','pickupcity','user_details','onewaydetail','localdetail'));
                    $path = public_path('multyclose_duty/');
                    $fileName =$book_cab[0]['orderno']. '.' . 'pdf';
                    $pdf->save($path . '/' . $fileName);

                    return $fileName;

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
              $message=urlencode('Dear '.$user_name.', Booking ID '.$orderno.' From '.$pickcity[0]['pick_city'].' To '.$dropcity[0]['drop_city'].' On '.$pickupdate.' At '.$pickup_time.' Has Been confirmed. For any update regarding booking call us on our helpline number +919909151547 or Login @ www.cabbookkaro.com Team MRSTXI');
        }
        elseif($booking_type=="Localpackage"){
            $pickcity = Pickup::select('pickups.*')->where('id',$pickupcity_id)->get();
            $dropcity = Local_package::select('local_packages.*')->where('id',$dropcity_id)->get();
             $message=urlencode('Dear '.$user_name.', Booking ID '.$orderno.' From '.$pickcity[0]['pick_city'].' To '.$dropcity[0]['local_package'].' On '.$pickupdate.' At '.$pickup_time.' Has Been confirmed. For any update regarding booking call us on our helpline number +919909151547 or Login @ www.cabbookkaro.com Team MRSTXI');
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
             $message = urlencode($user_name.', Booking ID '.$orderno.' From '.$pickcity[0]['pick_city'].' To '.$dropcity[0]['drop_city'].' On ' .$pickupdate.' At '.$pickup_time. ' has been confirmed. www.cabbookkaro.com Team MRSTXI');
                }
                elseif($booking_type=="Localpackage"){
                      $pickcity = Pickup::select('pickups.*')->where('id',$pickupcity_id)->get();
            $dropcity = Local_package::select('local_packages.*')->where('id',$dropcity_id)->get();
             $message = urlencode($user_name.', Booking ID '.$orderno.' From '.$pickcity[0]['pick_city'].' To '.$dropcity[0]['local_package'].' On ' .$pickupdate.' At '.$pickup_time. ' has been confirmed. www.cabbookkaro.com Team MRSTXI');
                }
                else{
                      $pickcity = Pickup::select('pickups.*')->where('id',$pickupcity_id)->get();
                     $dropcity = $dropcity_id;
                      $message = urlencode($user_name.', Booking ID '.$orderno.' From '.$pickcity[0]['pick_city'].' To '.$dropcity.' On ' .$pickupdate.' At '.$pickup_time. ' has been confirmed. www.cabbookkaro.com Team MRSTXI');
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
		$message=urlencode('Hello '.$user_name.', you will receive your cab/driver details before 2 hours prior for booking ID '.$orderno.'. For any help call us on 24*7 help line number +919909151547. Regards www.cabbookkaro.com Team MRSTXI');

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
         $id;
		$book_cab = Multy_bookings::select('multy_bookings.user_id')->where('id',$id)->get();
		$user_details = User::select('users.*')->where('id',$book_cab[0]['user_id'])->get();
		$user_name = $user_details[0]['name'];
		$number    = $user_details[0]['user_mobile'];


        $message=urlencode('Dear '.$user_name.', Thanks for choosing our services Regards.+919909151547 Team MRSTXI');

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

    public function charge_store(Request $request)
    {
        // return $request;
         $data = Multy_bookings::select('multy_bookings.*')->where('id',$request->booking_id)->first();
        if($data->status = "1")
            {
                $nm1= 0;
                // $this->trip_completed_sms($id);
                //    $this->generate_pdf_invoice_mail($id);
            }
            else{
                $nm1 = 1;
            }
            $nowdate = date('Y-m-d H:i:s');

            $data = multy_bookings::where('id',$request->booking_id)->update([
            "status"     =>$nm1 ,
            "updated_at" =>$nowdate   
            ]);

            //  $request;
        Multy_bookings::where('id',$request->booking_id)->update([
            "tall_tax"     => $request->toll_tax,
           "state_tax"      => $request->state_tax,
           "parking_charge" => $request->parking_charge,
           "extra_km" => $request->extra_kms,
           ]);
           $id= $request->booking_id;
              $this->trip_completed_sms($id);
           return redirect()->route('multy_bookings.index')->with('success','Charges Updated Successfully');
    }
    public function invoice(Request $request)
    {
        if ($request->ajax()) {

          



            if($request->number !='' && $request->booking_id !='')
            {


                 $number= $request->number;
                 $booking_id = $request->booking_id; 

                $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','users.name','users.email','users.user_mobile','cab_masters.cab')
                ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                ->join('users','users.id','multy_bookings.user_id')
                ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
                ->where('user_mobile',$number) 
                ->where('orderno',$booking_id)
                ->where('multy_bookings.status',0)
                ->orderby('multy_bookings.id','desc')
                ->get();
            }elseif(!empty($request->booking_id)){

                 $booking_id= $request->booking_id;

                $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','users.name','users.email','users.user_mobile','cab_masters.cab')
                ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                ->join('users','users.id','multy_bookings.user_id')
                ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
                ->where('orderno',$booking_id)
                ->where('multy_bookings.status',0)
                ->orderby('multy_bookings.id','desc')
                ->get();
            }
            elseif(!empty($request->number))
            {
                $number= $request->number;
                $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','users.name','users.email','users.user_mobile','cab_masters.cab')
                ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                ->join('users','users.id','multy_bookings.user_id')
                ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
                ->where('user_mobile',$number)
                ->where('multy_bookings.status',0)
                ->orderby('multy_bookings.id','desc')
                ->get();
            }else{
                $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','users.name','users.email','users.user_mobile','cab_masters.cab')
                ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                ->join('users','users.id','multy_bookings.user_id')
                ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
                ->where('multy_bookings.status',0)
                ->orderby('multy_bookings.id','desc')
                ->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                 })

                ->addColumn('invoice', function($row){
                     $order= $row->orderno.'.pdf';
                    // return '<label>Name : '.$order.'</label>';
                     
                   if(file_exists(public_path('close_duty/'.$order))){ 
                        $gen_inv =  "Invoice Genrated";
                    }else{
                        $gen_inv = "";
                    }
                    

                    if($row->status == "0")
                    {
                        if($gen_inv == 'Invoice Genrated' ){
                              $data =  '<div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Download</button>
                        <div class="dropdown-menu">
                               <li>
                                <a class="dropdown-item" href="'.url('admin/cab_booking/edit',$row->id).'">Edit</a>
                            </li>
                            <li>
                            
                                <a class="dropdown-item ganrate_invoice"  href="'.url('admin/cab_booking/ganrate_invoice/'.$row->id).'">Generate Pdf</a>
                            </li> 
                            <li>
                                <a class="dropdown-item" href="'.url("public/close_duty/".$row->orderno).'.pdf" download>Download</a>
                            </li>
                            <li>
                                <a class="dropdown-item send_mail" href="'.url('admin/cab_booking/send_mail/'.$row->id).'" >Send Mail</a>
                            </li>
                        </div>
                    </div>';
                        }else{
                            $data =  '<div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View</button>
                        <div class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="'.url('admin/cab_booking/edit',$row->id).'">Edit</a>
                            </li>
                            <li>
                            
                                <a class="dropdown-item ganrate_invoice"  href="'.url('admin/cab_booking/ganrate_invoice/'.$row->id).'">Generate Pdf</a>
                            </li> 
                         

                        </div>
                    </div>';
                        
                        }
                      
                    }
                    else{

                    }
                    if($row->booking_type=="Oneway"){
                            $html= '<div class="col-md-12" style="text-align:center">
                                        <div class="tooltip_2 tool_ml">
                                            <i class="fa fa-circle text-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Oneway Booking"></i>
                                        </div>
                                    </div>';
                    }else if($row->booking_type=="Localpackage"){ 
                        $html= '
                            <div class="col-md-12" style="text-align:center"> 
                                <div class="tooltip_2 tool_ml">
                                    <i class="fa fa-circle text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Local Booking"></i>
                                </div>
                            </div>';
                    }else{
                        $html= '
                            <div class="col-md-12" style="text-align:center">  
                                <div class="tooltip_2 tool_ml">
                                    <i class="fa fa-circle text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Round Trip Booking"></i>
                                </div>
                            </div>';
                    } 
                    
                    return '<label>'.$data.'</label>  
                             <label>'.$html.'</label><br>
                              <label><b>'.$gen_inv.'</b></label>';
                })
                   ->setRowAttr([
                            'style' => function($row){
                                 $order= $row->orderno.'.pdf';
                                if(file_exists(public_path('close_duty/'.$order))){ 
                                        $gen_inv =  "Invoice Genrated";
                                    }else{
                                        $gen_inv = "";
                                    }
                                return $gen_inv=='Invoice Genrated' ? 'background-color: #fbdddd;border-bottom:1px solid #c1c1c1' : 'border-bottom:1px solid #c1c1c1';
                            }
                        ])
                ->addColumn('customer', function($row){

                    $name = $row->name;
                    if (!empty($name)) {
                    return '<label>Name : '.ucwords($name).'</label>
                            <label>Mobile : '.ucwords($row->user_mobile).'</label>';
                    } else {
                        return '<label>-</label>';
                    }

                })

                    ->addColumn('from',function($row){


                        return '<label style="margin-bottom:0px">'.$row->pick_city.'</label><br>
                        <i class="fas fa-arrow-down"></i>
                        <br><label>'.$row->travel_city.'</label>';


                })
                        ->addColumn('invoice_no',function($row){


                        return '<p style="margin-bottom:0px;">
                            <a ><b class="b_color">'.$row->orderno.'</b></a><br>
                            </p>';


                })

                ->addColumn('cab_name', function($row){
                    $cab_name = $row->cab_name;
                    if (!empty($cab_name)) {
                    return '<label> '.ucwords($cab_name).'</label>&nbsp';
                    } else {
                        return '<label>-</label>';
                    }
                })
                ->addColumn('total_amount', function($row){
                    return '<label> <i class="fa fa-inr"></i> '.$row->total_amount.'</label>';

                })
                ->addColumn('date',function($row){

                    return $row->created_at->format('d-m-Y h:i A');
                })
                ->rawColumns(['invoice','invoice_no','customer','from','date','checkbox','total_amount'])
                ->make(true);
        }
        return view('multy_bookings.invoice');
    }
    public function invoice_view(){
        $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','dropcities.drop_city','users.name','users.email','users.user_mobile','cab_masters.cab')
                                        ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                                        ->join( 'dropcities','dropcities.id','multy_bookings.drop_city')
                                        ->join('users','users.id','multy_bookings.user_id')
                                        ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
                                        ->where('multy_bookings.id',4)
                                        ->orderby('multy_bookings.id','desc')
                                        ->first();
        return view('multy_bookings.invoice_view',compact('data'));
    }
    public function ganrate_invoice($id)
	{
         $id;
         $multy_data = Multy_bookings::select('multy_bookings.booking_type')->where('multy_bookings.id',$id)->first();
         if($multy_data->booking_type=="Oneway"){ 
            $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','dropcities.drop_city','users.name','users.email','users.user_mobile','cab_masters.cab')
                                        ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                                        ->join( 'dropcities','dropcities.id','multy_bookings.drop_city')
                                        ->join('users','users.id','multy_bookings.user_id')
                                        ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
                                        ->where('multy_bookings.id',$id)
                                        ->orderby('multy_bookings.id','desc')
                                        ->first();
        }else if($multy_data->booking_type=="Localpackage"){
          $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','users.name','users.email','users.user_mobile','cab_masters.cab','local_packages.local_package')
                                        ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                                        ->join( 'local_packages','local_packages.id','multy_bookings.drop_city')
                                        ->join('users','users.id','multy_bookings.user_id')
                                        ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
                                        ->where('multy_bookings.id',$id)
                                        ->orderby('multy_bookings.id','desc')
                                        ->first();
        }else{
            
             $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','users.name','users.email','users.user_mobile','cab_masters.cab')
                                        ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                                      
                                        ->join('users','users.id','multy_bookings.user_id')
                                        ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
                                        ->where('multy_bookings.id',$id)
                                        ->orderby('multy_bookings.id','desc')
                                        ->first();
        }
           
                // return view('multy_bookings.invoice_view',compact('data'));
            $pdf = PDF::loadView('multy_bookings.invoice_view',compact('data'));

            // $mail_to = 'dhavalthumar505@gmail.com';
            // \Mail::to($mail_to)->send(new \App\Mail\MyContactMail($details));
            $path = public_path('close_duty/');
            $fileName =$data->orderno. '.' . 'pdf';
            $pdf->save($path . '/' . $fileName);
                $dk =  "Invoice Generatesd";
                // return redirect()->route('multy_bookings.index')
                //          ->with('success','Data updated successfully');
            

            }
            public function send_mail($id)
            {
                $multy_data = Multy_bookings::select('multy_bookings.booking_type')->where('multy_bookings.id',$id)->first();
                    if($multy_data->booking_type=="Oneway"){ 
                         $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','dropcities.drop_city','users.name','users.email','users.user_mobile','cab_masters.cab')
                                                    ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                                                    ->join( 'dropcities','dropcities.id','multy_bookings.drop_city')
                                                    ->join('users','users.id','multy_bookings.user_id')
                                                    ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
                                                    ->where('multy_bookings.id',$id)
                                                    ->orderby('multy_bookings.id','desc')
                                                    ->first();
                    }else if($multy_data->booking_type=="Localpackage"){
                        $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','users.name','users.email','users.user_mobile','cab_masters.cab','local_packages.local_package')
                                                    ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                                                    ->join( 'local_packages','local_packages.id','multy_bookings.drop_city')
                                                    ->join('users','users.id','multy_bookings.user_id')
                                                    ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
                                                    ->where('multy_bookings.id',$id)
                                                    ->orderby('multy_bookings.id','desc')
                                                    ->first();
                    }else{
                        
                        $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city','users.name','users.email','users.user_mobile','cab_masters.cab')
                                                    ->join( 'pickups','pickups.id','multy_bookings.pickupcity_id')
                                                    ->join('users','users.id','multy_bookings.user_id')
                                                    ->join('cab_masters','cab_masters.id','multy_bookings.cab_type')
                                                    ->where('multy_bookings.id',$id)
                                                    ->orderby('multy_bookings.id','desc')
                                                    ->first();
                    }
                    $details =  $data;
                     $order= $data->orderno.'.pdf';
                    $data_2["email"]='dhavalt303@gmail.com';
                    $data_2["client_name"]='Dhaval Thumasr';
                    $data_2["subject"]='Devloper Testing';
                    $name = 'Booking Invoice';
                    $address = config("mail.from.address");
                    $pdf = PDF::loadView('multy_bookings.invoice_view',compact('data'));

                                    $mail_to = 'dhavalt303@gmail.com';
                                    \Mail::send('frontend.emails.request', $data_2, function($message)use($data_2,$pdf,$order,$name,$address) {
                                        $message->to($data_2["email"], $data_2["client_name"])
                                        ->subject($data_2["subject"])
                                        ->attachData($pdf->output(), $order)
                                        ->from($address,$name);
                                        });
                                   
                            
                                
                       
                    return redirect()->route('multy_bookings.index')->with('success','Mail Send successfully');
                    //  return view('multy_bookings.invoice_view',compact('data'));
            }

}

