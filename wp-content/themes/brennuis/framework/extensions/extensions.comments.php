<?php

/***********************************************************************
 * ln_comment
 * - used as wp_list_comments() callback function to display each comment
 ***********************************************************************/
function ln_list_comment($comment, $args, $depth){
	
	$GLOBALS['comment'] = $comment; 
	
?>
   <li id="li-comment-<?php comment_ID() ?>" <?php comment_class();  ?>>
	<div id="comment-<?php comment_ID() ?>" class="comment-wrap clear">
		<div>
		<aside class="comment-avatar">
			<?php echo get_avatar($comment,$size='40'); ?>
		</aside>
		
			<div class="comment-content">
				<header class="comment-header"><span><?php echo get_comment_author_link(); ?></span></header>
				
				<?php if ($comment->comment_approved == '0') : ?>
	         		<strong><?php _e('Your comment is awaiting moderation.', 'framework'); ?></strong>
	        		<br />
	      		<?php endif; ?>
				
	      		<?php comment_text() ?>
				<footer class="comment-meta">
					<?php edit_comment_link(__('[Edit]','framework'),'  ','') ?> <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date(); ?></a>
					<span><?php if(get_comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])))){ _e('/ ','framework'); }comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
				</footer>
			</div>
			<div class="clear"></div>
		</div>
	</div>
<?php

}// end ln_comment


/***********************************************************************
 * ln_pingback
 * - used as wp_list_comments() callback function to display pingbacks 
 ***********************************************************************/
function ln_pingback($comment, $args, $depth){
		
	$GLOBALS['comment'] = $comment; 
?>
	
	<li id="li-comment-<?php comment_ID() ?>" <?php comment_class();  ?>>
	<div id="comment-<?php comment_ID() ?>" class="comment-wrap clear">
		<div>
		
			<div class="comment-content">
				<header class="comment-header"><span><?php echo get_comment_author_link(); ?></span></header>
				
				<?php if ($comment->comment_approved == '0') : ?>
	         		<strong><?php _e('Your comment is awaiting moderation.', 'framework'); ?></strong>
	        		<br />
	      		<?php endif; ?>
				
	      		<?php comment_text() ?>
				<footer class="comment-meta">
					<?php edit_comment_link(__('[Edit]','framework'),'  ','') ?> <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date(); ?></a>
					<span><?php if(get_comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])))){ _e('/ ','framework'); }comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
				</footer>
			</div>
			<div class="clear"></div>
		</div>
	</div>
<?php 

} //end ln_pingback

?>
