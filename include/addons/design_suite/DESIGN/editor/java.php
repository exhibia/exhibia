  
			 
<?php
include("../../../../../config/config.inc.php");
 $pm = array('margin', 'padding');
 $units = array('px', 'pt', 'em', 'mm', 'cm', 'in', 'pc', '%', 'auto', 'inherit');
 $sides = array('top', 'bottom', 'left', 'right');
$units = array('px', 'pt', 'em', 'mm', 'cm', 'in', 'pc', '%');
$b_types = array('solid', 'dashed', 'dotted', 'groove', 'double', 'inset', 'outset', 'inherit', 'ridge', 'none');
 $variants = array('normal', 'small-caps', 'inherit'); 
 $weights = array('normal', 'bold', 'bolder', 'lighter', '100','200', '300','400', '500', '600', '700', '800', '900'); 	 
 $sides2 = array('top-left', 'top-right', 'bottom-right', 'bottom-left');
 $outline_types = array('border', 'outline');
 
 
?>


 			<?php include("gradient_java.php"); ?>
			
			
			
			function get_rgb_components(rgb){
			
			

			  rgb = rgb.substring(5, rgb.length-1).replace(/ /g, '').split(',');
			  
			    return rgb;
         
			}
			
			function blend_colors(start_color, end_color, steps){
			
			    var start_comp = get_rgb_components(start_color);
			    var end_comp = get_rgb_components(end_color);
			    
			    if(!steps){
			    
				steps = 2;
			      }
				
				redStepAmount = Math.round(parseInt(parseInt(start_comp[0]) + parseInt(end_comp[0])) / parseInt(steps));

				if(isNaN(redStepAmount)){
				  redStepAmount = '0';
				  }
				
				greenStepAmount = Math.round(parseInt(parseInt(start_comp[1]) + parseInt(end_comp[1])) / parseInt(steps));
				  if(isNaN(greenStepAmount)){
				      greenStepAmount = '0';
				  }
				
				blueStepAmount = Math.round(parseInt(parseInt(start_comp[2]) + parseInt(end_comp[2])) / parseInt(steps));
				  if(isNaN(blueStepAmount)){
				      blueStepAmount = '0';
				  }
							
				if(start_comp.length == 4 && end_comp[3].length ==4){
				  
				    
				    aStepAmount = Math.round(parseInt(parseInt(start_comp[3]) + parseInt(end_comp[3]) / parseInt(steps)));

				      return 'rgba( ' + redStepAmount + ', ' + greenStepAmount + ', ' + blueStepAmount + ', ' + aStepAmount + ')';
				      }else{
				      
				      return 'rgba( ' + redStepAmount + ', ' + greenStepAmount + ', ' + blueStepAmount + ')';
				      
				      
				      }
				
			
			}
			



 <?php
 
			    switch($_REQUEST['switch']){
 
			      case 'position':
 ?>
 
				function get_position_from_browser(divId){
			    	      if($(divId).offset()){
					  var position = $( divId).offset();
				      }else{
					var position;
					position = new Array();
					position.left = '0px';
					position.left = '0px';
					  
					  
				      }
      
				      if($(divId).position()){
					  var position_r = $(divId).position();
				      }else{
					var position_r;
					position_r = new Array();
					position_r.left = '0px';
					position_r.top = '0px';
				      
				      }
				   
				    $('#xa').val(Math.round(position.left));
				    $('#ya').val(Math.round(position.top));
			      
				    $('#yr').val(Math.round(position_r.top));
				    $('#xr').val(Math.round(position_r.left));
				    $('#z-index').val($(divId).css('zIndex'));
				}  
				
				
				get_position_from_browser('<?php echo $_REQUEST['id'];?>');
				
				
			      $('#position').val($('<?php echo $_REQUEST['id'];?>').css('position'));
			      
			      
			      if($('#position option:selected').val() == 'relative'){
			     
				$('.coordinates-a').css('display', 'none');
				$('.coordinates-r').css('display', 'block');
				$('.coordinates-r .accordion div').addClass('open');
			      }else{
			      
				$('.coordinates-r').css('display', 'none');
				$('.coordinates-a').css('display', 'block');
				$('.coordinates-a .accordion div').addClass('open');
			      
			      }
			      
			      
			  //    update_property('<?php echo $_REQUEST['id'];?>', 'position');
			      function update_z_index(divId, lVal){
				      
				      $( divId).css('zIndex', lVal);
				    


				  }
				function get_property(property){
				     property = property.split("-");
				     newProperty = property[0];
				     arr_length = property.length;
				       p = 1;
				     while(p < arr_length){
					newProperty += ucfirst(property[p]);
					
					
				       p++;
				    }
				    return newProperty;
				
				
				}
				
				function update_property(divId, property){
   
				switch(property){
				
				
				    case 'position':
				    if($( divId).css(property, $('#position').val())){
				    
				    
				    
				      $( divId).css(property, $('#position').val());
					
					    switch($('#position').val()){
					    
						case 'relative':
						  $('.coordinates-a').css('display', 'none');
						  $('.coordinates-r').css('display', 'block');
						  update_left(divId, $('#xr').val());
						  update_top(divId, $('#yr').val());
						  update_z_index(divId, $('#z-index').val());
						break;
						case 'absolute':
						  $('.coordinates-r').css('display', 'none');
						  $('.coordinates-a').css('display', 'block');
						  update_left(divId, $('#xa').val());
						  update_top(divId, $('#ya').val());
						  update_z_index(divId, $('#z-index').val());
						break;
					    
					    
					    }
					}
				
				    break;
				
				
				
				}



			      }
	
<?php
			      break;
		
			      case 'background':
 ?>
 
 
			<?php
			if(empty($_REQUEST['showOnly'])){
			?>	
				function get_background(id){
				str = '';
					    
					    if($('<?php echo $_REQUEST['id'];?>').css('backgroundColor')){
						str += $('<?php echo $_REQUEST['id'];?>').css('backgroundColor');
						
						 $('#background-color').css('background-color', $('<?php echo $_REQUEST['id'];?>').css('background-color'));
					    }else{
					    
						str += '';
					    }
					   
					    if($('<?php echo $_REQUEST['id'];?>').css('backgroundUrl')){
					      str += ' url(' + $('<?php echo $_REQUEST['id'];?>').css('backgroundUrl') + ')';
					    }else{
					    
					      str += ' url()';
					    }
					    if($('<?php echo $_REQUEST['id'];?>').css('backgroundRepeat')){
					      str += ' ' + $('<?php echo $_REQUEST['id'];?>').css('backgroundRepeat');
					    }
					    if($('<?php echo $_REQUEST['id'];?>').css('backgroundAttachment')){
					      str += ' ' + $('<?php echo $_REQUEST['id'];?>').css('backgroundAttachment');
					    }
					    if($('<?php echo $_REQUEST['id'];?>').css('backgroundPosition')){
					      str += ' ' + $('<?php echo $_REQUEST['id'];?>').css('backgroundPosition');
					    }
					
					 
					  if(!str.match(/undefined/)){
					     try{ document.getElementById('background-color').value = str;
					     }catch(oops){ document.getElementById('background-color').value = 'rgba(0,0,0,0) url()'; }
					  }else{
					  str = '';
					  }
					  console.log('enabling bacckground with ' + str);
				}



			      if($('<?php echo $_REQUEST['id']; ?>').css('backgroundPosition').length >= 1){
				      
					  $('#backgroundPosition').val($('<?php echo $_REQUEST['id']; ?>').css('backgroundPosition'));
				      
				      
				      
				      }
				      
				      function update_background_position(divId, bVal){
				      
					    $('<?php echo $_REQUEST['id']; ?>').css('backgroundPosition', bVal);
				      
				      }
				  
					$('#background-repeat').val($('<?php echo $_REQUEST['id'];?>').css('backgroundRepeat'));
					$('#background-attachment').val($('<?php echo $_REQUEST['id'];?>').css('backgroundAttachment'));
					function update_background_repeat(divId, bVal){
					    $(divId).css('backgroundRepeat', $('#background-repeat').val());
					    
					
					
					}
					function update_background_attachment(divId, bVal){
					
					
					    $(divId).css('backgroundAttachment',  $('#background-attachment').val());
					    
					
					
					
					}
					function update_background_color_from_picker(divId, bVal){
					
					    $(divId).css('backgroundImage', 'url()');
					 
					   
					   $(divId).css('backgroundAttachment', '');
					 
					    
					    
					    $('.gradient').each(function(){
					    
						var gr_id = $(this).attr('id');
					  
						    
						  $('#' + gr_id).val(bVal);
						  $('#' + gr_id).css('backgroundColor', bVal);
						  $('#' + gr_id).css('top', '-10px;');
					    });
					    refreshGradient('#hidden-gradient');
					    refreshGradient(divId);
					$(divId).css('backgroundColor', bVal);
					$(divId).css('linearGradient', '');
					
					}
					  function createUploader(){
        
        
          

						    var uploader = new qq.FileUploader({

						      // pass the dom node (ex. $(selector)[0] for jQuery users)
							element: document.getElementById('upload-button-logo'),
						      // path to server-side upload script
							action: '<?php echo $_SITE_URL;?>include/addons/uploader/uploadify.php',
						      // validation
						      // ex. ['jpg', 'jpeg', 'png', 'gif'] or []
							allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
						      // each file size limit in bytes
						      // this option isn't supported in all browsers
							sizeLimit: 0, // max size
							minSizeLimit: 0, // min size
						      // set to true to output server response to console
							debug: true,
							multiple: false,


							    params: {
	      'type': 'background', 
	      'path': '<?php echo @ $SITE_URL;?>css/<?php echo $template;?>/'},



							onSubmit: function(id, fileName){


							    },

							onProgress: function(id, fileName, loaded, total){
							    var progress = (loaded / total) * 100;


							     // $("#progress").progressbar({value: progress});


							},
							onComplete: function(id, fileName, responseJSON){ 

							    str = '';
					    
							    					    
							    if( $('<?php echo $_REQUEST['id'];?>').css('background-color') != 'undefined' & $('<?php echo $_REQUEST['id'];?>').css('background-color') != ''){
								str += hexToRgb($('<?php echo $_REQUEST['id'];?>').css('background-color'));
								
							    }else{
							    
								str += 'rgba(0, 0, 0, 0)';
							    }
							    if(str == 'undefined'){
							    
								str += 'rgba(0, 0, 0, 0)';
							    }
								str += ' url(<?php echo $SITE_URL;?>css/<?php echo $template;?>/' + fileName + ')';
								
								if($('<?php echo $_REQUEST['id'];?>').css('backgroundRepeat')){
								  str += ' ' + $('<?php echo $_REQUEST['id'];?>').css('backgroundRepeat');
								}
								if($('<?php echo $_REQUEST['id'];?>').css('backgroundPosition')){
								  str += ' ' + $('<?php echo $_REQUEST['id'];?>').css('backgroundPosition');
								}
							      
							var str = str.replace('undefined', '');     
							   
 
							   //$('#background').val(str);
							   $('<?php echo $_REQUEST['id'];?>').css('backgroundImage',  '');
							 
							 //  $('#gradient').val();
							   $('#background-color').val('rgba(0, 0, 0, 0)');
							   $('<?php echo $_REQUEST['id'];?>').css('background-color', 'rgba(0, 0, 0, 0)');
							   
							   
							   $('<?php echo $_REQUEST['id'];?>').css('backgroundImage', 'url(<?php echo $SITE_URL;?>css/<?php echo $template;?>/' + fileName + ')');
							   //$('.qq-upload-success').css('display', 'none');
   

						},
							onCancel: function(id, fileName){},
        // messages
							messages: {
							  typeError: "{file} has invalid extension. Only {extensions} are allowed.",
							  sizeError: "{file} is too large, maximum file size is {sizeLimit}.",
							  minSizeError: "{file} is too small, minimum file size is {minSizeLimit}.",
							  emptyError: "{file} is empty, please select files again without it.",
							  onLeave: "The files are being uploaded, if you leave now the upload will be cancelled."
							  },
							showMessage: function(message, fileName, extensions, sizeLimit, minSizeLimit){
								$('#dialog').html(message);
								$('#dialog').dialog();
							  }

						  });
					}

				      // in your app create uploader as soon as the DOM is ready
				      // don't wait for the window to load
				    createUploader();
	 bg_color = $('<?php echo $_REQUEST['id'];?>').css('backgroundColor');
			   
			   
			      my_color = hexToRgb(bg_color);
			      
			       $('#background-color').colorpicker({ 
			
					parts:			'full',
					swatches:		'pantone',
					
					swatchesWidth:	100,  
				colorFormat: 'RGBA',
				color: hexToRgb(my_color),
				altOnChange: true,
				altProperties:	'background-color, color',
				
				draggable:			true,		// Make popup dialog draggable if header is visible.
				duration:			'fast',
				//hsv:				false,
					alpha: true,
					init: function(event, color) {
								},
					select: function(event, color) {
					
								my_color = color.formatted;
								
								
							  update_background_color_from_picker('<?php echo $_REQUEST['id'];?>', my_color);
							}
	
				  });
			
				  
				  try {
				      opacity =parseInt($( "<?php echo $_REQUEST['id'];?>" ).css('opacity')) * 100;
				    
				  
				  }catch(noopacity){
				  
				      opacity = 100;
				  }

					
			
				<?php } ?>
	 
<?php
			      break;
			      case 'padding':
			      
			      ?>
			     
				
				<?php
				      foreach($pm as $m){
				      ?>
				       function update_these_<?php echo $m;?>s(divId, bType){
					  str = $(divId).css('<?php echo $m;?>-top');
					    
					    str += ' ' + $(divId).css('<?php echo $m;?>-right');
					    
					    str += ' ' + $(divId).css('<?php echo $m;?>-bottom');
					    
					    str += ' ' + $(divId).css('<?php echo $m;?>-left');
					    
					    
					    if(!str.match(/undefined/)){
					       $('#<?php echo $m; ?>').val(str);
					      }else{
					      str = '';
					      }
				
				}
				
				function update_<?php echo $m;?>(divId, bVal){
      
				    $(divId).css('margin', bVal);
				    <?php
					foreach($sides as $side){
				      ?>
				      
				      $('#<?php echo $m;?><?php echo ucfirst($side); ?>').val(extract_number_from_string($(divId).css('<?php echo $m;?><?php echo ucfirst($side); ?>')));
				       
				      
				      
				      var si =  extract_text_from_string($(divId).css('<?php echo $m;?><?php echo ucfirst($side); ?>'));
				     // prompt('#<?php echo $m;?><?php echo ucfirst($side);?>Unit');
						$('#<?php echo $m;?><?php echo ucfirst($side);?>Unit').val(si);
				      <?php } ?>
				  
				}
				
				<?php
					  foreach($sides as $side){
					  
					  
					  
					  ?>
					       document.getElementById('<?php echo $m;?><?php echo ucfirst($side); ?>').value = extract_number_from_string($('<?php echo $_REQUEST['id'];?>').css('<?php echo $m;?><?php echo ucfirst($side); ?>'));
				        
				      
				        
				        
					$('#<?php echo $m;?><?php echo ucfirst($side); ?>Unit').val(extract_text_from_string($('<?php echo $_REQUEST['id'];?>').css('<?php echo $m;?><?php echo ucfirst($side); ?>')));
				      
				 
				 
				      function update<?php echo $m; ?><?php echo ucfirst($side);?>(divId, bType, bVal){
				    
					if(isNaN($('#<?php echo $m; ?><?php echo ucfirst($side);?>').val())){
					
					  alert("<?php echo $m; ?><?php echo ucfirst($side);?> for <?php echo $_REQUEST['id'];?> must be numeric");
					  
					}else{
					  $('<?php echo $_REQUEST['id'];?>').css('<?php echo $m; ?>-<?php echo $side;?>', $('#<?php echo $m; ?><?php echo ucfirst($side);?>').val() + $('#<?php echo $m;?><?php echo ucfirst($side); ?>Unit').val()) ;
				    //  prompt($('#<?php echo $m; ?><?php echo ucfirst($side);?>').val() + $('#<?php echo $m;?><?php echo ucfirst($side); ?>Unit').val());
					  update_these_<?php echo $m;?>s(divId, bType);
					  
					}
				      
				      }
				      
				      
				      <?php
					  
					  
					  
					  
					  
					  
					  
					  }
				      
				      
				      
				      }
			
			      break;
			      case 'borders':
 ?>

				    var test_radius_type = false;    
				
						  jQuery.support.borderRadius = false;
							jQuery.each(['BorderRadius','MozBorderRadius','WebkitBorderRadius','OBorderRadius','KhtmlBorderRadius'], function() {
							    if(document.body.style[this] !== undefined){
							    
								  jQuery.support.borderRadius = true;
								  test_radius_type = this;
								    return (!jQuery.support.borderRadius);
							      
							      }
							  });
						
					var my_borders = new Array();
					
					
					if(test_radius_type != false){
					
						
					
							 if(test_radius_type == 'KhtmlBorderRadius'){
							      prompt($('<?php echo $_REQUEST['id']; ?>').css('border-radius-top-left'));
							  }else if(test_radius_type == 'OBorderRadius'){
							      prompt($('<?php echo $_REQUEST['id']; ?>').css('OBorderRadius'));
							  
							  }else if(test_radius_type == 'MozBorderRadius'){
							      prompt($('<?php echo $_REQUEST['id']; ?>').css('MozBorderRadius'));
							  
							  }else if(test_radius_type == 'WebkitBorderRadius'){
							  
							  
							      try{
							      my_borders = $('<?php echo $_REQUEST['id']; ?>').css('borderRadius').split(' ');
							      }catch(oo){}
							  
							  }else if(test_radius_type == 'BorderRadius'){
							  
							  prompt($('<?php echo $_REQUEST['id']; ?>').css('borderRadius'));
							  
							  }
							  
							
					
					}else{
					//alert('Your Browser is not currently supported');
					
					
					
					}
				
							 
							  
							 if(my_borders.length == 1){
							 
							    top_left = my_borders[0];
							    top_right = my_borders[0];
							    bottom_right = my_borders[0];
							    bottom_left = my_borders[0];
							 
							 }else{
							    top_left = my_borders[0];
							    top_right = my_borders[1];
							    bottom_right = my_borders[2];
							    bottom_left = my_borders[3];
							 
							 
							 }
					<?php
					
					foreach($outline_types as $outline_type){
					    foreach($sides as $side){
					    ?>
							 function update<?php echo ucfirst($outline_type); ?><?php echo ucfirst($side); ?>(divId, color){
						if(color){
							$('<?php echo $_REQUEST['id'];?>').css('<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Color', color);
							}
							
							$('<?php echo $_REQUEST['id'];?>').css('<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Style', $('#<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Style').val());
							
							
							
							$('<?php echo $_REQUEST['id'];?>').css('<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Width', $('#<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Width').val() + $('#<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Unit').val());
							
							
					  }
				
				try{
					       $('#<?php echo $outline_type;  ?><?php echo ucfirst($side);?>Width').val(extract_number_from_string($('<?php echo $_REQUEST['id'];?>').css('<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Width')));
					       
					       
					      $('#<?php echo $outline_type;  ?><?php echo ucfirst($side);?>Unit').val(extract_text_from_string($('<?php echo $_REQUEST['id'];?>').css('<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Width')));
					
					  
					 // selected.selectedIndex[si] = true;
					  
					  
					  
					     $('#<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Style').val($('<?php echo $_REQUEST['id'];?>').css('<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Style'));
					      
					     $('#<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Color').val($('<?php echo $_REQUEST['id'];?>').css('<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Color'));
					      
					}catch(oops){}      
					  
				/*   $('#<?php echo $outline_type;  ?><?php echo ucfirst($side); ?>Color').spectrum({
					  showInput: true,
					  showInitial: true,
					  palette: values.color,
					  showInput: true,
					  showInitial: true,
					  showSelectionPalette: true,
					
					  preferredFormat: "rgb",
					  color: $('<?php echo $_REQUEST['id'];?>').css('<?php echo $outline_type;  ?>-<?php echo $side; ?>-color'),
					  showPalette: true,
					 
	
					  
					
					  move: function(color) {
					
					    update<?php echo ucfirst($outline_type); ?><?php echo ucfirst($side); ?>('<?php echo $_REQUEST['id'];?>',color);
					  }
				   
				  });*/
				  
				  
				my_color = $('<?php echo $_REQUEST['id'];?>').css('<?php echo $outline_type; ?><?php echo ucfirst($side); ?>Color');
				
				
				$('#<?php echo $outline_type; ?><?php echo ucfirst($side); ?>Color').colorpicker({ 
			
					parts:			'full',
					swatches:		'pantone',
					
					swatchesWidth:	100,  
				colorFormat: 'RGB',
				color: my_color,
				altOnChange: true,
				altProperties:	'background-color, color',
				
				draggable:			true,		// Make popup dialog draggable if header is visible.
				duration:			'fast',
				//hsv:				false,
					alpha: true,
					init: function(event, color) {
								
							},
					select: function(event, color) {
							
							    $(this).css('background-color',color.formatted);
							    
							    
							update<?php echo ucfirst($outline_type); ?><?php echo ucfirst($side); ?>('<?php echo $_REQUEST['id'];?>', color.formatted);
							
							
							}
	
				  });
	
<?php


				  
				  }
				  
			}
			
			foreach($sides2 as $side2){
						?>
						
						
						
						    function border_<?php echo str_replace("-", "_",$side2); ?>_radius(divId, bVal){
						      var test_radius_type;
						    
						      
						     // $('<?php echo $_REQUEST['id'];?>').css('border-<?php echo $side2;?>-radius', bVal);
							  
							  
						      <?php $pre = array('webkit', 'moz', 'o', 'ms', 'khtml'); 
						      
						      $str = explode("-", $side2);
						      
							  foreach($pre as $prefix){
							  ?>
							      try{
								  $('<?php echo $_REQUEST['id'];?>').css('-<?php echo $prefix;?>-border-<?php echo $side2;?>-radius', bVal);
							      }catch(<?php echo $prefix; ?>){}
							  <?php
							  }
						      
						      
						      ?>
						      try{
						        $('<?php echo $_REQUEST['id'];?>').css('border-<?php echo $side2;?>-radius', bVal);
							  }catch(no){}
							  
							  update_border_radius_new();
						    
						    }
						
							  
							  
							  
							
							  
							  
							  
							  $('#border-radius-<?php echo $side2; ?>').val(<?php echo str_replace("-", "_", $side2);?>);
							  
							 
							  update_border_radius_new();
							  
							//  var r_<?php echo ucfirst($side2); ?>_=dhtmlXComboFromSelect("border<?php echo ucfirst($side2); ?>Radius");
							  
						     
						
						
						
						<?php
						
						}
						?>
						function update_border_radius_new(){
						     var str_b = '';
							    <?php
							  foreach($sides2 as $side2){
							  ?>
							  try{
							      str_b += $('#border-radius-<?php echo $side2; ?>').val() + ' ';
							  }catch(oops){}
							  
							  <?php } ?>
						      try{
						      $('#border-radius-hidden').val(str_b);
						      }catch(oops){}
						}
						
						<?php
			      break;
			      case 'fonts':
 ?>
  
				  
				  for(var f=0; f<fonts_used.length; f++){
				 
				      $('#font-family').append('<option style="font-family:' + values.fontFace[f] + ';" value="' + values.fontFace[f] + '">' + values.fontFace[f] + '</option>');
				  
				  
				  }
				  $('#font-style').val($('<?php echo $_REQUEST['id'];?>').css('fontStyle'));
				  $('#font-weight').val($('<?php echo $_REQUEST['id'];?>').css('fontWeight'));
				  $('#font-family').val($('<?php echo $_REQUEST['id'];?>').css('fontFace'));
				  var font_size = $('<?php echo $_REQUEST['id'];?>').css('fontSize');
				
				  $('#font-size').val(extract_number_from_string($('<?php echo $_REQUEST['id'];?>').css('fontSize')));
				  $('#fontSizeUnit').val(extract_text_from_string($('<?php echo $_REQUEST['id'];?>').css('fontSize')));
				  
				  
				  $('#color').val($('<?php echo $_REQUEST['id'];?>').css('fontColor'));
				  
				  
				  
				
				/*  $('#color').spectrum({ 
			
					  color: hexToRgb($('<?php echo $_REQUEST['id'];?>').css('color')),
					  palette: values.color ,
					  showInput: true,
					  showInitial: true,
					  showSelectionPalette: true,
					  preferredFormat: "rgba",
					  
					  showPalette: true,
					  move: function(color) {
					     
					      update_font_color('<?php echo $_REQUEST['id'];?>', color.toHexString());
					  }
				      
					
	
				  });
				  */
			f_color = $('<?php echo $_REQUEST['id'];?>').css('color');
			   
			   
			     
			      
			       $('#color').colorpicker({ 
			
					parts:			'full',
					swatches:		'pantone',
					
					swatchesWidth:	100,  
				colorFormat: 'RGB',
				color: f_color,
				altOnChange: true,
				altProperties:	'background-color, color',
				
				draggable:			true,		// Make popup dialog draggable if header is visible.
				duration:			'fast',
				//hsv:				false,
					alpha: true,
					init: function(event, color) {
								
							},
					select: function(event, color) {
								$('#color').css('background-color', color.formatted);
							      $('#color').css('color', color.formatted);
							  
							  update_font_color('<?php echo $_REQUEST['id'];?>', color.formatted);
							}
	
				  });
	
<?php
			      break;
			      case 'css3':
 ?>

	
<?php
			      break;			      
			      case 'dimensions':
 ?>

			<?php $sql_width = db_query("select * from style_sheets where select = '$_REQUEST[id]' and template = '$_REQUEST[template]' and (property = 'width' or property = 'height') and (width = 'auto' or height = 'auto')");
			
			    if(db_num_rows($sql_width) == 0){
			    ?>
		
			   width = $('<?php echo $_REQUEST['id'];?>').css('width');
			   
			   
			   height = $('<?php echo $_REQUEST['id'];?>').css('height');
			   
			   $('#height').val(extract_number_from_string(height));
			   $('#width').val(extract_number_from_string(width));
			   $('#heightUnit').val(extract_text_from_string(height));
			   $('#widthUnit').val(extract_number_from_string(width));
			   
			   
			   <?php }else{ ?>
			      width = 'auto';
			      height = 'auto';
			       $('#height').val('');
				$('#width').val('');
				$('#height').css('display', 'none');
				$('#width').css('display', 'none');
				
				
				$('#heightUnit').val('auto');
				$('#widthUnit').val('auto');
				
			   <?php } ?>
	
<?php
			      break;			      
			      
			      
		
			    }
		
		    
					     
		
 ?>

 
 
				function ucfirst (str) {
				  // http://kevin.vanzonneveld.net
				  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
				  // +   bugfixed by: Onno Marsman
				  // +   improved by: Brett Zamir (http://brett-zamir.me)
				  // *     example 1: ucfirst('kevin van zonneveld');
				  // *     returns 1: 'Kevin van zonneveld'
				  str += '';
				  var f = str.charAt(0).toUpperCase();
				  return f + str.substr(1);
				}
				
				
				
				
					  
				  $('.accordion h3').bind('click', function(event){
				  var id = $(this).parent().attr('id');
				  if(id == 'dimensions-accordion'){
				      $('#background-accordion .panel').css('display', 'none');
				  
				  
				  }
				  if(id == 'background-accordion'){
				      $('#dimensions-accordion .panel').css('display', 'none');
				  
				  
				  }
				  if(id == 'outline-accordion'){
				      $('#border-accordion .panel').css('display', 'none');
				  
				  
				  }
				  if(id == 'border-accordion'){
				      $('#outline-accordion .panel').css('display', 'none');
				  
				  
				  }
				  if(!$('#' + id + ' .panel').hasClass('nope')){
				      $('#' + id + ' .panel').css('display', 'none');
				      $(this).next('.panel').css('display', 'block');
				      }
				      });
				
function update_background_size(selector){
b_size_str = '';
    if($('#backgroundSizeUnit-x').val() != 'auto'){
      b_size_str = b_size_str + $('#background-size-x').val() + $('#backgroundSizeUnit-x').val();
    }else{
      b_size_str = b_size_str + 'auto';
    }

  if($('#backgroundSizeUnit-y').val() != 'auto'){
     b_size_str = b_size_str + ' ' + $('#background-size-y').val() + $('#backgroundSizeUnit-y').val();
   }else{
      b_size_str = b_size_str + ' auto';
    }
  $(selector).css('backgroundSize', b_size_str);

}