     var add_new_slider = function(){
     
	$.get('<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/edit_sliders.php?find_last=true', function(response){
	
	
	  $('#css-editor').css('display', 'none');
	  $('#css-editor').css('display', 'none');
	  $('#my_css_editor_loading_bar').css('display', 'block');
	  
	  $.get("<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/edit_sliders.php?get=sliderform&constant=" + response,
	    function(data){
	      document.getElementById('css-editor').innerHTML = data;
	       $('#css-editor').css('display', 'block');
	      $('#my_css_editor_loading_bar').css('display', 'none');
		 
		 
		 $('#constant2').append('<option value=\"' + response + '\">' + response + '</option>');
		  $('#constant2').val(response);
		  setup_mce();
	    });
	    
	    });;
      }