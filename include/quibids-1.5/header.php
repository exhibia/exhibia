<style>
.corner_imagev1 {
display:none;
margin : 0 0 10px 0;

}

.endinng-auction .corner_imagev {
display:none;
margin : 0 0 10px 0;
}
.auction-item img {
padding-top:15px;
width:120px;
height:auto;
max-height:100px;

}
#ending-auct .auction-item .endingtimer {
margin-bottom:-15px;


}

.endinng-auction {
    width: 174px;
    height: 320px;
    
    }
    
    .image-placeholder {
    
   background-size:250px auto;
    
    
    }
    .auction_type_picture img {
    width:45px;
    height:auto;
    float:left;
    position:relative;top:-30px;
    margin-bottom:-30px;
    
    }
    
    .biddingArea img.avatar {
    position:relative;
    top:-15px;
    width:100px;
    height:auto;
    max-height:100px;
    margin-bottom:-20px;
    
    }
#wrapper{
padding-bottom:10px;
border-bottom:1px solid #919191;
border-radius: 0 0 10px 10px;
}
#nav {
background-color:transparent;
border-radius:20px 38px 0 0;
}
</style>

<style>
#support_container {
max-width:200px;
}
</style>
<script type="text/javascript" src="<?php echo $SITE_URL ; ?>js/orbit.js"></script>

<!--<link rel="stylesheet" type="text/css" media="all" href="<?php echo $SITE_URL . $livesupportpath; ?>css/client.css" />-->
<script type="text/javascript" src="<?php echo $SITE_URL . $livesupportpath; ?>js/support.js"></script>
<script type="text/javascript" src="<?php echo $SITE_URL . $livesupportpath; ?>js/cufon-yui.js"></script>
<!--<script type="text/javascript" src="<?php echo $SITE_URL . $livesupportpath; ?>js/font_400.font.js"></script>-->


   
 <?php 
 include('include/dialog.php');
 
 
 
  foreach($addons as $key => $value){

  if(file_exists("include/addons/$value/header.php")){
    ?><?php
//include_once("include/addons/$value/header.php");

  }


  }
  ?>

  <div id="support_container">
<?php online1(); ?>
</div>
<div id="header">
    <a name="top"></a><h1><a href="index.php"></a></h1>
  
<?php if (!isset($_SESSION["userid"])) {
?>
    <div id="login">
                
        <ul id="list-languages">
            <?php
            $langsel="select language,flag from language where enable=1";
            $langres=  db_query($langsel);
            
            if(db_num_rows($langres) > 1){
            while($langitem=  db_fetch_array($langres)){
            ?>
            <li><a href="<?php echo $SITE_URL;?>language.php?lang=<?php echo $langitem['language']; ?>&url=<?php echo $_SERVER['PHP_SELF']; ?>"><img src="include/addons/icons/quibids-1.5/<?php echo $langitem['flag']; ?>" alt="" /></a></li>
            <?php }
            }
            
            ?>
        </ul>
        <form method="post" action="password.php">
            <span>
                <input name="username" value="username" onfocus="_delete_login_fields(this, 'username', this.value);" id="username" class="gray"/>
            </span>
            <span>
                <input type="password" name="password" onfocus="_delete_login_fields(this, 'password', this.value);" value="password" id="password" class="gray"/>
            </span>
            <button type="submit" id="login-btn"><?php echo LOGIN; ?></button>
        </form>
        <div id="login-links">
<?php echo FORGOT_PASSOWRD; ?> <a href="forgotpassword.php"><?php echo CLICK_HERE; ?></a>
            <?php echo NOT_A_MEMBER; ?><a href="registration.php"><?php echo SIGN_UP_NOW; ?></a>
        </div>
    </div>

<?php
        } else {
            $resbal = db_query("select final_bids, free_bids from registration where id=" . $_SESSION["userid"]);
            $objbal = db_fetch_object($resbal);
?>

            <div id="loged">
                        
        <ul id="list-languages" style="padding-left:25px;">
            <?php
            $langsel="select language,flag from language where enable=1";
            $langres=  db_query($langsel);
            if(db_num_rows($langres) > 1){
            while($langitem=  db_fetch_array($langres)){
            ?>
            <li><a href="<?php echo $SITE_URL;?>language.php?lang=<?php echo $langitem['language']; ?>&url=<?php echo $_SERVER['PHP_SELF']; ?>"><img src="include/addons/icons/quibids-1.5/<?php echo $langitem['flag']; ?>" alt="" /></a></li>
            <?php }
            
            
            }
            ?>
        </ul>
                <span id="bids">
                    <label id='bids_count'><?php echo $objbal->final_bids; ?></label> <?php echo AVAILABLE_BIDS; ?>
                    <label id='free_bids_count'><?php if(!empty($objbal->free_bids)){ echo $objbal->free_bids; }else{ echo "0"; } ?></label> <?php echo FREE_BIDS; ?>
                </span>
                <div style="min-height:15px;"></div>
                <strong id="user" style="padding-left:25px;"><?php echo getUserName($_SESSION["userid"]); ?></strong>
                <a href="logout.php"><?php echo LOGOUT; ?></a>
                <br />
            </div>
<?php
            db_free_result($resbal);
        }
