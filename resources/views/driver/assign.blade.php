<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Add Driver</title>
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
                        <h4 class="page-title">Add Driver</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Driver</li>
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
                            {!! Form::open(array('route' => 'driver_oneway','class'=>'form form-horizontal','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Vendor Name<span>*</span></label>
                                                {!! Form::text('vendor_name', null, array('placeholder' => ' Enter Vendor name','class' => 'form-control')) !!}
                                                <input type="hidden" id="oneway_id" name="oneway_id" value="{{$oneway_id}}">
                                                <div><span style="color: red;">{{ $errors->first('vendor_name') }}</span></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Driver Name<span>*</span></label>
                                                {!! Form::text('driver_name', null, array('placeholder' => ' Enter Driver Name','class' => 'form-control')) !!}
                                            </div>
                                             <div><span style="color: red;">{{ $errors->first('driver_name') }}</span></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Driver Mobile<span>*</span></label>
                                                {!! Form::text('driver_mobile', null, array('placeholder' => ' Enter Driver Mobile','class' => 'form-control')) !!}
                                            </div>
                                            <div><span style="color: red;">{{ $errors->first('driver_mobile') }}</span></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Cab Name<span>*</span></label>
                                                {!! Form::text('cab_name', null, array('placeholder' => ' Enter Cab Name','class' => 'form-control')) !!}
                                                    </div>
                                                    <div><span style="color: red;">{{ $errors->first('cab_name') }}</span></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Cab Number<span>*</span></label>
                                                {!! Form::text('cab_number', null, array('placeholder' => ' Enter Cab Number','class' => 'form-control')) !!}
                                            </div>
                                            <div><span style="color: red;">{{ $errors->first('cab_number') }}</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                                        <a href="{{route('multy_bookings.index')}}" class="btn btn-dark">Cancel</a>
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
   <script>
    // Date Picker
    jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#from_date').datepicker({
        todayHighlight: true,
        startDate: new Date(),

    });
    jQuery('#to_date').datepicker({
        todayHighlight: true,
        startDate: new Date(),

    });
    </script>
   <!-- END: Page JS-->




</body>

</html>
