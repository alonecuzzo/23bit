<?php
get_header();
require(sys_includes."/var.php");
?>
	<div id="subheader" class="<?php echo sidebaroption(get_the_id()); ?>">
		<div class='subheader'>
				<div class='subtitle'><?php echo $singleportfoliotitle; ?></h1></div>
			<div class='subdesc'><?php the_title(); ?></div>
		</div>
	</div>
	<!-- subheader -->
</header>
<!-- header -->

<div class="pagemid <?php sidebaroption(get_the_id()); ?>">
<div class="topshadow">	
	<div class="inner">

		<!-- mainfull -->
		<?php $layout = get_post_meta(get_the_id(), 'portfolio_layout_display', true); ?>

		<div id="<?php echo ($layout=="portfolio_fulllayout") ? mainfull:main;?>">

			<?php ($breadcrumbs_display=='') ? my_breadcrumb():''; ?>

			<div class="post">
				<?php
				if (have_posts()) : while (have_posts()) : the_post(); 
				if ($layout=="portfolio_fulllayout"){ $width="936";}else{  $width="600"; } ?>

				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<?php
				if (has_post_thumbnail()) {
					$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', true); ?>
				<div class="portimg">
					<div class="porthumb">
						<a href="<?php echo $image[0]; ?>" rel="prettyPhoto">	<?php if($timthumboption == "enable") { ?>
						<img src="<?php bloginfo( 'template_directory' ); ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;w=<?php echo $width; ?>h=<?php echo $height; ?>" alt="" class="image" />
						<?php }else{ 
						($layout=="portfolio_fulllayout") ? the_post_thumbnail('post_portfolio',array('class' =>'image')):the_post_thumbnail('post_blog',array('class' =>'image'));
						} ?>
						</a>
					</div>
				</div>
				<?php } ?>

				<div class="divider_space"></div>

				<div class="entry">
					<?php the_content(''); ?>
				</div>
					<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
				<?php 
	 if(get_option('portfolionavigation') =="true" ) { ?>
	<div class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->
<?php }
 ?>
			
			</div><!-- post -->
			<div class="clear"></div>

			<?php comments_template(); ?>

			<?php endwhile; else: ?>
			<?php '<p>'.__('Sorry, no posts matched your criteria.', 'versatile_front').'</p>';?>
			<?php endif; ?>

			<?php edit_post_link(__('Edit', 'versatile_front'), '<p>', '</p>'); ?>

		</div>
		
		<?if ($layout=="portfolio_sidebarlayout") { ?>
		<aside id="sidebar">
			<div class="content">
				<?php get_sidebar(); ?>
			</div><!-- content -->
		</aside>
		<!-- sidebar -->
		<?php } ?>

	</div>
	<!-- inner -->			
</div>
</div>
<!-- pagemid -->
<div class="clear"></div>
<?php get_footer(); ?>