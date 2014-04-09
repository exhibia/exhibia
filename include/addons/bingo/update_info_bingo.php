<?php
$aucdata = array();
header("content-type: application/json");
include("../../../config/config.inc.php");
if(!empty($_GET['userid'])){
$uid = $_GET['userid'];
}else if(!empty($_POST['userid'])){
$uid = $_POST['userid'];
}else{
$uid = $_SESSION['userid'];
}

if(!function_exists('microtime_float')){
function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}
}
if(!function_exists('rfloor')){
function rfloor($real,$decimals) {
        return substr($real, 0,strrpos($real,'.',0) + (1 + $decimals));
    }
    
}
//$aucdata['instances'] = array();
//$aucdata['instances'][$_REQUEST['instance_id']] = array();
//$aucdata['instances'][$_REQUEST['instance_id']]['numbers'] = array();

$tempkey='lastvisittime';
$starttime = microtime_float();
//0.69022417068481
$lasttime = (time() - $_SESSION['lastruntime']) * 100;

if(!empty($_SESSION[$tempkey]) & $starttime-$_SESSION[$tempkey] < 1){
  // echo json_encode(array('message' => 'failed','interval'=>$starttime-$_SESSION[$tempkey], 'quality'=>$lasttime));
  // exit;
}


$arrResult = array();
  $aucdata=new stdClass();
     $aucdata->userid=$_REQUEST['userid'];
 
     array_push($arrResult, $aucdata);
     
     
 $sql = db_query("select * from bingo_emails where instance = '$_REQUEST[instance_id]'" );
     if(db_num_rows($sql) >= 1){
	$aucdata=new stdClass();
	$aucdata->delayed = 'true';
	array_push($arrResult, $aucdata);
 }
 $sql1 = db_query("select distinct(card) from bingo_user_data where instance = '$_REQUEST[instance_id]' and userid = '$uid' and marked = 1 and row != '13' order by id desc" );
 
 while($row1 = db_fetch_array($sql1)){

 
    $sql = db_query("select * from bingo_user_data where instance = '$_REQUEST[instance_id]' and userid = '$uid' and marked = 1  and card = '$row1[card]' and row != '13' order by id desc" );
    
    while($row = db_fetch_array($sql)){
    $aucdata=new stdClass();
	
	$aucdata->squares = $row['number'];
    
	array_push($arrResult, $aucdata);
    }
 }
 echo db_error();
 $sql = db_query("select distinct(number) from bingo_numbers where instance = '$_REQUEST[instance_id]' order by id desc limit 1" );
 
 while($row = db_fetch_array($sql)){
   $aucdata=new stdClass();
     $aucdata->sound = $row['number'];
 
     array_push($arrResult, $aucdata);
 
 
 }
 $sql = db_query("select distinct(number) from bingo_numbers where instance = '$_REQUEST[instance_id]' order by id desc" );
 
 while($row = db_fetch_array($sql)){
  $aucdata1=new stdClass();
     $aucdata1->balls = $row['number'];
 

   if(db_num_rows(db_query("select * from bingo_numbers where instance = '$_REQUEST[instance_id]'")) >= 1){
 
	
	$aucdata1->started = 'true';
	
      }
      array_push($arrResult, $aucdata1);     
 }

 
 $sql = db_query("select bud.number, bud.card, bud.userid, bw.place from bingo_numbers left join bingo_user_data bud on bud.instance = bingo_numbers.instance left join bingo_winners bw on bw.number = bud.winner and bw.number=bud.userid  left join registration r on r.id=bud.userid and r.username=bw.winner where bingo_numbers.instance = '$_REQUEST[instance_id]' and bud.winner >= '1' and bud.userid=$_REQUEST[userid] order by bingo_numbers.id desc" );
 
 while($row = db_fetch_array($sql)){
  $aucdata=new stdClass();
  if($row['userid'] == $_REQUEST['userid']){
     $aucdata->winning_card = $row['card'];
   }
     $aucdata->winner = $row['number'];
     $aucdata->userid = $row['userid'];
    
     array_push($arrResult, $aucdata);
 
 }
 
 $aucdata3=new stdClass();

 $places = array('first', 'second', 'third');
 foreach($places as $place){
 echo db_error();
 $sql = db_query("select * from bingo_winners left join registration r on r.username = bingo_winners.winner where place = '$place' and instance = '$_REQUEST[instance_id]'");
 if(db_num_rows($sql) >= 1){
 $i = 0;
  while($row = db_fetch_array($sql)){
        $user_places = array();
        $user_places = array('userid' => $row['id'], 'username' => $row['username'], 'card' => $row['user_data_id']);
        $aucdata3->places[$place][$i] = $user_places; 
     $i++;
     }
   
 }
}
      
 
	  array_push($arrResult, $aucdata3);
	  
echo json_encode(array('result' => 'success', 'data' => array_values($arrResult), 'time' => microtime_float() - $starttime));
