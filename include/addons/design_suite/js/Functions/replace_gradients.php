     var replace_gradients = function(){
      
	  $('#css-editor').css('display', 'none');
	  $('#my_css_editor_loading_bar').css('display', 'block');
	  
	  $.get('<?php echo $SITE_URL; ?>/include/addons/design_suite/DESIGN/editor/replace_values.php?table=style_sheets&type=gradient', function(response){
	      $('#my_css_editor_loading_bar').css('display', 'none');
		$('#css-editor').html(response);
	   $('#css-editor').css('display', 'block');
	  });
      
      }