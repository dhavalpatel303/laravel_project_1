<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use App\Settings;
use DB;


class UserController extends Controller
{
      public function index(Request $request)
    {
        // return $data = User::select('users.*')->where('status_delete','1')->orderby('id','desc')->get();
        if ($request->ajax()) {
             $data = User::select('users.*')->where('status_delete','No')->where('name','!=','')->where('email','!=','')->where('user_mobile','!=','')->orderby('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                 })
                ->addColumn('action', function($row){

                    $html = '<a  href="'.url('admin/user_details/edit',$row->id).'" class="btn btn-info card-title"><i class=" fas fa-pencil-alt"></i></a>';
                    return $html;
                })

                ->addColumn('created_at',function($row){

                    $data = $row->created_at->format('d-m-Y');
                    $time = $row->created_at->format('h:i A');
                    return '<label>'.$data.'</label><br><label>'.$time.'</label>';

                })
                ->rawColumns(['action','checkbox','created_at'])
                ->make(true);
        }
        $data['meta_title'] = "User Management";
        return view('users.index',$data);

//        $data = User::orderBy('id','DESC')->paginate(5);
//        return view('users.index',compact('data'))
//            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['meta_title'] = "Create  User";
        return view('users.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name'       =>   'required',
            'user_mobile' => 'required|numeric|digits:10|unique:users,user_mobile|',
            // 'email'      => 'required|email|unique:users,email',
            // 'remark'       =>'required',


        ]);

        $input = $request->all();
        $user = User::create($input);
        return redirect()->route('users.index')
            ->with('success','User Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find(decrypt($id));
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
            return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // $this->validate($request, [
        //     'user_mobile' => 'required|numeric|digits:10|',
        //     'name'       =>   'required',
        //     // 'email'      => 'required|email|unique:users,email',
        // ]);
                // return $request;
        $input = $request->all();
        $user = User::find(decrypt($id));
        $user->update($input);
        return redirect()->route('users.index')
            ->with('success','User Updated Successfully');
    }

    public function destroy($id)
    {
        User::find(decrypt($id))->delete();
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
    public function deleteAll(Request $request)
    {
        $checkedcity_ids = $request->checkedcity_ids;
        User::WhereIn('id',$checkedcity_ids)->delete();
        return response()->json(['code'=>1,'msg'=>'User hava Been Deleted successfully']);

    }
    public function settings(Request $request)
    {
         $data = settings::select('settings.*')->first();
        return view('site_settings.setting',compact('data'));
    }
    public function setting_update(Request $request, $id)
    {



        if($profile = $request->file('site_logo')) {

            $oldprofile = Settings::find($id);

           if(file_exists(public_path('logo/'.$oldprofile->site_logo)) AND !empty($oldprofile->site_logo)){

               unlink(public_path('logo/'.$oldprofile->site_logo));
           }

           $name = "logo_".rand(1,500).'.'.$profile->getClientOriginalExtension();

           $target_path = public_path('logo/');

           if($profile->move($target_path, $name)) {

                $profile = $name;
           }
           else{

                $profile = '';
           }
       }else{

             $profile = ($img = Settings::find($id)) ? $img->site_logo : '' ;
       }



       if($favicon = $request->file('favicon')) {

        $oldfavicon = Settings::find($id);

       if(file_exists(public_path('logo/'.$oldfavicon->favicon)) AND !empty($oldfavicon->favicon)){

           unlink(public_path('logo/'.$oldfavicon->favicon));
       }

       $name = "favicon_".rand(1,500).'.'.$favicon->getClientOriginalExtension();

       $target_path = public_path('logo/');

       if($favicon->move($target_path, $name)) {

            $favicon = $name;
       }
       else{

            $favicon = '';
       }
   }else{

         $favicon = ($img = Settings::find($id)) ? $img->favicon : '' ;
   }


   if($signature = $request->file('signature')) {

    $oldsignature = Settings::find($id);

   if(file_exists(public_path('logo/'.$oldsignature->signature)) AND !empty($oldsignature->signature)){

       unlink(public_path('logo/'.$oldsignature->signature));
   }

   $name = "signature_".rand(1,500).'.'.$signature->getClientOriginalExtension();

   $target_path = public_path('logo/');

   if($signature->move($target_path, $name)) {

        $signature = $name;
   }
   else{

        $signature = '';
   }
}else{

     $signature = ($img = Settings::find($id)) ? $img->signature : '' ;
}



            $data=array('name'=>$request->input('name'),'url'=>$request->input('url'),'address'=>$request->input('address'),'email'=>$request->input('email'),'mobile'=>$request->input('mobile'),'cin_no'=>$request->input('cin_no'),'gst_no'=>$request->input('gst_no'),'alt_mobile'=>$request->input('alt_mobile'),'map_url'=>$request->input('map_url'),'fb_url'=>$request->input('fb_url'),'insta_url'=>$request->input('insta_url'),'tweet_url'=>$request->input('tweet_url'),'youtube_url'=>$request->input('youtube_url'),'site_logo'=>$profile,'favicon'=>$favicon,'signature'=>$signature);

           $settings = Settings::find($id);
            Settings::where('id',$settings->id)->update($data);
          return redirect()->route('site_settings')
           ->with('success','record Updated successfully');


        // return redirect()->route('site_settings');
    }
}
