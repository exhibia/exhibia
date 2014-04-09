<style>
#registerBox .top-reg ul {
  background: url("pas/backgrounds/bg-bid-croc.gif") no-repeat scroll left top / 100% 100% rgba(0, 0, 0, 0);
  display: block;
  height: 89px;
  padding: 20px 0 0 50px;
  margin: 10px 0 20px 0;
}
#footer {
margin-top:50px;
}
.single #column-right {
clear: both;
float: right;
margin-bottom: 50px;
position: relative;
top: 50px;
width: 250px;
left: -30px;
}
#column-left{
width:980px;
}
#column-left > div:first-child {

border-radius: 10px;
width: 980px;
position: relative;
top: 105px;
}
#column-left div:first-child h3 {
  background-color: #0E76BD;
  border-radius: 10px 10px 0 0;
  color: #FFFFFF;
  float: left !important;
  font-size: 14px;
  padding: 5px 0 2px 40px;
  clear: both;
  margin-left:4px;
}
#registerBox form {
  clear: both;
  margin: 0 2px;
  width: 970px;
}
#registerBox .top-reg h2 {
border-bottom: 2px solid #C6B7DA;
margin: 5px 0 !important;
display: none;
}
.right > p, .left p, .right .row {
  margin: 5px 5px 5px 5px!important;
  width: 95%!important;
}
.right > p label, .left label {
  float:left;
  width:200px;
  font-weight:bold;
  margin-left:10px;
}
.right .row {
  float: right!important;
  text-indent: 180px;
}
#rndcode {
  clear: both !important;
  width: 80px;
  position: relative;
  top: -15px;
}
#column-left div:first-child h3 {
  background-color: #0E76BD;
  border-radius: 10px 10px 0 0;
  clear: both;
  color: #FFFFFF;
  float: left !important;
  font-size: 14px;
  margin-bottom: -2px;
  margin-left: 10px;
  padding: 5px 10px 2px 10px;
}
.content li {
  float: none!important;
  margin: 5px 0 5px 0;

}
</style>



