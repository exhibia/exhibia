<?php
if(empty($bidpack_menu)){
$bidpack_menu = 'true';
$qrysel = "select *,".$lng_prefix."bidpack_banner as bidpack_banner,".$lng_prefix."bidpack_name as bidpack_name from bidpack order by id";
$rssel = db_query($qrysel);
$totalbpack = db_num_rows($rssel);
?>
<div id="packagesBox" class="box">
    <h3><?php echo BID_PACKAGE;?></h3>
    <div class="box-content">
        <ul>
		<?
		while($obj = db_fetch_array($rssel))
        {
        	$bname = $obj["bidpack_name"];
		?>
            <li><?=stripslashes($obj["bidpack_name"]);?> <strong><?=$Currency;?><?=$obj["bid_price"];?></strong></li>            
        <?
		}
		?>
		
        </ul>
    </div><!-- /box-content -->
</div><!-- /packagesBox
<img src="include/addons/icons/<?php echo $template;?>/credit-cards.gif" alt="" /> -->
<?php db_free_result($rssel); 
}
