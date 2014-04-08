<?php
	include("config/connect.php");
	include("functions.php");
        
	//rateid=0 it referred for thumb_up
	//rateid=1 it referred for thumb_down
	
	$rateid = $_GET["rat"];
	$comid  = $_GET["cid"];
	$uid = $_SESSION["userid"];
	
	$qrycheck = "select user_id from community_comment where id='".$comid."'";
	$rescheck = db_query($qrycheck);
	$objcheck = db_fetch_array($rescheck);
	
	if($objcheck["user_id"]==$uid)
	{
		echo "yourcomm";
		exit;
	}
	
	$qrysel = "select * from community_rating where user_id='".$uid."' and comment_id='".$comid."'";
	$ressel = db_query($qrysel);
	$total = db_num_rows($ressel);
	
	if($total>0)
	{
		echo "moreone";
		exit;
	}

	if($uid!="" && $comid!="" && $rateid!="" && $total==0)
	{

		$qryins = "Insert into community_rating (user_id,comment_id,status) values('".$uid."','".$comid."','".$rateid."')";
		db_query($qryins) or die(db_error());
		
		if($rateid==0)
		{
			$qryupd = "update community_comment set thumb_up=thumb_up+1 where id='".$comid."'";
			db_query($qryupd) or die(db_error());
		}
		if($rateid==1)
		{
			$qryupd = "update community_comment set thumb_down=thumb_down+1 where id='".$comid."'";
			db_query($qryupd) or die(db_error());
		}
		
		$qrygen = "select * from general_setting where id='3'";
		$resgen = db_query($qrygen);
		$objgen = db_fetch_array($resgen);
		
		if($objgen["login_flag"]==1 && $objgen["login_points"]>0 && $rateid==0)
		{
			$qryupd = "update registration set free_bids=free_bids + ".$objgen["login_points"]." where id='".$objcheck["user_id"]."'";
			db_query($qryupd) or die(db_error());
			
			$qryinsf = "Insert into free_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('".$objcheck["user_id"]."',NOW(),'".$objgen["login_points"]."','c','rt','Rating Free Points')";
			db_query($qryinsf) or die(db_error());
		}
		
		echo "success|".GetCommunityRating($comid)."|".$comid;
	}
?>