function restore_css_now(value,file){

    if(value == 'no'){
	$('#master_css').attr('href', '<?php echo $SITE_URL;?>css/styles.php');
	$('#my_css_editor_loading_bar').html('<img src="http://gunsbid.com/backendadmin/images/icons/loading-bar.gif">');
	$('#my_css_editor_loading_bar').css('display', 'none');
    }else{
    
    
	$.get('<?php echo $SITE_URL;?>css/styles.php?restore_css=yes&page=' + file, function(response){
	
	    
	    if(response == 'success'){
		$('#my_css_editor_loading_bar').html('<img src="http://gunsbid.com/backendadmin/images/icons/loading-bar.gif">');
		$('#master_css').attr('href', '<?php echo $SITE_URL;?>css/styles.php');
		
		}
		alert(response);
		window.location.href = window.location.href;
	    });
      }
    }



function load_css_file(file){
$('#my_css_editor_loading_bar').html('<img src="<?php echo $SITE_URL;?>backendadmin/images/icons/loading-bar.gif" /><br /><font style="color:red;font-weight:bold;">Loading Restore Point</font>');


$.get('<?php echo $SITE_URL;?>css/get_css.php?page=' + file + '&_' + new Date().getTime(), function(response){

    $('#master_css').attr('href', '<?php echo $SITE_URL;?>css/get_css.php?page=' + file + '&_' + new Date().getTime());
    
    
    $('#my_css_editor_loading_bar').html('<font style="color:red;font-weight:bold;">Restore from this date?</font><ul style="list-style:none;"><li style="display:inline;"><input type="checkbox" value="yes" id="restor_css"  onclick="restore_css_now(\'yes\', \'' + file + '\');" />Yes&nbsp;</li><li style="display:inline;"><input type="checkbox" value="no" id="restor_css" onclick="restore_css_now(\'no\');" />No&nbsp;</li></ul>');
    
    $('#my_css_editor_loading_bar').css('visibility', 'visible');
    $('#my_css_editor_loading_bar').css('display', 'block');
   
});
}
