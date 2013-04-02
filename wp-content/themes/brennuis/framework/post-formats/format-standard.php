<?php  
/**
 * Post Format : Standard
 */

$is_review = false;
$score = 0;
$icon = 'standard';
$show_fimg = true;

// check if this post is review
if( get_post_meta( get_the_ID(), 'ln_review_meta_use_as_review', true ) == 'on'){
	
	$is_review = true;
	$score = get_post_meta( get_the_ID(), 'ln_review_meta_fileds_score', true);
	$icon = 'review';
}

if( get_post_meta( get_the_ID(), 'ln_post_meta_standard_hide_fimage', true) == 'on' ){
	$show_fimg = false;
}

?>

<?php if(! is_singular()): ?>

	<article class="ln-blog-post">

		<header>
			<span class="format-icon <?php echo $icon; ?>"></span>
			<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<div class="clear"></div>
		</header>

	<?php if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ): ?>

			<a href="<?php the_permalink(); ?>" class="no-eff" title="<?php the_title(); ?>">
				<div class="img-wrapper post-img ln-col-half ln-featured">
					<?php the_post_thumbnail('post-featured-img-small'); ?>
					<div class="img-hover"></div>
	    	
	    		<?php if($is_review): ?>

	    			<div class="rating">
						<span class="score"><?php echo $score; ?></span>
						<span><?php _e('score', 'framework'); ?></span>
					</div>

	    		<?php endif; ?>	
	    		
	    		</div>
	    	</a>

	    	<div class="ln-col-half last-item excerpt">
	    		<?php the_excerpt(); ?>
	    	</div>
	    	<div class="clear"></div>

	<?php else: ?>

		<div class="ln-col-full last-item excerpt excerpt-offset">
	    	<?php the_excerpt(); ?>
	    </div>

	<?php endif; ?>

	<?php get_template_part('framework/post-formats/small-footer'); ?>

<?php else: ?>

	<?php if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) && $show_fimg ): ?>

		<div class="ln-single-featured ln-col-full">
			<?php the_post_thumbnail('post-featured-img-crop'); ?>
		</div>

	<?php endif; ?>
	    	
<?php endif; ?>