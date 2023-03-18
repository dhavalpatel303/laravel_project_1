<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cupon_code','from_date','to_date','cupon_rate','min_amount','max_amount','status','status_active'
    ];


}
