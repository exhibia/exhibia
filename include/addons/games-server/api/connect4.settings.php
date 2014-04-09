 <?php 
if(!$DBSERVER){
require("../../../../config.inc.php");

}
 ini_set('display_errors' , 1);
 
 $active = 'Connect Four Settings'; 
 include_once $BASE_DIR . '/include/addons/games-server/admin/games.txt.php';

 $admin_s = 'true';
if(!empty($_REQUEST['submit'])){
    foreach($_REQUEST['connect4'] as $key => $value){
   
	if(db_num_rows(db_query("select * from sitesetting where name = '$_REQUEST[domain]:game:connect4:$key'")) == 0){
	    db_query("insert into sitesetting (id, name, value) values(null, '$_REQUEST[domain]:game:connect4:$key', '$value');");
	
	}else{
	
	    db_query("update sitesetting set value = '$value' where name = '$_REQUEST[domain]:game:connect4:$key'");
	
	}

    }
}
$admin = 'true';
require($BASE_DIR . "/include/addons/games-server/api/connect4.config.inc.php");


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
                                                    <fieldset style="position:relative;left:50px;width:900px;">
						      <div class="forms">
								<div class="row">
                                                                    <label>Cost per game:</label>
                                                                    <div class="inputs">
                                                                     
                                                                         <input type="text" name="connect4[take]" id="connect4[take]" value="<?php echo $connect4['take']; ?>" />
                                                                       
                                                                        
                                                                        
									
                                                                    </div>
                                                                </div>
								<div class="row">
                                                                    <label>Take from:</label>
                                                                    <div class="inputs">
                                                                     
                                                                         <select name="connect4[take_from]" id="connect4[take_from]">
									    <option value="free_bids" <?php if($connect4['take_from'] == 'free_bids'){ echo 'selected';  } ?>>Free Bids</option>
									    <option value="final_bids"<?php if($connect4['take_from'] == 'final_bids'){ echo 'selected';  } ?>>Actual Bids</option>
                                                                         
                                                                         </select>
                                                                       
                                                                        
                                                                        
									
                                                                    </div>
                                                                </div>
								<div class="row">
                                                                    <label>Winner Payout:</label>
                                                                    <div class="inputs">
                                                                     
                                                                         
                                                                       <input type="text" name="connect4[reward]" id="connect4[reward]" value="<?php echo $connect4['reward']; ?>" />
                                                                       
                                                                        
                                                                        
									
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label>Payout in:</label>
                                                                    <div class="inputs">
                                                                     <select name="connect4[reward_with]" id="connect4[reward_with]">
									    <option value="free_bids" <?php if($connect4['reward_with'] == 'free_bids'){ echo 'selected';  } ?>>Free Bids</option>
									    <option value="final_bids" <?php if($connect4['reward_with'] == 'final_bids'){ echo 'selected';  } ?>>Actual Bids</option>
                                                                         
                                                                         </select>
                                                                         
                                                                       
                                                                        
                                                                        
									
                                                                    </div>
                                                                </div>
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
          
