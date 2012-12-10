<?php
/**
 * @package Intro
 * @since Intro 1.0
 */
?>

<div id="main">
	<div class="two-columns">
		<div id="content">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post' ); ?>>
				<p class="meta"><?php intro_posted_on(); ?> | <?php comments_popup_link( __( '<span>0</span> Comments', 'intro' ), __( '<span>1</span> Comment', 'intro' ), __( '<span>%</span> Comments', 'intro' ) ); ?></p>
				
				<?php if ( intro_has_video() ) : ?>
					<?php intro_the_video(); ?>
				<?php elseif ( has_post_thumbnail() ) : ?>
					<div class="image">
						<?php the_post_thumbnail( 'blog-inside' ); ?>
					</div>
				<?php endif; ?>

				<div class="entry-content">
					<?php the_content( '' ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'intro' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			</article>

			<?php
				if ( comments_open() || '0' != get_comments_number() )
					comments_template( '', true );
			?>
		</div><!-- / content -->
		<?php get_sidebar(); ?>
	</div>
</div><!-- / main -->