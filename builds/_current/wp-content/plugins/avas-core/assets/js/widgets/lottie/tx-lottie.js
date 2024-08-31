(function($){
	'use strict';

	var TxElementsTools = {

		getElementPercentageSeen: function( $element, offset ) {
			var offsetSettings      = offset || {},
				startOffset         = offsetSettings.start || 0,
				endOffset           = offsetSettings.end || 0,
				viewportHeight      = $( window ).height(),
				viewportStartOffset = viewportHeight * startOffset / 100,
				viewportEndOffset   = viewportHeight * endOffset / 100,
				scrollTop           = $( window ).scrollTop(),
				elementOffsetTop    = $element.offset().top,
				elementHeight       = $element.height(),
				percentage;

			percentage = (scrollTop + viewportHeight + viewportStartOffset - elementOffsetTop) / (viewportHeight + viewportStartOffset + viewportEndOffset + elementHeight);
			percentage = Math.min( 100, Math.max( 0, percentage * 100 ) );

			return parseFloat( percentage.toFixed( 2 ) );
		},

	};

    /* Lottie Widget
	------------------------------------- */
	var widgetLottie = function ( $scope ) {
			var $lottie     = $scope.find( '.tx-lottie-wrap' ),
				$lottieElem = $lottie.find( '.tx-lottie-elem' ),
				settings    = $lottie.data( 'settings' ),
				options,
				instance;

			if ( ! $lottie[0] ) {
				return;
			}

			options = {
				container: $lottieElem[0],
				renderer:  settings.renderer,
				loop:      settings.loop,
				autoplay:  false,
				path:      settings.path,
				name:      'avas-lottie'
			};

			instance = lottie.loadAnimation( options );

			if ( settings.play_speed ) {
				instance.setSpeed( settings.play_speed );
			}

			if ( settings.reversed ) {
				instance.setDirection( -1 );
			}

			var start = 0,
				end = 0;
			if ( settings.viewport ) {
				start = -settings.viewport.start || 0;
				end = -(100 - settings.viewport.end) || 0;
			}

			switch( settings.action_start ) {
				case 'on_hover':
					var startFlag = false,
						onHoverHandler = function() {
							if ( startFlag && 'reverse' === settings.on_hover_out ) {
								var reverseValue = settings.reversed ? -1 : 1;
								instance.setDirection( reverseValue );
							}
							instance.play();
							startFlag = true;
						},
						onHoverOutHandler = function() {
							switch ( settings.on_hover_out ) {
								case 'pause':
									instance.pause();
									break;

								case 'stop':
									instance.stop();
									break;

								case 'reverse':
									var reverseValue = settings.reversed ? 1 : -1;
									instance.setDirection( reverseValue );
									instance.play();
							}
						};

					$lottie
						.off( 'mouseenter', onHoverHandler )
						.on( 'mouseenter', onHoverHandler );
					$lottie
						.off( 'mouseleave', onHoverOutHandler )
						.on( 'mouseleave', onHoverOutHandler );
						
					break;
				case 'on_click':

					var $link = $lottie.find( '.tx-lottie-link' ),
						redirectTimeout = +settings.redirect_timeout,
						onClickHandler = function() {
							instance.play();
						},
						onLinkClickHandler = function( event ) {
							event.preventDefault();
							instance.play();
							var url = $( this ).attr( 'href' ),
								target = '_blank' === $( this ).attr( 'target' ) ? '_blank' : '_self';
							setTimeout( function() {
								window.open( url, target );
							}, redirectTimeout );
						};

					if ( $link[0] && redirectTimeout > 0 ) {

						$link
							.off( 'click', onLinkClickHandler )
							.on( 'click', onLinkClickHandler );

					} else {
						$lottie
							.off( 'click', onClickHandler )
							.on( 'click', onClickHandler );
					}

					break;

				case 'on_viewport':

					if ( undefined !== window.IntersectionObserver ) {
						var observer = new IntersectionObserver(
							function( entries, observer ) {
								if ( entries[0].isIntersecting ) {
									instance.play();
								} else {
									instance.pause();
								}
							},
							{
								rootMargin: end +'% 0% ' + start + '%'
							}
						);
						observer.observe( $lottie[0] );
					} else {
						instance.play();
					}

					break;

				case 'on_scroll':

					if ( undefined !== window.IntersectionObserver ) {
						var scrollY = 0,
							requestId,
							scrollObserver = new IntersectionObserver(
								function( entries, observer ) {
									if ( entries[0].isIntersecting ) {
										requestId = requestAnimationFrame( function scrollAnimation() {
											if ( window.scrollY !== scrollY ) {
												var viewportPercentage = TxElementsTools.getElementPercentageSeen( $lottieElem, { start: start, end: end } ),
													nextFrame = (instance.totalFrames - instance.firstFrame) * viewportPercentage / 100;

												instance.goToAndStop( nextFrame, true );
												scrollY = window.scrollY;
											}
											requestId = requestAnimationFrame( scrollAnimation );
										} );
									} else {
										cancelAnimationFrame(requestId);
									}
								},
								{
									rootMargin: end +'% 0% ' + start + '%'
								}
							);

						scrollObserver.observe( $lottie[0] );
					}

					break;

				default:
					var delay = +settings.delay;
					if ( delay > 0 ) {

						setTimeout( function() {
							instance.play();
						}, delay );
					} else {
						instance.play();
					}
			}

		};

	$( window ).on( 'elementor/frontend/init', function() {
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-lottie.default', widgetLottie ); // Lottie
 	} );


})( jQuery );


/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */