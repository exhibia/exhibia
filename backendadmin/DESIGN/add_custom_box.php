<?php


if(!empty($_REQUEST['find_last'])){

require_once("../../../../config/config.inc.php");
db_connect($DBSERVER, $USERNAME, $PASSWORD);

include("../js/ckeditor/ckeditor_php5.php");

db_select_db($DATABASENAME, $db);



		      $row = db_fetch_array(db_query("select * from languages where constant like 'CUSTOM_CONTENT%' order by constant desc limit 1"));
		      
		      $constant = str_replace("CUSTOM_CONTENT", "", $row['constant']);
		      
		      
			  $id = $constant + 1;
			  
			  echo "CUSTOM_CONTENT" . $id;













		  }else{

		      ?>
			   <form id="custom_form" name="custom_form" action="javascript: submit_test_ajax_custom_form('custom_form'); ">
					<table  align="center">
						
						<tr>
							<td colspan="2" valign="top" height="100%">
							<?php
							//if(!isset($_REQUEST['get'])){
							?>
											<h2>Add New Custom Box</h2>
					
					  			<input type="checkbox" value="new" id="new" name="new" onclick="add_new_custom();" />
							</td>
							<td>  
		
							<?php
						
								if(!isset($_REQUEST['get_custom']) | empty($_REQUEST['constant'])){
							?>
				      					<div id="constant_wrap" style="margin-left:50px;">
					    					<input type="hidden" value="<?php echo $rowlc['constant'];?>" id="constant_c" name="constant_c" style="width:400px;" size="400">
				      					</div>
							<?php
								//}
							?>
					  
				
			
			
							<?php
							}
							
							      if(db_num_rows(db_query("select * from languages where constant like 'CUSTOM_CONTENT%'")) >= 1){
							      
							      $selects = true;
							?>
								  <h2>Choose A Custom Box</h2>
									<select id="constant2c" name="constant" onchange="javascript:edit_custom_box($(this).val());">
									   
									    
								    <?php
								    $qry4c = db_query("select * from languages where constant like 'CUSTOM%'");
								    
								    while($row4c = db_fetch_array($qry4c)){
								    ?>
										
										<option value="<?php echo $row4c['constant'];?>" <?php if($_REQUEST['constant'] == $row4c['constant']){ echo 'selected'; } ?>><?php echo $row4c['constant'];?></option>
								<?php } ?>
									</select>
							<?php } ?>
								<input type="hidden" name="editcustom" value="yes" id="editcustom" />
								<input type="hidden" name="get_custom" id="get_custom" value="customform" />
			
							   <h2>Choose A Location</h2>
									<select id="box_location" name="location" onchange="javascript:<?php if(!$selects){ ?>edit_custom_box<?php }else{ ?>add_new_custom<?php } ?>($('#constant_c').val());">
									 <option value="#header">header</option>
									    <option value="body">page</option>
									    <option value="#column-left">Left Column</option>
									    <option value="#column-middle">Middle Column</option>
									    <option value="#column-right">Right Column</option>
									 </select>
							
							</td>

						    </tr>
						    <tr>
				     			<td colspan="1" align="left" valign="top" height="100%">
							<h2>Auto Translate?</h2>
								<input type="checkbox" value="yes" id="translate" name="translate"/>
				    			</td>
				   			 <td colspan="1" align="left" valign="top" height="100%">
				      
						    		<h2>Convert From</h2>
								<select name="oldlanguage" id="oldlanguage">
					    
						    			<option value="<?php echo $rowlc['language'];?>"><?php echo $rowlc['language'];?></option>
									<?php
									$qry3c = db_query("SELECT distinct(language) from language");
									
									while($rowAllLangc = db_fetch_array($qry3c)){
									
									?>
						      
						    			<option value="<?php echo $rowAllLangc['language'];?>"><?php echo $rowAllLangc['language'];?></option>		  
						      
									<?php
									}
										?>
								</select>  

				     			 </td>
							<td colspan="1" align="left" valign="top" height="100%">


						  		<h2>Target Language</h2> 
					     			 <select name="target_language" id="target_language">
								<?php
								if(!empty($_REQUEST['target_language'])){
								?>
						   			 <option value="<?php echo $_REQUEST['target_language'];?>"><?php echo $_REQUEST['target_language'];?></option>
								<?php
									}
								?>
						    			<option value="<?php echo $rowlc['language'];?>"><?php echo $rowlc['language'];?></option>

						 		 <?php
									$allLc = db_query("SELECT distinct(language) from language");


						 			 while($rowAllLc = db_fetch_array($allLc)){




						 		 ?><option value="<?php echo $rowAllLc['language'];?>" style="word-wrap:break-word;width:100px;"><?php echo $rowAllLc['language'];?></option><?php

						 			 }


						  		?>
					      			</select>
					      			<div style="position:absolute;top:5px;display:none;" id="text_editorc">
				
										  
								    <textarea id="lang_valuec" id="lang_valuec" style="height:50px;width:400px;" ><?php echo stripslashes($rowlc['value']);?></textarea>
								  <input type="hidden" value="<?php echo $rowlc['id'];?>" id="idc" name="idc">
								  <input type="hidden" value="<?php echo $id;?>" name="oldidc" id="oldidc">
					      <br />
								 
				</div>
							</td>

						</tr>
						    <tr>
							<td colspan="3" align="left">
							 <input type="submit" name="update_language_button" id="update_language_button" />
							 </td>
						    </tr>
					</table>
				    </form>
		    <?php




}
