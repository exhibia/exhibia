			    
function send_background(){

            color = document.getElementById('background-color').value;
	    repeat = $("#background-repeat").val();
	    attachment = $("#background-attachment").val();

      $.get('<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/background.php?' + 'update_bg=yes&background-color=' + encodeURIComponent(color) + '&background-repeat=' + encodeURIComponent(repeat) + '&background-attachment=' + encodeURIComponent(attachment) + '&element=' + encodeURIComponent(document.getElementById('background-element').value) , function(response){
      
	  update_bg();
	  
      $(document.getElementById('background-element').value).css('background-image', '');
      });



}