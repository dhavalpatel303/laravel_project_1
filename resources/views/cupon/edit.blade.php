<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Edit Coupon</title>
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
                        <h4 class="page-title">Edit Coupon</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Coupon</li>
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
                            {!! Form::model($cupon, ['method' => 'PATCH','route' => ['cupon.update', encrypt($cupon->id)]]) !!}

                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Coupon Name<span>*</span></label>
                                                {!! Form::text('cupon_code', null, array('placeholder' => 'Enter Coupon Name','class' => 'form-control' )) !!}
                                                <div><span style="color: red;">{{ $errors->first('cupon_code') }}</span></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Coupon Rate<span>*</span></label>
                                                {!! Form::text('cupon_rate', null, array('placeholder' => 'Enter Coupon Rate','class' => 'form-control')) !!}
                                                <div><span style="color: red;">{{ $errors->first('min_amount') }}</span></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Minimun Amount<span>*</span></label>
                                                {!! Form::number('min_amount', null, array('placeholder' => 'Enter Minimum Amount','class' => 'form-control')) !!}
                                                <div><span style="color: red;">{{ $errors->first('min_amount') }}</span></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Maximum Amount<span>* <span class="errorAmt"></span></span>
                                                </label>
                                                {!! Form::text('max_amount', null, array('placeholder' => 'Enter Maximum Amount','class' => 'form-control')) !!}
                                                <div><span style="color: red;">{{ $errors->first('max_amount') }}</span></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>From Date<span>*</span></label>
                                                <div class="input-group">{!! Form::date('from_date', null, array('placeholder' => 'Enter Coupon Name','id'=>'from_date','name'=>'from_date','class' => 'form-control' )) !!}
                                                </div> 

                                                <div><span style="color: red;">{{ $errors->first('from_date') }}</span></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>To Date<span>*</span></label>
                                                <div class="input-group">
                                                      <div class="input-group">{!! Form::date('to_date', null, array('placeholder' => 'Enter Coupon Name','id'=>'to_date','name'=>'to_date','class' => 'form-control' )) !!}
                                                </div> 
                                                </div>
                                                <div><span style="color: red;">{{ $errors->first('to_date') }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success" id="btn-submit"><i class="fa fa-check"></i> Update</button>
                                        <a href="{{route('cupon.index')}}" class="btn btn-dark">Cancel</a>
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
