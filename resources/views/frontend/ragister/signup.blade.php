
    @include('frontend.layout._top_bar')
    
        @include('frontend.layout._header')



    <section class="breadcrumb-section position-relative z-2 overflow-hidden mt--75" data-background="{{asset('front-assets/assets/img/shapes/texture-bg.png')}}" style="background-image: url(&quot;assets/img/shapes/texture-bg.png&quot;);">
            <img src="{{asset('front-assets/assets/img/shapes/tire-print-left.png')}}" alt="tire print" class="position-absolute start-0 z-1 tire-print">
            <img src="{{asset('front-assets/assets/img/shapes/tire-print-right.png')}}" alt="tire print" class="position-absolute end-0 z-1 tire-print">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                            <h1 class="text-white">Login/Register</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="login-section ptb-120 position-relative z-1 overflow-hidden">
            <span class="bg-primary-blur position-absolute z--1 start-50 top-0 tarnslate-middle-x"></span>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-xxl-4">
                        <div class="login-form-area">
                            <h2 class="mb-5">Login!<br>In Your Account.</h2>
                            <div id="mobile-number-div">
                                {!! Form::open(array('route' => 'homelogin','id'=>'userlogin','class'=>'login-form','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
                                    
                                        
                                        <label class="fw-semibold text-secondary mb-2">Mobile Number</label>
                                        <input type="number" placeholder="Enter Mobile No" class="form-control" id="user_mobile_login" name="user_mobile" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" required />
                                        <div class="login-btns d-flex align-items-center flex-wrap flex-sm-nowrap mt-40">
                                            <button  type="button" id="loginbutton"  class="btn btn-primary">Sign up</button>
                                            
                                        </div>
                                {!!Form::close()!!}    
                            </div>
                            <div id="ragister_otpdiv">
                                {!! Form::open(array('route' => 'onewayotp_check','id'=>'userlogin','class'=>'login-form','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
                                <h5 style="text-align: center; color: black; font-weight: bold; border: 0px;">
                                    We Send OTP On This Number <br />
                                    <span id="number_show" name="number_show" class="number_show number" style="font-weight: bold; border: 0px;"></span><br />
                                </h5>
                                <div class="col-md-12" style="text-align: center; margin-top: -10px;">
                                    <span id="resend_msg"></span>
                                </div>
                                <label class="fw-semibold text-secondary mb-2">Enter OTP</label>
                                <input type="hidden" name="mobile_number_re" id="mobile_number_re" />
                                <input type="number" placeholder="Enter 4 digit OTP Numbar" class="form-control" id="user_otp" name="user_otp" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" required />
                                <div class="col-md-12" style="text-align: center;">
                                    <h5><span id="otp_wrong" class="wrongotp"></span></h5>
                                </div>
                                <div class="col-md-12" style="text-align: center;">
                                    <span id="searchResend" type="button" style="cursor: pointer;"><a style="color: black; font-weight: 700;">Re-send OTP?</a></span><br />
                                </div><br>
                                <div class="col-md-12" style="text-align: center;">
                                            <button  type="button" id="otpsend"  class="btn btn-primary" style="width:160px">Submit</button>
                                </div>
                                {!!Form::close()!!}
                            </div>
                                    <p class="text-xl-center mt-4">Allready have an account? <a href="{{route('ragister.index')}}">Register</a></p>
                                
                            
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 offset-xl-2">
                        <div class="login-form-right position-relative z-1 mt-5 mt-xl-0">
                            <img src="{{asset('front-assets/assets/img/login-illustration.png')}}" alt="not found" class="img-fluid">
                            <span class="bg-star-color position-absolute z--1 end-0 bottom-0"></span>
                            <img src="{{asset('front-assets/assets/img/shapes/ball.png')}}" alt="not found" class="position-absolute ball-shape z--1">
                        </div>
                    </div>
                </div>
            </div>
        </section>
@include('frontend.layout._footer')
<script>
    const validateEmail = (email) => {
  return email.match(
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
  );
};
const validate = () => {
  const $result = $('#email_result');
  const email = $('#email').val();
  $result.text('');

  if (validateEmail(email)) {
    $result.text(email + ' is valid :)');
    $result.css('color', 'green');

  } else {
    $result.text(email + ' is not valid :(');
    $result.css('color', 'red');

  }
  return false;
}
$('#email').on('input', validate);
</script>
 <script>
    jQuery(document).ready(function(){
                    jQuery('#reg_submit').click(function()
                    {

                        var name = jQuery("#name").val();
                        var number =  $("#number").val();
                        var email = jQuery("#email").val();

                      if(name == '' || number=='' || email=='')
                            {
                                alert('All Filed Are Required');
                            }
                            else
                            {
                                jQuery.ajax({
                                    headers: {
                                                'X-CSRF-Token': $('input[name="_token"]').val()
                                            },
                                    type: "POST",
                                    url:"{{route('ragister.store')}}",
                                    data:{name:name,number: number,email:email},
                                    dataType: 'JSON',
                                    success:function(result){

                                        if(result==1)
                                        {
                                            window.location.replace('{{route('signup')}}');

                                        }
                                        else
                                        {
                                            $("#user_exit").css({"color":"#fc0000"});
                                                $("#user_exit").css({"font-weight":"700"});
                                                $("#user_exit").html("This User is Allready Exits !");

                                        }

                                    }
                                });
                            }




                return false;
            });
            });

</script>


 @include('frontend.layout._footer')

 <script>
    $(function () {
                   $("#ragister_otpdiv").hide();

           $("#loginbutton").click(function () {
               $("#ragister_otpdiv").show();
               $("#mobile-number-div").hide();
           });
       });
   </script>

           {{-- <------------- Open Login Number Popup ----------> --}}
           <script>
            jQuery(document).ready(function(){
                    jQuery('#loginbutton').click(function()
                    {

                        var user_mobile = jQuery("#user_mobile_login").val();

                        if(user_mobile.length != 10){
                            alert("Please Enter 10 Digit Number")
                            $("#ragister_otpdiv").hide();
                            $("#mobile-number-div").show();
                        } else{
                            $("#ragister_otpdiv").show();
                                jQuery.ajax({
                                type: "POST",
                                url:"{{route('homelogin')}}",
                                data:'user_mobile='+user_mobile+
                                '&_token={{csrf_token()}}',
                                dataType: 'JSON',
                                success:function(result){

                                    if(result==1)
                                    {


                                        $("#otp").show();
                                        $("#login_number").hide();
                                        $("#number_show").css({"color":"#2e3b4b"});
                                        $("#number_show").html(user_mobile);
                                        $("#mobile_number_re").val(result['0']);

                                    }
                                    else
                                    {
                                        $("#otp").show();
                                        $("#login_number").hide();
                                        $("#number_show").css({"color":"#2e3b4b"});
                                        $("#number_show").html(user_mobile);
                                        $("#mobile_number_re").val(result['0']);

                                    }

                            }
                        });
                            }

                    return false;
            });
            });
        </script>
           {{-- <------------------ Open Otp Check Butoon ---------------> --}}
           <script>
            $('#searchResend').click(function(){

                      var user_mobile_re = $("#mobile_number_re").val();
                      $.ajax({

                        type: "POST",
                        url: "{{route('resend_otp')}}",
                        dataType: 'json',
                        data:'user_mobile_re='+user_mobile_re+
                                    '&_token={{csrf_token()}}',
                        success: function(res) {
                          $("#resend_msg").css({"color":"#ff6700"});
                          
                          $("#resend_msg").html("OTP Sent Succesfully");
                          $("#mobile_number_re").html(JSON.parse(res['0']));
                          $("#otp-show").html(JSON.parse(res['1']));
                        }
                      });
                    });

            </script>
   <script>
       jQuery(document).ready(function(){
                       jQuery('#otpsend').click(function()
                       {


                           var user_mobile_re =  $("#mobile_number_re").val();
                           var user_otp = jQuery("#user_otp").val();
                           if(user_otp== '')
                               {
                                   alert("Enter Your 4 Digit Otp");
                               }
                           else{
                               jQuery.ajax({
                                       headers: {
                                                   'X-CSRF-Token': $('input[name="_token"]').val()
                                               },
                                       type: "POST",
                                       url:"{{route('onewayotp_check')}}",
                                       data:{user_mobile_re:user_mobile_re,user_otp: user_otp},
                                       dataType: 'JSON',
                                       success:function(result){

                                           if(result==1)
                                           {

                                              window.location.replace('{{route('home.index')}}');


                                           }
                                           else
                                           {
                                               $("#otp_wrong").css({"color":"red"});
                                                   
                                                   $("#otp_wrong").html("OTP Wrong Try Again");

                                           }

                                       }
                                   });
                                }




                   return false;
               });
               });

   </script>
        <script>
            var input = document.getElementById("user_mobile_login");
            input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("loginbutton").click();
            }
            });
            </script>
            <script>
                var input = document.getElementById("user_otp");
                input.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    document.getElementById("otpsend").click();
                }
                });
                </script>
    </body>


</html>
