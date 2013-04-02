<?php  
/**
 * Post Format : Quote
 */

$quote_text = get_post_meta( get_the_ID(), 'ln_post_meta_quote_text', true);
$quote_author = get_post_meta( get_the_ID(), 'ln_post_meta_quote_author', true);

?>

<?php if(! is_singular()): ?>

	<article class="ln-blog-post">

		<header>
			<span class="format-icon quote"></span>
			<div class="clear"></div>
		</header>
		<div class="ln-quote-post ln-col-full">
			<blockquote>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo $quote_text; ?></a>
				<cite><?php echo $quote_author; ?></cite>
			</blockquote>
		</div>
		
	<?php get_template_part('framework/post-formats/small-footer'); ?>

<?php else: ?>

	<div class="ln-quote-post ln-col-full">
		<blockquote>
			<?php echo $quote_text; ?>
			<cite><?php echo $quote_author; ?></cite>
		</blockquote>
	</div>

<?php endif; ?>