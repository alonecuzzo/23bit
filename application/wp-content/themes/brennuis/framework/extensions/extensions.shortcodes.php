<?php

$ln_tab_title_counter = 1;
$ln_tab_content_counter = 0;

// clears the p and br tags 
function ln_clear_content($content){
	
	$content = do_shortcode( shortcode_unautop($content) ); 
    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
   
    return $content;
}

// add shortcode generator metabox
function ln_add_shortcode_generator(){

	add_meta_box('ln-shrotcode-generator', __('Shortcode Generator', 'framework'), 'ln_shrotcode_generator_iu', 'post', 'side', 'high');
	add_meta_box('ln-shrotcode-generator', __('Shortcode Generator', 'framework'), 'ln_shrotcode_generator_iu', 'page', 'side', 'high');
	add_meta_box('ln-shrotcode-generator', __('Shortcode Generator', 'framework'), 'ln_shrotcode_generator_iu', 'portfolio', 'side', 'high');
	
}
add_action('add_meta_boxes', 'ln_add_shortcode_generator');


// shortcode generator user interface
function ln_shrotcode_generator_iu(){

	echo '<p>'._e('Switch to HTML preview and choose shortcode to insert.', 'framework').'</p>';

?>
	<select id="ln-shortcodes-list" name="ln-shortcodes-list">
		<option value="" disabled="true">-- Select --</option>
		<optgroup label="Columns">
			<option value="[col_full] your content [/col_full] ">full size</option>
			<option value="[col_half] your content [/col_half] ">one half</option>
			<option value="[col_half_last] your content [/col_half_last] ">one half last</option>
			<option value="[col_third] your content [/col_third] ">one third</option>
			<option value="[col_third_last] your content [/col_third_last] ">one third last</option>
			<option value="[col_fourth] your content [/col_fourth] ">one fourth</option>
			<option value="[col_fourth_last] your content [/col_fourth_last] ">one fourth last</option>
			<option value="[col_fifth] your content [/col_fifth] ">one fifth</option>
			<option value="[col_fifth_last] your content [/col_fifth_last] ">one fifth last</option>
			<option value="[col_sixth] your content [/col_sixth] ">one sixth</option>
			<option value="[col_sixth_last] your content [/col_sixth_last] ">one sixth last</option>
		</optgroup>

		<optgroup label="Buttons">
			<option value="[button color='white' url='#' target='_self'] button text [/button] ">button white</option>
			<option value="[button color='black' url='#' target='_self'] button text [/button] ">button black</option>
			<option value="[button color='green' url='#' target='_self'] button text [/button] ">button green</option>
			<option value="[button color='red' url='#' target='_self'] button text [/button] ">button red</option>
			<option value="[button color='blue' url='#' target='_self'] button text [/button] ">button blue</option>
			<option value="[button color='purple' url='#' target='_self'] button text [/button] ">button purple</option>
			<option value="[button color='yellow' url='#' target='_self'] button text [/button] ">button yellow</option>
		</optgroup>

		<optgroup label="Alerts">
			<option value="[alert type='alert'] alert text [/alert]">alert box</option>
			<option value="[alert type='info'] alert text [/alert]">info box</option>
			<option value="[alert type='success'] alert text [/alert]">success box</option>
		</optgroup>

		<optgroup label="Lists">
			<option value="[checklist] <li>List item</li> [/checklist]">check list</option>
		</optgroup>

		<optgroup label="Google Map">
			<option value="[google_map height='320' src='']">Google Map</option>
		</optgroup>

		<optgroup label="Quote">
			<option value="[pull_quote align='left']  quote text [/pull_quote]">pull quote left</option>
			<option value="[pull_quote align='right'] quote text [/pull_quote]">pull quote right</option>
			<option value="[block_quote cite='- John Doe'] quote text [/block_quote]">blockquote</option>
		</optgroup>

		<optgroup label="Highlight">
			<option value="[highlight color='#81caea' text-color='#ffffff'] highlight text [/highlight] ">text highlight</option>
		</optgroup>

		<optgroup label="Dropcaps">
			<option value="[dropcap] dropcap content [/dropcap] ">dropcap</option>
		</optgroup>

		<optgroup label="Tabs">
			<option value="[tabs tab1='tab 1 title' tab2='tab 2 title' tab3='tab 3 title'] [tab]tab 1 content[/tab] [tab]tab 2 content[/tab] [tab]tab 3 content[/tab]  [/tabs] ">tabs</option>
		</optgroup>

		<optgroup label="Toggle">
			<option value="[toggle title='Title' show='true'] toogle content [/toggle] ">toggle</option>
		</optgroup>

		<optgroup label="Video">
			<option value="[embed_youtube id='' width='420' height='345']">YouTube</option>
			<option value="[embed_vimeo id='' width='400' height='225']">Vimeo</option>
			<option value="[embed_video src='' width='420' height='345']">video</option>
		</optgroup>
	</select>
	<span id="ln-insert-shortcode" class="button"/>Insert Shortcode</span>
<?php 	
}

