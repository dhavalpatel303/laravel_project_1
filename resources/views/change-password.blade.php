<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>{{helpers::name()}} | Change Password</title>
    </head>
        @include('layouts._top_bar')


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
                        <h4 class="page-title">Change Password</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Change Password</h4>

                                <p style="text-align: center;"><span id="old_pass" class="old_pass"></span></p>
                                <p style="text-align: center;"><span id="new_pass" class="new_pass"></span></p>
                                <p style="text-align: center;"><span id="change_pass" class="change_pass"></span></p>

                                {!! Form::open(array('route' => 'change-password','class'=>'form form-horizontal','id'=>'change_form','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
                                     <input type="hidden" name="ci_csrf_token" value="">
                                    <div class="form-group">
                                        <label for="name">Current Password <span class="red">*</span></label>
                                        <input type="password" name="current_password" id="password" placeholder="Current Password" class="form-control" autocomplete="current-password">
                                        <div><span style="color: red;" id="error_1"></span></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="mobileno">Enter New Password <span class="red">*</span></label>
                                        <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control" autocomplete="new_password">
                                        <div><span style="color: red;" id="error_2"></span></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="mobileno">Confirm Password <span class="red">*</span></label>
                                        <input type="password" name="new_confirm_password" id="new_confirm_password" placeholder="Confirm Password" class="form-control" autocomplete="new_confirm_password">
                                        <div><span style="color: red;" id="error_3"></span></div>
                                    </div>
                                    <button type="button"  id="change_submit" class="btn btn-primary">Update</button>
                                {!!Form::close()!!}
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    $(document).on('submit', '#frm', function(event) {

                        if ($('#npass').val() != $('#cpass').val()) {
                            alert('Confirm Password Not Match');
                            return false;
                        }

                    });
                </script>

            </div>
        </div>
    </div>
    <div class="chat-windows"></div>
   @include('layouts._footer')
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- END: Page JS-->
   <script>
    jQuery(document).ready(function(){
        jQuery('#change_submit').click(function()

        {

            let current_password = $("#password").val();

            let new_password = $("#new_password").val();
            let new_confirm_password = $("#new_confirm_password").val()
            if(current_password=='' || new_password=='' || new_confirm_password==''){
                $("#error_1").css({"color":"red"});
                $("#error_1").css({"font-weight":"800"});
                $("#error_1").css({"font-size":"12px"});
                $("#error_1").html("The Current Password field is required.");
                $("#error_2").css({"color":"red"});
                $("#error_2").css({"font-weight":"800"});
                $("#error_2").css({"font-size":"12px"});
                $("#error_2").html("The New Password field is required.");
                $("#error_3").css({"color":"red"});
                $("#error_3").css({"font-weight":"800"});
                $("#error_3").css({"font-size":"12px"});
                $("#error_3").html("The Confirm Password field is required.");


            }
                else if(current_password=='')
            {
                $("#error_1").css({"color":"red"});
                $("#error_1").css({"font-weight":"800"});
                $("#error_1").css({"font-size":"12px"});
                $("#error_1").html("The Current Password field is required.");

            }else if(new_password==''){
                $("#error_2").css({"color":"red"});
                $("#error_2").css({"font-weight":"800"});
                $("#error_2").css({"font-size":"12px"});
                $("#error_2").html("The New Password field is required.");
            }
            else if(new_confirm_password==''){
                $("#error_3").css({"color":"red"});
                $("#error_3").css({"font-weight":"800"});
                $("#error_3").css({"font-size":"12px"});
                $("#error_3").html("The Confirm Password field is required.");
            }
            else{


                jQuery.ajax({
                    headers: {
                                'X-CSRF-Token': $('input[name="_token"]').val()
                            },
                    type: "POST",
                    url:"{{route('change-password')}}",
                    data:{current_password:current_password,new_password: new_password,new_confirm_password: new_confirm_password},
                    dataType: 'JSON',
                    success:function(result){

                        if(result==1){
                            $("#change_pass").css({"color":"green"});
                            $("#change_pass").css({"font-weight":"800"});
                            $("#change_pass").css({"font-size":"18px"});
                            $("#change_pass").html("Password Change Succesfully");
                            $("#old_pass").hide();
                            $("#new_pass").hide();
                            $("#req_pass").hide();
                            document.getElementById("change_form").reset();
                            setTimeout(function() {
                            location.reload();
                            }, 2000);
                        }else if(result==2){

                            $("#new_pass").css({"color":"red"});
                            $("#new_pass").css({"font-weight":"800"});
                            $("#new_pass").css({"font-size":"12px"});
                            $("#new_pass").html("Your New Password And Your Confirm Password Does Not Match ! Please Try Again");

                        }else if(result==0){
                            $("#old_pass").css({"color":"red"});
                            $("#old_pass").css({"font-weight":"800"});
                            $("#old_pass").css({"font-size":"12px"});
                            $("#old_pass").html("Your Current Password  Does Not Match ! Please Try Again");
                        }else{
                            $("#req_pass").css({"color":"red"});
                            $("#req_pass").css({"font-weight":"800"});
                            $("#req_pass").css({"font-size":"12px"});
                            $("#req_pass").html("All Fileds Are Required");

                        }

                    }
                });
            }
        });
    });
</script>
<script>
          $("#password").change(function(){
            if($("#password").val()=='')
            {
                $("#error_1").show();
            }
            else{
                $("#error_1").hide();
                // $("#change_pass").hide();
            }

        });
        $("#new_password").change(function(){
            if($("#new_password").val()=='')
            {
                $("#error_2").show();
            }
            else{
                $("#error_2").hide();
            }

        });
        $("#new_confirm_password").change(function(){
            if($("#new_confirm_password").val()=='')
            {
                $("#error_3").show();
            }
            else{
                $("#error_3").hide();
            }

        });
</script>

</body>

</html>
