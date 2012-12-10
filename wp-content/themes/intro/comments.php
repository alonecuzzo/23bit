<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to intro_comment() which is
 * located in the functions.php file.
 *
 * @package Intro
 * @since Intro 1.0
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
?>

	<div id="comments" class="comments">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php printf( _n( '<span>1</span> Comment', '<span>%d</span> Comments', get_comments_number() ), get_comments_number(), 'intro' ); ?>
		</h3>

		<ol class="list-comments">
			<?php
				wp_list_comments( array( 'callback' => 'intro_comment' ) );
			?>
		</ol>
		
		<?php 
			paginate_comments_links( array(
				'prev_next' => false,
				'type'      => 'list',
				'show_all'  => true
			) ); 
		?>
	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'intro' ); ?></p>
	<?php endif; ?>

	<div class="comment-form">
		<?php
			$fields = array(
				'author' => '<div class="comment-form-author row">
								<input id="author" class="txt" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_attr( __( 'Your Name: (Required)', 'intro' ) ) . '" />
							</div>',
				'email'  => '<div class="comment-form-email row">
								<input id="email" class="txt" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_attr( __( 'Your Email: (Required)', 'intro' ) ) . '" />
							</div>',
				'url'    => '<div class="comment-form-url row">
								<input id="url" class="txt" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . esc_attr( __( 'Your Website: (Required)', 'intro' ) ) . '" />
							</div>'
			);
			
			$comment = '<div class="comment-form-comment row">
							<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
						</div>';

			$comment_form_args = array(
				'title_reply'          => __( 'Have something to say?', 'intro' ),
				'fields'               => $fields,
				'comment_field'        => $comment,
				'comment_notes_after'  => '',
				'comment_notes_before' => '',
				'label_submit'         => __( 'Submit', 'intro' )
			);
			
			comment_form( apply_filters( 'comment_form_args', $comment_form_args ) ); 
		?>
	</div>

	</div><!-- #comments .comments-area -->
