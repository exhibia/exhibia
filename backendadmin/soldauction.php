<?php
session_start();
$active = "Payment";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");
include("functions.php");
include_once '../data/emailtemplate.php';
include("../Functions/SendWinnerMail.php");

if(!empty($_GET['orderid'])){
    if(!empty($_REQUEST['submit'])){
    
 
 


    $qrysel = "select p.name,up.price,up.buydate,up.status,up.id, username, email, up.productid,userid 
    from user_product up inner join registration r on r.id=up.userid
    inner join products p on p.productID=up.productid
    where up.id=$_GET[orderid]";
    
    $user_data = db_fetch_object(db_query($qrysel));
    

      db_query("update user_product set status = '3' where id = $_GET[orderid]");
      
	    if(db_num_rows(db_query("select orderid from shippingstatus  where orderid = '$_GET[orderid]' and ordertype = 1")) == 0){
	    
	      db_query("insert into shippingstatus values(null, '" . urldecode($_GET['shippingtypeid']) . "', '$_GET[orderid]', '1', '" . urldecode($_GET['trackingnumber']) ."', NOW(), '$_GET[shippingstatus]');");
	      
		  
		$trackingnumber = db_fetch_object(db_query("select * from shippingstatus where id = " . $_GET['orderid']));
                                                                                       
                $resc = db_fetch_object(db_query("select * from shipping left join shippingtype st on st.id=shippingtypeid where shippingtype.id = " . $trackingnumber->shippingtypeid ));
                                                                                     
                switch($_GET['shippingstatus']){
		  case '0':
		    $status = "Not Shipped";
		    $color = 'red';
		  break;
		  case '1':
		    $status = "Waiting Agent Pickup";
		    $color = 'white';
		  break;
		  case '2':
		    $status = "Shipped";
		    $color = 'blue';
		  break;
		  case '3':
		    $status = "Delivery Confirmed";
		    $color = 'green';
		  break;
                }
                 $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $_GET['orderid'] . " and ordertype=1"));
                 $resc = db_fetch_object(db_query("select shipping_title, st.logoimage, st.name,st.id as stid, shippingcharge, st.url from shipping left join shippingtype st on st.id = shipping.shippingtypeid where shipping.id = " . $trackingnumber->shippingtypeid ));
               
                
                  $str = "<ul style='list-type:none!important;list-style-type:none!important;'>";
                  $str .= "<li>" . $resc->name ."</li>";
		  $str .= "<li>" . $resc->shipping_title ."</li>";
                  $str .= "<li>" . $trackingnumber->tracknumber . "</li>"; 
                  $str .= "<li>" . $trackingnumber->adddate . "</li>";
                  $str .= "<li><img src='../uploads/other/" . $resc->logoimage . "' /></li>";
                  $str .= "</ul>";
                  
                  echo "{\"message\": \"$str\", \"status\" : \"" . $status . "\", \"color\" : \"$color\" }";
                   
                                                                                       
                                                                                       
                 $template = new EmailTemplate();                                
                 $emailtemplate = $template->getEmailTemplate('shipping');                              
                 if(!empty($emailtemplate)){                
                   SendHTMLMail2($user_data->email, $emailtemplate->subject . " " . $user_data->name, $emailtemplate->content . $emailtemplate->content ."<br />Shipping Agent" . $resc->shipping_title ."<br />Tracking Info"  .$trackingnumber->tracknumber . "<br />", "sales@" . $_SERVER['SERVER_NAME']); 
		    
		 }      
	    
	    
	    }else{
	    
		 
			  db_query("update shippingstatus set adddate = NOW(), tracknumber = '" . urldecode($_GET['trackingnumber']) ."', shippingtypeid = '" . urldecode($_GET['shippingtypeid']) . "', ordertype = '1', status=$_GET[shippingstatus] where orderid = '$_GET[orderid]'" . " and ordertype=1");
	      
	      
	      
		
                                                                                       
				      
				      switch($_GET['shippingstatus']){
					case '0':
					  $status = "Not Shipped";
					  $color = 'red';
					break;
					case '1':
					  $status = "Waiting Agent Pickup";
					  $color = 'white';
					break;
					case '2':
					  $status = "Shipped";
					  $color = 'blue';
					break;
					case '3':
					  $status = "Delivery Confirmed";
					  $color = 'green';
					break;
				      }
                
		      $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $_GET['orderid'] . " and ordertype=1"));
		      $resc = db_fetch_object(db_query("select shipping_title, st.logoimage, st.name,st.id as stid, shippingcharge, st.url from shipping left join shippingtype st on st.id = shipping.shippingtypeid where shipping.id = " . $trackingnumber->shippingtypeid ));
		      
		      
			$str = "<ul style='list-type:none!important;list-style-type:none!important;'>";
			$str .= "<li>" . $resc->name ."</li>";
			$str .= "<li>" . $resc->shipping_title ."</li>";
			$str .= "<li>" . $trackingnumber->tracknumber . "</li>"; 
			$str .= "<li>" . $trackingnumber->adddate . "</li>";
			$str .= "<li><img src='../uploads/other/" . $resc->logoimage . "' /></li>";
			$str .= "</ul>";
			
			echo "{\"message\": \"$str\", \"status\" : \"" . $status . "\", \"color\" : \"$color\" }";
			
			
			$template = new EmailTemplate();                                
			$emailtemplate = $template->getEmailTemplate('shipping');                              
			if(!empty($emailtemplate)){                
			  
			  SendHTMLMail2($user_data->email, $emailtemplate->subject . " " . $user_data->name, $emailtemplate->content . $emailtemplate->content ."<br />Shipping Agent" . $resc->shipping_title ."<br />Tracking Info"  .$trackingnumber->tracknumber . "<br />", "sales@" . $_SERVER['SERVER_NAME']); 
			  
			}                                                                                	  
		    
		 
	    
	    
	    }
    
      exit;

    }else{

$row = db_fetch_object(db_query("select * from shippingstatus where orderid = '$_GET[orderid]'"));

 ?>
		<span style="position:relative;width:180px;">
		<form id="form[<?php echo $_GET['orderid']?>]" name="form[<?php echo $_GET['orderid']?>]">
			<ul style="list-type:none!important;list-style-type:none!important;">
								    
			  
			   <li>
				<select name="shippingtypeid[<?php echo $_GET['orderid'];?>]" id="shippingtypeid[<?php echo $_GET['orderid'];?>]" style="font-size:10px;">
                                    <option value="none">select one</option>
                                          <?php
						 $resc = db_query("select * from shipping");
						    while ($obj = db_fetch_array($resc)) {
                                                    ?>
                                                         <option <?php echo isset($row->shippingtypeid) && $row->shippingtypeid == $obj['id'] ? "selected" : ""; ?> value="<?php echo $obj["id"]; ?>"><?php echo $obj["shipping_title"]; ?></option>
                                                    <?php
                                                                                   
                                                      }
                                                       db_free_result($resc);
                                           ?>
                               </select>
			   </li>
			  
			   <li> <input type="text" name="trackingnumber[<?php echo $_GET['orderid'];?>]" id="trackingnumber[<?php echo $_GET['orderid'];?>]" value="<?php echo $row->tracknumber;?>" style="font-size:10px;" size="15" /></li>
			   <li>
				<select name="shippingstatus[<?php echo $_GET['orderid'];?>]" id="shippingstatus[<?php echo $_GET['orderid'];?>]" style="font-size:10px;">
				      <option value="0" <?php if($row->status == 0){ echo 'selected'; } ?>>Not shipped</option>
				      <option value="1" <?php if($row->status == 1){ echo 'selected'; } ?>>Waiting Agent Pickup</option>
				      <option value="2" <?php if($row->status == 2){ echo 'selected'; } ?>>Shipped</option>
				      <option value="3" <?php if($row->status == 3){ echo 'selected'; } ?>>Confirmed</option>
				</select>
			   </li>
			   <li><input type="button" value="submit" onclick="javascript:ajaxupdateshipping<?php echo $_REQUEST['bn']; //added specifically for the new control panel code ?>('<?php echo $_GET['orderid'];?>');" style="font-size:10px;" /></li>
		       </ul>
		</form>
									  
	    </span>
<?php



}




}else{
$PRODUCTSPERPAGE = 15;


if (!$_GET['order'])
    $order = "";
else
    $order = $_GET['order'];
if ($_REQUEST['aucstatus']) {
    $aucstatus = $_REQUEST['aucstatus'];
}
if (!$_GET['pgno']) {
    $PageNo = 1;
} else {
    $PageNo = $_GET['pgno'];
}
$startdate = '';
$enddate = '';
$username = '';

if ($_POST["submit"] != "" || $_GET["sdate"] != "" || $order!='') {
    if ($_POST["submit"] != "") {
        $startdate = $_POST["datefrom"] == '' ? '' : ChangeDateFormat($_POST["datefrom"]);
        $enddate = $_POST["dateto"] == '' ? '' : ChangeDateFormat($_POST["dateto"]);
        $quyenddate = $enddate . ' 23:59:59';
        $username = $_POST["username"];
    } else {
        $startdate = $_GET["sdate"] == '' ? '' : ChangeDateFormat($_GET["sdate"]);
        $enddate = $_GET["edate"] == '' ? '' : ChangeDateFormat($_GET["edate"]);
        $quyenddate = $enddate == '' ? '' : $enddate . ' 23:59:59';
        $username = $_GET["username"];
    }

    $urldata = "sdate=" . ChangeDateFormatSlash($startdate) . "&edate=" . ChangeDateFormatSlash($enddate) . "&username=" . $username . "&order=" . $order . "&aucstatus=" . $aucstatus;
    $orderurldata="sdate=" . ChangeDateFormatSlash($startdate) . "&edate=" . ChangeDateFormatSlash($enddate) . "&username=" . $username . "&aucstatus=" . $aucstatus;
    /*     * ******************************************************************
      Get how many products  are to be displayed according to the  Events
     * ****************************************************************** */
    $wherecase = '';
    
    
    if ($startdate != '') {
        $wherecase.=" and w.won_date>'$startdate' ";
    }else{
    
	$wherecase .= " and w.won_date>'" . date("Y-m-d H:i:s") . "'";
    }
    if ($quyenddate != '') {
        $wherecase.=" and w.won_date<'$enddate' ";
    }else{
	$wherecase .= " and w.won_date<'" . date("Y-m-d H:i:s") . "'";
    
    }
    if ($username != '') {
        $wherecase.=" and username like '$username%' ";
    }
    if ($order != '') {
        $wherecase .=" and (p.name like '$order%' or b.bidpack_name like '$order%') ";
    }
    $StartRow = $PRODUCTSPERPAGE * ($PageNo - 1);
    /*     * ******************************************** */
    if ($aucstatus != "") {
        if ($aucstatus == "1") {
            $query = "select a.auctionID,a.productID as productID, o.orderid as invoiceid, a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,username,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,w.userid,buynowprice,reverseauction,uniqueauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,w.id as wid,ss.id as ssid,accept_denied,won_date,accept_date,payment_date,order_status, ss.adddate as shipdate, ss.status as shippingstatus
        from won_auctions w left join auction a on w.auction_id=a.auctionID left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join registration r on r.id=w.userid left join shippingstatus ss on ss.orderid=w.id and ss.ordertype=1 left join payment_order_history on o.auction_id=w.auction_id
        where a.auc_status='3' and w.accept_denied='' $wherecase and w.userid != 0 order by w.won_date desc";
        } elseif ($aucstatus == "2") {
            $query = "select a.auctionID,a.productID as productID, o.orderid as invoiceid,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,username,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,w.userid,buynowprice,reverseauction,uniqueauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,w.id as wid,ss.id as ssid,accept_denied,won_date,accept_date,payment_date,order_status, ss.adddate as shipdate, ss.status as shippingstatus
        from won_auctions w left join auction a on w.auction_id=a.auctionID left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join registration r on r.id=w.userid left join shippingstatus ss on ss.orderid=w.id and ss.ordertype=1 left join payment_order_history o on o.auction_id=w.auction_id
        where a.auc_status='3' and w.accept_denied='Accepted' and payment_date='0000-00-00 00:00:00' $wherecase and w.userid != 0 order by w.accept_date desc";
        } elseif ($aucstatus == "3") {
            $query = "select a.auctionID,a.productID as productID, o.orderid as invoiceid,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,username,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,w.userid,buynowprice,reverseauction,uniqueauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,w.id as wid,ss.id as ssid,accept_denied,won_date,accept_date,payment_date,order_status, ss.adddate as shipdate, ss.status as shippingstatus
        from won_auctions w left join auction a on w.auction_id=a.auctionID left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join registration r on r.id=w.userid left join shippingstatus ss on ss.orderid=w.id and ss.ordertype=1 left join payment_order_history o on o.auction_id=w.auction_id
        where a.auc_status='3' and w.accept_denied='Accepted' and payment_date!='0000-00-00 00:00:00' $wherecase and w.userid != 0 order by w.payment_date desc";
        }
    } else {
        $query = "select a.auctionID,a.productID as productID, o.orderid as invoiceid,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,username,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,w.userid,buynowprice,reverseauction,uniqueauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,w.id as wid,ss.id as ssid,accept_denied,won_date,accept_date,payment_date,order_status, ss.adddate as shipdate, ss.status as shippingstatus
    from won_auctions w
    left join auction a on w.auction_id=a.auctionID left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID
    left join registration r on r.id=w.userid left join shippingstatus ss on ss.orderid=w.id and ss.ordertype=1 left join payment_order_history o on o.auction_id=w.auction_id
    where a.auc_status='3' $wherecase and w.userid != 0 order by w.won_date desc";
    }
    $result = db_query($query) or die(db_error());
    $totalrows = db_num_rows($result);
    $totalpages = ceil($totalrows / $PRODUCTSPERPAGE);
    $query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
    $result = db_query($query);
    $total = db_num_rows($result);
}

echo db_error();
$orderurldata="sdate=" .($startdate!=''?ChangeDateFormatSlash($startdate):'')  . "&edate=" . ($enddate!=''?ChangeDateFormatSlash($enddate):'') . "&username=" . $username . "&aucstatus=" . $aucstatus;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Sold Auction-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.core.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.datepicker.min.js"></script>
        <script type="text/javascript">
            function Check()
            {
                if(document.f1.datefrom.value=="")
                {
                    alert("Please select start date!!!");
                    return false;
                    document.f1.datefrom.focus();
                }
                if(document.f1.dateto.value=="")
                {
                    alert("Please select end date!!!");
                    return false;
                    document.f1.dateto.focus();
                }
            }

            function popwindow(url){
                window.open (url, 'user address', 'height=450,width=520, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no, status=no');
            }
            $(function() {
                $.datepicker.setDefaults({dateFormat:'<?php echo $globalDateformat=='d/m/Y'?'dd/mm/yy':'mm/dd/yy'; ?>'});
                $("#datefrom").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                $("#dateto").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
            });
            
  /*          	    function ajaxupdateshipping(id){
		    data = "trackingnumber=" + document.getElementById('trackingnumber[' + id + ']').value;
		    data += "&shippingtypeid=" + document.getElementById('shippingtypeid[' + id + ']').options[document.getElementById('shippingtypeid[' + id + ']').selectedIndex].value;
		  $.get('soldauction.php?submit=yes&orderid=' + id + '&' + data , function(response){
		  
		    document.getElementById('shipping_status[' + id +']').innerHTML = response;
		    });
	}
	
	
	    function ajaxshipping(id, type){
	     document.getElementById('shipping_status[' + id +']').innerHTML = 'Loading';
		$.get('soldauction.php?ordertype=' + type + '&orderid=' + id, // URL to the JSON script
				  function(result){
				  
				document.getElementById('shipping_status[' + id + ']').innerHTML = result;
				 
				  
				  
				  });
	    
	    
	    }*/
	    function ajaxupdateshipping(id){
		data = 'shippingtypeid=' + document.getElementById('shippingtypeid[' + id + ']').options[document.getElementById('shippingtypeid[' + id + ']').selectedIndex].value + '&shippingstatus=' + document.getElementById('shippingstatus[' + id + ']').options[document.getElementById('shippingstatus[' + id + ']').selectedIndex].value;
	 
	
		data += '&trackingnumber=' + document.getElementById('trackingnumber[' + id + ']').value;
	
		  $.ajax({
			  url: 'soldauction.php?submit=yes&orderid=' + id + '&' + data ,
			  type: 'get',
			  dataType: 'json',
			  success: function(response){
				alert('Shipping Has Been Set to ' + response.status);
			    $('#record' + id + ' span').css('color', response.color);
			    $('#record' + id + ' span').html(response.status);
			   // $('#shipping_status[' + id + ']').html(response.message);
			    document.getElementById('shipping_box[' + id + ']').innerHTML = response.message;
			}
		  });
	      }
	
	
	    function ajaxshipping(id, type){
	    
		$.get('soldauction.php?ordertype=' + type + '&orderid=' + id, // URL to the JSON script
				  function(result){
				      document.getElementById('shipping_box[' + id + ']').innerHTML = result;
				   });
	          }	    
        </script>
    </head>

    <body>
        <!--[if !IE]>start wrapper<![endif]-->
        <div id="wrapper">
            <!--[if !IE]>start head<![endif]-->
            <div id="head">
<?php include('include/header.php'); ?>
            </div>
            <!--[if !IE]>end head<![endif]-->

            <!--[if !IE]>start content<![endif]-->
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">
                    <div class="inner">
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Manage Sold Auction</h2>
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>
                            <!--[if !IE]>end title wrapper<![endif]-->
                            <!--[if !IE]>start section content<![endif]-->
                            <div class="section_content">
                                <!--[if !IE]>start section content top<![endif]-->
                                <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">
                                                    <div class="categoryorder">
                                                        <form id="f1" name="f1" onsubmit="return Check(this)" action="soldauction.php" method="post" class="search_form general_form">

                                                            <div class="forms">
                                                                <div class="row">
                                                                    <span style="float:left;margin-right:40px;">

                                                                        <span><a href="soldauction.php?<?php echo $orderurldata; ?>">All</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=A&<?php echo $orderurldata; ?>">A</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=B&<?php echo $orderurldata; ?>">B</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=C&<?php echo $orderurldata; ?>">C</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=D&<?php echo $orderurldata; ?>">D</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=E&<?php echo $orderurldata; ?>">E</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=F&<?php echo $orderurldata; ?>">F</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=G&<?php echo $orderurldata; ?>">G</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=H&<?php echo $orderurldata; ?>">H</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=I&<?php echo $orderurldata; ?>">I</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=J&<?php echo $orderurldata; ?>">J</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=K&<?php echo $orderurldata; ?>">K</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=L&<?php echo $orderurldata; ?>">L</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=M&<?php echo $orderurldata; ?>">M</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=N&<?php echo $orderurldata; ?>">N</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=O&<?php echo $orderurldata; ?>">O</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=P&<?php echo $orderurldata; ?>">P</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=Q&<?php echo $orderurldata; ?>">Q</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=R&<?php echo $orderurldata; ?>">R</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=S&<?php echo $orderurldata; ?>">S</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=T&<?php echo $orderurldata; ?>">T</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=U&<?php echo $orderurldata; ?>">U</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=V&<?php echo $orderurldata; ?>">V</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=W&<?php echo $orderurldata; ?>">W</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=X&<?php echo $orderurldata; ?>">X</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=Y&<?php echo $orderurldata; ?>">Y</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=Z&<?php echo $orderurldata; ?>">Z</a></span>

                                                                    </span>
                                                                    <span>
                                                                        <strong>Auction Sold Status:</strong>
                                                                        <select name="aucstatus">
                                                                            <option value="" <?php if ($aucstatus == "") { ?> selected="selected"<?php } ?>>All</option>
                                                                            <option value="1" <?php if ($aucstatus == "1") { ?> selected="selected"<?php } ?>>Waiting for acceptance</option>
                                                                            <option value="2" <?php if ($aucstatus == "2") { ?> selected="selected"<?php } ?>>Waiting for payment</option>
                                                                            <option value="3" <?php if ($aucstatus == "3") { ?> selected="selected"<?php } ?>>Completed</option>
                                                                        </select>

                                                                    </span>
                                                                </div>

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                   
                                                                       <?php include("datepickers.php"); ?>
                                                                       
                                                                   
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>User Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="username" value="<?= $username; ?>" size="8" />
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Search</span></span><input name="submit" type="submit"/></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <div class="clear"></div>


                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
<?php if ($total <= 0) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No Sold Auction To Display</strong></li>
                                                                </ul>
<?php } else { ?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="width:20px;text-align: center;">Record No</th>
                                                                            <th style="width:20px;text-align: center;">Invoice Id</th>
                                                                            <th style="width:20px;text-align: center;">Auction Id</th>
                                                                            <th>Auction Name</th>
                                                                          
                                                                            <th style="text-align:center;">Price</th>
                                                                            <th style="text-align:center;">Status</th>
                                                                            <th style="text-align:center;">Won Date</th>
                                                                            <th style="text-align:center;">Due</th>
                                                                            <th style="text-align:center;">Winner</th>
                                                                            <th style="text-align:center;">Shipping Status</th>
                                                                            <th style="text-align:center;">Shipping Data</th>
                                                                        </tr>
<?
    for ($i = 0; $i < $total; $i++) {
        if ($PageNo > 1) {
            $srno = ($PageNo - 1) * $PRODUCTSPERPAGE + $i + 1;
        } else {
            $srno = $i + 1;
        }

        $row = db_fetch_object($result);
        $id = $row->auctionID;
        $pname = $row->bidpack ? $row->bidpack_name : stripslashes($row->name);
        $fprice = $row->auc_final_price;
        $status = $row->accept_denied;
        $paymentdate = $row->payment_date;
        $won_date = $row->won_date;
        $accept_date = $row->accept_date;
        $winner = $row->username;
        $ssid = $row->ssid;
        $userid = $row->userid;
        $complete_date = $row->shipdate;
?>
                                                                        <tr class="<?php echo ($i % 2 != 0) ? 'first' : 'second'; ?>">
                                                                            <td style="text-align:center;"><?= $row->wid ?></td>
                                                                            <td><?php if(!empty($row->invoiceid)){
											echo $row->invoiceid; 
											}else{
											echo "not yet checked out";
											}
										?>
									    </td>
                                                                            <td><?php echo $row->auctionID; ?></td>
                                                                         
                                                                            <td><?= $pname ?></td>
                                                                            <td style="text-align:right;"><?= $fprice == "" ? "&nbsp" : $Currency . $fprice; ?></td>
                                                                            <td style="text-align:center;">
<?
                                                                        if ($status == "") {
                                                                        $status = "Waiting for Acceptance";
                                                                            echo "<font color=green>Waiting for Acceptance</font>";
                                                                        } elseif ($status == "Accepted") {
                                                                            if ($status == "Accepted" and $paymentdate == '0000-00-00 00:00:00') {
                                                                                echo "<font color=blue>Accepted Waiting<br>for payment</font>";
                                                                                $status = "Waiting Payment";
                                                                            } elseif ($status == "Accepted" and $paymentdate != '0000-00-00 00:00:00') {
                                                                                echo "<font color=blue>Completed</font>";
                                                                                $status = "Completed";
                                                                            } else {
                                                                                echo "<font color=green>Accepted</font>";
                                                                            }
                                                                        } elseif ($status == "Denied") {
                                                                            echo "<font color=red>Denied</font>";
                                                                            $status = "Denied";
                                                                        }
?>
                                                                            </td>

                                                                            <td style="text-align:center;">
<?php echo arrangedate(substr($won_date, 0, 10)) . " " . substr($won_date, 11); ?>
                                                                            </td>

                                                                            <td style="text-align:center;">
<?php
                                                                        if ($status == "") {
                                                                            echo $won_date == "0000-00-00 00:00:00" ? " " : arrangedate(substr($won_date, 0, 10)) . " " . substr($won_date, 11);
                                                                        } elseif ($status == "Accepted") {
                                                                            if ($status == "Accepted" and $paymentdate == '0000-00-00 00:00:00') {
                                                                                echo $accept_date == "0000-00-00 00:00:00" ? " " : arrangedate(substr($accept_date, 0, 10)) . " " . substr($accept_date, 11);
                                                                            } elseif ($status == "Accepted" and $paymentdate != '0000-00-00 00:00:00') {
                                                                                echo $paymentdate == "0000-00-00 00:00:00" ? " " : arrangedate(substr($paymentdate, 0, 10)) . " " . substr($paymentdate, 11);
                                                                            } else {
                                                                                echo $accept_date == "0000-00-00 00:00:00" ? " " : arrangedate(substr($accept_date, 0, 10)) . " " . substr($accept_date, 11);
                                                                            }
                                                                        } elseif ($status == "Completed") {
                                                                        echo $complete_date;
                                                                        
                                                                        } elseif ($status == "Denied") {
                                                                            echo "<font color=red>Denied</font>";
                                                                        }
?>
									  <?php
										
											  switch($row->shippingstatus){
											    case '':
											      $sstatus = "Not Shipped";
											      $color = 'red';
											    break;
											  
											    case '0':
											      $sstatus = "Not Shipped";
											      $color = 'red';
											    break;
											    case '1':
											      $sstatus = "Waiting Agent Pickup";
											      $color = 'orange';
											    break;
											    case '2':
											      $sstatus = "Shipped";
											      $color = 'blue';
											    break;
											    case '3':
											      $status = "Delivery Confirmed";
											      $color = 'green';
											    break;
											  }
											  
											    ?>                                                                           </td>

                                                                            <td style="text-align:center;"><a href="#" onclick="popwindow('useraddress.php?userid=<?php echo $userid; ?>');return false;"><?= $winner == "" ? "&nbsp" : $winner; ?></a></td>

<?php //if ($paymentdate != '0000-00-00 00:00:00') { 


switch($status){
case "Waiting Payment":
$sstatus = 'Not available yet';
 ?>
                                                                              <td>

										  <a id="record<?php echo $row->wid; ?>" title="addshippingstatus.php?id=<?php echo $row->wid; ?>&ordertype=2" href="javascript: ajaxshipping('<?php echo $row->wid; ?>', 1);"><span style="color:<?php echo $color;?>"><?php echo $sstatus; ?></span></a>

									    </td>
                                                                            <td style="text-align:left;list-style-type:none;">
                                                                                      <div id="shipping_status[<?php echo $row->wid; ?>]"  style="height:auto;min-width:220px;">
											  <div id="shipping_box[<?php echo $row->wid; ?>]"  style="height:auto;min-width:220px;">
									 <?php if (!empty($row->ssid)) { ?>
										 
                                                                                       <a href="javascript: ajaxshipping('<?php echo $row->wid; ?>', 2);" ><span class="greenfont" id="record<?php echo $row->wid; ?>" style="font-size:10px;">
                                                                                       <?php $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $row->wid . " and ordertype=1"));
                                                                                      
                                                                                       $resc = db_fetch_object(db_query("select * from shipping left join shippingtype st on st.id=shippingtypeid where  shipping.id = " . $trackingnumber->shippingtypeid ));
                                                                                     
                                                                                       
                                                                                       if($row->shippingstatus >= 1){ 
                                                                                      
                                                                                       echo "<ul style=\"list-type:none!important;list-style-type:none!important;\"";
                                                                                       echo ">";
                                                                                       echo "<li>" . $resc->shipping_title ."</li>";
                                                                                       echo "<li>" .$trackingnumber->tracknumber . "</li>";
                                                                                       echo "<li>" .$trackingnumber->adddate . "</li>";
                                                                                       echo "</ul>";
                                                                                       
                                                                                       ?>
                                                                                       
                                                                                       
                                                                                       <?php
                                                                                       if(!empty($resc->logoimage)){
                                                                                       ?>
											    <img src="../uploads/other/<?php echo $resc->logoimage;?>" style="max-height:35px;width:auto;" />
											  <?php }
											  }
											  ?>
										</span></a>
										  <?php } ?>
											  </div>
										      </div> 
									    </td>
                                                                                <?php
                                                                                
                break;

      case "Accepted":

 ?>
                                                                              <td>

										  <a id="record<?php echo $row->wid; ?>" title="addshippingstatus.php?id=<?php echo $row->wid; ?>&ordertype=2" href="javascript: ajaxshipping('<?php echo $row->wid; ?>', 1);"><span style="color:<?php echo $color;?>"><?php echo $sstatus; ?></span></a>

									    </td>
                                                                            <td style="text-align:left;list-style-type:none;">
                                                                                      <div id="shipping_status[<?php echo $row->wid; ?>]"  style="height:auto;min-width:220px;">
											  <div id="shipping_box[<?php echo $row->wid; ?>]"  style="height:auto;min-width:220px;">
									 <?php if (!empty($row->ssid)) { ?>
										 
                                                                                       <a href="javascript: ajaxshipping('<?php echo $row->wid; ?>', 2);" ><span class="greenfont" id="record<?php echo $row->wid; ?>" style="font-size:10px;">
                                                                                       <?php $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $row->wid . " and ordertype=1"));
                                                                                      
                                                                                       $resc = db_fetch_object(db_query("select * from shipping left join shippingtype st on st.id=shippingtypeid where  shipping.id = " . $trackingnumber->shippingtypeid ));
                                                                                     
                                                                                       
                                                                                       if($row->shippingstatus >= 1){ 
                                                                                      
                                                                                       echo "<ul style=\"list-type:none!important;list-style-type:none!important;\"";
                                                                                       echo ">";
                                                                                       echo "<li>" . $resc->shipping_title ."</li>";
                                                                                       echo "<li>" .$trackingnumber->tracknumber . "</li>";
                                                                                       echo "<li>" .$trackingnumber->adddate . "</li>";
                                                                                       echo "</ul>";
                                                                                       
                                                                                       ?>
                                                                                       
                                                                                       
                                                                                       <?php
                                                                                       if(!empty($resc->logoimage)){
                                                                                       ?>
											    <img src="../uploads/other/<?php echo $resc->logoimage;?>" style="max-height:35px;width:auto;" />
											  <?php }
											  }
											  ?>
										</span></a>
										  <?php } ?>
											  </div>
										      </div> 
									    </td>
                                                                                <?php
                                                                                
                break;
                case "Waiting for Acceptance":
                $sstatus = 'Not available yet';
                                                     ?>
                                                      <td style="text-align:left;list-style-type:none;">
                                                                                      
                                                                                       
                                                                                        <a id="record<?php echo $row->wid; ?>" title="addshippingstatus.php?id=<?php echo $row->wid; ?>&ordertype=2" href="javascript: ajaxshipping('<?php echo $row->wid; ?>', 1);"><span class="redfont" style="min-width:220px;"><?php echo $status; ?></span></a>
										</div>
									    </td>
									     <td>
										  <div id="shipping_status[<?php echo $row->wid; ?>]"  style="height:auto;min-width:220px;">
										      <div id="shipping_box[<?php echo $row->wid; ?>]"  style="height:auto;min-width:220px;">
										      </div>
										  </div>


								             </td>
                                                       <?php                         
                                                                                
		break;
                                                                                
               case "":
               
				 ?>
                                                                              <td>

										  <a id="record<?php echo $row->wid; ?>" title="addshippingstatus.php?id=<?php echo $row->wid; ?>&ordertype=2" href="javascript: ajaxshipping('<?php echo $row->wid; ?>', 1);"><span style="color:<?php echo $color;?>"><?php echo $sstatus; ?></span></a>

									    </td>
                                                                            <td style="text-align:left;list-style-type:none;">
                                                                                      <div id="shipping_status[<?php echo $row->wid; ?>]"  style="height:auto;min-width:220px;">
											  <div id="shipping_box[<?php echo $row->wid; ?>]"  style="height:auto;min-width:220px;">
									 <?php if (!empty($row->ssid)) { ?>
										 
                                                                                       <a href="javascript: ajaxshipping('<?php echo $row->wid; ?>', 2);" ><span class="greenfont" id="record<?php echo $row->wid; ?>" style="font-size:10px;">
                                                                                       <?php $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $row->wid . " and ordertype=1"));
                                                                                      
                                                                                       $resc = db_fetch_object(db_query("select * from shipping left join shippingtype st on st.id=shippingtypeid where  shipping.id = " . $trackingnumber->shippingtypeid ));
                                                                                     
                                                                                       
                                                                                       if($row->shippingstatus >= 1){ 
                                                                                      
                                                                                       echo "<ul style=\"list-type:none!important;list-style-type:none!important;\"";
                                                                                       echo ">";
                                                                                       echo "<li>" . $resc->shipping_title ."</li>";
                                                                                       echo "<li>" .$trackingnumber->tracknumber . "</li>";
                                                                                       echo "<li>" .$trackingnumber->adddate . "</li>";
                                                                                       echo "</ul>";
                                                                                       
                                                                                       ?>
                                                                                       
                                                                                       
                                                                                       <?php
                                                                                       if(!empty($resc->logoimage)){
                                                                                       ?>
											    <img src="../uploads/other/<?php echo $resc->logoimage;?>" style="max-height:35px;width:auto;" />
											  <?php }
											  }
											  ?>
										</span></a>
										  <?php } ?>
											  </div>
										      </div> 
									    </td>
                                                                                <?php
                                                                                
              break;
              case "Denied":
              
              
   				   ?>
                                                                              <td>

										  <a id="record<?php echo $row->wid; ?>" title="addshippingstatus.php?id=<?php echo $row->wid; ?>&ordertype=2" href="javascript: ajaxshipping('<?php echo $row->wid; ?>', 1);"><span style="color:<?php echo $color;?>"><?php echo $sstatus; ?></span></a>

									    </td>
                                                                            <td style="text-align:left;list-style-type:none;">
                                                                                      <div id="shipping_status[<?php echo $row->wid; ?>]"  style="height:auto;min-width:220px;">
											  <div id="shipping_box[<?php echo $row->wid; ?>]"  style="height:auto;min-width:220px;">
									 <?php if (!empty($row->ssid)) { ?>
										 
                                                                                       <a href="javascript: ajaxshipping('<?php echo $row->wid; ?>', 2);" ><span class="greenfont" id="record<?php echo $row->wid; ?>" style="font-size:10px;">
                                                                                       <?php $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $row->wid . " and ordertype=1"));
                                                                                      
                                                                                       $resc = db_fetch_object(db_query("select * from shipping left join shippingtype st on st.id=shippingtypeid where  shipping.id = " . $trackingnumber->shippingtypeid ));
                                                                                     
                                                                                       
                                                                                       if($row->shippingstatus >= 1){ 
                                                                                      
                                                                                       echo "<ul style=\"list-type:none!important;list-style-type:none!important;\"";
                                                                                       echo ">";
                                                                                       echo "<li>" . $resc->shipping_title ."</li>";
                                                                                       echo "<li>" .$trackingnumber->tracknumber . "</li>";
                                                                                       echo "<li>" .$trackingnumber->adddate . "</li>";
                                                                                       echo "</ul>";
                                                                                       
                                                                                       ?>
                                                                                       
                                                                                       
                                                                                       <?php
                                                                                       if(!empty($resc->logoimage)){
                                                                                       ?>
											    <img src="../uploads/other/<?php echo $resc->logoimage;?>" style="max-height:35px;width:auto;" />
											  <?php }
											  }
											  ?>
										</span></a>
										  <?php } ?>
											  </div>
										      </div> 
									    </td>
                                                                                <?php           
              
              
              break;
              case "Completed":
            
				
                                                                                ?>
                                                                              <td>

										  <a id="record<?php echo $row->wid; ?>" title="addshippingstatus.php?id=<?php echo $row->wid; ?>&ordertype=2" href="javascript: ajaxshipping('<?php echo $row->wid; ?>', 1);"><span style="color:<?php echo $color;?>"><?php echo $sstatus; ?></span></a>

									    </td>
                                                                            <td style="text-align:left;list-style-type:none;">
                                                                                      <div id="shipping_status[<?php echo $row->wid; ?>]"  style="height:auto;min-width:220px;">
											  <div id="shipping_box[<?php echo $row->wid; ?>]"  style="height:auto;min-width:220px;">
									 <?php if (!empty($row->ssid)) { ?>
										 
                                                                                       <a href="javascript: ajaxshipping('<?php echo $row->wid; ?>', 2);" ><span class="greenfont" id="record<?php echo $row->wid; ?>" style="font-size:10px;">
                                                                                       <?php $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $row->wid . " and ordertype=1"));
                                                                                      
                                                                                       $resc = db_fetch_object(db_query("select * from shipping left join shippingtype st on st.id=shippingtypeid where  shipping.id = " . $trackingnumber->shippingtypeid ));
                                                                                     
                                                                                       
                                                                                       if($row->shippingstatus >= 1){ 
                                                                                      
                                                                                       echo "<ul style=\"list-type:none!important;list-style-type:none!important;\"";
                                                                                       echo ">";
                                                                                       echo "<li>" . $resc->shipping_title ."</li>";
                                                                                       echo "<li>" .$trackingnumber->tracknumber . "</li>";
                                                                                       echo "<li>" .$trackingnumber->adddate . "</li>";
                                                                                       echo "</ul>";
                                                                                       
                                                                                       ?>
                                                                                       
                                                                                       
                                                                                       <?php
                                                                                       if(!empty($resc->logoimage)){
                                                                                       ?>
											    <img src="../uploads/other/<?php echo $resc->logoimage;?>" style="max-height:35px;width:auto;" />
											  <?php }
											  }
											  ?>
										</span></a>
										  <?php } ?>
											  </div>
										      </div> 
									    </td>
                                                                                <?php
                                                                                
                                      
              
              
              break;
                                                                                
                                                                                
                                                                                } ?>
                                                                                <?php //} ?>
                                                                           

                                                                        </tr>
