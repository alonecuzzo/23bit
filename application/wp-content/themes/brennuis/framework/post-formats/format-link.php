<?php  
/**
 * Post Format : Link
 */

$link_url = get_post_meta( get_the_ID(), 'ln_post_meta_url', true);

?>

<?php if(! is_singular()): ?>

	<article class="ln-blog-post">

		<header>
			<span class="format-icon link"></span>
			<div class="clear"></div>
		</header>

		<div class="ln-link-post ln-col-full">
			<h4><a href="<?php echo $link_url; ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
		</div>

		<div class="ln-col-full excerpt excerpt-offset">
			<?php the_excerpt(); ?>
		</div>
		<div class="clear"></div>
	
	<?php get_template_part('framework/post-formats/small-footer'); ?>

<?php else: ?>

	<div class="ln-link-post ln-col-full">
		<h4><a href="<?php echo $link_url; ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
	</div>

<?php endif; ?>