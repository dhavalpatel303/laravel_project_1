<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Create Cab</title>
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
                        <h4 class="page-title">Add Cab</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add New Cab</li>
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
                            {!! Form::open(array('route' => 'cab_master.store','class'=>'form form-horizontal','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Cab Name<span class="red">*</span></label>
                                                    {!! Form::text('cab', null, array('placeholder' => 'Cab Name','class' => 'form-control','required')) !!}

                                                </div>

                                                <div><span style="color: red;">{{ $errors->first('cab') }}</span></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Availabel Cab<span class="red">*</span></label>
                                                    {!! Form::text('av_cabs', null, array('placeholder' => 'Available Cabs','class' => 'form-control','required')) !!}

                                                </div>

                                                <div><span style="color: red;">{{ $errors->first('avilable cabs') }}</span></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Km Rate<span class="red">*</span></label>
                                                    {!! Form::text('km_rate', null, array('placeholder' => 'Km Rate','class' => 'form-control','required')) !!}

                                                </div>

                                                <div><span style="color: red;">{{ $errors->first('km rate') }}</span></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Round Trip Km Rate<span class="red">*</span></label>
                                                    {!! Form::text('mkm_rate', null, array('placeholder' => 'Round Trip Km Rate','class' => 'form-control','required')) !!}

                                                </div>

                                                <div><span style="color: red;">{{ $errors->first('mkm rate') }}</span></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Seats<span class="red">*</span></label>
                                                    {!! Form::text('seat', null, array('placeholder' => 'Seats','class' => 'form-control','required')) !!}

                                                </div>

                                                <div><span style="color: red;">{{ $errors->first('seat') }}</span></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Bags<span class="red">*</span></label>
                                                    {!! Form::text('bag', null, array('placeholder' => 'Bags','class' => 'form-control','required')) !!}

                                                </div>

                                                <div><span style="color: red;">{{ $errors->first('bag') }}</span></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Cab Image<span class="red">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="file" class="form-control" id="image" name="image" required>

                                                    </div>

                                                </div>

                                                <div><span style="color: red;">{{ $errors->first('image') }}</span></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div id="imagePreview">
                                                        <img src="" class="preview_image" style="height: 100px;margin-bottom:15px;border-radius:20px">

                                                    </div>
                                                </div>

                                                <div><span style="color: red;">{{ $errors->first('image') }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="text-align: center">
                                        <div class="form-actions">
                                            <div class="card-body">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                                                <a href="{{route('cab_master.index')}}" class="btn btn-dark">Cancel</a>
                                            </div>
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
   <script>
    $("#imagePreview").hide();
    $('#image').change(function(){
        var img = $("#image").val()
        if(img != ''){
            $("#imagePreview").show();
        }else{
            $("#imagePreview").hide();
        }

    });
</script>
<script>
    const inpFile = document.getElementById("image");
    const previewContainer = document.getElementById("imagePreview");
    const previewImage = previewContainer.querySelector(".preview_image");

    inpFile.addEventListener("change",function() {
        const file = this.files[0];

        if(file){
            const reader = new FileReader();
            previewImage.style.display = "block";

            reader.addEventListener("load",function() {
                console.log(this);
                previewImage.setAttribute('src',this.result);
            });
            reader.readAsDataURL(file);
        }
    });
</script>



</body>

</html>
