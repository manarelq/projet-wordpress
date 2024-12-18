jQuery(document).ready(function($) {

	var rtl;	
	if( fashion_lifestyle_data.rtl == '1' ){
        rtl = true;
    }else{
        rtl = false;
    }

    $('#banner-slider-two').owlCarousel({
        loop       : true,
        nav        : true,
        items      : 1,
        dots       : true,
        autoplay   : true,
        animateOut : '',
        navText    : '',
        center     : true,
        rtl        : rtl,
        lazyLoad   : true,
        responsive : {
            1200: {
                margin: 80,
                stagePadding: 234,
            },
            1025: {
                margin: 50,
                stagePadding: 150,
            },
            768: {
                margin: 20,
                stagePadding: 50
            }
        }
    });
     $("#btn-search").on( 'click', function() {
        $(".site-header .form-holder").show("fast");
    }); 

    $('.btn-close-form').on( 'click', function(){
        $('.header-two .header-t .form-holder').hide("fast");
    });

    $(window).on( 'keyup', function (event) {
        if (event.key == 'Escape') {
            $('.header-two .header-t .form-holder').hide("fast");
        }
    });
});