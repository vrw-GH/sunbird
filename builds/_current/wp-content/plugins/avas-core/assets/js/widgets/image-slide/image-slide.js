!(function($){
	'use strict';

	/* Image Slide widget
	------------------------------------- */
	var widgetImageSlide = function( $scope, $ ) {
    var image_slide      = $scope.find('.tx-image-slide-wrap').eq(0);

    	if ( image_slide.length > 0 ) {

	        var settings        = image_slide.data('settings'),
		        speed        	= settings.speed,
		        direction 		= settings.direction,
		        pauseonhover 	= settings.pauseonhover,
		        clone 			= settings.clone;
		       
	        image_slide.infiniteslide({
			    speed: speed,
	            direction: direction,
	            'pauseonhover': pauseonhover,
	            'clone': clone,
	         	//'responsive': false
			});
    	}

	};


	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-image-slide.default', widgetImageSlide ); // Image Slide
 		
 	} );


})( jQuery );


/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */