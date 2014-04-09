<?php
ini_set('display_errors', 1);

function install_template(){
	
echo "Extracting";	  
include("../../../config/config.inc.php");
 $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);


	  db_select_db($DATABASENAME, $db);

	  shell_exec("cd $BASE_DIR");
	  $fp = fopen( $BASE_DIR . '/progress.txt', 'w+' );
	  
	  fputs( $fp, "Extracting $BASE_DIR/$_COOKIE[new_template].zip\n" );
	  
	  fclose( $fp );
	  shell_exec("chmod 777 $BASE_DIR/$_COOKIE[new_template].zip");
	  shell_exec("chmod 777 $BASE_DIR/css/ -R");
	  shell_exec("chmod 777 $BASE_DIR/include/ -R");
	  $zip = new ZipArchive;
	   if ($zip->open("$BASE_DIR/$_COOKIE[new_template].zip" )  === TRUE) {
	   // $zip->open("$BASE_DIR/$_COOKIE[new_template].zip" );
	    
	    
   
  $fp = fopen( $BASE_DIR . '/progress.txt', 'w+' );
	  
		  fputs( $fp, "Installing $BASE_DIR/$_COOKIE[new_template].zip<br />\n" );
		  
		  fclose( $fp );
		  
		  $fp = fopen( $BASE_DIR . '/progress.txt', 'a' );
		//  echo "Extracting " . $zip->numFiles . " files from $_COOKIE[new_template].zip<br />\n";
		  
		  fputs( $fp, "Extracting " . $zip->numFiles . " files from $_COOKIE[new_template].zip<br />\n" );
				      
		 fclose( $fp );
		  
		    for($i = 0; $i < $zip->numFiles; $i++) {
		    
		    		  $fp = fopen( $BASE_DIR . '/progress.txt', 'a' );
	 // echo "Inflating $BASE_DIR/". $fileinfo['basename'] . "\n";
	  
				      fputs( $fp, "Inflating $BASE_DIR/". $fileinfo['basename'] . "\n" );
				      
				      fclose( $fp );
				      
				      
			  $filename = $zip->getNameIndex($i);
			
			  $fileinfo = pathinfo($filename) . "<br />";
			  
			  if(!preg_match("/(.*)\.(.*)?(gif|jpg|png|css|html|php|inc|sql|txt|bmp|jpeg)$/i", $filename)){
			   
			      mkdir("$BASE_DIR/".$filename);
			   }else{
				
				copy("zip://$BASE_DIR/$_COOKIE[new_template].zip#".$filename, "$BASE_DIR/".$filename);
			   
			   }
		      } 
		   db_query("update sitesetting set value = '$_COOKIE[new_template]' where name = 'template'");
		  
		  
		  
		  $config = file_get_contents($BASE_DIR . '/config/config.inc.php');
		  
		  $config = str_replace($template, $_COOKIE['new_template'], $config);
		  
		  $fp = fopen( $BASE_DIR . '/config/config.inc.php', 'w+' );
	  
			  fputs( $fp, $config);
			  
			  fclose( $fp );
		  
		      if(db_num_rows(db_query("select * from sitesetting where name = 'addons' and value = 'design_suite'")) >= 1){

			  

		      }
		  
	  } else {
  
		  $fp = fopen( $BASE_DIR . '/progress.txt', 'w+' );
		  
		  fputs( $fp, "Extracting $BASE_DIR/$_COOKIE[new_template].zip Failed\n" );
		  
		  fclose( $fp );
	  }


	 shell_exec($BASE_DIR . '/progress.txt');
	 shell_exec("chmod 775 $BASE_DIR/css/ -R");
	 shell_exec("chmod 775 $BASE_DIR/include/ -R");
	 		
 
}

install_template();