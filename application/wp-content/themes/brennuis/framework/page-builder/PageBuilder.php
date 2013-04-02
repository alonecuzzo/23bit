<?php

require_once ( INC_PATH . '/page-builder/IPageBuilderModules.php' ); 
require_once ( INC_PATH . '/page-builder/Modules.php' );
require_once ( INC_PATH . '/page-builder/ModulesAdminView.php' );

/**
 * Page builder
 *
 * - manage saving and displaying of different page modules
 *
 * @author Lion : http://themeforest.net/user/Lion
 * @version 1.0
 *  
 */
class PageBuilder {

	/* constants */
	const FRONT_VIEW = 'FRONTEND';
	const BACK_VIEW = 'BACKEND';
	const PAGE_BUILDER_META_ID = 'ln_page_builder_unfold_meta_structure';

	/* @private properties */
	private $data;
	private $id;
	private $builder_modules;
	
	/**
	 * Constructor
	 *
	 * @param $data array of $_POST data
	 * @param $id page/post id
	 *
	 */
	public function __construct($data, $id) {
		
		if(is_array($data)){
			$this->data = $data;
		}

		if(isset($id)){
			$this->id = $id;
		}
	}

	/**
	 * Save Data
	 *
	 * - saves post data as post/page meta to passed post/page id
	 * - data will be saved to DB as an serialized array which wordpress do automatically when we save an array into DB.
	 *
	 * @param $id - post/page id
	 *
	 */
	public static function save_data($id){
				
		
		if(isset($id)){

			// create an array with page builder modules and save it to wordpress DB
			$structure = array();

			if(isset($_POST['module_id'])){

				// loop thru post data and add modules to structure array
				foreach ($_POST['module_id'] as $k => $v) {
					
					$module_id = addslashes($_POST['module_id'][$k]);
					$title = addslashes($_POST['title'][$k]);
					$category_name = addslashes($_POST['category_name'][$k]);
					$number_of_items = addslashes($_POST['number_of_items'][$k]);
					$embed_code = addslashes($_POST['embed_code'][$k]);
					$custom_text = addslashes($_POST['custom_text'][$k]);
					$custom_text_type = addslashes($_POST['custom_text_type'][$k]);
					$slider_type = addslashes($_POST['slider_type'][$k]);
					$slider_category = addslashes($_POST['slider_category'][$k]);
					
					$more_link_type = addslashes($_POST['more_link_type'][$k]);
					$more_link = addslashes($_POST['more_link_url'][$k]);

					// add module to structure array
					$structure[] = array(
											'module_id' => $module_id,
											'title' => $title,
											'category_name' => $category_name,
											'number_of_items' => $number_of_items,
											'embed_code' => $embed_code,
											'custom_text' => $custom_text,
											'custom_text_type' => $custom_text_type,
											'slider_type' => $slider_type,
											'slider_category' => $slider_category,
											'more_link_type' => $more_link_type,
											'more_link_url' =>$more_link
									); 

				}// end foreach

				// save array to DB
				update_post_meta($id, self::PAGE_BUILDER_META_ID, $structure); // array will be serialized automatically
			
			}else{
				// no modules
				update_post_meta($id, self::PAGE_BUILDER_META_ID, '');
			}


		}// end if

	}

	/**
	 * Output admin view
	 * - output the passed data in backend admin view 
	 *
	 * @return string with generated html ready to be displayed in page buidler metabox 
	 *
	 */
	public function output_admin_view(){
		
		if(isset($this->data)){
			
			return $this->generate_modules(self::BACK_VIEW);

		}

		return '<li class="ln-page-builder-no-modules"><h4>'.__('No modules!', 'framework').'</h4></li>';
	}

	/**
	 * Output layout view
	 * - output the passed data as separate modules ready to display in frontend 
	 *
	 * @return string with generated html 
	 *
	 */
	public function output_layout_view(){
		
		if(isset($this->data)){
			
			return $this->generate_modules(self::FRONT_VIEW);

		}
		
	}

