<style>
.rounded_corner div.content {
  background-color: #FFFFFF;
  border: 1px solid #D3EAF2;
  border-radius: 6px;
  clear: both;
  line-height: 20px;
  padding: 20px;
  width: 740px;
}
textarea { width: 700px; }
</style>
    <div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                <div class="tab-area">
                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><strong><?=$SITE_NM; ?> - <?php echo REFER_A_FRIEND; ?></strong></p>
                    </div><!-- /title-category-content -->
                    <div class="clear"></div>
                    <div class="rounded_corner">
                        <div class="content">
                            <form name="affiliate" method="post" action="" onSubmit="return Check()">
                                <?php if ($_GET["sc"] == "1") {
                                ?>
                                    <div class="greenfont" style=""><?php echo EMAIL_SENT_SUCCESSFULLY; ?></div>
                                    <div style="height:10px;">&nbsp;</div>
                                <?php } ?>

                                <p><b><?php echo YOUR_AFFILIATE_URL; ?> : </b>&nbsp;&nbsp; <strong>http://<?=str_replace("http://", "", $SITE_URL) . '/' .$subfolder; ?>registration.php?ref=<?=$uid; ?></strong></p>
                                <br />
                                <p><b><?php echo YOUR_AFFILIATE_CODE; ?> : &nbsp;&nbsp;<?=$uid; ?></b></p>
                                <br />
                                <p><?php echo ENTER_EMAIL_ADDRESS_TO_INVITE; ?> :</p>
                                <p>
                                    <textarea name="emailaddresses" cols="50" rows="5" class="logintextboxclas"></textarea>
                                </p>
                                <br />
                                <p style="padding-left: 40px;">
                                    <button class="button77" type="submit" value="image" name="image"><?php echo SEND; ?></button>
                                </p>
                                <input type="hidden" name="send" value="send" />

                            </form>
                        </div>
                    </div><!-- /content -->
                </div><!-- /column-right -->
                <div id="column-left">
                    <?php include("leftside.php"); ?>
                    
                            </div><!-- /column-left -->
                            </div>
                        </div><!-- /container -->

            <?php include("footer.php"); ?>
        </div> <!--end main--> 
