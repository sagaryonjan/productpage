<?php
/**
 * ProductPage Theme Customizer.
 *
 * @package ProductPage
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function productpage_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	//General Option
	$wp_customize->add_panel( 'general_panel', array(
		'capability' 		  => 'edit_theme_options',
		//'theme_supports' 	  => '',
		'priority' 			  => 10,
		'title'				  => esc_html__( 'General', 'productpage' ),
	) );

	// logo and site title position options
	$wp_customize->add_setting( 'productpage_header_logo_placement', array(
			'default'              =>  'header_text_only',
			'capability'           =>  'edit_theme_options',
			'sanitize_callback'    =>  'productpage_sanitize_radio'
	) );

	$wp_customize->add_control( 'productpage_header_logo_placement', array(
			'type'                 =>  'radio',
			'priority'             =>  20,
			'label'                =>  esc_html__('Choose the option that you want from below.', 'productpage'),
			'setting'              =>  'productpage_header_logo_placement',
			'section'              =>  'title_tagline',
			'choices'              =>  array(
					'header_logo_only'  =>  esc_html__('Header Logo Only', 'productpage'),
					'header_text_only'  =>  esc_html__('Header Text Only', 'productpage'),
					'show_both'         =>  esc_html__('Show Both', 'productpage'),
					'disable'           =>  esc_html__('Disable', 'productpage')
			) ) );

	// site layout setting
	$wp_customize->add_section( 'productpage_site_layout_section', array(
			'priority'             =>  25,
			'title'                =>  esc_html__( 'Site Layout', 'productpage' ),
			'panel'                =>  'general_panel'
	) );

	$wp_customize->add_setting( 'productpage_site_layout', array(
			'default'               =>  'wide',
			'capability'            =>  'edit_theme_options',
			'sanitize_callback'     =>  'productpage_sanitize_radio'
	) );

	$wp_customize->add_control( 'productpage_site_layout', array(
			'type'                 =>  'radio',
			'priority'             =>  10,
			'label'                =>  esc_html__('Choose your site layout. The change is reflected in whole site.', 'productpage'),
			'section'              =>  'productpage_site_layout_section',
			'setting'              =>  'productpage_site_layout',
			'choices'              =>  array(
					'box'               =>  esc_html__('Boxed layout', 'productpage'),
					'wide'              =>  esc_html__('Wide layout', 'productpage')
			)
	) );

	//header option
	$wp_customize->add_panel( 'productpage_header_option', array(
			'capability' 		  => 'edit_theme_options',
			'priority' 			  => 15,
			'title'				  => esc_html__( 'Header', 'productpage' ),
	) );
	$wp_customize->get_section( 'title_tagline'  )->panel		= 'productpage_header_option';

	$wp_customize->add_section( 'productpage_sticky_menu_section', array(
			'priority'          	 =>  25,
			'title'             	 =>  esc_html__('Sticky Menu', 'productpage'),
			'panel'             	 =>  'productpage_header_option'
	) );

	$wp_customize->add_setting( 'productpage_sticky_menu', array(
		'default' 				 =>  '',
		'capability' 			 =>  'edit_theme_options',
		'sanitize_callback' 	 =>  'productpage_checkbox_sanitize'
	) );
	$wp_customize->add_control( 'productpage_sticky_menu', array(
			'type' 				     =>  'checkbox',
			'label' 			     =>  esc_html__( 'Enable Sticky Menu', 'productpage' ),
			'settings' 			     =>  'productpage_sticky_menu',
			'section' 			     =>  'productpage_sticky_menu_section'
	) );

	$wp_customize->add_section( 'productpage_menu_layout_section', array(
			'priority'          	 =>  30,
			'title'             	 =>  esc_html__('Menu Layout', 'productpage'),
			'panel'             	 =>  'productpage_header_option'
	) );

	$wp_customize->add_setting( 'productpage_menu_layout', array(
			'default'               =>  'side_menu',
			'capability'            =>  'edit_theme_options',
			'sanitize_callback'     =>  'productpage_sanitize_radio'
	) );
	$wp_customize->add_control( 'productpage_menu_layout', array(
			'type'                 =>  'radio',
			'priority'             =>  10,
			'label'                =>  esc_html__('Choose your menu layout. The change is reflected in whole site.', 'productpage'),
			'section'              =>  'productpage_menu_layout_section',
			'setting'              =>  'productpage_menu_layout',
			'choices'              =>  array(
				'side_menu'               =>  esc_html__('Side Menu', 'productpage'),
				'header_menu'              =>  esc_html__('Header Menu', 'productpage')
			)
	) );

	//Footer option
	$wp_customize->add_panel( 'productpage_footer_option',	array(
		'capabitity'      	   =>  'edit_theme_options',
		'description'    	   =>  esc_html__('Footer options settings here', 'productpage'),
		'priority' 		 	   =>  25,
		'title' 		 	   =>  esc_html__( 'Footer', 'productpage' )
	) );

	$wp_customize->add_section( 'productpage_footer_background_color_section', array(
		'priority'          	 =>  10,
		'title'             	 =>  esc_html__('Background Color', 'productpage'),
		'panel'             	 =>  'productpage_footer_option'
	) );

	$wp_customize->add_setting( 'productpage_footer_background_color', array(
			'default' 				 =>  '',
			'capability' 			 =>  'edit_theme_options',
			'sanitize_callback' 	 =>  'productpage_checkbox_sanitize'
	) );
	$wp_customize->add_control( 'productpage_footer_background_color', array(
			'type' 				     =>  'checkbox',
			'label' 			     =>  esc_html__( 'Enable Scroll Top Button', 'productpage' ),
			'settings' 			     =>  'productpage_footer_background_color',
			'section' 			     =>  'productpage_footer_background_color_section'
	) );

	$wp_customize->add_section( 'productpage_footer_scroll_section', array(
		'priority'          	 =>  30,
		'title'             	 =>  esc_html__('Show/Hide Scroll Top Button', 'productpage'),
		'panel'             	 =>  'productpage_footer_option'
	) );

	$wp_customize->add_setting( 'productpage_footer_scroll_checkbox', array(
			'default' 				 =>  '',
			'capability' 			 =>  'edit_theme_options',
			'sanitize_callback' 	 =>  'productpage_checkbox_sanitize'
	) );
	$wp_customize->add_control( 'productpage_footer_scroll_checkbox', array(
			'type' 				     =>  'checkbox',
			'label' 			     =>  esc_html__( 'Enable Scroll Top Button', 'productpage' ),
			'settings' 			     =>  'productpage_footer_scroll_checkbox',
			'section' 			     =>  'productpage_footer_scroll_section'
	) );

	//Supplementary option
	$wp_customize->add_panel( 'productpage_accessories_option',	array(
		'capabitity'      	   =>  'edit_theme_options',
		'description'    	   =>  esc_html__('Accessories options settings here', 'productpage'),
		'priority' 		 	   =>  30,
		'title' 		 	   =>  esc_html__( 'Accessories', 'productpage' )
	) );

	$wp_customize->add_section( 'productpage_accessories_custom_coder_section', array(
		'priority'          	 =>  30,
		'title'             	 =>  esc_html__('Custom Coder', 'productpage'),
		'panel'             	 =>  'productpage_accessories_option'
	) );

	$wp_customize->add_setting( 'productpage_accessories_custom_css_textarea', array(
			'default'                =>  '<style> </style> ',
			'capability'             =>  'edit_theme_options',
			'sanitize_callback'	     =>  'productpage_sanitize_text'
	) );
	$wp_customize->add_control( 'productpage_accessories_custom_css_textarea', array(
			'type' 				     =>  'textarea',
			'label'                  =>  esc_html__('Type your custom css.', 'productpage'),
			'settings' 			     =>  'productpage_accessories_custom_css_textarea',
			'section'                =>  'productpage_accessories_custom_coder_section',
	) );

	$wp_customize->add_setting( 'productpage_accessories_custom_js_textarea', array(
			'default'                =>  '<script> </script>',
			'capability'             =>  'edit_theme_options',
			'sanitize_callback'	     =>  'productpage_sanitize_text'
	) );
	$wp_customize->add_control( 'productpage_accessories_custom_js_textarea', array(
			'type' 				     =>  'textarea',
			'label'                  =>  esc_html__('Type your Custom js.', 'productpage'),
			'settings' 			     =>  'productpage_accessories_custom_js_textarea',
			'section'                =>  'productpage_accessories_custom_coder_section',
	) );




	//sanitize checkbox function
	function productpage_checkbox_sanitize( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}
	// Sanitize Text
	function productpage_sanitize_text( $string ) {
		global $allowedtags;
		return wp_kses( $string , $allowedtags );
	}

	// radio sanitization
	function productpage_sanitize_radio($input, $setting)
	{
		// Ensuring that the input is a slug.
		$input = sanitize_key($input);
		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control($setting->id)->choices;
		// If the input is a valid key, return it, else, return the default.
		return (array_key_exists($input, $choices) ? $input : $setting->default);
	}
}
add_action( 'customize_register', 'productpage_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function productpage_customize_preview_js() {
	wp_enqueue_script( 'productpage_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'productpage_customize_preview_js' );
