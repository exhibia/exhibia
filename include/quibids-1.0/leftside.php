<?php include_once('common/sitesetting.php'); ?>
<div id="navigationBox" class="box">
    <h3><?php echo NAVIGATION; ?></h3>
    <div class="box-content">
        <h4><a href="myaccount.php"><?php echo MAIN; ?></a></h4>
        <ul>
            <li>
                <h5><?php echo AUCTIONS; ?></h5>
                <ul>
                    <li><a href="myauctions.php"><?php echo MY_AUCTIONS; ?></a></li>
                    <li><a href="myautobidder.php"><?php echo MY_AUTOBIDDER; ?></a></li>
                    <li><a href="watchauctions.php"><?php echo WATCHED_AUCTIONS; ?></a></li>
                    <li><a href="wonauctions.php"><?php echo WON_AUCTIONS; ?></a></li>
                    <li><a href="mybuynow.php?status=1"><?php echo MY_BUYNOW_LIST; ?></a></li>
                    <li><a href="mybuynow.php?status=2"><?php echo MY_BUYNOW_HISTORY;?></a></li>
                </ul>
            </li>
            <li>
                <h5><?php echo ACCOUNT; ?></h5>
                <ul>
                    <li><a href="buybids.php"><?php echo BUY_BIDS; ?></a></li>
                    <li><a href="bidhistory.php"><?php echo BID_ACCOUNT; ?></a></li>
                    <li><a href="vouchers.php"><?php echo VOUCHERS; ?></a></li>
                    <li><a href="myredemption.php"><?php echo MY_REDEMPTIONS; ?></a></li>
                    <li><a href="affiliate.php"><?php echo REFERRAL; ?></a></li>
                </ul>
            </li>
            <li>
                <h5><?php echo DETAIL; ?></h5>
                <ul>
                    <li><a href="mydetails.php"><?php echo MY_DETAILS; ?></a></li>
                    <?php if(Sitesetting::isEnableAvatar()){ ?>
                    <li><a href="myavatar.php"><?php echo MY_AVATAR; ?></a></li>
                    <?php }?>
                    <li><a href="editpassword.php"><?php echo CHANGE_PASSWORD; ?></a></li>
                    <li><a href="unsubscribeuser.php"><?php echo CLOSE_ACCOUNT; ?></a></li>
                    <li><a href="newsletter.php"><?php echo NEWSLETTER; ?></a></li>
                </ul>
            </li>
            <li>
                <h5><?php echo COUPON; ?></h5>
                <ul>
                    <li><a href="mycoupon.php"><?php echo MY_COUPON; ?></a></li>
                    <li><a href="couponhistory.php"><?php echo COUPON_HISTORY; ?></a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /box-content -->
</div><!-- /navigationBox -->
