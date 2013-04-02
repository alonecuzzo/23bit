 <?php
/*
 Template Name: Contact
 */
get_header(); 
require_once(sys_includes."/var.php");
?>
<?php 
	$subheaderbg_image=get_post_meta($post->ID, 'subheaderbg_image','true');
	if($subheaderbg_image) { ?>
	<style type="text/css">
		body#<?php if ($layoutoptions){ echo $layoutoptions;} else { echo get_option('layoutoption'); }?> #header { background-image:url(<?php echo $subheaderbg_image; ?>); }
	</style>
	<?php } ?>
	<div id="subheader" class="<?php sidebaroption($post->ID); ?>" <?php if($subheaderbg_display != '') { ?> style="background-color:<?php echo $subheaderbg_display.'"'; } ?>>
		<?php sub_header_text($post->ID); ?>
	</div>
	<!-- subheader -->	
</header>
<!-- header -->	

<div class="pagemid <?php sidebaroption($post->ID); ?>">	
	<div class="topshadow">	
		<div class="inner">
	
			<div id="main">

				<!-- breadcrumb -->
				<?php ($breadcrumbs_display=='') ? my_breadcrumb():''; ?>
				<!-- breadcrumb -->

				<div class="content">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="post" id="post-<?php the_ID(); ?>">
						
						<?php the_content('<p class="serif">'.__('Read the rest of this page &raquo;', 'versatile_front').'</p>'); ?>
						
						<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'versatile_front').'</strong>', 'after' => '</p>', 'next_or_number' => 'number')); ?>

						<div id="contactform" class="sysform">
							<script type="text/javascript">  
							/* <![CDATA[ */
							$(document).ready(function() {
								var close_note = $("#note");		
								close_note.click(function() {
								  $("#note").slideUp(1000, function() { $(this).hide(); });
								});	
								$("#ajax-contact-form").submit(function() {
									$('#load').append('<img src="<?php echo bloginfo('template_url'); ?>/ajax-loader.gif" width="24" height="24" alt="Currently Loading" id="cloading" />');

									var fem = $(this).serialize(),
										note = $('#note');
								
									$.ajax({
										type: "POST",
										url: "<?php echo bloginfo('template_url'); ?>/includes/contactsend.php",
										data: fem,
										success: function(msg) {
											if ( note.height() ) {			
												note.slideUp(1000, function() { $(this).hide(); });
											} 
											else note.hide();

											$('#cloading').fadeOut(300, function() {
												$(this).remove();

												// Message Sent? Show the 'Thank You' message and hide the form
												result = (msg === 'OK') ? '<div class="messagebox success"><div class="messagebox_content"><?php _e('Your message has been sent. Thank you!','versatile_front');?></div></div>' : msg;

												var i = setInterval(function() {
													if ( !note.is(':visible') ) {
														note.html(result).slideDown(1000);
														clearInterval(i);
													}
												}, 40);    
											}); // end loading image fadeOut
										}
									});


								   return false;
								});
							});
							/* ]]> */
							</script>
							<!--begin:notice message block-->
							<div id="note"></div>
							<!--begin:notice message block-->
							<br />

							<form id="ajax-contact-form" method="post" action="javascript:alert('success!');" >
								<p><input class="required txt" type="hidden" name="to" value="<?php echo get_option("contactemail");?>" /></p>
								<p><input class="required input_small txt" type="text" name="name" value="" /><label><?php _e('Name', 'versatile_front')?></label></p>
								<p><input class="required input_small txt" type="text" name="email" value="" /><label><?php _e('E-Mail', 'versatile_front')?></label></p>
								<p><input class="required input_small txt" type="text" name="phone" value="" /><label><?php _e('Phone Number', 'versatile_front')?></label></p>
								<p><input class="required input_small txt" type="text" name="subject" value="" /><label><?php _e('Subject', 'versatile_front')?></label>
								<!--  <input class="required inpt" type="text" name="subject" value="" /> -->
								</p>
								<p><textarea class="textbox input_medium" name="message" rows="6" cols="30"></textarea><label><?php _e('Comments', 'versatile_front')?></label></p>
								<p><input class="required input_small txt" type="text" name="answer" value="" /><label><?php _e('Calculate (5-2+1)', 'versatile_front')?></label></p>
								<p><a class="button small" onclick="jQuery('#ajax-contact-form').submit();return false;"><span><?php _e('Send', 'versatile_front')?></span></a>
									<label id="load"></label></p>
							</form>
						</div>
					</div>
					<!-- post -->
					
					<?php endwhile; endif; ?>
					<div class="clear"></div>

					<?php edit_post_link(__('Edit', 'versatile_front'), '<p>', '</p>'); ?>
				
				</div>
			</div>
			<!-- main -->

			<aside id="sidebar">
				<div class="content">
					<?php get_sidebar(); ?>
				</div>
			</aside>
			<!-- sidebar -->
				
		</div>
		<!-- inner -->			
	</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>