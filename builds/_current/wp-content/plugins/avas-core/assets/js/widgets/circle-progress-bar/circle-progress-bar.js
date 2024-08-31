/* Circle Progress Bar widget
------------------------------------- */
!(function($){
	'use strict';
	
	var widgetCircleProgressBar = function( $scope, $ ) {
	var cpb = $scope.find('.tx-circle-progress-bar');

		if ( cpb.length > 0 ) {

			var settings = cpb.data("settings");

			cpb.asPieProgress({
		        namespace: 'pie_progress'
		    }); 

			cpb.asPieProgress('start');

		}

	};


	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-circle-progress-bar.default', widgetCircleProgressBar ); // Circle Progress Bar
 		
 	} );


})( jQuery );


/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */