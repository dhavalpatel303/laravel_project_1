@extends('layouts.app')

@section('style')
<style type="text/css">
</style>
@endsection

@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-brain mr-2"></i> <span class="font-weight-semibold">View User</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Users Management</span>
                </div>
            </div>
    </div>
</div>
<!-- /page header -->
<!-- Page content -->
<div class="page-content pt-0">
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Content area -->
        <div class="content">
            <div class="row">
               <div class=" card col-md-6 b1">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Subject :</td>
                                <td>  {{ $getrecord->subject }}</td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td>{{ $getrecord->number}}</td>
                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td>{{ $getrecord->amount}}<i class="icon-coin-dollar ml-2" style="color: green;"></i></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ $getrecord->description}}</td>
                            </tr>
                            <tr>
                               <td>created_at</td>
                               <td>{{  date_format(date_create($getrecord->created_at),'d-m-Y') }}</td>
                           </tr>
                           <tr>
                               <td>updated_at</td>
                               <td>{{  date_format(date_create($getrecord->updated_at),'d-m-Y') }}</td>
                           </tr>
                           <tr>
                                <td>Status :</td>
                                <td>
                                     @if(!empty($getrecord->status == 0))
                                    <span class="badge badge-success">Approve</span>
                                    @elseif(!empty($getrecord->status == 1))
                                    <span class="badge badge-danger">Reject</span>
                                    @else
                                    <span class="badge badge-info">Pandding</span>
                                    @endif

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
        <!-- /content area -->
    </div>
    <!-- /main content -->
</div>
<!-- /Page content -->

@endsection
@section('script')
    <script src="{{url('public/assets/js/app.js')}}"></script>
@endsection
