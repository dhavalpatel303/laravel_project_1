<?php
	use App\Class_settings;
    use App\Cupon;
    use App\Settings;
    use App\Visitor_details;
    use App\Admin;
    use App\Advertisements;
    use App\Localdetails
;
	class Helpers
	{
        // static $ffmpeg = "/usr/bin/ffmpeg";
        static $ffmpeg = "C:\\ffmpeg\\bin\\ffmpeg";
		public static function thumbImage($image){
		    if($image!='')
			{
				$extension_pos = strrpos($image, '.');
		       	return $thumb = substr($image, 0, $extension_pos) . '_thumb' . substr($image, $extension_pos);
		    }else
		    {
		    	return 'thumb_noimage.png';
		    }
		}
		public static function common_settings()
		{
			return Class_settings::get_common_settings(['store_name','header_logo','footer_logo','post_earning','post_view']);
		}

        public static function visitorUpdate($url){


            $ip = $_SERVER['REMOTE_ADDR'];
            $nowdt = date('Y-m-d H:i:s');
             $getVisitors = Visitor_details::select('visitor_details.*')->where('status','Active')->where('visitor_ip',$ip)->get();
             $str_replace = $url;
             if (count($getVisitors) >= 1) {
                $dataUpdate['page'] = $str_replace;
                $dataUpdate['visitor_ip'] = $ip;
                $dataUpdate['update_date'] = $nowdt;
                Visitor_details::create($dataUpdate);

            } else if (count($getVisitors) < 1) {
                $data['page'] = $str_replace;
                $data['visitor_ip'] = $ip;
                $data['create_date'] = $nowdt;
                Visitor_details::create($data);
            }
        }

        public static function get_sms_url(){
            return  $the_content = Settings::select('settings.*')->orderby('settings.id','Asc')->limit('1')->first();
        }
        public static function missing(){
            return  view('frontend.about.error');
        }

        public static function coupon()
        {
             $coupon_details=Advertisements::select('name')->orderBy('id','desc')->first();
             return $coupon = $coupon_details->name;
        }
        public static function logo()
        {
           $logo = Settings::select('site_logo')->first();
           return $site_logo = $logo->site_logo;

        }
          public static function sign()
        {
           $sign = Settings::select('signature')->first();
           return $sign = $sign->signature;

        }
        public static function name()
        {
           $name = Settings::select('name')->first();
           return $site_name = $name->name;

        }
        public static function email()
        {
           $email = Settings::select('email')->first();
           return $site_email = $email->email;

        }
        public static function map()
        {
            $map = Settings::select('map_url')->first();
           return $site_map = $map->map_url;

        }
        public static function mobile()
        {
           $mobile = Settings::select('mobile')->first();
           return $site_mobile = $mobile->mobile;

        }
        public static function address()
        {
           $address = Settings::select('address')->first();
           return $site_address = $address->address;

        }
        public static function alt_mobile()
        {
           $alt_mobile = Settings::select('alt_mobile')->first();
           return $site_alt_mobile = $alt_mobile->alt_mobile;

        }
        public static function admin_name()
        {
            return $admin_name = Admin::pluck('name')->first();
        }
        public static function admin_email()
        {
            return $admin_email = Admin::pluck('email')->first();
        }
        public static function admin_mobile()
        {
            return $admin_mobile = Admin::pluck('admin_mobile')->first();
        }
        private static function get_title($filed_name,$title='',$tbl_name)
        {
            return DB::table($tbl_name)->where(array($filed_name=>$title))->select($filed_name)->first();
        }
        public static function slug($filed_name,$title,$tbl_name)
        {
            $title=preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ","-",$title));
            if(empty(static::get_title($filed_name,$title,$tbl_name)))
            {
                return strtolower($title);
            }
            else
            {
                $x=0;
                do {
                    $new_title=strtolower($title.($x+1));
                    $x++;
                }while(!empty(static::get_title($filed_name,$title.$x,$tbl_name)));
                    return strtolower($new_title);
            }
        }
        public static function get_ip()
        {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';

            return $ipaddress;
        }

        // ffmpeg command start from here
        public static function video_dimension($video)
        {
            $command = static::$ffmpeg . ' -i ' . $video . ' -vstats 2>&1';
            $output = shell_exec($command);
            $array=array();
            $regex_sizes = "/Video: ([^\r\n]*), ([^,]*), ([0-9]{1,4})x([0-9]{1,4})/"; // or : $regex_sizes = "/Video: ([^,]*), ([^,]*), ([0-9]{1,4})x([0-9]{1,4})/"; (code from @1owk3y)
            if (preg_match($regex_sizes, $output, $regs)) {
                $array['width']  = $regs [3] ? $regs [3] : null;
                $array['height'] = $regs [4] ? $regs [4] : null;
            }
            return $array;
        }
        public static function img_dimension($image)
        {
            $command = static::$ffmpeg . ' -i ' . $image . ' -vstats 2>&1';
            $output  = shell_exec($command);
            $array= array();
            $regex_sizes = "/Video: ([^\r\n]*), ([^,]*), ([0-9]{1,4})x([0-9]{1,4})/"; // or : $regex_sizes = "/Video: ([^,]*), ([^,]*), ([0-9]{1,4})x([0-9]{1,4})/"; (code from @1owk3y)
            if (preg_match($regex_sizes, $output, $regs)) {
                $array['width']  = $regs [3] ? $regs [3] : null;
                $array['height'] = $regs [4] ? $regs [4] : null;
            }
            return $array;
        }
        public static function duration($video)
        {
            $command = static::$ffmpeg . ' -i ' . $video . ' -vstats 2>&1';
            $output = shell_exec($command);
            $array= array();
            $regex_duration = "/Duration: ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}).([0-9]{1,2})/";
            if (preg_match($regex_duration, $output, $regs)) {
                $array['hours']  = $regs [1] ? $regs [1] : null;
                $array['mins']   = $regs [2] ? $regs [2] : null;
                $array['secs']   = $regs [3] ? $regs [3] : null;
                $array['ms']     = $regs [4] ? $regs [4] : null;
            }
            return array('hours'=>$hours,'mins'=>$mins,'secs'=>$secs,'ms'=>$ms);
        }
        public static function file_size($video,$decimals)
        {
            $sz         = 'BKMGTP';
            $factor     = floor((strlen(filesize($video)) - 1) / 3);
            $file_size  = sprintf("%.{$decimals}f", filesize($video) / pow(1024, $factor)) . @$sz[$factor];

            return array('file_size'=>$file_size);
        }
        public static function get_thumbnail($video,$image)
        {
            $getFromSecond = 2;
            $resolution=static::video_dimension($video);
            if(!empty($resolution)){

                $cmd = static::$ffmpeg." -y -i $video -an -ss $getFromSecond -s ".$resolution['width']."x".$resolution['height']." $image";
               //ration $cmd = static::$ffmpeg." -i $video -vf scale='min(100,iw)':-1 -ss $getFromSecond -f image2 -vframes 1 ".$image;
                shell_exec($cmd);

                return ['msg'=>true,'width'=>$resolution['width'],'height'=>$resolution['height']];
            }else{
                return ['msg'=>false];
            }
        }




        public static function watermark_img($img,$watermark)
        {
            $cmd= static::$ffmpeg." -y -i $img -i $watermark -filter_complex \"[0:v][1:v] overlay=25:25\" $img";
            shell_exec($cmd);
        }
        public static function watermark_video($video,$watermark,$new_file)
        {
            $cmd= static::$ffmpeg." -y -i $video -i $watermark -filter_complex \"[0:v][1:v] overlay=25:25\" $new_file";
            shell_exec($cmd);
        }
        public static function optimise_img($file_path,$file_name)
        {
            $new_file_name = pathinfo($file_name);

            $file   = $file_path.$file_name;
            $file1  = $file_path.'optimise1/'.$new_file_name['filename'].".".$new_file_name['extension'];
            $file2  = $file_path.'optimise2/'.$new_file_name['filename'].".".$new_file_name['extension'];
            $file3  = $file_path.'optimise3/'.$new_file_name['filename'].".".$new_file_name['extension'];
            $file4  = $file_path.'optimise4/'.$new_file_name['filename'].".".$new_file_name['extension'];

            if(strtolower($new_file_name['extension'])=='jpg'){$file_extension="mjpeg";}else{$file_extension=$new_file_name['extension'];}

            $cmd_1 = static::$ffmpeg." -r 1/4 -i $file -b 5000 -vcodec ".$file_extension." -qscale 5 $file1";
            shell_exec($cmd_1);

            $cmd_2 = static::$ffmpeg." -r 1/4 -i $file -b 4000 -vcodec ".$file_extension." -qscale 10 $file2";
            shell_exec($cmd_2);

            $cmd_3 = static::$ffmpeg." -r 1/4 -i $file -b 3000 -vcodec ".$file_extension." -qscale 15 $file3";
            shell_exec($cmd_3);

            $cmd_4 = static::$ffmpeg." -r 1/4 -i $file -b 2000 -vcodec ".$file_extension." -qscale 20 $file4";
            shell_exec($cmd_4);
        }
        public static function optimise_video($file_path,$file_name)
        {
            $new_file_name  = pathinfo($file_name);
            $file_extension = $new_file_name['extension'];

            $file   = $file_path.$file_name;
            $file1  = $file_path.'optimise1/'.$new_file_name['filename'].".".$new_file_name['extension'];
            $file2  = $file_path.'optimise2/'.$new_file_name['filename'].".".$new_file_name['extension'];
            $file3  = $file_path.'optimise3/'.$new_file_name['filename'].".".$new_file_name['extension'];
            $file4  = $file_path.'optimise4/'.$new_file_name['filename'].".".$new_file_name['extension'];

            $cmd_1 = static::$ffmpeg." -i $file -c:v libx264 -crf 25 $file1";
            shell_exec($cmd_1);

            $cmd2 = static::$ffmpeg." -i $file -c:v libx264 -crf 27 $file2";
            shell_exec($cmd2);

            $cmd3 = static::$ffmpeg." -i $file -c:v libx264 -crf 29 $file3";
            shell_exec($cmd3);

            $cmd4 = static::$ffmpeg." -i $file -c:v libx264 -crf 31 $file4";
            shell_exec($cmd4);
        }
        public static function blur_img($file_path,$file_name)
        {
            $new_file_name  = pathinfo($file_name);
            $file_extension = $new_file_name['extension'];

            $file       = $file_path.$file_name;
            $blur_file  = $file_path.'/'.$new_file_name['filename']."_blur.".$new_file_name['extension'];

            $cmd = static::$ffmpeg." -i $file -vf scale=3:3 $blur_file";
            shell_exec($cmd);

            return base64_encode(file_get_contents($blur_file));
        }
        // ffmpeg command end here
	}
?>
