<?php

/**
 * File: functions.php
 *
 *	Description: Here are a set of custom functions used for this theme framework.
 *	Please be extremely careful when you are editing this file, because when things
 *	tend to go bad, they go bad big time. Well, you have been warned ! :-)
 *
 * @package		Icy Framework
 * @copyright	Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Paul Roman
 *
 * @since		Icy Framework 1.0
 */

/**
 * Registering WP3.0+ Custom Menu 
 *
 * @return  void
 * @uses	init(); action
 */

function register_menu() {
	register_nav_menu('main-menu', __('Main Menu', 'framework'));
}
add_action('init', 'register_menu');


/**
 * Loading Theme Translation
 *
 * @return  void
 * @uses	load_theme_textdomain();
 */

load_theme_textdomain('framework');

/**
 * Registering Sidebars
 *
 * @return  void
 * @uses	register_sidebars();
 */

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Main Sidebar',
		'description' => 'Displays on the blog page and besides the posts.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Header Right',
		'description' => 'Display social icons here.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Footer 1',		
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Footer 2',		
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer 3',		
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Secondary Footer 1',
		'description' => 'Special highlighted area for the "Paid for" text',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Secondary Footer 2',		
		'description' => 'Put here your copyright, or social icons.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
}


/**
 * Configuring WP 2.9+ thumbnail support and adds theme support for post formats
 *
 * @return  void
 * @uses	add_theme_support();
 * @uses	set_post_thumbnail_size();
 * @uses 	add_image_size();
 */

if ( function_exists('add_theme_support')) {
	add_theme_support( 'post-formats', array(			
			'image', 
			'gallery', 			
			'video') 
	);		
	add_theme_support( 'post-thumbnails' ); //Adding theme support for post thumbnails
	add_theme_support( 'automatic-feed-links' ); //Adding support for automatic feed links	
	set_post_thumbnail_size( 300, 180, true );

	add_image_size('thumbnail-blog-block', 1200, 750, false);	
	add_image_size('thumbnail-carousel-block', 300, 180, true);
	add_image_size('thumbnail-events-list', 288, 177, true);	
	add_image_size('thumbnail-events-slider', 900, 550, false);	
	add_image_size('page', 1920, 1080, false);		 	
}

/**
 * Custom Excerpt Length
 *
 * @return  int
 * @uses 	filter 	excerpt_length(); 
 */

if ( !function_exists('icy_custom_excerpt_length') ) {
	function icy_custom_excerpt_length( $length ) {
		return 70;
	}
}
add_filter('excerpt_length', 'icy_custom_excerpt_length');


/**
 * Custom Excerpt String Text
 *
 * @return  string
 * @uses 	filter 	wp_trim_excerpt(); 
 */

if ( !function_exists('icy_excerpt') ) {
	function icy_excerpt($excerpt) {
		return str_replace('[...]', '...', $excerpt); 
	}
}
add_filter('wp_trim_excerpt', 'icy_excerpt');


/**
 * Separated pings list
 *
 */

function icy_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>

		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>

<?php }

/**
 * Custom Login Logo. In order to modify the custom login logo, go to the theme folder and modify the custom-login-logo.png file.
 *
 * @return  string
 * @uses 	get_template_directory_uri();
 * @uses 	action 	login_head(); 
 */

function icy_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_template_directory_uri().'/images/custom-login-logo.png) !important; width: 100% !important; height: auto !important; }
    </style>';
}
add_action('login_head', 'icy_custom_login_logo');

/**
 * Custom Login Logo. In order to modify the custom login logo, go to the theme folder and modify the custom-login-logo.png file.
 *
 * @return  void
 * @var 	int 	$content_width 
 */

if( ! isset( $content_width ) ) $content_width = 800;


/**
 * Custom caption function
 *
 * @var 	int 	$thumb_id
 * @return  void
 * @uses    get_posts();
 * @uses    get_post_thumbnail_id();
 */
if ( !function_exists('the_post_thumbnail_caption') ) {
	function the_post_thumbnail_caption() {
	  global $post;

	  $thumb_id = get_post_thumbnail_id($post->id);

	  $args = array(
		'post_type' => 'attachment',
		'post_status' => null,
		'post_parent' => $post->ID,
		'include'  => $thumb_id
		); 

	   $thumbnail_image = get_posts($args);

	   if ($thumbnail_image && isset($thumbnail_image[0])) {
	     //show thumbnail title
	     //echo $thumbnail_image[0]->post_title; 

	     //Uncomment to show the thumbnail caption
	     echo '<div class="icy_caption"><h3>'.$thumbnail_image[0]->post_excerpt.'</h3></div>';

	     //Uncomment to show the thumbnail description
	     //echo $thumbnail_image[0]->post_content; 

	     //Uncomment to show the thumbnail alt field
	     //$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
	     //if(count($alt)) echo $alt;
	  }
	}
}

