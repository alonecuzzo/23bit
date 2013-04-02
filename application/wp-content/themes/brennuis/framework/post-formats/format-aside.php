<?php  
/**
 * Post Format : Aside
 */
?>

<?php if(! is_singular()): ?>

	<article class="ln-blog-post">

		<header>
			<span class="format-icon aside"></span>
			<div class="clear"></div>
		</header>

		<div class="ln-aside-post ln-col-full">
	    	<?php the_content(); ?>
	    </div>

	<?php get_template_part('framework/post-formats/small-footer'); ?>

<?php endif ?>