@extends('layouts.app')

@section('extra-header-file')
<!-- Theme JS files -->

<!-- Theme JS files -->
<script src="{{url('uploads/assets/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script src="{{url('uploads/assets/js/app.js')}}"></script>
<script src="{{url('uploads/assets/global_assets/js/demo_pages/form_inputs.js')}}"></script>
<script src="{{url('uploads/assets/js/custom.js')}}"></script>
<!-- /theme JS files -->
@stop

@section('content')
	
	<!-- Page header -->
	<div class="page-header border-bottom-0">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>Common Metadata</span></h4>
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
		                <h5 class="card-title">Common Metadata</h5>
		            </div>
		            <span class="block-border"></span>
		            <div class="card-body">
		                <form method="post" enctype="multipart/form-data" action="{{url('settings/save-settings')}}">
		                    @csrf
		                    <div class="row">
		                        <div class="col-lg-12">
		                            <div class="form-group">
		                                <label class="col-form-label d-block font-weight-semibold">Meta Title</label>
		                                <input type="text" class="form-control" name="meta_title" id="meta_title" value="@if(isset($setting['meta_title'])){{$setting['meta_title']->option_value}}@endif" placeholder="Meta Title">
		                            </div>
		                        </div>
		                        <div class="col-lg-12">
		                            <div class="form-group">
		                                <label class="col-form-label d-block font-weight-semibold">Meta Keyword</label>
		                                <input type="text" name="meta_keyword" id="meta_keyword" class="form-control token-field" value="@if(isset($setting['meta_keyword'])){{$setting['meta_keyword']->option_value}}@endif" placeholder="Meta Keyword">
		                            </div>
		                        </div>
		                        <div class="col-lg-12">
		                            <div class="form-group">
		                                <label class="col-form-label d-block font-weight-semibold">Meta Description</label>
		                                <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Meta Description">@if(isset($setting['meta_description'])){{$setting['meta_description']->option_value}}@endif</textarea>
		                            </div>
		                        </div>
		                    </div>
		                    <button type="submit" class="btn bg-dark btn-setting" onclick="submit_form('setting-form6');">Update</button>
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