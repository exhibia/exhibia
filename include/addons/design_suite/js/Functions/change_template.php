function change_template(){
    $('h50').css('visibility', 'collapse');
    
    $.get('<?php echo $SITE_URL;?>/backendadmin/curl.php?type=templates', function(response){
    
	$('#alert_message').html(response);
	  $( "#alert_message" ).dialog({
            modal: true,
            autoOpen: true,
            buttons: {
                "<?php echo OK; ?>": function() {
                    $( this ).dialog( "close" );
                },
            
            },
            width:800,
            height:500
        });
       // $('#alert_message').dialog('open');
     });
}


function show_progress(template){

$('#my_css_editor_loading_bar').css('height', '120px');
$('#my_css_editor_loading_bar').css('overflow-y', 'auto');
    $.get('<?php echo $SITE_URL;?>progress.txt', function(response){
      
 	if(response !== 'Complete'){
	 
	  setTimeout(function(){show_progress(template)},100);
	  
		  if(parseInt(response) < 100){
			    
			
			  
			    $('#progress_bar_templ_inner').css('backgroundColor', 'red');
			    $('#progress_bar_templ_inner').css('width', parseInt(response) + '%');
			    $('#progress_bar_templ_text').html('Downloading');
			    $('#progress_bar_templ_inner').html(response + '%');
		  }else{
		  
			  if(parseInt(response) == 100){
			  
			      $.get('<?php echo $SITE_URL;?>include/addons/design_suite/extract_template.php?new_template=' + template, function(response){
			      
			      
			      
			      
			      });
			  
			  
			  }
			//$('#my_css_editor_loading_bar').html('<pre>' + response + '</pre>');
		  }
	
	}else{   
	    return;
	
	}
    
    });
    
   

}

function install_new_template(template){
    $('#my_css_editor_loading_bar').html('<center><img src="<?php echo $SITE_URL;?>backendadmin/images/icons/loading-bar.gif" style="float:center;" /><br /><div id="progress_bar_templ_text"></div><br /><div id="progress_bar_templ" style="border:1px solid black;text-align:left;height:20px;float:center;border-radius:6px;background:#fff;width:220px;"><div id="progress_bar_templ_inner" style="width:0px;height:100%;color:#fff;padding-left:5px;"></div></div></center>');
    $('#my_css_editor_loading_bar').css('display', 'block');
    $('#my_css_editor_loading_bar').css('visibility', 'visible');
    
	      $.get('<?php echo $SITE_URL;?>include/addons/design_suite/get_template.php?new_template='+ template, function(response){
		   
	      });	
show_progress(template);
	  
}