
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
                    <table class="w-100"> 
                        <tbody>
                            <tr>
                                <td><b>Pickup City</b></td>
                                <td>Surat</td>
                            </tr>
                            <tr>
                                <td><b>Drop City</b></td>
                                <td>Valsad</td>
                            </tr>
                            <tr>
                                <td><b>Estimate Km</b></td>
                                <td>Valsad</td>
                            </tr>   <tr>
                                <td><b>Base Fare</b></td>
                                <td>Valsad</td>
                            </tr>   <tr>
                                <td><b>Toll Tax</b></td>
                                <td>Valsad</td>
                            </tr>   <tr>
                                <td><b>State Tax</b></td>
                                <td>Valsad</td>
                            </tr>   <tr>
                                <td><b>Driver allowance</b></td>
                                <td>Valsad</td>
                            </tr>   <tr>
                                <td><b>Gross Total</b></td>
                                <td>Valsad</td>
                            </tr>   <tr>
                                <td><b>Discount</b></td>
                                <td>Valsad</td>
                           
                     
                        </tbody>
                    </table>
                    <form class="coupon-form d-flex align-items-center my-2">
                        <input type="text" placeholder="coupon" class="border w-100 rounded" />
                        <button type="submit" class="btn btn-secondary ms-3">Apply</button>
                    </form>
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <th>Total:</th>
                                <th>$1256.00</th>
                            </tr>
                        </tbody>
                    </table>
                  
                </div>
            </div>
            <div class="col-xl-8">
                <div class="checkout-box bg-white rounded mt-30">
                    <h4 class="mb-3">Billing Details</h4>
                    <span class="spacer"></span>
                    <form class="checkout-form mt-30">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Cutomer Name</label>
                                    <input type="text" placeholder="First name" class="w-100 border rounded" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Last name*</label>
                                    <input type="text" placeholder="Last name" class="w-100 border rounded" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Mobile Number*</label>
                                    <input type="text" placeholder="Mobile Number" class="w-100 border rounded" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Special Request*</label>
                                    <input type="text" placeholder="Special request" class="w-100 border rounded" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Pickup Date*</label>
                                    <input type="text" placeholder="Special request" class="w-100 border rounded" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-field">
                                    <label>Pickup Time*</label>
                                    <input type="text" placeholder="Special request" class="w-100 border rounded" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-field">
                                    <label>Pickup Location*</label>
                                    <textarea class="w-100 border rounded" cols="5" rows="5"></textarea>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-field">
                                    <label>Drop Location*</label>
                                    <textarea class="w-100 border rounded" cols="5" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-field">
                                <label class="form-label">
                                <input type="checkbox" id="demo-form-checkbox-1">
                                    <b> Alternative Number </b>
                                </label>
                                <input id="alternet_mobile" class="form-control" pattern="&quot;/^-?\d+\.?\d*$/&quot;" onkeypress="if(this.value.length==10) return false" placeholder="Enter Alternet Mobile" name="alternet_mobile" type="number" style="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-field">
                                <label class="form-label">
                                <input type="checkbox" id="demo-form-checkbox-1">
                                    <b>Flight Number </b>
                                </label>
                                <input id="alternet_mobile" class="form-control" pattern="&quot;/^-?\d+\.?\d*$/&quot;" onkeypress="if(this.value.length==10) return false" placeholder="Enter Alternet Mobile" name="alternet_mobile" type="number" style="">
                                </div>
                            </div>
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
                                    <label><input type="checkbox" class="me-2" /><b>I have Read and Accept Terms &amp; Conditions *</b></label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="alternate-shipping text_center">
                                <a href="{{route('booking_confirm')}}"><button class="btn btn-primary btn-md mt-4" type="button">Book Now</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="alternate-shipping-form mt-30">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-field">
                                        <label>First Name</label>
                                        <input type="text" placeholder="First Name" class="w-100 border rounded" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-field">
                                        <label>Last Name</label>
                                        <input type="text" placeholder="First Name" class="w-100 border rounded" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-field">
                                        <label>Country / Region*</label>
                                        <input type="text" placeholder="Country / Region" class="w-100 border rounded" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-field">
                                        <label>Street address</label>
                                        <input type="text" placeholder="House number and street name" class="w-100 border rounded" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-field">
                                        <input type="text" placeholder="Apartment, suite, unit, etc(optional)" class="w-100 border rounded" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-field">
                                        <label>State/Country*</label>
                                        <input type="text" placeholder="Town/City" class="w-100 border rounded" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-field">
                                        <label>Postcode / ZIP*</label>
                                        <input type="text" placeholder="Post code" class="w-100 border rounded" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-field mb-0">
                                        <label>Phone*</label>
                                        <input type="tel" placeholder="Phone" class="w-100 border rounded" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          
        </div>
    </div>
</section>

@include('frontend.layout._footer')    