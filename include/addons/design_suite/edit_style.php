<?php

include("../../../../config/config.inc.php");

$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
if (!$db) {
    //die('Could not connect: ' . db_error());
}

db_select_db($DATABASENAME, $db);




if(!function_exists('parseCSS')){
function parseCSS($file){

$page = $_REQUEST['css-element'];

  echo "Converting $file to use SQL<br/>";
    $css = urldecode($file);
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


         $result[$selector] = $rules_arr;
    }

    
         foreach($result as $key => $value){
		     if(db_num_rows(db_query("select * from style_sheets where page = '$_REQUEST[page]' and selector = '$key'")) == 0){
			 
			
			  db_query("delete from style_sheets where page = '$_REQUEST[page]' and selector = '$key' and property = '" . db_real_escape_string($cssKey) . "'");

		      }
	// echo "select * from style_sheets where selector = '$key' and page = '$page'";
	 $new_sql = db_query("select * from style_sheets where selector = '$key' and page = '$page'");
	
		  foreach($result[$key] as $cssKey => $cssValue){
		    echo "insert into style_sheets values(null, '$new_row[file]', '$key', '" . db_real_escape_string($cssKey) . "', '" . db_real_escape_string($cssValue) . "');<br />";

		      db_query("insert into style_sheets values(null, '$new_row[file]', '$key', '" . db_real_escape_string($cssKey) . "', '" . db_real_escape_string($cssValue) . "');");

		  }

	    
	 
      }

}
}

if(isset($_REQUEST['css-type'])){


$_REQUEST['page'] = $_REQUEST['css-element'];

parseCSS($_REQUEST['css']);




 $_REQUEST[$_REQUEST['css-type']] =$_REQUEST['css-element'];

}



if(!empty($_REQUEST['element']) & ! isset($_REQUEST['css-type'])){

$sql2 = db_query("select distinct(selector) from style_sheets where page != '' and page != 'css' and selector = '$_REQUEST[element]' and page = '$_REQUEST[getSelectors]' order by id, selector asc");



	        while($row2 = db_fetch_array($sql2)){

		  echo "" . $row2['selector'] . " {\n";
		      $sql3 = db_query("select property, value from style_sheets where selector = '$row2[selector]' and page = '$_REQUEST[getSelectors]'");



		      while($row3 = db_fetch_array($sql3)){

		      if(!empty($row3['property']) & !empty($row3['value'])){
			echo "\t". $row3['property'] . " : " . $row3['value'] . ";\n";
			}

		      }

		   echo " }\n";





}











}else{





if(!empty($_REQUEST['getSelectors'])){

 ?>
 
 <?php

		$queryP = db_query("select distinct(selector) from style_sheets where page not like '%theme%' and page = '$_REQUEST[getSelectors]'");

		  while($rowP = db_fetch_array($queryP)){

 ?>
		      <option value="<?php echo $rowP['selector']; ?>"><?php echo $rowP['selector']; ?></option>

 <?php
 }
}else{









$sql = "select distinct(selector), page from style_sheets where page != ''";







if(empty($_REQUEST['elements'])){
  if(!empty($_REQUEST['id'])){

   $sql .= " and selector LIKE '#$_REQUEST[id]%'";

}
  if(!empty($_REQUEST['class'])){

   $sql .= " and selector LIKE '.$_REQUEST[class]%'";

}
}else{

$sql = " and selector = '$_REQUEST[elements]'";


}
if(!empty($_REQUEST['page'])){

 $sql .= " and page LIKE '%" . basename($_REQUEST['page']) . "%'";

}






	$sql2 = db_query("$sql  and page != 'css' order by id asc");
?>
  <form action="javascript: update_elements();">

 <table style="padding-top:10px;padding-bottom:10px;margin: 0 auto;min-width:800px;" align="center">
   <tr>
     <td valign="top" height="100%">
	  <textarea id="css-id-editor" style="height:200px;overflow-y:auto;overflow-x:hidden;word-wrap:break-word;font-size:9px;width:400px;
margin-right:20px;margin-left:50px;border: 1px solid black;"  onclick="new_editor('css-id-editor');"><?php


	        while($row2 = db_fetch_array($sql2)){
echo "/*" . $row2['page'] . "*/\n\n";
		  echo "" . $row2['selector'] . " {\n";
		      $sql3 = db_query("select property, value from style_sheets where selector = '$row2[selector]' order by id asc");



		      while($row3 = db_fetch_array($sql3)){

			  if(!empty($row3['property']) & !empty($row3['value'])){
			      echo "\t". $row3['property'] . " : " . $row3['value'] . ";\n";

			    }
		      }

		   echo " }\n";





}
echo db_error();
?></textarea>
      </td><td valign="top" height="100%">
	<table width="400px" valign="top" height="100%">
	  <tr>
	    <td valign="top" height="100%">
	      <select name="page" id="page" onchange="javascript: ajax_PAS('<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/edit_style.php?', 'get=sliderform&getSelectors=' +
document.getElementById('page').options[document.getElementById('page').selectedIndex].value,'get','elements');
">
		<?php
		$queryP = db_query("select distinct(page) from style_sheets where page not like '%theme%'");

		  while($rowP = db_fetch_array($queryP)){

 ?>
		      <option value="<?php echo $rowP['page']; ?>"><?php echo $rowP['page']; ?></option>

 <?php
		    }
   ?>
	      </select>

	    </td>
	  </tr>
	  <tr>
	    <td valign="top" height="100%">

	      <select name="elements" id="elements" onchange="javascript: ajax_PAS('<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/edit_style.php?', 'get=sliderform&getSelectors=' +
document.getElementById('page').options[document.getElementById('page').selectedIndex].value + '&element=' + encodeURIComponent(document.getElementById('elements').options[document.getElementById('elements').selectedIndex].value), 'get', 'css-id-editor');">

	      </select>
	    </td>
	  </tr>
	</table>
	</td>
      </tr>
    </table>
<input type="hidden" id="css-element" name="css-type" value="<?php if (isset($_REQUEST['id'])){ echo $_REQUEST['id']; }else{ echo $_REQUEST['class'];} ?>" />
<input type="hidden" id="css-element" name="css-element" value="<?php if (isset($_REQUEST['id'])){ echo "id"; }else{ echo "class";} ?>" />
<input type="submit" class="button" name="submit" id="submit" />

</form>

<?php
}
}
  ?>