 <?php

require("../../../../config/config.inc.php");

 $human_description = array();
 $human_name = array();
 

	if(db_num_rows(db_query("select distinct(human_description) from style_sheets where selector = '$_REQUEST[id]' and template = '". $template . "' and human_description != ''")) >= 1){

	      $human_description = db_fetch_array(db_query("select distinct(human_description) from style_sheets where selector = '$_REQUEST[id]' and template = '". $template . "' and human_description != '' limit 1"));

	 }else{
	 
	      $human_description = array();
	      $human_description[0] == $_REQUEST['id'];
	 
	 }

      if(db_num_rows(db_query("select distinct(human_name) from style_sheets where selector = '$_REQUEST[id]' and template = '". $template . "' and human_name != ''")) >= 1){
	      $human_name = db_fetch_array(db_query("select distinct(human_name) from style_sheets where selector = '$_REQUEST[id]' and template = '". $template . "' and human_name != '' limit 1"));
      }else{

	    $human_name = array();
	    $human_name[0] == $_REQUEST['id'];

      }
      
      
      if(empty($_REQUEST['type'])){

		$type = db_fetch_array(db_query("select distinct(type) from style_sheets where selector = '$_REQUEST[id]' and template = '". $template . "' and type != '' limit 1"));
      }else{

	    $type= array();
	  $type[0]= $_REQUEST['type'];
      }





?>
 <input type="hidden" id="css_file" name="css_file" value="<?php echo $template;?>.css" />
<table style="width:100%;margin-top:15px;">
 <tr>
   
 
      <td width="200px">
	  <label style="float:left;margin-left:10px;margin-right:5px;font-weight:bold;">Template</label>
	  <select id="template" name="template">
	      <?php
	      $template_sql = db_query("select distinct template from style_sheets");
		  while($template_row = db_fetch_array($template_sql)){
		  echo "<option value=\"" . $template_row['0'] . "\" ";
		  if($template == $template_row['0']) { echo 'selected'; }
		  
		      echo ">" . $template_row['0'] . "</option>";
		  
		  }
	      ?>
	      </select>
	 
      </td>
      <td width="230px">

	  <label style="float:left;margin-left:10px;margin-right:5px;font-weight:bold;">Human Name</label>
	  <select id="human_name" name="human_name">
	      <?php
	      $template_sql = db_query("select distinct(human_name) from style_sheets");
		  while($template_row = db_fetch_array($template_sql)){
		  echo "<option value=\"" . $template_row['0'] . "\"";
		      if($template_row[0] == $human_name[0]) { echo " selected"; }
		      
		      echo ">" . $template_row['0'] . "</option>";
		  
		  }
	      ?>
	      </select>
     </td>
      <td width="300px">
     <label style="float:left;font-weight:bold;margin-left:10px;margin-right:5px;">Human Description</label>
	    <select id="human_description" name="human_description">
	    <?php
	    $template_sql = db_query("select distinct(human_description) from style_sheets");
		while($template_row = db_fetch_array($template_sql)){
		    echo "<option value=\"" . $template_row['0'] . "\"";
		  if($template_row[0] == $human_description[0]) { echo " selected"; }
		    echo ">" . $template_row['0'] . "</option>";
		
		}
	    ?>
	    </select>
      </td>
      <td width="350px">
      <label style="float:left;margin-left:10px;margin-right:5px;font-weight:bold;">Save As:</label>
	    <input type="text" id="selector" name="selector" value="<?php echo ltrim(rtrim($_REQUEST['id']));?>" onkeyup="javascript: add_new_selector();" style="float:left;" />
	    
	    <input type="hidden" name="type" id="type" value="<?php echo $type['0'];?>"  style="float:left;" />
	    
	    
	      <select id="type_sel" name="type_sel"  style="float:left;margin-left:5px;">
	      <?php $sel_types = array('id', 'class', 'psuedo', 'tag'); ?>
	      <?php 
	      foreach($sel_types as $sel_type){
	      ?>
		  <option value="<?php echo $sel_type; ?>" <?php if($sel_type == $type['0']) { echo 'selected'; } ?>><?php echo $sel_type; ?></option>
		  
	      <?php } ?>
	      </select>
      </td>
      <td width="100px">
	    <table>
		  <tr>
	      
		    <td>
			<a href="javascript:;" onclick="javascript:refresh_styles('<?php echo $_REQUEST['id'];?>'); do_it_now('<?php echo $_REQUEST['id'];?>', '<?php echo $_REQUEST['type'];?>');" class="prevented" >
			  <img src="<?php echo $SITE_URL;?>include/addons/design_suite/restore.png" style="margin-left:20px;height:25px;width:auto;" align="right" class="universal edit_css_interfaces" />
			</a>    
		    </td>
		
		    <td>
			<a href="javascript:;" onclick="javascript:save_changes('<?php echo(ltrim(rtrim($_REQUEST['id'])));
			?>', '<?php echo(ltrim(rtrim($_REQUEST['id']))); ?>', '<?php echo $_REQUEST['type'];?>');" class="prevented" >
			  <img src="<?php echo $SITE_URL;?>include/addons/design_suite/save.png" style="margin-left:20px;height:25px;width:auto;" align="right" class="universal edit_css_interfaces" />
			</a>    
		    </td>
		    <td>
			<a href="javascript:;"  onclick="hide_with_image_change('#edit_inner');" class="prevented" >
			  <img src="img/show.png" style="margin-left:20px;height:25px;width:auto;" align="right" class="show_editor" />
			</a>
		    </td>
		    <td>
		      
		      </td>
		  </tr>
	      </table>
	   
	   
	  
	    
      
      
      </td>
    </tr>
 </table>

  
   <!-- 
    
  <span id="create_image" onclick="create_image('<?php echo $_REQUEST['id'];?>');" style="border-radius:10px;width:100px; height:30px;font-size:22px;text-align:center;border:1px solid blue;">Create Image</span>
-->
