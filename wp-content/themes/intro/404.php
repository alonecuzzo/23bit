<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Intro
 * @since Intro 1.0
 */

get_header(); ?>
	
	<section class="heading">
		<div class="holder">
			<h1><?php _e( 'Oops! That page can&rsquo;t be found.', 'intro' ); ?></h1>
		</div>
	</section>
	<div id="main">
		<div class="two-columns">
			<div id="content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'intro' ); ?></p>

				<?php get_search_form(); ?>
				
				<br />
				
				<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
			</div><!-- / content -->
			<?php get_sidebar(); ?>
		</div>
	</div><!-- / main -->
	
<?php get_footer(); ?>