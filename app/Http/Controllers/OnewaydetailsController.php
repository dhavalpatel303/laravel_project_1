<?php

namespace App\Http\Controllers;

use App\Cab_master;
use App\Pickup;
use App\Dropcity;
use App\Increase_rates;
use App\Onewaydetails;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use DB;


class OnewaydetailsController extends Controller
{
      public function index(Request $request)
    {

        if($request->session('danger')){
            $danger =  "danger";
        }
        else{
            $danger =  " ";
        }
        $data = Onewaydetails::select('onewaydetails.*','pickups.pick_city','dropcities.drop_city','cab_masters.cab')
        ->join( 'pickups','pickups.id','onewaydetails.pcity_id')
        ->join( 'dropcities','dropcities.id','onewaydetails.dcity_id')
        ->join( 'cab_masters','cab_masters.id','onewaydetails.cab_type')
        ->where('cab_status',1)
        ->where('onewaydetails.amount','!=',0)
        ->where('onewaydetails.status_delete','No')
        ->orderby('onewaydetails.id','desc')
        ->get();

        if ($request->ajax()) {
            $data = Onewaydetails::select('onewaydetails.*','pickups.pick_city','dropcities.drop_city','cab_masters.cab')
            ->join( 'pickups','pickups.id','onewaydetails.pcity_id')
            ->join( 'dropcities','dropcities.id','onewaydetails.dcity_id')
            ->join( 'cab_masters','cab_masters.id','onewaydetails.cab_type')
            ->where('cab_status',1)
            ->where('onewaydetails.status_delete','No')
            ->orderby('onewaydetails.id','desc')
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                 })

                ->addColumn('action', function($row){

                              $html = '<a  href="'. route('onewaydetails.edit', ['pick_city' => $row->pick_city,'drop_city'=>$row->drop_city]).'" class="btn btn-info card-title"><i class=" fas fa-pencil-alt"></i></a>';

                    return $html;
                })
                // ->addColumn('add_cab', function($row){
                //     $html =  '<a class="btn btn-icon btn-outline-primary" href="'. route('add_cab').'" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                //              ';

                //     return $html;
                // })

                ->addColumn('created_at',function($row){

                    return $row->created_at->format('d-m-Y');
                })

                ->addColumn('status',function($row){
                    if($row->status==1){
                        $currentst='Active';
                        $nm='Inactive';
                        $btn="btn-success";

                    }else{
                        $currentst='Inactive';
                        $nm='Active';
                        $btn="btn-danger";


                    }

                        return '<a href="'.url('admin/onewaydetails/changestatus/'.$nm.'/'.$row->id).'" class="statuschange"><button  class="btn '.$btn.' me-1 waves-effect waves-float waves-light">'.$currentst.'</button></a>';

                })
                ->addColumn('alltax',function($row){
                   if($row->tax !=''){
                    $tall_tax = $row->tax;
                   }
                   else{
                    $tall_tax = '0';
                   }
                   if($row->state_tax !=''){
                    $state_tax = $row->state_tax;
                   }
                   else{
                    $state_tax = '0';
                   }
                   if($row->driver_allowance !=''){
                    $driver = $row->driver_allowance;
                   }
                   else{
                    $driver = '0';
                   }
                   if($row->gst !=''){
                    $gst = $row->gst;
                   }
                   else{
                    $gst = '0';
                   }
                    $km = $row->km;
                    // $state_tax = $row->state_tax;
                    // $driver =  $row->driver_allowance;
                    // $km = $row->km;


                        return '<a class="font">Toll Tax</a> : <span> '.$tall_tax.'</span>
                        <br><a class="font">State Tax </a> : <span>'.$state_tax.'</span>';


                })
                ->addColumn('fare_rate',function($row){
                    if($row->km_rate !=''){
                     $km_rate = $row->km_rate;
                    }
                    else{
                     $km_rate = '0';
                    }
                    if($row->km !=''){
                     $total_km = $row->km;
                    }
                    else{
                     $total_km = '0';
                    }
                    if($row->driver_allowance !=''){
                     $driver = $row->driver_allowance;
                    }
                    else{
                     $driver = '0';
                    }

                     // $state_tax = $row->state_tax;
                     // $driver =  $row->driver_allowance;
                     // $km = $row->km;
 

                         return '<a class="font">Fare Km</a> :  <span><i class="fa fa-inr"></i> '.$km_rate.'/-</span>
                         <br><a class="font">Min Km  </a> : <span>'.$total_km.'Km</span>
                         <br><a class="font">Allowance</a>   :<span><i class="fa fa-inr"></i> '.$driver.'/-</span>';



                 })

