<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Select Driver</title>
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
                        <h4 class="page-title">Select Driver</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Select Driver</li>
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
                        <div class="card">
                            @if(session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                <div class="alert-body">
                                    {{ session()->get('success') }}
                                 </div>
                            </div>
                            @endif
                            <div class="card-body">
                                <div>
                                    <h4>Driver List</h4>
                                </div>
                                <input type="hidden" name="onewayid" id=onewayid value="{{$onewayid}}">

                                <div class="table-responsive">
                                    <table id="list-table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th ><input type="checkbox" name="main_checkbox"><label></label></th>
                                                <th>No</th>
                                                <th>Vendor Name</th>
                                                <th>Driver Name</th>
                                                <th>Driver Mobile </th>
                                                <th>Cab Name</th>
                                                <th>Cab Number</th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: white">

                                            @php $i=0; @endphp
                                            @foreach($data as $value)
                                            @php $i++; @endphp
                                        <tr role="row" class="odd">
                                            <td><input type="checkbox" name="main_checkbox"><label></label> </td>
                                            <td>{{$i}}</td>
                                            <td>{{$value->vendor_name}}</td>
                                            <td>{{$value->driver_name}}</td>
                                            <td>{{$value->driver_mobile}}</td>
                                            <td>{{$value->cab_name}}</td>
                                            <td>{{$value->cab_number}}</td>
                                            <td> <a onclick="driverselect(<?=$value->id?>)" id="select" class="btn btn-success me-1 waves-effect waves-float waves-light" style="color: rgb(15, 13, 13)" ><i class="fa fa-check "></i> Select</a></td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
    function driverselect(id)  {

        var driverselect = id;
                                   var onewayid = jQuery("#onewayid").val();
                                   jQuery.ajax({
                                    headers: {
                                    'X-CSRF-Token': $('input[name="_token"]').val()
                                                },
                                       type: "Post",
                                       url: "{{route('dataselect')}}",
                                       data:{driverselect:driverselect,onewayid: onewayid},

                                       success: function(resp) {
                                        // alert('hello');
                                        window.location.replace('{{route('multy_bookings.index')}}');

                                   }
                           });
                   return false;
       };

  </script>

</body>

</html>
