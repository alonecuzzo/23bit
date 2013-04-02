<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Intro
 * @since Intro 1.0
 */

get_header(); ?>

	<section class="heading">
		<div class="holder">
			<h1><?php printf( __( 'Search Results for: %s', 'intro' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
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

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>
		</div><!-- / content -->
		<?php get_sidebar(); ?>
	</div><!-- / main -->

<?php get_footer(); ?>