<?php

/**
 * Collection of theme functions which enable us to set various things in the theme, like favicons, custom CSS, lightboxes, etc.
 *
 * @package     Icy Framework
 * @copyright   Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author      Paul Roman
 *
 * @since       Icy Framework 1.0
 */

/**
 * Output Custom CSS
 *
 * @return  string   $output    Outputs the string of Custom CSS defined in theme customizer
 * @uses    thsp_cbp_get_options_values(); defined in customizer/helpers.php to retrieve values from the customizer
 *          
 */

function icy_head_css() {
    global $icy_options;
		
		$output = '';
			
        $css = $icy_options['custom_css']; 
        $primary_accent = $icy_options['primary_accent'];
        $secondary_accent = $icy_options['secondary_accent'];
        $headings_colour = $icy_options['headings_colour'];
        $header_color = $icy_options['header_color'];
        $hello_color = $icy_options['hello_color'];
        $footer_color = $icy_options['footer_color'];
        $language_color = $icy_options['language_color'];
        $cart_color = $icy_options['cart_color'];
        $buddypress_color = $icy_options['buddypress_color'];
        $links_hover = $icy_options['links_hover'];
        
        if ($primary_accent != '') {
            $output .= "button:hover,input[type=\"submit\"]:hover,input[type=\"submit\"]:hover,.logo-wrapper.extend,.full-width-slider .flex-caption .caption-title span,.icy-page-title .flex-caption .caption-title span,.navigation-posts a,blockquote,#footer-widgets .widget-title:before,.small-thumbnail .article-title,.carousel-grid .entry-title,.icy-member .icy-member-name,.icy-eventslider-day.flex-active-slide,.icy-eventslider-day.see-all:hover,.icy-eventslider-day.see-all:hover a,#mc_signup_form input[type=\"submit\"], ul.tribe-events-sub-nav a, .tribe-events-back a, .tribe-events-list-widget .tribe-events-widget-link a, .tribe-events-adv-list-widget .tribe-events-widget-link a, #tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a:hover,#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a:hover, #buddypress div.activity-meta a.bp-primary-action, #buddypress a.bp-primary-action,#buddypress #reply-title small a, #buddypress div.item-list-tabs ul li.selected, #buddypress div.item-list-tabs ul li.current, #buddypress div.item-list-tabs ul li.selected a span,#buddypress div.item-list-tabs ul li.current a span,#buddypress div.item-list-tabs ul li a:hover span { background-color: ".$primary_accent."; } \n";
            $output .= "input:focus,textarea:focus,nav#primary-nav ul > li a::before,.navigation-posts a, nav#primary-nav ul li.current-cat a, nav#primary-nav ul li.current_page_item a, nav#primary-nav ul li.current-menu-item a, nav#primary-nav ul > li a:hover::before, ul.tribe-events-sub-nav a, .tribe-events-back a, .tribe-events-list-widget .tribe-events-widget-link a, .tribe-events-adv-list-widget .tribe-events-widget-link a, ul.tribe-events-sub-nav a:hover, .tribe-events-back a:hover, .tribe-events-list-widget .tribe-events-widget-link a:hover, .tribe-events-adv-list-widget .tribe-events-widget-link a:hover, .icy-event-datetime  { border-color: ".$primary_accent."; } \n";                        
            $output .= "a,nav#primary-nav ul li.current-cat a,.navigation-posts a:hover,.entry-title:hover h1,span.reply-to a,span.reply-to a:hover,.widget-title span,.icy-eventslider-day.see-all,#icy-nav a:hover, .events-meta-section p.first-row, ul.tribe-events-sub-nav a:hover, .tribe-events-back a:hover, .tribe-events-list-widget .tribe-events-widget-link a:hover, .tribe-events-adv-list-widget .tribe-events-widget-link a:hover { color: ".$primary_accent."; } \n";
        }

        if ($secondary_accent != '') {
            $output .= "input[type=\"button\"],input[type=\"submit\"],.more-link,.icy-button.donate,.search-button,.csstransitions .blogposts-grid .blog-item .post-meta .comment-count,.carousel-grid .post-meta,.icy-member .icy-position,.icy-eventslider-content .text, .icy-donation-amounts ul#amounts li .amount, #buddypress form#whats-new-form #whats-new-submit input, #tribe-bar-form .tribe-bar-submit input[type=submit] { background-color: ".$secondary_accent."; } \n";
            $output .= ".more-link:hover,input[type=\"button\"]:hover,input[type=\"submit\"]:hover, .icy-donation-amounts ul#amounts li .amount, .icy-donation-amounts ul#amounts li .amount.pressed,.icy-donation-amounts ul#amounts li .amount:hover, .tribe-events-list .events-list-element:nth-child(even) .icy-event-datetime,
#tribe-geo-results .vevent:nth-child(even) .icy-event-details .icy-event-datetime { border-color: ".$secondary_accent."; } \n";                        
            $output .= ".more-link:hover,input[type=\"button\"]:hover,input[type=\"submit\"]:hover,.full-width-slider .flex-caption .caption-button,.icy-posts-carousel .icy-button.icon-book::before,.icy-posts-carousel .icy-button.icon-calendar::before, .icy-donation-amounts ul#amounts li .amount.pressed,.icy-donation-amounts ul#amounts li .amount:hover, .buttons .button.checkout:hover { color: ".$secondary_accent."; } \n";
        }

        if ($headings_colour != '') {
            $output .= "h1,h2,h3,h4,h5,h6,aside.sidebar .widget-title,.widget-title,.icy-block-title, .aq-block-title, .tribe-bar-views-inner { color: ".$headings_colour."; } \n";            
        }

        if ($header_color != '') {
            $output .= "#top,header,.search-wrapper form input,nav#primary-nav ul ul,footer input[type=\"text\"],.secondary-footer { background-color: ".$header_color."; } \n";
        }

        if ($hello_color != '') {
            $output .= ".hello-bar,.search-button.active,footer.footer-container,#icy-nav, .events-meta-section, #tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a { background-color: ".$hello_color."; } \n";
            $output .= ".events-meta-section, #tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a, #buddypress div.item-list-tabs#subnav{ background-color: ".$hello_color.";}";
        }

        if ($footer_color != '') {
            $output .= "footer.footer-container,footer .widget,footer .widget ul li,footer,footer a, footer ul li a,.icy-posts-carousel .icy-carousel-title, .icy-donation-form .description .body-text { color: ".$footer_color." ;} \n";            
        }

        if ($language_color != '') {
            $output .= ".blogposts-grid .blog-item .post-meta .icon-tag, .header_language_list { background-color : ".$language_color."; }";
            //$output .= ".woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price { color : ".$language_color." ;}";
        }

        if ($cart_color != '') {
            $output .= ".icy-eventslider-content .content .cost, .header_language_list ul, .blogposts-grid .blog-item .post-meta .icon-category, .icy_cart_dropdown { background-color: ".$cart_color." ; }";
        }

        if ($buddypress_color != '') {
            $output .= "#buddypress div.item-list-tabs ul li a,#buddypress div.item-list-tabs ul li span,#buddypress div.item-list-tabs ul li.selected,#buddypress div.item-list-tabs ul li.current, .events-wrapper li { border-color: ".$buddypress_color." ; }";
            $output .= "#buddypress div.item-list-tabs ul li a span, #buddypress div#item-header, .tribe-events-meta-group .tribe-events-single-section-title, #tribe-bar-form, .tribe-events-list-separator-month, .tribe-events-list .events-list-element:nth-child(even) .icy-event-price,#tribe-geo-results .vevent:nth-child(even) .icy-event-details .icy-event-price { background-color: ".$buddypress_color." ; }";
        }

        if ($links_hover != '') {
            $output .= "a:hover { color: ".$links_hover."; }\n";
            $output .= ".icy-event-price, #buddypress div.item-list-tabs { background-color: ".$headings_colour.";}";
            $output .= ".search-wrapper form input,footer input[type=\"text\"],#footer-widgets .widget-title { border-color: ".$links_hover."; }\n";
            $output .= ".icy-page-title,.secondary-footer .paid-for,.icy-quote,#mc_subheader { background-color: ".$links_hover."; }\n";
        }

        if ($css != '') {
            $output .= $css;
        }
		
        if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo stripslashes($output);
		}
}
add_action('wp_head', 'icy_head_css');

