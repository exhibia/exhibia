var edit_icons = function(){
    $.get('<?php echo $SITE_URL;?>include/addons/design_suite/icons.php?', function(response){
      $('#css-editor').html(response);
 });
 
}