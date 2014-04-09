<div class="logo-box">
    <h1 class="logo"><a href="<?php echo $SITE_URL;?>index.php">&nbsp;</a></h1>

</div>
    <div class="navbar">
        <ul id="navigation">


<?php

include_once 'data/auction.php';
$adb=new Auction(null);

if(in_array('topmenu', $addons)){
?>

    
   <?php 
	  echo get_menu('top_menu'); 
    ?>

<?php
}
?>
 <li class="last">
<?php require($BASE_DIR . '/include/addons/category_menu/' . $template . '/index.php');
?>
            </li>
</ul>
<?php include_once('include/addons/right_social/wavee/index.php'); ?>
	<script type="text/javascript">
            function CheckSearch()
            {
                if(document.searchform.searchtext.value=="")
                    return false;
                else
                    return true;
            }
        </script>
        
        <form id="searchForm" name="searchform" action="allauctions.php" onsubmit="return CheckSearch();" method="post">
            <fieldset>
                <div class="text">
                    <input name="searchtext" id="keywords" class="input-hint" value="<?= htmlspecialchars(stripcslashes($searchdata), ENT_QUOTES); ?>" />
                </div>
                <input type="submit" class="btn-search" value="<?php echo SEARCH; ?>" alt="" />
            </fieldset>
        </form>
</div>
