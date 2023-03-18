<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Multycity Cabs</title>
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
                        <h4 class="page-title">Multycity Cabs</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Multycity Cabs</li>
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
                    @for($i=0;$i<count($cab);$i++)
                    <div class="col-lg-4">
                        <div class="card">
                            {!! Form::model($cab, ['method' => 'Patch','route' => ['multicitycabs.updateSedan', $cab[$i]['id']]]) !!}

                                <input type="hidden"  id="id" name="id"value="{{$cab[$i]['id']}}">
                                <div class="form-body">
                                    <div class="card-header" style="background: #698d85;">
                                        <h4 class="m-b-0 text-white">{{$cab[$i]['cab']}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Driver Allownce</label>
                                                    <input type="text" class="form-control"  id="driver_allowance" name="driver_allowance"value="{{$cab[$i]['driver_allowance']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Mini.Km/Day</label>
                                                    <input type="text" class="form-control"  id="minkm" name="minkm"value="{{$cab[$i]['minkm']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Seat</label>
                                                    <input type="text" class="form-control"  id="seat" name="seat"value="{{$cab[$i]['seat']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Bags</label>
                                                    <input type="text" class="form-control"  id="bag" name="bag"value="{{$cab[$i]['bag']}}">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-actions">
                                            <div class="card-body">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                                                <a href="{{route('home')}}" class="btn btn-dark">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {!!Form::close()!!}
                        </div>
                    </div>
                    @endfor

                </div>

                <!-- Note -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            {!! Form::model($note, ['method' => 'Patch','route' => ['multicitycabs.updateNote', $note->id]]) !!}
                                <input type="hidden" name="ci_csrf_token" value="" />
                                <input type="hidden" name="mode" id="mode" value="Add" />
                                <input type="hidden" name="eid" id="eid" value="" />
                                <input type="hidden" name="id" id="id" value="3" />
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Note</label>
                                                    {!! Form::textarea('note', null, array('placeholder' => 'note','class' => 'form-control ckeditor')) !!}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-actions">
                                            <div class="card-body">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                                                <a href="{{route('home')}}" class="btn btn-dark">Cancel</a>
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
   {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
   <script src="{{asset('app-assets/assets/libs/ckeditor/ckeditor.js')}}"></script>
   <script src=" {{asset('app-assets/assets/libs/ckeditor/samples/js/sample.js')}}"></script>
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
            ajax: "{{ route('localdetails.index') }}",
            columns: [
                {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
                {data: 'DT_RowIndex',    name: 'DT_RowIndex'},
                {data:'pickup',     name:'pickup'},
                {data:'dropcity',name:'dropcity'},
                {data:'cab_type',name:'cab_type'},
                {data:'amount',name:'amount'},
                {data:'extra',name:'extra'},
                {data:'kms',name:'kms'},
                {data:'status',name:'status'},
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

        var url = '{{route("localdetails.deleteAll")}}';
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
