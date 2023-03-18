<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inquries extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','mobile_no','email_ids','from_city','to_city','message','status'
    ];


}
