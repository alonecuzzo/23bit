<?php  
/**
 * Post Formats Footer 
 */

$comm_num = get_comments_number();

?>

	<footer>
		<span class="meta">
			<?php the_time("d F Y "); _e('by ','framework'); the_author_posts_link(); _e(' in ','framework'); the_category( ', ', 'multiple', false ); ?> / 
			
			<?php if($comm_num > 0): ?>

				<a href="<?php the_permalink(); ?>#comments" title="Comments">
			
			<?php endif; ?>
				
				<?php comments_number(__('No Comments', 'framework'), '1 '.__('Comment', 'framework'), '% '.__('Comments', 'framework')); ?>

			<?php if($comm_num > 0): ?>
				</a>
			<?php endif; ?>

		</span>
		    					
			<?php if( get_option('ln_theme_blog_enable_post_preview_share') == 'true'): ?>
		    	
		    	<ul class="share">
		    		<li>
		    			<a class="no-eff" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink(get_the_ID()) ).'&amp;media='.urlencode( wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ).'&amp;description='.urlencode(get_the_excerpt()); ?>">
		    				<img src="<?php echo INC_CSS.'/images/light/social/share-pinterest.png'; ?>" alt="Share on Pinterest" title="Share on Pinterest"/>
		    				</a>
		    		</li>
		    		<li>
		    			<a class="no-eff" target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" >
		    			<img src="<?php echo INC_CSS.'/images/light/social/share-facebook.png'; ?>" alt="Share on Facebook" title="Share on Facebook" />
		    			</a>
		    		</li>
					<li>
						<a class="no-eff" target="_blank" href="http://twitter.com/home?status=<?php echo urlencode(get_the_title()).'%20-%20'.get_permalink(get_the_ID()); ?>">
						<img src="<?php echo INC_CSS.'/images/light/social/share-twitter.png'; ?>" alt="Share on Twitter" title="Share on Twitter" />
						</a>
					</li>
		    	</ul>

		    <?php endif; ?>

		  	<div class="clear"></div>
	</footer>
</article>