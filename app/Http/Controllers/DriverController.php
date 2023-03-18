<?php

namespace App\Http\Controllers;

use App\Driver;
use App\User;
use App\Pickup;
use App\Onewaydetails;
use App\Localbookings;
use App\Onewaybookings;
use Illuminate\Http\Request;
use App\Multicitybookings;
use App\Multicitycabs;
use App\Multicityprices;
use App\Multy_bookings;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role; 
use DataTables;
use Helpers;
use DB;


class DriverController extends Controller
{
      public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Driver::select('drivers.*')
                            ->orderBy('id', 'desc')
                            ->where('drivers.status_delete','No')
                            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                 })

                ->addColumn('action', function($row){
                    if($row->status == "1")
                    {
                        return '<div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Active</button>
                        <div class="dropdown-menu">
                            <li>
                                <a class="dropdown-item status_change" href="'.url('admin/driver_details/status_change/'.$row->id).'">Inactive</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="'.url('admin/driver_details/edit',$row->id).'">Edit</a>
                            </li>

                        </div>
                    </div>';
                    }
                    else{
                        return '<div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Inactive</button>
                        <div class="dropdown-menu">
                            <li>
                                <a class="dropdown-item status_active" href="'.url('admin/driver_details/status_active/'.$row->id).'">Active</a>
                            </li>


                        </div>
                    </div>';
                    }
                })

                ->addColumn('vendor_name', function($row){
                    $vendor_name = $row->vendor_name;
                    if (!empty($vendor_name)) {
                    return '<label>'.ucwords($vendor_name).'</label>&nbsp';
                    } else {
                        return '<label>-</label>';
                    }
                })
                ->addColumn('driver_name', function($row){
                    $driver_name = $row->driver_name;
                    if (!empty($driver_name)) {
                    return '<label>'.ucwords($driver_name).'</label>&nbsp';
                    } else {
                        return '<label>-</label>';
                    }
                })
                ->addColumn('cab_name', function($row){
                    $cab_name = $row->cab_name;
                    if (!empty($cab_name)) {
                    return '<label>'.ucwords($cab_name).'</label>&nbsp';
                    } else {
                        return '<label>-</label>';
                    }
                })
                ->addColumn('total_customer', function($row){
                     $getTotalCustomerForDriver = $this->getTotalCustomerForDriver($row->id);
                    if($getTotalCustomerForDriver > 0) {
                           return '<a href="'.url('admin/driver_details/driver_customer/'.$row->id).'">'.$getTotalCustomerForDriver.'</a>';

                    } else {
                        return '-';
                    }
                })
                ->addColumn('created_at',function($row){

                    return $row->created_at->format('d-m-Y h:i:a');
                })
                ->rawColumns(['action','vendor_name','driver_name','cab_name','checkbox','total_customer'])
                ->make(true);
        }
        $data['meta_title'] = "Add Driver";
        return view('driver.index',$data);
    }
    public function status_change(Request $request)
    {

         $checkedcity_ids = $request->id;

         Driver::Where('id',$checkedcity_ids)->update(['status'=>'0']);
        //  return redirect()->route('multy_bookings.index')->with('success','Bookings Canceled Successfully !');

    }
    public function status_active(Request $request)
    {
        $checkedcity_ids = $request->id;

         Driver::Where('id',$checkedcity_ids)->update(['status'=>'1']);
        //  return redirect()->route('multy_bookings.index')->with('success','Bookings Canceled Successfully !');

    }
    public function create()
    {

        $data['meta_title'] = "Add Drive ";
        return view('driver.create',$data);
    }
     public function store(Request $request)
    {
        $this->validate($request, [
            'vendor_name'=>'required',
            'driver_name'=> 'required',
            'cab_name'  => 'required',
            'cab_number' =>'required',
            'driver_mobile' => 'required|numeric|digits:10|unique:drivers,driver_mobile|',

        ]);

        $input = $request->all();
        $driver = Driver::create($input);
        return redirect()->route('driver.index')
            ->with('success','Driver created successfully');
    }

    // Driver Add & Automatic Assign Oneway Driver

    public function driver_assign(Request $request,$id){
       $oneway_id = $request->id;
        return view('driver.assign',compact('oneway_id'));
    } 

    public function driver_oneway(Request $request){
        // return $request;
        $this->validate($request, [
            'vendor_name'=>'required',
            'driver_name'=> 'required',
            'cab_name'  => 'required',
            'cab_number' =>'required',
            'driver_mobile' => 'required|numeric|digits:10|unique:drivers,driver_mobile|',

        ]);
        $arraydata = Driver::create([
            'vendor_name' => $request->vendor_name,
            'driver_name' => $request->driver_name,
            'driver_mobile'=>$request->driver_mobile,
            'cab_name'=>$request->cab_name,
            'cab_number'=>$request->cab_number
          ]);
          $driver_id =  $arraydata->id;
          $driver_name = $arraydata->driver_name;
                $vendor_name = $arraydata->vendor_name;
                $driver_mobile = $arraydata->driver_mobile;
                $cab_name = $arraydata->cab_name;
                $cab_number = $arraydata->cab_number;
          $data =  Multy_bookings::where('id',$request->oneway_id)->update([
                        'id'=>$request->oneway_id,
                        'driver_id' => $driver_id,
                        'driver_name'=>$driver_name,
                        'vendor_name'=>$vendor_name,
                        'driver_mobile'=>$driver_mobile,
                        'cab_name'=>$cab_name,
                        'cab_number'=>$cab_number,
                    ]);
                      $this->sms_todriver($arraydata->id,$request->oneway_id);
            $this->sms_toclient($arraydata->id,$request->oneway_id);
            return redirect()->route('multy_bookings.index')
                    ->with('success','Driver Assign successfully');
    }

