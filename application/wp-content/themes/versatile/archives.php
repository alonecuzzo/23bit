<?php
get_header();
require(sys_includes."/var.php");
?>
<!-- start:subheader -->
<div id="subheader" class="<?php sidebaroption($post->ID); ?>" <?php if($subheaderbg_display != '') { ?> style="background-color:<?php echo $subheaderbg_display.'"'; } ?>>
	<?php sub_header_text($post->ID); ?>
</div>
<!-- end:subheader -->
</header>
<!-- end:header -->

<div class="pagemid <?php sidebaroption($post->ID); ?>">	
<div class="topshadow">	
	<div class="inner">

    <div id="main">
		<!-- breadcrumb -->
		<?php ($breadcrumbs_display=='') ? my_breadcrumb():''; ?>
		<!-- breadcrumb -->

		<div class="content">
			<?php get_search_form(); ?>
				<h2><?php _e('Archives by Month:','versatile{_front'); ?></h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
				<h2><?php _e('Archives by Subject:','versatile{_front'); ?></h2>
				<ul>
				<?php wp_list_categories(); ?>
				</ul>
		</div>
		<!-- content -->
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