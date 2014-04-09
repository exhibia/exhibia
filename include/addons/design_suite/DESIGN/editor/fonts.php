<?php $variants = array('normal', 'small-caps', 'inherit'); ?>
<?php $weights = array('normal', 'bold', 'bolder', 'lighter', '100','200', '300','400', '500', '600', '700', '800', '900'); ?> 	 
 <?php
 $units = array('px', 'pt', 'em', 'mm', 'cm', 'in', 'pc');
 ?>
			
		  	   <script>
				<?php include("java.php"); ?>
			  </script>
		  	 
		  	 
		  	<div class="accordion" id="font-accordion">
			    <h3>Font-Color</h3>
		  		  
		  		  <div class="panel">
				      
				 
				      <input type="text" name="color" id="color"  onkeyup="javascript: update_font_color('<?php echo $_REQUEST['id'];?>', this.value);"  title="color" class="other" style="position:relative;left:25px;" />
				  </div>
		  		  <script>
				  
				      $('#color').val(hexToRgb($('<?php echo $_REQUEST['id'];?>').css('color')));
				  </script>
				  
				  
		  		   <h3>Font-Size</h3>
		  		  <div class="panel open">
				     
				      
					  <input type="text" name="font-size" id="font-size"  onkeyup="javascript: update_font_size('<?php echo $_REQUEST['id'];?>', this.value);"  title="font-size" class="other" style="width:30px;position:relative;left:30px;" />
					  
					  <select style="width:auto;min-width:75px;margin-left:50px;" name="fontSizeUnit" id="fontSizeUnit" onchange="javascript: update_font_size('<?php echo $_REQUEST['id'];?>', this.value);">
					  <?php foreach($units as $unit){ ?>
					      <option value="<?php echo $unit;?>"><?php echo $unit;?></option>
					      
					  <?php } ?>
					  </select>
				    </div>
		  		  <h3>Font-Style</h3>
		  		   <div class="panel">
				      
				      
				      
				      
				      <select name="font-style" id="font-style"  class="edit_css_interfaces uinversal"  onchange="javascript: update_font_style('<?php echo $_REQUEST['id'];?>', this.value);"  title="font-style" class="other">
					  <option value=""></option>
					  <option value="normal">normal</option>
					  <option value="italic">italic</option>
					  <option value="inherit">inherit</option>
					  <option value="oblique">oblique</option>
				      </select>
		  		  </div>

				  
				  <h3>Font-Weight</h3>
				
				        <div class="panel">
				
				    
				  
				      <select name="font-weight" id="font-weight"  onkeyup="javascript: update_font_weight('<?php echo $_REQUEST['id'];?>', this.value);"  title="font-weight" class="other"  onchange="javascript: update_font_weight('<?php echo $_REQUEST['id'];?>', this.value);">
				      <option value=""></option>
				      <?php foreach($weights as $weight){ ?>
					    <option value="<?php echo $weight; ?>"><?php echo $weight; ?></option>
				      <?php } ?>
				      </select>
				      
				      
				  </div>
				  <h3>Font-Variant</h3>
				  <div class="panel">
				    
				 
				    
				      <select name="font-variant" id="font-variant"  onchange="javascript: update_font_variant('<?php echo $_REQUEST['id'];?>', this.value);"  title="font-variant" class="other" style="position:relative;">
				      <option value=""></option>
				      <?php
				      foreach($variants as $variant){ 
				      ?>
				      <option value="<?php echo $variant;?>"><?php echo $variant;?></option>
				      
				      <?php } ?>
				      
				      
				      </select>
				  </div>
				   <h3>Font-Face</h3>
				  <div class="panel">
				   
				    
				  
				      <select name="font-family" id="font-family"  onchange="javascript: update_font_family('<?php echo $_REQUEST['id'];?>', this.value);"  title="font-family" class="other" style="position:relative;">
					  <option value=""></option>
				      </select>
				      
				  </div>
				  
				   <h3>Display</h3>
					<div class="panel">
					
				      
					      <select name="display" id="display" onchange="javascript: update_display('<?php echo $_REQUEST['id'];?>', this.value);"  title="display" class="other">
						  <option value="block">block</option>
						  <option value="none">none</option>
						  <option value="inline">inline</option>
						  <option value="inline-block">inline-block</option>
					      </select>
					  
					  
					  </div>
				   
					  
					  
					
					  <h3>Float</h3>
					      <div class="panel">
					      <select name="float" id="float" onchange="update_float('<?php echo $_REQUEST['id'];?>');">
					      <option value="none">none</option>
						<option value="left">left</option>
						<option value="right">right</option>
						<option value="center">center</option>
					      </select>
					      <script>
						  $('#float').val($('<?php echo $_REQUEST['id'];?>').css('float'));
					      </script>
				
					  </div>
					  
					  
					   <h3>Text-Decoration</h3>
					      <div class="panel">
					      <select name="text-decoration" id="text-decoration" onchange="update_text_decoration('<?php echo $_REQUEST['id'];?>');">
						      <option value="none"></option>
						      <option value="underline">underline</option>
						      <option value="overline">overline</option>
						      <option value="line-through">line-through</option>
						      <option value="blink">blink</option>
						      <option value="inherit">inherit</option>
					      </select>
					      <script>
						  $('#float').val($('<?php echo $_REQUEST['id'];?>').css('float'));
						   $('#text-decoration').val($('<?php echo $_REQUEST['id'];?>').css('text-decoration'));
						   
						   function update_text_decoration(divId){
						   
						   $('<?php echo $_REQUEST['id'];?>').css('text-decoration', $('#text-decoration').val())
						   }
					      </script>
				
					  </div>
					  
					  
					  </div>
			
				  
				 
		  