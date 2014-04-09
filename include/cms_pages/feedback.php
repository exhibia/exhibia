<?php
if(empty($dont_show_left)){
$dont_show_left = array();
}
//Uncomment items below to remove them from ALL PAGES for ALL TEMPLATES SO LONG AS THEY ARE 100% USING THE NORMAL FRAMEWORK...IF NOT THEN LETS FIX THAT FIRST
//Skinny column
//$dont_show_left[] = 'testimonials';
//$dont_show_left[] = 'last_winner';
//$dont_show_left[] = 'right_social';
//$dont_show_left[] = 'coupon_menu';
//$dont_show_left[] = 'bidpack_menu';
//$dont_show_left[] = 'user_menu';
//$dont_show_left[] = 'help_menu';
$dont_show_left[] = 'faq_menu';
//$dont_show_left[] = 'top_menu';
//$dont_show_left[] = 'search_box';
//$dont_show_left[] = 'category_menu';

?>
<div id="main">
  <?php  include("header.php"); ?>
     <div id="container">
        <?php  include("include/topmenu.php"); ?>
        <div class="tab-area">
        <div id="column-right">
            <?php  include("include/searchbox.php"); ?>
            <div id="title-category-content" style="margin-bottom:-15px;">
                <?php  include("include/categorymenu.php"); ?>
                <p class="bid-title"><strong><?php echo $SITE_NM; ?> - <?php echo COMMUNITY; ?></strong></p>
            </div><!-- /title-category-content -->
            
            
                        <div class="content">
                            <div class="clear" style="height: 15px;">&nbsp;</div>

                            <?php

                            if($uid=="" && $_GET["sk"]=="") {

                                ?>

                            <div>
                                <div class="feedback_form_login">
                                    <div class="feedback_form_login_info" style=" color:#01265A" align="left"><?php echo LOGIN_AND_CONTACT_US; ?></div>
                                    <div class="feedback_form_login_inner">
                                        <form name="feedback" action="password.php" method="post">
                                                <?php if($_GET["suc"]=="1") { ?>
                                            <div style="color: green; padding-bottom: 15px; margin-left: 200px;" align="left"><strong><?php echo EMAIL_SEND_SUCCESSFULLY; ?></strong></div>
                                                    <?php } ?>

                                            <div style="width: 380px;" align="center">

                                                <div style="width: 250px;float: left;">

                                                    <div align="left" class="normal_text_big"><strong><?php echo USERNAME; ?>: </strong></div>

                                                    <div align="left" class="normal_text_big"><input type="text" name="username" class="logintextboxclas" /></div>

                                                    <div style="height:10px;">&nbsp;</div>

                                                    <div align="left" class="normal_text_big"><strong><?php echo PASSWORD; ?>:</strong> </div>

                                                    <div align="left" class="normal_text_big"><input type="password" name="password" class="logintextboxclas" /></div>

                                                    <div style="height:10px;">&nbsp;</div>



                                                    <!--
                                                    <div align="left" style="float: left;" class="normal_text_big"><input type="image" value="Submit" src="images/submit.png" onMouseOver="this.src='images/submit_hover.png'" onMouseOut="this.src='images/submit.png'" />

                                                        <input type="hidden" name="submit" value=" " />

                                                    </div>
                                                    -->
                                                    <div align="left" style="float: left;" class="normal_text_big">
                                                        <button style="cursor: pointer;" class="button77"><?php echo SUBMIT; ?></button>
                                                    </div>

                                                    <div align="left" style="margin-left: 120px; padding-top: 10px;" class="normal_text_big"><a href="forgotpassword.php" class="darkblue-12-link"><?php echo FORGOT_PASSWORD; ?></a></div>

                                                    <input type="hidden" name="feedback_hidden" value="feed" />

                                                </div>

                                                <div style="width: 120px; float: left; text-align: right; margin-top: 45px;">&nbsp;

                                                    <div style="height:40px;">&nbsp;</div>

                                                </div>

                                            </div>

                                            <div style="clear: both"></div>

                                            <div style="width: 380px; margin-top:15px" align="center">

                                                <div class="normal_text_big" align="left"><strong><?php echo NOT_REGISTERED_WITH; ?> <?=$SITE_NM;?>?</strong></div>

                                                <div class="normal_text_big" style="margin-top: 5px;" align="left"><?php echo IF_YOU_HAVENT_GOT_A_USERNAME_OR_PASSWORD; ?></div>

                                                <div style="height:40px;">&nbsp;</div>

                                                <div style="" align="left">
                                                    <button onclick="javascript: window.location.href='feedback.php?sk=1'" style="cursor: pointer;" class="button77"><?php echo SKIP_LOGIN; ?></button>
                                                    <!--<img src="images/skiplogin.png" onmouseover="this.src='images/skiplogin_hover.png'" onmouseout="this.src='images/skiplogin.png'" onclick="javascript: window.location.href='feedback.php?sk=1'" style="cursor: pointer;" /></div>
							-->
                                                    <div style="clear: both; height: 20px;">&nbsp;</div>

                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>

                                <div style="height: 40px; clear: both;">&nbsp;</div>

                            </div>

                                <?php

                            }

                            else {

                                ?>

                            <div>

                                <div class="feedback_form_login" align="center">

                                    <div class="feedback_form_login_info" style=" color:#01265A"  align="left"><?php echo YOUR_EMAIL_TO; ?> <?=$SITE_NM;?></div>

                                    <form name="feedback_email" method="post" action="feedback.php">

                                        <div class="clear" style="height: 20px;">&nbsp;</div>

                                            <?php if($_GET["suc"]=="1") { ?>

                                        <div style="color: green; padding-bottom: 15px; margin-left: 200px;" align="left"><strong><?php echo EMAIL_SEND_SUCCESSFULLY; ?></strong></div>

                                                <?php } ?>

                                        <div style="width: 600px;" class="normal_text_big" align="left">

                                            <div style="height: 30px; clear:both; width: 360px;">

                                                <div style="float:left; width:100px;text-align: right;"><strong>To:</strong></div>

                                                <div style="float:right; width: 250px;text-align:left;"><?=$SITE_NM;?><?php echo CUSTOMER_SERVICE; ?></div>

                                            </div>

                                            <div style="height: 30px; clear:both;width: 360px;">

                                                <div style="float:left; width:100px;text-align: right"><strong><?php echo EMAIL_ADDRESS; ?>:</strong></div>

                                                <div style="float:right; width: 250px;text-align: left;">

                                                        <?

                                                        if($uid!="") {

                                                            $qryreg = "select * from registration where id='$uid'";

                                                            $resreg = db_query($qryreg);

                                                            $obj = db_fetch_object($resreg);

                                                            ?><?=$obj->email;?>

                                                    <input type="hidden" name="emailaddress" value="<?=$obj->email?>" />

                                                            <?

                                                        }

                                                        else {

                                                            ?><input type="text" name="emailaddress" class="logintextboxclas" size="40"/>

                                                            <?

                                                        }

                                                        ?>

                                                </div>

                                            </div>

                                            <div style="height: 30px; clear:both;width: 360px;">

                                                <div style="float:left; width:100px;text-align: right"><strong><?php echo NAME; ?> :</strong></div>

                                                <div style="float:right; width: 250px;text-align: left;">

                                                        <?

                                                        if($uid!="") {

                                                            $qryreg = "select * from registration where id='$uid'";

                                                            $resreg = db_query($qryreg);

                                                            $obj = db_fetch_object($resreg);

                                                            ?><?=$obj->firstname;?>

                                                    <input type="hidden" name="name" value="<?=$obj->firstname;?>"/>

                                                            <?

                                                        }

                                                        else {

                                                            ?><input type="text" name="name" class="logintextboxclas" size="40"/>

                                                            <?

                                                        }

                                                        ?>

                                                </div>

                                            </div>

                                            <div style="height: 30px; clear:both;width: 360px;">

                                                <div style="float:left; width:100px;text-align: right"><strong><?php echo SUBJECT; ?>:</strong></div>

                                                <div style="float:right; width: 250px;text-align: left;">

                                                    <select name="subject">

                                                        <option value="none"><?php echo PLEASE_SELECT_SUBJECT; ?></option>

                                                        <option value="Bidding"><?php echo BIDDING; ?></option>

                                                        <option value="Auctions"><?php echo AUCTIONS; ?></option>

                                                        <option value="Delivery and sheeping"><?php echo DELIVERY_AND_SHIPPING; ?></option>

                                                            <?php /*?>							<option value="Returns and complaints">Returns and complaints</option>

    <?php */?>					<option value="Managing Myaccount"><?php echo MANAGING_MYACCOUNT; ?></option>

                                                        <option value="Payments and payment methods"><?php echo PAYMENTS_AND_PAYMENT_METHODS; ?></option>

                                                        <option value="International auctions"><?php echo INTERNATIONAL_AUCTIONS; ?></option>

                                                        <option value="Technical problems"><?php echo TECHNICAL_PROBLEMS; ?></option>

                                                        <option value="General questions"><?php echo QUESTIONS_ABOUT; ?> <?=$SITE_NM;?></option>

                                                        <option value="Feedback"><?php echo FEEDBACK; ?></option>

                                                        <option value="Vouchers"><?php echo VOUCHERS; ?></option>

                                                        <option value="Registration"><?php echo REGISTRATION; ?></option>

                                                        <option value="Report Abuse"><?php echo REPORT_ABUSE; ?></option>

                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                        <div style="clear: both; height: 20px;">&nbsp;</div>

                                        <div style="width: 600px; height: 20px; background-image:url(images/gred.gif); background-repeat: repeat-x" align="center"></div>

                                        <div style="height: 30px; clear:both; width:585px;">

                                            <div style="float:left; width:160px; text-align:left"><strong><?php echo PLEASE_ENTER_AUCTION_ID; ?>:</strong></div>

                                        </div>

                                        <div style="height: 30px; clear:both;width: 585px;">

                                            <div style="float:left; width: 140px;text-align: left;"><input type="text" name="auctionid" class="logintextboxclas" size="40"/> </div>

                                        </div>

                                        <div style="height: 30px; clear:both;width: 585px;">

                                            <div style="float:left; width: 140px;text-align: left;">(e.g. 15252)</div>

                                        </div>



                                        <div style="clear: both; height: 10px;">&nbsp;</div>

                                        <div style="width: 600px; height: 20px; background-image:url(images/gred.gif); background-repeat: repeat-x" align="center"></div>

                                        <div style="height: 30px; clear:both;width: 585px;">

                                            <div style="float:left; width: 160px;text-align: left;"><strong><?php echo ADDITIONAL_INFORMATION; ?>:</strong></div>

                                        </div>

                                        <div style="height: 180px; clear:both;width: 585px;">

                                            <div style="float:left;height: 180px; width: 140px;text-align: left;"><textarea cols="65" rows="7" name="messagecontent" class="textareaclass"></textarea></div>

                                        </div>

                                        <div style="width: 600px; height: 20px; background-image:url(images/gred.gif); background-repeat: repeat-x" align="center"></div>



                                        <div style="height: 30px; clear:both;padding-top: 15px;" align="center">
                                            <!--
                    <input type="image" name="image" src="images/send.png" onmouseover="this.src='images/send_hover.png'" onmouseout="this.src='images/send.png'" onclick="return Check();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/cancel.png" onmouseover="this.src='images/cancel_hover.png'" onmouseout="this.src='images/cancel.png'" onclick="window.location.href='help.php'" style="cursor: pointer" /><input type="hidden" name="send" value="send" />
						-->
                                            <button name="image" onclick="return Check();" class="button77"><?php echo SEND; ?></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button onclick="window.location.href='help.php'" class="button77"><?php echo CANCEL; ?></button>
                                            <input type="hidden" name="send" value="send" />
                                        </div>

                                        <div style="clear: both; height: 20px;">&nbsp;</div>

                                    </form>

                                </div>

                                <div style="height: 40px; clear: both;">&nbsp;</div>

                            </div>

                                <?php

                            }

                            ?>
                        </div><!-- /column-right -->	
		</div>
		<div id="column-left">
            <?php  include("leftside.php"); ?>
        </div><!-- /column-left -->
        </div>
    </div><!-- /container -->
  
  <?php  include("footer.php"); ?>

