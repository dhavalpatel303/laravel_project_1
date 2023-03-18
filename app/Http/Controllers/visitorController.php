<?php

namespace App\Http\Controllers;

use App\Visitor_details;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use DB;


class visitorController extends Controller
{
      public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Visitor_details::select('visitor_details.*')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                 })

                ->addColumn('created_at',function($row){

                    return $row->created_at->format('d-m-Y H:i:a');
                })
                ->rawColumns(['checkbox'])
                 ->make(true);
        }
        $data['meta_title'] = "Drop City";
        return view('visitor.index',$data);


    }



    public function destroy($id)
    {
        Visitor_details::find(decrypt($id))->delete();
        return redirect()->route('visitor.index')
            ->with('success','dropcity deleted successfully');
    }
    public function deleteAll(Request $request)
    {
        $checkedcity_ids = $request->checkedcity_ids;
        Visitor_details::WhereIn('id',$checkedcity_ids)->delete();
        return response()->json(['code'=>1,'msg'=>'City hava Been Deleted successfully']);

    }

}
