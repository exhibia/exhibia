<?php include('include/dialog.php'); ?>
<script type="text/javascript" src="<?php echo $SITE_URL ; ?>js/auctions_new.js"></script>
<!--<script type="text/javascript" src="<?php echo $SITE_URL ; ?>js/orbit.js"></script>-->

<!--<link rel="stylesheet" type="text/css" media="all" href="<?php echo $SITE_URL . $livesupportpath; ?>css/client.css" />-->
<script type="text/javascript" src="<?php echo $SITE_URL . $livesupportpath; ?>js/support.js"></script>
<script type="text/javascript" src="<?php echo $SITE_URL . $livesupportpath; ?>js/cufon-yui.js"></script>
<!--<script type="text/javascript" src="<?php echo $SITE_URL . $livesupportpath; ?>js/font_400.font.js"></script>-->



   

 <div id="support_container">
<?php if(in_array('livesupport', $addons)){ online1(); } ?>
</div>

<div id="header">
 <a name="top"></a><h1><a href="index.php"></a></h1>
 


<div id="header">
 
      
      
 <?php include("include/addons/right_social/$template/index.php"); ?>
  <?php 
  foreach($addons as $key => $value){

  if(file_exists("include/addons/$value/$template/header.php")){
    ?><?php
      include_once("include/addons/$value/$template/header.php");

  }


  }
  ?>
  
  
 <?php 
  foreach($addons as $key => $value){

  if(file_exists("include/addons/$value/$template/login_area.php")){
    ?><?php
      include_once("include/addons/$value/$template/login_area.php");

  }


  }
  ?>
  
</div>
<?php include("$BASE_DIR/include/$template/searchbox.php"); ?>
<script language='javascript'>UpdateLoginLogout();</script>