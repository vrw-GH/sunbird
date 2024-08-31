jQuery(document).ready(function($){'use strict';

/* ---------------------------------------------------------
    Preloader
------------------------------------------------------------ */ 
    $(window).on('load', function (e) {
        if ($(".pre-loader").length > 0)
        {
            $(".pre-loader").delay(150).fadeOut("slow");
        }
    });

/* ---------------------------------------------------------
    Search
------------------------------------------------------------ */ 
    var $srcicon = $('.search-icon'),
        $srcfield = $('#search'),
        $window     = $(window);
    $srcicon.on('click', function(event){
        event.preventDefault();
        $srcfield.addClass('visible');
        event.stopPropagation();
    });
    $('.search-close').on('click', function(e){
        $srcfield.removeClass('visible');
    });
    $srcfield.on('click', function(event){
        event.stopPropagation();
    });
    $window.on('click', function(e){
        $srcfield.removeClass('visible');
    });


/* ---------------------------------------------------------
    mobile menu icon
------------------------------------------------------------ */       
        function tx_mob_menu_icon() {
            // Mobile Menu Dropdown Icon
            var hasChildren = $('.tx-res-menu li.menu-item-has-children');

            hasChildren.each( function() {
                var $btnToggle = $('<a class="mb-dropdown-icon" href="#"></a>');
                $( this ).append($btnToggle);
                $btnToggle.on( 'click', function(e) {
                    e.preventDefault();
                    $( this ).toggleClass('open');
                    $( this ).parent().children('ul').toggle('slow');
                } );
            } );

            // Hamburger icon click to display close icon
            $(".navbar-toggle").on("click", function(e){
                $(this).find($(".la")).toggleClass('la-navicon la-close');
            });

        }
        tx_mob_menu_icon();

/* ---------------------------------------------------------
    Mobile menu item click to hide menu for one page menu
------------------------------------------------------------ */ 
        $(document).on('click','.navbar-collapse',function(e) {
            if( $(e.target).is('a:not(".mb-dropdown-icon")') ) {
                $(this).collapse('hide');
                $(".navbar-toggle").find($(".la")).toggleClass('la-navicon la-close');
            }
        });

/* ---------------------------------------------------------
   Gallery post format slider
------------------------------------------------------------ */         

    $('.posts-gallery-slider').each(function(i, e) {
      var id = 'posts-gallery-';
      $(e).attr('id', id+i);
      var selector = '#'+id+i;
       $(selector).lightSlider({
        adaptiveHeight:false,
        item:1,
        slideMargin:0,
        //speed:500, // slide speed, you can increase the value to slow down
        //pause:3000, // slide time, you can adjust slide time to increase / decrease value
        loop:true,
        auto:true,
        pager:false,
        pauseOnHover:true,
        onSliderLoad: function() {
            $('.posts-gallery-slider').removeClass('cS-hidden');
            }  

       });
    }); 

    // single post full width gallery
    $('#single-posts-full-width-gallery').lightSlider({
                // gallery:true,
                // galleryMargin:10,
                item:1,
                adaptiveHeight:false,
              //  thumbItem:8,
                slideMargin: 0,
                 speed:800, // slide speed, you can increase the value to slow down
                 pause:3000, // slide time, you can adjust slide time to increase / decrease value
                auto:true,
                loop:true,
                pager:false,
                pauseOnHover:true,
                onSliderLoad: function() {
            $('#single-posts-full-width-gallery').removeClass('cS-hidden');
                    
                }  
            });


/* ---------------------------------------------------------
   Portfolio Template
------------------------------------------------------------ */ 
    var $portfolio = $('.tx-portfolio').imagesLoaded( function() {
      // init Isotope after all images have loaded
      $portfolio.isotope({
        percentPosition: true,
      });
    });

/* ---------------------------------------------------------
   Portfolio filter
------------------------------------------------------------ */ 

    $('.portfolio-filters li').click(function(){
        $(".portfolio-filters li").removeClass("active");
        $(this).addClass("active");
        var selector = $(this).attr('data-filter');
        $(".tx-portfolio").isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false,
            }
        });
        return false;
    });        

/* ---------------------------------------------------------
   Portfolio Enlarge / Pop up
------------------------------------------------------------ */ 
    $('.tx-portfolio-item').magnificPopup({
            type:'inline',
            midClick: true,
            gallery:{
            enabled:true
            },
            delegate: '.tx-port-enlarge',
            removalDelay: 200, //delay removal by X to allow out-animation
            callbacks: {
                beforeOpen: function() {
                   this.st.mainClass = this.st.el.attr('data-effect');
                }
            },
              closeOnContentClick: false,

    });
    