/**
 * Body Class
 *
 * @return  array   $classes    adds different classnames to the <body>
 * @uses    thsp_cbp_get_options_values(); defined in customizer/helpers.php to retrieve values from the customizer   
 */

if ( !function_exists( 'icy_body_class' ) ) { 
    function icy_body_class($classes) {       
    global $icy_options;
    
        $logo_align = $icy_options['logo_placement'];   
        $hello = $icy_options['fixed_hellobar'];     
        $header = $icy_options['fixed_header'];

        $classes[] .= $logo_align;         
        $classes[] .= $hello;
        $classes[] .= $header;

        return $classes;
    }
    add_filter('body_class','icy_body_class');
}


/**
 * Favicon
 *
 * @return  string     Outputs the HTML required for the favicon to be displayed
 * @uses    thsp_cbp_get_options_values(); defined in customizer/helpers.php to retrieve values from the customizer   
 */

function icy_graphics() {
    global $icy_options;

    $output = '';
	$favicon = $icy_options['favicon'] ;
    
	if ($favicon != '') {
	   echo '<link rel="shortcut icon" href="' . $favicon . '"/>'."\n";
	}
}
add_action('wp_head', 'icy_graphics');

/**
 * Event Single Tweak
 *
 * @return  string     Outputs the HTML required for the favicon to be displayed
 * @uses    The Modern Tribe "The Events Calendar" plugin
 * @since   1.1
 */


