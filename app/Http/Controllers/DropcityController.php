<?php

namespace App\Http\Controllers;

use App\Dropcity;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use DB;


class DropcityController extends Controller
{
      public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Dropcity::select('dropcities.*')
                ->where('dropcities.status_delete','No')
                ->orderBy('id', 'desc')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                 })
                ->addColumn('action', function($row){
                    $html =  '<a class="btn btn-icon btn-outline-primary" href="'.url('admin/dropcity/edit',encrypt($row->id)).'" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 font-medium-3 text-info me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" style="color:#7367F0;"></path></svg></a>';

                    return $html;
                })
                ->addColumn('drop_city', function($row){
                    $city = $row->drop_city;
                    if (!empty($city)) {
                    return '<label>'.ucwords($city).'</label>&nbsp';
                    } else {
                        return '<label>-</label>';
                    }
                })
                ->addColumn('created_at',function($row){

                    return $row->created_at->format('d-m-Y');
                })
                ->rawColumns(['action','drop_city','checkbox'])
                ->make(true);
        }
        $data['meta_title'] = "Drop City";
        return view('dropcity.index',$data);


    }

    public function create()
    {

        $data['meta_title'] = "Create Drop City";
        return view('dropcity.create',$data);
    }
    public function store(Request $request)

    {
        $data = Dropcity::select('dropcities.*')->where('drop_city', '=', $request->input('drop_city'))->where('status_delete','No')->first();
        if($data !=''){
            $this->validate($request, [
                'drop_city' => 'required|unique:dropcities,drop_city',



            ]);
        }
        else{
            $input = $request->all();
            $dropcity = Dropcity::create($input);
            return redirect()->route('dropcity.index')
                ->with('success','Drop City created successfully');
        }


    }

    public function edit($id)
    {
        $dropcity = Dropcity::find(decrypt($id));
        return view('dropcity.edit',compact('dropcity'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'drop_city' => 'required|unique:dropcities,drop_city',

        ]);

        $input = $request->all();
        $dropcity = Dropcity::find(decrypt($id));
        $dropcity->update($input);
        return redirect()->route('dropcity.index')
            ->with('success','Drop city updated successfully');
    }
    public function destroy($id)
    {
        Dropcity::find(decrypt($id))->delete();
        return redirect()->route('dropcity.index')
            ->with('success','Dropcity deleted successfully');
    }
    public function deleteAll(Request $request)
    {
        $checkedcity_ids = $request->checkedcity_ids;
        dropcity::WhereIn('id',$checkedcity_ids)->update(['status_delete'=>'Yes']);
        return response()->json(['code'=>1,'msg'=>'City hava Been Deleted successfully']);

    }

}
