@extends('layouts.app')

@section('style')
    <!-- start custom css -->
    <!-- end custom css -->
@endsection

@section('content')
    <div class="page-header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><span class="font-weight-semibold">Roles Management</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none py-0 mb-3 mb-md-0">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Roles Management</span>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="content-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <table class="table datatable-button-init-basic" id="list-table">
                                <thead>
                                    <tr class="bg-dark">
                                        <th>No</th>
                                        <th>Name</th>
                                        <th width="280px" id="h1">Action</th>
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
    <script src="{{ asset('js/datatables/datatable-custom.min.js')}}"></script>

    <script>
        $(function () {

            var table = $('#list-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('roles.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],

                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-dark'
                        }
                    },
                    buttons: [
                        {
                            text: '<i class="icon-plus3"></i> Add Roles',
                            action: function ( e, dt, button, config ) {
                                window.location = "{{route('roles.create')}}";
                            }
                        },
                    ]
                },
            });

        });
    </script>
@endsection
