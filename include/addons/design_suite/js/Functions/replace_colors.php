var replace_colors = function(){
      
	  $('#css-editor').css('display', 'none');
	  $('#my_css_editor_loading_bar').css('display', 'block');
	  
	  $.get('<?php echo $SITE_URL; ?>/include/addons/design_suite/DESIGN/editor/replace_values.php?table=style_sheets', function(response){
	     
		$('#css-editor').html(response);
	   
	    $('#my_css_editor_loading_bar').css('display', 'none');
	    $('#css-editor').css('display', 'block');
	  });
      
      }