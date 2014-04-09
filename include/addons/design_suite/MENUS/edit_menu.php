<?php 

include("../../../../config/config.inc.php");

$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);

$menu_editor = 'true';
db_select_db($DATABASENAME, $db);

include("../../../../functions.php");
include("../../../../Menu_Functions/get_menu_settings.php");
include("../../../../Menu_Functions/list_conditionals.php");
include("../../../../Menu_Functions/admin_menu_form.php");

include("../../../../Menu_Functions/get_edit_boxes.php");
function link_form($row_sub, $row_links2, $edit, $menu_id, $design_m_r){

?>

	 
	      
	     <?php
			  
		//foreach($row_links2 as $row_links3){
	    ?>
			  
					
			
				<ol style="float:right;background-color:#fff;border:2px dotted green;border-radius:6px;max-width:200px!important;margin:2px 2px 2px 2px;">
				    <li style="height:20px;font-size:10px;">
					<label>Heading</label>
					
					<input type="text" id="sub_sub_menu_heading[<?php echo $row_links2['id'];?>]" ochange="edit_link('<?php echo $menu_id;?>', '<?php echo $row_links2['id']; ?>', 'name', $(this).attr('id'), 'page_areas_components', 'sub_links_for_<?php echo $design_m_r['id'];?>');" style="max-width:75px;float:right;" value="<?php echo $row_links2['name'];?>">
					
				
					<br />
					
					
				    </li>
				    <li style="height:20px;font-size:10px;">
					<label>Parent</label>
					<select id="sub_sub_menu_parent[<?php echo $row_links2['id'];?>]" onchange="edit_link('<?php echo $menu_id;?>', '<?php echo $row_links2['id']; ?>', 'parent', $(this).attr('id'), 'page_areas_components', 'sub_links_for_<?php echo $design_m_r['id'];?>');" style="max-width:75px;float:right;">
					<br />
																						  <?php
					      $sub_sub_sql = db_query("Select id, name from page_areas where menu = '$menu_id'");
																
						while($sub_sub_row = db_fetch_array($sub_sub_sql)){
					  ?>
					      <option value="<?php echo $sub_sub_row['id'];?>" <?php if($sub_sub_row['id'] == $row_links2['parent']){?> selected<?php } ?>><?php echo $sub_sub_row['name'];?></option>
					      
					  <?php } ?>
					</select>
						<br />				
				    </li>
				    <li style="height:20px;font-size:10px;">
					<label>Text</label>
					   <input id="sub_sub_menu_name[<?php echo $row_links2['id'];?>]" value="<?php echo	$row_links2['link_text'];?>" onkeyup="edit_link('<?php echo $menu_id;?>', '<?php echo $row_links2['id']; ?>', 'link_text', $(this).attr('id'), 'page_areas_components', '.sub_links_for_<?php echo $design_m_r['id'];?>');" style="max-width:75px;float:right;" />
					   <br />
				    </li>
				    <li style="height:35px;font-size:10px;">
					<label>Link</label>
				
					    <textarea id="sub_sub_menu_link[<?php echo $row_links2['id'];?>]" onkeyup="edit_link('<?php echo $menu_id;?>', '<?php echo $row_links2['id']; ?>', 'link', $(this).attr('id'), 'page_areas_components', 'sub_links_for_<?php echo $design_m_r['id'];?>');" style="max-width:75px;height:35px;float:right;"><?php echo $row_links2['link']; ?></textarea>
					    <br />
				    </li>
				    <li style="height:20px;font-size:10px;">
					<label>Ajax Container</label>
					  <input id="sub_sub_menu_container[<?php echo $row_links2['id'];?>]" value="<?php echo $row_links2['ajax_container'];?>" onkeyup="edit_link('<?php echo $menu_id;?>', '<?php echo $row_links2['id']; ?>', 'ajax_container', $(this).attr('id'), 'page_areas_components', 'sub_links_for_<?php echo $design_m_r['id'];?>');" style="max-width:75px;float:right;" />
				    </li>
				</ol>
		<?php //} ?>
			
		  
			<?php
	  }




	  
	  
	  
