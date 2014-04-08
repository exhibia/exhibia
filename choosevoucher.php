<?php
include("config/connect.php");
include("session.php");
include("functions.php");

$changeimage = "myaccount";
$uid = $_SESSION["userid"];
$winid = $_GET["winid"];
$winid1 = base64_decode($_GET["winid"]);
$expwin = explode("&",$winid1);
$aid = $expwin[1];

$qryselupd = "select *,uv.id as uservoucherid from user_vouchers uv left join vouchers v on uv.voucherid=v.id where uv.user_id='$uid'";
$resselupd = db_query($qryselupd);
$totalupd = db_num_rows($resselupd);
while($obj1 = db_fetch_array($resselupd)) {
    $status = "";
    if($obj1["expirydate"]!="0000-00-00 00:00:00" && $obj1["voucher_status"]==0) {
        $expiry = strtotime($obj1["expirydate"]);
        $today = time();
        if($today>$expiry) {
            $status="expire";
        }
    }
    if($status=="expire") {
        $qry = "update user_vouchers set voucher_status='2' where id='".$obj1["uservoucherid"]."'";
        db_query($qry) or die(db_error());
    }
}

$qryauc = "select * from auction a left join products p on a.productID=p.productID left join shipping s on a.shipping_id=s.id where a.auctionID='".$aid."'";
$resauc = db_query($qryauc);
$objauc = db_fetch_object($resauc);

