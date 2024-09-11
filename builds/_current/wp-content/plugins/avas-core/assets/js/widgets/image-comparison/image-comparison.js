!(function($){
	'use strict';

	/* Image Comparison widget
	------------------------------------- */
	var widgetImageComparison = function( $scope, $ ) {
	var IC = $scope.find('.tx-ic-wrap');
    var image_comparison      = $scope.find('.tx-ic-content');

    	if ( !image_comparison.length ) {
            return;
        }

        var settings        = image_comparison.data('settings');
        
        var 
        starting_point   	 = settings.starting_point,
        orientation          = settings.orientation,
        before_label         = settings.before_label,
        after_label          = settings.after_label,
        show_labels          = settings.show_labels,
        on_hover             = settings.on_hover,
        add_circle_blur      = settings.add_circle_blur,
        add_circle_shadow    = settings.add_circle_shadow,
        add_circle           = settings.add_circle,
        smoothing            = settings.smoothing,
        smoothing_amount     = settings.smoothing_amount,
        control_line         = settings.control_line,
        move_slider_on_hover = settings.move_slider_on_hover;
      
        var viewers = document.querySelectorAll('#' + settings.id);
  
        var options = {

            controlColor : control_line,
            controlShadow: add_circle_shadow,
            addCircle    : add_circle,
            addCircleBlur: add_circle_blur,        
            showLabels   : show_labels,
            labelOptions : {
              before       : before_label,
              after        : after_label,
              onHover      : on_hover
            },
            smoothing      : smoothing,
            smoothingAmount: smoothing_amount,
            hoverStart     : move_slider_on_hover,
            verticalMode   : orientation,
            startingPoint  : starting_point,
            fluidMode      : false
          };

          viewers.forEach(function (element){
            var view = new ImageCompare(element, options).mount();
          });
				
	};

	$( window ).on( 'elementor/frontend/init', function() {

		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-image-comparison.default', widgetImageComparison ); // Image Comparison
 		
 	} );


})( jQuery );


/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */