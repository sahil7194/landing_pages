(function ($) {
	"use strict";

    jQuery(document).ready(function($){
        
        // Homepage Slider
        $(".homepage-slides").owlCarousel({
            items: 1,
            nav: true,
            dots: false,
            autoplay: true,
            animateOut: 'fadeOut',
            loop: true,
            navText: ["<i class='fa fa-arrow-left fa-2x'></i>", "<i class='fa fa-arrow-right fa-2x'></i>"],
            mouseDrag: false,
            touchDrag: false,
        });
        
        $(".homepage-slides").on("translate.owl.carousel", function(){
            $(".single-slide-item h2").removeClass("animated fadeInLeft").css("opacity", "0");
            $(".single-slide-item p").removeClass("animated fadeInRight").css("opacity", "0");
            $(".single-slide-item .slide-btn").removeClass("animated fadeInUp").css("opacity", "0");
        });
        
        $(".homepage-slides").on("translated.owl.carousel", function(){
            $(".single-slide-item h2").addClass("animated fadeInLeft").css("opacity", "1");
            $(".single-slide-item p").addClass("animated fadeInRight").css("opacity", "1");
            $(".single-slide-item .slide-btn").addClass("animated fadeInUp").css("opacity", "1");
        });
        
        // Testimonial Slider
        $(".testimonial-slides").owlCarousel({
            items: 1,
            nav: true,
            dots: false,
            autoplay: true,
            animateOut: 'fadeOut',
            loop: true,
            navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
            mouseDrag: false,
            touchDrag: false,
        });
        
        $(".testimonial-slides").on("translate.owl.carousel", function(){
            $(".testimonial-slider-wrapper img").removeClass("animated fadeInUp").css("opacity", "0");
            $(".testimonial-slider-wrapper h3").removeClass("animated fadeInLeft").css("opacity", "0");
            $(".testimonial-slider-wrapper h4").removeClass("animated fadeInRight").css("opacity", "0");
            $(".testimonial-slider-wrapper ul").removeClass("animated fadeInDown").css("opacity", "0");
        });
        
        $(".testimonial-slides").on("translated.owl.carousel", function(){
            $(".testimonial-slider-wrapper img").addClass("animated fadeInUp").css("opacity", "1");
            $(".testimonial-slider-wrapper h3").addClass("animated fadeInLeft").css("opacity", "1");
            $(".testimonial-slider-wrapper h4").addClass("animated fadeInRight").css("opacity", "1");
            $(".testimonial-slider-wrapper ul").addClass("animated fadeInDown").css("opacity", "1");
        });
        
        // Popup Gallery
        $(".gallery-lightbox").magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
        
        // Responsive Menu
        $("ul#navigation").slicknav({
            prependTo: ".responsive-menu-wrap"
        });
        
        // Section Animations
        new WOW().init();
        
        // Smooth Scroll
        var scroll = new SmoothScroll('a[href*="#"]');

    });


    jQuery(window).load(function(){
        jQuery(".dentalofic-slider-preloader-wrap, .dentalofic-site-preloader-wrap").fadeOut(500);
    });


}(jQuery));	