$qryvou = "select *,uv.id as useruseid from user_vouchers uv left join vouchers v on uv.voucherid=v.id where uv.user_id='".$uid."' and uv.voucher_status='0'";
$resvou = db_query($qryvou);
$totalvou = db_num_rows($resvou);
$finalamount = $expwin[0] + $objauc->shippingcharge;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('page_headers.php'); ?>
        <script language="javascript">
            function Check()
            {
                if(document.f1.novoucher.checked==false && document.f1.voucher.value=='none')
                {
                    alert("Please selecte voucher!");
                    document.f1.voucher.focus();
                    return false;
                }
            }
            function number_format( number, decimals, dec_point, thousands_sep ) {
                var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
                var d = dec_point == undefined ? "." : dec_point;
                var t = thousands_sep == undefined ? "," : thousands_sep, s = n < 0 ? "-" : "";
                var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;

                return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
            }
            function TotalCountAmount(value)
            {
                totalamount = document.getElementById('final_amount');
                subtotalamount = document.getElementById('sub_final_amount');
                voucheramount = document.getElementById('amountvoucher');
                voucher = value.split(",");
                selvoucheramount = voucher[2];
                vouchertype = voucher[3];

                if(vouchertype==2)
                {
                    if(value!="none")
                    {
                        auctionamountvalue = Number(document.getElementById('auctionamount').innerHTML);
                        shippingamountvalue = Number(document.getElementById('shippingamount').innerHTML);

                        oldtotalamount = auctionamountvalue;

                        if(auctionamountvalue<selvoucheramount)
                        {
                            selvoucheramount1 = auctionamountvalue;
                        }
                        else
                        {
                            selvoucheramount1 = selvoucheramount;
                        }

                        newtotalamount = oldtotalamount - selvoucheramount;
                        if(newtotalamount<0)
                        {
                            newtotalamount = shippingamountvalue + 0.00;
                        }
                        else
                        {
                            newtotalamount = newtotalamount + shippingamountvalue
                        }
                        voucheramount.innerHTML =  number_format(selvoucheramount1,2,'.','');
                        document.getElementById('dispvoucheramount').innerHTML = selvoucheramount;
                        if(document.f1.novoucher.checked==false)
                        {
                            totalamount.innerHTML = number_format(newtotalamount,2,'.','');
                            subtotalamount.innerHTML = number_format(newtotalamount-shippingamountvalue,2,'.','');
                            document.getElementById("vouchercontent").style.display = 'block';
                        }
                    }
                    else
                    {
                        document.getElementById("vouchercontent").style.display = 'none';
                        totalamount = document.getElementById('final_amount');
                        subtotalamount = document.getElementById('sub_final_amount');

                        auctionvalue = Number(document.getElementById('auctionamount').innerHTML);
                        shippingvalue = Number(document.getElementById('shippingamount').innerHTML);

                        totalvalue = auctionvalue + shippingvalue;
                        totalamount.innerHTML = number_format(totalvalue,2,'.','');
                        subtotalamount = number_format(totalvalue-shippingvalue,2,'.','');
                    }
                    //		document.getElementById('freebidsnote').style.display = 'none';
                }
                else
                {
                    auctionvalue = Number(document.getElementById('auctionamount').innerHTML);
                    shippingvalue = Number(document.getElementById('shippingamount').innerHTML);

                    totalvalue = auctionvalue + shippingvalue;
                    totalamount.innerHTML = number_format(totalvalue,2,'.','');
                    subtotalamount.innerHTML = number_format(auctionvalue,2,'.','');
                    voucheramount.innerHTML = "0.00";
                    document.getElementById('dispvoucheramount').innerHTML = "0.00";
                    document.getElementById("vouchercontent").style.display = 'block';
                    if(value!="none")
                    {
                        //			document.getElementById('freebidsnote').style.display = 'block';
                    }
                    else
                    {
                        //			document.getElementById('freebidsnote').style.display = 'none';
                    }
                }
            }
            function HideVoucher()
            {
                value = document.getElementById('voucher').value;
                voucher = value.split(",");
                vouchertype = voucher[3];
                if(document.f1.novoucher.checked==true)
                {
                    document.getElementById("vouchercontent").style.display = 'none';

                    totalamount = document.getElementById('final_amount');
                    subtotalamount = document.getElementById('sub_final_amount');

                    auctionvalue = Number(document.getElementById('auctionamount').innerHTML);
                    shippingvalue = Number(document.getElementById('shippingamount').innerHTML);

                    totalvalue = auctionvalue + shippingvalue;
                    totalamount.innerHTML = number_format(totalvalue,2,'.','');
                    subtotalamount.innerHTML = number_format(auctionvalue,2,'.','');
                    //		document.getElementById('freebidsnote').style.display = 'none';
                }
                else
                {
                    if(document.f1.voucher.value=='none')
                    {
                        document.getElementById("vouchercontent").style.display = 'none';

                        totalamount = document.getElementById('final_amount');
                        subtotalamount = document.getElementById('sub_final_amount');

                        auctionvalue = Number(document.getElementById('auctionamount').innerHTML);
                        shippingvalue = Number(document.getElementById('shippingamount').innerHTML);

                        totalvalue = auctionvalue + shippingvalue;
                        totalamount.innerHTML = number_format(totalvalue,2,'.','');
                        subtotalamount.innerHTML = number_format(auctionvalue,2,'.','');
                        //			document.getElementById('freebidsnote').style.display = 'none';
                    }
                    else
                    {
                        document.getElementById("vouchercontent").style.display = 'block';

                        totalamount = document.getElementById('final_amount');
                        subtotalamount = document.getElementById('sub_final_amount');

                        auctionvalue = Number(document.getElementById('auctionamount').innerHTML);
                        shippingvalue = Number(document.getElementById('shippingamount').innerHTML);
                        vouchervalue = Number(document.getElementById('amountvoucher').innerHTML)

                        totalvalue = auctionvalue - vouchervalue;
                        if(totalvalue<0)
                        {
                            totalvalue = shippingvalue + 0.00;
                        }
                        totalamount.innerHTML = number_format(totalvalue + shippingvalue,2,'.','');
                        subtotalamount.innerHTML = number_format(totalvalue,2,'.','');
                        if(vouchertype==1)
                        {
                            //			document.getElementById('freebidsnote').style.display = 'block';
                        }
                    }

                }
            }
        </script>
    </head>

    <body class="single">
                <?php
         
         
	      foreach($addons as $key => $value){

		if(file_exists("include/addons/$value/$template/top_bar.php")){
		
		    include("include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists("include/addons/$value/top_bar.php")){
		

		    include_once("include/addons/$value/top_bar.php");

		}


	      }
	      if(file_exists("include/$template/product_pages/$_SERVER[PHP_SELF]")){
		include("include/$template/product_pages/$_SERVER[PHP_SELF]");
		}else{
		
		include("include/product_pages/$_SERVER[PHP_SELF]");
		
		}
		


	  ?>
    </body>
</html>