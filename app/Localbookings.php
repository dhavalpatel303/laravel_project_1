<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localbookings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pickupcity_id','user_id','dropcity_id','cab_type','flight_number','orderno','s_request',
        'pickup_date','pickup_time','discount','extra_charge','gross_total','localdetail_id',
        'customer_mobile','customer_name','email','alternet_mobile','total_amount',
        'pickup_location','drop_location'
    ];


}
