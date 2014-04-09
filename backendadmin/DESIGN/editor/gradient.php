
			  
		
			  	
				  
			
			     
				<div class="panel" <?php if($_REQUEST['showOnly'] == 'gradient'){ ?> id="gradient_tooltip" style="display:block;"<?php }else{ ?>  <?php } ?>>
				
									    <table  align="center">
									    
										  <tr>
										    <td valign="top" height="100%" class="first_td">
						      						
												     
												       
													  <textarea name="hidden-gradient" id="hidden-gradient" ></textarea>
													  <div id="my_gradients_begin" ></div>
													 <div class="clear"></div>
													 <br />
													 <br />
													 <br />
													 <br />
										   <a href="javascript:;" onclick="insert_a_stop('<?php echo $_REQUEST['id'];?>');">Insert Stop</a>
													   
											</td>
											
											<td valign="top" height="100%" class="second_td">
											    
												<select name="gradient_from" id="gradient_from" onchange="$('#deg').val('0');refreshGradient('<?php echo $_REQUEST['id']; ?>');">
												    <option value="top">t to b</option>
												    <option value="bottom">b to t</option>
												    <option value="left">l to r</option>
												    <option value="right">r to l</option>
												    <option value="right top">tr to bl</option>
												    <option value="left top">tl to br</option>
												    <option value="right bottom">br to tl</option>
												    <option value="left bottom">bl to tr</option>
												    <option value="center center">c to c</option>
												    <option value="center top">c to t</option>
												    <option value="center bottom">c to b</option>
												</select>
												<select  name="gradient_type" id="gradient_type" onchange="refreshGradient('<?php echo $_REQUEST['id']; ?>');">
												<option value="linear">Linear</option>
												<option value="radial">Radial</option>
												
												
												</select>
												
												
												
												<select  name="deg" id="deg" onchange="refreshGradient('<?php echo $_REQUEST['id']; ?>');">
												
												<?php
												$d = 360;
												  while($d >= -360){
												?>
												<option value="<?php echo $d;?>" <?php if($d == 0 ){ echo "selected"; } ?>><?php echo $d;?>&deg;</option>
												
												<?php $d = $d - 5; 
												
												}
												?>
												
												</select>
												
												<select  name="shape" id="shape" onchange="refreshGradient('<?php echo $_REQUEST['id']; ?>');">
												
												      
												      <option value="circle" selected>circle</option>
												      <option value="ellipse">ellipse</option>
												
												</select>
												<select  name="where" id="where" onchange="refreshGradient('<?php echo $_REQUEST['id']; ?>');">
												      
													<option value="closest-side">closest-side</option>
													<option value="closest-corner">closest-corner</option>
													<option value="farthest-side">farthest-side</option>
													<option value="farthest-corner">farthest-corner</option>
													<option value="contain">contain</option>
													<option value="cover" selected>cover</option>
												</select>
												
											


 
				   
				   



				   
										    
										    
										    </td>
										 </tr>
										
									   
									 </table>
		</div>
		
		 <style>

				</style> 