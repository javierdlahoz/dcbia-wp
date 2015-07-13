<?php 

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign

global $meta_boxes;

$meta_boxes = array();

function icy_register_meta_boxes( $meta_boxes )
{

	$prefix = '_icy_';

	$meta_boxes[] = array(	
		'id' => 'icy-meta-video-box',
		'title' => __( 'Video Settings', 'framework' ),
		'desc' => __('Embed a YouTube / Vimeo Code', 'framework'),
		'pages' => array('post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(						
			array(
				'name'             => __( 'Video Embed', 'framework' ),
				'id'               => "{$prefix}video_embed",
				'type'             => 'textarea',			
			),
		),
	);

	$meta_boxes[] = array(	
		'id' => 'icy-meta-gallery-box',
		'title' => __( 'Gallery Settings', 'framework' ),
		'desc' => __('Upload your images to the gallery.', 'framework'),
		'pages' => array('post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(						
			array(
				'name'             => __( 'Select / Upload Photo', 'framework' ),
				'id'               => "{$prefix}gallery_images",
				'type'             => 'image_advanced',			
			),
		),
	);

	$meta_boxes[] = array(	
		'id' => 'icy-meta-lightbox-box',
		'title' => __( 'Lightbox Settings', 'framework' ),
		'desc' => __('Upload your images.', 'framework'),
		'pages' => array('post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(		
			array(
				'name'			   => __('Number of columns', 'framework'),
				'id'			   => "{$prefix}lightbox_columns",
				'type'			   => 'select',
				'options'		   => array(
						'fullwidth' => __('One Column', 'framework'),
						'half' => __('Two Column', 'framework'),
						'third' => __('Three Column', 'framework'),
						'quarter' => __('Four Column', 'framework'),
					),	
				'multiple'		   => false,
				'std'			   => '',
			),				
			array(
				'name'             => __( 'Select / Upload Photo', 'framework' ),
				'id'               => "{$prefix}lightbox_images",
				'type'             => 'image_advanced',			
			),
		),
	);


	// 1st meta box
	$meta_boxes[] = array(	
		'id' => 'icy-type-meta-box',
		'title' => __( 'Hero Section Settings', 'framework' ),	
		'pages' => array( 'page', 'tribe_events', 'post' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(				
			array(
				'name'     => __( 'Choose what to display:', 'framework' ),
				'id'       => "{$prefix}type_select",
				'type'     => 'select',			
				'options'  => array(
					'image' => __( 'Image with Page Title', 'framework' ),
					'only-image' => __('Image only', 'framework'),
					'slider' => __( 'Slider', 'framework' ),				
					'page-title' => __('Page Title Only', 'framework'),
				),			
				'multiple'    => false,
				'std'         => 'page-title',			
			),		

			array(
				'name' => __('Page title', 'framework'),
				'id' => "{$prefix}page_title",
				'type' => 'text',
				'std' => '',
			),

			array(
				'name'			   => __('Page Title Position', 'framework'),
				'id'			   => "{$prefix}pagetitle_position",
				'type'			   => 'select',
				'options'		   => array(
						'left' => __('Left', 'framework'),
						'center' => __('Center', 'framework'),
						'right' => __('Right', 'framework'),						
					),	
				'multiple'		   => false,
				'std'			   => 'left',
			),					

			array(
				'name' =>  __('Page title - text color', 'framework'),
				'desc' => __('Choose a color for the page title text.', 'framework'),
				'id' => "{$prefix}title_color",
				'type' => 'color',			
			),	
			array(
				'name' =>  __('Page title - text background', 'framework'),
				'desc' => __('Choose a background color for the text.', 'framework'),
				'id' => "{$prefix}title_bgcolor",
				'type' => 'color',			
			),		

			array(
				'name'             => __( '(Optional) Hero image', 'framework' ),
				'id'               => "{$prefix}hero_image",
				'desc' 			   => __('Preferred image size is 1920px in width by any height.', 'framework'),
				'type'             => 'image_advanced',	
				'max_file_uploads' => 1,			
			),

			array(
				'name' =>  __('(Optional) Page title - background color', 'framework'),
				'desc' => __('Choose a background color for the wrapper. Overriden if an image is present.', 'framework'),
				'id' => "{$prefix}title_background",
				'type' => 'color',			
			),			

			array(
				'name' =>  __('(Optional) Slider ID', 'framework'),
				'desc' => __('Paste the shortcode ID ONLY from the Page Builder where you have used only a slider. Only works in conjuction with the Slider option in the display settings above.', 'framework'),
				'id' => "{$prefix}slider_shortcode",
				'type' => 'text',
				'std' => ''
			),	
		),
	);

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'icy_register_meta_boxes' );


?>