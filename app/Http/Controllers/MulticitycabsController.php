<?php

namespace App\Http\Controllers;

use App\Multicitycabs;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Oneway_note;
use App\Cab_master;
use DataTables;
use DB;
use PhpParser\Node\Stmt\Return_;

class MulticitycabsController extends Controller
{

    public function index()
    {

        $suv = Multicitycabs::select('multicitycabs.*')->where('id','2')->where('status_delete','No')->first();
         $sedan=  Multicitycabs::select('multicitycabs.*')->where('id','1')->where('status_delete','No')->first();
         $innova= Multicitycabs::select('multicitycabs.*')->where('id','3')->where('status_delete','No')->first();
         $tempo= Multicitycabs::select('multicitycabs.*')->where('id','4')->where('status_delete','No')->first();
         $primesedan= Multicitycabs::select('multicitycabs.*')->where('id','5')->where('status_delete','No')->first();
         $primesuv= Multicitycabs::select('multicitycabs.*')->where('id','6')->where('status_delete','No')->first();
         $note= Multicitycabs::select('multicitycabs.*')->where('id','1')->where('status_delete','No')->first();
         $cab = Multicitycabs::select('multicitycabs.*','cab_masters.cab','cab_masters.image','cab_masters.mkm_rate','cab_masters.av_cabs','cab_masters.cab_status')
                                ->join('cab_masters','cab_masters.id','multicitycabs.cab_id')
                                ->where('cab_masters.cab_status',1)
                                ->orderby('multicitycabs.cab_id','desc')
                                ->get();
        //  $cab = Cab_master::select('cab_masters.*')->where('cab_status','1')->get();
         return view('multicitycabs.index',compact('suv','sedan','innova','tempo','note','primesedan','primesuv','cab'));

    }

    public function updateSedan(Request $request)
    {
        $input = $request->all();

         Multicitycabs::where('id',$request->id)->update([
            "gst"     => $request->gst,
           "driver_allowance"      => $request->driver_allowance,
           "minkm"=>$request->minkm,
           "seat"=>$request->seat,
           "bag"=>$request->bag,
           "cab_order"=>"a"
           ]);
        return redirect()->route('multicitycabs.index')
            ->with('success','Cab Data Updated Successfully');

    }

    public function updateNote(Request $request)
    {

        $input = $request->all();
        $cab = Multicitycabs::select('multicitycabs.*')->get();
        for($i=0;$i<count($cab);$i++){
            $note = Multicitycabs::select('id')->where('id',$cab[$i]['id'])->first();
            $note->update($input);
        }

        return redirect()->route('multicitycabs.index')
            ->with('success','Note Updated successfully');

    }
    public function update_Note(Request $request,$id=1){
        $note = Oneway_note::select('oneway_notes.*')->where('id',1)->first();
        return view('multicitycabs.note',compact('note'));
    }
    public function update_onewaynote(Request $request){
        Oneway_note::where('id',1)->update([
            "oneway_note"     => $request->oneway_note,
            "local_note"=> $request->local_note,

           ]);
           return  redirect()->route('updateNote', ['id' =>1])
           ->with('success','Note updated successfully');
    }
    public function update_localnote(Request $request){
        Oneway_note::where('id',1)->update([
            "local_note"     => $request->local_note,

           ]);
           return redirect()->route('home')
            ->with('success','Note updated successfully');
    }

}
