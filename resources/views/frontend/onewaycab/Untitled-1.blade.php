<?php

$travel_city_arr =$request->travel_cities;

$travel_city_json = implode('||', $travel_city_arr);

$pick_date = $request->pickup_date;
$pickup_time = $request->pickup_time;
$jdays = $request->journy_days;
$pickup_date = date_format(date_create($pick_date),'d-m-Y');
// dd($pickup_date);
$return_by = date( 'd-m-Y',strtotime($pickup_date . ' + ' .($jdays- 1).' days')) . ' at 23:30:00';

$return_by_date = date('d-m-Y', strtotime($pickup_date . ' + ' .($jdays- 1).' days'));
$full_pick_up_city = $pickupcity[0]['pick_city'];
$texifrom = $pickupcity[0]['pick_city'];
$tot_dis = 0;
$scity_arr = array();
$ncity_arr = array();

for ($i = 0; $i < count($travel_city_arr); $i++) {

    $p = $i + 1;
	$scity_arr[0] = $full_pick_up_city;
    $scity_arr[$p] = $travel_city_arr[$i]; //two way km count
    $ncity_arr[] = $travel_city_arr[$i];
}

array_push($ncity_arr, $full_pick_up_city);
// var_dump($scity_arr); var_dump($ncity_arr);
// exit();
$mul_start_city_arr = $scity_arr;
$mul_next_city_arr = $ncity_arr;
$count_arr = count($mul_start_city_arr);


for ($i = 0;$i<$count_arr;$i++) {

	$start_city = $mul_start_city_arr[$i];

	$next_city = $mul_next_city_arr[$i];

	$coordinates1 = get_coordinates($start_city);

	$coordinates2 = get_coordinates($next_city);


	if (!$coordinates1||!$coordinates2) {
		echo 'Bad address.';
	} else {
		$dist = GetDrivingDistance($coordinates1['lat'],$coordinates2['lat'],$coordinates1['long'],$coordinates2['long']);
        // var_dump($dist);exit;
		// return  'Distance: <b>'.$dist['distance'].'</b><br>Travel time duration: <b>'.$dist['time'].'</b>';
	}

	$tot_dis = $tot_dis+str_replace(" km",'',$dist['distance']);
    // var_dump($tot_dis);exit;
}

$esti_kms = $tot_dis;

$estimate_inr_suv = $cab_price_list[0]['suv_km_rs']* $esti_kms;
$estimate_inr_sedan = $cab_price_list[0]['sedan_km_rs'] * $esti_kms;
$estimate_inr_innova = $cab_price_list[0]['innova_km_rs'] * $esti_kms;
$estimate_inr_tempo = $cab_price_list[0]['tempo_tra_km_rs'] * $esti_kms;

//---------------------------------------------

function get_coordinates($city) {

    $address = urlencode($city.', India');
	$url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyCSQaCVmpA6-zji--4a-9209LcltYbE5Io&address=$address&sensor=false"; //&language=en&region=India

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$response = curl_exec($ch);


	$response_a = json_decode($response);

	$status = $response_a->status;


	if ($status == 'ZERO_RESULTS') {
		return FALSE;
	} else {
		$return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
		return $return;
	}
}

function GetDrivingDistance($lat1, $lat2, $long1, $long2) {



	$url = "https://maps.googleapis.com/maps/api/distancematrix/json?key=AIzaSyCSQaCVmpA6-zji--4a-9209LcltYbE5Io&origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
    curl_close($ch);
	$response_a = json_decode($response, true);
	$dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
	$time = $response_a['rows'][0]['elements'][0]['duration']['text'];

	//echo $dist;
	//echo '</br>';
	return array('distance' =>$dist,'time' => $time);
}
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
    <head>
        <title>Round Trip</title>
    </head>

    @include('frontend.layout._top_bar')

