        <div id="main">
            <?php
            include("header.php");
            ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
	      <div class="tab-area">
                <div id="column-right">

                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><em><?php echo PLEASE_CONFIRM_WON_AUCTION; ?></em></p>
                    </div><!-- /title-category-content -->

                    <div class="rounded_corner">
                        <div class="content">
                            <div style="text-align:justify; text-align: justify" align="center">
                                <div class="darkblue-17" align="center"><?php=stripslashes($objsel->name);?></div>
                                <?php
                                if($err==1) {
                                    ?>
                                <div style="margin-top: 15px; margin-left: 40px;" align="center" class="redfont"><?php echo AUCTION_ACCEPT_PERIOD_IS_OVER; ?></div>
                                    <?php
                                }
                                elseif($err==2) {
                                    ?>
                                <div style="margin-top: 10px;" align="center" class="redfont"><?php echo YOU_HAVE_ALREADY_ACCEPT_OR_DENIED_THIS_AUCTION; ?></div>
                                    <?php
                                }
                                ?>
                                <div style="margin-top: 20px;" align="center">
                                    <div style="width: 270px;" align="center">
                                        <form name="login" action="" method="post" onSubmit="return CheckValue(this);">
                                            <div class="normal_text_big" style="height: 25px;" align="left"><?php echo USERNAME; ?> :</div>
                                            <div style="height: 25px;" align="left"><input type="text" name="username" size="40" class="logintextboxclas" /></div>

                                            <div class="normal_text_big" style="height: 25px; margin-top: 15px;" align="left"><?php echo PASSWORD; ?> : </div>
                                            <div style="height: 25px;" align="left"><input type="password" name="password" size="40" class="logintextboxclas" /></div>

                                            <div class="normal_text" style="height: 25px; clear:both; margin-top: 20px; padding-bottom: 10px;" align="left"><?php echo ACCEPT_DENIED; ?> :
                                                <select name="Accden">
                                                    <option value=""><?php echo PLEASE_SELECT; ?></option>
                                                    <option value="Accepted"><?php echo ACCEPT; ?></option>
                                                    <option value="Denied"><?php echo DENIED;?></option>
                                                </select>
                                                <input type="hidden" value="<?php=$auctionID;?>" name="auctionid" />
                                            </div>
                                            <div style="padding-bottom: 25px; margin-top: 15px;" align="center">
                                                <button name="submit1" value="Submit1"  class="button77"><?php echo SUBMIT; ?></button>

                                            </div>
                                            <input type="hidden" value="Submit" name="submit" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="column-left">
                    <?php include("leftside.php"); ?>
                  
                
                </div><!-- /column-left -->
                </div>
            </div>

            <?php
            include("footer.php");
            ?>
         
