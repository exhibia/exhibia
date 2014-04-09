<?php

include_once 'data/coupon.php';
$coupondb=new Coupon(null);
$rssel=$coupondb->select('', 1, 8, '');
$totalbpack = db_num_rows($rssel);
if($totalbpack > 0 ){
?>
<div id="packagesBox" class="box">
    <h3>New Coupon</h3>
    <div class="box-content">
        <ul>
            <?
            while($obj = db_fetch_object($rssel)) {
                
                ?>
            <li><?=stripslashes($obj->title);?> <strong><?=$obj->discount.'%+';?><?=$obj->freebids.' free bids';?></strong></li>
                <?
            }
            ?>

        </ul>
    </div><!-- /box-content -->
</div><!-- /packagesBox -->
<?php db_free_result($rssel); 

}
