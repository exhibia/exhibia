			    <script>
				<?php include("java.php"); ?>
			  </script>
		<div class="accordion" id="dimensions-accordion">
		
			      <h3>Width Settings</h3>
			     
			      <div class="panel" style="margin-top:5px;">
				
				<ul style="list-style-type:none;text-align:left;position:relative;top:-10px;width:200px;">
				   
				   
				   <li style="display:inline;float:'';">Width</li>
				
				      
				      
				      
				   <li style="display:inline;float:'';">
				   
					  <input type="text" name="width" id="width"  onkeyup="javascript: update_width('<?php echo $_REQUEST['id'];?>', this.value);"  title="width" class="other" style="width:25px;" />
				   </li>
				   <li style="display:inline;float:'';">
					  <select name="widthUnit" id="widthUnit" onchange="javascript: update_width('<?php echo $_REQUEST['id'];?>', this.value);">
					    <?php
					    foreach($units as $unit){
					    ?>
						<option value="<?php echo $unit;?>"><?php echo $unit;?></option>
					    <?php } ?>
					  </select>
					  
				  </li>
				</ul>
				 <ul style="list-style-type:none;text-align:left;position:relative;top:-10px;width:200px;">
				   
				   
				   <li style="display:inline;float:'';">Min-Width</li>
		      
				      
				      
				      
				      <li style="display:inline;float:'';">
					  <input type="text" name="min-width" id="min-width"  onkeyup="javascript: update_min_width('<?php echo $_REQUEST['id'];?>', this.value);"  title="min-width" class="other" style="width:25px;" />
				      </li>
				      <li  style="display:inline;float:'';">
					  <select name="min-widthUnit" id="min-widthUnit" onchange="javascript: update_min_width('<?php echo $_REQUEST['id'];?>', this.value);">
					  <?php
					  foreach($units as $unit){
					  ?>
					      <option value="<?php echo $unit;?>"><?php echo $unit;?></option>
					  <?php } ?>
					  </select>
				      </li>
				</ul>
				 <ul style="list-style-type:none;text-align:left;position:relative;top:-10px;width:200px;">
				   
				   
				   <li style="display:inline;float:'';">Max-Width</li>
			
				    
				      <li style="display:inline;float:'';">
				      
					  <input type="text" name="max-height" id="max-height"  onkeyup="javascript: update_max_height('<?php echo $_REQUEST['id'];?>', this.value);"  title="max-height" class="other" style="width:25px;" />
				      </li>
				      <li style="display:inline;float:'';">
					  <select name="max-heightUnit" id="max-heightUnit" onchange="javascript: update_max_height('<?php echo $_REQUEST['id'];?>', this.value);">
					  <?php
					  foreach($units as $unit){
					  ?>
					      <option value="<?php echo $unit;?>"><?php echo $unit;?></option>
					  <?php } ?>
					  </select>
				      </li>
				  
			     </ul>
			  
			 </div> 
			  <div class="clear"></div>
			  
			  <h3>Height Settings</h3>
			  
			   <div class="panel" style="margin-top:5px;">
			  
			    

				    <ul style="list-style-type:none;text-align:left;position:relative;top:-10px;width:200px;">
				   
				   
				   <li style="display:inline;float:'';">Height</li>
				 
				      
				      
				    
				      <li style="display:inline;float:'';">
				     
					    <input type="text" name="height" id="height"  onkeyup="javascript: update_height('<?php echo $_REQUEST['id'];?>', this.value);"  title="height" class="other"  style="width:25px;" />
				      </li>
				      <li style="display:inline;float:'';">
					    <select name="heightUnit" id="heightUnit" onchange="javascript: update_height('<?php echo $_REQUEST['id'];?>', this.value);">
					    <?php
					    foreach($units as $unit){
					    ?>
						<option value="<?php echo $unit;?>"><?php echo $unit;?></option>
					    <?php } ?>
					    </select>
				      </li>
				</ul>
				<ul style="list-style-type:none;text-align:left;position:relative;top:-10px;width:200px;">
				   
				   
				   <li style="display:inline;float:'';">Min-Height</li>
				      
				      
				      
				      <li style="display:inline;float:'';">
					    <input type="text" name="min-height" id="min-height"  onkeyup="javascript: update_min_height('<?php echo $_REQUEST['id'];?>', this.value);"  title="min-height" class="other" style="width:25px;" />
				      </li>
				      <li style="display:inline;float:'';">
					    <select name="min-heightUnit" id="min-heightUnit" onchange="javascript: update_min_height('<?php echo $_REQUEST['id'];?>', this.value);">
					    <?php
					    foreach($units as $unit){
					    ?>
						<option value="<?php echo $unit;?>"><?php echo $unit;?></option>
					    <?php } ?>
					    </select>
				      </li>
				  </ul>
				  <ul style="list-style-type:none;text-align:left;position:relative;top:-10px;width:200px;">
				   
				   
				   <li style="display:inline;float:'';">Max-Height</li>
				    
				      <li style="display:inline;float:'';">
					  <input type="text" name="max-height" id="max-height"  onkeyup="javascript: update_max_height('<?php echo $_REQUEST['id'];?>', this.value);"  title="max-height" class="other" style="width:25px;" />
				      </li>
				      <li style="display:inline;float:'';">
					  <select name="max-heightUnit" id="max-heightUnit" onchange="javascript: update_max_height('<?php echo $_REQUEST['id'];?>', this.value);">
					  <?php
					  foreach($units as $unit){
					  ?>
					      <option value="<?php echo $unit;?>"><?php echo $unit;?></option>
					  <?php } ?>
					  </select>				      
				      </li>
				</ul>
			</div>
	      	  
			  <div class="clear"></div>
			  
			  <h3>Overflow X</h3>
			  
			   <div class="panel" style="margin-top:5px;">
			   </div>
			  <div class="clear"></div>
			  
			  <h3>Overflow Y</h3>
			  
			   <div class="panel" style="margin-top:5px;">
			   </div>
</div>







 