//apply_filters( 'tribe_events_single_event_meta_legacy_mode', true);

// function icy_event_single() {
//     $event_id = get_the_ID();
//     $skeleton_mode = apply_filters( 'tribe_events_single_event_the_meta_skeleton', false, $event_id ) ;
//     $group_venue = apply_filters( 'tribe_events_single_event_the_meta_group_venue', false, $event_id );
//     $html = '';

//     if ( $skeleton_mode ) {

//         // show all visible meta_groups in skeleton view
//         $html .= tribe_get_the_event_meta();

//     } else {
//         if (tribe_embed_google_map( $event_id )) {
//             $venue_details = tribe_get_meta( 'tribe_venue_map' );
//             if ( !empty($venue_details) ) {
//                 $html .= apply_filters( 'tribe_events_single_event_the_meta_venue_row', sprintf( '%s',
//                     $venue_details
//                 ) );
//             }
//         }

//         $html .= '<div class="tribe-events-single-section tribe-events-event-meta tribe-clearfix">';
//         // Event Details
//         $html .= tribe_get_meta_group( 'tribe_event_details' );

//         // When there is no map show the venue info up top
//         if ( ! $group_venue && ! tribe_embed_google_map( $event_id ) ) {
//             // Venue Details
//             $html .= tribe_get_meta_group( 'tribe_event_venue' );
//             $group_venue = false;
//         } else if ( ! $group_venue && ! tribe_has_organizer( $event_id ) && tribe_address_exists( $event_id ) && tribe_embed_google_map( $event_id ) ) {
//             $html .= sprintf( '%s<div class="tribe-events-meta-group tribe-events-meta-group-gmap">%s</div>',
//                 tribe_get_meta_group( 'tribe_event_venue' ), tribe_get_meta( 'tribe_venue_map' )
//             );
//             $group_venue = false;
//         } else {
//             $group_venue = true;
//         }

//         // Organizer Details
//         if ( tribe_has_organizer( $event_id ) ) {
//             $html .= tribe_get_meta_group( 'tribe_event_organizer' );
//         }

//         $html .= apply_filters( 'tribe_events_single_event_the_meta_addon', '', $event_id );

