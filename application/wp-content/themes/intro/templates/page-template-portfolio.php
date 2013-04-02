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
			<h1><?php echo esc_attr( get_the_title( intro_find_portfolio_page() ) ); ?></h1>
		</div>
	</section>
	<section id="portfolio">
		<div class="holder">
			<?php
				$terms = get_terms( array( 'portfolio_category' ) );
				if ( $terms ) :
			?>
			<div class="filter-list">
				<span><?php _e( 'Filter:', 'intro' ); ?></span> 
				<ul id="filters">
					<li><a href="<?php echo esc_url( get_permalink( intro_find_portfolio_page() ) ); ?>" data-filter="*">All</a></li>
					<?php foreach ( $terms as $term ) : ?>
					<li><a href="<?php echo esc_url( get_term_link( $term, 'portfolio_category' ) ); ?>" data-filter=".filter-<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_attr( $term->name ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<div class="wrap">
				<ul id="filtered">
					<?php	
						$wp_query = new WP_Query( array(
							'post_type'      => 'post',
							'posts_per_page' => -1,
							'tax_query'      => array(
								array(
									'taxonomy' => 'post_format',
									'field'    => 'slug',
									'terms'    => array( 'post-format-video', 'post-format-gallery' ),
									'operator' => 'IN'
								)
							)
						) );
						
						while ( have_posts() ) : the_post(); 
							$types = wp_get_object_terms( $post->ID, 'portfolio_category' );
							$filter = array();
							
							if ( $types ) {
								foreach ( $types as $type ) {
									$filter[] = 'filter-' . $type->slug;
								}
							}
							
							$filters = trim( implode( ' ', $filter ) );
					?>
					<li class="<?php echo $filters; ?>">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'intro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
							<?php the_post_thumbnail( 'portfolio-outside' ); ?>							
							<span class="mask"><span class="<?php intro_format_icon(); ?>"></span></span>
						</a>
						<span><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'intro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></span>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
	</section>
	
<?php get_footer(); ?>