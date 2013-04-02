<?php
get_header();
?>
	<div id="subheader">	
		<?php sub_header_text($post->ID); ?>
	</div>
<!-- subheader -->
</header>
<!-- header -->

<div class="pagemid <?php sidebaroption($post->ID); ?>">
<div class="topshadow">	
	<div class="inner">

		<!-- mainfull -->
		<div id="mainfull">

			<div class="post">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<?php
				if (has_post_thumbnail()) {
				$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', true); ?>	
				<div class="portimg">
					<div class="porthumb">
						<a href="<?php echo $image[0]; ?>" rel="prettyPhoto">
						<?php if($timthumboption == "enable") { ?>
						<img src="<?php bloginfo( 'template_directory' ); ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;w=936" alt="" class="image" />	<?php }else{ the_post_thumbnail(array(936,9999,'true'));  } ?></a>
					</div>
				</div>
				<?php } ?>	

				<div class="divider_space"></div>

				<div class="entry">
				<?php the_content(''); ?>
				</div>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>

			</div><!-- post -->
			<div class="clear"></div>

			<?php 
			$comments=get_option('commentstemplate');
			if($comments=="posts" ||  $comments=="both"){
				comments_template('', true); 
			}?>	

			<?php endwhile; else: ?>

			<?php '<p>'.__('Sorry, no posts matched your criteria.', 'versatile_front').'</p>'?>

			<?php endif; ?>

		</div>
		
	<!-- inner -->			
	</div>
</div>
</div>
<!-- pagemid -->
<div class="clear"></div>
<?php get_footer(); ?>