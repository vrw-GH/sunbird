/* Background Slider section
------------------------------------- */

!(function($){
	'use strict';

	
	var widgetBGSlider = function ($scope, $) {
        var	bgSlider = $scope.children('.tx-bg-slider-wrap').children('.tx-bg-slider'),
            slides = [],
            slides_json = [];

        if (bgSlider && bgSlider.data('tx-bg-slider')) {

            var slider_images = bgSlider.data('tx-bg-slider'),
                transition = bgSlider.data('tx-bg-slider-transition'),
                firstTransition = bgSlider.data('tx-bg-slider-first-transition'),
                animation = bgSlider.data('tx-bg-slider-animation'),
                delay = bgSlider.data('tx-bg-slider-delay'),
                timer = bgSlider.data('tx-bg-slider-timer');

            if (typeof slider_images != 'undefined') {
                slides = slider_images.split(",");

                jQuery.each(slides, function (key, value) {
                    var slide = [];
                    slide.src = value;
                    slides_json.push(slide);
                });

                bgSlider.vegas({
                	slides: slides_json,
                    transition: transition,
                    firstTransition: transition,
                    animation: animation,
                    delay: delay,
                    timer: timer,
                });

            }
        }
    };

	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/section', widgetBGSlider ); // Background Slider
 		
 	} );


})( jQuery );


/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */