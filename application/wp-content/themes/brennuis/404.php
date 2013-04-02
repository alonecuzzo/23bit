<?php
	
	// Header
	get_header();
	$page_sideabr_position = get_option('ln_blog_sidebar_position');
	global $post;
   

	$page_title = stripslashes(get_option('ln_theme_404_page_title'));
	$page_content = stripslashes(get_option('ln_theme_404_page_content'));

	if(!isset($page_title) || $page_title == ''){
		$page_title = __('404', 'framework');
	}

	if(!isset($page_content) || $page_content == ''){
		$page_content = __('Something went wrong!', 'framework');
	}	
		
?>

		
		
		 <section class="content <?php echo $page_sideabr_position; ?>-sidebar">
			
				<h1 class="page-title"><?php echo $page_title; ?></h1>
				<article id="<?php the_ID(); ?>" <?php post_class("post clear"); ?> >
					<p><?php echo $page_content; ?></p>
				</article>
			
		

		<section class="ln-arvhices-list">

			<div class="section-head">
				<h3><?php _e('Recent Posts', 'framework'); ?></h3>
				<div class="section-line"></div>
			</div>

			<?php

				// Show 30 recent posts

	            wp_reset_query();

				query_posts( array('post_type' => 'post', 'posts_per_page' => 30) );
				
				while (have_posts()) : the_post();

				$format = get_post_format();

				if ($format === false){
					if( get_post_meta( get_the_ID(), 'ln_review_meta_use_as_review', true ) == 'on') {
						$format = "review";
					}
					else {
						$format = "standard";
					}
				}

        	?>
        	
			<!-- Entry -->
			<article class="ln-blog-post ln-archive-post">

				<header>
					<span class="format-icon <?php echo $format; ?>"></span>
					<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					<div class="clear"></div>
				</header>

			</article>
			
			<?php endwhile; ?>
		</section>
		</section>
	
<?php 	

	ln_get_single_page_sidebar('default');
	// Sidebar
	get_sidebar();
	
	// Footer
	get_footer();
?>