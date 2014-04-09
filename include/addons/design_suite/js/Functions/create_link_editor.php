  		function create_link_editor(menu_name, table_id){
			
			  
				table_id_in = table_id;
				table_id = table_id.split('_');
				
				if(!table_id[1]){
				    table_id = table_id[0];
				    table = 'navigation';
				    target = $('#menu_edit_icon_' + table_id_in);
				    at = 'bottom left';
				    my = 'top left';
				}else{
				    table_id = table_id[1];
				    table = 'page_areas_components';
				    target = $('#' + $('#menu_edit_icon_' + table_id_in).parent().parent().attr('id'));
				  //  prompt($('#menu_edit_icon_' + table_id_in).attr('id'));
				    at = 'top left';
				    my = 'bottom left';
				}
				parent = $('#menu_edit_entry_' + table_id_in).closest('li').attr('id');
				
				
				$('#menu_edit_entry_' + table_id_in).qtip({
					 
					     content: {
					     title: { button: 'Close', 
						      text: 'Edit Entry ...' + table_id_in + ' In ' + menu_name 
						  },
						  text: 'Loading Editor For Entry ...' + table_id + ' In ' + menu_name, 
						  ajax: {
							url: "<?php echo $SITE_URL;?>/include/addons/design_suite/MENUS/edit_menu.php?",
				
							  type: 'GET', // POST or GET
							  data: { "id": + table_id, "menu": menu_name, "table": table}, // Data to pass along with your request
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
				
			}