<?php

namespace App\Http\Controllers;


use App\Localdetails;
use App\Pickup;
use App\Local_package;
use App\Cab_master;
use Illuminate\Http\Request;
use DataTables;
use DB;
class LocaldetailsController extends Controller
{
      public function index(Request $request)
    {
        $data = localdetails::select('pickups.pick_city','localdetails.*','local_packages.local_package','cab_masters.cab','cab_masters.cab_status')
        ->join( 'pickups','pickups.id','localdetails.pcity_id')
        ->join( 'local_packages','local_packages.id','localdetails.dropcity')
        ->join('cab_masters','cab_masters.id','localdetails.cab_type')
        ->where('cab_status',1)
        ->where('amount','!=',0)
        ->where('localdetails.status_delete','No')
        ->orderby('localdetails.id','desc')
        ->get();

        if ($request->ajax()) {
            $data = localdetails::select('pickups.pick_city','localdetails.*','local_packages.local_package','cab_masters.cab','cab_masters.cab_status')
            ->join( 'pickups','pickups.id','localdetails.pcity_id')
            ->join( 'local_packages','local_packages.id','localdetails.dropcity')
            ->join('cab_masters','cab_masters.id','localdetails.cab_type')
            ->where('cab_status',1)
            // ->where('amount','!=',0)
            ->where('localdetails.status_delete','No')
            ->orderby('localdetails.id','desc')
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                 })
                ->addColumn('action', function($row){
                    $html = '<a  href="'. route('localdetails.edit', ['pick_city' => $row->pick_city,'drop_city'=>$row->dropcity]).'" class="btn btn-info card-title"><i class=" fas fa-pencil-alt"></i></a>';
                    return $html;
                })
                ->addColumn('pickup',function($row){
                    $pickup = $row->pick_city;
                    return '<label>'.$pickup.'</label>';

                })
                ->addColumn('dropcity',function($row){
                    $dropcity = $row->local_package;
                    return '<label>'.$dropcity.'</label>';

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

                        return '<a href="'.url('admin/localdetails/changestatus/'.$nm.'/'.$row->id).'" class="statuschange"><button  class="btn '.$btn.' me-1 waves-effect waves-float waves-light">'.$currentst.'</button></a>';

                })
                ->addColumn('amount', function($row){
                    $amount = $row->total_amount;
                    if (!empty($amount)) {
                    return '<label>Rs.'.ucwords($amount).'/-</label>&nbsp';
                    } else {
                        return '<label>Rs.0/-</label>';
                    }
                })
                ->addColumn('kms', function($row){
                    $kms = $row->kms;
                    if (!empty($kms)) {
                    return '<label>'.ucwords($kms).'KM</label>&nbsp';
                    } else {
                        return '<label>-</label>';
                    }
                })
                ->addColumn('cab_type',function($row){
                        return '<label><a class="font fsize"></a > '.$row->cab.'</i></label>';

                   })
                   ->setRowAttr([
                    'style' => function($row){
                        return $row->status==0 ? 'background-color: #fbdddd;border-bottom:1px solid #c1c1c1' : 'border-bottom:1px solid #c1c1c1';
                    }
                ])

                ->addColumn('extra',function($row){
                    $ehr = $row->ehr;
                    $ekr = $row->ekr;
                    return '<label>Rs.'.$ehr.'/Hour</label>
                            <label>Rs.'.$ekr.'/Km</label>';

                })
                ->rawColumns(['action','pickup','status','checkbox','amount','extra','dropcity','cab_type','kms'])
                ->make(true);
        }

        return view('localdetails.index');


    }

    public function create()
    {
        $data  = Pickup::select('pick_city','id','status_Delete')->where('status_delete','No')->get();
        $cab_data = Cab_master::select('cab_masters.*')->where('cab_status',1)->get();
        $pick_city = $data->pluck('pick_city','id')->all();
        $package = Local_package::select('local_packages.*')->get();
        return view('localdetails.create',compact('pick_city','cab_data','package'));
    }
  public function store(Request $request)
        {
            // return $request;
            $cab_type = $request->cab_type;
            $local_id = $request->rate_card_id;
            $amount = $request->amount;
           $ekm_rate = $request->ekr;
           $ehr_rate = $request->ehr;

           for ($i = 0; $i < count($local_id); $i++)
           {
               $pcity_id = $request->pcity_id;
                $dcity_id = $request->dropcity;
               $cab_name = $cab_type[$i];
               $am = $amount[$i];
               $ekm = $ekm_rate[$i];
               $ehr = $ehr_rate[$i];

               if($dcity_id==1)
               {
                   $hour = "4";
                   $km = "40";

               }elseif($dcity_id==2){
                   $hour =" 6";
                   $km = "60";
               }
               elseif($dcity_id==3){
                   $hour = "8";
                   $km = "80";
               }
               elseif($dcity_id==4){
                   $hour = "10";
                   $km = "100";
               }
               else{
                   $hour = "12";
                   $km = "120";
               }


               if($am == '')
               {
                   $amount_tx = 0;
               }
               else{
                   $amount_tx = $am;
               }
               if($ekm == '')
               {
                   $ekm_tx = 0;
               }
               else{
                   $ekm_tx = $ekm;
               }
               if($ehr == '')
               {
                   $ehr_tx = 0;
               }
               else{
                   $ehr_tx = $ehr;
               }



               $total_amount = $amount_tx;


                $data=array(
                   'dropcity'=>$request->input('dropcity'),
                   'pcity_id'=>$request->input('pcity_id'),
                   'hours'=>$hour,
                   'kms'=>$km,
                   'ehr'=>$ehr_tx,
                   'ekr'=>$ehr_tx,
                   'amount'=>$amount_tx,
                   'total_amount'=>$total_amount,
                   'cab_type'=>$cab_name,

               );


            //    $localdetails = Localdetails::create($data);
               if($data['amount'] == 0 || $data['amount'] == 0){

            }
            else{

                $onewayydetails = Localdetails::create($data);


            }


       }


       return redirect()->route('localdetails.index')
           ->with('success','Local Route Created Successfully');
       }
        public function changestatus($nm,$id)
        {



            if($nm == "Inactive"){
                $nm1 = 0;
            }else{
                $nm1 = 1;
            }


            $nowdate = date('Y-m-d H:i:s');

              $data = localdetails::where('id',$id)->update([
                "status"     =>$nm1 ,
                "updated_at" =>$nowdate
               ]);

        }
        public function edit($pick_city,$drop_city)
    {
        $cab = Cab_master::select('cab_masters.*')->get();
        $pcity_id = Pickup::select('id','pick_city')->where('pick_city',$pick_city)->first();
         $dcity_id = Local_package::select('id','local_package')->where('id',$drop_city)->first();

         $localdetails = localdetails::select('localdetails.*')->where('pcity_id',$pcity_id->id)->where('dropcity',$dcity_id->id)->orderby('cab_order','asc')->get();
         $get_local = localdetails::select('localdetails.*')->where('pcity_id',$pcity_id->id)->where('dropcity',$dcity_id->id)->first();
         $cab_data = Cab_master::select('cab_masters.*')->where('cab_status',1)->get();
         for($i=0;$i<count($cab_data);$i++){
            $cab_id = $cab_data[$i]['id'];
             $localdetails = localdetails::select('localdetails.*','cab_masters.cab','cab_masters.cab_status')->join('cab_masters','cab_masters.id','localdetails.cab_type')->where('pcity_id',$pcity_id->id)->where('dropcity',$dcity_id->id)->where('cab_type',$cab_id)->distinct()->first();

       }
        return view('localdetails.edit',compact('localdetails','pcity_id','dcity_id','get_local','cab','cab_data'));
    }

    public function update(Request $request)
    {
     $request;
        $lastid_get = Localdetails::select('id')->orderby('id','desc')->count();
        $cab_type = $request->cab_type;
        $local_id = $request->rate_card_id;
        $hour = $request->hours;
        $kms= $request->kms;
        $ekr = $request->ekr;
        $ehr = $request->ehr;
        $amount = $request->amount;
        if($lastid_get != '' && $lastid_get > 0)
        {

            for ($i = 0; $i < count($local_id); $i++)
            {

               $pcity_id = $request->pcity_id;
                $dcity_id = $request->dcity_id;
              $cab_name = $cab_type[$i];

              $localdetails = localdetails::select('localdetails.*')->where('pcity_id',$pcity_id)->where('dropcity',$dcity_id)->where('cab_type',$cab_name)->first();
              if($localdetails != '')
            {
               $localupdate_id = $request->rate_card_id[$i];




               $total_amount = $amount[$i];


               $datas['pcity_id'] = $pcity_id;
               $datas['dropcity'] = $dcity_id;
               $datas['cab_type']= $cab_type[$i];
               $datas['amount'] = $amount[$i];
               $datas['hours'] = $hour;
               $datas['kms'] = $kms;
               $datas['ehr'] = $ehr[$i];
               $datas['ekr'] = $ekr[$i];
               $datas['total_amount'] = $total_amount;
               if($datas['amount'] == 0){
                // return redirect()->route('localdetails.index')
                // ->with('danger','Oops ! Route Not Updated :(');
            }else{
                $updatedata = Localdetails::select('localdetails.*')->where('id',$local_id[$i])->first();
                    $updatedata->update($datas);

            }


            }else{
                $localupdate_id = $request->rate_card_id[$i];




                $total_amount = $amount[$i];


                $datas['pcity_id'] = $pcity_id;
                $datas['dropcity'] = $dcity_id;
                $datas['cab_type']= $cab_type[$i];
                $datas['amount'] = $amount[$i];
                $datas['hours'] = $hour;
                $datas['kms'] = $kms;
                $datas['ehr'] = $ehr[$i];
                $datas['ekr'] = $ekr[$i];
                $datas['total_amount'] = $total_amount;
                // return $local_id[$i];

                     $updatedata = Localdetails::select('localdetails.*')->first();
                     $updatedata->create($datas);

            }

            }
            $data_delete = Localdetails::select('localdetails.*')->where('total_amount',0)->delete();
            return redirect()->route('localdetails.index')
            ->with('success','Route Updated Successfully');
        }

    }


    public function destroy($id)
    {
        localdetails::find(decrypt($id))->delete();
        return redirect()->route('localdetails.index')
            ->with('success','record deleted successfully');
    }
    public function deleteAll(Request $request)
    {
        $checkedcity_ids = $request->checkedcity_ids;
        localdetails::WhereIn('id',$checkedcity_ids)->delete();
        // localdetails::WhereIn('id',$checkedcity_ids)->delete();
        return response()->json(['code'=>1,'msg'=>'Your Selected Route hava Been Deleted successfully']);

    }
}