function sub_edit_form_one($menu_id, $design_m_r, $m_settings, $admin_not, $l, $c, $m, $edit, $show_me, $edit_row){

if(empty($edit_row['id'])){
$edit_row['id'] = uniqid();
}


#############################################################################
### DISPLAYS QTIP DIALOG TO CONTROL SUB MENUS IF THEY EXIST              ####
#############################################################################
   ?>
								        <ul style="float:left;border:2px dotted green;border-radius:6px;margin:2px;width:100%;">
								     
									  <li style="display:inline;">
									  <?php if(!empty($edit_row['id'])){ ?>
								      <label>Sub Menu Heading</label>
									  <?php } ?>
									
									
										<input id="sub_menu[<?php echo $edit_row['id'];?>]" value="<?php echo $edit_row['name'];?>" onkeyup="edit_link('<?php echo $menu_id;?>', '<?php echo $edit_row['id']; ?>', 'name', $(this).attr('id'), 'page_areas', '.sub_links_for_<?php echo $design_m_r['id'];?>');" />
										
										
									  </li>
								
									  <li style="display:inline;">
									   <label>Menu Tab</label>
										<select id="sub_menu_tab[<?php echo $edit_row['id'];?>]"<?php if(!empty($edit_row['menu_index'])){?> onchange="edit_link('<?php echo $menu_id;?>', '<?php echo $edit_row['id']; ?>', 'menu_index', $(this).attr('id'), 'page_areas', '.sub_links_for_<?php echo $design_m_r['id'];?>' );"<?php } ?>>
										<?php
										unset($m_shown);
										$m_shown = array();
										
										    $men_sel = db_query("select id, menu_name, link_text from navigation where menu_name = '$menu_id'");
										    while($men_row = db_fetch_array($men_sel)){
										    if(!in_array($men_row['link_text'], $m_shown)){
										    $m_shown[] = $men_row['link_text'];
										    ?>
										      <option value="<?php echo $men_row['id'];?>" <?php if($edit_row['menu_index'] == $men_row['id']){ echo 'selected'; } ?>><?php echo str_replace("_", " ", $men_row['link_text']);?></option>
										    <?php } 
										    }
										    
										    ?>
										</select>
									  </li>
									  <li><label>Show?</label>
									      <input type="checkbox" id="invisible[<?php echo $edit_row['id'];?>]" name="" <?php if ($edit_row['invisible'] == 1){ echo 'checked'; } ?> style="float:center;" onchange="edit_link('<?php echo $menu_id;?>', '<?php echo $edit_row['id']; ?>', 'invisible', $(this).attr('id'), 'page_areas', '.sub_links_for_<?php echo $design_m_r['id'];?>' );" style="float:left;"/>
									  </li>
									  <?php
									  if(empty($edit_row['menu_index'])){
									  ?>
									  <li>
									      <input type="submit" onclick="javascript: add_sub_heading('<?php echo $menu_id;?>', '<?php echo $edit_row['id']; ?>', 'page_areas', '.sub_links_for_<?php echo $design_m_r['id'];?>');" value="Add Heading" />
									   </li>
									  
									  <?php } ?>
									  
									</ul>
										
								        <?php
					
							        
							}
							
							