/* ---------------------------------------------------------
   Portfolio Single Page Slider
------------------------------------------------------------ */ 
            $('#portfolio-gallery').lightSlider({
                gallery:true,
                galleryMargin:10,
                item:1,
                thumbItem:8,
                slideMargin: 100,
                speed:800, // slide speed, you can increase the value to slow down
                pause:3000, // slide time, you can adjust slide time to increase / decrease value
                auto:true,
                loop:true,
                pauseOnHover:true,
                onSliderLoad: function() {
            $('#portfolio-gallery').removeClass('cS-hidden');
                    
                }  
            });


            //Portfolio Single Page full width Slider  
            $('#portfolio-gallery-full-width').lightSlider({
                gallery:true,
                galleryMargin:12,
                item:1,
                thumbItem:10,
                slideMargin: 100,
                speed:800, // slide speed, you can increase the value to slow down
                pause:3000, // slide time, you can adjust slide time to increase / decrease value
                auto:true,
                loop:true,
                pauseOnHover:true,
                onSliderLoad: function() {
            $('#portfolio-gallery-full-width').removeClass('cS-hidden');
                    
                }  
            });

/* ---------------------------------------------------------
   LearnPress Course Single Page Slider
------------------------------------------------------------ */ 

            $('#course-gallery').lightSlider({
                gallery:true,
                galleryMargin:10,
                item:1,
                thumbItem:8,
                slideMargin: 100,
                speed:800, // slide speed, you can increase the value to slow down
                pause:3000, // slide time, you can adjust slide time to increase / decrease value
                auto:true,
                loop:true,
                pauseOnHover:true,
                onSliderLoad: function() {
            $('#course-gallery').removeClass('cS-hidden');
                    
                }  
            });
/* ---------------------------------------------------------
   related course
------------------------------------------------------------ */ 
    $('.related-course').owlCarousel({
        loop:false,
        margin:20,
        autoplay:false,
        slideSpeed: 200,
        paginationSpeed: 300,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        lazyLoad:true,
        nav: true,
        navText: ['<i class="la la-angle-left"></i>','<i class="la la-angle-right"></i>'], 
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            768:{
                items:2
            },
            1000:{
                items:3
            },
             1400:{
                items:4
            }
        }
    });

/* ---------------------------------------------------------
   Related Posts
------------------------------------------------------------ */ 
    $('.related-posts-loop').owlCarousel({
        loop:false,
        margin:20,
        autoplay:true,
        slideSpeed: 200,
        paginationSpeed: 300,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        lazyLoad:true,
        nav: true,
        navText: ['<i class="la la-angle-left"></i>','<i class="la la-angle-right"></i>'], 
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            768:{
                items:2
            },
            1000:{
                items:4
            },
             1400:{
                items:4
            }
        }
    });


/* ---------------------------------------------------------
   news-ticker
------------------------------------------------------------ */ 
    $('.news-ticker').owlCarousel({
        loop:true,
        autoplay:true,
        slideSpeed: 5000,
        paginationSpeed: 5000,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        nav: true,
        singleItem: true,
        items: 1,
        navText: ['<i class="la la-angle-left"></i>','<i class="la la-angle-right"></i>'], 
        
    });


/* ---------------------------------------------------------
    Portfolio Experience
------------------------------------------------------------ */ 
    var $project = $('.project-carousel')
    if ($project.length) {
        $project.owlCarousel({
            loop:true,
            margin:20,
            rtl:false,
            nav:true,
            smartSpeed: 500,
            autoplay: 3000,
            navText: [ '<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>' ],
            responsive:{
                0:{
                    items:2
                },
                600:{
                    items:3
                },
                1024:{
                    items:4
                },
                1200:{
                    items:4
                }
            }
        });         
    }
/* ---------------------------------------------------------
    Single post full width image template
------------------------------------------------------------ */ 
    $(window).load(function() {
      $('.flexslider').flexslider({
        easing: "linear",
        animation: "fade", 
        slideshowSpeed: 3000,
        animationSpeed: 600,
        animationLoop: true, 
        smoothHeight: false,  
        useCSS: false,
        controlNav: false,
        directionNav: true,
        prevText: "",
        nextText: "", 
      });
    });
/* ---------------------------------------------------------
    Back to top / Scroll up
------------------------------------------------------------ */ 
        function tx_back_top() {
            $('#back_top').on('click', function() {
                $('html,body').animate({
                    scrollTop: 0
                }, 400);
                return false;
            });

            if ($(window).scrollTop() > 300) {
                $('#back_top').addClass('back_top');
            } else {
                $('#back_top').removeClass('back_top');
            }

            $(window).on('scroll', function() {

                if ($(window).scrollTop() > 300) {
                    $('#back_top').addClass('back_top');
                } else {
                    $('#back_top').removeClass('back_top');
                }
            });
        }
        tx_back_top();



}); // End of jquery    

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */
