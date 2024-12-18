(function($) {
  'use strict';
    $(window).on('scroll', function () {
      if ($(this).scrollTop() > 200) {
        $('.scrollUp').addClass('is-active');
      } else {
        $('.scrollUp').removeClass('is-active');
      }
    });
    $(window).on('scroll', function() {
      if ($(window).scrollTop() >= 250) {
          $('.is-sticky-on').addClass('is-sticky-menu');
      }
      else {
          $('.is-sticky-on').removeClass('is-sticky-menu');
      }
    });
    $(window).bind("scroll", function(){if ($(".scrollUp").length){
        let b = $("body").height(),c = $(window).height(),d = b - c,e = $(window).scrollTop(),f = 250 - e / d * 150;
        $(".scrollUp circle").css("stroke-dashoffset", f + "px")
    }}),$('.scrollUp').click(function(b){return b.preventDefault(),$('html, body').animate({scrollTop:0},320),!1});
    $( document ).ready(function() {
        //Browse Menu
        if( $('.product-category-menus-list ul.main-menu').children().length >= 7 ) {
            $(".product-category-menus-list").addClass("active");
            $(".product-category-menus-list ul.main-menu").append('<li class="menu-item more-item"><button type="button" class="browse-more"><i class="fa fa-plus"></i> <span>More Category</span></button></li>');
            $(".product-category-menus-list > ul.main-menu > li:not(.more-item)").slice(0, 7).show();
            $(".browse-more").on('click', function (e) {
                if (!$(".browse-more").hasClass("active")) {
                    $(".browse-more").addClass("active");
                    $('.browse-more i').removeClass('fa-plus').addClass("fa-minus");
                    $(".browse-more").animate({display: "block"}, 500,
                        function () {
                            $(".product-category-menus-list > ul.main-menu > li:not(.more-item):hidden").addClass('actived').slideDown(200);
                            if ($(".product-category-menus-list > ul.main-menu > li:not(.more-item):hidden").length === 0) {
                                $(".browse-more").html('<i class="fa fa-minus"></i> <span>No More</span>');
                            }
                        }
                    );
                } else {
                    $(".browse-more").removeClass("active");
                    $(".browse-more").animate({display: "none"}, 500,
                        function () {
                            if ($(".product-category-menus-list > ul.main-menu > li:not(.more-item)").hasClass('actived')) {
                                $(".product-category-menus-list > ul.main-menu > li:not(.more-item).actived").slice(0, 7).slideUp(200);
                                $(".browse-more").html('<i class="fa fa-plus"></i> <span>More Category</span>');
                            }
                        }
                    );
                }
            });
        }
        $('.product-category-browse').hasClass('active') ? browseMenuAccessibility() : '';
        function browseMenuAccessibility() {
            var e, t, i, n = document.querySelector(".product-category-browse");
            let a = document.querySelector(".product-category-btn"),
                s = n.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                o = s[s.length - 1];
            if (!n) return !1;
            for (t = 0, i = (e = n.getElementsByTagName("a")).length; t < i; t++) e[t].addEventListener("focus", c, !0), e[t].addEventListener("blur", c, !0);
            function c() {
                for (var e = this; - 1 === e.className.indexOf("product-category-browse");) "li" === e.tagName.toLowerCase() && (-1 !== e.className.indexOf("focus") ? e.className = e.className.replace(" focus", "") : e.className += " focus"), e = e.parentElement
            }
            document.addEventListener("keydown", function(e) {
                ("Tab" === e.key || 9 === e.keyCode) && (e.shiftKey ? document.activeElement === a && (o.focus(), e.preventDefault()) : document.activeElement === o && (a.focus(), e.preventDefault()))
            })
        }
        $(".main-navbar").find("a").on("focus blur", function() { $(this).parents("ul, li").toggleClass("focus"); });
        //$('.btn,.post-items .more-link').prepend('<div class="hover"><span></span><span></span><span></span><span></span><span></span></div>');

        if(window.matchMedia('(max-width: 991px)').matches) {
            $('.product-category-browse').removeClass("active")
            $('.product-category-menus-list').addClass('closed');
            $('.product-category-menus .product-category-menus-list').css('display', 'none');
        } else {
            $('.product-category-browse').each(function(){
                if ($('.product-category-browse').hasClass("active")) {
                    setTimeout(function(){
                        $('.product-category-menus-list').removeClass('closed');
                    }, 100);
                    $('.product-category-menus .product-category-menus-list').slideDown(700);
                } else {
                    $('.product-category-menus-list').addClass('closed');
                    $('.product-category-menus .product-category-menus-list').css('display', 'none');
                }
            });
        }
        
        $('.product-category-btn').on('click',function(e){
            e.preventDefault();
            $('.product-category-browse').toggleClass("active");
            if ($('.product-category-browse').hasClass("active")) {
                setTimeout(function(){
                    $('.product-category-menus-list').removeClass('closed');
                }, 100);
                $('.product-category-menus .product-category-menus-list').slideDown(700);
            } else {
                $('.product-category-menus-list').addClass('closed');
                $('.product-category-menus .product-category-menus-list').slideUp(700);
            }
            e.stopPropagation();
        });
        $('.scrollingUp').on('click', function () {
          $("html, body").animate({
            scrollTop: 0
          }, 600);
          return false;
        });
        $('.cart-trigger').on('click',function(e){
            e.preventDefault();
            if (!$('.cart-modal').hasClass("cart-active")) {
                $('.cart-modal').addClass('cart-active');
                $('.cart-close').focus();
                var e, t, i, n = document.querySelector(".cart-modal");
                let a = document.querySelector(".cart-close"),
                    s = n.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                    o = s[s.length - 1];
                if (!n) return !1;
                for (t = 0, i = (e = n.getElementsByTagName("a")).length; t < i; t++) e[t].addEventListener("focus", c, !0), e[t].addEventListener("blur", c, !0);
                function c() {
                    for (var e = this; - 1 === e.className.indexOf("cart-container");) "li" === e.tagName.toLowerCase() && (-1 !== e.className.indexOf("focus") ? e.className = e.className.replace(" focus", "") : e.className += " focus"), e = e.parentElement
                }
                document.addEventListener("keydown", function(e) {
                    ("Tab" === e.key || 9 === e.keyCode) && (e.shiftKey ? document.activeElement === a && (o.focus(), e.preventDefault()) : document.activeElement === o && (a.focus(), e.preventDefault()))
                })
            } else {
                $('.cart-trigger').focus();
                $('.cart-modal').removeClass('cart-active');
            }
        });
        $('.cart-close, .cart-overlay').on('click',function(e){
            e.preventDefault();
            $('.cart-trigger').focus();
            $('.cart-modal').removeClass('cart-active');
        });
        
        $('.cart-close, .cart-overlay').on('click',function(e){
            e.preventDefault();
            $('.cart-trigger').focus();
            $('.cart-modal').removeClass('cart-active');
        });
        $('.signin-close').on('click',function(e){
            e.preventDefault();
            $('.signin-close').focus();
            $('.vf-signin-popup').removeClass('active');
        });
		
		// Home Slider
        var $owlHome = $('.home-slider');
        $owlHome.owlCarousel({
          rtl: $("html").attr("dir") == 'rtl' ? true : false,
          items: 1,
          autoplay: true,
		  autoplayTimeout: 10000,
          margin: 0,
          loop: true,
          dots: true,
          nav: true,
          navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
          singleItem: true,
          transitionStyle: "fade",
          touchDrag: true,
          mouseDrag: true,
          slideSpeed: 2000,
          responsiveRefreshRate: 200,
        });
        $owlHome.owlCarousel();
        $owlHome.on('translate.owl.carousel', function (event) {
            var data_anim = $("[data-animation]");
            data_anim.each(function() {
                var anim_name = $(this).data('animation');
                $(this).removeClass('animated ' + anim_name).css('opacity', '0');
            });
        });
        $("[data-delay]").each(function() {
            var anim_del = $(this).data('delay');
            $(this).css('animation-delay', anim_del);
        });
        $("[data-duration]").each(function() {
            var anim_dur = $(this).data('duration');
            $(this).css('animation-duration', anim_dur);
        });
        $owlHome.on('translated.owl.carousel', function() {
            var data_anim = $owlHome.find('.owl-item.active').find("[data-animation]");
            data_anim.each(function() {
                var anim_name = $(this).data('animation');
                $(this).addClass('animated ' + anim_name).css('opacity', '1');
            });
        });
        function owlHomeThumb() {
            $('.owl-item').removeClass('prev next');
            var currentSlide = $('.home-slider .owl-item.active');
            currentSlide.next('.owl-item').addClass('next');
            currentSlide.prev('.owl-item').addClass('prev');
            var nextSlideImg = $('.owl-item.next').find('.item img').attr('data-img-url');
            var prevSlideImg = $('.owl-item.prev').find('.item img').attr('data-img-url');
            $('.home-slider .owl-nav .owl-prev').css({
                backgroundImage: 'url(' + prevSlideImg + ')'
            });
            $('.home-slider .owl-nav .owl-next').css({
                backgroundImage: 'url(' + nextSlideImg + ')'
            });
        }
        owlHomeThumb();
        $owlHome.on('translated.owl.carousel', function() {
            owlHomeThumb();
        });
		       

        // Trending Product Carousel
        var owlTrendingProducts = $(".vf-trending-products.products-carousel .woocommerce .products");
        owlTrendingProducts.each(function () {
            $(this).addClass('owl-carousel owl-theme');
        });
        owlTrendingProducts.owlCarousel({
            rtl: $("html").attr("dir") == 'rtl' ? true : false,
            loop: false,
            rewind: true,
            nav: false,
            dots: false,
            margin: 26,
            mouseDrag: true,
            touchDrag: true,
            autoplay: true,
            autoplayTimeout: 12000,
            stagePadding: 18,
            autoHeight: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                992: {
                    items: 4
                }
            }
        });


        // Quick Veiw Trigger
        $('.quickview-trigger').on('click',function(e){
            e.preventDefault();
            if (!$('.quickview-overlay').hasClass("active")) {
                $('.quickview-overlay').addClass('active');
                $('.quickview-close').focus();
                var e, t, i, n = document.querySelector(".quickview-overlay");
                let a = document.querySelector(".quickview-close"),
                    s = n.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                    o = s[s.length - 1];
                if (!n) return !1;
                for (t = 0, i = (e = n.getElementsByTagName("a")).length; t < i; t++) e[t].addEventListener("focus", c, !0), e[t].addEventListener("blur", c, !0);
                function c() {
                    for (var e = this; - 1 === e.className.indexOf("quickview-model-details");) "li" === e.tagName.toLowerCase() && (-1 !== e.className.indexOf("focus") ? e.className = e.className.replace(" focus", "") : e.className += " focus"), e = e.parentElement
                }
                document.addEventListener("keydown", function(e) {
                    ("Tab" === e.key || 9 === e.keyCode) && (e.shiftKey ? document.activeElement === a && (o.focus(), e.preventDefault()) : document.activeElement === o && (a.focus(), e.preventDefault()))
                })
            } else {
                $('.quickview-trigger').focus();
                $('.quickview-overlay').removeClass('active');
            }
        });
        $('.quickview-close').on('click',function(e){
            e.preventDefault();
            $('.quickview-trigger').focus();
            $('.quickview-overlay').removeClass('active');
        });

        $('#grid').click(function(e) {
            e.preventDefault();
            $(this).addClass('active');
            $('#list').removeClass('active');
            $('ul.products:not(.owl-carousel)').fadeOut(300, function() {
                $(this).addClass('grid').removeClass('list').fadeIn(300);
            });
            return false;
        });

        $('#list').click(function(e) {
            e.preventDefault();
            $(this).addClass('active');
            $('#grid').removeClass('active');
            $('ul.products:not(.owl-carousel)').fadeOut(300, function() {
                $(this).removeClass('grid').addClass('list').fadeIn(300);
            });
            return false;
        });

       

        // Home Slider
        $('.product-category-carousel').owlCarousel({
            rtl: $("html").attr("dir") == 'rtl' ? true : false,
            items: 1,
            autoplay: true,
            autoplayTimeout: 20000,
            margin: 20,
            loop: true,
            dots: false,
            nav: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            singleItem: true,
            transitionStyle: "fade",
            touchDrag: true,
            mouseDrag: true,
            slideSpeed: 2000,
            responsiveRefreshRate: 200,
            responsive: {
                0: {
                    items: 1
                },
                460: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                },
                1400: {
                    items: 6
                }
            }
        });

        $(".product-category-content h6 a,.vf-products-deal .product-content.entry-summary .ywpc-sale-bar-loop > .ywpc-bar > .ywpc-label").html(function(){
            var text= $(this).text().trim().split(" ");
            var first = text.shift();
            return (text.length > 0 ? "<span class='first'>"+ first + "</span> " : first) + text.join(" ");
        });
    });

}(jQuery));
