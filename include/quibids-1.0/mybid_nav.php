<?php include_once('common/sitesetting.php');?>
<div id="left-nav">
    <h2><strong><font color="#333333"><?php echo MY_CONTROL_CENTER; ?></font></strong></h2>

    <div style="margin-top: 10px; margin-bottom: -10px; margin-left: 15px;">
        <strong><?php echo AUCTIONS; ?></strong>
    </div>
    <ul>
        <li><a href="myaccount.php" class="<?php echo ($currentPage == 'myaccount.php')?'selected':''; ?>"><?php echo MY_ACCOUNT; ?></a></li>
        <li><a href="myauctions.php" class="<?php echo ($currentPage == 'myauctions.php')?'selected':''; ?>"><?php echo MY_AUCTIONS; ?></a></li>
        <li><a href="myautobidder.php" class="<?php echo ($currentPage == 'myautobidder.php')?'selected':''; ?>"><?php echo MY_AUTOBIDDER; ?></a></li>
        <li><a href="watchauctions.php" class="<?php echo ($currentPage == 'watchauctions.php')?'selected':''; ?>"><?php echo WATCHED_AUCTIONS; ?></a></li>
        <li><a href="wonauctions.php" class="<?php echo ($currentPage == 'wonauctions.php')?'selected':''; ?>"><?php echo WON_AUCTIONS; ?></a></li>
        <li><a href="mybuynow.php?status=1" class="<?php echo ($currentPage == 'mybuynow.php' && $_GET['status']=='1')?'selected':''; ?>"><?php echo MY_BUY_NOW_LIST; ?></a></li>
        <li style="background: transparent none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;">
            <a href="mybuynow.php?status=2" class="<?php echo ($currentPage == 'mybuynow.php' && $_GET['status']=='2')?'selected':''; ?>"><?php echo MY_BUY_NOW_HISTORY; ?></a>
        </li>
    </ul>

    <p>
    </p>
    <div style="margin-top: 10px; margin-bottom: -10px; margin-left: 15px;"><strong><?php echo ACCOUNT; ?></strong></div>
    <ul>
        <li><a href="buybids.php" class="<?php echo ($currentPage == 'buybids.php')?'selected':''; ?>"><?php echo MY_BUY_BIDS; ?></a></li>
        <li><a href="bidhistory.php" class="<?php echo ($currentPage == 'bidhistory.php')?'selected':''; ?>"><?php echo MY_BID_ACCOUNT; ?></a></li>
        <li><a href="vouchers.php" class="<?php echo ($currentPage == 'vouchers.php')?'selected':''; ?>"><?php echo MY_VOUCHERS; ?></a></li>
       <!--  <li><a href="myredemption.php" class="<?php echo ($currentPage == 'myredemption.php')?'selected':''; ?>"><?php echo MY_REDEMPTIONS; ?></a></li> -->
        <li style="background: transparent none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;">
            <a href="affiliate.php" class="<?php echo ($currentPage == 'affiliate.php')?'selected':''; ?>"><?php echo MY_REFERRAL; ?></a>
        </li>
    </ul>

    <p>
    </p>
    <div style="margin-top: 10px; margin-bottom: -10px; margin-left: 15px;"><strong><?php echo DETAILS; ?></strong></div>
    <ul>
        <li><a href="mydetails.php" class="<?php echo ($currentPage == 'mydetails.php')?'selected':''; ?>"><?php echo MY_DETAILS; ?></a></li>
        <?php if (Sitesetting::isEnableAvatar()) {
        ?>
            <li><a href="myavatar.php" class="<?php echo ($currentPage == 'myavatar.php')?'selected':''; ?>"><?php echo MY_AVATAR; ?></a></li>
        <?php } ?>
        <li><a href="editpassword.php" class="<?php echo ($currentPage == 'editpassword.php')?'selected':''; ?>"><?php echo CHANGE_PASSWORD; ?></a></li>
        <li><a href="unsubscribeuser.php" class="<?php echo ($currentPage == 'unsubscribeuser.php')?'selected':''; ?>"><?php echo CLOSE_ACCOUNT; ?></a></li>
        <li style="background: transparent none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;">
            <a href="newsletter.php" class="<?php echo ($currentPage == 'newsletter.php')?'selected':''; ?>"><?php echo NEWSLETTER; ?></a>
        </li>
    </ul>

    <p>
    </p>
    <div style="margin-top: 10px; margin-bottom: -10px; margin-left: 15px;"><strong><?php echo COUPONS; ?></strong></div>
    <ul>
        <li><a href="mycoupon.php" class="<?php echo ($currentPage == 'mycoupon.php')?'selected':''; ?>"><?php echo MY_COUPON; ?></a></li>
        <li style="background: transparent none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;">
            <a href="couponhistory.php" class="<?php echo ($currentPage == 'couponhistory.php')?'selected':''; ?>"><?php echo COUPON_HISTORY; ?></a>
        </li>
    </ul>

</div>
