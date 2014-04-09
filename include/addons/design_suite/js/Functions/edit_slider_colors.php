 
    function edit_slider_colors(sliderId){
      $("#my_css_editor_loading_bar").html('<img src="<?php echo $SITE_URL;?>backendadmin/images/icons/loading-bar.gif" />');
  
	$('#my_css_editor_loading_bar').css('visibility', 'visible');
	  $('#my_css_editor_loading_bar').css('display', 'block');
    
    
	$.get('<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/edit_slider_colors.php?slider_id=' + sliderId, function(response){
	    $('#my_css_editor_loading_bar').css('display', 'none');
	    $('#css-editor').html(response);
	});
    }