<?php
/**
 * @package Intro
 * @since Intro 1.0
 */

?>

<div id="main">
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'single-portfolio' ); ?>>
		<div class="intro">
			<?php if ( 'video' == get_post_format() ) : ?>
				<div id="video">
					<?php intro_the_video(); ?>
				</div>
			<?php else : ?>
				<?php
					$gallery = get_children( array(
						'post_parent'    => $post->ID,
						'post_type'      => 'attachment',
						'post_mime_type' => 'image',
						'numberposts'    => -1,
					) );
					
					if ( $gallery ) :
				?>
				<div id="video" class="image slideshow">
					<ul class="gallery">
						<?php foreach ( $gallery as $image ) : ?>
							<li>
								<div class="w1">
									<div class="w2">
										<?php echo wp_get_attachment_link( $image->ID, 'blog-inside' ); ?>
										<?php if ( intro_get_theme_option( 'portfolio_show_titles' ) == 'on' ) : ?>
										<div class="description">
											<div class="holder">
												<h2><a href="<?php echo wp_get_attachment_url( $image->ID ); ?>"><?php echo get_the_title( $image->ID ); ?></a></h2>
												<?php echo wpautop( wp_trim_words( $image->post_excerpt, 8 ) ); ?>
											</div>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
			<?php endif; ?>
			
			<div class="info">
				<h2><?php the_title(); ?></h2>
				<p><?php echo get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' ); ?></p>
				<?php the_content(); ?>
			</div>
		</div>
		<?php
			$project_args = array(
				'posts_per_page' => 8,
				'post__not_in'   => array( $post->ID ),
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
			
			if ( $projects->have_posts() ) :
		?>
		<ul class="list">
			<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
			<li>
				<div class="image">
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'intro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						<?php the_post_thumbnail(); ?>
							<span class="mask"><span class="iconic <?php intro_format_icon(); ?>"></span></span>
					</a>
				</div>
				<?php echo wpautop( wp_trim_words( get_the_content(), 5 ) ); ?>
			</li>
			<?php endwhile; ?>
		</ul>
		<?php endif; ?>
	</div>
</div>