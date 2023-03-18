<?php

$travel_city_arr =$request->travel_cities;

$travel_city_json = implode('||', $travel_city_arr);

$pick_date = $request->pickup_date;
$pickup_time = $request->pickup_time;
$jdays = $request->journy_days;

$pickup_date = date_format(date_create($pick_date),'d-m-Y');

$return_by = date('d-m-Y', strtotime($pickup_date . ' + ' .($jdays- 1).' days')) . ' at 23:30:00';

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

		// return  'Distance: <b>'.$dist['distance'].'</b><br>Travel time duration: <b>'.$dist['time'].'</b>';
	}

   $data =  str_replace(",",'',$dist['distance']);

	$tot_dis = $tot_dis+str_replace(" km",'',$data);


}

$esti_kms = $tot_dis;
for($i=0;$i<count($cab_price);$i++){
    $estimate_inr = $cab_price[$i]['mkm_rate']* $esti_kms;
}



//---------------------------------------------

function get_coordinates($city) {

    $address = urlencode($city.', India');
	$url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyDSK543R3NXT7utCZbk_Ti3siOSaAtj9bA&libraries&address=$address&sensor=false"; //&language=en&region=India

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



	$url = "https://maps.googleapis.com/maps/api/distancematrix/json?key=AIzaSyDSK543R3NXT7utCZbk_Ti3siOSaAtj9bA&libraries&origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving";
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

    @include('frontend.layout._top_bar')

        @include('frontend.layout._header')     
  
        <section class="breadcrumb-section position-relative z-2 overflow-hidden mt--75" data-background="{{asset('front-assets/assets/img/shapes/texture-bg.png')}}" style="background-image: url(&quot;{{asset('front-assets/assets/img/shapes/texture-bg.png')}}&quot;);">
<img src="{{asset('front-assets/assets/img/shapes/tire-print-left.png')}}" alt="tire print" class="position-absolute start-0 z-1 tire-print">
<img src="{{asset('front-assets/assets/img/shapes/tire-print-right.png')}}" alt="tire print" class="position-absolute end-0 z-1 tire-print">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                <h1 class="text-white">Select cab</h1>
            </div>
        </div>
    </div>
</div>
</section>  
<section class="inventory-details-area ptb-50">
    <div class="container">
    <div class="col-xl-12" style="margin-bottom:30px">
                <div class="row">
                <div class="col-xl-3">
                    <span class="lable-cust"> Pick-Up : </span><span class="span-cust">{{$pickupcity['0']->pick_city}}</span></div>
                    <div class="col-xl-3">
                        <span class="lable-cust">Leave On @ </span><span class="span-cust"> {{$pickup_date }} @ {{$request->pickup_time}}</span>
                    </div>
                    <div class="col-xl-2">
                        <span class="lable-cust">Estimat Kms : </span><span class="span-cust">{{$esti_kms}}</span>
                    </div>
                    <div class="col-xl-4">
                        <span class="lable-cust">Return By : </span> <span class="span-cust">{{$return_by}}</span>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="iv_listing mt-5 mt-xl-0">
                    <div class="row g-4">
                    <?php for ($j = 0; $j < count($cab_price); $j++) { ?>  
                 <?php
                        if ($cab_price[$j]['cab_type'] != '') {
                            $cab_type = $cab_price[$j]['cab_type'];
                            // $cab_img = assets_path() . 'images/car/suv.webp';
                            $tall_tax = 0;
                            $state_tax = 0;
                                $km_rate =  $cab_price[$j]['mkm_rate'];
                            $driver_allows_perday = $cab_price[$j]['driver_allowance'];
                            $minkm = $cab_price[$j]['minkm'];
                            $jdayMinkm = $minkm * $jdays;
                            //var_dump($jdayMinkm);exit;
                            if ($jdayMinkm > $esti_kms) {
                                $minkm_jday = $minkm * $jdays;
                                $cabprice_jday = $minkm_jday * $cab_price[$j]['mkm_rate'];
                                // $tax_add = $tall_tax + $state_tax;
                                $cab = $cabprice_jday;
                                $driver_allowance =  $driver_allows_perday*$jdays;
                                $cab_total = $cab + $driver_allowance;
                                $tot_cab = round($cab_total);
                                $check = '<input type="hidden" name="tot_cab_fare_suv" value="' . $tot_cab . '">';
                                $submit_btn_dt = $cab_price[$j]['cab'];
                                $bags = $cab_price[$j]['bag'];
                                $seats = $cab_price[$j]['seat'];
                            } else if ($jdayMinkm < $esti_kms) {
                                $minkm_jday = $esti_kms;
                                $cabprice_jday = $minkm_jday *$cab_price[$j]['mkm_rate'];
                                // $tax_add = $tall_tax + $state_tax;
                                $cab = $cabprice_jday;
                                $driver_allowance =  $driver_allows_perday*$jdays;
                                $cab_total = $cab + $driver_allowance;
                                $tot_cab = round($cab_total);
                                $check = '<input type="hidden" name="tot_cab_fare_suv" value="' . $tot_cab . '">';
                                $submit_btn_dt = $cab_price[$j]['cab'];
                                $bags = $cab_price[$j]['bag'];
                                $seats = $cab_price[$j]['seat'];
                            }

                        }
                    ?>
                    
              
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                        {!! Form::open(array('route' =>'multicitybookcab.index','method'=>'Post','id'=>'onewayformid')) !!}
                           
                                <div class="filter-card-item position-relative overflow-hidden rounded bg-white bx_shadow2">
                                   

                                    <div class="feature-thumb position-relative overflow-hidden">
                                        <a><img src="{{asset('public/profile/'.$cab_price[$j]['image'])}}" alt="car" class="img-fluid img_height" /></a>
                                    </div>
                                    <div class="filter-card-content">
                                        <div class="price-btn text-end position-relative">
                                            <span class="small-btn-meta"><i class="fa-solid fa-inr f_14"></i> {{$cab_total}}</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a class="mt-4 d-block">
                                                    <h5>{{$cab_price[$j]['cab']}}</h5>
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="mt-4 d-block" data-toggle="modal" data-target="#fare_<?=$j + 1?>">
                                                    <h5 class="fl_right"><i class="fa-solid fa-eye f_14"></i><span class="f_14"> Fare Details </span></h5>
                                                </a>
                                            </div>
                                        </div>

                                        <span class="meta-content"><strong></strong></span>
                                        <hr class="spacer mt-3 mb-3" />
                                        <div class="card-feature-box d-flex align-items-center mb-4">
                                            <div class="icon-box d-flex align-items-center">
                                                <span class="me-2"><img src="http://localhost/demo_web/front-assets/assets/img/user.png" class="i_height" /></span>
                                                {{$seats}}
                                            </div>
                                            <div class="icon-box d-flex align-items-center">
                                                <span class="me-2"><img src="http://localhost/demo_web/front-assets/assets/img/bag.png" class="i_height" /></span>
                                                {{$bags}}
                                            </div>
                                            <div class="icon-box d-flex align-items-center">
                                                <span class="me-2"><img src="http://localhost/demo_web/front-assets/assets/img/ac_1.png" class="ac_height" /></span>
                                                Ac
                                            </div>
                                            <div class="icon-box d-flex align-items-center">
                                                <span class="me-2"><img src="http://localhost/demo_web/front-assets/assets/img/sen.png" class="ac_height" /></span>
                                                Senitize
                                            </div>
                                        </div>
                                        <input type="hidden" value="<?php $oneway_detail_id = $cab_price[$j]['id']?>">
                                                        <input type="hidden" name="pcity_id" value="{{$pickupcity[0]['id']}}"/>
                                                        <input type="hidden" name="city_name" id="city_name" value="{{$pickupcity[0]['pick_city']}}"/>
                                                        <input type="hidden" name="cab_id" value="{{$cab_price[$j]['cab_id']}}"/>
                                                        <input type="hidden" name="pick_date" id="pickup_date" value="{{$pickup_date}}"/>
                                                        <input type="hidden" name="pick_time" id="pickup_time" value="{{$pickup_time}}"/>
                                                        <input type="hidden" name="return_date" id="return_date" value="{{$return_by_date}}"/>
                                                        {{-- <!--<input type="hidden" name="journ_days" value="{{$jdays}}"/>--> --}}
                                                        <input type="hidden" name="estimate_kms" id="esti_kms"value="{{$esti_kms}}"/>
                                                        <input type="hidden" name="drop_city" value="{{end($travel_city_arr)}}"/>
                                                        <input type="hidden" name="travel_city" value="{{$travel_city_json}}"/>
                                                        <input type = "hidden" name= "cab_type" id="cab_type" value="{{$submit_btn_dt}}">
                                                        <input type = "hidden" name= "total_amount" id="total_amount" value="{{$tot_cab}}">
                                                        <input type = "hidden" name= "driver_allowance" id="driver_allowance" value="{{$driver_allowance}}">
                                                        <input type = "hidden" name= "journy_days" id="journy_days" value="{{$jdays}}">
                                                        <input type = "hidden" name= "journy_minkm" id="journy_minkm" value="{{$jdayMinkm}}">
                                                        <input type = "hidden" name= "minkm" id="minkm" value="{{$cab_price[$j]['minkm']}}">
                                                        <input type = "hidden" name= "km_rate" id="km_rate" value="{{$km_rate}}">
                                                        <input type = "hidden" name= "note" id="note" value="{!!$cab_price[0]['note']!!}">
                                                        <input type="hidden" name="modal_id" id="modal_id" value="{{$cab_price[$j]['id']}}"/>
                                        @if(session()->get('user_mobile'))
                                        <div class="col-xl-12 text_center">
                                            <button  type="submit" class="btn outline-btn btn-sm ">Book Now</button>
                                        </div>  
                                        @else
                                        @endif
                                    </div>
                                </div>
                            
                            {!!Form::close()!!}
                        </div>

                    
                     <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php for ($p = 0; $p < count($cab_price); $p++) {
                ?>
                        <?php
                        if ($cab_price[$p]['cab_type'] != '') {
                            $cab_type = $cab_price[$p]['cab_type'];
                            // $cab_img = assets_path() . 'images/car/suv.webp';
                            $tall_tax = 0;
                            $state_tax = 0;
                                $km_rate =  $cab_price[$p]['mkm_rate'];
                            $driver_allows_perday = $cab_price[$p]['driver_allowance'];
                            $minkm = $cab_price[$p]['minkm'];
                            $jdayMinkm = $minkm * $jdays;
                            //var_dump($jdayMinkm);exit;
                            if ($jdayMinkm > $esti_kms) {
                                $minkm_jday = $minkm * $jdays;
                                $cabprice_jday = $minkm_jday * $cab_price[$p]['mkm_rate'];
                                // $tax_add = $tall_tax + $state_tax;
                                $cab = $cabprice_jday;
                                $driver_allowance =  $driver_allows_perday *  $jdays;
                                $cab_total = $cab + $driver_allowance;
                                $tot_cab = round($cab_total);
                                $check = '<input type="hidden" name="tot_cab_fare_suv" value="' . $tot_cab . '">';
                                $submit_btn_dt = $cab_price[$p]['cab'];
                                $bags = $cab_price[$p]['bag'];
                                $seats = $cab_price[$p]['seat'];
                            } else if ($jdayMinkm < $esti_kms) {
                                $minkm_jday = $esti_kms;
                                $cabprice_jday = $minkm_jday *$cab_price[$p]['mkm_rate'];
                                // $tax_add = $tall_tax + $state_tax;
                                $cab = $cabprice_jday;
                                $driver_allowance =  $driver_allows_perday *  $jdays;
                                $cab_total = $cab + $driver_allowance;
                                $tot_cab = round($cab_total);
                                $check = '<input type="hidden" name="tot_cab_fare_suv" value="' . $tot_cab . '">';
                                $submit_btn_dt = $cab_price[$p]['cab'];
                                $bags = $cab_price[$p]['bag'];
                                $seats = $cab_price[$p]['seat'];
                            }

                        } 
                    ?>
                       <div class="modal fade" id="fare_<?=$p + 1?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog " >
                                <div class="modal-content" style="background-color: #f1f1f1">
                                    <div class="modal-header" style="background-color: #fc0012">
                                        <label style="font-weight: bold;color:white">Rs.<?php echo $cab_total?>/-Outstation From <span style="color: white;font-weight:700">{{$pickupcity[0]['pick_city']}}</label>
                                        <button type="button" class="close" id="cancle_close" data-dismiss="modal" style="margin-top: -15px;background: #fc0012;margin-right: -10px;border: 0;"><i class="fa fa-times" style="color: #fff5f5"></i></button>
                                    </div>

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
                                            <td><b>Estimated Km </b></td>
                                            <td>:</td>
                                            <td> <?=$esti_kms;?>Kms</td>
                                        </tr>
                                        
                                        <tr>
                                            <td><b>Per Km Rate </b></td>
                                            <td>:</td>
                                            <td><i class="fa fa-inr"></i> <?=$km_rate;?>/Km</td>
                                        </tr>
                                        <tr>
                                            <td><b>Driver Allowance</b></td>
                                            <td>:</td>
                                            <td><i class="fa fa-inr"></i><?=$driver_allows_perday;?> * <?=$jdays?> Day</td>
                                        </tr>
                                        <tr>
                                            <td><b>Minimum Km</b></td>
                                            <td>:</td>
                                            <td>Min. <?=$cab_price[$p]['minkm']?> KMs /Day</td>
                                        </tr>
                                    </table>
                                </div>
                                <hr>
                                <div class="headingclass">
                                    <table class="table table-striped" width="100%">

                                        <tr>
                                            <td><b>Leave On</b></td>
                                            <td><img src="{{asset('front-assets/assets/img/r-7.png')}}" class="exchange rotate linear infinite" style="height: 40px;"></td>
                                            <td>Return By</td>
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
                                    <div class="col-md-12" style="border-bottom:1px solid #eeeeee">
                                        <div class="col-md-6" style="max-width:100%">

                                            <p><b>After <?=$return_by?>:</b></p>
                                            <p>At .<i class="fa fa-inr"></i> {{$cab_total}} /KM</p>
                                            <p>Driver Allowance : Rs.<?=$driver_allowance;?>/Day</p>

                                        </div>
                                        <div class="col-md-6">

                                            <p><b>After <?=$esti_kms;?> KMs:</b></p>
                                            <p></p>
                                            <p>Rs  /KM</p>
                                            <p></p>

                                        </div>

                                    </div>
                                </div>

                                <div class="headingclass">
                                    <hr>
                                    <span> <b>Note:</b></span>
                                    <hr>
                                    <span><?=$cab_price[0]['note']?></span>
                                </div>

                            </div>
                        </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
           


        @include('frontend.layout._footer')
        <style type="text/css">

            .rotate {
          animation: rotation 2s;
        }

        .linear {
          animation-timing-function: linear;
        }

        .infinite {
          animation-iteration-count: infinite;
        }

        @keyframes rotation {
          from {
            transform: rotate(0deg);
          }
          to {
            transform: rotate(359deg);
          }
        }


        </style>

 <script>
$(document).ready(function(){
            $('#fare_modal').click(function()
            {
                $('#modal_details').modal('show');
            var modal_id = $("#modal_id").val();
            var journy_minkm = $("#journy_minkm").val();
            var esti_kms = $("#esti_kms").val();
            var km_rate = $("#km_rate").val();
            var driver = $("#driver_allowance").val();
            var pickup_date = $("#pickup_date").val();
            var pickup_time = $("#pickup_time").val(); 
            var return_date = $("#return_date").val();
            var note = $("#note").val(); 
            var tot_cab= $("#total_amount").val(); 
            var journy_day =$("#journy_days").val();
            var city_name = $("#city_name").val();
            // var dcity_id = $("#dcity_id").val();
              
                    jQuery.ajax({
                        headers: {
                                    'X-CSRF-Token': $('input[name="_token"]').val()
                                },
                        type: "POST",
                        url:"{{route('multy_modal_show')}}",
                        data:{modal_id:modal_id,journy_minkm: journy_minkm,esti_kms: esti_kms,km_rate: km_rate,driver: driver,pickup_date: pickup_date,pickup_time: pickup_time,return_date: return_date,note: note,city_name: city_name,tot_cab:tot_cab,journy_day:journy_day},

                    success: function (resp) {
                        $(".table-design").html(resp);
                    },
                });
                return false;
            });
        });
</script>




        <script>
            $('#close').click(function(event){
                location.reload();
            });
       $('#req_close').click(function(event){
        // alert("hello");
                  $('#modal_details').modal('hide');
            });

            $('#form-submit').click(function(event){
                alert("hello");
                $('#multy_form').submit();
            });
        </script>
        <script>
    jQuery(document).ready(function(){
            jQuery('.findcar').click(function()
            {
                $('#login-number').modal('show');
            });
        });
</script>
<script>
    jQuery(document).ready(function(){
            jQuery('#loginbutton').click(function()
            {

                var user_mobile = jQuery("#user_mobile").val();

                if(user_mobile.length != 10){
                    alert("Please Enter 10 Digit Number")
                    // $("#otp-div").hide();
                    // $("#login_number").show();
                } else{
                        jQuery.ajax({
                        type: "POST",
                        url:"{{route('homelogin')}}",
                        data:'user_mobile='+user_mobile+
                        '&_token={{csrf_token()}}',
                        dataType: 'JSON',
                        success:function(result){

                            if(result==1)
                            {


                                location.reload();

                            }
                            else
                            {
                                location.reload();
                            }

                    }
                });
                    }

            return false;
    });
    });
</script>
        <script>
            var input = document.getElementById("user_mobile3");
            input.addEventListener("keypress", function(event) {
              if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("loginbutton").click();
              }
            });
            </script>
              <script>
                var input = document.getElementById("user_otp");
                input.addEventListener("keypress", function(event) {
                  if (event.key === "Enter") {
                    event.preventDefault();
                    document.getElementById("otpsend").click();
                  }
                });
                </script>

