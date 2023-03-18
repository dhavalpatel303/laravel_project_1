<?php

namespace App\Http\Controllers\Frontend;

use App\Dropcity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Inquries;
use App\Pickup;
use App\Onewaydetails;
use App\Onewaybookings;
use App\Oneway_note; 
use App\Localdetails;
use App\Multicitybookings;
use App\Multicityprices;
use App\Multicitycabs;
use App\Local_package;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use DB;
use Laravel\Ui\Presets\React;
use Mail;
use Helpers;
class Search_cab extends Controller
{
    public function index(Request $request)
    {
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);

        
        $pcity_id = $request->pickupcity_id;
        $pickupcity = $request->pickcity_id;
        $dropcity = $request->dropcity;
        $dcity_id = $request->dropcity_id;
        $data['request']=$request;
        $data['from'] = $request->pickupcity_id;
         $data['to'] = $request->dropcity_id;

         $data['localfrom'] = $request->pickcity_id;
         $data['localto'] = $request->dropcity;
        $pc =  Pickup::select('pick_city','id')->where('id',$pcity_id)->where('pickups.status_delete','No')->first();
         $dc =  Dropcity::select('drop_city','id')->where('id',$dcity_id)->where('dropcities.status_delete','No')->first();
        $one_details = Onewaydetails::select('onewaydetails.*')->where('pcity_id',$pcity_id)->where('dcity_id',$dcity_id)->where('onewaydetails.status_delete','No')->where('onewaydetails.status',1)->orderby('car_order','asc')->where('onewaydetails.amount','!=','0')->first();

