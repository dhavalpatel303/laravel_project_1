
<?php echo $__env->make('frontend.layout._top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('frontend.layout._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="breadcrumb-section position-relative z-2 overflow-hidden mt--75" data-background="<?php echo e(asset('front-assets/assets/img/shapes/texture-bg.png')); ?>" style="background-image: url(&quot;assets/img/shapes/texture-bg.png&quot;);">
            <img src="<?php echo e(asset('front-assets/assets/img/shapes/tire-print-left.png')); ?>" alt="tire print" class="position-absolute start-0 z-1 tire-print">
            <img src="<?php echo e(asset('front-assets/assets/img/shapes/tire-print-right.png')); ?>" alt="tire print" class="position-absolute end-0 z-1 tire-print">
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
                            <h2 class="mb-5">Signup!<br>For New Account.</h2>
                            <?php echo Form::open(array('route' => 'homelogin','id'=>'userlogin','class'=>'login-form','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')); ?>

                            
                                <label class="fw-semibold text-secondary mb-2">Name</label>
                                <input type="email" class="form-control" name="name" id="name" placeholder="Enter Name" required="" >

                                <label class="fw-semibold text-secondary mb-2 mt-4">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" required="" >

                                <label class="fw-semibold text-secondary mb-2 mt-4">Moblie Number</label>
                                <input type="number" placeholder="Enter Mobile Number" pattern="/^-?\d+\.?\d*$/"  onKeyPress="if(this.value.length==10) return false;" id="number" name="number"class="form-control"/>

                                <div class="login-btns d-flex align-items-center flex-wrap flex-sm-nowrap mt-40">
                                    <button  type="button" id="reg_submit"  class="btn btn-primary">Sign up</button>
                                     
                                </div>
                                <p class="text-xl-center mt-4">Don't have an account? <a href="<?php echo e(route('signup')); ?>">Login</a></p>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 offset-xl-2">
                        <div class="login-form-right position-relative z-1 mt-5 mt-xl-0">
                            <img src="<?php echo e(asset('front-assets/assets/img/login-illustration.png')); ?>" alt="not found" class="img-fluid">
                            <span class="bg-star-color position-absolute z--1 end-0 bottom-0"></span>
                            <img src="<?php echo e(asset('front-assets/assets/img/shapes/ball.png')); ?>" alt="not found" class="position-absolute ball-shape z--1">
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php echo $__env->make('frontend.layout._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                    url:"<?php echo e(route('ragister.store')); ?>",
                                    data:{name:name,number: number,email:email},
                                    dataType: 'JSON',
                                    success:function(result){

                                        if(result==1)
                                        {
                                            window.location.replace('<?php echo e(route('signup')); ?>');

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


<?php /**PATH C:\xampp\htdocs\demo_web\resources\views/frontend/ragister/index.blade.php ENDPATH**/ ?>