
				      <ul>
					  <li>
					    <select name="transition_property" id="transition_property" onchange="javascript: update_transition('<?php echo $_REQUEST['id'];?>');" style="width:50px;float:left;;">
					    
						<option value="none">none</option>
						<option value="all">all</option>
					    
					    </select>
					  </li>
					  <li>
					    <select name="transition_duration" id="transition_duration" onchange="javascript: update_transition('<?php echo $_REQUEST['id'];?>');" style="width:50px;float:left;;">
						
						<?php
						    $s = 0;
						    while($s <= 18000){
						    ?>
						    <option value="<?php echo $s; ?>s"><?php echo $s; ?>sec</option>
						    <?php
						    $s++;
						    }
						 ?>
					    </select>
					  </li>
					  <li>
					    <select name="transition_timing_function" id="transition_timing_function" onchange="javascript: update_transition('<?php echo $_REQUEST['id'];?>');" style="width:50px;float:left;;">
						  
						  <option value="ease">ease</option>
						  <option value="linear">linear</option>
						  <option value="ease-in">ease-in</option>
						  <option value="ease-out">ease-out</option>
						  <option value="ease-in-out">ease-in-out</option>
					    
					    
					    </select>
					  </li>
					  <li>
					    <select name="transition_delay" id="transition_delay" onchange="javascript: update_transition('<?php echo $_REQUEST['id'];?>');" style="width:50px;float:left;;">
					    
						<?php
						    $s = 0;
						    while($s <= 18000){
						    ?>
						    <option value="<?php echo $s; ?>s"><?php echo $s; ?>sec</option>
						    <?php
						    $s++;
						    }
						 ?>
					    
					    
					    </select>
					  </li>
				      </ul>
					  
					<input type="hidden" name="transition" id="transition"     title="transition" class="other" />
					
					<script>
					  
					    tra_str = '';
					    transition_property = $('<?php echo $_REQUEST['id'];?>').css('transition-property');
					    
					    if(!$('#transition_property option[value="' + transition_property + '"]')){
						$('#transition_property').prepend('<option value="' + transition_property + '">' + transition_property + '</option>');
						
					    
					    }
					     $('#transition_property').val(transition_property);
					     
					      var tra=dhtmlXComboFromSelect("transition_property");
					     
					     
					    tra_str += transition_property;
					   
					    
					    transition_duration = $('<?php echo $_REQUEST['id'];?>').css('transition-duration');
					    $('#transition_duration').val(transition_duration);
					 
					    tra_str += ' ' + transition_duration;
					    
					    
					    
					   
					    
					    transition_timing_function = $('<?php echo $_REQUEST['id'];?>').css('transition-timing-function');
					    
					    tra_str += ' ' + transition_timing_function;
					    
					    
					     if($('#transition_timing_function option[value="' + transition_timing_function + '"]').length){
					    
						$('#transition_timing_function').append('<option value="' + transition_timing_function + '">' + transition_timing_function + '</option>');
					    
					    }
						
						$('#transition_timing_function').val(transition_timing_function);
					    
					    
					    
					     var tra_tf=dhtmlXComboFromSelect("transition_timing_function");
					    
					    
					    transition_delay = $('<?php echo $_REQUEST['id'];?>').css('transition-delay');
					    
					    tra_str += ' ' + transition_delay;
					    
					   $('#transition_delay').val(transition_delay);
					   
					   $('#transition').val(tra_str);
					   
					   function update_transition(divId){
					   
					      $('<?php echo $_REQUEST['id']; ?>').css('transition', $('input[name="transition_property"]').val() + ' ' + $('#transition_duration').val() + ' ' + $('input[name="transition_timing_function"]').val() + ' ' + $('#transition_delay').val());
					      
					   
					      $('#transition').val($('input[name="transition_property"]').val() + ' ' + $('#transition_duration').val() + ' ' + $('input[name="transition_timing_function"]').val() + ' ' + $('#transition_delay').val());
					   
					   
					   }
					</script>
				
