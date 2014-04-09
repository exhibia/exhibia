<?php
include("../../../../config/config.inc.php");

$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);


db_select_db($DATABASENAME, $db);


if(!empty($_REQUEST['add_first_heading'])){

      db_query("insert into page_areas (id, name, menu, menu_index, invisible) values(null, '" . addslashes(urldecode($_GET['name'])) . "', '$_GET[menu]', '$_GET[menu_index]', '1');");

      echo "Added New Tree to $_GET[menu]";

}else if(!empty($_REQUEST['add_sub_heading'])){
$uniqid = uniqid();

?>
			    <ul style="list-style-type:none;width:410px!important;text-align:left;">
				  
				      <li style="display:inline-block!important;position:relative;top:20px;" >
				      <input type="hidden" value="<?php echo $_GET['menu_index'];?>" name="menu_index_<?php echo $uniqid;?>" id="menu_index_<?php echo $uniqid;?>" />
				      
				      <input type="hidden" value="<?php echo $_GET['menu'];?>" name="menu_<?php echo $uniqid;?>" id="menu_<?php echo $uniqid;?>" />
				     
					    <input type="text" id="name_<?php echo $uniqid;?>" name="name_<?php echo $uniqid;?>" value="Add Your Heading Here" style="position:relative;top:-25px;" />
				      </li>
				      
				       <li style="display:inline!important;" >
					  <input type="submit" value="submit" onclick="javascript: add_sub_heading_now('<?php echo $_REQUEST['menu'];?>', '<?php echo $uniqid;?>', 'page_areas');" />
				    </li>
				    
				
			    </ul>
			    
			   

			    
<?php


}else{

      if(!empty($_REQUEST['update'])){
	  if(db_query("update $_REQUEST[table] set $_REQUEST[row] = '" . addslashes(urldecode($_REQUEST['lvalue'])) . "' where id = $_REQUEST[id]")){
	  
	  if(!empty($_REQUEST['affected_table'])){
		db_query("update $_REQUEST[table] set affected_table='" . $_REQUEST['affected_table'] . "', table_id = $_REQUEST[table_id] where id = $_REQUEST[id]"); 
	  }
	      echo "Updated '" . str_replace("_", " ", $_REQUEST['row']) . "' For '". str_replace("_", " ", $_REQUEST['table']) . "' To '$_REQUEST[lvalue]'";
	  
	  }else{
	      
	  }
	  echo db_error();

      }else {
	  if(!empty($_REQUEST['add_link_now'])){
	  
		if($_REQUEST['table'] == 'nav_conditionals'){
		
		
			  db_query("insert into $_REQUEST[table] (id) values(null);");
		      }else if($_REQUEST['table'] == 'page_areas_components'){
		      
			
			  db_query("insert into $_REQUEST[table] (id) values(null);");
		      
		      
		      }else{
			db_query("insert into $_REQUEST[table] (id) values(null);");
		  
		  
		      }
		      $id = db_insert_id();
		      foreach($_GET as $key => $value){
		      
			  db_query("update $_REQUEST[table] set $key = '" . addslashes($value) . "' where id = $id");
		      
		      }
		      echo db_error();
		      ?>
		      Added New Link to <?php echo $_REQUEST['name']; ?>
	  
      <?php
	  }else if(!empty($_REQUEST['add_header_now'])){
		  db_query("insert into $_REQUEST[table] (id) values(null);");
		
		$id = db_insert_id();
		foreach($_GET as $key => $value){
		
		    db_query("update $_REQUEST[table] set $key = '" . addslashes($value) . "' where id = $id");
		
		}
	  
	 
	  
	  }else if(!empty($_REQUEST['delete_link_now'])){
	  echo "delete from $_REQUEST[table] where id = $_REQUEST[id]";
	      db_query("delete from $_REQUEST[table] where id = $_REQUEST[id]");
	  
	  
	  }else if(!empty($_REQUEST['add_cond_now'])){
	  
	  
	      $cond = array( 'conditional_type', 'conditional_operator', 'conditional_val', 'link_name', 'menu_name' );
	      db_query("insert into $_REQUEST[table] (id) values(null);");
		
		$id = db_insert_id();
		foreach($_GET as $key => $value){
		
		if(in_array($key, $cond)){
			  echo "update $_REQUEST[table] set $key = '" . $value . "' where id = $id";
			  db_query("update $_REQUEST[table] set $key = '" . addslashes($value) . "' where id = $id");
		    
		    }
		
		}
	  echo db_error();
	  
	  }else if(!empty($_REQUEST['update_name'])){
	  
	      db_query("update page_areas_components set name = '" . addslashes(urldecode($_REQUEST['value'])) . "' where id = $_REQUEST[id]");
	  echo "update page_areas_components set name = '" . addslashes(urldecode($_REQUEST['value'])) . "' where id = $_REQUEST[id]";
	  
	  
	  }else if(!empty($_REQUEST['update_row'])){
	      if($_REQUEST['table'] != 'page_areas_components' ){
		      db_query("update $_REQUEST[table] set $_REQUEST[row] = '" . addslashes(urldecode($_REQUEST['value'])) . "' where id = $_REQUEST[id]");
		      echo "update $_REQUEST[table] set $_REQUEST[row] = '" . addslashes(urldecode($_REQUEST['value'])) . "' where id = $_REQUEST[id]";
		    
		}else{
		if(!is_numeric($_REQUEST['id'])){
			db_query("update $_REQUEST[table] set name = '" . addslashes(urldecode($_REQUEST['value'])) . "' where name = '" . addslashes(urldecode($_REQUEST['id'])) . "'");
		      echo "update $_REQUEST[table] set name = '" . addslashes(urldecode($_REQUEST['value'])) . "' where name = '" . addslashes(urldecode($_REQUEST['id'])) . "'";
		    
		}else{
		      db_query("update $_REQUEST[table] set $_REQUEST[row] = '" . addslashes(urldecode($_REQUEST['value'])) . "' where id = $_REQUEST[id]");
			echo "update $_REQUEST[table] set $_REQUEST[row] = '" . addslashes(urldecode($_REQUEST['value'])) . "' where id = $_REQUEST[id]";
		    
		
		
		
		}
		
		}
	  
	  
	  
	  }else if(!empty($_REQUEST['delete'])){
	  
	      if(is_numeric($_REQUEST['id'])){
		  db_query("delete from $_REQUEST[table] where id = $_REQUEST[id]");
	      echo "delete from $_REQUEST[table] where id = $_REQUEST[id]";
	      
	      }else{
		  db_query("delete from $_REQUEST[table] where name = '" . addslashes(urldecode($_REQUEST['id'])) . "'");
	      echo "delete from $_REQUEST[table] where name = '$_REQUEST[id]'";
	      
	      
	      }
	  echo db_error();
	  }else{
      ?>
		    <script>
			function edit_link_head(menu_name, uniqid, row, value, table){
			
			
			}//Used for moving a menu to a new tab
	
			
		    </script>
	  <div id="menu_mes" style="color:green;font-weight:bold;">Menu Will Change as You Edit Them</div>
       <?php 
	  echo get_menu($_REQUEST['menu'], 'edit'); 
	?>
		   
		 <?php
	    
	    }

      }

}
?>

