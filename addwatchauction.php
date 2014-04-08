<?php
	include("config/connect.php");
	include("session.php");
        
	$aucid = $_REQUEST["aid"];
	$userid = $_SESSION["userid"];
	
	$qrysel = "select * from watchlist where user_id='$userid' and auc_id='$aucid'";
	
	$ressel = db_query($qrysel);
	$total = db_num_rows($ressel);
	if($total==0)
	{
		$qryins = "insert into watchlist (user_id,auc_id) values('$userid','$aucid')";
		
		db_query($qryins) or die(db_error());
		
		$qrysel = "select * from watchlist where user_id='$userid'";
	
		$ressel = db_query($qrysel);
		$total = db_num_rows($ressel);
		    $array=array();
		    while($obj=  db_fetch_array($result)){
			array_push($array, $obj['auc_id']);
		    }
		echo json_encode(array('message'=>'ok','data'=>$array, 'total' => $total));
		
		}
		
	
?>