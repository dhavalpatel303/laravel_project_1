@include('layouts._top_bar')
<head>
    <title>{{helpers::name()}} | Create Onewaydetails</title>
</head>
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left caol-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Create Oneway Details</h2>

                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Horizontal form layout section start -->
                <section id="basic-horizontal-layouts">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Oneway Details</h4>
                                </div>
                                <div class="card-body">
                                    {!! Form::open(array('route' => 'onewaydetails.store','class'=>'form form-horizontal','id'=>'onewayform','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
                                    <div class ="row col-12">
                                        <div class="col-3 mobile-width">
                                            <div class="mb-1">

                                                <div class="col-sm-12" style="margin-top: -14px;">
                                                    <label class="col-form-label oneway" for="fname-icon" style="margin-top:0px;font-weight:bold">Pickup City</label>
                                                    <div class="input-group input-group-merge">

                                                        {!! Form::select('pcity_id', $pick_city,[], array('class' => 'form-select form-select-lg','id'=>'pcity_id','for'=>'select2-basic','placeholder'=>'Select Pickup City','required'=>'true')) !!}
                                                    </div>
                                                    <div><span style="color:red">{{  $errors->first('pick_city') }}</span></div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-3 mobile-width">
                                            <div class="mb-1">

                                                <div class="col-sm-12">
                                                    <label class="form-label" for="selectLarge" style="font-weight:bold;">Drop City</label>
                                                    <select class="form-select form-select-lg" name ="dcity_id" id="dcity_id" required="true" placeholder="Select  Drop City">
                                                    <option value="" >Select Drop City</option>
                                                    </select>
                                                </div>
                                                <div><span style="color:red">{{  $errors->first('drop city') }}</span></div>
                                            </div>

                                        </div>
                                        <div class="col-3 mobile-width">
                                            <div class="mb-1">

                                                <div class="col-sm-12" style="margin-top: -14px;">
                                                    <label class="col-form-label oneway" for="fname-icon" style="margin-top:0px;font-weight:bold">Total Km</label>
                                                    <div class="input-group input-group-merge">

                                                        {!! Form::text('km', null, array('placeholder' => 'Enter Total Km','id'=>'km','class' => 'form-control')) !!}
                                                    </div>
                                                    <div><span style="color:red">{{  $errors->first('km') }}</span></div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-3 mobile-width" style="margin-top: 30px;">
                                            <div class="mb-1">
                                                <div class="form-group">
                                                    <input id="demo-remember-me-5" class="form-check-input" type="checkbox" name="popular_routes" value="Yes">
                                                    <label for="demo-remember-me-5">Set As Popular Routes</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <label id="cab-msg" class="control-label" style="color: red;font-weight:900"></label>



                                    <div><span style="color:red">{{  $errors->first('cab_type') }}</span></div>
                                    <?php for($i=0;$i<count($cab_data);$i++) {?>
                                        <div class="row col-md-12">
                                           {{-- @if($onewaydetails[$i]['cab_type'] == $cab_data[$i]['id'])

                                                return "Hello";

                                            @else
                                                return "error";
                                            @endif --}}
                                        {{-- {!! Form::model($onewaydetails, ['method' => 'Patch','class'=>'row','route' => ['onewaydetails.update', $onewaydetails[$i]['id']]]) !!} --}}
                                                <input type="hidden" id="rate_card_id" name="rate_card_id[]" class="form-control" value="{{$cab_data[$i]['id']}}">

                                                <div class="col-2  mobile-width" style="width:20%">
                                                <div class="mb-1 row" style="margin-top: 15px;">

                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="selectLarge">Cab Type</label>
                                                        <input type="text" class="form-control"  value="{{$cab_data[$i]['cab']}}" readonly>
                                                        <input type="hidden" id="cab_type" name="cab_type[]" class="form-control" value="{{$cab_data[$i]['id']}}">
                                                        <input type="hidden" id="km_rate" name="km_rate[]" class="form-control" value="{{$cab_data[$i]['km_rate']}}">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <input type="hidden" name="pcity_id" id="pcity_id" value="{{$pcity_id->id}}">
                                            <input type="hidden" name="dcity_id" id="dcity_id" value="{{$dcity_id->id}}"> --}}

                                            <div class="col-2  mobile-width" style="width:20%">
                                                <div class="mb-1 row" style="margin-top: 15px;">

                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="selectLarge">Amount</label>

                                                        <div class="input-group input-group-merge">
                                                            {{-- <input type="text"  class="form-control" value="{{$cab_data[$i]['amount']}}"> --}}
                                                            <input type="text" name="amount[]" id="amount" class="form-control"  value="{{$cab_data[$i]['amount'], ''.$cab_data[$i]['amount'].''}}">
                                                        </div>
                                                        <span style="color:red">{{  $errors->first('amount') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2  mobile-width" style="width:20%">
                                                <div class="mb-1 row">

                                                    <div class="col-sm-12">
                                                            <label class="col-form-label" for="demo-form-checkbox-1">Toll Tax</label>

                                                        <div class="input-group input-group-merge">

                                                            <input type="text" name="tax[]" id="tax" class="form-control" value="{{$cab_data[$i]['tax'], ''.$cab_data[$i]['tax'].''}}">
                                                        </div>
                                                        <div><span style="color:red">{{  $errors->first('tall_tax') }}</span></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-2  mobile-width" style="width:20%">
                                                <div class="mb-1 row">

                                                    <div class="col-sm-12">
                                                            <label class="col-form-label" for="demo-form-checkbox-1">State Tax</label>
                                                        <input type="text" name="state_tax[]" id="state_tax" class="form-control" value="{{$cab_data[$i]['state_tax'], ''.$cab_data[$i]['state_tax'].''}}">
                                                        <div><span style="color:red">{{  $errors->first('state_tax') }}</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2  mobile-width" style="width:20%">
                                                <div class="mb-1 row">

                                                    <div class="col-sm-12">
                                                            <label class="col-form-label" for="demo-form-checkbox-1">Driver Allowance</label>
                                                        <input type="text" name="driver_allowance[]" id="driver_allowance" class="form-control" value="{{$cab_data[$i]['driver_allowance'], ''.$cab_data[$i]['driver_allowance'].''}}">
                                                        <div><span style="color:red">{{  $errors->first('driver_allownce') }}</span></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    <?php }?>
                                    {{-- <div class="col-3 mobile-width" style="margin-top: 30px;">
                                        <div class="mb-1">
                                            <div class="form-group">
                                                <input id="demo-remember-me-5" class="form-check-input" type="checkbox" {{ ($cab_data_km->popular_routes == 'Yes') ? 'checked' : '' }} name="popular_routes" value="Yes">
                                                <label for="demo-remember-me-5">Set As Popular Routes</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-12" style="text-align: center">
                                        <a  ><button type="button"  id="s_button"class="btn btn-primary me-1" >Submit</button></a>

                                        <a  id="close"><button type="button"  class="btn btn-danger me-1">Cancel</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @include('layouts._footer')
    <script src="{{asset('app-assets/js/scripts/forms/form-select2.min.js')}}"></script>
    <!-- BEGIN: Page Vendor JS-->

    <!-- END: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <!-- END: Page JS-->

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

            var amount = $("#amount").val();
            var toll = $("#tax").val();
            var state = $("#state_tax").val();
            var driver = $("#driver_allowance").val();
            if(amount=='' || toll=='' ||state=='' ||driver=='')
            {
                alert("Please Select Minimum One Filed");
            }
            else{
                $("#onewayform").submit();
            }

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
        $("#dcity_id").click(function(){
            var errMsg = "This Route Allready Exists Please Select Other Route!"
            var msg  = $("#cab-msg").text('');
            var pcity_id = $("#pcity_id").val();
            var dcity_id = $("#dcity_id").val();
            var value = $("#cab_type").val();


            $.ajax({
              headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                type: "POST",
                url: "{{route('onewaybookings.check_cab')}}",
                data:{pcity_id:pcity_id,dcity_id: dcity_id,value:value},
                dataType: 'html',
                //data:'dropcity='+val,
                success: function(result) {
                    if(result == 0) {
                        $("#s_button").show();
                    } else {

                    $("#pcity_id").val('');
                    $("#dcity_id").val('');
                    $("#cab_type").val('');
                    $("#cab-msg").html(errMsg);
                    $("#s_button").hide();

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

</body>
<!-- END: Body-->


