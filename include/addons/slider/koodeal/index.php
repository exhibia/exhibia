<?php if (!isset($_SESSION["userid"])) { ?>
    <table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <div class="banner">
                    <img src="images/promo1.png" alt="" border="0" usemap="#Map" />
                </div>
                <div class="shadow"></div>
            </td>
        </tr>
    </table>

<?php } else { ?>

<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td> <div class="banner">
                <table width="930" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="81"><img src="images/img-huge-savings.jpg" width="70" height="69" /></td>
                        <td width="129"><span class="blue-bold">Huge Savings</span><br />
                            Bid to win unbeatable deals. Save up to 90% on popular items. <a href="#"><span class="blue-sm">More</span></a></td>
                        <td width="77" align="center"><img src="images/img-loyalty-bucks.jpg" width="58" height="69" /></td>
                        <td width="131"><span class="blue-bold">Loyalty Bucks</span><br />
                            Earn a $1 dicount credit for every $1 spent on bid tokens.<a href="#"><span class="blue-sm">More</span></a></td>
                        <td width="72" align="center"><img src="images/img-buy-it-now.jpg" width="60" height="69" /></td>
                        <td width="138"><span class="blue-bold">Buy It Now</span><br />
                            Buy It Now for a discount equal to the cost of your used bid tokens. <a href="#"><span class="blue-sm">More</span></a></td>
                        <td width="302" rowspan="2" style="padding-top:16px">
                            <?php include 'dashboard.php'; ?>

                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="shadow"></div></td>
                                </tr>
                            </table>

<?php } ?>