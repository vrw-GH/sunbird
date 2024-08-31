(function ($, elementor) {
    'use strict';
    // Carousel Handler
    var WidgetHtmegaCarouselHandler = function ($scope, $) {

        var carousel_elem = $scope.find( '.htmega-carousel-activation' ).eq(0);
        if( carousel_elem.length > 0){ carousel_elem[0].style.display='block'; }
        if ( carousel_elem.length > 0 ) {

            var settings = carousel_elem.data('settings');
            var arrows = settings['arrows'];
            var arrow_prev_txt = settings['arrow_prev_txt'];
            var arrow_next_txt = settings['arrow_next_txt'];
            var dots = settings['dots'];
            var autoplay = settings['autoplay'];
            var autoplay_speed = parseInt(settings['autoplay_speed']) || 3000;
            var animation_speed = parseInt(settings['animation_speed']) || 300;
            var pause_on_hover = settings['pause_on_hover'];
            var center_mode = settings['center_mode'];
            var slloop = settings['slloop'];
            var center_padding = settings['center_padding'] ? parseInt( settings['center_padding'] ): 0;
            var variable_width = settings['variable_width'] ? true : false;
            var display_columns = parseInt(settings['display_columns']) || 1;
            var scroll_columns = parseInt(settings['scroll_columns']) || 1;
            var tablet_width = parseInt(settings['tablet_width']) || 800;
            var tablet_display_columns = parseInt(settings['tablet_display_columns']) || 1;
            var tablet_scroll_columns = parseInt(settings['tablet_scroll_columns']) || 1;
            var mobile_width = parseInt(settings['mobile_width']) || 480;
            var mobile_display_columns = parseInt(settings['mobile_display_columns']) || 1;
            var mobile_scroll_columns = parseInt(settings['mobile_scroll_columns']) || 1;
            var carousel_style_ck = parseInt( settings['carousel_style_ck'] ) || 1;

            if( carousel_style_ck == 4 ){
                carousel_elem.slick({
                    arrows: arrows,
                   prevArrow: '<button class="htmega-carosul-prev">'+arrow_prev_txt+'</button>',
                    nextArrow: '<button class="htmega-carosul-next">'+arrow_next_txt+'</button>',
                    dots: dots,
                    customPaging: function( slick,index ) {
                        var data_title = slick.$slides.eq(index).find('.htmega-data-title').data('title');
                        var data_thumbnail = slick.$slides.eq(index).find('.htmega-data-title').data('thumbnail');
                        
                        if(data_thumbnail ){
                            return '<img src="'+data_thumbnail+'" alt="'+data_title+'">';
                        } else {
                            return '<h6>'+data_title+'</h6>';
                        }
                    },
                    infinite: true,
                    autoplay: autoplay,
                    autoplaySpeed: autoplay_speed,
                    speed: animation_speed,
                    fade: false,
                    pauseOnHover: pause_on_hover,
                    slidesToShow: display_columns,
                    slidesToScroll: scroll_columns,
                    centerMode: center_mode,
                    centerPadding: center_padding+'px',
                    rtl: elementorFrontendConfig.is_rtl,
                    responsive: [
                        {
                            breakpoint: tablet_width,
                            settings: {
                                slidesToShow: tablet_display_columns,
                                slidesToScroll: tablet_scroll_columns
                            }
                        },
                        {
                            breakpoint: mobile_width,
                            settings: {
                                slidesToShow: mobile_display_columns,
                                slidesToScroll: mobile_scroll_columns
                            }
                        }
                    ]
                });
            }else{
                carousel_elem.slick({
                    arrows: arrows,
                    prevArrow: '<button class="htmega-carosul-prev">'+arrow_prev_txt+'</button>',
                    nextArrow: '<button class="htmega-carosul-next">'+arrow_next_txt+'</button>',
                    dots: dots,
                    infinite: true,
                    autoplay: autoplay,
                    autoplaySpeed: autoplay_speed,
                    speed: animation_speed,
                    infinite:slloop,
                    fade: false,
                    pauseOnHover: pause_on_hover,
                    slidesToShow: display_columns,
                    slidesToScroll: scroll_columns,
                    centerMode: center_mode,
                    centerPadding: center_padding+'px',
                    variableWidth: variable_width,
                    rtl: elementorFrontendConfig.is_rtl,
                    responsive: [
                        {
                            breakpoint: tablet_width,
                            settings: {
                                slidesToShow: tablet_display_columns,
                                slidesToScroll: tablet_scroll_columns
                            }
                        },
                        {
                            breakpoint: mobile_width,
                            settings: {
                                slidesToShow: mobile_display_columns,
                                slidesToScroll: mobile_scroll_columns
                            }
                        }
                    ]
                    
                });
            }

        }
    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/avas-panel-slider.default', WidgetHtmegaCarouselHandler);
    });
}(jQuery, window.elementorFrontend));