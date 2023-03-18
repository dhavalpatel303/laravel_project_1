<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Pickup;
use App\Dropcity;
use App\Onewaybookings;
use App\Onewaydetails;
use App\Localdetails;
use App\Driver;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use helpers;
use DB;

class RoutesController extends Controller
{

    public function index(Request $request )
    {

        $url = $_SERVER['REQUEST_URI'];
        Helpers::visitorUpdate($url);

        $data['pickupcity_id']   = Pickup::select(['pick_city','id'])->where('pickups.status_delete','No')->get();
        $data['dropcity_id']  = Dropcity::select(['drop_city','id'])->where('dropcities.status_delete','No')->get();
        $data['onewaydetail'] = Onewaydetails::select('onewaydetails.pcity_id')->where('status','1')->where('onewaydetails.status_delete','No')->where('onewaydetails.status','1')  ->limit(10)->get();
        $data['oneway_detail_uniq'] = Onewaydetails::select('pcity_id')->where('onewaydetails.status_delete','No')->where('onewaydetails.status','1')->distinct()->get();
         $data['oneway_detail_uniq_all'] =Onewaydetails::select('pcity_id','dcity_id','pickups.pick_city','total_amount','dropcities.drop_city','time','km','cab_type')->join('pickups','pickups.id','onewaydetails.pcity_id')->join('dropcities','dropcities.id','onewaydetails.dcity_id')->where('onewaydetails.status_delete','No')->where('onewaydetails.status','1')->groupby('dropcities.drop_city')->groupby('pickups.pick_city')->orderby('amount','asc')->distinct()->get();
        $hello= Onewaydetails::select('onewaydetails.*')->where('onewaydetails.status_delete','No')->where('onewaydetails.status','1')->limit(10)->get();
         $data['oneway_detail'] 	=Onewaydetails::select('onewaydetails.*')->where('onewaydetails.status_delete','No')->where('onewaydetails.status','1')->limit(10)->get();
        $data['user_id']  =user::pluck('id as u_id')->where('users.status_delete','No')->all();

        // for($l=0;$l<count($hello);$l++){
        //     $amount= $hello[$l]['total_amount'];
        // }


        return view('frontend.routs.index',$data);


    }
}
