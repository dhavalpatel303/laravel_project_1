<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multicitybookings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','driver_id','cupon_id','pickupcity_id','travel_city','order_no','s_request','pickup_date','pickup_time'
        ,'return_date','journey','pickup_location','drop_city','drop_location','alt_mobile','flight_number','cab_type',
        'tall_tax','state_tax','gst','driver_allowance','minkm','seat','bag','travelkms','estimate_kms','perkm_rate','ride_gst',
        'discount','extra_charge','pay_driver','pay_paytm','paytm_order','paytm_amount','discount_member','total_amount','paid',
        'booking_status','status','add_form','created_at','updated_at','status_delete','gross_total','status','status_delete',
    ];


}
