@extends('layouts.app')

@section('extra-header-file')
<!-- Theme JS files -->

<!-- Theme JS files -->
<script src="{{url('uploads/assets/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script src="{{url('uploads/assets/js/app.js')}}"></script>
<script src="{{url('uploads/assets/js/custom.js')}}"></script>
<!-- /theme JS files -->
@stop

@section('content')
    
    
    <!-- Page header -->
    <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4>store settings</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content pt-0">
        <div class="row">
            <div class="col-md-6">              
                <div class="card">
                    <div class="card-header header-elements-inline bg-dark">
                        <h5 class="card-title">Store Information</h5>
                    </div>
                    <span class="block-border"></span>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{url('settings/save-settings')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label d-block font-weight-semibold">Store Name</label>
                                        <input type="text" class="form-control" name="store_name" id="store_name" placeholder="Store Name" value="@if(isset($setting['store_name'])){{$setting['store_name']->option_value}}@endif">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label d-block font-weight-semibold">Business Name</label>
                                        <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Business Name" value="@if(isset($setting['business_name'])){{$setting['business_name']->option_value}}@endif">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label d-block font-weight-semibold">Business Phone</label>
                                        <input type="text" class="form-control" name="business_phone" id="business_phone" placeholder="Business Phone" onkeypress="return isNumber(event)" maxlength="10" value="@if(isset($setting['business_phone'])){{$setting['business_phone']->option_value}}@endif">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label d-block font-weight-semibold">Whatsapp Phone</label>
                                        <input type="text" class="form-control" name="whatsapp_phone" id="whatsapp_phone" placeholder="Whatsapp Phone" onkeypress="return isNumber(event)" maxlength="10" value="@if(isset($setting['whatsapp_phone'])){{$setting['whatsapp_phone']->option_value}}@endif">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label d-block font-weight-semibold">Helpline Phone</label>
                                        <input type="text" class="form-control" name="helpline_no" id="helpline_no" placeholder="Helpline Phone" onkeypress="return isNumber(event)" maxlength="10" value="@if(isset($setting['helpline_no'])){{$setting['helpline_no']->option_value}}@endif">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label d-block font-weight-semibold">Address</label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="@if(isset($setting['address'])){{$setting['address']->option_value}}@endif">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label d-block font-weight-semibold">City Name</label>
                                        <input type="text" class="form-control" placeholder="City" name="city" id="city" placeholder="City name" value="@if(isset($setting['city'])){{$setting['city']->option_value}}@endif">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label d-block font-weight-semibold">State Name</label>
                                        <input type="text" class="form-control" placeholder="State" name="state" id="state" placeholder="State name" value="@if(isset($setting['state'])){{$setting['state']->option_value}}@endif">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label d-block font-weight-semibold">Zip Code</label>
                                        <input type="text" class="form-control" placeholder="ZIP" name="zip" id="zip" placeholder="Zip Code" onkeypress="return isNumber(event)" maxlength="6" value="@if(isset($setting['zip'])){{$setting['zip']->option_value}}@endif">
                                    </div>
                                </div>
                                
                            </div>
                            <button type="submit" class="btn bg-dark btn-setting mt-10" onclick="submit_form('setting-form2');">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->
@stop
@section('footer-content')

@stop