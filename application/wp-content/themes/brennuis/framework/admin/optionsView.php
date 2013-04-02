<?php

/***
 * optionsView
 * - generates theme options view
 */
class optionsView {
	
	private $menu;
	private $output;
	private $options;
	private $counter;
	private $val;
	
	/**
	 * Constructor
	 * @param array with options 
	 **/
	function __construct($opt){
		
		$menu = '';
		$output = '';
		$this->options = $opt;
		
	}	
	
	/**
	 * generate_options_view
	 * - generate options html code depending on theme options
	 * @return array(menu, options)
	 **/
	public function generate_options_view(){
		
		$this->val = '';
		$this->counter=0;
		
		foreach ($this->options as $value) {
			
			$this->counter+=1;
			
			if(isset($value['std'])){
				$this->val = $value['std'];
			}
			
			if(get_option($value['id'])){
				$this->val = get_option($value['id']);
			}
			
			// option heading
			if ( $value['type'] != "heading" && substr($value['type'], 0, 7) != 'styling'){
		 	
				$this->output .= '<h3 class="ln-option-head ln-clear">'. $value['name'] .'</h3>';
			
		 	} 
			
			switch ( $value['type'] ) {
				
				case "heading": $this->add_heading($value); break;
				case "text":  $this->add_text($value); break;
				case "textarea":  $this->add_textarea($value); break;
				case "image": $this->add_image($value); break;
				case "checkbox": $this->add_checkbox($value); break;
				case "radio": $this->add_radio($value); break;
				case "select": $this->add_select($value); break;
				case "color_picker": $this->add_color_picker($value); break;
				case "styling_header": $this->add_styling_header($value); break;
				case "action_button": $this->add_action_button($value); break;
				case "select_font": $this->add_select_font($value); break;
				case "select_pattern": $this->add_select_pattern($value); break;
				
			}
			
		}
		
		return array($this->menu, $this->output);
	}
	
	/**
	 * add_heading
	 **/
	private function add_heading($op){
		
		if($this->counter >=2){
			$this->output.='</div>'."\n";
		}
		
		$this->menu .= '<li><a id="'.$op['id'].'" title="'.$op['name'].'" href="#'.$op['id'].'">'.$op['name'].'</a></li>';
		$this->output .= '<div class="hidden group" id="'.$op['id'].'">';
		
	}
	
	/**
	 * add_text
	 **/
	private function add_text($op){
		
		$this->output .= '<input id="' . esc_attr( $op['id'] ) . '" class="'.$op['class'].'" name="' . esc_attr($op['id']) . '" type="text" value="' . esc_attr( $this->val ) . '" />';
		$this->output .= '<span class="ln-desc">'.esc_attr($op['desc']).'</span>';
	}
	
	/**
	 * add_textarea
	 **/
	private function add_textarea($op){
		
		$this->output .= '<textarea rows="5" cols="25" id="' . esc_attr( $op['id'] ) . '" class="'.$op['class'].'" name="' . esc_attr($op['id']) . '" >' . esc_attr( $this->val ) . '</textarea>';
		$this->output .= '<span class="ln-desc">'.esc_attr($op['desc']).'</span>';
		
	}
	
	/**
	 * add_image
	 **/
	private function add_image($op){
		
		$this->output .= '<div class="ln-image-wrap"><input id="' . esc_attr( $op['id'] ) . '" class="'.$op['class'].'" name="' . esc_attr($op['id']) . '" type="text" value="' . esc_attr( $this->val ) . '" />';
		$this->output .= '<span id="'. esc_attr( $op['id'] ) .'" class="button upload ln-upload-image">Upload Image</span>';
		
		if($this->val != ""){ 
			
			// display remove button
			$this->output .= '<span id="remove_'. esc_attr( $op['id'] ) . '" class="button ln-remove-image" >Remove Image</span>';
			
			// preview image
			$this->output .= '<div class="ln-image-preview"><img src="'.$this->val.'"/></div>';
		
		}else if(isset($op['std']) && $op['std'] != ""){
			
			//preview default image
			$this->output .= '<div class="ln-image-preview"><img src="'.$op['std'].'"/></div>';
		}
		
		$this->output .= '</div>';
		$this->output .= '<span class="ln-desc">'.esc_attr($op['desc']).'</span>';
		
	}
	
	/**
	 * add_checkbox
	 **/
	private function add_checkbox($op){
		
		$checked = '';
		
		$this->output .= '<div class="ln-checkboxes">';
		
		if(get_option($op['id'])){
				
			if(get_option($op['id']) == 'true'){
				$checked = 'checked="checked"';
			}else{
				$checked = '';
			}
			
		}else if($op['default']=="true"){
			$checked = 'checked="checked"';
			
		}else{
			$checked = '';
		}

		
		$this->output .= '<input type="checkbox" id="'.$op['id'].'"'.$checked.' name="'.$op['id'].'"/><label for="'.$op['id'].'">'.$op['options'].'</label>';
		$this->output .= '</div><span class="ln-desc">'.esc_attr($op['desc']).'</span><div class="ln-clear"></div>';
		
	}
	
