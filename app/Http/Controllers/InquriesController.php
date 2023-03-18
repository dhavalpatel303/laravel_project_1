<?php

namespace App\Http\Controllers;

use App\Inquries;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use DB;


class InquriesController extends Controller
{
      public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Inquries::select('inquries.*')->where('inquries.status_delete','No')->orderby('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                 })


                ->addColumn('created_at',function($row){
                        return $row['created_at'] = trim(date_format(date_create($row['created_at']),'d-m-Y'));
                })
                ->rawColumns(['action','checkbox'])
                ->make(true);
        }
        $data['meta_title'] = "User Management";
        return view('inquries.index',$data);

//        $data = User::orderBy('id','DESC')->paginate(5);
//        return view('users.index',compact('data'))
//            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function deleteAll(Request $request)
    {
        $checkedcity_ids = $request->checkedcity_ids;
        Inquries::WhereIn('id',$checkedcity_ids)->update(['status_delete'=>'Yes']);
        return response()->json(['code'=>1,'msg'=>'Your Data hava Been Deleted successfully']);

    }

}
