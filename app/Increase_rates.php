<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Increase_rates extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id','type','percentage','status','created_at','updated_at'
    ];


}
