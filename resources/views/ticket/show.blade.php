@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Ticket</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('ticket.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subject:</strong>
                {{ $Ticket->subect }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mobile:</strong>
                {{ $Ticket->number }}
            </div>
        </div>
      <!--   <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $Ticket->description}}
            </div>
        </div> -->
       <!--  <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Reason:</strong>
                {{ $Ticket->reason }}
            </div>
        </div>  -->
        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Referance-id:</strong>
                {{ $Ticket->referance }}
            </div>
        </div>  -->
        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Updated_by</strong>
                {{ $Ticket->updated_by }}
            </div>
        </div> -->
       <!--   <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Created_at</strong>
              {{  date_format(date_create($getrecord->created_at),'d-m-Y') }}
            </div>
        </div>  -->
      <!--    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Updated_at</strong>
              {{  date_format(date_create($getrecord->updated_at),'d-m-Y') }}
            </div>
        </div> -->
      <!--   <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status</strong>
              @if(!empty($getrecord->status == 0))
                <span class="badge badge-success">Approve</span>
             @else
                <span class="badge badge-danger">Reject</span>
             @endif
            </div> -->
        </div> 
      
@endsection