//             if ( ! $skeleton_mode && $group_venue ) {
//                 // If there's a venue map and custom fields or organizer, show venue details in this seperate section
//                 $venue_details = tribe_get_meta_group( 'tribe_event_venue' );
//                                  //tribe_get_meta( 'tribe_venue_map' );

//                 if ( !empty($venue_details) ) {
//                     $html .= apply_filters( 'tribe_events_single_event_the_meta_venue_row', sprintf( '%s',
//                         $venue_details
//                     ) );
//                 }
//             }

//         $html .= '</div>';

//     }

//     return $html;
// }
// add_action('tribe_events_single_event_before_the_meta', 'icy_event_single');



/**
 * Icy Gallery - Slideshow using the FlexSlider jquery library
 *
 * @return  string    Outputs HTML for the gallery slideshow
 * @uses    rwmb_meta();  Function to retrieve custom meta box information
 * @uses    thsp_cbp_get_options_values(); defined in customizer/helpers.php to retrieve values from the customizer
 */
if ( !function_exists( 'icy_gallery' ) ) {
    function icy_gallery($postid, $imagesize) {
    
        if (function_exists('rwmb_meta'))
        {

            $args = array();
            $caption = '';
            $url = '';
            $caption = '';
            $height = '';
            $width = '';
            $alt = '';
            $images_array = '';

            $args = array(
                'type' => 'plupload_image',
                'size' => $imagesize,
            );
            $images_array = rwmb_meta( '_icy_gallery_images', $args, $postid );
 
            if( !empty($images_array) && function_exists('rwmb_meta') ) {               
                echo "<!-- BEGIN #slider -->\n<div class='flexslider loading'>"; 
                echo '<ul class="slides">';
                $i = 0;

                foreach ($images_array as $image) {
                    $url = $image['url'];
                    $caption = $image['caption'];
                    $width = $image['width'];
                    $height = $image['height'];
                    $alt = $image['title'];

                    echo "<li><img height='".$height."' width='".$width."' src='".$url."' alt='".$alt."' />";
                        if ($caption != '') echo "<div class='flex-caption'><h2 class='caption-title'>" .$caption . "</h2></div>";
                    echo "</li>";
                }

                echo '</ul>';
                echo "<!-- END #slider -->\n</div>";
        
        
            }            
        
        }        
        
    }
}

/**
 * Icy Lightbox - lightweight lightbox system using the View.js jquery library http://finegoodsmarket.com/view/
 *
 * @return  string    Outputs HTML for the lightbox gallery
 * @uses    rwmb_meta();  Function to retrieve custom meta box information
 * @uses    thsp_cbp_get_options_values(); defined in customizer/helpers.php to retrieve values from the customizer
 */

if ( !function_exists( 'icy_lightbox' ) ) {
    function icy_lightbox($postid, $imagesize) {
        if (function_exists('rwmb_meta'))
        {

            $args = array();
            $caption = '';
            $url = '';
            $caption = '';
            $height = '';
            $width = '';
            $alt = '';
            $images_array = '';

            $args = array(
                'type' => 'plupload_image',
                'size' => $imagesize,
            );
            $images_array = rwmb_meta( '_icy_lightbox_images', $args, $postid );
            $images_size = rwmb_meta( '_icy_lightbox_columns', '', $postid);
 
            if( !empty($images_array) && function_exists('rwmb_meta') ) {

                

                echo "<!-- BEGIN .lightbox-gallery -->\n<div class='lightbox-gallery'>"; 
                echo '<ul class="gallery-images">';
                $i = 0;
                $id = rand(1,100);                

                foreach ($images_array as $image) {
                    $url = $image['url'];
                    $caption = $image['caption'];
                    $width = $image['width'];
                    $height = $image['height'];
                    $alt = $image['title'];                    

                    echo "<li class='".$images_size."'><a href='".$url."' rel='gallery_".$id."' title='".$caption."' class='view'>";
                        echo "<img height='".$height."' width='".$width."' src='".$url."' alt='".$alt."' />";                        
                    echo "</a></li>";

                    $i++;
                }

                echo '</ul>';
                echo "<!-- END .lightbox-gallery -->\n</div>";
            }

        }               

    }
}

