<?php
$conditionals = array("isset", "is_array", "empty", "!isset", "!is_array", "!empty", "==", "!=", "<>", ">=", "<=", ">", "<");
if(!empty($BASE_DIR)){
require_once("$BASE_DIR/config/config.inc.php");

}else{
require_once("../../config/config.inc.php");

}


if(!empty($_REQUEST['menu_name'])){

    foreach($_REQUEST['link_text'] as $key => $value){
    if($_REQUEST['link_text'][$key] == '[[FORUMS]]'){
    
    
    
      if($_REQUEST['delete_link'][$key] == 'yes'){
	   if(db_num_rows(db_query("select * from sitesetting where name = 'forum'")) == 0){
	      db_query("insert into sitesetting (id, name, value) values(null, 'forum', 1);");
	   
	   }else{
	    db_query("update sitesetting set value = 1, status=1 where name = 'forum'");
	    
	   }
	
	}else{
	db_query("update sitesetting set value = 0,status=0 where name = 'forum'");
	
	}
    echo db_error();
    }
    if($_REQUEST['link_text'][$key] == '[[REDEMPTION]]'){
    
    
    
      if($_REQUEST['delete_link'][$key] == 'yes'){
    
	if(db_num_rows(db_query("select * from sitesetting where name = 'redemption'")) == 0){
	      db_query("insert into sitesetting (id, name, value) values(null, 'redemption', 1);");
	   
	   }else{
	    db_query("update sitesetting set value = 1, status=1 where name = 'redemption'");
	    
	   }
	
	}else{
	db_query("update sitesetting set value = 0,status=0 where name = 'redemption'");
	
	}
    
    }
    if($_REQUEST['link_text'][$key] == '[[COMMUNITY]]'){
    
    
    
      if($_REQUEST['delete_link'][$key] == 'yes'){
    
	if(db_num_rows(db_query("select * from sitesetting where name = 'community'")) == 0){
	      db_query("insert into sitesetting (id, name, value) values(null, 'community', 1);");
	   
	   }else{
	    db_query("update sitesetting set value = 1, status=1 where name = 'community'");
	    
	   }
	
	}else{
	db_query("update sitesetting set value = 0,status=0 where name = 'community'");
	
	}
    
    }
    


	  if(db_num_rows(db_query("select * from navigation where id = '$key' and menu_name = '$_REQUEST[menu_name]'")) >= 1){
	      
	      
		  db_query("update navigation set sort='" . $_REQUEST['sort'][$key] . "', link='" . addslashes($_REQUEST['link'][$key]) . "', link_text='" . addslashes($_REQUEST['link_text'][$key]) . "' where id= '$key'");
		  
		
	      if($_REQUEST['delete_link'][$key] != 'yes'){
		  db_query("update navigation set enabled = '0' where id = '$key'");
	      
	      }else{
	      
		  db_query("update navigation set enabled = '1' where id = '$key'");
	      }
	
		  $id = $key;
		
		  foreach($_REQUEST['conditional_type'][$id] as $keyc => $valuec){
		
		      if(db_num_rows(db_query("select * from nav_conditionals where id = '$keyc'")) >= 1){
		      
		      
			if($_REQUEST['delete_conditional'][$id][$keyc] != 'yes' ){
			
			    if(!empty($_REQUEST['conditional_operator'][$id][$keyc]) & !empty($_REQUEST['conditional_operator'][$id][$keyc])){
			      db_query("update nav_conditionals set link_name= '" . addslashes($_REQUEST['link_text'][$id]) . "', conditional_type = '" . addslashes($valuec) . "', conditional_operator='". $_REQUEST['conditional_operator'][$id][$keyc] . "', conditional_val='". addslashes($_REQUEST['conditional_val'][$id][$keyc]) . "', table_id=$key where id=$keyc");
			      
			      }else{
			       db_query("delete from nav_conditionals where id=$keyc");
				  
			      
			      }
			      echo db_error();
			      
			      
			    }else{
			    
			      db_query("delete from nav_conditionals where id=$keyc");
			    
			}
			  
		      
		      
		      }else{
			  if(!empty($_REQUEST['conditional_operator'][$id][$keyc]) & !empty($_REQUEST['conditional_operator'][$id][$keyc])){
			     
			    db_query("insert into nav_conditionals values(null, '" . addslashes($_REQUEST['menu_name']) . "', link_name='". addslashes($_REQUEST['link_text'][$id]) . "', conditional_type='" . addslashes($_REQUEST['conditional_type'][$id][$keyc]) . "', conditional_operator='". $_REQUEST['conditional_operator'][$id][$keyc] . "', conditional_val='". addslashes($_REQUEST['conditional_val'][$id][$keyc]) . "', 'navigation', '$key');");
		      
			  }
		      
		      }
		  
		  
		  
		  }
	  }else{
	 	$last = db_fetch_object(db_query("select * from navigation where menu_name = '$_REQUEST[menu_name]' order by `sort` desc limit 1"));
		
		$sort = $last->sort + 1;
		
		db_query("insert into navigation values(null, '$_REQUEST[menu_name]', '" . addslashes($_REQUEST['link'][$key]) . "', '" . addslashes($_REQUEST['link_text'][$key]) . "', '', '', '" . $sort . "');");
		
		$id = db_insert_id();
		db_query("update navigation set enabled = '1' where id = '$id'");
	 
	  }
    
    
    
    }






}
db_query("delete from navigation where link ='' or link_text = '';");
 
