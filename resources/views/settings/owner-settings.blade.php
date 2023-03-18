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
                <h4>owner settings</span></h4>
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
                        <h5 class="card-title">Owner Details</h5>
                    </div>
                    <span class="block-border"></span>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{url('settings/save-settings')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label d-block font-weight-semibold">Account Name</label>
                                        <input type="text" class="form-control" name="account_name" id="account_name" value="@if(isset($setting['account_name'])){{$setting['account_name']->option_value}}@endif">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label d-block font-weight-semibold">Account Email</label>
                                        <input type="email" name="account_email" id="account_email" class="form-control" value="@if(isset($setting['account_email'])){{$setting['account_email']->option_value}}@endif">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label d-block font-weight-semibold">Account Phone.</label>
                                        <input type="text" class="form-control" name="account_phone" id="account_phone" onkeypress="return isNumber(event)" value="@if(isset($setting['account_phone'])){{$setting['account_phone']->option_value}}@endif" placeholder="Account Phone" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label d-block font-weight-semibold">Account Prefix</label>
                                        <input type="text" class="form-control" name="prefix" id="prefix" value="@if(isset($setting['prefix'])){{$setting['prefix']->option_value}}@endif" placeholder="Account Prefix">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-dark btn-setting" onclick="submit_form('setting-form1');">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->
@stop
@section('footer-content')
    <!-- custom js -->

    <!-- \custom js -->
@stop