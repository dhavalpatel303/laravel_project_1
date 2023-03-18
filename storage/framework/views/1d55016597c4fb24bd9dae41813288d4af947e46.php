<?php echo $__env->make('frontend.layout._top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php use App\Cab_master;?>
<?php echo $__env->make('frontend.layout._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="breadcrumb-section position-relative z-2 overflow-hidden mt--75" data-background="<?php echo e(asset('front-assets/assets/img/shapes/texture-bg.png')); ?>" style="background-image: url(&quot;<?php echo e(asset('front-assets/assets/img/shapes/texture-bg.png')); ?>&quot;);">
    <img src="<?php echo e(asset('front-assets/assets/img/shapes/tire-print-left.png')); ?>" alt="tire print" class="position-absolute start-0 z-1 tire-print">
    <img src="<?php echo e(asset('front-assets/assets/img/shapes/tire-print-right.png')); ?>" alt="tire print" class="position-absolute end-0 z-1 tire-print">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                    <h1 class="text-white">Oneway Routes</h1>
                </div>
            </div>
        </div>
    </div>
</section>  

<section class="about-section  pb-100 bg-primary-light position-relative z-1 overflow-hidden" data-background="<?php echo e(asset('front-assets/assets/img/shapes/about-bg.jpg')); ?>" style="background-image: url(&quot;<?php echo e(asset('front-assets/assets/img/shapes/about-bg.jpg')); ?>&quot;);">
            <div class="container">
                <img src="<?php echo e(asset('front-assets/assets/img/shapes/tire-primary-light.png')); ?>" alt="tire" class="tire-primary-light position-absolute end-0 top-0 z--1">
                <span class="small-circle-shape position-absolute z--1"></span>
                <?php for($i=0;$i<count($oneway_detail_uniq);$i++) {?>
                        <?php for($j=0;$j<count($pickupcity_id);$j++) {?>
                             <?php if($oneway_detail_uniq[$i]['pcity_id'] == $pickupcity_id[$j]['id'])   {?>
                <button class="btn btn-primary btn-md mt-4" type="submit">Cab Form <?php echo e($pickupcity_id[$j]['pick_city']); ?></button>
                  <div class="row">
                            <?php for($m=0;$m<count($oneway_detail_uniq_all);$m++) {?>
                            <?php for($k=0;$k<count($dropcity_id);$k++) {?>
                            <?php  if($oneway_detail_uniq_all[$m]['dcity_id'] == $dropcity_id[$k]['id'] && $oneway_detail_uniq_all[$m]['pcity_id'] == $pickupcity_id[$j]['id']){?>
                        <div class="col-xl-4 mt_20">
                        <?php $pick = str_replace(" ",'',$pickupcity_id[$j]['pick_city'])?>        
                                     <?php $drop = str_replace(" ",'',$dropcity_id[$k]['drop_city'])?> 
                        <?php echo Form::open(array('route' => ['routs.cab',['pick_city' => $pick,'drop_city'=> $drop]],'method'=>'Post','files' => 'true','enctype'=>'multipart/form-data')); ?>

                                <input type="hidden" value="<?php echo e($pickupcity_id[$j]['id']); ?>" id="pick_city" name="pick_city">
                                    <input type="hidden" value="<?php echo e($dropcity_id[$k]['id']); ?>" id="drop_city" name="drop_city">
                            <div class="product-details-sidebar mt-5 mt-xl-0">
                                <div class="shop-sidebar-widget shop-products-widget py-4 px-3 border-top bg-white overflow-hidden bx_shadow">
                                
                                    <ul class="products">
                                        <li class="d-flex align-items-center">
                                           
                                            <div class="content-right ms-3">
                                                <button type="submit" class="title c_white"><?php echo e($pickupcity_id[$j]['pick_city']); ?> To <?php echo e($dropcity_id[$k]['drop_city']); ?> Cab</button>
                                                <div class="price">
                                                    <del><?php echo e($oneway_detail_uniq_all[$m]['total_amount']+$oneway_detail_uniq_all[$m]['total_amount']*20/100); ?></del>
                                                    <span class="text-primary"><span class="route_des d-inline-flex align-items-center justify-content-center rounded-circle text-white "><i class="fa-solid fa-inr f_14"></i></span><?php echo e($oneway_detail_uniq_all[$m]['total_amount']); ?></span>
                                                </div>
                                             
                                            </div>
                                            
                                        </li>
                                    
                                    </ul>
                                </div>
                
                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                  
                        <?php }}}?>
                    </div>
                    <?php }}}?>
            </div>
            
        </section>
                    

</main>
<?php echo $__env->make('frontend.layout._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\demo_web\resources\views/frontend/routs/index.blade.php ENDPATH**/ ?>