	/**
	 * Generate modules
	 * - generate modules for backend or frontend view
	 *
	 * @oaram display type backend or frontend
	 * @return string with generated hmtl 
	 *
	 */
	private function generate_modules($type){
		
		$output = '';

		if($type == self::FRONT_VIEW){
			
			// get sidebar inforamtion 
			$options = array('page_id' => $this->id, 'has-sidebar' => true );
			
			// frontend output
			$this->builder_modules = new Modules($options);
			
		}else{

			// backend output
			$this->builder_modules = new ModulesAdminView();
		}

		// loop thru data array
		foreach ($this->data as $k => $v) {
			
			switch ( stripslashes($v['module_id']) ) {
				
				// Posts
				case 'posts':
					$output .= $this->builder_modules->posts($v);
					break;

				// Posts Column
				case 'posts_column':
					$output .= $this->builder_modules->posts_column($v);
					break;

				// Posts Carousel
				case 'posts_carousel':
					$output .= $this->builder_modules->posts_carousel($v);
					break;
				
				// Slider
				case 'slider':
					$output .= $this->builder_modules->slider($v);
					break;

				// Video
				case 'video_full':
					$output .= $this->builder_modules->video_full($v);
					break;

				// Video Column
				case 'video_column':
					$output .= $this->builder_modules->video_column($v);
					break;

				// Text
				case 'text_full':
					$output .= $this->builder_modules->text_full($v);
					break;

				// Text Column
				case 'text_column':
					$output .= $this->builder_modules->text_column($v);
					break;

			}	
		}

		return $output;
	}

	/**
	 * Get Blog Categories Lists
	 * - outputs blog categories 
	 * @param optional selected value
	 * @return string with generated hmtl 
	 *
	 */
	public static function getBlogCategoriesList($selected_val=''){
		
		$output = '';
		
		// get categories
		$categories =  get_categories(); 
		
		if($selected_val == 'ln-recent-regular-posts'){
			$output .= '<option value="ln-recent-regular-posts" selected=selected>'.__('- Recent Blog Posts', 'framework').'</option>'; // add recent posts option selected
		}else{
			$output .= '<option value="ln-recent-regular-posts">'.__('- Recent Blog Posts', 'framework').'</option>'; // add recent posts option
		}

		foreach ($categories as $category) {

				if($category->category_nicename == $selected_val){
					$output .= '<option selected=selected value="'.$category->category_nicename.'">';
				}else{
					$output .= '<option value="'.$category->category_nicename.'">';
				}
				
				$output .= $category->cat_name;
				$output .= '</option>';
		}

		return $output;
	}
	
	/**
	 * Get Slider Posts Lists
	 * - outputs team categories
	 * @param optional selected value
	 * @return string with generated hmtl 
	 *
	 */
	public static function getSliderPostsList($selected_val=''){

		wp_reset_query();
		
		$output = '';
		$query = array('post_type' => 'sliders', 'posts_per_page' => -1);
		query_posts($query);
		
		while ( have_posts() ) : the_post();

			if(get_the_ID() == $selected_val){
				$output .= '<option selected=selected value="'.get_the_ID().'">';
			}else{
				$output .= '<option value="'.get_the_ID().'">';
			}
			
			$output .= get_the_title();
			$output .= '</option>';
		endwhile;

		return $output;

	}

	/**
	 * Get Available Pages
	 * - return <option value="[page url]">Page Title</option> for each Available page 
	 *
	 */
	public static function getAvailablePages(){

		$output = '';

		// get pages
		$pages = get_pages(); 
	  	
	  	foreach ( $pages as $pagg ) {
	  		$output .= '<option data-type="2" value="'.get_page_link( $pagg->ID ).'">'.$pagg->post_title.'</option>';
		}

		return $output;

	}
}

?>