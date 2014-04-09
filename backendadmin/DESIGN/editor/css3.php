			    <script type="text/javascript">
				    <?php include("java.php"); ?>
				    
				    function update_box_shadow(divId){
					  
					      $('<?php echo $_REQUEST['id'];?>').css('boxShadowColor', $('#boxShadowColor').val());
					      $('<?php echo $_REQUEST['id'];?>').css('boxShadowX', $('#boxShadowX').val() );
					      $('<?php echo $_REQUEST['id'];?>').css('boxShadowY', $('#boxShadowY').val() );
					      $('<?php echo $_REQUEST['id'];?>').css('boxShadowBlur',  $('#boxShadowBlur').val() );
					      
					    if( $('#boxShadowSpread').val() === 'inset'){
					       $('<?php echo $_REQUEST['id'];?>').css('boxShadowSpread', $('#boxShadowSpread').val() );
					       
					       
						$('#box-shadow').val($('#boxShadowX').val() + ' ' + $('#boxShadowY').val() + ' ' + $('#boxShadowBlur').val() + ' ' + $('#boxShadowSpread').val() + ' ' + $('#boxShadowColor').val());
					    
					    }else{
					    
					    
					    
					       
					       
					      $('#box-shadow').val($('#boxShadowX').val() + ' ' + $('#boxShadowY').val() + ' ' + $('#boxShadowBlur').val() + ' ' + $('#boxShadowColor').val());
					      
					      $('<?php echo $_REQUEST['id']; ?>').css('boxShadow',$('#boxShadowX').val() + ' ' + $('#boxShadowY').val() + ' ' + $('#boxShadowBlur').val() + ' ' + $('#boxShadowColor').val());
					  
					    }
					  }
					
					      $('#boxShadowColor').val($('<?php echo $_REQUEST['id'];?>').css('boxShadowColor'));
					      
					  
					      $('#boxShadowY').val($('<?php echo $_REQUEST['id'];?>').css('boxShadowY'));
					      $('#boxShadowX').val($('<?php echo $_REQUEST['id'];?>').css('boxShadowX'));
					      $('#boxShadowBlur').val($('<?php echo $_REQUEST['id'];?>').css('boxShadowBlur'));
					      
					      if($('#boxShadowSpread').val() === 'inset'){
					      
						  $('#boxShadowSpread').val($('<?php echo $_REQUEST['id'];?>').css('boxShadowSpread'));
						  
						  $('#box-shadow').val($('#boxShadowX').val() + ' ' + $('#boxShadowY').val() + ' ' + $('#boxShadowBlur').val() + ' ' + $('#boxShadowSpread').val() + ' ' + $('#boxShadowColor').val());
						}else{
						
						     $('#box-shadow').val($('#boxShadowX').val() + ' ' + $('#boxShadowY').val() + ' ' + $('#boxShadowBlur').val() +  ' ' + $('#boxShadowColor').val());
						
						
						}
						
						
						bs_color = $('boxShadowColor').val();
				
				
				$('#boxShadowColor').colorpicker({ 
			
					parts:			'full',
					swatches:		'pantone',
					
					swatchesWidth:	100,  
				colorFormat: 'RGBA',
				color: hexToRgb(bs_color),
				altOnChange: true,
				altProperties:	'boxShadowColor',
				
				draggable:			true,		// Make popup dialog draggable if header is visible.
				duration:			'fast',
				//hsv:				false,
					alpha: true,
					init: function(event, color) {
								
							},
					select: function(event, color) {
							
							    $(this).css('boxShadowColor',color.formatted);
							    
							    
							update_box_shadow('<?php echo $_REQUEST['id'];?>');
							
							
							}
	
				  });
				  var result = $('<?php echo $_REQUEST['id'];?>').css('text-shadow');
					try{
					if(ts_result == result.match(/(-?\d+px)|(rgb\(.+\))/g)){
					  // result => ['rgb(30, 43, 2)', '-4px', '11px', '8px']
					  textShadowColor = ts_result[0];
					      textShadowY = ts_result[1];
					      textShadowX = ts_result[2];
					      textShadowBlur = ts_result[3];
					   }else{
					      
					      textShadowColor = $('#color').val();
					      textShadowY = '0px';
					      textShadowX = '0px';
					      textShadowBlur = '0px';
					      
					      
					      }
					      }catch(oops){
					      textShadowColor = $('#color').val();
					      textShadowY = '0px';
					      textShadowX = '0px';
					      textShadowBlur = '0px';
					      
					      
					      }
					      $('#textShadowY').val(textShadowY);
					      $('#textShadowX').val(textShadowX);
					      $('#textShadowBlur').val(textShadowBlur);
					      $('#textShadowColor').val(textShadowColor);
					      $('#textShadow').val(textShadowX + ' ' + textShadowY + ' ' + textShadowBlur + ' ' + textShadowColor);
					      
					      
					function update_text_shadow_new(){
					    var textShadowColor = $('#textShadowColor').val(),
					      textShadowY = $('#textShadowY').val(),
					      textShadowX = $('#textShadowX').val(),
					      textShadowBlur = $('#textShadowBlur').val();
					    $('#textShadow').val(textShadowX + ' ' + textShadowY + ' ' + textShadowBlur + ' ' + textShadowColor);
					    $('<?php echo $_REQUEST['id'];?>').css('textShadow', $('#textShadow').val());
					
					
					
					}
					
						$('#textShadowColor').colorpicker({ 
			
					parts:			'full',
					swatches:		'pantone',
					
					swatchesWidth:	100,  
				colorFormat: 'RGB',
				color: textShadowColor,
				altOnChange: true,
				altProperties:	'background-color',
				
				draggable:			true,		// Make popup dialog draggable if header is visible.
				duration:			'fast',
				//hsv:				false,
					alpha: true,
					init: function(event, color) {
								
							},
					select: function(event, color) {
							
							    
							    
							update_text_shadow_new();
							
							
							}
	
				  });
				  
				  
				  var result = $('<?php echo $_REQUEST['id'];?>').css('boxReflect');
					try{
					if(ts_result == result.match(/(-?\d+px)|(rgb\(.+\))/g)){
					  // result => ['rgb(30, 43, 2)', '-4px', '11px', '8px']
					  boxReflectDirection = ts_result[0];
					     boxReflectOffset = ts_result[1];
					     
					   }else{
					      
					      boxReflectDirection = '';
					      boxReflectOffset = '';
					      
					      
					   }
					   
					   }catch(oops){
					   
					   
					    boxReflectDirection = '';
					      boxReflectOffset = '';
					   
					   
					   
					   }
					      $('#boxReflectDirection').val(boxReflectDirection);
					      $('#boxReflectOffset').val(boxReflectOffset);
					     
					      $('#boxReflect').val(boxReflectDirection + ' ' + boxReflectOffset);
					      
					     function update_box_reflection(divId){
					     
						    $('<?php echo $_REQUEST['id'];?>').css('boxReflect', $('#boxReflectDirection').val() + ' ' + $('#boxReflectOffset').val());
					       
					     
						    $('#boxReflect').val($('#boxReflectDirection').val() + ' ' + $('#boxReflectOffset').val());
					      
					      
					      
					      }
			    </script> 
			   <table>
			      <tr>
				  <td>
			    
			   <div id="accordian" class="accordion" style="width:310px;"> 
			   
				
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  <h3>Text-Shadow</h3>
				  <div class="panel">
				  
				  <ul>
				      <li>
					    <select id="textShadowX" name="textShadowX" onchange="update_text_shadow_new('<?php echo $_REQUEST['id'];?>');">
					    
						<option value=""></option>
						<?php 
						
						$m = 150;
						while($m >= -150){
						?>
						<option value="<?php echo $m . 'px'; ?>"><?php echo $m . 'px'; ?></option>
						<?php
						$m--;
						}
						?>
					    </select>
				      </li>
				      <li>
					  <select id="textShadowY" name="textShadowY" onchange="update_text_shadow_new('<?php echo $_REQUEST['id'];?>');">
					      <option value=""></option>
						    <?php 
						    
						    $m = 150;
						    while($m >= -150){
						    ?>
						    <option value="<?php echo $m . 'px'; ?>"><?php echo $m . 'px'; ?></option>
						    <?php
						    $m--;
						    }
						    ?>
					  </select>
					  </li>
				      <li>
					    <select id="textShadowBlur" name="textShadowBlur" onchange="update_text_shadow_new('<?php echo $_REQUEST['id'];?>');">
						<option value=""></option>
					    <?php 
						
						$m = 150;
						while($m >= -150){
						?>
						<option value="<?php echo $m . 'px'; ?>"><?php echo $m . 'px'; ?></option>
						<?php
						$m--;
						}
						?>
					    </select>
				      </li>
				      <li>
					  <input type="text" name="textShadowColor" id="textShadowColor" value=""  onkeyup="update_text_shadow('<?php echo $_REQUEST['id'];?>');" />
				      </li>
				   
				   </ul>
				  
				 
					<input type="hidden" name="textShadow" id="textShadow"  class="edit_css_interfaces universal"  title="textShadow" class="other" />
					
					
				  </div>
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
			
				  
			
				
				
				
				
						
						
				<h3>Transfom</h3>
				  <div class="panel" style="width:180px;" id="transform_me">
				  </div>
				  <h3>Transition</h3>
				  <div class="panel" id="transition_me">
				  </div>
				  
				  
				  <h3>Outline Offset</h3>
				  <div class="panel" id="offset_me">
				  </div> 
				  
				  <h3>Box Sizing</h3>
				  <div class="panel" id="boxsize_me">
				  </div>
				  
				  <h3>User Interface</h3>
				  <div class="panel" id="interface_me">
				  </div>
				
				
				</div>	
				
				
				
				</td>
			</tr>
		    </table>
				
			
			
				
				
				
	      
	