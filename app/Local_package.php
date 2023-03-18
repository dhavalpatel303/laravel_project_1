<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local_package extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'local_package','craeted_at','updated_at'
    ];


}
