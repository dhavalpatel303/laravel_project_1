@extends('layouts.app')

@section('style')
    <!-- start custom css -->
    <!-- end custom css -->
@endsection

@section('content')
    <div class="page-header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><span class="font-weight-semibold">Ticket</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none py-0 mb-3 mb-md-0">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Ticket</span>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="content-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
{{--                        @include('message._message')--}}
                        <div class="card">
                            <table class="table datatable-button-init-basic" id="list-table">
                                <thead>
                                <tr class="bg-dark">
                                    <th>No</th>
                                    <th>subject</th>
                                    <th>Number</th>
                                    <th width="500">Description</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('js/datatables/buttons.min.js')}}"></script>
    <script src="{{ asset('js/datatables/responsive.min.js')}}"></script>
    <script src="{{url('public/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{url('public/assets/js/app.js')}}"></script>
    <script src="{{ asset('js/datatables/datatable-custom.min.js')}}"></script>
    <script src="{{ asset('js/plugins/select2.min.js')}}"></script>
     <script src="{{url('public/global_assets/ckeditor/ckeditor.js')}}"></script>
    <script src="{{url('public/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js')}}"></script>
    <script>
        $(function () {

            var table = $('#list-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ticket.index') }}",
                columns: [
                    {data: 'id',                name: 'id'},
                    {data: 'subject',           name: 'subject'},
                    {data: 'number',            name: 'number'},
                    {data: 'description',        name: 'desription'},
                    {data:'created_at',         name:  'created_at'},
                    {data:'updated_at',         name:  'updated_at'},
                    {data:'status',             name:  'status'},
                    {data: 'action',            name: 'action', orderable: false, searchable: false},
                   
                ],

                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-dark'
                        }
                    },
                    buttons: [
                        {extend: 'copy'},
                        {extend: 'csv'},
                        {
                            text: '<i class="icon-plus3"></i> Add User',
                            action: function ( e, dt, button, config ) {
                                window.location = "{{route('ticket.create')}}";
                            }
                        },
                    ]
                },


        });

            });



    </script>
  
@endsection
