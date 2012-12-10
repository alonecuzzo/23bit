<?php
/**
 * The Template for displaying all single posts.
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
	<?php 
		while( have_posts() ) : the_post(); 
			$template = 'single';
			
			if ( in_array( get_post_format(), array( 'video', 'gallery' ) ) )
				$template = 'single-portfolio';
			
			get_template_part( 'content', $template );
			
		endwhile; 
	?>
	
<?php get_footer(); ?>