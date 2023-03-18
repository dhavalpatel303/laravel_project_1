@include('layouts._top_bar')
<head>
    <title>{{helpers::name()}} | Edit Dropcity</title>
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
                            <h2 class="content-header-title float-start mb-0">Add Pickup City</h2>

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
                                <div class="card-header">
                                    <h4 class="card-title">Edit Drop City</h4>
                                </div>
                                <div class="card-body">
                                    {!! Form::model($dropcity, ['method' => 'PATCH','route' => ['dropcity.update', encrypt($dropcity->id)]]) !!}
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label" for="fname-icon">City</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i data-feather="user"></i></span>
                                                            {!! Form::text('drop_city', null, array('placeholder' => 'City','class' => 'form-control')) !!}
                                                        </div>
                                                        <div><span style="color:red">{{  $errors->first('drop_city') }}</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-9 offset-sm-3">
                                                <a  ><button type="sumbit" class="btn btn-primary me-1" >Update</button></a>
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

            window.location.replace('{{route('dropcity.index')}}');
        });
        </script>
</body>
<!-- END: Body-->


