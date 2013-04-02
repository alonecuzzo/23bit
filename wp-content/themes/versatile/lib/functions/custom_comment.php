<?php
function mytheme_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; $homeurl = get_bloginfo('template_directory'); ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

<div id="comment-<?php comment_ID(); ?>" class="comment_wrap">
	<div class="comment-author">
		<?php echo get_avatar($comment,$size='60',$default=$default = $homeurl . '/images/default_avatar_visitor.gif' ); ?>
		<?php printf(__('<cite class=\"fn\">%s</cite>', 'versatile_front'), get_comment_author_link()) ?>
        <div class="comment-meta"> <?php printf(__('%1$s', 'versatile_front'), get_comment_date())?> <br />
          <?php edit_comment_link(__('Edit', 'versatile_front'),'  ','') ?>
        </div>

	</div>
    <div class="single_comment">
      <?php if ($comment->comment_approved == '0') : ?>
      <div class="moderation"><em>
        <?php _e('Your comment is awaiting moderation.', 'versatile_front') ?>
        </em></div>
      <?php endif; ?>
      <?php comment_text() ?>
		<span class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</span> 
	</div>
    <div class="clear"></div>

  </div>
<?php 
} 
?>