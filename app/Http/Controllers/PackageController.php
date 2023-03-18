<?php

namespace App\Http\Controllers;
use App\Local_package;
use App\Pickup;
use App\Dropcity;
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
use DB;


class PackageController extends Controller
{
      public function index(Request $request)
    {
        // return $data = Local_package::select('cab_masters.*')
        //                     ->orderBy('id', 'desc')
        //                     ->get();
        if ($request->ajax()) {
            $data = Local_package::select('local_packages.*')
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
                    return '<img src="'. $url .'" width="100" height="100"  class="b1"/>';
                    }
                    else{
                        $url = url("public/profile/".$row->image);
                    return '<img src="'. $url .'" width="100" height="100"  class="b1"/>';
                    }

                })

                ->setRowAttr([
                    'style' => function($row){
                        return $row->status==0 ? 'background-color: #fbdddd;border-bottom:1px solid #c1c1c1' : 'background-color: #d4f4e2;border-bottom:1px solid #c1c1c1';
                    }
                ])
                ->addColumn('action', function($row){
                    $html =  '<a class="btn btn-icon btn-outline-primary" href="'.url('admin/package/edit',$row->id).'" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 font-medium-3 text-info me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" style="color:#7367F0;"></path></svg></a>
                             ';

                    return $html;

                })
                ->addColumn('status',function($row){
                    if($row->status==1){
                        $currentst='Active';
                        $nm='InActive';
                        $btn="btn-success";

                    }else{
                        $currentst='InActive';
                        $nm='Active';
                        $btn="btn-danger";


                    }

                        return '<a href="'.url('admin/package/changestatus/'.$nm.'/'.$row->id).'" class="statuschange"><button  class="btn '.$btn.' me-1 waves-effect waves-float waves-light">'.$currentst.'</button></a>';

                })
                ->addColumn('local_package', function($row){
                    $local_package = $row->local_package;
                    if (!empty($local_package)) {
                    return '<label>'.ucwords($local_package).'</label>&nbsp';
                    } else {
                        return '<label>-</label>';
                    }
                })


                ->addColumn('created_at',function($row){

                    return $row->created_at->format('d-m-Y');
                })
                ->rawColumns(['action','local_package','checkbox','status'])
                ->make(true);
        }
        return view('package.index');
    }
    public function create()
    {

        $data['meta_title'] = "Add Drive ";
        return view('package.create',$data);
    }
  public function store(Request $request)
    {
        $this->validate($request, [
            'local_package'=>'required',
        ]);


         $data=array('local_package'=>$request->input('local_package'));
        $package = Local_package::create($data);
        return redirect()->route('package.index')
            ->with('success','record Inserted successfully');

    }

    public function edit($id)
    {
        $package = Local_package::find($id);
        return view('package.edit',compact('package'));
    }
    public function changestatus($nm,$id)
    {



        if($nm == "InActive"){
            $nm1 = 0;
        }else{
            $nm1 = 1;
        }

$nowdate = date('Y-m-d H:i:s');

          $data = Local_package::where('id',$id)->update([
            "status"     =>$nm1 ,
            "updated_at" =>$nowdate
           ]);
    }
    public function update(Request $request, $id)
    {


          $data=array('local_package'=>$request->input('local_package'));

        $package = Local_package::find($id);
        Local_package::where('id',$package->id)->update($data);
       return redirect()->route('package.index')
        ->with('success','record Updated successfully');
    }
    public function destroy($id)
    {
        Local_package::find(decrypt($id))->delete();
        return redirect()->route('cab_master.index')
            ->with('success','record deleted successfully');
    }
    public function deleteAll(Request $request)
    {
        $checkedcity_ids = $request->checkedcity_ids;
        Local_package::WhereIn('id',$checkedcity_ids)->delete();
        return response()->json(['code'=>1,'msg'=>'Your Selected Data Been Deleted successfully']);

    }


}
