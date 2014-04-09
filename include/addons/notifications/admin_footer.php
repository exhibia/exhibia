<?php
$str = '';
foreach($addons as $key => $value){
$str .= "&$value=";

$version = db_fetch_array(db_query("select * from sitesetting where name = 'version' and value like '$value:%'"));
$version = explode(":", $version[2]);
$str .= $version[1];

}
?>

<script type="text/javascript" src="js/ui/ui.core.min.js"></script>  
<script type="text/javascript" src="js/ui/ui.dialog.min.js"></script>
<div id="update_info"></div>
<script>
      $.get('<?php echo $SITE_URL;?>include/addons/notifications/curl.php?function=checkupdates&<?php echo $str;?>', function(response){

	    $("#notification_area").html(response);

	  }
      );
function show_update_info(addon, version){

      $.get('<?php echo $SITE_URL;?>include/addons/notifications/curl.php?function=update_info&addon=' + addon + '&version=' + version, function(response){

	    $("#update_info").html(response);
	    
$("#update_info").dialog({modal: true, width : 500, height: 500, autoOpen: true, buttons: { "Ok": function() { $(this).dialog("close"); } }});
	    
	  }
      );



}


</script>