?>
<script>
function show_conditionals(id){

    $('.conditionals').css('display', 'none');
    $('#conditionals_' + id).css('display', 'block');
}
</script>
<h1>This will not work if you are not using a dynamic menu</h1>
<form action="designsuite.php" method="get" enctype="multipart/form-data">

    <div style="border: 1px solid #000000;
border-radius: 8px 8px 8px 8px;
left: 1000px;
position: absolute;
top: 280px;
width: 330px;margin-bottom:100px;">
      <h3 style="margin:20px;">Help</h3>
      <ul style="list-style-type:none;margin-left:-25px;"><b>System Conditionals Explained</b>
	  <li><span style="color:blue;font-weight:bold;">Q:</span> If you do not want to show a link for a specific page?</li>
	  <li style="margin-bottom:20px;"><span style="color:blue;font-weight:bold;">A:</span> You would use a variable similar to "_SERVER['PHP_SELF']"<br />
		  A operator such as "!="<br />
		  And finally a value like "index.php"
		  
	  </li>
	  <li><span style="color:blue;font-weight:bold;">Q:</span> If you do not want to show or not show on a page based on a person's login status?</li>
	  <li style="margin-bottom:20px;"><span style="color:blue;font-weight:bold;">A:</span> You would use a variable similar to "_SESSION['userid']"<br />
		  A operator such as "<="<br />
		  And finally a value like "0"
		  <br/>The above example would hide the entry if the user is not logged in
		  <br /> Change the operator to ">=1"<br />
		  And the value to "1" to show it
		  
	  </li>
	  <li><span style="color:blue;font-weight:bold;">Q:</span> If you do not want to show or not show on a page based on a particular template?</li>
	  <li style="margin-bottom:20px;"><span style="color:blue;font-weight:bold;">A:</span> You would use a variable similar to "GLOBALS['template']"<br />
		  A operator such as "!="<br />
		  And finally a value like "wavee"
		  <br/>The above example would hide the entry if the template were wavee
		  
		  
	  </li>
      
      
      
      </ul>
      <br />
      <ul style="list-style-type:none;margin-left:-25px;"><b>Common PHP operators explained</b>
	  <li><span style="color:blue;font-weight:bold;">Q:</span> What is isset and isset?</li>
	  <li style="margin-bottom:20px;"><span style="color:blue;font-weight:bold;">A:</span> isset means that the variable does exist but might be empty<br />
	      !isset means the variable is not set at all
		  
	  </li>
	  <li><span style="color:blue;font-weight:bold;">Q:</span> What does empty and !empty mean?</li>
	  <li style="margin-bottom:20px;"><span style="color:blue;font-weight:bold;">A:</span> <ul style="list-style-type:none;">
	  Unlike isset empty can mean a wider variety of things
		
		 <li>variable may be completely unset</li>
		 <li>variable might be set but is empty(ex: the variable might be ""</li>
		 <li> Finally it may also mean that the value is equal to "0"</li>
		 </ul>
		  
	  </li>
	  <li><span style="color:blue;font-weight:bold;">Q:</span> What does is_array mean?</li>
	  <li style="margin-bottom:20px;"><span style="color:blue;font-weight:bold;">A:</span> An array is a special type of variable in programming languages<br />
	      Think of a variable as a folder with a single peice of paper<br />
	      With that being said an array is more like a filing cabinet where<br />
	      Those single peices of paper can be filed loosely<br />
	      Or in folders and indexed for eay retrieval and comparison<br />
		<ul style="list-style-type:none;"><b>Common System arrays</b>
		
		<li>_SERVER(PHP created settings)</li>
		<li>_SESSION(Server stored data meant to exist from page to page for the current user)</li>
		<li>_COOKIE(Browser stored data meant to exist from page to page for the current user)</li>
		<li>_POST(Data sent by a form</li>
		<li>_GET(Data sent in a query string ex: anything after "?" in a url)</li>
		<li>_REQUEST(matches any of the 4 above...this is dependant on the PHP settings of the server)</li>
		<li>GLOBALS(an indexed array of every variable in use on that page)</li>
		
		</ul>
		  
		  
	  </li>
      
      
      
      </ul>
      
      </div>
      
<?php

if(empty($_REQUEST['menu'])){
?>
<h3>Please choose a menu</h3>
<ul style="list-style-type:none;">
<?php

    $sqlm = db_query("select distinct(menu_name) from navigation where menu_name like '%menu%' order by id asc");

	while($rowm = db_fetch_array($sqlm)){
	
	    ?><li><a href="<?php echo $SITE_URL;?>backendadmin/designsuite.php?a_page=menus.php&menu=<?php echo $rowm['menu_name'];?>"><?php echo ucwords(str_replace("_", " ", $rowm['menu_name']));?></a></li><?php
	}

?>
</ul>
<?php
echo db_error();
}else{


      if(empty($_REQUEST['link_text']) | is_array($_REQUEST['link_text'])){
      ?>
      <h3 style="max-width:500px;word-wrap:break-word;">Program constants are used when you specify the text within<br /> double square brackets <br />(ex: [[HOME]] would equal <?php echo HOME;?>). This way language support is still enabled.</h3>
      <p>To keep language support enabled please edit the constants on the constants page</p>
      <ul style="list-style-type:none;min-width:650px;" id="<?php echo $_REQUEST['menu'];?>">
      <?php
          $sqlm = db_query("select * from navigation where menu_name ='$_REQUEST[menu]' order by sort, id asc");

	while($rowm = db_fetch_array($sqlm)){
	
	    ?><li style="border:1px dotted red;padding-bottom:4px;margin-bottom:10px;width:650px;">
	    
			  <ol  style="list-style-type:none;margin-left:-40px;"> 
			      <li style="display:inline;margin:10px 20px 5px 0;">
				  <input type="text" name="link_text[<?php echo $rowm['id'];?>]" id="link_text[<?php echo $rowm['id'];?>]" value="<?php echo $rowm['link_text'];?>" />
			      </li>
			      <li style="display:inline;margin:10px 20px 5px 0;">
				  <textarea style="height:40px;width:150px;margin-top:10px;" name="link[<?php echo $rowm['id'];?>]" id="link[<?php echo $rowm['id'];?>]"><?php echo $rowm['link'];?></textarea>
			      </li>
			      <li style="display:inline;margin:10px 20px 5px 0;">
				  <a href="javascript:show_conditionals(<?php echo $rowm['id'];?>);">Edit Conditionals</a>
			      </li>
			      <li style="display:inline;margin:10px 20px 5px 0;">
				  <input type="checkbox" name="delete_link[<?php echo $rowm['id'];?>]" id="delete_link[<?php echo $rowm['id'];?>]" value="yes" <?php if($rowm['enabled'] >= 1){ ?> checked<?php } ?> />Enabled/Disabled
			      </li>
			  </ol>
		
		    <span id="conditionals_<?php echo $rowm['id'];?>" class="conditionals" style="display:none;">
			<ul style="list-style-type:none;width:520px;">
			
				      <li style="background: none repeat scroll 0 0 #FFFFFF;border-radius: 6px 6px 6px 6px;font-weight: bold;margin-left: -10px;margin-top: 20px;padding: 15px 10px 20px 20px;width: 580px;">Position
					  <input id="sort[<?php echo $rowm['id'];?>]" name="sort[<?php echo $rowm['id'];?>]" value="<?php if(!empty($rowm['sort'])){ echo $rowm['sort']; } else{ echo 'null'; } ?>" style="float:right;" class="sort" />
				      </li>
				      <li style="min-height:40px;"></li>
				      <li style="width:600px;background: none repeat scroll 0 0 #FFFFFF;padding: 15px 10px 5px 0px;width: 600px;border-radius: 6px;margin-left: -10px;">
					  
				<label style="font-weight:bold;margin-left:20px;">Conditions</label>
			
			<?php
			$i = 1;
			
			    $sqlc = db_query("select * from nav_conditionals where link_name = '$rowm[link_text]' or table_id = '$rowm[id]' order by id asc");
			      while($rowc = db_fetch_array($sqlc)){
			      ?>
			      <ol style="width:540px;border:1px dashed blue;list-style-type:none;height:85px;margin-bottom:10px;margin-left:20px;">
			
				 
					    
				  
				      <li style="margin-left:-20px;margin-bottom:15px;">Condition to match(PHP env. variable)
					  <input type="text" name="conditional_type[<?php echo $rowm['id'];?>][<?php echo $rowc['id'];?>]" id="conditional_type[<?php echo $rowm['id'];?>][<?php echo $rowc['id'];?>]" value="<?php echo $rowc['conditional_type'];?>"  style="float:right;" />
				      </li>
				      <li style="margin-left:-20px;margin-bottom:15px;">Comparison type
					  <select name="conditional_operator[<?php echo $rowm['id'];?>][<?php echo $rowc['id'];?>]" id="conditional_operator[<?php echo $rowm['id'];?>][<?php echo $rowc['id'];?>]"  style="float:right;">
					      <?php
					      foreach($conditionals as $key => $value){
						  ?>
						    <option value="<?php echo $value;?>" <?php if($rowc['conditional_operator'] == $value){ echo 'selected'; } ?>><?php echo $value;?></option>
						  <?php
					      }
					      ?>
					      
					  </select>
				      </li>
				      <li style="margin-left:-20px;margin-bottom:15px;">Comparison value(*)
					  <input type="text" name="conditional_val[<?php echo $rowm['id'];?>][<?php echo $rowc['id'];?>]" id="conditional_val[<?php echo $rowm['id'];?>][<?php echo $rowc['id'];?>]" value="<?php echo $rowc['conditional_val'];?>"  style="float:right;clear:both;" />
				      
				      </li>
				      <li style="margin-left:-20px;margin-bottom:15px;">Delete Condition
					   <input type="checkbox" name="delete_conditional[<?php echo $rowm['id'];?>]" id="delete_conditional[<?php echo $rowc['id'];?>]" value="yes" />
				      
				 </ol>
			      <?php
			      $i++;
			      }
			  ?>
			  
				
				    <ol style="border:1px dashed blue;list-style-type:none;height:85px;margin-bottom:10px;margin-left:20px;">
			
			  
				  
				      <li style="margin-left:-20px;margin-bottom:15px;">Condition to match(PHP env. variable)
					  <input type="text" name="conditional_type[<?php echo $rowm['id'];?>][<?php echo $rowc['id'] + 1;?>]" id="conditional_type[<?php echo $rowm['id'];?>][<?php echo $rowc['id'] + 1;?>]" value="<?php echo $rowm['conditional_type'];?>"  style="float:right;" />
				      </li>
				      <li style="margin-left:-20px;margin-bottom:15px;">Comparison type
					  <select name="conditional_operator[<?php echo $rowm['id'];?>][<?php echo $rowc['id'] + 1;?>]" id="conditional_operator[<?php echo $rowm['id'];?>][<?php echo $rowc['id'] + 1;?>]"  style="float:right;">
					  <option value=""></option>
					      <?php
					      foreach($conditionals as $key => $value){
						  ?>
						    <option value="<?php echo $value;?>" <?php if($rowc['conditional_operator'] == $value){ echo 'selected'; } ?>><?php echo $value;?></option>
						  <?php
					      }
					      ?>
					      
					  </select>
				      </li>
				      <li style="margin-left:-20px;margin-bottom:15px;">Comparison value(*)
					  <input type="text" name="conditional_val[<?php echo $rowm['id'];?>][<?php echo $rowc['id'] + 1;?>]" id="conditional_val[<?php echo $rowm['id'];?>][<?php echo $rowc['id'];?>] + 1" value="<?php echo $rowm['conditional_val'];?>"  style="float:right;clear:both;" />
				      
				      </li>
				
				 </ol>
			      </li>
			  </ul>
		    </span>
	      </li>
	      
	<?php
	}
      ?>
      </li>
	    <li style="margin-top:20px;">Add Link
			<ol  style="list-style-type:none;margin-left:-40px;"> 
			      <li style="display:inline;margin:10px 20px 5px 0;">
				  <input type="text" name="link_text[100000]" id="link_text[100000]" value="<?php echo $rowm['link_text'];?>" />
			      </li>
			      <li style="display:inline;margin:10px 20px 5px 0;">
				  <textarea style="height:40px;width:150px;margin-top:10px;" name="link[100000]" id="link[100000]"><?php echo $rowm['link'];?></textarea>
			      </li>
			  
			      
			  </ol>
	  </li>  
      </ul>
      <script>
      $('#<?php echo $_REQUEST['menu'];?>').sortable({stop: function() {
      
	  s=0;
	  $('#<?php echo $_REQUEST['menu'];?> .sort').each( function(){
	    id = $(this).attr('id');
	  
	    $(this).val(s++);
	  
	  })
      
      } });
      </script>
	      <input type="hidden" name="menu" id="menu" value="<?php echo $_REQUEST['menu'];?>" />
	      <input type="hidden" name="menu_name" id="menu_name" value="<?php echo $_REQUEST['menu'];?>" />
	      <input type="hidden" name="a_page" id="a_page" value="<?php echo $_REQUEST['a_page'];?>" />
     * => Not used for isset, is_array or empty conditions
      <!--[if !IE]>start row<![endif]-->
      
      
      
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Save</span></span><input name="submit" type="submit"  /></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                         
                                                                <!--[if !IE]>end row<![endif]-->
     
 
     
      <?php
      
      
      
      }else{
      
      
      
      
      
      
      
      
      
      }

?>
</form>
<?php



}
 
