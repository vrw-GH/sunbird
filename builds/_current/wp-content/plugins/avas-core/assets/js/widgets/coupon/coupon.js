!(function($){
	'use strict';

	var getElementSettings = function( $element ) {
		var elementSettings = {},
			modelCID 		= $element.data( 'model-cid' );

		if ( isEditMode && modelCID ) {
			var settings 		= elementorFrontend.config.elements.data[ modelCID ],
				settingsKeys 	= elementorFrontend.config.elements.keys[ settings.attributes.widgetType || settings.attributes.elType ];

			jQuery.each( settings.getActiveControls(), function( controlKey ) {
				if ( -1 !== settingsKeys.indexOf( controlKey ) ) {
					elementSettings[ controlKey ] = settings.attributes[ controlKey ];
				}
			} );
		} else {
			elementSettings = $element.data('settings') || {};
		}

		return elementSettings;
	};

	var isEditMode	= true;

	/* Coupon Widget
	------------------------------------- */
	var widgetCoupon = function ($scope) {
		var elementSettings	= getElementSettings( $scope );

		$scope.find('.tx-coupon-image').each(function () {
            var couponCode = $(this).find('.tx-coupon-code').attr('data-coupon-code');

			$(this).find('.tx-coupon-code').not('.tx-copied').on('click', function(){
				var clicked = $(this);
				var tempInput = '<input type="text" value="' + couponCode + '" id="txCouponIn">';

				clicked.append(tempInput);

				var copyText = document.getElementById('txCouponIn');
				copyText.select();
				document.execCommand('copy');
				$('#txCouponIn').remove();

				setTimeout(function () {
					clicked.addClass('tx-copied');
					clicked.find('.tx-coupon-copy-text').fadeOut().text(txCopied).fadeIn();
				}, 500);
			});
		});

		if ( 'carousel' === elementSettings.layout ) {
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
		}

    };

	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-coupon.default', widgetCoupon ); // Coupon
 		
 	} );


})( jQuery );


/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */