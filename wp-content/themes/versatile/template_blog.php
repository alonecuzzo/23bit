<?php
/*
Template Name: Blog
*/
get_header();
require_once(sys_includes."/var.php");
?>
<?php 
	$subheaderbg_image=get_post_meta($post->ID, 'subheaderbg_image','true');
	if($subheaderbg_image) { ?>
	<style type="text/css">
		<!-- body#<?php if ($layoutoptions){ echo $layoutoptions;} else { echo get_option('layoutoption'); }?> #header { background-image:url(<?php echo $subheaderbg_image; ?>); } -->
	</style>
	<?php } ?>

	<div id="subheader" class="<?php sidebaroption($post->ID); ?>" style="background-color:<?php echo $subheaderbg_display=get_post_meta($post->ID, 'subheaderbg_display','true')?>">
		<?php sub_header_text($post->ID); ?>
	</div>
	<!-- subheader -->
</header>
<!-- header -->

<div class="pagemid <?php sidebaroption($post->ID); ?>">
<div class="topshadow">
	<div class="inner">

		<!-- main -->
		<div id="main">

			<!-- breadcrumb -->
			<?php ($breadcrumbs_display=='') ? my_breadcrumb():''; ?>
			<!-- breadcrumb -->	

			<div class="content">
				
				<?php	
				$blog_cats=get_post_meta($post->ID, "sys32_cats", true);
				$blog_all_cats=substr($blog_cats,0,-1);
				if ( get_query_var('paged') ) {
					$paged = get_query_var('paged');
				} elseif ( get_query_var('page') ) {
					$paged = get_query_var('page');
				} else {
					$paged = 1;  
				}
				query_posts("cat=$blog_all_cats.&paged=$paged");
				
				if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<div class="blogpost">
					<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

					<?php
					if (has_post_thumbnail()) {
						$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', true); ?>	
						<div class="portimg clearfix" style="width:604px;">
							<div class="porthumb">
								<?php if($bloglightbox == "true") { ?>
								<a rel="prettyPhoto" href="<?php echo $image['0']; ?>">
								<?php }else{ ?>
								<a  href="<?php the_permalink(); ?>">
								<?php } ?>
									<?php
									if($timthumboption == "enable") { ?>
										<img src="<?php bloginfo( 'template_directory' ); ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;w=600&amp;h=200&amp;zc=1&amp;q=100" alt="" class="image" />
									<?php 
									} else { 
										the_post_thumbnail('post_blog',array('class' =>'image'));  } ?>
								</a>
							</div>
						</div>
						<div class="clear"></div>
					<?php } ?>

					<div class="post-info">
						<span><?php the_time('M, D jS, Y') ?></span>
						<span><?php _e('Posted in','versatile_front')?> : <?php the_category(', ') ?> </span>
						<span><?php _e('By','versatile_front')?> : <?php the_author_posts_link(); ?> </span>
						<span><a href="<?php the_permalink(); ?>#comments" title="<?php __('View Comments','versatile_front')?>"><?php comments_number(0, 1, '%'); ?> <?php _e('Comments','versatile_front');?></a></span>
				
						<?php the_tags();?>
					</div>

					<?php global $more; $more = 0;  the_excerpt(''); ?>	
					
					<a href="<?php the_permalink() ?>" class="more-link alignright"><span><?php $readmoretext; ?></span></a>

				</div>
				<!-- post -->
				<?php endwhile; ?>

			<?php if(function_exists('atp_pagination')) { atp_pagination(); } ?>
				<?php
				
				else :
					if ( is_category() ) { // If this is a category archive
							printf('<h2 class="center">'.__( 'Sorry, but there aren\'t any posts in the %s category yet.', 'versatile_front' ).'</h2>', single_cat_title('',false));
					} else if ( is_date() ) { // If this is a date archive
						echo('<h2>'.__( 'Sorry, but there aren\'t any posts with this date.', 'versatile_front' ).'</h2>');
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
			
		</div>
		<!-- main -->

		<aside id="sidebar">
			<div class="content">
				<?php get_sidebar(); ?>
			</div>
		</aside>
		<!-- sidebar -->
		
		<div class="clear"></div>
	</div>
   	<!-- inner -->			
</div>
</div>
<!-- pagemid -->
<div class="clear"></div>
<?php get_footer(); ?>