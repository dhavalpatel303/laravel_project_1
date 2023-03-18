@include('layouts._top_bar')
<head>
    <title>{{helpers::name()}} | Onewaybookings List</title>
</head>
<style>

 </style>

<html class="loading" lang="en" data-textdirection="ltr">
    <!-- BEGIN: Head-->

    <!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Oneway Booking</h2>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-danger me-1 waves-effect waves-float waves-light  d-none" id="deleteAllBtn">Delete All</button>
                        </div>
                    </div>
                </div>
            <section>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                        @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <div class="alert-body">
                                {{ session()->get('success') }}
                             </div>
                        </div>
                        @endif
                      <table id="list-table" class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th ><input type="checkbox" name="main_checkbox"><label></label></th>
                            <th>#</th>
                            <th>No</th>
                            <th>Order No</th>
                            <th>Cab Type</th>
                            <th>Contatct info</th>
                            <th>Date/Time</th>
                            <th>Pickup/Drop City</th>
                            <th>Driver name </th>
                            <th>Assign Driver</th>
                            <th> Status </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                     </table>
                    </div>
                  </div>
                </div>
            </section>
                </div>
            </div>
        </div>
        <!-- END: Content-->


        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        @include('layouts._footer')
        <script src="{{asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js')}}"></script>
        <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
        <script src="{{asset('app-assets/vendors/js/tables/datatable/jszip.min.js')}}"></script>
        <script src="{{asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
        <script src="{{asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
        <script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
        <script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
        <script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')}}"></script>
        <script src="{{asset('app-assets/js/scripts/tables/table-datatables-basic.min.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- END: Page JS-->

        <script>
            $(window).on("load", function () {
                if (feather) {
                    feather.replace({ width: 14, height: 14 });
                }
            });
        </script>
        <script>
            $(function () {

                var table = $('#list-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('onewaybookings.index') }}",
                    columns: [
                        {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
                        {data:'pdf',     name:'pdf', orderable: false, searchable: false},
                        {data: 'DT_RowIndex',    name: 'DT_RowIndex'},
                        {data: 'orderno',    name: 'orderno'},
                        {data:'cab_type',     name:'cab_type'},
                        {data:'contact_info',     name:'contact_info'},
                        {data:'dateTime',     name:'dateTime'},
                        {data:'pickDrop',   name:'pickDrop'},
                        {data:'driver_id',   name:'driver_id'},
                        {data:'asign',name:'asign'},
                        {data:'status',name:'status'},
                        {data: 'action',name: 'action', orderable: false, searchable: false},


                    ],

                }).on('draw',function(){
                        $('input[name="city_checkbox"]').each(function(){this.checked = false;});
                        $('input[name="main_checkbox"]').prop('checked',false);
                        $('button#deleteAllBtn').addClass('d-none');

                });
            });

         </script>
         <script>

             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
             $(document).on('click','input[name="main_checkbox"]',function(){
                 if(this.checked){
                     $('input[name="city_checkbox"]').each(function(){
                         this.checked = true;
                     });
                 }else{
                    $('input[name="city_checkbox"]').each(function(){
                         this.checked = false;
                     });
                 }
                 toggledeleteAllBtn();
             });
             $(document).on('change','input[name="city_checkbox"]',function(){

                if($('input[name="city_checkbox"]').length==$('input[name="city_checkbox"]:checked').length){
                    $('input [name="main_checkbox"]').prop('checked',true);
                }else{
                    $('input [name="main_checkbox"]').prop('checked',false);
                }
                toggledeleteAllBtn();
             });

             function toggledeleteAllBtn(){
                 if( $('input[name="city_checkbox"]:checked').length > 0 ){
                     $('button#deleteAllBtn').text('DeleteAll ('+$('input[name="city_checkbox"]:checked').length+')').removeClass('d-none');
                 }else{
                     $('button#deleteAllBtn').addClass('d-none');
                 }
             }
             $(document).on('click','button#deleteAllBtn',function(){
                 var checkedcity = [];
                 $('input[name="city_checkbox"]:checked').each(function(){
                    checkedcity.push($(this).data('id'));
                 });

                var url = '{{route("onewaybookings.deleteAll")}}';
                if(checkedcity.length > 0)
                {

                    swal.fire({
                        title:'Are You Sure?',
                        html:'You want to delete <b>('+checkedcity.length+')</b>data',
                        showCancelButton:true,
                        showCloseButton:true,
                        confirmButtonText:'Yes,Delete',
                        cancelButtonText:'Cancel',
                        confirmButtonColor:'#556ee6',
                        cancelButtonColor:'#d33',
                        width:300,
                        allowOutsideClick:false,
                    }).then(function(result){
                        if(result.value){
                            $.post(url,{checkedcity_ids:checkedcity},function(data){

                                if(data.code == 1){
                                    $('#list-table').DataTable().ajax.reload(null,true);
                                    toaster.success(data.msg);
                                }
                            },'json');
                        }
                    })
                }
            });


         </script>
        {{-- <script>
            function changeStatus(_this, id) {
                var status = $(_this).prop('checked') == true ? 1 : 0;
                let _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: `/change-status`,
                    type: 'post',
                    data: {
                        _token: _token,
                        id: id,
                        status: status
                    },
                    success: function (result) {
                    }
                });
            }

        </script> --}}
       {{-- <script>
        $(function() {
          $('.toggle-class').change(function() {
              var status = $(this).prop('checked') == true ? 1 : 0;
              var user_id = $(this).data('id');

              $.ajax({
                  type: "GET",
                  dataType: "json",
                  url: '/changeStatus',
                  data: {'status': status, 'user_id': user_id},
                  success: function(data){
                    console.log(data.success)
                  }
              });
          })
        })
      </script> --}}
      <script>
          $(document).on('click', '.statuschange', function (e) {

            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({url:url,success:function(result)
            {
                $('#list-table').DataTable().ajax.reload();
            }});
        });

      </script>

    </body>
    <!-- END: Body-->


</html>
