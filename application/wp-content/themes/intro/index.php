<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Intro
 * @since Intro 1.0
 */

get_header(); ?>

	<section class="heading">
		<div class="holder">
			<h1><?php intro_blog_title(); ?></h1>
		</div>
	</section>
	<div id="main">
		<div id="content">
			<?php if ( have_posts() ) : ?>
			
				<div class="posts">
					<?php while( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content' ); ?>
					<?php endwhile; ?>
				</div><!-- / posts -->
				
				<?php intro_paginate_links(); ?>
				
			<?php else : ?>
				
				<?php get_template_part( 'no-results', 'index' ); ?>
			
			<?php endif; ?>
		</div><!-- / content -->
		<?php get_sidebar(); ?>
	</div><!-- / main -->

<?php get_footer(); ?>