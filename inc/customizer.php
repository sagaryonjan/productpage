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

	require_once get_template_directory() . '/inc/wp-customize-class.php';

	//General Option
	$wp_customize->add_panel( 'general_panel', array(
		'capability' 		  => 'edit_theme_options',
		//'theme_supports' 	  => '',
		'priority' 			  => 10,
		'title'				  => esc_html__( 'General', 'productpage' ),
	) );

	// Breadcrumbs
	$wp_customize->add_section('productpage_breadcrumbs_activate_settings', array(
			'priority' => 1,
			'title' => __('Activate Breadcrumbs', 'productpage'),
			'panel' => 'general_panel'
	));

	$wp_customize->add_setting('productpage_breadcrumbs_activate', array(
			'default' => 1,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'productpage_checkbox_sanitize'
	));

	$wp_customize->add_control('productpage_breadcrumbs_activate', array(
			'type' => 'checkbox',
			'label' => __('Check to activate breadcrumbs', 'productpage'),
			'section' => 'productpage_breadcrumbs_activate_settings',
			'settings' => 'productpage_breadcrumbs_activate'
	));

	//page background image
	$wp_customize->add_section('productpage_background_image_section', array(
			'priority' => 3,
			'title' => __('Background Image', 'productpage'),
			'panel' => 'general_panel'
	));

	$wp_customize->add_setting('productpage_page_background_image', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'productpage_page_background_image', array(
			'label' => __('Upload background  image for page', 'productpage'),
			'section' => 'productpage_background_image_section',
			'settings' => 'productpage_page_background_image',
	)));


	//post background image
	$wp_customize->add_setting('productpage_post_background_image', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'productpage_post_background_image', array(
			'label' => __('Upload background image for post', 'productpage'),
			'section' => 'productpage_background_image_section',
			'settings' => 'productpage_post_background_image',
	)));
	//default background image
	$wp_customize->add_setting('productpage_default_background_image', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'productpage_default_background_image', array(
			'label' => __('Upload background image for default', 'productpage'),
			'section' => 'productpage_background_image_section',
			'settings' => 'productpage_default_background_image',
	)));

	$wp_customize->add_section( 'productpage_default_sidebar_section', array(
			'priority'             =>  10,
			'title'                =>  esc_html__('Default Sidebar Settings', 'productpage'),
			'panel'                =>  'general_panel'
	) );

	$wp_customize->add_setting( 'productpage_default_sidebar_setting', array(
			'default'              =>  esc_html__('right-sidebar', 'productpage'),
			'capability'           =>  'edit_theme_options',
			'sanitize_callback'    =>  'productpage_sanitize_text'
	) );

	$wp_customize->add_control( new Productpage_Image_Radio_Control($wp_customize, 'productpage_default_sidebar_setting', array(
			'type'                 =>  'radio',
			'label'                =>  esc_html__('Select default layout for default pages.', 'productpage'),
			'section'              =>  'productpage_default_sidebar_section',
			'settings'             =>  'productpage_default_sidebar_setting',
			'choices'              =>  array(
					'right-sidebar'               =>  PRODUCTPAGE_IMAGES_ADMIN_URL . '/right-sidebar.png',
					'left-sidebar'                =>  PRODUCTPAGE_IMAGES_ADMIN_URL . '/left-sidebar.png',
					'no-sidebar-content-centered' =>  PRODUCTPAGE_IMAGES_ADMIN_URL . '/no-sidebar-content-centered-layout.png',
					'no-sidebar-full-width'       =>  PRODUCTPAGE_IMAGES_ADMIN_URL . '/no-sidebar-full-width-layout.png'
			)
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


	//stickey menu
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

	//Front Page
	$wp_customize->add_panel( 'productpage_front_page_option',	array(
			'capabitity'      	   =>  'edit_theme_options',
			'description'    	   =>  esc_html__('Front Page options settings here', 'productpage'),
			'priority' 		 	   =>  20,
			'title' 		 	   =>  esc_html__( 'Front Page', 'productpage' )
	) );

	$wp_customize->add_section( 'productpage_product_banner_section', array(
			'priority'          	 =>  10,
			'title'             	 =>  esc_html__('Product Banner', 'productpage'),
			'panel'             	 =>  'productpage_front_page_option'
	) );

	$wp_customize->add_setting( 'productpage_product_banner_checkbox', array(
			'default' 				 =>  '',
			'capability' 			 =>  'edit_theme_options',
			'sanitize_callback' 	 =>  'productpage_checkbox_sanitize'
	) );

	$wp_customize->add_control( 'productpage_product_banner_checkbox', array(
			'type' 				     =>  'checkbox',
			'label' 			     =>  esc_html__( 'Enable Product Banner', 'productpage' ),
			'settings' 			     =>  'productpage_product_banner_checkbox',
			'section' 			     =>  'productpage_product_banner_section'
	) );

	$wp_customize->add_setting( 'productpage_product_banner_caption', array(
			'default'                =>  'Slider Caption',
			'capability'             =>  'edit_theme_options',
			'sanitize_callback'	     =>  'productpage_sanitize_text'
	) );
	$wp_customize->add_control( 'productpage_product_banner_caption', array(
			'type' 				     =>  'text',
			'label'                  =>  esc_html__('Choose your Cation for Product Banner.', 'productpage'),
			'settings' 			     =>  'productpage_product_banner_caption',
			'section'                =>  'productpage_product_banner_section',
	) );

	$wp_customize->add_setting('productpage_slide',	array(
					'capability'         => 'edit_theme_options',
					'sanitize_callback'  => 'productpage_sanitize_integer'
	) );

	$wp_customize->add_control( 'productpage_slide', array(
					'label'    => esc_html__( 'Slide ' , 'productpage' ),
					'section'  => 'productpage_product_banner_section',
					'setting'  => 'productpage_slide',
					'type'     => 'dropdown-pages',
					'priority' =>  10
	) );


	$wp_customize->add_setting( 'productpage_detail_button', array(
			'default'                =>  'Detail',
			'capability'             =>  'edit_theme_options',
			'sanitize_callback'	     =>  'productpage_sanitize_text'
	) );
	$wp_customize->add_control( 'productpage_detail_button', array(
			'type' 				     =>  'text',
			'label'                  =>  esc_html__('Type to change  button text.', 'productpage'),
			'settings' 			     =>  'productpage_detail_button',
			'section'                =>  'productpage_product_banner_section',
	) );

	$wp_customize->add_setting( 'productpage_buy_now_button', array(
			'default'                =>  'BuY Now',
			'capability'             =>  'edit_theme_options',
			'sanitize_callback'	     =>  'productpage_sanitize_text'
	) );
	$wp_customize->add_control( 'productpage_buy_now_button', array(
			'type' 				     =>  'text',
			'label'                  =>  esc_html__('Type to change the  button text learn more.', 'productpage'),
			'settings' 			     =>  'productpage_buy_now_button',
			'section'                =>  'productpage_product_banner_section',
	) );

	$wp_customize->add_setting( 'productpage_product_banner',array(
			'sanitize_callback'		=>  'esc_attr',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'productpage_product_banner', array(
			'label' 				=>  __('Product Banner ','productpage'),
			'section' 				=>  'productpage_product_banner_section',
			'settings' 				=>  'productpage_product_banner',
			'flex_width'  			=>  false, // Allow any width, making the specified value recommended. False by default.
			'flex_height' 			=>  false, // Require the resulting image to be exactly as tall as the height attribute (default).
	) ) );

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

	//Contact option

	$wp_customize->add_section('productpage_contact_section', array(
			'priority'         => 27,
			'title'            => esc_html__('Contact Us', 'productpage'),
	));

	$wp_customize->add_setting('productpage_contact_title', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control('productpage_contact_title', array(
			'type' => 'text',
			'label' => esc_html__('Contact form title', 'productpage'),
			'section' => 'productpage_contact_section',
			'settings' => 'productpage_contact_title'
	));

	$wp_customize->add_setting('productpage_contact_text', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'productpage_sanitize_text'
	));
	$wp_customize->add_control('productpage_contact_text', array(
			'type' => 'textarea',
			'label' => esc_html__('Choose your Text for Contact.', 'productpage'),
			'settings' => 'productpage_contact_text',
			'section' => 'productpage_contact_section',
	));
	// contact us google map
	$wp_customize->add_setting('productpage_contact_map', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'productpage_sanitize_googlemaps'
	));

	$wp_customize->add_control('productpage_contact_map', array(
			'type' => 'textarea',
			'label' => esc_html__('Contact info Map', 'productpage'),
			'section' => 'productpage_contact_section',
			'settings' => 'productpage_contact_map'
	));
/*	$wp_customize->add_setting('productpage_contact_map', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'productpage_sanitize_text'
	));
	$wp_customize->add_control('productpage_contact_map', array(
			'type' => 'textarea',
			'label' => esc_html__(' Map for Contact.', 'productpage'),
			'settings' => 'productpage_contact_map',
			'section' => 'productpage_contact_section',
	));*/
	$wp_customize->add_setting('productpage_contact_shortcode', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control('productpage_contact_shortcode', array(
			'type' => 'text',
			'label' => esc_html__('Contact form Short code', 'productpage'),
			'section' => 'productpage_contact_section',
			'settings' => 'productpage_contact_shortcode'
	));




	//Accessories option
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

	// Sanitize Integer
	function productpage_sanitize_integer( $input ) {
		if( is_numeric( $input ) ) {
			return intval( $input );
		}
	}

	function productpage_sanitize_googlemaps($input)
	{
		global $productpage_allowedposttags;
		$productpage_allowedposttags_iframe = productpage_map_allowed_tags($productpage_allowedposttags);

		$output = wp_kses( $input, $productpage_allowedposttags_iframe);
		return $output;
	}


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
