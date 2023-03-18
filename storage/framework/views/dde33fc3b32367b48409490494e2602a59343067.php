
    <?php echo $__env->make('frontend.layout._top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('frontend.layout._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
        <section class="breadcrumb-section position-relative z-2 overflow-hidden mt--75" data-background="<?php echo e(asset('front-assets/assets/img/shapes/texture-bg.png')); ?>" style="background-image: url(&quot;<?php echo e(asset('front-assets/assets/img/shapes/texture-bg.png')); ?>&quot;);">
            <img src="<?php echo e(asset('front-assets/assets/img/shapes/tire-print-left.png')); ?>" alt="tire print" class="position-absolute start-0 z-1 tire-print">
            <img src="<?php echo e(asset('front-assets/assets/img/shapes/tire-print-right.png')); ?>" alt="tire print" class="position-absolute end-0 z-1 tire-print">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                            <h1 class="text-white">My Account</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>  
        <div class="faq-section pt-50 pb-50">
                <div class="container">
                
                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <div class="faq-tabs mt-5 brands-filter">
                                <ul class="nav nav-tabs border-0 justify-content-center" role="tablist">
                                    <li><a id="up_button" data-bs-toggle="tab" class="active" aria-selected="true" role="tab"><span class="me-2"><i class="fa-solid fa-car-side"></i></span>Up Comming</a></li>
                                    <li><a id="com_button" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab"><span class="me-2"><i class="fa-solid fa-car-side"></i></span>Complate</a></li>
                                    
                                </ul>
                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <section class="wishlist-section ptb-50" id="up_content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wishlist-table table-responsive bg-white">
                            <table class="table">
                                <tbody><tr>
                                    <th>Image</th>
                                    <th>Cab Name</th>
                                    <th>Booking No</th>
                                    <th>Booking Type</th>
                                    <th class="price-column pe-0">Price</th>
                                </tr>
                                <?php for ($i = 0; $i < count($upcoming_oneway); $i++) { ?>
                                <tr>
                                    <td class="product-thumb">
                                        <img src="<?php echo e(asset('public/profile/'.$upcoming_oneway[$i]['image'])); ?>" alt="tire" class="img-fluid">
                                    </td>
                                    <td>
                                        <h6 class="mb-1"><?php echo e($upcoming_oneway[$i]['cab']); ?></h6>
                                        
                                    </td>
                                    <td>
                                        <span class="stock-btn rounded-pill"><?php echo e($upcoming_oneway[$i]['orderno']); ?></span>
                                    </td>
                                    <td>
                                        <span class="stock-btn rounded-pill">Oneway</span>
                                    </td>
                                    <td>
                                        <span class="price fw-bold"><i class="fa fa-inr"></i><?php echo e($upcoming_oneway[$i]['total_amount']); ?></span>
                                        <a onclick="oneway_view_popup(<?=$upcoming_oneway[$i]['id']?>)" data-toggle="modal" data-target="#view_modal"  type="button" class="btn btn-primary btn-sm ms-5">View</a>
                                        <a data-toggle="modal" data-target="#cancle_modal"  class="close-btn ms-3"><i class="fas fa-close"></i></a>
                                    </td>
                                </tr>
                               <?php }?>
                               <?php for ($i = 0; $i < count($upcoming_localway); $i++) { ?>
                                <tr>
                                    <td class="product-thumb">
                                        <img src="<?php echo e(asset('public/profile/'.$upcoming_localway[$i]['image'])); ?>" alt="tire" class="img-fluid">
                                    </td>
                                    <td>
                                        <h6 class="mb-1"><?php echo e($upcoming_localway[$i]['cab']); ?></h6>
                                        
                                    </td>
                                    <td>
                                        <span class="stock-btn rounded-pill"><?php echo e($upcoming_localway[$i]['orderno']); ?></span>
                                    </td>
                                    <td>
                                        <span class="stock-btn rounded-pill">Local Package</span>
                                    </td>
                                    <td>
                                        <span class="price fw-bold"><i class="fa fa-inr"></i><?php echo e($upcoming_localway[$i]['total_amount']); ?></span>
                                        <a onclick="localway_view_popup(<?=$upcoming_localway[$i]['id']?>)" data-toggle="modal" data-target="#view_modal"  type="button" class="btn btn-primary btn-sm ms-5">View</a>
                                        <a data-toggle="modal" data-target="#cancle_modal"  class="close-btn ms-3"><i class="fas fa-close"></i></a>
                                    </td>
                                </tr>
                               <?php }?>
                               <?php for ($i = 0; $i < count($upcoming_multyway); $i++) { ?>
                                <tr>
                                    <td class="product-thumb">
                                        <img src="<?php echo e(asset('public/profile/'.$upcoming_multyway[$i]['image'])); ?>" alt="tire" class="img-fluid">
                                    </td>
                                    <td>
                                        <h6 class="mb-1"><?php echo e($upcoming_multyway[$i]['cab']); ?></h6>
                                        
                                    </td>
                                    <td>
                                        <span class="stock-btn rounded-pill"><?php echo e($upcoming_multyway[$i]['orderno']); ?></span>
                                    </td>
                                    <td>
                                        <span class="stock-btn rounded-pill">Round-Trip</span>
                                    </td>
                                    <td>
                                        <span class="price fw-bold"><i class="fa fa-inr"></i><?php echo e($upcoming_multyway[$i]['total_amount']); ?></span>
                                        <a onclick="multyway_view_popup(<?=$upcoming_multyway[$i]['id']?>)" data-toggle="modal" data-target="#view_modal"  type="button" class="btn btn-primary btn-sm ms-5">View</a>
                                        <a data-toggle="modal" data-target="#cancle_modal"  class="close-btn ms-3"><i class="fas fa-close"></i></a>
                                    </td>
                                </tr>
                               <?php }?>
                            </tbody></table>
                        </div>
                    </div>
                </div>
            </div>
        </section>  
        <section class="wishlist-section ptb-50" id="com_content">
           
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    
                        <div class="wishlist-table table-responsive bg-white">
                            <table class="table">
                                <tbody><tr>
                                    <th>Image</th>
                                    <th>Cab Name</th>
                                    <th>Booking No</th>
                                    <th>Booking Type</th>
                                    <th class="price-column pe-0">Price</th>
                                </tr>
                                <?php for ($i = 0; $i < count($complate_oneway); $i++) { ?>
                                <tr> 
                                    <td class="product-thumb">
                                        <img src="<?php echo e(asset('public/profile/'.$complate_oneway[$i]['image'])); ?>" alt="tire" class="img-fluid">
                                    </td>
                                    <td>
                                        <h6 class="mb-1"><?php echo e($complate_oneway[$i]['cab']); ?></h6>
                                        
                                    </td>
                                    <td>
                                        <span class="stock-btn rounded-pill"><?php echo e($complate_oneway[$i]['orderno']); ?></span>
                                    </td>
                                    <td>
                                        <span class="stock-btn rounded-pill">Oneway</span>
                                    </td>
                                    <td>
                                        <span class="price fw-bold"><i class="fa fa-inr"></i><?php echo e($complate_oneway[$i]['total_amount']); ?></span>
                                        <a onclick="oneway_view_popup(<?=$complate_oneway[$i]['id']?>)" data-toggle="modal" data-target="#view_modal"  type="button" class="btn btn-primary btn-sm ms-5">View</a>
                                        <a data-toggle="modal" data-target="#cancle_modal"  class="close-btn ms-3"><i class="fas fa-close"></i></a>
                                    </td>
                                </tr>
                               <?php }?>
                               <?php for ($i = 0; $i < count($complate_localway); $i++) { ?>
                                <tr>
                                    <td class="product-thumb">
                                        <img src="<?php echo e(asset('public/profile/'.$complate_localway[$i]['image'])); ?>" alt="tire" class="img-fluid">
                                    </td>
                                    <td>
                                        <h6 class="mb-1"><?php echo e($complate_localway[$i]['cab']); ?></h6>
                                        
                                    </td>
                                    <td>
                                        <span class="stock-btn rounded-pill"><?php echo e($complate_localway[$i]['orderno']); ?></span>
                                    </td>
                                    <td>
                                        <span class="stock-btn rounded-pill">Local Package</span>
                                    </td>
                                    <td>
                                        <span class="price fw-bold"><i class="fa fa-inr"></i><?php echo e($complate_localway[$i]['total_amount']); ?></span>
                                        <a onclick="localway_view_popup(<?=$complate_localway[$i]['id']?>)" data-toggle="modal" data-target="#view_modal"  type="button" class="btn btn-primary btn-sm ms-5">View</a>
                                        <a data-toggle="modal" data-target="#cancle_modal"  class="close-btn ms-3"><i class="fas fa-close"></i></a>
                                    </td>
                                </tr>
                               <?php }?>
                               <?php for ($i = 0; $i < count($complate_multyway); $i++) { ?>
                                <tr>
                                    <td class="product-thumb">
                                        <img src="<?php echo e(asset('public/profile/'.$complate_multyway[$i]['image'])); ?>" alt="tire" class="img-fluid">
                                    </td>
                                    <td>
                                        <h6 class="mb-1"><?php echo e($complate_multyway[$i]['cab']); ?></h6>
                                        
                                    </td>
                                    <td>
                                        <span class="stock-btn rounded-pill"><?php echo e($complate_multyway[$i]['orderno']); ?></span>
                                    </td>
                                    <td>
                                        <span class="stock-btn rounded-pill">Round-Trip</span>
                                    </td>
                                    <td>
                                        <span class="price fw-bold"><i class="fa fa-inr"></i><?php echo e($complate_multyway[$i]['total_amount']); ?></span>
                                        <a onclick="multyway_view_popup(<?=$complate_multyway[$i]['id']?>)" data-toggle="modal" data-target="#view_modal"  type="button" class="btn btn-primary btn-sm ms-5">View</a>
                                        <a data-toggle="modal" data-target="#cancle_modal"  class="close-btn ms-3"><i class="fas fa-close"></i></a>
                                    </td>
                                </tr>
                               <?php }?>
                            </tbody></table>
                        </div>
                    </div>
                    
                </div>
            </div>
            
           
        </section>  
        <div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog " >
                    <div class="modal-content" style="background-color: #f1f1f1">
                        <div class="modal-header" style="background-color: #fc0012">
                            <label style="font-weight: bold;color:white">Booking Details</label>
                            <button type="button" class="close" id="cancle_close" data-dismiss="modal" style="margin-top: -15px;background: #fc0012;margin-right: -10px;border: 0;"><i class="fa fa-times" style="color: #fff5f5"></i></button>
                        </div>

                        <div class="modal-body">
                            <div class="table-designs">
                            <div class="table-design"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="cancle_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog " >
                    <div class="modal-content" style="background-color: #f1f1f1">
                        <div class="modal-header" style="background-color: #fc0012">
                            <label style="font-weight: bold;color:white;">Please, Contact on our Helpline Number.</label>
                            <button type="button" class="close" id="cancle_close" data-dismiss="modal" style="margin-top: -15px;background: #fc0012;margin-right: -10px;border: 0;"><i class="fa fa-times" style="color: white"></i></button>
                        </div>

                        <div class="modal-body">
                            <div class="table-designs">
                                <span>Number :<b>(+91) <?php echo e(helpers::mobile()); ?></b></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php echo $__env->make('frontend.layout._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <script>
                $("#com_content").hide();       

            $('#up_button').click(function()
            {
                $("#up_content").show();       
                $("#com_content").hide();       
            });
            $('#com_button').click(function()
            {
                $("#up_content").hide();       
                $("#com_content").show();       
            });
         
        

        </script>
         <script>
            function oneway_view_popup(id) {

                // $("#view_modal").modal('show');
                //  $('.modal-body').addClass('m_body'); 
                var onewayupcoming_id = id;
                
                jQuery.ajax({
                    type: "Post", 
                    url: "<?php echo e(route('popup_values')); ?>",
                    data: "onewayupcoming_id=" + onewayupcoming_id + "&_token=<?php echo e(csrf_token()); ?>",

                    success: function (resp) {
                        $(".table-design").html(resp);
                    },
                });
                return false;
            }
        </script>
          <script>
            function localway_view_popup(id) {
                  
                var localwayupcoming_id = id;

                jQuery.ajax({
                    type: "Post",
                    url: "<?php echo e(route('local_popup_values')); ?>",
                    data: "localwayupcoming_id=" + localwayupcoming_id + "&_token=<?php echo e(csrf_token()); ?>",

                    success: function (resp) {
                        $(".table-design").html(resp);
                    },
                });
                return false;
            }
        </script>
          <script>
            function multyway_view_popup(id) {
                 
                var multyupcoming_id = id;

                jQuery.ajax({
                    type: "Post",
                    url: "<?php echo e(route('multy_popup_values')); ?>",
                    data: "multyupcoming_id=" + multyupcoming_id + "&_token=<?php echo e(csrf_token()); ?>",

                    success: function (resp) {
                        $(".table-design").html(resp);
                    },
                });
                return false;
            }
        </script>
 <script>
     $("#two_content").hide();
            $('#one').click(function()
            {
                 $("#one_content").show();
                 $("#two_content").hide();
            });
               $('#two').click(function()
            {
                 $("#two_content").show();
                 $("#one_content").hide();
            });
             $('#req_close').click(function()
            {
                $("#view_modal").modal('hide');
            });
                 $('.cancle_btn').click(function()
            {
                $("#cancle_details").modal('show');
            });
            $("#cancle_close").click(function(){
                $("#cancle_details").modal('hide');
            });
        </script>
<?php /**PATH C:\xampp\htdocs\demo_web\resources\views/frontend/myaccount/myaccount.blade.php ENDPATH**/ ?>