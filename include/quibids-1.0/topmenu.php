<div id="navigation">
    <h1 id="logo"><a href="index.php"><?php echo $SITE_URL; ?></a></h1>
    <ul>
        <li><a href="index.php"><?php echo HOME ?></a></li>
        <li><a href="myaccount.php"><?php echo MY_BIDS; ?></a></li>
        <?php if ( !isset($_REQUEST["userid"]) ) { ?>
        	<li><a href="registration.php"><?php echo REGISTER; ?></a></li>
        <?php }else{ ?>
        	<li><a href="buybids.php"><?php echo 'Buy Bids'; ?></a></li>
        <?php } ?>
        <li><a href="redemption.php"><?php echo REDEMPTION; ?></a></li>
        <li><a href="community.php"><?php echo COMMUNITY; ?></a></li>
        <li><a href="forum/index.php"><?php echo FORUM; ?></a></li>
        <li><a href="help.php"><?php echo HELP; ?></a></li>
    </ul>
</div><!-- /navigation -->
test