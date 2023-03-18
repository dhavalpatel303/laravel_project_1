
    @include('frontend.layout._top_bar')

        @include('frontend.layout._header')     

@if ($request->localid !='')
<section class="breadcrumb-section position-relative z-2 overflow-hidden mt--75" data-background="{{asset('front-assets/assets/img/shapes/texture-bg.png')}}" style="background-image: url(&quot;assets/img/shapes/texture-bg.png&quot;);">
            <img src="{{asset('front-assets/assets/img/shapes/tire-print-left.png')}}" alt="tire print" class="position-absolute start-0 z-1 tire-print">
            <img src="{{asset('front-assets/assets/img/shapes/tire-print-right.png')}}" alt="tire print" class="position-absolute end-0 z-1 tire-print">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                            <h1 class="text-white">Book Cab</h1>
                           
                        </div>
                    </div>
                </div>
            </div>
</section>
<section class="checkout-section ptb-50">
    <div class="container">
      
        <div class="row">
        <div class="col-xl-4">
                <div class="order-sidebar bg-white rounded mt-30">
                    <h4 class="mb-3">Booking Details</h4>
                    <span class="spacer"></span>
                    <a href="#" class="d-block mb-3">
                                    <img class="img-fluid rounded-xs" src="{{asset('public/profile/'.$cab->image)}}" alt="Image-Description">
                    </a>
                    <div class="col-md-12">
                    <h5 class="text_center">{{$cab->cab}}</h5>
                    </div>
                    <table class="w-100"> 
                        <tbody>
                            <tr>
                                <td><b>Pickup City</b></td>
                                <td>{{$local_pickcity->pick_city}}</td>
                            </tr>
                            <tr>
                                <td><b>Local Package </b></td>
                                <td>{{$package->local_package}}</td>
                            </tr>
                            <tr>
                                <td><b>Including KM`S</b></td>
                                <td>@if($package->local_package == '4Hr/40KMs' )
                                                        40 Km
                                                        @elseif($package->local_package == '6Hr/60KMs')
                                                        60 Km
                                                        @elseif($package->local_package == '8Hr/80KMs')
                                                        80 Km
                                                        @elseif($package->local_package == '10Hr/100KMs')
                                                        100 Km
                                                        @else
                                                        120 Km
                                                        @endif</td>
                            </tr>   <tr>
                                <td><b>Including Hours</b></td>
                                <td><i class="fa fa-inr"></i>@if($package->local_package == '4Hr/40KMs' )
                                                            4 Hours
                                                            @elseif($package->local_package == '6Hr/60KMs')
                                                            6 Hours
                                                            @elseif($package->local_package == '8Hr/80KMs')
                                                            8 Hours
                                                            @elseif($package->local_package == '10Hr/100KMs')
                                                            10 Hours
                                                            @else
                                                            12 Hours
                                                            @endif</td>
                            </tr>   <tr>
                                <td><b>Extra Hour Rate</b></td>
                                <td><i class="fa fa-inr"></i>{{$local_pick_city->ehr}}/-</td>
                            </tr>   <tr>
                                <td><b>Extra Km Rate</b></td>
                                <td><i class="fa fa-inr"></i>{{$local_pick_city->ekr}}/-</td>
                            </tr>    <tr>
                                <td><b>Gross Total</b></td>
                                <td><i class="fa fa-inr"></i>{{$local_pick_city->total_amount}}/-</td>
                            </tr>   <tr>
                                <td><b>Discount</b></td>
                                <td id="leftdiscount"><i class="fa fa-inr"></i>0/-</td>
                           
                     
                        </tbody>
                    </table>
                    <form class="coupon-form d-flex align-items-center my-2">
                    {!! Form::text('promo_code', null, array('placeholder' => 'Enter A Promo Code','id'=>'promo_code','name'=>'promo_code','class'=>'form-control')) !!}
                        
                        <button  type="submit"  id="apply_promo"class="btn btn-secondary ms-3">Apply</button>
                        
                    </form>
                    <b><span class="CoupenValid"></span></b>
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <th>Total:</th>
                                <th  id="leftamount"><i class="fa fa-inr"></i>{{$local_pick_city->total_amount}}/-</th>
                            </tr>
                        </tbody>
                    </table>
                  
                </div>
            </div>
            <div class="col-xl-8">
                <div class="checkout-box bg-white rounded mt-30">
                    <h4 class="mb-3">Billing Details</h4>
                    <span class="spacer"></span>
                    {!! Form::open(array('route' => 'localbookcab.store','class'=>'checkout-form mt-30','method'=>'POST','id'=>'local_booking','files' => 'true','enctype'=>'multipart/form-data')) !!}
                    <input id="pickupcity_id" name="pickupcity_id" type="hidden" value="{{$local_pickcity->id}}">
                                    {{-- <input id="dropcity_id" name="dropcity_id" type="text" value="{{$local_pick_city->dropcity}}"> --}}
                                    <input id="user_id" name="user_id" type="hidden" value="{{$user_id->id}}">
                                    <input id="cab_type" name="cab_type" type="hidden" value="{{$local_pick_city->cab_type}}">
                                    <!-- <input id="userid" name="userid" type="hidden" value="{{$userid}}"> -->
                                    <input type="hidden" name="dropcity" id="dropcity" value="{{$package->local_package}}">
                                    <input type="hidden" name="total_amount" id="leftamount" value="{{$local_pick_city->total_amount}}">
                                    <input id="localdetail_id" name="localdetail_id" type="hidden">
                                    <input id="gross_amount" name="gross_amount" type="hidden"value="{{$local_pick_city->total_amount}}">
                                     <input type="hidden" id="gross_total" name="gross_total" value="{{$local_pick_city->total_amount}}">
                                    <input type="hidden" name="discount" id="discount" value="">
                                    <input type="hidden" name="total_input" id="total_input" value="">
                                    <input type="hidden" name="amountDiscount" id="amountDiscount" value="{{$local_pick_city->total_amount}}">  
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Cutomer Name</label>
                                    <input type="text" id="local_customer_name" placeholder="Enter Your Name" class="w-100 border rounded" required name="customer_name"  value="{{$user_id->name}}">
                                    <span id="local_name_error"></span>
                                    
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Email Address*</label>
                                    <input id="local_email"  class="w-100 border rounded"  placeholder="Enter Email Address" required name="email" type="email" value="{{$user_id->email}}">
                                    <span id="local_email_result"></span>
                                     <span id="local_email_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Mobile Number*</label>
                                    <input id="local_customer_mobile" class="w-100 border rounded" pattern="/^-?\d+\.?\d*$/" onkeypress="if(this.value.length==10) return false;" name="customer_mobile" type="text" value="{{$user_id->user_mobile}}" readonly="true">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Special Request*</label>
                                    <input id="s_request" placeholder="Enter Special Request"   class="w-100 border rounded" name="s_request" type="text">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Pickup Date*</label>
                                    <input type="date" id="local_pickup_date" placeholder="Enter Pickup Date" name="pickup_date" class="w-100 border rounded" required />
                                             <span id="local_date_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Pickup Time*</label>
                                    <select id="local_pickup_time" name="pickup_time" class="form-select" placeholder="Enter Pickup Time"aria-label="Default select example" required>
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
                                             <span id="local_time_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-field">
                                    <label>Pickup Location*</label>
                                    <textarea style="width:100%" rows="3"  class="w-100 border rounded" id="local_pickup_location" name="pickup_location" required></textarea>
                                                <span id="local_pickup_error"></span>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-field">
                                    <label>Drop Location*</label>
                                    <textarea style="width:100%" rows="3"   class="w-100 border rounded" id="local_drop_location" name="drop_location" required></textarea>
                                                <span id="local_drop_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-field">
                                <label class="form-label">
                                <input type="checkbox" id="demo-form-checkbox-1">
                                    <b> Alternative Number </b>
                                </label>
                                {!! Form::number('alternet_mobile', null, array('id'=>'alternet_mobile','class'=>'w-100 border roundedform-control','pattern'=>'"/^-?\d+\.?\d*$/"' ,'onKeyPress'=>'if(this.value.length==10) return false','placeholder'=>'Enter Alternet Mobile')) !!}
                                
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-field">
                                <label class="form-label">
                                <input type="checkbox" id="demo-form-checkbox-2">
                                    <b>Flight Number </b>
                                </label>
                                {!! Form::text('flight_number', null, array('id'=>'flight_number','class'=>'w-100 border rounded','placeholder'=>'Enter Flight Number')) !!}
                                
                                </div>
                             
                            </div>
                            <h4>INR : {{$local_pick_city->total_amount}}/-</h4><br>
                            <br>
                            <h4>Note : </h4>
                            <div class="col-lg-12 mt_20">
                                <div class="alternate-shipping">
                                <ul>
                                    <li><span class="me-3 text-success"><i class="fa-solid fa-circle-check term_color"></i></span> Bookings are accepted minimum 4 hours before departure.</li>
                                    <li><span class="me-3 text-success"><i class="fa-solid fa-circle-check term_color"></i></span>If Booking is within next 24 hours Please Contact us.</li>
                                    <li><span class="me-3 text-success"><i class="fa-solid fa-circle-check term_color"></i></span> We are accepting payment via PAYTM, Google Pay, Bank transfer.</li><br>
                                  
                                </ul>
                                </diV>
                            </div>
                            <div class="col-lg-12">
                                <div class="alternate-shipping text_center">
                                    <label><input type="checkbox" class="me-2" id="term" /><b>I have Read and Accept Terms &amp; Conditions *</b></label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="alternate-shipping text_center">
                                <button class="btn btn-primary btn-md mt-4"  type="button" id="local_btn">Book Now</button></a>
                                </div>
                            </div>
                        </div>
                     
                    {!!Form::close()!!}
                </div>
            </div>
          
        </div>
    </div>
</section>


@else
<section class="breadcrumb-section position-relative z-2 overflow-hidden mt--75" data-background="{{asset('front-assets/assets/img/shapes/texture-bg.png')}}" style="background-image: url(&quot;assets/img/shapes/texture-bg.png&quot;);">
            <img src="{{asset('front-assets/assets/img/shapes/tire-print-left.png')}}" alt="tire print" class="position-absolute start-0 z-1 tire-print">
            <img src="{{asset('front-assets/assets/img/shapes/tire-print-right.png')}}" alt="tire print" class="position-absolute end-0 z-1 tire-print">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                            <h1 class="text-white">Book Cab</h1>
                           
                        </div>
                    </div>
                </div>
            </div>
</section>
<section class="checkout-section ptb-50">
    <div class="container">
      
        <div class="row">
        <div class="col-xl-4">
                <div class="order-sidebar bg-white rounded mt-30">
                    <h4 class="mb-3">Booking Details</h4>
                    <span class="spacer"></span>
                    <a href="#" class="d-block mb-3">
                                    <img class="img-fluid rounded-xs" src="{{asset('public/profile/'.$cab->image)}}" alt="Image-Description">
                    </a>
                    <div class="col-md-12">
                    <h5 class="text_center">{{$cab->cab}}</h5>
                    </div>
                    <table class="w-100"> 
                        <tbody>
                            <tr>
                                <td><b>Pickup City</b></td>
                                <td>{{$pickcity->pick_city}}</td>
                            </tr>
                            <tr>
                                <td><b>Drop City</b></td>
                                <td>{{$dropcity->drop_city}}</td>
                            </tr>
                            <tr>
                                <td><b>Estimate Km</b></td>
                                <td>{{$pick_city_id->km}} Km</td>
                            </tr>   <tr>
                                <td><b>Base Fare</b></td>
                                <td><i class="fa fa-inr"></i>{{$pick_city_id->amount}}/-</td>
                            </tr>   <tr>
                                <td><b>Toll Tax</b></td>
                                <td><i class="fa fa-inr"></i>@if($pick_city_id->tax=='') Include @else {{$pick_city_id->tax}}/- @endif</td>
                            </tr>   <tr>
                                <td><b>State Tax</b></td>
                                <td><i class="fa fa-inr"></i>@if($pick_city_id->state_tax=='')Include @else {{$pick_city_id->state_tax}}/-@endif</td>
                            </tr>   <tr>
                                <td><b>Driver allowance</b></td>
                                <td><i class="fa fa-inr"></i>@if($pick_city_id->driver_allowance=='')Include @elseif($pick_city_id->driver_allowance==0)Include @else {{$pick_city_id->driver_allowance}}/- @endif</td>
                            </tr>   <tr>
                                <td><b>Gross Total</b></td>
                                <td><i class="fa fa-inr"></i>{{$pick_city_id->total_amount}}/-</td>
                            </tr>   <tr>
                                <td><b>Discount</b></td>
                                <td id="leftdiscount"><i class="fa fa-inr"></i>0/-</td>
                           
                     
                        </tbody>
                    </table>
                    <form class="coupon-form d-flex align-items-center my-2">
                    {!! Form::text('promo_code', null, array('placeholder' => 'Enter A Promo Code','id'=>'promo_code','name'=>'promo_code','class'=>'form-control')) !!}
                        
                        <button  type="submit"  id="apply_promo"class="btn btn-secondary ms-3">Apply</button>
                        
                    </form>
                    <b><span class="CoupenValid"></span></b>
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <th>Total:</th>
                                <th  id="leftamount"><i class="fa fa-inr"></i>{{$pick_city_id->total_amount}}/-</th>
                            </tr>
                        </tbody>
                    </table>
                  
                </div>
            </div>
            <div class="col-xl-8">
                <div class="checkout-box bg-white rounded mt-30">
                    <h4 class="mb-3">Billing Details</h4>
                    <span class="spacer"></span>
                    {!! Form::open(array('route' => 'onewaybookcab.store','class'=>'checkout-form mt-30','method'=>'POST','id'=>'oneway_booking','files' => 'true','enctype'=>'multipart/form-data')) !!}
                    <input id="pickupcity_id" name="pickupcity_id" type="hidden" value="{{$pickcity->id}}">
                                <input id="dropcity_id" name="dropcity_id" type="hidden" value="{{$dropcity->id}}">
                                <input id="user_id" name="user_id" type="hidden" value="{{$user_id->id}}">
                                <input id="cab_type" name="cab_type" type="hidden" value="{{$pick_city_id->cab_type}}">
                                <!-- <input id="userid" name="userid" type="hidden" value="{{$userid}}"> -->
                                <input type="hidden" name="total_amount" id="leftamount" value="{{$pick_city_id->total_amount}}">
                                <input id="onewaydetail_id" name="onewaydetail_id" type="hidden">
                                <input id="gross_amount" name="gross_amount" type="hidden"value="{{$pick_city_id->total_amount}}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Cutomer Name</label>
                                    <input type="text" id="customer_name" placeholder="Enter Your Name" class="w-100 border rounded" required name="customer_name"  value="{{$user_id->name}}">
                                       <span id="name_error"></span>
                                    
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Email Address*</label>
                                    <input id="email"  class="w-100 border rounded"  placeholder="Enter Email Address" required name="email" type="email" value="{{$user_id->email}}">
                                    <span id="email_result"></span>
                                            <span id="email_error"></span>
                                            
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Mobile Number*</label>
                                    <input id="customer_mobile" class="w-100 border rounded" pattern="/^-?\d+\.?\d*$/" onkeypress="if(this.value.length==10) return false;" name="customer_mobile" type="text" value="{{$user_id->user_mobile}}" readonly="true">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Special Request*</label>
                                    <input id="s_request" placeholder="Enter Special Request"   class="w-100 border rounded" name="s_request" type="text">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Pickup Date*</label>
                                    <input type="date" id="pickup_date" placeholder="Enter Pickup Date" name="pickup_date" class="w-100 border rounded" required />
                                             <span id="date_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Pickup Time*</label>
                                    <select id="pickup_time" name="pickup_time" class="form-select" placeholder="Enter Pickup Time"aria-label="Default select example" required>
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
                                             <span id="time_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-field">
                                    <label>Pickup Location*</label>
                                    <textarea style="width:100%" rows="3"  class="w-100 border rounded" id="pickup_location" name="pickup_location" required></textarea>
                                                <span id="pickup_error"></span>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-field">
                                    <label>Drop Location*</label>
                                    <textarea style="width:100%" rows="3"   class="w-100 border rounded" id="drop_location" name="drop_location" required></textarea>
                                                <span id="drop_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-field">
                                <label class="form-label">
                                <input type="checkbox" id="demo-form-checkbox-1">
                                    <b> Alternative Number </b>
                                </label>
                                {!! Form::number('alternet_mobile', null, array('id'=>'alternet_mobile','class'=>'w-100 border roundedform-control','pattern'=>'"/^-?\d+\.?\d*$/"' ,'onKeyPress'=>'if(this.value.length==10) return false','placeholder'=>'Enter Alternet Mobile')) !!}
                                
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-field">
                                <label class="form-label">
                                <input type="checkbox" id="demo-form-checkbox-2">
                                    <b>Flight Number </b>
                                </label>
                                {!! Form::text('flight_number', null, array('id'=>'flight_number','class'=>'w-100 border rounded','placeholder'=>'Enter Flight Number')) !!}
                                
                                </div>
                                <input type="hidden" id="gross_total" name="gross_total" value="{{$pick_city_id->total_amount}}">
                                            <input type="hidden" name="discount" id="discount" value="">
                                            <input type="hidden" name="total_input" id="total_input" value="">
                                            <input type="hidden" name="amountDiscount" id="amountDiscount" value="{{$pick_city_id->total_amount}}">
                            </div>
                            <h4>INR : {{$pick_city_id->total_amount}}/-</h4><br>
                            <br>
                            <h4>Note : </h4>
                            <div class="col-lg-12 mt_20">
                                <div class="alternate-shipping">
                                <ul>
                                    <li><span class="me-3 text-success"><i class="fa-solid fa-circle-check term_color"></i></span> Bookings are accepted minimum 4 hours before departure.</li>
                                    <li><span class="me-3 text-success"><i class="fa-solid fa-circle-check term_color"></i></span>If Booking is within next 24 hours Please Contact us.</li>
                                    <li><span class="me-3 text-success"><i class="fa-solid fa-circle-check term_color"></i></span> We are accepting payment via PAYTM, Google Pay, Bank transfer.</li><br>
                                  
                                </ul>
                                </diV>
                            </div>
                            <div class="col-lg-12">
                                <div class="alternate-shipping text_center">
                                    <label><input type="checkbox" class="me-2" id="term" /><b>I have Read and Accept Terms &amp; Conditions *</b></label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="alternate-shipping text_center">
                                <button class="btn btn-primary btn-md mt-4"  type="button" id="btn">Book Now</button></a>
                                </div>
                            </div>
                        </div>
                     
                    {!!Form::close()!!}
                </div>
            </div>
          
        </div>
    </div>
</section>
@endif


        @include('frontend.layout._footer')
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        <script>
    const validateEmail = (email) => {
  return email.match(
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
  );
};
const validate = () => {
  const $result = $('#email_result');
  const email = $('#email').val();
  $result.text('');

  if (validateEmail(email)) {
    $result.text(email + ' is valid :)'); 
    $result.css('color', 'green');

  } else {
    $result.text(email + ' is not valid :(');
    $result.css('color', 'red');

  }
  return false;
}
$('#email').on('input', validate);
</script>
        
<script>
    const local_validateEmail = (local_email) => {
  return local_email.match(
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
  );
};
const local_validate = () => {
  const $local_result = $('#local_email_result');
  

  const local_email = $('#local_email').val();
  
  $local_result.text('');

  if (local_validateEmail(local_email)) {
    $local_result.text(local_email + ' is valid :)');
    $local_result.css('color', 'green');

  } else {
    $local_result.text(local_email + ' is not valid :(');
    $local_result.css('color', 'red');

  }
  return false;
}
$('#local_email').on('input', local_validate);
</script>
         <script>
                $(function () {
                    var dtToday = new Date();

                    var month = dtToday.getMonth() + 1;
                    var day = dtToday.getDate();
                    var year = dtToday.getFullYear();
                    if (month < 10) month = "0" + month.toString();
                    if (day < 10) day = "0" + day.toString();

                    var minDate = year + "-" + month + "-" + day;

                    $("#pickup_date").attr("min", minDate);
                });
            </script>
                 <script>
                $(function () {
                    var dtToday = new Date();

                    var month = dtToday.getMonth() + 1;
                    var day = dtToday.getDate();
                    var year = dtToday.getFullYear();
                    if (month < 10) month = "0" + month.toString();
                    if (day < 10) day = "0" + day.toString();

                    var minDate = year + "-" + month + "-" + day;

                    $("#local_pickup_date").attr("min", minDate);
                });
            </script>
<script>
  document.getElementById("btn").disabled = true
      jQuery('#term').click(function()
            {
                checkBox = document.getElementById('term');
                if(checkBox.checked) {
                document.getElementById("btn").disabled = false
                    } 
                    else{
                    document.getElementById("btn").disabled = true
                    }
                    
                    

            });
</script>
<script>
  document.getElementById("local_btn").disabled = true
      jQuery('#term').click(function()
            {
                checkBox = document.getElementById('term');
                if(checkBox.checked) {
                document.getElementById("local_btn").disabled = false
                    } 
                    else{
                    document.getElementById("local_btn").disabled = true
                    }
                    
                    

            });
</script>
 <script>
    jQuery(document).ready(function()
    {
          jQuery('#btn').click(function()
            {
                var customer_name = $('#customer_name').val();
                
                var email = $('#email').val();
                var customer_mobile = $('#customer_mobile').val();
                var pickup_date = $('#pickup_date').val();
                var pickup_time = $('#pickup_time').val();
                var pickup_location = $('#pickup_location').val();
                var drop_location = $('#drop_location').val();
             if(customer_name ==''){
                      $("#name_error").css({"color":"#ff0000"});
                $("#name_error").css({"font-weight":"700"});
                $("#name_error").css({"font-size":"12px"});
                $("#name_error").html("Name is required *");
                }
                else if(email ==''){
                      $("#email_error").css({"color":"#ff0000"});
                $("#email_error").css({"font-weight":"700"});
                $("#email_error").css({"font-size":"12px"});
                $("#email_error").html("Email Address is required *");
                }
                else if(customer_mobile ==''){
                      $("#date_error").css({"color":"#ff0000"});
                $("#date_error").css({"font-weight":"700"});
                $("#date_error").css({"font-size":"12px"});
                $("#date_error").html("Mobile Number is required *");
                }
                 else if(pickup_time ==''){
                      $("#time_error").css({"color":"#ff0000"});
                $("#time_error").css({"font-weight":"700"});
                $("#time_error").css({"font-size":"12px"});
                $("#time_error").html("Pickup Time is required *");
                } 
                else if(pickup_date ==''){
                      $("#date_error").css({"color":"#ff0000"});
                $("#date_error").css({"font-weight":"700"});
                $("#date_error").css({"font-size":"12px"});
                $("#date_error").html("Pickup Date is required *");
                } else if(pickup_location ==''){
                      $("#pickup_error").css({"color":"#ff0000"});
                $("#pickup_error").css({"font-weight":"700"});
                $("#pickup_error").css({"font-size":"12px"});
                $("#pickup_error").html("Pickup Location is required *");
                }
                else if(drop_location ==''){
                      $("#drop_error").css({"color":"#ff0000"});
                $("#drop_error").css({"font-weight":"700"});
                $("#drop_error").css({"font-size":"12px"});
                $("#drop_error").html("Drop Location  is required *");
                }else{
               $("#oneway_booking").submit();
               
               
               document.getElementById('btn').disabled = true;
            }
         
            });
                
                
          
        });
</script>

 <script>
    jQuery(document).ready(function()
    {
          jQuery('#local_btn').click(function()
            {
                var local_customer_name = $('#local_customer_name').val();
                
                var local_email = $('#local_email').val();
                var local_customer_mobile = $('#local_customer_mobile').val();
                var local_pickup_date = $('#local_pickup_date').val();
                var local_pickup_time = $('#local_pickup_time').val();
                var local_pickup_location = $('#local_pickup_location').val();
                var local_drop_location = $('#local_drop_location').val();
             if(local_customer_name ==''){
                $("#local_name_error").css({"color":"#ff0000"});
                $("#local_name_error").css({"font-weight":"700"});
                $("#local_name_error").css({"font-size":"12px"});
                $("#local_name_error").html("Name is required *");
                }
                else if(local_email ==''){
                $("#local_email_error").css({"color":"#ff0000"});
                $("#local_email_error").css({"font-weight":"700"});
                $("#local_email_error").css({"font-size":"12px"});
                $("#local_email_error").html("Email Address is required *");
                }
                else if(local_customer_mobile ==''){
                      $("#local_date_error").css({"color":"#ff0000"});
                $("#local_date_error").css({"font-weight":"700"});
                $("#local_date_error").css({"font-size":"12px"});
                $("#local_date_error").html("Mobile Number is required *");
                }
                 else if(local_pickup_time ==''){
                      $("#local_time_error").css({"color":"#ff0000"});
                $("#local_time_error").css({"font-weight":"700"});
                $("#local_time_error").css({"font-size":"12px"});
                $("#local_time_error").html("Pickup Time is required *");
                } 
                else if(local_pickup_date ==''){
                      $("#local_date_error").css({"color":"#ff0000"});
                $("#local_date_error").css({"font-weight":"700"});
                $("#local_date_error").css({"font-size":"12px"});
                $("#local_date_error").html("Pickup Date is required *");
                } else if(local_pickup_location ==''){
                      $("#local_pickup_error").css({"color":"#ff0000"});
                $("#local_pickup_error").css({"font-weight":"700"});
                $("#local_pickup_error").css({"font-size":"12px"});
                $("#local_pickup_error").html("Pickup Location is required *");
                }
                else if(local_drop_location ==''){
                      $("#local_drop_error").css({"color":"#ff0000"});
                $("#local_drop_error").css({"font-weight":"700"});
                $("#local_drop_error").css({"font-size":"12px"});
                $("#local_drop_error").html("Drop Location  is required *");
                }else{
               $("#local_booking").submit();
            }
         
            });
                
                
          
        });
</script>

<script>
   jQuery(document).ready(function(){
        jQuery('#customer_name').change(function()

        {
            $("#name_error").hide();
        });
    });
    jQuery(document).ready(function(){
        jQuery('#email').change(function()

        {
            $("#email_error").hide();
        });
    });
     jQuery(document).ready(function(){
        jQuery('#email').change(function()

        {
            $("#email_error").hide();
        });
    });
     jQuery(document).ready(function(){
        jQuery('#pickup_date').change(function()

        {
            $("#date_error").hide();
        });
    });
     jQuery(document).ready(function(){
        jQuery('#pickup_time').change(function()

        {
            $("#time_error").hide();
        });
    });
     jQuery(document).ready(function(){
        jQuery('#pickup_location').change(function()

        {
            $("#pickup_error").hide();
        });
    });
     jQuery(document).ready(function(){
        jQuery('#drop_location').change(function()

        {
            $("#drop_error").hide();
        });
    });
</script>


 <script>
                $(document).ready(function () {
                    $("#alternet_mobile").hide();
                    $("#icon_1").hide();
                    $("#icon_2").hide();

                    $("#demo-form-checkbox-1").click(function () {
                        $("#alternet_mobile").toggle();
                        $("#icon_1").toggle();
                    });
                });
            </script>
            <script>
                $(document).ready(function () {
                    $("#flight_number").hide();

                    $("#demo-form-checkbox-2").click(function () {
                        $("#flight_number").toggle();
                        $("#icon_2").toggle();
                    });
                });
            </script>
            <!-- <script>
                $(document).ready(function () {
                    $("#promo_code").hide();
                    $("#apply_promo").hide();
                    $("#demo-form-checkbox-3").click(function () {
                        $("#promo_code").toggle();
                        $("#apply_promo").toggle();
                    });
                });
            </script> -->

        </script>


           
            {{-- --------- Apply Promo --------------- --}}
             <script>
                jQuery(document).ready(function()
                {
                        jQuery('#apply_promo').click(function()
                        {

                            var coupon_id = jQuery("#coupon_id").val();
                            var promo_code = jQuery("#promo_code").val();
                            var gross_total = jQuery("#gross_total").val();
                            var discount = jQuery("#discount").val();
                            var total_input = jQuery("#total_input").val();
                            var amount = jQuery("#gross_amount").val();
                            var errMsg = "Opps ! Coupon Code Not Valid";
                            var sMsg = "Coupon Code Valid";
                            jQuery.ajax({
                                headers: {
                                            'X-CSRF-Token': $('input[name="_token"]').val()
                                        },
                            type:'post',
                            url:"{{route('coupon_check')}}",
                            data:{promo_code:promo_code,amount: amount},
                            success:function(result){

                            if(result==0)
                            {


                                $(".CoupenValid").css({"color":"#ff6700"});
                                $(".CoupenValid").css({"font-weight":"700"});
                                $(".CoupenValid").css({"font-size":"12px"});
                                $(".CoupenValid").html(errMsg);
                                $("#promo_code").val('');

                            }
                            else
                            {
                                $(".CoupenValid").css({"color":"#39a856"});
                                $(".CoupenValid").css({"font-weight":"700"});
                                $(".CoupenValid").css({"font-size":"22px;"});
                                $(".CoupenValid").html(sMsg);
                                $("#promo_code").attr('readonly','true');
                                $(".hidediscound").show();
                                $(".hidetotal").show();
                                coupon_ids = result['coupon_id']
                                $("#coupon_id").val(coupon_ids);
                                dis = result['coupon_rate'];
                                
                                total_amount = gross_total - dis;
                                $("#discount").val(dis);
                                $("#leftdiscount").html("<i class='fa fa-inr'></i> "+dis+"/-");

                                $("#leftamount").html("<i class='fa fa-inr'></i> "+total_amount+"/-");
                                $("#total_input").val(total_amount);
                                $("#total_label").html(+total_amount+"/-");
                                $("#total_label").css({"color":"#eaa430"});




                            }

                        }
                    });
                    return false;
                });
                });
            </script>
          
<style>
    @keyframes rotation {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(359deg);
  }
}
.rotate {
  animation: rotation 2s;
}

.linear {
  animation-timing-function: linear;
}

.infinite {
  animation-iteration-count: infinite;
}
</style>
            <!-- Js Files End -->
        </body>


    </body>


</html>
