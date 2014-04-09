
<div>

    <div class="my_account_menu_tab_border">
        <div class="my_account_menu_tab">
            <span><?php echo AUCTIONS; ?></span>
        </div>
    </div>

    <div class="my_account_menu_box_content_holder">
        <div class="my_account_menu_box_content">
            <div><a href="myaccount.php">» <?php echo MAIN; ?></a></div>
            <div><a href="myauctions.php">» <?php echo MY_AUCTIONS; ?></a></div>
            <div><a href="myautobidder.php">» <?php echo MY_AUTOBIDDER; ?></a></div>
            <div><a href="watchauctions.php">» <?php echo WATCHED_AUCTIONS; ?></a></div>
            <div><a href="wonauctions.php">» <?php echo WON_AUCTIONS; ?></a></div>
            <div><a href="mybuynow.php?status=1">» <?php echo MY_BUYNOW_LIST; ?></a></div>
            <div><a href="mybuynow.php?status=2">» <?php echo MY_BUYNOW_HISTORY; ?></a></div>
        </div>
    </div>

</div>


<div style="padding-top: 10px;">

    <div class="my_account_menu_tab_border">
        <div class="my_account_menu_tab">
            <span><?php echo ACCOUNT; ?></span>
        </div>
    </div>

    <div class="my_account_menu_box_content_holder">
        <div class="my_account_menu_box_content">
            <div><a href="buybids.php">» <?php echo BUY_BIDS; ?></a></div>
            <div><a href="bidhistory.php">» <?php echo BID_ACCOUNT; ?></a></div>
            <div><a href="vouchers.php">» <?php echo VOUCHERS; ?></a></div>
            <div><a href="myredemption.php">» <?php echo MY_REDEMPTIONS; ?></a></div>
            <div><a href="affiliate.php">» <?php echo REFERRAL; ?></a></div>
        </div>
    </div>

</div>



<div style="padding-top: 10px;">

    <div class="my_account_menu_tab_border">
        <div class="my_account_menu_tab">
            <span><?php echo DETAIL; ?></span>
        </div>
    </div>

    <div class="my_account_menu_box_content_holder">
        <div class="my_account_menu_box_content">
            <div><a href="mydetails.php">» <?php echo MY_DETAILS; ?></a></div>
            <?php if (Sitesetting::isEnableAvatar()) {
 ?>
                <div><a href="myavatar.php">» <?php echo MY_AVATAR; ?></a></div>
<?php } ?>
            <div><a href="editpassword.php">» <?php echo CHANGE_PASSWORD; ?></a></div>
            <div><a href="unsubscribeuser.php">» <?php echo CLOSE_ACCOUNT; ?></a></div>
            <div><a href="newsletter.php">» <?php echo NEWSLETTER; ?></a></div>
        </div>
    </div>

</div>

<div style="padding-top: 10px;">

    <div class="my_account_menu_tab_border">
        <div class="my_account_menu_tab">
            <span><?php echo COUPON; ?></span>
        </div>
    </div>

    <div class="my_account_menu_box_content_holder">
        <div class="my_account_menu_box_content">

            <div><a href="mycoupon.php">» <?php echo MY_COUPON; ?></a></div>
            <div><a href="couponhistory.php">» <?php echo COUPON_HISTORY; ?></a></div>
        </div>
    </div>

</div>