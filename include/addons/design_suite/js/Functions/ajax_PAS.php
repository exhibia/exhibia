/*function ajax_PAS(url,senddata,method,id){
var url;
var senddata;
var method;
var id;

        $.ajax({

		method: method,
	      url: url,
	      data: senddata,
	      success: function (response) {
                $("#" + id).html(response);
            }

	    }
        );



}*/


			
function ajax_PAS(url,senddata,method,id){
var url;
var senddata;
var method;
var id;


				var opacity = 0.6, toOpacity = 1.0, duration = 250;
				//set opacity ASAP and events
				
						
						$('#'+id).fadeTo(duration,toOpacity);
						$('#'+id).css('height', 'auto');
					
				
						
						
						$('#menu li').css('background-color', '#9eb4b7');
						$('#menu li').css('opacity', '1.0');
					
 $('#'+id).css('min-height', '50px');
  $('.opacity').css('min-height', '50px');	
  $("#my_css_editor_loading_bar").html('<img src="<?php echo $SITE_URL;?>backendadmin/images/icons/loading-bar.gif" />');
  
   $('#my_css_editor_loading_bar').css('visibility', 'visible');
    $('#my_css_editor_loading_bar').css('display', 'block');
   
        $.ajax({

		method: method,
	      url: url,
	      data: senddata,
	      success: function (response) {
	      $('#my_css_editor_loading_bar').css('display', 'none');
                $("#" + id).html(response);
                $('#'+id).css('height', 'auto');
                 $('.opacity').css('min-height', '220px');
            }

	    }
        );
//setup_mce();


}