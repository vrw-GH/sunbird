!(function($){
	'use strict';

	/* Hotspot Widget
	------------------------------------- */
	var widgetHotspot = function( $scope, $ ) {
	var txHotspot = $scope.find('.tx-hs-item').eq(0);

		if ( !txHotspot.length ) {
            return;
        }
				var pop = $('.tx-hs-popup');
			      pop.on('click', function(e) {
			        e.stopPropagation();
			    });
			      
			    $('.tx-hs-marker').on('click', function(e) {
			        e.preventDefault();
			        e.stopPropagation();
			        $(this).next('.tx-hs-popup').toggleClass('open');
			        $(this).parent().siblings().children('.tx-hs-popup').removeClass('open');
			    });
			      
			    $(document).on('click', function() {
			        pop.removeClass('open');
			    });
			      
			    pop.each(function() {
			        var w = $(window).outerWidth(),
			            edge = Math.round( ($(this).offset().left) + ($(this).outerWidth()) );
			        if( w < edge ) {
			          $(this).addClass('edge');
			        }
			    });
  	};

	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-hotspot.default', widgetHotspot ); // hotspot
 		
 	} );


})( jQuery );


/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */