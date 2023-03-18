<?php

namespace App\Http\Controllers;

use App\Cupon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use DB;
use App\Advertisements;


class CuponController extends Controller
{
      public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Cupon::select('cupons.*')
                            ->where('status_delete','No')
                            ->orderBy('id', 'desc')
                            ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="city_checkbox" data-id="'.$row['id'].'"><label></label>';
                 })
                ->addColumn('action', function($row){
                     $html = '<a  href="'.url('admin/cupon/edit',$row->id).'" class="btn btn-info card-title"><i class=" fas fa-pencil-alt"></i></a>';
                    return $html;
                })
                ->addColumn('status',function($row){


                    if ($row->status=='Avilable')
                    {
                            return '
                            <label class="cab_label_success"><a class="font fsize"></a> <span style="font-size:11px;">Available</span></label>
                            ';
                    }
                      else
                        {
                                    return '<span class="badge badge-glow bg-danger" style="color:white">Expired</span>';
                        }
                })
                // ->setRowAttr([
                //     'style' => function($row){
                //         return $row->status=='Avilable' ? 'background-color: #d4f4e2;' : 'background-color: #fbdddd;';
                //     }
                // ])
                ->addColumn('status_active',function($row){
                    if($row->status_active == "1")
                        {
                            return '<div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Active</button>
                            <div class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item status_cancel" href="'.url('admin/coupon/changestatus/'.$row->id).'">Inactive</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="'.url('admin/coupon/edit',$row->id).'">Edit</a>
                                </li>

                            </div>
                        </div>';
                        }
                        else{
                            return '<div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Inactive</button>
                        <div class="dropdown-menu">
                            <li>
                                <a class="dropdown-item status_change" href="'.url('admin/coupon/status_change/'.$row->id).'">Active</a>
                            </li>


                        </div>
                    </div>';
                        }

                })

                ->addColumn('created_at',function($row){

                    return $row->created_at->format('d-m-Y');
                })
                ->addColumn('from_date',function($row){

                    // return $row->from_date;
                    return $row['from_date']   = trim(date_format(date_create($row['from_date']),'d/m/Y '));
                })
                ->addColumn('to_date',function($row){
                    // return $row->to_date;
                    return $row['to_date']   = trim(date_format(date_create($row['to_date']),'d/m/Y '));
                })
                ->rawColumns(['action','from_date','to_date','status','checkbox','status_active'])
                ->make  (true);
        }
        $data['meta_title'] = "Add Cupon";
        return view('cupon.index',$data);
    }

    public function changestatus(Request $request)
    {

         $checkedcity_ids = $request->id;

         Cupon::Where('id',$checkedcity_ids)->update(['status_active'=>'0']);
        //  return redirect()->route('multy_bookings.index')->with('success','Bookings Canceled Successfully !');

    }
    public function status_change(Request $request)
    {
        // return $request;
        $checkedcity_ids = $request->id;

        Cupon::Where('id',$checkedcity_ids)->update(['status_active'=>'1']);
        //  return redirect()->route('multy_bookings.index')->with('success','Bookings Canceled Successfully !');

    }
    public function create()
    {

        $data['meta_title'] = "Add Cupon ";
        return view('cupon.create',$data);
    }
  public function store(Request $request)
    {
        $this->validate($request, [
             'cupon_code'=>'required |unique:cupons,cupon_code',
            'from_date' =>'required|after:today',
            'to_date' =>'date|after:from_date',
            'cupon_rate'  => 'required|numeric',


        ]);



        $input = $request->all();
                // return $request;
               $date =trim(date_format(date_create($request->from_date), 'Y/m/d'));
                $from =  trim(date_format(date_create($request->from_date), 'Y/m/d'));
                 $to = trim(date_format(date_create($request->to_date), 'Y/m/Y'));

                if($date .'between'. $from .'and'. $to)
                {
                   $input['status'] = 'Avilable';
               }else{
                 $input['status'] = 'expired';
               } 

        // $input['from_date']   = trim(date_format(date_create($input['from_date']),'d-m-Y'));
        // $input['to_date']   = trim(date_format(date_create($input['to_date']),'d-m-Y'));
        $cupon = Cupon::create($input);
        return redirect()->route('cupon.index')
            ->with('success','Coupon created successfully');
    }

    public function edit($id)
    {
        $cupon = Cupon::find($id);
        return view('cupon.edit',compact('cupon'));
    }

    public function update(Request $request, $id)
    {

        {
            $this->validate($request, [
                // 'cupon_code' => 'required|unique:cupons,cupon_code',
                // 'from_date' =>'required|after:today',
                // 'to_date' =>'date|after:from_date',
                 'cupon_code'=>'required |unique:cupons,cupon_code',
                'cupon_rate'  => 'required|numeric',


            ]);


            $cupon = Cupon::find(decrypt($id));
             $input = $request->all();
             $date =trim(date_format(date_create($request->from_date), 'd-m-Y'));

             $from =  trim(date_format(date_create($request->from_date), 'd-m-Y'));
             $to = trim(date_format(date_create($request->to_date), 'd-m-Y'));
                  if ($date .'between'. $from .'and'. $to){

                  $data = Cupon::where('id',$cupon->id)->update([
                    "cupon_code"     => $request->cupon_code,
                    'from_date' => $from,
                    'to_date'=>$to ,
                    'cupon_rate'=>$request->cupon_rate,
                    'min_amount'=>$request->min_amount,
                    'max_amount'=>$request->max_amount,
                    'status'=>'Avilable',
                   ]);
               }
               else{
                $data = Cupon::where('id',$cupon->id)->update([
                    "cupon_code"     => $request->cupon_code,
                    'from_date' => $from,
                    'to_date'=>$to ,
                    'cupon_rate'=>$request->cupon_rate,
                    'min_amount'=>$request->min_amount,
                    'max_amount'=>$request->max_amount,
                    'status'=>'expired',
                   ]);
               }


             $cupon->update($input);
            return redirect()->route('cupon.index')
                ->with('success','Coupon Updated Successfully');
        }


    }
    public function home_cupon(Request $request)
    {
         $today = $request->post('today');
         $today_date =  date_format(date_create($today),'Y-m-d') ;
         $result = Cupon::select('cupons.*')->where('status_delete','No')->get();
        //   $date= date_format(date_create($result->to_date),'Y-m-d') ;

         for($i=0;$i<count($result);$i++)
         {
                $date= date_format(date_create($result[$i]['to_date']),'Y-m-d') ;

             if($today_date>$date){
                $data = Cupon::where('id',$result[$i]['id'])->update([
                    "cupon_code"     => $result[$i]['cupon_code'],
                    'from_date' => $result[$i]['from_date'],
                    'to_date'=> $result[$i]['to_date'] ,
                    'cupon_rate'=> $result[$i]['cupon_rate'] ,
                    'min_amount'=> $result[$i]['min_amount'] ,
                    'max_amount'=> $result[$i]['max_amount'] ,
                    'status'=>'expired',
                ]);
                // return "success";
             }
         }
    }

public function destroy($id)
    {
        Cupon::find(decrypt($id))->delete();
        return redirect()->route('cupon.index')
            ->with('success','coupon deleted successfully');
    }
    public function deleteAll(Request $request)
    {
        $checkedcity_ids = $request->checkedcity_ids;
        Cupon::WhereIn('id',$checkedcity_ids)->update(['status_delete'=>'Yes']);
        return response()->json(['code'=>1,'msg'=>'Your Data hava Been Deleted successfully']);

    }

    public function advertisements()
    {
        $data= Advertisements::select('advertisements.*')->orderby('id','desc')->first();
        return view('cupon.advertisements',compact('data'));
    }
    public function update_ads(Request $request,$id)
{
    $input = $request->all();
    $ads = Advertisements::find($id);
    $ads->update($input);
    return redirect()->route('advertisements')
    ->with('success','Data is updated successfully');
}
}
