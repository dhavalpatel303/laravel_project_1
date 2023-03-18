<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use DB;


class AdminController extends Controller
{
      public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Admin::all();
            return Datatables::of($data);
        }
        $data['meta_title'] = "User Management";
    }


}
