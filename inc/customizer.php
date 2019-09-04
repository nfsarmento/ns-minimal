<?php
/**
 * NS Minimal Theme Customizer
 *
 * @package ns-minimal
 * @since ns-minimal 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'ns_minimal_customize_register' ) ) :
function ns_minimal_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'ns_minimal_customize_register' );
endif;
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'ns_minimal_customize_preview_js' ) ) :
function ns_minimal_customize_preview_js() {
	wp_enqueue_script( 'ns_minimal_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'ns_minimal_customize_preview_js' );
endif;
/*
 * Customize Sanitization
 */
// Sanitize Select
if ( ! function_exists( 'ns_minimal_sanitize_select' ) ) :
function ns_minimal_sanitize_select( $input, $setting ){

    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible select options
    $choices = $setting->manager->get_control( $setting->id )->choices;

    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}
endif;
/**
 * Customizer
 *
 * @since ns-minimal 1.0.0
 */
if ( ! function_exists( 'ns_minimal_theme_customizer' ) ) :
function ns_minimal_theme_customizer( $wp_customize ) {

    /*--------------------------------------------------------------
        # PANELS
    --------------------------------------------------------------*/
    // START HERE
    $wp_customize->add_panel( 'ns_minimal_start_here_panel', array(
        'title' => __('Theme options', 'ns-minimal'),
        'description' => __('Set colors, menus, widgets, header and css.', 'ns-minimal'),
        'priority' => 10,
    ) );

    // BACKGROUND
    $wp_customize->add_panel( 'ns_minimal_background_panel', array(
        'title' => __('Background', 'ns-minimal'),
        'description' => __('Background Color and Image.', 'ns-minimal'),
        'priority' => 20,
    ) );

    // HEADER
    $wp_customize->add_panel( 'ns_minimal_header_panel', array(
        'title' => __('Header', 'ns-minimal'),
        'description' => __('You can customize the header style.', 'ns-minimal'),
        'priority' => 40,
    ) );

    // HOME PAGE
    $wp_customize->add_panel( 'ns_minimal_home_panel', array(
        'title' => __('Home Page', 'ns-minimal'),
        'description' => __('Custom Meta Slider, Promo Box and Static Front Page', 'ns-minimal'),
        'priority' => 50,
    ) );

    // FOOTER
    $wp_customize->add_panel( 'ns_minimal_footer_panel', array(
        'title' => __('Footer', 'ns-minimal'),
        'description' => __('You can customize the Footer.', 'ns-minimal'),
        'priority' => 80,
    ) );

    /*--------------------------------------------------------------
        # SECTIONS
    --------------------------------------------------------------*/
	// START HERE: Social icons style
	$wp_customize->add_section( 'ns_minimal_social_icons_section' , array(
	    'title' => __( 'Social Icons Style', 'ns-minimal' ),
	    'description' => __('It changes the color of the social icons widget', 'ns-minimal'),
	    'priority' => 20,
	    'panel' => 'ns_minimal_start_here_panel',
	) );

	// START HERE: Colors
    $wp_customize->add_section( 'ns_minimal_colors' , array(
        'title'     => __('Colors', 'ns-minimal'),
        'priority'  => 30,
        'panel' => 'ns_minimal_start_here_panel',
    ));

    // BACKGROUND: Background Color
    $wp_customize->add_section( 'colors' , array(
        'title' => __('Background Color', 'ns-minimal'),
        'priority'  => 10,
        'panel' => 'ns_minimal_background_panel',
    ));

    // BACKGROUND: Background Image
    $wp_customize->add_section( 'background_image' , array(
        'title' => __('Background Image', 'ns-minimal'),
        'priority'  => 20,
        'panel' => 'ns_minimal_background_panel',
    ));

    // HEADER: Move Site Identity to Header Panel
    $wp_customize->add_section( 'title_tagline' , array(
        'title'     => __('Site Identity', 'ns-minimal'),
        'priority'  => 10,
        'panel' => 'ns_minimal_header_panel',
    ));

    // HEADER: Move Header Image to Header Panel
    $wp_customize->add_section( 'header_image' , array(
        'title'     => __('Header Image', 'ns-minimal'),
        'priority'  => 30,
        'panel' => 'ns_minimal_header_panel',
    ));

    // HOME PAGE: Move Static Front Page to Home Panel
    $wp_customize->add_section( 'static_front_page' , array(
        'title'     => __('Static Front Page', 'ns-minimal'),
        'priority'  => 30,
        'panel' => 'ns_minimal_home_panel',
    ));

    /*--------------------------------------------------------------
        # OPTIONS
    --------------------------------------------------------------*/
	// START HERE > SOCIAL ICONS STYLE: bg color
    $wp_customize->add_setting( 'ns_minimal_social_icons_bg_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_social_icons_bg_color', array(
		'label' => __( 'Background Color', 'ns-minimal' ),
		'priority' => 10,
		'section' => 'ns_minimal_social_icons_section',
		'settings' => 'ns_minimal_social_icons_bg_color',
	) ) );

	// START HERE > SOCIAL ICONS STYLE: color
    $wp_customize->add_setting( 'ns_minimal_social_icons_color', array(
        'default' => '#ffffff',
       	'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_social_icons_color', array(
		'label' => __( 'Icon Color', 'ns-minimal' ),
		'priority' => 20,
		'section' => 'ns_minimal_social_icons_section',
		'settings' => 'ns_minimal_social_icons_color',
	) ) );

	// START HERE > SOCIAL ICONS STYLE: circle or square
	$wp_customize->add_setting('ns_minimal_social_icons_border_radius', array(
		'default' => '50%',
		'sanitize_callback' => 'ns_minimal_sanitize_select',
	));

	$wp_customize->add_control('ns_minimal_social_icons_border_radius', array(
		'label' => __('Circle or Square', 'ns-minimal'),
		'priority' => 30,
		'section' => 'ns_minimal_social_icons_section',
		'settings' => 'ns_minimal_social_icons_border_radius',
		'type' => 'select',
		'choices' => array(
			'0' => 'Square',
			'50%' => 'Circle',
		),
	));

	// START HERE > COLORS: Header Title Color
    $wp_customize->add_setting( 'ns_minimal_header_title_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_header_title_color', array(
		'label' => __( 'Header Title', 'ns-minimal' ),
		'priority' => 20,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_header_title_color',
	) ) );

	// START HERE > COLORS: Top Menu Background Color
    $wp_customize->add_setting( 'ns_minimal_top_menu_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_top_menu_bg_color', array(
		'label' => __( 'Top Menu Background', 'ns-minimal' ),
		'priority' => 40,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_top_menu_bg_color',
	) ) );

	// START HERE > COLORS: Top Menu Link Color
    $wp_customize->add_setting( 'ns_minimal_top_menu_link_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_top_menu_link_color', array(
		'label' => __( 'Top Menu Link', 'ns-minimal' ),
		'priority' => 50,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_top_menu_link_color',
	) ) );

	// START HERE > COLORS: Top Menu Link Hover Color
    $wp_customize->add_setting( 'ns_minimal_top_menu_link_hover_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_top_menu_link_hover_color', array(
		'label' => __( 'Top Menu Link Hover', 'ns-minimal' ),
		'priority' => 60,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_top_menu_link_hover_color',
	) ) );

	// START HERE > COLORS: Main Menu Background Color
    $wp_customize->add_setting( 'ns_minimal_main_menu_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_main_menu_bg_color', array(
		'label' => __( 'Main Menu Background', 'ns-minimal' ),
		'priority' => 80,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_main_menu_bg_color',
	) ) );

	// START HERE > COLORS: Main Menu Link Color
    $wp_customize->add_setting( 'ns_minimal_main_menu_link_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_main_menu_link_color', array(
		'label' => __( 'Main Menu Link', 'ns-minimal' ),
		'priority' => 90,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_main_menu_link_color',
	) ) );

	// START HERE > COLORS: Main Menu Link Hover Color
    $wp_customize->add_setting( 'ns_minimal_main_menu_link_hover_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_main_menu_link_hover_color', array(
		'label' => __( 'Main Menu Link Hover', 'ns-minimal' ),
		'priority' => 100,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_main_menu_link_hover_color',
	) ) );

	// START HERE > COLORS: Sub Main Menu Background Color
    $wp_customize->add_setting( 'ns_minimal_sub_main_menu_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_sub_main_menu_bg_color', array(
		'label' => __( 'Sub Main Menu Background', 'ns-minimal' ),
		'priority' => 110,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_sub_main_menu_bg_color',
	) ) );

	// START HERE > COLORS: Body Font Color
    $wp_customize->add_setting( 'ns_minimal_body_color', array(
        'default' => '#666666',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_body_color', array(
		'label' => __( 'Body Font', 'ns-minimal' ),
		'priority' => 120,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_body_color',
	) ) );

	// START HERE > COLORS: Headings Font Color
    $wp_customize->add_setting( 'ns_minimal_heading_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_heading_color', array(
		'label' => __( 'Headings Font', 'ns-minimal' ),
		'priority' => 130,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_heading_color',
	) ) );

	// START HERE > COLORS: Link Color
    $wp_customize->add_setting( 'ns_minimal_link_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_link_color', array(
		'label' => __( 'Link', 'ns-minimal' ),
		'priority' => 140,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_link_color',
	) ) );

	// START HERE > COLORS: Link Hover Color
    $wp_customize->add_setting( 'ns_minimal_hover_color', array(
        'default' => '#666666',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_hover_color', array(
		'label' => __( 'Link Hover', 'ns-minimal' ),
		'priority' => 150,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_hover_color',
	) ) );

	// START HERE > COLORS: Post Title Link Color
    $wp_customize->add_setting( 'ns_minimal_post_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_post_color', array(
		'label' => __( 'Post Title', 'ns-minimal' ),
		'priority' => 160,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_post_color',
	) ) );

	// START HERE > COLORS: Post Title Link Hover Color
    $wp_customize->add_setting( 'ns_minimal_post_hover_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_post_hover_color', array(
		'label' => __( 'Post Title Hover', 'ns-minimal' ),
		'priority' => 170,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_post_hover_color',
	) ) );

	// START HERE > COLORS: Widget Background Color
    $wp_customize->add_setting( 'ns_minimal_widget_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_widget_bg_color', array(
		'label' => __( 'Widget Background', 'ns-minimal' ),
		'priority' => 180,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_widget_bg_color',
	) ) );

	// START HERE > COLORS: Widget Title Color
    $wp_customize->add_setting( 'ns_minimal_widget_title_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_widget_title_color', array(
		'label' => __( 'Widget Title', 'ns-minimal' ),
		'priority' => 190,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_widget_title_color',
	) ) );

	// START HERE > COLORS: Blockquote Color
    $wp_customize->add_setting( 'ns_minimal_blockquote_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_blockquote_color', array(
		'label' => __( 'Blockquote', 'ns-minimal' ),
		'priority' => 210,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_blockquote_color',
	) ) );

	// START HERE > COLORS: Button Color
    $wp_customize->add_setting( 'ns_minimal_button_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_button_color', array(
		'label' => __( 'Button', 'ns-minimal' ),
		'priority' => 220,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_button_color',
	) ) );

	// START HERE > COLORS: Button Text Color
    $wp_customize->add_setting( 'ns_minimal_button_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_button_text_color', array(
		'label' => __( 'Button Text', 'ns-minimal' ),
		'priority' => 230,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_button_text_color',
	) ) );

	// START HERE > COLORS: Pagination Current Color
    $wp_customize->add_setting( 'ns_minimal_pagination_current_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_pagination_current_color', array(
		'label' => __( 'Pagination Current', 'ns-minimal' ),
		'priority' => 240,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_pagination_current_color',
	) ) );

	// START HERE > COLORS: Pagination Next Color
    $wp_customize->add_setting( 'ns_minimal_pagination_next_color', array(
        'default' => '#cccccc',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_pagination_next_color', array(
		'label' => __( 'Pagination Next', 'ns-minimal' ),
		'priority' => 250,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_pagination_next_color',
	) ) );

	// START HERE > COLORS: Pagination Text Color
    $wp_customize->add_setting( 'ns_minimal_pagination_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_pagination_text_color', array(
		'label' => __( 'Pagination Text', 'ns-minimal' ),
		'priority' => 260,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_pagination_text_color',
	) ) );

	// START HERE > COLORS: Footer Background Color
    $wp_customize->add_setting( 'ns_minimal_footer_bg_color', array(
        'default' => '#eeeeee',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_footer_bg_color', array(
		'label' => __( 'Footer Background', 'ns-minimal' ),
		'priority' => 290,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_footer_bg_color',
	) ) );

	// START HERE > COLORS: Footer Text Color
    $wp_customize->add_setting( 'ns_minimal_footer_text_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_footer_text_color', array(
		'label' => __( 'Footer Text', 'ns-minimal' ),
		'priority' => 300,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_footer_text_color',
	) ) );

	// START HERE > COLORS: Footer Link Color
    $wp_customize->add_setting( 'ns_minimal_footer_link_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_footer_link_color', array(
		'label' => __( 'Footer Link', 'ns-minimal' ),
		'priority' => 310,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_footer_link_color',
	) ) );

	// START HERE > COLORS: Footer Widget Background Color
    $wp_customize->add_setting( 'ns_minimal_footer_widget_bg_color', array(
        'default' => '#eeeeee',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_footer_widget_bg_color', array(
		'label' => __( 'Footer Widget Background', 'ns-minimal' ),
		'priority' => 320,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_footer_widget_bg_color',
	) ) );

	// START HERE > COLORS: Footer Widget Title Color
    $wp_customize->add_setting( 'ns_minimal_footer_widget_title_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_footer_widget_title_color', array(
		'label' => __( 'Footer Widget Title', 'ns-minimal' ),
		'priority' => 330,
		'section' => 'ns_minimal_colors',
		'settings' => 'ns_minimal_footer_widget_title_color',
	) ) );

	// BACKGROUND > BACKGROUND COLOR: Header bg
    $wp_customize->add_setting( 'ns_minimal_header_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control ( $wp_customize, 'ns_minimal_header_bg_color', array(
		'label' => __( 'Header Background', 'ns-minimal' ),
		'priority' => 10,
		'section' => 'colors',
		'settings' => 'ns_minimal_header_bg_color',
	) ) );

	// BACKGROUND > BACKGROUND COLOR: Box Color
    $wp_customize->add_setting( 'ns_minimal_box_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ns_minimal_box_color', array(
		'label' => __( 'Box Color', 'ns-minimal' ),
		'section' => 'colors',
		'settings' => 'ns_minimal_box_color',
	) ) );
}
add_action('customize_register', 'ns_minimal_theme_customizer');
endif;

