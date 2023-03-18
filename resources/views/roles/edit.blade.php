@extends('layouts.app')


@section('content')
    <div class="page-header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><span class="font-weight-semibold">Edit Roles </span></h4>
            </div>
            <div class="header-elements d-none py-0 mb-3 mb-md-0">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Roles</a>
                   
                    <span class="breadcrumb-item active">Edit Roles</span>
                </div>
            </div>
        </div>
    </div>
      @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="content">
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12" id="add-message"></div>
                       {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}

                            <div class="form-group">
                                <label>Name</label>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control'))!!}
                                <span style="color:red">{{  $errors->first('name') }}</span>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    @foreach($permission as $value)
                                    <div class="col-md-6 p-3">
                                        <label class="form-check-input-switchery"  >
                                               {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }} {{ $value->name }}
                                            </label>
                                         </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                <button type="submit" class="btn btn-dark">Submit</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/plugins/select2.min.js')}}"></script>
    <script src="{{asset('js/plugins/uniform.min.js')}}"></script>
    <script>
        $('.select-search').select2();
    </script>
@endsection
