<?php
	
	// Header
	get_header();

	global $post;
	
	$is_review = false;

    // get page/post options
    $page_sideabr_position = 'right';
    
    if( get_post_meta($post->ID, 'ln_meta_page_sidebar_position', true) ){
    	$page_sideabr_position = get_post_meta($post->ID, 'ln_meta_page_sidebar_position', true);
    }

    $page_sidebar_name = get_post_meta($post->ID, 'ln_meta_page_sidebar', true);

    if( get_post_meta( get_the_ID(), 'ln_review_meta_use_as_review', true ) == 'on'){
		$is_review = true;
	}

?>

    <!-- Content -->
    <section class="content <?php echo $page_sideabr_position; ?>-sidebar">
   		 	
   		 <?php

   		 	// ============================== LOOP =============================== //
			if( have_posts() ) : while ( have_posts() ) : the_post();
				
				// ======== BEGIN POST ENTRY ========= //
				$format = get_post_format();
			
				if ($format === false){
					$format = "standard";
				}
		?>
			<?php if($format != 'link' && $format != 'quote'): ?>
				
				<?php if($is_review): ?>
					
					<div itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing">
						<h2 class="page-title" itemprop="name"><?php the_title(); ?></h2>
					</div>
	    		
	    		<?php else: ?>
	    		
	    			<h2 class="page-title"><?php the_title(); ?></h2>
	    		
	    		<?php endif; ?>
	    	
	    	<?php endif; ?>

	    	<div class="ln-single-meta">
	    		<?php the_time("d F Y "); _e('by ','framework'); the_author_posts_link(); _e(' in ','framework'); ?>  
	    		<span class="ln-post-categories"><?php the_category( ' ', 'multiple', false ); ?></span>
	    		- <a href="<?php the_permalink(); ?>#comments"><?php comments_number(__('No Comments', 'framework'), '1 '.__('Comment', 'framework'), '% '.__('Comments', 'framework')); ?></a>
	    	</div>

		<?php	
				// get post format
				get_template_part('framework/post-formats/format-'.$format);

				// show post content
				if($is_review):
		?>
					<div itemscope itemtype="http://schema.org/Review">
						<div class="ln-single-content" itemprop="reviewBody"><?php the_content(); ?></div>
					</div>

		<?php 	else: ?>
					
					<div class="ln-single-content">
						<?php the_content(); ?>
					</div>

		<?php 	endif;
				
				// WP link pages
				wp_link_pages();

				// review score
				ln_get_single_review_score();

				// post tags
				ln_get_single_tags_list();

				// social share
				ln_get_single_social_share();

				// author info
				ln_get_single_author_info();

				// next and prev posts links
				ln_get_single_next_prev_links();

				// related posts carousel
				ln_get_single_post_related_posts();

				// comments
				comments_template('', true ); 
				comment_form( ln_get_comment_form_options() );
				
				// ======== END POST ENTRY ========= //

			endwhile; 
			// ============================== END LOOP =============================== //
			
			else: // no posts found
				
				echo '<h2 class="page-title">'.__('Nothing found!', 'framework').'</h2>';
			
			endif;

   		?>

    </section>

<?php 
    
    // get content sidebar (extensions.sidebars.php)
    ln_get_single_page_sidebar($page_sidebar_name);

    // sidebar
	get_sidebar();

	// Footer
	get_footer();

?>