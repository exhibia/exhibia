
function add_first_sub(menu_name, menuTab){



			    <?php
			    if($_SESSION['userid'] >= 1){
				?>
			
				parent = $('#menu_edit_entry_' + menuTab).attr('id');
				if(menu_name == 'design_menu'){

				  my = 'bottom left';
				  at = 'top left';
				  target = $('#' + parent);
				}else{

				  my = 'top left';
				  at = 'bottom left';
				  target = $('#' + parent);
				}
				
				$('#menu_edit_entry_' + menuTab).qtip({
					 
					     content: {
					     title: { button: 'Close', 
						      text: 'Add Sub Heading For ...' + menuTab + ' In ' + menu_name 
						  },
						  text: 'Loading Editor For Entry ...' + menuTab + ' In ' + menu_name, 
						  ajax: {
							url: "<?php echo $SITE_URL;?>/include/addons/design_suite/MENUS/menu_editor.php?add_sub_heading=true&menu=" + menu_name + '&menu_index=' + menuTab,
				
							  type: 'GET', // POST or GET
							  data: { "menu_index": + menuTab, "menu": menu_name, "table": 'page_areas'}, // Data to pass along with your request
							  success: function(data, status) {
								  // Process the data
				  
								  // Set the content manually (required!)
								  this.set('content.text', data);
								
								  $('#' + parent + ' .pencil_sub').each(function(){
									var sub_link_id = $(this).attr('id');
									
									
									//create_link_editor(menu_name, sub_link_id);
						
								  });
						
						
								  
								  
							  }
						  }
						 
					    },
					    position: {
						  container: $(document.body),
						  viewport: $(window),
						  my: my,
						  at: at,
						  target: target
					    },
					    style: { width:450 },
					    show:{ ready:true, solo:true},
					    hide:false
				});
				<?php
			
			     }else{
			     ?>
			     $('.menu_edit_icon').css('display', 'none');
			     
			     
			 
			     <?php } ?>
			}