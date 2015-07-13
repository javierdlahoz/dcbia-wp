<?php

/**
 * Get Theme Customizer Fields
 *
 * @package		Theme_Customizer_Boilerplate
 * @copyright	Copyright (c) 2013, Slobodan Manic
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Slobodan Manic
 *
 * @since		Theme_Customizer_Boilerplate 1.0
 */


/**
 * Helper function that holds array of theme options.
 *
 * @return	array	$options	Array of theme options
 * @uses	thsp_get_theme_customizer_fields()	defined in customizer/helpers.php
 */
function thsp_cbp_get_fields() {

	/*
	 * Using helper function to get default required capability
	 */
	$thsp_cbp_capability = thsp_cbp_capability();
	
	$options = array(

		
		// Section ID
		'icy_theme_logo' => array(
			'existing_section' => false,
			'args' => array(
				'title' => __( 'Logo Setup', 'framework' ),
				'description' => __( 'Setup your own logo & favicon for your website.', 'framework' ),
				'priority' => 1
			),
			'fields' => array(
				'logo_type' => array(
					'setting_args' => array(
						'default' => 'text-logo',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Choose a Logo Type', 'framework' ),
						'type' => 'radio',
						'choices' => array(
							'text-logo' => array(
								'label' => __( 'Text', 'framework' )
							),						
							'image-logo' => array(
								'label' => __( 'Custom Image (below)', 'framework' )
							)
						),	
						'priority' => 1,
					)
				),				
				'logo' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo', 'framework' ),
						'type' => 'image', // Image upload field control
						'priority' => 2
					)
				),
				'logo_retina' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo Retina', 'framework' ),
						'type' => 'image', // Image upload field control
						'priority' => 3
					)
				),
				'logo_width' => array(
					'setting_args' => array(
						'default' => '167',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo Width (px)', 'framework' ),
						'type' => 'text', // Image upload field control
						'priority' => 4
					)
				),
				'logo_height' => array(
					'setting_args' => array(
						'default' => '64',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo Height (px)', 'framework' ),
						'type' => 'text', // Image upload field control
						'priority' => 5
					)
				),								
				'favicon' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Favicon', 'framework' ),
						'type' => 'image', // Image upload field control
						'priority' => 6
					)
				),
				'logo_placement' => array(
					'setting_args' => array(
						'default' => 'left-aligned',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo placement', 'framework' ),
						'type' => 'select',
						'choices' => array(
							'left-aligned' => array(
								'label' => __( 'Left Aligned', 'framework' )
							),						
							'right-aligned' => array(
								'label' => __( 'Right Aligned', 'framework' )
							)
						),					
						'priority' => 7
					)
				),

			),
			
		),
		// Section ID
		'icy_theme_settings' => array(
			'existing_section' => false,
			'args' => array(
				'title' => __( 'Theme Settings', 'framework' ),
				'description' => __( 'Theme settings helping you customize your brand new theme and make it your own.', 'framework' ),
				'priority' => 2
			),
			'fields' => array(											
				'smooth_scroll' => array(
					'setting_args' => array(
						'default' => 'true',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Activate Smooth Scrolling', 'framework' ),
						'type' => 'checkbox', // Textarea control
						'priority' => 1
					)
				),
				'donate_active' => array(
					'setting_args' => array(
						'default' => 'true',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Activate Donate Button', 'framework' ),
						'type' => 'checkbox', // Textarea control
						'priority' => 2
					)
				),
				'donate_link' => array(
					'setting_args' => array(
						'default' => 'http://parlament.icypixels.com/',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Donate button URL (include http://)', 'framework' ),
						'type' => 'text', // Textarea control
						'priority' => 3
					)
				),
				'language_switcher' => array(
					'setting_args' => array(
						'default' => 'true',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Activate header language switcher (WPML)', 'framework' ),
						'type' => 'checkbox', // Textarea control
						'priority' => 4
					)
				),
				'footer_copyright' => array(
					'setting_args' => array(
						'default' => 'true',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Display Icy Pixels\'s footer copyright message', 'framework' ),
						'type' => 'checkbox', // Textarea control
						'priority' => 5
					)
				),
				'fixed_hellobar' => array(
					'setting_args' => array(
						'default' => 'fixed-hello',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Fixed hello bar', 'framework' ),
						'type' => 'select',
						'choices' => array(
							'fixed-hello' => array(
								'label' => __( 'Yes', 'framework' )
							),						
							'not-fixed-hello' => array(
								'label' => __( 'No', 'framework' )
							)
						),					
						'priority' => 6
					)
				),
				'fixed_header' => array(
					'setting_args' => array(
						'default' => 'fixed-header',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Fixed header', 'framework' ),
						'type' => 'select',
						'choices' => array(
							'fixed-header' => array(
								'label' => __( 'Yes', 'framework' )
							),						
							'not-fixed-header' => array(
								'label' => __( 'No', 'framework' )
							)
						),					
						'priority' => 7
					)
				),
				'events_title' => array(
					'setting_args' => array(
						'default' => __('Events','framework'),
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Events Page Title', 'framework' ),
						'type' => 'text', // Textarea control
						'priority' => 8
					)
				),
				'custom_css' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Custom CSS', 'framework' ),
						'type' => 'textarea', // Textarea control
						'priority' => 9
					)
				),


			),
			
		),
		// Section ID
		'icy_slider_settings' => array(
			'existing_section' => false,
			'args' => array(
				'title' => __( 'Slider Settings', 'framework' ),
				'description' => __( 'Configure your slider auto-rotation and speed.', 'framework' ),
				'priority' => 3
			),
			'fields' => array(															
				'slideshow_rotate' => array(
					'setting_args' => array(
						'default' => 'false',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Should the slider rotate automatically?', 'framework' ),
						'type' => 'checkbox', // Textarea control
						'priority' => 1
					)
				),
				'slideshow_speed' => array(
					'setting_args' => array(
						'default' => '5000',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Slider Speed', 'framework' ),
						'type' => 'number', // Textarea control
						'priority' => 2
					)
				),				
			),
			
		),
		'colors' => array(
			'existing_section' => true,
			'fields' => array(				
				'primary_accent' => array(
						'setting_args' => array(
							'default' => '#0a9de2',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,					
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Primary accent color', 'framework' ),
							'type' => 'color',							
							'priority' => 1
						)
				),			
				'secondary_accent' => array(
						'setting_args' => array(
							'default' => '#ef3f42',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,					
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Secondary accent color', 'framework' ),
							'type' => 'color',							
							'priority' => 2
						)
				),
				'links_hover' => array(
						'setting_args' => array(
							'default' => '#3b3448',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,					
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Links hover color', 'framework' ),
							'type' => 'color',							
							'priority' => 3
						)
				),		
				'headings_colour' => array(
						'setting_args' => array(
							'default' => '#736c83',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,					
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Headings color', 'framework' ),
							'type' => 'color',							
							'priority' => 4
						)
				),
				'header_color' => array(
						'setting_args' => array(
							'default' => '#16161D',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,					
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Header & Secondary footer background', 'framework' ),
							'type' => 'color',							
							'priority' => 5
						)
				),
				'hello_color' => array(
						'setting_args' => array(
							'default' => '#29262f',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,					
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Hello bar & footer background', 'framework' ),
							'type' => 'color',							
							'priority' => 6
						)
				),
				'footer_color' => array(
						'setting_args' => array(
							'default' => '#697296',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,					
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Footer text color', 'framework' ),
							'type' => 'color',							
							'priority' => 7
						)
				),
				'language_color' => array(
						'setting_args' => array(
							'default' => '#546988',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,					
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Language Bar', 'framework' ),
							'type' => 'color',							
							'priority' => 7
						)
				),
				'cart_color' => array(
						'setting_args' => array(
							'default' => '#bfd74b',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,					
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Shopping Cart', 'framework' ),
							'type' => 'color',							
							'priority' => 7
						)
				),	
				'buddypress_color' => array(
						'setting_args' => array(
							'default' => '#464052',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,					
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'BuddyPress header', 'framework' ),
							'type' => 'color',							
							'priority' => 7
						)
				),														
			)
		)

	);
	
	/* 
	 * 'thsp_cbp_options_array' filter hook will allow you to 
	 * add/remove some of these options from a child theme
	 */
	return apply_filters( 'thsp_cbp_options_array', $options );
	
}