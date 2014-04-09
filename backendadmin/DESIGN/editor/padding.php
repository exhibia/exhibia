	
			<script type="text/javascript">
			      <?php include("java.php"); ?>
			</script>
			
			
			<?php 
			
			
			      $pm = array('padding', 'margin');
			      $units = array('px', 'pt', 'em', 'mm', 'cm', 'in', 'pc', '%', 'auto', 'inherit');
 
	
			
			
			
			    foreach($pm as $m){
			    ?>
			
			
			   
			   
			     <input type="hidden" name="<?php echo $m;?>" id="<?php echo $m;?>" value="" />
			    
			
			     <div class="accordion" id="<?php echo $pm;?>-accordion">
			    <?php
				foreach($sides as $side){
			?>
				<h3><?php echo ucfirst($m); ?>-<?php echo ucfirst($side); ?></h3>
				
				    <div class="panel">
				    
				      
				      <input type="text" name="<?php echo $m; ?><?php echo ucfirst($side);?>" id="<?php echo $m; ?><?php echo ucfirst($side);?>"  class="edit_css_interfaces universal"  onkeyup="javascript: update<?php echo $m; ?><?php echo ucfirst($side);?>('<?php echo $_REQUEST['id'];?>', '<?php echo $m; ?><?php echo ucfirst($side);?>', this.value);"  title="<?php echo $m; ?><?php echo ucfirst($side);?>" style="width:35px;" />
				      
				      <select id="<?php echo $m;?><?php echo ucfirst($side); ?>Unit" name="<?php echo $m;?><?php echo ucfirst($side); ?>Unit" onchange="javascript: update<?php echo $m; ?><?php echo ucfirst($side);?>('<?php echo $_REQUEST['id'];?>', '<?php echo $m; ?><?php echo ucfirst($side);?>', this.value);">
				      
					 
				      <?php foreach($units as $unit){ ?>
				      
					  <option value="<?php echo $unit;?>"><?php echo $unit;?></option>
				      
				      <?php } ?>
				      </select>
				 </div>
				 <script>
				
				 </script>
				
			    
			<?php 	} 
			 ?>
			 
			      </div>
			  
			   <?php
			    }
			?>
		
		
				</div>	  
				
		</div>