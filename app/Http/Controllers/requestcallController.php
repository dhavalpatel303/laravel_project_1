<?php

namespace App\Http\Controllers;

use App\Requestcall;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use DB;


class RequestcallController extends Controller
{
      public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Requestcall::select('requestcalls.*')->where('requestcalls.status_delete','No')->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                 })

                ->addColumn('created_at',function($row){

                    return $row->created_at->format('d-m-Y h:i A');
                })
                ->rawColumns(['checkbox'])
                 ->make(true);
        }
        $data['meta_title'] = "Drop City";
        return view('requestcall.index',$data);


    }



    public function destroy($id)
    {
        Requsetcall::find(decrypt($id))->delete();
        return redirect()->route('requestcall.index')
            ->with('success','dropcity deleted successfully');
    }
    public function deleteAll(Request $request)
    {
        $checkedcity_ids = $request->checkedcity_ids;
        Requestcall::WhereIn('id',$checkedcity_ids)->update(['status_delete'=>'Yes']);
        return response()->json(['code'=>1,'msg'=>'City hava Been Deleted successfully']);

    }

}
