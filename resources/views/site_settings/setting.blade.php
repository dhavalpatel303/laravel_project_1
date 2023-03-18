<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Site Settings</title>
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
                        <h4 class="page-title">Edit Comman Page</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Comman Page</li>
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

                            <div class="card-body">
                                {!! Form::model($data, ['method' => 'PATCH','route' => ['settings.update', $data->id],'files' => 'true','enctype'=>'multipart/form-data']) !!}
                                <div class="form-body">
                                    <div class="card-body">
                                        <div id="client_detail" class="boder_divider">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Site Name<span class="red">*</span></label>
                                                        {!! Form::text('name', null, array('placeholder' => 'Site Name','name'=>'name','class' => 'form-control')) !!}

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Email Id<span class="red">*</span></label>
                                                        {!! Form::email('email', null, array('placeholder' => 'Site Email','name'=>'email','class' => 'form-control')) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Mobile Number<span class="red">*</span></label>
                                                        {!! Form::number('mobile', null, array('placeholder' => 'Mobile Number','name'=>'mobile','class' => 'form-control')) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Alt Mobile</label>
                                                        {!! Form::number('alt_mobile', null, array('placeholder' => 'Alternet Mobile Number','name'=>'alt_mobile','class' => 'form-control')) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>SMS URL<span class="red">*</span></label>
                                                        {!! Form::textarea('url', null, array('placeholder' => 'Sms URL','name'=>'url','class' => 'form-control','rows'=>3)) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        {!! Form::textarea('address', null, array('placeholder' => 'Phone Number','name'=>'address','class' => 'form-control','rows'=>5)) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <!-------------CIN No & GST No--------------->
                                        <div class="boder_divider" id="CIN">
                                            <div class="row pd_top_bottom_25">
                                                <div class="col-lg-12">
                                                    <h4 style="font-weight: bold;">CIN No &amp; GST No</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group property_document_sec">
                                                        <label>CIN No</label>

                                                        {!! Form::text('cin_no', null, array('placeholder' => 'Facebook Link','name'=>'cin_no','class' => 'form-control')) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group property_document_sec">
                                                        <label>GST No</label>
                                                        {!! Form::text('gst_no', null, array('placeholder' => 'Facebook Link','name'=>'gst_no','class' => 'form-control')) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <!-------------Social Media Links--------------->
                                        <div class="boder_divider" id="Social">
                                            <div class="row pd_top_bottom_25">
                                                <div class="col-lg-12">
                                                    <h4 style="font-weight: bold;">Social Media &amp; Map Link</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group property_document_sec">
                                                        <label>Facebook</label>
                                                        {!! Form::text('fb_url', null, array('placeholder' => 'Facebook Link','name'=>'fb_url','class' => 'form-control')) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group property_document_sec">
                                                        <label>Instagram</label>
                                                        {!! Form::text('insta_url', null, array('placeholder' => 'Instagram Link','name'=>'insta_url','class' => 'form-control')) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group property_document_sec">
                                                        <label>Twitter</label>
                                                        {!! Form::text('tweet_url', null, array('placeholder' => 'Twiter Link','name'=>'tweet_url','class' => 'form-control')) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group property_document_sec">
                                                        <label>LinkedIn</label>
                                                        {!! Form::text('youtube_url', null, array('placeholder' => 'linkedIn_link','name'=>'youtube_url','class' => 'form-control')) !!}
                                                        {{-- <input type="url" name="linkedIn_link" id="linkedIn_link" class="form-control" value="https://www.linkedin.com/company/honor-cab-service/?originalSubdomain=in" placeholder="linkedIn Link" /> --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group property_document_sec">
                                                        <label>Google Map</label>
                                                        {!! Form::text('map_url', null, array('placeholder' => 'Phone Number','name'=>'map_url','class' => 'form-control')) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <!-------------Logo & Favicon & Signature Upload--------------->
                                        <div class="boder_divider" id="Logo">
                                            <div class="row pd_top_bottom_25">
                                                <div class="col-lg-12">
                                                    <h4 style="font-weight: bold;">Logo &amp; Favicon &amp; Signature</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Upload Logo (Allowed : jpg | jpeg | png)</label>

                                                    <input type="file" name="site_logo" id="site_logo" class="form-control" style="height: 41px;"  />
                                                </div>
                                                <div class="col-md-6">
                                                    <img src="{{asset('logo/'.$data->site_logo)}}" style="width: 110px;" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Upload Favicon (Allowed : jpg | jpeg | png | Ico)</label>
                                                    <input type="file" name="favicon" id="favicon" class="form-control" style="height: 41px;" />
                                                </div>
                                                <div class="col-md-6">
                                                    <img src="{{asset('logo/'.$data->favicon)}}" style="width: 45px;" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Upload Signature (Allowed : jpg | jpeg | png | Ico)</label>
                                                    <input type="file" name="signature" id="signature" class="form-control" style="height: 41px;" />
                                                </div>
                                                <div class="col-md-6">
                                                    <img src="{{asset('logo/'.$data->signature)}}" style="width: 150px;" />
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                    <div class="form-actions">
                                        <div class="card-body text-center">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
                                            <a href="{{route('home')}}" class="btn btn-dark">Cancel</a>
                                            <label class="label" style="color: red; font-weight: 600;">(*) Mendatory fields</label>
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
    </div>
    <div class="chat-windows"></div>
   @include('layouts._footer')
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
               ajax: "{{ route('users.index') }}",
               columns: [
                   {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
                   {data: 'DT_RowIndex',    name: 'DT_RowIndex'},
                   {data: 'name',           name: 'name'},
                   {data: 'email',           name: 'email'},
                   {data: 'user_mobile',           name: 'user_mobile'},
                   {data: 'created_at',           name: 'created_at'},
                   {data:'action',name:'action'},


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

              var url = '{{route("users.deleteAll")}}';
              if(checkedcity.length > 0)
              {

                  swal.fire({
                      title:'Are You Sure?',
                      html:'You want to delete <b>('+checkedcity.length+')</b>User data',
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

</html>
