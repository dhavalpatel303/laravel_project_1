       <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="{{route('home.index')}}">
                        <!-- Logo icon --> 

                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             <span style="color: #fff;font-size: 18px;font-weight: 600;">Admin Panel</span>
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">

                        <!-- ============================================================== -->
                        <!-- mega menu -->
                        <!-- ============================================================== -->
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>

                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('app-assets/assets/images/users/1.jpg')}}" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white mb-2">
                                    <div class=""><img src="{{asset('app-assets/assets/images/users/1.jpg')}}" alt="user" class="img-circle" width="60"></div>
                                    <div class="ml-2">
                                        <h4 class="mb-0">{{helpers::name()}}</h4>
                                        <p class=" mb-0">{{helpers::email()}}</p>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('change-password')}}"><i class="ti-settings mr-1 ml-1"></i>Change Passward</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i data-feather="power"  class="me-50"></i> {{ __('Logout') }}
                                </a> <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" >
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li>
                            <!-- User Profile-->
                            <div class="user-profile d-flex no-block dropdown mt-3">
                                <div class="user-pic"><img src="{{asset('app-assets/assets/images/users/1.jpg')}}" alt="users" class="rounded-circle" width="40" /></div>
                                <div class="user-content hide-menu ml-2">
                                    <a href="javascript:void(0)" class="" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <h5 class="mb-0 user-name font-medium">{{helpers::name()}} </h5>
                                        <span class="op-5 user-email">{{helpers::email()}}</span>
                                    </a>

                                </div>
                            </div>
                            <!-- End User Profile-->
                        </li>

                        <!-- User Profile-->

                        <li class="sidebar-item {{Request::is('admin/dashboard') ? 'menu_active1':''}}"> <a class="sidebar-link  waves-effect waves-dark" href="{{route('home')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard </span></a>

                        </li>
                        <li class="sidebar-item {{Request::is('admin/user_details') ? 'menu_active1':''}}"> <a class="sidebar-link waves-effect waves-dark" href="{{route('users.index')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">User List </span></a>

                        </li>
                        <li class="sidebar-item {{Request::is('admin/city') ? 'menu_active1':''}} {{Request::is('admin/city/add') ? 'menu_active1':''}} "> <a class="sidebar-link waves-effect waves-dark" href="{{route('pickup.index')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">City List</span></a>

                        </li>
                        <li class="sidebar-item "> <a class="sidebar-link has-arrow waves-effect waves-dark  {{Request::is('admin/onewaydetails') ? 'menu_active1':''}}" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-tune-vertical"></i><span class="hide-menu">Rate Card </span></a>
                            <ul aria-expanded="false" class="collapse first-level">

                                <li class="sidebar-item "> <a class="sidebar-link " href="{{route('onewaydetails.index')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Oneway Details </span></a></li>
                                <!-- <li class="sidebar-item "> <a class="sidebar-link " href="{{route('onewaydetails.increase')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Increase/Decrease</span></a></li>
                                <li class="sidebar-item "> <a class="sidebar-link " href="{{route('increase.index')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Increase/Decrease List</span></a></li> -->
                            </ul>
                        </li>

                        <li class="sidebar-item {{Request::is('admin/localdetails') ? 'menu_active1':''}}"> <a class="sidebar-link waves-effect waves-dark" href="{{route('localdetails.index')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Local Details </span></a> </li>


                        <li class="sidebar-item {{Request::is('admin/multy_bookings/add') ? 'menu_active1':''}}"> <a class="sidebar-link waves-effect waves-dark" href="{{route('multy_bookings.create')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Create Bookings</span></a>

                        </li>
                        <li class="sidebar-item  {{Request::is('admin/multy_bookings') ? 'menu_active1':''}}"> <a class="sidebar-link waves-effect waves-dark" href="{{route('multy_bookings.index')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Booking list</span></a>

                        </li>

                        <li class="sidebar-item  {{Request::is('admin/cab_booking/invoice') ? 'menu_active1':''}}"> <a class="sidebar-link waves-effect waves-dark" href="{{route('multy_bookings.invoice')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Invoice list</span></a>

                        </li>


                        <li class="sidebar-item {{Request::is('admin/cupon') ? 'menu_active1':''}}"> <a class="sidebar-link waves-effect waves-dark" href="{{route('cupon.index')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Coupon Code</span></a>

                        </li>

                        {{-- <li class="sidebar-item {{Request::is('admin/driver') ? 'menu_active1':''}}"> <a class="sidebar-link waves-effect waves-dark" href="{{route('driver.index')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Driver Details</span></a>

                        </li> --}}
                        <li class="sidebar-item "> <a class="sidebar-link has-arrow waves-effect waves-dark  {{Request::is('admin/common_page') ? 'menu_active1':''}}" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-tune-vertical"></i><span class="hide-menu">Website Management </span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="{{route('site_settings')}}" class="sidebar-link"><i class="mdi mdi-comment-processing-outline"></i><span class="hide-menu"> Common Page </span></a></li>

                            </ul>
                        </li>


                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
