

		  var id_edit = Array();
		  var class_edit = Array();

function draw_border(){
for(var i=0; i<id_edit.length; i++)
{
  $("#" + id_edit[i]).css("border", "1px dashed blue");
  $("#" + id_edit[i] + ' h75').css("display", "block");
 }
 for(var i=0; i<class_edit.length; i++)
{
$("." + class_edit[i] + ' h75').css("display", "block");
        $("." + class_edit[i]).css("border", "1px dashed orange");

}
$('h75').css("display", "block");
$('h75').css("max-width", "50px");
	}