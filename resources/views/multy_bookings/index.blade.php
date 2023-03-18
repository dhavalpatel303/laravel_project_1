<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Cab Booking List</title>
    </head>
        @include('layouts._top_bar')
        <?php
         use App\Onewaybookings;
         use App\Localbookings;
         use App\Multy_bookings;

        ?>


<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('layouts._sidebar')

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            <div class="page-breadcrumb">

                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Cab Booking List</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cab Booking List</li>
                                </ol>
                            </nav>
                        </div>
                        @for($i=0;$i<count($data);$i++)
                        <div class="modal fade" id="extraCharge_{{$data[$i]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal_width" role="document" >
                                <div class="modal-content border-0">
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title text-white dynamiCText">Extra Charges</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    {!! Form::open(array('route' => 'charge.store','class'=>'form form-horizontal','id'=>'onewayform','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}

                                        <div class="modal-body">
                                            <div class="notes-box">
                                                <div class="notes-content">
                                                    <input type="hidden" name="booking_id" id="booking_id" value="{{$data[$i]['id']}}">
                                                    <div class="row">
                                                        <table id="collectPaymentTable" class="table mb-0 table-striped">
                                                            <tbody><tr>
                                                                <td><label><strong>Extra Km</strong></label></td>
                                                                <td><strong>:</strong></td>
                                                                <td><input type="text" class="form-control" id="extra_kms" name="extra_kms" placeholder="Extra Kms" value="{{$data[$i]['extra_km']}}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label><strong>Parking Charge</strong></label></td>
                                                                <td><strong>:</strong></td>
                                                                <td><input type="text" class="form-control" id="parking_charge" name="parking_charge" placeholder="Parking Charge"  value="{{$data[$i]['parking_charge']}}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label><strong>Toll Tax</strong></label></td>
                                                                <td><strong>:</strong></td>
                                                                <td><input type="text" class="form-control" id="toll_tax" name="toll_tax" placeholder="Toll Tax" value="{{$data[$i]['tall_tax']}}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label><strong>State Tax</strong></label></td>
                                                                <td><strong>:</strong></td>
                                                                <td><input type="text" class="form-control" id="state_tax" name="state_tax" placeholder="State Tax" value="{{$data[$i]['state_tax']}}"></td>
                                                            </tr>
                                                        </tbody></table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btn-n-add-charge" class="btn btn-info">Add</button>
                                            <button class="btn btn-danger" data-dismiss="modal">Discard</button>
                                        </div>
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>

                </div>

            </div>



        @for($i=0;$i<count($data);$i++)
            @if($data[$i]['booking_type'] == 'Oneway')

                <div class="modal fade" id="oneway_{{$data[$i]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Booking Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row border border-dark mt-3">
                                    <div class="col-md-12">
                                        <table class="table table-bordered"> 
                                            <tbody>
                                                <tr>
                                                    <td><b>{{$data[$i]['estimate_kms']}} (Distance)</b></td>
                                                    <td>:</td>
                                                    @if($data[$i]['minkm']==0)
                                                    <td>{{$data[$i]['estimate_kms']}} (Min Km)</td>
                                                    @else
                                                    <td>{{$data[$i]['minkm']}} (Min Km)</td>
                                                    @endif
                                                </tr>

                                                <tr>
                                                    <td><b>{{$data[$i]['total_amount'] }}  (Gross Amount)</b></td>
                                                    <td>:</td>
                                                    <td>{{$data[$i]['total_amount']-$data[$i]['tall_tax']-$data[$i]['state_tax']-$data[$i]['driver_allowance']}} (Gross Amount) + {{$data[$i]['tall_tax']}}(Tall Tax) + {{$data[$i]['state_tax']  }}(State Tax) + {{$data[$i]['driver_allowance']  }}(Driver Allowance)</td>
                                                </tr>

                                                <tr>
                                                    <td><b>{{$data[$i]['total_amount'] }} (Grand Total)</b></td>
                                                    <td>:</td>
                                                    <td>{{$data[$i]['gross_total']}} (Gross Amount) - {{$data[$i]['discount']}} (Discount) + {{$data[$i]['extra_charge']}} (Extra Charge)</td>
                                                </tr>


                                            </tbody>
                                        </table> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                    </div>
                </div>
            @elseif($data[$i]['booking_type'] == 'Localpackage')
                <div class="modal fade" id="local_{{$data[$i]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Booking Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row border border-dark mt-3">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><b>{{$data[$i]['estimate_kms']}} (Distance)</b></td>
                                                    <td>:</td>
                                                    @if($data[$i]['minkm']==0)
                                                    <td>{{$data[$i]['estimate_kms']}} (Min Km)</td>
                                                    @else
                                                    <td>{{$data[$i]['minkm']}} (Min Km)</td>
                                                    @endif
                                                </tr>

                                                <tr>
                                                    <td><b>{{$data[$i]['total_amount']}}  (Gross Amount)</b></td>
                                                    <td>:</td>
                                                    <td>{{$data[$i]['total_amount']-$data[$i]['tall_tax']-$data[$i]['state_tax'] -$data[$i]['driver_allowance'] }} (Gross Amount) + {{$data[$i]['tall_tax']}}(Tall Tax) + {{$data[$i]['state_tax']  }}(State Tax) + {{$data[$i]['driver_allowance']  }}(Driver Allowance)</td>
                                                </tr>

                                                <tr>
                                                    <td><b>{{$data[$i]['total_amount'] }} (Grand Total)</b></td>
                                                    <td>:</td>
                                                    <td>{{$data[$i]['gross_total']  }} (Gross Amount) - {{$data[$i]['discount']}} (Discount) + {{$data[$i]['extra_charge']}} (Extra Charge)</td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                    </div>
                </div>

            @else
            <div class="modal fade" id="round_{{$data[$i]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Booking Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row border border-dark mt-3">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><b>{{$data[$i]['estimate_kms']}} (Distance)</b></td>
                                                <td>:</td>
                                                @if($data[$i]['minkm']==0)
                                                <td>{{$data[$i]['estimate_kms']}} (Min Km)</td>
                                                @else
                                                <td>{{$data[$i]['minkm']}} (Min Km)</td>
                                                @endif
                                            </tr> 

                                            <tr>
                                                <td><b>{{$data[$i]['total_amount'] }}  (Gross Amount)</b></td>
                                                <td>:</td>
                                                <td>{{$data[$i]['total_amount']-$data[$i]['tall_tax']-$data[$i]['state_tax'] -$data[$i]['driver_allowance'] }} (Gross Amount) + {{$data[$i]['tall_tax']}}(Tall Tax) + {{$data[$i]['state_tax']  }}(State Tax) + {{$data[$i]['driver_allowance']  }}(Driver Allowance)</td>
                                            </tr>

                                            <tr>
                                                <td><b>{{$data[$i]['total_amount'] }} (Grand Total)</b></td>
                                                <td>:</td>
                                                <td>{{$data[$i]['total_amount']-$data[$i]['discount']-$data[$i]['extra_charge'] }} (Gross Amount) + {{$data[$i]['discount']}} (Discount) + {{$data[$i]['extra_charge']}} (Extra Charge)</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
                </div>
            </div>

            @endif



        @endfor

        @for($i=0;$i<count($data);$i++)
            @if($data[$i]['booking_type'] == 'Oneway')

            <div class="modal fade" id="order_{{$data[$i]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="grid-title">Booking Details (ONEWAY)</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row border border-dark mt-3">
                                    <div class="col-md-12">
                                        <h5 class="headingH5">Trip Details</h5>
                                        <hr />
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"><b>Booking Id</b></th>
                                                            <th scope="col"><label class="label label-success" style="padding:3px">{{$data[$i]['orderno']}}</label></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Pick Up Date/Time </b></td>
                                                            <td>{{$data[$i]['pickup_date']}}- {{$data[$i]['pickup_time']}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"><b>Booking status</b></th>
                                                            <th scope="col" style="color: #294f75;"><label class="label label-success" style="padding:3px">Pending</label></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Cab Type</b></td>
                                                            <td>{{$data[$i]['cab']}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Route </b></td>
                                                            <td><label class="label label-purple">{{$data[$i]['pick_city']}}</label> &gt; <label class="label label-purple">{{$data[$i]['travel_city']}}</label></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Pick Up Location </b></td>
                                                            <td>{{$data[$i]['pickup_location']}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Seat </b></td>
                                                            <td>{{$data[$i]['seat']}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Flight Number </b></td>
                                                            <td>{{$data[$i]['flight_number']}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Drop Off Location</b></td>
                                                            <td>{{$data[$i]['drop_location']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Bag(s)</b></td>
                                                            <td>{{$data[$i]['bag']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Booking Amount</b></td>
                                                            <td>{{$data[$i]['total_amount']}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Customer Details -->
                                        <h5 class="headingH5">Customer Details</h5>
                                        <hr />
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Name</b></td>
                                                            <td>{{$data[$i]['name']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>WhatsApp Number</b></td>
                                                            <td>{{$data[$i]['user_mobile']}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Mobile Number</b></td>
                                                            <td>{{$data[$i]['user_mobile']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Email-Id</b></td>
                                                            <td>{{$data[$i]['email']}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Billing Details -->
                                        <h5 class="headingH5">Billing Details</h5>
                                        <hr />
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Company Name</b></td>
                                                            <td>-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>GST Number </b></td>
                                                            <td>-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Company Address </b></td>
                                                            <td>-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Driver Details -->
                                        <h5 class="headingH5">Driver Details</h5>
                                        <hr />
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Name</b></td>
                                                            <td>{{$data[$i]['driver_name']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Mobile Number </b></td>
                                                            <td>{{$data[$i]['driver_mobile']}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Cab Name</b></td>
                                                            <td>{{$data[$i]['cab_name']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Cab Number</b></td>
                                                            <td>{{$data[$i]['cab_number']}}</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            @elseif($data[$i]['booking_type'] == 'Localpackage')

                <div class="modal fade" id="localorder_{{$data[$i]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="grid-title">Booking Details (Local Package)</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row border border-dark mt-3">
                                        <div class="col-md-12">
                                            <h5 class="headingH5">Trip Details</h5>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><b>Booking Id</b></th>
                                                                <th scope="col"><label class="label label-success" style="padding:3px">{{$data[$i]['orderno']}}</label></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Pick Up Date/Time </b></td>
                                                                <td>{{$data[$i]['pickup_date']}}- {{$data[$i]['pickup_time']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><b>Booking status</b></th>
                                                                <th scope="col" style="color: #294f75;"><label class="label label-success" style="padding:3px">Pending</label></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Cab Type</b></td>
                                                                <td>{{$data[$i]['cab']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Route </b></td>
                                                                <td><label class="label label-purple">{{$data[$i]['pick_city']}}</label> &gt; <label class="label label-purple">{{$data[$i]['travel_city']}}</label></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Pick Up Location </b></td>
                                                                <td>{{$data[$i]['pickup_location']}}</td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Seat </b></td>
                                                                <td>{{$data[$i]['seat']}}</td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Flight Number </b></td>
                                                                <td>{{$data[$i]['flight_number']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Drop Off Location</b></td>
                                                                <td>{{$data[$i]['drop_location']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Bag(s)</b></td>
                                                                <td>{{$data[$i]['bag']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Booking Amount</b></td>
                                                                <td>{{$data[$i]['total_amount']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Customer Details -->
                                            <h5 class="headingH5">Customer Details</h5>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Name</b></td>
                                                                <td>{{$data[$i]['name']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>WhatsApp Number</b></td>
                                                                <td>{{$data[$i]['user_mobile']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Mobile Number</b></td>
                                                                <td>{{$data[$i]['user_mobile']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Email-Id</b></td>
                                                                <td>{{$data[$i]['email']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Billing Details -->
                                            <h5 class="headingH5">Billing Details</h5>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Company Name</b></td>
                                                                <td>-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>GST Number </b></td>
                                                                <td>-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Company Address </b></td>
                                                                <td>-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Driver Details -->
                                            <h5 class="headingH5">Driver Details</h5>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Name</b></td>
                                                                <td>{{$data[$i]['driver_name']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Mobile Number </b></td>
                                                                <td>{{$data[$i]['driver_mobile']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Cab Name</b></td>
                                                                <td>{{$data[$i]['cab_name']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Cab Number</b></td>
                                                                <td>{{$data[$i]['cab_number']}}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="modal fade" id="multyorder_{{$data[$i]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="grid-title">Booking Details (Round Trip)</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row border border-dark mt-3">
                                        <div class="col-md-12">
                                            <h5 class="headingH5">Trip Details</h5>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><b>Booking Id</b></th>
                                                                <th scope="col"><label class="label label-success" style="padding:3px">{{$data[$i]['orderno']}}</label></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Pick Up Date/Time </b></td>
                                                                <td>{{$data[$i]['pickup_date']}}- {{$data[$i]['pickup_time']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><b>Booking status</b></th>
                                                                <th scope="col" style="color: #294f75;"><label class="label label-success" style="padding:3px">Pending</label></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Cab Type</b></td>
                                                                <td>{{$data[$i]['cab']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Route </b></td>
                                                                <td><label class="label label-purple">{{$data[$i]['pick_city']}}</label> &gt; <label class="label label-purple">{{$data[$i]['travel_city']}}</label></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Pick Up Location </b></td>
                                                                <td>{{$data[$i]['pickup_location']}}</td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Seat </b></td>
                                                                <td>{{$data[$i]['seat']}}</td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Flight Number </b></td>
                                                                <td>{{$data[$i]['flight_number']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Drop Off Location</b></td>
                                                                <td>{{$data[$i]['drop_location']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Bag(s)</b></td>
                                                                <td>{{$data[$i]['bag']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Booking Amount</b></td>
                                                                <td>{{$data[$i]['total_amount']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Customer Details -->
                                            <h5 class="headingH5">Customer Details</h5>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Name</b></td>
                                                                <td>{{$data[$i]['name']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>WhatsApp Number</b></td>
                                                                <td>{{$data[$i]['user_mobile']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Mobile Number</b></td>
                                                                <td>{{$data[$i]['user_mobile']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Email-Id</b></td>
                                                                <td>{{$data[$i]['email']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Billing Details -->
                                            <h5 class="headingH5">Billing Details</h5>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Company Name</b></td>
                                                                <td>-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>GST Number </b></td>
                                                                <td>-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Company Address </b></td>
                                                                <td>-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Driver Details -->
                                            <h5 class="headingH5">Driver Details</h5>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Name</b></td>
                                                                <td>{{$data[$i]['driver_name']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Mobile Number </b></td>
                                                                <td>{{$data[$i]['driver_mobile']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Cab Name</b></td>
                                                                <td>{{$data[$i]['cab_name']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Cab Number</b></td>
                                                                <td>{{$data[$i]['cab_number']}}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        @endfor
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4>Filter</h4>
                                </div>
                            </div>
                            <form action="" method="get">
                                <div class="row input-daterange">
                                    <div class="col-md-3">
                                        <input type="text" name="from_date" id="from_date" placeholder="Start Date" class="form-control start_date datepicker" autocomplete="off" style="text-align: left" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="to_date" id="to_date" placeholder="End Date" class="form-control end_date datepicker" autocomplete="off" style="text-align: left"/>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <input type="button" name="filter" id="filter" value="Filter" class="btn rounded-pill btn-success"  />
                                        <input type="button" name="reset" id="reset" value="Reset" class="btn rounded-pill btn-danger" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            @if(session()->has('success'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                <h3 class="text-success"><i class="fa fa-check-circle"></i>  <b>  {{ session()->get('success') }}</h3>

                            </div>

                            @endif
                               
                            <div class="card-body">

                                <div class="d-flex align-items-center">

                                    <div>
                                        <h4>Cab Booking List</h4>
                                        <button class="btn btn-danger me-1 waves-effect waves-float waves-light  d-none" id="deleteAllBtn">Delete All</button>
                                    </div>
                                    <div class="ml-auto">

                                        <a href="{{route('multy_bookings.create')}}" class="btn btn-info card-title">Add New <i class="fa fa-plus"></i></a>
                                    </div>

                                </div>


                                <div class="table-responsive table_res2">
                                    <table id="list-table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th ><input type="checkbox" name="main_checkbox"><label></label></th>
                                                <th>No</th>
                                                <th> Status </th>
                                                <th>Action</th>
                                                <th>Order/Cab </th>
                                                <th>Customer info</th>
                                                <th>Date/Time</th>
                                                <th>From/To </th>
                                                <th>Driver Name</th>
                                                {{-- <th> Action </th> --}}
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="chat-windows"></div>
   @include('layouts._footer')
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script>

 load_data();
 function load_data(from_date = '', to_date = '')
 {
    var table = $('#list-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'{{ route("multy_bookings.index") }}',
                data:{from_date:from_date, to_date:to_date}
            },
            columns: [
                        {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
                        {data: 'DT_RowIndex',    name: 'DT_RowIndex'},
                        {data:'status',name:'status',class:"w4"},
                        {data:'asign',name:'asign',class:'w1'},
                        {data:'cab_type',     name:'cab_type',class:'w4'},
                        {data:'contact_info',     name:'contact_info'},
                        {data:'dateTime',     name:'dateTime',class:"w4"},
                        {data:'pickDrop',   name:'pickDrop',class:"w6"},
                        {data:'driver_name',   name:'driver_name',class:"w2"},
                    ],
    }).on('draw',function(){
                $('input[name="city_checkbox"]').each(function(){this.checked = false;});
                $('input[name="main_checkbox"]').prop('checked',false);
                $('button#deleteAllBtn').addClass('d-none');

    });

 }
    $('#filter').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
   $('#list-table').DataTable().destroy();
   load_data(from_date, to_date);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#reset').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  $('#list-table').DataTable().destroy();
  load_data();
 });

 </script>

 <script>

     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
     $(document).on('click','input[name="main_checkbox"]',function(){
         if(this.checked){
             $('input[name="city_checkbox"]').each(function(){
                 this.checked = true;
             });
         }else{
            $('input[name="city_checkbox"]').each(function(){
                 this.checked = false;
             });
         }
         toggledeleteAllBtn();
     });
     $(document).on('change','input[name="city_checkbox"]',function(){

        if($('input[name="city_checkbox"]').length==$('input[name="city_checkbox"]:checked').length){
            $('input [name="main_checkbox"]').prop('checked',true);
        }else{
            $('input [name="main_checkbox"]').prop('checked',false);
        }
        toggledeleteAllBtn();
     });

     function toggledeleteAllBtn(){
         if( $('input[name="city_checkbox"]:checked').length > 0 ){
             $('button#deleteAllBtn').text('DeleteAll ('+$('input[name="city_checkbox"]:checked').length+')').removeClass('d-none');
         }else{
             $('button#deleteAllBtn').addClass('d-none');
         }
     }
     $(document).on('click','button#deleteAllBtn',function(){
         var checkedcity = [];
         $('input[name="city_checkbox"]:checked').each(function(){
            checkedcity.push($(this).data('id'));
         });

        var url = '{{route("multy_bookings.deleteAll")}}';
        if(checkedcity.length > 0)
        {

            swal.fire({
                title:'Are You Sure?',
                html:'You want to delete <b>('+checkedcity.length+')</b>data',
                showCancelButton:true,
                showCloseButton:true,
                confirmButtonText:'Yes,Delete',
                cancelButtonText:'Cancel',
                confirmButtonColor:'#556ee6',
                cancelButtonColor:'#d33',
                width:300,
                allowOutsideClick:false,
            }).then(function(result){
                if(result.value){
                    $.post(url,{checkedcity_ids:checkedcity},function(data){

                        if(data.code == 1){
                            $('#list-table').DataTable().ajax.reload(null,true);
                            toaster.success(data.msg);
                        }
                    },'json');
                }
            })
        }
    });


 </script>
{{-- <script>
    function changeStatus(_this, id) {
        var status = $(_this).prop('checked') == true ? 1 : 0;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `/change-status`,
            type: 'post',
            data: {
                _token: _token,
                id: id,
                status: status
            },
            success: function (result) {
            }
        });
    }

</script> --}}
{{-- <script>
$(function() {
  $('.toggle-class').change(function() {
      var status = $(this).prop('checked') == true ? 1 : 0;
      var user_id = $(this).data('id');

      $.ajax({
          type: "GET",
          dataType: "json",
          url: '/changeStatus',
          data: {'status': status, 'user_id': user_id},
          success: function(data){
            console.log(data.success)
          }
      });
  })
})
</script> --}}
<script>
  $(document).on('click', '.statuschange', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');

    $.ajax({url:url,success:function(result)
    {
        $('#list-table').DataTable().ajax.reload();

    }});
});

</script>




<script>
    $(document).on('click', '.status_cancel', function (e) {
      e.preventDefault();

      var url = $(this).attr('href');

      $.ajax({url:url,success:function(result)
      {
          $('#list-table').DataTable().ajax.reload();

      }});
  });

  </script>
<script>

  $('#list-table').on('draw.dt', function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $('#list-table').on('draw.dt', function() {
            $('[data-toggle="popover"]').popover();
        });

</script>

<script>

$(document).ready(function(){


// window.onload = function()
// {
//     var data = $("#driver_id").val();
//     alert(data);
// }

});
$(document).ready(function() {
$('[data-toggle="popover"]').popover({
placement: 'top',
trigger: 'hover'
});
});
</script>
<script src="https://uwaycabs.com/assets/panel/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<style>
.book{
background-color: #7367f0 !important;
}
.book_local{
background-color: #e95455 !important;
}
.book_round{
background-color: #28c76f !important;
}
.book_text{
color: white !important;
font-weight:900 !important;
}
.out_lint{
border:1px solid #d4f4e2 !important
}
th{
width:0px !important;
}
</style>
<style>
.tooltip_1 {
position: relative;
display: inline-block;
}

.mal_5{
margin-left: 15px !important;
}
.mar_5{
/* float: right !important; */
/* margin-right: 45px !important; */
}
.tooltip_1 .tooltiptext_1 {
    visibility: hidden;
    width: 260px;
    height: 110px;
    background-color: #4b4b4b;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 10px 0;
    position: absolute;
    z-index: 1;
    top: 90%;
    left: 50%;
    margin-left: -100px;
    text-align: justify !important;
}
.tooltip_1 .tooltiptext_1::after {
content: "";
position: absolute;
bottom: 100%;
left: 50%;
margin-left: -5px;
border-width: 5px;
border-style: solid;
border-color: transparent transparent black transparent;
}
.tooltip_1:hover .tooltiptext_1 {
visibility: visible;
}
.tooltip_2 .tooltiptext_2 {
visibility: hidden;
width: 150px;
background-color: #000000;
color: #fff;
text-align: center;
border-radius: 6px;
padding: 12px 7px;
position: absolute;
z-index: 1;
top: 90%;
left: 50%;
margin-left: -75px;
text-align: justify !important;
}
.tooltip_2 .tooltiptext_2::after {
content: "";
position: absolute;
bottom: 100%;
left: 50%;
margin-left: -5px;
border-width: 5px;
border-style: solid;
border-color: transparent transparent black transparent;
}
.tooltip_2:hover .tooltiptext_2 {
visibility: visible;
}

.tooltip_3 .tooltiptext_3 {
visibility: hidden;
width: 150px;
background-color: #000000;
color: #fff;
text-align: center;
border-radius: 6px;
padding: 12px 7px;
position: absolute;
z-index: 1;
top: 90%;
left: 50%;
margin-left: -75px;
text-align: justify !important;
}
.tooltip_3 .tooltiptext_3::after {
content: "";
position: absolute;
bottom: 100%;
left: 50%;
margin-left: -5px;
border-width: 5px;
border-style: solid;
border-color: transparent transparent black transparent;
}
.tooltip_3:hover .tooltiptext_3 {
visibility: visible;
}
@media (max-width: 991px) {
.hide{
    display: none !important;
}
.tool_ml{
    margin-left: 35px !important;
}
.tool2_ml{
    margin-left: -70px !important
}
}

</style>

<script>
         $(".start_date").datepicker({
	        todayBtn:  1,
	        autoclose: true,
            format: 'dd-mm-yyyy'

	    }).on('changeDate', function (selected) {
	        var minDate = new Date(selected.date.valueOf());

	        $('.end_date').datepicker('setStartDate', minDate);
	    });

	    $(".end_date").datepicker({
	        todayBtn:  1,
	        autoclose: true,
            format: 'dd-mm-yyyy'

	    })
		.on('changeDate', function (selected) {
            var maxDate = new Date(selected.date.valueOf());
			$('.start_date').datepicker('setEndDate', maxDate);
        });
</script>
{{-- <script>
    $(document).on('click', '.ganrate_invoice', function (e) {
      e.preventDefault();
      var url = $(this).attr('href');
        alert(url);
      $.ajax({url:url,success:function(result)
      {
          $('#list-table').DataTable().ajax.reload();

      }});
  });

  </script> --}}
</body>

</html>
