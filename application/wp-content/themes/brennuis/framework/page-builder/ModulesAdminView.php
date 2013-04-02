<?php

/**
 * Modules admin view
 * - implements IPageBuilderModules ingerfacae, used to output backend modules view
 */
class ModulesAdminView implements IPageBuilderModules {
	
	/**
	 * Escape Text
	 * - helper function escapes strings
	 * 
	 * @param string to escape
	 * @return escaped string
	 */
	private function escapeText($txt){
		//return ereg_replace("\\\'", '"', stripslashes($txt) ); -- deprecated function in 5.3
		return str_replace('"', "\'", stripslashes($txt) );
	}

	/**
     * getModuleTemplate
     * - tempalte for backend modules
     * 
     * @param $data - data for tabs full module
     * @param $module_name - module name 
     * @param $module_size - module size css class, default is full size
     * @return generate html for each 
	 */
	private function getModuleTemplate($data, $module_name, $module_size = 'ln-page-builder-full'){

		$display_title = $this->escapeText( $data['title'] );
		$module_id = $this->escapeText( $data['module_id'] );
		$title = $this->escapeText( $data['title'] );
		$category_name = $this->escapeText( $data['category_name'] );
		$number_of_items = $this->escapeText( $data['number_of_items'] );
		$embed_code = $this->escapeText( stripslashes( $data['embed_code'] ) );
		$custom_text = $this->escapeText( $data['custom_text'] );
		$custom_text_type = $this->escapeText( $data['custom_text_type'] );
		$slider_type = $this->escapeText( $data['slider_type'] );
		$slider_category = $this->escapeText( $data['slider_category'] );
		$more_link_type = $this->escapeText( $data['more_link_type'] );
		$more_link_url = $this->escapeText( $data['more_link_url'] );

		$output = '';
		
		$output .= '<li class="'.$module_size.'">';
		$output .= 		'<span class="module-name">'.$module_name.': <span class="cat-name">'.$display_title.'</span></span> <span class="edit-button"></span><span class="remove-button"></span>';
		$output .= 		'<input type="hidden" name="module_id[]" value="'.$module_id.'"/>';
		$output .= 		'<input type="hidden" name="title[]" value="'.$title.'"/>';
		$output .= 		'<input type="hidden" name="category_name[]" value="'.$category_name.'"/>';
		$output .= 		'<input type="hidden" name="number_of_items[]" value="'.$number_of_items.'"/>';
		$output .= 		'<input type="hidden" name="embed_code[]" value="'.$embed_code.'"/>';
		$output .= 		'<input type="hidden" name="custom_text[]" value="'.$custom_text.'"/>';
		$output .= 		'<input type="hidden" name="custom_text_type[]" value="'.$custom_text_type.'"/>';
		$output .= 		'<input type="hidden" name="slider_type[]" value="'.$slider_type.'"/>';
		$output .= 		'<input type="hidden" name="slider_category[]" value="'.$slider_category.'"/>';
		$output .=      '<input type="hidden" name="more_link_type[]" value="'.$more_link_type.'" />';
		$output .=      '<input type="hidden" name="more_link_url[]" value="'.$more_link_url.'" />';
		$output .= '</li>';

		return $output;

	}

	/* Posts */
 	public function posts($data){
 		return $this->getModuleTemplate($data, 'Posts');
 	}
 	
 	/* Posts column */
 	public function posts_column($data){
 		return $this->getModuleTemplate($data, 'Posts Column', 'ln-page-builder-module-half-size');
 	}

 	/* Posts carousel */
 	public function posts_carousel($data){
 		return $this->getModuleTemplate($data, 'Carousel');
 	}

 	/* Slider */
 	public function slider($data){
 		return $this->getModuleTemplate($data, 'Slider');
 	}

 	/* Text full */
 	public function text_full($data){
 		return $this->getModuleTemplate($data, 'Text');
 	}

 	/* Text column */
 	public function text_column($data){
 		return $this->getModuleTemplate($data, 'Text Column', 'ln-page-builder-module-half-size');
 	}

 	/* Video full */
 	public function video_full($data){
 		return $this->getModuleTemplate($data, 'Video');
 	}

 	/* Video column */
 	public function video_column($data){
 		return $this->getModuleTemplate($data, 'Video Column', 'ln-page-builder-module-half-size');
 	}
}

?>