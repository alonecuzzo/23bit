<?php
/**
 * Template Name: Full Width
 *
 * @package Intro
 * @since Intro 1.0
 */

get_header(); ?>
	
	<section class="heading">
		<div class="holder">
			<h1><?php the_title(); ?></h1>
		</div>
	</section>
	<div id="main">
		<?php while( have_posts() ) : the_post(); ?>
			<?php 
				get_template_part( 'content', 'page' ); 
				
				comments_template( '', true );
			?>
		<?php endwhile; ?>
	</div><!-- / main -->
	
<?php get_footer(); ?>