/**
 * Registering the custom javascript files
 *
 * @uses 	wp_register_script();
 * @uses    rwmb_meta();  Function to retrieve custom meta box information
 * @uses    thsp_cbp_get_options_values(); defined in customizer/helpers.php to retrieve values from the customizer
 * @uses 	is_singular();
 * @uses 	is_archive();
 *
 * @return  void
 */
function icy_register_js() {
	if (!is_admin()) {

		global $icy_options;

		$smooth = $icy_options['smooth_scroll'];
		$slide_rotate = $icy_options['slideshow_rotate'];
		$slide_speed  = $icy_options['slideshow_speed'];

		// Registering Javascripts				
		wp_register_script('google-maps-api', 'http://maps.google.com/maps/api/js?sensor=false');
		wp_register_script('google-map',	get_template_directory_uri() . '/js/map.js', 'google-maps-api', '1.0', TRUE);
		wp_register_script('modernizr', 	get_template_directory_uri() . '/js/modernizr.js', 'jquery', '2.6.2', TRUE);		
		wp_register_script('superfish',     get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.0', TRUE);								
		wp_register_script('excanvas',		get_template_directory_uri() . '/js/excanvas.js', 'jquery','1.0',  TRUE);
		wp_register_script('easy-pie-chart',get_template_directory_uri() . '/js/jquery.easy-pie-chart.js', array('jquery', 'excanvas'), '1.0', TRUE);	
		wp_register_script('smoothscroll',	get_template_directory_uri() . '/js/smoothscroll.js', 'jquery','1.0',  TRUE);					
		wp_register_script('icy_scripts', 	get_template_directory_uri() . '/js/jquery.icyscripts.min.js', 'jquery', '1.0', TRUE);
		wp_register_script('icy_custom',    get_template_directory_uri() . '/js/jquery.custom.js', array('jquery', 'icy_scripts'), '1.0', TRUE);						

		// Enqueueing Javascripts
		wp_enqueue_script( 'jquery' );		
		wp_enqueue_script( 'modernizr' );		
		wp_enqueue_script( 'superfish' );	
		if ($smooth == true) wp_enqueue_script( 'smoothscroll' );								
		wp_enqueue_script( 'icy_scripts' );
		wp_enqueue_script( 'icy_custom' );	

		wp_localize_script('icy_custom', 
			'icySlide', 
			array( 
			'slider_speed' => $slide_speed, 			
			'slider_auto' => $slide_rotate, 			
			) 
		);

		// Loading conditional scripts
		if(is_singular()) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 	
		if(is_archive()) wp_enqueue_script('icy_custom');
	}
}
add_action('wp_enqueue_scripts', 'icy_register_js');

/**
 * Registering Google Fonts
 *
 * @var 	$protocol
 * @uses 	wp_enqueue_style();
 *
 * @return  void
 */
function icy_google_fonts() {
  		$protocol = is_ssl() ? 'https' : 'http';
		
		wp_enqueue_style( 'icy-google-font', "$protocol://fonts.googleapis.com/css?family=Roboto:900,600,700,400,300,100|Roboto+Condensed:400,300,700|Roboto+Slab:100,300,400,700' rel='stylesheet' type='text/css" );

}

add_action( 'wp_enqueue_scripts', 'icy_google_fonts' );


/**
 * Registering and Enqueuing the CSS files
 *
 * @uses 	wp_register_style(); 	- Used to register .css files
 * @uses 	wp_enqueue_style(); 	- Used to enqueue .css files
 *
 * @return  void
 */
function icy_enqueue_stylesheets() {    	
		//Registering Stylesheets
    	wp_register_style('style_css',			get_template_directory_uri() . '/style.css');
    	wp_register_style('pagenavi',			get_template_directory_uri() . '/css/pagenavi-css.css');
    	wp_register_style('flexslider_css',		get_template_directory_uri() . '/css/flexslider.css');    
    	wp_register_style('fontawesome',		get_template_directory_uri() . '/css/font-awesome.min.css');	

    	//Enqueue Stylesheets
		wp_enqueue_style('style_css');		
		wp_enqueue_style('fontawesome');

		if (is_home() || is_single() || is_archive() || is_front_page()) {
			wp_enqueue_style('pagenavi');
			wp_enqueue_style('flexslider_css');
		}	    	

    	if ( is_child_theme() && 'parlament' == get_template() ) { 
 	        wp_enqueue_style( get_stylesheet(), get_stylesheet_uri(), array( 'style_css' ), '1.0'); 
 	    } 
}
add_action('wp_enqueue_scripts', 'icy_enqueue_stylesheets');

/**
 * Adding Browser Detection Class
 *
 * @return  array 	$classes
 */
if ( !function_exists( 'icy_browser_body_class' ) ) {
    function icy_browser_body_class($classes) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE){ 
			$classes[] = 'ie';
			if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version)) $classes[] = 'ie'.$browser_version[1];
		} else $classes[] = 'unknown';
	
		if($is_iphone) $classes[] = 'iphone';
		return $classes;
    }
    
    add_filter('body_class','icy_browser_body_class');
}


