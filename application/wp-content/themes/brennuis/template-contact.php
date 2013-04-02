<?php

/*
 * Template Name: Contact
 */
    
    $error = array();
    $name;
    $mail;
    $send_mail;
    $message;
    $send = false;
    
    // validate data
    if(isset($_POST['contact-send'])){
        
        // validate name
        if(isset($_POST['contact-name']) && $_POST['contact-name'] != ''){
            // filter data
            $name = filter_input(INPUT_POST, 'contact-name', FILTER_SANITIZE_STRING);
            
        }else{
            $error['name_error'] = __('Required field!', 'framework');
        }
        
        // validate e-mail
        if(isset($_POST['contact-mail']) && $_POST['contact-mail'] != ''){
            
            $mail = $_POST['contact-mail'];
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $send_mail = filter_var($mail, FILTER_VALIDATE_EMAIL);
            }else{
                $error['mail_error'] = __('Enter valid e-mail address!', 'framework');
            }
            
        
        }else{
            $error['mail_error'] = __('Required field!', 'framework');
        }
        
        // validate message
        if(isset($_POST['contact-message']) && $_POST['contact-message'] != ''){
            // filter data
            $message = filter_input(INPUT_POST, 'contact-message', FILTER_SANITIZE_STRING);
        
        }else{
            $error['mesage_error'] = __('Required field!', 'framework');
        }
        
        // send mail
        
        if(empty($error)){
            
            // all data is valid -> send mail
            
            $email_address = get_option('ln_theme_contact_email');
            
            if(! isset($email_address)){
                    
                $email_address = get_option('admin_email');
            }
            
            //subject
            $subject='['.get_bloginfo('name').'] Message from : '.$name;
            //headers
            $headers = "MIME-Version: 1.0\r\n"; 
            $headers .= "Content-type: text/html; charset=utf-8 \r\n";
            //email
            $email= " From : ".$send_mail." <br>".$message;
            
            //send email
            mail($email_address,$subject,$email,$headers);
            
            $send = true;
            
            
        }
    }
    
    $suc_messg = get_option('ln_theme_contact_confirmation_text');

	// Header
	get_header();

	global $post;
	
    // get page/post options
    $page_sideabr_position = 'right';
    
    if( get_post_meta($post->ID, 'ln_meta_page_sidebar_position', true) ){
        $page_sideabr_position = get_post_meta($post->ID, 'ln_meta_page_sidebar_position', true);
    }
    
    $page_sidebar_name = get_post_meta($post->ID, 'ln_meta_page_sidebar', true);

    // THE LOOP
    if(have_posts()) : while(have_posts()) : the_post();
?>

    <!-- Content -->
    <section class="content <?php echo $page_sideabr_position; ?>-sidebar">
    	
        <h2 class="page-title"><?php the_title(); ?></h2>

        <div class="ln-single-content">
           <?php the_content(); ?>
        </div>

        <div id="contact-form-wrap">

            <?php 
                if($send === true){ 
                    if(isset($suc_messg) && $suc_messg != ''){ 
                        echo '<span class="contact-send-text">'.$suc_messg.'</span>';
                    }else{
                        echo '<span class="contact-send-text">'.__('Thank You! Your message was send!', 'framwork').'</span>';
                    }
                }
            ?>

            <form action="<?php the_permalink(); ?>" method="post" id="contact-form">
                
                <input type="hidden" id="contact-send" name="contact-send"/>
                <div>
                    <label for="contact-name" class="contact-form-label"><?php _e('Your Name:', 'framework'); ?></label>
                    <?php if(isset($error['name_error'])){ echo '<span class="contact-error">'.$error['name_error'].'</span>'; }?>
                    <input type="text" class="required" id="contact-name" name="contact-name" <?php if(isset($_POST['contact-name']) && !$send){ echo 'value="'.$_POST['contact-name'].'"'; }?>/>
                </div>
                <div>
                    <label for="contact-mail" class="contact-form-label"><?php _e('Your E-mail:', 'framework'); ?></label>
                    <?php if(isset($error['mail_error'])){ echo '<span class="contact-error">'.$error['mail_error'].'</span>'; }?>
                    <input type="text" class="required email" id="contact-mail" name="contact-mail" <?php if(isset($mail) && !$send){ echo 'value="'.$_POST['contact-mail'].'"'; }?>/>
                </div>
                <div>
                    <label for="contact-message" class="contact-form-label"><?php _e('Your Message:', 'framework'); ?></label>
                    <?php if(isset($error['mesage_error'])){ echo '<span class="contact-error">'.$error['mesage_error'].'</span>'; }?>
                    <textarea class="required" id="contact-message" name="contact-message" rows="9" cols="10"><?php if(isset($_POST['contact-message']) && !$send){ echo $_POST['contact-message']; }?></textarea>
                </div>
                <div>
                    <button name="submit" type="submit" id="contact-submit" ><?php _e('Send E-mail', 'framework') ?></button>
                </div>  
            </form>
        </div>

        <?php endwhile; endif;  // END LOOP ?>

    </section>

<?php 
    
    // get content sidebar (extensions.sidebars.php)
    ln_get_single_page_sidebar($page_sidebar_name);

    // sidebar
	get_sidebar();

	// Footer
	get_footer();

?>