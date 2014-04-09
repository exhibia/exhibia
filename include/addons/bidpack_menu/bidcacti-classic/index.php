<div class="sidebarWidget">
    <div id="auctionswonwidget" class="widgetBlue">
        <div class="widgetHeader">
            <div class="widgetHeaderLeft"></div>
            <div class="widgetHeaderRight"></div>
           <h3><?php echo BID_PACKAGE;?></h3>
        </div>
        
           
<?php
$qrysel = "select *,".$lng_prefix."bidpack_banner as bidpack_banner,".$lng_prefix."bidpack_name as bidpack_name from bidpack order by id";
$rssel = db_query($qrysel);
$totalbpack = db_num_rows($rssel);
?>
<div class="widgetContent">
    
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
    </div>
</div>  
