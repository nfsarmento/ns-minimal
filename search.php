<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package ns-minimal
 * @since ns-minimal 1.0.0
 */

get_header(); ?>

	<section id="primary" class="content-area column three-fourths">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h3 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'ns-minimal' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h3>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php ns_minimal_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
