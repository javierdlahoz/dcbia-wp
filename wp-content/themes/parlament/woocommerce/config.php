<?php

/**
 * WooCommerce compatibility
 *
 * @package     Icy Framework
 * @copyright   Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author      Paul Roman
 *
 * @since       Icy Framework 1.0
 */

/**
 * Disable default WooCommerce styling by checking WooCommerce version
 *          
 */

if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	define( 'WOOCOMMERCE_USE_CSS', false );
}

/**
 * Enqueue our own styles and javascript for WooCommerce pages
 *          
 * @uses wp_register_style();
 *
 */

function wp_enqueue_woocommerce_style(){
    wp_register_style( 'woocommerce', get_template_directory_uri() . '/woocommerce/css/woocommerce.css' );
	if ( class_exists( 'woocommerce' ) ) {
		wp_enqueue_style( 'woocommerce' );
	}

	wp_register_script( 'woocommerce-js', get_template_directory_uri() . '/woocommerce/js/woocommerce.custom.min.js', 'jquery');
	wp_enqueue_script('woocommerce-js');
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );


/**
 * Change default thumbnail sizes for WooCommerce pages. Also adding theme support for WooCommerce.
 *          
 * @uses add_theme_support();
 *
 */

if (function_exists('add_theme_support')) {
	add_theme_support('woocommerce'); 
	
	$shop_thumbnail = array('width' => 120,'height' => 120,'crop' => 1);
	$shop_catalog = array('width' => 450,'height' => 450,'crop' => 1);
	$shop_single = array('width' => 450,'height' => 999,'crop' => 0);

	update_option('shop_thumbnail_image_size', $shop_thumbnail);
	update_option('shop_catalog_image_size', $shop_catalog);
	update_option('shop_single_image_size', $shop_single);
}

/**
 * Remove Page Title
 *          
 * @since 1.1
 *
 */

function override_page_title() {
	return false;
}

/**
 * Removing default actions in WooCommerce and replacing those with my own.
 *          
 * @uses actions
 *
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

add_action('woocommerce_before_main_content', 'icy_start_woocommerce', 10);
add_action('woocommerce_after_main_content', 'icy_end_woocommerce', 10);
add_action('woocommerce_after_shop_loop', 'icy_after_shop_loop', 10);
add_filter('woocommerce_show_page_title', 'override_page_title');
//add_filter('woocommerce_show_page_title',false); // Disable Page Title LEGACY


/**
 * Change number of products shown per shop page
 *          
 * @uses $icy_options;
 * @return int
 *
 */

function icy_woocommerce_products_per_page(){
	return 9;
}

/**
 * Wrap content to fit the theme
 *          
 * @return void
 *
 */

function icy_start_woocommerce() {
	$output = '';

	$output .= '<section class="row-fluid main-container">';	
		$output .= '<section class="wrapper primary">';		
			$output .= '<section class="span8 content">';

	echo $output;
}

/**
 * Wrap content to fit the theme
 *          
 * @return void
 *
 */

function icy_end_woocommerce() {
	$output = '';

	
			$output .= '</section><!-- END content -->';    			

	echo $output;
}

/**
 * Wrap content to fit the theme
 *          
 * @return void
 *
 */

function icy_after_shop_loop()
{
		echo '</section><!--END shop content -->';
			
	echo '<!--START sidebar-->';
		do_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
	echo '<!--END sidebar-->';

	$output .= '</section><!--END wrapper -->';
		
}
// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', 'icy_woocommerce_products_per_page', 20 );


/**
 * Add the WooCommerce Cart Dropdown functionality
 *          
 * @return void
 *
 */

add_action( 'icy_main_header', 'icy_woocommerce_cart_dropdown', 10);

function icy_woocommerce_cart_dropdown()
{
	global $woocommerce;
	$cart_subtotal = $woocommerce->cart->get_cart_subtotal();
	$link = $woocommerce->cart->get_cart_url();


	$output = "";
	$output .= "<ul class='icy_cart_dropdown' data-success='".__('was added to the cart', 'framework')."'><li class='cart_dropdown_first'>";
		$output .= "<a class='cart_dropdown_link' href='".$link."'><i class='fa fa-shopping-cart'></i><span class='cart_subtotal'>".$cart_subtotal."</span></a>";
		$output .= "<div class='dropdown_widget dropdown_widget_cart'>";
			$output .= '<div class="widget_shopping_cart_content"></div>';
		$output .= "</div>";
	$output .= "</li></ul>";

	echo $output;
}

?>