			  <script>
				<?php include("java.php"); ?>
				
			   $('#opacity').slider({
					step: '5',
					range: "min",
					min: '0',
					max: '100',
					
					value: opacity,
					slide: function( event, ui ) {
				//prompt(ui.value);
					    $( "<?php echo $_REQUEST['id'];?>" ).css('opacity', ui.value / 100 );
					  //  $('#hidden-opacity').val($( "<?php echo $_REQUEST['id'];?>" ).css(parseInt(ui.value) / 100));
					}
					});				var result = $('<?php echo $_REQUEST['id'];?>').css('text-shadow');
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
				  $('#text-align').val($('<?php echo $_REQUEST['id'];?>').css('text-align'));
						 
						 function update_align(divId){
					
						    $(divId).css('text-align', $('#text-align').val());
					
						  }
					
						function update_indent(divId, lVal){
	  
						  if(isNaN($('#text-indent-value').val())){
						  
						      alert("text indent should be numerical");
						  }else{
						      $( divId).css('textIndent', $('#text-indent-value').val() + $('#text-indent').val());
						    
						

						    }

						  }
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
				  
				  $('#text-align').val($('<?php echo $_REQUEST['id'];?>').css('textAlign'));
						 
						 function update_align(divId){
					
						    $(divId).css('textAlign', $('#text-align').val());
					
						  }
					
						function update_indent(divId, lVal){
	  
						  if(isNaN($('#text-indent-value').val())){
						  
						      alert("text indent should be numerical");
						  }else{
						      $( divId).css('textIndent', $('#text-indent-value').val() + $('#text-indent').val());
						    
						

						    }

						  }
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
				  
				
			  </script>
					<div class="accordion" id="misc-accordion">
					  <h3>Text-Align</h3>
					   <div class="panel">
					     
					  
					      <select name="text-align" id="text-align"  onchange="javascript: update_align('<?php echo $_REQUEST['id'];?>', this.value);"  title="text-align" class="other" style="float:left;">
						  <option value="center">center</option>
						  <option value="left">left</option>
						  <option value="right">right</option>
					      </select>
					    
					      
					  </div>
			<?php
					$units = array('px', 'pt', 'em', 'mm', 'cm', 'in', 'pc', '%');
					
					?>
					
		
				   
					  
				
						<h3>Text-Indent</h3>
						    
					  <div class="panel">
						
						    <input type="text"  name="text-indent-value" id="text-indent-value" onkeyup="javascript: update_indent('<?php echo $_REQUEST['id'];?>', this.value);"  title="text-indent-value" style="float:left;width:25px;" /> 
						 
						    <select name="text-indent" id="text-indent"  onkeyup="javascript: update_indent('<?php echo $_REQUEST['id'];?>', this.value);"  title="text-indent" class="other" style="width:40px;">
						    <?php
						    foreach($units as $unit){
						    ?>
						      <option value="<?php echo $unit;?>"><?php echo $unit;?></option>
						    <?php } ?>
						    </select>
					    </div>
					    
					    
					    
					    
					    
					    
					    
					
				 <h3>Box-Reflect</h3>
				  <div class="panel">
				      <ul>
					  <li>
					      <select name="boxReflectDirection" id="boxReflectDirection" onchange="update_box_reflection('<?php echo $_REQUEST['id'];?>');">
						  <option value=""></option>
						  <option value="above">above</option>
						  <option value="below">below</option>
						  <option value="left">left</option>
						  <option value="right">right</option>
					      </select>
					  </li>
					  <li>
					      <select name="boxReflectOffset" id="boxReflectOffset" onchange="update_box_reflection('<?php echo $_REQUEST['id'];?>');">
						  <option value="0">0</option>
						    <?php 
						    
						    $m = 1800;
						    while($m >= -1800){
						    ?>
						    <option value="<?php echo $m . 'px'; ?>"><?php echo $m . 'px'; ?></option>
						    <?php
						    $m--;
						    }
						    ?>
						  
						</select>
					  </li>
				      </ul>
					<input type="hidden" name="boxReflect" id="boxReflect"  class="edit_css_interfaces universal"  onkeyup="javascript: update_reflect('<?php echo $_REQUEST['id'];?>', this.value);"  title="boxReflect" class="other" />
					
					
					
				  </div>
				        <h3>Opacity</h3>
						    <div class="panel" style="width:180px;">
		  
				
						<div name="opacity" id="opacity" class="other range" style="width:180px;;margin-top:10px;"> </div>
						<input id="hidden-opacity" name="hidden-opacity" value="" type="hidden" />
				      
					      </div>
				  
				    <h3>Box-Shadow</h3>
				  <div class="panel" style="position:relative;top:-15px;">
				  
				  
				  
				  <ul>
				      <li>
					    <select id="boxShadowX" name="boxShadowX" onchange="update_box_shadow('<?php echo $_REQUEST['id'];?>');">
					    
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
					  <select id="boxShadowY" name="boxShadowY" onchange="update_box_shadow('<?php echo $_REQUEST['id'];?>');">
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
					    <select id="boxShadowBlur" name="boxShadowBlur" onchange="update_box_shadow('<?php echo $_REQUEST['id'];?>');">
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
					  <input type="text" name="boxShadowColor" id="boxShadowColor" value=""  onkeyup="update_box_shadow('<?php echo $_REQUEST['id'];?>');" size="1" style="max-width:10px;!important;" onchange="update_box_shadow('<?php echo $_REQUEST['id'];?>');" />
				      </li>
				      <!--<li>
					  <select id="s-inset" name="s-inset">
					    <option value="">outside</option>
					    <option value="inset">inside</option>
				      
					  </select>
				      </li>-->
				      <li>
					  <select id="boxShadowSpread" name="boxShadowSpread"  onchange="update_box_shadow('<?php echo $_REQUEST['id'];?>');">
					    
					    <option value="">outside</option>
					    <option value="inset">inside</option>
						?>
					  </select>
				      </li>
				   </ul>
					<input type="hidden" name="box-shadow" id="box-shadow"  class="edit_css_interfaces universal"  onkeyup="javascript: update_shadow('<?php echo $_REQUEST['id'];?>', this.value);"  title="box-shadow" class="other" />
					
					
				  </div>
				</div>
				
			