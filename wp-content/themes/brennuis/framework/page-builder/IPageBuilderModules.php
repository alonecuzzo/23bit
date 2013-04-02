<?php

/**
 * Interface for page builder modules
 */

interface IPageBuilderModules {
 	
 	/**
	 * list of modules
	 * - each module should return generated html from passed data
	 * 				
	 */

 	/* Posts */
 	public function posts($data);
 	
 	/* Posts column */
 	public function posts_column($data);

 	/* Posts carousel */
 	public function posts_carousel($data);

 	/* Slider */
 	public function slider($data);

 	/* Text full */
 	public function text_full($data);

 	/* Text column */
 	public function text_column($data);

 	/* Video full */
 	public function video_full($data);

 	/* Video column */
 	public function video_column($data);

}

?>