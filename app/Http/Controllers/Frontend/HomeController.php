<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\inquries;
use App\Pickup;
use App\Dropcity;
use App\Testimonial;
use App\Onewaybookings;
use App\Onewaydetails;
use App\Localdetails;
use App\Driver;
use App\Admin;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use DB;
use Helpers;

class HomeController extends Controller
{

    public function index(Request $request )
    {
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);

        $dk = "Dhaval Thumar"; 

        $testimonial = Testimonial::select('name','profile','message','status_delete')->where('status_delete','No')->get();
        $pickupcity_id_demo   = Pickup::select('pick_city','id')->orderBy('pick_city')->where('status_delete','No')->where('status',1)->get();
         $pickupcity_id = $pickupcity_id_demo->pluck('pick_city','id')->all();

        //  $pickupcity_id_round   = Pickup::select('pick_city','id')->orderBy('pick_city')->where('status_delete','No')->where('status',1)->get();
        // $pickupcity_round = $pickupcity_id_round->pluck('pick_city','id')->all();

         $dropcity_id_demo  = Dropcity::select('drop_city','id')->orderby('drop_city')->where('status_delete','No')->where('status',1)->get();
            $dropcity_id =  $dropcity_id_demo->pluck('drop_city','id')->all();
        $localcity  =   Localdetails::select('localdetails.*')->get();
       $local_id = Localdetails::select('pcity_id','pickups.pick_city')->join('pickups','pickups.id','localdetails.pcity_id')->distinct()->get();
       $localcity_id = $local_id->pluck('pick_city','pcity_id')->all();
       $localcity  =   Localdetails::select('localdetails.*')->where('status_delete','No')->get();
       $onewaycity  =   Onewaydetails::select('onewaydetails.*')->where('status_delete','No')->get();
        $user_id  =user::pluck('id as u_id')->all();
       
         $Ahmedabad = Onewaydetails::select('onewaydetails.dcity_id','onewaydetails.total_amount','onewaydetails.time','onewaydetails.km','dropcities.drop_city','dropcities.id as d_id','pickups.pick_city','pickups.id as p_id')
        ->join('dropcities','dropcities.id','onewaydetails.dcity_id')
        ->join('pickups','pickups.id','onewaydetails.pcity_id')
        ->where('onewaydetails.pcity_id',1)
        ->where('onewaydetails.status_delete','No')
        ->where('onewaydetails.popular_routes','Yes')
        ->groupby('onewaydetails.dcity_id')
        ->distinct()
        ->limit(12)
        ->get();
        $Surat = Onewaydetails::select('onewaydetails.dcity_id','onewaydetails.total_amount','onewaydetails.time','onewaydetails.km','dropcities.drop_city','dropcities.id as d_id','pickups.pick_city','pickups.id as p_id')
        ->join('dropcities','dropcities.id','onewaydetails.dcity_id')
        ->join('pickups','pickups.id','onewaydetails.pcity_id')
        ->where('onewaydetails.pcity_id',2)
        ->where('onewaydetails.status_delete','No')
        ->where('onewaydetails.popular_routes','Yes')
        ->groupby('onewaydetails.dcity_id')
        ->distinct()
        ->limit(12)
        ->get();
             $Mumbai = Onewaydetails::select('onewaydetails.dcity_id','onewaydetails.total_amount','onewaydetails.time','onewaydetails.km','dropcities.drop_city','dropcities.id as d_id','pickups.pick_city','pickups.id as p_id')
        ->join('dropcities','dropcities.id','onewaydetails.dcity_id')
        ->join('pickups','pickups.id','onewaydetails.pcity_id')
        ->where('onewaydetails.pcity_id',3)
        ->where('onewaydetails.status_delete','No')
        ->where('onewaydetails.popular_routes','Yes')
        ->groupby('onewaydetails.dcity_id')
        ->distinct()
        ->limit(12)
        ->get();

         $Rajkot = Onewaydetails::select('onewaydetails.dcity_id','onewaydetails.total_amount','onewaydetails.time','onewaydetails.km','dropcities.drop_city','dropcities.id as d_id','pickups.pick_city','pickups.id as p_id')
        ->join('dropcities','dropcities.id','onewaydetails.dcity_id')
        ->join('pickups','pickups.id','onewaydetails.pcity_id')
        ->where('onewaydetails.pcity_id',4)
        ->where('onewaydetails.status_delete','No')
        ->where('onewaydetails.popular_routes','Yes')
        ->groupby('onewaydetails.dcity_id')
        ->distinct()
        ->limit(12)
        ->get();

    

        $Vadodara = Onewaydetails::select('onewaydetails.dcity_id','onewaydetails.total_amount','onewaydetails.time','onewaydetails.km','dropcities.drop_city','dropcities.id as d_id','pickups.pick_city','pickups.id as p_id')
        ->join('dropcities','dropcities.id','onewaydetails.dcity_id')
        ->join('pickups','pickups.id','onewaydetails.pcity_id')
        ->where('onewaydetails.pcity_id',5)
        ->where('onewaydetails.status_delete','No')
        ->where('onewaydetails.popular_routes','Yes')
        ->groupby('onewaydetails.dcity_id')
        ->distinct()
        ->limit(10)
        ->get();
        
        $Pune = Onewaydetails::select('onewaydetails.dcity_id','onewaydetails.total_amount','onewaydetails.time','onewaydetails.km','dropcities.drop_city','dropcities.id as d_id','pickups.pick_city','pickups.id as p_id')
        ->join('dropcities','dropcities.id','onewaydetails.dcity_id')
        ->join('pickups','pickups.id','onewaydetails.pcity_id')
        ->where('onewaydetails.pcity_id',6)
        ->where('onewaydetails.status_delete','No')
        ->where('onewaydetails.popular_routes','Yes')
        ->groupby('onewaydetails.dcity_id')
        ->distinct()
        ->limit(10)
        ->get();

