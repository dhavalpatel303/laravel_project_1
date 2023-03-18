<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multicityprices extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pcity_id','suv_km_rs','sedan_km_rs','innova_km_rs','tempo_tra_km_rs','primesedan_km_rs','primesuv_km_rs','status_delete'
    ];


}
