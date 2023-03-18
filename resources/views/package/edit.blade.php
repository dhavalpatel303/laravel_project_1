@include('layouts._top_bar')
<head>
    <title>{{helpers::name()}} | Edit Local Package</title>
</head>
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left caol-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Edit Local Package</h2>

                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Horizontal form layout section start -->
                <section id="basic-horizontal-layouts">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="card">

                                <div class="card-body">
                                    {!! Form::model($package, ['method' => 'PATCH','route' => ['package.update', $package->id],'files' => 'true','enctype'=>'multipart/form-data']) !!}
                                    {{-- {!! Form::model($testimonial, ['method' => 'PATCH','route' => ['testimonial.update', encrypt($testimonial->id)]]) !!} --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label" for="fname-icon">Local pPackage</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="input-group input-group-merge">
                                                        {!! Form::text('local_package', null, array('placeholder' => 'Local Package','class' => 'form-control')) !!}
                                                    </div>
                                                    <div><span style="color: red;">{{ $errors->first('Local Package') }}</span></div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="sumbit" class="btn btn-primary me-1">Update</button>
                                        {!! Form::close() !!}
                                        <a id="close"><button type="button" class="btn btn-danger me-1">Cancel</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @include('layouts._footer')
    <!-- END: Page JS-->

    <script>
        $(window).on("load", function () {
            if (feather) {
                feather.replace({ width: 14, height: 14 });
            }
        });
    </script>
    <script>

        $("#close").click(function(){

            window.location.replace('{{route('onewaydetails.index')}}');
        });
        </script>
</body>
<!-- END: Body-->


