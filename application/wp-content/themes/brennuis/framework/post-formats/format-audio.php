<?php  
/**
 * Post Format : Audio
 */

$audio_embed = get_post_meta( get_the_ID(), 'ln_post_meta_audio_embed_code', true);

?>

<?php if(! is_singular()): ?>

	<article class="ln-blog-post">

		<header>
			<span class="format-icon audio"></span>
			<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<div class="clear"></div>
		</header>

		<div class="ln-audio-post ln-col-full">
			<?php echo stripslashes(htmlspecialchars_decode($audio_embed)); ?>
		</div>
	
		<div class="ln-col-full excerpt excerpt-offset">
			<?php the_excerpt(); ?>
		</div>

	<?php get_template_part('framework/post-formats/small-footer'); ?>

<?php else: ?>

	<div class="ln-audio-post ln-col-full">
		<?php echo stripslashes(htmlspecialchars_decode($audio_embed)); ?>
	</div>

<?php endif; ?>