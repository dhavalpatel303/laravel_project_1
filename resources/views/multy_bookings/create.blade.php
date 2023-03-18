<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Create Bookings</title>
    </head>
        @include('layouts._top_bar')


<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('layouts._sidebar')

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Add Book Cab</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Book Cab</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        @if(session()->has('danger'))
                        <div class="alert alert-danger" role="alert">
                            <div class="alert-body">
                                {{ session()->get('danger') }}
                             </div>
                        </div>
                        @endif

                            {!! Form::open(array('route' => 'multy_bookings.store','class'=>'form form-horizontal','id'=>'multy_form','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
                                <div class="form-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-2" style="margin-top: 15px">
                                                        <div class="form-group">
                                                            <label>Select Route<span class="red">*</span></label>
                                                            <select class="form-select form-select-lg form-control" name="booking_type" id="booking_type" required="true">
                                                                <option value="Oneway">Oneway</option>
                                                                <option value="Round-Trip">Round-Trip</option>
                                                                <option value="Localpackage">Local-Package</option>
                                                            </select>
                                                            {{-- <input type="text" id="city_name" name="city_name" class="form-control pac-target-input" value="" placeholder="Enter a City" autocomplete="off" /> --}}
                                                        </div>
                                                        <div><span style="color: red;">{{ $errors->first('pick_city') }}</span></div>
                                                    </div>
                                                    {{-- ////**** Oneway Pickup ***///// --}}

                                                    <div class="col-md-3" id="oneway_content" style="margin-top: 15px">
                                                        <label>Select Pickup City<span class="red">*</span></label>
                                                        {!! Form::select('pickupcity_id', $pickupcity_id,[], array('class' => 'form-select form-select-lg form-control','id'=>'pickupcity_id','for'=>'select2-basic','required')) !!}
                                                        <div><span id="pickcity"></span></div>
                                                    </div>

                                                    {{-- ////**** Local Pickup ***///// --}}

                                                    <div class="col-md-3" id="local_content" style="margin-top: 15px">
                                                        <label>Select Pickup City<span class="red">*</span></label>
                                                        {!! Form::select('pickupcity_id', $pickupcity_id,[], array('class' => 'form-select form-select-lg form-control','id'=>'pickcity_id','for'=>'select2-basic','required')) !!}
                                                        <div><span id="pickcity_local"></span></div>
                                                    </div>
 
                                                        {{-- ////**** Round Trip Pickup ***///// --}}
                                                    <div class="col-md-3" id="round_content" style="margin-top: 15px">
                                                        <label>Select Pickup City<span class="red">*</span></label>
                                                        {!! Form::select('pickupcity_id', $pickupcity_id,[], array('class' => 'form-select form-select-lg form-control','id'=>'pickcity_id_roundtrip','for'=>'select2-basic','required')) !!}
                                                        <div><span id="pickcity_round"></span></div>
                                                    </div>

                                                        <input type="hidden" id="esti_kms" name="esti_kms" value="">
                                                        <input type="hidden" id="perkm_rate" name="perkm_rate" value="">
                                                        <input type="hidden" id="dropcity" name="dropcity" value="">
                                                        <input type="hidden" id="travel" name="travel" value="">
                                                        <input type="hidden" id="ride_gst" name="ride_gst" value="">

                                                    {{-- ////**** Oneway Drop ***///// --}}
                                                    <div class="col-md-3" id="oneway_dropcity" style="margin-top: 15px">
                                                        <label>Select Drop City<span class="red">*</span></label>
                                                        <select class="form-select form-select-lg form-control" name="dropcity_id" id="dropcity_id" required="true">
                                                            <option value="select_drop">Select Drop City</option>
                                                        </select>
                                                        <div><span id="dropcity_error"></span></div>
                                                    </div>
                                                    {{-- ////**** Local Drop ***///// --}}
                                                    <div class="col-md-3" id="local_dropcity" style="margin-top: 15px">
                                                        <label>Select Local Package<span class="red">*</span></label>
                                                        <select class="form-select form-select-lg form-control" name="local_dropcity_id" id="package_id" required="true">
                                                            <option value="select_cab">Select Local Package</option>
                                                        </select>
                                                        <div><span id="dropcity_local"></span></div>
                                                    </div>

                                                    {{-- ////**** Oneway Cab ***///// --}}
                                                    <div class="col-md-2" id="oneway_cab" style="margin-top: 15px">
                                                        <label>Cab Type<span class="red">*</span></label>
                                                        <select class="form-select form-select-lg form-control" name="cab_type" id="cab_type" required="true">
                                                            <option value="">Select Cab</option>
                                                        </select>
                                                        <div><span id="cab"></span></div>
                                                    </div>

                                                    {{-- ////**** Local Cab ***///// --}}
                                                    <div class="col-md-2" id="local_cab" style="margin-top: 15px">
                                                        <label>Cab Type<span class="red">*</span></label>
                                                        <select class="form-select form-select-lg form-control" name="local_cab_type" id="localcab_type" required="true">
                                                            <option value="">Select Cab</option>
                                                        </select>
                                                        <div><span id="local_cab_erorr"></span></div>
                                                    </div>
                                                    {{-- ////**** Round Trip Drop City ***///// --}} 
                                                    <div class="col-md-3" id="round_dropcity" style="margin-top: 15px">
                                                        <label>Travel City<span class="red">*</span></label>
                                                        <input type="text" id="travel_cities1" placeholder="Enter a Location" required="" name="travel_cities[]" class="form-control pac-target-input" autocomplete="off"><br>
                                                        <div class="field-box">
                                                            <div class="extra_input input_fields_wrap"></div>
                                                            <div class="space-pad">
                                                                <button type="button" id="add" name="add" class="btn btn-success">Add</button>
                                                                <button type="button" id="remove" name="remove" class="btn btn-dark" disabled="disabled">Remove</button>
                                                            </div>
                                                        </div>
                                                        <div><span id="travel_error"></span></div><br>

                                                    </div>
                                                    {{-- ////**** Journy Days ***///// --}}
                                                    <div class="col-md-2" id="journy" style="margin-top: 15px">
                                                        <label>Journy Days<span class="red">*</span></label>
                                                        <select class="form-select form-select-lg form-control"  name ="journy_days" id="journy_days" required='required' >
                                                            <?php for($i=0; $i<10; $i++) {?>
                                                                <option value="<?=$i+1?>"><?=$i+1?>
                                                                    <span>Days</span>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                        <div><span id="j_days"></span></div>
                                                    </div>
                                                    <div class="col-md-2" style="margin-top: 15px">
                                                        <label>Flight Number<span class="red">*</span></label>
                                                        {!! Form::text('flight_number', null, array('placeholder' => 'Flight Number','class' => 'form-control form-select-lg')) !!}
                                                        <div><span style="color: red;">{{ $errors->first('flight_number') }}</span></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                 {{-- ////**** Pickup Date ***///// --}}
                                                <div class="col-md-3">
                                                    <label>Pickup Date<span class="red">*</span></label>
                                                    {!! Form::date('pickup_date', null, array('placeholder' => 'Pickup date','id'=>'pickup_date','class' => 'form-control form-select-lg')) !!}
                                                    <div><span id="date"></span></div>
                                                </div>


                                                {{-- ////**** Pickup Time ***///// --}}
                                                <div class="col-md-3">
                                                    <label>Pickup Time<span class="red">*</span></label>
                                                    <select class="form-select form-select-lg form-control"  name ="pickup_time" id="pickup_time" required='required' >
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
                                                    <div><span id="time"></span></div>
                                                </div>
                                                 {{-- ////**** Cab type***///// --}}
                                                <div class="col-md-2"  id="round_cab">
                                                    <label>Cab Type<span class="red">*</span></label>
                                                    <select class="form-select form-select-lg form-control" name="round_cab_type" id="roundcab_type" required="true">
                                                        <option value="select_cab">Select Cab</option>
                                                        <?php for($i=0; $i<count($cab); $i++) {?>
                                                            <option value="{{$cab[$i]['id']}}">
                                                                {{$cab[$i]['cab']}}
                                                            </option>
                                                        <?php } ?>


                                                    </select>
                                                </div>
                                                <div><span id="round_cab_erorr"></span></div>

                                                 {{-- ////****Gross Total***///// --}}
                                                <div class="col-md-3"  id="oneway_gross">
                                                    <label>Gross total<span class="red">*</span></label>
                                                    {!! Form::text('gross_total', null, array('placeholder' => 'Enter Gross Total','id'=>'gross_total','name'=>'gross_total','class' => 'form-control','readonly'=>'true','required'=>'true')) !!}
                                                </div>

                                                <div class="col-md-3"  id="local_gross">
                                                    <label>Gross total<span class="red">*</span></label>
                                                    {!! Form::text('gross_total', null, array('placeholder' => 'Enter Gross Total','id'=>'localgross_total','name'=>'local_gross_total','class' => 'form-control','readonly'=>'true','required'=>'true')) !!}
                                                </div>

                                                <div class="col-md-2"  id="round_gross">
                                                    <label>Gross total<span class="red">*</span></label>
                                                    {!! Form::text('gross_total', null, array('placeholder' => 'Enter Gross Total','id'=>'roundgross_total','name'=>'roundgross_total','class' => 'form-control','readonly'=>'true','required'=>'true')) !!}
                                                </div>
                                                 {{-- ////****Round Trip Details***///// --}}
                                                <div class="col-md-2"  id="round_details" style="margin-top: 15px;">

                                                    <div class="d-flex align-items-center me-2 popup" onclick="myFunction()">
                                                        <i class="fa fa-circle text-success" ></i>
                                                        <span class="bullet bullet-primary font-small-3 me-50 cursor-pointer" style="margin-left:5px"></span>
                                                        <span>More Info +</span>
                                                        <span class="popuptext" id="myPopup">
                                                            <span>Total Km : <label id="total_kms"></label> Km</span><br>
                                                            <span>Per Km rate : <label id="km_rate"></label>.Rs/- </span><br>
                                                            <span>Driver : <label id="dl"></label>.Rs/- </span>

                                                        </span>
                                                      </div>
                                                </div>
                                                 {{-- ////****Discount***///// --}} 
                                                <div class="col-md-3"  id="oneway_dis">
                                                    <label>Discount<span class="red">*</span></label>
                                                    {!! Form::text('discount', null, array('placeholder' => 'Discount','id'=>'discount','name'=>'discount','class' => 'form-control form-select-lg','required')) !!}
                                                    <div><span id="dis"></span></div>
                                                </div>


                                                <div class="col-md-3"  id="local_dis">
                                                    <label>Discount<span class="red">*</span></label>
                                                    {!! Form::text('discount', null, array('placeholder' => 'Discount','id'=>'local_discount','name'=>'local_discount','class' => 'form-control form-select-lg','required')) !!}
                                                    <div><span id="local_dis_error"></span></div>
                                                </div>


                                                <div class="col-md-2"  id="round_dis" style="margin-top: 15px;">
                                                    <label>Discount<span class="red">*</span></label>
                                                    {!! Form::text('discount', null, array('placeholder' => 'Discount','id'=>'round_discount','name'=>'round_discount','class' => 'form-control form-select-lg','required')) !!}
                                                    <div><span id="round_dis_error"></span></div>
                                                </div>


                                                {{-- ////****Total Amount***///// --}}

                                                <div class="col-md-3"  id="oneway_total" style="margin-top: 15px;">
                                                    <label>Total Amount<span class="red">*</span></label>
                                                    {!! Form::text('total_amount', null, array('placeholder' => '','id'=>'total_amount','name'=>'total_amount','class' => 'form-control form-select-lg','readonly'=>'readonly','required')) !!}
                                                </div>
                                                <div><span style="color: red;">{{ $errors->first('total_amount') }}</span></div>

                                                <div class="col-md-3"  id="local_total" style="margin-top: 15px;">
                                                    <label>Total Amount<span class="red">*</span></label>
                                                    {!! Form::text('total_amount', null, array('placeholder' => '','id'=>'local_total_amount','name'=>'local_total_amount','class' => 'form-control form-select-lg','readonly'=>'readonly','required')) !!}
                                                </div>
                                                <div><span style="color: red;">{{ $errors->first('total_amount') }}</span></div>

                                                <div class="col-md-2"  id="round_total" style="margin-top: 15px;">
                                                    <label>Total Amount<span class="red">*</span></label>
                                                         {!! Form::text('total_amount', null, array('placeholder' => '','id'=>'round_total_amount','name'=>'round_total_amount','class' => 'form-control form-select-lg','readonly'=>'readonly','required')) !!}
                                                </div>
                                                <div><span style="color: red;">{{ $errors->first('total_amount') }}</span></div>

                                                {{-- ////****Extra Charge***///// --}}

                                                <div class="col-md-3"  id="oneway_extra" style="margin-top: 15px;">
                                                    <label>Extra Charge<span class="red">*</span></label>
                                                    {!! Form::text('extra_charge', null, array('placeholder' => 'Extra Charge','id'=>'extra_charge','name'=>'extra_charge','class' => 'form-control form-select-lg')) !!}
                                                </div>

                                                <div class="col-md-3"  id="local_extra" style="margin-top: 15px;">
                                                    <label>Extra Charge<span class="red">*</span></label>
                                                    {!! Form::text('extra_charge', null, array('placeholder' => 'Extra Charge','id'=>'local_extra_charge','name'=>'local_extra_charge','class' => 'form-control form-select-lg')) !!}
                                                </div>

                                                <div class="col-md-2"  id="round_extra" style="margin-top: 15px;">
                                                    <label>Extra Charge<span class="red">*</span></label>
                                                    {!! Form::text('extra_charge', null, array('placeholder' => 'Extra Charge','id'=>'round_extra_charge','name'=>'round_extra_charge','class' => 'form-control form-select-lg')) !!}
                                                </div>

                                                {{-- ////****Customer Details***///// --}}

                                                <div class="col-md-3"  id="round_extra" style="margin-top: 15px;">
                                                    <label>Customer Mobile<span class="red">*</span></label>
                                                    <input type="number" placeholder="Enter Mobile Number" pattern="/^-?\d+\.?\d*$/"  onKeyPress="if(this.value.length==10) return false;" id="customer_mobile" name="customer_mobile" class="form-control form-select-lg" />
                                                    <div><span id="mobile"></span></div>
                                                </div>

                                                {!! Form::hidden('user_id', null, array('placeholder' => 'User Id','id'=>'user_id','class' => 'form-control form-select-lg','value'=> $user_id)) !!}
                                                {!! Form::hidden('onewaydetail_id', null, array('placeholder' => '','id'=>'onewaydetail_id','name'=>'onewaydetail_id','class' => 'form-control form-select-lg')) !!}
                                                {!! Form::hidden('localdetail_id', null, array('placeholder' => '','id'=>'localdetail_id','name'=>'localdetail_id','class' => 'form-control form-select-lg')) !!}
                                                <div class="col-md-3"  style="margin-top: 15px;">
                                                    <label>Customer Name<span class="red">*</span></label>
                                                    {!! Form::text('customer_name', null, array('placeholder' => 'Enter Customer Name','id'=>'customer_name','class' => 'form-control form-select-lg')) !!}
                                                    <div><span id="name"></span></div>
                                                </div>


                                                <div class="col-md-6"  style="margin-top: 15px;">
                                                    <label>Customer Email<span class="red">*</span></label>
                                                    {!! Form::text('email', null, array('placeholder' => 'Enter Customer Email','id'=>'customer_email','class' => 'form-control form-select-lg' ))!!}
                                                    <label id="email_result"></label>
                                                    <div><span id="email"></span></div>
                                                </div>


                                                <div class="col-md-6"  style="margin-top: 15px;">
                                                    <label>Alternet Mobile<span class="red">*</span></label>
                                                    {!! Form::text('alternet_mobile', null, array('placeholder' => 'Enter Alternet Mobile Number','class' => 'form-control form-select-lg')) !!}
                                                </div>
                                                <div class="col-md-6"  style="margin-top: 15px;">
                                                    <label>Pickup Location<span class="red">*</span></label>
                                                    {!! Form::textarea('pickup_location', null, array('placeholder' => 'Pickup Location','id'=>'pickup_location','class' => 'form-control form-select-lg','rows'=>3,'required')) !!}
                                                    <div><span id="pick_location"></span></div>
                                                </div>


                                                <div class="col-md-6"  style="margin-top: 15px;">
                                                    <label>Drop Location<span class="red">*</span></label>
                                                        {!! Form::textarea('drop_location', null, array('placeholder' => 'Drop Location','id'=>"drop_location",'class' => 'form-control form-select-lg','rows'=>3,'required')) !!}
                                                        <div><span id="drop_location_error"></span></div>
                                                </div>

                                            </div>
                                            <div class="col-md-12 text-center">
                                                <div class="form-actions">
                                                    <div class="card-body">
                                                        <button type="button" id="hello_button" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                                                        <a href="{{route('pickup.index')}}" class="btn btn-dark">Cancel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            {!!Form::close()!!}


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="chat-windows"></div>
   @include('layouts._footer')
   @include('layouts.app')

   <!-- END: Page JS-->




</body>

</html>
