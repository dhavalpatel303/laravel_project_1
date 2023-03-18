 <!--footer section start-->
 <a href="https://api.whatsapp.com/send?phone=+91<?php echo e(helpers::mobile()); ?>&amp;text=hi%21%20%20" style="color: white;background-color:#3BB54A" target="_blank" class="mobile_none"><i class="fa-brands fa-whatsapp top_button show-mobile"></i></a>
 <div class="display_none">
    <div class="comunication_section" style="visibility: visible;">
        <div class="inside_comunication_section">
            <div class="sectionleft">
                <a href="tel:+91<?php echo e(helpers::mobile()); ?>"></a>
                <div class="imgsec">
                    <a href="tel:+91<?php echo e(helpers::mobile()); ?>">
                    <i class="fa-brands fa-whatsapp font_35"></i>
                     
                    </a>
                </div>
            </div>
            
            <div class="sectioncenter">
                <a href="whatsapp://send?phone=+91<?php echo e(helpers::mobile()); ?>&amp;text=Hi!"></a>
                <div class="imgsec">
                <i class="fa-brands fa-instagram font_35"></i>
                    
                    </a>
                </div>
            </div>
            <div class="sectioncenter_2">
                <a href="whatsapp://send?phone=+91<?php echo e(helpers::mobile()); ?>&amp;text=Hi!"></a>
                <div class="imgsec">
                <i class="fa-brands fa-youtube font_35"></i>
                    
                    </a>
                </div>
            </div>
            <div class="sectionright">
                    <a href="whatsapp://send?phone=+91<?php echo e(helpers::mobile()); ?>&amp;text=Hi!"></a>
                        <div class="imgsec">
                        <i class="fa-brands fa-facebook font_35"></i>
                            
                            </a>
                        </div>
            </div>
        </div>
    </div>
    
</div>
 <div class="modal fade " id="request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal_width" role="document">
          <div class="modal-content">
            <div class="modal-header" style="border-bottom:1px solid #e9ecef;background-color:#fc0012">
                <label style="color: white;font-weight:700;font-size:20px">Request Call Back</label>
                <button type="button" id="req_close" class="close btn_close" data-dismiss="modal" ><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
              <div id="login_number">
                    <div class="col-md-12">
                        <div class="x_slider_form_input_wrapper float_left">
                                <?php echo Form::open(array('route' => 'homelogin','id'=>'userlogin','class'=>'account-form','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')); ?>

                           
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="form-grp">
                                        <label>Enter Number</label>
                                <input  type="number" placeholder="Enter Mobile Number..."pattern="/^-?\d+\.?\d*$/"id="mobile_no"name="mobile_no"class="form-control"onKeyPress="if(this.value.length==10) return false;"/>
                                    </div>
                                </div>
                                
                            </div>
                        
                                <?php echo Form::close(); ?>


                        </div> 
                    </div>
                    <p style="text-align: center;margin-top:15px;font-size:12px">Only Indian Mobile Number Are Supported</p>
                    <div class="modal-footer border-remove" style="display: block;text-align:center;">
                      <div class="submit-btn text-center">
                      <button class="btn btn-primary btn-md" id="request_callback_button" type="button">Submit</button>
                                
                            </div>
                        <!-- <button  id="loginbutton" type="button"  data-target="otp-div" class="btn--base modal_button" >Next</button> -->
                    </div>
                </div>

            </div>

          </div>
        </div>
