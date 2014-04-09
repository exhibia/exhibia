<?php
ini_set('display_errors', 1);
session_start();
$active = "Payment";
include_once("config.inc.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");
include_once 'functions.php';
include_once '../data/paymentorder.php';
require_once '../data/userhelper.php';
require_once '../data/paymenthelper.php';
$PRODUCTSPERPAGE = 25;

if (!$_GET['pgno']) {
    $PageNo = 1;
} else {
    $PageNo = $_GET['pgno'];
}
$orderdb = new PaymentOrder(null);
$auction = '';

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    $orderid = $_REQUEST['orderid'];
    if ($action == 'process') {
        $userhelper = new UserHelper(null);
        $userhelper->processOrder($orderid);
        
    } else if ($action == 'delete') {
        $orderdb->delete($orderid);
    }
}

/* * ******************************************************************
  Get how many products  are to be displayed according to the  Events
 * ****************************************************************** */
$StartRow = $PRODUCTSPERPAGE * ($PageNo - 1);
/* * ******************************************** */
if(!empty($_REQUEST['limit'])){
$PRODUCTSPERPAGE = $_REQUEST['limit'];

}else{
$_REQUEST['limit'] = $PRODUCTSPERPAGE;
}

$totalrows = $orderdb->count('payment_order_history', $_REQUEST);
$totalpages = ceil($totalrows / $PRODUCTSPERPAGE);
$result = $orderdb->select($StartRow, $PRODUCTSPERPAGE, 'paid', $_REQUEST);
$total = db_num_rows($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Order-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.dialog.min.js"></script>
        <script type="text/javascript">

            function shipOrder(loc, id)
            {
                $.ajax({
			url: loc,
			type: 'get',
			dataType: 'html',
			success: function(response){
			
			    $('#shipping_' + id).html(response);
			}
		})
                return false;
            }

            function deleteOrder(loc){
                if(confirm("Are you sure you want to delete the order?"))
                {
                    window.location.href=loc;
                }
                return false;
            }
            function Submitform()
            {
                document.form1.submit();
            }
            
            //won auctions shipping functions
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
			    document.getElementById('shipping_status[' + id + ']').innerHTML = response.message;
			}
		  });
	   }
	
	  function ajaxshipping(id, type){
	    $.get('managebuynow.php?ordertype=' + type + '&orderid=' + id, // URL to the JSON script
				  function(result){
				      document.getElementById('shipping_status[' + id + ']').innerHTML = result;
				   });
	    
	    }
	
	      
	    //redemption and bingo shipping functions
	    function ajaxupdateshippingnormal(id, type){
		data = 'ordertype=' + type + '&shippingtypeid=' + document.getElementById('shippingtypeid[' + id + ']').options[document.getElementById('shippingtypeid[' + id + ']').selectedIndex].value + '&shippingstatus=' + document.getElementById('shippingstatus[' + id + ']').options[document.getElementById('shippingstatus[' + id + ']').selectedIndex].value;
	 
	 
		data += '&trackingnumber=' + document.getElementById('trackingnumber[' + id + ']').value;
	
		  $.get('basicshipping.php?bn=normal&submit=yes&orderid=' + id + '&' + data , function(response){
		
		   window.location.href = window.location.href;
		  });
	      }
	      
	      
	    function ajaxshipping_normal(id, type){
	    
		$.get('basicshipping.php?bn=normal&ordertype=' + type + '&orderid=' + id, // URL to the JSON script
				  function(result){
				      document.getElementById('shipping_status_p[' + id + ']').innerHTML = result;
				   });
	          }
	          
	          
	          
	    //Buy it now shipping functions
	    function ajaxupdateshippingbn(id){
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
			    document.getElementById('shipping_status_p[' + id + ']').innerHTML = response.message;
			}
		  });
	      }     
	          
	    function ajaxshippingbn(id, type){
	    
		$.get('managebuynow.php?bn=bn&ordertype=' + type + '&orderid=' + id, // URL to the JSON script
				  function(result){
				      document.getElementById('shipping_status_p[' + id + ']').innerHTML = result;
				   });
	          }
	    	
	
	    
	    function  get_user_page(url){
	    <?php
	    $admin_pass = db_fetch_array(db_query("select pass from admin"));
	    ?>
	    
	      var openDialog = function(element){

		  
		$('h25').css('border', '');
		$('.edit').css('background', '');
		$('.edit').css('background-image', '');
		//actually open the dialog
		$('#' + element).dialog('open');

	    };
	    $.get(url + '&ajax=set&admin_pass=<?php echo $admin_pass[0];?>', function(response){
	      response = response + '<link media="screen" rel="stylesheet" type="text/css" href="../css/myaccount.css"  />';
			  $("#user_info").html(response);
			  
			  $("#user_info").dialog({modal: true, width : 750, height: 600, autoOpen: false, buttons: { "Ok": function() { $(this).dialog("close"); } }});
			    
				openDialog('user_info');
			      
			}
		    );



	      }

           function delconfirm(loc)
            {
                if(confirm("Are you sure to delete this member?"))
                {
                    window.location.href=loc;
                }
                return false;
            }
            function Submitform()
            {
                document.form1.submit();
            }
            function EnterData()
            {
                if(document.searchuser.stext.value=="")
                {
                    alert("Please enter search text");
                    document.searchuser.stext.focus();
                    return false;
                }
            }

            function OpenPopup(url)
            {
                var recto = Number(document.getElementById('recto').value);
                var recfrom = Number(document.getElementById('recfrom').value);

                if(recfrom!="")
                {
                    if(recfrom>=recto)
                    {
                        alert("Record To value must be greater than Record From value!");
                        return false;
                    }
                }
                url = url + "&recfrom=" + recfrom + "&recto=" + recto;
                window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=100,height=100,screenX=300,screenY=350,top=300,left=350');

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
<div id="user_info"></div>
            <!--[if !IE]>start content<![endif]-->
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">
                    <div class="inner">
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Manage Order</h2>
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

                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                             <h2 style="margin-top:0px;">This is an advanced method for finding transactions of any kind. That have been paid for. You can select as many filters as you like and choose to filter them in a more intelligent way than on most other pages.</h2>
                                                            <form action="paidorders.php" method="post"  class="search_form general_form" >
                                                           
								
                                                                <fieldset>
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">
								 <table>
							      <tr>
								<td>
								    <?php
								    $text = array('id', 'orderid', 'itemid', 'itemname', 'userid', 'auction_id', 'datetime', 'itemdescription', 'shippingcharge', 'paymentway');
								    $result2 = db_query("SHOW COLUMNS FROM payment_order_history");
								    $r = 1;
								    while($fields = db_fetch_array($result2)){
								  
								    
								    
								      if(in_array($fields['Field'], $text)){
								      if($r == 6){
									  echo "</td><td>";
								      }else if($r == 11){
									  echo "</td></tr>";
								      
								      }
								      
									?>
									<div class="row">
										<label><?php echo ucfirst($fields['Field']); ?></label>
										<div class="inputs"  style="float:left;width:100px;">
										    <span class="input_wrapper blank">
										      <input type="text" name="o_<?php echo $fields['Field']; ?>" id="<?php echo $fields['Field']; ?>" value="<?php echo $_REQUEST['o_' . $fields['Field']]; ?>" />
										    </span>
										    </div>
										<div class="inputs" style="float:right;width:150px;">
										     <select id="o_<?php echo $fields['Field']; ?>_filter_with" name="o_<?php echo $fields['Field']; ?>_filter_with" style="margin-left:-150px;" >
											  <option value="equals" <?php if($_REQUEST['o_' . $fields['Field'] . '_filter_with'] == 'equals'){ echo 'selected'; } ?>>equals</option>
											  <option value="doesntequal" <?php if($_REQUEST['o_' . $fields['Field'] . '_filter_with'] == 'doesntequal'){ echo 'selected'; } ?>>doesn't equal</option>
											  <option value="like" <?php if($_REQUEST['o_' . $fields['Field'] . '_filter_with'] == 'like'){ echo 'selected'; } ?>>like</option>
											  <option value="gt" <?php if($_REQUEST['o_' . $fields['Field'] . '_filter_with'] == 'gt'){ echo 'selected'; } ?>>greater than</option>
											  <option value="lt" <?php if($_REQUEST['o_' . $fields['Field'] . '_filter_with'] == 'lt'){ echo 'selected'; } ?>>less than</option>
											  <option value="gtequal" <?php if($_REQUEST['o_' . $fields['Field'] . '_filter_with'] == 'gtequal'){ echo 'selected'; } ?>>greater than or equal</option>
											  <option value="ltequal" <?php if($_REQUEST['o_' . $fields['Field'] . '_filter_with'] == 'ltequal'){ echo 'selected'; } ?>>less than or equal</option>
										      </select>
										</div>
									</div>	
									<?php
									$r++;
								      }
								      
								      
								    }
								    ?>
								 <tr>
								  <td>
								<div class="row">
										<label>Number of results</label>
										<div class="inputs" style="display:inline-block;" style="display:inline;">
										    <span class="input_wrapper blank">
										      <input type="text" name="limit" id="limit" value="<?php echo $_REQUEST['limit']; ?>" />
										    </span>
										
										</div>
									</div>
								</td>
								<td>
								<div class="row">
										<label>Order</label>
										<div class="inputs" style="display:inline-block;" style="display:inline;">
										    <span class="input_wrapper blank" style="margin-right:30px;">
										      <select name="order" id="order">
											  <option value="asc" <?php if($_REQUEST['order'] == 'asc'){ echo 'selected'; } ?>>ascending</option>
											  <option value="desc" <?php if($_REQUEST['order'] == 'desc'){ echo 'selected'; } ?>>descending</option>
										      </select>
										    </span>
										    <span class="input_wrapper blank" style="margin-right:30px;">
										      <select name="order_by" id="order_by">
											  <option value="oid" <?php if($_REQUEST['order_by'] == 'asc'){ echo 'oid'; } ?>>database record</option>
											  <option value="o_datetime" <?php if($_REQUEST['order_by'] == 'o_datetime'){ echo 'selected'; } ?>>date</option>
											  <option value="r_username" <?php if($_REQUEST['order_by'] == 'r_username'){ echo 'selected'; } ?>>username</option>
											  <option value="r_id" <?php if($_REQUEST['order_by'] == 'r_id'){ echo 'selected'; } ?>>user id</option>
											  <option value="o_amount" <?php if($_REQUEST['order_by'] == 'o_amount'){ echo 'selected'; } ?>>amount</option>
											  <option value="o_itemname" <?php if($_REQUEST['order_by'] == 'o_itemname'){ echo 'selected'; } ?>>item name</option>
											  <option value="p_productID" <?php if($_REQUEST['order_by'] == 'p_productID'){ echo 'selected'; } ?>>product id</option>
											  <option value="c_categoryID" <?php if($_REQUEST['order_by'] == 'c_categoryID'){ echo 'selected'; } ?>>category id</option>
											  <option value="catname" <?php if($_REQUEST['order_by'] == 'catname'){ echo 'selected'; } ?>>category name</option>
											  <option value="o_paymentway" <?php if($_REQUEST['order_by'] == 'paymentway'){ echo 'selected'; } ?>>gateway</option>
											  <option value="o_payfor" <?php if($_REQUEST['order_by'] == 'payfor'){ echo 'selected'; } ?>>order type</option>
										      </select>
										    </span>
										</div>
									</div>
								</td>
								</tr>
								<tr>
								  <td  colspan="2">
								<div class="row">
										<label>Pay For</label>
										<div class="inputs" style="display:inline-block;" style="display:inline;">
										    <span class="input_wrapper blank"  style="margin-right:30px;">
										      <select name="o_payfor" id="o_payfor" >
										      <option value="" <?php if($_REQUEST['o_payfor'] == $row_p['payfor']){ echo 'selected'; } ?> ></option>
										      <?php
										      $sql_p = db_query("select distinct(payfor) from payment_order_history");
										      while($row_p = db_fetch_array($sql_p)){
										      
										      ?>
											<option value="<?php echo $row_p['payfor']; ?>" <?php if($_REQUEST['o_payfor'] == $row_p['payfor']){ echo 'selected'; } ?> ><?php echo $row_p['payfor']; ?></option>
										      <?php } ?>
										      </select>
										    </span>
										    </div>
										<div class="inputs" style="display:inline-block;" style="display:inline;">
										    <select id="o_payfor_filter_with" name="o_payfor_filter_with"  style="margin-left:-150px;">
											  <option value="equals" <?php if($_REQUEST['o_payfor_filter_with'] == 'equals'){ echo 'selected'; } ?>>equals</option>
											  <option value="doesntequal" <?php if($_REQUEST['o_payfor_filter_with'] == 'doesntequal'){ echo 'selected'; } ?>>doesn't equal</option>
											  <option value="like" <?php if($_REQUEST['o_payfor_filter_with'] == 'like'){ echo 'like'; } ?>>like</option>
										      </select>
										</div>
									</div>
								</td>
								</tr>
								<tr>
								  <td  colspan="2">
								<div class="row">
										<label>Username</label>
										<div class="inputs" style="display:inline-block;" style="display:inline;">
										    <span class="input_wrapper blank" style="margin-right:30px;">
										      <input type="text" name="r_username" id="r_username" value="<?php echo $_REQUEST['r_username']; ?>" />
										    </span>
										</div>
										<div class="inputs" style="display:inline-block;">
										    <select id="r_username_filter_with" name="r_username_filter_with"   style="margin-left:-150px;">
											  <option value="equals" <?php if($_REQUEST['r_username_filter_with'] == 'equals'){ echo 'selected'; } ?>>equals</option>
											  <option value="doesntequal" <?php if($_REQUEST['r_username_filter_with'] == 'doesntequal'){ echo 'selected'; } ?>>doesn't equal</option>
											  <option value="like" <?php if($_REQUEST['r_username_filter_with'] == 'like'){ echo 'like'; } ?>>like</option>
										      </select>
										</div>
									</div>
								</td>
								</tr>
								
								<tr>
								  <td colspan="2">
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
                                                                </div>
                                                                </td>
                                                                </tr>
                                                                </table>
                                                                </fieldset>
                                                                </form>
                                                                <br />
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
										<th>Record Id</th>
										<th>Invoice Id</th>
										<th>Live Id</th>
                                                                                <th>Item Name</th>
                                                                                <th>Category</th>
                                                                                <th>User Name</th>
                                                                                
                                                                                <th style="text-align: center;">Order Type</th>
                                                                                <th style="text-align: center;">Payment Way</th>
                                                                                <th style="text-align: center;">Order Time</th>
                                                                                <th style="text-align: center;">Amount</th>
                                                                                <th style="text-align: center;">Taxes</th>
                                                                                <th style="width:140px;text-align:center;">Action</th>
                                                                            </tr>
                                                                        <?php
                                                                        $total = 0;
                                                                        $ship_total = 0;
									$total_tax = 0;
									$total_bids = 0;
									$bingo_totals = array();
                                                                        while($row = db_fetch_array($result)){
                                                                        
                                                                        if(!in_array($row['orderid'], $order_ids)){
									  $order_ids[$row['id']] = $row['orderid'];
                                                                           
                                                                            $ordertime = $row['datetime'];
                                                                        ?>
                                                                            <tr class="<?php echo ($i % 2 != 0) ? 'first' : 'second'; ?>">
										
										<td><?php echo $row['oid']; ?></td>
										<td><?php echo $row['orderid']; ?></td>
										
										<?php if($row['payfor'] == 'wonauction' | $row['payfor'] == 'buyitnow'){ ?>
										<td><a href="addauction.php?auction_edit=<?php echo $row['auction_id']; ?>"><?php echo $row['auction_id']; ?></a></td>
										<?php }else if($row['payfor'] == 'buybid'){ ?>
										<td><a href="addbidpack.php?bidpack_edit=<?php echo $row['auction_id']; ?>"><?php echo $row['auction_id']; ?></a></td>
										
										<?php }else if($row['payfor'] == 'redemption'){ ?>
										<td><a href="addredemption.php?redemption_edit=<?php echo $row['auction_id']; ?>"><?php echo $row['auction_id']; ?></a></td>
										
										<?php }else if($row['payfor'] == 'Won Bingo'){ ?>
										<td>N/A</td>
										
										<?php } ?>
										
										<?php if($row['payfor'] == 'wonauction' | $row['payfor'] == 'buyitnow'){ ?>
                                                                                <td class="product_name"><a href="addproducts.php?product_edit=<?php echo $row['pid'];?>"><?php echo $row['itemname']; ?></a></td>
                                                                                
                                                                                
                                                                                <td class="product_name"><a href="addcategory.php?category_edit=<?php echo $row['cid'];?>"><?php echo $row['catname']; ?></a></td>
                                                                                
                                                                                
                                                                                <?php }else if($row['payfor'] == 'redemption'){
                                                                                $r_data = db_fetch_array(db_query("select c.name as catname, p.productID as pid, c.categoryID as cid from redemption left join products p on p.productID = redemption.product_id left join categories c on c.categoryID=redemption.category_id where redemption.id = $row[auction_id]"));
                                                                              
                                                                                ?>
                                                                                <td class="product_name"><a href="addproducts.php?product_edit=<?php echo $r_data['pid'];?>"><?php echo $row['itemname']; ?></a></td>
                                                                                
                                                                                
                                                                                <td class="product_name"><a href="addcategory.php?category_edit=<?php echo $r_data['cid'];?>"><?php echo $r_data['catname']; ?></a></td>
                                                                                
                                                                                
                                                                                <?php }else if($row['payfor'] == 'buybid'){ 
                                                                                
                                                                                ?>
                                                                                <td class="product_name"><a href="addbidpack.php?bidpack_edit=<?php echo $row['auction_id']; ?>"><?php echo $row['itemname']; ?></a></td>
                                                                                
                                                                                
                                                                                <td class="product_name"><a href="managebidpack.php">Bidpacks</a></td>
                                                                                
                                                                                <?php }
                                                                                else if($row['payfor'] == 'Won Bingo'){ 
                                                                               
                                                                                ?>
                                                                                <td class="product_name"><a href="addproducts.php?product_edit=<?php echo $row['itemid'];?>"><?php echo $row['itemname']; ?></a></td>
                                                                                
                                                                                
                                                                                <td class="product_name">
                                                                                <?php
                                                                                $cat = db_fetch_array(db_query("select categories.name as catname, categories.categoryID as cid from categories left join products p on p.categoryID=categories.categoryID where p.productID = $row[itemid]"));
                                                                                echo db_error();
                                                                                ?>
                                                                               
                                                                                <a href="addcategory.php?category_edit=<?php echo $cat['cid'];?>"><?php echo $cat['catname']; ?></a>
                                                                                 </td>
                                                                                <?php
                                                                                
                                                                                
                                                                                
                                                                                } ?>
                                                                            <td style="text-align:left;">
                                                                                <?php echo $row['username'] . "<br />"; ?>
                                                                                <div id="address_info_<?php echo $row['orderid']; ?>" style="display:none;">
                                                                                <?php echo $row['delivery_addressline1'] . " ".
                                                                                $row['delivery_addressline2'] . "<br />".
                                                                                $row['delivery_city'] . " ". 
                                                                                $row['delivery_state'] . ", ".
                                                                                $row['delivery_country'] . " ".
                                                                                $row['delivery_postcode'] . "<br />".
                                                                                $row['phoneno'] . "<br />";
                                                                                ?>
										</div>
                                                                                <div class="actions_menu">
                                                                                <ul style="list-type:none;">
                                                                                <li style="display:inline;">
                                                                                                <a name="Statistics" href="javascript:;" onclick="$('#address_info_<?php echo $row['orderid']; ?>').css('display', 'block');" ondblclick="$('#address_info_<?php echo $row['orderid']; ?>').css('display', 'none');"  title="Statistics">+</a>
                                                                                            </li>
                                                                                            <li style="display:inline;">
                                                                                                <a title="Edit"  class="edit" href="edit_member.php?editid=<?=$row['uid'];?>">&nbsp;</a>
                                                                                            </li>                                                                                            
                                                                                            <li style="display:inline;">
                                                                                                <a class="delete" name="button" onClick="return delconfirm('edit_member.php?delid=<?=$row['uid'];?>')" href="" title="Delete">&nbsp;</a>
                                                                                            </li>
                                                                                        
                                                                                            <li style="display:inline;">
                                                                                                <a name="Statistics" class="details" href="javascript: get_user_page('member_stats.php?uid=<?=$row['uid'];?>');" alt="Statistics" title="Statistics">&nbsp;</a>
                                                                                            </li>
                                                                                             <li>
                                                                                                <a name="re_sent" href="mailto:<?=$row['uemail'];?>">Send Email</a>
                                                                                            </li>
                                                                                </ul>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            <td style="text-align:center;">
                                                                            <a href="<?php 
                                                                            switch($row['payfor']){
										case 'buyitnow':
										  echo "managebuynow.php";
										break;
										case 'wonauction':
										  echo "soldauction.php";
										break;
										case 'redemption':
										  echo "soldredemption.php";
										break;
										case 'buybid':
										  echo "soldbidpacks.php";
										break;
										case 'Won Bingo':
										  echo "bingowinners.php";
										break;
                                                                            }
                                                                            
                                                                             
                                                                            
                                                                            
                                                                            ?>"><?php  echo $row['payfor']; ?></a></td>
                                                                            <td style="text-align:center;"><?php echo $row['paymentway']; ?></td>
                                                                            <td style="text-align:center;"><?php echo arrangedate(substr($ordertime, 0, 10)) . "&nbsp;" . substr($ordertime, 11); ?></td>
									    <td style="text-align:center;"><?php
									    
									    if($row['payfor'] != 'Won Bingo'){
									    $total = $row['amount'] + $total; echo $Currency . $row['amount']; 
									    }else{
										if(!array_key_exists($row['auction_id'], $bingo_totals)){  
									
										      $bingo_data = db_fetch_array(db_query("select * from bingo_games where id = $row[auction_id]"));
										      
										      $sql_u = db_query("select distinct(userid) from bingo_user_data where instance = $row[auction_id]");
									
											      $total_cards = 0;
										
											      while($row_u =db_fetch_array($sql_u)){
											
												    $count_cards = db_fetch_array(db_query("select count(distinct(card)) from bingo_user_data where instance = $row[auction_id] and userid=$row_u[userid]"));
												  
												    $total_cards = number_format($total_cards, 0, '', '') + number_format($count_cards[0], 0 , '', '');
												}
									      
										      echo $total_cards . " * " . $bingo_data['cost_per_card'] . ' =  ' . $total_cards * $bingo_data['cost_per_card'];
										      
										      $total_bids = $total_bids + ($total_cards * $bingo_data['cost_per_card']);
									    
										  $bingo_totals[$row['auction_id']] = $total_cards * $bingo_data['cost_per_card'];
									    
									    }else{
									    
										echo 'see above';
									    }
									    }
									    ?></td>
									    <td style="text-align:center;"><?php 
										if($row['payfor'] != 'Won Bingo'){ 
										if(empty($row['tax'])){
										$row['tax'] = 0.00;
										}
										if(empty($row['st_tax'])){
										$row['st_tax'] = 0.00;
										}
										    $total_tax = $total_tax + $row['tax'] + $row['st_tax']; 
										    echo $row['delivery_state'] . ' ' . $Currency . number_format($row['st_tax'], 2) . ' ' . $row['delivery_country'] . ' ' . $Currency. number_format($row['tax'], 2);
										}else{
										    echo 'N/A'; 
										}
										?>
									    <br />
									    <?php  ?>
									    </td>
                                                                            <td style="text-align:left;">
                                                                                <div class="actions_menu">
                                                                                   <ul>
                                                                                   <?php
                                                                                   if($row['payfor'] != 'buybid'){
                                                                                   if($row['payfor'] == 'buyitnow'){
                                                                                  $query_w = "select user_product.id, user_product.status as pstatus, ss.id as ssid,tracknumber,ss.status as shippingstatus, st.url as sturl,st.logoimage as stlogoimage from user_product left join shippingstatus ss on ss.orderid=user_product.id and ss.ordertype=2 left join shippingtype st on st.id=ss.shippingtypeid where userid = '$row[uid]' and productid = '$row[pid]' and price = '$row[amount]' and (buydate = '$row[datetime]' or productid = '$row[aid]') and ss.ordertype=2";
                                                                         $w_data = db_fetch_array(db_query($query_w));
										   echo db_error();
										    if(empty($w_data[0])){
										    
										    ?>
										    <span style="color:blue;font-size:9px;">Possible Corrupted Data / duplicate record</span>
										    <?php
										    }else{
										   
										
                                                                                   ?>
                                                                                    <div class="actions_menu" id="shipping_status_p[<?php echo $w_data[0]; ?>]" style="width:auto;min-width:220px;">
                                                                                    
                                                                                    <a href="javascript: ajaxshippingbn('<?php echo $w_data[0]; ?>', 2);" >
                                                                                    
                                                                                       <?php if (!empty($w_data['ssid']) & $w_data['shippingstatus'] >= 1) { ?>
										 
                                                                                        <span class="greenfont" id="record<?php echo $row['id']; ?>" style="font-size:10px;min-width:220px;">
                                                                                       <?php $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $w_data[0]));
                                                                                       
                                                                                       $resc = db_fetch_object(db_query("select * from shipping left join shippingtype st on st.id=shippingtypeid where  shipping.id = " . $trackingnumber->shippingtypeid ));
                                                                                     
                                                                                       
                                                                                       echo "" . $resc->shipping_title ."<br />";
                                                                                       echo "" .$trackingnumber->tracknumber . "<br />" . "" . $trackingnumber->adddate . "" .
                                                                                       $Currency . $resc->shippingcharge;
                                                                                       $ship_total = $ship_total + $resc->shippingcharge;
                                                                                       ?>
                                                                                       
                                                                                       </span>
                                                                                       <?php
                                                                                       if(!empty($resc->logoimage)){
                                                                                       ?><br />
											    <img src="../uploads/other/<?php echo $resc->logoimage;?>" style="max-height:35px;width:auto;" />
											  <?php } ?>
										  <?php } else {  ?>
										   
                                                                                        <div id="shipping_status[<?php echo $w_data['wid']; ?>]"  style="height:auto;min-width:220px;">
                                                                                        <a id="record<?php echo $w_data['wid']; ?>" title="addshippingstatus.php?id=<?php echo $w_data['wid']; ?>&ordertype=2" href="javascript: ajaxshippingbn('<?php echo $w_data[0]; ?>', 1);"><span class="redfont" style="min-width:220px;">NOT SHIPPED</span></a>
										</div> 
										                                                                                     
										                                                          
											 
										<?php }
										?>
											</a>
										      </div>
										<?php
										}
										}
                                                                                   else
                                                                                   if($row['payfor'] =='wonauction'){
                                                                                   $query_w = "select a.auctionID,a.productID as productID,a.categoryID as categoryID,  use_free,allowbuynow,userid,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,w.id as wid,ss.status as shippingstatus,ss.id as ssid,order_status from won_auctions w left join auction a on w.auction_id=a.auctionID left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join registration r on r.id=w.userid left join shippingstatus ss on ss.orderid=w.id and ss.ordertype=1 where w.auction_id='$row[auction_id]' and w.userid='$row[userid]'";
										   $w_data = db_fetch_array(db_query($query_w));
										 
										   
										   if($w_data['order_status'] == 0){
											
										 
				if(db_num_rows(db_query("select * from shippingstatus where orderid = " . $w_data['wid'])) >= 1){
					$trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $w_data['wid']));
                                                                                       
                                                                                       $resc = db_fetch_object(db_query("select * from shipping left join shippingtype st on st.id=shippingtypeid where  shipping.id = " . $trackingnumber->shippingtypeid ));
                                                                                  
				?>                                                                                       
				
									    <div id="shipping_status[<?php echo $w_data['wid']; ?>]" style="height:auto;width:auto;">
                                                                                        <a href="javascript: ajaxshipping('<?php echo $w_data['wid']; ?>', 2);" ><span class="greenfont" id="record<?php echo $w_data['wid']; ?>" style="font-size:10px;min-width:220px;">
                                                                                       <?php 
                                                                                       
                                                                                       echo "" . $resc->shipping_title ."<br />";
                                                                                       echo "" .$trackingnumber->tracknumber . "<br />" . "" . $trackingnumber->adddate . "<br />" . "" .
                                                                                       $Currency . $resc->shippingcharge;
                                                                                       $ship_total = $ship_total + $resc->shippingcharge;
                                                                                       
                                                                                       ?>
                                                                                       <?php
                                                                                       if(!empty($resc->logoimage)){
                                                                                       ?><br />
											    <img src="../uploads/other/<?php echo $resc->logoimage;?>" style="max-height:35px;width:auto;" />
											  <?php } ?>
                                                                                       </span></a>
                                                                                       </div>
                                <?php
									    
				
				
				}else{
                                                                                ?>
                                                                                 <div id="shipping_status[<?php echo $w_data['wid']; ?>]"  style="height:auto;min-width:220px;">
                                                                                        <a id="record<?php echo $w_data['wid']; ?>" title="addshippingstatus.php?id=<?php echo $w_data['wid']; ?>&ordertype=2" href="javascript: ajaxshipping('<?php echo $w_data['wid']; ?>', 1);"><span class="redfont" style="min-width:220px;">NOT SHIPPED</span></a>
										</div>     
                                                                                <?php
                                                                                
                                      }
					}					    
										    
										    }else if($row['payfor'] == 'redemption'){
										    ?>
										    <div id="shipping_status_p[<?php echo $row['oid']; ?>]"  style="height:auto;min-width:220px;">
                                                                                             <a id="record<?php echo $row['oid']; ?>" title="addshippingstatus.php?id=<?php echo $row['oid']; ?>&ordertype=6" href="javascript: ajaxshipping_normal('<?php echo $row['oid']; ?>', 6);">
                                                                                             
										    <?php
										    if(db_num_rows(db_query("select * from shippingstatus where ordertype = '6' and orderid = '$row[oid]'")) == 0 ){
											?>
											<span class="redfont" style="min-width:220px;">NOT SHIPPED</span>
											<?php
											}else{
											?>
											
                                                                                       <?php $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $row['oid'] . " and ordertype = 6"));
                                                                                       
                                                                                       $resc = db_fetch_object(db_query("select * from shipping left join shippingtype st on st.id=shippingtypeid where  shipping.id = " . $trackingnumber->shippingtypeid ));
                                                                                     
                                                                                       
                                                                                       echo "" . $resc->shipping_title ."<br />";
                                                                                       echo "" .$trackingnumber->tracknumber . "<br />" . "" . $trackingnumber->adddate . "<br />" . "" .
                                                                                       $Currency . $resc->shippingcharge;
                                                                                       $ship_total = $ship_total + $resc->shippingcharge;
                                                                                       
                                                                                       ?>
                                                                                        <?php
                                                                                       if(!empty($resc->logoimage)){
                                                                                       ?><br />
											    <img src="../uploads/other/<?php echo $resc->logoimage;?>" style="max-height:35px;width:auto;" />
											  <?php } ?>
                                                                                       
                                                                                       <?php
											}
											
											?>
											</a>
											</div> 
											<?php
										    }else if($row['payfor'] == 'Won Bingo'){
										    ?>
										    <div id="shipping_status_p[<?php echo $row['oid']; ?>]"  style="height:auto;min-width:220px;">
                                                                                             <a id="record<?php echo $row['oid']; ?>" title="addshippingstatus.php?id=<?php echo $row['oid']; ?>&ordertype=7" href="javascript: ajaxshipping_normal('<?php echo $row['oid']; ?>', 7);">
                                                                                             
										    <?php
										    if(db_num_rows(db_query("select * from shippingstatus where ordertype = '7' and orderid = '$row[oid]'")) == 0 ){
											?>
											<span class="redfont" style="min-width:220px;">NOT SHIPPED</span>
											<?php
											}else{
											?>
											
                                                                                       <?php $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $row['oid'] . " and ordertype = 7"));
                                                                                       
                                                                                       $resc = db_fetch_object(db_query("select * from shipping left join shippingtype st on st.id=shippingtypeid where  shipping.id = " . $trackingnumber->shippingtypeid ));
                                                                                     
                                                                                       
                                                                                       echo "" . $resc->shipping_title ."<br />";
                                                                                       echo "" .$trackingnumber->tracknumber . "<br />" . "" . $trackingnumber->adddate . "<br />" . "" .
                                                                                       $Currency . $resc->shippingcharge;
                                                                                   
                                                                                       
                                                                                       ?>
                                                                                        <?php
                                                                                       if(!empty($resc->logoimage)){
                                                                                       ?><br />
											    <img src="../uploads/other/<?php echo $resc->logoimage;?>" style="max-height:35px;width:auto;" />
											  <?php } ?>
                                                                                       
                                                                                       <?php
											}
											
											?>
											</a>
											</div> 
											<?php
										    
										    }
                                                                                   
                                                                                   }else{ 
                                                                             
											      if(db_num_rows(db_query("select * from bid_account where user_id = '$row[userid]' and bidpack_id = '$row[itemid]' and bidpack_buy_date = '$row[datetime]'")) == 0){

											      ?>
												  <li style="color:red;">Failed. check your payment gateway's website for possible reasons</li>
											      
											      
											      <?php }else{
											      ?>
												  <li style="color:green;">Complete</li>
											      
											      
											      <?php
											      
											      
											      }
                                                                                    echo db_error();
                                                                                    
                                                                                    }
                                                                                    ?>
                                                                                    </ul>
                                                                                    
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <?php } 
                                                                        
                                                                        }
                                                                        ?>
                                                                        <tr>
									  <td colspan="8">
									  <h3>Totals:</h3>
									  </td>
									 
									  
									   <td>
									    <h4>Sub total: <?php echo $Currency . number_format($total - $ship_total - $total_tax, 2); ?></h4>
									  
									  </td>
									  
									   <td>
									    <h4>Shipping: <?php echo $Currency . number_format($ship_total, 2); ?></h4>
									  
									  </td>
									  <td>
									    <h4>Taxes: <?php echo $Currency . number_format($total_tax, 2); ?></h4>
									  
									  </td>
									  
									   <td>
									    <h4>Total: <?php echo $Currency . number_format($total, 2); ?></h4>
									  
									  </td>
									
									 </tbody>
                                                                    </table>  
                                                                       
                                                                <?php 
								      
                                                                
                                                                }
                                                                ?>
								      
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end table_wrapper<![endif]-->
                                                            </div>

                                                    <?php if ($total) {
                                                    ?>
                                                                            <!--[if !IE]>start pagination<![endif]-->
                                                                            <div class="pagination">
                                                                                <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpages; ?></span>
                                                                                <ul class="pag_list">
                                                            <?php
                                                                            if ($PageNo > 1) {
                                                                                $PrevPageNo = $PageNo - 1;
                                                            ?>
                                                                                <li><a href="paidorders.php?pgno=<?php echo $PrevPageNo; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                            <?php } ?>

                                                            <?php
                                                                            $pageFrom = $PageNo - 3 < 1 ? 1 : $PageNo - 3;
                                                                            $pageTo = $PageNo + 3 > $totalpages ? $totalpages : $PageNo + 3;
                                                                            for ($i = $pageFrom; $i <= $pageTo; $i++) {
                                                            ?>
                                                            <?php if ($i == $PageNo) {
                                                            ?>
                                                                                    <li><a href="paidorders.php?pgno=<?php echo $i; ?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                            <?php } else {
                                                            ?>
                                                                                    <li><a href="paidorders.php?pgno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                            <?php
                                                                                }
                                                                            }
                                                            ?>
                                                            <?php
                                                                            if ($PageNo < $totalpages) {
                                                                                $NextPageNo = $PageNo + 1;
                                                            ?>
                                                                                <li><a href="paidorders.php?pgno=<?php echo $NextPageNo; ?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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