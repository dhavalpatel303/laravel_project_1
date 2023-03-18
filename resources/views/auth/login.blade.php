<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Login</title>
    </head>
        @include('layouts._top_bar')

<body>
    <div class="main-wrapper">
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
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{asset('app-assets/assets/images/big/auth-bg.jpg')}}) no-repeat center center;">
            <div class="auth-box">
                <div>
                    <div class="logo">
                        <?php $site_logo = helpers::logo();?>

                        <span class="db"><img alt="thumbnail" class="" width="100" src="{{asset('logo/'.$site_logo)}}"></span><br>
                        <h5 class="font-medium mb-3" style="margin-top:15px"><b>Sign In To Admin</b></h5>
                    </div>
                    <!-- Form -->
                    <div class="row">

                        <div class="col-12">
                            <p style="text-align: center;"><span id="wrong_details" class="wrong_details"></span></p>
                            {!! Form::open(array('route' => 'login_admin.index','id'=>'contact_form','class'=>'form-horizontal mt-3','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}

                                <div class="form-group row">
                                    <div class="col-12">
                                        @csrf

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                            </div>
                                            {!! Form::text('email', null, array('placeholder' => 'Enter User Name','id'=>'email','name'=>'email','class' => 'form-control form-control-lg')) !!}

                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                            </div>
                                            <input class="form-control form-control-lg" type="password" id="password" name="password" required="" placeholder="Password">
                                        </div>
                                        <div class="form-group text-center">
                                            <div class="col-xs-12 pb-3">
                                                <button class="btn btn-block btn-lg btn-info"  id="login_button" type="button">Log In</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            {!!form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{asset('app-assets/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('app-assets/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('app-assets/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    </script>
     <script>
        var input = document.getElementById("password");
        input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("login_button").click();
        }
        });
        </script>
    <script>
        $(window).on("load", function () {
            if (feather) {
                feather.replace({ width: 14, height: 14 });
            }
        });
    </script>
    <script>
        jQuery(document).ready(function(){
            jQuery('#login_button').click(function()

            {

                let email = $("#email").val();

                let pass = $("#password").val();

                jQuery.ajax({
                    headers: {
                                'X-CSRF-Token': $('input[name="_token"]').val()
                            },
                    type: "POST",
                    url:"{{route('login_admin.index')}}",
                    data:{email:email,pass: pass},
                    dataType: 'JSON',
                    success:function(result){

                        if(result==1){
                                window.location.replace('{{route('home')}}');


                        }else{
                            $("#wrong_details").css({"color":"red"});
                            $("#wrong_details").css({"font-weight":"800"});
                            $("#wrong_details").css({"font-size":"14px"});
                            $("#wrong_details").html("Your Credentials Does Not Match ! Try Again");
                        }

                    }
                });
            });
        });
    </script>
</body>

</html>
