      function submit_test_ajax_form_settings(formId, url, inputs, method){

	    // $('#editor_inner').html('<img src="img/loadingspot.gif" align="center" />');
	    var frm = $('#' + formId);
	    var thisdata;
	    thisdata = 'ajax=true&submit=true&' + $('.settings_form').serialize();
	    
		if(url == '' | !url){
		  url = "<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/edit_text.php?";
		}

		
		
		if(document.getElementById('lang_value')){
		    thisdata += "&value=" + encodeURIComponent(document.getElementById('lang_value').value);
		}

		if(document.getElementById('text')){
		    thisdata += "&text=" + encodeURIComponent(document.getElementById('text').value);
		}
	    //prompt(thisdata);
	
	    //prompt(url);
	    if(!method){
	          ajax_PAS(url, thisdata, 'get', formId);
		}else{
		
		  ajax_PAS(url, thisdata, method, formId);
		}
      } 
      
      
      /*
            function submit_test_ajax_form(formId, url, inputs, method){

	    // $('#editor_inner').html('<img src="img/loadingspot.gif" align="center" />');
	    var frm = $('#' + formId);
	    var thisdata;
	    thisdata = $('#' + formId).serialize();
	    
		if(url == '' | !url){
		  url = "<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/edit_text.php?";
		}

		
		
		if(document.getElementById('lang_value')){
		    thisdata += "&value=" + encodeURIComponent(document.getElementById('lang_value').value);
		}

		if(document.getElementById('text')){
		    thisdata += "&text=" + encodeURIComponent(document.getElementById('text').value);
		}
	    //prompt(thisdata);
	   
	    if(!method){
	    ajax_PAS(url, thisdata, 'get', formId);
		}else{
		
	    ajax_PAS(url, thisdata, method, formId);
		}
      }
      */