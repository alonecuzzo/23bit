function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function systemshortcodesubmit() {
	
	var tagtext;
	
	var sys_shortcode = document.getElementById('systemshortcode_panel');
   var sys_portfolio = document.getElementById('portfolio_panel');
var sys_icon = document.getElementById('SysIcon_panel');
var sys_contacttag = document.getElementById('SysContact_panel');
var sys_googlemap_panel = document.getElementById('Sysgooglemap_panel');

	if (sys_googlemap_panel.className.indexOf('current') != -1) {
		var gmap_address = document.getElementById('gmap_address').value;
	var gmap_height = document.getElementById('gmap_height').value;
	var gmap_latitude = document.getElementById('gmap_latitude').value;
	var gmap_longitude = document.getElementById('gmap_longitude').value;
	var gmap_zoom = document.getElementById('gmap_zoom').value;
		var gmap_html = document.getElementById('gmap_html').value; 
	var gmap_controls = document.getElementById('gmap_controls').value; 
	var gmap_popup = document.getElementById('gmap_popup').value; 
	var gmap_scrollwheel=document.getElementById('gmap_scrollwheel').value;
	var gmap_types=document.getElementById('gmap_types').value;
   
		if (gmap_height != 0 )
			tagtext = "[gmap address=" + gmap_address + " height=" + gmap_height + " latitude=" + gmap_latitude + " longitude=" + gmap_longitude + " zoom=" + gmap_zoom + " html=" + gmap_html + " controls=" + gmap_controls + "  popup=" + gmap_popup + " scrollwheel=" + gmap_scrollwheel + " maptypes=" + gmap_types + "]";
		else
			tinyMCEPopup.close();
	}


if (sys_contacttag.className.indexOf('current') != -1) {
		var syscontactemail = document.getElementById('syscontactemail_tag').value;
    	
		if ( syscontactemail != 0 ) {
			tagtext = "[contact_form email=" + syscontactemail + " ]";
		}else{
			tinyMCEPopup.close();
			}
	}
	
	if (sys_portfolio.className.indexOf('current') != -1) {
		var portfolio_tag = document.getElementById('portfolio_tag').value;
    	var max_columns = document.getElementById('max_columns').value;
		var images_pages = document.getElementById('images_pages').value;
		if (portfolio_tag != 0 )
			tagtext = "[portfolio id=" + portfolio_tag + " images=" + images_pages + " column=" + max_columns + " ]";
		else
			tinyMCEPopup.close();
	}
	
	// who is active ?
	if (sys_shortcode.className.indexOf('current') != -1) {
		var sys_shortcodeid = document.getElementById('systemshortcode_tag').value;
		switch(sys_shortcodeid)
{
case 0:
 	tinyMCEPopup.close();
  break;
case "youtube":
	tagtext = "["+ sys_shortcodeid + " width=\"500\" height=\"200\" id=\"\"]";
  break;
    case "vimeo":
	tagtext = "["+ sys_shortcodeid + " width=\"400\" height=\"300\" id=\"\"]";
  break;
   case "wordpresstv":
	tagtext = "["+ sys_shortcodeid + " width=\"400\" height=\"300\" id=\"\"]";
  break;
   case "bliptv":
	tagtext = "["+ sys_shortcodeid + " width=\"400\" height=\"300\" id=\"\"]";
  break;
  case "googlevideo":
	tagtext = "["+ sys_shortcodeid + " width=\"400\" height=\"300\" id=\"\"]";
  break;
case "chart":
	tagtext = "["+ sys_shortcodeid + " data=\"70,25,20.01,4.99\" colors=\"058DC7,50B432,ED561B,EDEF00\" size=\"430x200\" bg=\"F1F2F4\" title=\"3D Pie Chart Title\" labels=\"Reffering+sites|Google|Yahoo|Other\" advanced=\"\"  type=\"pie\" ]";
  break;
case "flickr":
	tagtext = "["+ sys_shortcodeid + " count=\"5\" id=\"flickrid\"]";
  break;
case "twitter":
	tagtext = "["+ sys_shortcodeid + " count=\"5\" username=\"twitter_username\"]";
  break;
case "recentpost":
	tagtext = "["+ sys_shortcodeid + " count=\"5\" cat_id=\"2\" thumb=\"true\"]";
  break;
case "popularpost":
	tagtext = "["+ sys_shortcodeid + " count=\"5\" thumb=\"true\"]";
  break;
case "blog":
	tagtext = "["+ sys_shortcodeid + " limtis=\"5\" cat=\"2\" image=\"true\" pagination=\"true\"]";
  break;
case "contact_info":
	tagtext = "["+ sys_shortcodeid + " name=\"name\" address=\"address\" state=\"state\" city=\"city\" zip=\"zip\" phone=\"phone\" email=\"email\"]";
  break;
case "clear":
	tagtext="["+sys_shortcodeid + "]";
break;
case "divider":
	tagtext="["+sys_shortcodeid + "]";
break;
case "divider_space":
	tagtext="["+sys_shortcodeid + "]";
break;
case "divider_line":
	tagtext="["+sys_shortcodeid + "]";
break;
case "divider_top":
	tagtext="["+sys_shortcodeid + "]";
break;
case "list":
	tagtext="["+sys_shortcodeid + " style=\"\"]<ul><li>Item #1</li><li>Item #2</li><li>Item #3</li></ul>[/" + sys_shortcodeid + "]";
break;
case "error":
	tagtext="["+sys_shortcodeid + "] Insert your message text here [/" + sys_shortcodeid + "]";
break;
case "info":
	tagtext="["+sys_shortcodeid + "] Insert your message text here [/" + sys_shortcodeid + "]";
break;
case "alert":
	tagtext="["+sys_shortcodeid + "] Insert your message text here [/" + sys_shortcodeid + "]";
break;
case "download":
	tagtext="["+sys_shortcodeid + "] Insert your message text here [/" + sys_shortcodeid + "]";
break;
case "success":
	tagtext="["+sys_shortcodeid + "] Insert your message text here [/" + sys_shortcodeid + "]";
break;
case "note":
	tagtext="["+sys_shortcodeid + " title=\"\" align=\"\"] Insert your message text here [/" + sys_shortcodeid + "]";
break;
case "highlight":
	tagtext="["+sys_shortcodeid + " bgcolor=\"\" textcolor=\"\"] Insert your highlight text here [/" + sys_shortcodeid + "]";
break;
case "dropcap1":
	tagtext="["+sys_shortcodeid + "]A[/" + sys_shortcodeid + "]";
break;
case "dropcap2":
	tagtext="["+sys_shortcodeid + "]A[/" + sys_shortcodeid + "]";
break;
case "dropcap3":
	tagtext="["+sys_shortcodeid + "]A[/" + sys_shortcodeid + "]";
break;
case "dropcap4":
	tagtext="["+sys_shortcodeid + " color=\"\" textcolor=\"\"]A[/" + sys_shortcodeid + "]";
break;
case "blockquote":
	tagtext="["+sys_shortcodeid + " cite=\"authorname\" align=\"\"] Insert your blockquote content goes here [/" + sys_shortcodeid + "]";
break;
case "icon":
	tagtext = "["+ sys_shortcodeid + " style=\"male\" ] text here [/" + sys_shortcodeid + "]";
  break;
case "fancy_table":
	tagtext = "["+ sys_shortcodeid + "]<table><br /><tbody><br /><tr><br /><th>Heading 1</th><br /><th>Heading 2</th><br /><th>Heading 3</th><br /><th>Heading 4</th><br /></tr><br /><tr><br /><td>Division 1</td><br /><td>Division 2</td><br /><td>Division 3</td><br /><td>Division 4</td><br /></tr><br /><tr><br /><td>Division 1</td><br /><td>Division 2</td><br /><td>Division 3</td><br /><td>Division 4</td><br /></tr><br /></tbody><br /></table><br />[/" + sys_shortcodeid + "]";
break;
case "galleria":
	tagtext="["+sys_shortcodeid + "  width=\"600\" height=\"400\" autoplay=\"2000\" ] Insert the full URL path to your images [/" + sys_shortcodeid + "]";
break;
case "images_mini_gallery":
	tagtext = "["+ sys_shortcodeid + "  width=\"299\" height=\"200\"] Insert the full URL path to your images [/" + sys_shortcodeid + "]";
break;
case "image":
	tagtext = "["+ sys_shortcodeid + "  width=\"\" height=\"\" link=\"#\" lightbox=\"false\" title=\"\"]http://path_to_your_image[/" + sys_shortcodeid + "]";
break;
case "photoframe":
	tagtext = "["+ sys_shortcodeid + "  width=\"\" height=\"\"  src=\"\"]";
break;
case "button":
	tagtext = "["+ sys_shortcodeid + "  link=\"#\" linktarget=\"\" align=\"\" bgcolor=\"\" size=\"\"] Button text [/" + sys_shortcodeid + "]";
break;
case "email_me":
	tagtext = "["+ sys_shortcodeid + "  emailid=\"#\"]Email Me[/" + sys_shortcodeid + "]";
break;
case "download_link":
	tagtext = "["+ sys_shortcodeid + "  link=\"#\"]Download Link[/" + sys_shortcodeid + "]";
break;
case "external_link":
	tagtext = "["+ sys_shortcodeid + "  url=\"#\" target=\"_self\"] Read More [/" + sys_shortcodeid + "]";
break;
case "toggle_content":
	tagtext = "["+ sys_shortcodeid + "  heading=\"Toggle Heading\"] content goes here [/" + sys_shortcodeid + "]";
break;
case "tabs":
	tagtext="["+sys_shortcodeid + " tab1=\"Tab 1 Title\" tab2=\"Tab 2 Title\" tab3=\"Tab 3 Title\"]<br /><br />[tab]Insert tab 1 content here[/tab]<br />[tab]Insert tab 2 content here[/tab]<br />[tab]Insert tab 3 content here[/tab]<br /><br />[/" + sys_shortcodeid + "]";
break;
case "fancy_box":
	tagtext="["+sys_shortcodeid + " title=\"Box Heading\" bgcolor=\"#ff8800\" heading=\"$9.95\"] Insert you content here [/" + sys_shortcodeid + "]";
break;
case "minimal_box":
	tagtext="["+sys_shortcodeid + " title=\"Box Heading\" heading=\"$9.95\"] Insert you content here [/" + sys_shortcodeid + "]";
break;
case "one_half_layout":
tagtext = "[one_half]<br /> Insert you content here <br />[/one_half]<br /><br />[one_half_last]<br /> Insert you content here <br />[/one_half_last]<br />";
break;
case "one_third_layout":
tagtext = "[one_third]<br /> Insert you content here <br />[/one_third]<br /><br />[one_third]<br /> Insert you content here <br />[/one_third]<br /><br />[one_third_last]<br /> Insert you content here <br />[/one_third_last]<br />";
break;
case "one_fourth_layout":
tagtext = "[one_fourth]<br /> Insert you content here <br />[/one_fourth]<br /><br />[one_fourth]<br /> Insert you content here <br />[/one_fourth]<br /><br />[one_fourth]<br /> Insert you content here <br />[/one_fourth]<br /><br />[one_fourth_last]<br /> Insert you content here <br />[/one_fourth_last]<br />";
break;
case "one_fifth_layout":
tagtext = "[one_fifth]<br /> Insert you content here <br />[/one_fifth]<br /><br />[one_fifth]<br /> Insert you content here <br />[/one_fifth]<br /><br />[one_fifth]<br /> Insert you content here <br />[/one_fifth]<br /><br />[one_fifth]<br /> Insert you content here <br />[/one_fifth]<br /><br />[one_fifth_last]<br /> Insert you content here <br />[/one_fifth_last]<br />";
break;
case "one_third_two_third_layout":
tagtext = "[one_third]<br /> Insert you content here <br />[/one_third]<br /><br />[two_third_last]<br /> Insert you content here <br />[/two_third_last]<br />";
break;
case "two_third_one_third_layout":
tagtext = "[two_third]<br /> Insert you content here <br />[/two_third]<br /><br />[one_third_last]<br /> Insert you content here <br />[/one_third_last]<br />";
break;
case "one_fourth_three_fourth_layout":
tagtext = "[one_fourth]<br /> Insert you content here <br />[/one_fourth]<br /><br />[three_fourth_last]<br /> Insert you content here <br />[/three_fourth_last]<br />";
break;
case "one_fourth_one_half_one_fourth_layout":
tagtext = "[one_fourth]<br /> Insert you content here <br />[/one_fourth]<br /><br />[one_half]<br /> Insert you content here <br />[/one_half]<br /><br />[one_fourth_last]<br /> Insert you content here <br />[/one_fourth_last]<br />";
break;
case "one_half_one_fourth_one_fourth_layout":
tagtext = "[one_half]<br /> Insert you content here <br />[/one_half]<br /><br />[one_fourth]<br /> Insert you content here <br />[/one_fourth]<br /><br />[one_fourth_last]<br /> Insert you content here <br />[/one_fourth_last]<br />";
break;
case "one_fourth_one_fourth_one_half_layout":
tagtext = "[one_fourth]<br /> Insert you content here <br />[/one_fourth]<br /><br />[one_fourth]<br /> Insert you content here <br />[/one_fourth]<br /><br />[one_half_last]<br /> Insert you content here <br />[/one_half_last]<br />";
break;
case "one_fifth_four_fifth_layout":
tagtext = "[one_fifth]<br /> Insert you content here <br />[/one_fifth]<br /><br />[four_fifth_last]<br /> Insert you content here <br />[/four_fifth_last]<br />";
break;
case "four_fifth_one_fifth_layout":
tagtext = "[four_fifth]<br /> Insert you content here <br />[/four_fifth]<br /><br />[one_fifth_last]<br /> Insert you content here <br />[/one_fifth_last]<br />";
break;
case "two_fifth_three_fifth_layout":
tagtext = "[two_fifth]<br /> Insert you content here <br />[/two_fifth]<br /><br />[three_fifth_last]<br /> Insert you content here <br />[/three_fifth_last]<br />";
break;
case "three_fifth_two_fifth_layout":
tagtext = "[three_fifth]<br /> Insert you content here <br />[/three_fifth]<br /><br />[two_fifth_last]<br /> Insert you content here <br />[/two_fifth_last]<br />";
break;
default:
tagtext="["+sys_shortcodeid + "] Insert you content here [/" + sys_shortcodeid + "]";
}
}

if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}