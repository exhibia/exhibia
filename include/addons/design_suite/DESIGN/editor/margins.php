 <?php $pm = array('margin');
 $units = array('px', 'pt', 'em', 'mm', 'cm', 'in', 'pc', '%', 'auto', 'inherit');
 
	
			
			
			
			    foreach($pm as $m){
			    ?>
			
			   <h2 style="font-size:13px;margin:0 0 0 0;float:left;padding-bottom:10px;font-size:13px;float:left;"><?php echo ucfirst($m); ?></h2>
			   
			   <a href="javascript: popup_css_help('css/css_margin.asp');" style="float:left;padding-left:20px;font-size:9px;">help</a>
			   <br />
			    
			    <input type="hidden" name="<?php echo $m;?>" id="<?php echo $m;?>" value="" />
			        <div style="float:left;padding-left:10px;width:110px;"  class="edit_css_interfaces advanced">
			      
				
			    
				<!--<input type="text" name="<?php echo $m; ?>" id="<?php echo $m; ?>"  onkeyup="javascript: update_<?php echo $m; ?>('<?php echo $_REQUEST['id'];?>', this.value);"  title="<?php echo $m; ?>" class="other" />-->
			     </div>
			    <script>
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
				      
				      $('#<?php echo $m;?><?php echo ucfirst($side); ?>').val(extract_number_from_string($(divId).css('<?php echo ucfirst($m);?><?php echo ucfirst($side); ?>')));
				       
				      
				      
				      var si =  extract_text_from_string($(divId).css('<?php echo $m;?><?php echo ucfirst($side); ?>'));
				     // prompt('#<?php echo $m;?><?php echo ucfirst($side);?>Unit');
						$('#<?php echo $m;?><?php echo ucfirst($side);?>Unit').val(si);
				      <?php } ?>
				  
				}
				
			    </script>
			   
			    <?php
				foreach($sides as $side){
			?>
				
				
				    <label style="font-size:10px;float:left;width:100px;float:left;"><?php echo ucfirst($m); ?>-<?php echo ucfirst($side); ?>
				      <a href="javascript: popup_css_help('css/css_<?php echo $m; ?>-<?php echo $side;?>.asp');" style="padding-left:2px;font-size:9px;">help</a></label>
				    <br />
				      
				      <input type="text" name="<?php echo $m; ?><?php echo ucfirst($side);?>" id="<?php echo $m; ?><?php echo ucfirst($side);?>"  class="edit_css_interfaces universal"  onkeyup="javascript: update<?php echo $m; ?><?php echo ucfirst($side);?>('<?php echo $_REQUEST['id'];?>', '<?php echo $m; ?><?php echo ucfirst($side);?>', this.value);"  title="<?php echo $m; ?><?php echo ucfirst($side);?>" style="width:40px;float:left;" />
				      
				      <select id="<?php echo $m;?><?php echo ucfirst($side); ?>Unit" name="<?php echo $m;?><?php echo ucfirst($side); ?>Unit" onchange="javascript: update<?php echo $m; ?><?php echo ucfirst($side);?>('<?php echo $_REQUEST['id'];?>', '<?php echo $m; ?><?php echo ucfirst($side);?>', this.value);" style="margin-left:3px;height:28px;width:45px;font-size:16px;float:left;">
				      
					 
				      <?php foreach($units as $unit){ ?>
				      
					  <option value="<?php echo $unit;?>"><?php echo $unit;?></option>
				      
				      <?php } ?>
				      </select>
				
				 <script type="text/javascript">
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
				 </script>
				
			    
			<?php 	} 
			if($m == 'margin'){
			
			?>
			
			
			
				     <script type="text/javascript">
				      
					function update_align(divId){
					
					  $(divId).css('textAlign', $('#text-align').val());
					
					}
				      </script>
					  <div style="width:100px;position:relative;"  class="edit_css_interfaces universal">
					      <label style="font-size:10px;float:left;">Text-Align</label>
					
					      <a href="javascript: popup_css_help('cssref/pr_text_text-indent.asp');" style="float:left;font-size:9px;">help</a><br />
					  
					      <select name="text-align" id="text-align"  onchange="javascript: update_align('<?php echo $_REQUEST['id'];?>', this.value);"  title="text-align" class="other">
						  <option value="center">center</option>
						  <option value="left">left</option>
						  <option value="right">right</option>
					      </select>
					      <script>
						  $('#text-align').val($('<?php echo $_REQUEST['id'];?>').css('textAlign'));
					      </script>
					      
					  </div>
			
			
			
			
			<?php }else{ ?>
			
			
			<?php
					$units = array('px', 'pt', 'em', 'mm', 'cm', 'in', 'pc', '%');
					
					?>
				 
					  <div style="float:left;padding-left:10px;width:100px;position:relative;"  class="edit_css_interfaces universal">
					      
						<script type="text/javascript">
						
						function update_indent(divId, lVal){
	  
						  if(isNaN($('#text-indent-value').val())){
						  
						      alert("text indent should be numerical");
						  }else{
						      $( divId).css('textIndent', $('#text-indent-value').val() + $('#text-indent').val());
						    
						

						    }

						  }

						  </script>
					  
				
						  <label style="font-size:10px;float:left;padding-left:10px;">Text-Indent</label>
						    <a href="javascript: popup_css_help('cssref/pr_text_text-align.asp');" style="float:left;padding-left:20px;font-size:9px;">help</a>
						<div class="clear"></div>
						    <input type="text"  name="text-indent-value" id="text-indent-value" onkeyup="javascript: update_indent('<?php echo $_REQUEST['id'];?>', this.value);"  title="text-indent-value" style="position:relative;left:-50px;width:40px;" /> 
						 
						    <select name="text-indent" id="text-indent"  onkeyup="javascript: update_indent('<?php echo $_REQUEST['id'];?>', this.value);"  title="text-indent" class="other" style="width:40px;position:relative;top:-20px;left:15px;">
						    <?php
						    foreach($units as $unit){
						    ?>
						      <option value="<?php echo $unit;?>"><?php echo $unit;?></option>
						    <?php } ?>
						    </select>
					    </div>
					    
					    
					    
					    
					    
					    
					    
					  <script>
					      $('#text-indent-value').val(extract_number_from_string($('<?php echo $_REQUEST['id'];?>').css('textIndent')));
					      $('#text-indent').val(extract_text_from_string($('<?php echo $_REQUEST['id'];?>').css('textIndent')));
					  </script>
				
				<?php } ?>
			 
			      
			   <?php
			    }
			?>
			
			<script type="text/javascript">
			function show_more(id){
			
			if($('.'+ id + '_more').css('display') == 'none'){
			
			    $('.'+ id + '_less').css('display', 'none');
			    $('.'+ id + '_more').css('display', 'inline');
			    $('#label_' + id).html('Less');
			}else{
			
			     $('.'+ id + '_less').css('display', 'inline');
			    $('.'+ id + '_more').css('display', 'none');
			    $('#label_' + id).html('More');
			}
			
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
			</script>
		
					   