/***********************************
 * Columns
 ***********************************/

// column full
function ln_col_full($atts, $content=null){
	return '<div class="column-full">'.ln_clear_content($content).'</div><div class="clear"></div>';	
}
add_shortcode('col_full', 'ln_col_full');

// column half
function ln_col_half($atts, $content=null){
	return '<div class="column-half">'.ln_clear_content($content).'</div>';	
}
add_shortcode('col_half', 'ln_col_half');

// column half last
function ln_col_half_last($atts, $content=null){
	return '<div class="column-half column-last">'.ln_clear_content($content).'</div><div class="clear"></div>';
}
add_shortcode('col_half_last', 'ln_col_half_last');


// column third
function ln_col_third($atts, $content=null){
	return '<div class="column-third">'.ln_clear_content($content).'</div>';	
}
add_shortcode('col_third', 'ln_col_third');

// column third last
function ln_col_third_last($atts, $content=null){
	return '<div class="column-third column-last">'.ln_clear_content($content).'</div><div class="clear"></div>';
}
add_shortcode('col_third_last', 'ln_col_third_last');


// column fourth
function ln_col_fourth($atts, $content=null){
	return '<div class="column-fourth">'.ln_clear_content($content).'</div>';	
}
add_shortcode('col_fourth', 'ln_col_fourth');

// column fourth last
function ln_col_fourth_last($atts, $content=null){
	return '<div class="column-fourth column-last">'.ln_clear_content($content).'</div><div class="clear"></div>';
}
add_shortcode('col_fourth_last', 'ln_col_fourth_last');


// column fifth
function ln_col_fifth($atts, $content=null){
	return '<div class="column-fifth">'.ln_clear_content($content).'</div>';	
}
add_shortcode('col_fifth', 'ln_col_fifth');

// column fifth last
function ln_col_fifth_last($atts, $content=null){
	return '<div class="column-fifth column-last">'.ln_clear_content($content).'</div><div class="clear"></div>';
}
add_shortcode('col_fifth_last', 'ln_col_fifth_last');


// column fifth
function ln_col_sixth($atts, $content=null){
	return '<div class="column-sixth">'.ln_clear_content($content).'</div>';	
}
add_shortcode('col_sixth', 'ln_col_sixth');

// column fifth last
function ln_col_sixth_last($atts, $content=null){
	return '<div class="column-sixth column-last">'.ln_clear_content($content).'</div><div class="clear"></div>';
}
add_shortcode('col_sixth_last', 'ln_col_sixth_last');

/*******************************
 * Video
 *******************************/

// youtube
function ln_youtube($atts, $content=null){
	
	$atts=shortcode_atts( array('id' => '', 'width' => 420, 'height' => 345), $atts);
	
	return '<iframe width="'.$atts['width'].'" height="'.$atts['height'].'" src="http://www.youtube.com/embed/'.$atts['id'].'" frameborder="0" allowfullscreen></iframe>';
	
}
add_shortcode('embed_youtube', 'ln_youtube');


// vimeo
function ln_vimeo($atts, $content=null){
	
	$atts = shortcode_atts( array('id' => '', 'width' => 400, 'height' => 225), $atts);
	
	return '<iframe src="http://player.vimeo.com/video/'.$atts['id'].'?title=0&amp;byline=0&amp;portrait=0" width="'.$atts['width'].'" height="'.$atts['height'].'" frameborder="0"></iframe>';
}
add_shortcode('embed_vimeo', 'ln_vimeo');

// video from source
function ln_embed_video($atts, $content=null){
	
	$atts = shortcode_atts( array('src' => '', 'width' => 420, 'height' => 345), $atts);
	
	return '<iframe width="'.$atts['width'].'" height="'.$atts['height'].'" src="'.$atts['src'].'" frameborder="0" allowfullscreen></iframe>';
	
}
add_shortcode('embed_video', 'ln_embed_video');


/*******************************
 * Buttons
 *******************************/
