(function($){
	'use strict';

	/* Menu Widget
	------------------------------------- */
	var widgetMenu = function ($scope, $) {
		$('.navbar-toggle').on('click',function(){
			$(this).find($(".bi")).toggleClass('bi-list bi-x');
		});
	};


	$( window ).on( 'elementor/frontend/init', function() {
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-menu.default', widgetMenu ); // Menu
 		
 	} );


})( jQuery );


/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */