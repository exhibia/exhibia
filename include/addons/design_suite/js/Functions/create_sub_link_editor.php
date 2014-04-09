function create_sub_link_editor(menu_name, span_id){

    var inline = 'true';
    span_id_out = span_id.split('_');
    
    url = '<?php echo $SITE_URL;?>/include/addons/design_suite/MENUS/edit_menu.php?inline=true&menu=' + menu_name + '&id=' + span_id_out[1] + '&table=' + 'page_areas_components';
    
    $.get(url, function(response){
    
	$('.qtip #menu_edit_entry_' + span_id).html(response);
	
    
    });

}