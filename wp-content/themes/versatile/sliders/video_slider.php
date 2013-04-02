<?php require(sys_includes."/var.php"); ?>
<div class="inner">
	<div id="video">
		<div id="video_container">
			<?php echo stripslashes(get_option("sys_video")); ?>
		</div>
	</div>
	<div class="header_highlight">
		<?php echo do_shortcode(stripslashes(get_option('video_header_highlight'))); ?>
	</div>
</div>
<!-- End: Slider -->