<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multicitycabs extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'note','cab_id','cab_type','tall_tax','state_tax','gst','driver_allowance','minkm','maxkm','seat','bag','status','status_delete','cab_order'
    ];


}
