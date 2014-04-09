							<!--[if !IE]>start row<![endif]-->
                                                        <div class="row">     
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
     <script>

function show(divId){
document.getElementById(divId).style.display='block';

if(divId == "chooseform"){

document.getElementById('createform').style.display='none';


}else{
document.getElementById('chooseform').style.display='none';

}
}
</script>

                                                             
                                                                    <div class="inputs" style="width:400px;">
                                                                        <input type="radio" value="choose" onclick="show('chooseform');"> <label id="pdcode-label">Choose a Template</label><br />
									   <label id="pdcode-label">Or</label><br />
									<input type="radio" value="create" onclick="show('createform');"> <label id="pdcode-label">Create a Custom Template</label>
                                                                        
                                                                    </div>
                                                                </div>
							    </div>
		  
							 </div>

							<!--[if !IE]>start row<![endif]-->
                                                        <div class="row" id="chooseform" style="display:none;">     
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label id="pdcode-label">Select a Template:</label><br />
                                                                    <div class="inputs">
                                                                        <select name="template" id="template">
<?php
    $sql = db_query("select * from templates");

	while($row = db_fetch_array($sql)){
?>
									    <option value="<?php echo $row['template'];?>"><?php echo $row['template'];?></option>
<?php
}
?>
									</select>
                                                                        
                                                                    </div>
                                                                </div>
							    </div>
		  
							 </div>

							<!--[if !IE]>start row<![endif]-->
                                                        <div class="row" id="createform" style="display:none;">     
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label id="pdcode-label">Select a Template:</label><br />
                                                                    <div class="inputs">
                                                                        <input type="radio" value="choose" onclick="show('chooseform');">Choose a Template<br />
									  Or<br />
									<input type="radio" value="create" onclick="show('createform');">Create a Custom Template
                                                                        
                                                                    </div>
                                                                </div>
							    </div>
		  
							 </div>