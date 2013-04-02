/********************************************
 * Custom jQuery Admin
 ********************************************/
jQuery(document).ready(function($){
	
	// set first menu btn to active
	$('#ln-menu ul li:first-child').addClass('current');
	
	// hide groups
	$('.group').hide();
	
	// show first group
	$('.group:first').addClass('activePage').show();
	
	$('#ln-menu ul li').click(function(e){
		e.preventDefault();
		var newPage=$(this).find('a').attr('id');
		
		$('#ln-menu ul li.current').removeClass('current');
		$(this).addClass('current');
		
		$('#ln-options .activePage').removeClass('activePage').hide();
		$('div #'+newPage).addClass('activePage').fadeIn(200);
		
		
	});
	
	
	//AJAX upload
	$('.ln-upload-image').each(function(){
		
		var the_button=$(this);
		var image_input=$(this).prev();
		var image_id=$(this).attr('id');
		
		
		new AjaxUpload($(this), {
			  action: ajaxurl,
			  name: image_id,
			  
			  // Additional data
			  data: {
				action: 'ln_ajax_upload',
				data: image_id
			  },
			  autoSubmit: true,
			  responseType: false,
			  onChange: function(file, extension){
				  
				  //check file extension
				  if(extension == 'jpg'  || extension == 'jpeg' || extension == 'png'  || extension == 'gif' || extension == 'ico') {
					  return true;
		          } else {
		        	  alert("Only image files (jpg, jpeg, png, gif and ico)");
		        	  return false;
		          }
			  },
			  onSubmit: function(file, extension) {
					the_button.html("Uploading...");				  
			  },
			  onComplete: function(file, response) {	
					
					the_button.html("Upload Image");
					
					if(response.search("Error") > -1){
						alert("There was an error uploading:\n"+response);
					}
					
					else{							
						image_input.val(response);
						var image_preview='<div class="ln-image-preview"><img src="' + response + '" class="ln_image_preview" /></div>';							
						
						var remove_button_id='remove_'+image_id;
						var rem_id="#"+remove_button_id;
						var rem_img=the_button.parent().find('.ln-image-preview');
						
						if(!$(rem_id).length>0){
							the_button.after('<span class="button ln-remove-image" id="'+remove_button_id+'">Remove Image</span>');
							
						}
						// remove prev image if present
						if(rem_img.length>0){
							rem_img.fadeOut().remove();
						}
						
						the_button.parent().append(image_preview);
						
					}
						
						
					
				}
		});
	});
	
	
	//AJAX image remove
	$('.ln-remove-image').live('click', function(){
		var remove_button=$(this);
		var image_remove_id=$(this).prev().attr('id');
		remove_button.html('Removing...');
		
		var data = {
			action: 'ln_ajax_remove',
			data: image_remove_id
		};
		
		jQuery.post(ajaxurl, data, function(response) {
			remove_button.prev().prev().val('');
			remove_button.next().html('');
			remove_button.remove();
		});
		
	});
	
	// Shortcodes generator
	$('#ln-insert-shortcode').click(function(){
		
		// get selected option
		var srt_code = $('#ln-shortcodes-list').val();
		var content = document.getElementById('content'); 
		
		// insert shortcode code into editor current cursor position
		if(srt_code){
			
			if(document.selection) {
				  
				 content.focus();
			     sel = document.selection.createRange();
			     sel.text = srt_code;
			     content.focus();
			      
			}else if (content.selectionStart || content.selectionStart == '0') {
			      
				 var startPos = content.selectionStart;
			     var endPos = content.selectionEnd;
			      
			     content.value = content.value.substring(0, startPos)+srt_code+content.value.substring(endPos,content.value.length);
			     content.focus();
			     content.selectionStart = startPos + srt_code.length;
			     content.selectionEnd = startPos + srt_code.length;
			      
			}else{
			    	
			     content.value += srt_code;
			     content.focus();
			    	
			}
			
		}
		
	});

	// lnEscapeText - escapes double quotes
	function lnEscapeText(text){
		return text.replace(/"/g, "\\'");
	}

	///////////////////////////////////////////
	// Custom sidebars
	///////////////////////////////////////////

	$('#ln-add-new-sidebar').click(function(e){
		e.preventDefault();

		var targeUl = $('ul#ln-sidebars-list');
		var newName = $('#ln-new-sidebar-name').val();

		if($.trim(newName).length > 3){

			var flag = false;

			// find if we dont have already sidebar with this name 
			$('ul#ln-sidebars-list li').each(function(){
				if( lnEscapeText( $(this).text() ) == lnEscapeText(newName) ){
					alert('Sidebar with this name already exists!');
					flag = true;
				}
			});

			if(!flag){
				
				var newItem = '';
				newItem += '<li>'+newName+'<span class="remove-button"></span>';
				newItem += '<input type="hidden" name="custom_sidebar_name[]" value="'+lnEscapeText(newName)+'"/></li>';
				
				var newObj = $(newItem);
				newObj.find('.remove-button').click(removeListItem);
				
				targeUl.append(newObj);
			}
		}
	});

	$('ul#ln-sidebars-list li .remove-button').each(function(){
		$(this).click(removeListItem);
	});

	// remove list item
	function removeListItem(){

		var result=confirm('Delete ?');
		
		if (result == true){
			$(this).parent().remove();
		}
	}

	///////////////////////////////////////////
	// Rating Criteria
	///////////////////////////////////////////
	var criteriaEditTarget = null;
	var defaultCriteriaHolderHeight = $('#ln-critera-content').height();

	$('#ln-criteria-fields-list').sortable({
			placeholder: 'ln-tab-item-placeholder'
	});

	$('#ln-add-new-criteria').click(function(e){
		e.preventDefault();

		var targeUl = $('ul#ln-criterias-list');
		var newName = $('#ln-new-criteria-name').val();

		if($.trim(newName).length > 3){

			var flag = false;

			// find if we dont have already criteria with this name 
			$('ul#ln-criterias-list li').each(function(){
				
				if( lnEscapeText( $.trim( $(this).text()) ) === lnEscapeText(newName) ){
					alert('Criteria with this name already exists!');
					flag = true;
				}
			});

			if(!flag){

				var newItem = '';
				newItem += '<li>'+newName+'<span class="edit-button"></span><span class="remove-button"></span>';
				newItem += '<input type="hidden" name="criteria_name[]" value="'+lnEscapeText(newName)+'"/>';
				newItem += '<input type="hidden" name="criteria_fields[]" value="'+lnEscapeText(newName)+'"/></li>';
				
				var newObj = $(newItem);
				
				newObj.find('.remove-button').click(removeListItem);
				newObj.find('.edit-button').click(editCriteriaItem);
				
				targeUl.append(newObj);
			}
		}
	});

	$('ul#ln-criterias-list li .remove-button').each(function(){
		$(this).click(removeListItem);
	});

	$('ul#ln-criterias-list li .edit-button').each(function(){
		$(this).click(editCriteriaItem);
	});

	// add new criteira item
	function editCriteriaItem(){
		// set edit target
		criteriaEditTarget = $(this).parent();
		var fieldsUl = $('#ln-criteria-fields-list');
		var data = criteriaEditTarget.find('input[name=criteria_fields\\[\\]]').val();
			
		// get current data and append fields to <ul>
		if(data != undefined){
			
			var currFields = data.split('/');
			
			for(var i=0; i<currFields.length; i++){
				
				var listItm = '<li><span class="module-name">'+(currFields[i].replace(/\\'/g, '"'))+'</span><span class="remove-button"></span></li>';
				var listObj = $(listItm);
				
				listObj.find('.remove-button').click(removeListItem);
				// append list
				fieldsUl.append(listObj);
			}

		}

		// resize container height
		setCriteriaContainerSize();

		// fade in edit panel
		$('#ln-edit-criteria-page').fadeIn(270);
	}

	// edit criteria save button click
	$('#ln-edit-criteria-save-button').click(function(e){
		e.preventDefault();

		// save data and fade out
		if(criteriaEditTarget != null){

			var newFields = '';

			// get fields
			$('#ln-criteria-fields-list li').each(function(){
				newFields += $(this).find('span.module-name').html();
				newFields += '/';
			});

			// remove last backslash
			newFields = newFields.substring(0, newFields.length-1);

			// save to current edited item
			criteriaEditTarget.find('input[name=criteria_fields\\[\\]]').val( lnEscapeText(newFields) );

		}
		// fade out edit panel
		$('#ln-edit-criteria-page').fadeOut(270);
		clearCriteriaFields();
	});

	// edit criteria close button
	$('#ln-edit-criteria-close-button').click(function(e){
		e.preventDefault();
		$('#ln-edit-criteria-page').fadeOut(270);
		clearCriteriaFields();
	});

	// clear criteria fileds
	function clearCriteriaFields(){
		$('#ln-critera-content').css('min-height', (defaultCriteriaHolderHeight-40)+'px');
		$('#ln-criteria-fields-list').empty();
	}

	// add new filed click
	$('#ln-add-new-criteria-field').click(function(e){
		e.preventDefault();

		var targeUl = $('ul#ln-criteria-fields-list');
		var newName = $('#ln-criteria-new-field-name').val();

		if($.trim(newName).length > 2){

			var newItem = '<li><span class="module-name">'+newName+'</span><span class="remove-button"></span></li>';
			var newObj = $(newItem);
			
			newObj.find('.remove-button').click(removeListItem);
			
			targeUl.append(newObj);
			setCriteriaContainerSize();
		}

	});

	// increase container size
	function setCriteriaContainerSize(){
		
		var holder = $('#ln-critera-content');
		var holderParent = $('#ln-edit-criteria-page');

		if( holder.height() <= holderParent.height() ){
			holder.css('min-height', (holderParent.height()-40)+'px');
		}else{
			holderParent.css('min-height', (holder.height()+40)+'px');
		}
	}

	/*****************************************/
	/** 		Metabox UIs    				 */
	/*****************************************/

	// ui slider
	$(".ln-ul-slider").each(function(){

		var startVal = $(this).attr('data-value');
		var fieldV = $('#' + $(this).attr('data-field') );

		$(this).slider({
			value: startVal,
			min: 0,
			max: 10,
			step: 0.5,
			slide: function( event, ui ) {
				fieldV.find('.ln-ui-slider-field').val(ui.value);
			}
		});

	})
	
	// color picker
	$('.ln-color-picker-input').each(function(){
		
		$(this).ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				
				$( '#'+$(el).attr('data-color-box') ).css('backgroundColor', '#'+hex);
				
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function (el) {
				$(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function(){
				$(this).ColorPickerSetColor(this.value);
		});

	});

	// background image upload 
	$('#image-ln_meta_page_style_bg_img').click(function(){
		  
		  	window.send_to_editor = function(html) {
		  		imgurl = $('img',html).attr('src');
		  		$('#' + formfield).val(imgurl);
		  		tb_remove();
		  	};
		  
		  	formfield = $('#ln_meta_page_style_bg_img').attr('name');
		  	tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
		  return false;
	});

	// new slide image upload
	$('#image-ln-new-slide-big-img').click(function(){
		  
		  	window.send_to_editor = function(html) {
		  		imgurl = $('img',html).attr('src');
		  		$('#' + formfield).val(imgurl);
		  		tb_remove();
		  	};
		  
		  	formfield = $('#ln-new-slide-big-img').attr('name');
		  	tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
		  return false;
	});

	// gallery shortcode generator click
	$('#ln-gallery-shortcode-generator').click(function(){
		$(this).select();
	})

	/***************************************
	 * slider manager category select
	 ****************************************/
	var sliderEditTarget = null;

	$('#ln_slider_manager_posts_category').change(function(){

		$(this).parent().find('#ln_slider_manager_posts_type_id').val($(this).find('option:selected').attr('data-type'));

	});

	$('#ln-slides-list').sortable({
			placeholder: 'ln-slide-placeholder'
	});

	$('#ln-slides-list li').each(function(){
		
		$(this).find('.edit-button').click(editSlideItem);
		$(this).find('.remove-button').click(removeListItem);

	});

	/***************************************
	 * slider manager edit slide item
	 ****************************************/
	function editSlideItem(){

		// set edit target
		sliderEditTarget = $(this).parent();

		$('#ln-edit-slide-preview').attr('src', sliderEditTarget.find('input[name=slide_small\\[\\]]').val() );
		$('#ln-edit-slide-title').val( sliderEditTarget.find('input[name=slide_title\\[\\]]').val().replace(/\\'/g, '"') );
		$('#ln-edit-slide-caption').val( sliderEditTarget.find('input[name=slide_caption\\[\\]]').val().replace(/\\'/g, '"') );
		$('#ln-edit-slide-url').val( sliderEditTarget.find('input[name=slide_url\\[\\]]').val().replace(/\\'/g, '"') );

		// resize container height
		setSlideManagerContainerSize();

		// fade in edit panel
		$('#ln-edit-slide-page').fadeIn(270);
		
	}

	// edit slide save click
	$('#ln-edit-slide-save-button').click(function(e){

		e.preventDefault();
			
		sliderEditTarget.find('span.title').html(lnEscapeText($('#ln-edit-slide-title').val()));

		// save data and clear fields
		sliderEditTarget.find('input[name=slide_title\\[\\]]').val( lnEscapeText($('#ln-edit-slide-title').val()) );
		sliderEditTarget.find('input[name=slide_caption\\[\\]]').val( lnEscapeText($('#ln-edit-slide-caption').val()) );
		sliderEditTarget.find('input[name=slide_url\\[\\]]').val( lnEscapeText($('#ln-edit-slide-url').val()) );
		
		$('#ln-edit-slide-page').fadeOut(270);
		$('#ln-wrap-slider-manager').css('min-height', 400);
		clearSlideFields();
	});

	// edit slide close button
	$('#ln-edit-slide-close-button').click(function(e){
		
		e.preventDefault();
		
		$('#ln-edit-slide-page').fadeOut(270);
		$('#ln-wrap-slider-manager').css('min-height', 400);
		clearSlideFields();
	});

	// clear slider fields
	function clearSlideFields(){
		$('#ln-edit-slide-preview').attr('src', '');
		$('#ln-edit-slide-title').val('');
		$('#ln-edit-slide-caption').val('');
		$('#ln-edit-slide-url').val(''); 
	}

	// increase container size
	function setSlideManagerContainerSize(){
		
		var holder = $('#ln-wrap-slider-manager');
		var holderParent = $('#ln-edit-slide-page');

		if( holder.height() <= holderParent.height() ){
			holder.css('min-height', (holderParent.height()-20)+'px');
		}else{
			holderParent.css('min-height', (holder.height()+20)+'px');
		}
	}

	/***************************************
	 * slider manager add new slide
	 ****************************************/
	 $('#ln-add-new-slide').click(function(e){

	 	e.preventDefault();

	 	var target = $('#ln-slides-list');
	 	var urlHolder = $('#ln-new-slide-big-img');
		var bigImgURL = urlHolder.val();

		if($.trim(bigImgURL).length > 0){

			// clear field
			urlHolder.val('');

			target.find('.no-slides').remove();
			
			// create li note and append it
			var extension = bigImgURL.substr( (bigImgURL.lastIndexOf('.') +1) );
			var imgName = bigImgURL.substr( 0, ((bigImgURL.lastIndexOf('.'))))
			var navImg = imgName+'-40x30.'+extension;
			var bigImg = imgName+'-1000x400.'+extension;

			var newSlide = '<li>';
				newSlide += 	'<img src="'+navImg+'" /><span class="title"></span> <span class="edit-button"></span> <span class="remove-button"></span>';
				newSlide += 	'<input type="hidden" id="slide_title[]" name="slide_title[]" value="">';
				newSlide += 	'<input type="hidden" id="slide_big[]" name="slide_big[]" value="'+bigImg+'">';
				newSlide += 	'<input type="hidden" id="slide_small[]" name="slide_small[]" value="'+navImg+'">';
				newSlide += 	'<input type="hidden" id="slide_caption[]" name="slide_caption[]" value="">';
				newSlide += 	'<input type="hidden" id="slide_url[]" name="slide_url[]" value="">';
				newSlide += '</li>';

			var newObj = $(newSlide);
			
			newObj.find('.remove-button').click(removeListItem);
			newObj.find('.edit-button').click(editSlideItem);
			
			target.append(newObj);
		}

	 });

	// category page select posts category
	$('#ln_meta_catgory_page_select_category').change(function(){

		$(this).parent().find('#ln_meta_catgory_page_select_category_type').val($(this).find('option:selected').attr('data-type'));

	});

	// export custom style CSS
	$('#ln_theme_styling_export_css_button').click(function(e){

		e.preventDefault();

		// get data
		var content = $('#ln-custom-theme-generated-css-holder').html();

		// open new window
		var wnd =  window.open('','Custom Theme CSS','width=600,height=600');
    	var html = '<html><head></head><body>'+content+'</body></html>';
	    wnd.document.open();
	    wnd.document.write(html);
	    wnd.document.close();

	}); 











	/***********************************
	 * Fonts choose 
	 ***********************************/
	$('#ln_theme_heading_font').change(function(){
		var fontName = $(this).find('option:selected').text();
		var fontUrl = $(this).val();

		$('#ln-options-fonts-heading').attr('href', 'http://'+fontUrl);
		$(this).parent().find('.ln-font-preview').css('font-family', fontName);
	});

	$('#ln_theme_content_font').change(function(){
		var fontName = $(this).find('option:selected').text();
		var fontUrl = $(this).val();

		$('#ln-options-fonts-content').attr('href', 'http://'+fontUrl);
		$(this).parent().find('.ln-font-preview').css('font-family', fontName);
	});


	/***********************************
	 * Sliders 
	 ***********************************/

	$('#ln-post-sliders-upload-slides').click(function(){
		
		var post_id = $('#post_ID').val();

		window.send_to_editor = function(html) {
			tb_remove();
		};
		  
		tb_show('', 'media-upload.php?post_id='+post_id+'&amp;type=image&amp;TB_iframe=true');
		return false;
	});

	$('#ln-post-sliders-edit-slides').click(function(){
		
		var post_id = $('#post_ID').val();

		window.send_to_editor = function(html) {
			tb_remove();
		};
		  
		tb_show('', 'media-upload.php?post_id='+post_id+'&amp;type=image&amp;tab=gallery&amp;TB_iframe=true');
		return false;
	});

	/***********************************
	 * Clients 
	 ***********************************/
	$('#image-ln_clients_meta_client_module_img').click(function(){
		  
	  	window.send_to_editor = function(html) {
	  		imgurl = $('img',html).attr('src');
	  		$('#' + formfield).val(imgurl);
	  		tb_remove();
	  	};
	  
	  	formfield = $('#ln_clients_meta_client_module_img').attr('name');
	  	tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
	  	return false;
	});

	/***********************************
	 * Portfolio 
	 ***********************************/

	 $('#ln-post-portfolio-upload-slides').click(function(){
		
		var post_id = $('#post_ID').val();

		window.send_to_editor = function(html) {
			tb_remove();
		};
		  
		tb_show('', 'media-upload.php?post_id='+post_id+'&amp;type=image&amp;TB_iframe=true');
		return false;
	});

	$('#ln-post-portfolio-edit-slides').click(function(){
		
		var post_id = $('#post_ID').val();

		window.send_to_editor = function(html) {
			tb_remove();
		};
		  
		tb_show('', 'media-upload.php?post_id='+post_id+'&amp;type=image&amp;tab=gallery&amp;TB_iframe=true');
		return false;
	});

	/***********************************
	 * Pattern select 
	 ***********************************/
	$('.ln-select-pattern ul.patterns-list li').click(function(){
		
		var parent = $(this).parent().parent();

		// remove selected class from current
		$(this).parent().find('li.selected').removeClass('selected');

		// add selected class to this 
		$(this).addClass('selected');

		// change pattern id
		parent.find('input.pattern-select-target').val( $(this).attr('data-value') );

	});

});

