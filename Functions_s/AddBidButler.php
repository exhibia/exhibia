<?php


function AddBidButler($aucid, $newtime, $aucusefree) {

                           

    global $adminautobidtype, $topbidercount;
    $rettime = $newtime;
    
    
    $colors = new Colors_CLI();
      echo $colors->getColoredString("[[" . date("Y-m-d H:i:s") . "]] ***********Calling AddBidButler from functions_s.php for Auction  => $aucid************", "green") . "\n";
    
    
    if ($newtime >= -4) {
        $sqlc = "select count(*) from bidbutler b inner join registration r on r.id=b.user_id where auc_id=$aucid and butler_bid>used_bids and butler_status=0";
        $retc = db_query($sqlc);
        if (db_result($retc, 0) <= 0) {
        
        
        echo $colors->getColoredString("***********Updating Completed Butlers for Auction $aucid************", "magenta") . "\n";
        
        
            UpdateCompleteButlers($aucid, $aucusefree);
            return -1;
        }

        $aucSql = "select pennyauction, auc_plus_price, auc_plus_time, max_plus_time, productID, auc_start_price,uniqueauction,reverseauction,lockauction,locktype,lockprice,locktime " .
                "from auction_running a inner join auction_management am on a.time_duration=am.auc_manage " .
                "where a.auctionID=$aucid and a.pause_status=0 and auc_status=2";
        $aucResult = db_query($aucSql);

        if (db_num_rows($aucResult) > 0) {
            //when have auction to bid
            $auc = db_fetch_object($aucResult);
            $plusprice = ( $auc->pennyauction == 1 ) ? 0.01 : ($auc->auc_plus_price == 0 ? 0.01 : $auc->auc_plus_price);

            $pid = $auc->productID;

            if ($newtime <= $auc->max_plus_time) {//lower nuumber is max_plus_time thiis is the kick
                $ntime = $auc->auc_plus_time + 2;
            

            if ($aucusefree == 1) {
                $topbidQry = "select user_id, bidding_price " .
                        "from free_account_bidding " .
                        "where auction_id=$aucid order by id desc limit 0,1";
            echo $colors->getColoredString("***********Getting Top Bid for Auction => $aucid From Free Accounts************", "purple") . "\n";
            } else {
                $topbidQry = "select user_id, bidding_price " .
                        "from bid_account_bidding " .
                        "where auction_id=$aucid order by id desc limit 0,1";
            echo $colors->getColoredString("***********Getting Top Bid for Auction => $aucid************", "yellow") . "\n";
            }
            $topbidQryResult = db_query($topbidQry);

            if (db_num_rows($topbidQryResult) > 0) {
                //when have user bid,get the current price and top user
                $topbid = db_fetch_object($topbidQryResult);
                $price = ( $topbid->bidding_price == "" ) ? ( ( $auc->auc_start_price != "" ) ? $auc->auc_start_price : "0.00" ) : $topbid->bidding_price;
                $topUserid = $topbid->user_id;
            } else {
                //when no user bid
                $topUserid = 0;
                $price = ($auc->auc_start_price != "") ? $auc->auc_start_price : "0.00";
            }
            db_free_result($topbidQryResult);

            if ($auc->reverseauction == true) {
		echo $colors->getColoredString("***********Updating Price For Reverse Auction for Auction => $aucid************", "yellow") . "\n";
                $newprice = $price - $plusprice;
            } else {
                $newprice = $price + $plusprice;
                echo $colors->getColoredString("***********Updating Price for Auction => $aucid************", "yellow") . "\n";
            }

            if ($auc->reverseauction == false) {
                $andbulterwhere = "butler_start_price<='$newprice' and butler_end_price>='$newprice'";
            } else {
                $andbulterwhere = "butler_start_price>='$newprice' and butler_end_price<='$newprice'";
            }

            $butlerQry = "select b.id as id, user_id,username,position, used_bids, butler_bid, butler_end_price,admin_user_flag " .
                    "from bidbutler b inner join registration r on r.id=b.user_id where auc_id=$aucid and $andbulterwhere and butler_bid>used_bids and butler_status=0 and user_id>'$topUserid' order by user_id asc limit 0,1";
            $buylerResult = db_query($butlerQry);
            if (db_num_rows($buylerResult) <= 0) {
                $butlerQry = "select b.id as id, user_id,username,position, used_bids, butler_bid, butler_end_price,admin_user_flag " .  "from bidbutler b inner join registration r on r.id=b.user_id where auc_id=$aucid and $andbulterwhere and butler_bid>used_bids and butler_status=0 and user_id<'$topUserid' order by user_id asc limit 0,1";
                $buylerResult = db_query($butlerQry);
            }

            
            //when have user to autobid
            if (db_num_rows($buylerResult) > 0) {
                $buyler = db_fetch_object($buylerResult);


                $username = $buyler->user_id;

                $placedbids = $buyler->butler_bid;
                $usedbids = $buyler->used_bids;
                $id = $buyler->id;
                
                
                if($buyler->admin_user_flag == '1'){
                
		    echo $colors->getColoredString("***********UPDATING BUTLER FROM ADMIN AUTO BIDDER as $username for Auction => $aucid************", "red") . "\n";
                           
                
                }else{
                
                
		  echo $colors->getColoredString("***********UPDATING BUTLER FOR REGULAR USER $username for Auction   => $aucid************", "red") . "\n";
                
                
                
                }

                if ($auc->lockauction == true) {
                    if (($auc->locktype == 1 && $auc->locktime >= $newtime) || ($auc->locktype == 2 && (($auc->reverseauction == false && $auc->lockprice <= $price) || ($auc->reverseauction == true && $auc->lockprice >= $price)))) {
                        if ($aucusefree == 1) {
			    echo $colors->getColoredString("***********Upddating Free Points For  => $aucid************", "yellow") . "\n";
                            $qrybids = "select count(*) from free_account_bidding where auction_id='" . $aucid . "' and user_id='$username' order by id desc limit 0,1";
                        } else {
                        
			    echo $colors->getColoredString("***********Upddating Bids For  => $aucid************", "yellow") . "\n";
                           
                            $qrybids = "select count(*) from bid_account_bidding where auction_id='" . $aucid . "' and user_id='$username' order by id desc limit 0,1";
                        }

                        $bidsresult = db_query($qrybids);
                        if (db_result($bidsresult, 0) < 1) {
                            return $rettime;
                        }
                    }
                }

                $bidtype = 'b';
                if ($buyler->admin_user_flag == '1') {
                    $bidtype = $adminautobidtype;
                }

                begin();
                $uptsql = "update auc_due_table set auc_due_price='$newprice' ";
                if ($ntime != $newtime) {
                    $uptsql.=",auc_due_time='$ntime' ";
                }
                $uptsql.=" where auction_id=$aucid";

                if (!db_query($uptsql)) {
                    rollback();
                    echo "test13Failed";
                    return -1;
                }

                if ($aucusefree == 1) {
                    $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time)  values('$username',NOW(),'1','$aucid','$pid','d','$newprice','$bidtype','$ntime')";
                    $qryins1 = "Insert into free_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$username',NOW(),'1','$aucid',$newprice,'$bidtype','{$buyler->username}','{$buyler->position}')";
                } else {
                    $qryins = "Insert into bid_account  (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time)  values('$username',NOW(),'1','$aucid','$pid','d','$newprice','$bidtype','$ntime')";
                    $qryins1 = "Insert into bid_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position, timestamp) values('$username',NOW(),'1','$aucid',$newprice,'$bidtype','{$buyler->username}','{$buyler->position}', " . time() . ")";
                }
                if (!db_query($qryins)) {
                    rollback();
                    echo "test14Failed";
                    return -1;
                }

                if (!db_query($qryins1)) {
                    rollback();
                    echo "test15Failed";
                    return -1;
                }


                if (!db_query("update bidbutler set used_bids=used_bids+1 where id=$id")) {
                    rollback();
                    echo "test16Failed";
                    return -1;
                }

                if (!$auc->uniqueauction) {
                    updateAuctionBidding($aucid, $ntime, $newprice, $aucusefree, $username, $buyler->username, $topbidercount, $ntime != $newtime);
                }

                commit();
            } else {
                return -1;
            }
            db_free_result($buylerResult);

            $rettime = $ntime;
            }
        } else {
            return -1;
        }

        db_free_result($aucResult);
    } else {
        return -1;
    }

    //UpdateCompleteButlers($aucid, $aucusefree);
    return $rettime;
}

