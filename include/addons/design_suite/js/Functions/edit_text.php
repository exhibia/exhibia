function edit_text(id){

 
  
$.get("<?php echo $SITE_URL;?>include/addons/design_suite/edit_text.php?id=" + id, function(data){
document.getElementById('css-editor').innerHTML = "<div style=\"text-align:center;\">" +data + "</div>"

 
});
}