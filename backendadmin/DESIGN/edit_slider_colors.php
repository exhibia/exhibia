<?php
require_once("../../../../config/config.inc.php");
db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);


db_select_db($DATABASENAME, $db);
$slider_settings = array();
$sql = db_query("select * from sitesetting where name = 'slider_settings'");
  while($row = db_fetch_array($sql)){
     $setting = explode(":", $row['value']);
      $slider_settings[$setting[0]] = $setting[1];
  
  
  }

if(!function_exists('directoryToArray')){


function include_sub_dirs($base) {

	$dir_array = array();
	if (!is_dir($base)) {
		return $dir_array;
	}
		
	if ($dh = opendir($base)) {
		while (($file=readdir($dh)) !== false) {
			if ($file == '.' || $file == '..') continue;
			
			if (is_dir($base.'/'.$file)) {
				$dir_array[] = $file;
			} else {
				//array_merge($dir_array, rendertask::getAllSubdirectories($base.'/'.$file));
			}
		}
		closedir($dh);
		return $dir_array;
	}
}


function directoryToArray($directory, $extension, $full_path = false) {

if(isset($directory) & @ $directory != ""){
	$array_items = array();
	$handle = @ opendir($directory);
		while (false !== ($file = @ readdir($handle))) {
			if ($file != "." && $file != "..") {
				if (is_dir($directory. "/" . $file)) {
					$array_items = array_merge($array_items, directoryToArray($directory. "/" . $file, $extension, $full_path));
				}
				else {
					if(!$extension || (preg_match("/.$extension/", $file)))
					{

                              {


						if($full_path) {
							$array_items[] = $directory . "/" . $file;

						}
						else {

							$array_items[] = $file;
						}
					}
}
				}
			}
		}
		@ closedir($handle);

	return $array_items;
}
}
}
  ?>
 
    
