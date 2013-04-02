<?php  
/**
 * Post Format : Image
 */

$close_lightbox = false;
$has_image = false;

if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ){
	
	$has_image = true;

	$small_src = get_the_post_thumbnail(get_the_ID(), 'post-featured-img');
		
	// lightbox src
	$lightbox_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array('960','9999'), false, '' );
}


?>

<?php if(! is_singular()): ?>

	<article class="ln-blog-post">

		<header>
			<span class="format-icon image"></span>
			<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<div class="clear"></div>
		</header>

	<?php if($has_image): ?>

		<?php if(get_option('ln_theme_enable_lightbox') == 'true'): ?>
			<a href="<?php echo $lightbox_src[0]; ?>" class="no-eff lightbox" title="<?php the_title(); ?>">
		<?php else: ?>
			<a href="<?php the_permalink(); ?>" class="no-eff" title="<?php the_title(); ?>">
		<?php endif; ?>

				<div class="ln-col-full post-img ln-format-img">
					<?php echo $small_src; ?>
					<div class="img-hover"></div>
				</div>
			</a>

	<?php endif; ?>

	<div class="ln-col-full excerpt excerpt-offset">
		<?php the_excerpt(); ?>
	</div>

	<?php get_template_part('framework/post-formats/small-footer'); ?>

<?php else: ?>

	<?php if($has_image): ?>

	<div class="ln-single-featured ln-col-full">
		<?php if(get_option('ln_theme_enable_lightbox') == 'true'): $close_lightbox = true; ?>
			<a href="<?php echo $lightbox_src[0]; ?>" class="no-eff lightbox" title="<?php the_title(); ?>">
		<?php endif; ?>

			<div class="ln-col-full post-img ln-format-img">
				<?php echo $small_src; ?>
				
				<?php if($close_lightbox): ?>
					<div class="img-hover"></div>
				<?php endif; ?>
			
			</div>
		
		<?php if($close_lightbox): ?>
		</a>
		<?php endif; ?>
	
	</div>

	<?php endif; ?>

<?php endif; ?>