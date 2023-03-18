@include('frontend.layout._top_bar') @include('frontend.layout._header')
<section
    class="breadcrumb-section position-relative z-2 overflow-hidden mt--75"
    data-background="{{asset('front-assets/assets/img/shapes/texture-bg.png')}}"
    style="background-image: url(&quot;{{asset('front-assets/assets/img/shapes/texture-bg.png')}}&quot;);"
>
    <img src="{{asset('front-assets/assets/img/shapes/tire-print-left.png')}}" alt="tire print" class="position-absolute start-0 z-1 tire-print" />
    <img src="{{asset('front-assets/assets/img/shapes/tire-print-right.png')}}" alt="tire print" class="position-absolute end-0 z-1 tire-print" />
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                    <h1 class="text-white">Booking Confirm</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section
    class="about-section pt-120 pb-120 bg-primary-light position-relative z-1 overflow-hidden"
    data-background="{{asset('front-assets/assets/img/shapes/about-bg.jpg')}}"
    style="background-image: url(&quot;{{asset('front-assets/assets/img/shapes/about-bg.jpg')}}&quot;);"
>
    <img src="{{asset('front-assets/assets/img/shapes/tire-primary-light.png')}}" alt="tire" class="tire-primary-light position-absolute end-0 top-0 z--1" />
    <span class="small-circle-shape position-absolute z--1"></span>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="about-right mt-5 mt-lg-0">
            

                    <div class="about-icon-box bg-white shadow rounded mt-20">
                        <div class="ab-icon-box-top d-flex align-items-center mb-3">
                            <span class="icon-wrapper d-flex align-items-center justify-content-center rounded"><i class="flaticon-price-tag"></i></span>
                            <h2 class="title">Thank You. Your Booking Order  {{$data->orderno}} Is Confirm Now</h2>
                        </div>
                        <p>A confirmation email has been sent to your provided email address.</p>
                        <div class="row">
                            <div class="col-lg-6 col-xl-6">
                                <div class="pt-4 pb-5 px-5 border-bottom">
                                    <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-2">
                                        User Information
                                    </h5>
                                    <!-- Fact List -->
                                    <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                    <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Booking Number</span>
                                            <span class="text-secondary text-right"> {{$data->orderno}}</span>
                                        </li>

                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Name</span>
                                            <span class="text-secondary text-right"> {{$user->name}}</span>
                                        </li>

                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Email Address</span>
                                            <span class="text-secondary text-right">{{$user->email}}</span>
                                        </li>


                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Mobile Number</span>
                                            <span class="text-secondary text-right">+91 {{$user->user_mobile}}</span>
                                        </li>
                                        
                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Amount</span>
                                            <span class="text-secondary text-right"><i class="fa fa-inr"></i>{{$data->total_amount}}/-</span>
                                        </li>
                                        
                                        
                                    </ul>
                                    <!-- End Fact List -->
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-6">
                                <div class="pt-4 pb-5 px-5 border-bottom">
                                    <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-2">
                                        Trip Information
                                    </h5>
                                    <!-- Fact List -->
                                    <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Pickup City</span>
                                            <span class="text-secondary text-right">{{$data->pick_city}}</span>
                                        </li>

                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Drop City</span>
                                            <span class="text-secondary text-right">{{$data->drop_city}}</span>
                                        </li>

                                     

                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Pickup Date</span>
                                            <span class="text-secondary text-right">{{ date_format(date_create($data->pickup_date),'d-m-y') }}</span>
                                        </li>
                                        
                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Pickup Time</span>
                                            <span class="text-secondary text-right">{{$data->pickup_time}}</span>
                                        </li>
                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Vehicle</span>
                                            <span class="text-secondary text-right">{{$data->cab}}</span>
                                        </li>
                                        
                                        <!-- <button id="hello" type="button" class="btn btn-primary btn-md mt-4">hello</button> -->

                                    </ul>
                                   
                                    <!-- End Fact List -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.layout._footer')
<!-- <script>
      $(document).ready(function(){
                     
                     $('#hello').click(function()
                     {
                        const date = new Date();
                        const time = date.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour10: true });
                        console.log(time);

                            
                       
                     });
            });
             
    
</script> -->
