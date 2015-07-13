/*-----------------------------------------------------------------------------------*/
/*  jquery.custom.js
/*  This file contains all the required custom code for the theme to function properly.
/*  Can be easily tweaked by the end user to adjust things to their liking.
/*-----------------------------------------------------------------------------------*/ 


/*-----------------------------------------------------------------------------------*/
/*  Global Variables
/*-----------------------------------------------------------------------------------*/ 
if ( !icyGlobal ) {
    var icyGlobal = {}; // Global storage
}

if ( !icyGlobal.isMobile ) {
    icyGlobal.isMobile  = (/(Android|BlackBerry|iPhone|iPod|iPad|Palm|Symbian)/.test(navigator.userAgent));
    if (icyGlobal.isMobile) {
        jQuery('body').addClass('is-mobile');
    }
}

/*-----------------------------------------------------------------------------------*/
/*  Mobile Menu Function Triggers
/*-----------------------------------------------------------------------------------*/ 
function icy_menu_trigger() {
    jQuery('.icy-menu-trigger').click(function(e) {        
        jQuery('#icy-nav').stop().slideToggle(500);        
        e.preventDefault();
    });
}

function icy_mobilenav() {          
    icy_menu_trigger();         
}

/*-----------------------------------------------------------------------------------*/
/*  Document Ready Code
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function($) {

    "use strict";

    jQuery('html').addClass('js-ready');
    /*-----------------------------------------------------------------------------------*/
    /*  Navigation
    /*-----------------------------------------------------------------------------------*/ 
    jQuery("nav#primary-nav ul").supersubs({
            minWidth:    15,            
            maxWidth:    35,   // maximum width of sub-menus in em units
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over
                               // due to slight rounding differences and font-family
            }).superfish({
                delay: 700,
                animation:     {height:'show'},   // an object equivalent to first parameter of jQueryâ€™s .animate() method. Used to animate the sub-menu open
                animationOut:  {height:'hide'},   // an object equivalent to first parameter of jQueryâ€™s .animate() method Used to animate the sub-menu closed
                speed:         'normal',           // speed of the opening animation. Equivalent to second parameter of jQueryâ€™s .animate() method
                speedOut:      'fast', 
                autoArrows: false
    });

    jQuery('#icy-nav ul').superfish({
                delay: 700,
                animation:     {height:'show'},   // an object equivalent to first parameter of jQueryâ€™s .animate() method. Used to animate the sub-menu open
                animationOut:  {height:'hide'},   // an object equivalent to first parameter of jQueryâ€™s .animate() method Used to animate the sub-menu closed
                speed:         'normal',           // speed of the opening animation. Equivalent to second parameter of jQueryâ€™s .animate() method
                speedOut:      'fast', 
                autoArrows: false
    });

    /*-----------------------------------------------------------------------------------*/
    /*  Donation Button & Hover effects
    /*-----------------------------------------------------------------------------------*/         
    jQuery('.icy-button.donate').hover(function(){
        jQuery('.icy-button.donate').addClass('btn-activated');    
    },function(){
        jQuery('.icy-button.donate').removeClass('btn-activated'); 
    }); 

    /*-----------------------------------------------------------------------------------*/
    /*  Hover class for thumbnails
    /*-----------------------------------------------------------------------------------*/ 
    jQuery('.small-thumbnail').hover(function(){
        jQuery(this).addClass('hovered');    
    },function(){
        jQuery(this).removeClass('hovered'); 
    }); 

    /*-----------------------------------------------------------------------------------*/
    /*  Sharing icons in posts
    /*-----------------------------------------------------------------------------------*/ 
    jQuery('.icon-sharing, .share-icons').hover(function(){
        var icons = jQuery(this).parent().find('.share-icons');
        if ( icons.hasClass('inview') ) {
            icons.removeClass('inview');
        } else {
            icons.addClass('inview');
        }
    }); 

    /*-----------------------------------------------------------------------------------*/
    /*  Placeholder for email of Mailchimp
    /*-----------------------------------------------------------------------------------*/ 
    // if(!jQuery('.mc_var_label').val()) { 
    //     jQuery('#mc_mv_EMAIL').attr("placeholder", jQuery('#mc_mv_EMAIL').val());
    // }  

    jQuery('.mc_merge_var').each( function() {
        var string = jQuery(this).find('label').text();
        jQuery(this).find('input').attr('placeholder', string);        
    });   

    /*-----------------------------------------------------------------------------------*/
    /*  Search button reveal
    /*-----------------------------------------------------------------------------------*/ 
    jQuery('.search-button').click(function(event){

        if (!jQuery(this).hasClass('active')) {
            jQuery(this).addClass('active');

            jQuery('.search-wrapper').animate({
                'top': '0px'
            }, 300, 'easeInOutQuad');
        } else {
            jQuery(this).removeClass('active');
            jQuery('.search-wrapper').animate({
                'top': '-90px'
            }, 300, 'easeInOutQuad');
        }
        event.preventDefault();
        event.stopPropagation();
    });

    /*-----------------------------------------------------------------------------------*/
    /*  Navigation text ghosting
    /*-----------------------------------------------------------------------------------*/ 
    jQuery('nav#primary-nav ul li a, .small-thumbnail .article-title .article-link .entry-title').each( function() {
        var string = jQuery(this).text();
        jQuery(this).attr('data-hover', string);
    });   

    /*-----------------------------------------------------------------------------------*/
    /*  Scrolling Text Magic
    /*-----------------------------------------------------------------------------------*/ 
    var restore = '';

    jQuery('.carousel-grid .entry-title').stop(true,true).hover(function(){
        
        var title = jQuery(this);
        var titleWidth = title[0].scrollWidth,
            parentWidth = title.parent().width();
        
        if(titleWidth > parentWidth) {                 
            var space = (titleWidth - parentWidth),
            speed = (space * 40);
        
            title.stop(true,true).delay(300).animate({textIndent:"-"+space+"px"},speed,function(){                    
               
            });
        }

    },function(){  
        jQuery(this).stop(true,true).css({textIndent:"0"});
        clearTimeout(restore);
    }); 


    /*-----------------------------------------------------------------------------------*/
    /*  Events Single Page
    /*---------------------------------------------------------------------------------- 
    if (jQuery('body').hasClass('events-single'))
    {
        jQuery('.tribe-events-venue-map').insertAfter('.single-tribe_events h2.tribe-events-single-event-title');           

    } */

    /*-----------------------------------------------------------------------------------*/
    /*  FitVids
    /*---------------------------------------------------------------------------------- */

    jQuery('.icy_video,.fitVids').fitVids();

    /*-----------------------------------------------------------------------------------*/
    /*  Language Switcher
    /*---------------------------------------------------------------------------------- */

    if (jQuery('.icy-language-switcher').length) {
        jQuery('.icy-button.language').click(function(event) {
            jQuery('.icy-language-switcher ul li').slideToggle();
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*  View.js
    /*---------------------------------------------------------------------------------- */

    if (jQuery('.gallery-images').length) {
        new View( jQuery('.gallery-images a[href], .gallery-item a[href]') );        
    }   

    /*-----------------------------------------------------------------------------------*/
    /*  Mobile Menu Start
    /*---------------------------------------------------------------------------------- */

    icy_mobilenav();
    
    /*-----------------------------------------------------------------------------------*/
    /*  Positioning for Tablets and mobile
    /*---------------------------------------------------------------------------------- */
    var body = jQuery('body'),
        windowWidth = jQuery(window).width();

    /* Option Specific layouting */

    if (body.hasClass('not-fixed-hello')) { 
        jQuery('.hello-bar').css({
            'position': 'relative',
            'top': 0
        });
    }

    /* Mobile Specific JS */
    if (body.hasClass('logged-in')) {
        if (!body.hasClass('is-mobile') && body.hasClass('fixed-header') && (windowWidth >= 768)) {
            var fromTop = '';
            if (body.hasClass('fixed-hello')) { fromTop = 68; } else { fromTop = 28; }

            jQuery("#top").sticky({ topSpacing: fromTop, className: 'is-sticky',
                wrapperClassName: 'icy-sticky-wrapper' });                  
        } 

        if (body.hasClass('is-mobile') && (windowWidth < 1200)) {
            jQuery('.hello-bar').css({
                'position': 'relative',
                'top': 0
            });
        } 

    } else if (!body.hasClass('logged-in')) {
        if (!body.hasClass('is-mobile') && body.hasClass('fixed-header') && (windowWidth >= 768)) {
            var fromTop = '';
            if (body.hasClass('fixed-hello')) { fromTop = 40; } else { fromTop = 0; }
            jQuery("#top").sticky({ topSpacing: fromTop, className: 'is-sticky',
                wrapperClassName: 'icy-sticky-wrapper' });                  
        } 

        if (body.hasClass('is-mobile') && (windowWidth < 1200)) {
            jQuery('.hello-bar').css({
                'position': 'relative',
                'top': 0
            });
        } 
    }

    /*-----------------------------------------------------------------------------------*/
    /*  Donation form brain
    /*---------------------------------------------------------------------------------- */


    if (jQuery('.icy-donation-form').length) {
        jQuery('.icy-donation-form ul#amounts li span.amount').on('click', function () {            
            var price = jQuery(this).attr('data-amount'); 
            jQuery('.icy-donation-form ul#amounts li.other-amount input').attr('value', '');
            jQuery('.icy-donation-form .icy-donation-value').val(price);
            jQuery('.icy-donation-form ul#amounts li span.amount').removeClass('pressed');
            jQuery(this).addClass('pressed');
        });

        jQuery('.icy-donation-form ul#amounts li.other-amount input').focus(
            function() {
                jQuery('.icy-donation-form ul#amounts li span.amount').removeClass('pressed');
                jQuery('.icy-donation-form .icy-donation-value').val(0);
            }            
        );

        jQuery('.icy-donation-form ul#amounts li.other-amount input').blur(
            function() {
                if (jQuery(this).val() != '') {
                    var amount = jQuery(this).val();
                    var number = parseInt(amount);
                    var reg = /^\d+$/;

                    if (amount.match(reg) != null) {                        
                        jQuery('.icy-donation-form ul#amounts li span.amount').removeClass('pressed');
                        jQuery('.icy-donation-form .icy-donation-value').val(amount);
                    }
                }
            }
        );        
    }

});


/*-----------------------------------------------------------------------------------*/
/*  Window Load Code
/*-----------------------------------------------------------------------------------*/ 
jQuery(window).load(function($){

    jQuery('.small-thumbnail').each( function(i) {
        var imageHeight = jQuery(this).find('img').outerHeight();
        var titleHeight = jQuery(this).find('.article-title').outerHeight();

        jQuery(this).find('.article-title').css({'top': imageHeight - titleHeight});
    });    

    

    if (jQuery.flexslider) {
        /*-----------------------------------------------------------------------------------*/
        /*  Slider
        /*-----------------------------------------------------------------------------------*/ 
        jQuery(".flexslider").flexslider({ 
            animation: 'fade',            
            slideshowSpeed: icySlide.slider_speed,           //Integer: Set the speed of the slideshow cycling, in milliseconds
            animationSpeed: 700,            //Integer: Set the speed of animations, in milliseconds                     
            animationLoop: true, 
            slideshow: icySlide.slider_auto,               // Set to true to autostart slideshow.
            smoothHeight: true,        
            useCSS: true,  
            start: function(slider) {                        
                    var current = slider.slides.eq(slider.currentSlide),                            
                        title = current.find('.caption-title'),
                        button = current.find('.caption-button');
                    
                                                            
                    if (slider.parent().hasClass('full-width-slider')) {
                        var imageHeight = current.find('img, embed, video').height();
                        slider.parent().animate({'height' : imageHeight-1}, 700, 'easeOutQuad');                               
                    }                                

                    title.addClass('fadeInUp animated');                                                        
                    button.addClass('fadeInDown animated');

                    slider.parent().removeClass('loading');
                    slider.removeClass('loading');
            },      
            before: function(slider) {                
                    var current = slider.slides.eq(slider.currentSlide),                            
                        title = current.find('.caption-title'),
                        button = current.find('.caption-button');
                        
                   title.removeClass('fadeInUp animated'); 
                   button.removeClass('fadeInDown animated');                                                         
            },
            after: function(slider) {                
                    var current = slider.slides.eq(slider.currentSlide),                            
                        title = current.find('.caption-title'),
                        button = current.find('.caption-button');
                            
                    if (slider.parent().hasClass('full-width-slider')) {
                        var imageHeight = current.find('img, embed, video').height();
                        slider.parent().animate({'height' : imageHeight-1}, 700, 'easeOutQuad');                               
                    }             

                    title.addClass('fadeInUp animated');
                    button.addClass('fadeInDown animated');                                                        
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /*  Event Slider - Code for the Event Slider block
        /*-----------------------------------------------------------------------------------*/ 

        if (jQuery('.icy-eventslider').length) {
            jQuery('.icy-eventslider-navigation').flexslider({
                animation: "slide",                            
                animationLoop: false,
                controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                directionNav: false, 
                slideshow: false,
                minItems: 3,                    //{NEW} Integer: Minimum number of carousel items that should be visible. Items will resize fluidly when below this.                                
                maxItems: 10,
                itemWidth: 80,                            
                direction: "horizontal",        //String: Select the sliding direction, "horizontal" or "vertical"
                asNavFor: ".icy-eventslider"
                });

            jQuery('.icy-eventslider').flexslider({
                animation: "slide",
                controlNav: false,                
                directionNav: false,
                animationLoop: false,
                direction: "horizontal",        //String: Select the sliding direction, "horizontal" or "vertical"
                slideshow: false,
                sync: ".icy-eventslider-navigation",
                start: function(slider) {                
                    var current = slider.slides.eq(slider.currentSlide),                            
                        day = current.find('.content .day'),
                        address = current.find('.content .address'),
                        title = current.find('.text'),
                        cost = current.find('.content .cost');
                            
                    day.addClass('fadeInDown animated');                                                        
                    address.addClass('fadeInLeft animated');
                    title.addClass('fadeInRight animated');
                    cost.addClass('fadeInUp animated');
                },      
                before: function(slider) {                
                    var current = slider.slides.eq(slider.currentSlide),                            
                        day = current.find('.content .day'),
                        address = current.find('.content .address'),
                        title = current.find('.text'),
                        cost = current.find('.content .cost');
                            
                    day.removeClass('fadeInDown animated');                                                        
                    address.removeClass('fadeInLeft animated');
                    title.removeClass('fadeInRight animated');
                    cost.removeClass('fadeInUp animated');
                },
                after: function(slider) {                
                    var current = slider.slides.eq(slider.currentSlide),                            
                        day = current.find('.content .day'),
                        address = current.find('.content .address'),
                        title = current.find('.text'),
                        cost = current.find('.content .cost');
                            
                    day.addClass('fadeInDown animated');                                                        
                    address.addClass('fadeInLeft animated');
                    title.addClass('fadeInRight animated');
                    cost.addClass('fadeInUp animated');                                                    
                }
            });
        }
    } 
        

});
/*-----------------------------------------------------------------------------------*/
/*  Parallax Effect for the Caption on the Full Width Slider
/*-----------------------------------------------------------------------------------*/ 
jQuery(window).scroll(function($) {
    var $HeaderInner = jQuery('.full-width-slider .flexslider .flex-caption .flex-caption-content');
    var windowScroll;

    //Get scroll position of window
    windowScroll = jQuery(this).scrollTop();

    //Slow scroll of .art-header-inner scroll and fade it out
    $HeaderInner.css({
      'margin-top' : +(windowScroll/2)+"px",
      'opacity' : Math.max(1-(windowScroll/1500), 0)
    });
});

jQuery(window).resize(function() {

    if (jQuery('.full-width-slider').length) {
        var imageHeight = jQuery('.full-width-slider').find('img, embed, video').height();
        jQuery('.full-width-slider').animate({'height' : imageHeight-1}, 0, 'easeOutQuad');                               
    }  

});