<?php
session_start();
$active="Users";
include("connect.php");
include("security.php");
ini_set('display_errors', 1);

//include_once("gd.inc.php");
include_once("imgsize.php");

@db_query("CREATE TABLE `user_ranking_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `row_to_match` varchar(50) NOT NULL DEFAULT '0',
  `rank_name` varchar(200) not null,
  `min_amount` text,
  `rank_image` text null,
  `bids_awarded` int(11) null,
  `free_bids_awarded` int(11) null,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;");
@db_query("alter table user_ranking_rules add column preference int(11) not null;");
@db_query("alter table user_ranking_rules add column preference int(11) not null unique;");
@db_query("alter table bid_account_bidding add column `topbidder` int(11) null");
@db_query("alter table bid_account_bidding add column `timestamp` int(11) null");

if(db_num_rows(db_query("select * from user_ranking_rules")) == 0){
db_query("INSERT INTO `user_ranking_rules` VALUES (null,'purchased_bids','Novice',0.00,'yellow_chip.png',0,0,1,1),(null,'time_as_high_bidder','Beginner',0.00,'yellow_clock.png',0,0,1,2),(null,'used_bids','Beginner',0.00,'blonde_gavel.png',0,0,1,3),(null,'used_bids','Bid Master',100.00,'wood_gavel.png',15,10,1,4),(null,'auctions_won','Auction Sage',2.00,'blue_ribbon.png',20,12,1,5),(null,'auctions_won','Auction Genius',5.00,'red_ribbon.png',30,15,1,6),(null,'used_bids','Heavy Hitter',200.00,'green_gavel.png',50,15,1,7),(null,'dollars_spent','Shop a Holic',200.00,'yellow_dollar.png',20,10,1,8),(null,'dollars_spent','Major Gifter',600.00,'green_dollar.png',40,10,1,9),(null,'friends_refered','Extrovert',3.00,'friend_yellow.png',20,5,1,10),(null,'friends_refered','Life of the Party',7.00,'friend_green.png',45,7,1,11),(null,'friends_refered','Great Neighbor',10.00,'friend_blue.png',50,10,1,12),(null,'time_as_high_bidder','Bid Bunny',24000.00,'yellow_clock.png',5,5,1,14),(null,'time_as_high_bidder','Bid Guerilla',48000.00,'green_clock.png',7,5,1,15),(16,'time_as_high_bidder','Bid Assasin',96000.00,'red_clock.png',9,5,1,16),(null,'time_as_high_bidder','Bid Samurai',192000.00,'clock_blue.png',12,7,1,17),(null,'time_as_high_bidder','Bid Baron',384000.00,'gold_clock.png',15,7,1,18),(null,'used_bids','Auction Addict',500.00,'purple_gavel.png',100,50,1,19),(null,'dollars_spent','Daddy Warbucks',5000.00,'blue_dollar.png',10,20,1,21),(null,'auctions_won','Auction King',30.00,'gold_ribbon.png',10,5,1,22),(null,'friends_refered','Bid God',786000.00,'gold_clock.png',20,20,1,23),(null,'time_as_high_bidder','Bid Ninja',7860000.00,'gold_clock.png',20,20,1,22),(null,'purchased_bids','Guns a blazin',100.00,'yellow_chip.png',5,5,1,25),(null,'purchased_bids','In a groove',200.00,'purple_chip.png',15,7,1,26),(null,'used_bids','Ultimate',2000.00,'blue_gavel.png',200,50,1,43);");

}
if(!empty($_POST['submit'])){

$msg = '';

    foreach($_POST['rank_name'] as $key => $value){
    
    if(!empty($_POST['rank_name'][$key])){
    
    if(!empty($_POST['delete'][$key]) & $_POST['delete'][$key] == '1'){
	
	    db_query("delete from user_ranking_rules where id = '$key' limit 1");
	    $msg .= "<br />deleted rank with id $key";
	
	}else{
	    if(db_num_rows(db_query("select * from user_ranking_rules where id = '$key'")) >0 ){
		$msg .= "<br />Updated User Rank with ID $key";
		
		
		db_query("update user_ranking_rules set row_to_match = '" . $_POST['row_to_match'][$key] . "', rank_name = '" . $_POST['rank_name'][$key] . "', min_amount = '" . $_POST['min_amount'][$key] . "', bids_awarded = '" . $_POST['bids_awarded'][$key] . "', free_bids_awarded = '" . $_POST['free_bids_awarded'][$key] . "', allow_multiple = '" . $_POST['allow_multiple'] . "', preference = '" . $_POST['preference'][$key] . "' where id = '" . $key . "'");
		echo db_error();
		
		echo db_error();
		if(!empty($_FILES['rank_image']['tmp_name'][$key])){
		
		
		    rank_image($_FILES['rank_image']['name'][$key], $key,  $_FILES['rank_image']['tmp_name'][$key]);
		    $msg .= "update user_ranking_rules set rank_image = '" . $_FILES['rank_image']['name'][$key] . "' where id = $id";
		    
		    db_query("update user_ranking_rules set rank_image = '" . $_FILES['rank_image']['name'][$key] . "' where id = $key");
		    
		}
		
	    }else{
	    
			db_query("insert into user_ranking_rules values(null, '" . $_POST['row_to_match'][$key] . "', '" . $_POST['rank_name'][$key] . "', '" . $_POST['min_amount'][$key] . "', '', '" . $_POST['bids_awarded'][$key] . "', '" . $_POST['free_bids_awarded'][$key] . "', '" . $_POST['allow_multiple'] . "', '" . $_POST['preference'][$key] . "');");
		
		echo db_error();
		
		$id = db_insert_id();
		
		$msg .= "<br />Inserted new user rank '" . $_POST['rank_name'][$key] . "'";
		
		if(!empty($_FILES['new_image']['tmp_name'])){
		
		echo $_FILES['new_image']['name'];
		
		    rank_image($_FILES['new_image']['name'],$id,$_FILES['new_image']['tmp_name']);
		    $msg .= "update user_ranking_rules set rank_image = '" . $_FILES['new_image']['name'] . "' where id = $id";
		    
		    db_query("update user_ranking_rules set rank_image = '" . $_FILES['new_image']['name'] . "' where id = $id");
		    
		}
	    
	    
	    
	    }
	
		
	}
   
      }
    }
     db_query("update user_ranking_rules set allow_multiple = '" . $_POST['allow_multiple'] . "'");
		  header("location: message.php?msg=" . urlencode($msg));
		  exit;
	}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage User Ranks-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
	<style>
	tr{border: 1px dashed #fff!important;margin-bottom:10px;}
	    .border {border: 1px dashed #fff!important;} .margin{margin-bottom:10px;} td {padding:5px 5px 0px 5px; }
	
	</style>
	
	<script type="text/javascript" src="js/ui/ui.dialog.min.js"></script>
        <!--[if lte IE 6]>
        <link href="css/menu_ie.css" rel="stylesheet" type="text/css" />
        <![endif]-->
      
        <style>
        #user_info {
        display:none;
        }
        </style>
        <script type="text/javascript">
        
        $(function () {
        $('#check_all').toggle(
        
	   function(){
	    
	      $('.pages').prop('checked', true);
	    
	    },
	    function(){
	    $('.pages').prop('checked', false);
	    
	    }
	    
	    );
        
        });
        </script>
    </head>

    <body>
      <div id="user_info"></div>
        <!--[if !IE]>start wrapper<![endif]-->
        <div id="wrapper">
            <!--[if !IE]>start head<![endif]-->
            <div id="head">
                <?php include('include/header.php'); ?>
            </div>
            <!--[if !IE]>end head<![endif]-->

            <!--[if !IE]>start content<![endif]-->
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">
                    <div class="inner">
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
			    
                                <h2>Manage user Rank</h2>
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
                                                    <div class="categoryorder">
                                                         <form name="f1" action="editchangerank.php" enctype="multipart/form-data" method="post">
							    <?php
							    $rank_names = array("purchased_bids" => 'Purchased Bids',
										"used_bids" => 'Used Bids', 
										"auctions_won" => 'Auctions Won',
										"dollars_spent" => 'Total $ Spent',
										"friends_refered" => 'Friends Refered',
										"time_as_high_bidder" => 'Time as High Bidder'
										);
                                                               ?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            
                                                                            <th style="text-align:left;">Rank Name</th>
                                                                            <th style="text-align:left;">Condition to Match</th>
                                                                            <th style="text-align:left;">Amount</th>
                                                                         
									    <th align="center" width="200px" style="text-align:center;width:200px!important;">Rank image</th>
									    <th style="text-align:left;">Bids to award</th>
									    <th style="text-align:left;">Free Bids to award</th>
									    <th style="text-align:left;">Delete</th>
                                                                        </tr>
                                                                        <tr>
									    <td colspan="7"  style="border-bottom:1px dashed blue;height:20px;">
									    </td>
                                                                        </tr>
                                                                            <?php
                                                                            $total = db_num_rows(db_query("select * from user_ranking_rules"));
                                                                           
                                                                            
									   
									    
									    $result = db_query("select * from user_ranking_rules order by row_to_match, min_amount asc");
                                                                             $i =1;
                                                                             
                                                                               while($row = db_fetch_array($result)){
                                                                               
                                                                             
                                                                                ?>
                                                                     
                                                                                
							      <tr class="border margin <?php if($i % 2!=0){ echo 'first'; }else{ echo 'second'; } ?>">
									      <td valign="top" height="100%" >
                                                                         
                                                                         
										<input value="<?php echo $row['rank_name'];?>" id="rank_name[<?php echo $row['id']; ?>]" name="rank_name[<?php echo $row['id']; ?>]" type="text" />
                                                                         
									      </td>
									      <td valign="top" height="100%" >
                                                                         
                                                                                 <select name="row_to_match[<?php echo $row['id']; ?>]" id="row_to_match[<?php echo $row['id']; ?>]">
										      <?php
										      foreach($rank_names as $key => $value){
										      ?>
										      <option value="<?php echo $key; ?>" <?php if($key == $row['row_to_match'] ){ echo 'selected'; } ?>><?php echo $value;?></option>
										      <?php
										      }
										      ?>
                                                                                 </select>
                                                                                </td>
                                                                                <td valign="top" height="100%" style="text-align:left;">
                                                                                           <?php
                                                                                           if($row['row_to_match'] != 'dollars_spent'){
											      $row['min_amount'] = number_format($row['min_amount'], 0, '', '');
                                                                                           }else{
											      $row['min_amount'] = number_format($row['min_amount'], 2, '.', '');
											      
											      
                                                                                           
                                                                                           }
                                                                                           ?>
                                                                                            <input type="text" value="<?php echo $row['min_amount']; ?>" name="min_amount[<?php echo $row['id'];?>]" id="min_amount[<?php echo $row['id'];?>]" size="5" />
                                                                                             <?php
                                                                                           if($row['row_to_match'] == 'dollars_spent'){
											      echo '$';
                                                                                           }else if ($row['row_to_match'] != 'time_as_high_bidder'){
											      echo 'number';
                                                                                           
                                                                                           }else{
                                                                                           
											      echo 'seconds';
                                                                                           
                                                                                           }
                                                                                           ?>
                                                                                            <input type="hidden" name="preference[<?php echo $row['id'];?>]" id="preference[<?php echo $row['id'];?>]" value="<?php echo $row['id'];?>" />
                                                                                </td>
                                                                                
                                                                                <td valign="top" height="100%" align="center" style="text-align:center;vertical-align:middle;width:200px!important;">
                                                                                        <?php if($row['rank_image']!=''){ ?>
                                                                                        <img src="<?php echo $UploadImagePath . "rank_image/" . $row['rank_image']; ?>" style="vertical-align:middle;margin-right:10px;float:left;height:auto;width:50px;display:inline;"/>
                                                                                        <?php } ?>
                                                                                        <input type="file" name="rank_image[<?php echo $row['id']; ?>]" id="rank_image[<?php echo $row['id']; ?>]" size="4" style="float:right;display:inline;" />
                                                           
                                                                                </td>

                                                                                <td valign="top" height="100%" style="text-align:left;">
										      <input type="text" name="bids_awarded[<?php echo $row['id']; ?>]" id="bids_awarded[<?php echo $row['id']; ?>]" value="<?php echo $row['bids_awarded']; ?>" size="4" />
                                                                                </td>
                                                                                <td valign="top" height="100%" style="text-align:left;">
										      <input type="text" name="free_bids_awarded[<?php echo $row['id']; ?>]" id="free_bids_awarded[<?php echo $row['id']; ?>]" value="<?php echo $row['free_bids_awarded'];?>"  size="4" />
                                                                                </td>
                                                                                <td valign="top" height="100%" style="text-align:left;">
										      <input type="hidden" name="preference[<?php echo $row['id']; ?>]" id="preference[<?php echo $row['id']; ?>]" value="<?php if(empty($row['preference'])){ echo $row['id']; }else { echo $row['preference']; } ?>"  size="4" />
                                                                                
										      <input type="checkbox" id="delete[<?php echo $row['id'];?>]" name="delete[<?php echo $row['id'];?>]" value="1" />
                                                                                </td>
                                                                            </tr>
									<tr>
									<td valign="top" height="100%" colspan="7" height="5px" style="border-bottom:1px dashed blue;">
									</td>
									</tr>
                                                                                <?php 
                                                                                $i = $row['id'] + 1;
                                                                                
                                                                                }
                                                                                
                                                                               if($i == 0){
										    $i = 1;
                                                                               }else{
										  $last  = db_fetch_array(db_query("select id from user_ranking_rules order by id desc limit 1"));
										  $i = $i + $last['id'];
                                                                               }
                                                                            ?>
					    
							      <tr class="<?php if($i % 2!=0){ echo 'first'; }else{ echo 'second'; } ?>">
									      <td valign="top" height="100%" >
                                                                         
                                                                         
										<input id="rank_name[<?php echo $i; ?>]" name="rank_name[<?php echo $i; ?>]" type="text" />
                                                                         
									      </td>
									      <td valign="top" height="100%" >
                                                                         
                                                                                 <select name="row_to_match[<?php echo $i; ?>]" id="row_to_match[<?php echo $i; ?>]" class="row_to_match_<?php echo $i; ?>">
										      <?php
										      foreach($rank_names as $key => $value){
										      ?>
										      <option value="<?php echo $key; ?>"><?php echo $value;?></option>
										      <?php
										      }
										      ?>
                                                                                 </select>
                                                                                 
                                                                              
                                                                                </td>
                                                                                <td valign="top" height="100%" style="text-align:left;">
                                                                                           
                                                                                            <input type="text" value="" name="min_amount[<?php echo $i;?>]" id="min_amount[<?php echo $i;?>]" size="5" />
                                                                                            <span id="memo_specail"></span>
                                                                                </td>
                                                                                
                                                                                <td valign="top" height="100%" style="text-align:center;vertical-align:middle;width:200px!important;">
                                                                                        <?php if($picture!=''){ ?>
                                                                                        <img src="<?php echo $UploadImagePath . "user_ranks/" . $picture; ?>" style="vertical-align:middle;margin-right:10px;float:left;display:inline;height:auto;width:100px;"/>
                                                                                        <?php } ?>
                                                                                        <input type="file" name="new_image" size="4"  style="float:right;display:inline;" id="new_image" />
                                                           
                                                                                </td>

                                                                                <td valign="top" height="100%" style="text-align:left;">
										      <input type="text" name="bids_awarded[<?php echo $i; ?>]" id="bids_awarded[<?php echo $i; ?>]" value=""  size="4" />
                                                                                </td>
                                                                                <td valign="top" height="100%" style="text-align:left;">
										      <input type="text" name="free_bids_awarded[<?php echo $i; ?>]" id="free_bids_awarded[<?php echo $i; ?>]" value="" size="4" />
                                                                                </td>

                                                                            </tr>
                                                                            <tr>
									    <td colspan="7"  style="border-bottom:1px dashed blue;height:20px;">
									    </td>
                                                                        </tr>
                                                                            <tr>
										<td valign="top" height="100%" colspan="7" style="display:none;">
										<h4>
										Allow Users to Hold Multiple User Levels (if chosen then user will have multiple badges next to their avatar or username, if not then each subsequent level overrides the next, useful when using multiple options)
										</h4>
										<input name="allow_multiple" id="allow_multiple" value="1" />
										
										</td>
										
									      </tr>
                                                                            <tr>
									    <td colspan="7"  style="border-bottom:1px dashed blue;height:20px;">
									    </td>
									    </tr>
									    <tr>
										  <td valign="top" height="100%" width="100%" colspan="7" valign="bottom" align="right" style="text-align:right;width:100%;">
										  <span class="button send_form_btn"><span><span>Submit Changes</span></span><input name="submit" type="submit" /></span>
                                                                               
										  </td>
									    </tr>
									    <td valign="top" height="100%" style="text-align:left;">
										    
                                                                                
                                                                                </td>
                                                                    </tbody>
                                                                </table>
                                                                    
                                                  
								</form>
								
								</div>
								</div>
								  <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                                            </div>
                                                        </div>
                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                    </div>
                                                      
                                                         
       						</div>
                                            </div>
                                        </div>

                                <!--[if !IE]>end section content bottom<![endif]-->
  
                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
                        <!--[if !IE]>end section<![endif]-->
                    
               
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
									  <script>
                                                                            $('a[title]').qtip();
                                                                               </script>
    </body>
</html> 
