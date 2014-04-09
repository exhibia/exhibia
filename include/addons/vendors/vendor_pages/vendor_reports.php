<?php

if(!empty($_GET['change_status'])){

    include("../../../../config/connect.php");
    if(db_query("update auction set auc_status = '$_GET[status]' where auctionID = $_GET[aid]")){
    
    switch($_GET['status']){
    
    
	case '7':
	echo "Product has been marked as used";
	//db_query("update auction set auc_status = '4' where auctionID = $_GET[aid]");
	mail($adminemailadd, $adminemailadd, 'Vendor Reports', "Attention a Vendor just marked auction Id => $aid as having been redeemed");
	break;
	case '5':
	echo "Vendor has been marked as Unpaid";
	break;
	case '6':
	echo "Vendor has been marked as Paid";
	
	break;
    
    
    }
}else{


echo db_error();
}


die();
}
//if($_POST["submit"]!="") {

    if(!$_GET['pgno']) {
        $PageNo = 1;
    }
    else {
        $PageNo = $_GET['pgno'];
    }

    if($_POST["datefrom"]!="") {
        $startdate = ChangeDateFormat($_POST["datefrom"]);
        $enddate = ChangeDateFormat($_POST["dateto"]);
        $product = $_POST["products"];
       
    }
    else {
        $startdate = ChangeDateFormat($_GET["sdate"]);
        $enddate = ChangeDateFormat($_GET["edate"]);
        $auctionstatus = $_GET["stat"];
        $product = $_GET["prod"];
    }
    if(!empty($_REQUEST["auctionstatus"])){
     $auctionstatus = $_REQUEST["auctionstatus"];
     }
     
     
    $urldata = "sdate=".ChangeDateFormatSlash($startdate)."&edate=".ChangeDateFormatSlash($enddate)."&stat=".$auctionstatus."&prod=".$product;

    if($auctionstatus!="") {
        if($auctionstatus=="1") {
            $qrysel = "select * from auction a left join products p on a.productID=p.productID left join payment_order_history as po on po.itemid=a.auctionID left join registration r on r.id=wa.userid where po.orderid != '' ";
            
		if($startdate!= '--'){
		$qrysel .= " and a.auc_start_date>='$startdate' ";
		
		}
		if($enddate != '--'){
		$qrysel .= " and auc_end_date<='$enddate' ";
		}
		if(!empty($product)){
		$qrysel .= " and a.productID='$product' ";
		
		}
		
		$qrysel .= " and a.auc_status='2'";
        }else if($auctionstatus=="7" & $_SESSION['UsErOfAdMiN'] == 'admin') {
	    $qrysel = "select * from auction a left join won_auctions as wa on wa.auction_id=a.auctionID left join products p on a.productID=p.productID left join payment_order_history as po on po.itemid=a.auctionID left join registration r on r.id=wa.userid where po.orderid != '' ";
            
		if($startdate!= '--'){
		$qrysel .= " and a.auc_start_date>='$startdate' ";
		
		}
		if($enddate != '--'){
		$qrysel .= " and auc_end_date<='$enddate' ";
		}
		if(!empty($product)){
		$qrysel .= " and a.productID='$product' ";
		
		}
		
		$qrysel .= " and a.auc_status = '7' ";
        
        
        
        }
        else {
            $qrysel = "select * from auction a left join products p on a.productID=p.productID left join won_auctions wa on wa.auction_id=a.auctionID left join payment_order_history as po on po.itemid=a.auctionID left join registration r on r.id=wa.userid where wa.userid != '0' ";
           
            if($startdate!= '--'){
		$qrysel .= " and a.auc_start_date>='$startdate' ";
		
		}
		if($enddate != '--'){
		$qrysel .= " and auc_end_date<='$enddate' ";
		}
		if(!empty($product)){
		$qrysel .= " and a.productID='$product' ";
		
		}
		
		$qrysel .= " and a.auc_status='$auctionstatus'";
		
		
        }
        
        if(!empty($_REQUEST['auction_id'])){
        
        $qrysel .= " and a.auctionID = " . $_REQUEST['auction_id'];
        
        }
	if(!empty($_REQUEST['products']) & $_REQUEST['products'] != 'none'){
        
        $qrysel .= " and a.productID = " . $_REQUEST['products'] . " ";
        
        }
    }else{
   if(!empty($_REQUEST['auction_id'])){
    
    $qrysel = "select * from auction a left join products p on a.productID=p.productID left join won_auctions wa on wa.auction_id=a.auctionID left join payment_order_history as po on po.itemid=a.auctionID left join registration r on r.id=wa.userid where wa.userid != '0' and a.auctionID = '$_REQUEST[auction_id]' ";
    
    if($startdate!= '--'){
		$qrysel .= " and a.auc_start_date>='$startdate' ";
		
		}
		if($enddate != '--'){
		$qrysel .= " and auc_end_date<='$enddate' ";
		}
		if(!empty($product)){
		$qrysel .= " and a.productID='$product' ";
		
		}
    
    }
    else {
        $qrysel = "select * from auction a left join products p on a.productID=p.productID left join won_auctions wa on wa.auction_id=a.auctionID left join payment_order_history as po on po.itemid=a.auctionID left join registration r on r.id=wa.userid where wa.userid != '0'"; 
        
          if($startdate!= '--'){
		$qrysel .= " and a.auc_start_date>='$startdate' ";
		
		}
		if($enddate != '--'){
		$qrysel .= " and auc_end_date<='$enddate' ";
		}
		if(!empty($product)){
		$qrysel .= " and a.productID='$product' ";
		
		}
		
		//$qrysel .= "and a.productID='$product'";
    }
   // }
          if(db_num_rows(db_query("select * from user_levels where admin_level = 'Golf Biddy Vendor' or admin_level = 'Vendor'")) >= 1 & $_SESSION['username'] != 'admin'){
          
	      $vendor_info = db_fetch_array(db_query("select vendors from registration where id = '$_SESSION[userid]'"));
	      
	      $qrysel = " and p.vendor = '$vendor_info[0]'";
	      
          
          }
  if(!empty($_REQUEST['vendor'])){
      $qrysel .= " and p.vendor = '$_REQUEST[vendor]'";
  
  
  }
  }
  
  if(!empty($_REQUEST['voucher_id'])){
  
  
  $qrysel .= " and po.orderid='$_REQUEST[voucher_id]'";
  
  }
  $qrysel .= " and p.vendor != ''";
  
  

   $qrysel2=$qrysel;
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);
    $totalpage=ceil($total/$PRODUCTSPERPAGE);

    if($totalpage>=1) {
        $startrow=$PRODUCTSPERPAGE*($PageNo-1);
        $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
        $ressel=db_query($qrysel);
        $total=db_num_rows($ressel);
    }

