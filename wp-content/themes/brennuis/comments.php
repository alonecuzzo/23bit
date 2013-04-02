<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
			die ('Please do not load this page directly. Thanks!');
	
	if ( post_password_required() ) {
			echo '<p class="nocomments">This post is password protected. Enter the password to view comments.</p>';
			return;
	}

	if (have_comments()):
?>

<!-- Comments -->
<section id="comments" class="ln-comments ln-col-full">
	<div class="section-head">
		<h3><?php comments_number(__('No Comments', 'framework'), '1 '.__('Comment', 'framework'), '% '.__('Comments', 'framework')); ?> </h3>
		<div class="section-line"></div>
	</div>
	<ul>
		<?php wp_list_comments('type=comment&callback=ln_list_comment'); ?>
	</ul>
	<ul>
		<?php wp_list_comments('type=pingback&callback=ln_pingback') ?>
	</ul>

	<ul>
		<?php wp_list_comments('type=trackback&callback=ln_pingback') ?>
	</ul>
	
	<?php if(get_previous_comments_link() || get_next_comments_link()): ?>
	
	<div class="comments-navigation">
		<?php if(get_previous_comments_link()): ?><span class="prev-comments"><?php previous_comments_link(); endif; ?></span>
		<span class="next-comments"><?php next_comments_link(); ?></span>
	</div>

	<?php endif; ?>
	
</section>

<?php 	
	
	endif;
	
	if (have_comments() && !comments_open()):
?>
	<p class="nocomments"><span><?php _e( 'Comments are closed', 'framework' ); ?></span></p>
	
<?php 
	
	endif;

?>



