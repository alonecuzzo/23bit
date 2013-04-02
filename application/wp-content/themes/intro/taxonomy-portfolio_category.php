<?php

/**

 * Template Name: Portfolio

 *

 * @package Intro

 * @since Intro 1.0

 */



get_header(); ?>

	

	<section class="heading">

		<div class="holder">

			<h1><?php single_term_title(); ?></h1>

		</div>

	</section>

	<section id="portfolio">

		<div class="holder">

			<div class="wrap">

				<ul id="filtered">

					<?php	

						while ( have_posts() ) : the_post(); 

							$types = wp_get_object_terms( $post->ID, 'portfolio_category' );

					?>

					<li class="filter-<?php echo isset ( $types[0] ) ? esc_attr( $types[0]->slug ) : ''; ?>">

						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'intro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">

							<?php the_post_thumbnail( 'portfolio-outside' ); ?>

							<span class="mask"><span class="iconic <?php intro_format_icon(); ?>"></span></span>

						</a>

						<span><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'intro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></span>

					</li>

					<?php endwhile; ?>

				</ul>

			</div>

		</div>

	</section>

	

<?php get_footer(); ?>