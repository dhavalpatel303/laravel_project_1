<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Captcha extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'captcha','created_at','updated_at',
    ];


}
