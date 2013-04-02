<?php

	// Header
	get_header();

    $page_sideabr_position = 'right';
?>

    <!-- Content -->
    <section class="content <?php echo $page_sideabr_position; ?>-sidebar">
    	
        <?php 

            // ============================== LOOP =============================== //
            if( have_posts() ) : while ( have_posts() ) : the_post();
                
                // ======== BEGIN POST ENTRY ========= //
        ?>

        <h2 class="page-title"><?php the_title(); ?></h2>

        <?php  

                if (wp_attachment_is_image(get_the_ID())):
                    $att_image = wp_get_attachment_image_src( get_the_ID(), "post-featured-img");
        ?>
            <p class="attachment ln-single-attachment">
                <a  class="no-eff" href="<?php echo wp_get_attachment_url(get_the_ID()); ?>" title="<?php the_title(); ?>">
                <img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-large" alt="<?php get_the_excerpt(); ?>" />
                </a>
            </p>

            <?php endif; ?>

        <?php 
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