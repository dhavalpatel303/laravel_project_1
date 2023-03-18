<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localdetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pcity_id','dropcity','hours','kms','cab_type','amount','ehr','ekr','gst','status','total_amount','cab_order'
    ];


}
