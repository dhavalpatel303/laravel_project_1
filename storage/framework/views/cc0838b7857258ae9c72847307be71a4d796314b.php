
<body>

    <div class="ring-preloader w-100 h-100 position-fixed start-0 top-0">
        <div class="lds-dual-ring"></div>
    </div>

    <!--main content wrapper start-->
    <div class="main-wrapper">

        <!--header area start-->
        <header class="header-style-one header-sticky">
            <div class="at_topbar d-none d-sm-block bg-white">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-4 col-lg-5 col-8">
                            <div class="tp-info">
                                <p class="mb-0"> <marquee onmouseover="this.stop();" onmouseout="this.start();"><a style="font-size: 15px; color:black;">Get200 Use This Code For Get Discount !</a></marquee></p>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-4">
                            <div class="tp-info-wrapper d-flex align-items-center justify-content-end">
                                
                                <div class="tp-info d-inline-flex align-items-center">
                                    <span class="icon-wrapper me-2">
                                      <i class="flaticon-phone-call"></i>
                                  </span>
                                    <p class="mb-0">+91 <?php echo e(helpers::mobile()); ?></p>
                                </div>
                                <div class="d-none tp-info d-xl-inline-flex align-items-center">
                                    <span class="icon-wrapper me-2">
                                      <i class="flaticon-email"></i>
                                  </span>
                                    <p class="mb-0"><?php echo e(helpers::email()); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="at_header_nav">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6 col-lg-3">
                            <div class="logo-wrapper">
                                <a href="<?php echo e(route('home.index')); ?>"><img src="<?php echo e(asset('front-assets/assets/img/logo.png')); ?>" alt="logo"></a>
                            </div>
                        </div>
                        <div class="col-6 col-lg-9">
                            <div class="at_header_right d-flex align-items-center justify-content-end">
                                <nav class="at_nav_menu d-none d-lg-block">
                                    <ul> 
                                        <li><a class="<?php echo e(Request::is('/') ? 'menu_active':''); ?>" href="<?php echo e(route('home.index')); ?>">Home</a></i>
                                        <li><a class="<?php echo e(Request::is('about-us') ? 'menu_active':''); ?>" href="<?php echo e(route('about.index')); ?>">About us</a></li>
                                           <li><a class="<?php echo e(Request::is('service') ? 'menu_active':''); ?>" href="<?php echo e(route('service')); ?>">Service</a></i>
                                           <li><a class="<?php echo e(Request::is('oneway-routs') ? 'menu_active':''); ?>" href="<?php echo e(route('routs.index')); ?>">Routes</a></i>
                                           <li><a class="<?php echo e(Request::is('contact-us') ? 'menu_active':''); ?>" href="<?php echo e(route('contact.index')); ?>">Contact us</a></i>
                                           <?php if(session()->get('user_mobile')): ?>
                                           <li><a  class="<?php echo e(Request::is('myaccount') ? 'menu_active':''); ?>" href="<?php echo e(route('myaccount')); ?>">My Account</a></i></li>
                                           <li><a href="<?php echo e(route('logout')); ?>">Logout</a></i></li>
                                           <?php else: ?>
                                           <li><a class="<?php echo e(Request::is('user-register') ? 'menu_active':''); ?> <?php echo e(Request::is('signup') ? 'menu_active':''); ?> "  href="<?php echo e(route('ragister.index')); ?>">Login/Register</a></i></li>
                                           <?php endif; ?>
                                       
                                    </ul>
                                </nav>
                                
                                <a id="req_button"  class="listing-btn text-white ms-4 d-none d-sm-block "><span class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle text-white me-2"><i class="fa-solid fa-phone"></i></span>Request Call Back</a>
                               
                                <button class="mobile-menu-toggle header-toggle-btn ms-4 d-lg-none">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--header area end-->

        <!--mobile menu start-->
        <div class="mobile-menu position-fixed bg-white deep-shadow">
            <button class="close-menu position-absolute"><i class="fa-solid fa-xmark"></i></button>
            <a href="<?php echo e(route('home.index')); ?>" class="logo-wrapper bg-secondary d-block mt-4 p-3 rounded-1 text-center"><img src="<?php echo e(asset('front-assets/assets/img/logo.png')); ?>" alt="logo" class="img-fluid"></a>
            <nav class="mobile-menu-wrapper mt-40">
                <ul>
                <li><a class="<?php echo e(Request::is('/') ? 'menu_active':''); ?>" href="<?php echo e(route('home.index')); ?>">Home</a></i>
                                        <li><a class="<?php echo e(Request::is('about-us') ? 'menu_active':''); ?>" href="<?php echo e(route('about.index')); ?>">About us</a></li>
                                           <li><a class="<?php echo e(Request::is('service') ? 'menu_active':''); ?>" href="<?php echo e(route('service')); ?>">Service</a></i>
                                           <li><a class="<?php echo e(Request::is('oneway-routs') ? 'menu_active':''); ?>" href="<?php echo e(route('routs.index')); ?>">Routes</a></i>
                                           <li><a class="<?php echo e(Request::is('contact-us') ? 'menu_active':''); ?>" href="<?php echo e(route('contact.index')); ?>">Contact us</a></i>
                                           <?php if(session()->get('user_mobile')): ?>
                                           <li><a  class="<?php echo e(Request::is('myaccount') ? 'menu_active':''); ?>" href="<?php echo e(route('myaccount')); ?>">My Account</a></i></li>
                                           <li><a href="<?php echo e(route('logout')); ?>">Logout</a></i></li>
                                           <?php else: ?>
                                           <li><a href="<?php echo e(route('ragister.index')); ?>">Login/Register</a></i></li>
                                           <?php endif; ?>
                </ul>
                
            </nav>
            <div class="contact-info mt-60">
                <h4 class="mb-20">Contact Info</h4>
                <p>Chicago 12, Melborne City, USA</p>
                <p>+88 01682648101</p>
                <p>info@example.com</p>
                <div class="social-contact">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <!--mobile menu end-->

        <!--ofcanvus menu start-->
        <div class="at_offcanvus_menu position-fixed">
            <button class="at-offcanvus-close"><i class="fa-solid fa-xmark"></i></button>
            <a href="#" class="logo-wrapper d-inline-block mb-5"><img src="assets/img/logo-black.png" alt="logo"></a>
            <div class="offcanvus-content">
                <h4 class="mb-4">About Us</h4>
                <p>Explain to you how all this mistaken denouncing pleasure and praising pain was born and we will give you a complete account of the system, and expound the actual teachings.</p>
                <p>Mistaken denouncing pleasure and praising pain was born and we will give you complete account of the system expound.</p>
                <a href="#" class="btn btn-primary mt-4">About Us</a>
            </div>
            <div class="offcanvus-contact">
                <h4 class="mb-4 mt-5">Contact Info</h4>
                <ul class="at_canvus_address">
                    <li><?php echo e(helpers::address()); ?></li>
                    <li><?php echo e(helpers::mobile()); ?></li>
                    <li><?php echo e(helpers::email()); ?></li>
                </ul>
            </div>
            <div class="at_canvus_social mt-4">
                <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-btn"><i class="fab fa-linkedin"></i></a>
                <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-btn"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        
        <!--ofcanvus menu end--><?php /**PATH C:\xampp\htdocs\demo_web\resources\views/frontend/layout/_header.blade.php ENDPATH**/ ?>