</div>
  <footer class="footer-section pt-50">
         
            <div class="footer-wrapper position-relative z-1 overflow-hidden pt-50" data-background="<?php echo e(asset('front-assets/assets/img/shapes/texture-bg.png')); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4">
                            <div class="footer-widget widget-basic">
                                <h3 class="widget-title-large mb-4 text-white">About Company</h3>
                                <p class="mb-40">Compellingly expedite mission-critical methodologies and integrated readiness without quality intellectual capital.</p>
                                <div class="phone-box d-flex align-items-center">
                                    <span class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white"><i class="flaticon-phone-call"></i></span>
                                    <h4 class="text-white ms-3 mb-0">+91 <?php echo e(helpers::mobile()); ?></h4>
                                </div>
                             
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7">
                            <div class="ms-lg-5 ms-xl-0 mt-5 mt-lg-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <a href="<?php echo e(route('home.index')); ?>" class="footer-logo d-inline-block"><img src="<?php echo e(asset('front-assets/assets/img/logo.png')); ?>" alt="logo"></a>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-end">
                                            <div class="footer-social d-inline-block text-start">
                                                <h6 class="text-white">Follow us on</h6>
                                                <ul class="footer-social-list">
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-30">
                                    <div class="col-sm-4">
                                        <div class="footer-widget footer-nav-widget mb-5 mb-sm-0">
                                            <h6 class="widget-title text-white mb-3">Useful Links</h6>
                                            <ul class="footer-nav">
                                                <li><a href="<?php echo e(route('home.index')); ?>">Book Cab</a></li>
                                                <li><a href="<?php echo e(route('service')); ?>">Service</a></li>
                                                <li><a href="<?php echo e(route('routs.index')); ?>">Routes</a></li>
                                                <li><a href="#testimonial">Testimonial</a></li>
                                                <li><a href="<?php echo e(route('contact.index')); ?>">Contact Us</a></li>
                                            
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="footer-widget footer-nav-widget mb-5 mb-sm-0">
                                            <h6 class="widget-title text-white mb-3">Vehicles Type</h6>
                                            <ul class="footer-nav">
                                            <li><a href="<?php echo e(route('home.index')); ?>">Home</a></li>
                                                <li><a href="<?php echo e(route('about.index')); ?>">About</a></li>
                                                <li><a href="<?php echo e(route('policy')); ?>">Term & Condition </a></li>
                                                <li><a href="<?php echo e(route('policy')); ?>">Privacy & Policy</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="footer-widget footer-nav-widget mb-5 mb-sm-0">
                                            <h6 class="widget-title text-white mb-3">Company Address</h6>
                                            <ul class="footer-nav">
                                            <li class="text_white">
                                                445, Times Trade Center,
                                                Opp. Polaris Commercial Mall,
                                                Parvat Patiya, Surat,
                                                Gujarat 395010
                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-sm-7">
                                <div class="copyright-text">
                                    <p class="mb-0">&copy; All rights reserved. </p>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="copyright-links text-start text-sm-end mt-1 mt-sm-0">
                                <p>Design & Developed By : <a href="<?php echo e(route('home.index')); ?>">mSquare info tech</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content wrapper ends -->
<!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="at_product_view">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content product_modal shadow">
                <div class="close-btn-wrapper text-end">
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="at_product_view">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="product_view_slider">
                                <div class="product_feature_img_slider swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="<?php echo e(asset('front-assets/assets/img/home4/pd-1.jpg')); ?>" alt="feature img" class="img-fluid">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="<?php echo e(asset('front-assets/assets/img/home4/pd-1.jpg')); ?>" alt="feature img" class="img-fluid">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="<?php echo e(asset('front-assets/assets/img/home4/pd-1.jpg')); ?>" alt="feature img" class="img-fluid">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="<?php echo e(asset('front-assets/assets/img/home4/pd-1.jpg')); ?>" alt="feature img" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="product_thumb_slider swiper mt-3">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="assets/img/home4/pd-thumb-1.png" alt="thumbnail" class="img-fluid">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/img/home4/pd-thumb-1.png" alt="thumbnail" class="img-fluid">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/img/home4/pd-thumb-1.png" alt="thumbnail" class="img-fluid">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/img/home4/pd-thumb-1.png" alt="thumbnail" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product_view_right mt-4 mt-md-0">
                                <ul class="product_review d-flex align-items-center">
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li class="review-total ms-2 text-primary fw-semibold"><a href="#">( 95 Reviews )</a></li>
                                </ul>
                                <h5 class="product_title mt-3">Aluminium Wheel AR-19 <br> Tire Parts</h5>
                                <p>Monotonectally simplify frictionless communities via clicks-and-mortar Interactively disseminate relationships. </p>
                                <ul class="key_features">
                                    <li>Speed: 750 RPM</li>
                                    <li>Power Source: Cordless-Electric</li>
                                    <li>Battery Cell Type: Lithium</li>
                                    <li>Voltage: 20 Volts</li>
                                    <li>Battery Capacity: 2 Ah</li>
                                </ul>
                                <div class="product_color_select mt-3">
                                    <span class="title text-secondary fw-semibold">Color</span>
                                    <ul class="d-flex align-items-center">
                                        <li>
                                            <input type="radio" name="color">
                                            <span class="color_circle bg-white border border-1"></span>
                                        </li>
                                        <li>
                                            <input type="radio" name="color">
                                            <span class="color_circle black-color bg-secondary"></span>
                                        </li>
                                        <li>
                                            <input type="radio" name="color">
                                            <span class="color_circle red-color bg-primary"></span>
                                        </li>
                                        <li>
                                            <input type="radio" name="color">
                                            <span class="color_circle bg-warning"></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product_price mt-4">
                                    <del class="fw-semibold">$59.00</del>
                                    <span class="text-primary fw-semibold ms-2">$29.00</span>
                                </div>
                                <div class="add_to_cart_product d-flex align-items-center mb-4 mt-3">
                                    <form class="d-inline-flex align-items-center">
                                        <button type="button" class="decrement btn-sm">-</button>
                                        <input type="text" value="01">
                                        <button type="button" class="increment btn-sm">+</button>
                                    </form>
                                    <a href="#" class="btn btn-secondary btn-sm"><span class="me-1"><i class="fa-solid fa-cart-plus"></i></span>Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--scrolltop button-->
    <button class="theme-scrolltop-btn"><i class="fa-regular fa-hand-pointer"></i></button>
    <!--scrolltop button end-->

    <!--build:js-->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSK543R3NXT7utCZbk_Ti3siOSaAtj9bA&libraries=places&region=in" async></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/appear.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/swiper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/massonry.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/bootstrap-slider.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/magnific-popup.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/waypoints.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/counterup.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/isotop.pkgd.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/date-picker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/progressbar.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/slick.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/countdown.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/custom-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/price-range.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/vendors/image-rotate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('front-assets/assets/js/select2.min.js')); ?>"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo e(asset('front-assets/assets/js/mdb.min.js')); ?>"></script>
        <script>
       console.clear();
