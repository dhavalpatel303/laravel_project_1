@include('layouts._top_bar')
<head>
    <title>{{helpers::name()}} | Edit Onewaydetails</title>
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
                            <h2 class="content-header-title float-start mb-0">Edit Oneway Details</h2>

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
                                        <div class="row col-md-12">
                                            {!! Form::open(array('route' => 'onewaydetails.update','class'=>'form form-horizontal row','id'=>'onewayform','method'=>'post','files' => 'true','enctype'=>'multipart/form-data')) !!}
                                            <div class="col-3  mobile-width">
                                                <div class="mb-1 row">

                                                        <div class="col-sm-12">
                                                        <label class="col-form-label" for="fname-icon">Pickup City</label>
                                                        <input type="text" class="form-control" value="{{$pcity_id->pick_city}}" readonly>

                                                        </div>


                                                    </div>
                                            </div>
                                            <div class="col-3  mobile-width">
                                                <div class="mb-1 row" style="margin-top: 15px;">

                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="selectLarge">Drop City</label>
                                                        <input type="text" class="form-control" id="dcity_id" name = "dcity_id" value="{{$dcity_id->drop_city}}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3  mobile-width">
                                                <div class="mb-1 row" style="margin-top: 15px;">

                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="selectLarge">Total Km</label>
                                                        <input type="text" class="form-control" id="km" name = "km" value="{{$total_km}}">
                                                    </div>
                                                </div>
                                            </div><div class="col-3  mobile-width">
                                                <div class="mb-1 row" style="margin-top: 15px;">

                                                    <div class="form-group">
                                                        <input id="demo-remember-me-5" type="checkbox"   name="popular_routes" id="popular_routes" value="Yes">
                                                        <label >Set As Popular Routes</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php for($i=0;$i<count($onewaydetails);$i++) {?>
                                                <div class="row col-md-12">

                                                {{-- {!! Form::model($onewaydetails, ['method' => 'Patch','class'=>'row','route' => ['onewaydetails.update', $onewaydetails[$i]['id']]]) !!} --}}
                                                        <input type="hidden" id="rate_card_id" name="rate_card_id[]" class="form-control" value="{{$onewaydetails[$i]['id']}}">

                                                        <div class="col-2  mobile-width" style="width:20%">
                                                        <div class="mb-1 row" style="margin-top: 15px;">

                                                            <div class="col-sm-12">
                                                                <label class="form-label" for="selectLarge">Cab Type</label>
                                                                <input type="text" class="form-control"  value="{{$onewaydetails[$i]['cab_type']}}" readonly>
                                                                <input type="hidden" id="cab_type" name="cab_type[]" class="form-control" value="{{$onewaydetails[$i]['cab_type']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="pcity_id" id="pcity_id" value="{{$pcity_id->id}}">
                                                    <input type="hidden" name="dcity_id" id="dcity_id" value="{{$dcity_id->id}}">
                                                    <input type="hidden" name="dcity_id" id="dcity_id" value="{{$onewaydetails[$i]['km']}}">
                                                    <div class="col-2  mobile-width" style="width:20%">
                                                        <div class="mb-1 row" style="margin-top: 15px;">

                                                            <div class="col-sm-12">
                                                                <label class="form-label" for="selectLarge">Amount</label>

                                                                <div class="input-group input-group-merge">
                                                                    {{-- <input type="text"  class="form-control" value="{{$onewaydetails[$i]['amount']}}"> --}}
                                                                    <input type="text" name="amount[]" id="amount" class="form-control"  value="{{$onewaydetails[$i]['amount'], ''.$onewaydetails[$i]['amount'].''}}">
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

                                                                    <input type="text" name="tax[]" id="tax" class="form-control" value="{{$onewaydetails[$i]['tax'], ''.$onewaydetails[$i]['tax'].''}}">
                                                                </div>
                                                                <div><span style="color:red">{{  $errors->first('tall_tax') }}</span></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-2  mobile-width" style="width:20%">
                                                        <div class="mb-1 row">

                                                            <div class="col-sm-12">
                                                                    <label class="col-form-label" for="demo-form-checkbox-1">State Tax</label>
                                                                <input type="text" name="state_tax[]" id="state_tax" class="form-control" value="{{$onewaydetails[$i]['state_tax'], ''.$onewaydetails[$i]['state_tax'].''}}">
                                                                 <div><span style="color:red">{{  $errors->first('state_tax') }}</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2  mobile-width" style="width:20%">
                                                        <div class="mb-1 row">

                                                            <div class="col-sm-12">
                                                                    <label class="col-form-label" for="demo-form-checkbox-1">Driver</label>
                                                                <input type="text" name="driver_allowance[]" id="driver_allowance" class="form-control" value="{{$onewaydetails[$i]['driver_allowance'], ''.$onewaydetails[$i]['driver_allowance'].''}}">
                                                                <div><span style="color:red">{{  $errors->first('driver_allownce') }}</span></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            <?php }?>
                                            <div class="col-sm-12 offset-sm-4 ">
                                                <a  ><button type="sumbit" class="btn btn-primary me-1" >Update</button></a>

                                                <a  id="close"><button type="button"  class="btn btn-danger me-1">Cancel</button></a>
                                            </div>
                                            {!!Form::close()!!}
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
                    url:"{{route('onewaydetails.updateDropcity')}}",
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
    $(document).ready(function() {

        $('#tall_tax_input').hide();

       $('#demo-form-checkbox-1').click(function(){
        $('#tall_tax_input').toggle();
            $('#tall_tax_include').toggle();

        });


    });
    </script>
     <script>
        $(document).ready(function() {

            $('#state_tax_input').hide();

           $('#demo-form-checkbox-2').click(function(){
            $('#state_tax_input').toggle();
                $('#state_tax_include').toggle();

            });


        });
        </script>
     <script>
        $(document).ready(function() {

            $('#driver_aloownce_input').hide();

           $('#demo-form-checkbox-3').click(function(){
            $('#driver_aloownce_input').toggle();
                $('#driver_allownce_include').toggle();

            });


        });
        </script>
<script type="text/javascript">



    function getCab(val) {

            var errMsg = "already exists!"
            var msg  = $("#cab-msg").text('');
            var pcity_id = $("#pcity_id").val();
            var dcity_id = $("#dcity_id").val();
            var value = val;

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

                    } else {

                    $("#pcity_id").val('');
                    $("#dcity_id").val('');
                    $("#cab_type").val('');
                    $("#cab-msg").html(errMsg);
                    }
            }
        });
            return false;
        }
</script>
<script>
    $("#close").click(function(){

  window.location.replace('{{route('onewaydetails.index')}}');
  });
</script>
</body>
<!-- END: Body-->


