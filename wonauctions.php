<?php
include("config/connect.php");
include("session.php");
include("functions.php");
include("data/paymenthelper.php");
include_once 'common/seosupport.php';

$uid = $_SESSION["userid"];
$changeimage = "myaccount";

if (!$_GET['pgno']) {
    $PageNo = 1;
} else {
    $PageNo = $_GET['pgno'];
}
/* on 11/14/2013 Edward Goodnow modified the below SQL to left join auc_due_table with auc_final_price he was not sure if this would effet other auction types...this was done so that seated auctions with no_bids_after would grab the correct price during checkout the original code was
$qrysel = "select w.auction_id, accept_denied,won_date,accept_date,payment_date,order_status,tracknumber,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,a.auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,ss.id as ssid,st.url as sturl,st.logoimage as stlogoimage from won_auctions w left join auction a on w.auction_id=a.auctionID left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join shippingstatus ss on ss.orderid=w.id and ss.ordertype=1 left join shippingtype st on st.id=ss.shippingtypeid where w.userid=$uid order by w.won_date desc";
     
     
     the bottom is the new code */
     
$qrysel = "select w.auction_id, accept_denied,won_date,accept_date,payment_date,order_status,tracknumber,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,adt.auc_due_price as auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,s.id as sid, ss.id as ssid,st.url as sturl,st.logoimage as stlogoimage, r.delivery_country, r.delivery_state, r.country, r.state from won_auctions w left join auction a on w.auction_id=a.auctionID left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join shippingstatus ss on ss.orderid=w.id and ss.ordertype=1 left join shipping s on s.id=ss.shippingtypeid left join shippingtype st on st.id=s.shippingtypeid left join auc_due_table adt on adt.auction_id=a.auctionID left join registration r on r.id=w.userid where w.userid=$uid order by w.won_date desc";
$ressel = db_query($qrysel);
$total = db_num_rows($ressel);
$totalauc = db_num_rows($ressel);
echo db_error();
$totalpage = ceil($total / $PRODUCTSPERPAGE_MYACCOUNT);

if ($totalpage >= 1) {
    $startrow = $PRODUCTSPERPAGE_MYACCOUNT * ($PageNo - 1);
    $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE_MYACCOUNT";
    //echo $sql;
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);
}

$qryvou = "select * from user_vouchers where user_id='" . $uid . "' and voucher_status='0'";
$resvou = db_query($qryvou);
$totalvou = db_num_rows($resvou);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <?php include("page_headers.php"); ?>
        <script type="text/javascript" language="javascript">
            function ShowMakepaymentbutton(Aucid,Accden,paydate)
            {
                if(Accden=='Accepted' && paydate=='')
                {
                    document.getElementById("wonacceptdenied_"+Aucid).innerHTML = "<font class='greenfont'><b><?php echo ACCEPTED; ?></b></font>";
                    document.getElementById("makepayment_"+Aucid).style.visibility = 'visible';
                }
                else if(Accden=='Denied')
                {
                    document.getElementById("wonacceptdenied_"+Aucid).innerHTML = "<font color='#C82C2F'><b><?php echo DENIED; ?></b></font>";
                }
                else if(paydate!="")
                {
                    document.getElementById("wonacceptdenied_"+Aucid).innerHTML = "<font class='greenfont'><b><?php echo ACCEPTED; ?></b></font>";
                    document.getElementById('paymentdate_' + Aucid).style.visibility= 'visible';
                    document.getElementById('paymentdate_' + Aucid).innerHTML = "<b>" + paydate + "</b>";
                }
            }
             function CheckValue(f1)
            {
                var wonstatus = f1.Accden.value;
                if(wonstatus=="")
                {
                    alert("<?php echo PLEASE_SELECT_ACCEPT_OR_DENIED; ?>");
                    f1.Accden.focus();
                    return false
                }
            }
            function accept_in_modal(){
		$.ajax({
			url: 'acceptordenied.php',
			data: $('#AcceptWon').serialize(),
			type: 'post',
			dataType: 'html',
			success: function(response){
			window.location.href = window.location.href;
		
			}
		
		      });
            
            }
            function OpenAcceptdeniedPopup(url, popup)
            {
		if(popup == true){
		  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=300,height=130,screenX=150,screenY=200,top=200,left=200')
		}else{
				$('#alert_message_content').html('Loading');
				
				    $( "#alert_message" ).dialog({
						    modal: true,
						    autoOpen: true,
						    buttons: {
							"<?php echo OK; ?>": function() {
							    $( this ).dialog( "close" );
							}
						    },
						    
							    open: function(){
							    
								    $("#alert_message").css({"zIndex": findHighestZIndex('*') + 10 });
							    
							      }
							
						    
						});
		    $.ajax({
			  url: url + '&ajax=true',
			  type: 'get',
			  dataType: 'html',
			  success: function(response){
			    $('#alert_message_content').html(response);
			  }
		
			});
		            
		  }
            }
        </script>
    </head>

    <body onload="OnloadPage();" class="single">

         <?php
	      foreach($addons as $key => $value){

		if(file_exists("include/addons/$value/$template/top_bar.php")){
		
		    include("include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists("include/addons/$value/top_bar.php")){
		

		    include_once("include/addons/$value/top_bar.php");

		}


	      }
	      if(file_exists($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF'])  )  ) {
		include($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/user_pages/" . basename($_SERVER['PHP_SELF']));
		
		}
	  ?>
        
    </body>
</html>
