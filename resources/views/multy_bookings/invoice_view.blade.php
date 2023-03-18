<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Karla:400,700" />
</head>
<body style="font-family: Karla;">
    <div style="border: 1px solid; margin: 0 auto; font-size: 17px;">
        <div style="border-bottom: 1px solid; height: 230px; padding: 5px;">
            <div style="text-align: center; padding: 5px; color: #ee6931;">
                <span><b>Original Tax Invoice</b></span>
            </div>
            <div style="width: 340px; text-align: left; display: inline-block; font-size: 15px;">
                <img style="margin-top: 15px; margin-bottom: 2px; height: 50px;" src="{{asset('front-assets/assets/img/logo/logo_2.png')}}" /><br />
                <span style="color: #ee6931;"><b>Company Details:</b></span><br />
                <span><b>{{helpers::name()}}.</b></span><br />
                <span><b>Address:</b>{{helpers::address()}}<i class="fas fa-square-root-alt"></i></span><br />
                <span><b>Contact:</b>&nbsp;+91 {{helpers::mobile()}}</span><br />
                <span><b>Email Us:</b><span style="color: #2888d1;">&nbsp;{{helpers::email()}}</span></span>
            </div>
            <div style="width: 100px; display: inline-block; vertical-align: top; font-size: 15px; margin-top: 30px;"></div>
            <div style="width: 240px; display: inline-block; vertical-align: top; font-size: 15px; margin-top: 30px;">
                <div style="inline-block">
                    <span style="color: #ee6931;"><b>Invoice Details:</b> </span><br />
                    <span><b>Invoice No:</b> {{$data->orderno}}</span><br />
                    <span><b>Invoice Date:</b>&nbsp;{{ date_format(date_create($data->created_at),'d-m-Y') }}</span><br />
                    <span><b>Driver Name:</b>&nbsp;{{$data->driver_name}}</span><br />
                    <span><b>Car Number:</b>&nbsp;{{$data->cab_number}}</span><br />
                    <span><b>Website:</b>&nbsp;www.{{helpers::name()}}.com</span><br />
                </div>
            </div>
        </div>

        <div style="height: auto; padding: 5px; border-bottom: 1px solid; font-size: 15px;">
            <span style="color: #ee6931;"><b>Trip Details:</b></span><br><br>
            <div style="width: 200px; text-align: center; display: inline-block;">
                <span>Trip Type</span><br />
                <span>{{$data->pick_city}} To {{$data->travel_city}}</span><br />
            </div>
            <div style="width: 200px; display: inline-block; text-align: center;">
                <span>Trip Date</span><br />
                <span>
                    {{ date_format(date_create($data->pickup_date),'d-m-Y') }}</span><br />
            </div>
            <div style="width: 200px; display: inline-block; text-align: center;">
                <span>Trip Route</span><br />
                <span>{{$data->pick_city}} - {{$data->travel_city}}</span><br />
            </div>
        </div>

        <div style="height: auto; margin-top: 4px;">
            <div style="border-bottom: 1px solid; padding: 5px; font-size: 15px;">
                <span style="color: #ee6931;"><b>Guest Details:</b></span><br />
                <div style="width: 650px; text-align: left; display: inline-block;">
                    <span>Guest Name - {{$data->name}}</span><br />
                    <span>Guest Number - {{$data->user_mobile}}</span><br />
                    <span>Guest Email - {{$data->email}}</span><br><br>

                    <span style="color: #ee6931;"><b>Fare Details:</b></span><br />
                </div>
            </div>
        </div>

        <div style="height: auto;">
            <table style="width: 700px; border-bottom: 1px solid; border-collapse: collapse;">
                <thead style="font-size: 15px;">
                    <tr style="outline: thin; border-bottom: 1px solid;">
                        <td style="width: 300px; border-right: 1px solid; border-bottom: 1px solid; text-align: center;">Fare/Charges</td>
                        <td style="border-right: 1px solid; border-bottom: 1px solid; text-align: center;">QTY</td>
                        <td style="border-right: 1px solid; border-bottom: 1px solid; text-align: center;">Rate</td>
                        <td style="text-align: center; border-bottom: 1px solid;">Amount</td>
                    </tr>
                </thead>
                <tbody style="font-size: 14px;">
                    <tr style="height: 2px;">
                        <td style="border-right: 1px solid; text-align: left;">Base Fare</td>
                        <td style="border-right: 1px solid; text-align: center;">1</td> 
                        <td style="border-right: 1px solid; text-align: center;">Rs.{{$data->total_amount-$data->tall_tax-$data->state_tax-$data->driver_allowance+$data->discount}}/-</td>
 
                        <td style="text-align: center;">Rs. {{$data->total_amount-$data->tall_tax-$data->state_tax-$data->driver_allowance+$data->discount}}</td>
                    </tr>
                    <tr style="height: 2px;">
                        <td style="border-right: 1px solid; text-align: left;">Toll Tax</td>
                        <td style="border-right: 1px solid; text-align: center;"></td>
                        <td style="border-right: 1px solid; text-align: center;">Rs. {{$data->tall_tax}}</td>
                        <td style="text-align: center;">Rs. {{$data->tall_tax}}</td>
                    </tr>
                    <tr style="height: 2px;">
                        <td style="border-right: 1px solid; text-align: left;">State Tax</td>
                        <td style="border-right: 1px solid; text-align: center;"></td>
                        <td style="border-right: 1px solid; text-align: center;">Rs. {{$data->state_tax}}</td>
                        <td style="text-align: center;">Rs. {{$data->state_tax}}</td>
                    </tr>
                    <tr style="height: 2px;">
                        <td style="border-right: 1px solid; text-align: left;">Driver Allowance</td>
                        <td style="border-right: 1px solid; text-align: center;"></td>
                        <td style="text-align: center; border-right: 1px solid;">Rs. {{$data->driver_allowance}}</td>
                        <td style="text-align: center;">Rs. {{$data->driver_allowance}}</td>
                    </tr>
                      
                    <tr style="height: 2px;">
                        <td style="border-bottom: 1px solid; border-right: 1px solid; text-align: left;">Parking Charge</td>
                        <td style="border-bottom: 1px solid; border-right: 1px solid; text-align: center;"></td>
                        <td style="border-bottom: 1px solid; border-right: 1px solid; text-align: center;">Rs. {{$data->parking_charge}}</td>
                        <td style="border-bottom: 1px solid; text-align: center;">Rs. {{$data->parking_charge}}</td>
                    </tr>
                    <tr style="outline: thin; border-top: 1px solid;">
                        <td style="width: 147px;"></td>
                        <td></td>
                        <td style="border-right: 1px solid; text-align: right;"><span>Sub Total</span></td>
                        <td style="text-align: center;">Rs. {{$data->total_amount+$data->discount-$data->extra_charge}}/-</td>
                    </tr>
                    @if($data->extra_charge == '')

                    @else
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="border-right: 1px solid; text-align: right;">
                            <span><b>Extra Charge</b></span>
                        </td>
                        <td style="text-align: center;">Rs.{{$data->extra_charge}}/-</td>
                    </tr>
                    @endif   
                    @if($data->discount == '')

                    @else
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="border-right: 1px solid; text-align: right;">
                            <span><b> Discount</b></span>
                        </td>
                        <td style="text-align: center;">Rs. {{$data->discount}}/-</td>
                    </tr>
                    @endif
                    

                    <tr>
                        <td></td>
                        <td></td>
                        <td style="border-right: 1px solid; text-align: right;">
                            <span style="color: #ee6931;"><b>Grand Total</b></span>
                        </td>
                        <td style="border-top: 1px solid; text-align: center;">Rs. {{$data->total_amount}}/-</td>
                    </tr>
                </tbody>
            </table>
        </div>

     
        

        <div style="padding: 5px;">
            <div style="width: 75%; text-align: left; display: inline-block; font-size: 14px; margin-top: 15px;">
                <span>1. All Correspondence with Central Account office of <b>{{helpers::name()}}</b> at {{helpers::email()}}</span><br />
                <span>2. E. & OE. Subject of Vadodara Jurisdiction.</span><br />
                <span>3. In case of discrepency, Kindly Return the bill for necessary correction within 10 days or it shall be treated as approved and you shall be liable to pay the full amount.</span><br />
                <span>4. Cheque should be made in favor of <b>{{helpers::name()}}</b></span>
            </div>
              

            <div style="width: 20%; display: inline-block; float: right; text-align: right; font-size: 15px; margin-top: 20px;">
              <?php $sign = helpers::sign();?>
                <img style="margin-bottom: 4px; height: 50px;" src="{{asset('logo/'.$sign)}}" /><br />
                <span><b>Authorised Signatory</b></span><br />
            
            </div>
            <br />
        </div>
    </div>
</body>
