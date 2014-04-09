<?php

include("$BASE_DIR/config/config.inc.php");
  
		$page_where .= " page = '$template.css' ";
		//}


		$page_where .= " and template = '$template'";


		$sql = db_query("select distinct(selector), page from style_sheets where $page_where order by id asc");
if(db_num_rows($sql) >= 1){
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
 
		shell_exec("rm $BASE_DIR/css/$template.css -f");
		$fp = fopen("$BASE_DIR/css/$template.css", "w+");
		fwrite($fp, $css_file);
		fclose($fp);
		
	}
	//db_query("delete from style_sheets where template = '$template'");
		