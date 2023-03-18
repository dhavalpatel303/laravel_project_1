<?php

namespace App\Http\Controllers;

use App\Cab_master;
use App\Pickup;
use App\Dropcity;
use App\Localbookings;
use App\Localdetails;
use App\Local_package;
use App\Driver;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use Helpers;
use DB;
use PDF;

class LocalbookingsController extends Controller
{

      public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Localbookings::select('localbookings.*','pickups.pick_city','users.name','users.email','users.user_mobile')
        ->join( 'pickups','pickups.id','localbookings.pickupcity_id')
        ->join('users','users.id','localbookings.user_id')
        ->where('localbookings.status_delete','No')
        ->orderby('localbookings.id','desc')
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
                        $html =  '<a class="btn btn-icon btn-outline-primary"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg></a>';

                    }
                    else{
                        $html =  '<a class="btn btn-icon btn-outline-primary" href="'.url('public/localclose_duty',$row->orderno.'.pdf').'" download ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg></a>';
                    }
                    return $html;
                 })
                 ->addColumn('action', function($row){
                    $status = $row->status;
                    if($status == 1)
                    {
                        $html =  '<a class="btn btn-icon btn-outline-primary" href="'.url('admin/localbookings/edit',$row->id).'" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 font-medium-3 text-info me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" style="color:#7367F0;"></path></svg></a>
                            ';
                    }else{
                        $html = '<a class="btn btn-icon btn-outline-primary" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 font-medium-3 text-info me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" style="color:#7367F0;"></path></svg></a>';
                    }


                    return $html;
                })
                ->setRowAttr([
                    'style' => function($row){
                        return $row->status==0 ? 'background-color: #fbdddd;border-bottom:1px solid #c1c1c1' : 'background-color: #d4f4e2;border-bottom:1px solid #c1c1c1';
                    }
                ])
                ->addColumn('orderno',function($row){
                    $orderno= $row->orderno;
                    $html =  '<a class="btn btn-icon btn-outline-primary" href="'.url('admin/localbookings/localwayorder',$row->orderno).'" >'.$row->orderno.'</a>
                    ';

            return $html;
                })

                ->addColumn('contact_info',function($row){
                    $name = $row->name;
                    $email = $row->email;
                    $mobile = $row->user_mobile;
                    $altmobile = $row->alternet_mobile;
                    return '<label><a class="font fsize"></a>'. ucwords($name).'</label>
                    <label><a class="font fsize"></a>'.$email.'</label>
                    <label><a class="font fsize"></a>'.$mobile.'</label>';


                })
                ->addColumn('asign',function($row){
                    if($row->status == 1){
                    return'<div class="btn-group">
                                <button type="button" class="btn btn-dark me-1 waves-effect  dropdown-toggle budget-dropdown waves-effect " data-bs-toggle="dropdown">Assign</button>
                                <div class="dropdown-menu " data-popper-placement="top-start" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(0px, -60px);">
                                <a class="dropdown-item" href="'.route('driver_local_assign', ['id' => $row->id]).'">Add Driver</a>
                                <a class="dropdown-item" href="'.url('admin/driver/localselect/'.$row->id).'">Exits Driver</a>
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
                    $to = $row->dropcity_id;
                    return '<label>'.$from.'</label><br><a class="font fsize">To</a><br><label>'.$to.'</label>';

                })
                ->addColumn('driver_id',function($row){
                    return '<label><a class="font fsize"></a > '. ucwords($row->driver_name).'</i></label>';
                })
                ->addColumn('dateTime',function($row){
                    $date =  $row['created_at'] = trim(date_format(date_create($row['created_at']),'d-m-Y'));
                    $time = $row->pickup_time;
                    return '<label><a class="font fsize"> Date</a> : '.  $date.'</label><label><br><a class="font fsize">Time</a> : '.$time.'</label>';
                })

                ->addColumn('status',function($row){

                    if($row->status==1){
                        $currentst='OnDuty';
                        $nm='CloseDuty';
                        $btn="btn-success";
                        $click = "";

                    }else{
                        $currentst='CloseDuty';
                        $nm='OnDuty';
                        $btn="btn-danger";
                        $click = "disabled";

                    }
                    return '<a href="'.url('admin/localbookings/changestatus/'.$nm.'/'.$row->id).'" class="statuschange"><button  class="btn '.$btn.' me-1 waves-effect waves-float waves-light"  '.$click.'>'.$currentst.'</button></a>';
                })
                ->addColumn('created_at',function($row){

                    return $row->created_at->format('d-m-Y');
                })

                ->addColumn('cab_type',function($row){
                    $type =$row->cab_type;
                    if($type=='Primesuv'){
                        return '<label><a class="font fsize"></a >Primium Suv</i></label>';

                    }elseif($type=='Primesedan'){
                        return '<label><a class="font fsize"></a >Primium Sedan</i></label>';

                    }else{
                        return '<label><a class="font fsize"></a > '.$row->cab_type.'</i></label>';
                    }
                    })
                ->rawColumns(['action','contact_info','pdf','dateTime','cab_type','status','checkbox','pickDrop','driver_name','asign','orderno','driver_id'])
                ->make(true);
        }
        return view('localbookings.index');
    }
    public function create()
    {
        $pickupcity_id_data  = Pickup::select('pick_city','id','status_delete')->where('status_delete','No')->get();
        $pickupcity_id = $pickupcity_id_data->pluck('pick_city','id')->all();
    $user_id_data  =user::select('id as u_id','status_delete')->where('status_delete','No')->get();
    $user_id = $user_id_data->pluck('id as u_id')->all();

        return view('localbookings.create',compact('pickupcity_id','user_id'));
    }

  public function store(Request $request)
    {
    //    return $request;
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

        $localdetail = localdetails::select('id')
                                            ->where('pcity_id',$request->pickupcity_id)
                                            ->where('cab_type',$request->cab_type)
                                            ->first();
             $localdetail_id = $localdetail->id;

            $orderno = $this->getOrderNo();

         $dropcity_id = Local_package::select('local_packages.local_package')->where('local_packages.id',$request->dropcity)->first();

         $from =  trim(date_format(date_create($request->pickup_date), 'Y-m-d'));
           $data=array('pickupcity_id'=>$request->input('pickupcity_id'),
                    'dropcity_id'=>$dropcity_id->local_package,
                    'cab_type' => $request->input('cab_type'),
                    'flight_number' => $request->input('flight_number'),
                    'localdetail_id'=>$localdetail_id,
                    'pickup_date' =>$from,
                    'pickup_time' => $request->input('pickup_time'),
                    'discount' => $request->input('discount'),
                    'extra_charge' => $request->input('extra_charge'),
                     'alternet_mobile' => $request->input('alternet_mobile'),
                     'pickup_location' => $request->input('pickup_location'),
                     'drop_location' => $request->input('drop_location'),
                     'driver_id' => $request->input('driver_id'),
                     'status' => $request->input('status'),
                     'user_id'=> $request->input('user_id'),
                     'gross_total'=>$request->input('gross_total'),
                     'total_amount'=>$request->input('total_amount'),
                    'orderno'=>$orderno,


                     );
                     if($request->user_id == 0){

                        $data['user_id']= $user_id->id;

                    }  else if($request->user_id != 0) {
                        $data['user_id']= $request->user_id;
                    }

                    $this->booking_localdetails_sms($data['user_id'],$data['orderno'],$data['pickupcity_id'],$data['dropcity_id'],$data['pickup_date'],$data['pickup_time']);
                    $this->booking_localdetails_admin_sms($data['user_id'],$data['orderno'],$data['pickupcity_id'],$data['dropcity_id'],$data['pickup_date'],$data['pickup_time']);
                    $this->booking_confirm_sms($data['user_id'],$data['orderno']);
                 $localbookings = localbookings::create($data);

       return redirect()->route('localbookings.index')->with('success','Bookings created successfully');
    }

    public function edit($id)
    {
        $localbookings = localbookings::find($id);
        $pick_city  = Pickup::select('id as p_id','pick_city','status_delete')->where('status_delete','No')->get();
         $drop_city = Dropcity::select('id as d_id','drop_city','status_delete')->where('status_delete','No')->get();
         $user_data = User::select('id','name','email','user_mobile')->where('id',$localbookings->user_id)->first();
        return view('localbookings.edit',compact('localbookings','pick_city','drop_city','user_data'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'city'      => 'required|city|unique:dropcities,city',

        ]);
        // return $request;
         $localbookings = Localbookings::find(decrypt($id));
        $local_id = $localbookings->id;

            $arraydata = User::where('id',$localbookings->user_id)->update([
                                "name"     => $request->name,
                                'email' => $request->email,
                                'user_mobile'=>$request->user_mobie
                            ]);
        //   $request;
        //  $gross = $request->gross_total;
        // $dis = $request->discount;
        // $ex_charge =$request->extra_charge;
        //  $total_amount_count  = $gross-$dis+$ex_charge;

            $data = Localbookings::where('id',$local_id)->update([
                                "user_id"=> $localbookings->user_id,
                                'localdetail_id'=> $localbookings->localdetail_id,
                                'orderno'=>$localbookings->orderno,
                                'pickupcity_id'=>$request->pickupcity_id,
                                'dropcity_id'=>$request->dropcity_id,
                                'cab_type'=>$request->cab_type,
                                'flight_number'=>$request->flight_number,
                                'pickup_date'=>$request->pickup_date,
                                'pickup_time'=>$request->pickup_time,
                                'discount'=>$request->discount,
                                'extra_charge'=>$request->extra_charge,
                                'pickup_location'=>$request->pickup_location,
                                'drop_location'=>$request->drop_location,
                                'gross_total'=>$request->gross_total,
                                'total_amount'=>$request->total_amount,
                                'alternet_mobile'=>$request->alternet_mobile
                                ]);
        return redirect()->route('localbookings.index')
            ->with('success','Data Updated Successfully');
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

         $data = Localbookings::where('id',$id)->update([
            "status"     =>$nm1 ,
            "updated_at" =>$nowdate
           ]);

    }

    public function destroy($id)
    {
        Localbookings::find(decrypt($id))->delete();
        return redirect()->route('localbookings.index')
            ->with('success','Data deleted successfully');
    }
    public function deleteAll(Request $request)
    {

        $checkedcity_ids = $request->checkedcity_ids;

        LocalBookings::WhereIn('id',$checkedcity_ids)->update(['status_delete'=>'Yes']);
        return response()->json(['code'=>1,'msg'=>'You Selected Data Been Deleted successfully']);

    }
    public function user_check(Request $request) {
        $customer_mobile= $request->customer_mobile;
        $user_exist= User::select('user_mobile')->where('user_mobile',$customer_mobile)->get();
        $html = '';
		if(count($user_exist) >= 1) {
			 $user_id= User::select('users.*')->where('user_mobile',$customer_mobile)->get();

              $arr = array('0'=>$user_id[0]['id'],'1'=>$user_id[0]['name'],'2'=>$user_id[0]['email']);
              return $arr;
		} else {
			echo 0;
		}
	}
    public function getDropcity(Request $request){
        $pid  = $request->post('pid');

        $pickupcity = Pickup::select('id','pick_city')->where('id',$pid)->where('pickups.status_delete','No')->get();
        $pickupcity_id= $pickupcity[0]['pick_city'];
          $dropcity = Localdetails::select('dropcity','pcity_id','status_delete')->where('pcity_id',$pid)->where('status_delete','No')->get();


         $html='';
         $html.='<option value="select_drop">Select Drop City</option>';
          for($i=0;$i<count($dropcity);$i++){
              if($pickupcity_id != $dropcity[$i]['dropcity']){

                  $html.='<option value = '.$dropcity[$i]['dropcity'].'>'.$dropcity[$i]['dropcity'].'</option>';

              }
              else{
                  echo 0;
              }
          }
          echo $html;
     }
        public function updateDropcity(Request $request)
    {
        $pid  = $request->post('pid');
        $localbookings=Localbookings::all();
        $pickupcity = Pickup::select('id','pick_city','status_delete')->where('id',$pid)->where('status_delete','No')->get();
          $pick_city= $pickupcity[0]['pick_city'];
           $dropcity = Dropcity::select('id','drop_city','status_delete')->where('status_delete','No')->get();
           $html='';
            for($i=0;$i<count($dropcity);$i++){
                if($pick_city != $dropcity[$i]['drop_city']){

                    $html.='<option value = '.$dropcity[$i]['id'].'>'.$dropcity[$i]['drop_city'].'</option>';

                }
                else{
                    echo 0;
                }
            }
            echo $html;


    }
    public function getOrderNo()
	{
        $getOrderId =localbookings::select('id')->count();

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
    public function get_cab_type (Request $request)
    {
        $did  = $request->post('did');
        $cab_list = Localdetails::select('cab_type','dropcity')->where('dropcity',$did)->where('localdetails.status_delete','No')->where('localdetails.total_amount','!=',0)->distinct()->orderby('cab_order','asc')->get();
        //  $cab_list = Localdetails::select('cab_type','dropcity','pcity_id')->where('dropcity',$did)->get();
       	$html = '';
		$html.='<option value="select_cab">Select Cab</option>';
		for($i=0;$i<count($cab_list);$i++) {
            $cab = $cab_list[$i]['cab_type'];
            $cab_data = Cab_master::select('cab_masters.*')->where('cab_masters.id',$cab)->first();
			$html.='<option id="drop_option" value = '.$cab_list[$i]['cab_type'].'>'.$cab_data->cab.'</option>';

		}

		echo $html;

     }
     public function get_gross_total(Request $request) {
        $cid  = $request->post('cid');
        $pid  = $request->post('pid');
         $did  = $request->post('did');



          $html = Localdetails::select('total_amount')->where('pcity_id',$pid)->where('cab_type',$cid)->where('dropcity',$did)->first();
          $array = array('gross_total' => $html->total_amount);
          echo json_encode($array);

	}
    public function localwayorder (Request $request ,$id)
    {
        $orderno = $request->id;

             $result =	localbookings::select('users.name','users.email','users.user_mobile','pickups.pick_city','localbookings.*')
         ->join('users','users.id','localbookings.user_id')
         ->join( 'pickups','pickups.id','localbookings.pickupcity_id')
         ->where('localbookings.orderno',$orderno)
         ->first();

          $driver=localbookings::select('localbookings.driver_id','drivers.driver_name')->join('drivers','drivers.id','localbookings.driver_id')->where('localbookings.orderno',$orderno)->first();

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
        return view('localbookings.localwayorder',compact('result','s_request','flight_number','driver','status','b_status_color'));
    }


    public function check_cab(Request $request)
    {
         $value  = $request->post('value');
         $pcity_id  = $request->post('pcity_id');
       $dcity_id  = $request->post('dcity_id');
       $localdetails= Localdetails::select('pcity_id','dropcity')->where('pcity_id',$pcity_id)->where('dropcity',$dcity_id)->get();
       $htmls= "";
       for ($i=0; $i <count($localdetails); $i++) {

        if($localdetails[$i]['pcity_id'] == $pcity_id && $localdetails[$i]['dropcity'] == $dcity_id) {
            $htmls.='already exists';

        }
    }
    echo $htmls;

    }

    public function booking_localdetails_sms($user_id, $orderno, $pickupcity_id, $dropcity_id, $pickup_date, $pickup_time)
	{
		 $user_details = User::select('users.*')->where('id',$user_id)->get();
		$user_name = $user_details[0]['name'];
		$number    = $user_details[0]['user_mobile'];
        $pickupdate= date_format(date_create($pickup_date),'d-M-y');
        $pickcity = Pickup::select('pickups.*')->where('id',$pickupcity_id)->get();



        $message=urlencode('Dear '.$user_name.', Booking ID: '.$orderno.' From '.$pickcity[0]['pick_city'].' To '.$dropcity_id.' On '.$pickupdate.' At '.$pickup_time.' Has Been confirmed. For any update regarding booking call us on our helpline number +919054300083 or Login @ www.vahansewa.net Team MRSTXI');

        $DLT_TE_ID = '1207166081654342428';

        $url_a= helpers::get_sms_url();
        $a= $url_a->url;
		$url_b = str_replace('{number}',$number,$a);
		$url_c = str_replace('{message}',$message,$url_b);
		$url = str_replace('{DLT_TE_ID}',$DLT_TE_ID,$url_c);
		$msg_status=$this->run_urlOnwaycab($url);
		return true;
	}



    public function booking_localdetails_admin_sms($user_id, $orderno, $pickupcity_id, $dropcity_id, $pickup_date, $pickup_time)
	{

		 $user_details = User::select('users.*')->where('id',$user_id)->get();
		 $user_name = $user_details[0]['name'];
		 $m_number  = $user_details[0]['user_mobile'];
         $pickupdate= date_format(date_create($pickup_date),'d-M-y');
          $pickcity = Pickup::select('pickups.*')->where('id',$pickupcity_id)->get();


           $message = urlencode($user_name.', Booking ID '.$orderno.' From '.$pickcity[0]['pick_city'].' To '.$dropcity_id.' On ' .$pickupdate.' At '.$pickup_time. ' has been confirmed. www.vahansewa.net Team MRSTXI');

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

		$book_cab = Localbookings::select('localbookings.*')->where('id',$id)->where('status',1)->get();
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

    protected function generate_pdf_invoice_mail($id)
	{

           $book_cab = Localbookings::select('localbookings.*')->where('id',$id)->get();

           $user_details = User::select('users.*')->where('id',$book_cab[0]['user_id'])->get();

            $pickupcity    = Pickup::select('pickups.*')->where('id',$book_cab[0]['pickupcity_id'])->get();

            // return	$dropcity  =Dropcity::select('dropcities.*')->where('id',$book_cab[0]['dropcity_id'])->get();

		  $one_way_cab  = Localdetails::select('localdetails.*')->where('id',$book_cab[0]['localdetail_id'])->where('status',1)->get();

		// $pickdate = date_format(date_create($book_cab[0]['pick_date']),'d-m-Y');
		// $bookon = date_format(date_create($book_cab[0]['create_date']),'d-m-Y');
		$CGST = $one_way_cab[0]['gst'] / 2;
		$SGST = $one_way_cab[0]['gst'] / 2;



		 if($one_way_cab[0]['tax'] != 'Include') {
	              $tall_tax = 'Rs. '.$one_way_cab[0]['tax'].'/-';
	        } else {
	        	$tall_tax = 'Rs. 0/-';
	        }

	        if($one_way_cab[0]['state_tax'] != 'Include') {
	              $state_tax = 'Rs. '.$one_way_cab[0]['state_tax'].'/-';
	        } else {
	        	$state_tax = 'Rs. 0/-';
	        }

	        if($one_way_cab[0]['driver_allowance'] != 'Include') {
	              $driver_allowance = 'Rs. '.$one_way_cab[0]['driver_allowance'].'/-';
	        } else {
	        	$driver_allowance = 'Rs. 0/-';
	        }

	        $sender_mail   = $user_details[0]['email'];
	        $name  	 	   = $user_details[0]['name'];
            $pickdate = date_format(date_create($book_cab[0]['pickup_date']),'d-m-Y');
		$bookon = date_format(date_create($book_cab[0]['created_at']),'d-m-Y');
	        $subject       = 'Booking Confirmation';

	        //  $pdf = PDF::loadView('onewaybookings.invoice',compact('subject','name','sender_mail','SGST','book_cab','pickupcity','dropcity','one_way_cab','CGST','user_details'))->setPaper('a4', 'landscape');
            // $filename = $book_cab[0]['orderno'];
            // $filepath = storage_path('close_duty_pdf/'. $filename .'.pdf') ;
            // $pdf->save($filepath . '/' . 'dhaval');

            $pdf = PDF::loadView('localbookings.invoice',compact('subject','bookon','pickdate','name','sender_mail','SGST','book_cab','pickupcity','one_way_cab','CGST','user_details'));
            $path = public_path('localclose_duty/');
            $fileName =$book_cab[0]['orderno']. '.' . 'pdf';
            $pdf->save($path . '/' . $fileName);

            return $fileName;

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
