<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Onewaydetails extends Model
{

    protected $fillable = [
        'pcity_id','dcity_id','cab_type','time','amount','tax','state_tax','gst','driver_allowance','total_amount','notice','popular_routes','status','km','km_rate','car_order'
    ];



}
