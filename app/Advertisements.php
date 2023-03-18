<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisements extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','created_at','updated_at'
    ];


}
