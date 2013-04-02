<?php require(sys_includes."/var.php"); ?>
<script>
var $slider_type = jQuery("meta[name=slider_type]").attr('content');
var $nivo_slider_effect = jQuery("meta[name=nivo_slider_effect]").attr('content');
var $slider_url = jQuery("meta[name=slider_url]").attr('content');
if($slider_type == 'nivo_slider')
	{
	$(window).load(function() {
		$('#slider').nivoSlider({
		effect:$nivo_slider_effect, // sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, fade, random
		animSpeed:500,
		pauseTime:3000,
		directionNav:false, //Next and Prev
		directionNavHide:false, //Only show on hover
		controlNav:true, //1,2,3...
		pauseOnHover:false, //Stop animation while hovering
		captionOpacity: 1,
		beforeChange: function(){
			jQuery('.nivo-caption').animate({bottom:"0px", opacity: "0"}, {easing:"jswing", duration: "300"});
		},
		afterChange: function(){
			jQuery('.nivo-caption').animate({bottom:"15px", opacity: "1"}, {easing:"easeOutBack",  duration: "300"});
		}

		});
	});
}
</script>
<div class="inner">
<div id="slider">
<?php
// nivo slider options
$nivodisplayimages = get_option("nivodisplayimage");
query_posts("post_type=slider&showposts=$nivodisplayimages");
while (have_posts()) : the_post(); 
    $radio_coptions = get_post_meta($post->ID, "radio_coptions", TRUE);
	switch($radio_coptions) {
		case "linkpage":
			$link=get_page_link(get_post_meta($post->ID, "slider_c_page", TRUE));
			break;
		case "linktocategory":
			$link=get_category_link(get_post_meta($post->ID, "slider_c_cat", TRUE));
			break;
		case "linktopost":
			$link=get_permalink(get_post_meta($post->ID, "slider_c_post", TRUE));
			break;
		case "linkmanually":
			$link=get_post_meta($post->ID, "slider_c_manually", TRUE);
			break;
		case "default":
			$link=get_permalink($post->ID);
			break;
	}
	$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 940,420 ), false, '' );
?>
	<a href="<?php echo $link; ?>">
	<?php
	if($timthumboption == "enable") { ?>
	<img src="<?php bloginfo( 'template_directory' ); ?>/timthumb.php?src=<?php echo $src[0]; ?>&amp;w=600&amp;h=300&amp;zc=1" alt="" title="<?php the_title(); ?>" />
	<?php
	}else{
		the_post_thumbnail('post_slider',array('class' =>'thinframe'));
	} ?>
	</a>
	<?php endwhile; ?>  
	
	</div>
	
	<div class="header_highlight">
	 <?php echo do_shortcode(stripslashes(get_option('nivo_header_highlight'))); ?>
	</div>
</div>
<!-- End: Slider -->