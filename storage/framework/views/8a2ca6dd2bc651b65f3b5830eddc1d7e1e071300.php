
    <?php echo $__env->make('frontend.layout._top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('frontend.layout._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>     

    <!-- slider-area -->
      <?php if($request->pickcity_id==''): ?>
      <section class="breadcrumb-section position-relative z-2 overflow-hidden mt--75" data-background="<?php echo e(asset('front-assets/assets/img/shapes/texture-bg.png')); ?>" style="background-image: url(&quot;<?php echo e(asset('front-assets/assets/img/shapes/texture-bg.png')); ?>&quot;);">
<img src="<?php echo e(asset('front-assets/assets/img/shapes/tire-print-left.png')); ?>" alt="tire print" class="position-absolute start-0 z-1 tire-print">
<img src="<?php echo e(asset('front-assets/assets/img/shapes/tire-print-right.png')); ?>" alt="tire print" class="position-absolute end-0 z-1 tire-print">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                <h1 class="text-white">Select cab</h1>
            </div>
        </div>
    </div>
</div>
</section>  
<section class="inventory-details-area ptb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
            <div class="iv_listing mt-5 mt-xl-0">
                    
                    <div class="row g-4">
                    <?php for ($i = 0; $i < count($onewaydetails); $i++) { ?>
                    
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                            <?php echo Form::open(array('route' => ['onewaybookcab.index',['onewaydetails_id' => $onewaydetails[$i]['id'] ]],'id'=>'onewayformid','action'=>'onewaybookcab','method'=>'Get','files' =>
                                'true','enctype'=>'multipart/form-data')); ?>

                                <div class="filter-card-item position-relative overflow-hidden rounded bg-white bx_shadow2">
                                  
                                
                                    <div class="feature-thumb position-relative overflow-hidden">
                                        <a><img src="<?php echo e(asset('public/profile/'.$onewaydetails[$i]['image'])); ?>" alt="car" class="img-fluid img_height"></a>
                                    </div>
                                    <div class="filter-card-content">
                                        <div class="price-btn text-end position-relative">
                                            <span class="small-btn-meta"><i class="fa-solid fa-inr f_14"></i> <?php echo e($onewaydetails[$i]['total_amount']); ?></span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <a class="mt-4 d-block">
                                                <h5><?php echo e($onewaydetails[$i]['cab']); ?></h5>
                                            </a>    
                                            </div>
                                            <div class="col-md-6 ">
                                            <a class="mt-4 d-block" data-toggle="modal" data-target="#modal_<?php echo e($onewaydetails[$i]['id']); ?>" >
                                                <h5 class="fl_right" ><i class="fa-solid fa-eye f_14"></i><span class="f_14"> Fare Details </span></h5>
                                            </a>    
                                            </div>
                                        </div>
                                        
                                        <span class="meta-content"><strong></strong></span>
                                        <hr class="spacer mt-3 mb-3">
                                        <div class="card-feature-box d-flex align-items-center mb-4">
                                            <div class="icon-box d-flex align-items-center">
                                                <span class="me-2"><img src="<?php echo e(asset('front-assets/assets/img/user.png')); ?>" class="i_height"></span>
                                                <?php echo e($onewaydetails[$i]['seat']); ?>

                                            </div>
                                            <div class="icon-box d-flex align-items-center">
                                            <span class="me-2"><img src="<?php echo e(asset('front-assets/assets/img/bag.png')); ?>" class="i_height"></span>
                                            <?php echo e($onewaydetails[$i]['bag']); ?>

                                            </div>
                                            <div class="icon-box d-flex align-items-center">
                                            <span class="me-2"><img src="<?php echo e(asset('front-assets/assets/img/ac_1.png')); ?>" class="ac_height"></span>
                                                Ac
                                            </div>
                                            <div class="icon-box d-flex align-items-center">
                                            <span class="me-2"><img src="<?php echo e(asset('front-assets/assets/img/sen.png')); ?>" class="ac_height"></span>
                                                Senitize
                                            </div>
                                        </div>
                                        <?php if(session()->get('user_mobile')): ?>
                                            <a href="<?php echo e(route('onewaybookcab.index',['onewaydetails_id' => $onewaydetails[$i]['id'] ])); ?>" type="submit" class="btn outline-btn btn-sm d-block">Book Now</a>
                                            <?php else: ?>
                                            <a type="button" data-toggle="modal" data-target="#login-number" class="btn outline-btn btn-sm d-block findcar"> Book Now</a>
                                            <?php endif; ?>
                                        
                                    </div>
                                </div>
                                <?php echo Form::close(); ?>

                            </div>
                        
                        <?php }?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
        <section class="about-section pt-50 pb-50 bg-primary-light position-relative z-1 overflow-hidden" data-background="http://localhost/demo_web/front-assets/assets/img/shapes/about-bg.jpg" style="background-image: url(&quot;http://localhost/demo_web/front-assets/assets/img/shapes/about-bg.jpg&quot;);">
            <img src="http://localhost/demo_web/front-assets/assets/img/shapes/tire-primary-light.png" alt="tire" class="tire-primary-light position-absolute end-0 top-0 z--1">
            <span class="small-circle-shape position-absolute z--1"></span>
            <div class="container">
                <div class="row align-items-center">
                <div class="section-heading">
                        <h2 class="sec__title sec_title2">  <?php echo e($pickupcity->pick_city); ?> To <?php echo e($dropcity->drop_city); ?> One Way Taxi Services</h2>
                    </div><!-- end section-heading -->
                    <div>
                    <p><?php echo e(helpers::name()); ?> gives a One Way Taxi rental help from <?php echo e($pickupcity->pick_city); ?> To <?php echo e($dropcity->drop_city); ?>. Assuming that you are keen on one way drop taxi, you can book one way drop taxi from <?php echo e($pickupcity->pick_city); ?> to <?php echo e($dropcity->drop_city); ?>, which cost around a portion of the full circle rate. <?php echo e($pickupcity->pick_city); ?> to <?php echo e($dropcity->drop_city); ?> taxi administration remembers the get from any area for <?php echo e($pickupcity->pick_city); ?> city and drop off anyplace in <?php echo e($dropcity->drop_city); ?> city. <?php echo e(helpers::name()); ?> gives moment booking and every minute of every day accessibility.</p>
                    <h2 class="sec__title sec_title2">  <?php echo e($pickupcity->pick_city); ?> To <?php echo e($dropcity->drop_city); ?> Cabs At Lowest Price</h2>
                    <p><?php echo e(helpers::name()); ?> offers the most reduced costs on <?php echo e($pickupcity->pick_city); ?> to <?php echo e($dropcity->drop_city); ?> taxis across a wide assortment of taxis or taxicabs. In the event that you are searching for vehicle rental administrations in <?php echo e($pickupcity->pick_city); ?>, <?php echo e(helpers::name()); ?> gives a wide assortment of cabs models you can choose. Select the classification of a taxi that is the most ideal to your prerequisite. Get the best offers and markdown on our AC taxi from <?php echo e($pickupcity->pick_city); ?> to <?php echo e($dropcity->drop_city); ?> for one way excursion and full circle ventures</p>
                    
                    <h2 class="sec__title sec_title2">  <?php echo e($pickupcity->pick_city); ?> To <?php echo e($dropcity->drop_city); ?> Car Rental Service</h2>
                    <p><?php echo e(helpers::name()); ?> offers agreeable and completely adaptable one way taxi, outstation taxi and vehicle rental assistance from <?php echo e($pickupcity->pick_city); ?> to <?php echo e($dropcity->drop_city); ?>, or book taxis from <?php echo e($pickupcity->pick_city); ?> to <?php echo e($dropcity->drop_city); ?>. Visit our valuing choice for <?php echo e($pickupcity->pick_city); ?> to <?php echo e($dropcity->drop_city); ?> one way taxi for more detail. You can likewise contact our client care number recorded on our site to get limits and offers on <?php echo e($pickupcity->pick_city); ?> to <?php echo e($dropcity->drop_city); ?> vehicle recruit charges.</p>
                    
                    <h2 class="sec__title sec_title2">  <?php echo e($pickupcity->pick_city); ?> To <?php echo e($dropcity->drop_city); ?> Taxi Service</h2>
                    <p>Get the most reduced passages on <?php echo e($pickupcity->pick_city); ?> to <?php echo e($dropcity->drop_city); ?> on <?php echo e(helpers::name()); ?>. Book from an extensive variety of vehicle rental choice in <?php echo e($pickupcity->pick_city); ?> - Car, Hatchbacks or SUVs and more. <?php echo e(helpers::name()); ?> suggests Vehicle scope of vehicles on the off chance that you are traveling alone or with an accomplice or little family. In any case, to go in a gathering, go for Innova or comparable vehicles, select the one that best suits your necessities.</p>
                    
                    <h2 class="sec__title sec_title2">  <?php echo e($pickupcity->pick_city); ?> To <?php echo e($dropcity->drop_city); ?> by Car</h2>
                    <p>One way taxi from <?php echo e($pickupcity->pick_city); ?> To <?php echo e($dropcity->drop_city); ?> is the perfect choice for all travelers who would like to move one way only from <?php echo e($pickupcity->pick_city); ?> to <?php echo e($dropcity->drop_city); ?>. One way cab or One way taxi would easily pick you up from <?php echo e($pickupcity->pick_city); ?> and Drop you off at your destination in Ahemdabad. Your One Way Cab is 100% personal, not shared with anyone. It will 100% safe, clean and dedicated cab for you.</p>
                    
                    <h2 class="sec__title sec_title2">One Way Cab   <?php echo e($pickupcity->pick_city); ?> To <?php echo e($dropcity->drop_city); ?></h2>
                    <p>We design our routes, pricing, and packages in a way, So everyone can get benefits by paying only for one way trip instead of round trip charges. Book your one way cab from <?php echo e($pickupcity->pick_city); ?> To <?php echo e($dropcity->drop_city); ?> Cab and enjoy your journey!</p>
                    
                    <h2 class="sec__title sec_title2">Cab Service In <?php echo e($pickupcity->pick_city); ?></h2>
                    <p> <?php echo e(helpers::name()); ?> is a popular Cab service that operates in <?php echo e($pickupcity->pick_city); ?>. They offer a variety of vehicles, including standard sedans, luxury sedans, and SUVs.</p>
                    
                    <h2 class="sec__title sec_title2">Taxi Service In <?php echo e($pickupcity->pick_city); ?></h2>
                    <p><?php echo e(helpers::name()); ?> is a popular ride-hailing service in <?php echo e($pickupcity->pick_city); ?>, offering a wide range of cabs to suit your needs. With <?php echo e(helpers::name()); ?>, you can choose from budget-friendly options like <?php echo e(helpers::name()); ?> Mini or luxury rides like <?php echo e(helpers::name()); ?> Prime.</p>
                    
                    </div>
                </div>
            </div>
        </section>
        <?php for ($j = 0; $j < count($onewaydetails); $j++){?>
            <div class="modal fade" id="modal_<?php echo e($onewaydetails[$j]['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered " role="document" style="padding-top: 0px;">
                    <div class="modal-content   ">
                        <div class="modal-header" style="border-bottom:1px solid #e9ecef;background-color:#ff0000">
                            <label style="color: white;font-weight:700;font-size:20px">Fare Details</label> 
                            <button type="button" id="oneway_close" class="close btn_close" data-dismiss="modal" ><i class="fa fa-times"></i></button>
                        </div>
                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 col-lg-12 col-md-12 fare-area" id="loadfare">
                                                    <div class="fare-area">
                                                        <h4>Fare Breakup:</h4>
                                                        <h5 class="f_16">Base Fare <span class="fl_right"> ₹ <?php echo e($onewaydetails[$j]['amount']); ?> </span></h5>
                                                        <h5 class="f_16">Toll Tax <span class="fl_right"> ₹ <?php echo e($onewaydetails[$j]['tax']); ?> </span></h5>
                                                        <h5 class="f_16">State Tax <span class="fl_right"> ₹ <?php echo e($onewaydetails[$j]['state_tax']); ?> </span></h5>
                                                        <h5 class="f_16">Driver Allowance <span class="fl_right"> ₹ <?php echo e($onewaydetails[$j]['driver_allowance']); ?> </span></h5>
                                                        <h5 class="f_16">Estimated Amount <span  class="fl_right" style="font-weight: 900"> ₹ <?php echo e($onewaydetails[$j]['total_amount']); ?> </span></h5>


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row fare-area">
                                                <div class="col-lg-12">
                                                    <?php echo $oneway_note->oneway_note; ?>

                                                </div>
                                            </div>
                                        </div>

                    </div>
                    </div>
            </div>
<?php }?>



       <?php else: ?>
       <section class="breadcrumb-section position-relative z-2 overflow-hidden mt--75" data-background="<?php echo e(asset('front-assets/assets/img/shapes/texture-bg.png')); ?>" style="background-image: url(&quot;<?php echo e(asset('front-assets/assets/img/shapes/texture-bg.png')); ?>&quot;);">
<img src="<?php echo e(asset('front-assets/assets/img/shapes/tire-print-left.png')); ?>" alt="tire print" class="position-absolute start-0 z-1 tire-print">
<img src="<?php echo e(asset('front-assets/assets/img/shapes/tire-print-right.png')); ?>" alt="tire print" class="position-absolute end-0 z-1 tire-print">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                <h1 class="text-white">Select cab</h1>
            </div>
        </div>
    </div>
</div>
</section>  
<section class="inventory-details-area ptb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
            <div class="iv_listing mt-5 mt-xl-0">
                    
                    <div class="row g-4">
                    <?php for ($i = 0; $i < count($localdetails); $i++) { ?>
                    
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                            <?php echo Form::open(array('route' => ['localbookcab.index',['localdetails_id' => $localdetails[$i]['id'] ]],'id'=>'onewayformid','action'=>'onewaybookcab','method'=>'Get','files' =>
                                'true','enctype'=>'multipart/form-data')); ?>

                                <div class="filter-card-item position-relative overflow-hidden rounded bg-white bx_shadow2">
                                 
                                    <div class="feature-thumb position-relative overflow-hidden">
                                        <a><img src="<?php echo e(asset('public/profile/'.$localdetails[$i]['image'])); ?>" alt="car" class="img-fluid img_height"></a>
                                    </div>
                                    <div class="filter-card-content">
                                        <div class="price-btn text-end position-relative">
                                            <span class="small-btn-meta"><i class="fa-solid fa-inr f_14"></i> <?php echo e($localdetails[$i]['total_amount']); ?></span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <a class="mt-4 d-block">
                                                <h5><?php echo e($localdetails[$i]['cab']); ?></h5>
                                            </a>    
                                            </div>
                                            <div class="col-md-6 ">
                                            <a class="mt-4 d-block" data-toggle="modal" data-target="#modal_<?php echo e($localdetails[$i]['id']); ?>" >
                                                <h5 class="fl_right" ><i class="fa-solid fa-eye f_14"></i><span class="f_14"> Fare Details </span></h5>
                                            </a>    
                                            </div>
                                        </div>
                                        
                                        <span class="meta-content"><strong></strong></span>
                                        <hr class="spacer mt-3 mb-3">
                                        <div class="card-feature-box d-flex align-items-center mb-4">
                                            <div class="icon-box d-flex align-items-center">
                                                <span class="me-2"><img src="<?php echo e(asset('front-assets/assets/img/user.png')); ?>" class="i_height"></span>
                                                <?php echo e($localdetails[$i]['seat']); ?>

                                            </div>
                                            <div class="icon-box d-flex align-items-center">
                                            <span class="me-2"><img src="<?php echo e(asset('front-assets/assets/img/bag.png')); ?>" class="i_height"></span>
                                            <?php echo e($localdetails[$i]['bag']); ?>

                                            </div>
                                            <div class="icon-box d-flex align-items-center">
                                            <span class="me-2"><img src="<?php echo e(asset('front-assets/assets/img/ac_1.png')); ?>" class="ac_height"></span>
                                                Ac
                                            </div>
                                            <div class="icon-box d-flex align-items-center">
                                            <span class="me-2"><img src="<?php echo e(asset('front-assets/assets/img/sen.png')); ?>" class="ac_height"></span>
                                                Senitize
                                            </div>
                                        </div>
                                        <?php if(session()->get('user_mobile')): ?>
                                            <a href="<?php echo e(route('localbookcab.index',['localdetails_id' => $localdetails[$i]['id'] ])); ?>" type="submit" class="btn outline-btn btn-sm d-block">Book Now</a>
                                            <?php else: ?>
                                            <a type="button" data-toggle="modal" data-target="#login-number" class="btn outline-btn btn-sm d-block findcar"> Book Now</a>
                                            <?php endif; ?>
                                        
                                    </div>
                                </div>
                                <?php echo Form::close(); ?>

                            </div>
                        
                        <?php }?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
        <section class="about-section pt-50 pb-50 bg-primary-light position-relative z-1 overflow-hidden" data-background="http://localhost/demo_web/front-assets/assets/img/shapes/about-bg.jpg" style="background-image: url(&quot;http://localhost/demo_web/front-assets/assets/img/shapes/about-bg.jpg&quot;);">
            <img src="http://localhost/demo_web/front-assets/assets/img/shapes/tire-primary-light.png" alt="tire" class="tire-primary-light position-absolute end-0 top-0 z--1">
            <span class="small-circle-shape position-absolute z--1"></span>
            <div class="container">
                <div class="row align-items-center">
                <div class="section-heading">
                        <h2 class="sec__title sec_title2">  <?php echo e($localpickupcity->pick_city); ?> To <?php echo e($package_name->local_package); ?> One Way Taxi Services</h2>
                    </div><!-- end section-heading -->
                    <div>
                    <p><?php echo e(helpers::name()); ?> gives a One Way Taxi rental help from <?php echo e($localpickupcity->pick_city); ?> To <?php echo e($package_name->local_package); ?>. Assuming that you are keen on one way drop taxi, you can book one way drop taxi from <?php echo e($localpickupcity->pick_city); ?> to <?php echo e($package_name->local_package); ?>, which cost around a portion of the full circle rate. <?php echo e($localpickupcity->pick_city); ?> to <?php echo e($package_name->local_package); ?> taxi administration remembers the get from any area for <?php echo e($localpickupcity->pick_city); ?> city and drop off anyplace in <?php echo e($package_name->local_package); ?> city. <?php echo e(helpers::name()); ?> gives moment booking and every minute of every day accessibility.</p>
                    <h2 class="sec__title sec_title2">  <?php echo e($localpickupcity->pick_city); ?> To <?php echo e($package_name->local_package); ?> Cabs At Lowest Price</h2>
                    <p><?php echo e(helpers::name()); ?> offers the most reduced costs on <?php echo e($localpickupcity->pick_city); ?> to <?php echo e($package_name->local_package); ?> taxis across a wide assortment of taxis or taxicabs. In the event that you are searching for vehicle rental administrations in <?php echo e($localpickupcity->pick_city); ?>, <?php echo e(helpers::name()); ?> gives a wide assortment of cabs models you can choose. Select the classification of a taxi that is the most ideal to your prerequisite. Get the best offers and markdown on our AC taxi from <?php echo e($localpickupcity->pick_city); ?> to <?php echo e($package_name->local_package); ?> for one way excursion and full circle ventures</p>
                    
                    <h2 class="sec__title sec_title2">  <?php echo e($localpickupcity->pick_city); ?> To <?php echo e($package_name->local_package); ?> Car Rental Service</h2>
                    <p><?php echo e(helpers::name()); ?> offers agreeable and completely adaptable one way taxi, outstation taxi and vehicle rental assistance from <?php echo e($localpickupcity->pick_city); ?> to <?php echo e($package_name->local_package); ?>, or book taxis from <?php echo e($localpickupcity->pick_city); ?> to <?php echo e($package_name->local_package); ?>. Visit our valuing choice for <?php echo e($localpickupcity->pick_city); ?> to <?php echo e($package_name->local_package); ?> one way taxi for more detail. You can likewise contact our client care number recorded on our site to get limits and offers on <?php echo e($localpickupcity->pick_city); ?> to <?php echo e($package_name->local_package); ?> vehicle recruit charges.</p>
                    
                    <h2 class="sec__title sec_title2">  <?php echo e($localpickupcity->pick_city); ?> To <?php echo e($package_name->local_package); ?> Taxi Service</h2>
                    <p>Get the most reduced passages on <?php echo e($localpickupcity->pick_city); ?> to <?php echo e($package_name->local_package); ?> on <?php echo e(helpers::name()); ?>. Book from an extensive variety of vehicle rental choice in <?php echo e($localpickupcity->pick_city); ?> - Car, Hatchbacks or SUVs and more. <?php echo e(helpers::name()); ?> suggests Vehicle scope of vehicles on the off chance that you are traveling alone or with an accomplice or little family. In any case, to go in a gathering, go for Innova or comparable vehicles, select the one that best suits your necessities.</p>
                    
                    <h2 class="sec__title sec_title2">  <?php echo e($localpickupcity->pick_city); ?> To <?php echo e($package_name->local_package); ?> by Car</h2>
                    <p>One way taxi from <?php echo e($localpickupcity->pick_city); ?> To <?php echo e($package_name->local_package); ?> is the perfect choice for all travelers who would like to move one way only from <?php echo e($localpickupcity->pick_city); ?> to <?php echo e($package_name->local_package); ?>. One way cab or One way taxi would easily pick you up from <?php echo e($localpickupcity->pick_city); ?> and Drop you off at your destination in Ahemdabad. Your One Way Cab is 100% personal, not shared with anyone. It will 100% safe, clean and dedicated cab for you.</p>
                    
                    <h2 class="sec__title sec_title2">One Way Cab   <?php echo e($localpickupcity->pick_city); ?> To <?php echo e($package_name->local_package); ?></h2>
                    <p>We design our routes, pricing, and packages in a way, So everyone can get benefits by paying only for one way trip instead of round trip charges. Book your one way cab from <?php echo e($localpickupcity->pick_city); ?> To <?php echo e($package_name->local_package); ?> Cab and enjoy your journey!</p>
                    
                    <h2 class="sec__title sec_title2">Cab Service In <?php echo e($localpickupcity->pick_city); ?></h2>
                    <p> <?php echo e(helpers::name()); ?> is a popular Cab service that operates in <?php echo e($localpickupcity->pick_city); ?>. They offer a variety of vehicles, including standard sedans, luxury sedans, and SUVs.</p>
                    
                    <h2 class="sec__title sec_title2">Taxi Service In <?php echo e($localpickupcity->pick_city); ?></h2>
                    <p><?php echo e(helpers::name()); ?> is a popular ride-hailing service in <?php echo e($localpickupcity->pick_city); ?>, offering a wide range of cabs to suit your needs. With <?php echo e(helpers::name()); ?>, you can choose from budget-friendly options like <?php echo e(helpers::name()); ?> Mini or luxury rides like <?php echo e(helpers::name()); ?> Prime.</p>
                    
                    </div>
                </div>
            </div>
        </section>
        <?php for ($j = 0; $j < count($localdetails); $j++){?>
            <div class="modal fade" id="modal_<?php echo e($localdetails[$j]['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered " role="document" style="padding-top: 0px;">
                    <div class="modal-content   ">
                        <div class="modal-header" style="border-bottom:1px solid #e9ecef;background-color:#ff0000">
                            <label style="color: white;font-weight:700;font-size:20px">Fare Details</label> 
                            <button type="button" id="oneway_close" class="close btn_close" data-dismiss="modal" ><i class="fa fa-times"></i></button>
                        </div>
                        <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 col-lg-12 col-md-12 fare-area" id="loadfare">
                                        <div class="fare-area">
                                            <h4>Fare Breakup:</h4>
                                            <h5 class="f_16">Base Fare <span class="fl_right"> ₹ <?php echo e($localdetails[$j]['amount']); ?> </span></h5>
                                            <h5 class="f_16">Extra Hour Rate <span class="fl_right"> ₹ <?php echo e($localdetails[$j]['ehr']); ?> </span></h5>
                                            <h5 class="f_16">Extra Km Rate<span class="fl_right"> ₹ <?php echo e($localdetails[$j]['ekr']); ?> </span></h5>
                                            <h5 class="f_16">Estimated Amount <span  class="fl_right" style="font-weight: 900"> ₹ <?php echo e($localdetails[$j]['total_amount']); ?> </span></h5>


                                        </div>
                                    </div>
                                </div>

                                <div class="row fare-area">
                                    <div class="col-lg-12">
                                    <?php echo $local_note->local_note; ?>

                                    </div>
                                </div>
                            </div>

                    </div>
                    </div>
            </div>
<?php }?>




    <?php endif; ?>
    <div class="modal fade" id="login-number" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal_width" role="document">
          <div class="modal-content">
            <div class="modal-header" style="border-bottom:1px solid #e9ecef;background-color:#ff0000">
                <label style="color: white;font-weight:900;font-size:20px">Login</label>
                <button type="button" id="btn_close" class="close btn_close" data-dismiss="modal" ><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                                        <div id="login_number_modal" class="big_screeen">
                                            <div class="col-md-12">
                                                <div class="x_slider_form_input_wrapper float_left">
                                                    <?php echo Form::open(array('route' => 'homelogin','id'=>'userlogin','class'=>'account-form','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')); ?>


                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-grp">
                                                                <label>Enter Mobile Number</label>
                                                                <input type="number" placeholder="Phone *" class="form-control" id="user_mobile" name="user_mobile" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" required />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php echo Form::close(); ?>

                                                </div>
                                            </div>
                                            <p style="text-align: center; font-size: 12px;">Only Indian Mobile Number Are Supported</p>
                                            <div class="modal-footer border-remove" style="display: block; text-align: center;">
                                                <div class="submit-btn text-center">
                                                <button class="btn btn-primary btn-md" id="loginbutton" type="button">Submit</button>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div id="otp-div" class="big_screen">
                                                <div id="otp">
                                                    <p style="text-align: center; font-weight: 700;">
                                                        We Send OTP On This Number <br />
                                                        <span id="number_show" name="number_show" class="number_show number" style="font-weight: bold; border: 0px;"></span>
                                                        <p id="resend_msg" class="wrongotp" style="font-weight:700;text-align:center"></p>
                                                    </p>
                                                    <div class="col-md-12">
                                                        <div class="x_slider_form_input_wrapper float_left">

                                                                <?php echo Form::open(array('route' => 'homelogin','id'=>'userlogin','class'=>'account-form','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data','style'=>'text-align: center;padding-right: 0px;margin-bottom:10px;')); ?>

                                                                <input type="hidden" name="form_type" id="form_type" />
                                                                <input type="hidden" name="mobile_number_re" id="mobile_number_re" />
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-grp">
                                                                            
                                                                            <input type="number" placeholder="Enter OTP Number" pattern="/^-?\d+\.?\d*$/"  onKeyPress="if(this.value.length==4) return false;" id="user_otp" name="user_otp"class="form-control" style="border:1px solid;"/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                
                                                                    
                                                                <div class="col-md-12" style="text-align: center; margin-top: 10px;">
                                                                    <div>
                                                                        <p id="otp_wrong" class="wrongotp" style="text-align: center;"></p>
                                                                    </div>
                                                                    <div class="col-md-12" style="text-align: center">
                                                                        <p id="searchResend" type="button" style="cursor: pointer; font-weight: bold;"><a>Re-send OTP?</a></p>
                                                                    </div>
                                                                </div>
                                                                <?php echo Form::close(); ?>

                                                                <div class="modal-footer" style="display: block;border-top:0px;text-align:center">

                                                                
                                                                <button class="btn btn-primary btn-md" id="otpsend" type="button">Submit</button>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>

          </div>
        </div>
    </div>

    <?php echo $__env->make('frontend.layout._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    $("#oneway_close").click(function () {
        $("#fare_modal").modal("hide");
    });
    $("#btn_close").click(function () {
        $("#login-number").modal("hide");
    });
