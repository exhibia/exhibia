var submit_test_ajax_form = function(formId, url, container, method){


 
 
  if(!url){
  try{
    if(CKEDITOR.instances['lang_value'].getData()){
      data = 'value=' + encodeURIComponent(CKEDITOR.instances['lang_value'].getData()) + '&' + $('#' + formId).serialize();
      $('#' + $('#constant').val()).html(CKEDITOR.instances['lang_value'].getData());
    }else{
    data = $('#' + formId).serialize()
    
    }
  }catch(oo){
  
  data = $('#' + formId).serialize() + '&value=' + encodeURIComponent($('#lang_value').html()); 
  
  }
      url = '<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/edit_sliders.php?' + data;
  }else{
  
  data = $('#' + formId).serialize();
  
      try{ 
      data = data + '&description=' + encodeURIComponent(CKEDITOR.instances['description'].getData()); 
      }catch(oo){}
  }

    $.get(url + '&' + data, function(response){
      if(!container){
	    $('#dialog').html(response);
	    $('#dialog').dialog();
	    $('#editor').qtip('close');
	    constant = $('#constant').val();
	    if(constant.match(/SLIDER/)){
	  
		edit_sliders($('#constant2').val());
	    }else{
	    
		$('#edit_log').html(response);
	   }
	   
	}else{
	
	    $('#container').html(response);
	
	
	}
    
    
    });
}