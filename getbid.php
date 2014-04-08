<?php

include("config/connect.php");
include("functions_s.php");
include("session.php");

if ($_SERVER["HTTP_X_REQUESTED_WITH"] != "XMLHttpRequest") {
  //  exit;
}
usleep(0.2*1000000);
if ($_GET["prid"] != "" && $_GET["uid"] && $_GET["aid"]) {

    $prid = chkInput($_GET["prid"], 'i');
    $uid = $_SESSION["userid"];
    $verify = db_num_rows(db_query("select * from registration where ID = '$uid' and (facebook = '' and google = '' and twitter = '')"));
    if($verify == 0){
     echo '[{"result":"unsuccess","message":"we can put something here. The above condition has been temporarily<br /> reversed meaning that it matches the opposite of what<br /> it should match after testing this and adding modal<br /> code change it $verify > 0 instead of $verify == 0"}]';
            exit;
    
    }
    $aid = chkInput($_GET["aid"], 'i');
    $bids_to_take = db_fetch_object(db_query("select bids_to_take from auction where auctionID = $aid limit 1"));
    $bids_to_take = $bids_to_take->bids_to_take;
    $escroe = db_num_rows(db_query("select * from auction where auctionId = $aid and escroe = 1 and pause_status=1"));
    if(db_num_rows(db_query("select * from sitesetting where name = 'prompt_confirm' and status != ''")) >= 1) {
	if (allowWinInWeek($uid) == false) {
	    echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_REACHED_TO_WEEK_LIMIT)) . '"}]';
	    exit;
	}
    if (allowWinInMonth($uid) == false) {
        echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_REACHED_TO_MONTH_LIMIT)) . '"}]';
        exit;
    }

    $q = "select * from auc_due_table adt inner join auction_running a on adt.auction_id=a.auctionID inner join auction_management am on a.time_duration=am.auc_manage where auction_id=$aid and auc_due_time>0 and a.pause_status=0 and (auc_status=2 or auc_status=1)";
    $r = db_query($q);
    if (db_num_rows($r) > 0) {
        $ob = db_fetch_object($r);
	if(db_num_rows(db_query("select * from auction left join free_account_bidding fr on fr.auction_id=auction.auctionID left join bid_account_bidding ba on ba.auction_id=auction.auctionID where auc_status = '3' and (fr.user_id = '$_SESSION[userid]' or ba.user_id='$_SESSION[userid]')"))>=1 & $ob->beginner_auction == true){
            echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", ONLY_NEW_USERS_ARE_ALLOWED_TO_BID_ON_BEGINNER_AUCTIONS)) . '"}]';
            exit;	
	}
        if ($ob->use_free == 1) {
            $qrycheck = "select user_id from free_account_bidding where auction_id='" . $aid . "' order by id desc limit 0,1";
        } else {
            $qrycheck = "select user_id from bid_account_bidding where auction_id='" . $aid . "' order by id desc limit 0,1";
        }
        $rescheck = db_query($qrycheck);
        $objcheck = db_fetch_array($rescheck);
        if ($objcheck["user_id"] == $uid & db_num_rows(db_query("select * from auction where auctionID = '$aid' and allow_multi_bid = '0'")) >= 1) {
            echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_TOP_BIDDER)) . '"}]';
            exit;
        }
        if ($ob->lockauction == true) {
            if (($ob->locktype == 1 && $ob->locktime >= $ob->auc_due_time) || ($ob->locktype == 2 && (($ob->reverseauction == false && $ob->lockprice <= $ob->auc_due_price) || ($ob->reverseauction == true && $ob->lockprice >= $ob->auc_due_price)))) {
                if ($ob->use_free == 1) {
                    $qrybids = "select count(*) from free_account_bidding where auction_id='" . $aid . "' and user_id='$uid' order by id desc limit 0,1";
                } else {
                    $qrybids = "select count(*) from bid_account_bidding where auction_id='" . $aid . "' and user_id='$uid' order by id desc limit 0,1";
                }
                $bidsresult = db_query($qrybids);
                if (db_result($bidsresult, 0) < 1) {
                    echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_LOCK_AUCTION)) . '"}]';
                    exit;
                }
            }
        }

        if ($ob->seatauction == true) {
            $seatqry = "select count(*) from auction_seat where auction_id=$aid";
            $seatret = db_query($seatqry);
            $seatcount = db_result($seatret, 0);
            db_free_result($seatret);
            if ($seatcount < $ob->minseats) {
                echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_NOT_REACHED_TO_MIN_SEATS)) . '"}]';
                exit;
            }

            $seatqry1 = "select count(*) from auction_seat where auction_id='$aid' and user_id='$uid'";
            $seatret1 = db_query($seatqry1);
            if (db_result($seatret1, 0) <= 0) {
                echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_DONT_HAVE_SEAT)) . '"}]';
                exit;
            }
        }
	update_users_bids($uid);
        $qrysel = "select final_bids,free_bids,username,position from registration where id=$uid";
        $ressel = db_query($qrysel);
        $obj = db_fetch_object($ressel);
        if ($ob->use_free == 1) {
            $bal = $obj->free_bids;
            $useonlyfree = 1;
        } else {
            $bal = $obj->final_bids;
            $useonlyfree = 0;
        }

			//////////////////////////////////////////////////////////////////////////////////
			/// Begin Bugfix
			/// Clear Idea Technology
			/// Trent Raber
			/// 2012-05-02
			/// Fix to prevent bidding with negative bids
			//////////////////////////////////////////////////////////////////////////////////
			  if ($bal <= $bids_to_take && $ob->use_free == 1) {
			      echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_DONT_HAVE_FREE_POINTS)) . '"}]';
			      exit;
			  }
			  if ($bal <= $bids_to_take && $ob->use_free == 0) {
			      echo '[{"result":"nobids","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_DONT_HAVE_FINAL_POINTS)) . '"}]';
			      exit;
			  }
			//////////////////////////////////////////////////////////////////////////////////
			/// End Bugfix
			//////////////////////////////////////////////////////////////////////////////////
	  if ($ob->pause_status != '1' && ($ob->auc_status == '2' | $ob->status == '1')) {
            $oldtime = $ob->auc_due_time;
            $oldprice = $ob->auc_due_price;
            $plusprice = $ob->auc_plus_price;
            /* Change for plus or minus random timer */
            //$plustime = rand($ob->auc_plus_time, $ob->max_plus_time);
		if(db_num_rows(db_query("SELECT * from auction where auctionID = '$aid' and cashauction = '1'")) >= 1){
		      if ($ob->reverseauction == false) {
			  if ($ob->pennyauction == 1) {
			      $newprice = $oldprice + 0.00;
			  } else {
			      $newprice = $oldprice + $plusprice;
			  }
		      } else {
			  if ($ob->pennyauction == 1) {
			      $newprice = $oldprice - 0.00;
			  } else {
			      $newprice = $oldprice - $plusprice;
			  }
		      }

		      if ($oldtime <= $ob->auc_plus_time) {
			  $newtime = $ob->auc_plus_time + 2;
		      } else {
			  $newtime = $oldtime;
		      }
		 }else{
			if ($ob->reverseauction == false) {
			    if ($ob->pennyauction == 1) {
				$newprice = $oldprice + 0.00;
			    } else {
				$newprice = $oldprice + $plusprice;
			    }
			} else {
			    if ($ob->pennyauction == 1) {
				$newprice = $oldprice - 0.00;
			    } else {
				$newprice = $oldprice - $plusprice;
			    }
			}

			if ($oldtime <= $ob->auc_plus_time) {
			    $newtime = $ob->auc_plus_time + 2;
			} else {
			    $newtime = $oldtime;
			}
		}
            begin();
            /* End for plus or minus random timer */
            $qupd = "update auc_due_table set auc_due_price=$newprice";
            if ($newtime != $oldtime) {
                $qupd.=",auc_due_time=$newtime";
            }
            $qupd .= " where auction_id=$aid";
            $result1 = db_query($qupd);
            if (!$result1) {
                rollback();
                echo "Failed5";
                exit;
            }
            if ($ob->use_free == 1) {
		if(db_num_rows(db_query("SELECT * from auction where auctionID = '$aid' and cashauction = '1'")) >= 1){
		    $cashauction = '1';
		}else{
		    $cashauction = '0';
		    $final_bal = $bal - 1;

                    $qryins1 = "Insert into free_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$uid','" . date("Y-m-d H:i:s", time()) . "','" . $bids_to_take . "','$aid',$newprice,'s','{$obj->username}','{$obj->position}')";
		    $result = db_query($qryins1);
		    if (!$result) {
			rollback();
			echo "Failed";
			exit;
		    }
		    $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time) values('$uid','" . date("Y-m-d H:i:s", time()) . "','" . $bids_to_take . "','$aid','$prid','d',$newprice,'s'," . $oldtime . ")";
		    $result3 = db_query($qryins);

		    if (!$result3) {
			rollback();
			echo "Failed";
			exit;
		    }
	    update_users_bids($uid);

	    updateAuctionBidding($aid, $newtime, $newprice, $ob->use_free, $uid, $obj->username, $topbidercount, $newtime);
	      }
            } else {
		if(db_num_rows(db_query("SELECT * from auction where auctionID = '$aid' and cashauction = '1'")) >= 1){
		      $cashauction = '1';
		      $qryins1 = "Insert into bid_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$uid','" . date("Y-m-d H:i:s", time()) . "','" . $bids_to_take . "','$aid',$newprice,'s','{$obj->username}','{$obj->position}')";
		      $result = db_query($qryins1);
		      if (!$result) {
			  rollback();
			  echo "Failed2";
			  exit;
		      }

		      $qryins = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time) values('$uid','" . date("Y-m-d H:i:s", time()) . "','" . $bids_to_take . "','$aid','$prid','d',$newprice,'s'," . $oldtime . ")";
		      $result3 = db_query($qryins);
		      if (!$result3) {
			  rollback();
			  echo "Failed3";
			  exit;
		      }


		}else{
		    $cashauction = '0';
		    $final_bal =  $bal - $bids_to_take ;
		    $qryins1 = "Insert into bid_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$uid','" . date("Y-m-d H:i:s", time()) . "','" . $bids_to_take . "','$aid',$newprice,'s','{$obj->username}','{$obj->position}')";
		    $result = db_query($qryins1);
		    if (!$result) {
			rollback();
			echo "Failed2";
			exit;
		    }

		    $qryins = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time) values('$uid','" . date("Y-m-d H:i:s", time()) . "','" . $bids_to_take . "','$aid','$prid','d',$newprice,'s'," . $oldtime . ")";
		    $result3 = db_query($qryins);

		    if (!$result3) {
			rollback();
			echo "Failed3";
			exit;
		    }
		}
		update_users_bids($uid);
            }

        }
	    updateAuctionBidding($aid, $newtime, $newprice, $ob->use_free, $uid, $obj->username, $topbidercount, $newtime);
	    $qrysel = "select * from auc_due_table adt inner join auction_running a on a.auctionID=adt.auction_id left join auction_run_status ars on ars.auctionID=adt.auction_id inner join auction_management am on 
	    am.auc_manage=a.time_duration where auc_due_time>0 and a.pause_status=0 and auc_status=2 order by auction_id";
	    $ressel = db_query($qrysel);
       
		while ($obj = db_fetch_array($ressel)) {
		$heighuser=json_decode($obj['heighuser']);

		
		$p = count($heighuser); 
		if($p < 3){

		while($p <= 3){
		array_push($heighuser, "---");
		$p++;
		}
		}
		$obj['hu'] = $heighuser[0];
		$obj['tb'] = $heighuser[0];
		}
 
		commit();
            echo '[{"result":"success", "tb" : "' . $obj['tb'] . '", "hu": "' . $obj['hu'] . '", "id": "' . $_REQUEST['aid'] . '", "freebids":"' . $useonlyfree . '","bids":"' . $bids_to_take . '", "cashauction":"' . $cashauction . '"}]';
    } else {
            echo '[{"result":"unsuccess","id": "' . $_REQUEST['aid'] . '", "message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_AUCTION_ENDED . " " . "Or" . " " . NOT_YET_STARTED)) . '"}]';
    }
}else{
    $prid = chkInput($_GET["prid"], 'i');
    $uid = $_SESSION["userid"];
    $aid = chkInput($_GET["aid"], 'i');
    if (allowWinInWeek($uid) == false) {
        echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_REACHED_TO_WEEK_LIMIT)) . '"}]';
        exit;
    }

    if (allowWinInMonth($uid) == false) {
        echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_REACHED_TO_MONTH_LIMIT)) . '"}]';
        exit;
    }

    $q = "select * from auc_due_table adt inner join auction_running a on adt.auction_id=a.auctionID inner join auction_management am on a.time_duration=am.auc_manage where auction_id=$aid and auc_due_time>0 and a.pause_status=0 and (auc_status=2 or auc_status=1)";
    $r = db_query($q);
    if (db_num_rows($r) > 0) {
        $ob = db_fetch_object($r);
      if(db_num_rows(db_query("select * from auction left join free_account_bidding fr on fr.auction_id=auction.auctionID left join bid_account_bidding ba on ba.auction_id=auction.auctionID where auc_status = '3' and (fr.user_id = '$_SESSION[userid]' or ba.user_id='$_SESSION[userid]')"))>=1 & $ob->beginner_auction == true){
            echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", ONLY_NEW_USERS_ARE_ALLOWED_TO_BID_ON_BEGINNER_AUCTIONS)) . '"}]';
            exit;	
	
	
	}
        if ($ob->use_free == 1) {
            $qrycheck = "select user_id from free_account_bidding where auction_id='" . $aid . "' order by id desc limit 0,1";
        } else {
            $qrycheck = "select user_id from bid_account_bidding where auction_id='" . $aid . "' order by id desc limit 0,1";
        }
        $rescheck = db_query($qrycheck);
        $objcheck = db_fetch_array($rescheck);

        if ($objcheck["user_id"] == $uid & $obj->reserve <= '0.00') {
            echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_TOP_BIDDER)) . '"}]';
            exit;
        }

        if ($ob->lockauction == true) {
            if (($ob->locktype == 1 && $ob->locktime >= $ob->auc_due_time) || ($ob->locktype == 2 && (($ob->reverseauction == false && $ob->lockprice <= $ob->auc_due_price) || ($ob->reverseauction == true && $ob->lockprice >= $ob->auc_due_price)))) {
                if ($ob->use_free == 1) {
                    $qrybids = "select count(*) from free_account_bidding where auction_id='" . $aid . "' and user_id='$uid' order by id desc limit 0,1";
                } else {
                    $qrybids = "select count(*) from bid_account_bidding where auction_id='" . $aid . "' and user_id='$uid' order by id desc limit 0,1";
                }

                $bidsresult = db_query($qrybids);
                if (db_result($bidsresult, 0) < 1) {
                    echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_LOCK_AUCTION)) . '"}]';
                    exit;
                }
            }
        }

        if ($ob->seatauction == true) {
            $seatqry = "select count(*) from auction_seat where auction_id=$aid";
            $seatret = db_query($seatqry);
            $seatcount = db_result($seatret, 0);
            db_free_result($seatret);
            if ($seatcount < $ob->minseats) {
                echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_NOT_REACHED_TO_MIN_SEATS)) . '"}]';
                exit;
            }

            $seatqry1 = "select count(*) from auction_seat where auction_id='$aid' and user_id='$uid'";
            $seatret1 = db_query($seatqry1);
            if (db_result($seatret1, 0) <= 0) {
                echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_DONT_HAVE_SEAT)) . '"}]';
                exit;
            }
        }

