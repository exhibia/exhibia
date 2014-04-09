<?
include("config/connect.php");
include("session.php");
include("functions.php");
include_once 'data/auction.php';
include_once 'data/registration.php';
include_once 'data/paygateway.php';

$uid = $_SESSION["userid"];

if ($_POST["paymentmethod"] != "") {
    $paymentmethod = $_POST["paymentmethod"];
    if ($paymentmethod == "paypal") {
        header("location: buybidspayment.php?bpid=" . $_POST["auctionId"]);
        exit;
    } elseif ($paymentmethod == "creditcard") {
        header("location: checkout.php?bpid=" . $_POST["auctionId"]);
        exit;
    }
}

if ($_GET["auctionId"] == "") {
    header("location:index.php");
    exit;
}
$payGateway = new PayGateway(null);
$paypalInfo = $payGateway->getPaypal();
$paypalProInfo = $payGateway->getPaypalPro();
$authnetInfo = $payGateway->getAuthnet();
$googleCheckoutInfo = $payGateway->getGoogleCheckOut();
$mbinfo = $payGateway->getMoneyBooker();
$payflowLinkInfo = $payGateway->getPayflowLink();
$paymentasiaInfo = $payGateway->getPaymentasia();
$ccavenueInfo = $payGateway->getPaymentCCAvenue();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <link rel="stylesheet" href="css/style.css" media="screen,projection" type="text/css" />
        <link rel="stylesheet" href="css/login.css" media="screen,projection" type="text/css" />
        <link rel="stylesheet" href="css/registration.css" media="screen,projection" type="text/css" />
        <link rel="stylesheet" href="css/store.css" type="text/css"></link>
