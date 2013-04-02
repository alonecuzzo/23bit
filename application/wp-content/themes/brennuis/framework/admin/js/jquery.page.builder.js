/********************************************
 * Page builder 
 ********************************************/
jQuery(document).ready(function($){

	var pageBuilderElementsHolder = $('ul#ln-page-builder-structure');
	var pageBuilderEditModule = $('#ln-edit-module-page');
	var pageBuilderWrapperHeight;
	var pagebuilderEditTarget;

	// Array [ "module_id", Array["edit section to show", "edit section to show 1" ....] ]
	var pagebuilderModulesOptions = [];
	
	pagebuilderModulesOptions["posts"] = ["title", "number_of_items", "category_name", "more_link"];
	pagebuilderModulesOptions["posts_column"] = ["title", "number_of_items", "category_name", "more_link"];
	pagebuilderModulesOptions["posts_carousel"] = ["title", "number_of_items", "category_name", "more_link"];
	pagebuilderModulesOptions["slider"] = ["slider_type", "slider_blog_cat", "slider_category", "number_of_items",];
	pagebuilderModulesOptions["text_full"] = ["title", "custom_text_type", "custom_text"];
	pagebuilderModulesOptions["text_column"] = ["title", "custom_text_type", "custom_text"];
	pagebuilderModulesOptions["video_full"] = ["title", "embed_code"];
	pagebuilderModulesOptions["video_column"] = ["title", "embed_code"];
	
	// array with edit sections ids
	var pageBuilderEditSections = [];
	pageBuilderEditSections['title'] = "#ln-page-builder-edit-title";
	pageBuilderEditSections['number_of_items'] = "#ln-page-builder-edit-number";
	pageBuilderEditSections['category_name'] = "#ln-page-builder-edit-category";
	pageBuilderEditSections['slider_type'] = "#ln-page-builder-edit-slider-type";
	pageBuilderEditSections['slider_blog_cat'] = "#ln-page-builder-edit-slider-blog-category";
	pageBuilderEditSections['slider_category'] = "#ln-page-builder-edit-slider-category";
	pageBuilderEditSections['embed_code'] = "#ln-page-builder-edit-video";
	pageBuilderEditSections['custom_text'] = "#ln-page-builder-edit-text";
	pageBuilderEditSections['more_link'] = "#ln-page-builder-edit-more-link";

	//
	// Array [ "element id", "input name", "default field value" ]
	//
	var pageBuilderEditTargets = [
									[ "#ln-page-builder-edit-module-new-title", "title", "Title"],
									[ "#ln-page-builder-edit-module-new-number", "number_of_items", "3"],
									[ "#ln-page-builder-edit-select-category", "category_name", "ln-pbDefault"],
									[ "#ln-page-builder-edit-slider-type-select", "slider_type", "ln-pbDefault"],
									[ "#ln-page-builder-edit-slider-select-blog-category", "slider_category", "ln-pbDefault"],
									[ "#ln-page-builder-edit-slider-select-category", "category_name", "ln-pbDefault"],
									[ "#ln-page-builder-edit-select-text-type", "custom_text_type", "custom"],
									[ "#ln-page-builder-edit-custom-text", "custom_text", ""],
									[ "#ln-page-builder-edit-video-embed", "embed_code", ""],
									[ "#ln-page-builder-edit-select-more-link", "more_link", "0"]
								 ];

	// make page builder modules sortable
	pageBuilderElementsHolder.sortable({
			placeholder: 'ln-module-item-placeholder'
	});

	/***************************************
	 * Save New Data
	 ****************************************/
	function pbSaveNewData(){

		var moduleId = pagebuilderEditTarget.find('input[name=module_id\\[\\]]').val();
		var sz = pageBuilderEditTargets.length;

		for(var i=0; i<sz; i++){

			pagebuilderEditTarget.find('input[name='+pageBuilderEditTargets[i][1]+'\\[\\]]').val( pbClearQuotes( $(pageBuilderEditTargets[i][0]).val() ) );
			
			if(pageBuilderEditTargets[i][1] == 'category_name'){

				var categoryTarget = pagebuilderEditTarget.find('input[name=category_name\\[\\]]');

				switch(moduleId){
					
					case 'posts':
					case 'posts_column':
					case 'posts_carousel': categoryTarget.val( pbClearQuotes( $('#ln-page-builder-edit-select-category').val() ) );
						break;
					
					case 'slider': categoryTarget.val( pbClearQuotes( $('#ln-page-builder-edit-slider-select-category').val() ) ); 
						break;
				}

			}

		}

		pagebuilderEditTarget.find('.cat-name').html( $('#ln-page-builder-edit-module-new-title').val() );
		pagebuilderEditTarget.find('input[name=more_link_type\\[\\]]').val( $('#ln-page-builder-edit-select-more-link').val() );
		pagebuilderEditTarget.find('input[name=more_link_url\\[\\]]').val( $('#ln-more-link-custom').val() );
		
	}

	/***************************************
	 * get module data 
	 ****************************************/
	function getModuleData(){

		// for each edit target fill data from edit module input fields

		var sz = pageBuilderEditTargets.length;

		for(var i=0; i<sz; i++){

			$(pageBuilderEditTargets[i][0]).val( pbClearText( pagebuilderEditTarget.find('input[name='+pageBuilderEditTargets[i][1]+'\\[\\]]').val() ) );

		}
		
		// select text mode option
		var selectedOption = pagebuilderEditTarget.find('input[name=custom_text_type\\[\\]]').val();
		
		$('#ln-page-builder-edit-select-text-type').find('option[value='+selectedOption+']').attr('selected', 'selected');

		if(selectedOption == 'page-content'){
			$('#ln-page-builder-edit-enable-custom-text').css('display', 'none');
		}

	}

	/***************************************
	 * Clear text 
	 ****************************************/		
	function pbClearText(txt){
		
		if(txt!=undefined){
			return txt.replace(/\\'/g, '"');
		}

		return '';
	}

	/***************************************
	 * Clear quotes
	 ****************************************/
	function pbClearQuotes(txt){
		
		if(txt!=undefined){
			return txt.replace(/"/g, "\\'");
		}
		
		return '';
	}

	/***************************************
	 * increase container size
	 ****************************************/
	function setContainerSize(){

		var holder = $('#ln-page-builder-meta');
		var holderEdit = $('#ln-edit-module-page');
		var holderEditInner = $('#ln-edit-page-content');

		holderEdit.css('min-height', (holderEditInner.height()+100)+'px');

		if( holder.height() <= holderEdit.height()+60){
			holder.css('min-height', (holderEdit.height()+70)+'px');
		}else{
			holderEdit.css('min-height', (holder.height()-70)+'px');
		}

	}

	/***************************************
	 * add module click
	 ****************************************/
	$('#ln-add-module-button').click(function(e){
		
		e.preventDefault();
		
		var content = pageBuilderGenerateModule();
		
		if(content != null){
			
			if($('ul#ln-page-builder-structure > li').hasClass('ln-page-builder-no-modules')){
				$('ul#ln-page-builder-structure > li').remove();
				pageBuilderElementsHolder.sortable('enable');	
			}
			
			var objContent = $(content);
			// add module and event listeners
			pageBuilderElementsHolder.append(objContent)
			objContent.find('.remove-button').click(removeModuleClick)
			objContent.find('.edit-button').click(editModuleClick);
			
		}

	});

	/***************************************
	 * add page builder remove module click
	 ****************************************/
	$('ul#ln-page-builder-structure .remove-button').each(function(){ $(this).click(removeModuleClick) });

	function removeModuleClick(){
		
		var result=confirm('Delete module ?');
		
		if (result == true){

			// remove that module
			$(this).parent().find('.edit-button').unbind('click');
			$(this).parent().find('.remove-button').unbind('click');
			$(this).parent().remove();
			
			// if there are no modules appedn no modules text
			if(pageBuilderElementsHolder.children().size() <= 0 ){
				pageBuilderElementsHolder.append('<li class="ln-page-builder-no-modules"><h4>No modules!</h4></li>');
				pageBuilderElementsHolder.sortable('disable');	
			}
		}
	}
	
	/***************************************
	 * add edit button click
	 ****************************************/
	$('ul#ln-page-builder-structure .edit-button').each(function(){ $(this).click(editModuleClick) });
	
	function editModuleClick(){
		
		// set edit module target
		pagebuilderEditTarget = $(this).parent();
		pageBuilderEditModule.fadeIn(300);
		
		// get module type
		var moduleType = pagebuilderEditTarget.find('input[name=module_id\\[\\]]').val();
		var showEditTitle = true;

		getModuleData(); // fill module data in edit sections

		var optionsToShow = pagebuilderModulesOptions[moduleType];
		var sz = optionsToShow.length;
		var sizeT = pageBuilderEditTargets.length;
		
		for (var i = 0; i<sz; i++) {
			
			showEditSection( pageBuilderEditSections[ optionsToShow[i] ] );

		}
		
		setContainerSize();

		// select slider type option
		var sliderSelOp = pagebuilderEditTarget.find('input[name=slider_type\\[\\]]').val();
		
		$('#ln-page-builder-edit-slider-type-select').find('option[value='+sliderSelOp+']').attr('selected', 'selected');

		if(sliderSelOp == 'blog-posts'){
			$('#ln-page-builder-edit-slider-category').css('display', 'none');
		}else{
			$('#ln-page-builder-edit-slider-blog-category').css('display', 'none');
		}

		// set selected link option
		var moreLinkType = pagebuilderEditTarget.find('input[name=more_link_type\\[\\]]').val();
		var moreLinkTypeUrl = pagebuilderEditTarget.find('input[name=more_link_url\\[\\]]').val();
		
		if(moreLinkType == "0" || moreLinkType == "1"){
			$('#ln-page-builder-edit-select-more-link').find('option[value='+moreLinkType+']').attr('selected', 'selected');
		}else{
			$('#ln-page-builder-edit-select-more-link').find('option[value="'+moreLinkType+'"]').attr('selected', 'selected');
		}

		// show custom link field
		if(moreLinkTypeUrl){
			$('#ln-more-link-custom').val(moreLinkTypeUrl);
		}

		if(moreLinkType == 1){
			$('#ln-more-link-wrap').fadeIn(200);
		}
		
	}

	/***************************************
	 * show edit section 
	 ****************************************/
	function showEditSection(secId){
		$(secId).css('display', 'block');
	}

	/***************************************
	 * hide all edit sections
	 ****************************************/
	function hideEditSections(){
		// hide all panels
		$('.ln-module-edit-inner .ln-page-builder-edit-section').each(function(){
			$(this).css('display', 'none');
		});
	}
	
	/***************************************
	 * page builder generate module
	 ****************************************/
	function pageBuilderGenerateModule(){
		
		var output = ''

		// get selected module
		var selectedModule = $('#ln-page-buidler-module-select').val();
		var moduleName = $('#ln-page-buidler-module-select option:selected').text();
		var title = 'Title';
		var moduleSize = 'ln-page-builder-full';

		if(selectedModule == 'slider'){
			title = '';
		}

		if('Column' == moduleName.substr(moduleName.length-6, moduleName.length)) {
			moduleSize = 'ln-page-builder-module-half-size';
		}

		if(selectedModule != 'select'){
			
			var numberOfPosts = 3;
			
			// output module
			output += '<li class="'+moduleSize+'"><span class="module-name">'+moduleName+': <span class="cat-name">'+title+'</span></span> <span class="edit-button"></span><span class="remove-button"></span>';
			output += 	'<input type="hidden" name="module_id[]" value="'+selectedModule+'"/>';
			output += 	'<input type="hidden" name="title[]" value="'+title+'" />';
			output += 	'<input type="hidden" name="category_name[]" value="ln-default"/>';
			output += 	'<input type="hidden" name="number_of_items[]" value="'+numberOfPosts+'" />';
			output += 	'<input type="hidden" name="embed_code[]" value="" />';
			output += 	'<input type="hidden" name="custom_text[]" value="" />';
			output += 	'<input type="hidden" name="custom_text_type[]" value="custom" />';
			output +=   '<input type="hidden" name="slider_type[]" value="blog-posts"/>';
			output +=	'<input type="hidden" name="slider_category[]" value="ln-default"/>';
			output +=   '<input type="hidden" name="more_link_type[]" value="0" />';
			output +=   '<input type="hidden" name="more_link_url[]" value="" />';
			output += '</li>';

			// return generated content
			return output;
		}

		return null;
	}

	/***************************************
	 * edit module save
	 ****************************************/
	$('#ln-edit-module-save-button').click(function(e){
		
		e.preventDefault();

		// save new data
		pbSaveNewData();
		
		// hide edit panel
		pageBuilderEditModule.fadeOut(300);
		$('#ln-page-builder-meta').animate({'min-height': '100%'}, 300, 'easeOutQuad');

		// clear values
		clearEditSectionsData();

		// hide all panels
		hideEditSections();
	});

	/***************************************
	 * close edit module 
	 ****************************************/
	$('#ln-edit-module-close-button').click(function(e){
		e.preventDefault();
		pagebuilderEditTarget = null;
		pageBuilderEditModule.fadeOut(300);
		$('#ln-page-builder-meta').animate({'min-height': '100%'}, 300, 'easeOutQuad');

		// clear
		clearEditSectionsData();
		
		// hide all panels
		hideEditSections();
	});

	/***************************************
	 * clear edit sections data 
	 ****************************************/
	function clearEditSectionsData(){
		
		var sz = pageBuilderEditTargets.length;

		for(var i=0; i<sz; i++){
			$(pageBuilderEditTargets[i][0]).val(pageBuilderEditTargets[i][2]);
		}
		
		$('#ln-page-builder-edit-select-text-type').find('option').each(function(){
			$(this).removeAttr('selected');
		});

		$('#ln-page-builder-edit-enable-custom-text').fadeIn(0);
	}

	/***************************************
	 * text module - text type select
	 ****************************************/
	$('#ln-page-builder-edit-select-text-type').change(function(){
		if($(this).val() == "page-content"){
			$(this).parent().find('#ln-page-builder-edit-enable-custom-text').fadeOut(200);
		}else{
			$(this).parent().find('#ln-page-builder-edit-enable-custom-text').fadeIn(200);
		}
		setContainerSize();
	});

	/***************************************
	 * Slider module - select slider type
	 ****************************************/
	$('#ln-page-builder-edit-slider-type-select').change(function(){
		
		console.log('changed '+$(this).val());

		if($(this).val() == 'blog-posts'){
			$('#ln-page-builder-edit-slider-category').fadeOut(200);
			$('#ln-page-builder-edit-slider-blog-category').fadeIn(200);
		}else{
			$('#ln-page-builder-edit-slider-category').fadeIn(200);
			$('#ln-page-builder-edit-slider-blog-category').fadeOut(200);
		}
		setContainerSize();
	});

	/***************************************
	 * More link option select change - if selected custom link enable field
	 ****************************************/
	$('#ln-page-builder-edit-select-more-link').change(function(){
		
		if( $(this).val() == '1' ){
			$(this).parent().find('#ln-more-link-wrap').fadeIn(200);
		}else{
			$(this).parent().find('#ln-more-link-wrap').fadeOut(200);
		}
	});

});