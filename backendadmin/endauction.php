<?
//	include("connect.php");
//
//	function begin()
//	{
//		db_query("BEGIN");
//	}
//	function commit()
//	{
//		db_query("COMMIT");
//	}
//	function rollback()
//	{
//		db_query("ROLLBACK");
//	}
//
//	$auctionid = $_GET["aid"];
//
//	if($auctionid!="")
//	{
//		$qrysel = "select * from auction a left join bid_account ba on a.auctionID=ba.auction_id left join auction_management am on a.time_duration=am.auc_manage  left join auc_due_table adt on a.auctionID=adt.auction_id where a.auctionID='".$auctionid."' order by ba.id desc limit 0,1";
//		$ressel = db_query($qrysel);
//		$total	= db_num_rows($ressel);
//		$obj = db_fetch_object($ressel);
//
//		$fprice1 = $obj->bidding_price;
//
//		if($fprice1=="")
//		{
//			if($obj->pennyauction=='1')
//			{
//				$fprice = $obj->auc_start_price + 0.01;
//			}
//			else
//			{
//				$fprice = $obj->auc_start_price + $obj->auc_plus_price;
//			}
//		}
//		else
//		{
//			if($obj->pennyauction=='1')
//			{
//				$fprice = $fprice1 + 0.01;
//			}
//			else
//			{
//				$fprice = $fprice1 + $obj->auc_plus_price;
//			}
//		}
//
//		begin();
//
//		$qryupd1 = "update auction set auc_status='3', buy_user='3',auc_final_price='$fprice',auc_final_end_date=NOW() where auctionID='$auctionid'";
//		$result1 = db_query($qryupd1);
//		if(!$result1)
//		{
//			rollback();
//			echo "Failed";
//			exit;
//		}
//
//
//		$qryupd2 = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time) values('3',NOW(),'1','$auctionid','".$obj->productID."','d','$fprice','s','".$obj->auc_due_time."')";
//		$result2 = db_query($qryupd2);
//		if(!$result2)
//		{
//			rollback();
//			echo "Failed";
//			exit;
//		}
//
//		$qryupd3 = "update auc_due_table set auc_due_time='0',auc_due_price='$fprice' where auction_id='$auctionid'";
//		$result3 = db_query($qryupd3);
//		if(!$result3)
//		{
//			rollback();
//			echo "Failed";
//			exit;
//		}
//
//		$qryupd4 = "update registration set final_bids=final_bids-1 where id='3'";
//		$result4 = db_query($qryupd4);
//		if(!$result4)
//		{
//			rollback();
//			echo "Failed";
//			exit;
//		}
//
//		$qryupd5 = "Insert into won_auctions(auction_id,won_date,userid) values('$auctionid',NOW(),'3')";
//		$result5 = db_query($qryupd5);
//		if(!$result5)
//		{
//			rollback();
//			echo "Failed";
//			exit;
//		}
//		commit();
//		echo "Success|".$auctionid;
//	}
?>