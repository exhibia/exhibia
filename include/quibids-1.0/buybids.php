<?php
include("config/connect.php");
include("session.php");
include("functions.php");

include_once 'data/paygateway.php';


$uid = $_SESSION["userid"];
$changeimage = "buybids";

if ($_POST["paymentmethod"] != "") {
    $paymentmethod = $_POST["paymentmethod"];
    if ($paymentmethod == "paypal") {
        header("location: buybidspayment.php?bpid=" . $_POST["bidpackid"]);
        exit;
    } elseif ($paymentmethod == "creditcard") {
        header("location: checkout.php?bpid=" . $_POST["bidpackid"]);
        exit;
    }
}

$qrysel = "select *," . $lng_prefix . "bidpack_banner as bidpack_banner," . $lng_prefix . "bidpack_name as bidpack_name from bidpack order by id";
$rssel = db_query($qrysel);
$totalbpack = db_num_rows($rssel);
if ($totalbpack > 0) {
    $selected = ceil($totalbpack / 2);
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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $AllPageTitle; ?></title>
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

                if (ccCardNumber(document.f2.creditCardNumber.value) == false) {
                    alert("<?php echo CREDIT_CARD_NUMBER_INVALID; ?>")
                    document.f2.creditCardNumber.focus();
                    return false;
                }

                if (document.f2.cvv2Number.value.length < 3) {
                    alert("<?php echo YOUR_CREDIT_CARD_CCV_INVALID; ?>");
                    document.f2.cvv2Number.focus();
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

            function setPaymentValue(val){
                //$('#bidpacksize1').val($('#pkg_size_'+val).val());
                $('#bidpackid_main').val($('#pkg_base64id_'+val).val());
                $('#bidpackid_google').val($('#pkg_base64id_'+val).val());
                $('#bidpackid_payflowlink').val($('#pkg_base64id_'+val).val());
                $('#bidpackid_paymentasia').val($('#pkg_base64id_'+val).val());
                $('#bidpackid_ccavenue').val($('#pkg_base64id_'+val).val());
            }

            $(document).ready(function(){
                $('.pkg_').change(function(){
                    var val=$(this).children(':radio').val();
                    $('#info_title').html($('#pkg_name_'+val).val());
                    $('#info_bids').html(Number($('#pkg_size_'+val).val()));
                    $('#free_bids').html(Number($('#pkg_free_'+val).val()));
                    $('#info_cost').html($('#pkg_price_'+val).val());
                    $('#info_totalcost').html($('#pkg_price_'+val).val());

                    $('#pkg_id').val(val);

                    $('.pkg_').removeClass('active');
                    $(this).addClass('active');
                    setPaymentValue(val);
                });

                var tval=($('.pkg_').children(':checked').val());

                $('#info_title').html($('#pkg_name_'+tval).val());
                $('#info_bids').html(Number($('#pkg_size_'+tval).val()));
                $('#free_bids').html(Number($('#pkg_free_'+tval).val()));
                $('#info_cost').html($('#pkg_price_'+tval).val());
                $('#info_totalcost').html($('#pkg_price_'+tval).val());

                $('#pkg_id').val(tval);
                setPaymentValue(tval);

<?php
if(db_num_rows(db_query("select * from sitesetting where value = 'multi_coupon' and name = 'addons'")) >= 1){
?>



<?php 
}else{
?>

                $("#couponcode").change(function(){
                    var val=$(this).val();
                    $("#couponcode1").val(val);
                    $("#couponcode2").val(val);
                    $("#couponcode3").val(val);
                    $("#couponcode4").val(val);
                    $("#couponcode5").val(val);
                    $("#couponcode6").val(val);
                });

                $("#applycoupon").click(function(){
                    var code=$("#couponcode").val();
                    if(code.length<=0){
                        alert('<?php echo ENTER_THE_COUPON_CODE_PLEASE; ?>');
                        return;
                    }
                    $("#couponinfo").hide();
                    $.ajax({
                        type:"post",
                        url:"getcouponinfo.php",
                        dataType:"json",
                        cache: false,
                        data:{couponcode:code},
                        success:function(data){
                            if(data.msg=='ok'){
                                $('#free_bids').html(Number($('#free_bids').html())+data.data.freebids);
                                var amount=$('#info_totalcost').html();
                                $('#info_totalcost').html(amount*(1-data.data.discount/100));
                                
                                var html='<strong><?php echo TITLE; ?>:</strong>'+data.data.title+'&nbsp;&nbsp;<strong><?php echo DISCOUNT; ?>:</strong>'+data.data.discount+'%&nbsp;<?php echo OFF; ?>&nbsp;&nbsp;<strong><?php echo FREE_BIDS; ?>:</strong>'+data.data.freebids;

                                $("#couponinfo").html(html);
                                $("#couponinfo").show();
                            }else{
                                $("#couponinfo").html('<span class="error">'+data.msg+'</span>');
                                $("#couponinfo").show();
                            }
                        }
                    });
                });
<?php } ?>
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
                            <!--
                            <table><tbody><tr><td align="right">
                                            <script type="text/javascript" src="flash/getseal_002"></script><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" id="s_s" width="100" align="" height="72">
                                                <param name="movie" value="https://seal.verisign.com/getseal?at=1&amp;&amp;sealid=2&amp;dn=WWW.QUIBIDS.COM&amp;aff=VeriSignCACenter&amp;lang=en"/>
                                                <param name="loop" value="false"/>
                                                <param name="menu" value="false"/>
                                                <param name="quality" value="best"/>
                                                <param name="wmode" value="transparent"/>
                                                <param name="allowScriptAccess" value="always"/>
                                                <embed src="flash/getseal" loop="false" menu="false" quality="best" wmode="transparent" swliveconnect="FALSE" name="s_s" type="application/x-shockwave-flash" pluginspage="https://www.macromedia.com/go/getflashplayer" allowscriptaccess="always" width="100" align="" height="72"/>
                                            </object>
                                        </td>
                                        <td width="5">&nbsp;</td>
                                        <td>
                                            <img src="img/lock.png"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            -->
                        </div>

                        <h2><?php echo BUY_BID; ?></h2>
                        <!-- ============= Ready Start Winning =============  -->                       

                        <div id="bid-pack-wrap">
			  <h3><?php echo CHOOSE_A_BID_PACK;?></h3>
 

                            <div id="bid-packs">
                                <?php
                                $i = 0;
                                while ($obj = db_fetch_array($rssel)) {
                                    $path = '';
                                    if ($obj['bid_size'] <= 24)
                                        $clssize = "bg-box-xs.gif";
                                    else if ($obj['bid_size'] > 24 && $obj['bid_size'] <= 57)
                                        $clssize = "bg-box-s.gif";
                                    else if ($obj['bid_size'] > 57 && $obj['bid_size'] <= 118)
                                        $clssize = "bg-box-m.gif";
                                    else if ($obj['bid_size'] > 118 && $obj['bid_size'] <= 295)
                                        $clssize = "bg-box-l.gif";
                                    else if ($obj['bid_size'] > 295 && $obj['bid_size'] <= 605)
                                        $clssize = "bg-box-xl.gif";
                                    else if ($obj['bid_size'] > 605 && $obj['bid_size'] <= 1250)
                                        $clssize = "bg-box-xxl.gif";
                                    else if ($obj['bid_size'] > 1250 && $obj['bid_size'] <= 1900)
                                        $clssize = "bg-box-u.gif";
                                ?>
                                    <label class="pkg_ <?php echo $i == 0 ? 'active' : ''; ?>" id="pkg_<?php echo $obj['id']; ?>">
                                        <input type="radio" name="pkg_" <?php echo $i == 0 ? 'checked' : ''; ?> value="<?php echo $obj['id']; ?>" />
                                        <span style="background-image: url(img/backgrounds/<?php echo $clssize; ?>);">
                                            <strong><?php echo $obj['bidpack_name']; ?> </strong>
					<?php echo $obj["bid_size"]; ?>&nbsp;<?php echo BIDS; ?>&nbsp;<?php echo FOR1 . ' ' . USD . $obj['bid_price']; ?>
                                    </span>
                                    <input type="hidden" id="pkg_name_<?php echo $obj['id']; ?>" value="<?php echo $obj['bidpack_name'] ?>"/>
                                    <input type="hidden" id="pkg_size_<?php echo $obj['id']; ?>" value="<?php echo $obj['bid_size'] ?>"/>
                                    <input type="hidden" id="pkg_free_<?php echo $obj['id']; ?>" value="<?php echo $obj['freebids'] ?>"/>
                                    <input type="hidden" id="pkg_price_<?php echo $obj['id']; ?>" value="<?php echo $obj['bid_price'] ?>"/>
                                    <input type="hidden" id="pkg_base64id_<?php echo $obj['id']; ?>" value="<?php echo base64_encode($obj['id']); ?>"/>
                                </label>

                                <?php $i++;
                                    } ?>
                                </div>
                                <br/><div class="wraps"></div>
                                <div id="bid-packs" style="padding-left:25px;">
                                    <strong><?php echo ENTER_A_COUPON_CODE; ?></strong>
                                    <div style="margin-top:4px;vertical-align: middle;">
                                        <input type="text" id="couponcode" />
                                        <button value="APPLY COUPON " name="applycoupon" class="button" style="border:none;" type="button" id="applycoupon">
                                        <?php echo APPLY_COUPON; ?>
                                    </button>
                                </div>
                                <div id="couponinfo"></div>
                                <div class="error"><?php echo $_GET['msg'] == '1' ? "(" . INCORRECT_COUPON_CODE . ")" : "" ?></div>
                            </div>
                        </div>
                        <!-- ============= End Ready Start Winning =============  -->

                        <div id="payment-form-wrap">

                            <div id="payment-form-top"></div>
                            <div id="payment-form">
                                <div id="payment-method">
				  <h3><?php echo PAYMENT_INFORMATION;?></h3>

                                    <table width="430">
                                        <tbody>
                                            <tr>
                                                <td width="140" align="left"><strong><?php echo PACKAGE; ?></strong></td>
                                                <td width="80" align="left"><strong><?php echo BIDS; ?></strong></td>
                                                <td width="70" align="right"><strong><?php echo PRICE ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><hr style="color: silver;"/></td>
                                            </tr>
                                            <tr>
                                                <td id="info_title"></td>
                                                <td align="left"><span id="info_bids">45</span> <?php echo BIDS . " " . FOR1; ?><br/><span id="free_bids">45</span> <?php echo FREE_BIDS; ?></td>
                                                <td align="right"><?php echo $Currency; ?><span id="info_cost">27.00</span></td>
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
                                                    <strong><u><?php echo TOTAL_PACKAGE_COST; ?>:</u> <?php echo $Currency; ?><span id="info_totalcost">27.00</span></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="wraps"><br/></div>
                                </div>


                                <h3><?php echo PAYMENT_METHODS; ?></h3>

                                <div class="paymentmethod_list">

                                    <form name="payment" action="buybidspayment.php" method="post">
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
                                                <button value="BUY BIDS" name="cnfbuybids" class="button" type="submit"><?php echo BUY_BID; ?></button>
                                            <?php } ?>
                                        </p>
                                        <input type="hidden" name="couponcode" id="couponcode1" value=""/>
                                        <input type="hidden" name="bidpackid" id="bidpackid_main" value="<?php echo base64_encode($id); ?>" />
                                        <input type="hidden" name="bidpacksize" value="<?php echo $obj->bid_size; ?>" />
                                    </form>

                                </div>

                                <div id="payment-info">
                                    <div id="creditdetail" style="display:none;">
                                        <?php if ($paypalProInfo->isEnabled() == true || $authnetInfo->isEnabled() == true) {
                                        ?>
                                                <h4><?php echo FILL_YOUR_CREDIT_CARD_DETAILS; ?> :</h4>
                                                <form action="checkout.php" method="post" name="f2" id="checkoutform">

                                            <?php include 'paymentform/creditcard.php'; ?>

                                                <input type="hidden" name="pay_method" id="pay_method" value="paypalcredit"></input>
                                                <input type="hidden" name="couponcode" id="couponcode2" value=""/>
                                                <input type="hidden" name="bidpackid" value="<?php echo base64_encode($id); ?>" />

                                                <div class="wraps">
                                                    <input name="submitbutton" id="submitbutton" value="<?php echo BUY_BID; ?>" class="button" type="submit"/>
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
                                                    <input type="hidden" name="payfor" value="buybid"/>
                                                    <input type="hidden" name="couponcode" id="couponcode3" value=""/>
                                                    <input type="hidden" name="id" id="bidpackid_google" value="<?php echo base64_encode($id); ?>" />
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
                                                    <input type="hidden" name="payfor" value="buybid"/>
                                                    <input type="hidden" name="couponcode" id="couponcode4" value=""/>
                                                    <input type="hidden" name="id" id="bidpackid_payflowlink" value="<?php echo base64_encode($id); ?>" />
                                                    <p style="margin:0 auto;">
                                                        <button value="BUY BIDS" class="button" name="payflow" type="submit"><?php echo BUY_BID; ?></button>
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
                                                    <input type="hidden" name="payfor" value="buybid"/>
                                                    <input type="hidden" name="couponcode" id="couponcode5" value=""/>
                                                    <input type="hidden" name="id" id="bidpackid_paymentasia" value="<?php echo base64_encode($id); ?>" />
                                                    <button value="BUY BIDS" class="button" name="paymentasia" type="submit"><?php echo BUY_BID; ?></button>
                                                </form>

                                        <?php } ?>
                                        </div>

                                        <div id="ccavenue" class="wraps" style="display:none;">
                                        <?php if ($ccavenueInfo->isEnabled() == true) {
                                        ?>

                                                <h4><?php echo PAYMENT_CCAVENUE; ?>:</h4>

                                                <form method="POST" action="paymentccavenue.php" style="text-align:center;padding:10px;">
                                                    <label class="label">&nbsp;&nbsp;</label>
                                                    <input type="hidden" name="payfor" value="buybid"/>
                                                    <input type="hidden" name="couponcode" id="couponcode6" value=""/>
                                                    <input type="hidden" name="id" id="bidpackid_ccavenue" value="<?php echo base64_encode($id); ?>" />
                                                    <button value="BUY BIDS" class="button" name="ccavenue" type="submit"><?php echo BUY_BID; ?></button>

                                                </form>

                                        <?php } ?>
                                        </div>


                                    </div>


                                </div>
                                <div id="login-form-end"></div>
                            </div>

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
