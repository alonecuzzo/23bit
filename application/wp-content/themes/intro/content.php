<?php
/**
 * @package Intro
 * @since Intro 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-outside' ); ?>>
	<div class="meta">
		<div class="box">
			<dl>
				<dt><strong><?php _e( 'Posted:', 'intro' ); ?></strong></dt>
				<dd><?php echo get_the_date( str_replace( 'F', 'M', get_option( 'date_format' ) ) ); ?></dd>
			</dl>
		</div>
		<div class="box">
			<strong><?php _e( 'Categories:', 'intro' ); ?></strong>
			<ul>
				<?php the_category(); ?>
			</ul>
		</div>
		<div class="box">
			<strong><?php _e( 'Comments:', 'intro' ); ?></strong>
			<ul>
				<li><?php comments_popup_link( __( '<span>0</span> Comments', 'intro' ), __( '<span>1</span> Comment', 'intro' ), __( '<span>%</span> Comments', 'intro' ) ); ?></li>
			</ul>
		</div>
	</div>
	<div class="block">
		<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'intro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<em class="date"><?php printf( __( '<strong>Posted:</strong> %s', 'intro' ), get_the_date() ); ?></em>
		<div class="image">
			<?php the_post_thumbnail( 'blog-outside' ); ?>
		</div>
		
		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( '' ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
		
		<div class="holder">
			<a href="<?php the_permalink(); ?>#more" class="btn01"><span><?php _e( 'Continue Reading', 'intro' ); ?></span></a>
		</div>
	</div>
</article>