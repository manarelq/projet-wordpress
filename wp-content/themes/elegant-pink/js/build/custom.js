jQuery(document).ready(function ($) {

    /** Variables from Customizer for Slider settings */
    var slider_auto, slider_loop, slider_control, rtl, mrtl, slider_animation;

    if (elegant_pink_data.auto == '1') {
        slider_auto = true;
    } else {
        slider_auto = false;
    }

    if (elegant_pink_data.loop == '1') {
        slider_loop = true;
    } else {
        slider_loop = false;
    }

    if (elegant_pink_data.option == '1') {
        slider_control = true;
    } else {
        slider_control = false;
    }

    if (elegant_pink_data.rtl == '1') {
        rtl = true;
        mrtl = false;
    } else {
        rtl = false;
        mrtl = true;
    }

    /** Home Page Slider */
    if (elegant_pink_data.mode == 'slide') {
        slider_animation = '';
    } else {
        slider_animation = 'fadeOut';
    }

    $("#imageGallery").owlCarousel({
        items: 1,
        margin: 0,
        loop: slider_loop,
        autoplay: slider_auto,
        nav: slider_control,
        dots: false,
        animateOut: slider_animation,
        autoplayTimeout: elegant_pink_data.pause,
        lazyLoad: true,
        mouseDrag: false,
        rtl: rtl,
        autoplaySpeed: elegant_pink_data.speed,
    });

    /** Masonry */
    $('.ep-masonry').imagesLoaded(function () {
        $('.ep-masonry').masonry({
            itemSelector: '.post',
            isOriginLeft: mrtl
        });
    });

    $('.overlay').on( 'click', function() {
        // $('.mobile-menu').toggleClass('menu-open');
        $('#mobile-site-navigation').removeClass('toggled');
        $('body').removeClass('menu-open');
    });

    //responsive-menu-toggle
    $('.btn-menu-opener').on( 'click', function() {
        // $('.mobile-menu').toggleClass('menu-open');
        $('#mobile-site-navigation').addClass('toggled');
        $('body').addClass('menu-open');
    });

    $('.mobile-menu .close').on( 'click', function() {
        // $('.mobile-menu').toggleClass('menu-open');
        $('#mobile-site-navigation').removeClass('toggled');
        $('body').removeClass('menu-open');

    });

    $('<button class="angle-down"></button>').insertAfter($('.mobile-main-navigation ul .menu-item-has-children > a'));
    $('.mobile-main-navigation ul li .angle-down').on( 'click', function() {
        $(this).next().slideToggle();
        $(this).toggleClass('active');
    });

    //for drop down menu appear in edge from keyboard
    var winWidth = $(window).width();
    if (winWidth > 1024) {
        $(".main-navigation ul li a").on( 'focus', function() {
            $(this).parents("li").addClass("focus");
        }).on( 'blur', function() {
            $(this).parents("li").removeClass("focus");
        });
    }

    var windowWidth = window.innerWidth;
    window.addEventListener('resize', function () {
        if (windowWidth >= 1024) {
            document.body.classList.remove('menu-open');
        }
    });
});