</script>

<script>
    $(document).ready(function () {
        $(".fare_1").click(function () {
            $("#fare_modal").modal("show");

            var modal_id = $("#modal_id").val();
            var pcity_id = $("#pcity_id").val();
            var dcity_id = $("#dcity_id").val();
            alert(modal_id);
            jQuery.ajax({
                headers: {
                    "X-CSRF-Token": $('input[name="_token"]').val(),
                },
                type: "POST",
                url: "<?php echo e(route('modal_show')); ?>",
                data: { modal_id: modal_id, pcity_id: pcity_id, dcity_id: dcity_id },

                success: function (resp) {
                    $(".table-design").html(resp);
                },
            });
            return false;
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#fare_mobile").click(function () {
            $("#fare_modal").modal("show");
            var modal_id = $("#modal_id").val();
            var pcity_id = $("#pcity_id").val();
            var dcity_id = $("#dcity_id").val();

            jQuery.ajax({
                headers: {
                    "X-CSRF-Token": $('input[name="_token"]').val(),
                },
                type: "POST",
                url: "<?php echo e(route('modal_show')); ?>",
                data: { modal_id: modal_id, pcity_id: pcity_id, dcity_id: dcity_id },

                success: function (resp) {
                    $(".table-design").html(resp);
                },
            });
            return false;
        });
    });
