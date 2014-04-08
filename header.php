

<?php
include_once 'include/dialog.php';
?> 
  <script>
	  function add_to_watchlist(uid, aid){
	  
	    $.get('addwatchauction.php?uid=<?php echo $_SESSION['userid'];?>&aid<?php echo $objauc['auctionID']; ?>', function(response){
	      showAlertBox(response);
		  });
	  
	  }
  
  </script>
 

<div id="timeout_dialog" title="<?php echo DIALOG_TIMEOUT_TITLE; ?>" style="display: none;">
    <p>
        <?php printf(DIALOG_TIMEOUT_CONTENT,  Sitesetting::getTimeout()); ?>
    </p>
</div>

<link rel="shortcut icon" type="image/x-icon" href="<?php echo $SITE_URL;?>favicon.ico" />
<!--link rel="icon" href="<?php echo $SITE_URL;?>animated_favicon.gif" type="image/gif" -->
<div style="display: none">

</div>

<?
if (isset($_SESSION['url']) && $_SESSION['url'] != $SITE_URL) {
    session_destroy();
?>
    <script language="javascript">window.location.href="<?php echo $SITE_URL; ?>index.php";</script>
<?
    exit;
}



?>



<div id="support_container">
<?php if(in_array('livesupport', $addons)){ online1(); } ?>
</div>


<div id="header">
<?php
if(empty($languages)){
$languages = 'set';
?>
	<ul id="list-lenguages">
            <?php
            $langsel="select language,flag from language where enable=1";
            $langres=  db_query($langsel);
            while($langitem=  db_fetch_array($langres)){
            ?>
            <li><a href="<?php echo $SITE_URL;?>language.php?lang=<?php echo $langitem['language']; ?>&url=<?php echo $_SERVER['PHP_SELF']; ?>"><img src="<?php echo str_replace("uploads/", "", $UploadImagePath);
?>img/icons/<?php echo $langitem['flag']; ?>" alt="" /></a></li>
            <?php }?>
        </ul><!-- /list-lenguages -->
      <?php } ?>  
        
   	<?php
	      foreach($addons as $key => $value){

		if(file_exists($BASE_DIR . "/include/addons/$value/$template/header.php")){

		      include_once($BASE_DIR . "/include/addons/$value/$template/header.php");

		}else{
		
		     include_once($BASE_DIR . "/include/addons/$value/header.php");
		
		}


	      }
	 
	      foreach($addons as $key => $value){

		if(file_exists($BASE_DIR . "/include/addons/$value/$template/login_area.php")){

		      include_once($BASE_DIR . "/include/addons/$value/$template/login_area.php");

		}else{
		
		     include_once($BASE_DIR . "/include/addons/$value/login_area.php");
		
		}


	      }
	  ?>  
 



    
<?php 

?>

</div><!-- /header -->

<script language='javascript'>UpdateLoginLogout();</script>
