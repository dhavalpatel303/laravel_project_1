@include('layouts._top_bar')
<head>
    <title>{{helpers::name()}} | Update Round Trip </title>
</head>

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left caol-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Update Round Trip Bookings</h2>

                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Horizontal form layout section start -->
                <section id="basic-horizontal-layouts">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title">Round Trip Bookings</h4> --}}
                                </div>
                                <div class="card-body">
                                    {!! Form::model($multybookings, ['method' => 'PATCH','route' => ['Multicitybookings.update', encrypt($multybookings->id)]]) !!}
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-3">
                                                            <label class="form-label l1" for="fname-icon">Pick City</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                <select class="form-select form-select-lg" placeholder="Select Pickup City" name ="pickcity_id_roundtrip" id="pickcity_id_roundtrip">
                                                                    <option>Select Pickup City</option>
                                                                    @foreach($pickupcity_id as $pickcity)
                                                                    <option value="{{$pickcity->p_id}}"{{($multybookings->pickupcity_id==$pickcity->p_id)? 'selected':''}} >{{$pickcity->pick_city}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div><span style="color:red">{{  $errors->first('pickcity_id') }}</span></div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-3">
                                                            <label class="form-label l1" for="selectLarge">Travel City</label>
                                                        </div>
                                                        <div class="new"></div>
                                                        <?php
                                                          $cab_travel =$multybookings->travel_city;
                                                          $values = (explode("|",$cab_travel));
                                                            for($q=0;$q<count($values);$q++) {
                                                                $tcity_arr = $values[$q];
                                                                $tcity     = $tcity_arr;
                                                                $n = $q+1;
                                                        ?>
                                                        <?php
                                                        if($n == 1) {
                                                          $col = 'col-sm-12';
                                                        } else
                                                         {
                                                          $col = 'col-sm-12';
                                                         }
                                                    ?>

                                                            <div class="<?=$col?> input_fields_wrap travel<?=$n?>" id="getTravel<?=$n?>">
                                                                <div class="form-group">
                                                                    <?php if($n ==1 ) {?>

                                                                    <?php } ?>
                                                                    <?php if($n > 1) {
                                                                    $margin = 'top-margin';
                                                                    } ?>
                                                                    <?php if($n ==1 ) {?>
                                                                    <input type="text"  required="required" class="mul_city form-control travel_cities" id="travel_cities<?=$n?>" required="required" name="travel_cities[]" placeholder="Enter a Location" value='<?=$tcity?>'>
                                                                    <?php } else if($n >1) {?>
                                                                    <input type="text" onclick="set_code()" required="required" class="mul_city form-control travel_cities" id="travel_cities<?=$n?>" required="required" name="travel_cities[]" placeholder="Enter a Location" value=<?=$tcity?>>
                                                                    <?php } ?>
                                                                    <?php if($n ==1 ) {?>

                                                                <?php } ?>

                                                                </div>
                                                            </div>
                                                            <?php } ?>
                                                            <div class="new"></div>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="row col-12">
                                                    <div class="col-4">
                                                        <div class="mb-1 row">
                                                            <div class="col-12">
                                                                <label class="col-form-label l1" for="fname-icon">PickupDate</label>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="input-group input-group-merge">
                                                                    {!! Form::text('pickup_date', null, array('placeholder' => 'Pickup date','id'=>'pickup_date','class' => 'form-control date','readonly'=>'true')) !!}
                                                                </div>
                                                                <div><span style="color: red;">{{ $errors->first('pickup_date') }}</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="mb-1 row">
                                                            <div class="col-12">
                                                                <label class="col-form-label l1" for="fname-icon">PickupTime</label>
                                                            </div>

                                                            <div class="col-12">
                                                                <select class="form-select form-select-lg"  name ="pickup_time" id="pickup_time" required='required' >
                                                                    <option value="">Select Pickup Time</option>
                                                                    <?php
                                                                    for($hours=0; $hours<24; $hours++){ // the interval for hours is '1'

                                                                      for($mins=0; $mins<60; $mins+=60){ // the interval for mins is '30'
                                                                           $sel="";
                                                                          if($multybookings->pickup_time == str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT)){
                                                                              $sel='selected="selected"';
                                                                          }

                                                                          echo '<option '.$sel.' value = "'.str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT).'">'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                                                                                         .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
                                                                          }} ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="mb-1 row">
                                                            <div class="col-12">
                                                                <label class="col-form-label l1" for="fname-icon">JournyDays</label>
                                                            </div>

                                                            <div class="col-12">
                                                                <select class="form-select form-select-lg"  name ="journy_days" id="journy_days" required='required' >
                                                                    <?php for($i=0; $i<10; $i++) {
                                                                        $sel = "";
                                                                       if($multybookings->journey == $i+1) {
                                                                           $sel='selected="selected"';
                                                                       }
                                                                       ?>

                                                                        <option <?=$sel?> value="<?=$i+1?>"><?=$i+1?>
                                                                            <span>Days</span>
                                                                        </option>
                                                                        <?php
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-4">
                                                    <div class="mb-1 row">
                                                        <div class="col-12">
                                                            <label class="col-form-label l1" for="fname-icon">Cab Type</label>
                                                        </div>

                                                        <div class="col-12">
                                                            <select class="form-select form-select-lg"  name ="cab_type" id="cab_type" required='required' >
                                                                <option> Select Cab Type</option>
                                                                <option {{($multybookings->cab_type=='sedan')? 'selected' : ''}} value="sedan">Sedan</option>
                                                                <option {{($multybookings->cab_type=='suv')? 'selected' : ''}} value="suv">Suv</option>
                                                                <option {{($multybookings->cab_type=='innova')? 'selected' : ''}} value="innova">innova</option>
                                                                <option {{($multybookings->cab_type=='tempo')? 'selected' : ''}} value="tempo">Tempo Travera</option>
                                                            </select>
                                                            <div><span style="color: red;">{{ $errors->first('pickup_date') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-1 row">
                                                        <div class="col-12">
                                                            <label class="col-form-label l1" for="fname-icon">Flight Number</label>
                                                        </div>

                                                        <div class="col-12">
                                                            {!! Form::text('flight_number', null, array('placeholder' => 'Flight Number','id'=>'flight_number','class' => 'form-control')) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-1 row">
                                                        <div class="col-12">
                                                            <label class="col-form-label l1" for="fname-icon">Gross total</label>
                                                        </div>

                                                        <div class="col-12">
                                                            {!! Form::text('gross_total', null, array('placeholder' => 'Gross Total','id'=>'gross_total','class' => 'form-control','readonly'=>'true')) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="row col-12">
                                                    <div class="col-4">
                                                        <div class="mb-1 row">
                                                            <div class="col-12">
                                                                <label class="col-form-label l1" for="fname-icon">Discount</label>
                                                            </div>

                                                            <div class="col-12">
                                                                {!! Form::text('discount', null, array('placeholder' => 'Discount','id'=>'discount','name'=>'discount','class' => 'form-control ')) !!}

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="mb-1 row">
                                                            <div class="col-12">
                                                                <label class="col-form-label l1" for="fname-icon">Total Amount</label>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="input-group input-group-merge">
                                                                    {!! Form::text('total_amount', null, array('placeholder' => 'Total Amount','id'=>'total_amount','name'=>'total_amount','class' => 'form-control','readonly'=>'readonly')) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="mb-1 row">
                                                            <div class="col-sm-12">
                                                                <label class="col-form-label l1" for="fname-icon">Extra Charge</label>
                                                            </div>


                                                                <div class="col-12">
                                                                    {!! Form::text('extra_charge', null, array('placeholder' => 'Extra charge','id'=>'extra_charge','name'=>'extra_charge','class' => 'form-control ')) !!}

                                                                </div>

                                                        </div>
                                                    </div>

                                            </div>

                                            <div class="row col-12">
                                                <div class="col-4">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="col-form-label l1" for="fname-icon">Customer Mobile</label>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                <input type="text" class="form-control" id="customer_mobile" name="customer_mobile" value="{{$user_data->user_mobile}}" readonly>
                                                                {{-- {!! Form::text('customer_mobile', null, array('placeholder' => 'Customer Mobile','id'=>'customer_mobile','class' => 'form-control ')) !!} --}}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('customer_mobile') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            {{-- {!! Form::hidden('user_id', null, array('placeholder' => 'User Id','id'=>'user_id','class' => 'form-control ','value'=> $user_id)) !!} --}}


                                                <div class="col-4">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="col-form-label l1" for="fname-icon">Customer name</label>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{$user_data->name}}" readonly>
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('customer_name') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="col-form-label l1" for="fname-icon">Customer email</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                <input type="text" class="form-control" id="email" name="email" value="{{$user_data->email}}" readonly>
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('email') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="col-form-label l1" for="fname-icon">Pickup Location </label>
                                                        </div>
                                                         <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                {!! Form::textarea('pickup_location', null, array('placeholder' => 'Pickup Location','id'=>'pickup_location','class' => 'form-control ','rows'=>4)) !!}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('pickup_location') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="col-form-label l1" for="fname-icon">drop Location </label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                {!! Form::textarea('drop_location', null, array('placeholder' => 'drop Location','id'=>'drop_location','class' => 'form-control ','rows'=>4)) !!}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('drop_location') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-9 offset-sm-3 pl">
                                                    <button type="submit" id="submit_id" class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>

                                                    <a href="{{route('onewaybookings.index')}}"><button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Vendor JS-->
    @include('layouts._footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
<script>
        $(window).on("load", function () {
            if (feather) {
                feather.replace({ width: 14, height: 14 });
            }
        });
    </script>
    <script type="text/javascript">
        // $( document ).ready(function() {
        //     $('#pickupcity_id').prepend('<option value="" selected >Select Pickup City</option>');
        // });
    </script>
        <script>
            $(function() {

                $('#pickup_date').datepicker({
                startDate: new Date()
             });

         });

        </script>
   <!-------------- Get cab_type -------------->
<script>
    var total = Math.round($('#total_input').val()).toFixed(0);
    var discount = Math.round($('#discount').val());
    var num1 =$('#total_amount').val();
    var num2 = $('#extra_charge').val();
    $('#discount').on('keyup', function() {
      var total = Math.round($('#gross_total').val()).toFixed(0);
      var discount = Math.round($('#discount').val());
      if(total == '') {
        alert('Please, Enter Valid Amount');
      } else {
        if(total > discount){
          var total_amount = (total - discount);
          $('#total_amount').val(total_amount);
        }else{
          alert('Please, Enter Valid Amount');
          $('#discount').val();
          $('#discount').focus();
        }
      }
    });
</script>


   <script>
    jQuery(document).ready(function(){
        jQuery('#cab_type').change(function()

        {

            var dropcity = $('#dropcity_id').val();
            var pcity_id         = $('#pickcity_id_roundtrip').val();
            var pickup_date        = $('#pickup_date').val();
            var pickup_time        = $('#pickup_time').val();
            var jdays            = $('#journy_days').val();
            var cab_type         = $('#cab_type').val();
            var gross_total      = $('#gross_total').val();
            var travel_cities1 = $('#travel_cities1').val();

            if(pcity_id == '' || pickup_date == '' || pickup_time == '' ||  travel_cities1 == '')
            {
                alert('Requied All Fileds');
                $('#gross_total').val(0);
                $('#cab_type').val('');
                $('#travel_cities1').val('');
            }else{
                var city = $("input[name^='travel_cities']").map(function(){
                return this.value;

            }).get();
            var travel_cities = city.join("|");

            $('#travel').val(travel_cities);
                        $.ajax({
                    type: "POST",
                    url: "{{route('get_estimate')}}",
                    dataType: "json",
                    data:{travel_cities:travel_cities,pcity_id:pcity_id,pickup_date:pickup_date,pickup_time:pickup_time,jdays:jdays,cab_type:cab_type},
                    success: function(data){
                        if(data.value_null) {
                        alert('Please Try Another Cab !');
                        $('#gross_total').val(0);
                        $('#submit_id').attr("disabled", 'disabled');
                        } else {
                        $('#ride_gst').val(data.ride_gst);
                        if($('#dropcity').val(data.dropcity)) {
                        $('#submit_id').removeAttr("disabled");
                        }
                        $('#perkm_rate').val(data.km_rate);
                        $('#esti_kms').val(data.esti_kms);
                        $('#gross_total').val(data.gross_total);
                        }
                    }
                    });
            }



        });
    });
</script>




     <!-------------- Get Customer Detail -------------->
    <script>
        jQuery(document).ready(function(){
            jQuery('#customer_mobile').on('keyup', function()
                {
                            var customer_mobile =jQuery('#customer_mobile').val();
                            jQuery.ajax({
                                type: "Post",
                                url: "{{route('user_check')}}",
                                data:  'customer_mobile='+customer_mobile+
                                '&_token={{csrf_token()}}',

                                success: function(result) {

                                if(result != 0) {
                                $('#user_id').val(result[0]);
                                $('#customer_name').val(result[1]);
                                $('#customer_email').val(result[2]);
                                $('#customer_name').attr('disabled','disabled');
                                $('#customer_email').attr('disabled','disabled');
                                }
                                else {
                                $('#user_id').val(0);
                                $('#customer_name').val('');
                                $('#customer_email').val('');
                                $('#customer_name').removeAttr('disabled','disabled');
                                $('#customer_email').removeAttr('disabled','disabled');
                                }
                            }
                        });
                    return false;
                });
        });
    </script>
<!---------------Extra Charge --------------------->
<script>
    jQuery(document).ready(function(){
        jQuery('#extra_charge').on('keyup', function() {
        var total = Math.round($('#gross_total').val()).toFixed(0);
        var discount = $('#discount').val();
        var num1 =$('#total_amount').val();
        var num2 = $('#extra_charge').val();

        if(discount == '') {

          var answer = parseInt(total) + parseInt(num2);
          $('#total_amount').val(answer);

        } else {
          if(parseInt(num1) > parseInt(num2)){
            var numBeR = parseInt(total) - parseInt(discount)
;
            var answer = parseInt(numBeR) + parseInt(num2);
            $('#total_amount').val(answer);
          }else{
            var numBeR = parseInt(total) - parseInt(discount)
;
              alert('Please, Enter Valid Amount');
              $('#extra_charge').val();
              $('#extra_charge').focus();
              $('#total_amount').val(numBeR);
          }
        }
      });
    });
</script>
<!-----------------Discount ---------------------->
<script>
    jQuery(document).ready(function()
    {
        var total = Math.round($('#total_input').val()).toFixed(0);
          var discount = Math.round($('#discount').val());
          var num1 =$('#total_amount').val();
          var num2 = $('#extra_charge').val();

          jQuery('#discount').on('keyup', function()
         {
            var total = Math.round($('#gross_total').val()).toFixed(0);
            var discount = Math.round($('#discount').val());
            if(total == '') {
                alert('Please, Enter Valid Amount');
            } else {
               if(total > discount){
              var total_amount = (total - discount);
              $('#total_amount').val(total_amount);
              }else{
                alert('Please, Enter Valid Amount');
                $('#discount').val();
                $('#discount').focus();
            }
        }
      });

    });
</script>
<script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    var max_fields      = 4;
    var wrapper =  $(".input_fields_wrap");

   var remove_button   = $("#remove"); //Fields wrapper
   $("#remove").attr( "disabled", "disabled" );
   var add_button      = $("#add"); //Add button ID
   var x = 1; //initlal text box count

   $(add_button).click(function(e) { //on add input button click
       e.preventDefault();
       $("#remove").removeAttr( "disabled", "disabled" );
       var t_check 		= $('#travel_cities1').val();

       if(t_check == '') {
           alert('Please Select City First');
           return false;
       } else {
           if(x < max_fields){ //max input box allowed
               x++; //text box increment
               $('.extra_input').append('<div class="col-md-12"><div class="form-group" id="appendDiv_id'+x+'"><label id="lable-travel'+x+'" style="font-size:15px;"></label><input type="text" style="margin-top:10px"; class="mul_city form-control pac-target-input" id="travel_cities'+x+'" name="travel_cities[]" placeholder="Enter a Location" autocomplete="off"></div></div>');
                   set_code();
               }
       }
   });
</script>
<script>
$("#remove").click(function(event) {
       $("#remove").removeAttr( "disabled", "disabled" );

           var x1 = x++;
           var t_check 		= $('#travel_cities1').val();
           $('#travel_cities'+x+'').remove(); x--;
           $('#appendDiv_id'+x1+'').remove(); x--;
           if (x==1) {
                 $('#remove').attr("disabled", "disabled");
               }
});
</script>

</div>
<script type="text/javascript">
window.onload = function()
{
 initialize();
}

var autocomplete;
function initialize()
{
   var travel_cities = document.getElementById('travel_cities1');
   autocomplete1 = new google.maps.places.Autocomplete((travel_cities),{ types: ['geocode'],types: ['(cities)'],componentRestrictions: {country: 'in'} });
   google.maps.event.addListener(autocomplete1, 'place_changed', function() {
   });
}
function set_code()
{
 var elms = document.querySelectorAll(".mul_city");
 for (var i = 1; i <= elms.length; i++) {
     var p = i+1;
     autocomplete1  = new google.maps.places.Autocomplete((document.getElementById('travel_cities'+p)),{ types: ['geocode'],componentRestrictions: {country: 'in'} });
       google.maps.event.addListener(autocomplete1, 'place_changed', function() {
       });
   }
}
</script>
<script>
    var max_fields      = 4;
    var wrapper =  $(".input_fields_wrap");

   var remove_button   = $("#remove_mobile"); //Fields wrapper
   $("#remove_mobile").attr( "disabled", "disabled" );
   var add_button      = $("#add_mobile"); //Add button ID
   var x = 1; //initlal text box count

   $(add_button).click(function(e) { //on add input button click
       e.preventDefault();
       $("#remove_mobile").removeAttr( "disabled", "disabled" );
       var t_check 		= $('#travel_cities1').val();

       if(t_check == '') {
           alert('Please Select City First');
           return false;
       } else {
           if(x < max_fields){ //max input box allowed
               x++; //text box increment
               $('.extra_input').append('<div class="col-md-12"><div class="form-group" id="appendDiv_id'+x+'"><label id="lable-travel'+x+'"  style="font-size:11px;"></label><input type="text" style="margin-top:10px;" class="mul_city form-control pac-target-input" id="travel_cities'+x+'" name="travel_cities[]" placeholder="Enter a Location" autocomplete="off"></div></div>');
                   set_code();
               }
       }
   });
</script>
<script>
$("#remove_moble").click(function(event)
{
       $("#remove_moble").removeAttr( "disabled", "disabled" );

           var x1 = x++;
           var t_check 		= $('#travel_cities1').val();
           $('#travel_cities'+x+'').remove(); x--;
           $('#appendDiv_id'+x1+'').remove(); x--;
           if (x==1) {
                 $('#remove_mobile').attr("disabled", "disabled");
               }
});
</script>
</div>
<script type="text/javascript">
window.onload = function()
{
 initialize();
}

var autocomplete;
function initialize()
{
   var travel_cities = document.getElementById('travel_cities1');
   autocomplete1 = new google.maps.places.Autocomplete((travel_cities),{ types: ['geocode'],types: ['(cities)'],componentRestrictions: {country: 'in'} });
   google.maps.event.addListener(autocomplete1, 'place_changed', function() {
   });
}
function set_code()
{
 var elms = document.querySelectorAll(".mul_city");
 for (var i = 1; i <= elms.length; i++) {
     var p = i+1;
     autocomplete1  = new google.maps.places.Autocomplete((document.getElementById('travel_cities'+p)),{ types: ['geocode'],componentRestrictions: {country: 'in'} });
       google.maps.event.addListener(autocomplete1, 'place_changed', function() {
       });
   }
}
</script>

<script>

var wrapper = $(".input_fields_wrap"); // append button
var divCount = 1;
var divCount = $(".input_fields_wrap").length;
var max_fields = 5;
var max_fields = 5;
                    if (divCount == 1) {
                        divCount++;
                        if (divCount < max_fields) {
                            $(".new").append(
                                '<div id="t' +
                                    divCount +
                                    '" class="col-md-12"><input type="text" class="mul_city form-control pac-target-input travel_cities top-margin" id="travel_cities' +
                                    divCount +
                                    '" name="travel_cities[]" placeholder="Enter a Location" autocomplete="off"></div>'
                            ); //add input box
                            set_code();
                        }
                    } else if (divCount == 2) {
                        if (divCount < max_fields) {
                            divCount++;
                            $(".new").append(
                                '<div id="t' +
                                    divCount +
                                    '" class="col-md-12"><input type="text" class="mul_city form-control pac-target-input travel_cities top-margin" id="travel_cities' +
                                    divCount +
                                    '" name="travel_cities[]" placeholder="Enter a Location" autocomplete="off"></div>'
                            ); //add input box
                            set_code();
                        }
                    } else if (divCount == 3) {
                        divCount++;
                        if (divCount < max_fields) {
                            $(".new").append(
                                '<div id="t' +
                                    divCount +
                                    '" class="col-md-12"><input type="text" class="mul_city form-control pac-target-input travel_cities top-margin" id="travel_cities' +
                                    divCount +
                                    '" name="travel_cities[]" placeholder="Enter a Location" autocomplete="off"></div>'
                            ); //add input box
                            set_code();
                        }
                    } else if (divCount == 4) {
                        divCount++;
                        if (divCount < max_fields) {
                            $(".new").append(
                                '<div id="t' +
                                    divCount +
                                    '" class="col-md-12"><input type="text" class="mul_city form-control pac-target-input travel_cities top-margin" id="travel_cities' +
                                    divCount +
                                    '" name="travel_cities[]" placeholder="Enter a Location" autocomplete="off"></div>'
                            ); //add input box
                            set_code();
                        }
                    } else if (divCount == 5) {
                        divCount++;
                        if (divCount < max_fields) {
                            $("#add").removeAttr("disabled", "disabled");
                        }
                    }
</script>

</body>
<!-- END: Body-->


