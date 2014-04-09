
			  <script>
				<?php include("java.php"); ?>
			  </script>
		
			  <div class="coordinates-r">
			  
			      <div class="accordion" id="coordinates-r-accordion">
				      <h3>X (from left => numerical):</h3> 
				      <div class="panel">
					    <input type="text" name="xr" id="xr" value="<?php echo $_REQUEST['xr'];?>"   class="edit_css_interfaces universal"  onkeyup="javascript: update_left('<?php echo $_REQUEST['id'];?>', this.value);" />
				      </div>
					
					<h3>Y (from top => numerical):</h3>
					<div class="panel">
					    <input type="text" name="yr" id="yr" value="<?php echo $_REQUEST['yr'];?>"   class="edit_css_interfaces universal"  onkeyup="javascript: update_top('<?php echo $_REQUEST['id'];?>', this.value);" style="" /> 
				      </div>
			    </div> 
			      
			 </div>
		
			  <div  class="coordinates-a"> 
			  
				<div class="accordion" id="coordinates-a-accordion">
				      <h3>X (from left => numerical):</h3>
				      <div class="panel">
					  <input type="text" name="x" id="x" value="<?php echo $_REQUEST['x'];?>"  class="edit_css_interfaces universal"  onkeyup="javascript: update_left('<?php echo $_REQUEST['id'];?>', this.value);" style="" /><br /> 
				      </div>
			      
				         <h3>Y (from right => numerical):</h3>
					<div class="panel">
					  <input type="text" name="y" id="y" value="<?php echo $_REQUEST['y'];?>"  class="edit_css_interfaces universal"  onkeyup="javascript: update_top('<?php echo $_REQUEST['id'];?>', this.value);" />
					</div>
			      
				</div>
			  </div> 
		<div class="accordion" id="position-accordion">
			
			  <h3>Z Index (label => numerical):</h3>
			  <div class="panel">
			      <input type="text" name="z-index" id="z-index" value="<?php echo $_REQUEST['z-index'];?>"    onkeyup="javascript: update_z_index('<?php echo $_REQUEST['id'];?>', this.value);" />  
			  </div>
			  
			  
			<h3>Type</h3>
			<div class="panel">
			  <select id="position" name="position" onchange="javascript: update_property('<?php echo $_REQUEST['id'];?>', this.name);">
			      <option value="relative">relative</option>
			      <option value="absolute">absolute</option>
			       <option value="static">static</option>
			        <option value="fixed">fixed</option>
			         <option value="inherit">inherit</option>
			  </select>
			 </div>
	
	
	
	
					 
			  </div>
		
	
	

		
	
