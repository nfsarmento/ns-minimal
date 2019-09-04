<?php
/**
 * The template used for displaying single post
 *
 * @package ns-minimal
 * @since ns-minimal 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php
			ns_minimal_posted_on();
			?>
		</div><!-- .entry-meta -->

		<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ns-minimal' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php ns_minimal_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
