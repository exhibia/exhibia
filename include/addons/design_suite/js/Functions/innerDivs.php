var innerDivs = document.getElementsByTagName("div");

for(var i=0; i<innerDivs.length; i++)
{

    if(innerDivs[i].id){

    id_edit.push(innerDivs[i].id);

    
    var url = '<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/edit_style.php?';
     url2 = 'id=' + innerDivs[i].id + '&';
      

     txt = "<h75 class=\"edit-tabs\"  style=\"margin-bottom:-50px;max-width:50px;display:none;font-size:10px;color:white;position:static;z-index:999999999999999999;top:-50px;left:-10px;word-wrap:break-word;";

 txt += "background-color:red;\"><a  class=\"prevented\" href=\"javascript:;\" onclick=\"";

 txt += "ajax_PAS('" + url + "', '" + url2 + "', 'get' ,'css-editor'); \">#"+ innerDivs[i].id +"</a></h75>";
       $("#" + innerDivs[i].id).append(txt);
    
}else{
innerDivs[i].id = 'undefined[' + i + ']';

}
     if(innerDivs[i].getAttribute('class')){
     var url = '<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/edit_style.php?';
     url2 = 'class=' + innerDivs[i].getAttribute('class');

     
     class_edit.push(innerDivs[i].id);
     txt = "<h75 class=\"edit-tabs\" style=\"max-width:50px;display:none;font-size:10px;color:white;position:static;top:-50px;z-index:999999999;left:-10px;word-wrap:break-word;margin-bottom:-50px;";

     txt += "background-color:blue;\"><a  class=\"prevented\" href=\"javascript:;\" onclick=\"";
       txt += "ajax_PAS('" + url + "', '" + url2 + "', 'get', 'css-editor');\">."+ innerDivs[i].getAttribute('class') +"</a></h75>";

    
$("#" + innerDivs[i].id).append(txt);
    

     }
 
      
}