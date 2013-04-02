<?php
/*
* Theme Name: Timeline Template
*
* Description: Timeline Template is a clean and minimal wordpress template, 
* intended to showcase your work, blog or interests in an unique modern way, 
* using the trendy timeline look.
*
* Version: 1.0 
*/
?>


<?php get_header();?>

<?php
//BEGIN LOOP
//=====================================================
if(have_posts()) : ?><?php while(have_posts()) : the_post(); 

	//the_meta();
	$id = get_the_ID();
		$post_meta_data = get_post_custom($post->ID);
		if(isset($post_meta_data['custom_repeatable'][0]) ){
			$custom_repeatable = unserialize($post_meta_data['custom_repeatable'][0]); 
		}	
		if(isset( $post_meta_data['custom_select_row_position'][0])){
			$row_position = $post_meta_data['custom_select_row_position'][0];
		}else{ 
			$row_position = "center";
			$img_position = "inside";
			$post_showtitle = "show";
			$post_showcategory = "show";
			$post_showsoc = "show";
		}
		if(isset($post_meta_data['custom_select_img_style'][0]))
		 	$img_syle = $post_meta_data['custom_select_img_style'][0];
		else $img_syle ='';
		if(isset($post_meta_data['custom_select_img_position'][0]))
			$img_position = $post_meta_data['custom_select_img_position'][0];
		else $img_position ='';
		if(isset($post_meta_data['custom_select_img_size'][0]))
			$img_size = $post_meta_data['custom_select_img_size'][0];
		else $img_size ='';
		if(isset($post_meta_data['custom_img_title'][0]))
			$img_title = $post_meta_data['custom_img_title'][0];
		else $img_title ='';
		if(isset($post_meta_data['custom_img_content'][0]))
			$img_content = $post_meta_data['custom_img_content'][0];
		else $img_content ='';
		if(isset($post_meta_data['custom_img_link'][0]))
			$img_link = $post_meta_data['custom_img_link'][0];
		else $img_link='';
		if(isset($post_meta_data['custom_img_buttontitle'][0]))
			$img_buttontitle = $post_meta_data['custom_img_buttontitle'][0];
		else $img_buttontitle ='';
		if(isset($post_meta_data['custom_select_img_badge'][0]))
			$img_badge = $post_meta_data['custom_select_img_badge'][0];
		else $img_badge='';
        if(isset($post_meta_data['custom_select_show_soc'][0]))
			$post_showsoc = $post_meta_data['custom_select_show_soc'][0];
		else $post_showsoc ='';
		if(isset($post_meta_data['custom_select_show_title'][0]))
			$post_showtitle = $post_meta_data['custom_select_show_title'][0];
		else $post_showtitle = '';
		if(isset($post_meta_data['custom_select_show_category'][0]))
			$post_showcategory = $post_meta_data['custom_select_show_category'][0];
		else $post_showcategory = '';
	
	//JAVASCRIPT FOR FLEX SLIDER AND FADE IN
	//=====================================================?>
    <script>   
		jQuery( document ).ready( function($){	
	   		$('.add-opacity-fx').animate({opacity:1}, 1500);
		});
		//javascript:history.go(-1)
	</script>
	<script>
		jQuery( document ).ready( function($){				 					 
		  $('#flexslider-<?php echo $id;?>').flexslider({
			animation: "fade",
			controlNav: false,
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		
		});
	</script><?php
    //ROW BODY
	//=====================================================?>
	<div class="ss-row-f add-opacity-fx">
		<div class="time-dot-date">
			<div class="arrow-date-border"></div>
			<div class="arrow-date"></div>
			<div class="container-border">
				<div class="gray-container">
					<?php echo get_the_date(); ?>
				</div>
			</div>
		</div>
		<div class="time-dot"></div>
		<div class="ss-full"><?php 
			if(apply_filters( 'the_content', get_the_content()) !='' || $post_showtitle == 'hide' ){ ?>
                <div class="arrow-up"></div>
                <div class="arrow-side"></div>
                <div class="container-border">
                    <div class="gray-container single-page-t"> <?php 
                        if(has_post_thumbnail()) {	
							$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 720,405, ), true );
							$srcf = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full', true );
							
								if($img_badge =='new'){?>
									<div class="badge badge-1 badge-top-padding"></div><?php
								}
								if($img_badge =='hot'){?>
									<div class="badge-hot badge-hot-top-padding"></div><?php
								}
							
							if($custom_repeatable[0] != ''){?>
								<div id="flexslider-<?php echo $id;?>" class="flexslider">
									<ul class="slides">
										<li>
											<div class="hover-effect h-style"><?php 
												if($img_title || $img_content){ ?>
													<img src="<?php echo $src[0]; ?>" class="clean-img"/> 
													<div class="mask"><?php 
														if($img_title){ ?>
															<h2><?php echo $img_title; ?></h2> <?php 
														}; ?>
														<p><?php echo $img_content; ?></p><?php
														 if($img_link){ ?>
															<a href="<?php echo $img_link; ?>" class="info" > <span class="button violet"><?php echo $img_buttontitle; ?></span></a><?php
														 }; ?>
													</div><?php 
												}else{ ?>
													<a href="<?php echo $srcf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $src[0]; ?>" class="clean-img"/> 
														<div class="mask">
															<span class="img-rollover"></span>
														</div>
													</a><?php 
												};?>
											</div>
										</li> <?php
										foreach ($custom_repeatable as $string) {
											$srcslider = wp_get_attachment_image_src( $string, array( 720,405, ), true );
											$srcsliderf = wp_get_attachment_image_src( $string, 'full', true );?>
											<li>
												<div class="hover-effect h-style">
													<a href="<?php echo $srcsliderf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $srcslider[0]; ?>" class="clean-img"/> 
														<div class="mask">
															<span class="img-rollover"></span>
														</div>
													</a>
												</div>
											</li> <?php 
										};?>
									</ul>
								</div> <?php
							}else{?>
								<div class="hover-effect h-style"><?php 
									if($img_title || $img_content){ ?>
										<img src="<?php echo $src[0]; ?>" class="clean-img"/> 
										<div class="mask"><?php 
											if($img_title){ ?>
												<h2><?php echo $img_title; ?></h2><?php  
											}; ?>
											<p><?php if($img_content) echo $img_content; ?></p><?php 
											if($img_link){ ?>
												<a href="<?php echo $img_link; ?>" class="info" > <span class="button violet"><?php echo $img_buttontitle; ?></span></a><?php
											}; ?>
										</div><?php 
									}else{ ?>
										<a href="<?php echo $srcf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $src[0]; ?>" class="clean-img"/>
											<div class="mask">
												<span class="img-rollover"></span>
											</div>
										</a><?php
									};?>
								</div><?php 
							};
						};
						if(apply_filters ('the_title', get_the_title()) !=''  ) {
							if($post_showtitle != 'hide'){?>                         	
								<h1 class="content-title single-page-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1> <?php 
							};
                        };
                        the_content();  
                        
                        if($post_showcategory != "hide"){ ?>
                            <div class="icon-soc-container">
                                <div class="share-btns">
                                    <?php
                                    $category = get_the_category(); ?> 
                                    <div class="single-page-cat"><div class="icon-s category-ico"></div><a href="<?php echo get_category_link( $category[0]->term_id );?>"><?php echo $category[0]->cat_name;?></a>
                                    </div> 
                                    <div class="single-page-cat"><div class="icon-s user-ico"></div><?php  the_author(); ?> 
                                    </div> 
									<div class="single-page-cat"><div class="icon-s comments-ico"></div><a href="<?php comments_link(); ?>"> <?php comments_number( '0', '1', '%' ); ?></a>
                                    </div>
                                    <div class="navigation empty-right"><?php 	
       								 	previous_post_link('<strong>&larr;</strong> %link') ?> | <?php next_post_link(' %link <strong>&rarr;</strong>')?>
    								</div>
                                </div>   
                            </div><?php
                        };?>
                    </div>
                        
                </div><?php
                
                if($post_showsoc == "show"){
                
               		if( of_get_option('fb-link') !='' || of_get_option('tw-link') !='' || of_get_option('li-link') !='' || of_get_option('yt-link') !='' || of_get_option('vm-link') !='' || of_get_option('fl-link') !='' || of_get_option('da-link') !='' || of_get_option('su-link') !='' || of_get_option('di-link') !=''){?>
                        <div class="icon-soc-container-alone ">
                            <div class="container-border">
                                <div class="gray-container " > 
                                    <ul ><?php 
                                        if(of_get_option('fb-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('fb-link-tooltip');?>" target="_blank" rel="tooltip"  href="<?php echo of_get_option('fb-link');?>"><div class="icon-soc facebook-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('tw-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('tw-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('tw-link');?>"><div class="icon-soc twitter-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('li-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('li-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('li-link');?>"><div class="icon-soc linkedin-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('yt-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('yt-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('yt-link');?>"><div class="icon-soc youtube-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('vm-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('vm-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('vm-link');?>"><div class="icon-soc vimeo-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('fl-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('fl-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('fl-link');?>"><div class="icon-soc flickr-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('da-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('da-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('da-link');?>"><div class="icon-soc devianart-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('su-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('su-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('su-link');?>"><div class="icon-soc stumbleupon-ico"></div></a></li><?php
                                        };
                                        if(of_get_option('di-link') !=''){?>
                                            <li><a title="<?php echo of_get_option('di-link-tooltip');?>" target="_blank" rel="tooltip "  href="<?php echo of_get_option('di-link');?>"><div class="icon-soc digg-ico"></div></a></li><?php
                                        };?>
                                   </ul>
                                </div>	
                            </div>
                        </div> <?php   
                    };
                };
            }; ?> 
        </div>
	</div><?php
	comments_template(); ?>
<?php endwhile; ?>
<?php endif; ?>
<?php get_sidebar(); ?>	
<?php get_footer(); ?>