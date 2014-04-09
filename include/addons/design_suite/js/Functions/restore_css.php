 function restore_css(){
 
    if(!getCookie('template')){
    $.get('<?php echo $SITE_URL;?>css/styles.php<?php echo $tenplate;?>&page=<?php echo $tenplate;?>.css', function(response){
    
	$('#css_live').append(response);
	
      });
      
      reloadStylesheets();
      
      }else{
          reloadStylesheets();
      
      }
    }