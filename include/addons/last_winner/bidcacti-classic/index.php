<div class="sidebarWidget">
    <div id="auctionswonwidget" class="widgetBlue">
        <div class="widgetHeader">
            <div class="widgetHeaderLeft"></div>
            <div class="widgetHeaderRight"></div>
            <?php echo AUCTIONS_WON; ?>
        </div>
        <div class="widgetContent">
            <iframe src="auctionwon.php" frameborder="0" height="255px" scrolling="vertical" width="100%">
            </iframe>
        </div>
    </div>
</div>
<div class="sidebarWidget">
    <div id="howtobidwidget" class="widgetBlue">
        <div class="widgetHeader">
            <div class="widgetHeaderLeft"></div>
            <div class="widgetHeaderRight"></div>
		<?php echo HOW_TO_BID; ?>!
        </div>
        <div class="widgetContent" style="background: url(&quot;http://images.bidcactus.com/registerNowCTABG.jpg&quot;) no-repeat scroll center top transparent;">
            <strong><?php echo HOW_TO_BID_CONTENT; ?></strong>
            <ul class="registerSteps">
                <li class="registerStepOne"><a href="registration.php"><?php echo REGISTER; ?></a></li>
                <li class="registerStepTwo"><a href="registration.php"><?php echo BUY_BID; ?></a></li>
                <li class="registerStepThree"><span><?php echo BID_ON_ITEMS; ?></span></li>
                <li class="registerStepFour"><span><?php echo WIN;?></span></li>
            </ul>
            <strong class="getStartedB"><?php echo GET_START_NOW; ?>!</strong>
            <a href="registration.php" class="sideButn RegisterNowLink"><?php echo REGISTER_NOW; ?></a>
        </div>
    </div>
</div> 
