			    <script type="text/javascript">
			    <?php include("java.php"); ?>
			    </script> 
<?php

$sides = array('top', 'right', 'bottom', 'left');
$outline_types = array('border', 'outline');

foreach($outline_types as $outline_type){
?>
	  
	    
	    
			<div class="accordion" id="<?php echo $outline_type;  ?>-accordion">
			
			
			<?php
			foreach($sides as $side){
			?>
			
			<h3><?php echo ucfirst($outline_type); ?>-<?php echo ucfirst($side); ?></h3>
			    <div class="panel">
				
					   <input type="hidden" name="<?php echo $outline_type;  ?>-<?php echo $side; ?>" id="<?php echo $outline_type;  ?>-<?php echo $side; ?>"  onkeyup="javascript: update_<?php echo $outline_type;  ?>_<?php echo $side; ?>('<?php echo $_REQUEST['id'];?>', this.value);"  title="<?php echo $outline_type;  ?>-<?php echo $side; ?>" class="edit_css_interfaces basic <?php echo $outline_type;  ?>s" />
				
				<ul>
				
				  <li>
				    <input type="text" name="<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Width" id="<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Width" onkeyup="javascript: update<?php echo ucfirst($outline_type); ?><?php echo ucfirst($side); ?>('<?php echo $_REQUEST['id'];?>');" class="edit_css_interfaces basic"  />
				  </li>
				  <li>
				    <select name="<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Unit" id="<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Unit" onchange="javascript: update<?php echo ucfirst($outline_type); ?><?php echo ucfirst($side); ?>('<?php echo $_REQUEST['id'];?>');"  class="edit_css_interfaces basic">

					  <?php foreach($units as $unit){ ?>
						  <option value="<?php echo $unit; ?>" ><?php echo $unit; ?></option>
					  <?php } ?>
				    </select>
				 </li>  
				
				
				<li>
				    <select name="<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Style" id="<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Style" onchange="javascript: update<?php echo ucfirst($outline_type); ?><?php echo ucfirst($side); ?>('<?php echo $_REQUEST['id'];?>');"  class="edit_css_interfaces basic" style="float:left;">

					  <?php foreach($b_types as $b_type){ ?>
						  <option value="<?php echo $b_type; ?>"><?php echo $b_type; ?></option>
					  <?php } ?>
				    </select>
				
				</li>
				<li>
				
				    <input type="text" name="<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Color" id="<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Color" class="edit_css_interfaces basic" />
				    
				    
				</li>
				
				
			      </ul>
				
			  </div>
				
				
					 
	         <?php } ?>
	         
	         
	         
	          <?php
					  if($outline_type == 'border'){
					  ?>
					      <h3>Border Radius</h3>
					      <div class="panel">
					     <ul>
						<?php
						$sides2 = array('top-left', 'top-right', 'bottom-right', 'bottom-left');
						
						    foreach($sides2 as $side2){
						    
							
						    ?>
						    <li>
						 
							<select name="border-radius-<?php echo $side2; ?>"  id="border-radius-<?php echo $side2; ?>" onchange="border_<?php echo str_replace("-", "_",$side2); ?>_radius('<?php echo $_REQUEST['id'];?>', $(this).val());" style="float:left;">
							      <?php
							      $radians = 0;
							      
							      while($radians <= 200){
							      ?>
							      <option value="<?php echo $radians;?>px"><?php echo $radians;?>px</option>
							      <?php
							      $radians++;
							      
							      }
							      ?>
							</select>
						</li>
						<?php
						
						 
						
						} 
						?>
					
						</ul>
					      </div>
					      
					      
					  <?php } ?>
					  <input type="hidden" name="border-radius-hidden" id="border-radius-hidden" value="" />
					  <input type="hidden" name="border-radius" id="border-radius" value="" />
	         </div>
	</div>	 
	<?php } ?>
	
	
	
		   
		