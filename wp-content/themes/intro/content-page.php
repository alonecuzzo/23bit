<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Intro
 * @since Intro 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post' ); ?>>
	<?php if ( ! is_page_template( 'templates/page-template-full-width.php' ) ) : ?>
	<p class="meta"><?php intro_posted_on(); ?> | <?php comments_popup_link( __( '<span>0</span> Comments', 'intro' ), __( '<span>1</span> Comment', 'intro' ), __( '<span>%</span> Comments', 'intro' ) ); ?></p>
	<?php endif; ?>
	
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="image">
		<?php the_post_thumbnail( 'blog-inside' ); ?>
	</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content( '' ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'intro' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
</article>
