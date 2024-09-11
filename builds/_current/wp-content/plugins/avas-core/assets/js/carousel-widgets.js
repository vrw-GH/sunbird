(function($){
	'use strict';

	/* Carousel Widget
	------------------------------------- */
	var widgetCarousel = function( $scope, $ ) {
	var txCarousel = $scope.find('.tx-carousel').eq(0);

		if ( txCarousel.length > 0 ) {

			var settings = txCarousel.data("settings"),
				display_mobile = settings["display_mobile"],
				display_tablet = settings["display_tablet"],
				display_laptop = settings["display_laptop"],
				display_desktop = settings["display_desktop"],
				gutter = settings["gutter"],
				autoplay = settings["autoplay"],
				pause_on_hover = settings["pause_on_hover"],
				navigation = settings["navigation"],
				dots = settings["dots"],
				loop = settings["loop"],
				autoplay_timeout = settings["autoplay_timeout"],
				smart_speed = settings["smart_speed"];

			txCarousel.owlCarousel({
		        loop: loop,
		        margin: gutter,
		        autoplay: autoplay,
		        smartSpeed: smart_speed,
		        autoplayTimeout: autoplay_timeout,
		        autoplayHoverPause: pause_on_hover,
		        lazyLoad: true,
		        nav: navigation,
		        dots: dots,
		        navText: ['<i class="bi bi-arrow-left"></i>','<i class="bi bi-arrow-right"></i>'],
		        responsive:{
		            0:{
		                items: display_mobile
		            },
		            600:{
		                items: display_tablet
		            },
		            1000:{
		                items: display_laptop
		            },
		             1400:{
		                items: display_desktop
		            }
		        }

		    });

		}

	};


	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-courses-carousel.default', widgetCarousel ); // LearnPress Courses Carousel
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-news-ticker.default', widgetCarousel ); // News Ticker
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-post-carousel.default', widgetCarousel ); // Post Carousel
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-portfolio-carousel.default', widgetCarousel ); // Portfolio Carousel
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-profile-carousel.default', widgetCarousel ); // Profile Carousel
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-services-carousel.default', widgetCarousel ); // Services Carousel
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-team-carousel.default', widgetCarousel ); // Team Carousel
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-testimonial.default', widgetCarousel ); // Testimonial Carousel
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-woocommerce-carousel.default', widgetCarousel ); // WooCommerce product Carousel
 		
 	} );


})( jQuery );


/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */