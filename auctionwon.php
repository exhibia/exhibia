<?php
ini_set('display_errors' , 1);
include("config/connect.php");
//find latest winner




//end latest winner
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

<?php include('page_headers.php'); ?>
       <style>
       body { 
    margin: 6px 0 0 0; padding: 0;
    background-image: url("css/bidcacti-classic/backgrounds/sunburst.jpg");
}
</style>
        
    </head>
    <body>
        <div id='myData'>
            <table class = "AuctionsWonTable">
                <?php
                $qr = "select a.fixedpriceauction, a.auc_fixed_price, a.offauction, a.auc_final_price, p.price, a.auctionID, p.picture1, r.username, p.name, a.use_free, a.buy_user from auction a left join products p on a.productID=p.productID left join registration r on a.buy_user=r.id where a.auc_status=3 and auc_final_price not like '0.00' and buy_user!='0' order by a.auc_final_end_date desc limit 0, 10";

		$rs = db_query($qr);
                while ($ob =  db_fetch_object($rs)) {
                    if ($ob->fixedpriceauction == 1) {
                        $fprice1 = $ob->auc_fixed_price;
                    } elseif ($ob->offauction == 1) {
                        $fprice1 = "0.00";
                    } else {
                        $fprice1 = $ob->auc_final_price;
                    }
                    $saving_percent1 = ($ob->price - ($objtotalbids->totalwinnerbid * 0.5) - $fprice1) * 100 / $ob->price;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars(stripcslashes($ob->name), ENT_QUOTES);?><br/><?php echo date("m/d/Y g:i a",  strtotime($ob->auc_final_end_date)); ?>&nbsp&nbsp<b><?=$Currency;?><?=number_format($fprice1, 2);?></b><br/>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $ob->username != "" ? $ob->username."!" : "---";?></td>
                    </tr>
                    <tr>
                        <td><hr/>
                        </td>
                    </tr>
                <?php }  ?>
            </table>
        </div>
    </body>
</html>

<?php ?>