                ->addColumn('km_rate',function($row){
                    $km_rate = $row->km_rate;
                    if($row->km_rate==Null){
                         return '<label>-</label>';
                    }else{
                        return '<label>Rs.'.$km_rate.'/Km</label>';
                    }

                })

                ->addColumn('amount',function($row){
                    $amount = $row->amount;
                    if($row->amount==Null){
                         return '<label style="font-size:16px"><a>0</a></label>';
                    }else{
                        return '<label style="font-size:16px"><i class="fa fa-inr"></i> '.$amount.'/-</label>';
                    }

                })
                ->addColumn('total_amount',function($row){
                    $amount = $row->amount;
                    $tax = $row->tax;
                    $state_tax = $row->state_tax;
                    $driver = $row->driver_allowance;

                     $total_amount = $amount+$tax+$state_tax+$driver;

                    if($row->total_amount==Null){
                         return '<label class="label-primary"><a class="font">0</a></label>';
                    }else{
                        return '<label class="label-primary"><a class="font"></a>'.$total_amount.'</label>';
                    }

                })
                ->addColumn('popular_routes',function($row){
                    $route = $row->popular_routes;
                    if($route == 'Yes'){
                        return '<label class="label-success">Yes</label>';
                    }else{
                        return '<label class="label-danger">No</label>';
                    }



                })
                ->addColumn('extra',function($row){
                    $from = $row->pick_city;
                    $to = $row->drop_city;
                    return '<label style="font-size:14px;"><b>From : </b>'.$from.'</label> <br>
                    <label style="font-size:14px;"><b>To : </b>'.$to.'</label>';

                })
                ->setRowAttr([
                    'style' => function($row){
                        return $row->status==0 ? 'background-color: #fbdddd;border-bottom:1px solid #c1c1c1' : 'border-bottom:1px solid #c1c1c1';
                    }
                ])
                ->addColumn('cab_type',function($row){
                $type =$row->cab;

                    return '<label><a class="font fsize"> '.$row->cab.'</a ></i></label>';



                })
                ->rawColumns(['action','add_cab','extra','fare_rate','cab_type','status','alltax','driver_allowance','popular_routes','checkbox','amount','total_amount','km','km_rate','single','danger'])
                ->make(true);
        }
        return view('onewaydetails.index');
    }
    public function create()
    {
         $pick_city1  = Pickup::select('status_delete','pick_city','id')->where('status_delete','No')->orderby('pick_city')->get();
         $drop_city1  = Dropcity::select('status_delete','drop_city','id')->where('status_delete','No')->orderby('drop_city')->get();
         $cab_data = Cab_master::select('cab_masters.*')->get();
         $pick_city = $pick_city1->pluck('pick_city','id')->all();
         $drop_city = $drop_city1->pluck('drop_city','id')->all();
        return view('onewaydetails.create',compact('pick_city','cab_data','drop_city'));
    }
    public function single_create($pick_city,$drop_city)
    {
        $pcity_id = Pickup::select('id','pick_city')->where('pick_city',$pick_city)->first();
        $dcity_id = Dropcity::select('id','drop_city')->where('drop_city',$drop_city)->first();
         $pick_city1  = Pickup::select('status_delete','pick_city','id')->where('status_delete','No')->orderby('pick_city')->get();
         $pick_city = $pick_city1->pluck('pick_city','id')->all();
        //  $onewaydetails = onewaydetails::select('onewaydetails.*')->where('pcity_id',$pcity_id->id)->where('dcity_id',$dcity_id->id)->get();
         $onewaydetails_km = onewaydetails::select('onewaydetails.*')->where('pcity_id',$pcity_id->id)->where('dcity_id',$dcity_id->id)->first();
         return   $onewaydetails = onewaydetails::select('onewaydetails.*','cab_masters.cab')->join('cab_masters','cab_masters.id','onewaydetails.cab_type')->where('pcity_id',$pcity_id->id)->where('dcity_id',$dcity_id->id)->orderby('car_order','asc')->get();
           $cab_data = Cab_master::select('cab_masters.*')->where('status',1)->get();


         $total_km = $onewaydetails_km->km;
        return view('onewaydetails.single',compact('onewaydetails','pick_city','drop_city','pcity_id','dcity_id','total_km','onewaydetails_km','cab_data'));
    }
    public function getDropcity(Request $request){
          $pid  = $request->post('pid');

          $pickupcity = Pickup::select('id','pick_city')->where('id',$pid)->where('pickups.status_delete','No')->get();
          $pick_city= $pickupcity[0]['pick_city'];
           $dropcity = Dropcity::select('id','drop_city')->where('dropcities.status_delete','No')->orderby('drop_city')->get();

           $html='<option>Select Drop City</option>';
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

    public function changestatus($nm,$id)
    {



        if($nm == "Inactive"){
            $nm1 = 0;
        }else{
            $nm1 = 1;
        }

        $nowdate = date('Y-m-d H:i:s');

          $data = Onewaydetails::where('id',$id)->update([
            "status"     =>$nm1 ,
            "updated_at" =>$nowdate
           ]);

        // //   Onewaydetails::where('id',$id)->update(['status'=>$status]);
        //   return redirect()->route('onewaydetails.index')
        //      ->with('success','Status Updated Successfully');
    }
  public function store(Request $request)

    {
        // return $request;
            if($request->km != '')
            {


                        $cab_type = $request->cab_type;
                        $oneway_id = $request->rate_card_id;
                        $amount = $request->amount;

                        $tax = $request->tax;
                        $pop = $request->popular_routes;
                        $km_rate = $request->km_rate;
                        $state_tax = $request->state_tax;
                        $driver_allowance = $request->driver_allowance;
                        $km = $request->km;

                    for ($i = 0; $i < count($oneway_id); $i++)
                    {
                        $pcity_id = $request->pcity_id;
                        $dcity_id = $request->dcity_id;
                        $cab_name = $cab_type[$i];
                        $am = $amount[$i];
                        $stx = $state_tax;
                        $rate = $km_rate[$i];
                        $tx =$tax;
                        $dv = $driver_allowance;
                        // if($am == '')
                        // {
                        //     $amount_tx = 0;
                        // }
                        // else{
                        //     $amount_tx = $am;
                        // }
                        if($stx == '')
                        {
                            $state_tx = 0;
                        }
                        else{
                            $state_tx = $stx;
                        }
                        if($tx == '')
                        {
                            $tall_tx = 0;
                        }
                        else{
                            $tall_tx = $tx;
                        }
                        if($dv == '')
                        {
                            $driver = 0;
                        }
                        else{
                            $driver = $dv;
                        }


                        $total_amount = $state_tx+$dv+$tx+$am;
                        $gst = $total_amount*5/100;



                           $data=array(
                            'pcity_id'=>$pcity_id,
                            'dcity_id'=>$dcity_id,
                            'cab_type' => $cab_name,
                            'amount' => $am,
                            'popular_routes'=>$pop,
                            'tax'=>$tall_tx,
                            'state_tax'=>$state_tx,
                            'driver_allowance'=>$driver,
                            'km'=>$request->input('km'),
                            'time'=>$request->input('time'),
                            'km_rate'=>$rate,
                            'gst'=>$gst,
                            'total_amount'=>$total_amount,

                        );
                          $data2=array(
                            'pcity_id'=>$dcity_id,
                            'dcity_id'=>$pcity_id,
                            'cab_type' => $cab_name,
                            'amount' => $am,
                            'popular_routes'=>$pop,
                            'tax'=>$tall_tx,
                            'state_tax'=>$state_tx,
                            'driver_allowance'=>$driver,
                            'km'=>$request->input('km'),
                            'time'=>$request->input('time'),
                            'km_rate'=>$rate,
                            'gst'=>$gst,
                            'total_amount'=>$total_amount,

                        );
                        if($data['amount'] == 0 || $data2['amount'] == 0){
                            $request->session()->put('danger');
                            // return view("onewaydetails.index");
                        }
                        else{
                            $onewayydetails_1 = Onewaydetails::create($data);
                            $onewayydetails_2 = Onewaydetails::create($data2);

                        }




                }

                return redirect()->route('onewaydetails.index')
                ->with('success','Route Created Successfully');
            }else{
                $this->validate($request, [
                    'km'=>'required',
                    'amount'=>'required',
                    // 'pick_city'=>'required',
                ]);
            }


    }

    public function edit($pick_city,$drop_city)
    {

         $pcity_id = Pickup::select('id','pick_city')->where('pick_city',$pick_city)->first();
         $dcity_id = Dropcity::select('id','drop_city')->where('drop_city',$drop_city)->first();
        // $onewaydetails = onewaydetails::select('onewaydetails.*','cab_masters.cab','cab_masters.cab_status')->join('cab_masters','cab_masters.id','onewaydetails.cab_type')->where('pcity_id',$pcity_id->id)->where('dcity_id',$dcity_id->id)->orderby('car_order','asc')->distinct()->get();
    //    return$onewaydetails[1];

         $onewaydetails_km = onewaydetails::select('onewaydetails.*')->where('pcity_id',$pcity_id->id)->where('dcity_id',$dcity_id->id)->first();
            $cab_data = Cab_master::select('cab_masters.*')->where('cab_status',1)->get();

            for($i=0;$i<count($cab_data);$i++){
                 $cab_id = $cab_data[$i]['id'];
                  $onewaydetails = onewaydetails::select('onewaydetails.*','cab_masters.cab','cab_masters.cab_status')->join('cab_masters','cab_masters.id','onewaydetails.cab_type')->where('pcity_id',$pcity_id->id)->where('dcity_id',$dcity_id->id)->where('cab_type',$cab_id)->orderby('car_order','asc')->distinct()->first();

            }
        // return   $onewaydetails;


          $pick_city  = Pickup::select('id as p_id','pick_city','status_delete')->where('status_delete','No')->get();
        $drop_city = Dropcity::select('id as d_id','drop_city','status_delete')->where('status_delete','No')->get();
         $total_km = $onewaydetails_km->km;
        return view('onewaydetails.edit',compact('onewaydetails','pick_city','drop_city','pcity_id','dcity_id','total_km','onewaydetails_km','cab_data'));
    }
    public function updateDropcity(Request $request)
    {
        $pid  = $request->post('pid');
         $onewaydetails=Onewaydetails::select('onewaydetails.*')->where('Onewaydetails.status_delete','No')->get();
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

    public function update(Request $request)
    {
        // return $request;
       if($request->km != ''){
        $lastid_get = Onewaydetails::select('id')->orderby('id','desc')->count();


        $cab_type = $request->cab_type;
        $oneway_id = $request->rate_card_id;
        $amount = $request->amount;
 $km_rate = $request->km_rate;
        $tax = $request->tax;
         $pop_rt = $request->popular_routes;
        if($pop_rt == ''){
            $pop = 'No';
        }
        else{ 
            $pop =  'Yes';
        }
        
        $state_tax = $request->state_tax;
        $driver_allowance = $request->driver_allowance;
    $km = $request->km;
    $time = $request->time;
// return $request;


            for ($i = 0; $i < count($oneway_id); $i++)
            {

               $pcity_id = $request->pcity_id;
                $dcity_id = $request->dcity_id;
              $cab_name = $cab_type[$i];

                  $onewaydetails = Onewaydetails::select('onewaydetails.*')->where('pcity_id',$pcity_id)->where('dcity_id',$dcity_id)->where('cab_type',$cab_name)->first();

                if($onewaydetails != ''){

                    $onewayupdate_id = $request->rate_card_id[$i];
                   $total_amount = $amount[$i]+ $state_tax + $tax +$driver_allowance;
                   $gst = $total_amount*5/100;
                    $datas['pcity_id'] = $pcity_id;
                    $datas['dcity_id'] = $dcity_id;
                    $datas['cab_type']= $cab_type[$i];
                    $datas['amount'] = $amount[$i]; 
                    $datas['tax'] = $tax;
                    $datas['km_rate'] = $km_rate[$i];
                    $datas['state_tax'] = $state_tax;
                    $datas['driver_allowance'] = $driver_allowance;
                    $datas['popular_routes'] = $pop;
                    $datas['km'] = $km;
                    $datas['time'] = $time;
                    $datas['gst'] = $gst;
                    $datas['total_amount'] = $total_amount;
                    
                            $oneway_id[$i];
                        
                        $updatedata = Onewaydetails::select('onewaydetails.*')->where('id',$oneway_id[$i])->first();
                        $updatedata->update($datas);
            

                }else{

                     $onewayupdate_id = $request->rate_card_id[$i];

                     $total_amount = $amount[$i]+ $state_tax + $tax +$driver_allowance;
                      $gst = $total_amount*5/100;
                     $datas['pcity_id'] = $pcity_id;
                    $datas['dcity_id'] = $dcity_id;
                    $datas['cab_type']= $cab_type[$i];
                     $datas['amount'] = $amount[$i];
                       $datas['tax'] = $tax;
                    $datas['state_tax'] = $state_tax;
                    $datas['driver_allowance'] = $driver_allowance;
                    $datas['popular_routes'] = $pop;
                    $datas['km'] = $km;
                    $datas['time'] = $time;
                    $datas['gst'] = $gst;
                    $datas['total_amount'] = $total_amount;
                    //  return$datas['amount'];
                     $oneway_id[$i];

                    //  $updatedata = Onewaydetails::select('onewaydetails.*')->where('id',$oneway_id[$i])->first();

                         $updatedata->create($datas);


                }


            }
        $data_delete = onewaydetails::select('onewaydetails.*')->where('amount',0)->delete();
            return redirect()->route('onewaydetails.index')
            ->with('success','Route Updated Successfully (:');


       }
       else{
        $this->validate($request, [
            'km'=>'required',
            'amount'=>'required',
        ]);
       }

    }
    public function destroy($id)
    {
        Onewaydetails::find(decrypt($id))->delete();
        return redirect()->route('onewaydetails.index')
            ->with('success','Route Deleted successfully');
    }
    public function add_cab()
    {

        $pick_city1  = Pickup::select('status_delete','pick_city','id')->where('status_delete','No')->orderby('pick_city')->get();
        $drop_city1  = Dropcity::select('status_delete','drop_city','id')->where('status_delete','No')->orderby('drop_city')->get();
        $cab_data = Cab_master::select('cab_masters.*')->get();
        $pick_city = $pick_city1->pluck('pick_city','id')->all();
        $drop_city = $drop_city1->pluck('drop_city','id')->all();
       return view('onewaydetails.add_cab',compact('pick_city','cab_data','drop_city'));
    }
    public function deleteAll(Request $request)
    {
        $checkedcity_ids = $request->checkedcity_ids;
        Onewaydetails::WhereIn('id',$checkedcity_ids)->delete();
        return response()->json(['code'=>1,'msg'=>'Route hava Been Deleted successfully']);

    }
    public function get_cab_type (Request $request)
    {
        $did  = $request->post('did');
        $cab_get = Cab_master::select('cab_masters.*')->where('cab_status',1)->get();
         $cab_list = Onewaydetails::select('cab_type','dcity_id')->where('dcity_id',$did)->where('onewaydetails.status_delete','No')->distinct()->orderby('car_order','asc')->get();
          $html = '';
       $html.='<option value="select_cab">Select Cab</option>';
       for($i=0;$i<count($cab_get);$i++) {


           $html.='<option id="drop_option" value = '.$cab_get[$i]['id'].'>'.$cab_get[$i]['cab'].'</option>';

       }

       echo $html;

     }
     public function check_cab(Request $request)
     {
            $value  = $request->post('value');
           $pcity_id  = $request->post('pcity_id');
        $dcity_id  = $request->post('dcity_id');
          $onewaydetails= Onewaydetails::select('pcity_id','dcity_id','cab_type')->where('onewaydetails.pcity_id',$pcity_id)->where('onewaydetails.dcity_id',$dcity_id)->where('onewaydetails.status_delete','No')->first();
         if($onewaydetails != '')
            {
                echo 0;
            }else{
                echo 1;
            }


     }
     public function cab_dropcity(Request $request){
        $pid  = $request->post('pid');

          $pickupcity = Pickup::select('id','pick_city','status_delete')->where('id',$pid)->where('status_delete','No')->get();
          $pickupcity_id= $pickupcity[0]['pick_city'];
             $dropcity = Onewaydetails::select('dcity_id','pcity_id','dropcities.*')->join('dropcities','dropcities.id','onewaydetails.dcity_id')->distinct()->where('pcity_id',$pid)->get();


           $html='';
           $html.='<option value=>Select Drop City</option>';
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
  public function add_store(Request $request)
  {
    // return $request;
     $km_rate = Cab_master::select('cab_masters.*')->where('id',$request->cab_type)->first();
    if($request->tax == ''){
        $tax = 0;
    }else{
        $tax = $request->tax;
    }
    if($request->state_tax == ''){
        $state_tax = 0;
    }else{
        $state_tax = $request->state_tax;
    }
    if($request->amount == ''){
        $amount = 0;
    }else{
        $amount = $request->amount;
    }
    if($request->driver_allowance == ''){
        $driver_allowance = 0;
    }else{
        $driver_allowance = $request->driver_allowance;
    }

     $total_amount= $tax+$state_tax+$driver_allowance;
            $data=array(
                'pcity_id'=>$request->pcity_id,
                'dcity_id'=>$request->dcity_id,
                'cab_type' => $request->cab_type,
                'amount' => $amount,
                'popular_routes'=>$request->popular_routes,
                'tax'=>$tax,
                'state_tax'=>$state_tax,
                'driver_allowance'=>$driver_allowance,
                'km'=>$request->km,
                'time'=>$request->time,
                'km_rate'=>$km_rate->km_rate,
                'total_amount'=>$total_amount,

            );
            $data2=array(
                'pcity_id'=>$request->dcity_id,
                'dcity_id'=>$request->pcity_id,
                'cab_type' => $request->cab_type,
                'amount' => $amount,
                'popular_routes'=>$request->popular_routes,
                'tax'=>$tax,
                'state_tax'=>$state_tax,
                'driver_allowance'=>$driver_allowance,
                'km'=>$request->km,
                'time'=>$request->time,
                'km_rate'=>$km_rate->km_rate,
                'total_amount'=>$total_amount,

            );
            $onewayydetails = Onewaydetails::create($data);
            $onewayydetails = Onewaydetails::create($data2);

            return redirect()->route('onewaydetails.index')
            ->with('success','Route Created Successfully');
}
public function get_estimate(Request $request)
{
        
        $pickupCityId =$request->pcity_id;
        $dropCityId = $request->dcity_id; 
        $pickupcity = Pickup::select('pickups.*')->where('id',$pickupCityId)->get();
        $travel_city_arr = Dropcity::select('dropcities.*')->where('id',$dropCityId)->get();

                // return$travel_city_arr =$request->travel_cities;






                $full_pick_up_city = $pickupcity[0]['pick_city'];
                $texifrom = $pickupcity[0]['pick_city'];
                $tot_dis = 0;
                $scity_arr = array();
                $ncity_arr = array();

                for ($i = 0; $i < count($travel_city_arr); $i++) {

                    $p = $i + 1;
                    $scity_arr[0] = $full_pick_up_city;
                    $scity_arr[$p] = $travel_city_arr[$i]; //two way km count
                    $ncity_arr[] = $travel_city_arr[$i];
                }

                array_push($ncity_arr, $full_pick_up_city);

                $mul_start_city_arr = $scity_arr;
                $mul_next_city_arr = $ncity_arr;
                $count_arr = count($mul_start_city_arr);


                for ($i = 0;$i<$count_arr;$i++) {

                    $start_city = $mul_start_city_arr[$i];

                    $next_city = $mul_next_city_arr[$i];

                     $coordinates1 = $this->get_coordinates($start_city);

                    $coordinates2 = $this->get_coordinates($next_city);


                    if (!$coordinates1||!$coordinates2) {
                        echo 'Bad address.';
                    } else {
                         $dist = $this->GetDrivingDistance($coordinates1['lat'],$coordinates2['lat'],$coordinates1['long'],$coordinates2['long']);

                        // return  'Distance: <b>'.$dist['distance'].'</b><br>Travel time duration: <b>'.$dist['time'].'</b>';
                    }

                     $km =  str_replace(",",'',$dist['distance']);
                      $time = $dist['time'];
                       return$data = array('distance' => $km,'time' => $time);
                    //  echo json_encode($data);

}

}
//--------------------------------------------- 


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
public function increase(Request $request)
{

    $data = Onewaydetails::select('onewaydetails.*','pickups.pick_city')->join('pickups','pickups.id','onewaydetails.pcity_id')->groupby('pcity_id')->distinct()->get();
     $pcity_id = $data->pluck('pick_city','pcity_id',)->all();
    return view('onewaydetails.increase',compact('data','pcity_id'));

}
public function increase_add(Request $request)
{

    // return $request;
     $data = Onewaydetails::select('onewaydetails.*')->where('pcity_id',$request->pcity_id)->get();

    for($i=0;$i<count($data);$i++){
          $increse = $data[$i]['total_amount']*$request->percentage/100;
          $rate = $increse;
        if($request->type=='Increase'){

              $total_amount = $data[$i]['amount']+$rate;

            Onewaydetails::where('id',$data[$i]['id'])->update([
            "amount"     => $total_amount,

           ]);
        }else{

            // $pt= $data[$i]['amount']*$request->percentage/100;
                $total_amount = $data[$i]['amount']-$rate;
            Onewaydetails::where('id',$data[$i]['id'])->update([
            "amount"     => $total_amount,

           ]);
        }


    }
    Increase_rates::create([
        'city_id' => $request->pcity_id,
        'type' => $request->type,
        'percentage'=>$request->percentage

    ]);

    $data = Onewaydetails::select('onewaydetails.*','pickups.pick_city')->join('pickups','pickups.id','onewaydetails.pcity_id')->groupby('pcity_id')->distinct()->get();
    $pcity_id = $data->pluck('pick_city','pcity_id',)->all();
     return redirect()->route('onewaydetails.increase',compact('data','pcity_id'))
     ->with('success','Route Updated Successfully (:');
    // return view('onewaydetails.increase',)->with('success','Route Deleted successfully');;

}
public function increase_list (Request $request)
{
     $data = Increase_rates::select('increase_rates.*','pickups.pick_city')->join('pickups','pickups.id','increase_rates.city_id')->get();
     if ($request->ajax()) {
        $data = Increase_rates::select('increase_rates.*','pickups.pick_city')->join('pickups','pickups.id','increase_rates.city_id')->get();
        return Datatables::of($data)

            ->addIndexColumn()
            ->addColumn('checkbox', function($row){
               return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
            })


            ->addColumn('city', function($row){
                $city = $row->pick_city;
                if (!empty($city)) {
                return '<label>'.($city).'</label>&nbsp';
                } else {
                    return '<label>-</label>';
                }
            })
            ->addColumn('type', function($row){
                $type = $row->type;
                if ($type=='Increase') {
                return '<label class="label label-success">'.$type.'</label>';
                } else {
                    return '<label class="label label-danger">'.$type.'</label>';
                }
            })

            ->setRowAttr([
                'style' => function($row){
                    return $row->status==0 ? 'background-color: #fbdddd;border-bottom:1px solid #c1c1c1' : 'border-bottom:1px solid #c1c1c1';
                }
            ])
            ->addColumn('status',function($row){
                if($row->status==1){
                    $currentst='Active';
                    $nm='Inactive';
                    $btn="btn-success";

                }else{
                    $currentst='Inactive';
                    $nm='Active';
                    $btn="btn-danger";


                }

                    return '<a href="'.url('admin/onewaydetails/increse_change/'.$nm.'/'.$row->id).'" class="statuschange"><button  class="btn '.$btn.' me-1 waves-effect waves-float waves-light">'.$currentst.'</button></a>';

            })

            ->addColumn('created_at',function($row){

                $data = $row->created_at->format('d-m-Y');
                $time = $row->created_at->format('h:i A');
                return '<label>'.$data.'</label><br><label>'.$time.'</label>';

            })

            ->rawColumns(['action','city','checkbox','status','created_at','type'])
            ->make(true);
    }
    return view('onewaydetails.increase_index');
}
public function increse_change($nm,$id)
{



    if($nm == "Inactive"){
        $nm1 = 0;
    }else{
        $nm1 = 1;
    }

    $nowdate = date('Y-m-d H:i:s');

      $data = Increase_rates::where('id',$id)->update([
        "status"     =>$nm1 ,
        "updated_at" =>$nowdate
       ]);

    // //   Onewaydetails::where('id',$id)->update(['status'=>$status]);
    //   return redirect()->route('onewaydetails.index')
    //
}
public function increse_deleteAll(Request $request)
{
    $checkedcity_ids = $request->checkedcity_ids;
    Increase_rates::WhereIn('id',$checkedcity_ids)->delete();
    return response()->json(['code'=>1,'msg'=>'Data Been Deleted successfully']);

}
}
