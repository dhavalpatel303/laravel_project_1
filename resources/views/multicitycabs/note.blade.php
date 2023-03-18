<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Inclusion & Exclusion</title>
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
                        <h4 class="page-title">Inclusion & Exclusion </h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Inclusion & Exclusion </li>
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
                             {!! Form::model($note, ['method' => 'Patch','route' => ['multicitycabs.onewaynote', $note]]) !!}
                            
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                           <div class="col-md-6 col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Oneway Term & Condition</h4>
                                                    </div>
                                                    <div class="card-body">
                                                     

                                                    <div class="col-md-12 mb-1">{{-- <label class="form-label" for="defaultInput">Bags</label> --}}
                                                        {!! Form::textarea('oneway_note', null, array('placeholder' => 'note','class' => 'form-control ckeditor')) !!}</div>

                                                    {{-- <div class="col-md-12" style="text-align: center;">
                                                        <button class="btn btn-primary waves-effect waves-float waves-light mtop" type="submit">Submit</button>
                                                    </div> --}}

                                                               
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="col-md-6 col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Local Term & Condition</h4>
                                                </div>
                                                <div class="card-body">
                                                   

                                                                    <div class="col-md-12 mb-1">{{-- <label class="form-label" for="defaultInput">Bags</label> --}}
                                                                        {!! Form::textarea('local_note', null, array('placeholder' => 'local_note','class' => 'form-control ckeditor')) !!}</div>


                                                       
                                                </div>
                                            </div>
                                        </div>
                                        
                                        </div>
                                    </div>
                                      
                                        <div class="form-actions">
                                            <div class="card-body" style="text-align:center">
                                            
                                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
                                                <a href="{{route('home')}}" class="btn btn-dark">Cancel</a>
                                                </div>
                                                
                                        
                                        </div>
                                     
                                </div>
                            {!! Form::close() !!}
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


<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script type="text/javascript">

    $(document).ready(function() {

       $('.ckeditor').ckeditor();

    });

</script>



</body>

</html>