<div id="main">
           
            <div id="container"> 
                <?php include("$BASE_DIR/addons/top_bar/exhibia/top_bar.php"); ?>
              <!--  <div class="tab-area"> -->
              <div id="column-right" style="float:right;">
              <?php include("$BASE_DIR/include/exhibia/column-right.php"); ?>
              </div> 
                <div id="column-left" style="float:left;">
                    <div id="registerBox" class="content">
                    <div class="top-reg">
                        <h2><span><?php echo NEW_USER_REGISTRATION; ?></span></h2>
                        <?
                        if (!isset($_SESSION["uid"])) {
                        ?>
                            <ul>
                                <li><span>Free Registration</span></li>
                            <?
                            if ($objregmsg["reg_message"] != "") {
                            ?>
                                <li><span><?= $objregmsg["reg_message"]; ?></span></li>
                            <?php } ?>
                            <li><span><?php echo THE_CHANCE_TO_WIN_AMAZING_PRODUCTS_AT_AMAZING_PRICES; ?></span></li>
                        </ul>
                        <h3><?php echo TO_REGISTER_WITH; ?> <?= $SITE_NM; ?>, <?php echo PLEASE_CMPLETE_THE_FOLLOWING; ?>:</h3>

                        <?php if ($errorMsg != '') {
                        ?>
                        <div id="errorMsg">
                              <ul>
                                <?php echo $errorMsg; ?>
                            </ul>
                        </div>
                        <?php } ?>
		    </div>

                            <form action="registration.php" id="registration" name="registration" method="post"  accept-charset="utf-8" >
                                <div class="left">
                                    <h4><?php echo PERSONAL_INFORMATION; ?></h4>
                                 
                                        <p>
                                            <label for="firstname"><?php echo FIRST_NAME; ?>:<small class="req_input">*</small></label>
                                            <span>
                                                <input type="text" id="firstname" name="firstname" maxlength="100" value="<?= ($fname != "" ? $fname : ""); ?>" />
                                                <span></span>
                                            </span>
                                        </p>
                                        <p>
                                            <label for="lastname"><?php echo LAST_NAME; ?>:<small class="req_input">*</small></label>
                                            <span>
                                                <input type="text" id="lastname" name="lastname" maxlength="100" value="<?= ($lname != "" ? $lname : ""); ?>" />
                                                <span></span>
                                            </span>
                                        </p>
                                        <p>
                                            <label for="date"><?php echo DATE_OF_BIRTH; ?>:<small class="req_input">*</small></label>
                                            <span>
                                            <?php
                                            if (Sitesetting::getDateFormat() == 'd/m/Y') {
                                            ?>
                                                <select id="date" name="date" style="width:auto;">
                                                    <option value="dd">DD</option>
                                                <?php for ($i = 1; $i <= 31; $i++) {
                                                ?>
                                                    <option value="<?= ($i <= 9 ? "0" . $i : $i); ?>" <?= ($_POST["date"] == $i ? "selected" : ""); ?>><?= ($i <= 9 ? "0" . $i : $i); ?></option>
                                                <?php } ?>
                                            </select>
                                            <select id="month" name="month" style="width:70px;">
                                                <option selected="selected" value="mm">MM</option>
                                                <option <?= $_POST["month"] == "01" ? "selected" : ""; ?> value="01"><?php echo JANUARY; ?></option>
                                                <option <?= $_POST["month"] == "02" ? "selected" : ""; ?> value="02"><?php echo FEBRUARY; ?></option>
                                                <option <?= $_POST["month"] == "03" ? "selected" : ""; ?> value="03"><?php echo MARCH; ?></option>
                                                <option <?= $_POST["month"] == "04" ? "selected" : ""; ?> value="04"><?php echo APRIL; ?></option>
                                                <option <?= $_POST["month"] == "05" ? "selected" : ""; ?> value="05"><?php echo MAY; ?></option>
                                                <option <?= $_POST["month"] == "06" ? "selected" : ""; ?> value="06"><?php echo JUNE; ?></option>
                                                <option <?= $_POST["month"] == "07" ? "selected" : ""; ?> value="07"><?php echo JULY; ?></option>
                                                <option <?= $_POST["month"] == "08" ? "selected" : ""; ?> value="08"><?php echo AUGUST; ?></option>
                                                <option <?= $_POST["month"] == "09" ? "selected" : ""; ?> value="09"><?php echo SEPTEMBER; ?></option>
                                                <option <?= $_POST["month"] == "10" ? "selected" : ""; ?> value="10"><?php echo OCTOBER; ?></option>
                                                <option <?= $_POST["month"] == "11" ? "selected" : ""; ?> value="11"><?php echo NOVEMBER; ?></option>
                                                <option <?= $_POST["month"] == "12" ? "selected" : ""; ?> value="12"><?php echo DECEMBER; ?></option>
                                            </select>
                                            <?php } else {
                                            ?>
                                                <select id="month" name="month" style="width:70px;">
                                                    <option selected="selected" value="mm">MM</option>
                                                    <option <?= $_POST["month"] == "01" ? "selected" : ""; ?> value="01"><?php echo JANUARY; ?></option>
                                                    <option <?= $_POST["month"] == "02" ? "selected" : ""; ?> value="02"><?php echo FEBRUARY; ?></option>
                                                    <option <?= $_POST["month"] == "03" ? "selected" : ""; ?> value="03"><?php echo MARCH; ?></option>
                                                    <option <?= $_POST["month"] == "04" ? "selected" : ""; ?> value="04"><?php echo APRIL; ?></option>
                                                    <option <?= $_POST["month"] == "05" ? "selected" : ""; ?> value="05"><?php echo MAY; ?></option>
                                                    <option <?= $_POST["month"] == "06" ? "selected" : ""; ?> value="06"><?php echo JUNE; ?></option>
                                                    <option <?= $_POST["month"] == "07" ? "selected" : ""; ?> value="07"><?php echo JULY; ?></option>
                                                    <option <?= $_POST["month"] == "08" ? "selected" : ""; ?> value="08"><?php echo AUGUST; ?></option>
                                                    <option <?= $_POST["month"] == "09" ? "selected" : ""; ?> value="09"><?php echo SEPTEMBER; ?></option>
                                                    <option <?= $_POST["month"] == "10" ? "selected" : ""; ?> value="10"><?php echo OCTOBER; ?></option>
                                                    <option <?= $_POST["month"] == "11" ? "selected" : ""; ?> value="11"><?php echo NOVEMBER; ?></option>
                                                    <option <?= $_POST["month"] == "12" ? "selected" : ""; ?> value="12"><?php echo DECEMBER; ?></option>
                                                </select>                
                                                <select id="date" name="date" style="width:auto;">
                                                    <option value="dd">DD</option>
                                                <?php for ($i = 1; $i <= 31; $i++) {
                                                ?>
                                                    <option value="<?= ($i <= 9 ? "0" . $i : $i); ?>" <?= ($_POST["date"] == $i ? "selected" : ""); ?>><?= ($i <= 9 ? "0" . $i : $i); ?></option>
                                                <?php } ?>
                                            </select>

                                            <?php } ?>
                                            <select id="year" name="year" style="width:auto;">
                                                <option selected="selected" style="width:40px" value="yyyy">YYYY</option>
                                                <?php for ($i = 1950; $i <= 2020; $i++) {
                                                ?>
                                                    <option <?= ($_POST["year"] == $i ? "selected" : ""); ?> value="<?= $i; ?>"><?= $i; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span></span>
                                        </span>
                                    </p>
                                      <p style="">

                                            <label for="email"><?php echo EMAIL_ADDRESS; ?>:<small class="req_input">*</small></label>
                                            <span>
                                            <?php if ($errr == 1) {
                                            ?>
                                                    <input type="text" id="email" name="email" maxlength="150" value="" />
                                            <?php } else {
                                            ?>
                                                    <input type="text" id="email" name="email" maxlength="150" value="<?php echo ($email != "" ? $email : ""); ?>" />
                                            <?php } ?>
                                                <span></span>
                                            </span>
                                        </p>

                                        <p>
                                            <label for="cnfemail"><?php echo RETYPE_EMAIL_ADDRESS; ?>:<small class="req_input">*</small></label>
                                            <span>
                                            <?php if ($errr == 1) {
                                            ?>
                                                    <input type="text" id="cnfemail" name="cnfemail" maxlength="150" value="" />
                                            <?php } else {
                                            ?>
                                                    <input type="text" id="cnfemail" name="cnfemail" maxlength="150" value="<?php echo ($email != "" ? $email : ""); ?>" />
                                            <?php } ?>
                                                <span></span>
                                            </span>
                                        </p>
				  </div>
				   <div class="right">
                                    <p>
                                        <label for="rusername"><?php echo USERNAME; ?>:<small class="req_input">*</small></label>
                                        <span>
                                            <?php if ($errr == 2) {
 ?>
                                                    <input type="text" id="rusername" name="username" maxlength="16" />
                                            <?php } else { ?>
                                                    <input type="text" id="rusername" name="username" maxlength="16" value="<?= ($username != "" ? $username : ""); ?>"/>
                                            <?php } ?>

                                                <span></span>
                                            </span>
                                        </p>
                                        <p>
                                            <label for="referid"><?php echo AFFILIATE_CODE; ?>:</label>
                                            <span>
                                                <input type="text" id="referid" name="referid" value="<?php echo $referrerid; ?>" />
                                                <span></span>
                                            </span>
                                        </p>

                                        <p>

                                            <label for="rpassword"><?php echo PASSWORD; ?>:<small class="req_input">*</small></label>
                                            <span>
                                                <input type="password" id="rpassword" name="password" maxlength="16" value="<?= ($pass != "" ? $pass : ""); ?>" onkeyup="pwd_test_password(this.value);" />
                                                <span></span>
                                            </span>
                                        </p>

                                        <p>
                                            <label for="cnfpassword"><?php echo RETYPE_PASSWORD; ?>:<small class="req_input">*</small></label>
                                            <span>
                                                <input name="cnfpassword" id="cnfpassword" type="password" maxlength="16" value="<?= ($pass != "" ? $pass : ""); ?>"/>
                                                <span></span>
                                                <div class="row">
                                                    <div style="width:auto; float:left; padding-top:10px; padding-right: 5px;"><?php echo PASSWORD_SECURITY; ?>:</div>
                                                    <div style=" background:url(images/securty-bg.gif) no-repeat; width:118px; height:28px; float:left">
                                                        <div style="width: 100px; margin-left: 10px; margin-top: 4px;">
                                                            <div id="pwd_text" style="font-size: 10px;"></div>
                                                            <div id="pwd_bar" style="font-size: 1px; height: 5px; width: 0px; border: 1px solid white;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </span>
                                        </p>

                                   
                                        <p>
                                            <label for="rndcode"><?php echo ENTER_THE_CODE; ?>:</label>
						<span style="padding-top:5px;">
                                                    <img src="CaptchaSecurityImages.php?width=250&height=100&character=6" width="116px" height="36px" border="1" />
                                                </span>
                                                <input type="text" id="rndcode" name="rndcode" value="" />
                                                <span></span>
                                                
                                            
                                        </p>
                                        <p>
                                            <label for="" style="width:auto;float:none;"><?php echo I_HAVE_READ_UNDERSTOOD_AND_ACCEPTED; ?> :</label><br>
                                            <input type="checkbox" id="terms" name="terms" value="1" <?= ($terms == "1" ? "checked" : ""); ?> /> <?= $SITE_NM; ?>'s <a href="javascript: void(0)" onclick="javascript:OpenPopUp('terms.php','','width=150,height=100')"><?php echo TERMS_CONDITIONS; ?></a>.<br />
                                            <input type="checkbox" id="privacy" name="privacy" value="1" <?= ($privacy == "1" ? "checked" : ""); ?> /> <?= $SITE_NM; ?>'s <a href="javascript: void(0)" onclick="javascript:OpenPopUp('privacy.php','','width=150,height=100')"> <?php echo PRIVACY_POLICY; ?></a>.<br />
                                            <input type="checkbox" id="Newsletter" name="Newsletter" value="1" <?= ($news == "1" ? "checked" : ""); ?> /> <?php echo YES_I_WANT_TO_RECEIVE; ?> <?= $SITE_NM; ?> <?php echo NEWSLETTER; ?>.<br />
                                        </p>
                                        <p>
                                            <button type="submit" name="register" style="padding: 6px 20px;font-size: 16px;cursor: pointer;margin: 30px 0px 0px 350px;background-color: lightgreen;border-radius: 10px;font-weight: bold;"><?php echo REGISTER; ?></button>
                                        </p>
                                
                                 </div>
                                
                                                


                            </form>
                        <?php
                                            } else {
                                                $ress = db_query("select email from registration where id=" . $_SESSION["uid"]);
                                                $email = db_result($ress, 0);
                                                db_free_result($ress);
                        ?>

                                                <div class="information">
                                                    <h4><?php echo PLEASE_CONFIRM_YOUR_REGISTRATION; ?></h4>
                                                    <p><?php echo WE_HAVE_SENT_AN_EMAIL_TO; ?> <?php echo $email; ?><br/>
                                <?php echo WE_HAVE_SENT_YOU_A_VERIFICATION_EMAIL_COTAINING_YOUR; ?> <?= $SITE_NM; ?>, <?php echo CLICK_ACTIVE_YOUR_ACCOUNT; ?><br/>
                                                <span class="red-text-12-b">Important:</span>
                                <?php echo IF_YOU_DONT_RECEIVE_THIS_EMAIL; ?>, <a href='feedback.php' class='darkblue-12-link'><?php echo CLICK_HERE; ?></a>.
                                            </p>

                            <?php
                                                if (Sitesetting::isEnableInviter() == true) {
                            ?>
                                                    <h4><?php echo INVITE_A_FRIENDS; ?></h4>

                            <?php
                                                    include_once 'inviter.php';
                            ?>
                            <?php } ?>
                                            </div>
                        <?php
                                                session_unregister("uid");
                                            }
                        ?>
                                      </div><!-- /content -->
                                    </div><!-- /column-right -->
                               </div>    
                                
            <?php include("$BASE_DIR/include/exhibia/footer.php"); ?> 
            
</div><!-- /container --