    <table>
      <tr>
	<td colspan="1">
	    <h1 style="height:20px;width:100px;position:relative;top:-10px;font-size:14px;width:120px;" id="<?php echo $_REQUEST['id'];?>-hidden"><?php echo $_REQUEST['id'];?></h1>
	</td>
	<td colspan="9" style="height:20px;border: 1px dotted blue;border-radius:15px;height:20px;margin:2px 2px 2px 0;font-size:13px;" height="20px" >
	    <table >
		<tr>
		  	<td colspan="1" style="height:20px;width:100px;position:relative;">
		  	
		  	
			    <h1 style="color:#000;margin-right:20px;height:20px;width:100px;font-size:13px;top:5px;left:10px; position:relative;">Filter With:</h1>

			</td>
			
			<?php
			$sql_sub_tag = db_query("select distinct selector, human_name, type from style_sheets where template = '" . addslashes(urldecode($template)) . "' and selector like '$_REQUEST[id]%' and selector != '$_REQUEST[id]'");
					
			if(db_num_rows($sql_sub_tag) >= 1){
			?>
			
			<td colspan="1" style="height:20px;width:250px;" >
			  <label  style="height:20px;position:relative;width:100px;float:left;">Child Elements</label>
				<input type="hidden" id="my_css_id" value="<?php $tag = explode(" ", $_REQUEST['id']); echo $tag[0]; ?>" style="height:20px;position:relative;"/>
				
				     <select id="tag" name="tag" onchange="javascript: create_editor_from_tag('<?php echo $_REQUEST['id']; ?>');"  style="height:20px;position:relative;">
					<option value=""></option>
					
					<?php
					
					
					
					while($row_sub_tag = db_fetch_array($sql_sub_tag)){
					
					?>
					
					
					<option value="<?php echo $row_sub_tag['selector']; ?>"><?php if(!empty($row_sub_tag['human_name'])){ echo $row_sub_tag['human_name']; }else{ $row_sub_tag['selector']; } ?></option>
					
					<?php 
					
					}
					?>
				  </select>
				      <?php echo db_error(); ?>
				    
				      
				
		      </td>
		    <?php } ?>
		      <td colspan="1" style="height:20px;width:220px;" align="left" >
			    <label  style="height:20px;position:relative;width:80px;float:left;">Search</label>
				  <input name="tag_action_search" id="tag_action_search"  style="height:20px;position:relative;width:200px;" value="<?php echo $_REQUEST['id'];?>" />
				
				 
				  <script>
				        
				      $('#tag_action_search').bind('keyup', function (e) {
				     
					if (e.which == 13) {
					 if ($($('#tag_action_search').val()).length ) {
						create_editor($('#tag_action_search').val());
					    }else{
					    $('#dialog').html("no matching selector found in the DOM. Please try another one");
					    $('#dialog').dialog();
					}
					}
				      });
	
				  </script>
				
		      </td>
		      <td colspan="1" style="height:20px;width:220px;" >
				<input type="hidden" id="my_css_id" value="<?php $tag = explode(" ", $_REQUEST['id']); echo $tag[0]; ?>" style="height:20px;position:relative;float:left;max-width:120px;word-wrap:break-word;"/>
				
				     <select id="with_class" name="with_class" onchange="javascript: create_editor($(this).val(), 'id');"  style="height:20px;position:relative;">
					<option value=""></option>
					
					<?php
					$sql_sub_tag = db_query("select distinct selector, human_name, type from style_sheets where type='id' order by selector asc");
					
					
					
					while($row_sub_tag = db_fetch_array($sql_sub_tag)){
					
					?>
					
					
					<option value="<?php echo $row_sub_tag['selector']; ?>" style="max-width:120px;word-wrap:break-word;border:1px dotted blue;"><?php if(!empty($row_sub_tag['human_name'])){ echo wordwrap($row_sub_tag['human_name'], 50); }else{ wordwrap($row_sub_tag['selector'], 50); } ?></option>
					
					<?php 
					
					}
					?>
				  </select>
				      <?php echo db_error(); ?>
				      <label  style="height:20px;position:relative;width:150px;">All Ids</label>
		      </td>
		      <td colspan="1" style="height:20px;width:200px;" >
				<input type="hidden" id="my_css_id" value="<?php $tag = explode(" ", $_REQUEST['id']); echo $tag[0]; ?>" style="height:20px;position:relative;float:left;word-wrap:break-word;"/>
				
				     <select id="with_class" name="with_class" onchange="javascript: create_editor($(this).val(), 'class');"  style="height:20px;position:relative;float:left;max-width:120px;word-wrap:break-word;">
					<option value=""></option>
					
					<?php
					$sql_sub_tag = db_query("select distinct selector, human_name, type from style_sheets where type='class' or selector like '.%' order by selector asc");
					
					
					
					while($row_sub_tag = db_fetch_array($sql_sub_tag)){
					
					?>
					
					
					<option value="<?php echo $row_sub_tag['selector']; ?>" style="max-width:120px;word-wrap:break-word;border:1px dotted blue;"><?php if(!empty($row_sub_tag['human_name'])){ echo wordwrap($row_sub_tag['human_name'], 50); }else{ wordwrap($row_sub_tag['selector'], 50); } ?></option>
					
					<?php 
					
					}
					?>
				  </select>
				      <?php echo db_error(); ?>
				      <label  style="height:20px;position:relative;width:150px;">All Classes</label>
				      
  
  

				
		      </td>
		      <td colspan="1" style="height:20px;width:300px;border:1px dotted blue;border-radius:6px;" >
		      

				
				
				     <select id="with_tag" name="with_tag" onchange="javascript: create_editor_action($(this).val(), $('#tag_action').val(), '<?php echo $_REQUEST['id'];?>' );"  style="float:left;">
					<option value=""></option>
					<option value="html">html</option>
					<option value="body">body</option>
					<option value="table">table</option>
					<option value="tbody">tbody</option>
					<option value="th">th</option>
					<option value="tr">tr</option>
					<option value="td">td</option>
					<option value="div">div</option>
					<option value="span">span</option>
					<option value="label">label</option>
					<option value="select">select</option>
					<option value="input">input</option>
				
					<option value="button">button</option>
					<option value="textarea">textarea</option>
					<option value="ul">unordered lists</option>
					<option value="li">list element</option>
					<option value="ol">ordered lists</option>
					<option value="a">links</option>
					<option value="a:link">link</option>
					<option value="a:active">active links</option>
					<option value="a:hover">hover link</option>
					<option value="a:visited">visited link</option>
				  </select>
				  
				  
				  <select id="tag_action" name="tag_action" onchange="javascript: create_editor_action($('#with_tag').val(), $(this).val(), '<?php echo $_REQUEST['id'];?>');"  style="float:left;">
					<option value=""></option>
					<option value="append">Append</option>
					<option value="prepend">Prepend</option>
					<option value="global">Edit Globally</option>
				  </select>
				      <?php echo db_error(); ?>
				      <label  style="margin-left:15px;float:left;">All Tags</label>
				      
				
		      </td>		
		  </tr>
	     </table>