<?php
if(!empty($_REQUEST['newset'])){
shell_exec("mkdir ../include/slider_images/$_REQUEST[newset]");

shell_exec("chmod 777 ../include/slider_images/$_REQUEST[newset] -R");



shell_exec("cp ../include/slider_images/$_REQUEST[buttonset]/* ../include/slider_images/$_REQUEST[newset]/ -R -f");




$_REQUEST['buttonset'] = $_REQUEST['newset'];
}
if(empty($_REQUEST['buttonset'])){

?>

<script>
function update_slider_settings(slider_id){
ajax_PAS('include/addons/design_suite/DESIGN/edit_slider_colors.php?slider_id=<?php echo $_REQUEST['slider'];?>', 'buttonset=' + $('#buttons').val()
+ '&changeSpeed=' + $('#changeSpeed').val()
+ '&effect=' + $('#effect').val()
+ '&links=' + $('#button_type').val(), 'get','button-preview');
}
</script>
<form id="custom_form" action="javascript:update_slider_settings('<?php echo $_REQUEST['slider'];?>');">
    <table align="center" style="padding-top:10px;padding-bottom:10px;margin:0 auto;" width="1200px;">
      <tr>
	<td colspan="2"><?php echo $msg; ?>
	  		
	  
	  </td>


      </tr>
      <tr>
	  <td colspan="1" align="left">


<?php $buttons = include_sub_dirs("../../../slider_images/"); ?>
<?php

 if(db_num_rows(db_query("select * from sitesetting where name = 'slider_buttons'")) >= 1){
 
 
    $old_button = db_fetch_array(db_query("select value from sitesetting where name = 'slider_buttons'"));
    
    
    }
     $file_array = directoryToArray("../../../slider_images/$buttonset", "*", true);
    
			
			    ?>
			    <h2>choose a Color</h2>
		<select id="buttons" name="buttons">
		      
			  <option value="<?php echo $old_button[0];?>"><?php echo $old_button[0];?></option>
		      
		      <?php
		      		      foreach($buttons as $key => $buttonset){
				      
				     
					if(count($file_array) >=1 & !empty($buttonset)){
			?><option value="<?php echo $buttonset;?>" <?php if($slider_settings['color'] == $buttonset){ echo "selected"; } ?>><?php echo $buttonset;?></option><?php
			
					  }

				  }

?>
		</select>
		
	    </td>
	    <td id="button-preview">
	      <div id="background-uploader"></div> 
	      <?php
	      if(!empty($old_button[0])){
	      
	      
	      $buttons = directoryToArray("../../../slider_images/$old_button[0]", "*", true);
	      	
		  foreach($buttons as $key => $value){
		  
		  
		  if($i % 8 == 0){
		  
		    echo "<br />";
		    }
		      ?>
		  <a href="javascript:;" onclick="ajax_PAS('include/addons/design_suite/uploader.php?', 'type=button&path=../../../slider_images/<?php echo $old_button[0];?>&file=<?php echo $value;?>&buttonset=<?php echo $old_button[0];?>&image=image[<?php echo $key;?>]' , 'get', 'background-uploader');">
		      <img id="image[<?php echo $key;?>]" src="<?php echo $SITE_URL;?>/include/slider_images/<?php echo $old_button[0];?>/<?php echo basename($value);?>" style="margin-bottom:5px;margin-left:5px;width:auto;height:30px;" />
		    </a>
		    
		  <?php
		  $i++;
		  }


 
	      
	      }
	      
		?>
	      </td>
	    <td align="left">
	    <h2>Button Type</h2>
		<select name="button_type" id="button_type" onchange="">
		
		   
		     <option value="false" <?php if($slider_settings['links'] == 'false'){ echo "selected"; } ?>>none</option>
		    <option value="bullets"  <?php if($slider_settings['links'] == 'bullets'){ echo "selected"; } ?>>bullets</option>
		    <option value="boxes" <?php if($slider_settings['links'] == 'boxes'){ echo "selected"; } ?>>boxes</option>
		    <option value="buttons" <?php if($slider_settings['links'] == 'buttons'){ echo "selected"; } ?>>buttons</option>
		</select>

	    </td>
	    <td align="left">
	    <h2>Transition</h2>
		<select name="effect" id="effect" onchange="">
		
		    <option value="'none'" <?php if($slider_settings['effect'] == "'none'"){ echo "selected"; } ?>>none</option>
		    <option value="'fade'" <?php if($slider_settings['effect'] == "'fade'"){ echo "selected"; } ?>>fade</option>
		    <option value="'slideLeft'" <?php if($slider_settings['effect'] == "'slideLeft'"){ echo "selected"; } ?>>slide left</option>
		    
		</select>

	    </td>
	    <td align="left">
	    <h2>Speed(milli-seconds)</h2>
		<select name="changeSpeed" id="changeSpeed" onchange="">
		<?php
		$i = 100;
		while($i <= 24000){
		?>
		    <option value="<?php echo $i;?>" <?php if($slider_settings['changeSpeed'] == $i){ echo "selected"; } ?>><?php echo $i;?></option>
		    
		<?php $i++; } ?>
		    
		</select>

	    </td>
	    
	      <td align="left">
	      <input type="submit" value="Update Slider" />
	      </td>
	    </tr>

	</table>
	

<?php
}else{

 ?>
<div id="background-uploader"></div> 
<?php

 if(db_num_rows(db_query("select * from sitesetting where name = 'slider_buttons'")) >= 1){
 
 
    $old_button = db_fetch_array(db_query("select value from sitesetting where name = 'slider_buttons'"));
    db_query("delete from sitesetting where name = 'slider_buttons'");
 
}
    db_query("insert into sitesetting(id, name, value) values(null, 'slider_buttons', '$_REQUEST[buttonset]');");

    //db_query("delete from sitesetting where name = 'slider_settings'");
if($_GET['color'] == 'transparent'){
  $_GET['controls'] = 'false';
}
switch($_GET['links']){

  case('boxes'):
    include("ADDONS/slider/boxes.sql.php");
  break;
  case('buttons'):
    include("ADDONS/slider/buttons.sql.php");
  break;
  case('bullets'):
    include("ADDONS/slider/bullets.sql.php");
  break;
  case('none'):
    include("ADDONS/slider/none.sql.php");
  break;
}
    foreach($_GET as $key => $value){
      if($key != 'slider_id' & $key != 'slider'){
	$setting = "$key:$value";
	
	
	db_query("insert into sitesetting(id, name, value) values(null, 'slider_settings', '$setting');");
      }
    
    
    }

 echo db_error();
$buttons = directoryToArray("../../../slider_images/$_REQUEST[buttonset]/", "*", true);
$i = 0;
//shell_exec("rm ../include/slider_images/$_REQUEST[buttonset] -R -f");
shell_exec("rm ../../../slider_images/.htaccess -f");
$handle = fopen("../../../slider_images/.htaccess", "w+");

    $text = file_get_contents("../new-htaccess-slider");

	$text = str_replace("SITE_URL", $SITE_URL, $text);
	$text = str_replace("BUTTONSET", $_REQUEST['buttonset'], $text);
	$text = str_replace("include/addons/design_suite/img/buttons/", 'include/slider_images/', $text);
	
	
	
	$slider_css = db_query("select * from style_sheets where property like 'background-image%' and selector like 'a.jshowoff-next' and template = '$template'");
	
	while($row_css = db_fetch_array($slider_css)){
	
	    
	db_query("update style_sheets set value = 'url($SITE_URL/include/slider_images/$_REQUEST[buttonset]/next.png)' where id = '$row_css[id]'");
	
	}
	
	$slider_css = db_query("select * from style_sheets where property like 'background-image%' and selector like 'a.jshowoff-prev' and template = '$template'");
	
	while($row_css = db_fetch_array($slider_css)){
	
	    
	db_query("update style_sheets set value = 'url($SITE_URL/include/slider_images/$_REQUEST[buttonset]/previous.png)' where id = '$row_css[id]'");
	
	}
	
	
	
	fwrite($handle, $text);
	
	fclose($handle);
	  ?>
	   
	   <?php
	foreach($buttons as $key => $value){
	
	
	if($i % 8 == 0){
	
	  echo "<br />";
	  }
	    ?>
	    <img id="image[<?php echo $key;?>]" src="<?php echo $SITE_URL;?>/include/slider_images/<?php echo basename($value);?>" style="margin-bottom:5px;margin-left:5px;width:auto;height:30px;"  />
	    
	 <?php
	$i++;
	}


 ?>


<?php

}


 ?>

 <script type="text/javascript">
   
   
   

function change_images(slider_id){

		function cacheBuster(url) {
		    return url.replace(/\?cacheBuster=\d*/, "") + "?cacheBuster=" + new Date().getTime().toString();
		}

		 
		$(slider_id + ' a.jshowoff-next, ' + slider_id + ' a.jshowoff-prev').each(function() {
		    var bg_img = $(this).css("background-image");
		    if (bg_img !== "none") {
			var url = /url\((.*)\)/i.exec(bg_img);
			if (url) {
			new_url = url[1];
			
			  <?php if(!empty($button[0])){ ?>
			    
			    
			    new_url = new_url.replace(/<?php echo $button[0];?>/, <?php echo $_REQUEST['buttonset'];?>);
			    
			    <?php } ?>
			$(this).css("background-image", "url(" + cacheBuster(new_url) + ")");
			}
		    }
		}); 
		
}
   change_images();
 </script>



