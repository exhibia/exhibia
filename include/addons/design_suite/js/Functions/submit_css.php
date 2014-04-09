			  function submit_css(form_id){
			  
			  
			       var data = $('#css_editor .advanced').serialize(); 
			     
				$.ajax({
				
				type: 'post',
				dataType:'text',
				url: "<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/parse_css.php",
				
				data:"css=" + css + "&file=" + file + "&save=true", 
				
				  success: function(response){
				  alert(response);
					  if(response == 'success'){
					      window.location.href = '<?php echo $SITE_URL;?>';
					  
					  }else{
					  
					      $('#edit_log').html(response);
					  
					  }
				    }
			      
			      });
			  
			  
			  
			  }