@extends('layouts.app')


@section('content')
    <div class="page-header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><span class="font-weight-semibold">Add Users </span></h4>
            </div>
            <div class="header-elements d-none py-0 mb-3 mb-md-0">
                <div class="breadcrumb">
                    <a href="{{ route('withdrawal.index') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <a href="{{ route('withdrawal.index') }}" class="breadcrumb-item"> User</a>
                    <span class="breadcrumb-item active">Add User</span>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12" id="add-message"></div>
                        {!! Form::open(array('route' => 'ticket.store','method'=>'POST')) !!}

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Subject</label>
                                {!! Form::text('subject', null, array('placeholder' => 'Subject','class' => 'form-control')) !!}
                                <span style="color:red">{{  $errors->first('name') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Number</label>
                                {!! Form::text('number', null, array('placeholder' => 'number','class' => 'form-control')) !!}
                                <span style="color:red">{{  $errors->first('number') }}</span>
                            </div>
                              <div class="form-group col-md-12">
                                <label>Description</label>
                              {!! Form::textarea('description', null, array('placeholder' => 'description','class' => 'form-control','id'=>'description',)) !!}
                                <span style="color:red">{{  $errors->first('description') }}</span>
                            </div>
                        </div>
                       <div class="form-group mb-3 mb-md-3">
                                    <label class="d-block font-weight-semibold">Status</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="status" id="status" checked="" value="0">
                                        <label class="custom-control-label" for="status">Approve</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="status" id="status1" value="1" {{ old('status') ? 'checked' : ''}}>
                                        <label class="custom-control-label" for="status1">Reject</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="status" id="status2" value="2" {{ old('status') ? 'checked' : ''}}>
                                        <label class="custom-control-label" for="status2">Panding</label>
                                    </div>
                        </div>
                            
                            <div class="form-group">
                                <div class="d-flex justify-content-start align-items-center">
                                    <button type="submit" class="btn bg-dark">Submit</button>
                                </div>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div> 
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Page js -->
    <script src="{{url('public/global_assets/js/plugins/editors/ckeditor/ckeditor.js')}}"></script>
    <script src="{{url('public/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{url('public/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <!-- Page js -->

    <!-- date picker -->
    <script src="{{url('public/global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script src="{{url('public/global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>
    <script src="{{url('public/global_assets/js/plugins/pickers/pickadate/picker.js')}}"></script>
    <script src="{{url('public/global_assets/js/plugins/pickers/pickadate/picker.date.js')}}"></script>

    <!-- /date picker -->

    <!-- global js -->
    <script src="{{url('public/assets/js/app.js')}}"></script>
    <!-- global js -->

    <!-- custom js -->
   <!--  <script type="text/javascript">
        // CKEDITOR
        CKEDITOR.replace('description', {
            height: 370,
        });
        // end- CKEDITOR

        // file
        $('.form-control-uniform-custom').uniform({
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400'
        });
        // end - file

        // select with search
        $('.select-search').select2();
        // end- select with search

        // Single picker
        $('.daterange-single').daterangepicker({ 
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
        // end-Single picker
    </script> -->
    <!-- custom js -->
@endsection