function ln_button( $atts, $content = null ) {
	
    $atts = shortcode_atts(array('color' => '', 'url' => '#', 'target' => '_self'), $atts);

	return  '<a href="'.$atts['url'].'" title="'.$content.'" target="'.$atts['target'].'" class="no-anim ln-button button-'.$atts['color'].'">'.ln_clear_content($content).'</a>';
	
}
add_shortcode('button', 'ln_button');


/*******************************
 * Highlight
 *******************************/
function ln_highlight( $atts, $content = null ) {
	
    $atts = shortcode_atts(array('color' => '#81caea', 'text-color' => '#ffffff'), $atts);

	return  '<span class="highlight" style="border-color: '.$atts['color'].'; padding: 3px; background-color: '.$atts['color'].'; color: '.$atts['text-color'].';">'.ln_clear_content($content).'</span>';
	
}
add_shortcode('highlight', 'ln_highlight');


/*******************************
 * List
 *******************************/
function ln_checklist( $atts, $content = null ) {
	
	return  '<ul class="ln-checklist" >'.ln_clear_content($content).'</ul>';
	
}
add_shortcode('checklist', 'ln_checklist');


/*******************************
 * Pull Quote
 *******************************/
function ln_pull_quote($atts, $content = null){
	
	$atts = shortcode_atts(array('align' => 'left'), $atts);
	
	return  '<span class="pull-quote-'.$atts['align'].'">'.ln_clear_content($content).'</span>';
	
}
add_shortcode('pull_quote', 'ln_pull_quote');


/*******************************
 * Blockquote
 *******************************/
function ln_block_quote($atts, $content = null){
	
	$atts = shortcode_atts(array('cite' => ''), $atts);
	
	return  '<blockquote>'.ln_clear_content($content).'<cite>'.$atts['cite'].'</cite></blockquote><div class="clear"></div>';
	
}
add_shortcode('block_quote', 'ln_block_quote');


/*******************************
 * Dropcaps
 *******************************/
function ln_dropcap( $atts, $content = null ) {
	
	return  '<span class="dropcap" >'.ln_clear_content($content).'</span>';
	
}
add_shortcode('dropcap', 'ln_dropcap');


/*******************************
 * Alerts
 *******************************/

// alert
function ln_alert_box($atts, $content = null ){
	
	 $atts = shortcode_atts(array('type' => 'alert'), $atts);
	 
	 return '<div class="'.$atts['type'].'-box" >'.ln_clear_content($content).'</div>';
}
add_shortcode('alert', 'ln_alert_box');


/*******************************
 * Tabs
 *******************************/
function ln_tabs($atts, $content = null ){
	 
	 global $ln_tab_title_counter;
	 global $ln_tab_content_counter;
	 
	 $output = '<div class="tabs"><ul>';
	 
	 foreach ($atts as $title){
	 	$output .= '<li><a href="#tabs-'.$ln_tab_title_counter.'" title="'.$title.'" >'.$title.'</a></li>';
	 	$ln_tab_title_counter+=1;
	 }
	 $output .= '</ul>';
	 $output .= '<div class="tabs-content">';
	 $output .= ln_clear_content($content);
	 $output .= '</div></div>';
	 $ln_tab_title_counter = $ln_tab_content_counter+1;
	 return $output;
}
add_shortcode('tabs', 'ln_tabs');


function ln_tabs_content($atts, $content = null ){
	 
	 global $ln_tab_content_counter;
	 
	 $ln_tab_content_counter+=1;
	 
	 return '<div id="tabs-'.$ln_tab_content_counter.'"><p>'.ln_clear_content($content).'</p></div>';
	
}
add_shortcode('tab', 'ln_tabs_content');

/*******************************
 * Toggle
 *******************************/
function ln_toggle( $atts, $content = null ) {
	
    $atts = shortcode_atts(array('title' => 'Title', 'show'	=> 'true'), $atts);

	return  '<div class="toggle" ><h4>'.$atts['title'].'</h4><div class="toggle-content" data-show="'.$atts['show'].'"><p>'.ln_clear_content($content).'</p></div></div>';
	
}
add_shortcode('toggle', 'ln_toggle');

/*******************************
 * Google Maps
 *******************************/
function ln_google_map($atts, $content = null) {

   $atts = shortcode_atts(array( "width" => '320', "height" => '320', "src" => ''), $atts);
   
   return '<iframe width="'.$atts['width'].'" height="'.$atts['height'].'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$atts['src'].'&amp;output=embed"></iframe>';
}
add_shortcode("google_map", "ln_google_map");

?>