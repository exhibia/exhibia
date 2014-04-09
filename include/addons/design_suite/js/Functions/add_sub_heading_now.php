function add_sub_heading_now(menu_id, uniqid, table){
    menu = menu_id;
    table = table;
    name = encodeURIComponent($('#name_' + uniqid).val());
    menu_index = $('#menu_index_'+ uniqid).val();
    
    $.get('<?php echo $SITE_URL;?>include/addons/design_suite/MENUS/menu_editor.php?menu=' + menu + '&menu_index=' + menu_index + '&name=' + name + '&add_first_heading=true', function(response){
    
	$('#edit_log').html(response);
    window.location.href = window.location.href;
    });

}