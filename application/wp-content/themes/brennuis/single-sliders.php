<?php

    // Header
	get_header();
	
    // get page/post options
    $page_sideabr_position = get_option('ln_blog_sidebar_position');

?>

    <!-- Content -->
    <section class="content <?php echo $page_sideabr_position; ?>-sidebar">
	
	  <?php

            // ============================== LOOP =============================== //
            if( have_posts() ) : while ( have_posts() ) : the_post();
                
                // ======== BEGIN POST ENTRY ========= //
                
        ?>
            <h2 class="page-title"><?php the_title(); ?></h2>
            
            <div class="ln-single-meta">
                <?php the_time("d F Y "); _e('by ','framework'); the_author_posts_link(); ?>
            </div>

        <?php   
                // get post format
                get_template_part('framework/post-formats/format-gallery');

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
    ln_get_single_page_sidebar('default');

    // sidebar
	get_sidebar();

	// Footer
	get_footer();

?>