function menu_input_globals($menu, $link, $value = null, $key, $id, $table, $js_action = null, $container){

    ?>
	<select id="<?php echo $key;?>[<?php echo $id; ?>]" name=""  <?php if($js_action != 'add'){ ?> onchange="<?php echo $js_action;?>_link('<?php echo $menu;?>', '<?php echo $id; ?>', '<?php echo $key;?>', $(this).attr('id'), '<?php echo $table;?>', '<?php echo $container;?>');" <?php } ?> style="max-width:100px;word-wrap:break-word;">
	      <option value=""></option>
	      <?php
	     $these_globals = array("_POST", "_GET", "_SESSION", "_COOKIE", "_SERVER");
	      
	      foreach($these_globals as $t => $m){
		  foreach($GLOBALS[$m] as $k => $v){
		  if(!is_array($GLOBALS[$m][$k])){
		?>
		      <option value="<?php echo $v;?>" <?php if($value == $v){ echo 'selected'; } ?>><?php echo $v; ?></option>
		<?php  
		
		  }else{
			foreach($GLOBALS[$m][$k] as $k2 => $v2){
			    if(!is_array($GLOBALS[$m][$k][$k2])){
		  ?>
			<option value="<?php echo $v2;?>" <?php if($value == $v2){ echo 'selected'; } ?>><?php echo $v2; ?></option>
		  
		  <?php
		  
			    }else{
				foreach($GLOBALS[$m][$k][$k2] as $k3 => $v3){
				  if(!is_array($GLOBALS[$m][$k][$k2][$k3])){
				    ?>
				    <option value="<?php echo $v3;?>" <?php if($value == $v3){ echo 'selected'; } ?>><?php echo $v3; ?></option>
			      
			      <?php
			    
				  }
				  
				}
			    }
			}
		  }
		  
		  }
		  }
		?>
	</select>
    <?php

}
function menu_input($menu, $link, $value = null, $key, $id, $table, $js_action = null, $container){
    ?>
	<select id="<?php echo $key;?>[<?php echo $id; ?>]" name=""  <?php if($js_action != 'add'){ ?> onchange="<?php echo $js_action;?>_link('<?php echo $menu;?>', '<?php echo $id; ?>', '<?php echo $key;?>', $(this).attr('id'), '<?php echo $table;?>', '<?php echo $container;?>'); " <?php } ?> style="max-width:100px;word-wrap:break-word;">
	      <option value=""></option>
	      <?php 
	      $these_globals = array("_POST", "_GET", "_SESSION", "_COOKIE", "_SERVER", "GLOBALS");
	      
	      foreach($these_globals as $t => $m){
		 foreach($GLOBALS[$m] as $k => $v){
		  if(!is_array($GLOBALS[$m][$k])){
		?>
		      <option value="<?php echo $m;?>['<?php echo $k;?>']" <?php if($value == $m . "['" . $k . "']"){ echo 'selected'; } ?>>$<?php echo $m;?>['<?php echo $k;?>']</option>
		<?php  
		
		  }else{
			foreach($GLOBALS[$m][$k] as $k2 => $v2){
			    if(!is_array($GLOBALS[$m][$k][$k2])){
		  ?>
			<option value="<?php echo $m;?>['<?php echo $k2;?>']" <?php if($value == $m . "['" . $k2 . "']"){ echo 'selected'; } ?>>$<?php echo $m;?>[<?php echo $k2;?>]</option>
		  
		  <?php
		  
			    }else{
				foreach($GLOBALS[$m][$k][$k2] as $k3 => $v3){
				  if(!is_array($GLOBALS[$m][$k][$k2][$k3])){
				    ?>
				    <option value="<?php echo $m;?>['<?php echo $k3;?>']" <?php if($value == $m . "['" . $k3 . "']"){ echo 'selected'; } ?>><?php echo $k3;?></option>
			      
			      <?php
			    
				  }
				  
				}
			    }
			}
		  }
		  
		  } 
		    }
	      ?>
	</select>
    <?php
}




function menu_select($menu, $link, $value, $key, $id, $table, $js_action, $container){
$conds = array(
      '' => ''
      , '!=' => '!='
      , '>' => '&gt;'
      , '<' => '&lt;'
      , '>=' => '&gt;&#061;' 
      , '<=' => '&lt;&#061;'
      , '<>' => '&lt;&gt;'
      , '==' => '&#061;&#061;'
      , 'in_array' => 'in_array'
      , '!in_array' => '!in_array'
      , 'empty' => 'empty'
      , '!empty' => '!empty'
      , 'isset' => 'isset'
      , '!isset' => '!isset'
);
    ?>
	<select id="<?php echo $key;?>[<?php echo $id; ?>]" name=""  <?php if($js_action != 'add'){ ?> onchange="<?php echo $js_action;?>_link('<?php echo $menu;?>', '<?php echo $id; ?>', '<?php echo $key;?>', $(this).attr('id'), '<?php echo $table;?>'); show_hide_input('<?php echo $key;?>[<?php echo $id; ?>]', 'conditional_val[<?php echo $id; ?>]', '<?php echo $container;?>');" <?php } ?> style="max-width:100px;word-wrap:break-word;">
	    
	      <?php
		  foreach($conds as $k => $v){
		?>
		<option value="<?php echo $k;?>" <?php if($value == $k){ echo 'selected'; } ?>><?php echo $v; ?></option>
		<?php } ?>
	</select>
    <?php

}






