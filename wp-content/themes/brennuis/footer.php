<?php 
	// get foooter texts
	$footer_text_left = get_option('ln_theme_footer_text_left');
    $footer_text_right = get_option('ln_theme_footer_text_right');

?>

<!-- Footer -->
    	<footer id="main-footer">
    		 <span class="left-text">
            <?php if(isset($footer_text_left) && $footer_text_left !=''){ echo $footer_text_left; } else { ?>
                    Magazine Theme by <a href="http://www.mafiashare.net" target="_blank">Lion</a> 2012
            <?php } ?>
        </span>

        <span class="right-text">
            <?php if(isset($footer_text_right) && $footer_text_right !=''){ echo $footer_text_right; } else { ?>
                    Powered by <a href="http://www.mafiashare.net" target="_blank">WordPress</a>
            <?php } ?>
        </span>
        <div class="clear"></div>
    	</footer>
    
    </section>
    <?php ln_get_custom_background(true); ?>
    <?php wp_footer();?>
</body>  
</html>  