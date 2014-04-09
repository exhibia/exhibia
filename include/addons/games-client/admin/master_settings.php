 <?php $active = 'Master Settings'; 
 include_once $BASE_DIR . '/include/addons/games/admin/games.txt.php';
if(!empty($_REQUEST['submit'])){
 
    foreach($_REQUEST['master_game_settings'] as $key => $value){
 
	if(db_num_rows(db_query("select * from sitesetting where name = 'master_game_settings:$key'")) >= 1){
	    db_query("update sitesetting set value = '$value' where name = 'master_game_settings:$key'");
	echo db_error();
	}else{
	
	    db_query("insert into sitesetting (id, name, value) values(null, 'master_game_settings:$key', '$value');");
	    
	
	}
 echo db_error();
 
 }
 
 }
 
 
 
 
include($BASE_DIR . "/include/addons/games/config.inc.php");
 ?>
 
		  <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2><?php echo $active; ?></h2>
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
                                                   
                                                     <!--[if !IE]>start system messages<![endif]-->

                                                    <ul class="system_messages">
                                                        <?php if (isset($msg)) {
                                                        ?>
                                                            <li class="red"><span class="ico"></span><strong class="system_title"><?= $msg; ?></strong></li>
                                                        <?php } ?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>
                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <br/>
                                                    <form id="form1" action="get_addon.php" method=post enctype="multipart/form-data" class="search_form general_form">
                                                    <fieldset>
						      <div class="forms">
						      
						      
								<div class="row">
                                                                    <label>Use Free Bids or Actual Bids:</label>
                                                                     <div class="inputs">
                                                                     
                                                                            <select name="master_game_settings[which_to_use]" id="master_game_settings[which_to_use]">
									      <option value="free_" <?php if($master_game_settings['which_to_use'] == 'free_'){ echo 'selected'; } ?>>Free Bids</option>
									      <option value="" <?php if($master_game_settings['which_to_use'] != 'free_'){ echo 'selected'; } ?>>Actual Bids</option>
                                                                            
                                                                            </select>
                                                                       
                                                                        <span class="system required">*</span>
                                                                        
                                                                        
                                                                
									<span class="system message">Warning: the legality of using actual bids is dependant upon where your orginisation is located</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label>Payout in Free Bids or Actual Bids:</label>
                                                                     <div class="inputs">
                                                                     
                                                                            <select name="master_game_settings[which_to_pay_out]" id="master_game_settings[which_to_pay_out]">
									      <option value="free_" <?php if($master_game_settings['which_to_pay_out'] == 'free_'){ echo 'selected'; } ?>>Free Bids</option>
									      <option value="" <?php if($master_game_settings['which_to_pay_out'] != 'free_'){ echo 'selected'; } ?>>Actual Bids</option>
                                                                            
                                                                            </select>
                                                                       
                                                                        <span class="system required">*</span>
                                                                        
                                                                        
                                                                
									<span class="system message">Warning: the legality of using actual bids is dependant upon where your orginisation is located</span>
                                                                    </div>
                                                                </div>
                                                                  <div class="row">
                                                                    <label>Give Bids Back On Win:</label>
                                                                     <div class="inputs">
                                                                     
                                                                            <select name="master_game_settings[give_bids_back_on_win]" id="master_game_settings[give_bids_back_on_win]">
									      <option value="0" <?php if($master_game_settings['give_bids_back_on_win'] == '0'){ echo 'selected'; } ?>>No</option>
									      <option value="1" <?php if($master_game_settings['give_bids_back_on_win'] == '1'){ echo 'selected'; } ?>>Yes</option>
                                                                            
                                                                            </select>
                                                                       <span class="system required">*</span>
                                                                        <br />
                                                                        
                                                                        
                                                                
									<span class="system message">In addition to the payout amount the user will be given back the bids / credits placed</span>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <label>Allow User To Determine Bid Amount:</label>
                                                                     <div class="inputs">
                                                                     
                                                                            <select name="master_game_settings[allow_user_bid_price]" id="master_game_settings[allow_user_bid_price]">
									      <option value="yes" <?php if($master_game_settings['allow_user_bid_price'] == 'yes'){ echo 'selected'; } ?>>Yes</option>
									      <option value="" <?php if($master_game_settings['allow_user_bid_price'] != 'yes'){ echo 'selected'; } ?>>No</option>
                                                                            
                                                                            </select>
                                                                       
                                                                        <span class="system required">*</span>
                                                                        
                                                                        
                                                                
									<span class="system message">Warning: the legality of allowing this is dependant upon where your orginisation is located</span>
                                                                    </div>
                                                                </div>
                                                                  <div class="row">
                                                                    <label>Default Amount Per Bid:</label>
                                                                     <div class="inputs">
                                                                    
                                                                            <input type="text" name="master_game_settings[price_per_bid]" id="master_game_settings[price_per_bid]" value="<?php echo $master_game_settings['price_per_bid'];?>">
								   
                                                                        <span class="system required">*</span>
                                                                        
                                                                        
                                                                
									<span class="system message">Does Nothing if Above Setting is set to No, also is overridden by some games</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
						     
						    <div style="height:25px;"></div>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Save</span></span><input name="submit" type="submit"  /></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                          </div>
						    </fieldset>
						      <input type="hidden" name="addon" value="games" />
								      <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />
								      <input type="hidden" name="submit" value="submit" />
                                                     </form>
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

                           

                    </div>
                </div>
                <!--[if !IE]>end page<![endif]-->
                <!--[if !IE]>start sidebar<![endif]-->
                <div id="sidebar">
                    <div class="inner">
                   
                        <?php include 'include/leftside.php' ?>
                    </div>
                </div>
                <!--[if !IE]>end sidebar<![endif]-->

            </div>
            <!--[if !IE]>end content<![endif]-->

        </div>
        <!--[if !IE]>end wrapper<![endif]-->

        <!--[if !IE]>start footer<![endif]-->
        <div id="footer">
            <div id="footer_inner">
                <?php include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

            </div>
            <!--[if !IE]>end content<![endif]-->