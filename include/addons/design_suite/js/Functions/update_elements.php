function update_elements(){
str = 'css=' + encodeURIComponent(document.getElementById('css-id-editor').value) + '&css-element=' + document.getElementById('page').options[document.getElementById('page').selectedIndex].value + '&css-type=' + document.getElementById('css-type');


$(document.getElementsByTagName('head')[0]).append(document.getElementById('css-id-editor'));
  ajax_PAS('include/addons/design_suite/DESIGN/edit_style.php?', str ,'get','css-editor');



}

/*
function update_elements(){
str = 'css=' + encodeURIComponent(document.getElementById('css-id-editor').innerHTML) + '&css-element=' + document.getElementById('css-element') + '&css-type=' + document.getElementById('css-type');


$(document.getElementsByTagName('head')[0]).append(document.getElementById('css-id-editor'));
  ajax_PAS('include/addons/design_suite/DESIGN/edit_style.php?', str ,'get','css-editor');



}
*/