<?php } ?>
                                                                    </tbody>
                                                                </table>
                                                                        <?php } ?>
                                                            </div>
                                                        </div>
                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                    </div>

<?php if ($total) { ?>
                                                                <!--[if !IE]>start pagination<![endif]-->
                                                                <div class="pagination">
                                                                    <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpages; ?></span>
                                                                                <ul class="pag_list">
<?php
                                                                            if ($PageNo > 1) {
                                                                                $PrevPageNo = $PageNo - 1;
?>
                                                                                        <li><a href="soldauction.php?<?php echo $urldata ?>&pgno=<?php echo $PrevPageNo; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                            <?php } ?>

                                                            <?php
                                                                            $pageFrom = $PageNo - 3 < 1 ? 1 : $PageNo - 3;
                                                                            $pageTo = $PageNo + 3 > $totalpages ? $totalpages : $PageNo + 3;
                                                                            for ($i = $pageFrom; $i <= $pageTo; $i++) {
                                                            ?>
                                                            <?php if ($i == $PageNo) {
 ?>
                                                                                    <li><a href="soldauction.php?<?php echo $urldata ?>&pgno=<?php echo $i; ?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                            <?php } else {
                                                            ?>
                                                                                    <li><a href="soldauction.php?<?php echo $urldata ?>&pgno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                            <?php
                                                                                }
                                                                            }
                                                            ?>
                                                            <?php
                                                                            if ($PageNo < $totalpages) {
                                                                                $NextPageNo = $PageNo + 1;
                                                            ?>
                                                                                <li><a href="soldauction.php?<?php echo $urldata ?>&pgno=<?php echo $NextPageNo; ?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                            <?php } ?>
                                                                        </ul>

                                                                    </div>
                                                                    <!--[if !IE]>end pagination<![endif]-->
<?php } ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--[if !IE]>end section content top<![endif]-->
                                            <!--[if !IE]>start section content bottom<![endif]-->
                                            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                            <!--[if !IE]>end section content bottom<![endif]-->

                                        </div>
                                        <!--[if !IE]>end section content<![endif]-->
                                    </div>
                                    <!--[if !IE]>end section<![endif]-->
                                </div>
                            </div>
                            <!--[if !IE]>end page<![endif]-->
                            <!--[if !IE]>start sidebar<![endif]-->
                            <div id="sidebar">
                                <div class="inner">
<?php include 'include/leftside.php' ?>
                                        </div>
                                    </div>
                                    <!--[if !IE]>end sidebar<![endif]-->

                                </div>
                                <!--[if !IE]>end content<![endif]-->

                            </div>
                            <!--[if !IE]>end wrapper<![endif]-->

                            <!--[if !IE]>start footer<![endif]-->
                            <div id="footer">
                                <div id="footer_inner">
<?php include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

    </body>
</html>

<?php
}
?>