/**
 * Custom Comment Styling
 *
 * @return  string 	$output
 */

function icy_comment($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     	<!--BEGIN .comment -->
    	<div id="comment-<?php comment_ID(); ?>" class="comment-content commentary-no-<?php comment_ID(); ?> <?php if($isByAuthor == true) : ?>bypostauthor<?php endif; ?>">
    		<!--BEGIN .comment-author -->
    		<div class="comment-author commentary">

    			<figure class="author-avatar">
        			<?php echo get_avatar($comment,$size='64'); ?>        		
		        </figure>    			
    			<span class="author-name"><?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?></span>

    			<span class="reply-to"><?php printf(__('%1$s at %2$s', 'framework'), get_comment_date(),  get_comment_time()) ?><?php edit_comment_link(__('[Edit]', 'framework'),' ',' ') ?><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
         	<!--END .comment-author -->
    		</div>    		
      
    	<?php if ($comment->comment_approved == '0') : ?>
        	<em class="moderation"><?php _e('Your comment is awaiting moderation.', 'framework') ?></em>     
      	<?php endif; ?>
	  		
	  		<!--BEGIN .comment-entry -->
      		<div class="comment-entry commentary span12">
    			<?php comment_text() ?>
      		<!--END .comment-entry -->      		
			</div>
      
		<!--END .comment -->      
    	</div>

<?php
}

/**
 * Loading Custom Widgets
 *
 * @return  void
 */

// Add the Custom Flickr Photos Widget
include("functions/widget-flickr.php");

// Add the Custom Video Widget
include("functions/widget-video.php");

/**
 * Filtering which allows shortcodes in text widgets
 *
 * @return  void
 */

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

/**
 * Gives each and every image a class which enables it to be displayed in a lightbox
 *
 * @uses 	preg_replace
 * @return  string $content;
 */

function lightbox_regex($content){ 
    global $post; 

    $content = preg_replace("/(<a(?![^>]*?rel=['\"]lightbox.*)[^>]*?href=['\"][^'\"]+?\.(?:gif|jpg|jpeg|png)\?{0,1}\S{0,}['\"][^\>]*)>/i" , '$1 class="lightbox view" rel="gallery['.$post->ID.']">', $content); 
    return $content; 
} 

add_filter('post_format_meta', 'lightbox_regex');
add_filter('the_content', 'lightbox_regex');

/**
 * Remove version number next to each script that is enqueued to minimize redirects
 *
 * @uses 	remove_query_arg();
 * @return  string $src;
 */
function _remove_wp_ver_css_js( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', '_remove_wp_ver_css_js', 10 );
add_filter( 'script_loader_src', '_remove_wp_ver_css_js', 10 );

/**
 * Check WooCommerce existence
 * 
 * @return  bool;
 */

function icy_woocommerce_enabled()
{
	if ( class_exists( 'woocommerce' ) ){ return true; }
	return false;
}

/*

function icy_login_msg( $message )
{
    return '<p class="message">For Buddypress:  user: bpdemo  pass: bpdemo100</p>';
}
add_filter( 'login_message', 'icy_login_msg' );
*/

/**
 *
 * INCLUDING THE THEME FUNCTIONS, METABOX, REQUIRED PLUGINS, THEME CUSTOMIZER AND AUTO-UPDATE FEATURE
 *
 */

if (!defined('ICY_FILEPATH'))  define('ICY_FILEPATH', get_template_directory());
if (!defined('ICY_DIRECTORY')) define('ICY_DIRECTORY', get_template_directory_uri());

require_once (ICY_FILEPATH . '/functions/theme-functions.php');
require_once (ICY_FILEPATH . '/functions/theme-metabox.php');
require_once (ICY_FILEPATH . '/functions/theme-require-plugins.php');
require_once (ICY_FILEPATH . '/page-builder/page-builder.php');
require_once (ICY_FILEPATH . '/customizer/customizer.php' );
require_once (ICY_FILEPATH . '/functions/class-pixelentity-theme-update.php');
if (icy_woocommerce_enabled()) { require_once(ICY_FILEPATH . '/woocommerce/config.php'); }

/**
 * Auto update setup
 *
 * @uses 	PixelentityThemeUpdate::init
 * @return  void;
 */

$theme_options = thsp_cbp_get_options_values();
// $user = $theme_options['buyer_username'];
// $api = $theme_options['buyer_apikey'];
// PixelentityThemeUpdate::init($user,$api, 'Icy Pixels');

?>