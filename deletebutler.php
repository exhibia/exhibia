<?php
	include("config/connect.php");
	include("session.php");
	
//To allow a user to delete there bidbutler while it is running change the variable below to yes
     $allow_delete_while_running = 'no';

     
     
     if($allow_delete_while_running == 'yes'){
     
      include("deletebutler_while_running.php");
     
	die();
     }else{
	$uid = $_SESSION["userid"];
	
	$id = $_GET["delid"];	
	
	if($id!="" && $uid!="")
	{
		$qrysel="select * from bidbutler b left join auction a on a.auctionID=b.auc_id where b.id='$id' and b.butler_status='0'";
		$ressel = db_query($qrysel);
		$totalf = db_num_rows($ressel);
		$obj = db_fetch_object($ressel);
		
		if($obj->used_bids==0 && $obj->butler_status==0 && $totalf>0)
		{
			$aucid = $obj->auc_id;
			$qryd = "update bidbutler set butler_status='1' where id='$id' and used_bids=0";
			db_query($qryd) or die(db_error());
			
			$qryreg = "select * from registration where id='$uid'";
			$resreg = db_query($qryreg);
			$objreg = db_fetch_object($resreg);
			if($obj->use_free=="1")
			{
				$fbids = $objreg->free_bids;
				$pbids = $obj->butler_bid;			
				$finalbids = $fbids + $pbids;

				$qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag) values('$uid',NOW(),'$pbids','".$aucid."','".$obj->productID."','b')";
			db_query($qryins) or die(db_error());
			
				$qryupd = "update registration set free_bids='$finalbids' where id='$uid'";
				db_query($qryupd) or die(db_error());
			}
			else
			{
				$fbids = $objreg->final_bids;
				$pbids = $obj->butler_bid;			
				$finalbids = $fbids + $pbids;
	
				$qryins = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag) values('$uid',NOW(),'$pbids','".$aucid."','".$obj->productID."','b')";
			db_query($qryins) or die(db_error());
			
				$qryupd = "update registration set final_bids='$finalbids' where id='$uid'";
				db_query($qryupd) or die(db_error());
			}
			
			$qrysel = "select * from bidbutler where user_id='$uid' and auc_id='$aucid' and butler_status='0' order by id desc limit 0,20";
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
	
	
    }
?>