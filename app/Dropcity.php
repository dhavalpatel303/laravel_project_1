<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dropcity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'drop_city','state_id'
    ];


}