</script>
<script>
         
         $(window).scroll(function () {
             var scroll = $(window).scrollTop();

             if ($(this).scrollTop() > 800) {
                 $(".comunication_section").css('visibility', 'hidden');

             } else if ($(this).scrollTop() > 150) {

                 $(".comunication_section").css('visibility', 'visible');
             }
         });
 </script>
 <script>
       $(document).ready(function(){
                     
        $('#req_button').click(function()
        {
        $('#request_modal').modal('show');
        });

        $('#req_close').click(function()
        {
        $('#request_modal').modal('hide');
        });
        
    });
 </script>
        <!-- JS Plugins Init. -->
        <script>
            // $(window).on('load', function () {
            //     // initialization of HSMegaMenu component
            //     $('.js-mega-menu').HSMegaMenu({
            //         event: 'hover',
            //         pageContainer: $('.container'),
            //         breakpoint: 1199.98,
            //         hideTimeOut: 0
            //     });

            //     // Page preloader
            //     setTimeout(function() {
            //       $('#jsPreloader').fadeOut(500)
            //     }, 800);
            // });

            $(document).on('ready', function () {
                // initialization of header
                $.HSCore.components.HSHeader.init($('#header'));

                // initialization of google map
                function initMap() {
                    $.HSCore.components.HSGMap.init('.js-g-map');
                }

                // initialization of autonomous popups
                $.HSCore.components.HSModalWindow.init('[data-modal-target]', '.js-modal-window', {
                    autonomous: true
                });

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

                // initialization of show animations
                $.HSCore.components.HSShowAnimation.init('.js-animation-link');

                // initialization of datepicker
                $.HSCore.components.HSRangeDatepicker.init('.js-range-datepicker');

                // initialization of forms
                $.HSCore.components.HSRangeSlider.init('.js-range-slider');

                // initialization of malihu scrollbar
                $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

                // initialization of select
                $.HSCore.components.HSSelectPicker.init('.js-select');

                // initialization of quantity counter
                $.HSCore.components.HSQantityCounter.init('.js-quantity');

                // initialization of slick carousel
                $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

                // initialization of go to
                $.HSCore.components.HSGoTo.init('.js-go-to');
            });
        </script>
        <script>
      $(document).ready(function(){
                      $('#request_callback_button').click(function()
                      {


                          var mobile_no =  $("#mobile_no").val();

                          if(mobile_no=='' || mobile_no.length!=10)
                              {
                                  alert("Enter 10 Digit Number!");
                              }
                              else
                              {
                                  $.ajax({
                                      type: "POST",
                                      url:"<?php echo e(route('contact_inquiry.index')); ?>",
                                      data:'mobile_no='+mobile_no+
                                      '&_token=<?php echo e(csrf_token()); ?>',
                                      dataType: 'JSON',
                                      success:function(result){

                                          if(result != 0)
                                          {

                                              $("#mobile_no").val("");
                                              alert('We will contact you soon!...');
                                              $('#request_modal').modal('hide');


                                          }
                                          else{
                                              alert('hello');
                                          }

                                      }
                                  });
                              }




                  return false;
              });
              });


       </script>
    </body>
</html><?php /**PATH C:\xampp\htdocs\demo_web\resources\views/frontend/layout/_footer.blade.php ENDPATH**/ ?>