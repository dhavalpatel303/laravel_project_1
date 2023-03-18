@include('layouts._top_bar')

<head>
    <title>{{helpers::name()}} | Round Trip PriceList</title>
</head>
<style>
   .mtop{
       margin-top: 15px;
   }
</style>
<html class="loading" lang="en" data-numberdirection="ltr">
    <!-- BEGIN: Head-->

    <!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Round Trip Price List</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <!-- Basic Horizontal form layout section start -->
                    <section id="basic-horizontal-layouts">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <section id="input-sizing">
                                    <div class="row match-height">
                                        <div class="col-md-12 col-12">
                                            <div class="card price2"  >
                                                <div class="card-header">
                                                    <h4 class="card-title">Round Trip Price List</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!! Form::model($price, ['method' => 'Patch','class'=>'form-control col-md-12','route' => ['insertrecord', $lastid_get]]) !!}
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input type="hidden" name="lastid" value="{{$lastid_get->id}}" />
                                                                    {{-- <input type="hidden" name="lastid" value="{{$lastid_get->id}}" /> --}}
                                                            <table  class="table table-bordered">
                                                                <thead>
                                                                <tr>
                                                                    <th>City name</th>
                                                                    <th>SEDAN (Rs.Per Km)</th>
                                                                      <th>SUV (Rs.Per Km)</th>

                                                                    <th>INNOVA (Rs.Per Km)</th>
                                                                    <th>Tempo Travels (Rs.Per Km)</th>
                                                                    <th>Prime Sedan (Rs.Per Km)</th>
                                                                    <th>Prime Suv (Rs.Per Km)</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="table-responsive">
                                                                    {{-- @php $i=0; @endphp --}}

                                                                    @foreach($price as $value)

                                                                    {{-- @php $i++; @endphp --}}
                                                                    <tr>
                                                                    <td style="padding: 0px"><input type="text" class="form-control price" readonly="true" value="{{$value->pick_city}}">
                                                                        <input type="hidden" class="form-control price" id="pcity_id"name="pcity_id[]" readonly="true" value="{{$value->pcity_id}}">
                                                                    </td>
                                                                    <td><input type="text" class="form-control" id="sedan_km_rs"  name ="sedan_km_rs[]" value="{{$value->sedan_km_rs}}" required></td>
                                                                    <td><input type="text" class="form-control" id="suv_km_rs" name = "suv_km_rs[]" value="{{$value->suv_km_rs}}" required></td>
                                                                    <td><input type="text" class="form-control" id="innova_km_rs"  name = "innova_km_rs[]" value="{{$value->innova_km_rs}}" required></td>
                                                                    <td><input type="text" class="form-control" id="tempo_tra_km_rs" name = "tempo_tra_km_rs[]" value="{{$value->tempo_tra_km_rs}}" required></td>
                                                                    <td><input type="text" class="form-control" id="primesedan_km_rs" name = "primesedan_km_rs[]" value="{{$value->primesedan_km_rs}}" required></td>
                                                                    <td><input type="text" class="form-control" id="primesuva_km_rs" name = "primesuv_km_rs[]" value="{{$value->primesuv_km_rs}}" required></td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <button class="btn btn-primary waves-effect waves-float waves-light mtop" style="float:right;" type="submit">Submit</button>
                                                        </div>
                                                    </div>
                                                    {{-- <button class="btn btn-primary waves-effect waves-float waves-light mtop "  type="submit">Submit</button> --}}
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                </section>

                            </div>
                        </div>
                    </section>
                    <!-- full Editor start -->


  <!-- full Editor end -->
                </div>
            </div>
        </div>
        <!-- END: Content-->

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        @include('layouts._footer')

     <!-- BEGIN: Page Vendor JS-->




<script type="text/javascript">

    $(document).ready(function() {

       $('.ckeditor').ckeditor();

    });

</script>



</html>
    <script>
        $(window).on('load',  function(){
          if (feather) {
            feather.replace({ width: 14, height: 14 });
          }
        })
      </script>
    </body>
    <!-- END: Body-->


</html>
