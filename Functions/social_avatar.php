<?php

function social_avatar($userid, $avatar){
 global $BASE_DIR;
 include("$BASE_DIR/config/config.inc.php");
    $qry = db_fetch_array(db_query("select pointer from social_avatar where user_id = '$userid' order by id DESC limit 1"));
    $qry2 = db_fetch_array(db_query("select $qry[pointer] from social_avatar where user_id = '$userid' order by id desc limit 1"));
    if(!empty($qry2[$qry['pointer']])){
      return $qry2[$qry['pointer']];
    }else{
      return $avatar;
  
   }
}