	/**
	 * add_radio
	 **/
	private function add_radio($op){
		
		$counter = 0;
		$checked = '';
		$default = '';
		
		$this->output .='<span class="ln-desc">'.$op['desc'].'</span>';
		$this->output .= '<div class="ln-radio">';
		
		if(get_option($op['id'])){
			$default=get_option($op['id']);
		}else{
			$default = $op['default'];
		}
		
		foreach($op['options'] as $key => $rd){

			$checked='';

			if($op['values'][$counter]==$default){
				$checked=' checked="checked"';
			}
			
			$this->output .='<input type="radio" id="'.$op['values'][$counter].'" name="'.$op['id'].'" value="'.$op['values'][$counter].'"'.$checked.'><label for="'.$op['values'][$counter].'">'.$op['options'][$counter].'</label><br/>';
			$counter++;
		
		}
		
		$this->output .= '</div><div class="ln-clear"></div>';
		
	}
	
	/**
	 * add_select
	 **/
	private function add_select($op){
		
		$selected = '';
		$default = '';
		
		$this->output .= '<div class="ln-select">';
		$this->output .= '<select id="'.$op['id'].'" name="'.$op['id'].'">';
		
		if(get_option($op['id'])){
			$default=get_option($op['id']);
		}else{
			$default = $op['default'];
		}
		
		
		foreach($op['options'] as $sel){								

				$selected='';							
				
				if($sel[0] == $default){
					$selected=' selected="selected"';
				}
				
				$this->output .='<option value="'.$sel[0].'" '.$selected.'>'.$sel[1].'</option>';
		}
		
		$this->output .= '</select></div><span class="ln-desc">'.esc_attr($op['desc']).'</span><div class="ln-clear"></div>';
	}

	/**
	 * add_color_picker
	 **/
	private function add_color_picker($op){

		$default = '';

		if(get_option($op['id'])){
			$default=get_option($op['id']);
		}else{
			$default = $op['std'];
		}

		$this->output .= '<div class="ln-portfolio-desc" style="float: left; margin-bottom: 20px; padding-top: 5px;"></div>';
		$this->output .='<div style="float: left; margin-bottom:10px;"><div id="ln-color-box-'.esc_attr($op['id']).'" class="ln-color-picker-preview" style="background-color:#'.esc_attr( $default ).';"></div>';
		$this->output .= '<input data-color-box="ln-color-box-'.esc_attr($op['id']).'" type="text" maxlength="6" size="6" id="'.esc_attr($op['id']).'" name="'.esc_attr($op['id']).'" class="ln-color-picker-input" value="'.esc_attr( $default ).'">';
		$this->output .= '</div> <div class="ln-clear"></div>';
	
	}

	/**
	 * add_styling_header
	 **/
	private function add_styling_header($op){

		$this->output .= '<div class="styling-header clear" id="'.$op['id'].'"><h3>'.$op['name'].'</h3></div>';
	}

	/**
	 * add_action_button
	 **/
	private function add_action_button($op){

		$this->output .= '<div class="styling-header" ><a class="ln-options-action-buttton" href="#" id="'.$op['id'].'">'.$op['desc'].'</a></div>';
	}

	/**
	 * add_select_font
	 **/
	private function add_select_font($op){
		
		$selected = '';
		$default = '';
		
		$font_name = '';

		$this->output .= '<div class="ln-select">';
		$this->output .= '<select id="'.$op['id'].'" name="'.$op['id'].'">';
		
		if(get_option($op['id'])){
			$default=get_option($op['id']);
		}else{
			$default = $op['default'];
		}

		foreach($op['options'] as $sel){								

				$selected='';							
				
				if($sel[0] == $default){
					$selected=' selected="selected"';
					$font_name = $sel[1];
				}
				
				$this->output .='<option value="'.$sel[0].'" '.$selected.'>'.$sel[1].'</option>';
		}
		
		$this->output .= '</select><span class="ln-font-preview" style="font-family: '.$font_name.'; ">Font Preview</span></div><span class="ln-desc">'.esc_attr($op['desc']).'</span><div class="ln-clear"></div>';
	}

	/**
	 * add_select_pattern
	 **/
	private function add_select_pattern($op){
			
		$selected = '';
		$default = '';
		
		if(get_option($op['id'])){
			$default=get_option($op['id']);
		}else{
			$default = $op['default'];
		}

		$this->output .= '<div class="ln-select-pattern">';
		$this->output .= '<input type="hidden" id="'.$op['id'].'" class="pattern-select-target" name="'.$op['id'].'" value="'.$default.'"/>';
		$this->output .= '<ul class="patterns-list">';

		foreach($op['options'] as $pattern){								

				$selected='';							
				
				if($pattern['id'] == $default){
					$selected='class="selected"';
				}
				
				$this->output .='<li data-value="'.$pattern['id'].'" '.$selected.'><img src="'.$pattern['thumb'].'" width="60" height="60" alt="'.$pattern['id'].'"/></option>';
		}
		
		$this->output .= '</ul> <span class="ln-desc">'.esc_attr($op['desc']).'</span><div class="ln-clear"></div> </div>';	

	}
	
}
