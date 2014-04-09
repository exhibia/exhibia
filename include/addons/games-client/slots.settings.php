 <?php 
 $games_server = "http://pennyauctionsoftdemo.com/";
 $active = 'Master Settings'; 
 include_once $BASE_DIR . '/include/addons/games-clientadmin/games.txt.php';

 $admin_s = 'true';
 

if(!empty($_REQUEST['submit'])){
    foreach($_REQUEST['fruits'] as $key => $fruit){
   
	foreach($_REQUEST['payouts'][$fruit] as $repeats => $paysout){
	   db_query("update sitesetting set value = '$repeats:$paysout' where name = 'games:slots:$fruit' and value like '$repeats:%'");
	}
      }

}
$admin = 'true';
include($BASE_DIR . "/include/addons/games-clientslots.config.inc.php");
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
						      <?php
						      foreach($fruits as $key => $fruit){
						       ?> 
						       <!--[if !IE]>start row<![endif]-->
                                                       <div class="row" style="height:90px;">
						       
						       <label><img style="width:45px; height:auto;" src="../include/addons/games-clientslots/image/<?php echo $fruit;?>.png" /></label>
						       <div style="float:left;position:relative;top:-15px;left:-100px;">
						       <input type="hidden" name="fruits[<?php echo $key;?>]" id="fruits[<?php echo $key;?>]" value="<?php echo $fruit;?>" />
							  <ul style="list-style:none;">
							  
						      <?php
							    foreach($payouts[$fruit] as $repeats => $payout){
							      ?>
							      <li style="display:inline;">
								    <ul style="list-style:none;display:inline;float:left;">
								      <li>
									  <?php $i = 1;
									  while($i <= $repeats){
									  ?>
									  <img style="width:15px; height:auto;display:inline;float:left;" src="<?php echo $games_server;?>/include/addons/games-clientslots/image/<?php echo $fruit;?>.png" />
									  
									  <?php $i++; } ?>
									  <br />
								      </li>
								      <li>
									  Paysout:
										  
										  <input type="text" name="payouts[<?php echo $fruit;?>][<?php echo $repeats;?>]" id="payouts[<?php echo $fruit;?>][<?php echo $repeats;?>]t" size="3" maxlength="3" class="text" value="<?php echo $payout; ?>" style="width:50px;" />
								      </li>
								    </ul>
							      </li>
                                                             <?php        
						      
							       }
							    
							     ?>
								</ul>
							    </div>
                                                                </div>
                                                                
                                                                <?php
							    
						      }
						      ?>
						     
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
