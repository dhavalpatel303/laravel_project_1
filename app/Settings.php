<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url','name','address','email','mobile','alt_mobile','map_url','site_logo','fb_url','insta_url','tweet_url','youtube_url','created_date','cin_no','gst_no','favicon','signeture'
    ];


}
