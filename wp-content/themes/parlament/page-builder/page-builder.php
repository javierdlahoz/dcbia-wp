<?php
/**
 *	Adds and register blocks for the Aqua Page Builder
 *
 *	@package Parlament
 *
 */


if(class_exists('AQ_Page_Builder')) {
	define('ICY_CUSTOM_DIR', get_template_directory() . '/page-builder/');
	define('ICY_CUSTOM_URI', get_template_directory_uri() . '/page-builder/');
	
	//include the block files
	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-blog-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-bio-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-lightbox-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-events-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-quote-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-slogan-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-image-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-donate-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-contact-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-horizontal-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-slider-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-slider-small-block.php');		
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-carousel-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-skills-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-google-map-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-contact-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-mailchimp-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-sectionstart-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-sectionend-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-video-block.php');
	
	//register the blocks
	aq_register_block('ICY_Horizontal_Block');
	aq_register_block('ICY_Blog_Block');
	aq_register_block('ICY_Lightbox_Block');
	aq_register_block('ICY_Events_Block');
	aq_register_block('ICY_Bio_Block');
	aq_register_block('ICY_Quote_Block');
	aq_register_block('ICY_Contact_Block');
	aq_register_block('ICY_MailChimp_Block');
	aq_register_block('ICY_Googlemap_Block');
	aq_register_block('ICY_Image_Block');
	aq_register_block('ICY_Donate_Block');
	aq_register_block('ICY_Skills_Block');
	aq_register_block('ICY_Slogan_Block');
	aq_register_block('ICY_Slider_Block');
	aq_register_block('ICY_Slider_Normal_Block');	
	aq_register_block('ICY_Carousel_Block');	
	aq_register_block('ICY_SectionSTART_Block');
	aq_register_block('ICY_SectionEND_Block');
	aq_register_block('ICY_Video_Block');

	if(is_admin()) add_action('aq-page-builder-admin-enqueue', 'aqpb_custom_admin_js');
	function aqpb_custom_admin_js() {
		wp_register_style( 'aqpb-custom-admin-css',  ICY_CUSTOM_URI . 'css/aqpb-custom-admin.css', array(), time(), 'all');
		wp_register_script('aqpb-custom-admin-js', ICY_CUSTOM_URI . 'js/aqpb-custom-admin.js', array('jquery', 'aqpb-js'), time(), true);
		
		wp_enqueue_style('aqpb-custom-admin-css');
		wp_enqueue_script('aqpb-custom-admin-js');
	}
		
}

?>
