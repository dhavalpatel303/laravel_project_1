
    @include('frontend.layout._top_bar')

        @include('frontend.layout._header')     
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
                                <td><b>Travel City</b></td>
                                <td>{{$request->travel_city}}</td>
                            </tr>
                            <tr>
                                <td><b>Pickup Date</b></td>
                                <td>{{ date_format(date_create($request->pick_date),'d-m-y') }}</td>
                            </tr>
                            <tr>
                                <td><b>Pickup Time</b></td>
                                <td>{{$request->pick_time}}</td>
                            </tr>
                            <tr>
                                <td><b>Return Date</b></td>
                                <td>{{ date_format(date_create($request->return_date),'d-m-y') }}</td>
                            </tr>
                            <tr>
                                <td><b>Journy Days</b></td>
                                <td>{{$request->journy_days}} Days</td>
                            </tr>
                            <tr>
                                <td><b>Km Rate</b></td>
                                <td><i class="fa fa-inr"></i>{{$request->km_rate}}/-</td>
                            </tr>
                            <tr>
                           
                                <td><b>Total Journey KM </b></td>
                                <td> {{$request->estimate_kms}} Km</td>
                            </tr>  
                             <tr>
                                <td><b>Base Fare</b></td>
                                <td><i class="fa fa-inr"></i>{{$request->total_amount-$request->driver_allowance}}/-</td>
                            </tr>  
                            <tr>
                                <td><b>Gross Total</b></td>
                                <td><i class="fa fa-inr"></i>{{$request->total_amount}}/-</td>
                            </tr>   
                                 <tr>
                                <td><b>Discount</b></td>
                                <td id="leftdiscount"><i class="fa fa-inr"></i>0/-</td>
                            </tr>
                     
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
                                <th  id="leftamount"><i class="fa fa-inr"></i>{{$request->total_amount}}/-</th>
                            </tr>
                        </tbody>
                    </table>
                  
                </div>
            </div>
            <div class="col-xl-8">
                <div class="checkout-box bg-white rounded mt-30">
                    <h4 class="mb-3">Billing Details</h4>
                    <span class="spacer"></span>
                    {!! Form::open(array('route' => 'multybookcab.store','class'=>'checkout-form mt-30','method'=>'POST','id'=>'booking','files' => 'true','enctype'=>'multipart/form-data')) !!}
                    <input id="pickupcity_id" name="pickupcity_id" type="hidden" value="{{$pickcity->id}}">
                                <input id="drop_City" name="drop_City" type="hidden" value="{{$request->drop_city}}">
                                <input id="travel_city" name="travel_city" type="hidden" value="{{$request->travel_city}}">
                                <input id="user_id" name="user_id" type="hidden" value="{{$user_id->id}}">
                                <input id="cab_type" name="cab_type" type="hidden" value="{{$cab->id}}">
                                
                                <input id="pickup_time_hidden" name="pickup_time_hidden" type="hidden" value="{{$request->pick_time}}">
                                <input type="hidden" name="total_amount" id="leftamount" value="{{$request->total_amount}}">
                                <input type="hidden" name="return_date" id="return_date" value="{{$request->return_date}}">
                                <input type="hidden" name="journey" id="journey" value="{{$request->journy_days}}">
                                <input type="hidden" name="drop_city" id="drop_city" value="{{$request->drop_city}}">
                                <input type="hidden" name="driver_allownce" id="driver_allownce" value="{{$request->driver_allowance}}">
                                <input id="estimate_kms" name="estimate_kms" type="hidden" value="{{$request->estimate_kms}}">
                                <input id="travelkms" name="travelkms" type="hidden" value="{{$request->journy_minkm}}">
                                <input id="gross_amount" name="gross_amount" type="hidden"value="{{$request->total_amount}}">
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
                                    <input type="text" id="pickup_date" placeholder="Enter Pickup Date" name="pickup_date" class="w-100 border rounded" value="{{$request->pick_date}}" readonly/>
                                             
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Pickup Time*</label>
                                    <input type="text" id="pickup_time" placeholder="Enter Pickup Time" name="pickup_time" class="w-100 border rounded" value="{{$request->pick_time}}" readonly/>
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
                                <input type="hidden" id="gross_total" name="gross_total" value="{{$request->total_amount}}">
                                            <input type="hidden" name="discount" id="discount" value="">
                                            <input type="hidden" name="total_input" id="total_input" value="">
                                            <input type="hidden" name="amountDiscount" id="amountDiscount" value="{{$request->total_amount}}">
                            </div>
                            <h4>INR : {{$request->total_amount}}/-</h4><br>
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

        @include('frontend.layout._footer')
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
    jQuery(document).ready(function()
    {
          jQuery('#btn').click(function()
            {
                var customer_name = $('#customer_name').val();
                    // alert(customer_name);
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
               $("#booking").submit();
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
                                $("#leftdiscount").html("Rs. "+dis+"/-");

                                $("#leftamount").html("Rs. "+total_amount+"/-");
                                $("#total_input").val(total_amount);
                                $("#total_label").html(+total_amount+"/-");
                                $("#total_label").css({"font-weight":"900"});
                                $("#total_label").css({"color":"#a8cf45"});




                            }

                        }
                    });
                    return false;
                });
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

                    $("#pickup_date").attr("min", minDate);
                });
            </script>
        <!-- Js Files End -->
