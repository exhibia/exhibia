   <!--[if !IE]>start section<![endif]-->
                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Paypal Pro Setting</h2>
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>
                            <!--[if !IE]>end title wrapper<![endif]-->
                            <!--[if !IE]>start section content<![endif]-->
                            <div class="section_content">
                                <!--[if !IE]>start section content top<![endif]-->
                                <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">
                                                    <br/>
                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="f1" action="paypalsetting.php" method="post" class="search_form general_form">

                                                        <?php
                                                        $paypalProInfo=$gateway->getPaypalPro();
                                                        ?>
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label style="width:130px;">API Username:</label>
                                                                    <div class="inputs" style="width:480px;">
                                                                        <span class="input_wrapper" style="width:400px;">
                                                                            <input type="text" size="50" name="apiusername" class="text" value="<?=$paypalProInfo->getUsername();?>" maxlength="255" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label style="width:130px;">API Password:</label>
                                                                    <div class="inputs" style="width:480px;">
                                                                        <span class="input_wrapper" style="width:400px;">
                                                                            <input type="text" size="50" name="apipassword" class="text" value="<?=$paypalProInfo->getPassword();?>" maxlength="255" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label style="width:130px;">API Signature:</label>
                                                                    <div class="inputs" style="width:480px;">
                                                                        <span class="input_wrapper" style="width:400px;">
                                                                            <input type="text" size="50" name="apisignature" class="text" value="<?=$paypalProInfo->getSignature();?>" maxlength="255" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>&nbsp;</label>
                                                                    <div class="inputs">
                                                                        <ul class="inline">
                                                                            <li><input class="checkbox" <?=$paypalProInfo->isEnabled()==true?"checked":""?> type="checkbox" name="enabled" value="1"/> Enabled</li>

                                                                        </ul>
                                                                        <ul>
                                                                            <li><input class="checkbox" <?=$paypalProInfo->isTestMode()==true?"checked":""?> type="checkbox" name="testmode" value="1"/> TestMode</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <input type="hidden" value="paypalpro" name="for"/>
                                                                                <span class="button send_form_btn"><span><span>Submit</span></span><input name="editinfo" type="submit"/></span>
                                                                            </li>

                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                            </div>
                                                            <!--[if !IE]>end forms<![endif]-->

                                                        </fieldset>
                                                        <!--[if !IE]>end fieldset<![endif]-->
                                                    </form>
                                                    <!--[if !IE]>end forms<![endif]-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
                        <!--[if !IE]>end section<![endif]--> 
 
