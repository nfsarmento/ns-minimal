<?php
/**
 * The Header for NS Minimal
 *
 * @package ns-minimal
 * @since ns-minimal 1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
  if ( function_exists( 'wp_body_open' ) ) {
      wp_body_open();
  } else {
      do_action( 'wp_body_open' );
  }
?>

<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">

		<div class="container">

      <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ns-minimal' ); ?></a>

			<?php the_custom_logo(); ?>

			<div class="site-branding">
				<?php
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$ns_minimal_description = get_bloginfo( 'description', 'display' );
				if ( $ns_minimal_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo wp_kses_post( $ns_minimal_description ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div>

			<?php if ( get_header_image() ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><div class="header-image" style="background: url('<?php header_image(); ?>') no-repeat center center; height:<?php echo esc_attr( get_custom_header()->height ); ?>px; width: 100%; background-size: cover;">
			</div></a>
			<?php endif; // End header image check. ?>

			<nav id="site-navigation" class="main-navigation" role="navigation">

        <button class="menu-toggle hamburger hamburger--spin" type="button">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
            <p class="hamburger-inner-text"><?php esc_html_e( 'Menu', 'ns-minimal' ); ?></p>
          </span>
        </button>

				<?php wp_nav_menu( array(
          'theme_location' => 'primary',
          'container_class' => 'menu-wrap',
          'menu_id' => 'top-navigation'
        ) ); ?>

			</nav><!-- #site-navigation -->

		</div>

	</header><!-- #masthead -->

	<div class="container">

		<div id="content" class="site-content">
