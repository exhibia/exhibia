function create_editor_from_tag(divId){
    var tag = $('#tag').val();
  
    create_editor(tag, 'psuedo');
}

function create_editor_from_class(divId, tag){
    var tag = $('#with_class').val();
  
    create_editor(divId + ' ' + tag, 'psuedo');

  }
  
      var create_editor = function(divId, type, new_selector){
      
      $('#css-editor').css('display', 'none');
	  $('#my_css_editor_loading_bar').html('<img src="<?php echo $SITE_URL;?>backendadmin/images/icons/loading-bar.gif" /><br />Please Wait');
				$('#my_css_editor_loading_bar').css('display', 'block');
				$('#my_css_editor_loading_bar').css('visibility', 'visible');
				
				
	      if ($(divId).length) {
		high_light(divId);
	      
	      
	      if(!$('#selector').length){
			//refresh_styles(document.getElementById('selector').value);
			do_it_now(divId, type);
		   
			$('#css-editor').css('display', 'block');	
			
		    }else{
		    
			if(document.getElementById('selector').value == divId){
			
			    get_position_from_browser(divId);
			    get_dimensions_from_browser(divId);
			    $('#css-editor').css('display', 'block');
			
			}else{
	
			
			
			refresh_styles(document.getElementById('selector').value);
			
			do_it_now(divId, type );
				
				$('#css-editor').css('display', 'block');
				
			}
		    
		    }
		}else{
		
		    $('#alert_message_content').html("Object was not found in the DOM. Please try other combinations or different search criteria.");
		    
		    $('#alert_message').dialog();
		
		}
	   
	   
       }