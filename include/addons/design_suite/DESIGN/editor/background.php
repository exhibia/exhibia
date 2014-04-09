<style>
.qq-upload-list {
position:relative;
left:80px;
top:-35px;
background:#fff;
border-radius:6px;
font-size:10px;
color:#000;
text-align:left;
float:left;
min-height:0px;
height:auto;
padding:10px 0 10px 10px;

}

.qq-upload-list li span{
font-size:9px;

display:block;
}
</style>
<script type="text/javascript">
				  <?php include("java.php"); ?>
				  

				    $(function() {
				      // when inputs change, update the gradient
				     
				    });
				    

			  
			    </script> 
			    
			    <?php
 $units = array('%', 'px', 'pt', 'em', 'mm', 'cm', 'in', 'pc', 'auto');
 
 if(empty($_REQUEST['showOnly'])){
 ?>

	     	<div class="accordion" id="background-accordion">
				  <h3>Color</h3>  
				  <div class="panel">
				      
				      
				      
				  
				  <input type="text" id="background-color" name="background-color" style="width:90px;" />
				  
				  
				  </div>
				  <h3>Attachment</h3>
				  <div class="panel">
				     
				      
				      
					<select name="background-attachment" id="background-attachment" onchange="javascript: update_background_attachment('<?php echo $_REQUEST['id'];?>', this.value);">
					    <option value=""></option>
					    <option value="scroll">scroll</option>
					    <option value="fixed">fixed</option>
					    <option value="repeat-y">inherit</option>
					    
					</select>
				   </div>
	
				  <h3>Image</h3>
				  <div class="panel" style="height:70px;">
				  
				  <label style="font-size:10px;float:left;">Image</label>
				    
				
			    
				      <ul style="list-style:none;margin: 0 0 0 0;height:70px;position:relative;top:20px">
					  <li id="upload-button-logo" style="display:inline;float:left;height:14px;text-align:center;font-size:12px;background-color:red;border-radius:6px;padding:10px 10px 20px 10px;color:#fff;width:50px;"></li>
					  
				      </ul>
				  </div>
				  <h3>Repeat</h3>
				  <div class="panel">
				    <select style="min-width:100px;" name="background-repeat" id="background-repeat" onchange="javascript: update_background_repeat('<?php echo $_REQUEST['id'];?>', this.value);">
					    <option value=""></option>
					    <option value="repeat">repeat</option>
					    <option value="repeat-x">repeat-x</option>
					    <option value="repeat-y">repeat-y</option>
					    <option value="no-repeat">no-repeat</option>
					</select>
				  </div>
				  <h3>Position</h3>
				  <div class="panel">
				    <select name="backgroundPosition" id="backgroundPosition" onchange="javascript: update_background_position('<?php echo $_REQUEST['id'];?>', this.value);">
					    <option value=""></option>
								<option value="left top">tl</option>
								<option value="left center">cl</option>
								<option value="left bottom">bl</option>
								
								<option value="right top">tr</option>
								<option value="right bottom">br</option>
								<option value="right center">rc</option>
								
								
								<option value="center top">ct</option>
								
								<option value="center bottom">cb</option>
								<option value="center center">br</option>
					</select>
				  </div>
				   <h3>Size</h3>
				  <div class="panel">
				  <span>
						<label>X</label>    <input type="text" value="" name="background-size-x" id="background-size-x"  onkeyup="javascript: update_background_size('<?php echo $_REQUEST['id'];?>');">
								<select name="backgroundSizeUnit-x" id="backgroundSizeUnit-x" onchange="update_background_size('<?php echo $_REQUEST['id'];?>');">
								<option value=""></option>
								<?php
								foreach($units as $unit){
								?>
								<option value="<?php echo $unit;?>"><?php echo $unit;?></option>
								<?php
								}
								?>
								</select>
					</span>
					<div class="clear"></div>
					<span>
						  <label>Y</label>   <input type="text" value="" name="background-size-y" id="background-size"  onkeyup="javascript: update_background_size('<?php echo $_REQUEST['id'];?>');">
								<select name="backgroundSizeUnit-y" id="backgroundSizeUnit-y" onchange="update_background_size('<?php echo $_REQUEST['id'];?>');">
								<option value=""></option>
								<?php
								foreach($units as $unit){
								?>
								<option value="<?php echo $unit;?>"><?php echo $unit;?></option>
								<?php
								}
								?>
								</select>
					</span>
					
				  </div>
					<div class="clear"></div>
			
			
					
				         
				 <h3>Gradient</h3>
					
				      <?php 
				    
				      } ?>
				   
				  <?php include("gradient.php"); ?>
				  
				
				  
		

<input type="hidden" name="background" id="background"    onkeyup="javascript: update_background('<?php echo $_REQUEST['id'];?>', this.value);"  title="background" class="other advanced" />

	</div>