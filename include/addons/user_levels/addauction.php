<?php

include_once("$BASE_DIR/include/addons/user_levels/class.user_levels.php");
$user_levels = new Userlevel();
$levels = $user_levels->get_ranking_list();


$str = '';
if(!empty($_POST['user_level'])){

    foreach($_POST['user_level'] as $key => $value){
	$str = $str . $value . ",";
  
    }
$str = rtrim($str, ",");
	db_query("update auction set user_level = '$str' where auctionID = '$auctionID'");
      


      
}else{
@db_query("alter table auction add column user_level int(11) null");
@db_query("alter table auction add column badge varchar(200) null");


?>
  <td colspan="1" width="250px" valign="top" height="100%">
      <div style="position:relative;top:-30px;width:250px;">
<?php

    echo "<h5 style=\"font-size:18px;font-weight:bold;\">Limit to User Level</h5>";
    ?>
     <div style="max-height:350px;overflow-y:auto;">
    <?php
    foreach($levels as $key => $value){
    
      echo "<div style=\"font-weight:bold;\">" . ucwords(str_replace("_", " " , "$key")) . "<br />";
      echo "<span class='user_level' id='user_level_$key'><ul>";
   
    
	foreach($levels[$key] as $key2 => $value2){
	
	  
	    echo "<li style='width:250px;font-weight:normal;font-size:10px;'>$value2";
	    echo "=>users(";
	    echo db_num_rows(db_query("select * from user_ranking where rank_id = $key2")) >=1 ? db_num_rows(db_query("select * from user_ranking where rank_id = $key2")) : 0 ;
	    echo ") ";
	    echo "<input type='checkbox' name='user_level' id='level_$key2' value='$value2' style='float:right;' /></li>";
	
	
	}
	
	echo "</ul></span></div><div style=\"clear:both;\"></div>";
    
    }
    ?>
	</div>
      </div>
    </td>
    <?php













}