/**
 * Title         : Aqua Resizer
 * Description   : Resizes WordPress images on the fly
 * Version       : 1.2.0
 * Author        : Syamil MJ
 * Author URI    : http://aquagraphite.com
 * License       : WTFPL - http://sam.zoy.org/wtfpl/
 * Documentation : https://github.com/sy4mil/Aqua-Resizer/
 *
 * @param string  $url    - (required) must be uploaded using wp media uploader
 * @param int     $width  - (required)
 * @param int     $height - (optional)
 * @param bool    $crop   - (optional) default to soft crop
 * @param bool    $single - (optional) returns an array if false
 * @uses  wp_upload_dir()
 * @uses  image_resize_dimensions()
 * @uses  wp_get_image_editor()
 *
 * @return str|array
 */

if(!class_exists('Aq_Resize')) {
    class Aq_Resize
    {
        /**
         * The singleton instance
         */
        static private $instance = null;

        /**
         * No initialization allowed
         */
        private function __construct() {}

        /**
         * No cloning allowed
         */
        private function __clone() {}

        /**
         * For your custom default usage you may want to initialize an Aq_Resize object by yourself and then have own defaults
         */
        static public function getInstance() {
            if(self::$instance == null) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        /**
         * Run, forest.
         */
        public function process( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
            // Validate inputs.
            if ( ! $url || ( ! $width && ! $height ) ) return false;

            // Caipt'n, ready to hook.
            if ( true === $upscale ) add_filter( 'image_resize_dimensions', array($this, 'aq_upscale'), 10, 6 );

            // Define upload path & dir.
            $upload_info = wp_upload_dir();
            $upload_dir = $upload_info['basedir'];
            $upload_url = $upload_info['baseurl'];
            
            $http_prefix = "http://";
            $https_prefix = "https://";
            
            /* if the $url scheme differs from $upload_url scheme, make them match 
               if the schemes differe, images don't show up. */
            if(!strncmp($url,$https_prefix,strlen($https_prefix))){ //if url begins with https:// make $upload_url begin with https:// as well
                $upload_url = str_replace($http_prefix,$https_prefix,$upload_url);
            }
            elseif(!strncmp($url,$http_prefix,strlen($http_prefix))){ //if url begins with http:// make $upload_url begin with http:// as well
                $upload_url = str_replace($https_prefix,$http_prefix,$upload_url);      
            }
            

            // Check if $img_url is local.
            if ( false === strpos( $url, $upload_url ) ) return false;

            // Define path of image.
            $rel_path = str_replace( $upload_url, '', $url );
            $img_path = $upload_dir . $rel_path;

            // Check if img path exists, and is an image indeed.
            if ( ! file_exists( $img_path ) or ! getimagesize( $img_path ) ) return false;

            // Get image info.
            $info = pathinfo( $img_path );
            $ext = $info['extension'];
            list( $orig_w, $orig_h ) = getimagesize( $img_path );

            // Get image size after cropping.
            $dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
            $dst_w = $dims[4];
            $dst_h = $dims[5];

            // Return the original image only if it exactly fits the needed measures.
            if ( ! $dims && ( ( ( null === $height && $orig_w == $width ) xor ( null === $width && $orig_h == $height ) ) xor ( $height == $orig_h && $width == $orig_w ) ) ) {
                $img_url = $url;
                $dst_w = $orig_w;
                $dst_h = $orig_h;
            } else {
                // Use this to check if cropped image already exists, so we can return that instead.
                $suffix = "{$dst_w}x{$dst_h}";
                $dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
                $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

                if ( ! $dims || ( true == $crop && false == $upscale && ( $dst_w < $width || $dst_h < $height ) ) ) {
                    // Can't resize, so return false saying that the action to do could not be processed as planned.
                    return false;
                }
                // Else check if cache exists.
                elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
                    $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
                }
                // Else, we resize the image and return the new resized image url.
                else {

                    $editor = wp_get_image_editor( $img_path );

                    if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
                        return false;

                    $resized_file = $editor->save();

                    if ( ! is_wp_error( $resized_file ) ) {
                        $resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
                        $img_url = $upload_url . $resized_rel_path;
                    } else {
                        return false;
                    }

                }
            }

            // Okay, leave the ship.
            if ( true === $upscale ) remove_filter( 'image_resize_dimensions', array( $this, 'aq_upscale' ) );

            // Return the output.
            if ( $single ) {
                // str return.
                $image = $img_url;
            } else {
                // array return.
                $image = array (
                    0 => $img_url,
                    1 => $dst_w,
                    2 => $dst_h
                );
            }

            return $image;
        }

        /**
         * Callback to overwrite WP computing of thumbnail measures
         */
        function aq_upscale( $default, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
            if ( ! $crop ) return null; // Let the wordpress default function handle this.

            // Here is the point we allow to use larger image size than the original one.
            $aspect_ratio = $orig_w / $orig_h;
            $new_w = $dest_w;
            $new_h = $dest_h;

            if ( ! $new_w ) {
                $new_w = intval( $new_h * $aspect_ratio );
            }

            if ( ! $new_h ) {
                $new_h = intval( $new_w / $aspect_ratio );
            }

            $size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

            $crop_w = round( $new_w / $size_ratio );
            $crop_h = round( $new_h / $size_ratio );

            $s_x = floor( ( $orig_w - $crop_w ) / 2 );
            $s_y = floor( ( $orig_h - $crop_h ) / 2 );

            return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
        }
    }
}

