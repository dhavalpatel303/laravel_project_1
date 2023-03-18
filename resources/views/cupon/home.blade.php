<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        <title> {{helpers::name()}} Dashboard</title>
    </head>
    <body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
        @include('layouts._top_bar')
        <!-- BEGIN: Content-->

        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row"></div>
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Welcome Admin</h2>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        <div class="alert-body">
                            {{ session()->get('success') }}
                        </div>
                    </div>
                    @endif
                    <section id="statistics-card">
                        <!-- Stats Horizontal Card -->
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card">
                                    <a href="{{route('users.index')}}">
                                        <div class="card-header ">
                                            <div>
                                                <h2 class="fw-bolder mb-0">{{$user}}</h2>
                                                <p class="card-text">Register User List</p>
                                            </div>
                                            <div class="avatar bg-light-primary p-50 m-0">
                                                <div class="avatar-content">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="14"
                                                        height="14"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-users font-medium-5"
                                                    >
                                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="9" cy="7" r="4"></circle>
                                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card">
                                    <a href="{{route('driver.index')}}">
                                        <div class="card-header">
                                            <div>
                                                <h2 class="fw-bolder mb-0">{{$driver}}</h2>
                                                <p class="card-text">Driver List</p>
                                            </div>
                                            <div class="avatar bg-light-success p-50 m-0">
                                                <div class="avatar-content">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="14"
                                                        height="14"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-credit-card font-medium-5"
                                                    >
                                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card">
                                    <a href="{{route('pickup.index')}}">
                                        <div class="card-header">
                                            <div>
                                                <h2 class="fw-bolder mb-0">{{$pick_city}}</h2>
                                                <p class="card-text">Pickup City</p>
                                            </div>
                                            <div class="avatar bg-light-danger p-50 m-0">
                                                <div class="avatar-content">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="14"
                                                        height="14"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-activity font-medium-5"
                                                    >
                                                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card">
                                    <a href="{{route('dropcity.index')}}">
                                        <div class="card-header">
                                            <div>
                                                <h2 class="fw-bolder mb-0">{{$drop_city}}</h2>
                                                <p class="card-text">Drop City</p>
                                            </div>
                                            <div class="avatar bg-light-warning p-50 m-0">
                                                <div class="avatar-content">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="14"
                                                        height="14"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-user-check font-medium-5"
                                                    >
                                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="8.5" cy="7" r="4"></circle>
                                                        <polyline points="17 11 19 13 23 9"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="{{route('onewaybookings.index')}}">
                                            <div>
                                                <h2 class="fw-bolder mb-0"></h2>
                                                <p class="card-text">One Way Booking Details</p>
                                            </div>
                                        </a>
                                        <div class="avatar bg-light-warning p-50 m-0">
                                            <div class="avatar-content">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="14"
                                                    height="14"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="feather feather-user-check font-medium-5"
                                                >
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="8.5" cy="7" r="4"></circle>
                                                    <polyline points="17 11 19 13 23 9"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="">
                                            <div>
                                                <h2 class="fw-bolder mb-0"></h2>
                                                <p class="card-text">Multicity Booking Details</p>
                                            </div>
                                        </a>
                                        <div class="avatar bg-light-warning p-50 m-0">
                                            <div class="avatar-content">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="14"
                                                    height="14"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="feather feather-user-check font-medium-5"
                                                >
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="8.5" cy="7" r="4"></circle>
                                                    <polyline points="17 11 19 13 23 9"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="{{route('localdetails.index')}}">
                                            <div>
                                                <h2 class="fw-bolder mb-0"></h2>
                                                <p class="card-text fw-bolder">Local Bokking Details</p>
                                            </div>
                                        </a>
                                        <div class="avatar bg-light-warning p-50 m-0">
                                            <div class="avatar-content">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="14"
                                                    height="14"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="feather feather-user-check font-medium-5"
                                                >
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="8.5" cy="7" r="4"></circle>
                                                    <polyline points="17 11 19 13 23 9"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="{{route('advertisements')}}">
                                            <div>
                                                <h2 class="fw-bolder mb-0"></h2>
                                                <p class="card-text fw-bolder">Advertisementes</p>
                                            </div>
                                        </a>
                                        <div class="avatar bg-light-warning p-50 m-0">
                                            <div class="avatar-content">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="14"
                                                    height="14"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="feather feather-user-check font-medium-5"
                                                >
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="8.5" cy="7" r="4"></circle>
                                                    <polyline points="17 11 19 13 23 9"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

 <!--- Quick Lines --->
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h4 class="content-header-title float-start mb-0">Welcome Admin</h4>
                            </div>
                        </div>
                    </div>

                        <section id="statistics-card">
                            <!-- Stats Horizontal Card -->
                            <div class="row">
                                {{-- <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="">
                                                <div>
                                                    <h2 class="fw-bolder mb-0"></h2>
                                                    <p class="card-text">SMS Panel</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{route("visitor.index")}}">
                                                <div>
                                                    <h2 class="fw-bolder mb-0"></h2>
                                                    <p class="card-text">Visitor Details</p>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{route("requestcall.index")}}">
                                                <div>
                                                    <h2 class="fw-bolder mb-0"></h2>
                                                    <p class="card-text">Request Callback List ({{$requestcalls}})</p>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{route('driver.index')}}">
                                                <div>
                                                    <h2 class="fw-bolder mb-0"></h2>
                                                    <p class="card-text">Driver List</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{route('multicitycabs.index')}}">
                                                <div>
                                                    <h2 class="fw-bolder mb-0"></h2>
                                                    <p class="card-text">Multi City Cabs</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{route('multicityprices.index')}}">
                                                <div>
                                                    <h2 class="fw-bolder mb-0"></h2>
                                                    <p class="card-text">Multicity Price List</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{route("inquries.index")}}">
                                                <div>
                                                    <h2 class="fw-bolder mb-0"></h2>
                                                    <p class="card-text">Contact Us</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{route('testimonial.index')}}">
                                                <div>
                                                    <h2 class="fw-bolder mb-0"></h2>
                                                    <p class="card-text">TestiMonial</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{route('cupon.index')}}">
                                                <div>
                                                    <h2 class="fw-bolder mb-0"></h2>
                                                    <p class="card-text">Coupon code</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                </div>
            </div>
        </div>
        <!-- End: Customizer-->

        <!-- Buynow Button-->
        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        @include('layouts._footer')

        <script src="{{asset('app-assets/js/scripts/pages/dashboard-ecommerce.min.js')}}"></script>

        <script>
            $(window).on("load", function () {
                if (feather) {
                    feather.replace({ width: 14, height: 14 });
                }
            });
        </script>

        <!-- END: Body-->

        <!-- Mirrored from www.pixinvent.com/demo/vuexy-html-bootstrap-admin-template/html/ltr/vertical-menu-template/dashboard-ecommerce.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Sep 2021 07:00:26 GMT -->
    </body>
</html>
