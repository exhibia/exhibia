			function add_link(menu_name, uniqid, table, parent){
			prompt(uniqid);
			if(table === 'navigation'){
			try{
			  if(document.getElementById('new_menu[' + uniqid + ']')){
			     var  m = document.getElementById('new_menu').value;
			      menu_name = m.replace(" ", "_");
			      menu_name = encodeURIComponent(menu_name.toLowerCase());
			      
			  
			  }
			  }catch(oo){}
			try{
				link = encodeURIComponent(document.getElementById('link[' + uniqid + ']').value);
				link_text = encodeURIComponent(document.getElementById('link_text[' + uniqid + ']').value);
			    }catch(oo){}
			    }
			    
			    
			    if(table === 'navigation'){
			    if(document.getElementById('enabled[' + uniqid + ']').checked == true){
				  enabled = 1;
			      }else{
				  enabled = 0;
			      }
			      if(document.getElementById('enabled[' + uniqid + ']').length == 0){
			      enabled = 1;
			      
			      }
			      }
			      created_by = 'PAS';
			      extra = '';
			  if(table === 'navigation'){
			   if(!is_null(document.getElementById('table_id_' + record))){
				if(table === 'navigation'){
				  extra += '&affected_table=' + document.getElementById('table_id[' + record + ']').value;
				  extra += '&table_id=' + document.getElementById('affected_table[' + record + ']').value;
				  
				  }
			    }
			    }
			    
			    if(table === 'navigation'){
				  url = '<?php echo $SITE_URL;?>/include/addons/design_suite/MENUS/menu_editor.php?table=' + table + '&link=' + link + '&menu_name=' + menu_name + '&link_text=' + link_text + '&add_link_now=true' + '&enabled=' + enabled + '&created_by=PAS' + extra;
			    
			    }else if(table === 'page_areas_components'){
			    
			    link = encodeURIComponent($('.link_url_' + uniqid).val());
			    link_text = encodeURIComponent($('.link_text_url_' + uniqid).val());
			    
				name = encodeURIComponent($('#heading_url_' + uniqid).val());
			    
				url = '<?php echo $SITE_URL;?>/include/addons/design_suite/MENUS/menu_editor.php?name=' + name + '&parent=' + parent + '&table=' + table + '&link=' + link + '&menu_name=' + menu_name + '&link_text=' + link_text + '&add_link_now=true' + '&created_by=PAS' + extra;
			    
			    
			    }else{
			    link = encodeURIComponent($('#link_' + uniqid).val());
			    
				 name = encodeURIComponent($('.name_' + uniqid).val());
				 url = '<?php echo $SITE_URL;?>/include/addons/design_suite/MENUS/menu_editor.php?name=' + name + '&menu_index=' + parent + '&table=' + table + '&link=' + link + '&menu=' + menu_name + '&invisible=1&add_link_now=true' + '&created_by=PAS' + extra;
			    
			    }
			    $.get(url, 
			  function(response){
				$('#edit_log').html(response);
				window.location.href = window.location.href;
			    
			    });
			
			}