<title>{{helpers::name()}} | Order Details</title>
@include('layouts._top_bar')



<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="" style="margin-top: 100px;">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-body">
                <!-- Basic Horizontal form layout section start -->
                <section id="basic-horizontal-layouts">
                    <div class="row">
                        <div class="col-md-12 col-12">


                                <body style="font-family: Fira Sans, sans-serif;">
                                    <section style="background-color: #7a878e00 !important; color: #000000;margin-bottom:-50px;">
                                          <div class="row">
                                            <section class="col-lg-12 connectedSortable">


                                                <div id="print" style="width: 700px;height: auto;border: 1px solid #c1c1c1;margin: 0 auto 100px;font-size: 15px;background-color: #f1f1f1;box-shadow: 0 0 20px #777777ad !important;">
                                                  <div style="border-bottom:1px solid #c1c1c1;height:auto;padding:15px;">
                                                      <div style="width: 55%;text-align: left;display:inline-block;">
                                                         <br> <b style="color: #6e6b7b">{{helpers::name()}}</b><br>
                                                         <b style="color: #6e6b7b">Address : </b>{{helpers::address()}}<br>
                                                          <b style="color: #6e6b7b">Contact:</b>&nbsp;+91 {{helpers::mobile()}}<br>
                                                          <b style="color: #6e6b7b">Email Us:</b><span style="color: #2e93e4;">&nbsp;{{helpers::email()}}</span></span>
                                                      </div>
                                                      <div style="width: 40%;display:inline-block;vertical-align: top;text-align: right;">
                                                        <?php $site_logo = helpers::logo();?>
                                                         <img style="margin-bottom: 4px;height: 70px;margin-top: 15px;" src="{{asset('logo/'.$site_logo)}}">
                                                      </div>
                                                  </div>

                                                  <div style="border-bottom:1px solid #c1c1c1;height:auto;">
                                                      <div style="padding:15px;">
                                                          <span style="color: #6e6b7b">Dear&nbsp;<b >{{$result->name}},</b></span><br>
                                                          <span style="color: #6e6b7b">Your car booking ID is<b >&nbsp;{{$result->orderno}}</b></span><br>
                                                      </div>
                                                  </div>
                                                  <div>
                                                      <div style="padding:15px;">
                                                        <span style="color: #2e93e4;"><b>Booking Details</b></span>
                                                      </div>
                                                  </div>

                                                  <div style="height:auto;padding:15;border-bottom: 1px solid #c1c1c1;">
                                                      <div style="width:100%;text-align: left;">
                                                         <table style="width: 100%;">
                                                          <tbody><tr>
                                                          <td ><span><b>Booking Id : </b> <span></td>
                                                          <td  ><span style="font-size: 14px;">{{$result->orderno}}<span></td>
                                                          <td ><span><b>Status : </b> <span></td>
                                                          <td  ><span style="font-size: 14px;">Paid<span></td>
                                                          </tr>
                                                          <tr>
                                                          <td ><span><b>Pickup Date Time : </b> <span></td>
                                                          <td  ><span style="font-size: 14px;">{{$result->pickup_date}}, {{$result->pickup_time}}<span></td>
                                                          <td ><span><b>Booked On : </b><span></td>
                                                          <td  ><span style="font-size: 14px;">{{$result->created_at}}<span></td>
                                                          </tr>
                                                          <tr>
                                                          <td ><span><b>Pickup City : </b><span></td>
                                                          <td  ><span style="font-size: 14px;">{{$result->pick_city}}<span></td>
                                                          <td ><span><b>Car Booked : </b> <span></td>
                                                          <td  ><span style="font-size: 14px;">{{$result->cab_type}}<span></td>
                                                          </tr>
                                                          <tr>
                                                          <td ><span><b>Rental Type  : </b><span></td>
                                                          <td  colspan="3"><span style="font-size: 14px;">Round-Trip ({{$result->pick_city}} - {{$result->drop_city}})</span></td>
                                                          </tr>
                                                         </tbody></table>

                                                      </div>
                                                  </div>
                                                  <div style="width:335px;display:inline-block;border-right: 1px solid #c1c1c1;padding: 15px;vertical-align: top;height: 360px;max-height: 370px;">
                                                    <table style="text-align:center;border-collapse:collapse;font-size: 13.5px;">
                                                        <tbody><tr>
                                                          <td colspan="2" style="text-align: left;"><span style="color: #2e93e4;"><b>Customer Details</b></span> </td>
                                                        </tr>
                                                         <tr style="line-height: 1.5;">
                                                          <td style="width: 125px;text-align: left;"><span><b>Name</b></span> </td>
                                                          <td style="text-align: left;"><span>{{$result->name}}</span> </td>
                                                        </tr>
                                                        <tr style="line-height: 1.5;">
                                                          <td style="text-align: left;"><span><b>Mobile No</b></span> </td>
                                                          <td style="text-align: left;"><span>{{$result->user_mobile}}</span> </td>
                                                        </tr>
                                                        <tr style="line-height: 1.5;">
                                                          <td style="text-align: left;"><span><b>Email-Id</b></span> </td>
                                                          <td style="text-align: left;"><span style="color: #2e93e4;">{{$result->email}}</span> </td>
                                                        </tr>
                                                        <tr style="line-height: 1.5;">
                                                          <td style="text-align: left;"><span><b>Pickup Location</b></span> </td>
                                                          <td style="text-align: left;"><span>{{$result->pick_city}}</span> </td>
                                                        </tr>
                                                        <tr style="line-height: 1.5;">
                                                          <td style="text-align: left;vertical-align: top;"><span><b>Pickup Address</b></span> </td>
                                                          <td style="text-align: left;"><span>{{$result->pickup_location}}</span> </td>
                                                        </tr>
                                                        <tr style="line-height: 1.5;">
                                                          <td style="text-align: left;"><span><b>Travel  City</b></span> </td>
                                                          <td style="text-align: left;"><span>{{$result->travel_city}}</span> </td>
                                                        </tr>

                                                        <tr style="line-height: 1.5;">
                                                            <td style="text-align: left;"><span><b>Driver Name</b></span> </td>
                                                            <td style="text-align: left;"><span>{{$driver}}</span> </td>
                                                          </tr>
                                                        <!-- <tr style="line-height: 1.5;">
                                                          <td style="text-align: left;vertical-align: top;"><span><b>Drop Address</b></span> </td>
                                                          <td style="text-align: left;"><span>76-77 royal bunglows,<br>opp akruti bunglows,<br>near ﬂorence hospital <br>vesu surat 395007</span> </td>
                                                        </tr> -->
                                                    </tbody></table>
                                                  </div>
                                                  <div style="width:335px;display:inline-block;padding: 15px;vertical-align: top;">
                                                    <table style="text-align:center;border-collapse:collapse;font-size: 13.5px;">
                                                      <tbody><tr>
                                                        <td colspan="2" style="text-align: left;"><span style="color: #2e93e4;"><b>Estimated Taxi Fare</b></span> </td>
                                                      </tr>
                                                      <tr style="line-height: 1.5;">
                                                        <td style="text-align: left;"><span><b>Total Km</b></span> </td>
                                                        <td style="text-align: right;"><span>@if($result->estimate_kms == '')Include @elseif($result->estimate_kms == 0) Include @else Rs. {{$result->estimate_kms}}/- @endif</span> </td>
                                                      </tr>
                                                      <tr style="line-height: 1.5;">
                                                        <td style="width: 195px;text-align: left;"><span><b>Base Fare</b></span> </td>
                                                        <td style="text-align: right;"><span>Rs {{$result->gross_total}}/-</span> </td>
                                                      </tr>


                                                      <tr style="line-height: 1.5;">
                                                        <td style="text-align: left;"><span><b>Trip Discount</b></span> </td>
                                                        <td style="text-align: right;"><span>@if($result->discount == '') Include @elseif($result->discount == 0) Inlcude @else Rs. {{$result->discount}}/-@endif</span> </td>

                                                      </tr>
                                                      <tr style="line-height: 1.5;">
                                                        <td style="text-align: left;"><span><b>Extra Charge</b></span> </td>
                                                        <td style="text-align: right;"><span>@if($result->extra_charge == '') Include @elseif($result->extra_charge == 0) Inlcude @else Rs. {{$result->extra_charge}}/-@endif</span> </td>

                                                      </tr>
                                                      <tr style="line-height: 1.5;">
                                                        <td style="text-align: left;"><span><b>Estimated Trip Fare</b></span> </td>
                                                        <td style="text-align: right;"><span>Rs. {{$result->total_amount}}/-</span> </td>
                                                      </tr>
                                                      <tr>
                                                        <td colspan="2" style="text-align: left;">
                                                        <span style="color: #2e93e4;"><b>Extra charges, if applicable</b></span><br>
                                                        <span style="font-size: 12px;">(to be paid to the driver after trip ends.)</span>
                                                        </td>
                                                      </tr>
                                                      <tr style="line-height: 1.5;">
                                                        <td style="text-align: left;vertical-align: top;"><span><b>Airport Parking</b></span> </td>
                                                        <td style="text-align: right;"><span>As Per Actual</span> </td>
                                                      </tr>
                                                                      </tbody></table>
                                                  </div>

                                                  <div style="border-top:1px solid #c1c1c1;margin-top: -4px;">

                                                      <div style="padding:15px;">
                                                        <span>Please Note-</span><br>
                                                        <ul style="border-bottom: 1px solid #c1c1c1">
                                                            <li>Please verify the opening & closing Time / KMS readings journey.</li>
                                                            <li>For any further clarications, write to us or call us +91 {{helpers::mobile()}}.</li>
                                                        </ul>



                                                      </div>
                                                  </div>
                                                  <div class="col-md-12" style="text-align: right">
                                                    <a href="{{route('multy_bookings.index')}}" class="btn btn-danger  waves-effect waves-float waves-light" style="margin-bottom: 15px;margin-right:15px;">Back</a>
                                                    </div>
                                                </div>

                                            </section>
                                          </div>
                                        </section>


                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @include('layouts._footer')
    <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('app-assets/js/core/app-menu.min.js')}}"></script>
    <script src="{{asset('app-assets/js/core/app.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/customizer.min.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('app-assets/js/scripts/forms/pickers/form-pickers.min.js')}}"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->
<script>
    $(window).on("load", function () {
        if (feather) {
            feather.replace({ width: 14, height: 14 });
        }
    });
</script>

