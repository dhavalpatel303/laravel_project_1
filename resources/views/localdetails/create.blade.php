<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Create Local Package</title>
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
                        <h4 class="page-title">Add Local Package</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add New Local Package</li>
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
                            {!! Form::open(array('route' => 'localdetails.store','class'=>'form form-horizontal','id'=>'localform','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}

                            <div class="form-body">
                                <div class="card-body">
                                    <div id="client_detail" class="boder_divider">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Pickup City<span class="red">*</span></label>
                                                    {!! Form::select('pcity_id', $pick_city,[], array('class' => 'form-control','placeholder'=>'Select From City','id'=>'pcity_id','for'=>'select2-basic','requried'=>'true')) !!}

                                                </div>
                                                <div><span style="color:red">{{  $errors->first('pick_city') }}</span></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Drop City<span class="red">*</span></label>
                                                    <select class="form-control" name ="dropcity" id="dropcity" required="true">
                                                    <option>Select Local Package</option>
                                                        <?php for($i=0; $i<count($package); $i++) {?>
                                                            <option value={{$package[$i]['id']}}>
                                                                <span>{{$package[$i]['local_package']}}</span>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div><span style="color:red">{{  $errors->first('drop city') }}</span></div>
                                            </div>


                                        </div>
                                    </div>
                                    <label id="cab-msg" class="control-label" style="color: red;font-weight:900"></label>



                                    <div><span style="color:red">{{  $errors->first('cab_type') }}</span></div>
                                    <?php for($i=0;$i<count($cab_data);$i++) {?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="hidden" id="rate_card_id" name="rate_card_id[]" class="form-control" value="{{$cab_data[$i]['id']}}">
                                                @if($cab_data[$i]['cab_status']=='1')
                                                <label class="form-label l1" for="selectLarge">Cab Type</label>
                                                <input type="text"  class="form-control" value="{{$cab_data[$i]['cab']}}" placeholder="Enter a Cab Name" readonly>
                                                <input type="hidden" id="cab_type" name="cab_type[]" class="form-control" value="{{$cab_data[$i]['id']}}" placeholder="Enter a Cab Name" readonly>
                                                @else


                                                @endif

                                            </div>
                                            @if($cab_data[$i]['cab_status']=='1')
                                            <div class="col-md-3">
                                                <label class="form-label l1" for="selectLarge">Amount</label>
                                                <input type="text" name="amount[]" id="amount" class="form-control"  value="0">
                                                @else

                                                @endif
                                            </div>
                                            @if($cab_data[$i]['cab_status']=='1')
                                            <div class="col-md-3">
                                                <label class="form-label l1" for="selectLarge">Extra Km Rate</label>
                                                <input type="text" id="ekr" name="ekr[]" class="form-control" value="0" placeholder="Enter a Extra KM Rate"   required="true">
                                            </div>
                                            @else

                                            @endif
                                            @if($cab_data[$i]['cab_status']=='1')
                                            <div class="col-md-3">
                                                <label class="form-label l1" for="selectLarge">Extra Hour Rate </label>
                                                <input type="text" id="ehr" name="ehr[]" class="form-control" value="0" placeholder="Enter a Extra Hours Rate"  required="true">
                                            </div>
                                            @else

                                            @endif

                                        </div>

                                        <?php }?>
                                </div>
                                <div class="col-md-12" style="text-align: center">
                                    <div class="form-actions">
                                        <div class="card-body text-center l1">
                                            <button type="button" class="btn btn-success" id="s_button"><i class="fa fa-check"></i> Save</button>
                                            <a href="{{route('localdetails.index')}}" class="btn btn-dark">Cancel</a>
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
    jQuery('#s_button').click(function()

    {
        var pcity_id = $("#pcity_id").val();
    var dcity_id = $("#dropcity").val();

        if(pcity_id=='' || dcity_id=='Select Local Package')
        {
            alert("All Fileds Are Required");
        }
        else{
            $("#localform").submit();
        }


    });
});
</script>

<script>
$("#dropcity").click(function(){
    var errMsg = "This Route Allready Exists Please Select Other Route!"
    var msg  = $("#cab-msg").text('');
    var pcity_id = $("#pcity_id").val();
    var dcity_id = $("#dropcity").val();
    // var value = $("#cab_type").val();


    $.ajax({
      headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: "POST",
        url: "{{route('localbookings.check_cab')}}",
        data:{pcity_id:pcity_id,dcity_id: dcity_id},
        dataType: 'html',
        //data:'dropcity='+val,
        success: function(result) {
            if(result == 0) {
                $("#s_button").show();
            } else {

            $("#pcity_id").val('');
            $("#dropcity").val('');
            $("#cab-msg").html(errMsg);
            $("#s_button").hide();
            setTimeout(function() {
                    location.reload();
                    }, 1000);

            }
    }
});
    return false;
});
</script>




</body>

</html>