/**
 * Customizer Apply Style
 *
 * @since ns-minimal 1.0.0
 */
if ( ! function_exists( 'ns_minimal_apply_style' ) ) :

  	function ns_minimal_apply_style() {
		if ( get_theme_mod('ns_minimal_header_bg_color') ||
			 get_theme_mod('ns_minimal_box_color') ||
			 get_theme_mod('ns_minimal_header_title_color') ||
			 get_theme_mod('ns_minimal_top_menu_bg_color') ||
			 get_theme_mod('ns_minimal_top_menu_link_color') ||
			 get_theme_mod('ns_minimal_top_menu_link_hover_color') ||
			 get_theme_mod('ns_minimal_main_menu_bg_color') ||
			 get_theme_mod('ns_minimal_main_menu_link_color') ||
			 get_theme_mod('ns_minimal_main_menu_link_hover_color') ||
			 get_theme_mod('ns_minimal_sub_main_menu_bg_color') ||
			 get_theme_mod('ns_minimal_body_color') ||
			 get_theme_mod('ns_minimal_heading_color') ||
			 get_theme_mod('ns_minimal_link_color') ||
			 get_theme_mod('ns_minimal_hover_color') ||
			 get_theme_mod('ns_minimal_post_color') ||
			 get_theme_mod('ns_minimal_post_hover_color') ||
			 get_theme_mod('ns_minimal_widget_bg_color') ||
			 get_theme_mod('ns_minimal_widget_title_color') ||
			 get_theme_mod('ns_minimal_social_icons_bg_color') ||
			 get_theme_mod('ns_minimal_social_icons_color') ||
			 get_theme_mod('ns_minimal_social_icons_border_radius') ||
			 get_theme_mod('ns_minimal_blockquote_color') ||
			 get_theme_mod('ns_minimal_button_color') ||
			 get_theme_mod('ns_minimal_button_text_color') ||
			 get_theme_mod('ns_minimal_pagination_current_color') ||
			 get_theme_mod('ns_minimal_pagination_next_color') ||
			 get_theme_mod('ns_minimal_pagination_text_color') ||
			 get_theme_mod('ns_minimal_footer_bg_color') ||
			 get_theme_mod('ns_minimal_footer_text_color') ||
			 get_theme_mod('ns_minimal_footer_link_color') ||
			 get_theme_mod('ns_minimal_footer_widget_bg_color') ||
			 get_theme_mod('ns_minimal_footer_widget_title_color')
		) {
		?>
			<style id="biscuit-style-settings">
				<?php if ( get_theme_mod('ns_minimal_header_bg_color') ) : ?>
					.site-header {
						background-color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_header_bg_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_box_color') ) : ?>
					.site-content { background-color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_box_color', '#ffffff' ) ); ?>; }
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_header_title_color') ) : ?>
					.site-title a {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_header_title_color' ) );  ?> !important;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_top_menu_bg_color') ) : ?>
					#top-navigation {
						background-color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_top_menu_bg_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_top_menu_link_color') ) : ?>
					#top-navigation a,
					#top-navigation a:visited,
					#top-navigation .menu-toggle {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_top_menu_link_color' ) );  ?>;
						text-decoration: none;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_top_menu_link_hover_color') ) : ?>
					#top-navigation a:hover,
					#top-navigation button.menu-toggle a:hover {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_top_menu_link_hover_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_main_menu_bg_color') ) : ?>
					#site-navigation {
						background-color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_main_menu_bg_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_main_menu_link_color') ) : ?>
					#site-navigation a,
					#site-navigation a:visited,
					#site-navigation .menu-toggle {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_main_menu_link_color' ) );  ?>;
						text-decoration: none;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_main_menu_link_hover_color') ) : ?>
					#site-navigation a:hover,
					#site-navigation button.menu-toggle a:hover {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_main_menu_link_hover_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_sub_main_menu_bg_color') ) : ?>
					#site-navigation ul ul {
						background-color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_sub_main_menu_bg_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_body_color') ) : ?>
					body,
					button,
					input,
					select,
					textarea {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_body_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_heading_color') ) : ?>
					h1, h2, h3, h4, h5, h6 {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_heading_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_link_color') ) : ?>
					a,
					a:visited {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_link_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_hover_color') ) : ?>
					a:hover,
					a:focus,
					a:active {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_hover_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_post_color') ) : ?>
					.entry-title,
					.entry-title a {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_post_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_post_hover_color') ) : ?>
					.entry-title a:hover {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_post_hover_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_widget_bg_color') ) : ?>
					.widget-title {
						background-color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_widget_bg_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_widget_title_color') ) : ?>
					.widget-title {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_widget_title_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_social_icons_bg_color') ) : ?>
					.social,
					.social-icomoon {
						background-color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_social_icons_bg_color', '#000000' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_social_icons_color') ) : ?>
					.social:before,
					.social-icomoon:before {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_social_icons_color', '#ffffff' ) ); ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_social_icons_border_radius') ) : ?>
				.social,
				.social-icomoon {
					border-radius: <?php echo esc_attr( get_theme_mod( 'ns_minimal_social_icons_border_radius', '0' ) ); ?>;
				}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_blockquote_color') ) : ?>
					blockquote {
						border-left: 5px solid <?php echo esc_attr( get_theme_mod( 'ns_minimal_blockquote_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_button_color') || get_theme_mod('ns_minimal_button_text_color') ) : ?>
					button,
					input[type="button"],
					input[type="reset"],
					input[type="submit"] {
						border: 1px solid <?php echo esc_attr( get_theme_mod( 'ns_minimal_button_color' ) );  ?>;
						background: <?php echo esc_attr( get_theme_mod( 'ns_minimal_button_color' ) );  ?>;
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_button_text_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_pagination_current_color') ) : ?>
					.pagination a:hover,
					.pagination .current {
						background: <?php echo esc_attr( get_theme_mod( 'ns_minimal_pagination_current_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_pagination_next_color') ) : ?>
					.pagination a {
						background: <?php echo esc_attr( get_theme_mod( 'ns_minimal_pagination_next_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_pagination_text_color') ) : ?>
					.pagination a:hover,
					.pagination .current,
					.pagination a {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_pagination_text_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_footer_bg_color') ) : ?>
					.site-footer {
						background-color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_footer_bg_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_footer_text_color') ) : ?>
					.site-info {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_footer_text_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_footer_link_color') ) : ?>
					.site-info a {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_footer_link_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_footer_widget_bg_color') ) : ?>
					.site-footer .widget-title {
						background-color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_footer_widget_bg_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('ns_minimal_footer_widget_title_color') ) : ?>
					.site-footer .widget-title {
						color: <?php echo esc_attr( get_theme_mod( 'ns_minimal_footer_widget_title_color' ) );  ?>;
					}
				<?php endif; ?>
			</style>
		<?php
    }
}
endif;
add_action( 'wp_head', 'ns_minimal_apply_style' );
