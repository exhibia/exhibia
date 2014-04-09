<?php
ini_set('display_errors', 1);
include("../../../../../config/config.inc.php");
$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);


db_select_db($DATABASENAME, $db);






$date = date("Y-m-d");
$hour = date("H");
$full_date = date("Y-m-d-H:i:s");

	      
include($BASE_DIR . "/include/addons/design_suite/DESIGN/editor/css_functions.php");


db_query("CREATE TABLE IF NOT EXISTS `styles_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_entry` text not null,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;");







$css = $_GET['css']; 

    if(empty($_GET['human_name']) | empty($_GET['human_description']) | empty($_REQUEST['selector']) | empty($template)){
    
   ?>
	    You must supply a human name and description
   <?php   
    
    die();
    
    
    }else{
    
    
   if($_REQUEST['template'] == 'default' & $_SERVER['SERVER_NAME'] != 'websitecommercesolutions.net'){
   
   ?>
      You can not change the default template. Please Choose or Create Another One.
   <?php
   
   
   
   }else{

   include('../../../../../config/config.inc.php');

    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
      if (!$db) {
	 // die('Could not connecttest: ' . db_error());
      }

      db_select_db($DATABASENAME, $db);
      shell_exec("mkdir $BASE_DIR/css/backups/");
		shell_exec("mkdir $BASE_DIR/css/backups/$template/");
		shell_exec("mkdir $BASE_DIR/css/backups/$template/" . date("Y-m-d") . "/");
      
 		$page_where = '';

		//if(!empty($_REQUEST['page'])){

		$page_where .= " page = '$template.css' ";
		//}


		$page_where .= " and template = '$template'";


		$sql = db_query("select distinct(selector), page from style_sheets where $page_where order by id asc");

		    while($row = db_fetch_array($sql)){

				      $css_file .= "\t" . $row['selector'] . " {\n";
			$sql2 = db_query("select property, value from style_sheets where  $page_where and selector = '$row[selector]' order by id asc");


				while($row2 = db_fetch_array($sql2)){
				
		//		$row2['value'] = preg_replace("/url\((.*?)\)/", "url('$1')", $row2['value']);
		//$row2['value'] = str_replace("../img/", $SITE_URL . "img/", str_replace( array("'\"", "\"'", "''"), "'", $row2['value']));
		if($row2['value'] != '' & $row2['property'] != '' & $row2['value'] != 'Array'){
		
		
		

				    $css_file .= "\t\t\t\t" . stripslashes($row2['property']) . " : " . stripslashes( $row2['value']) . ";\n";
		}

				}



				      $css_file .= "\t}\n";



		}
 		
		
		$fp = fopen("$BASE_DIR/css/backups/$template/" . date("Y-m-d") . "/" . time() . ".css", "w+");
		fwrite($fp, $css_file);
		fclose($fp);     
   ?>

   <?php
      $css_sql = db_query("select * from style_sheets where (selector = '" .addslashes($_GET['selector']) . "' or selector = '" .addslashes($_GET['selector']) . " ' or selector = ' " .addslashes($_GET['selector']) . "' or selector = ' " .addslashes($_GET['selector']) . " ') and template = '$_REQUEST[template]'");
      
      if(db_num_rows($css_sql) >=1){
      $str = '';
      while($css_row = db_fetch_array($css_sql)){
      
	$str = "<br>insert into style_sheets values(null, '$_REQUEST[template]', '$css_row[page]', '$row[selector]', '$row[property]', '$row[value]', '$row[human_name]', '$row[human_description]', '$row[editable]'";

	db_query("insert into styles_log values(id, log_entry) values(null, '" . addslashes($str) . "');");
	
      
      
      }
    

	  db_query("delete from style_sheets where (selector = '" .addslashes($_GET['selector']) . "' or selector = '" .addslashes($_GET['selector']) . " ' or selector = ' " .addslashes($_GET['selector']) . "' or selector = ' " .addslashes($_GET['selector']) . " ') and template = '$_REQUEST[template]'");

	      echo db_error();
	//      //echo "Deleted Old Records For $_GET[selector]";
      
    
      
      }
      //echo db_error();

        $ignore = array('template', 'template_new_value', 'css_file', 'selector', 'human_name', 'human_description' );
        
        $log = '';
				     $selector = rtrim(ltrim($_REQUEST['selector']));
				     $selector = $selector; 
        //echo 't' .$selector . 't';
        foreach($_GET as $key => $value){
        
        if($pieces == preg_split('/(?=[A-Z])/',$key)){
        $key = '';
	    foreach($peices as $value){
	    $key .= strtolower($value) . "-";
	    
	    }
        $key = rtrim($key);
        }
        if($value != 'undefined' & $value != '' & $value != 'NaN undefined undefined' & $value != 'NaN' & $value != 'none' & $value != 'NaN undefinedundefined undefinedundefined undefinedundefined' & $value != 'undefinedpx'){
        
        
	           if(preg_match('/[A-Z/', $key)){
			$new_key = '';
			    $pieces = preg_split('/(?=[A-Z])/',$key);
			  foreach($peices as $p){
	      
			      $new_key .= "-" . strtolower($p);
	      
			      }
			  $key = ltrim($p, "-"); 
        
		  }
		  
		  
		 
		    if(!in_array($key, $ignore)){
		    
		  
	
			  if(preg_match('/radius/',$key) | preg_match('/shadow/', $key)){
			  
			 
			  $log .= "Adding CSS3 =>  $key as $value to $_REQUEST[selector] for $_REQUEST[template]<br />";
			
			      check_css_3($_GET, $key, $value);
			      
			      
			  }else if($key == 'svg'){
			  $log .= "Adding IE<10 gradient values  $key as $value to $_REQUEST[selector] for $_REQUEST[template]<br />";
				if(db_num_rows(db_query("select * from style_sheets where selector = '$selector' and page = '$template.css' and selector = '$selector' and property = 'background-image' and value like 'url(data:image/svg+xml;base64'")) >= 1){ 
							    if($value != 'undefined' & $value != ''){
								  db_query("update style_sheets set value = '$value' where selector = '$selector' and page = '$template.css' and selector = '$selector' and property = '$key'");
							    }
							  }else{
			
							      $selector_info = db_fetch_array(db_query("select type, human_name, human_description from style_sheets where selector = '$selector' and type != '' limit 1"));
			
			
							    if($value != 'undefined' & $value != ''){
								db_query("insert into style_sheets values(null, '$_REQUEST[template]', '$template.css', '$selector', 'background', '$value', '$type', '" . addslashes($_GET['human_name']) . "', '" . addslashes($_GET['human_description']) . "', '1');");
							      }
			
						      }
			  
			  
	  
			      }
			    else{
	   
				    if(preg_match('/gradient/', $key)){
		$log .= "Adding Propietary CSS3 gradients =>  $key as $value to $_REQUEST[selector] for $_REQUEST[template]<br />";
					 create_linear_gradient_from_real($_REQUEST, $selector, $value, $key);
		  
		
				      }else{
				   
				   
				   
				   
				   
				   
				   
				    
				      if(preg_match('/#/', $selector) ){
		
					    if(!preg_match('/\s+/', $selector)){
						$type = 'id';
					    }else{
						$type = 'psudeo';
					    
					    }
					    
					  }else if(preg_match('/\./', $selector) ){
					  
					  if(!preg_match('/\s+/', $selector)){
						$type = 'class';
					    }else{
						$type = 'psudeo';
					    
					    }
					    
					  }else{
					    
					    
						if(!preg_match('/\s+/', $selector)){
						    $type = 'tag';
						    }else{
						    $type = 'psudeo';
						
						}
					    
					    
					  }
	      if(preg_match('/gradient/', $value) & preg_match('/background/', $key)){
	      
	      
	      
	      }else{
	       
	      $log .= "Adding $key as $value to $_REQUEST[selector] for $_REQUEST[template]<br />";
	     
	      
					       if(db_num_rows(db_query("select * from style_sheets where (selector = '$selector' or  selector = '$selector ') and property = '$key' and template = '" . addslashes($_REQUEST[template]) . "'")) >= 1){ 
					       
					       
							   
							    
							    
							      db_query("\nupdate style_sheets set value = '" . addslashes($value) . "' where (selector = '$selector' or selector = '$selector ') and template = '" .addslashes($_REQUEST[template]) . "' and property = '$key'");
							      
							      echo db_error();
							    
			
							  }else{
			
							      $selector_info = db_fetch_array(db_query("select type, human_name, human_description from style_sheets where selector = '$selector' and type != '' limit 1"));
							      
						
							    
							       
							       if($value == 'px'){
							       $value = '0px';
							       }
							   $log .= "<br>insert into style_sheets values(null, '$_REQUEST[template]', '$template.css', '$selector', '$key', '$value', '$type', '" . addslashes($_GET['human_name']) . "', '" . addslashes($_GET['human_description']) . "', '1');<br />";
							   
							    
							    
							    
								db_query("insert into style_sheets values(null, '$_REQUEST[template]', '$template.css', '$selector', '" . addslashes($key) . "', '" . addslashes($value) . "', '$type', '" . addslashes($_GET['human_name']) . "', '" . addslashes($_GET['human_description']) . "', '1');");
								
								  echo db_error();
							
			
						      }
						 }
		    
				    }
	    
			   }
	    
	    
		      }
		      
		      }
       
       
		}
		if($_COOKIE['new_selector'] != $_REQUEST['selector']){
		?>
		<script type="text/javascript">
		      do_it_now('<?php echo $_COOKIE['new_selector']; ?>', '<?php echo $_COOKIE['new_type'];?>');
		</script>
		<?php
		
		}else{

		?>
		Success!!! Changes were saved for <?php echo $_GET['human_description'];?><br />
		<div id="log_css_inner" style="display:none;font-size:10px;">
		    <?php //echo str_replace("'", "\'", $log);?>
		</div><br />
		      <a href="javascript:;" onclick="$('#log_css_inner').css('display', 'block');">Show log</a>
		     
		
		<?php
		
		
		
		}
        
        }
        
        }




