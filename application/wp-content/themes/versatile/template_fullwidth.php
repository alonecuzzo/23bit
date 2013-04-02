<?php
/*

Template Name: Full Width

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
	<div id="subheader" <?php if($subheaderbg_display != '') { ?> style="background-color:<?php echo $subheaderbg_display.'"'; } ?>>	
		<?php sub_header_text($post->ID); ?>
	</div>
	<!-- subheader -->
</header>
<!-- header -->

<div class="pagemid">	
<div class="topshadow">
	<div class="inner">

		<div id="mainfull">

		<!-- breadcrumb -->
		<?php ($breadcrumbs_display=='') ? my_breadcrumb():''; ?>
		<!-- breadcrumb -->

		<div class="content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post">	
				<?php global $more; $more = 0;  the_content(''); ?>
				<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'versatile_front').'</strong>', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div>

			<?php endwhile; endif; ?>
			<?php edit_post_link(__('Edit', 'versatile_front'), '<p>', '</p>'); ?>
			<?php  wp_reset_query();?>
		</div>
		</div>
	</div>
</div>
</div>
<!-- .pagemid -->
<div class="clear"></div>
<?php get_footer(); ?>