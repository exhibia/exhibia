<?php


function getBidHistory($aid, $uid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $res = db_query("select place_date, butler_bid from bidbutler where user_id='$uid' and auc_id='$aid'");
    if (db_num_rows($res) > 0) {
        while (( $v1 = db_fetch_array($res))) {
?>
            <div class="normal_text_big">
                <div style="width: 80px;float: left" align="center"><?= arrangedate(substr($v1["place_date"], 0, 10));
?></div>
        <div style="width: 80px;float: left" align="center"><?= substr($v1["place_date"], 11);
?></div>
        <div style="width: 90px;float: left" align="center">AutoBidder</div>
        <div style="width: 40px;float: left; padding-right: 8px;" align="right" class="red-text-12-b"><?php echo "-" . $v1["butler_bid"]; ?></div>
    </div>
<?
        }
    }
    db_free_result($res);

    $res = db_query("select bidpack_buy_date, bid_count from bid_account where user_id='$uid' and auction_id='$aid' and bid_flag='b'");
    if (db_num_rows($res) > 0) {
        while (( $v2 = db_fetch_array($res))) {
?>
            <div class="normal_text_big">
                <div style="width: 80px;float: left" align="center"><?= arrangedate(substr($v2["bidpack_buy_date"], 0, 10));
?></div>
        <div style="width: 80px;float: left" align="center"><?= substr($v2["bidpack_buy_date"], 11);
?></div>
        <div style="width: 90px;float: left" align="center">Back Booking</div>
        <div style="width: 40px;float: left; padding-right: 8px;" align="right" class="greenfont"><strong><?= $v2["bid_count"];
?></strong></div>
</div>
<?
        }
    }
    db_free_result($res);

    $res = db_query("select bidpack_buy_date,bid_flag, bidding_type, bid_count from bid_account where user_id='$uid' and auction_id='$aid' and ((bid_flag='d' 
and bidding_type='s') or bid_flag='s' ) order by id desc");
    if (db_num_rows($res) > 0) {
        while (( $v = db_fetch_array($res))) {
?>
            <div class="normal_text_big">
                <div style="width: 80px;float: left" align="center"><?= substr(arrangedate($v["bidpack_buy_date"]), 0, 10);
?></div>
        <div style="width: 80px;float: left" align="center"><?= substr($v["bidpack_buy_date"], 11);
?></div>
        <div style="width: 90px;float: left" align="center">
        <?
            if ($v["bidding_type"] == 's')
                echo "Single Bid";
            if ($v["bidding_type"] == 'b')
                echo "AutoBidder";
            if ($v["bid_flag"] == 's')
                echo 'Buy Seat';
        ?>
        </div>
        <div style="width: 40px;float: left; padding-right: 8px;" align="right" class="red-text-12-b"><?php echo "-" . $v["bid_count"]; ?></div>
    </div>
<?
        }
    }
    db_free_result($res);
}