<body>
    <!-- LOADING AREA START ===== -->
    <div class="loading-area">
        <div class="loading-box"></div>
        <div class="loading-pic">
            <div class="windows8">
                <div class="wBall" id="wBall_1">
                    <div class="wInnerBall"></div>
                </div>
                <div class="wBall" id="wBall_2">
                    <div class="wInnerBall"></div>
                </div>
                <div class="wBall" id="wBall_3">
                    <div class="wInnerBall"></div>
                </div>
                <div class="wBall" id="wBall_4">
                    <div class="wInnerBall"></div>
                </div>
                <div class="wBall" id="wBall_5">
                    <div class="wInnerBall"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- LOADING AREA  END ====== -->
	<div class="page-wraper">        <!-- HEADER START -->
        @include('frontend.layout._header')
        <!-- HEADER END -->

        <!-- Content -->
        <div class="page-content">

            <div class="aon-page-jobs-wrap" style="padding-top: 130px;">
                <div class="container">
                    <div class="section-head" style="margin-bottom: 0px;">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                {{-- <span class="aon-sub-title">Onesided Cab</span> --}}
                                {{-- <h3 class="sf-title">Cab Details</h3> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- Side bar start -->
                        <div class="col-lg-4 col-md-12" style="margin-top: 20px;
                        box-shadow: 0px 0px 14px 3px #f38697;">

                            <aside  class="side-bar sf-rounded-sidebar">

                                <div class="sf-job-sidebar-blocks">
                                    <h4 class="sf-title">Pickup City</h4>
                                    <div class="form-group">
                                        <input  value="{{$pickupcity['0']->pick_city}}"  placeholder="Search Keywords" class="form-control" disabled>
                                    </div>
                                    <h4 class="sf-title">Travel City</h4>
                                    <div class="form-group">
                                        @foreach($travel_city_arr as $value)
                                        <input  value="{{$value}}" placeholder="Search Keywords" class="form-control" disabled>
                                        @endforeach
                                    </div>
                                    <h4 class="sf-title">Drop City</h4>
                                    <div class="form-group">
                                        <input  value="{{$dropcity}}" placeholder="Search Keywords" class="form-control" disabled>
                                    </div>

                                    <h4 class="sf-title">Leave On Date</h4>
                                    <div class="form-group">
                                        <input  value="{{$pickup_date }},{{$request->pickup_time}}" placeholder="Search Keywords" class="form-control" disabled>
                                    </div>
                                    <h4 class="sf-title">Estimated Kms</h4>
                                    <div class="form-group">
                                        <input  value="{{$esti_kms}} Kms" placeholder="Search Keywords" class="form-control" disabled>
                                    </div>
                                    <h4 class="sf-title">Return By</h4>
                                    <div class="form-group">
                                        <input  value="{{$return_by}}" placeholder="Search Keywords" class="form-control" disabled>
                                    </div>
                                </div>
                            </aside>

                        </div>
                        <!-- Side bar END -->

                        <!-- Right part start -->
                        <div class="col-lg-8 col-md-12">
                            <!--Showing results topbar Start-->
                            <div class="aon-search-result-top flex-wrap d-flex justify-content-between">
                            {{--     --}}
                            <!--Showing results topbar End-->
                        </div>

                        <ul class="job_listings job_listings-two">
                            <?php for ($j = 0; $j < count($cab_price); $j++) {

                                ?>
                                 {!! Form::open(array('route' =>'multicitybookcab.index','action'=>'onewaybookcab','method'=>'GET','files' => 'true','enctype'=>'multipart/form-data')) !!}
                                 <input type="hidden" value="<?php $oneway_detail_id = $cab_price[$j]['id']?>">

                                    <li class="job_listing type-job_listing job-type-hourly">
                                        <?php
                                            if ($cab_price[$j]['cab_type'] == 'suv') {
                                                $cab_type = 'AC SUV';
                                                // $cab_img = assets_path() . 'images/car/suv.webp';
                                                $tall_tax = 0;
                                                $state_tax = 0;
                                                    $km_rate =  $cab_price_list[0]['suv_km_rs'];
                                                $driver_allows_perday = $cab_price[$j]['driver_allowance'];
                                                $minkm = $cab_price[$j]['minkm'];
                                                $jdayMinkm = $minkm * $jdays;
                                                //var_dump($jdayMinkm);exit;
                                                if ($jdayMinkm > $esti_kms) {
                                                    $minkm_jday = $minkm * $jdays;
                                                    $cabprice_jday = $minkm_jday * $cab_price_list[0]['suv_km_rs'];
                                                    // $tax_add = $tall_tax + $state_tax;
                                                    $cab = $cabprice_jday;
                                                    $driver_allowance =  $driver_allows_perday *  $jdays;
                                                    $cab_total = $cab + $driver_allowance;
                                                    $tot_cab = round($cab_total);
                                                    $check = '<input type="hidden" name="tot_cab_fare_suv" value="' . $tot_cab . '">';
                                                    $submit_btn_dt = 'suv';
                                                    $bags = $cab_price[$j]['bag'];
                                                    $seats = $cab_price[$j]['seat'];
                                                } else if ($jdayMinkm < $esti_kms) {
                                                    $minkm_jday = $esti_kms;
                                                    $cabprice_jday = $minkm_jday * $cab_price_list[0]['suv_km_rs'];
                                                    // $tax_add = $tall_tax + $state_tax;
                                                    $cab = $cabprice_jday;
                                                    $driver_allowance =  $driver_allows_perday *  $jdays;
                                                    $cab_total = $cab + $driver_allowance;
                                                    $tot_cab = round($cab_total);
                                                    $check = '<input type="hidden" name="tot_cab_fare_suv" value="' . $tot_cab . '">';
                                                    $submit_btn_dt = 'suv';
                                                    $bags = $cab_price[$j]['bag'];
                                                    $seats = $cab_price[$j]['seat'];
                                                }
                                            } else if ($cab_price[$j]['cab_type'] == 'sedan') {
                                                $cab_type = 'AC SEDAN';
                                                // $cab_img = assets_path() . 'images/car/sedan.webp';
                                                $tall_tax = 0;
                                                $state_tax = 0;
                                                $driver_allows_perday = $cab_price[$j]['driver_allowance'];
                                                    $km_rate =  $cab_price_list[0]['sedan_km_rs'];
                                                $minkm = $cab_price[$j]['minkm'];
                                                $jdayMinkm = $minkm * $jdays;
                                                if ($jdayMinkm > $esti_kms) {
                                                    $minkm_jday = $minkm * $jdays;
                                                    $cabprice_jday = $minkm_jday * $cab_price_list[0]['sedan_km_rs'];
                                                    // var_dump($cabprice_jday);
                                                    // exit;

                                                    // $tax_add = $tall_tax + $state_tax;
                                                    $cab = $cabprice_jday;
                                                    $driver_allowance =  $driver_allows_perday *  $jdays;
                                                    $cab_total = $cab + $driver_allowance;
                                                    $tot_cab = round($cab_total);

                                                    $check = '<input type="hidden" name="tot_cab_fare_sedan" value="' . $tot_cab . '">';
                                                    $submit_btn_dt = 'sedan';
                                                    $bags = $cab_price[$j]['bag'];
                                                    $seats = $cab_price[$j]['seat'];
                                                } else if ($jdayMinkm < $esti_kms) {
                                                    //$minkm_jday   	  	  =  $esti_kms * $jdays;
                                                    $minkm_jday = $esti_kms;
                                                    $cabprice_jday = $minkm_jday * $cab_price_list[0]['sedan_km_rs'];

                                                    // $tax_add = $tall_tax + $state_tax;
                                                    $cab = $cabprice_jday;
                                                    $driver_allowance =  $driver_allows_perday *  $jdays;
                                                    $cab_total = $cab + $driver_allowance;
                                                    $tot_cab = round($cab_total);

                                                    $check = '<input type="hidden" name="tot_cab_fare_sedan" value="' . $tot_cab . '">';
                                                    $submit_btn_dt = 'sedan';
                                                    $bags = $cab_price[$j]['bag'];
                                                    $seats = $cab_price[$j]['seat'];
                                                }
                                            } else if ($cab_price[$j]['cab_type'] == 'innova') {
                                                $cab_type = 'LUX INNOVA';
                                                // $cab_img = assets_path() . 'images/car/innova.webp';
                                                $tall_tax = 0;
                                                $state_tax = 0;
                                                    $km_rate =  $cab_price_list[0]['innova_km_rs'];
                                                $driver_allows_perday = $cab_price[$j]['driver_allowance'];
                                                $minkm = $cab_price[$j]['minkm'];
                                                $jdayMinkm = $minkm * $jdays;
                                                if ($jdayMinkm > $esti_kms) {
                                                    $minkm_jday = $minkm * $jdays;
                                                    $cabprice_jday = $minkm_jday * $cab_price_list[0]['innova_km_rs'];

                                                    // $tax_add = $tall_tax + $state_tax;
                                                    $cab = $cabprice_jday;
                                                    $driver_allowance =  $driver_allows_perday *  $jdays;
                                                    $cab_total = $cab + $driver_allowance;

                                                    $tot_cab = round($cab_total);
                                                    $check = '<input type="hidden" name="tot_cab_fare_innova" value="' . $tot_cab . '">';
                                                    $submit_btn_dt = 'innova';
                                                    $bags = $cab_price[$j]['bag'];
                                                    $seats = $cab_price[$j]['seat'];
                                                } else if ($jdayMinkm < $esti_kms) {
                                                    // $minkm_jday   	  	  =  $esti_kms * $jdays;
                                                    $minkm_jday = $esti_kms;
                                                    $cabprice_jday = $minkm_jday * $cab_price_list[0]['innova_km_rs'];

                                                    // $tax_add = $tall_tax + $state_tax;
                                                    $cab = $cabprice_jday;
                                                    $driver_allowance =  $driver_allows_perday *  $jdays;
                                                    $cab_total = $cab + $driver_allowance;

                                                    $tot_cab = round($cab_total);
                                                    $check = '<input type="hidden" name="tot_cab_fare_innova" value="' . $tot_cab . '">';
                                                    $submit_btn_dt = 'innova';
                                                    $bags = $cab_price[$j]['bag'];
                                                    $seats = $cab_price[$j]['seat'];
                                                }
                                            } else if ($cab_price[$j]['cab_type'] == 'tempo') {
                                                $cab_type = 'INNOVA CRYSTA';
                                                // $cab_img = assets_path() . 'images/car/tempo-tra.webp';
                                                $tall_tax = 0;
                                                $state_tax = 0;
                                                    $km_rate =  $cab_price_list[0]['tempo_tra_km_rs'];
                                                $driver_allows_perday = $cab_price[$j]['driver_allowance'];
                                                $minkm = $cab_price[$j]['minkm'];

                                                $jdayMinkm = $minkm * $jdays;

                                                if ($jdayMinkm > $esti_kms) {

                                                    $minkm_jday = $minkm * $jdays;
                                                    $cabprice_jday = $minkm_jday * $cab_price_list[0]['tempo_tra_km_rs'];

                                                    // $tax_add = $tall_tax + $state_tax;
                                                    $cab = $cabprice_jday;
                                                    $driver_allowance =  $driver_allows_perday *  $jdays;
                                                    $cab_total = $cab + $driver_allowance;

                                                    $tot_cab = round($cab_total);
                                                    $check = '<input type="hidden" name="tot_cab_fare_tempo" value="' . $tot_cab . '">';
                                                    $submit_btn_dt = 'tempo';
                                                    $bags = $cab_price[$j]['bag'];
                                                    $seats = $cab_price[$j]['seat'];

                                                } else if ($jdayMinkm < $esti_kms) {

                                                    // $minkm_jday   	  	  =  $esti_kms * $jdays;
                                                    $minkm_jday = $esti_kms;
                                                    $cabprice_jday = $minkm_jday * $cab_price_list[0]['tempo_tra_km_rs'];

                                                    // $tax_add = $tall_tax + $state_tax;
                                                    $cab = $cabprice_jday;
                                                    $driver_allowance =  $driver_allows_perday *  $jdays;
                                                    $cab_total = $cab + $driver_allowance;

                                                    $tot_cab = round($cab_total);
                                                    $check = '<input type="hidden" name="tot_cab_fare_tempo" value="' . $tot_cab . '">';
                                                    $submit_btn_dt = 'tempo';
                                                    $bags = $cab_price[$j]['bag'];
                                                    $seats = $cab_price[$j]['seat'];
                                                }
                                            }
                                        ?>
                                            <div class="row">

                                                    {{-- {!! Form::open(array('route' => ['onewaybookcab.index',['onewaydetails_id' => $onewaydetails[$i]['id'] ]],'id'=>'onewayformid', 'action'=>'onewaybookcab','method'=>'GET','files' => 'true','enctype'=>'multipart/form-data')) !!} --}}


                                                        <div class="col-md-4 col-sm-6" style="box-shadow:0px 0px 14px 3px #f38697">
                                                            <div class="fleet-grid-box">
                                                                <!--Fleet Grid Thumb Start-->
                                                                <figure class="fleet-thumb">
                                                                    <img src="{{asset('front-assets/images/car-fleet1.jpg')}}" alt="">
                                                                    <figcaption class="fleet-caption">
                                                                        <div class="price-box">
                                                                            <strong></strong>
                                                                        </div>
                                                                        <span class="rated">Amount : Rs./-</span>
                                                                    </figcaption>
                                                                </figure>
                                                                <!--Fleet Grid Thumb End-->
                                                                <!--Fleet Grid Text Start-->
                                                                <div class="fleet-info-box">
                                                                    <div class="fleet-info">
                                                                        <h3>AvailableCabs : </h3>
                                                                        <span style="font-weight: bold"> </span>

                                                                        <ul class="fleet-meta">
                                                                            <div>
                                                                                <li style="font-weight: bold;font-size:11px;"><i class="fa fa-car"></i> Cab :<span style="margin-left: 15px;"> </span>
                                                                                    </li>
                                                                                    <li style="font-weight: bold;font-size:11px;"><i class="fa fa-users"></i> Seat :<span style="margin-left: 15px;">  </span>
                                                                                    </li>
                                                                            </div>
                                                                            <div>
                                                                                            <li style="font-weight: bold;font-size:11px;"><i class="fa fa-briefcase"></i> Bags :<span style="margin-left: 15px;"> </span></li>
                                                                                                    <li style="font-weight: bold;font-size:10px;"><i class="fa fa-user"></i>Driver Allownce :<span style="margin-left: 15px;"> </span></li>
                                                                            </div>
                                                                            <div>
                                                                                <li style="font-weight: bold;font-size:11px;"><i class="fa fa-briefcase"></i> Toll Tax :<span style="margin-left: 15px;"> </span></li>
                                                                                        <li style="font-weight: bold;font-size:11px;"><i class="fa fa-user"></i>State Tax :<span style="margin-left: 15px;"> </span></li>
                                                                </div>
                                                                        </ul>
                                                                    </div>


                                                                    @if(session()->get('user_mobile'))
                                                                    <a href = "" type = "submit" class="tj-btn" style="float: left"><strong> Countinue </strong></a>
                                                                    @else
                                                                    <button type="button" id="findcar" class="route-button findcar" data-toggle="modal" data-original-title="oneway"data-target="#login-number">Find Car</button>
                                                                    @endif

                                                                    {{-- <a href="booking-form.html" class="tj-btn">Book Now </a> --}}
                                                                </div>
                                                                <!--Fleet Grid Text End-->
                                                            </div>
                                                        </div>


                                                <!--Fleet Grid Box End-->
                                            </div>

                                        {{-- <div class="job-location" style="padding-top: 0px;margin-top:15px;"><i class="fa fa-map-eye"></i> <button class="btn" type="button" data-toggle="modal" id="hello"  data-target="#faremodal<?=$j + 1?> "><h4><i class="fa fa-eye"><span >View Details</span> </i></h4></button> </div> --}}

                                        <input type="hidden" value="<?php $oneway_detail_id = $cab_price[$j]['id']?>">
                                                   <input type="hidden" name="pcity_id" value="{{$pickupcity[0]['id']}}"/>
                                                <input type="hidden" name="city_name" value="{{$pickupcity[0]['pick_city']}}"/>
                                                <input type="hidden" name="pick_date" value="{{$pickup_date}}"/>
                                                <input type="hidden" name="pick_time" value="{{$pickup_time}}"/>
                                                <input type="hidden" name="return_date" value="{{$return_by_date}}"/>
                                                {{-- <!--<input type="hidden" name="journ_days" value="{{$jdays}}"/>--> --}}
                                                <input type="hidden" name="estimate_kms" value="{{$esti_kms}}"/>
                                                <input type="hidden" name="drop_city" value="{{end($travel_city_arr)}}"/>
                                                <input type="hidden" name="travel_city" value="{{$travel_city_json}}"/>
                                                <input type = "hidden" name= "cab_type" id="cab_type" value="{{$submit_btn_dt}}">
                                                <input type = "hidden" name= "total_amount" id="total_amount" value="{{$tot_cab}}">
                                                <input type = "hidden" name= "driver_allowance" id="driver_allowance" value="{{$driver_allowance}}">
                                                <input type = "hidden" name= "journy_days" id="journy_days" value="{{$jdays}}">
                                                <input type = "hidden" name= "journy_minkm" id="journy_minkm" value="{{$jdayMinkm}}">
                                                <input type = "hidden" name= "km_rate" id="km_rate" value="{{$km_rate}}">
                                        <div class="dropdown action-dropdown dropdown-left">
                                            <input type="hidden" >
                                            <button type="submit"class="site-button">Countinue</button>
                                        </div>

                                    </li>
                                {!!Form::Close();!!}
                            <?php } ?>
                        </ul>
                        </div>
                    </div>
                </div>

            </div>
            </div>

     	{{-- <button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button> --}}
    </div>


    <!-- Login Sign Up Modal -->
    <?php for ($p = 0; $p < count($cab_price); $p++) {
        if ($cab_price[$p]['cab_type'] == 'suv') {
            $tall_tax = 0;
            $state_tax = 0;
            $driver_allows_perday = $cab_price[$p]['driver_allowance'];
            $minkm = $cab_price[$p]['minkm'];
            $jdayMinkm = $minkm * $jdays;
            if ($jdayMinkm > $esti_kms) {
                $minkm_jday = $minkm * $jdays;
                $cabprice_jday = $minkm_jday * $cab_price_list[0]['suv_km_rs'];
                $driver_allowance = $driver_allowance;
                // $tax_add = $tall_tax + $state_tax;
                $cab = $cabprice_jday;
                $tot_cab_suv = $cab + $driver_allowance;
                $total_fare = round($tot_cab_suv);

                $cab_prices_list = $cab_price_list[0]['suv_km_rs'];
                $driver_allows = $cab_price[$p]['driver_allowance'];

            } else if ($jdayMinkm < $esti_kms) {
                // $minkm_jday   	  	  	=  $esti_kms * $jdays;
                $minkm_jday = $esti_kms;
                $cabprice_jday = $minkm_jday * $cab_price_list[0]['suv_km_rs'];
                $driver_allowance = $driver_allowance;
                // $tax_add = $tall_tax + $state_tax;
                $cab = $cabprice_jday;
                $tot_cab_suv = $cab + $driver_allowance;
                $total_fare = round($tot_cab_suv);
                $cab_prices_list = $cab_price_list[0]['suv_km_rs'];
                $driver_allows = $cab_price[$p]['driver_allowance'];
            }
        } else if ($cab_price[$p]['cab_type'] == 'sedan' || $cab_price[$p]['cab_type'] == 'seden') {
            $tall_tax = 0;
            $state_tax = 0;
            $driver_allows_perday = $cab_price[$p]['driver_allowance'];
            $minkm = $cab_price[$p]['minkm'];

            $jdayMinkm = $minkm * $jdays;

            if ($jdayMinkm > $esti_kms) {

                $minkm_jday = $minkm * $jdays;

                $cabprice_jday = $minkm_jday * $cab_price_list[0]['sedan_km_rs'];

                $driver_allowance =  $driver_allows_perday;

                // $tax_add = $tall_tax + $state_tax;

                $cab = $cabprice_jday;

                $tot_cab_sedan = $cab + $driver_allowance;

                $total_fare = round($tot_cab_sedan);
                $cab_prices_list = $cab_price_list[0]['sedan_km_rs'];
                $driver_allows = $cab_price[$p]['driver_allowance'];

            } else if ($jdayMinkm < $esti_kms) {

                $minkm_jday = $esti_kms;
                //$minkm_jday   	  	  	=  $esti_kms * $jdays;

                $cabprice_jday = $minkm_jday * $cab_price_list[0]['sedan_km_rs'];

                $driver_allowance =  $driver_allows_perday;

                // $tax_add = $tall_tax + $state_tax;

                $cab = $cabprice_jday;

                $tot_cab_sedan = $cab + $driver_allowance;

                $total_fare = round($tot_cab_sedan);
                $cab_prices_list = $cab_price_list[0]['sedan_km_rs'];
                $driver_allows = $cab_price[$p]['driver_allowance'];

            }

        } else if ($cab_price[$p]['cab_type'] == 'innova') {
            $tall_tax = 0;
            $state_tax = 0;

            $driver_allows_perday = $cab_price[$p]['driver_allowance'];
            $minkm = $cab_price[$p]['minkm'];

            $jdayMinkm = $minkm * $jdays;

            if ($jdayMinkm > $esti_kms) {

                $minkm_jday = $minkm * $jdays;

                $cabprice_jday = $minkm_jday * $cab_price_list[0]['innova_km_rs'];

                $driver_allowance =  $driver_allows_perday;

                // $tax_add = $tall_tax + $state_tax;

                $cab = $cabprice_jday;

                $tot_cab_innova = $cab + $driver_allowance;

                $total_fare = round($tot_cab_innova);
                $cab_prices_list = $cab_price_list[0]['innova_km_rs'];
                $driver_allows = $cab_price[$p]['driver_allowance'];

            } else if ($jdayMinkm < $esti_kms) {

                //$minkm_jday   	  	  	=  $esti_kms * $jdays;
                $minkm_jday = $esti_kms;

                $cabprice_jday = $minkm_jday * $cab_price_list[0]['innova_km_rs'];

                $driver_allowance =  $driver_allows_perday;

                // $tax_add = $tall_tax + $state_tax;

                $cab = $cabprice_jday;

                $tot_cab_innova = $cab + $driver_allowance;

                $total_fare = round($tot_cab_innova);
                $cab_prices_list = $cab_price_list[0]['innova_km_rs'];
                $driver_allows = $cab_price[$p]['driver_allowance'];

            }

        } else if ($cab_price[$p]['cab_type'] == 'tempo') {
            $tall_tax = 0;
            $state_tax = 0;

            $driver_allows_perday = $cab_price[$p]['driver_allowance'];
            $minkm = $cab_price[$p]['minkm'];

            $jdayMinkm = $minkm * $jdays;

            if ($jdayMinkm > $esti_kms) {

                $minkm_jday = $minkm * $jdays;

                $cabprice_jday = $minkm_jday * $cab_price_list[0]['tempo_tra_km_rs'];

                $driver_allowance =  $driver_allows_perday;

                // $tax_add = $tall_tax + $state_tax;

                $cab = $cabprice_jday;

                $tot_cab_tempo = $cab + $driver_allowance;

                $total_fare = round($tot_cab_tempo);
                $cab_prices_list = $cab_price_list[0]['tempo_tra_km_rs'];
                $driver_allows = $cab_price[$p]['driver_allowance'];

            } else if ($jdayMinkm < $esti_kms) {

                $minkm_jday = $esti_kms;
                //$minkm_jday   	  	  	=  $esti_kms * $jdays;

                $cabprice_jday = $minkm_jday * $cab_price_list[0]['tempo_tra_km_rs'];

                $driver_allowance =  $driver_allows_perday;

                // $tax_add = $tall_tax + $state_tax;

                $cab = $cabprice_jday;

                $tot_cab_tempo = $cab + $driver_allowance;

                $total_fare = round($tot_cab_tempo);
                $cab_prices_list = $cab_price_list[0]['tempo_tra_km_rs'];
                $driver_allows = $cab_price[$p]['driver_allowance'];

            }


        }

        ?>

    <div class="modal fade" id="faremodal<?=$p + 1?>">
      <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header"  style="background: #1b77bd;">
            <h3 class="modal-title" style="text-align: center;color: white;">Rs.<?php echo $total_price = $esti_kms*$cab_prices_list + $driver_allows*$jdays ?>/-</h3>
        <h4 class="modal-title" style="text-align: center;color: white;">Outstation From {{$pickupcity[0]['pick_city']}}</h4>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="body-model" style="margin-left: 10px;">
                        <hr>
                        <div class="headingclass">
                            <span><b> Fare Breakup :</b></span>
                        </div>
                        <hr>

                        <div class="headingclass">
                            <table class="table table-striped" width="100%">

                                <tr>
                                    <td><b>Estimated Fare</b></td>
                                    <td>:</td>
                                    <td><b>KMs <?=$esti_kms;?>* <?=$cab_prices_list?>.Rs /KM</b></td>
                                </tr>
                                <tr>
                                    <td><b>Driver Allowance</b></td>
                                    <td>:</td>
                                    <td><b>Rs<?=$driver_allows;?> * <?=$jdays?> Day</b></td>
                                </tr>
                                <tr>
                                    <td><b>Minimum Km</b></td>
                                    <td>:</td>
                                    <td><b>Min. <?=$cab_price[$p]['minkm']?> KMs /Day Day</b></td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="headingclass">
                            <table class="table table-striped" width="100%">

                                <tr>
                                    <td><b>Leave On</b></td>
                                    <td><img src="{{asset('front-assets/images/background/exchange.png')}}" class="exchange"></td>
                                    <td><b>Return By</b></td>
                                </tr>
                                <tr>
                                    <td><?=$pickup_date?> at <?=$pickup_time?></td>
                                    <td></td>
                                    <td><?=$return_by?></td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="headingclass">
                            <span> <b>Trip Extension:</b></span>
                        </div>
                        <hr>
                        <div class="headingclass">
                            <div class="col-md-12">
                                <div class="col-md-6">

                                    <p><b>After <?=$return_by?>:</b></p>
                                    <p>At <?=$cab_prices_list?>.Rs /KM</p>
                                    <p>Driver Allowance : Rs.<?=$driver_allows;?>/Day</p>

                                </div>
                                <div class="col-md-6">

                                    <p><b>After <?=$esti_kms;?> KMs:</b></p>
                                    <p></p>
                                    <p>Rs <?=$cab_prices_list?> /KM</p>
                                    <p></p>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="headingclass">
                            <span><b>Notes:</b></span>
                        </div>
                        <hr>
                        <div class="headingclass">
                            <span><?=$cab_price[0]['note']?></span>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
      </div>
    </div>
    <?php }?>
    <!-- Login Sign Up Modal -->
    @include('frontend.layout._footer')

</body>
</html>
