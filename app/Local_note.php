<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local_note extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','local_note','craeted_at','updated_at'
    ];


}