if(!function_exists('aq_resize')) {

    /**
     * This is just a tiny wrapper function for the class above so that there is no
     * need to change any code in your own WP themes. Usage is still the same :)
     */
    function aq_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
        $aq_resize = Aq_Resize::getInstance();
        return $aq_resize->process( $url, $width, $height, $crop, $single, $upscale );
    }
}

/**
 * Icy WPML Language Switcher - Custom switcher in the header.php file
 *
 * @return  string    Outputs HTML for language switcher
 * @uses    icl_get_languages();    Returns an array with languages http://wpml.org/documentation/getting-started-guide/language-setup/custom-language-switcher/
 * @uses    icl_disp_language();    The icl_disp_language() function is created by WPML. What it does is check if the two arguments (native_language_name, translated_language_name) are different. If so, it returns them both, otherwise, it returns them just once.
 */

if (!function_exists('languages_list_footer') && function_exists('icl_get_languages')) {
    function languages_list_footer() {

        $languages = icl_get_languages('skip_missing=0&orderby=code');
        
        if(!empty($languages)){
        
            echo '<div class="header_language_list">';
            echo '<div class="icy-button language icon-flag">';
                _e('Choose a language', 'framework');
            echo '</div>';
            echo '<ul>';
        
            foreach($languages as $lang){                
                if(!$lang['active']) {
                    echo '<li>'; 

                        if($lang['country_flag_url']){
                            if(!$lang['active']) echo '<span class="flag"><a href="'.$lang['url'].'">';
                            echo '<img src="'.$lang['country_flag_url'].'" height="12" alt="'.$lang['language_code'].'" width="18" />';
                            if(!$lang['active']) echo '</a></span>';
                        }

                        echo '<a href="'.$lang['url'].'">';
                            echo icl_disp_language($lang['translated_name'], $lang['translated_name']);
                        echo '</a>';

                    echo '</li>';
                }
            }
        
            echo '</ul>';

            echo '</div>';

            
        }
    }
}

/**
 * Add custom JS to admin screen
 *
 * @return  array
 * @uses    wp_enqueue_Script();
 */



function portfolio_admin_style( $hook_suffix ) {   
    wp_enqueue_style( 'wp-color-picker' );        
    wp_enqueue_script( 'custom-admin', get_stylesheet_directory_uri() . '/js/jquery.custom.admin.js', array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_print_styles', 'portfolio_admin_style', 11 );


?>