if(empty($_REQUEST['voucher_id']) & $_SESSION['UsErOfAdMiN'] != 'admin'){
$total = 0;
}
	
	?>
	
	   <script type="text/javascript">
	   
	   
                                                                                    function change_status_now(status, id, confirmed){
                                                                                    
                                                                              
                                                                                    if(!isNaN(status)){
											  if(!confirmed){
											  
											  
											  $('#dialog').html('Would you like to Commit this change to the database? Otherwise use the close button at the top to cancel it.<button onclick="change_status_now(\'' + status + '\', \'' + id + '\', \'yes\');">Confirm</button>'); 
											  
											  $('#dialog').dialog(
                                                                                    {modal:true, ready:true, autoOpen: false  });
											  
											   $('#dialog').dialog('open');
											   
											  }else{
											  
											      $.get('../include/addons/golf_courses/vendor_pages/vendor_reports.php?change_status=true&aid=' + id + '&status=' + status, function(response){
											      
												  $('#display_status_' + id).html(response);
											     jQuery('#dialog').dialog('close');
											      });
											  
											  
											  }
										      }
                                                                                    
                                                                                    }
                                                                                    
            function Check(f1)
            {
                if(document.f1.datefrom.value=="" && document.f1.products.value=="" && document.f1.auctionstatus.value=="" && document.f1.auctioniddatefrom.value=="")
                {
                    alert("Please select start date!!!");
                    return false;
                    document.f1.datefrom.focus();
                }
                if(document.f1.dateto.value=="" && document.f1.products.value=="" && document.f1.auctionstatus.value=="" && document.f1.auctioniddatefrom.value=="")
                {
                    alert("Please select end date!!!");
                    return false;
                    document.f1.dateto.focus();
                }
                if(document.f1.products.value=="none" && document.f1.auctionstatus.value=="" && document.f1.auctioniddatefrom.value=="")
                {
                    alert("Please select product!!!");
                    return false;
                    document.f1.products.focus();
                }
            }
            function OpenPopup(url)
            {
                window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=100,height=100,screenX=300,screenY=350,top=300,left=350');

            }
        </script>
	<div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Golf Course Vouchers Report</h2>
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

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="f1" action="" method="post" onSubmit="return Check(this)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                        
                                                        <?php
                                                        if($_SESSION['UsErOfAdMiN'] == 'admin'){
                                                        ?>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Please Select Date:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <input type="hidden" name="paymentstatus" value="0"/>
                                                                            <input type="text" name="datefrom" id="datefrom" size="12" value="<?php if(empty($_REQUEST['datefrom'])){ echo $_REQUEST['datefrom']; } ?>"/>
                                                                            <strong>&nbsp;To&nbsp;</strong>
                                                                            <input type="text" name="dateto" size="12" id="dateto" value="<?php if(empty($_REQUEST['dateto'])){ echo $_REQUEST['dateto']; } ?>"/>
                                                                        </span> 
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
								  <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Id:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                        
                                                                        <input id="auction_id" name="auction_id" value="<?php echo $_REQUEST['auction_id'];?>" type="text" />
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Vouchers:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <?
                                                                            $qrr="select * from products ";
                                                                            
                                                                           
                                                                            if(db_num_rows(db_query("select * from user_levels where id = $_SESSION[user_level] and ( admin_level = 'Golf Biddy Vendor' or admin_level = 'Vendor' )")) >= 1){
                                                                          
                                                                                  
        
											$vendor_info = db_fetch_array(db_query("select vendors from registration where username = '$_SESSION[UsErOfAdMiN]' or id = '$_SESSION[userid]'"));
											
											    if($vendor_info[0] != ''){
											      $qrr .= " where vendor = '$vendor_info[0]'";
											  }
										      }else{
										      $qrr .= " where vendor != ''";
										      
										      }
										      
									
										      
										      $qrr .= " order by name";
                                                                            $resp = db_query($qrr) or die(db_error());
                                                                            $totalp = db_num_rows($resp);
                                                                            ?>
                                                                            <select name="products" id="products">
                                                                                <option value="none">Please Select</option>
                                                                                <?php if($totalp>0) {
                                                                                    while($roww=db_fetch_array($resp)) {
                                                                                        ?>
                                                                                <option <?=$product==$roww["productID"]?"selected":"";?> value="<?=$roww["productID"];?>"><?=stripslashes($roww["name"]);?></option>
                                                                                        <?
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
<?php


                                                                                    if($_SESSION['UsErOfAdMiN'] == 'admin'){
                                                                                    ?>
                                                                                     <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Vendor Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                    
                                                                            <select name="vendor" id="vendor">
                                                                                <option></option>
                                                                                
                                                                                <?php
                                                                              $vendor_list = db_query("select * from vendors");
                                                                              while($row_v = db_fetch_array($vendor_list)){
                                                                                ?>  
                                                                                
                                                                                
                                                                                <option <?=$row_v[1] ==$_REQUEST['vendor']?"selected":"";?> value="<?php echo $row_v[1];?>"><?php echo $row_v[1];?></option>
                                                                                
                                                                                <?php } ?>
                                                                               
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]--> 
                                                                                    
                                                                                    
                                                                                    <?php } ?>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Status:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                    
                                                                            <select name="auctionstatus" id="auctionstatus">
                                                                                
                                                                                
                                                                               
                                                                                
                                                                                <?php  ?>
                                                                                <option <?=$auctionstatus==""?"selected":"";?> value="">Please Select</option>
                                                                             <option <?=$auctionstatus=="1"?"selected":"";?> value="1">Active</option>
                                                                                
                                                                                <option <?=$auctionstatus=="3"?"selected":"";?> value="3">Sold / Not Used</option>
                                                                                
                                                                                <option <?=$auctionstatus=="7"?"selected":"";?> value="7">Redeemed</option>
                                                                               
                                                                                
                                                                                <option <?=$auctionstatus=="5"?"selected":"";?> value="6">100% Completed</option>
                                                                               
                                                                               
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
<?php } ?>

								  <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Voucher Id:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                        
                                                                        <input id="voucher_id" name="voucher_id" value="<?php echo $_REQUEST['voucher_id'];?>" type="text" />
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>start row<![endif]-->




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
                                                            <!--[if !IE]>end forms<![endif]-->

                                                        </fieldset>
                                                        <!--[if !IE]>end fieldset<![endif]-->
                                                    </form>
                                                    <!--[if !IE]>end forms<![endif]-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
 <?php if(isset($total)) {
                            ?>
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->

                            <div class="title_wrapper">
                                <h2>Product List</h2>
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
                                                                    <?php if($total==0) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No Auctions To Display.</strong></li>
                                                                </ul>
                                                                        <?php }else {?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="width:80px;text-align: center;">Auctinon ID</th>
                                                                            <th>Name</th>
                                                                            <?php
                                                                            if($_SESSION['UsErOfAdMiN'] == 'admin'){
                                                                            ?>
                                                                            <th style="text-align:center;">Order Id</th>
                                                                            
                                                                            <?php }else{ ?>
                                                                            <th style="text-align:center;">Voucher Id</th>
                                                                            
                                                                            <?php } ?>
                                                                            <th style="text-align:center;">Company</th>
                                                                            
                                                                             <?php
                                                                            if($_SESSION['UsErOfAdMiN'] == 'admin'){
                                                                            ?>
                                                                            <th style="text-align:center;">Email / Order Id</th>
                                                                            <?php }else{ ?>
                                                                            <th style="text-align:center;">Email</th>
                                                                            <?php } ?>
                                                                            <th style="text-align:center;width:100px;">Auction Status</th>
                                                                            <th style="text-align:center;width:60px;">Option</th>
                                                                        </tr>
                                                                                <?
                                                                                $i=1;
                                                                                while($obj = db_fetch_object($ressel)) {
                                                                               
                                                                                    if($obj->fixedpriceauction=="1") {
                                                                                        $type = "Set Price Auction";
                                                                                    }
                                                                                    if($obj->pennyauction=="1") {
                                                                                        $type = "1 Cent Auction";
                                                                                    }
                                                                                    if($obj->nailbiterauction=="1") {
                                                                                        $type = "NailBiter Auction";
                                                                                    }
                                                                                    if($obj->offauction=="1") {
                                                                                        $type = "Totally Free";
                                                                                    }
                                                                                    if($obj->nightauction=="1") {
                                                                                        $type = "Night Auction";
                                                                                    }
                                                                                    if($obj->openauction=="1") {
                                                                                        $type = "Open Auction";
                                                                                    }

                                                                                    if($obj->auc_status=="2" || $obj->auc_status=="1") {
                                                                                        $status = "<span  style='color:red' id='display_status_" .  $obj->auctionID . "'>Auction is Still Running</span>";
                                                                                    }
                                                                                    elseif($obj->auc_status=="4") {
                                                                                        $status = "<span  style='color:green' id='display_status_" .  $obj->auctionID . "'>Future Auction</span>";
                                                                                    }
                                                                                    elseif($obj->auc_status=="3") {
                                                                               if(db_num_rows(db_query("select * from won_auctions where auction_id = '" . $obj->auctionID . "' and userid != 0")) == 0){
                                                                               
										  $status = "<span  style='color:gray'>No Winner</span>";    
                                                                           
                                                                           
                                                                           
                                                                           
                                                                           }else{
											$vendor_obj = db_fetch_array(db_query("select * from won_auctions where auction_id = '" . $obj->auctionID . "'"));



										      if($vendor_obj['accept_denied']=="Accepted" && $vendor_obj['payment_date']=='0000-00-00 00:00:00') {
																	
																	    $status = "<span  style='color:orange'>Auction Accepted / Payment Not Yet Recieved</span>";
																	
																	
													}else if($vendor_obj['accept_denied']=="Accepted" && $vendor_obj['payment_date']!='0000-00-00 00:00:00') {
																	
																	
																	      $status = "<span  style='color:green'>Payment Recieved / Not Yet Used</span>";
																	      $not_used = 'true';
																	
																	}

														      else if($vendor_obj['accept_denied']!="Accepted") {

																	    $status = "<span  style='color:blue'>" . $vendor_obj['accept_denied'] . "</span>";
																	    }
	}																    }else if($obj->auc_status=="4") {
                                                                                    $status = "<span  style='color:red' id='display_status_" .  $obj->auctionID . "'>Pending Auction</span>";
                                                                                    
                                                                                    
                                                                                    }else if($obj->auc_status=="5") {
                                                                                    $status = "<span  style='color:blue' id='display_status_" .  $obj->auctionID . "'>". $obj->vendor ." Has Not Yet Been Paid For This</span>";
                                                                                    
                                                                                    
                                                                                    if(db_num_rows(db_query("select * from user_levels where admin_level = 'Golf Biddy Vendor' or admin_level = 'Vendor' and ")) >= 1 & $_SESSION['username'] != 'admin' & $_SESSION['UsErOfAdMiN'] != 'admin'){
                                                                                    ?>
                                                                                    
                                                                                    
                                                                                    
                                                                                    <?php }else{ 
                                                                                    
                                                                                     if($_SESSION['UsErOfAdMiN'] == 'admin'){
											  $status .= '<select name="change_status[' . $obj->auc_status . ']" id="change_status['. $obj->auc_status . ']" onchange="change_status_now($(this).val(),' . $obj->auctionID . ');"><option></option><option value="6" style="color:green;">Mark Vendor as Paid</option><option value="5" style="color:red;">Mark Vendor as UnPaid</option> </select>';
                                                                                    
                                                                                    
											}
                                                                                    
											}
                                                                                    
                                                                                    }
                                                                                    elseif($obj->auc_status=="7") {
                                                                                    
                                                                                    $status = "<span style='color:black' id='display_status_" .  $obj->auctionID . "'> Voucher was redeemed</span>";
                                                                                     if(db_num_rows(db_query("select * from user_levels where admin_level = 'Golf Biddy Vendor' or admin_level = 'Vendor'")) >= 1 & $_SESSION['username'] != 'admin' & $_SESSION['UsErOfAdMiN'] != 'admin'){
                                                                                    ?>
                                                                                    
                                                                                    
                                                                                    
                                                                                    <?php }else{ 
                                                                                    
											 if($_SESSION['UsErOfAdMiN'] == 'admin'){
											    $status .= ' <select name="change_status[' .  $obj->auc_status . ']" id="change_status[' . $obj->auc_status . ']" onchange="change_status_now($(this).val(), '. $obj->auctionID . ');">
											      <option></option>
												  <option value="6" style="color:green;">Mark Vendor as Paid</option>
												  <option value="5" style="color:red;">Mark Vendor as UnPaid</option>
												</select>';
                                                                                    
											  }
                                                                                  
                                                                                    
											}
                                                                                    
                                                                                    }
                                                                                    elseif($obj->auc_status=="6") {
                                                                                    
                                                                                    $status = "<span style='color:black' id='display_status_" .  $obj->auctionID . "'>Payment was made to ". $obj->vendor ."</span>";
                                                                                    
                                                                                    
                                                                                    
                                                                                    if(db_num_rows(db_query("select * from user_levels where admin_level = 'Golf Biddy Vendor' or admin_level = 'Vendor'")) >= 1 & $_SESSION['username'] != 'admin'){
                                                                                    
                                                                                    
                                                                                    
                                                                                    }else{
                                                                                     
                                                                                    if($_SESSION['UsErOfAdMiN'] == 'admin'){
											  $status .= '<select name="change_status[' . $obj->auc_status . ']" id="change_status[' .$obj->auc_status . ']" onchange="change_status_now($(this).val(), '.$obj->auctionID . ');">
											    <option></option>
												<option value="6" style="color:green;">Mark Vendor as Paid</option>
												<option value="5" style="color:red;">Mark Vendor as UnPaid</option>
											      </select>';
                                                                                    }
                                                                             
                                                                                    }
                                                                                    }
                                                                                    ?>
                                                                                    <script>
                                                                                   
                                                                                    
                                                                                    
                                                                                    </script>
                                                                        <tr class="<?php echo ($i==1)?'first':'second'; ?>">
                                                                            <td style="text-align:center;">
                                                                                            <?php if($obj->auctionID) {
                                                                                                echo $obj->auctionID;
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?>
                                                                                             
                                                                                            
                                                                                            </td>
                                                                            <td><?php  echo '<span color="red">' . $obj->name. "</span><br />"; 
                                                                            if($_SESSION['UsErOfAdMiN'] == 'admin'){
                                                                            echo $type!=""?$type:"&nbsp;";
                                                                            } ?>
                                                                           
                                                                            
                                                                            </td>
                                                                            <td style="text-align:right;">
                                                                            
                                                                            <?php ?>
                                                                                            <?php if($obj->auc_start_price) {
                                                                                               if($_SESSION['UsErOfAdMiN'] == 'admin'){ echo "Start Price " .$Currency . $obj->auc_start_price;
                                                                                               }
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }
                                                                                            
                                                                                            
                                                                                            ?>
                                                                              <br />
                                                                             #<?php echo $obj->orderid; ?>               
                                                                             </td>
                                                                            <td style="text-align:right;">
                                                                            
                                                                            <?php echo '<span color="red">' . $obj->vendor . '</span><br />'; ?>
                                                                                            <?php if($obj->auc_fixed_price) {
                                                                                                if($_SESSION['UsErOfAdMiN'] == 'admin'){ echo "End Price " . $Currency . $obj->auc_fixed_price;
                                                                                                }
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?></td>
                                                                            <td style="text-align:center;">
                                                                                            <?php if($obj->auc_final_end_date) {
                                                                                            if($_SESSION['UsErOfAdMiN'] == 'admin'){
                                                                                                echo substr(ChangeDateFormatSlash($obj->auc_final_end_date),0,10);
                                                                                                }
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?>
                                                                                       <br /><?php echo $obj->email; ?>
                                                                                            
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                            <?
                                                                                                echo $status;
                                                                                            ?></td>

                                                                            <td style="text-align:center;">
                                                                                <div class="actions_menu">
                                                                                
                                                                                <?php
                                                                                if($_SESSION['UsErOfAdMiN'] != 'admin' & $obj->auc_status == 3){
                                                                                ?>
                                                                                <div id="display_status_<?php echo $obj->auctionID; ?>"></div>
                                                                                  <select name="change_status[<?php echo $obj->auc_status;?>]" id="change_status[<?php echo $obj->auc_status;?>]" onchange="change_status_now($(this).val(), <?php echo $obj->auctionID;?>);">
                                                                                    <option></option>
											<option value="7" style="color:green;">Mark as Used</option>
										
										      </select>
                                                                                
                                                                                <?php }else{
                                                                                
                                                                                 if(db_num_rows(db_query("select * from user_levels where admin_level = 'Golf Biddy Vendor' or admin_level = 'Vendor'")) >= 1 & $_SESSION['UsErOfAdMiN'] == 'admin'){
                                                                                 
                                                                                 ?>
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a class="details" name="details" href="auctiondetails.php?aid=<?=$obj->auctionID;?>">Details</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                 <?php 
										    }
                                                                                 } ?>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                                    <?php
                                                                                    $i=$i*-1;
                                                                                }
                                                                                ?>
                                                                    </tbody>
                                                                </table>
                                                                        <?php }?>
                                                            </div>
                                                        </div>
                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                    </div>

                                                        <?php if($total) { ?>
                                                    <!--[if !IE]>start pagination<![endif]-->
                                                    <div class="pagination">
                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpage; ?></span>
                                                        <ul class="pag_list">
                                                                    <?php
                                                                    if($PageNo>1) {
                                                                        $PrevPageNo = $PageNo-1;
                                                                        ?>
                                                            <li><a href="gb_vendors.php?pgno=<?=$PrevPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                        <?php } ?>

                                                                    <?php
                                                                    $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                    $pageTo=$PageNo+3>$totalpage?$totalpage:$PageNo+3;
                                                                    for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                        ?>
                                                                        <?php if($i==$PageNo) { ?>
                                                            <li><a href="gb_vendors.php?pgno=<?=$i;?>&<?=$urldata;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                            <?php }else {?>
                                                            <li><a href="gb_vendors.php?pgno=<?=$i;?>&<?=$urldata;?>"><?php echo $i; ?></a></li>
                                                                            <?php }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if($PageNo<$totalpage) {
                                                                        $NextPageNo = 	$PageNo + 1;
                                                                        ?>
                                                            <li><a href="gb_vendors.php?pgno=<?=$NextPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                        <?php } ?>
                                                        </ul>

                                                    </div>
                                                    <!--[if !IE]>end pagination<![endif]-->
                                                            <?php }?>

                                                    <div class="categoryorder" style="text-align: center;">
                                                            <?
                                                            if($total>0) {
                                                                ?>
                                                  
                                                                <?
                                                            }
                                                            ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                     if($_SESSION['UsErOfAdMiN'] == 'admin'){
                                     ?>
                                </div>
                                
                                <?php } ?>
                                <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
                        <!--[if !IE]>end section<![endif]-->

                            <?php } ?>
                            <div id="dialog"></div>