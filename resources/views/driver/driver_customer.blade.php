<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Customer Details</title>
    </head>
        @include('layouts._top_bar')
          <?php use App\Local_package;?>
          <?php use App\Dropcity;?>



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
                    <div class="col-md-12">
                        <div class="card card-body printableArea" id="hello">
                            <h3><b>Customer Booking Details</b></h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
                                            <h3>&nbsp;<b class="text-danger">{{$driver_name->driver_name}}</b></h3>
                                            <p class="text-muted m-l-5">
                                                Driver Mobile - {{$driver_name->driver_mobile}}, <br />
                                                Cab Name - {{$driver_name->cab_name}}, <br />
                                                Cab Number - {{$driver_name->cab_number}}.
                                            </p>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Route Type</th>
                                                    <th>Booking Id</th>
                                                    <th>Journy From</th>
                                                    <th class="text-right">Journey Date</th>
                                                    <th class="text-right">Booking Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $totalAmount = 0?>
                                                @for($i=0;$i<count($data);$i++)
                                                <tr>
                                                    <td class="text-center"><?=$i+1?></td>
                                                    <td>{{$data[$i]['booking_type']}}</td>
                                                    <td>{{$data[$i]['orderno']}}</td>
                                                    <td><label class="label label-purple">{{$data[$i]['pick_city']}}</label>
                                                 </td>
                                                    <td class="text-right">{{ date_format(date_create($data[$i]['pickup_date']),'d-M-y') }}</td>
                                                    <td class="text-right"><i class="fa fa-inr"></i> {{$data[$i]['total_amount']}}</td>
                                                    <?php   $totalAmount += $data[$i]['total_amount'];?>
                                                </tr>
                                                @endfor


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        <hr />
                                        <h3><b>Total :</b> <i class="fa fa-inr"></i><?=number_format($totalAmount, 2, '.', ',')?></h3>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr />
                                    <div class="text-right printBtn">
                                        <button id="print" class="btn btn-default btn-outline" type="button">
                                            <span><i class="fa fa-print"></i> Print</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

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

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="chat-windows"></div>
   @include('layouts._footer')
   <script>
    $(function() {
        $("#print").click(function() {
         var print_div = document.getElementById("hello");
        var print_area = window.open();
        print_area.document.write(print_div.innerHTML);
        print_area.document.close();
        print_area.focus();
        print_area.print();
        print_area.close();
        });
    });
    </script>


</body>

</html>
