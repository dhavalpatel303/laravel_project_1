<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor_details extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'visitor_ip','page','created_at','updated_at','status'
    ];


}
