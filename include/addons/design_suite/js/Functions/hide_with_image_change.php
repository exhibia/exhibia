      function hide_with_image_change(id, type){
		      if(!type){
			   if($(id).css('display') == 'none'){
			  // prompt('test');
			      $('.show_editor').attr('src', '<?php echo $SITE_URL;?>img/hide.png');
			      $(id).css('display', 'block');
			    }else{
			    // prompt('test');
			      $('.show_editor').attr('src', '<?php echo $SITE_URL;?>img/show.png');
			      $(id).css('display', 'none');
			    }
			    
			}else{
			$('.show_editor').attr('src', '<?php echo $SITE_URL;?>img/hide.png');
			      $(id).css('display', 'block');
			
		      }
		  }