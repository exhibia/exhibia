function toggle_editor_buttons(status){

    				
				$('h18').css('visibility', status);
				$('h19').css('visibility', status);
				$('h20').css('visibility', status);
				
				
				if(getCookie('ids') != 'collapse'){
				    $('h50').css('visibility', status);
				}
				if(getCookie('class') != 'collapse'){
				    $('h60').css('visibility', status);
				}
				if(getCookie('pencil') != 'collapse'){
				    $('.pencil').css('visibility', status);
				}
				
				if(getCookie('add') != 'collapse'){
				    $('.add').css('visibility', status);
				}
				if(getCookie('idea') != 'collapse'){
				    $('.idea').css('visibility', status);
				}
				$('.menu_edit_icon').css('visibility', status);
				
				$('.ui-icon-gripsmall-diagonal-se').css('visibility', status);
				
				
				if(getCookie('sort') != 'collapse'){
				    $('.sort_icon').css('visibility', status);
				}
				$('#edit_icons_layer').css('visibility', status); 
				
				$('.menu_edit_icon').css('visibility', status);
				
				
				if(getCookie('addons') != 'collapse'){
				    $('.edit_addons').css('visibility', status);
				}
				    $('h50, h60, h70').each(function(){
				      var id = $(this).attr('title');
				   $(this).bind('mouseover', function(){
				     
					 	  $(this).qtip({
					  content: {
						  text: '<ul style="max-height:120px;overflow-y:auto;">Loading...</ul>', // The text to use whilst the AJAX request is loading
						  ajax: {
							  url: '<?php echo $SITE_URL; ?>include/addons/design_suite/tabs.php?unique_class=<?php echo $unique_class;?>&type=<?php if($ids['type'] == 'class') { echo 'class'; }else{ echo 'id'; } ?>&selector=' + encodeURIComponent($(this).attr('title')), // URL to the local file
							  type: 'GET', // POST or GET
							  data: {}, // Data to pass along with your request
							  once: false,
							  success: function(data, status) {
								// Process the data
				
								// Set the content manually (required!)
								this.set('content.text', '<dl style="max-height:120px;overflow-y:auto;">' +  data + '</dl>');
							  }
						  }
					  },
					  
					  
					  hide: 'unfocus', show: { ready:true, solo: true }, 
					  
					  position: {target : $(this).closest('h50'), my : 'top left', at: 'top right',
					  
					  container: $('body'),  
					  viewport: $(window),
					  adjust: {
						      target: $(document),
						      resize: true // Can be ommited (e.g. default behaviour)
					      }
					  
					  }
					  
				  });
				  
				  
				  });
				});
	    }