        return view('frontend.home',compact('pickupcity_id','dropcity_id','localcity',
                                            'onewaycity','Ahmedabad','Mumbai','Surat',
                                            'Rajkot','testimonial','localcity_id','Vadodara','Pune'));


    }
    public function localcity(Request $request )
    {
            $pickupcity_id  = Pickup::pluck('pick_city','id')->where('pickups.status_delete','No')->all();
            $user_id  =user::pluck('id as u_id')->where('users.status_delete','No')->all();

            return view('frontend.home',compact('pickupcity_id','user_id'));


    }
    public function onewaygetDropcity(Request $request){
        $pid  = $request->post('pid'); 

        $pickupcity = Pickup::select('id','pick_city')->where('id',$pid)->where('pickups.status_delete','No')->get();
        $pickupcity_id= $pickupcity[0]['pick_city'];
         $dropcity = Onewaydetails::select('dcity_id','pcity_id','dropcities.*')->join('dropcities','dropcities.id','onewaydetails.dcity_id')->distinct()->where('pcity_id',$pid)->where('dropcities.status_delete','No')->where('onewaydetails.status_delete','No')->orderby('drop_city')->get();
         $html='';
         $html.='

         <option value=>Select Drop City</option>';
          for($i=0;$i<count($dropcity);$i++){
              if($pickupcity_id != $dropcity[$i]['drop_city']){

                  $html.='<option value = '.$dropcity[$i]['id'].'>'.$dropcity[$i]['drop_city'].'</option>';

              }
              else{
                  echo 0;
              }
          }
          echo $html;
    }
    public function getlocalPackage(Request $request){
        $pickupid  = $request->post('pickupid');


         $localPackage = Localdetails::select('dropcity','local_packages.*')->join('local_packages','localdetails.dropcity','local_packages.id')->distinct()->where('localdetails.pcity_id',$pickupid)->get();
        $html = '';
		$html.='<option value="">Select Package</option>';
		for($i=0;$i<count($localPackage);$i++) {
			$html.='<option value = '.$localPackage[$i]['id'].'>'.$localPackage[$i]['local_package'].'</option>';
		}
		echo $html;
    }


    public function enquiry(Request $request)
    {

        $input = $request->all();
        $enquiry = inquries::create($input);
        return redirect()->route('home.index')
            ->with('success','Cupon updated successfully');
    }

    public function getcitydata(Request $request)
    {
        $cid  = $request->post('cid');
        $pid  = $request->post('pid');
        $did  = $request->post('did');

        $gross_total = Onewaydetails::select('total_amount')->where('pcity_id',$pid)->where('dcity_id',$did)->where('cab_type',$cid)->where('onewaydetails.status_delete','No')->get();
        $html = '';

		for($i=0;$i<count($gross_total);$i++) {
			$html.='<option id="drop_option" value = '.$gross_total[$i]['total_amount'].'>'.$gross_total[$i]['total_amount'].'</option>';

		}

		echo $html;

	}
    public function policy()
    {
        return view('frontend.policy.policy');
    }

      public function book_cab()
    {
        return view('frontend.about.book_cab');
    }
      public function service()
    {
        return view('frontend.about.service');
    }
   public function booking_confirm()
    {
        return view('frontend.about.booking_confirm');
    }

    public function onewayform(Request $request)
    {

        if($request->hello==''){
            $pickup   = $request->pickup_location['0'];
            $drop = $request->drop_location['0'];
            Onewaybookings::create([
                'name' =>$request->name,
                'phone' => $request->phone,
                'alt_number'=> $request->alt_number,
                'pickup_location' => $pickup,
                'drop_location' => $drop,
                'cab_type' => $request->cab_type,
                'pickup_date'=>$request->pickup_date,
                'pickup_time' => $request->pickup_time,
            ]);
                $details = ['name'=>$request->name,'email'=>$request->alt_number,'number'=>$request->phone,'pickup_location'=>$pickup,'drop_location'=>$drop,'cab_type'=>$request->cab_type,'pickup_date'=>$request->date,'pickup_time'=>$request->pickup_time,];

            //   $mail_to = 'dhavalthumar505@gmail.com';
            //   \Mail::to($mail_to)->send(new \App\Mail\MyTestMail($details));

            return redirect()->route('home.index')
                ->with('success','Booking created successfully');
        }else{

            Onewaybookings::create([
                'name' =>$request->name,
                'phone' => $request->phone,
                'alt_number'=> $request->alt_number,
                'pickup_location' => $request->pickup_location_data,
                'drop_location' => $request->drop_location_data,
                'cab_type' => $request->cab_type,
                'pickup_date'=>$request->pickup_date,
                'pickup_time' => $request->pickup_time,
            ]);
            $details = ['name'=>$request->name,'email'=>$request->alt_number,'number'=>$request->phone,'pickup_location'=>$request->pickup_location_data,'drop_location'=>$request->drop_location_data,'cab_type'=>$request->cab_type,'pickup_date'=>$request->date,'pickup_time'=>$request->pickup_time,];

            // $mail_to = 'dhavalthumar505@gmail.com';
            // \Mail::to($mail_to)->send(new \App\Mail\MyTestMail($details));
            return redirect()->route('home.index')
                ->with('success','Booking created successfully');
        }


    }


}
