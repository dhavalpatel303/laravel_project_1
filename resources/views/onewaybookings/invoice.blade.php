<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="date=no">
<meta name="format-detection" content="address=no">
<meta name="format-detection" content="email=no">
<title></title>
<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        </head>
<style>
span {
font-weight: 500 !important;
}
tr {
font-weight: 900 !important;
}
ul {
font-weight: 700 !important;
}
.footerRight {
	font-weight: 900 !important;
	float:right;
}
@font-face {
	font-family: Fira Sans, sans-serif;
	src: url(https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900);
}
body {
	font-family: Fira Sans, sans-serif !important;
}
div {
  font-family: Fira Sans, sans-serif !important;
}
table {
  font-family: Fira Sans, sans-serif !important;
}
ul {
  font-family: Fira Sans, sans-serif !important;
}
</style>
        <body style="font-family: Fira Sans, sans-serif;">
<section class="content" style="background-color: #7a878e00 !important; color: #000000;margin-bottom:-50px;">
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <div class="card">

            <div id="print" style="width:700px;height:auto;border:1px solid #c1c1c1;margin:0 auto 100px;font-size: 15px;">
              <div style="border-bottom:1px solid #c1c1c1;height:auto;padding:5px;">
                  <div style="width: 55%;text-align: left;display:inline-block;">
                     <br> <span><b>{{helpers::name()}}</b></span><br>
                     <span><b>Address : </b>{{helpers::address()}}</span><br>
                      <span><b>Contact:</b>&nbsp;+91 {{helpers::mobile()}}</span><br>
                      <span><b>Email Us:</b><span style="color: #2e93e4;">&nbsp;{{helpers::email()}}</span></span>
                  </div>
                  <div style="width: 40%;display:inline-block;vertical-align: top;text-align: right;">
                    <?php $site_logo = helpers::logo();?>
                     <img style="margin-bottom: 4px;height: 70px;margin-top: 15px;" src="{{asset('logo/'.$site_logo)}}">
                  </div>
              </div>

              <div style="border-bottom:1px solid #c1c1c1;height:auto;">
                  <div style="padding:5px;">
                      <span>Dear&nbsp;<b>{{$user_details[0]['name']}},</b></span><br>
                      <span>Your car booking ID is<b>&nbsp;{{$book_cab[0]['orderno']}}</b></span><br>


                  </div>
              </div>

              <div style="border-bottom:1px solid #c1c1c1;height:28px;">
                  <div style="padding:5px;">
                    <span style="color: #2e93e4;"><b>Booking Details</b></span>
                  </div>
              </div>

              <div style="height:auto;padding:0;border-bottom: 1px solid #c1c1c1;">
                  <div style="width:100%;text-align: left;">
                     <table style="width: 100%;">
                      <tbody><tr>
                      <td style="border: 1px solid #ccc;"><span>Booking Id <span></td>
                      <td style="border: 1px solid #ccc;" ><span>{{$book_cab[0]['orderno']}}<span></td>
                      <td style="border: 1px solid #ccc;"><span>Status <span></td>
                      <td style="border: 1px solid #ccc;" ><span>Paid<span></td>
                      </tr>
                      <tr>
                      <td style="border: 1px solid #ccc;"><span>Pickup Date Time <span></td>
                      <td style="border: 1px solid #ccc;" ><span>{{$pickdate}}, {{$book_cab[0]['pickup_time']}}<span></td>
                      <td style="border: 1px solid #ccc;"><span>Booked On <span></td>
                      <td style="border: 1px solid #ccc;" ><span>{{$bookon}}<span></td>
                      </tr>
                      <tr>
                      <td style="border: 1px solid #ccc;"><span>Pickup City <span></td>
                      <td style="border: 1px solid #ccc;" ><span>{{$pickupcity[0]['pick_city']}}<span></td>
                      <td style="border: 1px solid #ccc;"><span>Car Booked <span></td>
                      <td style="border: 1px solid #ccc;" ><span>{{$book_cab[0]['cab_type']}}<span></td>
                      </tr>
                      <tr>
                      <td style="border: 1px solid #ccc;"><span>Rental Type <span></td>
                      <td style="border: 1px solid #ccc;" colspan="3"><span>Oneway ({{$pickupcity[0]['pick_city']}} - {{$dropcity[0]['drop_city']}})</span></td>
                      </tr>
                     </tbody></table>

                  </div>
              </div>
              <div style="width:335px;display:inline-block;border-right: 1px solid #c1c1c1;padding: 5px;vertical-align: top;height: 360px;max-height: 370px;">
                <table style="text-align:center;border-collapse:collapse;font-size: 13.5px;">
                    <tbody><tr>
                      <td colspan="2" style="text-align: left;"><span style="color: #2e93e4;"><b>Customer Details</b></span> </td>
                    </tr>
                     <tr style="line-height: 1.5;">
                      <td style="width: 125px;text-align: left;"><span><b>Name</b></span> </td>
                      <td style="text-align: left;"><span>{{$user_details[0]['name']}}</span> </td>
                    </tr>
                    <tr style="line-height: 1.5;">
                      <td style="text-align: left;"><span><b>Mobile No</b></span> </td>
                      <td style="text-align: left;"><span>{{$user_details[0]['user_mobile']}}</span> </td>
                    </tr>
                    <tr style="line-height: 1.5;">
                      <td style="text-align: left;"><span><b>Email-Id</b></span> </td>
                      <td style="text-align: left;"><span style="color: #2e93e4;">{{$user_details[0]['email']}}</span> </td>
                    </tr>
                    <tr style="line-height: 1.5;">
                      <td style="text-align: left;"><span><b>Pickup Location</b></span> </td>
                      <td style="text-align: left;"><span>{{$pickupcity[0]['pick_city']}}</span> </td>
                    </tr>
                    <tr style="line-height: 1.5;">
                      <td style="text-align: left;vertical-align: top;"><span><b>Pickup Address</b></span> </td>
                      <td style="text-align: left;"><span>{{$book_cab[0]['pickup_location']}}</span> </td>
                    </tr>
                    <tr style="line-height: 1.5;">
                      <td style="text-align: left;"><span><b>Drop City</b></span> </td>
                      <td style="text-align: left;"><span>{{$dropcity[0]['drop_city']}}</span> </td>
                    </tr>
                    <tr style="line-height: 1.5;">
                      <td style="text-align: left;"><span><b>Drop Location</b></span> </td>
                      <td style="text-align: left;"><span>{{$book_cab[0]['drop_location']}}</span> </td>
                    </tr>
                    <!-- <tr style="line-height: 1.5;">
                      <td style="text-align: left;vertical-align: top;"><span><b>Drop Address</b></span> </td>
                      <td style="text-align: left;"><span>76-77 royal bunglows,<br>opp akruti bunglows,<br>near ﬂorence hospital <br>vesu surat 395007</span> </td>
                    </tr> -->
                </tbody></table>
              </div>
              <div style="width:335px;display:inline-block;padding: 5px;vertical-align: top;">
                <table style="text-align:center;border-collapse:collapse;font-size: 13.5px;">
                  <tbody><tr>
                    <td colspan="2" style="text-align: left;"><span style="color: #2e93e4;"><b>Estimated Taxi Fare</b></span> </td>
                  </tr>
                  <tr style="line-height: 1.5;">
                    <td style="width: 195px;text-align: left;"><span><b>Base Fare</b></span> </td>
                    <td style="text-align: right;"><span>Rs {{$one_way_cab[0]['amount']}}/-</span> </td>
                  </tr>

                  <tr style="line-height: 1.5;">
                    <td style="text-align: left;"><span><b>Tall Tax</b></span> </td>
                    <td style="text-align: right;"><span>@if($one_way_cab[0]['tax'] == '')Include @elseif($one_way_cab[0]['tax'] == 0) Include @else Rs. {{$one_way_cab[0]['tax']}}/- @endif</span> </td>
                  </tr>



              <tr style="line-height: 1.5;">
                <td style="text-align: left;"><span><b>State Tax</b></span> </td>
                <td style="text-align: right;"><span>@if($one_way_cab[0]['state_tax'] == '')Include @elseif($one_way_cab[0]['state_tax'] == 0) Include @else Rs. {{$one_way_cab[0]['state_tax']}}/- @endif</span> </td>
              </tr>



              <tr style="line-height: 1.5;">
                <td style="text-align: left;"><span><b>Driver Allowance</b></span> </td>
                <td style="text-align: right;"><span>@if($one_way_cab[0]['driver_allowance'] == '')Include @elseif($one_way_cab[0]['driver_allowance'] == 0) Include @else Rs. {{$one_way_cab[0]['driver_allowance']}}/- @endif</span> </td>
              </tr>

                  <tr style="line-height: 1.5;">
                    <td style="text-align: left;"><span><b>Package Discount</b></span> </td>
                    <td style="text-align: right;"><span>@if($book_cab[0]['discount'] == '') Include @elseif($book_cab[0]['discount'] == 0) Inlcude @else Rs. {{$book_cab[0]['discount']}}/-@endif</span> </td>

                  </tr>
                  <tr style="line-height: 1.5;">
                    <td style="text-align: left;"><span><b>Estimated Trip Fare</b></span> </td>
                    <td style="text-align: right;"><span>Rs. {{$book_cab[0]['total_amount']}}/-</span> </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="text-align: left;">
                    <span style="color: #2e93e4;"><b>Extra charges, if applicable</b></span><br>
                    <span style="font-size: 12px;">(to be paid to the driver after trip ends.)</span>
                    </td>
                  </tr>
                  <tr style="line-height: 1.5;">
                    <td style="text-align: left;vertical-align: top;"><span><b>Airport Parking</b></span> </td>
                    <td style="text-align: right;"><span>As Per Actual</span> </td>
                  </tr>
                                  </tbody></table>
              </div>

              <div style="border-top:1px solid #c1c1c1;margin-top: -4px;">

                  <div style="padding:5px;">
                    <span>Please Note-</span><br>
                    <ul style="border-bottom: 1px solid #c1c1c1">
                        <li>Please verify the opening & closing Time / KMS readings journey.</li>
                        <li>For any further clarications, write to us or call us +91 {{helpers::mobile()}}.</li>
                    </ul>

                    <span>Kind Regards,</span><br>
                      <span>Reservations Team,</span><br>
                      <span><b>{{helpers::name()}}</b></span>

                  </div>
              </div>

            </div>
          </div>
        </section>
      </div>
    </section>
   <footer class="footerRight"> <span><b>Printed By : Mobility Right System</b></footer>
</body>
</html>
