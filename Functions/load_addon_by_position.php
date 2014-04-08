<?php

function load_addon_by_position($position, $addons, $admin = '', $page = "" , $dont_show = array()){
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");

$addons = loadAddonsAsArray($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);

if(empty($page)){
$page = basename($_SERVER['PHP_SELF']);
}




  


$xtra = "and page = '$page'";
$xtra .= " and s.status >= 1";
   

if($page == 'buybids.php'){
 $xtra .= " and page_areas.name != 'faq_menu' and page_areas.name != 'help_menu'";
			      
}
$xtra .= " and invisible != '1'";

    $qry_addon = db_query("select distinct page_areas.name from page_areas left join sitesetting s on s.value = page_areas.name where menu = '$position' $xtra order by menu_index asc");
      while($row_addon = db_fetch_array($qry_addon)){
    
	
	
		//echo "select value from sitesetting where name = '$row_addon[name]' order by id desc limit 1";
	$these_settings = db_fetch_array(db_query("select value from sitesetting where name = '$row_addon[name]' and value like 'folder:%' $admin_check order by id desc limit 1"));
	    if(!empty($these_settings[0])){
	    
		  $settings = explode(":", $these_settings[0]);
		  $folder = $template . "/";
		//  echo $folder;
	      }else{
		  $folder = '';
	      }

if(db_num_rows(db_query("select * from nav_conditionals where menu_name = '$position' and link_name = '$row_addon[name]'")) ==0){	     
if($row_addon['name'] != 'rightnews' & $page != 'registration.php' & !in_array($row_addon['name'], $dont_show)){
echo "<!-- $row_addon[name] Begin -->";
	   // echo "include/$folder". "$row_addon[name].php";
	//echo $BASE_DIR . "/include/addons/$row_addon[name]/$template/";   
	if(file_exists($BASE_DIR . "/include/$folder/". "$row_addon[name].php")){
	
	    require($BASE_DIR . "/include/$folder/" . "$row_addon[name].php");
	}else{
	
	if(file_exists($BASE_DIR . "/include/addons/$row_addon[name]/$template/" . basename($page))){
	
	    require($BASE_DIR . "/include/addons/$row_addon[name]/$template/" . basename($page));
	
	}else{
	    if(file_exists($BASE_DIR . "/include/addons/$row_addon[name]/$folder/$row_addon[name].php")){
	   
		require($BASE_DIR . "/include/addons/$row_addon[name]/$folder/$row_addon[name].php");
	    
	    }else{
	     
		if(file_exists($BASE_DIR . "/page_areas/" . str_replace(".php", "_php", $row_addon['name']) . "/$folder/" . "$row_addon[name].php")){
		 require($BASE_DIR . "/page_areas/" . str_replace(".php", "_php", $row_addon['name']) . "/$folder/" . "$row_addon[name].php");
		 }else{
		 
		 
		      if(file_exists($BASE_DIR . "/include/addons/$row_addon[name]/$template/$row_addon[name].php")){
		      
			    require($BASE_DIR . "/include/addons/$row_addon[name]/$template/$row_addon[name].php");
		      
		      
		      }else if(file_exists($BASE_DIR . "/include/addons/$row_addon[name]/$template/index.php")){
		      
		      
			    require($BASE_DIR . "/include/addons/$row_addon[name]/$template/index.php");
		      
		      }else if(file_exists($BASE_DIR . "/include/addons/$row_addon[name]/index.php")){
		      
			    require($BASE_DIR . "/include/addons/$row_addon[name]/index.php");
		      
		      }
		 
		 
		 }
	    
	    }
	    }
	}
	
	}
echo "<!-- $row_addon[name] End -->";	
	}else{
	
	$show_me =check_addon_conditionals($row_addon, $row_addon['id'], $position);
	
	      if(empty($show_me)){
	      ?>
	      <div style="display:none;">
	      <?php
	      }
		  
		  
		  if(file_exists($BASE_DIR . "/include/addons/$row_addon[name]/$folder/" . basename($page))){
		  
		      include($BASE_DIR . "/include/addons/$row_addon[name]/$folder/" . basename($page));
		  
		  }else{
		      if(file_exists($BASE_DIR . "/include/addons/$row_addon[name]/$folder/$row_addon[name].php")){
		    
			  include($BASE_DIR . "/include/addons/$row_addon[name]/$folder/$row_addon[name].php");
		      
		      }else{
		    
			  if(file_exists($BASE_DIR . "/page_areas/" . str_replace(".php", "_php", $row_addon['name']) . "/$folder/" . "$row_addon[name].php")){
			  
			      include($BASE_DIR . "/page_areas/" . str_replace(".php", "_php", $row_addon['name']) . "/$folder/" . "$row_addon[name].php");
			  }
		      
		      }
		      
		  }
		if(empty($show_me)){
		  ?>
		    </div>
		  <?php
		  }  
	    }
	     
	  
	  
	
	
	
	  }
     echo db_error();
    }
   
