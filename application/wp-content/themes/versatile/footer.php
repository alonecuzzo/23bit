	<?php $footersidebar=get_option("footer_sidebar");
	if($footersidebar == "true"){ ?>
	<footer id="footer">
	<div class="inner">
	<?php //get_template_part( 'sidebar_footer', 'index' ); //Works with wordpress 3.0 and above
	include (TEMPLATEPATH."/sidebar_footer.php"); // Comment this if you want to use the get_template_part() latest 3.0 functionality
		?>
	</div>
	<div class="clear"></div>
	<?php }?>	
	</footer>
	<!-- Footer -->
	<div class="copyright">
		<div class="inner">
			<div class="copy_left">
			<?php echo stripslashes(get_option("left_footer")); ?>
			</div>
			<div class="copy_right">
			<?php echo stripslashes(get_option("right_footer")); ?>
			Powered by <a href="http://www.siteslike.com">siteslike</a>
			<?php include(TEMPLATEPATH."/includes/sociables.php");?>
			</div>
		</div>
	</div>
	<!-- Copyright -->


<?php $googleanalytics=get_option("googleanalytics");
if($googleanalytics){
	echo stripslashes($googleanalytics); 
}
?>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</div><!-- wrap-all -->
</body>

</html>