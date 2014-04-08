<?php


///Do not ever use on any site but kelebids...this intance allows removing a user's bid butler while it is running...it may however be useful if ever asked for this feature again
	include("config/config.inc.php");
	include("session.php");
        include("Functions/update_users_bids.php");
	$uid = $_SESSION["userid"];
	
	$id = $_GET["delid"];
	$aid = $_GET['aid'];
	$finalbids1 = 0;
	ini_set('display_errors', 1);
	
	
	
	if($_GET['all'] == 'true'){
	
	
	    $qry = db_query("select * from bidbutler where auc_id = '$aid' and user_id = '$uid' and butler_status = 0");
	    while($unusedbids = db_fetch_array($qry)){
	
		  $finalbids1 = $unusedbids['butler_bid'];
	    }
	    	
	$qrysel="select * from bidbutler b left join auction a on a.auctionID=b.auc_id";
	
	$ressel = db_query($qrysel);
	$totalf = db_num_rows($ressel);
	$obj = db_fetch_object($ressel);
		
	    if($totalf>0)
		{
	    
			$aucid = $obj->auc_id;
			$qryd = "delete from bidbutler where auc_id = '$aid' and user_id = '$uid'";
		//	echo $qryd;
			db_query($qryd) or die(db_error());
			
			$qryreg = "select * from registration where id='$uid'";
			$resreg = db_query($qryreg);
			$objreg = db_fetch_object($resreg);
			if($obj->use_free=="1")
			{
				$qrysel="select * from bidbutler b left join auction a on a.auctionID=b.auc_id where b.id='$id'";
		$ressel = db_query($qrysel);
		$totalf = db_num_rows($ressel);
		$obj = db_fetch_object($ressel);
		
		if( $totalf>0)
		{
			$aucid = $obj->auc_id;
			$qryd = "update bidbutler set butler_status='1' where id='$id'";
			db_query($qryd) or die(db_error());
			
			$qryreg = "select * from registration where id='$uid'";
			$resreg = db_query($qryreg);
			$objreg = db_fetch_object($resreg);
			if($obj->use_free=="1")
			{
				$fbids = $objreg->free_bids;
				$pbids = $obj->butler_bid;			
				$finalbids = $fbids + $pbids + $finalbids1;

				update_users_bids($uid);
				
				
				$user_bids = get_users_bids($uid);
			}
			
			}

			
			}else{
			
				$fbids = $objreg->final_bids;
				$pbids = $obj->butler_bid;			
				$finalbids = $fbids + $pbids;
	
				update_users_bids($uid);
				
				
				$user_bids = get_users_bids($uid);
			}
		
			
			$qrysel = "select * from bidbutler where user_id='$uid' and auc_id='$aucid' order by id desc limit 0,20";
			$ressel = db_query($qrysel);
			$total = db_num_rows($ressel);
			
			for($i=1;$i<=$total;$i++)
			{
				$obj = db_fetch_object($ressel);
				if($i==1)
				{
					$bidbutler = '{"bidbutler":{"startprice":"'.number_format($obj->butler_start_price,2).'","endprice":"'.number_format($obj->butler_end_price,2).'","bids":"'.$obj->butler_bid.'","id":"'.$obj->id.'","usedbids":"'.$obj->used_bids.'"}}';
				}
				else
				{
					$bidbutler .= ',{"bidbutler":{"startprice":"'.number_format($obj->butler_start_price,2).'","endprice":"'.number_format($obj->butler_end_price,2).'","bids":"'.$obj->butler_bid.'","id":"'.$obj->id.'","usedbids":"'.$obj->used_bids.'"}}';
				}
			}
			
		}
	
			      $points  = db_fetch_array(db_query("select free_bids, final_bids from registration where id = $uid"));
			
				echo '{"all": "true", "free_bids":"' . $points['free_bids'] . '", "final_bids":"' . $points['final_bids'] . '"}';
	
	}else
	if($id!="" && $uid!="")
	{
	
		$qrysel="select * from bidbutler b left join auction a on a.auctionID=b.auc_id where b.id='$id'";
		$ressel = db_query($qrysel);
		$totalf = db_num_rows($ressel);
		$obj = db_fetch_object($ressel);
		
		if($totalf>0)
		{
			$aucid = $obj->auc_id;
			$qryd = "update bidbutler set butler_status='1' where id='$id'";
			db_query($qryd) or die(db_error());
			
			$qryreg = "select * from registration where id='$uid'";
			$resreg = db_query($qryreg);
			$objreg = db_fetch_object($resreg);
			if($obj->use_free=="1")
			{
				$fbids = $objreg->free_bids;
				$pbids = $obj->butler_bid;			
				$finalbids = $fbids + $pbids + $finalbids1;
				update_users_bids($uid);
				
				
				$user_bids = get_users_bids($uid);
			
			}
			else
			{
				$fbids = $objreg->final_bids;
				$pbids = $obj->butler_bid;			
				$finalbids = $fbids + $pbids + $finalbids1;
	
				update_users_bids($uid);
				
				
				$user_bids = get_users_bids($uid);
			}
			
			$qrysel = "select * from bidbutler where user_id='$uid' and auc_id='$aucid' order by id desc limit 0,20";
			$ressel = db_query($qrysel);
			$total = db_num_rows($ressel);
			
			for($i=1;$i<=$total;$i++)
			{
				$obj = db_fetch_object($ressel);
				if($i==1)
				{
					$bidbutler = '{"bidbutler":{"startprice":"'.number_format($obj->butler_start_price,2).'","endprice":"'.number_format($obj->butler_end_price,2).'","bids":"'.$obj->butler_bid.'","id":"'.$obj->id.'","usedbids":"'.$obj->used_bids.'"}}';
				}
				else
				{
					$bidbutler .= ',{"bidbutler":{"startprice":"'.number_format($obj->butler_start_price,2).'","endprice":"'.number_format($obj->butler_end_price,2).'","bids":"'.$obj->butler_bid.'","id":"'.$obj->id.'","usedbids":"'.$obj->used_bids.'"}}';
				}
			}
	
				echo '{"butlerslength":['.$bidbutler.']}';
		}
		else
		{
		echo '[{"result":"unsuccess","message":"'.MESSAGE_BIDDING_IS_RUNNING.'"}]';
		}
	}
?>