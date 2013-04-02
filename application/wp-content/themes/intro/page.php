<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
		<div class="two-columns">
			<div id="content">
				<?php while( have_posts() ) : the_post(); ?>
					<?php 
						get_template_part( 'content', 'page' ); 
						
						comments_template( '', true );
					?>
				<?php endwhile; ?>
			</div><!-- / content -->
			<?php get_sidebar(); ?>
		</div>
	</div><!-- / main -->
	
<?php get_footer(); ?>