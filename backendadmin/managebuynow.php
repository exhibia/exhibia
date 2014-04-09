<?php
ini_set('display_errors', 1);
session_start();
$active = "Payment";
include_once("config.inc.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");
include_once 'functions.php';
include("../common/constvariable.php");
include_once '../data/userproduct.php';
include_once '../data/emailtemplate.php';
include_once("../Functions/SendWinnerMail.php");


@db_query("alter table user_product add column record_id int(22) not null");
@db_query("alter table user_product add column invoiceid varchar(200) not null");

if(empty($_REQUEST['datefrom'])){
$startdate = date($globalDateformat, strtotime('-7 Days'));
}
if(empty($_REQUEST['dateto'])){
$enddate = date($globalDateformat, time());
}
if(!empty($_GET['orderid'])){
    if(!empty($_REQUEST['submit'])){
    header("content-type: application/json");
    
    $qrysel = "select up.id as id,invoiceid,p.name,up.price,up.buydate,up.status,up.price,userid,up.productid,r.username,ss.id as ssid,tracknumber,st.url as sturl,st.logoimage as stlogoimage, p.picture1, p.short_desc from user_product up left join registration r on up.userid=r.id left join products p on p.productID=up.productid left join shippingstatus ss on ss.orderid=up.id and ss.ordertype=2 left join shippingtype st on st.id=ss.shippingtypeid where up.id !='' and up.productid != '' and up.id = $_REQUEST[orderid]";
    $user_data = db_fetch_object(db_query($qrysel));
   

    ?><?php
      db_query("update user_product set status = 1 where id = $_GET[orderid];");
     // db_query("update shippingstatus set status = '2' where id = $_GET[orderid]");
     
	    if(db_num_rows(db_query("select orderid from shippingstatus  where orderid = '$_GET[orderid]'")) == 0){
	    
	    
	      db_query("insert into shippingstatus values(null, '" . urldecode($_GET['shippingtypeid']) . "', '$_GET[orderid]', '2', '" . urldecode($_GET['trackingnumber']) ."', NOW(), '$_GET[shippingstatus]');");
	      
		  
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
                 $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $_GET['orderid'] . " and ordertype=2"));
                 $resc = db_fetch_object(db_query("select shipping_title, st.logoimage, st.name,st.id as stid, shippingcharge, st.url from shipping left join shippingtype st on st.id = shipping.shippingtypeid where shipping.id = " . $trackingnumber->shippingtypeid ));
                echo db_error();
                
                  $str = "<ul style='list-type:none;'>";
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
	   
	  db_query("update shippingstatus set adddate = NOW(), tracknumber = '" . urldecode($_GET['trackingnumber']) ."', shippingtypeid = '" . urldecode($_GET['shippingtypeid']) . "', ordertype = '2', status=$_GET[shippingstatus] where orderid = '$_GET[orderid]'" . " and ordertype=2");
	      
	      
	      
		
                                                                                       
                 
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
                
                $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $_GET['orderid'] . " and ordertype=2"));
                 $resc = db_fetch_object(db_query("select shipping_title, st.logoimage, st.name,st.id as stid, shippingcharge, st.url from shipping left join shippingtype st on st.id = shipping.shippingtypeid where shipping.id = " . $trackingnumber->shippingtypeid ));
                echo db_error();
                
                  $str = "<ul style='list-type:none;'>";
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
      ?><?php
      exit;
    }else{
        $row = db_fetch_object(db_query("select * from shippingstatus where orderid = '$_GET[orderid]'"));
      ?>
	<span style="position:relative;width:180px;">
		<form id="form[<?php echo $_GET['orderid']?>]" name="form[<?php echo $_GET['orderid']?>]">
			<ul>
								    
			   <li>Provider:</li>
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
			   <li>Tracking Number:</li>
			   <li class="clear"></li>
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
exit;
    }
}else{
	      $PRODUCTSPERPAGE = 10;

	      if (!$_GET['pgno']) {
		  $PageNo = 1;
	      } else {
		  $PageNo = $_GET['pgno'];
	      }
	      //set the status of the user product.
	      if (isset($_REQUEST['sent'])) {
		  $sendid = $_REQUEST['sent'];
		  $updb = new UserProduct(null);
		  $updb->setStatus($sendid, 2);
	      }
	      if ($_POST["submit"] != "" || $_GET["sdate"] != "") {
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

		  $status=$_REQUEST['status'];

		  $urldata = "sdate=" . ChangeDateFormatSlash($startdate) . "&edate=" . ChangeDateFormatSlash($enddate) . "&username=" . $username . "&status=" . $status;
		  $wherecase = " where up.id != '' ";
		  $wherecase .= " and up.productid!='' ";
		  if ($startdate != '') {
		      $wherecase.=" and up.buydate>'$startdate' ";
		  }
		  if ($quyenddate != '') {
		      $wherecase.=" and up.buydate<'$quyenddate' ";
		  }
		  if ($username != '') {
		      $wherecase.=" and r.username like '$username%' ";
		  }
		 if ($status != 'all') {
		    
		      $wherecase .=" and ss.status = '$status' ";
		    
		  }


  
            $qrysel="select up.id as id,invoiceid, p.name, up.price,up.buydate,up.status,up.price,up.userid,up.productid,r.username,ss.id as ssid,tracknumber,st.url as sturl,st.logoimage as stlogoimage, ss.status as shippingstatus, p.picture1, p.short_desc from user_product up left join registration r on up.userid=r.id left join products p on p.productID=up.productid left join shippingstatus ss on ss.orderid=up.id and ss.ordertype=2 left join shippingtype st on st.id=ss.shippingtypeid left join payment_order_history o on o.datetime=up.buydate and up.userid=o.userid and up.productid=o.itemid $wherecase and p.name != '' and up.id !='' and up.productid != '' order by up.buydate desc";
     



		  $ressel = db_query($qrysel);
		  $total = db_num_rows($ressel);
		  echo db_error();
		  $totalnumrows = $total;
		  $totalpage = ceil($total / $PRODUCTSPERPAGE);

		  if ($totalpage >= 1) {
		      $startrow = $PRODUCTSPERPAGE * ($PageNo - 1);
		      $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
		      $ressel = db_query($qrysel);
		      $total = db_num_rows($ressel);
		  }
	      }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Buy Now-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.core.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.datepicker.min.js"></script>
        <script type="text/javascript">
        
	    function edit_invoice_id(id, table, pointer){
		$.ajax({
		      url: 'edit_invoice.php?',
		      data: { "table" : table, "id" : id, "pointer" : pointer },
		      type: 'get',
		      dataType: 'html',
		      success: function(response){
		      
			$('#invoice_' + id).html(response);
		      
		      }
		      
		      })
	    
	    }
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

            function sentconfirm(loc)
            {
                if(confirm("Are you sure the product was sent to user?"))
                {
                    window.location.href=loc;
                }
                return false;
            }
            function Submitform()
            {
                document.form1.submit();
            }
            $(function() {
                $.datepicker.setDefaults({dateFormat:'<?php echo $globalDateformat == 'd/m/Y' ? 'dd/mm/yy' : 'mm/dd/yy'; ?>'});
                $("#datefrom").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                $("#dateto").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
            });
	    function ajaxupdateshipping(id){
		data = 'shippingtypeid=' + document.getElementById('shippingtypeid[' + id + ']').options[document.getElementById('shippingtypeid[' + id + ']').selectedIndex].value + '&shippingstatus=' + document.getElementById('shippingstatus[' + id + ']').options[document.getElementById('shippingstatus[' + id + ']').selectedIndex].value;
	 
	
		data += '&trackingnumber=' + document.getElementById('trackingnumber[' + id + ']').value;
	
		  $.ajax({
			  url: 'managebuynow.php?submit=yes&orderid=' + id + '&' + data ,
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
	    
		$.get('managebuynow.php?ordertype=' + type + '&orderid=' + id, // URL to the JSON script
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
                                <h2>Manage Buy Now</h2>
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
                                                        <form id="f1" name="f1" action="managebuynow.php" method="post" onsubmit="return Check(this)" class="search_form general_form">
                                                            <div class="forms">
                                                                <div class="row">
                                                            <span>
                                                                <strong>Status:</strong>
                                                                <select name="status">
								    <option value="all" <?php if ($status == "all") { ?> selected<?php } ?>>All</option>
								    
                                                                    <option value="0" <?php if ($status == "") { ?> selected<?php } ?>>Unsent</option>
                                                                    <option value="1" <?php if ($status == "1") { ?> selected<?php } ?>>Waiting Agent Pickup</option>
                                                                    <option value="2" <?php if ($status == "2") { ?> selected<?php } ?>>Sent Product</option>
                                                                    <option value="3" <?php if ($status == "3") { ?> selected<?php } ?>>Delivery Confirmed</option>
                                                                </select>
                                                            </span>
                                                                </div>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Please Select Date:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <input type="text" name="datefrom" id="datefrom" size="12" value="<?= $startdate != "" ? ChangeDateFormatSlash($startdate) : ""; ?>"/>
                                                                            <strong>&nbsp;To&nbsp;</strong>
                                                                            <input type="text" name="dateto" size="12" id="dateto" value="<?= $enddate != "" ? ChangeDateFormatSlash($enddate) : ""; ?>"/>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>User Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="username" id="username" value="<?= $username; ?>" size="8" />
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
                                                    </div><div class="clear"></div>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
							    <?php if ($total <= 0) {
							    ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No Order To Display</strong></li>
                                                                </ul>
							    <?php } else {
							    ?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
									    <th>Database ID</th>
									    <th>Invoice ID</th>
                                                                            <th>Product</th>
                                                                            <th>User</th>
                                                                            <th style="text-align: center;">Price</th>
                                                                            <th style="text-align: center;">Buy Date</th>
                                                                            <th style="text-align: center;">Status</th>
                                                                            <th style="width:140px;text-align:center;">Action</th>
                                                                        </tr>
								      <?php
									  for ($i = 0; $i < $total; $i++) {
									      $row = db_fetch_object($ressel);
									      $datetime = $row->buydate;
								      ?>
                                                                        <tr class="<?php echo ($i % 2 != 0) ? 'first' : 'second'; ?>">
									    <?php
									    
									    
									    
									    ?>
									    <td><?php echo $row->id; ?></td>
									    <td id="invoice_<?php echo $row->invoiceid; ?>"><?php echo $row->invoiceid; ?>
									    <?php if(empty($row->invoiceid)){
										echo "product bought with older version of software";
									    }
									    ?>
									    </td>
                                                                            <td class="product_name"><a href="productdetail.php?productid=<?php echo $row->productid; ?>"><?php echo $row->name; ?></a></td>
                                                                            <td class="product_name"><a href="userdetail.php?userid=<?php echo $row->userid; ?>"><?php echo $row->username; ?></a></td>
                                                                            <td style="text-align:center;"><?php echo $Currency . $row->price; ?></td>
                                                                            <td style="text-align:center;"><?php echo arrangedate(substr($datetime, 0, 10)) . "&nbsp;" . substr($datetime, 11); ?></td>
                                                                            <td style="text-align:center;" id="status[<?php echo $row->id; ?>]">
									      
                                                                                        <a id="record<?php echo $row->id; ?>" title="addshippingstatus.php?id=<?php echo $row->id; ?>&ordertype=2" href="javascript: ajaxshipping('<?php echo $row->id; ?>', 1);">
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
											  
											    ?>
												<span style="color:<?php echo $color;?>;"><?php echo $sstatus; ?></span>
											  
									    
											  </a>
                                                                            </td>
																											    <td align="left" style="width:auto;min-width:220px;">
                                                                                <div class="actions_menu" id="shipping_status[<?php echo $row->id; ?>]" style="width:auto;min-width:220px;">
                                                                                    <div id="shipping_box[<?php echo $row->id; ?>]" style="height:auto;width:auto;">                                                                                          
										<?php if (!empty($row->ssid)) { ?>
										 
                                                                                        <a href="javascript: ajaxshipping('<?php echo $row->id; ?>', 2);" ><span class="greenfont" id="record<?php echo $row->id; ?>" style="font-size:10px;min-width:220px;">
                                                                                       <?php $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $row->id));
                                                                                       
                                                                                       $resc = db_fetch_object(db_query("select * from shipping left join shippingtype st on st.id=shippingtypeid where  shipping.id = " . $trackingnumber->shippingtypeid ));
                                                                                     
                                                                                       echo "<ul style=\"list-type:none;\"";
                                                                                       if($resc->shippingstatus == 0){ 
                                                                                       echo " style=\"color:red;\"";
                                                                                       }
                                                                                       echo ">";
                                                                                       echo "<li>" . $resc->shipping_title ."</li>";
                                                                                       echo "<li>" .$trackingnumber->tracknumber . "</li>";
                                                                                       echo "<li>" .$trackingnumber->adddate . "</li>";
                                                                                       echo "</ul>";
                                                                                       
                                                                                       ?>
                                                                                       
                                                                                       </span></a>
                                                                                       <?php
                                                                                       if(!empty($resc->logoimage)){
                                                                                       ?>
											    <img src="../uploads/other/<?php echo $resc->logoimage;?>" style="max-height:35px;width:auto;" />
											  <?php } ?>
										  <?php }else{
										  ?>
										   <a href="javascript: ajaxshipping('<?php echo $row->id; ?>', 2);" ><span class="greenfont" id="record<?php echo $row->id; ?>" style="font-size:10px;min-width:220px;"></a>
										  <?php
										  }
										
										   ?>
										</div>                                                                             
											 
										


                                                                                  
                                                                                </div>
                                                                            </td>
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
                                                                        <li><a href="managebuynow.php?<?php echo $urldata; ?>&pgno=<?php echo $PrevPageNo; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
								<?php } ?>

								<?php
                                                                    $pageFrom = $PageNo - 3 < 1 ? 1 : $PageNo - 3;
                                                                    $pageTo = $PageNo + 3 > $totalpages ? $totalpages : $PageNo + 3;
                                                                    for ($i = $pageFrom; $i <= $pageTo; $i++) {
								 ?>
                                                            <?php if ($i == $PageNo) { ?>
                                                                            <li><a href="managebuynow.php?<?php echo $urldata; ?>&pgno=<?php echo $i; ?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                            <?php } else { ?>
                                                                            <li><a href="managebuynow.php?<?php echo $urldata; ?>&pgno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                            <?php
                                                                        }
                                                                    }
                                                            ?>
                                                            <?php
                                                                    if ($PageNo < $totalpages) {
                                                                        $NextPageNo = $PageNo + 1;
                                                            ?>
                                                                        <li><a href="managebuynow.php?<?php echo $urldata; ?>&pgno=<?php echo $NextPageNo; ?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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