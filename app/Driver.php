<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_name','driver_name','driver_mobile','cab_name','cab_number','status','booking_id'
    ];


}
