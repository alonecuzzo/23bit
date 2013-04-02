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
<?php get_header();
?>
<div id="posts" <?php post_class(); ?>>
<?php
	//SORT ONLY STICKY ON HOME PAGE
	//=====================================================
	if(!is_archive() && !is_search()){
	   if ( is_home()  ){
		$sticky = get_option( 'sticky_posts' );
		rsort( $sticky );
		query_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) ); }
	};
	//BEGIN LOOP
	//=====================================================
	if(have_posts()) : while ( have_posts() ) : the_post();
	
	//DONT SHOW PAGES IN SEARCH RESULT
	//=====================================================
	if (is_search() && ($post->post_type=='page')) continue;
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
				$('.add-opacity-fx').animate({opacity:1},1500);
      		});
		</script>
		<script>
			jQuery(document).ready(function($) {		 					 
				$('#flexslider-<?php echo $id;?>').flexslider({
					animation: "fade",
					controlNav: false,
					start: function(slider){
				  		$('body').removeClass('loading');
					}
			  	});
			});
		</script><?php
		do_shortcode( get_the_content() );
		
		//ROW BODY
		//=====================================================?>
        
		<div class="ss-row add-opacity-fx <?php 
			if($img_syle == "circle"){ 
				if($img_size == "big"){ ?>
					circle-img-3<?php 
				}else if($img_size == "medium"){ ?>
					circle-img-2<?php 
				}else if($img_size == "small"){ ?>
					circle-img-1<?php 
				};
			};?> ">
			<div class="time-dot-date" style="">
				<div class="arrow-date-border"></div>
                <div class="arrow-date"></div>
                <div class="container-border">
                    <div class="gray-container">
                        <?php echo get_the_date(); ?>
                    </div>
                </div>
            </div>
            <div class="time-dot"></div><?php 
			if($row_position == 'left') {  ?>
        		<div class="ss-left empty-left"><?php 
        	};
			if($row_position == 'right') {?> 
				<div class="ss-right empty-right"><?php
			};
			if($row_position == 'center') {?> 
				<div class="ss-full"><?php  
			};
		
			if(apply_filters( 'the_content', get_the_content()) != '' || $post_showtitle == 'hide' && has_post_thumbnail() && $img_position == 'inside'){ ?>
                <div class="arrow-up"></div>
                <div class="arrow-side"></div>
                <div class="container-border">
                    <div class="gray-container"> <?php 
                   		if(apply_filters ('the_title', get_the_title()) !=''  ) {
							if($post_showtitle != 'hide'){?>                         	
                        		<h3 class="content-title <?php if(has_post_thumbnail() && $img_position == 'inside' || $row_position == 'center') { ?> content-title-no-b <?php }; ?>"><a id="<?php echo $id;?>"  href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3> <?php 
							};
                    	};
						if(has_post_thumbnail()) {	
							if($img_position == 'inside' || $row_position == 'center' ) {  
								if($row_position == 'center'){
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 720,205, ), true );
									$srcf = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', true );
								}else if($img_position == 'inside'){
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 720,405, ), true );
									$srcf = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', true );
								};
								
								if($img_badge =='new'){?>
									<div class="badge badge-1 <?php if($row_position == 'center'){ ?>badge-top-padding<?php };?>"></div><?php
								}
								if($img_badge =='hot'){?>
									<div class="badge-hot <?php if($row_position == 'center'){ ?>badge-hot-top-padding<?php };?>"></div><?php
								}
								
								if($custom_repeatable[0] != ''){?>

                                	<div id="flexslider-<?php echo $id;?>" class="flexslider">
                                    	<ul class="slides">
                                        	<li>
                                        		<div class="hover-effect h-style"><?php 
													if($img_title || $img_content ){ ?>
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
												if($row_position == 'center'){
													$srcslider = wp_get_attachment_image_src( $string, array( 720,205, ), true );
													$srcsliderf = wp_get_attachment_image_src( $string, 'full', true );
												}else if($img_position == 'inside'){
													$srcslider = wp_get_attachment_image_src( $string, array( 720,405, ), true );
													$srcsliderf = wp_get_attachment_image_src( $string, 'full', true );
												};?>
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
                                		if($img_title || $img_content ){ ?>
											<img src="<?php echo $src[0]; ?>" class="clean-img"/> 
											<div class="mask"><?php 
												if($img_title){ ?>
													<h2><?php echo $img_title; ?></h2><?php  
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
                            		</div><?php 
                            	};
							};
						};
						
                    	the_content();  
											
						if($post_showcategory != "hide"){ ?>
                            <div class="icon-soc-container">
                                <div class="share-btns">
                                    <div class="empty-right"><div class="icon-s comments-ico"></div><a href="<?php comments_link(); ?>"> <?php comments_number( '0', '1', '%' ); ?></a>
                                    </div> <?php
                                    $category = get_the_category(); ?> 
                                    <div class="empty-left"><div class="icon-s category-ico"></div><a href="<?php echo get_category_link( $category[0]->term_id );?>"><?php echo $category[0]->cat_name;?></a>
                                    </div> 
                                </div>   
							</div><?php
						};?>
					</div>
						
				</div><?php
				
				if($post_showsoc == "show"){
				
				if( of_get_option('fb-link') !='' || of_get_option('tw-link') !='' || of_get_option('li-link') !='' || of_get_option('yt-link') !='' || of_get_option('vm-link') !='' || of_get_option('fl-link') !='' || of_get_option('da-link') !='' || of_get_option('su-link') !='' || of_get_option('di-link') !=''){        
                ?>
                    <div class="icon-soc-container-alone">
                        <div class="container-border">
                            <div class="gray-container"> 
                                <ul><?php 							
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
					}
				};
			}; ?>
		</div><?php 
		
		if(has_post_thumbnail() && $row_position != 'center' ) {
			if($img_position == 'right' || $img_position == 'left') {  
				if($img_position == 'right'){?>
                	<div class="ss-right empty-right"><?php 
            	}else if($img_position == 'left'){?>
					<div class="ss-left empty-left" ><?php
			 	}; 
             	if($img_syle == "square" || $img_syle == "circle"){ ?>
               		<div class="ss-long-arrow"></div><?php 
                };?>
                <div class="arrow-side"></div><?php 
                if($img_size == 'big') {  ?>
                	<div class="container-border <?php if($img_position == 'left'){?>empty-right <?php }; ?> <?php if($img_position == 'right'){?>empty-left <?php }; ?> <?php if($img_syle == "default"){ ?> c-size-big <?php };?><?php if($img_syle == "square"){ ?> img-padding c-size-big  <?php };?> <?php if($img_syle == "circle"){ ?> circle-img-b<?php };?> " > <?php 
               	}else if($img_size == 'medium'){ ?>
               		<div class="container-border  <?php if($img_position == 'left'){?>empty-right <?php }; ?><?php if($img_position == 'right'){?>empty-left <?php }; ?>  <?php if($img_syle == "default"){ ?> c-size-large <?php };?><?php if($img_syle == "square"){ ?> c-size-large img-padding <?php };?> <?php if($img_syle == "circle"){ ?> circle-img-b <?php };?> "  > <?php 
				}else if($img_size == 'small'){ ?>
                	<div class="container-border <?php if($img_position == 'left'){?>empty-right <?php }; ?><?php if($img_position == 'right'){?>empty-left <?php }; ?> <?php if($img_syle == "default"){ ?>c-size-small<?php };?> <?php if($img_syle == "square"){ ?> c-size-small img-padding<?php };?> <?php if($img_syle == "circle"){ ?>circle-img-b<?php };?> " ><?php 
                }; ?>
                	<div class="gray-container  <?php if($img_syle == "circle"){ ?> circle-img-c<?php };?> <?php if($img_syle == "square"){ ?> img-padding-c<?php };?>" ><?php 
                    	if ( has_post_thumbnail()) {  
							if($img_syle == "circle"){
								if($img_size == "big"){
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 310,310, ), true );
								}
								if($img_size == "medium"){
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 220, 220, ), true );
								}
								if($img_size == "small"){
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 150, 150, ), true );
								}
							}else{
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 720, 405, ), true );
									$srcf = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', true );
							}
							if($custom_repeatable[0] != ''){
								
									if($img_badge =='new' && $img_syle != "circle"){?>
												<div class="badge badge-1 <?php if($img_size != 'big' && $img_syle == "square") {  ?> m-pading <?php };?>"></div><?php
											}
									if($img_badge =='hot' && $img_syle != "circle"){?>
										<div class="badge-hot <?php if($img_size != 'big' && $img_syle == "square") {  ?> b-pading <?php };?>"></div><?php
									}
							
								?>
                                	<div id="flexslider-<?php echo $id;?>" class="flexslider" >
                                    	<ul class="slides">
                                          <!--[if IE]><div style="width:340px; min-width:340px;"></div> <![endif]-->
                                        	<li> <?php
                                            	if($img_syle == "circle"){ ?>
                                                    <ul class="ch-grid">
                                                        <li>
                                                            <div class="ch-item" style="background-image: url(<?php echo $src[0]; ?>);">				
                                                                <div class="ch-info-wrap">
                                                                    <div class="ch-info">
                                                                        <div class="ch-info-front" style="background-image: url(<?php echo $src[0]; ?>);"></div>
                                                                        <div class="ch-info-back">
                                                                            <h3><?php if($img_title) echo $img_title; ?></h3>
                                                                            <p><?php if($img_content) echo $img_content; ?></p>
                                                                            <?php if($img_link){ ?>
                                                                            <a href="<?php echo $img_link; ?>" ><?php echo $img_buttontitle; ?></a>
                                                                            <?php };?>
                                                                        </div>	
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul><?php
                                                }else{ ?>
                                                    <div class="hover-effect h-style"><?php 
                                                       if($img_title || $img_content ){?>
                                                            <img src="<?php echo $src[0]; ?>" class="clean-img"/> 
                                                            <div class="mask"><?php 
                                                                if($img_title){ ?>
                                                                    <h2><?php echo $img_title; ?></h2> <?php 
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
                                            	};?>
                                        	</li> <?php
											foreach ($custom_repeatable as $string) {
													if($img_syle == "circle"){
														if($img_size == "big"){
															$srcslider = wp_get_attachment_image_src( $string, array( 310,310, ), true );
														}
														if($img_size == "medium"){
															$srcslider = wp_get_attachment_image_src( $string, array( 220, 220, ), true );
														}
														if($img_size == "small"){
															$srcslider = wp_get_attachment_image_src( $string, array( 150, 150, ), true );
														}
													}else{
															$srcslider = wp_get_attachment_image_src( $string, array( 720,405, ), true );
															$srcsliderf = wp_get_attachment_image_src( $string, 'full', true );
													}?>
                                                <li><?php
                                                	if($img_syle == "circle"){ ?>
                                                        <ul class="ch-grid">
                                                            <li>
                                                                <div class="ch-item" style="background-image: url(<?php echo $srcslider[0]; ?>);">				
                                                                    <div class="ch-info-wrap">
                                                                        <div class="ch-info">
                                                                            <div class="ch-info-front" style="background-image: url(<?php echo $srcslider[0]; ?>);"></div>
                                                                            <div class="ch-info-back">
                                                                            	<h3><?php if($img_title) echo $img_title; ?></h3>
                                                                                <p><?php if($img_content) echo $img_content; ?></p>
                                                                                <?php if($img_link){ ?>
                                                                                <a href="<?php echo $img_link; ?>" ><?php echo $img_buttontitle; ?></a>
                                                                                <?php };?>
                                                                            </div>	
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul><?php
                                                    }else{ ?>
                                                        <div class="hover-effect h-style">
                                                            <a href="<?php echo $srcsliderf[0]; ?>" rel="prettyPhotoImages[<?php echo $id; ?>]"><img src="<?php echo $srcslider[0]; ?>" class="clean-img"/> 
                                                                <div class="mask">
                                                                    <span class="img-rollover"></span>
                                                                </div>
                                                            </a>
                                                        </div><?php
                                                    };?>
                                                </li> <?php 
											};?>
										</ul>
									</div> <?php
								}else{
									if($img_syle == "circle"){ ?>
										<ul class="ch-grid">
											<li>
												<div class="ch-item" style="background-image: url(<?php echo $src[0]; ?>);">				
													<div class="ch-info-wrap">
														<div class="ch-info">
															<div class="ch-info-front" style="background-image: url(<?php echo $src[0]; ?>);"></div>
															<div class="ch-info-back">
																<h3><?php if($img_title) echo $img_title; ?></h3>
                                                                <p><?php if($img_content) echo $img_content; ?></p>
                                                                <?php if($img_link){ ?>
                                                                <a href="<?php echo $img_link; ?>" ><?php echo $img_buttontitle; ?></a>
                                                                <?php };?>
															</div>	
														</div>
													</div>
												</div>
											</li>
										</ul><?php
									}else{ 
										
									
											if($img_badge =='new'){?>
												<div class="badge badge-1 <?php if($img_size != 'big' && $img_syle == "square") {  ?> m-pading <?php };?>"></div><?php
											}
											if($img_badge == 'hot'){?>
												<div class="badge-hot <?php if($img_size != 'big' && $img_syle == "square") {  ?> b-pading <?php };?>"></div><?php	
											}
										?>
										<div class="hover-effect h-style">  <?php
											if($img_title || $img_content ){ ?>
												<img src="<?php echo $src[0]; ?>" class="clean-img"/> 
												<div class="mask"><?php
													if($img_title){ ?>
														<h2><?php echo $img_title; ?></h2><?php
													}; ?>
													<p><?php echo $img_content; ?></p><?php	
													if($img_link){
														
														 $img_linkaa = $inkaa;?>
                                                   
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
                        	};?>
                        </div>
                    </div>
                </div><?php 
			};
        };?>
	</div>
		<?php endwhile; ?>
        
          <?php else : ?>
         
            <div class="ss-full s-no-result"> 
                <div class="time-dot time-dot-show"></div>
                <div class="arrow-up"></div>
                <div class="container-border">
                    <div class="gray-container" >

                        <h1 class="content-title"><?php _e( 'Nothing Found', 'timeline' ); ?></h1>
                            <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'timeline' ); ?></p>
                            <p><?php echo get_search_form(); ?></p>
                    </div>
                </div>
            </div>        
        </div>
  <?php endif; 
  add_editor_style()
  
  ?>
  
  	<div style="display:none;"><?php  the_post_thumbnail() ;  posts_nav_link() ?> <?php wp_link_pages();  the_tags();
?></div>
	</div>
<?php get_footer(); ?>