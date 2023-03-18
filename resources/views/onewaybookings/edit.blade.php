@include('layouts._top_bar')
<head>
    <title>{{helpers::name()}} | Edit Onewaybookings</title>
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
                            <h2 class="content-header-title float-start mb-0">Edit Oneway Booking</h2>

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
                                    <h4 class="card-title">Oneway Details</h4>
                                </div>
                                <div class="card-body">

                                    {!! Form::model($onewaybookings, ['method' => 'PATCH','route' => ['onewaybookings.update', encrypt($onewaybookings->id)]]) !!}
                                            <div class="row col-12">
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Pick City</label>
                                                        </div>

                                                            <div class="col-sm-12">
                                                                <select class="form-select form-select-lg" name ="pickupcity_id" id="pickupcity_id">
                                                                    @foreach($pick_city as $pickcity)
                                                                    <option value="{{$pickcity->p_id}}"{{($onewaybookings->pickupcity_id==$pickcity->p_id)? 'selected':''}} >{{$pickcity->pick_city}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>


                                                    </div>
                                                </div>

                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Drop City</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <select class="form-select form-select-lg" name ="dropcity_id" id="dropcity_id">
                                                                @foreach($drop_city as $dropcity)
                                                                <option value="{{$dropcity->d_id}}"{{($onewaybookings->dropcity_id==$dropcity->d_id)? 'selected':''}} >{{$dropcity->drop_city}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Cab Type</label>
                                                        </div>
                                                        <div class="col-sm-12">

                                                            <select class="form-select form-select-lg" name ="cab_type" id="cab_type">
                                                                <option {{($onewaybookings->cab_type=='Hatchback')? 'selected' : ''}} value="Hatchback"  >Hatchback</option>
                                                                <option {{($onewaybookings->cab_type=='Sedan')? 'selected' : ''}} value="Sedan"  >Sedan</option>
                                                                <option {{($onewaybookings->cab_type=='Suv')? 'selected' : ''}} value="Suv"   >Suv</option>
                                                                <option {{($onewaybookings->cab_type=='Innova')? 'selected' : ''}} value="Innova"  >Innova</option>
                                                                <option {{($onewaybookings->cab_type=='Primesedan')? 'selected' : ''}} value="primesedan"  >Primium Sedan</option>
                                                                <option {{($onewaybookings->cab_type=='Primesuv')? 'selected' : ''}} value="primesuv"  >Primium Suv</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Flight Number</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">

                                                                {!! Form::text('flight_number', null, array('placeholder' => 'Flight Number','class' => 'form-control form-select-lg')) !!}
                                                            </div>
                                                            <div><span style="color:red">{{  $errors->first('flight_number') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row col-12">
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Pickup Date</label>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                {!! Form::text('pickup_date', null, array('placeholder' => 'Pickup date','id'=>'pickup_date','class' => 'form-control form-select-lg date')) !!}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('pickup_date') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Pickup Time</label>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <select class="form-select form-select-lg"  name ="pickup_time" id="pickup_time" required='required' >
                                                                <option value="">Select Pickup Time</option>
                                                                <?php
                                                                for($hours=0; $hours<24; $hours++){ // the interval for hours is '1'

                                                                  for($mins=0; $mins<60; $mins+=60){ // the interval for mins is '30'
                                                                       $sel="";
                                                                      if($onewaybookings->pickup_time == str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT)){
                                                                          $sel='selected="selected"';
                                                                      }

                                                                      echo '<option '.$sel.' value = "'.str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT).'">'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                                                                                     .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
                                                                      }} ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Gross total</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <select class="form-select" name ="gross_total" id="gross_total" readonly="readonly" >
                                                                <option {{($onewaybookings->gross_total)? 'selected' : ''}} >{{$onewaybookings->gross_total}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Discount</label>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                {!! Form::text('discount', null, array('placeholder' => 'Discount','id'=>'discount','name'=>'discount','class' => 'form-control form-select-lg')) !!}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('discount') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Total Amount</label>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">

                                                                <input type="text" class="form-control form-select-lg" id="total_amount" name="total_amount"  value="{{$onewaybookings->total_amount}}" readonly>
                                                                {{-- {!! Form::text('total_amount', null, array('placeholder' => 'Total Amount','id'=>'total_amount','name'=>'total_amount','class' => 'form-control form-select-lg','disabled'=>'true')) !!} --}}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('total_amount') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Extra Charge</label>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                {!! Form::text('extra_charge', null, array('placeholder' => 'Extra Charge','id'=>'extra_charge','name'=>'extra_charge','class' => 'form-control form-select-lg')) !!}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('extra_charge') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1">Customer Mobile</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control form-select-lg" id="user_mobile" name="user_mobie" value="{{$user_data->user_mobile}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1">Customer Name</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control form-select-lg" id="name" name="name"  value="{{$user_data->name}}">
                                                            {{-- <input type="hidden" class="form-control" id="user_id" name="user_id"  value="{{$onewaybookings->user_id}}"> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row col-12">
                                                <div class="col-6 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1">Customer email</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control form-select-lg" id="email" name="email"  value="{{$user_data->email}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Alternative Mobile</label>
                                                        </div>
                                                         <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                <input type="text" class="form-control form-select-lg" id="alternet_mobile" name="alternet_mobile" value="{{$data->alternet_mobile}}">
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('alternet_mobile') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Pickup Location </label>
                                                        </div>
                                                         <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                {!! Form::textarea('pickup_location', null, array('placeholder' => 'Pickup Location','class' => 'form-control ','rows'=>5)) !!}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('pickup_location') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">drop Location </label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                {!! Form::textarea('drop_location', null, array('placeholder' => 'drop Location','class' => 'form-control ','rows'=>5)) !!}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('drop_location') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12" style="text-align: center">
                                                <a  ><button type="sumbit" class="btn btn-primary me-1" >Update</button></a>


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
        <script>
            $(function() {

                $('#pickup_date').datepicker({
                format: 'dd-mm-yyyy',
                    startDate: new Date()

             });

         });

        </script>
    <script type="text/javascript">

        // default open create for parent category
        $( document ).ready(function() {
            $('#from').prepend('<option value="" selected disabled>Select Pickup City</option>');
        });
    </script>
    <script>
        jQuery(document).ready(function(){
            jQuery('#cab_type').change(function()

            {

                var pid = $('#pickupcity_id').val();
                var did   = $('#dropcity_id').val();
                var cid   = jQuery(this).val();

                jQuery.ajax({
                    headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
              },
                    type:'POST',
                    url:"{{route('onewaybookings.get_gross_total')}}",

                    data:{pid:pid,did: did,cid:cid},
                    success:function(result){

                        if(result==0){
                            alert('This Cab Is Not Avilable Please Select Other Cab')

                        }else{
                            jQuery('#gross_total').html(result)
                        }

                    }
                });
            });
        });
    </script>
    <script>
        jQuery(document).ready(function(){
            jQuery('#pickupcity_id').change(function()

            {

                let pid=jQuery(this).val();

                jQuery.ajax({
                    url:"{{route('onewaybookings.updateDropcity')}}",
                    type:'post',
                    data:'pid='+pid+
                    '&_token={{csrf_token()}}',
                    success:function(result){

                        if(result==0){
                            alert('select Other City')
                        }else{
                            jQuery('#dropcity_id').html(result)
                        }

                    }
                });
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

        $("#close").click(function(){

            window.location.replace('{{route('onewaybookings.index')}}');
        });
        </script>
</body>
<!-- END: Body-->


