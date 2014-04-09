<?php
require("../../config/connect.php");
if($_REQUEST['social_verify'] == 'facebook'){
      include("$BASE_DIR/include/addons/facebook/index.php");
}else if($_REQUEST['social_verify'] == 'google'){
      include("$BASE_DIR/include/addons/google/index.php");
}
?>
<style>
form { text-align:left; }
form p { margin:5px 0 5px 0; clear:both;}
form p label{ float:left; width:250px;}
form p span input{ float:right; width:200px; }
.row {
  clear: both;
}
form p span select {
border-radius:6px;
background-color:#fff;
}
</style>

		  <h3><img src="<?php echo $picture;?>" style="float:left;width:60px;height:auto;margin-left:20px;" />Welcome <?php echo $userInfo['name']; ?></h3>
		  <h4>Please complete your registration</h4>
                            <form action="verify_account_or_register.php" id="registration" name="registration" method="post"  accept-charset="utf-8" >
				  <input type="hidden" name="email" id="email"  value="<?php echo $email;?>" />
				  <input type="hidden" name="username" id="username"  value="<?php echo $userInfo['name'];?>" />
				  <input type="hidden" name="firstname" id="firstname"  value="<?php echo $firstname;?>" />
				  <input type="hidden" name="lastname" id="lastname"  value="<?php echo $lastname;?>" />
				  <input type="hidden" name="cfnemail" id="cfnemail"  value="<?php echo $email;?>" />
				  <?php if(isset($birthday)) { ?>
				  <input type="hidden" name="month" id="month"  value="<?php echo $birthday[0];?>" />
				  <input type="hidden" name="date" id="date"  value="<?php echo $birthday[1];?>" />
				  <input type="hidden" name="year" id="year"  value="<?php echo $birthday[2];?>" />
				  <?php }else{ ?>
				  <p>
                                            <label for="date"><?php echo DATE_OF_BIRTH; ?>:<small class="req_input">*</small></label>
                                            <span style=" margin-left: 115px;">
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
				  
				  
				  <?php } ?>
				  <input type="hidden" value="<?php echo $location[0];?>" name="city" id="city" />
				  <input type="hidden" value="<?php echo $location[1];?>" name="state" id="state" />
				  <input type="hidden" name="cfnemail" id="cfnemail" />
				  <input type="hidden" name="social_verify" id="social_verify" value="<?php echo $_REQUEST['social_verify']; ?>" />
				      <p>

                                            <label for="rpassword"><?php echo PASSWORD; ?>:<small class="req_input">*</small></label>
                                            <span>
                                                <input type="password" onkeyup="pwd_test_password(this.value);" id="rpassword" name="password" maxlength="16" value="<?= ($pass != "" ? $pass : ""); ?>"  />
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
                                                    <div style=" background:url(images/securty-bg.gif) no-repeat; width:118px; height:28px; float:right;">
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
                                            <label style="width:200px;" for="rndcode"><?php echo ENTER_THE_CODE; ?>:</label>
                                            <span>
                                                <input type="text" id="rndcode" name="rndcode" value="" />
                                                <span></span>
                                                <span style="display:inline-block;margin:0 5px 0 0;">
                                                    <img src="CaptchaSecurityImages.php?width=250&height=100&character=6" width="116px" height="36px" border="1" />
                                                </span>
                                            </span>
                                        </p>
                                        <p>
                                         <label for="" style="width:auto;float:none;"><?php echo I_HAVE_READ_UNDERSTOOD_AND_ACCEPTED; ?> :</label>
                                         </p>
                                        <p>
                                           
                                            <input type="checkbox" id="terms" name="terms" value="1" <?= ($terms == "1" ? "checked" : ""); ?> /> <?= $SITE_NM; ?>'s <a href="javascript: void(0)" onclick="javascript:OpenPopUp('terms.php','','width=150,height=100')"><?php echo TERMS_CONDITIONS; ?></a>.<br />
                                            <input type="checkbox" id="privacy" name="privacy" value="1" <?= ($privacy == "1" ? "checked" : ""); ?> /> <?= $SITE_NM; ?>'s <a href="javascript: void(0)" onclick="javascript:OpenPopUp('privacy.php','','width=150,height=100')"> <?php echo PRIVACY_POLICY; ?></a>.<br />
                                            <input type="checkbox" id="Newsletter" name="Newsletter" value="1" <?= ($news == "1" ? "checked" : ""); ?> /> <?php echo YES_I_WANT_TO_RECEIVE; ?> <?= $SITE_NM; ?> <?php echo NEWSLETTER; ?>.<br />
                                        </p>
                                        <p>
                                            <button type="submit" class="button" name="register" style="border-radius: 10px;cursor: pointer;font-size: 16px;font-weight: bold;margin: -30px 0 0 100px;padding: 6px 20px;float: right;"><?php echo REGISTER; ?></button>
                                        </p>
                                     </form>