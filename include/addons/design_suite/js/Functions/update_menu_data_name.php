function update_menu_data_name(record, table, row, value, record_id){
    //prompt('<?php echo $SITE_URL;?>include/addons/design_suite/MENUS/menu_editor.php?update_name=true&table=' + table + '&id=' + record_id + '&row=' + row + '&value=' + encodeURIComponent(value));
	$.get('<?php echo $SITE_URL;?>include/addons/design_suite/MENUS/menu_editor.php?update_name=true&table=' + table + '&id=' + record_id + '&row=' + row + '&value=' + encodeURIComponent(value), function(response){
	    $('#edit_log').html(response);
	
	
	
	});

}