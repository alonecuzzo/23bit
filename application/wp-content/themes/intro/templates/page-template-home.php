<?php
/**
 * Template Name: Home
 *
 * @package Intro
 * @since Intro 1.0
 */

get_header(); ?>

<section class="slideshow">
	<?php
		$slideshow_args = array(
			'post_type' => 'post',
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'portfolio_category',
					'field'    => 'id',
					'terms'    => array( intro_get_theme_option( 'featured_category' ) ),
					'operator' => 'IN'
				),
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => array( 'post-format-video', 'post-format-gallery' ),
					'operator' => 'IN'
				)
			)
		);
	
		$slideshow = new WP_Query( apply_filters( 'intro_slideshow_args', $slideshow_args ) );

		if ( $slideshow->have_posts() ) :
	?>
	<ul class="gallery">
		<?php while ( $slideshow->have_posts() ) : $slideshow->the_post(); ?>
		<li>
			<div class="w1">
				<div class="w2">
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'intro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						<?php the_post_thumbnail( 'feature-slider' ); ?>
					</a>
					<?php if ( intro_get_theme_option( 'featured_show_titles' ) == 'on' ) : ?>
					<div class="description">
						<div class="holder">
							<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'intro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<?php echo wpautop( wp_trim_words( get_the_content(), 8 ) ); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</li>
		<?php endwhile; ?>
	</ul>
	<?php endif; ?>
</section><!-- / slideshow -->

<section class="info">
	<?php
		$news_args = array(
			'posts_per_page' => 3,
			'tax_query'      => array(
				array(
				  'taxonomy' => 'post_format',
				  'field'    => 'slug',
				  'terms'    => array( 'post-format-video', 'post-format-gallery' ),
				  'operator' => 'NOT IN'
				)
			)
		);
		
		$news = new WP_Query( apply_filters( 'latest_news_args', $news_args ) );
		
		if ( $news->have_posts() ) :
	?>
	<div class="box">
		<div class="text">
			<h3><?php _e( 'Latest News.', 'intro' ); ?></h3>
			<?php echo wpautop( intro_get_theme_option( 'news_description' ) ); ?>
			<div class="holder">
				<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn01"><span><?php _e( 'Read More', 'intro' ); ?></span></a>
			</div>
		</div>
		<div class="holder">
			<ul class="list">
				<?php while( $news->have_posts() ) : $news->the_post(); ?>
				<li>
					<div class="ttl">
						<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'intro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<p><?php the_category( ', ' ); ?></p>
					</div>
					<div class="image">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'intro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
							<?php the_post_thumbnail(); ?>
							<span class="mask"><span class="<?php intro_format_icon(); ?>"></span></span>
						</a>
					</div>
				</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
	<?php endif; ?>
	
	<?php
		$project_args = array(
			'posts_per_page' => 6,
			'tax_query'      => array(
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => array( 'post-format-video', 'post-format-gallery' ),
					'operator' => 'IN'
				)
			)
		);
		
		$projects = new WP_Query( apply_filters( 'latest_project_args', $project_args ) );
		$count    = 1;
		
		if ( $projects->have_posts() ) :
	?>
	<div class="box">
		<div class="text">
			<h3><?php _e( 'Our Latest Projects.', 'intro' ); ?></h3>
			<?php echo wpautop( intro_get_theme_option( 'project_description' ) ); ?>
			<?php if ( intro_find_portfolio_page() ) : ?>
			<div class="holder">
				<a href="<?php echo esc_url( get_permalink( intro_find_portfolio_page() ) ); ?>" class="btn01"><span><?php _e( 'See More', 'intro' ); ?></span></a>
			</div>
			<?php endif; ?>
		</div>
		<div class="holder">
			<ul class="list">
				<?php while( $projects->have_posts() ) : $projects->the_post(); ?>
				<li>
					<div class="ttl">
						<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'intro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<p><?php echo get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' ); ?></p>
					</div>
					<div class="image">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'intro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
							<?php the_post_thumbnail(); ?>
							<span class="mask"><span class="<?php intro_format_icon(); ?>"></span></span>
						</a>
					</div>
					<?php echo wpautop( wp_trim_words( get_the_content(), 17 ) ); ?>
				</li>
				<?php if ( $count % 3 == 0 & $count > 2 ) : ?><li class="divider"></li><?php endif; ?>
				<?php $count++; endwhile; ?>
			</ul>
		</div>
	</div>
	<?php endif; ?>
</section><!-- / info -->

<?php get_footer(); ?>