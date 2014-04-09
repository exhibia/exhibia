var save_changes = function(selector, new_selector, new_type, form_id){
setCookie(encodeURIComponent($('input[name="template"]').val()), 365);
$('#css-editor').css('display', 'none');
$('#my_css_editor_loading_bar').css('display', 'none');

      if(new_selector){

	    setCookie('new_selector', new_selector, 1);
			      
			      
      }else{

	    setCookie('new_selector', selector, 1);

      }

      if(new_type){
	    setCookie('new_type', new_type, 1);

      }else{
	    setCookie('new_type', type, 1);
      }
      
	  data = get_values_from_browser(selector);

//prompt('<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/parse_css.php?selector=' + encodeURIComponent($('#selector').val()) + '&template=' + encodeURIComponent($('input[name="template"]').val()) + '&human_description=' + encodeURIComponent($('input[name="human_description"]').val()) + '&human_name=' + encodeURIComponent($('input[name="human_name"]').val()) + '&' + data);
	    $.get('<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/parse_css.php?selector=' + encodeURIComponent($('#selector').val()) + '&template=' + encodeURIComponent($('input[name="template"]').val()) + '&human_description=' + encodeURIComponent($('input[name="human_description"]').val()) + '&human_name=' + encodeURIComponent($('input[name="human_name"]').val()) + '&' + data, function(response){
	   $('.ui-dialog').css('zIndex', '9999999999999999999999999999999999999999999');
	   
	 showAlertBox(response);
	
	    
		
		do_it_now(selector);
	    });



}