</script>
<script>
    jQuery(document).ready(function () {
        jQuery(".findcar").click(function () {
            $("#login-number").modal("show");
        });
    });
</script>
<script>
    jQuery(document).ready(function () {
        jQuery("#loginbutton").click(function () {
            var user_mobile = jQuery("#user_mobile").val();

            if (user_mobile.length != 10) {
                alert("Please Enter 10 Digit Number");
                // $("#otp-div").hide();
                // $("#login_number").show();
            } else {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo e(route('homelogin')); ?>",
                    data: "user_mobile=" + user_mobile + "&_token=<?php echo e(csrf_token()); ?>",
                    dataType: "JSON",
                    success: function (result) {
                        if (result == 1) {
                            location.reload();
                        } else {
                            location.reload();
                        }
                    },
                });
            }

            return false;
        });
    });
</script>
<script>
    jQuery(document).ready(function () {
        jQuery("#otpsend").click(function () {
            var type = jQuery("#form_type").val();

            var user_mobile_re = $("#mobile_number_re").val();
            var user_otp = jQuery("#user_otp").val();

            if (user_otp == "") {
                alert("Otp is requried");
            } else {
                jQuery.ajax({
                    headers: {
                        "X-CSRF-Token": $('input[name="_token"]').val(),
                    },
                    type: "POST",
                    url: "<?php echo e(route('onewayotp_check')); ?>",
                    data: { user_mobile_re: user_mobile_re, user_otp: user_otp },
                    dataType: "JSON",
                    success: function (result) {
                        if (result == 1) {
                            location.reload();
                        } else {
                            if (type == "oneway") {
                                if ($("#pickupcity_id").val() == "" || $("#dropcity_id").val() == "") {
                                    alert("Requried All Fields");
                                    location.reload();
                                } else {
                                    $("#otp_wrong").css({ color: "#ff6700" });
                                    $("#otp_wrong").css({ "font-weight": "700" });
                                    $("#otp_wrong").html("OTP Wrong Try Again");
                                }
                            } else {
                                $("#otp_wrong").css({ color: "#ff6700" });
                                $("#otp_wrong").css({ "font-weight": "700" });
                                $("#otp_wrong").html("OTP Wrong Try Again");
                            }
                        }
                    },
                });
            }

            return false;
        });
    });
</script>
<?php /**PATH C:\xampp\htdocs\demo_web\resources\views/frontend/onewaycab/index.blade.php ENDPATH**/ ?>