	  
				
			  
				
			      <ul style="position:relative;top:5px;font-size:8px;">
				  <li style="float:left;">
				      <select name="transform_property" id="transform_property"  onchange="update_transform('<?php echo $_REQUEST['id'];?>');"  style="float:left;width:50px;">
					  <option value="none">none</option>
					  <option value="matrix3d">matrix</option>
					  
					  <option value="translate3d">translate</option>
					  
					
					  <option value="scale3d">scale</option>
					
					  
					  <option value="rotate3d">rotate</option>
					  
					  <option value="skew">skew</option>
					  <option value="perspective">perspective</option>
				      </select> 
				    </li>
			 

				
				    
				     <li style="float:left;">
				    X Ang.

					    <select id="transform_angle" name="transform_angle" onchange="update_transform('<?php echo $_REQUEST['id'];?>');" style="float:left;">
						<?php
						$n = 360;
						while($n >= 0){
						?>
						    <option value="<?php echo $n;?>deg" <?php if($n == 0){ echo 'selected'; } ?>><?php echo $n;?>&deg;</option>
						
						<?php
						$n--;
						}
						?>

					    </select>
					 </li>
				    
				    <li> 
					     <select id="transform_angle_y" name="transform_angle_y" onchange="update_transform('<?php echo $_REQUEST['id'];?>');"  style="float:left;">
						<?php
						$n = 360;
						while($n >= 0){
						?>
						    <option value="<?php echo $n;?>deg" <?php if($n == 0){ echo 'selected'; } ?>><?php echo $n;?>&deg;</option>
						
						<?php
						$n--;
						}
						?>

					    </select>

				    </li>
				    
				    <li>
				    
				  Pers.
					    <select id="perspective_n" name="perspective_n" onchange="update_transform('<?php echo $_REQUEST['id'];?>');"  >
						<?php
						$n = 1000;
						while($n >= -100){
						?>
						    <option value="<?php echo $n;?>" <?php if($n == 0){ echo 'selected'; } ?>><?php echo $n;?></option>
						
						<?php
						$n--;
						}
						?>

					    </select>

				    </li>
				</ul>
				<ul style="position:relative;top:-35px;font-size:8px;">
				    <li>


					    X
					    <select id="transform_x" name="transform_x" onchange="update_transform('<?php echo $_REQUEST['id'];?>');">
						<?php
						$n = -2400;
						while($n <= 2400){
						?>
						    <option value="<?php echo $n;?>px" <?php if($n == 0){ echo 'selected'; } ?>><?php echo $n;?>px</option>
						
						<?php
						$n++;
						}
						?>

					    </select>
				    </li>
				    <li>

					    Y
					    <select id="transform_y" name="transform_y" onchange="update_transform('<?php echo $_REQUEST['id'];?>');" <?php if($n == 0){ echo 'selected'; } ?>>
						<?php
						$n = -2400;
						while($n <= 2400){
						?>
						    <option value="<?php echo $n;?>px" <?php if($n == 0){ echo 'selected'; } ?>><?php echo $n;?>px</option>
						
						<?php
						$n++;
						}
						?>

					    </select>
				    </li>
				    
				    
				    
				    <li>

					    Z
					    <select id="transform_z" name="transform_z" onchange="update_transform('<?php echo $_REQUEST['id'];?>');" <?php if($n == 0){ echo 'selected'; } ?>>
						<?php
						$n = 0;
						while($n <= 2147483647){
						?>
						    <option value="<?php echo $n;?>"><?php echo $n;?></option>
						
						<?php
						if($n <= 100){
						    $step = 10;
						   }else if($n <= 10000){
						      $step = 1000;
						   
						   }else if($n <= 100000){
						   $step = 100000;
						   }else{
						   $step = 1000000;
						   }
						$n = $n + $step;
						}
						?>

					    </select>
				    </li>
				 </ul>
				 <ul style="position:relative;top:-45px;margin-bottom:-50px;font-size:8px;">
				    <li>
				    Mat. Val's.
					    <input type="text" name="matrix_values" id="matrix_values" value="" />
				    </li>
				</ul>
			   
			  <input type="hidden" name="transform" id="transform" value="" />
			    <script>
			    <?php $prefixes = array('Webkit', 'Khtml', 'O', 'Ms', 'Moz'); ?>
			    
			  function update_transform(divId){
			      
			      
				  switch($('#transform_property').val()){
				  
				      case "skew":
				      
					  bVal = 'skew(' + $('#transform_angle').val() + ',' + $('#transform_angle_y').val() + ')';
					  
					  $('<?php echo $_REQUEST['id'];?>').css('transform', bVal);
					  
					  <?php
					  foreach($prefixes as $pre){
					  ?>
					     $('<?php echo $_REQUEST['id'];?>').css('<?php echo $pre;?>Transorm', bVal);
					  <?php
					  }
					  ?>
					  
					  
				      break;
				      case "perspective":
					  bVal = 'perspective(' + $('#perspective_n').val() + ')';
					  $('<?php echo $_REQUEST['id'];?>').css('transform', bVal);
					  
					  <?php
					  foreach($prefixes as $pre){
					  ?>
					     $('<?php echo $_REQUEST['id'];?>').css('<?php echo $pre;?>Transorm', bVal);
					  <?php
					  }
					  ?>
					  
				      break;
				      case "rotate3d":
				      
					  bVal = 'rotate3d(' + extract_neg_number_from_string($('#transform_x').val()) + ',' + extract_neg_number_from_string($('#transform_y').val()) + ',' + extract_neg_number_from_string($('#transform_z').val()) + ',' + $('#transform_angle').val() + ')';
					 
					  $('<?php echo $_REQUEST['id'];?>').css('transform', bVal);
					  
					  <?php
					  foreach($prefixes as $pre){
					  ?>
					     $('<?php echo $_REQUEST['id'];?>').css('<?php echo $pre;?>Transorm', bVal);
					  <?php
					  }
					  ?>
					  
					  
				      break;
				      case "translate3d":
					  bVal = 'translate3d(' + $('#transform_x').val() + ',' + $('#transform_y').val() + ',' + $('#transform_x').val() + ')';
					  $('<?php echo $_REQUEST['id'];?>').css('transform', bVal);
					  
					  <?php
					  foreach($prefixes as $pre){
					  ?>
					     $('<?php echo $_REQUEST['id'];?>').css('<?php echo $pre;?>Transorm', bVal);
					  <?php
					  }
					  ?>
				      break;
				      case "scale3d":
					  bVal = 'scale3d(' + parseFloat(parseInt(extract_neg_number_from_string($('#transform_x').val())) / 1000, 2)+ ',' + parseFloat(parseInt(extract_neg_number_from_string($('#transform_y').val())) / 1000, 2)+ ',' + parseFloat(parseInt($('#transform_z').val()) / 1000, 2) + ')';
					  
					  $('<?php echo $_REQUEST['id'];?>').css('transform', bVal);
					  
					  <?php
					  foreach($prefixes as $pre){
					  ?>
					     $('<?php echo $_REQUEST['id'];?>').css('<?php echo $pre;?>Transorm', bVal);
					  <?php
					  }
					  ?>
				      break;
				       case "matrix3d":
					  bVal = 'matrix3d(' + $('input[name="matrix_values"]').val();
					  $('<?php echo $_REQUEST['id'];?>').css('transform', bVal);
					  
					  <?php
					  foreach($prefixes as $pre){
					  ?>
					     $('<?php echo $_REQUEST['id'];?>').css('<?php echo $pre;?>Transorm', bVal);
					  <?php
					  }
					  ?>
				      break;
				      case "none":
					bVal = '';
					
					$('<?php echo $_REQUEST['id'];?>').css('transform', bVal);
					  
					  <?php
					  foreach($prefixes as $pre){
					  ?>
					     $('<?php echo $_REQUEST['id'];?>').css('<?php echo $pre;?>Transorm', bVal);
					  <?php
					  }
					  ?>
				      break;
				  
				  
				  
				  
				  }
			      
			      
			      $('#transform').val(bVal);
			      
			      
			      
			      } 
			      
			      
			      
			  </script>
			  