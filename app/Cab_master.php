<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cab_master extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cab','created_at','updated_at','km_rate','ekm_rate','cab_status','image','seat','bag','av_cabs','mkm_rate'
    ];


}
