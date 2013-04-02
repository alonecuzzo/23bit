<?php
	
	// Header
	get_header();

	global $post;
    
    // get page/post options
    $page_sideabr_position = 'right';
    
    if( get_post_meta($post->ID, 'ln_meta_page_sidebar_position', true) ){
        $page_sideabr_position = get_post_meta($post->ID, 'ln_meta_page_sidebar_position', true);
    }

    $page_sidebar_name = get_post_meta($post->ID, 'ln_meta_page_sidebar', true);

?>
	<!-- Content -->
    <section class="content <?php echo $page_sideabr_position;?>-sidebar">
    	
    	<h2 class="page-title"><?php the_title(); ?></h2>
    	
    	<?php 

    		// show page content
    		echo '<div class="ln-single-content">';
                    the_content());
            echo '</div>';
    		
    		// show comments
			comments_template('', true ); 
			comment_form( ln_get_comment_form_options() );
		?>

    </section>


<?php
	
	// get content sidebar (extensions.sidebars.php)
    ln_get_single_page_sidebar($page_sidebar_name);
	
	// Sidebar
	get_sidebar();
	
	// Footer
	get_footer();
?>