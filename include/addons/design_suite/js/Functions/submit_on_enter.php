     function submit_custom(evt){
     var charCode = (evt.which) ? evt.which : event.keyCode


	    if(charCode == "13"){
     
		ajax_PAS('include/addons/design_suite/DESIGN/buttonsets.php?', 'newset=' + document.getElementById('buttonset').value + '&buttonset=' + $('#buttons').val() , 'get','button-preview');
     
	      }
     
     }