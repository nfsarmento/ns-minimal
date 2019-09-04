<?php
/**
 * Custom Header feature
 *
 * @package ns-minimal
 * @since ns-minimal 1.0.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses ns_minimal_header_style()
 * @uses ns_minimal_admin_header_style()
 * @uses ns_minimal_admin_header_image()
 */
if ( ! function_exists( 'ns_minimal_custom_header_setup' ) ) :
function ns_minimal_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'ns_minimal_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1050,
		'height'                 => 118,
		'flex-height'            => true,
		'wp-head-callback'       => 'ns_minimal_header_style',
		'admin-head-callback'    => 'ns_minimal_admin_header_style',
		'admin-preview-callback' => 'ns_minimal_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'ns_minimal_custom_header_setup' );
endif;

/**
 * Styles the header image and text displayed on the blog.
 *
 * @see test_custom_header_setup().
 */
if ( ! function_exists( 'ns_minimal_header_style' ) ) :
function ns_minimal_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
	// Has the text been hidden?
	if ( ! display_header_text() ) :
		?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
	// If the user has set a custom color for the text use that.
	else :
		?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;

/**
* Styles the header image displayed on the Appearance > Header admin panel.
*
* @see ns_minimal_custom_header_setup().
*/
if ( ! function_exists( 'ns_minimal_admin_header_style' ) ) :
function ns_minimal_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif;

/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see ns_minimal_custom_header_setup().
 */
if ( ! function_exists( 'ns_minimal_admin_header_image' ) ) :
function ns_minimal_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo esc_attr( $style ); ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo esc_attr( $style ); ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif;