        if($pc == '' || $dc=='' || $one_details ==''){
            return view("frontend.about.error");
        }
        else{
            $data['pickupcity'] = Pickup::select('pick_city','id')->where('id',$pcity_id)->where('pickups.status_delete','No')->first();
            $data['dropcity'] = Dropcity::select('drop_city','id')->where('id',$dcity_id)->where('dropcities.status_delete','No')->first();
            $data['onewaydetails']=Onewaydetails::select('onewaydetails.*','cab_masters.cab','cab_masters.av_cabs','cab_masters.bag','cab_masters.seat','cab_masters.km_rate','cab_masters.ekm_rate','cab_masters.image')->join('cab_masters','cab_masters.id','onewaydetails.cab_type')->where('pcity_id',$pcity_id)->where('dcity_id',$dcity_id)->where('onewaydetails.status_delete','No')->where('onewaydetails.status',1)->orderby('car_order','asc')->where('onewaydetails.amount','!=','0')->get();
            $data['km'] = Onewaydetails::select('onewaydetails.km')->where('pcity_id',$pcity_id)->where('dcity_id',$dcity_id)->where('onewaydetails.status_delete','No')->where('onewaydetails.status',1)->orderby('car_order','asc')->distinct()->first();
            $data['oneway_note'] = Oneway_note::select('oneway_note','id')->where('id',1)->first();
            return view('frontend.onewaycab.index',$data);
        }



    }

    public function local_index(Request $request)
    {
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);
         $request;
        $pcity_id = $request->pickupcity_id;
        $pickupcity = $request->pickcity_id;
        $dropcity = $request->dropcity;
        $dcity_id = $request->dropcity_id;
        $data['request']=$request;
        $data['from'] = $request->pickupcity_id;
         $data['to'] = $request->dropcity_id;

         $data['localfrom'] = $request->pickcity_id;
         $data['localto'] = $request->dropcity;
        $pc =  Pickup::select('pick_city','id')->where('id',$pcity_id)->where('pickups.status_delete','No')->first();
        $dc =  Dropcity::select('drop_city','id')->where('id',$dcity_id)->where('dropcities.status_delete','No')->first();

        $plc = Pickup::select('pick_city','id')->where('id',$pickupcity)->where('pickups.status_delete','No')->first();
        $dlc = Local_package::select('local_packages.local_package','id')->where('local_packages.id',$dropcity)->first();
        if($plc == '' || $dlc == ''){
            return view("frontend.about.error");
        }
        else{
            $data['localpickupcity'] = Pickup::select('pick_city','id')->where('id',$pickupcity)->where('pickups.status_delete','No')->first();
            $data['localdropcity'] = localdetails::select('dropcity','id')->where('dropcity',$dropcity)->where('localdetails.status_delete','No')->first();
            $data['package_name'] = Local_Package::select('local_packages.*')->where('local_packages.id',$dropcity)->first();
              $data['localdetails']= localdetails::select('localdetails.*','cab_masters.cab','cab_masters.av_cabs','cab_masters.bag','cab_masters.seat','cab_masters.km_rate','cab_masters.ekm_rate','cab_masters.image')->join('cab_masters','cab_masters.id','localdetails.cab_type')->where('pcity_id',$pickupcity)->where('dropcity',$dropcity)->where('localdetails.status_delete','No')->where('localdetails.status',1)->where('localdetails.amount','!=','0')->orderby('cab_order','asc')->get();
              $data['local_note'] = Oneway_note::select('local_note','id')->where('id',1)->first();
              return view('frontend.onewaycab.index',$data);
        }
    }
    public function routes(Request $request)
    {
        // return $request;
        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);

    

         $route_pcity = Pickup::select('pick_city','id')->where('id',$request->pick_city)->where('pickups.status_delete','No')->first();
         $route_dcity =Dropcity::select('drop_city','id')->where('id',$request->drop_city)->where('dropcities.status_delete','No')->first();

         if($route_pcity == '' || $route_dcity == ''){
            return view("frontend.about.error");
         }
         else{
            $route_pcity_id = $route_pcity->id;
            $route_dcity_id = $route_dcity->id;
            $routedata['request']= $request;
            $routedata['from'] = $route_pcity_id;
             $routedata['to'] =  $route_dcity->id;
             $routedata['oneway_note'] = Oneway_note::select('oneway_note','id')->where('id',1)->first();

              $routedata['km'] = Onewaydetails::select('onewaydetails.km','onewaydetails.time')->where('pcity_id',$route_pcity_id)->where('dcity_id',$route_dcity_id)->where('onewaydetails.status_delete','No')->where('onewaydetails.status',1)->orderby('total_amount','asc')->distinct()->first();
            $routedata['pickupcity'] = Pickup::select('pick_city','id')->where('id',$request->pick_city)->where('pickups.status_delete','No')->first();
            $routedata['dropcity'] = Dropcity::select('drop_city','id')->where('id',$request->drop_city)->where('dropcities.status_delete','No')->first();
            //  $routedata['onewaydetails']= Onewaydetails::select('onewaydetails.*')->where('pcity_id',$route_pcity_id)->where('dcity_id',$route_dcity_id)->where('onewaydetails.status_delete','No')->where('onewaydetails.status',1)->orderby('car_order','asc')->where('onewaydetails.amount','!=','0')->get();
             $routedata['onewaydetails']=Onewaydetails::select('onewaydetails.*','cab_masters.cab','cab_masters.image','cab_masters.av_cabs','cab_masters.bag','cab_masters.seat','cab_masters.km_rate','cab_masters.ekm_rate')->join('cab_masters','cab_masters.id','onewaydetails.cab_type')->where('pcity_id',$route_pcity_id)->where('dcity_id',$route_dcity_id)->where('onewaydetails.status_delete','No')->where('onewaydetails.status',1)->orderby('car_order','asc')->where('onewaydetails.amount','!=','0')->get();
            return view('frontend.onewaycab.routecab',$routedata);

         }


    }

    public function multicity(Request $request)
    {


        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);

         $cab_price_list = Multicityprices::select('multicityprices.*')->get();
           $data['request']= $request;
         $data['travel_city'] =  $request->travel_cities;
        $travel = $request->travel_cities;
         $pick_city= $request->pickcity_id;
         
         $data['dropcity'] = end($data['travel_city']);
         $data['pickupcity'] = Pickup::select('pick_city','id')->where('id',$pick_city)->get();
   $data['cab_price'] =Multicitycabs::select('multicitycabs.*','cab_masters.cab','cab_masters.image','cab_masters.mkm_rate','cab_masters.av_cabs','cab_masters.cab_status','cab_masters.mkm_rate')
                                                    ->orderby('cab_order','asc')
                                                    ->join('cab_masters','cab_masters.id','multicitycabs.cab_id')
                                                    ->where('cab_masters.cab_status',1)
                                                    ->get();
            //   $data['cab_price'] =Multicitycabs::select('multicitycabs.*')->orderby('cab_order','asc')->where('cab_type','!=','primesedan')->where('cab_type','!=','primesuv')->get();
        //   $data['multicitydetails'] = Multicitycabs::select('multicitycabs.*')->get();
         $data['cab_price_list'] = Multicityprices::select('multicityprices.*')->where('pcity_id',$pick_city)->get();
        return view('frontend.onewaycab.multicity',$data,compact('travel'));
    }
    public function special_routes(Request $request,$pick_city)
    {
        $pick = Pickup::select(['pick_city','id'])->where('pick_city',$pick_city)->where('pickups.status_delete','No')->first();
        $data['pickupcity_id']   = Pickup::select(['pick_city','id'])->where('pick_city',$pick_city)->where('pickups.status_delete','No')->get();
        $data['dropcity_id']  = Dropcity::select(['drop_city','id'])->where('dropcities.status_delete','No')->get();
        $data['onewaydetail'] = Onewaydetails::select('onewaydetails.pcity_id')->where('status','1')->where('onewaydetails.status_delete','No')->distinct()->limit(10)->get();
        $data['oneway_detail_uniq'] = Onewaydetails::select('pcity_id')->where('onewaydetails.status_delete','No')->distinct()->get();


        // $this->db->select('*');

		// $this->db->from('onewaydetails');

	    // $this->db->join('dropcities','dropcities.id=onewaydetails.dcity_id','left');

	    // $this->db->join('pickups','pickups.id=onewaydetails.pcity_id','left');

	    // $this->db->where('onewaydetails.pcity_id',$pick->id);

	    // $this->db->group_by('dropcities.drop_city');

	    // $this->db->order_by('dropcities.drop_city','ASC');

		// $query = $this->db->get();

		// $the_content = $query->result_array();

		// return $the_content;

            // return $data = DB::table('onewaydetails','dropcities')
            // ->select('*')
            // ->from('onewaydetails')
            // ->join('dropcities','dropcities.id','onewaydetails.dcity_id','left')
            // ->join('pickups','pickups.id','onewaydetails.pcity_id','left')
            // ->where('onewaydetails.pcity_id',$pick->id)
            // ->groupby('dropcities.drop_city')
            // ->get();

        // return $dj= DB::select("select onewaydetails.*, `pickups`.`pick_city`, `dropcities`.`drop_city` from `onewaydetails` inner join `pickups` on `pickups`.`id` = `onewaydetails`.`pcity_id` inner join `dropcities` on `dropcities`.`id` = `onewaydetails`.`dcity_id` group by `dropcities`.`drop_city` order by `dropcities`.`drop_city` asc;")->toSql();


     $data['oneway_detail_uniq_all'] =Onewaydetails::select('pcity_id','dcity_id','pickups.pick_city','total_amount','dropcities.drop_city')->join('pickups','pickups.id','onewaydetails.pcity_id')->join('dropcities','dropcities.id','onewaydetails.dcity_id')->where('onewaydetails.pcity_id',$pick->id)->where('onewaydetails.status_delete','No')->groupby('dropcities.drop_city')->orderby('dcity_id','asc')->distinct()->get();
        $hello= Onewaydetails::select('onewaydetails.*')->where('onewaydetails.status_delete','No')->limit(10)->get();
         $data['oneway_detail'] 	=Onewaydetails::select('onewaydetails.*')->where('onewaydetails.status_delete','No')->limit(10)->get();

         return view('frontend.routs.special_route',$data);
    }
    public function modal_show(Request  $request)
    {
         $modal_id = $request->modal_id;
         $pcity_id = $request->pcity_id; 
         $dcity_id = $request->dcity_id;
         $oneway_note =  Oneway_note::select('oneway_note','id')->where('id',1)->first();
         
           $onewaydetails=Onewaydetails::select('onewaydetails.*','cab_masters.cab','cab_masters.av_cabs','cab_masters.bag','cab_masters.seat','cab_masters.km_rate','cab_masters.ekm_rate','cab_masters.image')->join('cab_masters','cab_masters.id','onewaydetails.cab_type')->where('pcity_id',$pcity_id)->where('dcity_id',$dcity_id)->where('onewaydetails.status_delete','No')->where('onewaydetails.id',$modal_id)->where('onewaydetails.status',1)->orderby('car_order','asc')->where('onewaydetails.amount','!=','0')->first();
              $html='';

        $html.=' 
             <div class="row">
                                <div class="col-12 col-lg-12 col-md-12 fare-area" id="loadfare">
                                    <div class="fare-area">
                                        <h4>Fare Breakup:</h4>
                                        <h5>Base Fare <span> ₹ '.$onewaydetails->amount.' </span></h5>
                                        <h5>Toll Tax <span> ₹ '.$onewaydetails->tax.' </span></h5>
                                        <h5>State Tax <span> ₹ '.$onewaydetails->state_tax.' </span></h5>
                                        <h5>Driver Allowance <span> ₹ '.$onewaydetails->driver_allowance.' </span></h5>
                                        <h5>Estimated Amount <span style="font-weight: 900"> ₹ '.$onewaydetails->total_amount.' </span></h5>


                                    </div>
                                </div>
                            </div>

                            <div class="row fare-area">
                                <div class="col-lg-12">
                                    '.$oneway_note->oneway_note.'
                                </div>
                            </div>
        ';
           echo $html;
    }


     public function local_modal_show(Request  $request)
    {
         $modal_id = $request->modal_id;
         $pcity_id = $request->pcity_id; 
         $dcity_id = $request->dcity_id;
        //  return $request;
         $oneway_note =  Oneway_note::select('local_note','id')->where('id',1)->first();
         
             $localdetails=Localdetails::select('localdetails.*','cab_masters.cab','cab_masters.av_cabs','cab_masters.bag','cab_masters.seat','cab_masters.km_rate','cab_masters.ekm_rate','cab_masters.image','local_packages.local_package')
                                        ->join('cab_masters','cab_masters.id','localdetails.cab_type')
                                        ->join('local_packages','local_packages.id','localdetails.dropcity')
                                        ->where('pcity_id',$pcity_id)->where('dropcity',$dcity_id)
                                        ->where('localdetails.status_delete','No')->where('localdetails.id',$modal_id)
                                        ->where('localdetails.amount','!=','0')
                                        ->first();
          if($localdetails->local_package== '4Hr/40KMs' )
            {
                $km = '40 Km';
            }
           elseif($localdetails->local_package== '6Hr/60KMs')
            {  
               $km = '60 Km';
            }
           elseif($localdetails->local_package== '8Hr/80KMs')
            { 
            $km = '80 Km';
            }
           elseif($localdetails->local_package== '10Hr/100KMs')
            { 
                 $km = '100 Km';
            }
           else
            { 
                 $km = '120 Km';
            }

              if($localdetails->local_package== '4Hr/40KMs' )
            {
                $hour = ' 4 Hours';
            }
           elseif($localdetails->local_package== '6Hr/60KMs')
            {  
               $hour = '6 Hours';
            }
           elseif($localdetails->local_package== '8Hr/80KMs')
            { 
            $hour = '8 Hours';
            }
           elseif($localdetails->local_package== '10Hr/100KMs')
            { 
                 $hour = '10 Hours';
            }
           else
            { 
                 $hour = '120 Hours';
            }
            
              $html='';
             
                      $html.=' 
             <div class="row">
                                <div class="col-12 col-lg-12 col-md-12 fare-area" id="loadfare">
                                    <div class="fare-area">
                                        <h4>Fare Breakup:</h4>
                                        <h5>Base Fare <span> ₹ '.$localdetails->amount.' </span></h5>
                                        <h5>Usable Local Limit <span> ₹ '.$km.' </span></h5>
                                        <h5>After <span> '.$km.', Extra Charges ₹ '.$localdetails->ekr.' Per KM </span></h5>
                                        <h5>After <span> '.$hour.'. Extra Charges ₹ '.$localdetails->ehr.' Per Hour </span></h5>
                                        <h5>Estimated Amount <span style="font-weight: 900"> ₹ '.$localdetails->total_amount.' </span></h5>


                                    </div>
                                </div>
                            </div>

                            <div class="row fare-area">
                                <div class="col-lg-12">
                                    '.$oneway_note->local_note.'
                                </div>
                            </div>
        ';
           echo $html;
    }
    public function multy_modal_show(Request  $request)
    {
        // return $request;
         $modal_id = $request->modal_id;
            $journy_minkm = $request->journy_minkm;
            $esti_kms = $request->esti_kms;
            $km_rate = $request->km_rate;
            $driver = $request->driver;
            $pickup_date = $request->pickup_date;
            $pickup_time = $request->pickup_time;
            $return_date = $request->return_date;
            $note = $request->note;
             $tot_cab  = $request->tot_cab;
             $jdays = $request->journy_day;
            // alert(note);
            $city_name = $request->city_name;
            if($journy_minkm > $esti_kms){
            $h1 = ' <tr>
                <td><b>Estimated Fare</b></td>
                <td>:</td>
                <td><b>KM '.$journy_minkm.'* '.$km_rate .'.Rs /KM</b></td>
            </tr>';
            }else{
                $h1 = '<tr>
                <td><b>Estimated Fare</b></td>
                <td>:</td>
                <td><b>KM '.$esti_kms.';?>* '.$km_rate .'.Rs /KM</b></td>
            </tr>';
            }
        // return $h1;
           
  $html = '';
        $html.= ' <div class="modal-header"  style="background: black;">

            <h3 class="modal-title" style="text-align: center;color: white;font-size:22px">Rs.'.$tot_cab.'/-</h3>
            <h4 class="modal-title" style="text-align: center;color: white;font-size:22px">Outstation From <span style="color: #ffc000;font-weight:900">'.$city_name.'</span></h4>
        
            </div>
           
                <div class="modal-body" >
                    <div class="body-model" style="margin-left: 10px;">
                        
                        <div class="headingclass">
                            <span><b> Fare Breakup :</b></span>
                        </div>
                        <hr>

                        <div class="headingclass">
                            <table class="table table-striped" width="100%">


                               '.$h1.'


                                <tr>
                                    <td><b>Driver Allowance</b></td>
                                    <td>:</td>
                                    <td><b>Rs '.$driver.' * '.$jdays.' Day</b></td>
                                </tr>
                                <tr>
                                    <td><b>Minimum Km</b></td>
                                    <td>:</td>
                                    <td><b>Min. '.$journy_minkm.' KMs /Day</b></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="headingclass">
                            <table class="table table-striped" width="100%">

                                <tr>
                                    <td><b>Leave On</b></td>
                                    <td></td>
                                    <td><b>Return By</b></td>
                                </tr>
                                <tr>
                                    <td>'.$pickup_date.' at '.$pickup_time.'</td>
                                    <td></td>
                                    <td>'.$return_date.'</td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="headingclass">
                            <span> <b>Trip Extension:</b></span>
                        </div>
                        <hr>
                        <div class="headingclass">
                            <div class="col-md-12" style="border-bottom:1px solid #eeeeee">
                                <div class="col-md-6" style="max-width:100%">

                                    <p><b>After '.$return_date.':</b></p>
                                    <p>At '.$journy_minkm.'.Rs /KM</p>
                                    <p>Driver Allowance : Rs.'.$driver.'/Day</p>

                                </div>
                                <div class="col-md-6">

                                    <p><b>After <?=$esti_kms;?> KMs:</b></p>
                                    <p></p>
                                    <p>Rs '.$journy_minkm.' /KM</p>
                                    <p></p>

                                </div>

                            </div>
                        </div>

                        <div class="headingclass">
                            <hr>
                            <span> <b>Note:</b></span>
                            <hr>
                            <span>'.$note.'</span>
                        </div>

                    </div>
                </div>
          
           ';
            echo $html;
      
    }
}
