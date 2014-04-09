
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->
            <div id="wrapper" class="clearfix" >
                <div id="maincol">

                    <div id="registration-wrap">
                        

                        <h2><?php echo REGISTRATION; ?></h2>
                        
                        <div style="float: right; right: 20px; top: 5px; position: relative; font-size: 14px; font-weight: bold;">
                            <table>
                                <tbody><tr><td align="right">
                                            <script type="text/javascript" src="flash/getseal"></script>
                                            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" id="s_s" width="100" align="" height="72">
                                                <param name="movie" value="https://seal.verisign.com/getseal?at=1&amp;&amp;sealid=2&amp;dn=WWW.QUIBIDS.COM&amp;aff=VeriSignCACenter&amp;lang=en"/>
                                                <param name="loop" value="false"/>
                                                <param name="menu" value="false"/>
                                                <param name="quality" value="best"/>
                                                <param name="wmode" value="transparent"/>
                                                <param name="allowScriptAccess" value="always"/>
                                                <embed src="flash/getseal_002" loop="false" menu="false" quality="best" wmode="transparent" swliveconnect="FALSE" name="s_s" type="application/x-shockwave-flash" pluginspage="https://www.macromedia.com/go/getflashplayer" allowscriptaccess="always" width="100" align="" height="72"/>
                                            </object>
                                        </td><td width="5">&nbsp;</td><td>
                                            <img src="css/quibids-1.0/lock.png"/>
                                        </td></tr>
                                </tbody>
                            </table>
                        </div>
     
