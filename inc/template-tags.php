<?php
/**
 * Custom template tags for NS Minimal
 *
 * @package ns-minimal
 * @since ns-minimal 1.0.0
 */


/**
 * Prints HTML with meta information for the current post-date/time and author.
 */

if ( ! function_exists( 'ns_minimal_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function ns_minimal_posted_on() {

		// Get the author name; wrap it in a link.
		$byline = sprintf(
			/* translators: %s: post author */
			__( 'by %s', 'ns-minimal' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		// Finally, let's write all of this to the page.
		echo '<span class="posted-on">' . ns_minimal_time_link() . '</span><span class="byline"> ' . $byline . '</span>';// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;


if ( ! function_exists( 'ns_minimal_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function ns_minimal_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
			/* translators: %s: post date */
			__( '<span class="screen-reader-text">Posted on</span> %s', 'ns-minimal' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}
endif;


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if ( ! function_exists( 'ns_minimal_entry_footer' ) ) :
function ns_minimal_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'ns-minimal' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'ns-minimal' ) . '</span>', wp_kses_post( $categories_list ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'ns-minimal' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'ns-minimal' ) . '</span>', wp_kses_post( $tags_list ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'ns-minimal' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'ns-minimal' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;
