<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Update User</title>
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
                        <h4 class="page-title">Update User</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update User</li>
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
                        <div class="card">

                            {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', encrypt($user->id)]]) !!}
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6"> 
                                                <div class="form-group"> 
                                                    <label>User Name<span class="red">*</span></label>

                                                    {!! Form::text('name', null, array('placeholder' => 'User Name','class' => 'form-control','Required')) !!}
                                                    {{-- <input type="text" id="city_name" name="city_name" class="form-control pac-target-input" value="" placeholder="Enter a City" autocomplete="off" /> --}}
                                                </div>
                                                <div><span style="color: red;">{{ $errors->first('name') }}</span></div>
                                                <div class="form-group">
                                                    <label>User Mobile Number<span class="red">*</span></label>

                                                    {!! Form::text('user_mobile', null, array('placeholder' => 'User Mobile Number','class' => 'form-control','Required')) !!}
                                                    {{-- <input type="text" id="city_name" name="city_name" class="form-control pac-target-input" value="" placeholder="Enter a City" autocomplete="off" /> --}}
                                                </div>
                                                <div><span style="color: red;">{{ $errors->first('user_mobile') }}</span></div>

                                                <div class="form-group">
                                                    <label>User Mobile Email <span class="red">*</span></label>

                                                    {!! Form::text('email', null, array('placeholder' => 'User Email Address','class' => 'form-control','Required')) !!}
                                                    {{-- <input type="text" id="city_name" name="city_name" class="form-control pac-target-input" value="" placeholder="Enter a City" autocomplete="off" /> --}}
                                                </div>
                                                <div><span style="color: red;">{{ $errors->first('email') }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
                                            <a href="{{route('users.index')}}" class="btn btn-dark">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            {!!Form::close()!!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="chat-windows"></div>
   @include('layouts._footer')
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- END: Page JS-->




</body>

</html>
