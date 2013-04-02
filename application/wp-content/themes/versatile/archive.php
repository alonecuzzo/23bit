<?php
get_header();
require(sys_includes."/var.php");
?>
<!-- start:subheader -->
	<div id="subheader" class="<?php sidebaroption($post->ID); ?>" <?php if($subheaderbg_display != '') { ?> style="background-color:<?php echo $subheaderbg_display.'"'; } ?>>
	<div class="subheader">
		<div class="subtitle"><h1><?php _e('Archive','versatile_front'); ?></h1></div><div class="subdesc"><?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  	<?php /* If this is a category archive */ if (is_category()) { ?>
		<h3><?php _e('Category Archive for the','versatile_front'); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('Category','versatile_front'); ?></h3>
 	 	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h3><?php _e('Posts Tagged ','versatile_front'); ?>&#8216;<?php single_tag_title(); ?>&#8217;</h3>
 	  	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h3><?php _e('Daily Archive for ','versatile_front'); ?><?php the_time('F jS, Y'); ?></h3>
 	  	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h3><?php _e('Monthly Archive for ','versatile_front'); ?> <?php the_time('F, Y'); ?></h3>
 	  	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h3><?php _e('Yearly Archive for ','versatile_front'); ?> <?php the_time('Y'); ?></h3>
	  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h3><?php _e('Author Archive','versatile_front'); ?></h3>
 	  	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h3><?php _e('Blog Archives','versatile_front'); ?></h3>
 	  	<?php } ?>
		</div></div>
</div>
<!-- end:subheader -->
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
			<!-- post -->
			<div class="blogpost">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	
				<?php
				if (has_post_thumbnail()) {
					$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', true);
				?>	
				<div class="portimg clearfix">
					<div class="porthumb">
					<?php if(get_option('bloglightbox') == "true") { ?>
								<a rel="prettyPhoto" href="<?php echo $image['0']; ?>">
								<?php }else{ ?>
								<a  href="<?php the_permalink(); ?>">
								<?php } ?>				
					<?php if($timthumboption == "enable") { ?><img src="<?php bloginfo( 'template_directory' ); ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;w=600&amp;h=150" alt="" class="image" />
						<?php
						} else {
						the_post_thumbnail('post_blog',array('class' =>'image'));  } ?>
						</a>
					</div>
				</div>	
				<?php } ?>

				<div class="post-info">
					<span><?php the_time('M, D jS, Y'); ?></span>
					<span><?php _e('Posted in','versatile_front'); ?> : <?php the_category(', '); ?> </span>
					<span><?php _e('By','versatile_front'); ?> : <?php the_author_posts_link(); ?> </span>
					<span><a href="<?php the_permalink(); ?>#comments" title="<?php __('View Comments','versatile_front'); ?>"><?php comments_number(0, 1, '%'); ?> <?php _e('Comments','versatile_front'); ?></a></span>
					<?php the_tags();?>
				</div>
			
				<?php global $more; $more = 0;  the_excerpt(''); ?>	

				<a href="<?php the_permalink() ?>" class="more-link alignright"><span><?php echo $readmoretext;?></span></a>
			
			</div>
			<!-- post -->
				
			<?php endwhile; ?>
			<?php if(function_exists('atp_pagination')) { atp_pagination(); } ?>
			<!-- pagination -->
				<?php else :
				if ( is_category() ) { // If this is a category archive
					printf('<h2 class="center">'.__( 'Sorry, but there aren\'t any posts in the %s category yet.', 'versatile_front' ).'</h2>', single_cat_title('',false));
				} else if ( is_date() ) { // If this is a date archive
				echo("<h2>'.__( 'Sorry, but there aren\'t any posts with this date.', 'versatile_front' ).'</h2>");
				} else if ( is_author() ) { // If this is a category archive
					$userdata = get_userdatabylogin(get_query_var('author_name'));
					printf('<h2 class="center">'.__( 'Sorry, but there aren\'t any posts by %s yet.', 'versatile_front' ).'</h2>', $userdata->display_name);
				} else {
					echo('<h2 class="center">'.__( 'No posts found.', 'versatile_front').'</h2>');
					}
				get_search_form();
				endif;
				?>
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