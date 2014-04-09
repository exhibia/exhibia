<?php
include($_SERVER['DOCUMENT_ROOT'] . "/config/config.inc.php");
$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
if (!$db) {
    die('Could not connect: ' . db_error());
}

db_select_db($DATABASENAME, $db);


$template_exists = db_fetch_array(db_query("select value from sitesetting where name = 'master_settings' and value like 'template:%' order by id desc limit 1"));

    if(empty($template_exists[0]) & empty($template) & empty($_COOKIE['template'])){
	$template = 'default';
	
    }else{
      if(!empty($template)){
      
	    $template = $template;
    
      }else if(!empty($_COOKIE['template'])){
	  $template = $_COOKIE['template'];
      }else
      {
	  $template = explode(":", $template_exists[0]);
	  $template = $template[1];

      }
}
$template = urldecode($template);
setcookie('template', $template, time()-4000000000000, '/');
setcookie('template', $template, time()+4000000000000, '/');

function rgb2hex($rgb) {
   $hex = "#";
   
   $rgb = str_replace("rgb(", " ", $rgb);
   $rgb = explode(",", $rgb);
  
   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

   return $hex; // returns the hex value including the number sign (#)
}


  
      if(!empty($_REQUEST['update_names'])){
      
      
      
      }
      else
      
      if(!empty($_REQUEST['update'])){
   
      $limit = '';
      


if(db_num_rows(db_query("select * from style_sheets where template = '$template'")) == 0){

    $qry = db_query("select * from style_sheets where template = 'default'");
    
	while($row = db_fetch_array($qry)){
	
	
	    db_query("insert into style_sheets values(null, '" . addslashes($template) . "', '$row[page]', '$row[selector]', '$row[property]', '$row[value]', '$row[type]', '$row[human_name]', '$row[human_description]', '$row[editable]');");
	
	}

}

	
   
	      
	      
	if($_REQUEST['type'] == 'color' | empty($_REQUEST['type'])){
		
	    if(!empty($_REQUEST['property'])){
      
	      $limit = " and property = '$_REQUEST[property]'";
	  
	    }
	  $qry = db_query("select * from $_REQUEST[table] where value = '$_REQUEST[old_color]' and template = '$template'" . $limit);
	  
	     while($row = db_fetch_array($qry)){
		  setcookie('template', $template, time()-3600, '/');
		  setcookie('template', $template, time()+3600, '/');
		  
		  
		  
		    $new_value = str_replace($_REQUEST['old_color'], $_REQUEST['new_color'], $row['value']);
		    
		    db_query("update $_REQUEST[table] set value = '$new_value' where id = '$row[id]'");
	      
	      
	      
	      }
	      
	      
	}else if($_REQUEST['type'] == 'gradient'){
	
	
	


	$values_array = array('svg', 'filter', 'gradient');

	$prefixes = array("webkit", "ms", "khtml", "o", "moz");
	
	
	$sql_m1 ="select distinct selector from style_sheets where template = '$template' and property like '%background%' and (value like '%gradient%' or value like '%filter%' or value like '%svg%')";
	
	$qry = db_query($sql_m1);
	
	  while($row = db_fetch_array($qry)){
	
	
	foreach($_REQUEST['new_color'] as $key_c => $value_c){
	
	
	    $sql_m2 = "select * from style_sheets where template = '$template' and property like '%background%' and (value like '%gradient%' or value like '%filter%' or value like '%svg%') and selector = '$row[selector]'";
	    
	    $qry2 = db_query($sql_m2);
	  
		while($row2 = db_fetch_array($qry2)){
		
		
			
			    $value_c = ltrim(rtrim($value_c));
		      echo $_REQUEST[$key_c . '_color_hidden'] . "=>" . $_REQUEST['new_color'][$key_c];
		      
		      
		      $sql_m3 = "select * from style_sheets where template = '$template' and property like '%background%' and selector = '$row2[selector]' and (value like '%" . $_REQUEST[$key . '_color_hidden'] . "' or value like '%" . rgb2hex($_REQUEST[$key . '_color_hidden']) . "%')";
		
		      $qry3 = db_query($sql_m3);
		      
			while($row_m3 = db_fetch_array($qry3)){
			
			  if(!preg_match('/svg/', $row_m3['value']) & !preg_match('/filter/', $row_m3['value'])){
			
			
			
		
		
		
			
		 $new_value = str_replace($_REQUEST[$key_c . '_color_hidden'], $_REQUEST['new_color'][$key_c], $row_m3['value']);
		
			  $new_value = str_replace(rgb2hex($_REQUEST[$key_c . '_color_hidden']), $_REQUEST['new_color'][$key_c], $new_value);
			 
			  
			//  echo "update style_sheets set value = '". addslashes($new_value) . "' where id = '$row_m3[id]'";
			      db_query("update style_sheets set value = '". addslashes($new_value) . "' where id = '$row_m3[id]'");
			      
			      db_query("update style_sheets set value = '". addslashes($new_value) . "' where id = '$row_m3[id]'");
			       
			       
			     
			      
			      }else if(preg_match('/svg/', $row_m3['value'])){
			      
			      db_query("update style_sheets set value = '" . addslashes(urldecode($_REQUEST['svg'])) . "' where id = '$row_m3[id]'");
			      
			      
			      }else{
			      
			      db_query("update style_sheets set value = '" . addslashes(urldecode($_REQUEST['filter'])) . "' where id = '$row_m3[id]'");
			      
			      }
			
			
			}
			}
		    
		    
		    
		   
	      }
	echo "success";

	}
	}  
      echo db_error();
      
      
      }else{
     
      ?>
      <style>
      h2 {
      font-weight:bold;
      }
      .highlight {
      
      background-color:blue;
      
      }
      </style>
    <link rel="STYLESHEET" type="text/css" href="<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/codebase/dhtmlxcombo.css">      
      
    <script src="<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/codebase/dhtmlxcommon.js"></script>
    <script src="<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/codebase/dhtmlxcombo.js"></script>

<script>
window.dhx_globalImgPath="<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/codebase/imgs/";
      try{
	  var zi=dhtmlXComboFromSelect("template_r");
	
      }catch(no){}
      
      function change_colors(){
      
      $('div, span, td, label, ul, li, dd, dl, ol, a,  th, table, tbody').each(function() {
      
      
	var match = hexToRgb($('#old_color').val());
	var new_color = $('#new_color').val();
	var property = $('#property').val().replace('-color', 'Color');
	match_rgb = match.replace('a', '');
	
	match_rgb = match_rgb.replace(/,\s[0-9]+\)$/, ')');
	
	
	
		if( $(this).css(property) == match_rgb || $(this).css(property) == match || $(this).css(property) == $('#old_color').val() ){
		
	    
		    $(this).css(property, new_color);
		    
		}
	    
	    
	    });
      
      
      
      
      }
      function change_names(){
			  $('#human_name').val($('#human_name_select').val());
			  $('#human_description').html($('#human_name_select option:selected').attr('class')); 
			  $('*').removeClass('highlight'); 
			// $($('#human_name_select option:selected').attr('alt')).addClass('highlight');
			 
			 $($('#human_name_select option:selected').attr('alt')).effect("pulsate", { times:3000 }, 2000000);
		      
		      }
        function replace_db_value(){
        <?php if($_REQUEST['type'] == 'color' | empty($_REQUEST['type'])){
        ?>
				  
					$.get('<?php echo $SITE_URL;?>/include/addons//design_suite/DESIGN/editor/replace_values.php?' + $('#css_form').serialize(), function(response){
					
					    $('#dialog').html("Success!!! Your Database has been updated<div id=\"hide_log\" style=\"display:none;\"> " + response + "</div><a href=\"javascript:;\" onclick=\"$('#hide_log').css('display', 'block');\">View Log</a>");
					    $('#dialog').dialog();
					    
					    });
					    
	<?php }else if($_REQUEST['type'] == 'gradient'){
	
	    ?>
	    data = '';
	    if($('#ms_filter').val() != ''){
	      data += '&filter=' + encodeURIComponent($('#ms_filter').val());
    
	      }
	    if($('#svg').val() != ''){
	      data += '&svg=' + encodeURIComponent($('#svg').val());
    
	    }
	    
	    data += '&gradient=' + encodeURIComponent($($('#selector').html()).css('backgroundImage'));
	    data += '&old_color=' + encodeURIComponent($('#old_color').val());
	    data += '&template=' + encodeURIComponent($('input[name="template_r"]').val());
	    data += '&type=gradient';
	    
	    $('.hidden-gradient-boxes').each(function(){
		
		alt = $(this).attr('alt');
		id = $(this).attr('id');
		
		data += '&' + id + '=' + $(this).val();
	    
	    });
	    
	   
	    
	    
	    $('.gradient').each(function(){
	    data += '&new_color[' + $(this).attr('id') + ']= ' + $(this).val();
	   
	    
	    });
	    
	
				      $.post('<?php echo $SITE_URL;?>/include/addons//design_suite/DESIGN/editor/replace_values.php?update=true&' + data , function(response){
					
					    $('#dialog').html("Success!!! Your Database has been updated<div id=\"hide_log\" style=\"display:none;\"> " + response + "</div><a href=\"javascript:;\" onclick=\"$('#hide_log').css('display', 'block');\">View Log</a>");
					    $('#dialog').dialog();
					    
					    });
					    
	<?php					
	
	
	}
	?>
				}
      </script>
      <div style="width:100%;text-align:center;max-height:150px;overflow:auto;">
      <form action="javascript: replace_db_value();" id="css_form" name="css_form" enctype="multipart/formdata">
      <table align="center" style="position::relative;left:200px;height:100px;">
     
	  <tr>
	      <td colspan="6" align="center">
		
		  
      
      <h1>Change Colors</h1>
	      </td>
	  </tr>
     
	  <tr>
	      <td valign="top" height="100%">
	      
	      <?php 
	      if(!empty($_REQUEST['table'])){
	   
	      ?>
		  <h2>Template</h2>
		  <br />
		
		  <select id="template_r" name="template_r" style="margin-left:20px;">
		     <?php
	      $template_sql = db_query("select distinct template from style_sheets");
		  while($template_row = db_fetch_array($template_sql)){
		  echo "<option value=\"" . $template_row['0'] . "\" ";
		  if(urldecode($template) == $template_row['0']) { echo 'selected';; }
		  
		      echo ">" . $template_row['0'] . "</option>";
		  
		  }
	      ?>
		     
		      </select>
		      
		 <?php } ?>
	      </td>
	      <td valign="top" height="100%">
	      
	      <?php 
	      if(!empty($_REQUEST['table']) & empty($_REQUEST['type'])){
	      ?>
	         <h2>Property Optional</h2>
		      <br />
		      <select id="property" style="margin-left:20px;">
		      <option value=""></option>
		      <?
			  $qry = db_query("select distinct(property) from $_REQUEST[table] where property like '%color%' order by property asc");
			    while($row = db_fetch_array($qry)){
			    
			    //if(preg_match('/gradient/', $row['value'])){
			  
			    
			    ?>
			    
				<option  value="<?php echo $row['property'];?>"><?php echo $row['property'];?></option>
			    <?php
			    }
			    
			  ?>
		      
		      
		      </select>
		<?php } ?>
 		</td>
		<td colspan="2" valign="top" height="100%"> 
		<?php if($_REQUEST['table'] == 'style_sheets'){
		?>
		    <h2>Old Color Or Gradient</h2>
		    <br />
	   <select id="choose_color" onchange="javascript: $('#selector').html($('#choose_color option:selected').text());$('#old_color').val($(this).val());<?php if($_REQUEST['type'] == 'gradient'){ ?>get_gradient_box(); high_light($('#choose_color option:selected').text());<?php }else{ ?>  <?php } ?> $('#property').val($('#choose_color option:selected').attr('alt'))" style="margin-left:20px;">
		    <?php
		    $extra = '';
		    if($_REQUEST['type'] == 'gradient'){
		    
		    $extra = " where value like '%gradient%' and property like '%background%' order by selector, id asc";// or selector =  'box-shadow'";
		    
		    }else{
		    
			if(!empty($_REQUEST['row'])){
			
			    if(!empty($_REQUEST['value'])){
			     $extra = " where $_REQUEST[row] = '$_REQUEST[value]' order by value asc";
			     
			     }else{
				$extra = " where property = '$_REQUEST[value]' order by value asc";
			     
			     }
			}else{
			if(!empty($_REQUEST['value'])){
			     $extra = " where property = '$_REQUEST[value]' order by value asc";
			     
			     }else{
			     
			    $extra = " where property like '%color%'  order by value asc";
			    
			    }
			
			}
		    
		    }
		    
			$qry = db_query("select distinct value, property, human_name, selector from $_REQUEST[table] $extra");
			  while($row = db_fetch_array($qry)){
			  
			  if(preg_match('/gradient/', $row['value'])){
			
			      
			  
			  }
			  ?>
			  
			      <option style="<?php if(($row['value'] == '#fff' | $row['value'] == '#ffffff' & $row['value'] == '#FFF' | $row['value'] == '#FFFFFF' | $row['value'] == 'white') & $row['property'] == 'color'){ ?> background-color:red;<?php }else{ ?>background-color:white;<?php }  echo $row['property'];?>:<?php echo $row['value'];?>;" value="<?php echo $row['value'];?>" alt="<?php  echo $row['property'];?>"><?php if($_REQUEST['type'] != 'gradient'){ echo $row['value']; }else{ echo $row['selector']; } ?></option>
			  <?php
			  }
			 
			?>
		    
		    
		    </select>
		
		      <input type="hidden" name="old_color" id="old_color" value="" style="margin-left:20px;" />
		      
		      <?php }else{ ?>
		      
		      
		      
		      <?php } ?>
		 </td>
		<td valign="top" height="100%">
		     
	<?php
		if($_REQUEST['type'] != 'gradient' & !empty($_REQUEST['table'])){
		?>
			<h2>New Color</h2>
			<br />
			<input type="text" name="new_color" id="new_color" value="" style="margin-left:20px;" />
			
			
			
      <?php }else if($_REQUEST['type'] == 'gradient'){ ?>
			<h2>New Gradient</h2>
			<br />
			<input type="text" name="new_color" id="new_color" value="" style="margin-left:20px;font-size:9px;width:200px;"   />
			<input type="hidden" name="type" id="type" value="<?php echo $_REQUEST['type'];?>" />
			<div id="selector" style="display:none;"><?php echo $_REQUEST['selector'];?></div>
			
			
			<input type="hidden" name="gradient" id="gradient" value="" />
			<input type="hidden" name="background" id="background" value="" />
			<input type="hidden" name="background-color" id="background-color" value="" />
			<input type="hidden" name="background-image" id="background-image" value="" />
			
			<input type="hidden" id="from_color_r" value="" />
			<input type="hidden" id="mid_color_r" value="" />
			<input type="hidden" id="to_color_r" value="" />
						
			<div id="hidden-gradient-boxes"></div>
			
			
			
	<?php } ?>
	
			    <input type="hidden" name="table" id="table" value="<?php echo $_REQUEST['table'];?>" />
			    <input type="hidden" name="update" id="update" value="true" />
			<input type="submit">
			</form>
		</td>
		<td>
		
	</table>	
	
		<script>
		<?php
		if($_REQUEST['type'] != 'gradient' & !empty($_REQUEST['table'])){
		?>
    
		
					
			      $('#new_color').colorpicker({ 
			
					parts:			'full',
					swatches:		'pantone',
					
					swatchesWidth:	100,  
				colorFormat: 'RGBA',
				color: '#fff',
				altOnChange: true,
				altProperties:	'background-color, color',
				
				draggable:			true,		// Make popup dialog draggable if header is visible.
				duration:			'fast',
				//hsv:				false,
					alpha: true,
					select: function(event, color) {
								my_color = color.formatted;
					      change_colors();
					}
	
				  });	
				  
		<?php }else{ ?>
		$('#selector').html($('#choose_color').val());
			
			
			
	 
      function get_gradient_box(){
      
      
      $('#new_color').val($('#old_color').val());
      $('#new_color').css('backgroundImage', $($('#choose_color option:selected').text()).css('backgroundImage'));
		 var id = $('#choose_color option:selected').text();
		
		    $('#new_color').qtip( { id: 'edit_tt', content: { 
					    text : '<img src="<?php echo $SITE_URL;?>include/addons/design_suite/loading.gif" align="center" width="30px" height="30px" />',
						
					    title: { text: '<h37>Edit Gradient for ' + $('#choose_color option:selected').text() + '</h37>', botton: 'Close' }, 
					    
					  
					    ajax : {
					    
						url: '<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/background.php',
						data: { template: $('input[name="template_r"]').val(), switch: 'background', id: $('#selector').html(), type: 'id', showOnly: 'gradient' },
						type: 'get',
						success: function(data, status){
						
						    this.set('content.text', data);
						
						}
					    
					    
					    
					    }
					    
					  },
					      //prerender: true,
						    position: {
							my: 'bottom middle',
							at: 'top middle',
							viewport:$('body'),
							target: $('#new_color')
							
							},
							show: {
							prerender:true,
							ready:true,
							solo: true
							
							},
							style:{
							height: 'auto',
							
							},
							
							
							hide : false,
							   events: {
							      render: function() {
							      $(this).css('position', 'fixed');
							       $(this).draggable({ handle: 'h37' });
								
								}
								
								
							     
							   },
							   
							 api: {
							    onRender: function() {
							      
							    }
							}
						
						      });
		}
		
		
		<?php } ?>
	</script>
	
	
	<?php
	if($_SERVER['SERVER_NAME'] == 'websitecommercesolutions.net'){
	?>
	<div class="clear"></div>
	<br />
	 <form action="javascript: replace_db_value();" id="replace_names" name="replace_names" enctype="multipart/formdata">
	
     <table align="center" >
	   <tr>
	      <td valign="top" height="100%" colspan="4" align="center">
     
		   <h1>Joel This is just for you</h1>
	      </td>
	  </tr>
	  <tr>
	      <td valign="top" height="100%">
		
	    
    
		    <h2>Old Name</h2>
		    <br />
		    <script>
		      
		    </script>
		    <select id="human_name_select" onchange="javascript: change_names();" style="margin-left:20px;">
		    <?
			$qry = db_query("select distinct(human_name), human_description, selector from $_REQUEST[table]  order by human_name asc");
			  while($row = db_fetch_array($qry)){
			
			  ?>
			  
			      <option alt="<?php echo $row['selector'];?>" value="<?php echo $row['human_name'];?>" class="<?php echo $row['human_description'];?>"><?php echo $row['human_name'];?></option>
			  <?php
			  }
			  
			?>
		    
		    
		    </select>
		
		 </td>
		<td valign="top" height="100%">
		     
    
			<h2>Human Name</h2>
			<br />
			<input type="text" name="human_name" id="human_name" value="" style="margin-left:20px;" disabled/>
			
			<br />
			<h2>Human Description</h2>
			<br /> 
			<textarea name="human_description" id="human_description" disabled></textarea>

		
		</td>
	  
		<td valign="top" height="100%">
		     
    
			<h2>New Human Name</h2>
			<br />
			<input type="text" name="new_human_name" id="new_human_name" value="" style="margin-left:20px;" />
			
			<br />
			<h2>New Human Description</h2>
			<br />
			<textarea name="new_human_description" id="new_human_description"></textarea>

			
		</td>
         
		    <td valign="top" height="100%">
		    <input type="hidden" name="update_names" id="update_names" value="true" />
		    <input type="submit" />
		    </td>
		 </tr>
	</table>
	<script>
	
	
	//$('input[name="template"]').val('<?php echo $template; ?>');
	</script>

</form>

<?php } ?>
	</div>
<?php
}
?>