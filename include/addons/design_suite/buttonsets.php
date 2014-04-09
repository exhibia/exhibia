<?php
require_once("../../../config/config.inc.php");
db_connect($DBSERVER, $USERNAME, $PASSWORD);


db_select_db($DATABASENAME);


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
shell_exec("mkdir img/buttons/$_REQUEST[newset]");

shell_exec("chmod 777 img/buttons/$_REQUEST[newset] -R");



shell_exec("cp img/buttons/$_REQUEST[buttonset]/* img/buttons/$_REQUEST[newset]/ -R -f");




$_REQUEST['buttonset'] = $_REQUEST['newset'];
}
if(empty($_REQUEST['buttonset'])){

?>




    <table align="center" style="padding-top:10px;padding-bottom:10px;margin:0 auto;" width="1200px;" class="settings_form">
      <tr>
	<td colspan="2"><?php echo $msg; ?>
	  		
	  
	  </td>


      </tr>
      <tr>
	  <td colspan="1">


<?php  $buttons = include_sub_dirs("img/buttons"); ?>
<?php

 if(db_num_rows(db_query("select * from sitesetting where name = 'buttons'")) >= 1){
 
 
    $old_button = db_fetch_array(db_query("select value from sitesetting where name = 'buttons'"));
    
    
    }else{
    $old_button = array();
    $old_button[0] = $template;
    
    db_query("insert into sitesetting(id, name, value) values(null, 'buttons', '$template');");
    
    
    
    }
			
			    ?>
			    <table>
			    <tr>
			    <td>
			<h2>Choose a Button Package</h2>
	
			<select id="buttons" name="buttons" onchange="ajax_PAS('include/addons/design_suite/buttonsets.php?', 'buttonset=' + $('#buttons').val() , 'get','button-preview');">
			    <option value="<?php echo $old_button[0];?>"><?php echo $old_button[0];?></option>
		      
			<?php
		      		      foreach($buttons as $key => $buttonset){
				      
				      $file_array = directoryToArray("img/buttons/$buttonset", "*", true);
					if(count($file_array) >=1 & !empty($buttonset)){
					  ?><option value="<?php echo $buttonset;?>"><?php echo $buttonset;?></option><?php
			
					  }

					}

			?>
			</select>
		</td>
		</tr>
		<tr>
		<td>
		   <input type="checkbox" id="custom" name="custom" onclick="document.getElementById('custom_name').style.display= 'block';">Use as custom button set
		</td>
		</tr>
		<tr>
		<td>
		    <div id="custom_name" style="display:none;">
		    <h2>Custom Name</h2>
		      <input type="text" name="butonset" id="buttonset" value="custom" onkeyup="submit_custom(event);" />
		    </div>
		</td>
		</tr>
		</table>
	    </td>


	    <td id="button-preview">
	      <div id="background-uploader"></div> 
	      <?php
	   
	      if(!empty($old_button[0])){
	      
	      
	      $buttons = directoryToArray("../../../css/$template/buttons/", "*", true);
	      	
		  foreach($buttons as $key => $value){
		  
		  
		  if($i % 8 == 0){
		  
		    echo "<br />";
		    }
		      ?>
		  <a href="javascript:;" onclick="ajax_PAS('include/addons/design_suite/uploader.php?', 'type=button&path=img/buttons/<?php echo $old_button[0];?>&file=<?php echo $value;?>&buttonset=<?php echo $old_button[0];?>&image=image[<?php echo $key;?>]' , 'get', 'background-uploader');">
		      <img id="image[<?php echo $key;?>]" src="<?php echo $SITE_URL;?>/css/<?php echo $template;?>/buttons/<?php echo $value;?>" style="margin-bottom:5px;margin-left:5px;width:auto;height:30px;" />
		    </a>
		    
		  <?php
		  $i++;
		  }
		}
	      
		?>
	      </td>

	</table>
<?php
}else{

 ?>
<div id="background-uploader"></div> 
<?php

 if(db_num_rows(db_query("select * from sitesetting where name = 'buttons'")) >= 1){
 
 
    $old_button = db_fetch_array(db_query("select value from sitesetting where name = 'buttons'"));
    db_query("delete from sitesetting where name = 'buttons'");
 
}
db_query("insert into sitesetting values(null, 'buttons', '$_REQUEST[buttonset]', '', '', '');");


 echo db_error();
$buttons = directoryToArray("img/buttons/$_REQUEST[buttonset]", "*", true);
$i = 0;
//shell_exec("rm ../img/buttons/$_REQUEST[buttonset] -R -f");
shell_exec("rm ../../../css/$template/buttons/.htaccess -f");
$handle = fopen("../../../css/$template/buttons/.htaccess", "w+");

    $text = file_get_contents("new-htaccess");

	$text = str_replace("SITE_URL", $SITE_URL, $text);
	$text = str_replace("BUTTONSET", $_REQUEST['buttonset'], $text);

	fwrite($handle, $text);
	
	fclose($handle);
	  ?>
	   
	   <?php
	foreach($buttons as $key => $value){
	
	
	if($i % 8 == 0){
	
	  echo "<br />";
	  }
	    ?>
	    <a href="javascript:;" onclick="ajax_PAS('include/addons/design_suite/uploader.php?', 'type=button&path=img/buttons/<?php echo $_REQUEST['buttonset'];?>&file=<?php echo $value;?>&buttonset=<?php echo $_REQUEST['buttonset'];?>&image=image[<?php echo $key;?>]' , 'get', 'background-uploader');">
	      <img id="image[<?php echo $key;?>]" src="<?php echo $SITE_URL;?>/include/addons/design_suite/buttons/<?php echo $value;?>" style="margin-bottom:5px;margin-left:5px;width:auto;height:30px;"  />
	    </a>
	 <?php
	$i++;
	}


 ?>


<?php

}


 ?>

 <script type="text/javascript">
   
   
   

function change_images(){

		function cacheBuster(url) {
		    return url.replace(/\?cacheBuster=\d*/, "") + "?cacheBuster=" + new Date().getTime().toString();
		}

		$("img").each(function() {
		
			new_url = this.src;
			
			  <?php if(!empty($button[0])){ ?>
			    
			    
			    new_url = new_url.replace(/<?php echo $button[0];?>/, <?php echo $_REQUEST['buttonset'];?>);
			    
			    <?php } ?>
			
		    this.src = cacheBuster(new_url);
		    
		    
		});

		$("button").each(function() {
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
		$("span").each(function() {
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
		$(".button").each(function() {
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
		$("p").each(function() {
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
		$("img, input[type=image]").each(function() {
		    	new_url = this.src;
			
			  <?php if(!empty($button[0])){ ?>
			    
			    
			    new_url = new_url.replace(/<?php echo $button[0];?>/, <?php echo $_REQUEST['buttonset'];?>);
			    
			    <?php } ?>
			
		    this.src = cacheBuster(new_url);
		  });
}
   change_images();
 </script>