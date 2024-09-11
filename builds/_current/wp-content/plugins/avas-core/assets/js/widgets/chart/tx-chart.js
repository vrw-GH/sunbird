/* Chart Widget
------------------------------------- */
!(function($){
	'use strict';
	
	var widgetChart = function( $scope, $ ) {	
	var txChart = $scope.find( '.tx-chart-wrapper' ).eq(0);
	
		if ( !txChart.length ) {
            return;
        }

		var	txChartType        = txChart.data( 'type' ),
			txChartLabels      = txChart.data( 'labels' ),
			txChartsettings    = txChart.data('settings'),
			
			txChart            = $scope.find( '.tx-chart-widget' ).eq( 0 ),
			txChartId          = txChart.attr( 'id' ),
			ctx                  = document.getElementById( txChartId ).getContext( '2d' ),
			myChart              = new Chart( ctx, txChartsettings );	
	};


	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-chart.default', widgetChart ); // Chart
 	} );


})( jQuery );


/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */


