<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Create Testimonial</title>
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
                        <h4 class="page-title">Add Testimonial</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add New Testimonial</li>
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
                          {!! Form::open(array('route' => 'testimonial.store','class'=>'form form-horizontal','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                         
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Name<span class="red">*</span></label>
                                                 {!! Form::text('name', null, array('placeholder' => 'name','class' => 'form-control')) !!}
                                                 
                                                </div>
                                              
                                            </div>
                                              <div class="col-md-6">
                                               
                                              
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Message<span class="red">*</span></label>
                                                {!! Form::textarea('message', null, array('placeholder' => 'Message','class' => 'form-control','rows'=>5)) !!}
                                                 
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                                            <a href="{{route('testimonial.index')}}" class="btn btn-dark">Cancel</a>
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

   <script type="text/javascript">
    window.onload = function(){
        initialize();
    }
    var autocomplete;
        function initialize() {
            var cityname = document.getElementById('pick_city');
                autocomplete1 = new google.maps.places.Autocomplete((cityname), { types: ['(cities)'],componentRestrictions: {country: 'in'} });
                google.maps.event.addListener(autocomplete1, 'place_changed', function() {
            });
        }
    </script>



</body>

</html>
