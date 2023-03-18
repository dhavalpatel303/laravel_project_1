    <!DOCTYPE html>
    <html dir="ltr" lang="en">
        <head>
            <title>{{helpers::name()}} | Create Onewaudetails</title>
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
                            <h4 class="page-title">Add Oneway Route</h4>
                            <div class="d-flex align-items-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add New Oneway Route</li>
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
                                {!! Form::open(array('route' => 'onewaydetails.store','class'=>'form form-horizontal','id'=>'onewayform','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}


                                <div class="form-body">
                                    <div class="card-body">
                                        <div id="client_detail" class="boder_divider" style="margin-bottom: -20px">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Pickup City<span class="red">*</span></label>
                                                        {!! Form::select('pcity_id', $pick_city,[], array('class' => 'form-control','id'=>'pcity_id','for'=>'select2-basic','placeholder'=>'Select Pickup City','required'=>'true')) !!}
                                                        <label id="error_1"></label>
                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Drop City<span class="red">*</span></label>
                                                        <select class="form-control" name ="dcity_id" id="dcity_id" required="true" placeholder="Select  Drop City">
                                                            <option value="" >Select Drop City</option>
                                                            </select>
                                                            <label id="error_2"></label>
                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Total Km<span class="red">*</span></label>
                                                        <input type="text" id="km" name="km" placeholder="Estimate Km" class="form-control" readonly>
                                                        <label id="error_3"></label>
                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Time<span class="red">*</span></label>
                                                        <input type="text" id="time" name="time" placeholder="Estimate Time" class="form-control" readonly>
                                                        <label id="error_4"></label>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <label id="cab-msg" class="control-label" style="color: red;font-weight:900"></label>



                                        <div><span style="color:red">{{  $errors->first('cab_type') }}</span></div>
                                        <?php for($i=0;$i<count($cab_data);$i++) {?>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="hidden" id="rate_card_id" name="rate_card_id[]" class="form-control" value="{{$cab_data[$i]['id']}}">
                                                    @if($cab_data[$i]['cab_status']=='1')
                                                    <label class="form-label l1" for="selectLarge">Cab Type</label>
                                                    <input type="text" class="form-control"  value="{{$cab_data[$i]['cab']}}" readonly>
                                                    <input type="hidden" id="cab_type" name="cab_type[]" class="form-control" value="{{$cab_data[$i]['id']}}">

                                                    @else
                                                    <input type="hidden" id="cab_type" name="cab_type[]" class="form-control" value="{{$cab_data[$i]['id']}}">


                                                    @endif

                                                </div>
                                                @if($cab_data[$i]['cab_status']=='1')
                                                <div class="col-md-4">
                                                    <label class="form-label l1" for="selectLarge">Base Fare</label>
                                                    <input type="text" name="amount[]" id="amount" class="form-control"  value="0">
                                                    @else
                                                    <input type="hidden" name="amount[]" id="amount" class="form-control"  value="0">
                                                    @endif
                                                </div>
                                                @if($cab_data[$i]['cab_status']=='1')
                                                <div class="col-md-4">
                                                    <label class="form-label l1" for="selectLarge">Fare Per Km</label>
                                                    <input type="text" name="km_rate[]" id="km_rate" class="form-control"  value="0">
                                                    @else
                                                    <input type="hidden" name="km_rate[]" id="km_rate" class="form-control"  value="0">
                                                    @endif
                                                </div>




                                            </div>

                                            <?php }?><br><br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline">
                                                        <div class="custom-control custom-checkbox">
                                                            <br>
                                                            <input type="checkbox" name="popular_routes" class="custom-control-input" id="customCheck1" value="Yes">
                                                            <label class="custom-control-label" for="customCheck1">Set As Popular Routes</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Toll Tax<span class="red">*</span></label>
                                                        <input type="text" id="tax" name="tax" placeholder="Toll Tax" class="form-control">
                                                        <label id="error_5"></label>
                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>State Tax<span class="red">*</span></label>
                                                        <input type="text" id="state_tax" name="state_tax" placeholder="State Tax" class="form-control">
                                                        <label id="error_6"></label>
                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Driver Allowance<span class="red">*</span></label>
                                                        <input type="text" id="driver_allowance" name="driver_allowance" placeholder="Driver Allowance" class="form-control">
                                                        <label id="error_7"></label>
                                                    </div>

                                                </div>
                                            </div>
                                    </div>

                                    <div class="col-md-12" style="text-align: center">
                                        <div class="form-actions">
                                            <div class="card-body text-center l1">
                                                <button type="button" class="btn btn-success" id="s_button"><i class="fa fa-check"></i> Save</button>
                                                <a href="{{route('onewaydetails.index')}}" class="btn btn-dark">Cancel</a>
                                                <label class="label" style="color: red; font-weight: 600;">(*) Mendatory fields</label>
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
    <script>
            $(window).on("load", function () {
                if (feather) {
                    feather.replace({ width: 14, height: 14 });
                }
            });
        </script>
            <script>
                jQuery(document).ready(function(){
                    jQuery('#pcity_id').change(function()

                    {
                        let pid=jQuery(this).val();
                        jQuery.ajax({
                            url:"{{route('onewaydetails.getDropcity')}}",
                            type:'post',
                            data:'pid='+pid+
                            '&_token={{csrf_token()}}',
                            success:function(result){
                                if(result==0){
                                    alert('select Other City')
                                }else{
                                    jQuery('#dcity_id').html(result)
                                }

                            }
                        });
                    });
                });
            </script>

    <script>
        jQuery(document).ready(function(){
            jQuery('#s_button').click(function()

            {
                var pcity_id = $("#pcity_id").val();
                var dcity_id = $("#dcity_id").val();
                var km = $("#km").val();
                var time = $("#time").val();
                var tax = $("#tax").val();
                var state_tax = $('#state_tax').val();
                var driver_allowance = $('#driver_allowance').val();
                if(pcity_id=='' || dcity_id=='' || km==''||time==''||tax==''||state_tax==''||driver_allowance=='')
                {
                          $("#error_1").css({"color":"red"});
                            $("#error_1").css({"font-weight":"800"});
                            $("#error_1").css({"font-size":"14px"});
                            $("#error_1").html("The Pickup City is required.");

                            $("#error_2").css({"color":"red"});
                            $("#error_2").css({"font-weight":"800"});
                            $("#error_2").css({"font-size":"14px"});
                            $("#error_2").html("The Drop City required.");

                            // $("#error_3").css({"color":"red"});
                            // $("#error_3").css({"font-weight":"800"});
                            // $("#error_3").css({"font-size":"14px"});
                            // $("#error_3").html("The Total Km is required.");

                            // $("#error_4").css({"color":"red"});
                            // $("#error_4").css({"font-weight":"800"});
                            // $("#error_4").css({"font-size":"14px"});
                            // $("#error_4").html("The Journy Time required.");

                            $("#error_5").css({"color":"red"});
                            $("#error_5").css({"font-weight":"800"});
                            $("#error_5").css({"font-size":"14px"});
                            $("#error_5").html("The Toll Tax required.");

                            $("#error_6").css({"font-weight":"800"});
                            $("#error_6").css({"font-size":"14px"});
                            $("#error_6").html("The State Tax is required.");
                            $("#error_6").css({"color":"red"});

                            $("#error_7").css({"font-weight":"800"});
                            $("#error_7").css({"font-size":"14px"});
                            $("#error_7").html("The Driver Allowance required.");
                            $("#error_7").css({"color":"red"});

                }
                else{
                    $("#onewayform").submit();
                }
            });
        });
    </script>
    <script>
            $("#dcity_id").click(function(){
                
                var msg  = $("#cab-msg").text('');
                var pcity_id = $("#pcity_id").val();

                var dcity_id = $("#dcity_id").val();
                // alert(dcity_id);

 
                $.ajax({
                headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: "POST",
                    url: "{{route('onewaydetails.estimate')}}",
                    data:{pcity_id:pcity_id,dcity_id: dcity_id},
                    dataType: "json",
                    //data:'dropcity='+val,
                    success: function(data) {
                        if(data.value_null) {
                            alert('Please Try Another Cab !');

                            } else {
                                // alert("hello");
                                jQuery('#km').val(data.distance);
                                jQuery('#time').val(data.time)
                               
                            }
                }
            });
                return false;
    });
    </script>
     <script>
            $("#dcity_id").change(function(){
                // var errMsg = "This Route Allready Exists Please Select Other Route!"
                var msg  = $("#cab-msg").text('');
                var pcity_id = $("#pcity_id").val();

                var dcity_id = $("#dcity_id").val();
                // alert(dcity_id);

 
                $.ajax({
                headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: "POST",
                    url: "{{route('onewaydetails.check_cab')}}",
                    data:{pcity_id:pcity_id,dcity_id: dcity_id},
                    dataType: "json",
                    //data:'dropcity='+val,
                     success:function(result){
                        if(result==0){
                            alert('This Route All Ready Exits Please Try Other Route');
                            location.reload();
                        }else{
                           
                        }
                }
            });
                return false; 
    });
    </script>

    <script>
        $("#close").click(function(){

    window.location.replace('{{route('onewaydetails.index')}}');
    });
    </script>



<script>
    $("#pcity_id").change(function(){
      if($("#pcity_id").val()=='')
      {
          $("#error_1").show();
      }
      else{
          $("#error_1").hide();
          // $("#change_pass").hide();
      }

  });
  $("#dcity_id").change(function(){

      if($("dcity_id").val()=='')
      {
          $("#error_2").show();
      }
      else{
          $("#error_2").hide();
      }

  });
  $("#km").change(function(){
      if($("#km").val()=='')
      {
          $("#error_3").show();
      }
      else{
          $("#error_3").hide();
      }

  });
  $("#time").change(function(){
      if($("#time").val()=='')
      {
          $("#error_4").show();
      }
      else{
          $("#error_4").hide();
      }

  });
  $("#tax").change(function(){
      if($("#tax").val()=='')
      {
          $("#error_5").show();
      }
      else{
          $("#error_5").hide();
      }

  });
  $("#state_tax").change(function(){
      if($("#state_tax").val()=='')
      {
          $("#error_6").show();
      }
      else{
          $("#error_6").hide();
      }

  });
  $("#driver_allowance").change(function(){
      if($("#driver_allowance").val()=='')
      {
          $("#error_7").show();
      }
      else{
          $("#error_7").hide();
      }

  });

</script>

    </body>

    </html>
