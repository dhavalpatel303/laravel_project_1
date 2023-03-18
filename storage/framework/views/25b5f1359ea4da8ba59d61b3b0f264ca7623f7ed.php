<?php echo $__env->make('frontend.layout._top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
   
        <?php echo $__env->make('frontend.layout._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <section class="breadcrumb-section position-relative z-2 overflow-hidden mt--75" data-background="<?php echo e(asset('front-assets/assets/img/shapes/texture-bg.png')); ?>" style="background-image: url(&quot;<?php echo e(asset('front-assets/assets/img/shapes/texture-bg.png')); ?>&quot;);">
    <img src="<?php echo e(asset('front-assets/assets/img/shapes/tire-print-left.png')); ?>" alt="tire print" class="position-absolute start-0 z-1 tire-print">
    <img src="<?php echo e(asset('front-assets/assets/img/shapes/tire-print-right.png')); ?>" alt="tire print" class="position-absolute end-0 z-1 tire-print">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                    <h1 class="text-white">Contact Us</h1>
                </div>
            </div>
        </div>
    </div>
</section>  
<section class="contact-section pt-120">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="contact-form-area bg-white rounded">
                            <h4 class="mb-3">Need Help? Send Message</h4>
                            <!-- <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div><br />
                            <?php endif; ?> -->
                            <?php if(session()->has('success')): ?>
                            <div class="alert alert-success" role="alert">
                                <div class="alert-body">
                                    <?php echo e(session()->get('success')); ?>

                                 </div>
                            </div>
                            <?php endif; ?>
                            <h3 style="text-align: center"><span id="success_messge" class="success_messge"></span></h3>
                            <?php echo Form::open(array('route' => 'contact.contactdetails','class'=>'ct-form-wrapper','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')); ?>

                            
                                <div class="row g-4">
                                    <div class="col-sm-4">
                                        <div class="input-field">
                                            <label class="fw-semibold text-secondary mb-1">Name</label>
                                            
                                            <?php echo Form::text('name', null, array('placeholder' => 'Enter Name','id'=>'name','name'=>'name','class' => 'border w-100 rounded')); ?>

                                            
                                            <span style="color:red"><?php echo e($errors->first('name')); ?></span>
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-field">
                                            <label class="fw-semibold text-secondary mb-1">Email</label>
                                            <?php echo Form::text('email', null, array('placeholder' => 'Enter Email Address','id'=>'email','name'=>'email','class' => 'border w-100 rounded')); ?>

                                            <label id="email_result"></label>
                                            <span style="color:red"><?php echo e($errors->first('email')); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-field">
                                            <label class="fw-semibold text-secondary mb-1">Phone</label>
                                            <?php echo Form::text('number', null, array('placeholder' => 'Enter Mobile Number','id'=>'number','name'=>'number','class' => 'border w-100 rounded')); ?>

                                            
                                            <span style="color:red"><?php echo e($errors->first('number')); ?></span>
                                            
                                        </div>
                                    </div>
                                  
                                    <div class="col-sm-12">
                                        <div class="input-field">
                                            <label class="fw-semibold text-secondary mb-1">Message</label>
                                            <?php echo Form::textarea('message', null, array('placeholder' => 'Enter message ...','id'=>'message','name'=>'message','class' => 'border w-100 rounded','rows'=>6)); ?>

                                            
                                            <span style="color:red"><?php echo e($errors->first('message')); ?></span>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="g-recaptcha" data-sitekey="6Lf6fvwkAAAAAGrWT3Q2GBeZHaQ_7EkIW-pKVpZ-"></div>
                                   
                                   <span style="color:red"><?php echo e($errors->first('captcha')); ?></span>
                                </div>
                                <div class="col-sm-12 text_center">
                                <button class="btn btn-primary btn-md mt-4" type="submit" id="form_submit">Get in Touch</button>
                                </div>
                            <?php echo Form::close(); ?>


                            
  
   
  
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="contact-sidebar-widget py-5 px-4 bg-white rounded mt-5 mt-xl-0">
                            <h4 class="mb-4">Contact Details</h4>
                            <ul class="fs-md">
                                <li class="fw-500"><strong class="fw-bold text-secondary">Office Address-1: </strong><?php echo e(helpers::address()); ?></li>
                                
                            </ul>
                            <hr class="mt-4 mb-4">
                            <ul class="contact-info">
                                <li class="d-flex align-items-center">
                                    <span class="icon-wrapper d-flex align-items-center justify-content-center rounded bg-light-primary rounded-circle flex-shrink-0"><i class="fa-brands fa-whatsapp"></i></span>
                                    <div class="ms-3 info-content">
                                        <span class="d-block">Emergency Call:</span>
                                        <a href="tel:<?php echo e(helpers::mobile()); ?>"><?php echo e(helpers::mobile()); ?></a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <span class="icon-wrapper d-flex align-items-center justify-content-center rounded bg-light-primary rounded-circle flex-shrink-0"><i class="fa-regular fa-envelope"></i></span>
                                    <div class="ms-3 info-content">
                                        <span class="d-block">General communication</span>
                                        <a href="maito:<?php echo e(helpers::email()); ?>"><?php echo e(helpers::email()); ?></a>
                                    </div>
                                </li>
                            </ul>
                            <hr class="mt-30 mb-40">
                           

                        </div>
                    </div>
                </div>
            </div>
            <div class="map-wrapper mt-40">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.875205328703!2d72.87287411479738!3d21.197115885907408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f3f60102c4d%3A0xa57c22bc0f9e7956!2smSquare%20Tech!5e0!3m2!1sgu!2sin!4v1677731322304!5m2!1sgu!2sin" style="border:0; width:100%; height: 400px;" allowfullscreen="" loading="lazy"></iframe>
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



      
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
        <!-- Js Files End -->
 
<?php /**PATH C:\xampp\htdocs\demo_web\resources\views/frontend/contact/index.blade.php ENDPATH**/ ?>