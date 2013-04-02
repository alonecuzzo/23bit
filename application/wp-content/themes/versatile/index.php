<?php 
get_header();
require(sys_includes."/var.php");
?>
<?php
if($slidervisble =="true") {

	if($homepageslider== "piecemaker_slider") {
		echo "<div id=\"piecemaker_slider\">";
		}else{
		echo "<div id=\"featured_slider\">";
	}
	switch ($homepageslider):
		case 'nivo_slider':
			include (TEMPLATEPATH."/sliders/nivo_cat_slider.php");	
			break;
		case 'video_slider':
			include (TEMPLATEPATH."/sliders/video_slider.php");	
			break;
		case 'piecemaker_slider':
			include (TEMPLATEPATH."/sliders/piecemaker_slider.php");	
			break;
		default:
			include (TEMPLATEPATH."/sliders/nivo_default_slider.php");
	endswitch;
	echo "</div><!--featured slider-->";
}
?> 
<!-- Header -->
<div class="clear"></div>

<?php if($teaserbox == "true") { ?>
<!-- TEASER -->
<div class="infobox <?php echo $homepagelayout;?>">
	<div class="inner">
		<div class='teaserfull'>
		<?php echo do_shortcode(stripslashes(get_option('home_teaser'))); ?>
		</div>
	</div>
</div>
<!-- TEASER -->
<div class="clear"></div>
<?php } ?>
</header>

<div class="pagemid <?php echo $homepagelayout;?>">
	<div class="topshadow">
	<div class="inner">

		<div class="frontpage_inner">
			<div class="content">
			<?php
				if($sys_homepages== "None" ){
					include (TEMPLATEPATH."/includes/home_custom.php");
				}else{
					include (TEMPLATEPATH."/includes/home_page.php");
				}
			?>
			</div>
		</div>

		<?php if($homepagelayout != 'fullpage') { ?>
		<aside id="sidebar">
			<div class="content">
				<?php 	if (function_exists('dynamic_sidebar') && dynamic_sidebar('home_page_widget') ) : endif;  ?>
			</div>
		</aside>
		<?php  } ?>
	</div>
	<!-- inner -->
	</div>	
	<!--topshadow-->
</div>
<!-- pagemid -->
<div class="clear"></div>
<?php get_footer(); ?>