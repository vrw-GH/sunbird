!(function($){
	'use strict';

	/* Countdown Widget
	------------------------------------- */
	var widgetCountdown = function( $scope, $ ) {
	var countdown = $scope.find('.tx-countdown-wrapper');
				
		if ( countdown.length > 0 ) {
			
			var	countdownItem = countdown.find( '.tx-countdown-content' ),
				countdownID = $(countdownItem).attr('id');

			$('#'+countdownID).countdown();

		} 

	};

	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-countdown.default', widgetCountdown ); // Countdown
 		
 	} );


})( jQuery );


/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */