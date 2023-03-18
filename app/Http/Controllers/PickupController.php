<?php

namespace App\Http\Controllers;

use App\Pickup;
use App\Multicityprices;
use App\Dropcity;
use App\States;
use Illuminate\Http\Request;
use DataTables;
use DB;
use PhpParser\Node\Stmt\Else_;

class PickupController extends Controller
{
      public function index(Request $request)
    {
    $data = Pickup::select('pickups.*','states.name')
                            ->join('states','pickups.state_id','states.id')
                            ->where('pickups.status_delete','No')
                            ->orderBy('id', 'desc')
                            ->get();
        if ($request->ajax()) {
            $data = Pickup::select('pickups.*','states.name')
                            ->join('states','pickups.state_id','states.id')
                            ->where('pickups.status_delete','No')
                            ->orderBy('id', 'desc')
                            ->get();
            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                   return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                })

                ->addColumn('action', function($row){

                            $html = '<a  href="'.url('admin/city/edit',$row->id).'" class="btn btn-info card-title"><i class=" fas fa-pencil-alt"></i></a>';

                    return $html; 
                })
                ->addColumn('pick_city', function($row){
                    $city = $row->pick_city;
                    if (!empty($city)) {
                    return '<label>'.($city).'</label>&nbsp';
                    } else {
                        return '<label>-</label>';
                    }
                })
                ->addColumn('state', function($row){
                    $state = $row->name;
                    if (!empty($state)) {
                    return '<label>'.($state).'</label>&nbsp';
                    } else {
                        return '<label>-</label>';
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

                        return '<a href="'.url('admin/city/changestatus/'.$nm.'/'.$row->id).'" class="statuschange"><button  class="btn '.$btn.' me-1 waves-effect waves-float waves-light">'.$currentst.'</button></a>';

                })

                ->addColumn('created_at',function($row){

                    $data = $row->created_at->format('d-m-Y');
                    $time = $row->created_at->format('h:i A');
                    return '<label>'.$data.'</label><br><label>'.$time.'</label>';

                })

                ->rawColumns(['action','pick_city','checkbox','status','created_at','state'])
                ->make(true);
        }
        return view('pickup.index');


    }

    public function create()
    {
         $state = States::select('states.*')->where('status','Active')->get();
        $state_id = $state->pluck('name','id')->all();
        return view('pickup.create',compact('state','state_id'));
    }
  public function store(Request $request)
    {

         $request;
        $string = $request->pick_city;
        $part = explode(',',$string);
         $pick_city = $part[0];

          $data = Pickup::select('pickups.*')->where('pick_city',$pick_city)->where('status_delete','No')->first();
        if($data != ''){
            return redirect()->route('pickup.create')->with('danger','This City Allready Exit');
        }
        else {
            // $this->validate($request, [

            //     'City' => 'required |unique:pickups,pick_city',
            // ]);

                // return $request;


            $data=array(
                'pick_city'=>$pick_city,
                'state_id'=>$request->input('state_id'),
                    );
                $pickup = Pickup::create($data);

               $data2 = array(
                'drop_city'=>$pick_city,
                'state_id'=>$request->input('state_id'),
                
                );
                $pickup = Dropcity::create($data2);
            if($request->id == 0) {

                $suv = 0;
                $sedan = 0;
                $innova = 0;
                $tempo = 0;
                $pcity_id=$pickup->id;
                $data = array("suv_km_rs"=>$suv,"sedan_km_rs"=>$sedan,"innova_km_rs"=>$innova,"tempo_tra_km_rs"=>$tempo,"pcity_id"=>$pcity_id);
                $id = Multicityprices::create($data);

                // DB::table('users')->insert($data);

        } else if($request->id != 0) {

        $data['id']= $request->id;
        }
        }

            // $data=array(
            //         'pick_city'=>$request->input('pick_city')

            //              );
            //           $pickup = Pickup::create($data);

   return redirect()->route('pickup.index')->with('success','Pickup City Inserted Successfully');
}


    public function edit($id)
    {

        $pickup = Pickup::select('pickups.*')->where('id',$id)->first();
        $state = States::select('states.*')->where('status','Active')->get();
        // return$state_id = $state->pluck('name','id')->all();
        return view('pickup.edit',compact('pickup','state'));
    }

    public function update(Request $request, $id)
    {
        $request;
        $string = $request->pick_city;
        $part = explode(',',$string);
         $pick_city = $part[0];
        $data = Pickup::select('pickups.*')->where('pick_city',$pick_city)->where('status_delete','No')->first();


        $this->validate($request, [

            'pick_city' => 'required |unique:pickups,pick_city',
        ]);

             
                $pickup = Pickup::find($id);
                $data = Pickup::where('id',$pickup->id)->update([
                    'pick_city'=>$pick_city,

                   ]);
                   $data = Dropcity::where('id',$pickup->id)->update([
                    'drop_city'=>$pick_city,

                   ]);

                return redirect()->route('pickup.index')
                    ->with('success','Pickup city updated successfully');
            
        
      




    }
    public function changestatus($nm,$id)
    {



        if($nm == "Inactive"){
            $nm1 = 0;
        }else{
            $nm1 = 1;
        }

$nowdate = date('Y-m-d H:i:s');

          $data = Pickup::where('id',$id)->update([
            "status"     =>$nm1 ,
            "updated_at" =>$nowdate
           ]);

        // //   Onewaydetails::where('id',$id)->update(['status'=>$status]);
        //   return redirect()->route('onewaydetails.index')
        //      ->with('success','Status Updated Successfully');
    }
    public function destroy($id)
    {
        Pickup::find(decrypt($id))->delete();
        return redirect()->route('pickup.index')
            ->with('success','Pickup deleted successfully');
    } 
    public function deleteAll(Request $request)
    {
        $checkedcity_ids = $request->checkedcity_ids;
        Pickup::WhereIn('id',$checkedcity_ids)->delete();
        Dropcity::WhereIn('id',$checkedcity_ids)->delete();
        return response()->json(['code'=>1,'msg'=>'City hava Been Deleted successfully']);

    }
}
