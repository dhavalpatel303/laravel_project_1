@include('layouts._top_bar')
<head>
    <title>{{helpers::name()}} | Create localbooking</title>
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
                            <h2 class="content-header-title float-start mb-0">Create Local Booking</h2>

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
                                    <h4 class="card-title">Local Booking</h4>
                                </div>
                                <div class="card-body">

                                    {!! Form::open(array('route' => 'localbookings.store','class'=>'form form-horizontal','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
                                            <div class="row col-12">
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Pickup City</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                {!! Form::select('pickupcity_id', $pickupcity_id,[], array('class' => 'form-control form-select-lg','placeholder'=>'Select Pickup City','id'=>'pickcity_id','for'=>'select2-basic','required')) !!}
                                                            </div>
                                                            <div><span style="color:red">{{  $errors->first('pickcity_id') }}</span></div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Select Package</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <select class="form-select form-select-lg" name ="dropcity" id="dropcity_id" required="true">
                                                                <option value="">Select Packages</option>
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
                                                            <select class="form-select form-select-lg" name ="cab_type" id="cab_type" required="true" >
                                                            <option value="">Select Cab Type</option>
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
                                                                <input class="form-control form-select-lg date" id="pickup_date" name="pickup_date" required placeholder="{{date("d/m/Y ")}}" readonly>
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
                                                                            for ($hours = 1; $hours < 24; $hours++) // the interval for hours is '1'
                                                                            {
                                                                            for ($mins = 0; $mins < 60; $mins += 60) // the interval for mins is '30'
                                                                            {
                                                                            echo '<option value = "' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT) . '">' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':'
                                                                            . str_pad($mins, 2, '0', STR_PAD_LEFT) . '</option>';
                                                                            }
                                                                            }

                                                                            ?>
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Gross Total</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <select class="form-select form-select-lg" name ="gross_total" id="gross_total" selected required="true" >
                                                                <option value="">Select Gross Total</option>
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
                                                                {!! Form::text('discount', null, array('placeholder' => 'Discount','id'=>'discount','name'=>'discount','class' => 'form-control form-select-lg ','required')) !!}
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
                                                                {!! Form::text('total_amount', null, array('placeholder' => '','id'=>'total_amount','name'=>'total_amount','class' => 'form-control form-select-lg','readonly'=>'readonly','required')) !!}
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
                                                                {!! Form::text('extra_charge', null, array('placeholder' => 'Extra Charge','id'=>'extra_charge','name'=>'extra_charge','class' => 'form-control form-select-lg ',)) !!}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('extra_charge') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Customer Mobile</label>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">

                                                                {!! Form::text('customer_mobile', null, array('placeholder' => 'Enter Mobile Number','id'=>'customer_mobile','name'=>'customer_mobile','class' => 'form-control form-select-lg ')) !!}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('customer_mobile') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>

                                  {!! Form::hidden('user_id', null, array('placeholder' => 'User Id','id'=>'user_id','class' => 'form-control form-select-lg ','value'=> $user_id)) !!}
                                  {!! Form::hidden('localdetail_id', null, array('placeholder' => '','id'=>'localdetail_id','name'=>'localdetail_id','class' => 'form-control form-select-lg')) !!}

                                                <div class="col-3 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Customer Name</label>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                {!! Form::text('customer_name', null, array('placeholder' => 'Enter Customer Name','id'=>'customer_name','class' => 'form-control form-select-lg ')) !!}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('customer_name') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Customer Email</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                {!! Form::text('email', null, array('placeholder' => 'Enter Customer Email','id'=>'customer_email','class' => 'form-control form-select-lg ' ))!!}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('email') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Alternet Mobile</label>
                                                        </div>
                                                         <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                {!! Form::text('alternet_mobile', null, array('placeholder' => 'Enter Alternet Mobile Number','class' => 'form-control form-select-lg ')) !!}
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
                                                                {!! Form::textarea('pickup_location', null, array('placeholder' => 'Enter Pickup Location','class' => 'form-control form-select-lg ','rows'=>4,'required')) !!}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('pickup_location') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 mobile-width">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-12">
                                                            <label class="form-label l1" for="selectLarge">Drop Location </label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                {!! Form::textarea('drop_location', null, array('placeholder' => 'Enter Drop Location','class' => 'form-control form-select-lg ','rows'=>4,'required')) !!}
                                                            </div>
                                                            <div><span style="color: red;">{{ $errors->first('drop_location') }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12" style="text-align: center">
                                                    <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>
                                                    {{-- {!! Form::close() !!}
                                                    <a href="{{route('localbookings.index')}}"><button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button></a> --}}
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
        <script>
            $(function() {

                $('#pickup_date').datepicker({

             });

         });

        </script>
    {{-- <script type="text/javascript">
        $( document ).ready(function() {
            $('#pickupcity_id').prepend('<option value="" selected disabled>Select Pickup City</option>');
        });
    </script>
      <script type="text/javascript">
        $( document ).ready(function() {
            $('#dropcity_id').prepend('<option value="" selected disabled>Select drop City</option>');
        });
    </script> --}}
   <!-------------- Get cab_type -------------->
   <script>
    jQuery(document).ready(function(){
        jQuery('#dropcity_id').change(function()

        {

            let did=jQuery(this).val();

            jQuery.ajax({
                url:"{{route('localbookings.get_cab_type')}}",
                type:'post',
                data:'did='+did+
                '&_token={{csrf_token()}}',
                success:function(result){

                    if(result==0){
                        alert('select Other City')
                        window.location.reload();
                    }else{
                        jQuery('#cab_type').html(result)
                    }

                }
            });
        });
    });

</script>
<!----------------Get Gross Total ------------->
<script>
    jQuery(document).ready(function(){
        jQuery('#cab_type').change(function()

        {

            var pid = $('#pickcity_id').val();

            var did   = $('#dropcity_id').val();

            var cid   = jQuery(this).val();

            jQuery.ajax({
                headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type:'POST',
                url:"{{route('localbookings.get_gross_total')}}",

                data:{pid:pid,did: did,cid:cid},
                success:function(result){

                    if(result==0){
                        alert('select')

                    }else{
                        jQuery('#gross_total').html(result)
                    }

                }
            });
        });
    });
</script>
     <!-------------- Get Drop City -------------->
     <script>
        jQuery(document).ready(function(){
            jQuery('#pickcity_id').change(function()

            {

                let pid=jQuery(this).val();

                jQuery.ajax({
                    url:"{{route('home.getlocalPackage')}}",
                    type:'post',
                    data:'pickupid='+pid+
                    '&_token={{csrf_token()}}',
                    success:function(result){

                        if(result==0){
                            alert('select Other City')
                            window.location.reload();
                        }else{
                            jQuery('#dropcity_id').html(result)
                        }

                    }
                });
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
                                url: "{{route('localbookings.user_check')}}",
                                data:  'customer_mobile='+customer_mobile+
                                '&_token={{csrf_token()}}',

                                success: function(result) {

                                if(result != 0) {
                                $('#user_id').val(result[0]);
                                $('#customer_name').val(result[1]);
                                $('#customer_email').val(result[2]);
                                $('#customer_name').attr('','');
                                $('#customer_email').attr('','');
                                }
                                else {
                                $('#user_id').val(0);
                                $('#customer_name').val('');
                                $('#customer_email').val('');
                                $('#customer_name').removeAttr('','');
                                $('#customer_email').removeAttr('','');
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

</body>
<!-- END: Body-->


