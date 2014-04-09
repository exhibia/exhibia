   function change_constant(){
			    id = $("#choose_constant").val();
			    constant = $("#choose_constant option[value='" + id + "']").text();
	
			    id = constant + ":" + id;
			    
			      $.get("<?php echo $SITE_URL;?>include/addons/design_suite/edit_text.php?id=" + id, function(data){

				document.getElementById('css-editor').innerHTML = data;
						    
						      
				  });
			    
			    }
			    
			    
/*
 function change_constant(){
			    id = $("#choose_constant").val();
			    constant = $("#choose_constant option[value='" + id + "']").text();
	
			    id = constant + ":" + id;
			    
			      $.get("<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/edit_text.php?id=" + id, function(data){

				document.getElementById('css-editor').innerHTML = data;
						    
						      
				  });
			    
			    }
			    */