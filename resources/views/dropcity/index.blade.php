@include('layouts._top_bar')
<head>
    <title>{{helpers::name()}} | Dropcity List</title>
</head>
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
                                <h2 class="content-header-title float-start mb-0">Drop  City</h2>
                                {{-- <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item active">Select <input class="form-check-input" type="checkbox" value="checked" checked="" >For Delete All</li>
                                    </ol>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-danger me-1 waves-effect waves-float waves-light  d-none" id="deleteAllBtn">Delete All</button>
                            <a href="{{route('dropcity.create')}}">
                                <button class="dt-button create-new btn btn-primary waves-effect waves-float waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-slide-in" style="float: right;">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                            <line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        Add New Record
                                    </span>
                                </button></a>
                        </div>
                    </div>
            <section>

                <div class="row">

                  <div class="col-12">
                    <div class="card">
                      <table id="list-table" class="table table-bordered">
                        <thead>
                        <tr>
                            <th ><input type="checkbox" name="main_checkbox"><label></label></th>
                            <th>No</th>
                            <th>City</th>
                            <th>Created At</th>
                            <th>Action</th>
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
                    ajax: "{{ route('dropcity.index') }}",
                    columns: [
                        {data:'checkbox',name:'checkbox',orderable: false, searchable: false,},
                        {data: 'DT_RowIndex',    name: 'DT_RowIndex'},
                        {data: 'drop_city',           name: 'drop_city'},
                        {data:'created_at',      name:'created_at'},
                        {data: 'action',            name: 'action', orderable: false, searchable: false},

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

                   var url = '{{route("dropcity.deleteAll")}}';
                   if(checkedcity.length > 0)
                   {

                       swal.fire({
                           title:'Are You Sure?',
                           html:'You want to delete <b>('+checkedcity.length+')</b>Drop city',
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
    </body>
    <!-- END: Body-->


</html>
