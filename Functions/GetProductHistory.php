<?php

function GetProductHistory($aucid, $uid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $rescheck = db_query("select use_free from auction where auctionID=$aucid");
    $objcheck = db_fetch_array($rescheck);

    if ($objcheck["use_free"] == 1) {
        $qryhis = "select * from free_account ba left join auction a on ba.auction_id=a.auctionID left join registration r on ba.user_id=r.id where ba.auction_id='$aucid' and ba.bid_flag='d' order by ba.id desc limit 0,10";
    } else {
        $qryhis = "select * from bid_account  ba left join auction a on ba.auction_id=a.auctionID left join registration r on ba.user_id=r.id where ba.auction_id='$aucid' and ba.bid_flag='d' order by ba.id desc limit 0,10";
    }
    $reshis = db_query($qryhis) or die(db_error());
    $total = db_num_rows($reshis);
    for ($i = 1; $i <= $total; $i++) {
        $obj = db_fetch_object($reshis);
        if ($lprice == $obj->bidding_price) {
            break;
            $flg = 1;
        }
        if ($i == 1) {
            $temp2 = '{"history":{"bprice":"' . number_format($obj->bidding_price, 2) . '","username":"' . $obj->username . '","bidtype":"' . $obj->bidding_type . '"}}';
        } else {
            $temp2 .= ',{"history":{"bprice":"' . number_format($obj->bidding_price, 2) . '","username":"' . $obj->username . '","bidtype":"' . $obj->bidding_type . '"}}';
        }
    }

    if ($flg != 1) {
        if ($objcheck["use_free"] == 1) {
            $qryhis1 = "select * from free_account ba left join auction a on ba.auction_id=a.auctionID left join registration r on ba.user_id=r.id where ba.auction_id='$aucid' and ba.bid_flag='d' and ba.user_id='$uid' order by ba.id desc limit 0,10";
        } else {
            $qryhis1 = "select * from bid_account ba left join auction a on ba.auction_id=a.auctionID left join registration r on ba.user_id=r.id where ba.auction_id='$aucid' and ba.bid_flag='d' and ba.user_id='$uid' order by ba.id desc limit 0,10";
        }

        $reshis1 = db_query($qryhis1) or die(db_error());
        $total1 = db_num_rows($reshis1);
        for ($i = 1; $i <= $total1; $i++) {
            $obj1 = db_fetch_object($reshis1);
            if ($i == 1) {
                $temp21 = '{"myhistory":{"bprice":"' . number_format($obj1->bidding_price, 2) . '","time":"' . substr($obj1->bidpack_buy_date, 10) . '","bidtype":"' . $obj1->bidding_type . '"}}';
            } else {
                $temp21 .= ',{"myhistory":{"bprice":"' . number_format($obj1->bidding_price, 2) . '","time":"' . substr($obj1->bidpack_buy_date, 10) . '","bidtype":"' . $obj1->bidding_type . '"}}';
            }
        }
    }

    if ($temp2 != "") {
        return '{"histories":[' . $temp2 . '],"myhistories":[' . $temp21 . ']}';
    } else {
        return $temp2;
    }
}
