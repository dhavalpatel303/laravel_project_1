<?php

namespace App\Http\Controllers;
use App\Cab_master;
use App\Pickup;
use App\Dropcity;
use App\Multicitycabs;
use App\Onewaybookings;
use App\Onewaydetails;
use App\Driver;
use App\Cupon;
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


class Cab_masterController extends Controller
{
      public function index(Request $request)
    {
        // return $data = Cab_master::select('cab_masters.*')
        //                     ->orderBy('id', 'desc')
        //                     ->get();
        if ($request->ajax()) {
            $data = Cab_master::select('cab_masters.*')
            ->orderBy('id', 'desc')
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                 })
                 ->addColumn('image', function($row){
                    if($row->image==''){
                        $url = url("public/profile/defult.png");
                    return '<img src="'. $url .'" class="b1"/>';
                    }
                    else{
                        $url = url("public/profile/".$row->image);
                    return '<img src="'. $url .'" class="b1"/>';
                    }

                })

                ->setRowAttr([
                    'style' => function($row){
                        return $row->cab_status==0 ? 'background-color: #fbdddd;border-bottom:1px solid #c1c1c1' : 'border-bottom:1px solid #c1c1c1';
                    }
                ])
                ->addColumn('action', function($row){
                    $html = '<a  href="'.url('admin/cab_master/edit',$row->id).'" class="btn btn-info card-title"><i class=" fas fa-pencil-alt"></i></a>';


                    return $html;

                })
                ->addColumn('status',function($row){
                    if($row->cab_status==1){
                        $currentst='Active';
                        $nm='Inactive';
                        $btn="btn-success";

                    }else{
                        $currentst='Inactive';
                        $nm='Active';
                        $btn="btn-danger";


                    }

                        return '<a href="'.url('admin/cab_master/changestatus/'.$nm.'/'.$row->id).'" class="statuschange"><button  class="btn '.$btn.' me-1 waves-effect waves-float waves-light">'.$currentst.'</button></a>';

                })
                ->addColumn('cab', function($row){
                    $cab = $row->cab;
                    if (!empty($cab)) {
                    return '<label>'.ucwords($cab).'</label>&nbsp';
                    } else {
                        return '<label>-</label>';
                    }
                })
                ->addColumn('seat', function($row){
                    $seat = $row->seat;
                    $bag = $row->bag;
                    if (!empty($seat)) {
                    return '<label><i class="fa fa-user"></i> : '.ucwords($seat).' Seat</label><br>
                    <label><i class="fa fa-briefcase"></i> : '.ucwords($bag).' Bag</label>';
                    } else {
                        return '<label>-</label>';
                    }
                })
                ->addColumn('km_rate', function($row){
                    $km_rate = $row->km_rate;
                    $mkm_rate = $row->mkm_rate;

                    return '<label style="font-size:13px">Oneway :'.ucwords($km_rate).'/Km</label><br>
                    <label style="font-size:13px">Round Trip :'.ucwords($mkm_rate).'/Km</label>';

                })


                ->addColumn('created_at',function($row){

                    return $row->created_at->format('d-m-Y');
                })
                ->rawColumns(['action','cab','checkbox','status','image','seat','bag','km_rate'])
                ->make(true);
        }
        return view('cab_master.index');
    }
    public function create()
    {

        $data['meta_title'] = "Add Drive ";
        return view('cab_master.create',$data);
    }
  public function store(Request $request)
    {
        // $this->validate($request, [
        //     'cab'=>'required',
        //     'avilable cabs'=> 'required',
        //     'km rate'=>'required',
        //     'extra km rate'=>'required',
        //     'seat'=>'required',
        //     'bag'=>'required',
        // ]);
            // return $request;
        // $input = $request->all();
        if($image = $request->file('image')) {
            $name = "image_".rand(1,500).'.'.$image->getClientOriginalExtension();
            $target_path = public_path('/profile');

            if($image->move($target_path, $name)) {
                $image = $name;
            }
            else{
                $image = '';
            }
        }else{
            $image = '';
        }
        // return $request;
          $data=array('cab'=>$request->input('cab'),'av_cabs'=>$request->input('av_cabs'),'km_rate'=>$request->input('km_rate'),'ekm_rate'=>0,'seat'=>$request->input('seat'),'bag'=>$request->input('bag'),'image'=>$image,'mkm_rate'=>$request->input('mkm_rate'));
        $cab_master = Cab_master::create($data);
        $multy_cabs = array('cab_id'=>$cab_master->id,'cab_type'=>$cab_master->cab,'tall_tax'=>0,'state_tax'=>0,'gst'=>0,'driver_allowance'=>0,'minkm'=>0,'maxkm'=>0,'seat'=>0,'bag'=>0);
        $multycity = Multicitycabs::create($multy_cabs);
        return redirect()->route('cab_master.index')
            ->with('success','Record Inserted Successfully');

    }

    public function edit($id)
    {
        $cab_master = Cab_master::find($id);
        return view('cab_master.edit',compact('cab_master'));
    }
    public function changestatus($nm,$id)
    {



        if($nm == "Inactive"){
            $nm1 = 0;
        }else{
            $nm1 = 1;
        }

$nowdate = date('Y-m-d H:i:s');

          $data = Cab_master::where('id',$id)->update([
            "cab_status"     =>$nm1 ,
            "updated_at" =>$nowdate
           ]);
    }
    public function update(Request $request, $id)
    {

    if($iamge = $request->file('image')) {

         $oldimage = Cab_master::find($id);

        if(file_exists(public_path('profile/'.$oldimage->image)) AND !empty($oldimage->image)){

            unlink(public_path('profile/'.$oldimage->image));
        }

        $name = "image_".rand(1,500).'.'.$iamge->getClientOriginalExtension();

        $target_path = public_path('profile/');

        if($iamge->move($target_path, $name)) {

             $iamge = $name;
        }
        else{

             $iamge = '';
        }
    }else{

          $iamge = ($img = Cab_master::find($id)) ? $img->image : '' ;
    }
        // return $request;
          $data=array('cab'=>$request->input('cab'),'av_cabs'=>$request->input('av_cabs'),'seat'=>$request->input('seat'),'bag'=>$request->input('bag'),'ekm_rate'=>0,'km_rate'=>$request->input('km_rate'),'image'=>$iamge,'mkm_rate'=>$request->input('mkm_rate'));

        $cab_master = Cab_master::find($id);
        Cab_master::where('id',$cab_master->id)->update($data);
       return redirect()->route('cab_master.index')
        ->with('success','Record Updated Successfully');
    }
    public function destroy($id)
    {
        Cab_master::find(decrypt($id))->delete();
        return redirect()->route('cab_master.index')
            ->with('success','record deleted successfully');
    }
    public function deleteAll(Request $request)
    {
        $checkedcity_ids = $request->checkedcity_ids;
        $image = Cab_master::select('cab_masters.image')->where('id',$checkedcity_ids)->first();
        if(file_exists(public_path('profile/'.$image->image))){
           file::delete(public_path('profile/'.$image->image));
        }else{
            return "Image Not Found";
        }
        Cab_master::WhereIn('id',$checkedcity_ids)->delete();
        return response()->json(['code'=>1,'msg'=>'Your Selected Record Been Deleted successfully']);

    }


}
