<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <title>{{helpers::name()}} | Dashboard</title>
</head>
    @include('layouts._top_bar')
<body>

    <div id="main-wrapper">
        @include('layouts._sidebar')
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>

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
                <div class="row">
                    <div class="col-12">
                        <!-- Row -->
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <a  href="{{route('users.index')}}">
                                    <div class="card border-bottom border-blue">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div>
                                                    <h2>{{$user}}</h2>
                                                    <h6 class="text-orange">Register User List</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-orange display-6"><i class="fa fa-users"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a  href="{{route('driver.index')}}">
                                    <div class="card border-bottom border-blue">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div>
                                                    <h2>{{$driver}}</h2>
                                                    <h6 class="text-orange">Driver List</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-orange display-6"><i class="ti-user"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a  href="{{route('pickup.index')}}">
                                    <div class="card border-bottom border-blue">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div>
                                                     <h2>{{$pick_city}}</h2>
                                                    <h6 class="text-orange">City List</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-orange display-6"><i class=" fas fa-map-marker-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a  href="{{route('multy_bookings.index')}}">
                                    <div class="card border-bottom border-blue">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div>
                                                    <h2>{{$multy_bookings}}</h2>
                                                    <h6 class="text-orange">Booking Details</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-orange display-6"><i class="fa fa-quote-left"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>


                            <div class="col-lg-3 col-md-6">
                                <a  href="{{route('onewaydetails.index')}}">
                                    <div class="card border-bottom border-blue">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div>
                                                    <h2>{{$onewaydetails}}</h2>
                                                    <h6 class="text-orange">Oneway Route</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-orange display-6"><i class="fas fa-road"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a  href="{{route('localdetails.index')}}">
                                    <div class="card border-bottom border-blue">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div>
                                                    <h2>{{$localdetail}}</h2>
                                                    <h6 class="text-orange">Local Package</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-orange display-6"><i class="fas fa-road"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a  href="{{route('requestcall.index')}}">
                                    <div class="card border-bottom border-blue">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div>
                                                    <h2>{{$requestcalls}}</h2>
                                                    <h6 class="text-orange">Request Call Back</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-orange display-6"><i class="ti-mobile"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a  href="{{route('advertisements')}}"> 
                                    <div class="card border-bottom border-blue">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div>
                                                    <h2>{{$advertisements}}</h2>
                                                    <h6 class="text-orange">Advertisement</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-orange display-6"><i class="far fa-comments" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a  href="{{ route('updateNote', ['id' =>1]) }}">
                                    <div class="card border-bottom border-blue">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div>
                                                    <h2>{{$oneway_note}}</h2>
                                                    <h6 class="text-orange">Inclusion & Excusion</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-orange display-6"><i class="fa fa-check"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a  href="{{route('visitor.index')}}">
                                    <div class="card border-bottom border-blue">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div>
                                                    <h2>{{$visitor_details}}</h2>
                                                    <h6 class="text-orange">Visior Details</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-orange display-6"><i class="fas fa-user-plus" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a  href="{{route('inquries.index')}}">
                                    <div class="card border-bottom border-blue">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div>
                                                    <h2>{{$contact}}</h2>
                                                    <h6 class="text-orange">Contact Us</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-orange display-6"><i class="far fa-address-book"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a  href="{{route('testimonial.index')}}">
                                    <div class="card border-bottom border-blue">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div>
                                                    <h2>{{$testimonial}}</h2>
                                                    <h6 class="text-orange">Testimonial</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-orange display-6"><i class="far fa-address-book"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Row -->
                        <!-- Booking Cabs -->
                        <div class="row">
                            <!-- ONEWAY -->
                            <div class="col-sm-12 col-lg-4">
                                <a href="{{route('multy_bookings.index')}}" >
                                    <div class="card bg-orange">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="m-r-10">
                                                    <h1 class="m-b-0"><i class="fa fa-car text-white"></i></h1></div>
                                                <div>
                                                    <h6 class="font-12 text-white m-b-5 op-7">Oneway Booking</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <div class="crypto"><canvas width="58" height="30" style="display: inline-block; width: 58px; height: 30px; vertical-align: top;"></canvas></div>
                                                </div>
                                            </div>
                                            <div class="row text-center text-white m-t-30">
                                                <div class="col-6">
                                                    <span class="font-14 d-block">Total Booking</span>
                                                    <span class="font-medium"><i class="fas fa-arrow-up"></i>{{$oneway_count}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="font-14 d-block">Total Booking Amount</span>
                                                    <span class="font-medium"><i class="fas fa-arrow-up"></i>{{$oneway_amount}}</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- MULTIWAY -->
                            <div class="col-sm-12 col-lg-4">
                                <a href="{{route('multy_bookings.index')}}" >
                                    <div class="card bg-cyan">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="m-r-10">
                                                    <h1 class="m-b-0"><i class="fa fa-car text-white"></i></h1></div>
                                                <div>
                                                    <h6 class="font-12 text-white m-b-5 op-7">Local Booking</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <div class="crypto"><canvas width="58" height="30" style="display: inline-block; width: 58px; height: 30px; vertical-align: top;"></canvas></div>
                                                </div>
                                            </div>
                                            <div class="row text-center text-white m-t-30">
                                                <div class="col-6">
                                                    <span class="font-14 d-block">Total Booking</span>
                                                    <span class="font-medium"><i class="fas fa-arrow-up"></i>{{$local_count}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="font-14 d-block">Total Booking Amount</span>
                                                    <span class="font-medium"><i class="fas fa-arrow-up"></i>{{$local_amount}}</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- ROUNDTRIP -->
                            <div class="col-sm-12 col-lg-4">
                                <a href="{{route('multy_bookings.index')}}" >
                                    <div class="card bg-purple">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="m-r-10">
                                                    <h1 class="m-b-0"><i class="fa fa-car text-white"></i></h1></div>
                                                <div>
                                                    <h6 class="font-12 text-white m-b-5 op-7">RoundTrip Booking</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <div class="crypto"><canvas width="58" height="30" style="display: inline-block; width: 58px; height: 30px; vertical-align: top;"></canvas></div>
                                                </div>
                                            </div>
                                            <div class="row text-center text-white m-t-30">
                                                <div class="col-6">
                                                    <span class="font-14 d-block">Total Booking</span>
                                                    <span class="font-medium"><i class="fas fa-arrow-up"></i>{{$multy_count}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="font-14 d-block">Total Booking Amount</span>
                                                    <span class="font-medium"><i class="fas fa-arrow-up"></i>{{$multy_amount}}</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Booking Cabs -->
                        <h4 class="m-t-40">Quick Links</h4>
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <a href="{{route('multicitycabs.index')}}">
                                    <div class="card bg-info">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div class="text-white">
                                                    <h6>Multi City Cabs</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-white display-6"><i class="ti-notepad"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="{{route('cab_master.index')}}">
                                    <div class="card bg-cyan">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center">
                                                <div class="text-white">
                                                    <h6>Cab Master</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="text-white display-6"><i class="ti-notepad"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by OceanCab admin. Designed and Developed by <a href="https://msquaretech.in/">mSquare Info Tech</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->

    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    @include('layouts._footer')
</body>

</html>