?>
 <?php 
  foreach($addons as $key => $value){

  if(file_exists("include/addons/$value/login_area.php")){
    ?><?php
    
    //include_once("include/addons/$value/login_area.php");

  }


  }
  ?>
        <div class="clear"></div>
        <ul id="nav">
            <li id="all-cats">
                <select id="auc_cat">
                    <option value="allauctions.php?aid=2"><?php echo ALL_CATEGORIES; ?></option>
                    <option value="allauctions.php?aid=2"><?php echo ALL_LIVE_AUCTIONS; ?> (<?php echo checkaucstatus(2); ?>)</option>
<?php
        $resc = db_query("select categoryID as cid, name, (select count(*) from auction where categoryID=cid and auc_status='2') as cnt from categories where status=1");
        while (( $cat = db_fetch_array($resc))) {
?>
                <option value="allauctions.php?id=<?php echo $cat["cid"]; ?>"><?=htmlspecialchars(stripcslashes($cat["name"]), ENT_QUOTES); ?> (<?php echo $cat["cnt"]; ?>)</option>
<?php
            }
            db_free_result($resc);
?>
                <option value="allauctions.php?aid=1"><?php echo FUTURE_AUCTIONS; ?> (<?php echo checkaucstatus(1); ?>)</option>
                <option value="allauctions.php?aid=3"><?php echo ENDED_AUCTIONS; ?> (<?php echo checkaucstatus(3); ?>)</option>
            </select>
        </li>
        <li class="menuitem"><a href="index.php" class="<?php echo $currentPage == 'index.php' ? 'active' : ''; ?>"><span><?php echo HOME ?></span></a></li>
        <li class="menuitem"><a href="myaccount.php" class="<?php echo $currentPage == 'myaccount.php' ? 'active' : ''; ?>"><span><?php echo MY_BIDS; ?></span></a></li>
<?php if (!isset($_SESSION["userid"])) { ?>
            <li class="menuitem"><a href="registration.php" class="<?php echo $currentPage == 'registration.php' ? 'active' : ''; ?>"><span><?php echo REGISTER; ?></span></a></li>
<?php } else { ?>
                    <li class="menuitem"><a href="buybids.php" class="<?php echo $currentPage == 'buybids.php' ? 'active' : ''; ?>"><span><?php echo BUY_BID; ?></span></a></li>
<?php } ?>
<?php if(db_num_rows(db_query("select * from sitesetting where name = 'forum' and value = '1'")) >= 1){
        ?>
           <li class="menuitem"><a href="forums.php" class="<?php echo $currentPage == 'forums.php' ? 'active' : ''; ?>"><span><?php echo FORUM; ?></span></a></li>    
<?php } ?>


<?php if (isset($_SESSION["userid"])) { ?>

<?php if(db_num_rows(db_query("select * from sitesetting where name = 'redemption' and value = '1'")) >= 1){
        ?>
                <li class="menuitem"><a href="redemption.php" class="<?php echo $currentPage == 'redemption.php' ? 'active' : ''; ?>"><span><?php echo REDEMPTION; ?></span></a></li>
<?php } ?>

<?php if(db_num_rows(db_query("select * from sitesetting where name = 'community' and value = '1'")) >= 1){
        ?>
		<li class="menuitem"><a href="community.php" class="<?php echo $currentPage == 'community.php' ? 'active' : ''; ?>"><span><?php echo COMMUNITY; ?></span></a></li>
<?php } ?>
<?php ?>
<?php }else{ ?>

		<li class="menuitem"><a href="registration.php"><span><?php echo REGISTER_NOW; ?></span></a></li>

<?php } ?>
		<li class="menuitem last"><a href="help.php" class="<?php echo $currentPage == 'help.php' ? 'active' : ''; ?>"><span><?php echo HELP; ?></span></a></li>
    </ul>
</div>

<script language='javascript'>UpdateLoginLogout();</script>