<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use DB;


class TestimonialController extends Controller
{
      public function index(Request $request)
    {
        // return $data = Testimonial::select('testimonials.*')
        //                     ->where('testimonials.status_delete','No')
        //                     ->orderBy('id', 'desc')
        //                     ->get();
        if ($request->ajax()) {
            $data = Testimonial::select('testimonials.*')
                            ->where('testimonials.status_delete','No')
                            ->orderBy('id', 'desc')
                            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                 })
                 ->addColumn('profile', function($row){
                    if($row->profile==''){
                        $url = url("public/profile/defult.png");
                    return '<img src="'. $url .'" width="100" height="100"  class="b1"/>';
                    }
                    else{
                        $url = url("public/profile/".$row->profile);
                    return '<img src="'. $url .'" width="100" height="100"  class="b1"/>';
                    }

                })
                ->addColumn('action', function($row){
                      $html = '<a  href="'.url('admin/testimonial/edit',$row->id).'" class="btn btn-info card-title"><i class=" fas fa-pencil-alt"></i></a>';

                    return $html;
      

                })
                ->addColumn('name', function($row){
                    $name = $row->name;
                    if (!empty($name)) {
                    return '<label>'.ucwords($name).'</label>&nbsp';
                    } else {
                        return '<label>-</label>';
                    }
                })

                ->addColumn('created_at',function($row){

                    return $row->created_at->format('d-m-Y');
                })
                ->rawColumns(['action','name','checkbox','profile'])
                ->make(true);
        }
        return view('testimonial.index');
    }
    public function create()
    {

        $data['meta_title'] = "Add Drive ";
        return view('testimonial.create',$data);
    }
  public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'message'=> 'required',
        ]);

        // $input = $request->all();
        if($image = $request->file('profile')) {
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
        $data=array('name'=>$request->input('name'),'message'=>$request->input('message'),'profile'=>$image);
        $testimonial = Testimonial::create($data);
        return redirect()->route('testimonial.index')
            ->with('success','record Inserted successfully');

    }

    public function edit($id)
    {
        $testimonial = Testimonial::find($id);
        return view('testimonial.edit',compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        // return $request;
        $this->validate($request, [
            'name'=>'required',
            'message'=> 'required',

        ]);

        // return $profile = $request->file('profile');
    //    return  unlink(public_path('profile/'.$oldImage->profile));
    if($profile = $request->file('profile')) {

         $oldprofile = Testimonial::find(decrypt($id));

        if(file_exists(public_path('profile/'.$oldprofile->profile)) AND !empty($oldprofile->profile)){

            unlink(public_path('profile/'.$oldprofile->profile));
        }

        $name = "profile_".rand(1,500).'.'.$profile->getClientOriginalExtension();

        $target_path = public_path('profile/');

        if($profile->move($target_path, $name)) {

             $profile = $name;
        }
        else{

             $profile = '';
        }
    }else{

          $profile = ($img = Testimonial::find(decrypt($id))) ? $img->profile : '' ;
    }
         $data=array('name'=>$request->input('name'),'message'=>$request->input('message'),'profile'=>$profile);

        $testimonial = Testimonial::find(decrypt($id));
         Testimonial::where('id',$testimonial->id)->update($data);
       return redirect()->route('testimonial.index')
        ->with('success','record Updated successfully');
    }
    public function destroy($id)
    {
        Testimonial::find(decrypt($id))->delete();
        return redirect()->route('testimonial.index')
            ->with('success','record deleted successfully');
    }
    public function deleteAll(Request $request)
    {
        $checkedcity_ids = $request->checkedcity_ids;
        Testimonial::WhereIn('id',$checkedcity_ids)->delete();
        return response()->json(['code'=>1,'msg'=>'Your Selected Data Been Deleted successfully']);

    }


}
