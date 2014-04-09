<?php if (!empty($_SESSION["userid"]) & empty($top_bar)) {
$top_bar = 'yes';
$query = "select * from registration left join avatar a on a.id=registration.avatarid where registration.id = $_SESSION[userid]";

$row = db_fetch_object(db_query("$query"));
if(file_exists($BASE_DIR . "/include/addons/user_levels/login.php")){
include("include/addons/user_levels/login.php");
$levels = $level_str;
}
?>
<style>


#toolbar {
   background: #315E7C;
position: fixed;
bottom: 0px;
z-index: 500;
width: 1005px;
height: 40px;
left: 50%;
margin-left: -500px;
border-top: 1px solid black;
border-left: 1px solid black;
border-right: 1px solid black;
border-radius: 6px 6px 0px 0px;
}
#connection-strength-bg {
    background: url("css/wavee/connection-bg.png") no-repeat scroll 0 0 transparent;
    width: 24px;
    height: 15px;
    margin-top: 5px;
}
#connection-strength {
    height: 15px;
    width: 24px;
    z-index: 1001;
    background: url('css/wavee/connection-strength.png') no-repeat;
}
.h-main .links li.connection {
    padding: 0 0 0 9px;
}
.h-main .links li.notifications-link {
    padding: 0 0 0 5px;
}
.h-main .links img {
    display: block;
}
.h-main .watch {
    font-size: 12px;
    margin: 14px 0 0 3px;
    float: left;
    padding: 0 24px 0 0;
    background: url(css/wavee/ico-watch-expand.gif) no-repeat 100% 0;
    text-decoration: none;
}
.h-main .watch strong {
    color: #fbb415;
    padding: 0 0 0 18px;
    background: url(css/wavee/ico-watch.gif) no-repeat 0 1px;
}


.h-main .links li.connection {
    padding: 0 0 0 9px;
}
.h-main .links li.notifications-link {
    padding: 0 0 0 5px;
}
.h-main .links img {
    display: block;
}
.h-main .watch {
    font-size: 12px;
    margin: 14px 0 0 3px;
    float: left;
    padding: 0 24px 0 0;
    background: url(css/wavee/ico-watch-expand.gif) no-repeat 100% 0;
    text-decoration: none;
}
.h-main .watch strong {
    color: #fbb415;
    padding: 0 0 0 18px;
    background: url(css/wavee/ico-watch.gif) no-repeat 0 1px;
}
.h-main .btn-notifications {
background: url("css/wavee/btn-notifications.gif") no-repeat scroll 0 0 transparent;
font-size: 12px;
font-weight: bold;
height: 27px;
margin: 0 50px 0 10px;
padding: 13px 0 0 11px;
text-decoration: none;
width: 120px;
float: right;
}
.h-main .btn-notifications .light {
    width: 25px;
    height: 25px;
    background: url(css/wavee/notification-light.gif) no-repeat;
    position: relative;
    bottom: 6px;
    float: left;
    color: #ccc;
}
.h-main .btn-notifications .light div {
    margin: 4px 0 0 35px;
}
.h-main .btn-notifications .light-on {
    background-position: 0 -25px;
}
.h-main .btn-notifications .light-on div {
    color: #fff;
}
.h-main .user {
    float: left;
    line-height: 28px;
    min-width:450px;
   
}
.h-main .user img {

margin-left: 10px;
padding-top: 10px;
float:left;
}
.h-main .user .name {
    float: left;
    font-size: 12px;
    color: #fff;
    margin: 5px 0 0 9px;
}
.h-main .user .name a {
    color: #fff;
}
.h-main .user .name a:hover {
    color: #fba31b;
}

.h-main .user ul {
float: left;
overflow: hidden;
position: relative;
left: 180px;
}

.h-main .user ul li {
background: none repeat scroll 0 0 #FFFFFF;
border-radius: 6px 6px 6px 6px;
display: inline;
float: left;
margin: 5px 1px 0 0;
padding: 1px 6px;
    
}
.h-main .user ul li:hover {
    background: #484848;
}
.h-main .user ul li.highlight {
    background: #636363;
}
.h-main .credits {
    display: inline;

    min-height: 31px;
    position:absolute;
  left:900px;
}
.megawin-box {
    width: 221px;
    margin: 0 auto;
}
.megawin-box:after {
    content: "";
    display: block;
    clear: both;
}
.megawin {
    width: 221px;
    height: 38px;
    margin: 0 0 -38px;
    float: left;
    position: relative;
}
#megawin-empty {
    display: block;
    width: 171px;
    height: 19px;
    background: url('css/wavee/sp-mega-win.png') no-repeat;
    background-position: 0 0;
    cursor: pointer;
}
#megawin-fill {
    display: block;
    height: 19px;
    background: url('css/wavee/sp-mega-win.png') no-repeat;
    background-position: 0 -19px;
}
.megawin .holder {
    height: 32px;
    text-align:center;
    padding: 6px 15px 0 15px;
    background: url(css/wavee/bg-megawin.png) no-repeat;
}
.question-help {
    position: relative;
    left: 96px;
    top: 6px;
}
.megawin .holder:after {
    content: "";
    display: block;
    clear: both;
}
.megawin .frame {
    height: 1%;
    position: relative;
}
.megawin .meter {
    float: left;
}
.megawin .help {
    float: right;
    width: 14px;
    height: 14px;
    text-indent: -9999px;
    overflow: hidden;
   
}
.bonus-credits {
    width: 500px;
    margin: 0 auto;
    display: none;
}
.bonus-credits img {
    height: 90px;
    width: 90px;
    vertical-align: top;
    position: absolute;
    z-index: 9999;
}
.bonus-credits div {
    height: 38px;
    line-height: 34px;
    width: 190px;
    background: #555;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    margin: 30px auto 0;
    text-align: center;
}
.bonus-credits div span {
    font-size: 20px;
    color: #f8981f;
}
.w-main {
    width: 962px;
    margin: 0 auto;
    position: relative;
    padding: 204px 0 0;
    z-index: 2;
}




