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
        $wherecase.=" and payment_order_history.datetime>'$startdate' ";
    }else{
    
	$wherecase .= " and payment_order_history.datetime>'" . date("Y-m-d H:i:s") . "'";
    }
    if ($quyenddate != '') {
        $wherecase.=" and payment_order_history.datetime<'$enddate' ";
    }else{
	$wherecase .= " and payment_order_history.datetime<'" . date("Y-m-d H:i:s") . "'";
    
    }
    if ($username != '') {
        $wherecase.=" and r.username like '$username%' ";
    }
    if ($order != '') {
        $wherecase .=" and payment_order_history.itemname like '$order%' ";
    }
    $StartRow = $PRODUCTSPERPAGE * ($PageNo - 1);
    /*     * ******************************************** */
   $sql = "select payment_order_history.id as oid, payment_order_history.itemid, payment_order_history.orderid, payment_order_history.itemname, payment_order_history.amount, payment_order_history.datetime, r.id as uid, r.username from payment_order_history  left join registration r on r.id=payment_order_history.userid where payment_order_history.id != '' $wherecase and payment_order_history.payfor='Won Bingo' order by payment_order_history.id ";
   
   
    $result = db_query($sql) or die(db_error());
    $totalrows = db_num_rows($result);
    $totalpages = ceil($totalrows / $PRODUCTSPERPAGE);
    $sql .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
    $result = db_query($sql);
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
        <title>Manage Bingo Winnings-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <!--[if lte IE 7]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
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
            
            	    function ajaxupdateshipping(id){
		    data = "trackingnumber=" + document.getElementById('trackingnumber[' + id + ']').value;
		    data += "&shippingtypeid=" + document.getElementById('shippingtypeid[' + id + ']').options[document.getElementById('shippingtypeid[' + id + ']').selectedIndex].value;
		  $.get('bingowinners.php?submit=yes&orderid=' + id + '&' + data , function(response){
		  
		    document.getElementById('shipping_status[' + id +']').innerHTML = response;
		    });
	}
	
	
	    function ajaxshipping(id, type){
	     document.getElementById('shipping_status[' + id +']').innerHTML = 'Loading';
		$.get('bingowinners.php?ordertype=' + type + '&orderid=' + id, // URL to the JSON script
				  function(result){
				  
				document.getElementById('shipping_status[' + id + ']').innerHTML = result;
				 
				  
				  
				  });
	    
	    
	    }
	    
	    function ajaxupdateshippingnormal(id, type){
		data = 'ordertype=' + type + '&shippingtypeid=' + document.getElementById('shippingtypeid[' + id + ']').options[document.getElementById('shippingtypeid[' + id + ']').selectedIndex].value;
	 
	 
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
                                <h2>Manage Bingo Winnings</h2>
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
                                                        <form id="f1" name="f1" onsubmit="return Check(this)" action="bingowinners.php" method="post" class="search_form general_form">

                                                            <div class="forms">
                                                                

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
                                                                            <th style="width:20px;text-align: center;">No</th>
                                                                            <th style="width:290px;text-align: center;">Invoice Id</th>
                                                                            <th style="width:150px;text-align: center;">Name</th>
                                                                            <th style="text-align:center;">Price</th>
                                                                           
                                                                            <th style="text-align:center;">Date</th>
                                                                        
                                                                            <th style="text-align:center;">Member</th>
									    <th style="text-align:center;">Shipping</th>
                                                                        </tr>
<?
    for ($i = 0; $i < $total; $i++) {
        if ($PageNo > 1) {
            $srno = ($PageNo - 1) * $PRODUCTSPERPAGE + $i + 1;
        } else {
            $srno = $i + 1;
        }

        $row = db_fetch_object($result);
      
?>
                                                                        <tr class="<?php echo ($i % 2 != 0) ? 'first' : 'second'; ?>">
                                                                            <td style="text-align:center;"><?= $row->oid ?></td>
                                                                            <td><?php echo $row->orderid; ?></td>
                                                                            <td><?= $row->itemname ?></td>
                                                                            <td style="text-align:right;"><?= $row->amount ?></td>
                                                                            <td style="text-align:center;">
									      <?php echo $row->datetime; ?>

                                                                            </td>

                                                                           

                                                                            <td style="text-align:center;"><a href="#" onclick="popwindow('useraddress.php?userid=<?php echo $row->userid; ?>');return false;"><?= $row->username; ?></a></td>
                                                                            <td style="text-align:left;">
                                                                             <div id="shipping_status_p[<?php echo $row->oid; ?>]"  style="height:auto;min-width:220px;">
                                                                                             <a id="record<?php echo $row->oid; ?>" title="addshippingstatus.php?id=<?php echo $row->oid; ?>&ordertype=7" href="javascript: ajaxshipping_normal('<?php echo $row->oid; ?>', 7);">
                                                                                             
										    <?php
										    if(db_num_rows(db_query("select * from shippingstatus where ordertype = '7' and orderid = '" . $row->oid . "'")) == 0 ){
											?>
											<span class="redfont" style="min-width:220px;">NOT SHIPPED</span>
											<?php
											}else{
											?>
											
                                                                                       <?php $trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $row->oid . " and ordertype = 7"));
                                                                                       
                                                                                       $resc = db_fetch_object(db_query("select * from shipping left join shippingtype st on st.id=shippingtypeid where  shipping.id = " . $trackingnumber->shippingtypeid ));
                                                                                     
                                                                                       
                                                                                       echo "" . $resc->shipping_title ."<br />";
                                                                                       echo "" .$trackingnumber->tracknumber . "<br />" . "" . $trackingnumber->adddate . "<br />" . "" .
                                                                                       $Currency . $resc->shippingcharge;
                                                                                       $ship_total = $ship_total + $resc->shippingcharge;
                                                                                       
                                                                                       ?>
                                                                                       
                                                                                       
                                                                                       <?php
											}
											
											?>
											 <?php
                                                                                       if(!empty($resc->logoimage)){
                                                                                       ?>
											    <img src="../uploads/other/<?php echo $resc->logoimage;?>" style="max-height:35px;width:auto;" />
											  <?php } ?>
											</a>
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
                                                                                        <li><a href="bingowinners.php?<?php echo $urldata ?>&pgno=<?php echo $PrevPageNo; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                            <?php } ?>

                                                            <?php
                                                                            $pageFrom = $PageNo - 3 < 1 ? 1 : $PageNo - 3;
                                                                            $pageTo = $PageNo + 3 > $totalpages ? $totalpages : $PageNo + 3;
                                                                            for ($i = $pageFrom; $i <= $pageTo; $i++) {
                                                            ?>
                                                            <?php if ($i == $PageNo) {
 ?>
                                                                                    <li><a href="bingowinners.php?<?php echo $urldata ?>&pgno=<?php echo $i; ?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                            <?php } else {
                                                            ?>
                                                                                    <li><a href="bingowinners.php?<?php echo $urldata ?>&pgno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                            <?php
                                                                                }
                                                                            }
                                                            ?>
                                                            <?php
                                                                            if ($PageNo < $totalpages) {
                                                                                $NextPageNo = $PageNo + 1;
                                                            ?>
                                                                                <li><a href="bingowinners.php?<?php echo $urldata ?>&pgno=<?php echo $NextPageNo; ?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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

