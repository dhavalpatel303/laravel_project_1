<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oneway_note extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','oneway_note','local_note','craeted_at','updated_at'
    ];


}
