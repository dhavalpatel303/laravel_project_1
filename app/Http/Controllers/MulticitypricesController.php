<?php

namespace App\Http\Controllers;

use App\Multicityprices;
use App\Pickup;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Collection;
use DataTables;
use DB;
use PhpParser\Node\Stmt\Return_;

class MulticitypricesController extends Controller
{

    public function index()
    {
          $price= Multicityprices::select('multicityprices.*','pickups.*')->join('pickups','multicityprices.pcity_id','pickups.id')->where('status_delete','No')->get();
          $lastid_get = Multicityprices::select('id')->orderby('id','desc')->first();
        return view('multicityprices.index',compact('price','lastid_get'));

    }
    public function insertrecord(Request $request)
    {
        $this->validate($request, [
            'suv_km_rs' =>'required',
            'sedan_km_rs'=>'required',
            'innova_km_rs'=>'required',
            'primesedan_km_rs'=>'required',
            'primesuv_km_rs'=>'required',
            'tempo_tra_km_rs'=>'required',


        ]);

         $pcity_id = $request->pcity_id;
          $suv_km_rs			=	$request->suv_km_rs;
          $sedan_km_rs		=	$request->sedan_km_rs;
          $innova_km_rs		=	$request->innova_km_rs;
          $tempo_tra_km_rs	=	$request->tempo_tra_km_rs;
          $primesedan_km_rs		=	$request->primesedan_km_rs;
          $primesuv_km_rs		=	$request->primesuv_km_rs;
          $lastid_get = Multicityprices::select('id')->orderby('id','desc')->count();


        if($lastid_get != '' && $lastid_get > 0)
        {
            for ($i = 0; $i < count($pcity_id); $i++)
            {

                $multi_city_id=$pcity_id[$i];

                $datas['suv_km_rs'] = $suv_km_rs[$i];
                $datas['sedan_km_rs'] =$sedan_km_rs[$i];
                $datas['innova_km_rs'] = $innova_km_rs[$i];
                $datas['tempo_tra_km_rs'] = $tempo_tra_km_rs[$i];
                $datas['primesedan_km_rs'] = $primesedan_km_rs[$i];
                $datas['primesuv_km_rs'] = $primesuv_km_rs[$i];
                 $updatedata = Multicityprices::select('multicityprices.*')->where('pcity_id',$multi_city_id)->first();
                $updatedata->update($datas);

                        //    $localdetail = localdetails::find(decrypt($id));
                        //    $localdetail->update($data);
            }

        }
        else{
            return "hello";
        }
            return redirect()->route('multicityprices.index')
                ->with('success','data updated successfully');
    }
}
