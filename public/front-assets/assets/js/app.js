(function ($) {
  "use strict"; //data background

  $('[data-background]').each(function () {
    var $data_bg = $(this).attr('data-background');
    $(this).css({
      "background-image": 'url(' + $data_bg + ')'
    });
  }); //offcanvas function

  function offCanvus() {
    $(".ofcanvus-toggle").on("click", function () {
      $(".at_offcanvus_menu").addClass("active");
    });
    $(".at-offcanvus-close").on("click", function () {
      $(".at_offcanvus_menu").removeClass("active");
    });
    $(document).on("mouseup", function (e) {
      var offCanvusMenu = $(".at_offcanvus_menu");

      if (!offCanvusMenu.is(e.target) && offCanvusMenu.has(e.target).length === 0) {
        $(".at_offcanvus_menu").removeClass("active");
      }
    });
  }

  offCanvus(); //mobile menu 

  $(".mobile-menu-toggle").on("click", function () {
    $(".mobile-menu").addClass("active");
  });
  $(".mobile-menu .close-menu").on("click", function () {
    $(".mobile-menu").removeClass("active");
  });
  $(".mobile-menu ul li.has-submenu a").each(function () {
    $(this).on("click", function () {
      $(this).siblings('ul').slideToggle();
      $(this).toggleClass("icon-rotate");
    });
  });
  $(document).on("mouseup", function (e) {
    var offCanvusMenu = $(".mobile-menu");

    if (!offCanvusMenu.is(e.target) && offCanvusMenu.has(e.target).length === 0) {
      $(".mobile-menu").removeClass("active");
    }
  }); //section scrolldown 

  $(".btn-scroll-down").on("click", function () {
    $("html,body").animate({
      scrollTop: 600
    });
    return false;
  }); //scroll top animation

  $(".theme-scrolltop-btn").on("click", function () {
    $("body,html").animate({
      scrollTop: 0
    }, 1500, 'easeOutCubic');
  }); //counterup 

  $('.counter').counterUp({
    delay: 10,
    time: 1000
  }); //video popup 

  $('.video-popup-btn').magnificPopup({
    type: 'iframe'
  }); //theme slider 

  const at_hero_slider = new Swiper('.at-hero-slider-wrapper', {
    slidesPerView: 1,
    loop: true,
    spaceBetween: 0,
    autoplay: {
      delay: 5000
    },
    speed: 900,
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    }
  }); //add banner slider

  const ad_banner_slider = new Swiper(".banner-slider", {
    slidesPerView: 2,
    loop: true,
    spaceBetween: 24,
    autoplay: {
      delay: 4000
    },
    speed: 900,
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 2
      }
    }
  });
  const feedback_slider = new Swiper(".at_feedback_slider", {
    slidesPerView: 1,
    loop: true,
    spaceBetween: 24,
    autoplay: {
      delay: 5000
    },
    speed: 1500,
    navigation: {
      nextEl: '.slide-btn-next',
      prevEl: '.slide-btn-prev'
    }
  });
  const h2FeedbackSlider = new Swiper(".h2-feedback-slider", {
    slidesPerView: 2,
    loop: true,
    spaceBetween: 24,
    autoplay: {
      delay: 5000
    },
    speed: 1500,
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      992: {
        slidesPerView: 2
      }
    }
  });
  const carThumbSlider = new Swiper(".car-thumb-slider", {
    loop: true,
    spaceBetween: 24,
    slidesPerView: 3,
    freeMode: true,
    watchSlidesProgress: true,
    navigation: {
      nextEl: ".slider-button-next",
      prevEl: ".slider-button-prev"
    },
    breakpoints: {
      0: {
        slidesPerView: 2
      },
      576: {
        slidesPerView: 3
      },
      1200: {
        slidesPerView: 2
      },
      1400: {
        slidesPerView: 3
      }
    }
  });
  const carSlider = new Swiper(".car-slider", {
    loop: true,
    spaceBetween: 10,
    thumbs: {
      swiper: carThumbSlider
    }
  });
  $(".hero3-slider").slick({
    slidesToShow: 1,
    arrows: false,
    dots: true,
    autoplay: true,
    fade: true,
    autoplaySpeed: 5000,
    speed: 1000
  });
  const h3FeedbackControl = new Swiper(".h3-feedback-client-slider", {
    spaceBetween: 24,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 2
      },
      992: {
        slidesPerView: 3
      },
      1200: {
        slidesPerView: 4
      }
    }
  });
  const h3FeedbackSlider = new Swiper(".h3-feedback-slider", {
    loop: true,
    spaceBetween: 24,
    thumbs: {
      swiper: h3FeedbackControl
    }
  }); //Category Menu 

  $(".category-toggle").on("click", function () {
    $(".product_category_nav").slideToggle();
  }); //category menu offcanvas

  $(".categories-toggle").on("click", function () {
    $('.offcanvas-category-menu').addClass("active");
  });
  $(".offcanvas-category-menu .close-menu").on("click", function () {
    $(".offcanvas-category-menu").removeClass("active");
  });
  $(".offcanvas-category-menu ul li.has-submenu a").each(function () {
    $(this).on("click", function () {
      $(this).siblings('.category-submenu').slideToggle();
      $(this).toggleClass("icon-rotate");
    });
  });
  $(document).on("mouseup", function (e) {
    var offCanvusMenu = $(".offcanvas-category-menu");

    if (!offCanvusMenu.is(e.target) && offCanvusMenu.has(e.target).length === 0) {
      $(".offcanvas-category-menu").removeClass("active");
    }
  }); //custom scrollbar

  $(".at_scrollbar").mCustomScrollbar({
    axis: "y"
  });
  const h4_hero_slider = new Swiper(".h4-hero-slider", {
    slidesPerView: 1,
    loop: true,
    spaceBetween: 10,
    autoplay: true,
    speed: 1500,
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    }
  }); //Countdown

  $(".countdown-timer").each(function () {
    var $data_date = $(this).data('date');
    $(this).countdown({
      date: $data_date
    });
  });
  const flashSalesSlider = new Swiper(".flash-sales-slider", {
    slidesPerView: 4,
    spaceBetween: 24,
    loop: true,
    autoplay: true,
    speed: 1500,
    navigation: {
      nextEl: '.flash-button-next',
      prevEl: '.flash-button-prev'
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      576: {
        slidesPerView: 2
      },
      992: {
        slidesPerView: 3
      },
      1200: {
        slidesPerView: 4
      }
    }
  });
  const h4_ct_slider_1 = new Swiper(".h4_ct_slider_1", {
    slidesPerView: 3,
    spaceBetween: 10,
    loop: true,
    autoplay: true,
    speed: 1500,
    navigation: {
      nextEl: '.flash-button-next',
      prevEl: '.flash-button-prev'
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      400: {
        slidesPerView: 2
      },
      768: {
        slidesPerView: 3
      },
      992: {
        slidesPerView: 4
      },
      1200: {
        slidesPerView: 3
      }
    }
  });
  const h4_ct_slider_2 = new Swiper(".h4_ct_slider_2", {
    slidesPerView: 4,
    spaceBetween: 24,
    loop: true,
    autoplay: true,
    speed: 1500,
    navigation: {
      nextEl: '.flash-button-next',
      prevEl: '.flash-button-prev'
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      550: {
        slidesPerView: 2
      },
      992: {
        slidesPerView: 3
      },
      1200: {
        slidesPerView: 4
      }
    }
  });
  const megaMenuSlider = new Swiper(".megamenu-slider", {
    slidesPerView: 1,
    spaceBetween: 16,
    autoplay: true,
    speed: 1500
  });
  const productThumbSlider = new Swiper(".product_thumb_slider", {
    loop: true,
    spaceBetween: 16,
    slidesPerView: 3,
    freeMode: true,
    watchSlidesProgress: true,
    navigation: {
      nextEl: ".slider-button-next",
      prevEl: ".slider-button-prev"
    },
    breakpoints: {
      0: {
        slidesPerView: 3
      },
      576: {
        slidesPerView: 3
      },
      1200: {
        slidesPerView: 2
      },
      1400: {
        slidesPerView: 4
      }
    }
  });
  const productViewSlider = new Swiper(".product_feature_img_slider", {
    loop: true,
    spaceBetween: 10,
    thumbs: {
      swiper: productThumbSlider
    }
  });
  const blogGridSlider = new Swiper(".blog-grid-slider", {
    slidesPerView: 1,
    autoplay: true,
    loop: true,
    spaceBetween: 10,
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    }
  });
  const inventorySlider = new Swiper(".inventroy-slider", {
    slidesPerView: 4,
    autoplay: true,
    loop: true,
    spaceBetween: 24,
    navigation: {
      nextEl: ".slider-btn-next",
      prevEl: ".slider-btn-prev"
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 2
      },
      992: {
        slidesPerView: 3
      },
      1400: {
        slidesPerView: 4
      }
    }
  });
  const ivThumbControlSlider = new Swiper(".iv_thumb_control_slider", {
    slidesPerView: 4,
    loop: true,
    spaceBetween: 24,
    breakpoints: {
      0: {
        slidesPerView: 3,
        spaceBetween: 16
      },
      992: {
        slidesPerView: 4,
        spaceBetween: 24
      }
    }
  });
  const ivThumbSlider = new Swiper(".iv_thumb_slider", {
    slidesPerView: 1,
    autoplay: true,
    loop: true,
    spaceBetween: 16,
    thumbs: {
      swiper: ivThumbControlSlider
    }
  });
  const shopProductslider = new Swiper(".shop-products-slider", {
    slidesPerView: 1,
    autoplay: true,
    loop: true,
    spaceBetween: 16,
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      576: {
        slidesPerView: 2
      },
      992: {
        slidesPerView: 3
      },
      1200: {
        slidesPerView: 1
      }
    }
  });
  const productThumbSlider2 = new Swiper(".product_thumb_slider_2", {
    loop: true,
    spaceBetween: 16,
    slidesPerView: 3,
    freeMode: true,
    watchSlidesProgress: true,
    navigation: {
      nextEl: ".slider-button-next",
      prevEl: ".slider-button-prev"
    },
    breakpoints: {
      0: {
        slidesPerView: 3
      },
      576: {
        slidesPerView: 3
      },
      1200: {
        slidesPerView: 2
      },
      1400: {
        slidesPerView: 4
      }
    }
  });
  const productViewSlider2 = new Swiper(".product_feature_img_slider_2", {
    loop: true,
    spaceBetween: 10,
    thumbs: {
      swiper: productThumbSlider2
    }
  }); //dealer sidebar slider

  $(".dl_slider_wrapper").slick({
    slidesToShow: 1,
    arrows: false,
    dots: true,
    responsive: [{
      breakpoint: 1200,
      settings: {
        slidesToShow: 3
      }
    }, {
      breakpoint: 992,
      settings: {
        slidesToShow: 2
      }
    }, {
      breakpoint: 576,
      settings: {
        slidesToShow: 1
      }
    }]
  }); //Related Products Slider

  const rlProductSlider = new Swiper(".rl-products-slider", {
    slidesPerView: 4,
    spaceBetween: 24,
    loop: true,
    autoplay: true,
    navigation: {
      nextEl: '.slider-button-next',
      prevEl: '.slider-button-prev'
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      576: {
        slidesPerView: 2,
        spaceBetween: 16
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 24
      },
      1400: {
        slidesPerView: 4
      }
    }
  });
  const dealerSlider = new Swiper(".dealership-slider", {
    loop: true,
    spaceBetween: 24,
    autoplay: true,
    slidesPerView: 3,
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 16
      },
      768: {
        slidesPerView: 2
      },
      992: {
        slidesPerView: 3
      },
      1400: {
        slidesPerView: 4
      }
    }
  }); //sr feedback slider

  const srFeedbackSlider = new Swiper(".sr-feedback-slider", {
    loop: true,
    spaceBetween: 24,
    autoplay: true,
    slidesPerView: 3,
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 16
      },
      768: {
        slidesPerView: 2
      },
      1200: {
        slidesPerView: 3
      }
    }
  }); //dealership 2 brand slider 

  const bannerSlider2 = new Swiper(".dl2-banner-slider", {
    loop: true,
    spaceBetween: 24,
    slidesPerView: 1,
    autoplay: true,
    speed: 1000,
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    }
  });
  const dl2FeedbackSlider = new Swiper(".dl2-feedback-slider", {
    loop: true,
    spaceBetween: 24,
    autoplay: true,
    speed: 1000,
    breakpoints: {
      992: {
        slidesPerView: 2
      },
      1200: {
        slidesPerView: 1
      }
    }
  });
  const heroBikeSlider = new Swiper(".hero-bike-slider", {
    slidesPerView: 1,
    spaceBetween: 24,
    speed: 1000,
    autoplay: true,
    loop: true,
    pagination: {
      el: '.bike-slider-pagination',
      type: 'progressbar'
    }
  });
  const motoPartSlider = new Swiper(".moto-parts-slider", {
    slidesPerView: 4,
    spaceBetween: 16,
    speed: 1000,
    autoplay: true,
    loop: true,
    navigation: {
      nextEl: '.moto-parts-slider-next',
      prevEl: '.moto-parts-slider-prev'
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      480: {
        slidesPerView: 2
      },
      768: {
        slidesPerView: 3
      },
      992: {
        slidesPerView: 4
      }
    }
  });
  const mdBannerSlider = new Swiper(".md-banner-slider", {
    slidesPerView: 2,
    spaceBetween: 24,
    speed: 1000,
    autoplay: true,
    loop: true,
    pagination: {
      el: '.md-banner-pagination',
      type: 'bullets',
      clickable: true
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      992: {
        slidesPerView: 2
      }
    }
  });
  const mdBikeSlider = new Swiper(".md-bike-slider", {
    slidesPerView: 1,
    spaceBetween: 24,
    speed: 1000,
    pagination: {
      el: '.ft-bike-slider-pagination',
      type: 'progressbar'
    }
  });
  const elCarListingThumbSlider = new Swiper(".el-car-listing-slider-thumb", {
    slidesPerView: 4,
    spaceBetween: 20,
    slideToClickedSlide: true,
    breakpoints: {
      0: {
        slidesPerView: 2
      },
      480: {
        slidesPerView: 3
      },
      768: {
        slidesPerView: 4
      }
    }
  });
  const elCarlistingSlider = new Swiper(".el-car-listing-slider-lg", {
    slidesPerView: 1,
    spaceBetween: 24,
    thumbs: {
      swiper: elCarListingThumbSlider
    }
  });
  const elServiceSlider = new Swiper(".el-service-slider", {
    slidesPerView: 3,
    spaceBetween: 24,
    loop: true,
    autoplay: true,
    speed: 700,
    navigation: {
      prevEl: '.el-service-slider-prev',
      nextEl: '.el-service-slider-next'
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 2
      },
      1200: {
        slidesPerView: 3
      }
    }
  });
  const elBrandSlider = new Swiper(".el-brands-slider", {
    slidesPerView: 6,
    spaceBetween: 24,
    autoplay: true,
    loop: true,
    autoplay: true,
    speed: 700,
    breakpoints: {
      0: {
        slidesPerView: 2
      },
      400: {
        slidesPerView: 3
      },
      576: {
        slidesPerView: 4
      },
      992: {
        slidesPerView: 5
      },
      1200: {
        slidesPerView: 6
      }
    }
  });
  const elFeedbackSlider = new Swiper(".el-feedback-slider", {
    slidesPerView: 1,
    spaceBetween: 24,
    autoplay: true,
    speed: 700,
    loop: true,
    pagination: {
      el: '.el-feedback-slide-contorls',
      type: 'bullets',
      clickable: true
    }
  });
  const smBikeSlider = new Swiper(".sm-bike-slider", {
    slidesPerView: 4,
    spaceBetween: 24,
    autoplay: true,
    loop: true,
    speed: 700,
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 2
      },
      992: {
        slidesPerView: 3
      },
      1400: {
        slidesPerView: 4
      }
    }
  }); //bike-listing slider control

  const bldBikeSliderControl = new Swiper(".bike-listing-slider-control", {
    slidesPerView: 3,
    spaceBetween: 12,
    speed: 700,
    loop: true,
    breakpoints: {
      0: {
        direction: "horizontal"
      },
      992: {
        direction: "vertical"
      }
    }
  });
  const bldBikeSlider = new Swiper(".bld-bike-slider", {
    slidesPerView: 1,
    spaceBetween: 24,
    autoplay: true,
    speed: 700,
    loop: true,
    thumbs: {
      swiper: bldBikeSliderControl
    }
  });
  const eqHeroSlider = new Swiper(".eq-hero-slider", {
    slidesPerView: 1,
    //autoplay: true,
    spaceBetween: 24,
    speed: 700,
    loop: true,
    pagination: {
      el: '.eq-hero-slider-pagination',
      type: 'progressbar'
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 2
      },
      992: {
        slidesPerView: 3
      },
      1200: {
        slidesPerView: 1
      }
    }
  });
  const eqFeedbackSlider = new Swiper(".eq-feedback-slider", {
    slidesPerView: 3,
    spaceBetween: 24,
    speed: 700,
    loop: true,
    pagination: {
      el: ".eq-feedback-pagination",
      type: "bullets",
      clickable: true
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 2
      },
      1200: {
        slidesPerView: 3
      }
    }
  });
  const eqBrandSlider = new Swiper(".eq-brand-slider", {
    slidesPerView: 5,
    spaceBetween: 16,
    loop: true,
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      400: {
        slidesPerView: 2
      },
      550: {
        slidesPerView: 3
      },
      992: {
        slidesPerView: 4
      },
      1200: {
        slidesPerView: 5
      }
    }
  });
  const eqdGalleryControlSlider = new Swiper(".eqd-gallery-control-slider", {
    spaceBetween: 16,
    loop: true,
    speed: 700,
    breakpoints: {
      0: {
        slidesPerView: 2
      },
      576: {
        slidesPerView: 3
      },
      992: {
        slidesPerView: 4
      }
    }
  });
  const eqdVideoGallerySlider = new Swiper(".eqd-video-gallery-slider", {
    slidesPervView: 1,
    autoplay: true,
    loop: true,
    spaceBetween: 24,
    speed: 700,
    thumbs: {
      swiper: eqdGalleryControlSlider
    }
  }); //cycle hero slider

  var cycle_hero_slider = new Swiper(".cycle-hero-slider", {
    slidesPerView: 1,
    spaceBetween: 24,
    autoplay: true,
    speed: 700,
    loop: true,
    loopedSlides: 6,
    pagination: {
      el: ".cycle-hero-pagination",
      type: "bullets",
      clickable: true,
      renderBullet: function (index, className) {
        if (index + 1 >= 10) {
          return '<span class="' + className + '">' + (index + 1) + "</span>";
        } else {
          return '<span class="' + className + '">' + 0 + (index + 1) + "</span>";
        }
      }
    }
  });
  var cycle_hero_slider_control = new Swiper(".cl-hero-slider-control", {
    slidesPerView: 3,
    autoplay: true,
    speed: 700,
    centeredSlides: true,
    loop: true,
    slideToClickedSlide: true,
    navigation: {
      prevEl: ".cl-hero-slides-control-prev",
      nextEl: ".cl-hero-slides-control-next"
    }
  });
  cycle_hero_slider.controller.control = cycle_hero_slider_control;
  cycle_hero_slider_control.controller.control = cycle_hero_slider;
  const cycle_service_slider = new Swiper(".cycle-service-slider", {
    slidesPerView: 2,
    spaceBetween: 24,
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 2
      }
    }
  }); //slide index

  var eqSlideIndex = $(".eq-hero-slider .swiper-slide").length - 2;

  if (eqSlideIndex < 10) {
    eqSlideIndex = "0" + eqSlideIndex;
  }

  $(".eq-hero-slider").siblings(".slide-end-index").text(eqSlideIndex); //cycle feedback slider 

  var cycle_feedback_slider = new Swiper(".cl-feedback-slider", {
    slidesPerView: 1,
    autoplay: true,
    speed: 700,
    spaceBetween: 48,
    loop: true
  }); //content expand 

  $(".iv-expand-btn").on("click", function (e) {
    e.preventDefault();
    $(".expanded-content").slideDown();
  });
  $('.theme-date-input').datetimepicker({
    icons: {
      time: 'fa-solid fa-clock'
    }
  }); //theme file upload

  var file_upload = $(".file_upload");
  file_upload.children(".btn").on("click", function () {
    $(this).siblings('input').click();
  });
  file_upload.children('input').on("change", function () {
    var file_name = this.files[0].name;
    $(this).siblings(".file_name").text(file_name);
  }); //Progressbar

  $(".progress-bar-line").ProgressBar(); //listing scroll nav

  $(".car_listing_nav ul li a").each(function () {
    $(this).on("click", function (e) {
      e.preventDefault();

      if ($(this.hash) && $(this.hash).offset()) {
        var hashOffset = $(this.hash).offset().top - 100;
        $("body,html").animate({
          scrollTop: hashOffset
        }, 1000, 'easeOutCubic');
      }
    });
  }); //shipping form slideToggle 

  $(".alternate-shipping label").on("click", function () {
    if ($(this).children("input").is(":checked")) {
      $(".alternate-shipping-form").slideDown();
    } else {
      $(".alternate-shipping-form").slideUp();
    }
  }); //elAboutBox

  $(".el-about-box").each(function () {
    $(this).hover(function () {
      $(this).parents(".row").find(".el-about-box.active").removeClass("active");
      $(this).addClass("active");
    });
  }); //image rotate 

  $(".img-rotate").each(function () {
    var img_location = $(this).data("img-folder");
    var totalFrames = $(this).data("total-images");
    $(this).TreeSixtyImageRotate({
      totalFrames: totalFrames,
      endFrame: totalFrames,
      currentFrame: 5,
      extension: '.png',
      imagesFolder: img_location,
      navigation: true
    }).initTreeSixty();
  }); //bootstrap tooltip

  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
  $(window).on('scroll', function () {
    //header sticky 
    var scrollBar = $(this).scrollTop();

    if (scrollBar > 100) {
      $(".header-sticky").addClass("sticky-on");
    } else {
      $(".header-sticky").removeClass("sticky-on");
    } //theme scrolltop button 


    if (scrollBar > 300) {
      $(".theme-scrolltop-btn").fadeIn();
    } else {
      $(".theme-scrolltop-btn").fadeOut();
    } //vertical listing menu


    var scrollBarPosition = $(window).scrollTop();
    $(".car_listing_nav ul li a").each(function () {
      if ($(this.hash) && $(this.hash).offset()) {
        var navOffset = $(this.hash).offset().top - 120;

        if (scrollBarPosition > navOffset) {
          $(this).parents("ul").find("a.active").removeClass("active");
          $(this).addClass("active");
        }
      }
    });
  });
  $(window).on('load', function () {
    //preloader
    $(".ring-preloader").fadeOut();
    var $grid = $('.filter-grid').isotope({});
    $('.collection-filter-controls').on('click', 'button', function () {
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({
        filter: filterValue
      });
    }); //active btn switch 

    $(".collection-filter-controls button").each(function () {
      $(this).on("click", function () {
        $(this).parent().find("button.active").removeClass("active");
        $(this).addClass("active");
      });
    }); // filter grid 2

    var $filter_grid_2 = $('.filter_grid_2').isotope({});
    $('.h4-filter-btn-group').on('click', 'button', function () {
      var filterValue = $(this).attr('data-filter');
      $filter_grid_2.isotope({
        filter: filterValue
      });
      $(this).parent(".h4-filter-btn-group").find("button.active").removeClass("active");
      $(this).addClass("active");
    }); // filter grid 3

    var $filter_grid_3 = $('.filter_grid_3').isotope({});
    $('.bs-filter-btn-group').on('click', 'button', function () {
      var filterValue = $(this).attr('data-filter');
      $filter_grid_3.isotope({
        filter: filterValue
      });
      $(this).parent(".bs-filter-btn-group").find("button.active").removeClass("active");
      $(this).addClass("active");
    }); //masonry grid 

    $('.masonry_grid').isotope({
      itemSelector: '.grid_item',
      percentPosition: true,
      masonry: {
        columnWidth: 1
      }
    });
    var filter_grid_4 = $(".featured_masonry");
    $('.listing-ft-controls').on('click', 'button', function () {
      var filterValue = $(this).attr('data-filter');
      filter_grid_4.isotope({
        filter: filterValue
      });
      $(this).parent(".listing-ft-controls").find("button.active").removeClass("active");
      $(this).addClass("active");
    });
  });
})(window.jQuery);