<?php
/**
 * NS Minimal functions and definitions
 *
 * @package ns-minimal
 * @since ns-minimal 1.0.0
 */
if ( ! function_exists( 'ns_minimal_setup' ) ) :
function ns_minimal_setup() {

	/*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on NS Theme Starter, use a find and replace
   * to change 'ns_theme_starter' to the name of your theme in all the template files.
  */
	load_theme_textdomain( 'ns-minimal', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ns-minimal' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'quote', 'audio' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ns_minimal_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );

	// custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// enable feature custom header
	add_theme_support( 'custom-header' );
}
add_action( 'after_setup_theme', 'ns_minimal_setup' );
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'ns_minimal_content_width' ) ) :
function ns_minimal_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ns_minimal_content_width', 780 );
}
add_action( 'after_setup_theme', 'ns_minimal_content_width', 0 );
endif;

/**
 * Custom Editor Style
 *
 * @since ns-minimal 1.0.0
 */
if ( ! function_exists( 'ns_minimal_add_editor_styles' ) ) :
function ns_minimal_add_editor_styles() {
    add_editor_style( 'css/editor-style.css' );
}
add_action( 'init', 'ns_minimal_add_editor_styles' );
endif;

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
if ( ! function_exists( 'ns_minimal_widgets_init' ) ) :
function ns_minimal_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ns-minimal' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'ns-minimal' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'ns-minimal' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'ns-minimal' ),
		'id'            => 'sidebar-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'ns_minimal_widgets_init' );
endif;

/**
 * Enqueue scripts and styles.
 *
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
 *
 */
if ( ! function_exists( 'ns_minimal_scripts' ) ) :
function ns_minimal_scripts() {
	wp_enqueue_style( 'ns-minimal-style', get_stylesheet_uri() );
  wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_script( 'jquary-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.1' );
	wp_enqueue_script( 'jquery-retina', get_template_directory_uri() . '/js/retina.js', array('jquery'), '1.3.0', true );
	wp_enqueue_script( 'ns-minimal-plugins', get_template_directory_uri() . '/js/plugins.js', array(), '20190606', true );
	wp_enqueue_script( 'ns-minimal-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20190515', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ns_minimal_scripts' );
endif;

/**
 * Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Widgets.
 */
require get_template_directory() . '/inc/widgets.php';


/**
 * Read more link
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_more
 *
 */
if ( ! function_exists( 'ns_minimal_excerpt_more' ) ) :
function ns_minimal_excerpt_more( $more ) {
	if (is_admin()) return $more;
	return '<a class="more-link" href="'. esc_url( get_permalink( get_the_ID() ) ) . '">' . __( 'Read more', 'ns-minimal' ) . '</a>';
}
add_filter( 'excerpt_more', 'ns_minimal_excerpt_more' );
endif;

/**
 * Add to scroll top
 */
if ( ! function_exists( 'ns_minimal_scroll_to_top' ) ) :
function ns_minimal_scroll_to_top() {
	?>
		<a href="#top" class="smoothup" title="<?php echo esc_attr( __( 'Back to top', 'ns-minimal' ) ); ?>"><i class="fa fa-angle-up fa-2x" aria-hidden="true"></i>
		</a>
	<?php
}
add_action('wp_footer', 'ns_minimal_scroll_to_top');
endif;

/**
 * Add Google Fonts URL
 * ref: https://github.com/WordPress/twentyseventeen/blob/master/functions.php#L127
 */
if ( ! function_exists( 'ns_minimal_fonts_url' ) ) :
function ns_minimal_fonts_url() {
	$fonts_url = '';
	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Frankin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$nunito_sans = _x( 'on', 'nunito_sans font: on or off', 'ns-minimal' );
	if ( 'off' !== $nunito_sans ) {
		$font_families = array();
		$font_families[] = 'Nunito Sans:300,400,400i,700,700i';
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Add Google Fonts
 */
if ( ! function_exists( 'ns_minimal_add_google_fonts' ) ) :
function ns_minimal_add_google_fonts() {
		wp_enqueue_style( 'ns-minimal-google-font', ns_minimal_fonts_url(), array(), null );
}
add_action('wp_enqueue_scripts', 'ns_minimal_add_google_fonts');
endif;

/**
 * Registers an editor stylesheet for the current theme.
 */
if ( ! function_exists( 'ns_minimal_theme_add_editor_styles' ) ) :
function ns_minimal_theme_add_editor_styles() {
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Nunito+Sans:300,400,400italic,700,700italic&subset=latin-ext' );
    add_editor_style( $font_url );
}
add_action( 'after_setup_theme', 'ns_minimal_theme_add_editor_styles' );
endif;

/**
 * Posts navigation function
 */
if ( ! function_exists( 'ns_minimal_paging_nav' ) ) :
function ns_minimal_paging_nav() {
	the_posts_pagination(array(
		'prev_text' => '<i class="fa fa-angle-double-left"></i>',
		'next_text' => '<i class="fa fa-angle-double-right"></i>',
		'before_page_number' => '<span class="meta-nav screen-reader-text"></span>'
	));
}
endif;
