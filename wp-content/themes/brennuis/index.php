<?php

    // Header
	get_header();
	
    // get page/post options
    $page_sideabr_position = get_option('ln_blog_sidebar_position');
    
    if($page_sideabr_position == ''){
        $page_sideabr_position = 'right';
    }
?>

    <!-- Content -->
    <section class="content <?php echo $page_sideabr_position; ?>-sidebar">
        
        <?php 

            // extensions.blog.php
            ln_get_blog_posts();

        ?>

    </section>

<?php 
    
    // get content sidebar (extensions.sidebars.php)
    ln_get_single_page_sidebar('default');

    // sidebar
	get_sidebar();

	// Footer
	get_footer();

?>