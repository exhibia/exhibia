<?php
ini_set('display_errors', 1);
//header("content-type: text/css");
include("../config/connect.php");


if(!function_exists('parseCSS')){
function parseCSS($file){
  echo "Converting $file to use SQL<br/>";
    $css = file_get_contents($file);
    preg_match_all( '/(?ims)([a-z0-9\s\.\:#_\-@,]+)\{([^\}]*)\}/', $css, $arr);
    $result = array();
    foreach ($arr[0] as $i => $x){
        $selector = trim($arr[1][$i]);
        $rules = explode(';', trim($arr[2][$i]));
        $rules_arr = array();
        foreach ($rules as $strRule){
            if (!empty($strRule)){
                $rule = explode(":", $strRule);
                $rules_arr[trim($rule[0])] = trim($rule[1]);
            }
        }

        $selectors = explode(',', trim($selector));
        foreach ($selectors as $strSel){
            $result[$strSel] = $rules_arr;
        }
    }


      foreach($result as $key => $value){

	foreach($result[$key] as $cssKey => $cssValue){
	if(db_num_rows(db_query("select * from style_sheets where page = '$file' and selector = '$key' and property = '" . db_real_escape_string($cssKey) . "'"))
== 0){
	db_query("insert into style_sheets values(null, '$file', '$key', '" . db_real_escape_string($cssKey) . "', '" . db_real_escape_string($cssValue) . "');");

	}else{

if(isset($_REQUEST['reinstall'])){
db_query("update style_sheets set value = '" . db_real_escape_string($cssValue) . "' where page = '$file' and selector = '$key' and property = '" . db_real_escape_string($cssKey) .
"'");
}

	}

	}
echo db_error();
      }


}
}


if(db_num_rows(db_query("select distinct selector from style_sheets where page LIKE '%" . basename($_REQUEST['page']) . "'")) == 0){

parseCSS($_REQUEST['page']);


}
$sql = db_query("select distinct selector from style_sheets where page LIKE '%" . basename($_REQUEST['page']) . "' order by id asc");

    while($row = db_fetch_array($sql)){

		      echo $row['selector'] . " {\n";
	$sql2 = db_query("select distinct property, value from style_sheets where  page LIKE '%" . basename($_REQUEST['page']) . "' and selector = '$row[selector]'");
	

	        while($row2 = db_fetch_array($sql2)){

		    echo "\t\t\t" . $row2['property'] . " : " . $row2['value'] . ";\n";


		}



		      echo $row['selector'] . " }\n";



}


     echo db_error(); 