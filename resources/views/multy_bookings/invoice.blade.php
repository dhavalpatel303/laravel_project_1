<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Invoice List</title>
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
                        <h4 class="page-title">Invoice List</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Invoice List</li>
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4>Filter</h4>
                                    </div>
                                </div>
                                <form action="" method="get">
                                    <div class="row input-daterange">
                                        <div class="col-md-3">
                                            <input type="text" name="booking_id" id="booking_id" placeholder="Booking ID" class="form-control" autocomplete="off" style="text-align: left" />
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="number" id="number" placeholder="Number" class="form-control" autocomplete="off" style="text-align: left"/>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <input type="button" name="filter" id="filter" value="Filter" class="btn rounded-pill btn-success"  />
                                            <input type="button" name="reset" id="reset" value="Reset" class="btn rounded-pill btn-danger" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
               </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                <h3 class="text-success"><i class="fa fa-check-circle"></i>  <b>  {{ session()->get('success') }}</h3>

                            </div>

                            @endif
                            <div class="card-body">
                                <div class="d-flex align-items-center">

                                    <div>
                                        <h4>Invoice List</h4>
                                        {{-- <button class="btn btn-danger me-1 waves-effect waves-float waves-light  d-none" id="deleteAllBtn">Delete All</button> --}}
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="list-table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                {{-- <th ><input type="checkbox" name="main_checkbox"><label></label></th> --}}
                                                <th>No</th>
                                                <th>Invoice No</th>
                                                <th>Invoice</th>
                                                <th>Customer Info</th>
                                                <th>From/To</th>
                                                <th>Date / Time</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
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

    load_data();
    function load_data(booking_id = '', number = '')
    {
       var table = $('#list-table').DataTable({
               processing: true,
               serverSide: true,
               ajax: {
                   url:'{{ route("multy_bookings.invoice") }}',
                   data:{booking_id:booking_id, number:number}
               },
               columns: [ 

                {data: 'DT_RowIndex',    name: 'DT_RowIndex'},
                {data: 'invoice_no',           name: 'invoice_no'},
                {data: 'invoice',           name: 'invoice'},
                {data: 'customer',           name: 'customer'},
                {data: 'from',           name: 'from'},
                {data: 'date',           name: 'date'},
                {data: 'total_amount',           name: 'total_amount'},


            ],
       })

    }
       $('#filter').click(function(){
     var booking_id = $('#booking_id').val();
     var number = $('#number').val();
     $('#list-table').DataTable().destroy();
      load_data(booking_id, number);
    });

    $('#reset').click(function(){
     $('#booking_id').val('');
     $('#number').val('');
     $('#list-table').DataTable().destroy();
     load_data();
    });

    </script>

<script>
    $(document).on('click', '.status_change', function (e) {
      e.preventDefault();

      var url = $(this).attr('href');

      $.ajax({url:url,success:function(result)
      {
          $('#list-table').DataTable().ajax.reload();

      }});
  });

  </script>
  <script>
    $(document).on('click', '.status_active', function (e) {
      e.preventDefault();

      var url = $(this).attr('href');

      $.ajax({url:url,success:function(result)
      {
          $('#list-table').DataTable().ajax.reload();

      }});
  });

  </script>
  <script>

    $('#list-table').on('draw.dt', function() {
              $('[data-toggle="tooltip"]').tooltip();
          });
          $('#list-table').on('draw.dt', function() {
              $('[data-toggle="popover"]').popover();
          });

  </script>

<script>
    $(document).on('click', '.ganrate_invoice', function (e) {
      e.preventDefault();
      var url = $(this).attr('href');
        // alert(url);
      $.ajax({url:url,success:function(result)
      {
          $('#list-table').DataTable().ajax.reload();

      }});
  });

  </script>

<script src="https://uwaycabs.com/assets/panel/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

</body>

</html>
