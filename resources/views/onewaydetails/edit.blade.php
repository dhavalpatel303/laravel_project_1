<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Edit Onewaudetails</title>
    </head>
    @include('layouts._top_bar')
    <?php use App\Onewaydetails;?>

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
                            <h4 class="page-title">Edit Oneway Route</h4>
                            <div class="d-flex align-items-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Oneway Route</li>
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
                                {!! Form::open(array('route' => 'onewaydetails.update','class'=>'form form-horizontal row','id'=>'onewayform','method'=>'post','files' => 'true','enctype'=>'multipart/form-data')) !!}

                                <div class="form-body">
                                    <div class="card-body">
                                        <div id="client_detail" class="boder_divider">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Pickup City<span class="red">*</span></label>
                                                        <input type="text" class="form-control" value="{{$pcity_id->pick_city}}" readonly />
                                                        <input type="hidden" class="form-control" id="pcity_id" name="pcity_id" value="{{$pcity_id->id}}" readonly />
                                                    </div>
                                                    <div><span style="color: red;">{{ $errors->first('pick_city') }}</span></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Drop City<span class="red">*</span></label>
                                                        <input type="text" class="form-control" value="{{$dcity_id->drop_city}}" readonly />
                                                        <input type="hidden" class="form-control" id="dcity_id" name="dcity_id" value="{{$dcity_id->id}}" readonly />
                                                    </div>
                                                    <div><span style="color: red;">{{ $errors->first('drop city') }}</span></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Total Km<span class="red">*</span></label>
                                                        <input type="text" class="form-control" id="km" name="km" value="{{$total_km}}" readonly />
                                                    </div>
                                                    <div><span style="color: red;">{{ $errors->first('km') }}</span></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Time<span class="red">*</span></label>
                                                        <input type="text" class="form-control" id="time" name="time" value="{{$onewaydetails_km->time}}" readonly />
                                                    </div>
                                                    <div><span style="color: red;">{{ $errors->first('km') }}</span></div>
                                                </div>

                                            </div>
                                        </div>
                                        <label id="cab-msg" class="control-label" style="color: red; font-weight: 900;"></label>

                                        <?php for($i=0;$i<count($cab_data);$i++) {?>

                                        <div><span style="color: red;">{{ $errors->first('cab_type') }}</span></div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label l1" for="selectLarge">Cab Type</label>
                                                <input type="text" class="form-control" value="{{$cab_data[$i]['cab']}}" readonly />
                                                <input type="hidden" id="cab_type" name="cab_type[]" class="form-control" value="{{$cab_data[$i]['id']}}" />
                                            </div>
                                            <?php
                                            $pickup = $pcity_id->id;
                                            $drop = $dcity_id->id;
                                            $cab = $cab_data[$i]['id'];
                                         $onewaydetails = onewaydetails::select('onewaydetails.*')->where('pcity_id',$pickup)->where('dcity_id',$drop)->where('cab_type',$cab)->first();
                                        //  echo $onewaydetails;
                                        ?>
                                            <div class="col-md-4">
                                                <label class="form-label l1" for="selectLarge">Amount</label>
                                                @if($onewaydetails !='' )
                                                <input type="hidden" id="rate_card_id" name="rate_card_id[]" class="form-control" value="{{$onewaydetails->id}}" />
                                                <input type="text" name="amount[]" id="amount" class="form-control left_border" value="{{$onewaydetails->amount}}" />
                                                @else
                                                <input type="text" name="amount[]" id="amount" class="form-control left_border" value="0" />
                                                <input type="hidden" id="rate_card_id" name="rate_card_id[]" class="form-control" value="1" />
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label l1" for="selectLarge">Km Rate</label>
                                                @if($onewaydetails !='' )

                                                <input type="text" name="km_rate[]" id="km_rate" class="form-control left_border" value="{{$onewaydetails->km_rate}}" />
                                                @else
                                                <input type="text" name="km_rate[]" id="km_rate" class="form-control left_border" value="0" />

                                                @endif
                                            </div>
                                        </div>

                                        <?php }?>
                                        <br><br>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-checkbox">
                                                        <br />
                                                        <input type="checkbox" {{ ($onewaydetails_km->popular_routes == 'Yes') ? 'checked' : '' }} name="popular_routes" class="custom-control-input" id="demo-remember-me-5" value="Yes">
                                                        <label class="custom-control-label" for="demo-remember-me-5">Set As Popular Routes</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Toll Tax<span class="red">*</span></label>
                                                    <input type="text" id="tax" name="tax" placeholder="Toll Tax" class="form-control" value="{{$onewaydetails_km->tax}}">
                                                    <label id="error_5"></label>
                                                </div>

                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>State Tax<span class="red">*</span></label>
                                                    <input type="text" id="state_tax" name="state_tax" placeholder="State Tax" class="form-control" value="{{$onewaydetails_km->state_tax}}">
                                                    <label id="error_6"></label>
                                                </div>

                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Driver Allowance<span class="red">*</span></label>
                                                    <input type="text" id="driver_allowance" name="driver_allowance" placeholder="Driver Allowance" class="form-control" value="{{$onewaydetails_km->driver_allowance}}">
                                                    <label id="error_7"></label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="text-align: center;">
                                        <div class="form-actions">
                                            <div class="card-body text-center l1">
                                                <button type="submit" class="btn btn-success" ><i class="fa fa-check"></i> Update</button>
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
            jQuery(document).ready(function () {
                jQuery("#pcity_id").change(function () {
                    let pid = jQuery(this).val();

                    jQuery.ajax({
                        url: "{{route('onewaydetails.getDropcity')}}",
                        type: "post",
                        data: "pid=" + pid + "&_token={{csrf_token()}}",
                        success: function (result) {
                            if (result == 0) {
                                alert("select Other City");
                            } else {
                                jQuery("#dcity_id").html(result);
                            }
                        },
                    });
                });
            });
        </script>

        <script>
            jQuery(document).ready(function () {
                jQuery("#s_button").click(function () {
                    var pcity_id = $("#pcity_id").val();
                    var dcity_id = $("#dcity_id").val();
                    var km = $("#km").val();

                    if (pcity_id == "" || dcity_id == "" || km == "") {
                        alert("All Fileds are Required");
                    } else {
                        $("#onewayform").submit();
                    }
                });
            });
        </script>

        <script>
            $("#dcity_id").click(function () {
                var errMsg = "This Route Allready Exists Please Select Other Route!";
                var msg = $("#cab-msg").text("");
                var pcity_id = $("#pcity_id").val();

                var dcity_id = $("#dcity_id").val();

                $.ajax({
                    headers: {
                        "X-CSRF-Token": $('input[name="_token"]').val(),
                    },
                    type: "POST",
                    url: "{{route('onewaybookings.check_cab')}}",
                    data: { pcity_id: pcity_id, dcity_id: dcity_id },
                    dataType: "html",
                    //data:'dropcity='+val,
                    success: function (result) {
                        if (result == 0) {
                            $("#s_button").show();
                        } else {
                            $("#pcity_id").val("");
                            $("#dcity_id").val("");
                            $("#cab_type").val("");
                            $("#cab-msg").html(errMsg);
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }
                    },
                });
                return false;
            });
        </script>

        <script>
            $("#close").click(function(){

            window.location.replace('{{route('onewaydetails.index')}}');
            });
        </script>
    </body>
</html>
