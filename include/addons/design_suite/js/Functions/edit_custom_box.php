      var edit_custom_box = function(custom_id){
	  $('#css-editor').css('display', 'none');
	  $('#css-editor').css('display', 'none');
	  $('#my_css_editor_loading_bar').css('display', 'block');
	  $.get("<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/add_custom_box.php?get=sliderform&constant=" + $('#constant2').val() + "&get=customform&constantc=" + custom_id,
	    function(data){
	      document.getElementById('css-editor').innerHTML = data;
	       $('#css-editor').css('display', 'block');
	      $('#my_css_editor_loading_bar').css('display', 'none');
		 setup_mce($('#text_editorc').html(), $('#constant2c').val() );
	    });
      }