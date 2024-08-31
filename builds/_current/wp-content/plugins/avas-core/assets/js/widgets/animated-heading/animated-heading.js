/* Animated Heading widget
------------------------------------- */
!(function($){
	'use strict';
	var widgetAnimatedHeading = function( $scope, $ ) {
	var animatedHeading = $scope.find('.tx-animated-heading-wrap');
				
		if ( animatedHeading.length > 0 ) {
			
			var settings = animatedHeading.data('settings'),
				animatedText = animatedHeading.find( '.tx-animated-txt' ),
				animatedID = $(animatedText).attr('id');

			if(settings.styles === 'typed') {

				var	typed = new Typed('#'+animatedID, settings);

			} else if (settings.styles === 'animated') {
				
				$(animatedText).Morphext(settings);
			}

		} 

	};


	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-animated-heading.default', widgetAnimatedHeading ); // Animated Heading
 	} );

})( jQuery );

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */