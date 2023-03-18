<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Inquries;
use App\Pickup;
use App\Dropcity;
use App\Onewaybookings;
use App\Onewaydetails;
use App\Localdetails;
use App\Driver;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use Helpers;
use DB;

class OnewaycabController extends Controller
{

    public function index(Request $request )
    {
            return view('frontend.onewaycab.index');
    }
}
