<?php
if(empty($last_winner_script)){
$last_winner_script = 'true';
$qr = "select a.auctionID,username,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,bidpack,a.tax1,a.tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc " .
        "from auction a left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join registration r on a.buy_user=r.id " .
        "where a.auc_status=3 and auc_final_price not like '0.00' and buy_user!='0' order by a.auc_final_end_date desc limit 0, 1";

$rs = db_query($qr);

$tot = db_num_rows($rs);
echo db_error();
$ob = db_fetch_object($rs);

db_free_result($rs);



if ($tot > 0) {

    $qrytotalbids = "select sum(bid_count) as totalwinnerbid from " . ($ob->use_free == 1 ? "free_account" : "bid_account") .
            " where auction_id=" . $ob->auctionID . " and bid_flag='d' and user_id=" . $ob->buy_user . " group by auction_id";

    $restotalbids = db_query($qrytotalbids);

    $objtotalbids = db_fetch_object($restotalbids);

    db_free_result($restotalbids);
}

	//end latest winner
?>

<div id="winnerBox" class="box">

    <h3><?php echo LATEST_WINNERS; ?><img src="img/winner.png" style="float:right; position:absolute;top:-40px;right:-5px;display:inline;padding:0px;margin:0px;"/></h3>


<?
    if ($tot > 0) {
        if ($ob->fixedpriceauction == 1) {
            $fprice1 = $ob->auc_fixed_price;
        } elseif ($ob->offauction == 1) {
            $fprice1 = "0.00";
        } else {
            $fprice1 = $ob->auc_final_price;
        }
        $pname = $ob->bidpack ? $ob->bidpack_name : $ob->name;
        $picture = $ob->bidpack ? $ob->bidpack_banner : $ob->picture1;
        $price = $ob->bidpack ? $ob->bidpack_price : $ob->price;
        if ($price == 0) {
            $saving_percent1 = 100;
        } else {
            $saving_percent1 = ($price - $fprice1) * 100 / $price;
        }

	//////////////////////////////////////////////////////////////////////////////////
	/// Begin Bugfix
	/// Clear Idea Technology
   /// Trent Raber
   /// 2012-05-02
	/// Fix to display the correct info if a bidpack is the auction that was just won
	//////////////////////////////////////////////////////////////////////////////////
	if( $ob->bidpack <= 0 )
	{
		$fAmount = $Currency;
		$fAmount .= number_format($fprice1, 2);

		$sProdLink = "<a class='winnertitle' ";
		$sProdLink .= "href='".SEOSupport::getProductUrl($ob->name, $ob->auctionID, 'n')."'>";
		$sProdLink .= "A ".htmlspecialchars(stripcslashes($ob->name), ENT_QUOTES)."</a> ";
		$sProdLink .= "for $fAmount";
	}
	else
	{
		$fAmount = $Currency;
		$fAmount .= number_format($fprice1, 2);

		$sProdLink = "<a class='winnertitle' ";
		$sProdLink .= "href='".SEOSupport::getProductUrl($pname, $ob->auctionID, 'n')."'>";
		$sProdLink .= "A ".htmlspecialchars(stripcslashes($ob->bidpack_name), ENT_QUOTES)."</a> ";
		$sProdLink .= "for $fAmount";
	}

	//////////////////////////////////////////////////////////////////////////////////
	/// End Bugfix
	//////////////////////////////////////////////////////////////////////////////////

?>

        <div class="box-content">
            <a href="<?php echo SEOSupport::getProductUrl($pname, $ob->auctionID, 'n'); ?>"><img src="<?= $UploadImagePath; ?>products/thumbs/thumb_<?= $picture; ?>" border="0" style="border: 1px solid #E39F13;" /></a>
            <p><strong><?php echo CONGRATULATIONS; ?>, <?= $ob->username != "" ? $ob->username . "!" : "---"; ?></strong></p>
            <p>
					<?php
					//////////////////////////////////////////////////////////////////////////////////
					/// Begin Bugfix
					/// Clear Idea Technology
					/// Trent Raber
					/// 2012-05-02
					/// Fix to display the correct info if a bidpack is the auction that was just won
					//////////////////////////////////////////////////////////////////////////////////
					echo WHO_JUST_WON." ";
					echo $sProdLink;
					//////////////////////////////////////////////////////////////////////////////////
					/// End Bugfix
					//////////////////////////////////////////////////////////////////////////////////
					?>
				</p>
        </div><!-- /box-content -->
        <p class="box-bottom"><?php echo THAT_S; ?> <strong><?= number_format($saving_percent1, 2); ?>%</strong> <?php echo OFF_THE_RETAIL_PRICE; ?></p>
    <?php } ?>
</div><!-- /winnerBox --> 
<?php } ?>