?>
 
  		  <script>
			function show_hide(divId){
			
			
			    if(document.getElementById(divId).style.display == 'block'){
				document.getElementById(divId).style.display = 'none';
			    }else{
				document.getElementById(divId).style.display = 'block';
			    }
		      }
		      function edit_link(menu_name, record, row, value, table, container){
			
			extra = '';
			if(!isNaN(record)){
			extra = '&update=true';
			}else{
			extra = '&add_link=true';
			}
			
			if(!container){
			container = '#menu_mes';
			}
			
		if(!is_null(document.getElementById('table_id_' + record))){
		
		extra += '&affected_table=' + document.getElementById('table_id[' + record + ']').value;
		extra += '&table_id=' + document.getElementById('affected_table[' + record + ']').value;
		}
			
			value = document.getElementById(value).value;
			
			
			      $.get('<?php echo $SITE_URL;?>/include/addons/design_suite/MENUS/menu_editor.php?id=' + record + '&table=' + table + '&lvalue=' + encodeURIComponent(value) + '&menu_name=' + menu_name +'&row=' + row + extra, 
			      
			      function(response){
				$('#' + container).html(response);
			   
				});
			
			
			}
			
			
			  function add_sub_heading(menu_name, uniqid,  table, container){
			
			      name = encodeURIComponent(document.getElementById('sub_menu[' + uniqid + ']').value);
			      menu_index = encodeURIComponent(document.getElementById('sub_menu_tab[' + uniqid + ']').value);
			     if(document.getElementById('invisible[' + uniqid + ']').checked == true){
				  invisible = 1;
			      }else{
				  invisible = 0;
			      }
			      if(document.getElementById('invisible[' + uniqid + ']').length == 0){
			      invisible = 1;
			      
			      }
			    
			      if(!name | name == ''){
			      
			      alert('Headings can not be empty! They can however be set to invisible');
			      }else{
			          $.get('<?php echo $SITE_URL;?>/include/addons/design_suite/MENUS/menu_editor.php?table=' + table  + '&name=' + name + '&menu=' + menu_name + '&menu_index=' + menu_index + '&invisible=' + invisible + '&add_header_now=true' + '&created_by=PAS', 
			  function(response){
				$('#menu_mes').html(response);
				window.location.href = window.location.href;
			    
			    });
			  }
			}//Used for moving a menu to a new tab
			
			

		function add_sub_link(menu_name, uniqid, table){
			
			
			  link = encodeURIComponent(document.getElementById('sub_sub_menu_link[' + uniqid + ']').value);
			  link_text = encodeURIComponent(document.getElementById('sub_sub_menu_name[' + uniqid + ']').value);
			  heading = encodeURIComponent(document.getElementById('sub_sub_menu_heading[' + uniqid + ']').value);
			  parent = encodeURIComponent(document.getElementById('sub_sub_menu_parent[' + uniqid + ']').options[document.getElementById('sub_sub_menu_parent[' + uniqid + ']').selectedIndex].value);
			  container = encodeURIComponent(document.getElementById('sub_sub_menu_container[' + uniqid + ']').value);
			  
			  
			   
			  $.get('<?php echo $SITE_URL;?>/include/addons/design_suite/MENUS/menu_editor.php?table=' + table + '&link=' + link + '&name=' + heading + '&link_text=' + link_text + '&ajax_container=' + container + '&parent=' + parent +'&add_link_now=true' + '&enabled=yes' , 
			    
			    function(response){
				$('#menu_mes').html(response);
				window.location.href = window.location.href;
			    
			   });
			
			}	
			function delete_link(menu_name, uniqid, table){
			
			 $.get('<?php echo $SITE_URL;?>/include/addons/design_suite/MENUS/menu_editor.php?table=' + table + '&menu_name=' + menu_name + '&id=' + uniqid + '&delete_link_now=true', 
			    
			    function(response){
				$('#menu_mes').html(response);
				window.location.href = window.location.href;
			    
			    });
			
			
			}
			function edit_link_click(menu_name, record, row, value, table){
			extra = '';
			if(!isNaN(record)){
			extra = '&update=true';
			}else{
			extra = '&add_link=true';
			}
			if(document.getElementById(value).checked == true){
			value = 1;
			}else{
			value = 0;
			}
			//'<?php echo $menu_id;?>', '<?php echo $design_m_r['id']; ?>', 'link_text', $(this).val())
			    $.get('<?php echo $SITE_URL;?>/include/addons/design_suite/MENUS/menu_editor.php?id=' + record + '&table=' + table + '&lvalue=' + encodeURIComponent(value) + '&menu_name=' + menu_name + '&row=' + row + extra, 
			    
			    function(response){
				$('#menu_mes').html(response);
				
			    
			    });
			
			}
	function edit_link(menu_name, record, row, value, table, container){
			
			extra = '';
			if(!isNaN(record)){
			extra = '&update=true';
			}else{
			extra = '&add_link=true';
			}
			
			if(!container){
			container = '#css-editor';
			}
			
		if(!is_null(document.getElementById('table_id_' + record))){
		
		extra += '&affected_table=' + document.getElementById('table_id[' + record + ']').value;
		extra += '&table_id=' + document.getElementById('affected_table[' + record + ']').value;
		}
			
			value = document.getElementById(value).value;
			
			
			      $.get('<?php echo $SITE_URL;?>/include/addons/design_suite/MENUS/menu_editor.php?id=' + record + '&table=' + table + '&lvalue=' + encodeURIComponent(value) + '&menu_name=' + menu_name +'&row=' + row + extra, 
			      
			      function(response){
				$(container).html(response);
			    
				});
			
			
			}
			function show_hide(divId){
			
			
			    if(document.getElementById(divId).style.display == 'block'){
				document.getElementById(divId).style.display = 'none';
			    }else{
				document.getElementById(divId).style.display = 'block';
			    }
		      }
		function add_conditional(menu_name, uniqid, table, menu_link){
			
			
			      data  = '';
			      if(table == 'addons'){
			      pre = 'addon_';
			      }else{
			      pre = '';
			      }
			      
			      
			   <?php
			    $row = array( 'conditional_type', 'conditional_operator', 'conditional_val' );
			    foreach($row as $k){
			    ?>
			    selectId = pre + '<?php echo $k; ?>[' + uniqid + ']';
				data += '&table=nav_conditionals&<?php echo $k; ?>=' + encodeURIComponent(document.getElementById(selectId).options[document.getElementById(selectId).selectedIndex].value) + '&';
			    <?php
			    }
			    ?>
			    data += '&menu_name=' + menu_name + '&';
			    data += '&link_name=' + menu_link + '&';
			    
			
			     
			    $.get('<?php echo $SITE_URL;?>/include/addons/design_suite/MENUS/menu_editor.php?&add_cond_now=true' + data , 
			    
			   function(response){
				$('#menu_mes').html(response);
				
				//window.location.href = window.location.href;
			    
			    });
			
			}
	      </script>
<?php
if($_REQUEST['table'] != 'page_areas_components'){
$table = 'navigation';
$sql = db_query("select * from $table where menu_name = '$_REQUEST[menu]' and id='$_REQUEST[id]'");
}else{

$sql = db_query("select * from page_areas_components where id='$_REQUEST[id]'");

}



    $row = db_fetch_array($sql);
    
    admin_menu_form($_REQUEST['menu'], $row);
   