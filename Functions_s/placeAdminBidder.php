<?php


function placeAdminBidder($aucid, $newtime, $aucusefree) {
    global $adminautobidtype, $topbidercount, $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $rettime = $newtime;

    if ($newtime >= 0) {

        $sqlc = "select count(*) from bidbutler b inner join registration r on r.id=b.user_id where auc_id=$aucid and butler_bid>used_bids and butler_status=0 and admin_user_flag='1'";
        $retc = db_query($sqlc);
        if (db_result($retc, 0) <= 0) {
            UpdateCompleteButlers($aucid, $aucusefree);
            return $rettime;
        }


        $aucSql = "select pennyauction, auc_plus_price, auc_plus_time, max_plus_time, productID, auc_start_price,uniqueauction,reverseauction,lockauction,locktype,lockprice,locktime " .
                "from auction_running a left join auction_management am on a.time_duration=am.auc_manage " .
                "where a.auctionID=$aucid and a.pause_status=0 and auc_status=2";
        $aucResult = db_query($aucSql);

        if (db_num_rows($aucResult) > 0) {
            //when have auction to bid
            $auc = db_fetch_object($aucResult);
            $plusprice = ( $auc->pennyauction == 1 ) ? 0.01 : ($auc->auc_plus_price == 0 ? 0.01 : $auc->auc_plus_price);

            $pid = $auc->productID;

            if ($newtime < $auc->max_plus_time) {
                $ntime = $auc->max_plus_time + 2;
            } else {
                $ntime = $newtime;
            }

            if ($aucusefree == 1) {
                $topbidQry = "select user_id, bidding_price " .
                        "from free_account_bidding " .
                        "where auction_id=$aucid order by id desc limit 0,1";
            } else {
                $topbidQry = "select user_id, bidding_price " .
                        "from bid_account_bidding " .
                        "where auction_id=$aucid order by id desc limit 0,1";
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
                $newprice = $price - $plusprice;
            } else {
                $newprice = $price + $plusprice;
            }

            if ($auc->reverseauction == false) {
                $andbulterwhere = "butler_start_price<='$newprice' and butler_end_price>='$newprice'";
            } else {
                $andbulterwhere = "butler_start_price>='$newprice' and butler_end_price<='$newprice'";
            }



            $butlerQry = "select b.id as id, user_id,username,position, used_bids, butler_bid, butler_end_price,admin_user_flag " .
                    "from bidbutler b inner join registration r on r.id=b.user_id where auc_id=$aucid and $andbulterwhere and butler_bid>used_bids and butler_status=0 and user_id>'$topUserid' and admin_user_flag='1' order by user_id asc limit 0,1";
            $buylerResult = db_query($butlerQry);
            if (db_num_rows($buylerResult) <= 0) {
                $butlerQry = "select b.id as id, user_id,username,position, used_bids, butler_bid, butler_end_price,admin_user_flag " .
                        "from bidbutler b inner join registration r on r.id=b.user_id where auc_id=$aucid and $andbulterwhere and butler_bid>used_bids and butler_status=0 and user_id<'$topUserid' and admin_user_flag='1' order by user_id asc limit 0,1";
                $buylerResult = db_query($butlerQry);
            }
            //when have user to autobid
            if (db_num_rows($buylerResult) > 0) {
                $buyler = db_fetch_object($buylerResult);

                $username = $buyler->user_id;

                $placedbids = $buyler->butler_bid;
                $usedbids = $buyler->used_bids;
                $id = $buyler->id;

                if ($auc->lockauction == true) {
                    if (($auc->locktype == 1 && $auc->locktime >= $newtime) || ($auc->locktype == 2 && (($auc->reverseauction == false && $auc->lockprice <= $price) || ($auc->reverseauction == true && $auc->lockprice >= $price)))) {
                        if ($aucusefree == 1) {
                            $qrybids = "select count(*) from free_account_bidding where auction_id='" . $aucid . "' and user_id='$username' order by id desc limit 0,1";
                        } else {
                            $qrybids = "select count(*) from bid_account_bidding where auction_id='" . $aucid . "' and user_id='$username' order by id desc limit 0,1";
                        }

                        $bidsresult = db_query($qrybids);
                        if (db_result($bidsresult, 0) < 1) {
                            return $newtime;
                        }
                    }
                }

//                $bidtype = 'b';
//                if ($buyler->admin_user_flag == '1') {
//                    $bidtype = $adminautobidtype;
//                }
                $bidtype = $adminautobidtype;
                begin();

                $uptsql = "update auc_due_table set auc_due_price='$newprice' ";
                if ($ntime != $newtime) {
                    $uptsql.=",auc_due_time='$ntime' ";
                }
                $uptsql.=" where auction_id=$aucid";

                if (!db_query($uptsql)) {
                    rollback();
                    echo "test9Failed";
                    return $rettime;
                }

                if ($aucusefree == 1) {
                    $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time)  values('$username',NOW(),'1','$aucid','$pid','d','$newprice','$bidtype','$ntime')";
                    $qryins1 = "Insert into free_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$username',NOW(),'1','$aucid',$newprice,'$bidtype','{$buyler->username}','{$buyler->position}')";
                } else {
                    $qryins = "Insert into bid_account  (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time)  values('$username',NOW(),'1','$aucid','$pid','d','$newprice','$bidtype','$ntime')";
                    $qryins1 = "Insert into bid_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$username',NOW(),'1','$aucid',$newprice,'$bidtype','{$buyler->username}','{$buyler->position}')";
                }
                if (!db_query($qryins)) {
                    rollback();
                    echo "test10Failed";
                    return $rettime;
                }

                if (!db_query($qryins1)) {
                    rollback();
                    echo "test11Failed";
                    return $rettime;
                }



                if (!db_query("update bidbutler set used_bids=used_bids+1 where id=$id")) {
                    rollback();
                    echo "test12Failed";
                    return $rettime;
                }

                if (!$auc->uniqueauction) {
                    updateAuctionBidding($aucid, $ntime, $newprice, $aucusefree, $username, $buyler->username, $topbidercount, $ntime != $newtime);
                }

                commit();

                $rettime = $ntime;
            }
            db_free_result($buylerResult);
        }

        db_free_result($aucResult);
    }
    //UpdateCompleteButlers($aucid, $aucusefree);
    return $rettime;
}
