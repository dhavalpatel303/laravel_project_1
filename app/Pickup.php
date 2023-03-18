<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pick_city','state_id'
    ];


}
