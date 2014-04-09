      var edit_sliders = function(slider_id){
      $("#my_css_editor_loading_bar").html('<img src="<?php echo $SITE_URL;?>backendadmin/images/icons/loading-bar.gif" />');
  
	$('#my_css_editor_loading_bar').css('visibility', 'visible');
	  $('#my_css_editor_loading_bar').css('display', 'block');
	     
	 
	  $.get("<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/edit_sliders.php?get=sliderform&constant=" + slider_id,
	    function(data){
	      if(!document.getElementById('slider_box')){
		  $('#column-right').html(data);
	      
	      }else{
		    $('#slider_box').removeClass('jshowoff');
		    $('.jshowoff').jshowoff('destroy');
		    $('.jshowoff').replace(data);
	      
	      
	      }
		
		
      });
      }
      
      
   