<?php include("page_headers.php"); ?>

        <script type="text/javascript" src="js/payment.js"></script>
        <script type="text/javascript">
            function setname(name)
            {
                var temp = document.getElementById('bidpackname'+name).value;
                document.getElementById('bidpackname').innerHTML = temp;
            }

            function check()
            {
                if(document.f2.c_name.value=="")
                {
                    alert("<?php echo PLEASE_ENTER_YOUR_CARD_NAME; ?>");
                    document.f2.c_name.focus();
                    return false;
                }

                if (ccCardNumber(document.f2.c_no.value) == false) {
                    alert("<?php echo CREDIT_CARD_NUMBER_INVALID; ?>")
                    document.f2.c_no.focus();
                    return false;
                }

                if (document.f2.c_cvv_no.value.length < 3) {
                    alert("<?php echo YOUR_CREDIT_CARD_CCV_INVALID; ?>");
                    document.f2.c_cvv_no.focus();
                    return false;
                }
            }

            function ccCardNumber(cardNumber) {
                var cardTotal=0;
                var dnum=0;
                var test=0;
                if (cardNumber.length < 13) { return (false); }
                else
                {
                    for ( i = cardNumber.length; i >= 1 ;  i--)	{
                        test=test+1;
                        num = cardNumber.charAt(i-1);
                        if ((test % 2) != 0) cardTotal=cardTotal+parseInt(num)
                        else {
                            dnum=parseInt(num)*2;
                            if (dnum >= 10) cardTotal=cardTotal+1+dnum-10
                            else cardTotal=cardTotal+dnum;
                        }
                    }
                    if ((cardTotal % 10) != 0){ return (false); }else{ return(true); }
                }
            }

            $(document).ready(function(){

                $("#checkoutform").submit(function(){

                    if(ccCardNumber($("#creditCardNumber").val())==false){
                        alert("<?php echo CREDIT_CARD_NUMBER_INVALID; ?>");
                        $("#creditCardNumber").focus();
                        return false;
                    }
                    if($("#cvv2Number").val().length<3){
                        alert("<?php echo YOUR_CREDIT_CARD_CCV_INVALID; ?>");
                        $("#cvv2Number").focus();
                        return false;
                    }
                    return true;
                });
            });



        </script>
    </head>

    <body>
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include 'header.php'; ?>
            <!-- ============= End Header =============  -->

            <div id="wrapper" class="clearfix">
                <div id="maincol">
                    <!-- ============= Registration =============  -->
                    <div id="bidpack-wrap">
                        <div style="float: right; right: 20px; top: 5px; position: relative; font-size: 14px; font-weight: bold;">

                        </div>

                        <h2><?php echo BUY_PRODUCT_NOW; ?></h2>
                        <!-- ============= Ready Start Winning =============  -->

                        <?php
                        $id = $_GET["auctionId"];
                        $aucdb = new Auction(null);

                        $ressel = $aucdb->selectByAuctionId($id);
                        $total = db_num_rows($ressel);


                        if ($total > 0) {
                            $obj = db_fetch_object($ressel);
                            $userdb = new Registration(null);
                            $userquery = $userdb->selectById($uid);
                            $user = db_fetch_object($userquery);

                            if ($obj->allowbuynow == true) {
                                $buynowprice = $aucdb->getBuynowPrice($uid, $id);
                        ?>
                                <div id="bid-pack-wrap">
                                    <h3><?php echo $obj->name; ?></h3>


                                    <div id="bid-packs">

                                        <p>
                                    <?php echo $obj->short_desc; ?>
                                </p>
                                <div style="text-align:center;">
                                    <img src="<?php echo $UploadImagePath; ?>products/<?php echo $obj->picture1; ?>" alt="" width="280" height="250" />
                                </div>

                            </div>
                            <br/>


                            <div id="payment-method" style="text-align:left;">
                                <h3><?php echo PAYMENT_INFORMATION; ?></h3>

                                <table width="430">
                                    <tbody>
                                        <tr>
                                            <td align="left"><strong><?php echo PRODUCT_NAME; ?></strong></td>

                                            <td width="70" align="right"><strong><?php echo BUY_PRICE ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><hr style="color: silver;"/></td>
                                        </tr>
                                        <tr>
                                            <td align="left"><?php echo $obj->name; ?></td>
                                            <td align="right"><?php echo $Currency; ?><span id="info_cost"><?php echo number_format($buynowprice, 2); ?></span></td>
                                        </tr>
                                        <tr>
                                            <td id="coupon_title"></td>
                                            <td id="coupon_bids" align="center"></td>
                                            <td id="coupon_cost" align="right"></td>
                                        </tr>
                                        <tr>
                                            <td><br/></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4" align="right">
                                                <input type="hidden" id="pkg_id" value=""/>
                                                <strong><u><?php echo TOTAL_PACKAGE_COST; ?>:</u> <?php echo $Currency; ?><span><?php echo number_format($buynowprice, 2); ?></span></strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                        <!-- ============= End Ready Start Winning =============  -->

                        <div id="payment-form-wrap">

                            <div id="payment-form-top"></div>
                            <div id="payment-form">


                                <h3><?php echo PAYMENT_METHODS; ?></h3>

                                <div class="paymentmethod_list">

                                    <form name="payment" action="buyproductpayment.php" method="post">
                                        <?php if ($mbinfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input id="mb_method" checked="checked" type="radio" name="paymentmethod" value="moneybooker" onclick="OpenDetails(this.value)" />
                                                <label for="mb_method"><img style="vertical-align:middle" src="img/moneybooker.jpg"/></label>
                                            </p>
                                        <?php } ?>

                                        <?php if ($paypalInfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input id="paypal_method" checked="checked" type="radio" name="paymentmethod" value="paypal" onclick="OpenDetails(this.value)" />
                                                <label for="paypal_method"><img style="vertical-align:middle" src="img/paylogo_ppl.gif" /></label>
                                            </p>
                                        <?php } ?>

                                        <?php if ($paypalProInfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input type="radio" id="credit_method" name="paymentmethod" value="creditcard" onclick="OpenDetails(this.value)" />
                                                <label for="credit_method"><img style="vertical-align:middle" src="img/credit.png" /></label>
                                            </p>
                                        <?php } ?>

                                        <?php if ($authnetInfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input type="radio" id="auth_method" name="paymentmethod" value="authorize" onclick="OpenDetails(this.value)" />
                                                <label for="auth_method"><img style="vertical-align:middle" src="img/authorize_logo.gif" /></label>
                                            </p>
                                        <?php } ?>
                                        <?php if ($googleCheckoutInfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input type="radio" id="google_method" name="paymentmethod" value="google" onclick="OpenDetails(this.value)" />
                                                <label for="google_method"><img style="vertical-align:middle" src="img/google_checkout_logo.gif" /></label>
                                            </p>
                                        <?php } ?>

                                        <?php if ($payflowLinkInfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input type="radio" id="payflowlink_method" name="paymentmethod" value="payflowlink" onclick="OpenDetails(this.value)" />
                                                <label for="payflowlink_method"><img style="vertical-align:middle" src="img/pp_logo_payflow.gif" /></label>
                                            </p>
                                        <?php } ?>

                                        <?php if ($paymentasiaInfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input type="radio" id="paymentasia_method" name="paymentmethod" value="paymentasia" onclick="OpenDetails(this.value)" />
                                                <label for="paymentasia_method"><img style="vertical-align:middle" src="img/paymentasia_logo.jpg" /></label>
                                            </p>
                                        <?php } ?>

                                        <?php if ($ccavenueInfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input type="radio" id="ccavenue_method" name="paymentmethod" value="ccavenue" onclick="OpenDetails(this.value)" />
                                                <label for="ccavenue_method"><img style="vertical-align:middle" src="img/ccavenue.jpg" /></label>
                                            </p>
                                        <?php } ?>

                                        <p id="buybidbut" align="right">
                                            <?php if ($paypalInfo->isEnabled() == true) {
                                            ?>
                                                <button value="BUY BIDS" name="cnfbuybids" class="button" type="submit"><?php echo PAYMENT; ?></button>
                                            <?php } ?>
                                        </p>
                                        <input type="hidden" name="auctionId" value="<?=base64_encode($id); ?>" />
                                    </form>

                                </div>

                                <div id="payment-info">
                                    <div id="creditdetail" style="display:none;">
                                        <?php if ($paypalProInfo->isEnabled() == true || $authnetInfo->isEnabled() == true) {
                                        ?>
                                                <h4><?php echo FILL_YOUR_CREDIT_CARD_DETAILS; ?> :</h4>
                                                <form action="productcheckout.php" method="post" name="f2" id="checkoutform">

                                            <?php include 'paymentform/creditcard.php'; ?>

                                                <input type="hidden" name="pay_method" id="pay_method" value="paypalcredit"></input>
                                                <input type="hidden" name="auctionId" value="<?=base64_encode($id); ?>" />

                                            <div class="wraps">
                                                <input name="submitbutton" id="submitbutton" value="<?php echo PAYMENT ?>" class="button" type="submit"/>
                                                <div class="clear"></div>
                                            </div>

                                        </form>
                                        <?php } ?>
                                    </div>


                                    <div id="google" class="wraps" style="display:none;">
                                        <?php if ($googleCheckoutInfo->isEnabled() == true) {
                                        ?>
                                            <h4><?php echo PAYMENT_GOOGLE_CHECKOUT; ?>:</h4>

                                            <form method="POST" action="googlepayment.php" style="text-align:center;padding:10px;">
                                                <label class="label">&nbsp;&nbsp;</label>
                                                <input type="hidden" name="payfor" value="buyitnow"/>
                                                <input type="hidden" name="id" value="<?=base64_encode($id); ?>" />
                                                <input name="Checkout" alt="Checkout" src="img/google_checkout_logo.gif?merchant_id=&amp;w=180&amp;h=46&amp;style=trans&amp;variant=text&amp;loc=en_US" type="image" />
                                            </form>

                                        <?php } ?>
                                    </div>

                                    <div id="payflowlink" class="wraps" style="display:none;">
                                        <?php if ($payflowLinkInfo->isEnabled() == true) {
                                        ?>
                                            <h4><?php echo PAYMENT_VIA_PAYFLOWLINK; ?>:</h4>


                                            <form method="POST" action="payflowlinkpayment.php" style="text-align:center;padding:10px;">
                                                <label class="label">&nbsp;&nbsp;</label>
                                                <input type="hidden" name="payfor" value="buyitnow"/>
                                                <input type="hidden" name="id" value="<?=base64_encode($id); ?>" />
                                                <p style="margin:0 auto;">
                                                    <button value="BUY BIDS" class="button" name="payflow" type="submit"><?php echo PAYMENT; ?></button>
                                                </p>
                                            </form>

                                        <?php } ?>
                                    </div>

                                    <div id="paymentasia" class="wraps" style="display:none;">
                                        <?php if ($paymentasiaInfo->isEnabled() == true) {
                                        ?>

                                            <h4><?php echo PAYMENT_VIA_PAYMENTASIA; ?>:</h4>

                                            <form method="POST" action="paymentasiapayment.php" style="text-align:center;padding:10px;">
                                                <label class="label">&nbsp;&nbsp;</label>
                                                <input type="hidden" name="payfor" value="buyitnow"/>
                                                <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>" />
                                                <button value="BUY BIDS" class="button" name="paymentasia" type="submit"><?php echo PAYMENT; ?></button>
                                            </form>

                                        <?php } ?>
                                    </div>

                                    <div id="ccavenue" class="wraps" style="display:none;">
                                        <?php if ($ccavenueInfo->isEnabled() == true) {
                                        ?>

                                            <h4><?php echo PAYMENT_CCAVENUE; ?>:</h4>

                                            <form method="POST" action="paymentccavenue.php" style="text-align:center;padding:10px;">
                                                <label class="label">&nbsp;&nbsp;</label>
                                                <input type="hidden" name="payfor" value="buyitnow"/>
                                                <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>" />
                                                <button value="BUY BIDS" class="button" name="ccavenue" type="submit"><?php echo PAYMENT; ?></button>

                                            </form>

                                        <?php } ?>
                                    </div>


                                </div>


                            </div>
                            <div id="login-form-end"></div>
                        </div>

                        <?php } else {
                        ?>
                                        <div style="min-height:300px;padding:20px;">
                                            <p>
                                <?php echo THE_PRODUCT_DONT_ALLOW_TO_BUY_IT_NOW; ?>
                                    </p>

                                </div>
                        <?php
                                    }
                                } else {
                        ?>

                                    <div style="min-height:300px;padding:20px;">

                                        <p>
                                <?php echo NOW_PRODUCT_TO_SELECT_TO_BUY ?>
                                </p>

                            </div>
                        <?php } ?>

                                <div class="clear"></div>
                                <div id="login-register-end"></div>
                            </div>
                            <!-- ============= End Registration =============  -->
                        </div>
                    </div>
                    <div id="wrap-end"></div>
                </div> <!--end pagewidth-->

        <?php include 'footer.php' ?>

    </body>
</html>