//for bid management for minus
	update_users_bids($uid);
        $qrysel = "select final_bids,free_bids,username,position from registration where id=$uid";
        $ressel = db_query($qrysel);
        $obj = db_fetch_object($ressel);
        if ($ob->use_free == 1) {
            $bal = $obj->free_bids;
            $useonlyfree = 1;
        } else {
            $bal = $obj->final_bids;
            $useonlyfree = 0;
        }

			//////////////////////////////////////////////////////////////////////////////////
			/// Begin Bugfix
			/// Clear Idea Technology
			/// Trent Raber
			/// 2012-05-02
			/// Fix to prevent bidding with negative bids
			//////////////////////////////////////////////////////////////////////////////////
		  if ($bal <= 0 && $ob->use_free == 1) {
		      echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_DONT_HAVE_FREE_POINTS)) . '"}]';
		      exit;
		  }
		  if ($bal <= 0 && $ob->use_free == 0) {
		      echo '[{"result":"nobids","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_DONT_HAVE_FINAL_POINTS)) . '"}]';
		      exit;
		  }

			//////////////////////////////////////////////////////////////////////////////////
			/// End Bugfix
			//////////////////////////////////////////////////////////////////////////////////

        if ($ob->pause_status != '1' && ($ob->auc_status == '2' | $ob->status == '1')) {
            $oldtime = $ob->auc_due_time;
            
	    $oldprice = $ob->auc_due_price;
            
            $plusprice = $ob->auc_plus_price;
            /* Change for plus or minus random timer */
            //$plustime = rand($ob->auc_plus_time, $ob->max_plus_time);
		  if(db_num_rows(db_query("SELECT * from auction where auctionID = '$aid' and cashauction = '1'")) >= 1){

			      if ($ob->reverseauction == false) {
				  if ($ob->pennyauction == 1) {
				      $newprice = $oldprice + 0.00;
				  } else {
				      $newprice = $oldprice + $plusprice;
				  }
			      } else {
				  if ($ob->pennyauction == 1) {
				      $newprice = $oldprice - 0.00;
				  } else {
				      $newprice = $oldprice - $plusprice;
				  }
			      }

			      if ($oldtime <= $ob->auc_plus_time) {
				  $newtime = $ob->auc_plus_time + 2;
			      } else {
				  $newtime = $oldtime;
			      }


		  }else{
			      if ($ob->reverseauction == false) {
				  if ($ob->pennyauction == 1) {
				      $newprice = $oldprice + 0.00;
				  } else {
				      $newprice = $oldprice + $plusprice;
				  }
			      } else {
				  if ($ob->pennyauction == 1) {
				      $newprice = $oldprice - 0.00;
				  } else {
				      $newprice = $oldprice - $plusprice;
				  }
			      }

			      if ($oldtime <= $ob->auc_plus_time) {
				  $newtime = $ob->auc_plus_time + 2;
			      } else {
				  $newtime = $oldtime;
			      }
		  }
			      begin();


			      /* End for plus or minus random timer */
			      $qupd = "update auc_due_table set auc_due_price=$newprice";
			      if ($newtime != $oldtime) {
				  $qupd.=",auc_due_time=$newtime";
			      }

			      $qupd .= " where auction_id=$aid";

			      $result1 = db_query($qupd);

			      if (!$result1) {
				  rollback();
				  echo "Failed5";
				  exit;
			      }



		      if ($ob->use_free == 1) {
			  if(db_num_rows(db_query("SELECT * from auction where auctionID = '$aid' and cashauction = '1'")) >= 1){
			      $cashauction = '1';
			  }else{
				$cashauction = '0';
				$final_bal = $bal - $bids_to_take;
				update_users_bids($uid);
				
				$qryins1 = "Insert into free_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$uid','" . date("Y-m-d H:i:s", time()) . "','" . $bids_to_take . "','$aid',$newprice,'s','{$obj->username}','{$obj->position}')";
				$result = db_query($qryins1);
				if (!$result) {
				    rollback();
				    echo "Failed";
				    exit;
				}

			    $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time) values('$uid','" . date("Y-m-d H:i:s", time()) . "','" . $bids_to_take . "','$aid','$prid','d',$newprice,'s'," . $oldtime . ")";
			    $result3 = db_query($qryins);

			    if (!$result3) {
				rollback();
				echo "Failed";
				exit;
			    }
           
                  updateAuctionBidding($aid, $newtime, $newprice, $ob->use_free, $uid, $obj->username, $topbidercount, $newtime);
	      }

		    } else {
			if(db_num_rows(db_query("SELECT * from auction where auctionID = '$aid' and cashauction = '1'")) >= 1){

				  $cashauction = '1';
			      $qryins1 = "Insert into bid_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$uid','" . date("Y-m-d H:i:s", time()) . "','" . $bids_to_take . "','$aid',$newprice,'s','{$obj->username}','{$obj->position}')";
			      $result = db_query($qryins1);
			      if (!$result) {
				  rollback();
				  echo "Failed2";
				  exit;
			      }

			      $qryins = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time) values('$uid','" . date("Y-m-d H:i:s", time()) . "','" . $bids_to_take . "','$aid','$prid','d',$newprice,'s'," . $oldtime . ")";
			      $result3 = db_query($qryins);

			      if (!$result3) {
				  rollback();
				  echo "Failed3";
				  exit;
			      }
			}else{
			    $cashauction = '0';
			    $final_bal = $bal - $bids_to_take;
			    $qryinsf = "Insert into free_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('$uid',NOW(),'1','c','fr','Reward Points for bidding on $aid')";
			    db_query($qryinsf); 
		      
			    update_users_bids($uid);
			    $qryins1 = "Insert into bid_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$uid','" . date("Y-m-d H:i:s", time()) . "','" . $bids_to_take . "','$aid',$newprice,'s','{$obj->username}','{$obj->position}')";
			    $result = db_query($qryins1);
			    if (!$result) {
				rollback();
				echo "Failed2";
				exit;
			    }
			    $qryins = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time) values('$uid','" . date("Y-m-d H:i:s", time()) . "','" . $bids_to_take . "','$aid','$prid','d',$newprice,'s'," . $oldtime . ")";
			    $result3 = db_query($qryins);
				  update_users_bids($uid);
			    if (!$result3) {
				rollback();
				echo "Failed3";
				exit;
			    }
			}
		    }
		}
		  updateAuctionBidding($aid, $newtime, $newprice, $ob->use_free, $uid, $obj->username, $topbidercount, $newtime);
		  commit();
			$qrysel = "select * from auc_due_table adt inner join auction_running a on a.auctionID=adt.auction_id left join auction_run_status ars on ars.auctionID=adt.auction_id inner join auction_management am on am.auc_manage=a.time_duration where auc_due_time>0 and a.pause_status=0 and auc_status=2 order by auction_id";
		        $ressel = db_query($qrysel);
			      
			while ($obj = db_fetch_array($ressel)) {
			$heighuser=json_decode($obj['heighuser']);

			
			$p = count($heighuser); 
			if($p < 3){

			while($p <= 3){
			array_push($heighuser, "---");
			$p++;
			}
			}
			$obj['hu'] = $heighuser[0];
			$obj['tb'] = $heighuser[0];
			}
			if(!empty($free_bids[0])){
			    echo '[{"result":"success", "tb" : "' . $obj['tb'] . '", "hu": "' . $obj['hu'] . '", "id": "' . $_REQUEST['aid'] . '", "freebids":"' . $free_bids[0] . '","bids":"' . $bids_to_take . '", "cashauction":"' . $cashauction . '"}]';
		    
			
			}else{
			    
			echo '[{"result":"success", "tb" : "' . $obj['tb'] . '", "hu": "' . $obj['hu'] . '","id": "' . $_REQUEST['aid'] . '", "freebids":"' . $useonlyfree . '","bids":"' . $bids_to_take . '", "cashauction":"' . $cashauction . '"}]';
		    
		    }
	    } else {
	    echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", MESSAGE_AUCTION_ENDED . " " . "Or" . " " . NOT_YET_STARTED)) . '"}]';
	}
    }

}
?>