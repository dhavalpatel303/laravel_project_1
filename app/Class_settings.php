<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Class_settings extends Model {
    static $tbl_settings        = 'settings';

    public static function get_common_settings($option)
    {
        $value=DB::table(static::$tbl_settings)->whereIn('option_name',$option)->select('option_name','option_value')->get()->keyBy('option_name');
        return $value; 
    }
    public static function get_settings()
    {
        $value=DB::table(static::$tbl_settings)->select('option_name','option_value')->get()->keyBy('option_name');
        return $value; 
    }
    public static function save_settings($setting_data)
    {
        foreach ($setting_data as $title => $setting_value) 
        {
            try {
               
               DB::table(static::$tbl_settings)->insert(array('option_name'=>$title,'option_value'=>$setting_value));

            } catch(\Illuminate\Database\QueryException $e){
               
                DB::table(static::$tbl_settings)->where(['option_name'=>$title])->update(array('option_value'=>$setting_value));
            }
        }
    }   
}