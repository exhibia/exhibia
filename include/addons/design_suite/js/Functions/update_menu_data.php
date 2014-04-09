function update_menu_data(record, table, row, value){

	$.get('<?php echo $SITE_URL;?>include/addons/design_suite/MENUS/menu_editor.php?update_row=true&table=' + table + '&id=' + record + '&row=' + row + '&value=' + encodeURIComponent(value), function(response){
	    $('#edit_log').html(response);
	
	
	
	});


}