<?php
/*
Template Name: Contact Form
*/
?>
<?php get_header(); ?>

<?php 
//If the form is submitted
if(isset($_POST['submitted'])) {
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = 'You forgot to enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
		//Check to make sure comments were entered	
		if(trim($_POST['comments']) === '') {
			$commentError = 'You forgot to enter your comments.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = get_bloginfo( 'admin_email' );
			$subject = 'Contact Form Submission from '.$name;
			$sendCopy = trim($_POST['sendCopy']);
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);
			if($sendCopy == true) {
				$subject = 'You emailed Your Name';
				$headers = 'From: Your Name <noreply@somedomain.com>';
				mail($email, $subject, $body, $headers);
			}
			$emailSent = true;
		}
	}
} 
//BEGIN LOOP
//=====================================================
if(have_posts()) : ?><?php while(have_posts()) : the_post(); 
        
		$id = get_the_ID();
		$post_meta_data = get_post_custom($post->ID);
		if(isset($post_meta_data['custom_repeatable'][0]) ){
			$custom_repeatable = unserialize($post_meta_data['custom_repeatable'][0]); 
		}	
		if(isset( $post_meta_data['custom_select_row_position'][0])){
			$row_position = $post_meta_data['custom_select_row_position'][0];
		}else{ 
			$row_position = "center";
			$img_position = "inside";
			$post_showtitle = "show";
			$post_showcategory = "show";
			$post_showsoc = "show";
		}
		if(isset($post_meta_data['custom_select_img_style'][0]))
		 	$img_syle = $post_meta_data['custom_select_img_style'][0];
		else $img_syle ='';
		if(isset($post_meta_data['custom_select_img_position'][0]))
			$img_position = $post_meta_data['custom_select_img_position'][0];
		else $img_position ='';
		if(isset($post_meta_data['custom_select_img_size'][0]))
			$img_size = $post_meta_data['custom_select_img_size'][0];
		else $img_size ='';
		if(isset($post_meta_data['custom_img_title'][0]))
			$img_title = $post_meta_data['custom_img_title'][0];
		else $img_title ='';
		if(isset($post_meta_data['custom_img_content'][0]))
			$img_content = $post_meta_data['custom_img_content'][0];
		else $img_content ='';
		if(isset($post_meta_data['custom_img_link'][0]))
			$img_link = $post_meta_data['custom_img_link'][0];
		else $img_link='';
		if(isset($post_meta_data['custom_img_buttontitle'][0]))
			$img_buttontitle = $post_meta_data['custom_img_buttontitle'][0];
		else $img_buttontitle ='';
		if(isset($post_meta_data['custom_select_img_badge'][0]))
			$img_badge = $post_meta_data['custom_select_img_badge'][0];
		else $img_badge='';
        if(isset($post_meta_data['custom_select_show_soc'][0]))
			$post_showsoc = $post_meta_data['custom_select_show_soc'][0];
		else $post_showsoc ='';
		if(isset($post_meta_data['custom_select_show_title'][0]))
			$post_showtitle = $post_meta_data['custom_select_show_title'][0];
		else $post_showtitle = '';
		if(isset($post_meta_data['custom_select_show_category'][0]))
			$post_showcategory = $post_meta_data['custom_select_show_category'][0];
		else $post_showcategory = '';

		//JAVASCRIPT FOR FLEX SLIDER AND FADE IN
		//=====================================================?>
        <script>   
			jQuery( document ).ready( function($){	
				$('.add-opacity-fx').animate({opacity:1}, 1500);
			});
		</script>
		<script>
			jQuery( document ).ready( function($){					 					 
			  $('#flexslider-<?php echo $id;?>').flexslider({
				animation: "fade",
				controlNav: false,
				start: function(slider){
				  $('body').removeClass('loading');
				}
			  });
			
			});
			</script><?php
		//ROW BODY
		//=====================================================
		do_shortcode( get_the_content() );?>
		<div class="ss-row-f add-opacity-fx">
            <div class="time-dot"></div>
				<div class="ss-full"><?php 
					if(apply_filters( 'the_content', get_the_content()) !='' || $post_showtitle == 'hide' ){ ?>
						<div class="arrow-up"></div>
						<div class="arrow-side"></div>
						<div class="container-border">
							<div class="gray-container single-page-t"> <?php 
								if(has_post_thumbnail()) {	
										$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 720,405, ), true );
										$srcf = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', true );
										
											if(isset($img_badge) == 'new'){?>
												<div class="badge badge-1 badge-top-padding"></div><?php
											}
											if(isset($img_badge) == 'hot'){?>
												<div class="badge-hot badge-hot-top-padding"></div><?php
											}
										
										if($custom_repeatable[0] != ''){?>
											<div id="flexslider-<?php echo $id;?>" class="flexslider">
												<ul class="slides">
													<li>
														<div class="hover-effect h-style"><?php 
															if($img_title || $img_content){ ?>
																<img src="<?php echo $src[0]; ?>" class="clean-img"/> 
																<div class="mask"><?php 
																	if($img_title){ ?>
																		<h2><?php echo $img_title; ?></h2> <?php 
																	}; ?>
																	<p><?php echo $img_content ; ?></p><?php
																	 if($img_link){ ?>
																		<a href="<?php echo $img_link; ?>" class="info" > <span class="button violet"><?php echo $img_buttontitle; ?></span></a><?php
																	 }; ?>
																</div><?php 
															}else{ ?>
																<a href="<?php echo $srcf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $src[0]; ?>" class="clean-img"/> 
																	<div class="mask">
																		<span class="img-rollover"></span>
																	</div>
																</a><?php 
															};?>
														</div>
													</li> <?php
													foreach ($custom_repeatable as $string) {
														$srcslider = wp_get_attachment_image_src( $string, array( 720,405, ), true );
														$srcsliderf = wp_get_attachment_image_src( $string, 'full', true );
														?>
														<li>
															<div class="hover-effect h-style">
																<a href="<?php echo $srcsliderf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $srcslider[0]; ?>" class="clean-img"/> 
																	<div class="mask">
																		<span class="img-rollover"></span>
																	</div>
																</a>
															</div>
														</li> <?php 
													};?>
												</ul>
											</div> <?php
										}else{?>
											<div class="hover-effect h-style"><?php 
												if($img_title || $img_content){ ?>
													<img src="<?php echo $src[0]; ?>" class="clean-img"/> 
													<div class="mask"><?php 
														if($img_title){ ?>
															<h2><?php echo $img_title; ?></h2><?php  
														}; ?>
														<p><?php echo $img_content; ?></p><?php 
														if($img_link){ ?>
															<a href="<?php echo $img_link; ?>" class="info" > <span class="button violet"><?php echo $img_buttontitle; ?></span></a><?php
														}; ?>
													</div><?php 
												}else{ ?>
													<a href="<?php echo $srcf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $src[0]; ?>" class="clean-img"/>
														<div class="mask">
															<span class="img-rollover"></span>
														</div>
													</a><?php
												};?>
											</div><?php 
										};
									};
									if(apply_filters ('the_title', get_the_title()) !=''  ) {
										if($post_showtitle != 'hide'){?>                         	
											<h1 class="content-title contact-form-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1> <?php 
										};
									};
								
									the_content(); 					
									if(isset($emailSent) && $emailSent == true) { ?>
										<div class="thanks">
											<h1>Thanks, <?php echo $name;?></h1>
											<p>Your email was successfully sent.</p>
										</div><?php 
									} else { ?>
										<div class="contact-form-h"><?php 
											if(isset($hasError) || isset($captchaError)) { ?>
												<p class="error">There was an error submitting the form.<p><?php 
											} ?>
											<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
												<ol class="forms">
													<li><label for="contactName">Name</label>
														<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField" />
														<?php if(isset($nameError) != '') { ?>
															<span class="error"><?php echo $nameError;?></span> 
														<?php } ?>
													</li>
													
													<li><label for="email">Email</label>
														<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email" />
														<?php if(isset($emailError) != '') { ?>
															<span class="error"><?php echo $emailError;?></span>
														<?php } ?>
													</li>
													
													<li class="textarea"><label for="commentsText">Message</label>
														<textarea name="comments" id="commentsText" rows="20" cols="30" class="requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
														<?php if(isset($commentError) != '') { ?>
															<span class="error"><?php echo $commentError;?></span> 
														<?php } ?>
													</li>
													<li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit">Email us</button></li>
												</ol>
											</form>
										</div><?php 
									} ?>
								</div>
						</div><?php
						if($post_showsoc == "show"){
							if( of_get_option('fb-link') !='' || of_get_option('tw-link') !='' || of_get_option('li-link') !='' || of_get_option('yt-link') !='' || of_get_option('vm-link') !='' || of_get_option('fl-link') !='' || of_get_option('da-link') !='' || of_get_option('su-link') !='' || of_get_option('di-link') !=''){?>
							<div class="icon-soc-container-alone ">
								<div class="container-border">
									<div class="gray-container " > 
										<ul><?php 
											if(of_get_option('fb-link') !=''){?>
												<li><a title="<?php echo of_get_option('fb-link-tooltip');?>" target="_blank" rel="tooltip"  href="<?php echo of_get_option('fb-link');?>"><div class="icon-soc facebook-ico"></div></a></li><?php
											};
											if(of_get_option('tw-link') !=''){?>
												<li><a title="<?php echo of_get_option('tw-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('tw-link');?>"><div class="icon-soc twitter-ico"></div></a></li><?php
											};
											if(of_get_option('li-link') !=''){?>
												<li><a title="<?php echo of_get_option('li-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('li-link');?>"><div class="icon-soc linkedin-ico"></div></a></li><?php
											};
											if(of_get_option('yt-link') !=''){?>
												<li><a title="<?php echo of_get_option('yt-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('yt-link');?>"><div class="icon-soc youtube-ico"></div></a></li><?php
											};
											if(of_get_option('vm-link') !=''){?>
												<li><a title="<?php echo of_get_option('vm-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('vm-link');?>"><div class="icon-soc vimeo-ico"></div></a></li><?php
											};
											if(of_get_option('fl-link') !=''){?>
												<li><a title="<?php echo of_get_option('fl-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('fl-link');?>"><div class="icon-soc flickr-ico"></div></a></li><?php
											};
											if(of_get_option('da-link') !=''){?>
												<li><a title="<?php echo of_get_option('da-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('da-link');?>"><div class="icon-soc devianart-ico"></div></a></li><?php
											};
											if(of_get_option('su-link') !=''){?>
												<li><a title="<?php echo of_get_option('su-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('su-link');?>"><div class="icon-soc stumbleupon-ico"></div></a></li><?php
											};
											if(of_get_option('di-link') !=''){?>
												<li><a title="<?php echo of_get_option('di-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('di-link');?>"><div class="icon-soc digg-ico"></div></a></li><?php
											};?>
									   </ul>
									</div>	
								</div>
							</div> <?php   
							}
						};
					}; ?>
			</div>        
        </div>  <?php 
		comments_template(); ?>
<?php endwhile; 
endif; ?>
<?php get_footer(); ?>