.credits-counter {
left: -820px;
margin: 2px 0 0 28px;
min-width: 350px;
padding: 3px 6px 6px;
position: relative;
vertical-align: middle;
float: left;
color: white;
}







.invite ul {

position: absolute;

left:700px;
top:10px;


}

.invite ul li {
background: #E46706;
border-radius: 6px;
display: inline;
height: 31px;
margin: 2px;
min-width: 90px;
padding: 3px 8px;
text-align: center;
    
}
.invite ul li:hover {
    background: #484848;
}
.invite ul li.highlight {
    background: #636363;
}
.qtip .next_row_to_match {
color:red;
}
.invite ul li a{
color: black !important;
}
</style>

		
        <div class="h-row" id="small_div">

            <div id="toolbar" class="h-main">
                <div class="user">

  <img class="avatar" src="uploads/avatars/<?php echo $row->avatar; ?>" width="20" height="20" alt="image description" />
		    <strong class="name"><?php echo WELCOME ?>:&nbsp;<a href="mydetails.php"><?php echo getUserName($_SESSION["userid"]); ?></a></strong>
       
                   <ol style="display:inline;">
				<li class="credits user">
			                <strong class="credits-counter">
			                
					<?php
					
						      
					    $resbal = db_query("select final_bids, free_bids from registration where id=" . $_SESSION["userid"]);
					    $objbal = db_fetch_object($resbal);
					?>
					
					                    <?php echo AVAILABLE_BIDS; ?>:<span id="bids_count_tb"><?= $objbal->final_bids; ?></span>&nbsp;&nbsp;&nbsp;
					                    <?php echo FREE_BIDS; ?>:<span id="free_bids_count_tb"><?= $objbal->free_bids != "" ? $objbal->free_bids : "0"; ?></span>
					                </strong>
               
                                 </li>
				<li style="margin-left:265px;color:#fff;font-weight:bold;display:inline;margin-right:10px;float:left;margin-top:3px;font-size:15px;">Badges:</li> 
			    <?php
			    foreach($levels as $key => $value){
			    
			    if(!empty($levels[$key]['rank_name']) & !is_numeric($levels[$key]['rank_name'])){
			    if($value != 'time_as_bidder'){
			    ?>
				<li id="badge_<?php echo $levels[$key]['row_to_match'];?>" style="display:inline;float:left;" title="<?php echo $levels[$key]['row_to_match'];?>" class="user_badges_bar">
				
				<img src="uploads/rank_image/<?php echo $levels[$key]['rank_image']; ?>" style="height: 30px;margin: -6px 2px 0;width: 30px;" />
				<span style="display:none;" id="title_<?php echo $levels[$key]['row_to_match'];?>" class="title_<?php echo $levels[$key]['row_to_match'];?>">Current Level: 
				
				      <?php if(empty($levels[$key]['maxed_out'])){ echo $levels[$key]['rank_name']; }else{ 
				      
				      $max = db_fetch_object(db_query("select min_amount, rank_name from user_ranking_rules where row_to_match = '" . $levels[$key]['row_to_match'] . "' order by id desc limit 1"));
					echo $max->rank_name;
				      
				      }
				      ?>
				      
				</span>
				<span style="display:none;" id="badge_tooltip_<?php echo $levels[$key]['row_to_match'];?>">
				<span style="display:none;"><!-- change display:none to display:block to show current points awarded -->
				points awarded 
				
				    <a>bids:<a id="bids_awarded_<?php echo $levels[$key]['row_to_match'];?>" class="bids_awarded"><?php echo $levels[$key]['bids_awarded']; ?></a></a> 
				    <a>free bids: <a id="free_bids_awarded_<?php echo $levels[$key]['row_to_match'];?>" class="free_bids_awarded"><?php echo $levels[$key]['free_bids_awarded']; ?></a></a>
				<br />acheived for <a id="min_amount_<?php echo $levels[$key]['row_to_match'];?>" class="min_amount">
				<?php if($levels[$key]['row_to_match'] != 'time_as_high_bidder'){ 
				
				
				echo number_format($levels[$key]['min_amount'],0);
				
				}else{ 
				?>
				<script>
				    $('#min_amount_<?php echo $levels[$key]['row_to_match'];?>').html(calc_counter_from_time('<?php echo number_format($levels[$key]['time_as_high_bidder'], 0, '', ''); ?>'));
				</script>
				<?php
				
				} ?></a> 
				<a id="row_to_match_<?php echo $levels[$key]['row_to_match'];?>"><?php echo str_replace("time", "", str_replace("_", " ", $levels[$key]['row_to_match'])); ?></a>
				<br /><br />
				</span>
				<?php
				if(is_array($levels[$key]['next']) & $levels[$key]['row_to_match'] != 'time_as_high_bidder' & empty($levels[$key]['maxed_out'])){ ?>
				    <a> Next level:</a>
				    <a id="next_rank_name_<?php echo $levels[$key]['row_to_match'];?>" class="next_rank_name"><?php echo $levels[$key]['next']['rank_name'];?></a>
				    
				    <br />
				    <a>Needed:<a>&nbsp;
				    <a id="next_min_amount_<?php echo $levels[$key]['row_to_match'];?>" class="next_min_amount"><?php echo $levels[$key]['next']['min_amount'];?></a>
				    
				    <a id="next_row_to_match" class="next_row_to_match"><?php echo str_replace("_", " ", $levels[$key]['next']['row_to_match']);?></a>
				    &nbsp; More To Go
				<?php }else
				
				if($levels[$key]['row_to_match'] == 'time_as_high_bidder' & empty($levels[$key]['maxed_out'])){ 
				
				?>
				    <a> Next level:</a>
				    <a id="next_rank_name_<?php echo $levels[$key]['row_to_match'];?>" class="next_rank_name"><?php echo $levels[$key]['next']['rank_name'];?></a>
				     <br />
				    <a> Needed:</a>&nbsp;
				    <a id="next_min_amount_<?php echo $levels[$key]['row_to_match'];?>" class="next_min_amount">
				    <?php echo $levels[$key]['next']['needed'];?>
				    </a>
				   
				    <a id="next_min_amount_<?php echo $levels[$key]['row_to_match'];?>" class="next_row_to_match">
				     <?php echo str_replace('time', '', str_replace("_", " ", $levels[$key]['next']['row_to_match']));?></a>
				     &nbsp; More To Go
				<?php
				
				}else {
				echo "Congratulations! You have reached the top level!";
				
				}
				
				if(!empty($levels[$key]['next']['rank_name'])){
				if( !empty($levels[$key]['next']['free_bids_awarded']) & !empty($levels[$key]['next']['bids_awarded'])){
				?>
				<br />
				<span style="font-size:9px">Recieve:&nbsp;
				<?php
				if(!empty($levels[$key]['next']['bids_awarded'])){
				?>
				<a id="next_bids_awarded_<?php echo $levels[$key]['row_to_match'];?>" class="next_bids_awarded">
				     <?php echo str_replace('time', '', str_replace("_", " ", $levels[$key]['next']['bids_awarded']));?></a> Bids&nbsp;&nbsp;&nbsp;&nbsp;
				<?php
				}
				if(!empty($levels[$key]['next']['free_bids_awarded'])){
				?>
				<a id="next_free_bids_awarded_<?php echo $levels[$key]['row_to_match'];?>" class="next_free_bids_awarded">
				     <?php echo str_replace('time', '', str_replace("_", " ", $levels[$key]['next']['free_bids_awarded']));?></a>
				Free Bids
				
				<?php } ?>
				</span>
				
				<?php 
				}
				
				}else{ ?>
				<br />
				    You have maxed out for this badge
				    <?php } ?>
				</li>
			    <?php } 
			    }
			  }
			    ?>
			</ol>
		</div>
		<div id="connection_speed">
		    Connection Speed:<span id="connection_quality"></span>
		</div>
		<script>
		$('.user_badges_bar').each( function(){
		    var id = $(this).attr('title');
		   
		    $('#badge_' + id).qtip({
		    id: 'qtip_' + 'badge_' + id,
			    content: { text: $('#badge_tooltip_' + id).html(), title: '<a class="badge_title">' + $('#title_' + id).html() + '</a>' },
			   
			     
			    style: {
			    show: { ready: true, solo:true},
			    classes: 'qtip-<?php echo str_replace(".", "", $template);?> qtip-shadow',
			    
			    
			    },
			 
			    events: {
			   
					show: function(event, api){
					
					
						
						
						
						
				}
			},
			    position: { my: 'bottom center', at:'top center' }
		     });
		     
		});
		</script>
           
            <div class="invite">
                <!--<a href="#">Invite a Friend</a>-->
                 <ul>
		     <li id="inviter_link"><a href="affiliate.php">Invite a Friend</a></li>
		     <?php
		     if(file_exists($BASE_DIR . "/include/addons/user_levels/inviter_link.php")){
			include($BASE_DIR . "/include/addons/user_levels/inviter_link.php");
		     }
		     ?>
		     <li><a href="myaccount.php">My Account</a></li>
                    <li id="toolbar-buy-more" style="cursor:pointer;"><a href="buybids.php">Buy Bids</a></li>
                </ul> 
            </div>

        </div>
    </div>
  <?php } ?>