// Driver Add & Automatic Assign Local Driver

  
    public function edit($id)
    {
        $driver = Driver::find($id);
        return view('driver.edit',compact('driver'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'vendor_name'=>'required',
            'driver_name'=> 'required',
            'cab_name'  => 'required',
            'cab_number' =>'required',
            'driver_mobile' => 'required|numeric|digits:10|',

        ]);

        $input = $request->all();
        $driver = Driver::find(decrypt($id));
        $driver->update($input);

         $arraydata = Multy_bookings::where('driver_id',$driver->id)->update([
            'driver_name'=>$request->driver_name,
            'vendor_name'=>$request->vendor_name,
            'driver_mobile'=>$request->driver_mobile,
            'cab_name'=>$request->cab_name,
            'cab_number'=>$request->cab_number,
           ]);


        return redirect()->route('driver.index')
            ->with('success','Driver Details  updated successfully');
    }
    public function destroy($id)
    {
        Driver::find(decrypt($id))->delete();
        return redirect()->route('driver.index')
            ->with('success','driver deleted successfully');
    }
    public function deleteAll(Request $request)
    {
        $checkedcity_ids = $request->checkedcity_ids;
        Driver::WhereIn('id',$checkedcity_ids)->delete();
        return response()->json(['code'=>1,'msg'=>'Yor Selected Data hava Been Deleted successfully']);

    }
    public function select(Request $request,$id)
    {

         $data = Driver::select('drivers.*')
        ->orderBy('id', 'desc')
        ->where('status_delete','No')
        ->where('status','1')
        ->get();
        $onewayid = $id;

          $selected = Multy_bookings::select('multy_bookings.driver_id')->join('drivers','drivers.id','multy_bookings.driver_id')->where('multy_bookings.id',$onewayid)->first();
        return view('driver.select',compact('data','onewayid'));
    }

    public function localselect(Request $request,$id)
    {
        $data = Driver::select('drivers.*')
        ->orderBy('id', 'desc')
        ->where('status_delete','No')
        ->where('status','1')
        ->get();
        $localid = $id;
        return view('driver.localselect',compact('data','localid'));
    }



    public function multyselect(Request $request,$id)
    {
        $data = Driver::select('drivers.*')
        ->orderBy('id', 'desc')
        ->where('status_delete','No')
        ->where('status','1')
        ->get();
        $multyid = $id;
        return view('driver.multyselect',compact('data','multyid'));
    }
    public function dataselect(Request $request)
    {
         $driver_id = $request->driverselect;
        $oneway_id = $request->onewayid;
          $driver_name= Driver::select('drivers.*')->where('id',$driver_id)->first();
         $drivername=$driver_name->driver_name;
         $data=array(
        'oneway_id'=>$oneway_id,
        'driver_id'=> $driver_id,
        'driver_name'=> $drivername,
        'vendor_name'=>$driver_name->vendor_name,
        'driver_mobile'=>$driver_name->driver_mobile,
        'cab_name'=>$driver_name->cab_name,
        'cab_number'=>$driver_name->cab_number,
            );

         $arraydata = Multy_bookings::where('id',$oneway_id)->update([
            'driver_id' => $driver_id,
            'id'=>$oneway_id,
            'driver_name'=>$drivername,
            'vendor_name'=>$driver_name->vendor_name,
            'driver_mobile'=>$driver_name->driver_mobile,
            'cab_name'=>$driver_name->cab_name,
            'cab_number'=>$driver_name->cab_number,
           ]);

           echo json_encode($arraydata);
              $this->sms_todriver($data['driver_id'],$data['oneway_id']);
            $this->sms_toclient($data['driver_id'],$data['oneway_id']);




    }

    public function sms_todriver($driver_id,$oneway_id)
    {
        // return "Dhaval";
        // return $oneway_id;
           $book_cab_details=Multy_bookings::select('multy_bookings.*')->where('id',$oneway_id)->get();
        $orderno         = $book_cab_details[0]['orderno'];
        $city_data = $book_cab_details[0]['pickupcity_id'];
          $pick_city =Pickup::select('pickups.pick_city')->where('pickups.id',$city_data)->first();
         $pickup = $pick_city->pick_city;
         
         $pick_address    = $book_cab_details[0]['pickup_location'];

        $pick_time       = $book_cab_details[0]['pickup_time'];
        $pick_date       = $book_cab_details[0]['pickup_date'];
        $pickupdate= date_format(date_create($pick_date),'d-M-y');
        $userdetail_id   = $book_cab_details[0]['user_id'];

      $user_details    = User::select('users.*')->where('id',$userdetail_id)->get();
        $username        = $user_details[0]['name'];
        $user_mobile     = $user_details[0]['user_mobile'];

       $driver_details  = Driver::select('drivers.*')->where('id',$driver_id)->get();
      $dr_name 		 = $driver_details[0]['driver_name'];
      $number          = $driver_details[0]['driver_mobile'];

        $message=urlencode('Dear '.$dr_name.', cab for Booking ID '.$orderno.' pickup From '.$pickup.' At '.$pick_time.' On Date '.$pickupdate.' has been assigned to you. '.$username.' customer mobile: '.$user_mobile.' Regards. www.cabbookkaro.com +919909151547 Team MRSTXI');
       $DLT_TE_ID = '1207166081664819035';

      $url_a= helpers::get_sms_url();
      $a= $url_a->url;
      $url_b = str_replace('{number}',$number,$a);
      $url_c = str_replace('{message}',$message,$url_b);
      $url = str_replace('{DLT_TE_ID}',$DLT_TE_ID,$url_c);
      $msg_status=$this->run_urlOnwaycab($url);
      return true;

    }

  public function sms_toclient($driver_id,$oneway_id)
	{

        $book_cab_details=Multy_bookings::select('multy_bookings.*')->where('id',$oneway_id)->get();
        $orderno         = $book_cab_details[0]['orderno'];
        $pick_address    = $book_cab_details[0]['pickup_location'];
        $pick_time       = $book_cab_details[0]['pickup_time'];
        $pick_date       = $book_cab_details[0]['pickup_date'];
        $pickupdate= date_format(date_create($pick_date),'d-M-y');
        $userdetail_id   = $book_cab_details[0]['user_id'];

		$user_details    = User::select('users.*')->where('id',$userdetail_id)->get();
        $username        = $user_details[0]['name'];
        $number     	 = $user_details[0]['user_mobile'];

        $driver_details  = Driver::select('drivers.*')->where('id',$driver_id)->get();
		$dr_name 		 = $driver_details[0]['driver_name'];
		$dr_phone        = $driver_details[0]['driver_mobile'];
		$dr_cabname      = $driver_details[0]['cab_name'];
		$dr_cabnumber    = $driver_details[0]['cab_number'];

		$message=urlencode('Dear '.$username.' cab for booking ID '.$orderno.' for pick up at '.$pick_time.' on date '.$pickupdate.' has been assigned. driver '.$dr_name.' will be picking you up in cab '.$dr_cabname.' cab number '.$dr_cabnumber.', driver mobile : '.$dr_phone.' Regards. www.cabbookkaro.com +919909151547 Team MRSTXI');
		$DLT_TE_ID = '1207166081668286005';

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
  function getTotalCustomerForDriver($driverId)
  {
    // return $driverId;
     $getBookCustData = Multy_bookings::select('multy_bookings.*')->where('driver_id',$driverId)->get();

      return count($getBookCustData);
  }
  public function driver_customer(Request $request,$id){

     $driver_name = Driver::select('drivers.*')->where('id',$id)->first();

     
        $data = Multy_bookings::select('multy_bookings.*','pickups.pick_city')
                                ->join('pickups','pickups.id','multy_bookings.pickupcity_id')
                                
                                ->where('driver_id',$id)
                                ->get();
         return view('driver.driver_customer',compact('data','driver_name'));
  }


}
