<?php  
/**
 * Post Format : Video
 */

$video_embed = get_post_meta( get_the_ID(), 'ln_post_meta_video_embed_code', true);

?>

<?php if(! is_singular()): ?>

	<article class="ln-blog-post">

		<header>
			<span class="format-icon video"></span>
			<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<div class="clear"></div>
		</header>
		
		<div class="ln-col-half ln-featured">
			<?php echo stripslashes(htmlspecialchars_decode($video_embed)); ?>
		</div>
	
		<div class="ln-col-half last-item excerpt">
			<?php the_excerpt(); ?>
		</div>
		<div class="clear"></div>
		
	
	<?php get_template_part('framework/post-formats/small-footer'); ?>

<?php else: ?>

	<div class="ln-col-full ln-featured">
		<?php echo stripslashes(htmlspecialchars_decode($video_embed)); ?>
	</div>

<?php endif; ?>