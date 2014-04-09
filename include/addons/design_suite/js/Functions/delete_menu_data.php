function delete_menu_data(record, table, confirmed){
link = '"' + record + '", "' + table + '", "yes"';
    if(!confirmed){
	$('#alert_message_content').html('Please Confirm that you want to delete this link?<input type="submit" onclick="delete_menu_data(\'' + record + '\', \'' + table + '\', \'yes\');" value="Yes"><input type="submit" onclick="$(\'#alert_message\').dialog(\'close\');" value="No">'); 
	
	   $( "#alert_message" ).dialog({
            modal: true,
            autoOpen: false,
            buttons: {
                "<?php echo OK; ?>": function() {
                    $( this ).dialog( "close" );
                }
            }
        });

	$('#alert_message').dialog('open');

      }else{
      $('#alert_message').dialog('close');
	  $.get('<?php echo $SITE_URL;?>include/addons/design_suite/MENUS/menu_editor.php?delete=true&id=' + encodeURIComponent(record) + '&table=' + table, function(response){
	      $('#edit_log').html(response);
	  window.location.href = window.location.href;
	  });
    }
}