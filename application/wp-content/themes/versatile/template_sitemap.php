<?php
/*
Template Name: Sitemap
*/

get_header();
?>
	<div id="subheader" <?php if($subheaderbg_display != '') { ?> style="background-color:<?php echo $subheaderbg_display.'"'; } ?>>
		<?php sub_header_text($post->ID); ?>	
	</div>
	<!-- subheader -->
</header>
<!-- header -->

<div class="pagemid <?php sidebaroption($post->ID); ?>">
<div class="topshadow">	
	<div class="inner">


	<div id="mainfull">
	
		<?php ($breadcrumbs_display=='') ? my_breadcrumb():''; ?>
		<!-- breadcrumb -->

		<h1><?php the_title(); ?></h1>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php the_content(); ?> 
		<?php endwhile; endif; ?>
		<div class="divider_space"></div>
		<div class="one_fourth">
			<h3><?php _e('Pages','versatile_front'); ?></h3>
				<ul class="sitemap"><?php wp_list_pages('title_li=' ); ?></ul>
			</div>

			<div class="one_fourth">
			<h3><?php _e('Feeds','versatile_front'); ?></h3>
				<ul class="sitemap">
					<li><a title="<?php _e('Main RSS','versatile_front'); ?>" href="<?php bloginfo('rss2_url'); ?>"><?php _e('Main RSS','versatile_front'); ?></a></li>
					<li><a title="<?php _e('Comment Feed','versatile_front'); ?>" href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comment Feed','versatile_front'); ?></a></li>
				</ul>
			</div>

			<div class="one_fourth">
			<h3><?php _e('Categories','versatile_front'); ?></h3>
				<ul class="sitemap"><?php wp_list_cats(''); ?></ul>
			</div>

			<div class="one_fourth last">
			<h3><?php _e('Archives','versatile_front'); ?></h3>
				<ul class="sitemap">
					<?php wp_get_archives('type=monthly&show_post_count=true'); ?>
				</ul>
			</div>
	</div>
	<!-- main -->

	</div>
   	<!-- inner -->			
</div>
</div>
<!-- pagemid -->		

<div class="clear"></div>
<?php get_footer(); ?>