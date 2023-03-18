<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Oneway Details</title>
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
                        <h4 class="page-title">Onewaydetails List</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Onewaydetails List</li>
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
                            @if(session()->has('danger'))
                            <div class="alert alert-danger" role="alert">
                                <div class="alert-body">
                                    {{ session()->get('danger') }}
                                 </div>
                            </div>
                            @endif
                            @if(session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                <div class="alert-body">
                                    {{ session()->get('success') }}
                                 </div>
                            </div>
                            @endif
                            <div class="card-body">
                                <div class="d-flex align-items-center">

                                    <div>
                                        <h4>Onewaydetails</h4>
                                        <button class="btn btn-danger me-1 waves-effect waves-float waves-light  d-none" id="deleteAllBtn">Delete All</button>
                                    </div>
                                    <div class="ml-auto">

                                        <a href="{{route('onewaydetails.create')}}" class="btn btn-info card-title">Add New <i class="fa fa-plus"></i></a>
                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table id="list-table" class="table table-striped table-bordered" style="width: 1245px">
                                        <thead>
                                            <tr>
                                                <th ><input type="checkbox" name="main_checkbox"><label></label></th>
                                                <th>No</th>
                                                <th>From/To</th>
                                                <th>Cab</th>
                                                <th>Amount</th>
                                                {{-- <th>Km Rate</th> --}}
                                                <th>Toll/State/Gst</th>
                                                <th>Fare Rate/Min Km/Allowance</th>
                                                <th>Popular Route</th>
                                                <th> Total</th>
                                                <th> Status </th>
                                                {{-- <th>Add Cab </th> --}}
                                                <th> Action </th>
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
    $(function () {

        var table = $('#list-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('onewaydetails.index') }}",

            columns: [
                {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false,},
                {data: 'DT_RowIndex',    name: 'DT_RowIndex'},
                {data:'extra',     name:'extra'},
                {data:'cab_type',     name:'cab_type',width:'120px'},
                {data:'amount',     name:'amount'},
                // {data:'km_rate',     name:'km_rate'},
                {data:'alltax',name:'alltax'},
                {data:'fare_rate',name:'fare_rate'},
                {data:'popular_routes',name:'popular_routes'},
                {data:'total_amount' ,name:'total_amount'},
                {data:'status',name:'status'},
                // {data:'add_cab' ,name:'add_cab'},
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

        var url = '{{route("onewaydetails.deleteAll")}}';
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

</html>
