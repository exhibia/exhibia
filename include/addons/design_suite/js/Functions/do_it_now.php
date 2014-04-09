      var do_it_now = function(divId, type){
      
      $('h50, h18, h19, h20, .pencil, .add, .edit_icon, h18 img, h37').css('visibility', 'collapse');
	      
		
	      $('#css-editor').css('display',  'none');
	      
	      
	    $('#my_css_editor_loading_bar').html('<img src="<?php echo $SITE_URL;?>backendadmin/images/icons/loading-bar.gif" /><br />Please Wait');
		$('#my_css_editor_loading_bar').css('visibility', 'visible');
		$('#my_css_editor_loading_bar').css('display', 'block');
	      
		  $.get('include/addons/design_suite/DESIGN/css_editor.php?type=' + type + '&id=' + encodeURIComponent(divId) + '&template=' + encodeURIComponent(getCookie('template')), function(result){
			  
			  $('#css-editor').html(result);
			  
			  	
			$.get('<?php echo $SITE_URL; ?>include/addons/design_suite/tabs.php', function(response){
			
			     $('#edit_icons_layer').html(response);
			  });
		    });
	    
		    
	 hide_with_image_change('#css-editor', 'show');
	 $('#css-editor input, #css-editor select, #css-editor #range').css('cursor', 'pointer');
      }