<table>

  <tr>
      <td colspan="1"  valign="top" align="right">

                        <?php include("reg_text.php"); ?>
      </td>
               <td valign="top"> 
 
                                          <?
                        if (!isset($_SESSION["uid"])) {
                        ?>
  
                        <div id="login-form" style="margin-left:20px;">

                            <form method="post" action="registration.php" id="registration">                                
                                <ul>
                                <?php if (isset($errorMsg) && $errorMsg != '') {
                                ?>
                                <?php echo $errorMsg; ?>
                                <?php } ?>
                                </ul>
                                <label><?php echo FIRST_NAME; ?>:</label>
                                <input id="firstname" name="firstname" maxlength="100" value="<?=($fname != "" ? $fname : ""); ?>" type="text"/>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_firstname" style="display: none;" border="0"/></a>

                                <label><?php echo LAST_NAME; ?>:</label>
                                <input id="lastname" name="lastname" maxlength="100" value="<?=($lname != "" ? $lname : ""); ?>" type="text"/>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_lastname" style="display: none;" border="0"/></a>

                                <label><?php echo DATE_OF_BIRTH; ?>:</label>
                                <select id="month" name="month" style="width:70px;">
                                    <option selected="selected" value="mm">MM</option>
                                    <option <?php echo $_POST["month"] == "01" ? "selected" : ""; ?> value="01"><?php echo JANUARY; ?></option>
                                    <option <?php echo $_POST["month"] == "02" ? "selected" : ""; ?> value="02"><?php echo FEBRUARY; ?></option>
                                    <option <?php echo $_POST["month"] == "03" ? "selected" : ""; ?> value="03"><?php echo MARCH; ?></option>
                                    <option <?php echo $_POST["month"] == "04" ? "selected" : ""; ?> value="04"><?php echo APRIL; ?></option>
                                    <option <?php echo $_POST["month"] == "05" ? "selected" : ""; ?> value="05"><?php echo MAY; ?></option>
                                    <option <?php echo $_POST["month"] == "06" ? "selected" : ""; ?> value="06"><?php echo JUNE; ?></option>
                                    <option <?php echo $_POST["month"] == "07" ? "selected" : ""; ?> value="07"><?php echo JULY; ?></option>
                                    <option <?php echo $_POST["month"] == "08" ? "selected" : ""; ?> value="08"><?php echo AUGUST; ?></option>
                                    <option <?php echo $_POST["month"] == "09" ? "selected" : ""; ?> value="09"><?php echo SEPTEMBER; ?></option>
                                    <option <?php echo $_POST["month"] == "10" ? "selected" : ""; ?> value="10"><?php echo OCTOBER; ?></option>
                                    <option <?php echo $_POST["month"] == "11" ? "selected" : ""; ?> value="11"><?php echo NOVEMBER; ?></option>
                                    <option <?php echo $_POST["month"] == "12" ? "selected" : ""; ?> value="12"><?php echo DECEMBER; ?></option>
                                </select>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_month" style="display: none;" border="0"/></a>

                                <select id="date" name="date" style="width:50px;">
                                    <option value="dd">DD</option>
                                    <?php for ($i = 1; $i <= 31; $i++) {
                                    ?>
                                        <option value="<?php echo ($i <= 9 ? "0" . $i : $i); ?>" <?php echo ($_POST["date"] == $i ? "selected" : ""); ?>><?php echo ($i <= 9 ? "0" . $i : $i); ?></option>
                                    <?php } ?>
                                </select>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_date" style="display: none;" border="0"/></a>

                                <select id="year" name="year" style="width:70px;">
                                    <option selected="selected" value="yyyy">YYYY</option>
                                    <?php for ($i = 1950; $i <= 2020; $i++) {
 ?>
                                        <option <?php echo ($_POST["year"] == $i ? "selected" : ""); ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
                                </select>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_year" style="display: none;" border="0"/></a>

                                <label><?php echo GENDER; ?>:</label>
                                <select id="gender" name="gender" style="width: 125px;">
                                    <option selected="selected" value="Male"><?php echo MALE; ?></option>
                                    <option <?php echo $gender == "Female" ? "selected" : ""; ?> value="Female"><?php echo FEMALE; ?></option>
                                </select>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_gender" style="display: none;" border="0"/></a>

                                <div class="clear"></div>
                                &nbsp;<br/>
                                <label><?php echo ADDRESS_LINE; ?> 1:</label>
                                <input id="addressline1" type="text" name="addressline1" maxlength="100" value="<?php echo ($addressline1 != "" ? $addressline1 : ""); ?>"/>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_addressline1" style="display: none;" border="0"/></a>

                                <label><?php echo ADDRESS_LINE; ?> 2:</label>
                                <input id="addressline2" type="text" name="addressline2" maxlength="100" value="<?php echo ($addressline2 != "" ? $addressline2 : ""); ?>"/>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_addressline2" style="display: none;" border="0"/></a>

                                <label><?php echo TOWN_CITY; ?>:</label>
                                <input id="city" name="city" maxlength="100" value="<?=($city != "" ? $city : ""); ?>" type="text"/>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_city" style="display: none;" border="0"/></a>

                                <label><?php echo STATE; ?>:</label>

                                <select id="state" name="state">
                                   
                                    <?php
                    
                                   
                                    $resstate = db_query("select id, stname from usstates ORDER BY id , stname ASC");
                                    while (( $objstate = db_fetch_array($resstate))) {
?>
                                        <option <?php echo ($objstate["stname"] == $state ? "selected" : ""); ?> value="<?php echo stripslashes($objstate["stname"]); ?>"><?php echo stripslashes($objstate["stname"]); ?></option>
                                    <?php
                                    }
                                    db_free_result($resstate);
                                    ?>

                                </select> 
<br />                             
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_state" style="display: none;" border="0"/></a>

                               <!-- <label><?php echo COUNTRY; ?>:</label>
                                <select id="countrycode" name="countrycode" style="width:220px;">
                                    <option value="none"><?php echo PLEASE_SELECT_COUNTRY; ?></option>
                                    <?
                                    $rescou = db_query("select countryId, printable_name from countries order by printable_name");
                                    while (( $country = db_fetch_object($rescou))) {
                                    ?>
                                        <option <?=($country->countryId == $countrycode ? "selected" : "");
                                    ?> value="<?=$country->countryId; ?>"><?=$country->printable_name; ?></option>
                                        <?
                                    }
                                    db_free_result($rescou);
                                        ?>
                                </select>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_countrycode" style="display: none;" border="0"/></a>
-->
<input type="hidden"  id="countrycode" name="countrycode" value="PA" />
                               <label><?php echo ZIP_CODE; ?>:</label>
                                <input id="postcode" name="postcode" value="<?php echo ($postcode != "" ? $postcode : ""); ?>" type="text"/>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_postcode" style="display: none;" border="0"/></a>

                                <label><?php echo PHONE_NUMBER; ?>:</label>
                                <input id="phoneno" name="phoneno" maxlength="100" value="<?php echo ($phoneno != "" ? $phoneno : ""); ?>" type="text"/>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_phoneno" style="display: none;" border="0"/></a>

                                <br/>&nbsp;<br/>

                                <label><?php echo AFFILIATE_CODE; ?>:</label>
                                <input id="referid" name="referid" value="" type="text"/>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_referid" style="display: none;" border="0"/></a>


                                <label><?php echo USERNAME; ?>:</label>
                                <?php if ($errr == 2) { ?>
                                        <input type="text" id="rusername" name="username" maxlength="16" />
                                <?php } else {
 ?>
                                        <input type="text" id="rusername" name="username" maxlength="16" value="<?php echo ($username != "" ? $username : ""); ?>"/>
<?php } ?>
                                    <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_rusername" style="display: none;" border="0"/></a>

                                    <label><?php echo PASSWORD; ?>:</label>
                                    <input type="password" id="rpassword" name="password" maxlength="16" value="<?php echo ($pass != "" ? $pass : ""); ?>" onkeyup="pwd_test_password(this.value);"/>
                                    <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_rpassword" style="display: none;" border="0"/></a>

                                    <label><?php echo RETYPE_PASSWORD; ?>:</label>
                                    <input name="cnfpassword" id="cnfpassword" type="password" maxlength="16" value="<?php echo ($pass != "" ? $pass : ""); ?>"/>
                                    <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_cnfpassword" style="display: none;" border="0"/></a>

                                    <span class="strength">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td valign="top"><strong><span style="font-size: 10px; color: rgb(150, 150, 150);"><?php echo PASSWORD_SECURITY; ?>:</span></strong></td>
                                                    <td>
                                                        <div style=" background:url(images/securty-bg.gif) no-repeat; width:118px; height:28px; float:left">
                                                            <div style="width: 100px; margin-left: 10px; margin-top: 4px;">
                                                                <div id="pwd_text" style="font-size: 10px;"></div>
                                                                <div id="pwd_bar" style="font-size: 1px; height: 5px; width: 0px; border: 1px solid white;"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </span>

                                    <br/>&nbsp;<br/>

                                    <label><?php echo EMAIL_ADDRESS; ?>:</label>
<?php if ($errr == 1) { ?>
                                        <input type="text" id="email" name="email" maxlength="150" value="" />
                                <?php } else { ?>
                                        <input type="text" id="email" name="email" maxlength="150" value="<?=($email != "" ? $email : ""); ?>" />
                                <?php } ?>
                                    <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_email" style="display: none;" border="0"/></a>

                                    <label><?php echo RETYPE_EMAIL_ADDRESS; ?>:</label>
                                <?php if ($errr == 1) {
                                ?>
                                        <input type="text" id="cnfemail" name="cnfemail" maxlength="150" value="" />
                                <?php } else {
                                ?>
                                        <input type="text" id="cnfemail" name="cnfemail" maxlength="150" value="<?=($email != "" ? $email : ""); ?>" />
                                <?php } ?>
                                <a class="info"><img src="css/quibids-1.0/info-icon.png" alt="" id="flag_cnfemail" style="display: none;" border="0"/></a>
                                <br/>&nbsp;<br/>

                                <label><?php echo ENTER_THE_CODE; ?>:</label>
                                <input id="rndcode" name="rndcode" value="" type="text" style="width:100px;"/>
                                <img src="CaptchaSecurityImages.php?width=250&height=100&character=6" width="116px" height="36px" border="1" />
                                <br/>&nbsp;<br/>
                                <div class="wraps" style="line-height: 20px;">
                                    <input type="checkbox" id="terms" name="terms" value="1" <?php echo ($terms == "1" ? "checked" : ""); ?> /> 
				     <a href="javascript: void(0)" onclick="javascript:OpenPopUp('terms.php','','width=150,height=100')"> <?php  echo I_ACCEPT_TERMS;?></a> <?php echo $SITE_NM; ?>
                                   
                                    <br/>

                                    <input type="checkbox" id="privacy" name="privacy" value="1" <?php echo ($privacy == "1" ? "checked" : ""); ?> />
                                    <a href="javascript: void(0)" onclick="javascript:OpenPopUp('privacy.php','','width=150,height=100')"> <?php echo I_ACCEPT_PRIVACY;?></a> <?php echo $SITE_NM; ?>
                                    <br/>

                                    <input type="checkbox" id="Newsletter" name="Newsletter" value="1" <?php echo ($news == "1" ? "checked" : ""); ?> /> <?php echo YES_I_WANT_TO_RECEIVE; ?> <?php echo $SITE_NM; ?> <?php echo NEWSLETTER; ?>.<br />

                                    <input name="login" value="<?php echo REGISTER; ?>" class="button" type="submit"/>
                                    <div class="clear"></div>
                                </div>
                            </form>
               
                              <?php
                                            } else {
                                                $ress = db_query("select email from registration where id=" . $_SESSION["uid"]);
                                                $email = db_result($ress, 0);
                                                db_free_result($ress);
                        ?>
                             
                                                  <div id="login-form" style="border: 1px solid gray;border-radius:5px 5px 5px 5px;margin-left:40px;">
                                                    <h4><?php echo PLEASE_CONFIRM_YOUR_REGISTRATION; ?></h4>
                                                    <p><?php echo WE_HAVE_SENT_AN_EMAIL_TO; ?> <?php echo $email; ?><br/>
						      <?php echo WE_HAVE_SENT_YOU_A_VERIFICATION_EMAIL_COTAINING_YOUR; ?> <?php echo $SITE_NM; ?>, <?php echo CLICK_ACTIVE_YOUR_ACCOUNT; ?><br/>
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
						
                        <?php
                                              //  session_unregister("uid");
                                            }
                        ?>
                             <div id="login-form-end"></div>
                        </div>
                     
      </td>
    </tr>
</table>
                        <div class="clear"></div>
                        <div id="login-register-end"></div>
                    </div>

                    <!-- ============= End Registration =============  -->
                </div>
            </div>
            <div id="wrap-end"></div>



        </div>

        <?php include("$BASE_DIR/include/$template/footer.php") ?>
    

