			  function perc(b, a) {

			  a = a/100;
			  

			  b = a*b;
			  return Math.round(b);
			  }	    
			      function get_and_set_perc(id, divId){
				    var id;
				    var divId;

					prompt(  $('#' + id).css('width')  );
					prompt(  $('#' + id).css('left')  );


				    }
				    
				    
			try{	    
			  var gr_options_start = $('<?php echo $_REQUEST['id'];?>').css('backgroundImage');
			}catch(pp){ var gr_options_start = 'linear-gradient( top, ' + $('<?php echo $_REQUEST['id'];?>').css('backgroundColor') + ' 100%)'; }
			
				    
			try{	    
				    
			      var colors = $('<?php echo $_REQUEST['id'];?>').css('linearGradientColors_seperate');
			
			}catch(pp){ colors = new Array(); colors[0] = $('<?php echo $_REQUEST['id'];?>').css('backgroundColor'); }
			
			
			
			try{
			      var points = $('<?php echo $_REQUEST['id'];?>').css('linearGradientColors_points');
			}catch(pp){ var points = new Array(); points[0] = '100%'; }
			
			var type = gr_options_start.split("-");
			
			
			$('#gradient_type').val(type[0]);
			
			try{
			    type[1] = type[1].replace('gradient(', '');
			}catch(pp){} 
			
			    
			

				
				
				
				
			$('#my_gradients_begin').html('');
			height = $('#hidden-gradient').css('height');
			
			
				try { 
				
				
				
				palette_in = "[" + palette_in.slice(0,palette_in.length-1) + "]";
				
				
				}catch(nope){}
				
				
				
				
				if(!colors){
				
				var colors = new Array();
				var points =  new Array();
				    colors[0] = $('<?php echo $_REQUEST['id'];?>').css('backgroundColor');
				    colors[1] = $('<?php echo $_REQUEST['id'];?>').css('backgroundColor');
				    if(colors[0] == 'none'){
				    
					colors[0] = 'rgb( 0, 0, 0, 0)';
					colors[1] = 'rgb( 0, 0, 0, 0)';
				    }
				    points[0] = '50%';
				    points[1] = '100%';
				    
				    $('#hidden-gradient').html('');
				   
				
				}
				
				
				basez = $('#my_gradients_begin').css('zIndex');
				if (basez == 'auto'){
				basez = 9999;
				
				}
				
				$('#hidden-gradient').css('width', '180px');
				$('#my_gradients_begin').css('width', '180px');
				
				
				$('#my_gradients_begin').append('<ul style="list-style-type:none;left:-13px;z-index:' + parseInt(basez + 1000) + ';height:' +height+ ';max-width:180px;width:180px;min-width:180px;padding:0;margin:0;position:relative;top:30px;left:0px;"></ul>');
				
				
				$('#hidden-gradient-boxes').html();
				
				
				
				c=0;
				prev_width = 0;
				total_colors = colors.length - 1;
				final_width = extract_number_from_string($('#my_gradients_begin ul').css('width'));
				
				
				while(c < colors.length ){
				
				
				try{
				type[1] = type[1].replace(colors[c], '');
				type[1] = type[1].replace(points[c] + ',', '');
				type[1] = type[1].replace(points[c] + ')', '');
				}catch(pp){}
				
				
				if(c == 0){
				      left = '0px';
				      
					  try{
					      this_width = points[c].replace('%', '');
					  
						width = perc(180, this_width);
					  }catch(pp){ this_width = '180px'; }
				      
				      
				}else{
				      left = prev_width + 'px';
				      
				      if(c === parseInt(total_colors)){
				      
				      	$('.colors_li').each(function(){
					
					    final_width = final_width - extract_number_from_string($(this).css('width'));
					
					});
					    width = final_width;
					  
					    
					    
				      
				      }else{
				      
					try{
					    this_width = points[c].replace('%', '');
					   
					    
					    width = perc(180, parseInt(this_width));
					  }catch(pp){ this_width = '180px'; } 
					   
				      
				      }
				
				}
				total = parseInt(width + prev_width);
				
				
				<?php if($_REQUEST['showOnly'] == 'gradient'){ ?>
				
				      $('#my_gradients_begin ul').append('<li style="height:' +height+ ';display:inline;position:absolute;left:' + left + ';width:' + width + 'px;background:transparent;text-align:right;padding:0;margin:0;" class="colors_li" id="colors_li_' + c + '"><input id="colors[' + c + ']" class="gradient" type="text" style="width:' + width + 'px;height:' +height+ ';border:0;paddding:0;margin:0;background:transparent;font-size:5px;" value="' + colors[ c ] + '" /></li>');
				<?php }else{ ?>
				      $('#my_gradients_begin ul').append('<li style="height:' +height+ ';display:inline;position:absolute;top:15px;left:' + left + ';width:' + width + 'px;background:transparent;text-align:right;padding:0;margin:0;" class="colors_li" id="colors_li_' + c + '"><input id="colors[' + c + ']" class="gradient" type="text" style="width:' + width + 'px;height:' +height+ ';border:0;paddding:0;margin:0;background:transparent;font-size:5px;" value="' + colors[ c ] + '" /></li>');
				
				
				<?php } ?>
				$('#hidden-gradients').append('<input type="hidden" id="color_hidden[' + c + ']" value="' + colors[c] + '" class="hidden-gradient_boxes" />');
				
				
				 $('#colors[' + c + ']').css('width', points[c]);
				 
				 
				 console.log(points[c]);
				
				
				prev_width = width;
				c++;
				
				   
				}
				if(type[1] == ' ' | type[1] == '' | type[1] == '  ' | type[1] == '  ' | !type[1] | !type){
				
				    from_me = 'top';
				
				}else{
				
				    from_me = type[1];
				}
				
				
				$('#gradient_from').val(from_me);
				
				
				if(from_me.match('deg')){
				
				    $('#gradient_from').val('top');
				     $('#deg').val(from_me);
				
				}
				
				$('.colors_li').each(function(){
				    var id = $(this).attr('id');
				   
					$(this).resizable({ 
					  
					   <?php if($_REQUEST['showOnly'] == 'gradient'){ ?>
				
				   
					  minHeight: 50, 
					  maxHeight: 50, 
					  
					  <?php }else{ ?>
					   minHeight: 65, 
					  maxHeight: 65, 
					  
					  <?php } ?>
					  containment: "#my_gradients_begin ul", 
					 
					  stop:function(event,ui){
					
					      refreshGradient( '<?php echo $_REQUEST['id'];?>');
					      
					      
					      } 
					      
					 });
				    
				    });
				
				
				    
				p = 0;
				  $('.gradient').each(function(){
				  
				  
				      g_id = $(this).attr('id');
				    
					$(this).colorpicker({ 
				
						parts:			'full',
						swatches:		'pantone',
						
						swatchesWidth:	100,  
						colorFormat: 'RGBA',
						color: hexToRgb(colors[p]),
						altOnChange: true,
						altProperties:	'background-color, color',
						
						draggable:			true,		// Make popup dialog draggable if header is visible.
						duration:			'fast',
						//hsv:				false,
						alpha: true,
						init: function(event, color) {
									console.log(color.formatted);
								},
						select: function(event, color) {
					
									$(this).val(color.formatted);
									
									refreshGradient('<?php echo $_REQUEST['id'];?>');
								}	      
						
						
		
					  });
					  p++;
				});
				
				
				if(!$('<?php echo $_REQUEST['id'];?>').css('backgroundImage').match(/url/)){
				    $('#hidden-gradient').css('backgroundImage', $('<?php echo $_REQUEST['id'];?>').css('backgroundImage'));
				    $('#hidden-gradient').val( $('<?php echo $_REQUEST['id'];?>').css('backgroundImage'));
				}else{
				
				    $('#hidden-gradient').css('backgroundColor', 'rgb( 0, 0, 0, 0)');
				    $('#hidden-gradient').val('rgb( 0, 0, 0, 0)');
				}
				
				
				
				
				
				
				
				
				  function refreshGradient(divId, remove) {
				   if(remove == 'true'){
					$('.gradient').css('backgroundColor', $('#background-color').val());
					refreshGradient(divId);
					return;
						
					}
				
					  var gradientBody = new Array();
					
					  var divId;
					  
					  if(!divId){
						divId = "<?php echo $_REQUEST['id'];?>";
						}
						
					      
					  var stops  = $('.colors_li').length;
					  
					  if(!$('#gradient_type').val()){
						    g_type = 'linear';
						}else{
						    g_type = $('#gradient_type').val();
						}
					  
					 
					    if(g_type === 'linear'){
						if($('#deg').val() == '0'){
					
						  from_t = $('#gradient_from').val();
						  }else{
						  
						    from_t = $('#deg').val() + 'deg';
						  
						  }
						extra_gr = '';
						
					    }else{
					    
						
						  from_t = $('#gradient_from').val();
						
						
							if($('#shape').val() == ''){
								  prompt('yes');
								    $('#shape').val() == 'circle';
								    
								  }
								  if($('#where').val() == ''){
								    $('#where').val() == 'cover';
								  }
								 
								    extra_gr = ', ' + $('#shape').val() + ' ' + $('#where').val();
					     }
					     
					     
					     
					      
					   
						
						
						
					
					
						
			
						
						
						
						    t = 0;
						       $.each(['-o-', '-moz-', '-webkit-', '-ms-', ''], function() {
						       
						       	  
							  gradientBody[t] = this + g_type + '-gradient(' + from_t + extra_gr;
					    
							      p = 1;
							      y = 0;
							      
							      
							  
								
								$('.gradient').each(function(){
							
								
								 
								 width = $('#colors_li_' + y).css('width');
								offset = $('#colors_li_' + y).css('left');
								  
								  
								  
								  this_total = parseInt(parseInt(extract_number_from_string(width) + extract_number_from_string(offset)));
								  
								  this_perc = this_total/180 * 100;
								  
								  
								console.log(y  + '=>' + width + ' ' + offset + '=' + this_total + '=' + this_perc + ' color => ' + $(this).val());
								
								    this_stop = Math.round(this_perc);
								      
								  
								    if(this == '-ms-'){
								    
								    
									  str2 += '&c_offset[' + parseInt(p-1) + ']=' + this_stop + '&color[' + parseInt(p-1) + ']=' + encodeURIComponent(colors[parseInt(p-1)]);
						  
									    $.getJSON('<?php echo $SITE_URL; ?>include/addons/design_suite/DESIGN/editor/create_ie_gradients.php?' + str2, function(result){
					  
										  $('#ms_filter').val(result.filter);
										  $('#svg').val(result.svg);
									      
									      
									      });
								    }
						 
									
						
									gradientBody[t] += ', ' + $(this).val() + ' ' + this_stop + '%';
								      p++;
								      y++;
						    
								    });
							
								      gradientBody[t] += ')';
								      
								      
								      
								      $(divId).css('backgroundImage', gradientBody[t]);
								      $('#hidden-gradient').css('backgroundImage', gradientBody[t]);
								      $('#new_color').css('backgroundImage', gradientBody[t]);
								      
								 
								      t++;
					    
								  });
						    gradientValue = '';
						    $.each(gradientBody, function(){
						    
							gradientValue += this + ';';
						    
						    });
						    
						    
						    
						    console.log(gradientValue);
						    
						    $('#hidden-gradient').val(gradientValue);
							
					
					    y++;
					
					
				    }
				    
				    
				    
				    
				    
				    
				    
				    
			

			
			
			
			
		
			function insert_a_stop(divId){
			 
			      if(!colors){
				
				var colors = new Array();
				var points =  new Array();
				    colors[0] = $('<?php echo $_REQUEST['id'];?>').css('backgroundColor');
				    colors[1] = $('<?php echo $_REQUEST['id'];?>').css('backgroundColor');
				    if(colors[0] == 'none'){
				    
					colors[0] = 'rgb( 0, 0, 0, 0)';
					colors[1] = 'rgb( 0, 0, 0, 0)';
				    }
				    points[0] = '50%';
				    points[1] = '100%';
				    
				    $('#hidden-gradient').html('');
				   
				
				}
				
			  ind = parseInt(parseInt(colors.length) - parseInt(1));
			  
			  prev = parseInt(ind - 1);
			 
			//    
			
			    start_color = colors[parseInt(prev)];
		
			    end_color = colors[parseInt(ind)];
			     
			     
			    my_color  = blend_colors(start_color, end_color);
			    
			    
			  colors.splice(prev, 0, my_color);
			  points.splice(prev, 0, '20%');
			    
			
			       
				    $('#gradient_type').val(type[0]);
				    $('#my_gradients_begin ul').html('');
				    $('#my_gradients_begin').html('');
			  
			 
				try { 
				
				
				
				palette_in = "[" + palette_in.slice(0,palette_in.length-1) + "]";
				
				
				}catch(nope){}
				
				
				
				
				basez = $('#my_gradients_begin').css('zIndex');
				if (basez == 'auto'){
				basez = 99999;
				
				}
				
				$('#hidden-gradient').css('width', '180px');
				$('#my_gradients_begin').css('width', '180px');
				
				
				$('#my_gradients_begin').append('<ul style="list-style-type:none;z-index:9999999999999;height:40px;max-width:180px;width:180px;padding:0;margin:0;top:0px;background-color:transparent;position:absolute;"></ul>');
				
				
				$('#hidden-gradient-boxes').html();
				
				
				
				c=0;
				prev_width = 0;
				total_colors = colors.length - 1;
				final_width = extract_number_from_string($('#my_gradients_begin ul').css('width'));
				
				
				while(c < colors.length ){
				
				
				
				if(c == 0){
				      left = '0px';
				      
				      
				      this_width = points[c].replace('%', '');
				      width = perc(180, this_width);
				      
				      
				      radius = '6px 0 0 6px';
				}else{
				      left = prev_width + 'px';
				      
				      if(c === parseInt(total_colors)){
				      
				      	$('.colors_li').each(function(){
					
					    final_width = final_width - extract_number_from_string($(this).css('width'));
					
					});
					    width = final_width;
					  
					    
					    radius = '0 6px 6px 0';
				      
				      }else{
					    this_width = points[c].replace('%', '');
					    
					    
					    width = perc(180, parseInt(this_width));
					    
					    radius = '0px';
				      
				      }
				
				}
				total = parseInt(width + prev_width);
				
				<?php if($_REQUEST['showOnly'] == 'gradient'){ ?>
				
				      $('#my_gradients_begin ul').append('<li style="height:' +height+ ';display:inline;position:absolute;left:' + left + ';width:' + width + 'px;" class="colors_li" id="colors_li_' + c + '"><input id="colors[' + c + ']" class="gradient" type="text" value="' + colors[ c ] + '" /></li>');
				<?php }else{ ?>
				      $('#my_gradients_begin ul').append('<li style="height:' +height+ ';display:inline;position:absolute;left:' + left + ';width:' + width + 'px;" class="colors_li" id="colors_li_' + c + '"><input id="colors[' + c + ']" class="gradient" type="text"  value="' + colors[ c ] + '" /></li>');
				
				
				<?php } ?>
		
				$('#hidden-gradients').append('<input type="hidden" id="color_hidden[' + c + ']" value="' + colors[c] + '" class="hidden-gradient_boxes" />');
				
				
				 $('#colors[' + c + ']').css('width', points[c]);
				 
				 
				
				
				
				prev_width = width;
				c++;
				
				   
				}
				
				
				$('.colors_li').each(function(){
				    var id = $(this).attr('id');
				   
					$(this).resizable({ 
					   <?php if($_REQUEST['showOnly'] == 'gradient'){ ?>
				
				   
					  minHeight: 50, 
					  maxHeight: 50, 
					  
					  <?php }else{ ?>
					   minHeight: 65, 
					  maxHeight: 65, 
					  
					  <?php } ?>
					  containment: "#my_gradients_begin ul", 
					 
					  stop:function(event,ui){
					
					      refreshGradient( '<?php echo $_REQUEST['id'];?>');
					      
					      
					      } 
					      
					 });
				    
				    });
				
				
				    
				p = 0;
				  $('.gradient').each(function(){
				  
				  
				      g_id = $(this).attr('id');
				    
					$(this).colorpicker({ 
				
						parts:			'full',
						swatches:		'pantone',
						
						swatchesWidth:	100,  
						colorFormat: 'RGBA',
						color: hexToRgb(colors[p]),
						altOnChange: true,
						altProperties:	'background-color, color',
						
						draggable:			true,		// Make popup dialog draggable if header is visible.
						duration:			'fast',
						//hsv:				false,
						alpha: true,
						init: function(event, color) {
									console.log(color.formatted);
								},
						select: function(event, color) {
					
									$(this).val(color.formatted);
									refreshGradient('<?php echo $_REQUEST['id'];?>');
								}	      
						
						
		
					  });
					  p++;
				});
				
				
				
				
			 
			 }
		
			$('#my_gradients_begin ul').sortable({stop:function(){
			
			    
			
			
			}});
			
			
			
				