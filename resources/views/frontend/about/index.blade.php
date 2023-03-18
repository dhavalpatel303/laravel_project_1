
    @include('frontend.layout._top_bar')

        @include('frontend.layout._header')   
        <section class="breadcrumb-section position-relative z-2 overflow-hidden mt--75" data-background="{{asset('front-assets/assets/img/shapes/texture-bg.png')}}" style="background-image: url(&quot;{{asset('front-assets/assets/img/shapes/texture-bg.png')}}&quot;);">
            <img src="{{asset('front-assets/assets/img/shapes/tire-print-left.png')}}" alt="tire print" class="position-absolute start-0 z-1 tire-print">
            <img src="{{asset('front-assets/assets/img/shapes/tire-print-right.png')}}" alt="tire print" class="position-absolute end-0 z-1 tire-print">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                            <h1 class="text-white">About us</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>  
        <section class="about-section pt-120 pb-50 bg-primary-light position-relative z-1 overflow-hidden" data-background="{{asset('front-assets/assets/img/shapes/about-bg.jpg')}}" style="background-image: url(&quot;{{asset('front-assets/assets/img/shapes/about-bg.jpg')}}&quot;);">
            <img src="{{asset('front-assets/assets/img/shapes/tire-primary-light.png')}}" alt="tire" class="tire-primary-light position-absolute end-0 top-0 z--1">
            <span class="small-circle-shape position-absolute z--1"></span>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="about-left position-relative z-1">
                            <span class="circle-large position-absolute z--1"></span>
                            <div class="at-section-title mb-20">
                                <span class="at-subtitle position-relative lead text-primary">Why Choose Us</span>
                                <h2 class="h1 mt-2 mb-4">Don't Waste Your <br> Valuable Time or Money</h2>
                                <p>Collaboratively leverage existing client-centric schemas integrated processes. Inter
                                    actively engineer global sources after team driven niche markets. Rapidiously
                                    processes with resource maximizing architectures.</p>
                            </div>
                            <img src="{{asset('front-assets/assets/img/home1/car-red.png')}}" alt="car" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="about-right mt-5 mt-lg-0">
                            <div class="about-icon-box bg-white shadow rounded">
                                <div class="ab-icon-box-top d-flex align-items-center mb-3">
                                    <span class="icon-wrapper d-flex align-items-center justify-content-center rounded"><i class="flaticon-shield"></i></span>
                                    <h5 class="mb-0 ms-3">Expert Certified Mechanics</h5>
                                </div>
                                <p class="mb-0">Credibly maximize resource maximizing channels after interoperable
                                    frictionless. Rather than synergistic models.</p>
                            </div>
                            <div class="about-icon-box bg-white shadow rounded mt-20 ms-md-5">
                                <div class="ab-icon-box-top d-flex align-items-center mb-3">
                                    <span class="icon-wrapper d-flex align-items-center justify-content-center rounded"><i class="flaticon-shield"></i></span>
                                    <h5 class="mb-0 ms-3">Genuine Spares Parts</h5>
                                </div>
                                <p class="mb-0">Credibly maximize resource maximizing channels after interoperable
                                    frictionless. Rather than synergistic models.</p>
                            </div>
                            <div class="about-icon-box bg-white shadow rounded mt-20">
                                <div class="ab-icon-box-top d-flex align-items-center mb-3">
                                    <span class="icon-wrapper d-flex align-items-center justify-content-center rounded"><i class="flaticon-price-tag"></i></span>
                                    <h5 class="mb-0 ms-3">Get Reasonable Price</h5>
                                </div>
                                <p class="mb-0">Credibly maximize resource maximizing channels after interoperable
                                    frictionless. Rather than synergistic models.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('frontend.layout._footer')

