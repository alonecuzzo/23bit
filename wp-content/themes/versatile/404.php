<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
require(sys_includes."/var.php");
?>
</header>
<!-- header -->
<div class="pagemid <?php sidebaroption($post->ID); ?>">
<div class="topshadow">	
	<div class="inner">

		<div id="mainfull">
		
			<!-- breadcrumb -->
			<?php ($breadcrumbs_display=='') ? my_breadcrumb():''; ?>
			<!-- breadcrumb -->

			<div class="content">
				<h2 class="aligncenter"><?php echo $error404txt; ?></h2>
			
				<div class="divider"></div>
				
				<?php include(TEMPLATEPATH. '/search-box.php'); ?>
				
				<div class="divider"></div>
				
				<div class="one_half">
					<h3><?php _e('Pages','versatile_front')?></h3>
					<ul class="sitemap"><?php wp_list_pages('title_li=' ); ?></ul>
				</div>

				<div class="one_fourth">
					<h3><?php _e('Feed','versatile_front')?></h3>
					<ul class="sitemap">
						<li><a title="Full content" href="<?php bloginfo('rss2_url'); ?>"><?php _e('Main RSS','versatile_front'); ?></a></li>
						<li><a title="Comment Feed" href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comment Feed','versatile_front'); ?></a></li>
					</ul>
				</div>

				<div class="one_fourth last">
					<h3><?php _e('Categories','versatile_front'); ?></h3>
					<ul class="sitemap"><?php wp_list_cats(''); ?></ul>
					
					<h3><?php _e('Archives','versatile_front'); ?></h3>
					<ul class="sitemap">
					<?php wp_get_archives('type=monthly&show_post_count=true'); ?>
					</ul>
				</div>

			</div>
			<!-- content -->
		</div>
		<!-- main -->

	</div>
   	<!-- inner -->			
</div>
</div>
<!-- pagemid -->		
<div class="clear"></div>
<?php get_footer(); ?>