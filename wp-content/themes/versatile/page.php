<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
require(sys_includes."/var.php");
?>
<?php
	$subheaderbg_image=get_post_meta($post->ID, 'subheaderbg_image','true');
	if($subheaderbg_image) {
	?>
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
				</div>
				
				<?php endwhile; endif; ?>
				
				<div class="clear"></div>
				<?php edit_post_link(__('Edit', 'versatile_front'), '<p>', '</p>'); ?>
				
				<?php
				$comments=get_option('commentstemplate');
				if($comments=="pages" ||  $comments=="both") {
					comments_template('', true); 
				}?>
				
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
<!-- pagemid -->		
<div class="clear"></div>
<?php get_footer(); ?>