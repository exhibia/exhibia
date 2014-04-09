<?php
session_start();
$active="Auctions";
include("connect.php");
include('functions.php');
include("admin.config.inc.php");
include("security.php");

if($_REQUEST['delid']) {
    $qryselche = "select * from redemption_order where redem_id='".$_REQUEST["delid"]."'";
    $resselche = db_query($qryselche);
    $totalche = db_num_rows($resselche);

    if($totalche>0) {
        header("location: message.php?msg=77");
    }
    else {
        $delqry="delete from redemption where id=".$_REQUEST['delid'];
        db_query($delqry);
        header("location: message.php?msg=76");
    }
    exit;
}

if($globalDateformat == 'd/m/Y'){
$startdate =  explode("/", $_POST['redem_startdate']);
$enddate =  explode("/", $_POST['redem_enddate']);

$_POST['redem_startdate'] =  $startdate[1] . "/" . $startdate[0] . "/" . $startdate[2];
$_POST['redem_enddate'] =  $enddate[1] . "/" . $enddate[0] . "/" . $enddate[2];


}
if($_REQUEST['addredemption']) {


    $category=$_POST['category'];
    $product=$_POST['product'];
    $redem_qty=$_POST['redem_qty'];
    $redem_points=$_POST['redem_points'];
    $redem_startdate=date("Y-m-d", strtotime($_POST['redem_startdate']));
    $redem_enddate= date("Y-m-d", strtotime($_POST['redem_enddate']));
    $shippingid = $_POST["shipping"];

    $insqry="insert into redemption(category_id,product_id,redem_qty,redem_points,redem_startdate,redem_enddate,redem_shipping) values('".$category."','".$product."','".$redem_qty."','".$redem_points."','".$redem_startdate."','".$redem_enddate."','".$shippingid."')";
    db_query($insqry) or die(db_error());
    header("location: message.php?msg=75");
    exit;
}
if($_REQUEST['editredemption']) {

    $category=$_POST['category'];
    $product=$_POST['product'];
    $redem_qty=$_POST['redem_qty'];
    $redem_points=$_POST['redem_points'];
    $redem_startdate=date("Y-m-d", strtotime($_POST['redem_startdate']));
    $redem_enddate= date("Y-m-d", strtotime($_POST['redem_enddate']));
    $shippingid = $_POST["shipping"];

    $updqry="update redemption set category_id='".$category."',product_id='".$product."',redem_qty='".$redem_qty."',redem_points='".$redem_points."',redem_startdate='".$redem_startdate."',redem_enddate='".$redem_enddate."',redem_shipping='".$shippingid."' where id='".$_REQUEST['editid']."'";
    db_query($updqry) or die(db_error());

    header("location: message.php?msg=75");
    exit;
}
if($_REQUEST['redemption_edit'] || $_REQUEST['redemption_delete']) {
    if($_REQUEST["redemption_edit"]!="") {
        $redid = $_REQUEST["redemption_edit"];
    }
    if($_REQUEST["redemption_delete"]!="") {
        $redid = $_REQUEST["redemption_delete"];
    }

    $selqry="select * from redemption, products, bidpack where (redemption.product_id=products.productID and redemption.id=$redid) or (
redemption.product_id=bidpack.id and redemption.id=$redid) order by products.productID, bidpack.id desc limit 1";

    $selres=db_query($selqry);

    $row=db_fetch_object($selres);
        echo db_error();
    $id=$row->id;
    $category=$row->category_id;

 if($category != '1'){
    $product=$row->product_id;
    $redem_qty=$row->redem_qty;
    $redem_points=$row->redem_points;
    $redem_startdate=$row->redem_startdate;
    $redem_enddate=$row->redem_enddate;
    $price=$row->price;
      $pname=$row->name;
      

    }else{
    $product=$row->id;
    $redem_qty=$row->redem_qty;
    $redem_points=$row->redem_points;
    $redem_startdate=$row->redem_startdate;
    $redem_enddate=$row->redem_enddate;
    $price=$row->bidpack_price;
      $pname=$row->bidpack_name;


    }
}	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if($_GET['redemption_edit']!="") { ?> Edit Redemption<?php } else {
                if($_GET['redemption_delete']!="") { ?> Confirm Delete Redemption<?php }else { ?> Add Redemption <?php }
            }
            ?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <link href="zpcal/themes/aqua.css" rel="stylesheet" type="text/css" media="all" title="Calendar Theme - aqua.css" />
        <script type="text/javascript" src="zpcal/src/utils.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.core.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.datepicker.min.js"></script>
        <script type="text/javascript">
            function Check(f1)
            {
                if(document.f1.category.value=="none")
                {
                    alert("Please select category!");
                    document.f1.category.focus();
                    return false;
                }

                if(document.f1.product.value=="none")
                {
                    alert("Please select product!");
                    document.f1.product.focus();
                    return false;
                }
                if(document.f1.redem_qty.value=="")
                {
                    alert("Please select Qty!");
                    document.f1.redem_qty.focus();
                    return false;
                }
                if(document.f1.redem_startdate.value=="")
                {
                    alert("Please enter redemption start date!");
                    document.f1.redem_startdate.focus();
                    return false;
                }
                if(document.f1.redem_startdate.value!="" && document.f1.checkflag.value=="add")
                {
                    var startdate = condate(document.f1.redem_startdate.value);
                    var curdate = condate(document.f1.curdate.value);

                    var newstartdate = document.getElementById('redem_startdate').value;
                   
		    var newcurdate = '<?php echo date($globalDateformat); ?>';

                    

                    if(newcurdate > newstartdate)
                    {
                        alert("Redemption start date should not be past date!")
                        document.f1.redem_startdate.focus();
                        return false;
                    }
                }
                if(document.f1.redem_enddate.value=="")
                {
                    alert("Please enter redemption end date!");
                    document.f1.redem_enddate.focus();
                    return false;
                }
                if(document.f1.redem_enddate.value!="" && document.f1.checkflag.value=="add")
                {
                    var enddate = condate(document.f1.redem_enddate.value);
                    var curdate = condate(document.f1.curdate.value);

                    var newenddate = document.getElementById('redem_enddate').value;
		    var newcurdate = '<?php echo date($globalDateformat); ?>';

                    if(newcurdate > newenddate)
                    {
                        alert("Redemption end date should not be past date!")
                        document.f1.redem_enddate.focus();
                        return false;
                    }

                }
                if(f1.redem_startdate.value !="" && f1.redem_enddate.value !="")
                {

		    var newenddate = document.getElementById('redem_enddate').value;
		    var newstartdate = document.getElementById('redem_startdate').value;
                    if(newstartdate > newenddate)
                    {
                        alert("Redemption end date must be greater than redemption start date!");
                        f1.redem_enddate.focus();
                        return false;
                    }
                }
                if(document.f1.redem_points.value=="")
                {
                    alert("Please enter redemption point!");
                    document.f1.redem_points.focus();
                    return false;
                }
                if(document.f1.shipping.value=="none")
                {
                    alert("Please select shipping method!");
                    document.f1.shipping.focus();
                    return false;
                }

            }
            function condate(dt)
            {
                var ndate= new String(dt);
                //alert(dt);
                var fdt=ndate.split("/");
                var nday=fdt[0];
                var nmon=fdt[1];
                var nyear=fdt[2];

                var finaldate=nmon+"/"+nday+"/"+nyear;
                //alert(finaldate);

                return finaldate;
            }
            function GetXmlHttpObject()
            {
                var xmlHttp=null;
                try
                {
                    // Firefox, Opera 8.0+, Safari
                    xmlHttp=new XMLHttpRequest();
                }
                catch (e)
                {
                    // Internet Explorer
                    try
                    {
                        xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
                    }
                    catch (e)
                    {
                        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                }
                return xmlHttp;

            }
            function ChangeProduct(crid)
            {

	var selObj = document.getElementById('category');


	var selIndex = selObj.selectedIndex;
	value = selObj.options[selIndex].value;
                var url="getproductlist.php";
                url=url+"?crid="+value;
                 $.get(url,
		function(response){
                  $("#Productlist").html(response);

		});

            }
           

            function setprice(prid)
            {
	       /* xmlHttp=GetXmlHttpObject();
                if (xmlHttp==null)
                {
                    alert ("Your browser does not support AJAX!");
                    return;
                }
                var url="getprice.php";
                url=url+"?prid="+prid
                xmlHttp.onreadystatechange=changedprice;
                xmlHttp.open("GET",url,true);
		xmlHttp.send(null);*/

	var selObj = document.getElementById('category');


	var selIndex = selObj.selectedIndex;
	value = selObj.options[selIndex].value;

	
	   var url="getprice.php";
              url=url+"?prid="+prid+"&cat="+value;
	  $.ajax({
            url: url,
            dataType: 'json',
            success: function(data) {
                $.each(data, function(i, item) {
                    result = item.result;
if(i == 'price'){
price = item.split("|");

$("#getprice").html("$"+price[0]);

}
if(i == 'picture1' & item != ''){


 $("#picture1").html('<img src="../uploads/products/thumbs_small/thumbsmall_' + item + '" />');

}else{
 $("#picture1").html();
 }
if(i == 'picture2' & item != ''){


 $("#picture2").html('<img src="../uploads/products/thumbs_small/thumbsmall_' + item + '" />');

}else{
 $("#picture2").html();
 }
if(i == 'picture3' & item != ''){


 $("#picture3").html('<img src="../uploads/products/thumbs_small/thumbsmall_' + item + '" />');

}
else{
 $("#picture3").html();
 }
if(i == 'picture4' & item != ''){


 $("#picture4").html('<img src="../uploads/products/thumbs_small/thumbsmall_' + item + '" />');

}else{
 $("#picture4").html();
 }
		    });
	    
		}
	    });
	    

            }
    /*        function changedprice() This function is broken and should never be used
            {
                if (xmlHttp.readyState==4)
                {
                    var temp=xmlHttp.responseText;


var data = eval(temp);
prompt(data);
price = data.split("|");

                    document.getElementById("getprice").innerHTML="$"+price[0];
                }
	    }*/

        </script>

        <script type="text/javascript">
            $(function() {
                $.datepicker.setDefaults({dateFormat:'<?php echo $globalDateformat=='d/m/Y'?'dd/mm/yy':'mm/dd/yy'; ?>'});
                $("#redem_startdate").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                $("#redem_enddate").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
            });
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
                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>
                                    <?php if($_GET['redemption_edit']!="") { ?> Edit Redemption<?php } else {
                                        if($_GET['redemption_delete']!="") { ?> Confirm Delete Redemption<?php }else { ?> Add Redemption <?php }
                                    }
                                    ?>
                                </h2>
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
                                                    <!--[if !IE]>start system messages<![endif]-->

                                                    <ul class="system_messages">

                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="f1" action="addredemption.php" method="post" onSubmit="return Check(f1)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Category:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="category" id="category" onChange="ChangeProduct($(this).val());">
                                                                                <option value="none">select one</option>
                                                                                <?
                                                                                $qryc = "select * from categories";
                                                                                $resc = db_query($qryc);
                                                                                $totalc = db_affected_rows();
                                                                                while($namec = db_fetch_array($resc)) {
                                                                                    ?>
                                                                                <option <?=$category==$namec["categoryID"]?"selected":"";?> value="<?=$namec["categoryID"];?>"><?=stripslashes($namec["name"]);?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Product:</label>
                                                                    <span class="input_wrapper blank">
								      <?php if(!empty($product)){?>


 <script type="text/javascript">setprice(<?php echo $product;?>);</script>

									<?php } ?>
                                                                        <select name="product" id="Productlist" onChange="setprice(this.value);">
									  <?php if(empty($product)){?>

									    <option value="none">select one</option>
                                                                            <?php
									    }else{?>

									    <option value="<?php echo $product;?>"><?php echo $pname;?></option>
                                                                            <?php




									    }
                                                                            if($category!="") {
                                                                                $qryp = "select * from products where categoryID='".$category."'";
                                                                            }
                                                                            else {
                                                                                $qryp = "select * from products";
                                                                            }
                                                                            $resp = db_query($qryp);
                                                                            $totalp = db_affected_rows();
                                                                            while($objp = db_fetch_array($resp)) {
                                                                                ?>
                                                                            <option <?=$product==$objp["productID"]?"selected":"";?> value="<?=$objp["productID"];?>"><?=stripslashes($objp["name"]);?></option>
                                                                                <?
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </span>
                                                                    <span class="system required">*</span>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Product Market Price:</label>
                                                                    <div class="inputs">
                                                                        <span class="" id="getprice"><?=$price!=""?$Currency.$price:$pprice;?></span>
                                                                    </div>
                                                                    <span class="system required">*</span>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Product Photos:</label>
								    <ul style="display:inline;list-style-type:none;">
								      <li  style="display:inline;" id="picture1"></li>
								      <li style="display:inline;" id="picture2"></li>
								      <li style="display:inline;" id="picture3"></li>
								      <li style="display:inline;" id="picture4"></li>
								     </ul> 
                                                                    <span class="system required">*</span>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Redemption Qty:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="5" name="redem_qty" value="<?=$redem_qty;?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Redemption Date:</label>
                                                                    <div class="inputs">
                                                                  
                                                                        <span class="input_wrapper_custom">
                                                                            <input type="text" name="redem_startdate" id="redem_startdate" value="<?=$redem_startdate!=""?arrangedate($redem_startdate):date($globalDateformat);?>" />
                                                                            <strong>&nbsp;To&nbsp;</strong>
                                                                            <input type="text" size="12" name="redem_enddate" id="redem_enddate" value="<?=$redem_enddate!=""?arrangedate($redem_enddate):date($globalDateformat);?>" />
                                                                        </span>
                                                                    </div>
								    <div id="clock2"></div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Redemption Point:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="8" name="redem_points" value="<?=$redem_points;?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Shipping Method:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="shipping" id="shipping">
                                                                                <option value="none">select one</option>
                                                                                <?
                                                                                $qryship = "select * from shipping order by id";
                                                                                $resship = db_query($qryship);
                                                                                while($objship = db_fetch_array($resship)) {
                                                                                    ?>
                                                                                <option <?=$objship["id"]==$row->redem_shipping?"selected":"";?> value="<?=$objship["id"];?>"><?=stripslashes($objship["shipping_title"]);?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <input type="hidden" name="checkflag" value="<?=$_GET["redemption_edit"]!=""?"edit":"add";?>" />
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <?
                                                                                if($_REQUEST["redemption_edit"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Edit Redemption</span></span><input name="editredemption" type="submit"/></span>
                                                                                <input type="hidden" name="editid" value="<?php echo $_REQUEST['redemption_edit']; ?>" />
                                                                                    <?
                                                                                }
                                                                                elseif($_REQUEST["redemption_delete"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete Redemption</span></span><input name="deleteredemption" type="button" onclick="javascript: window.location.href='addredemption.php?delid=<?=$id?>';"/></span>
                                                                                    <?
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Add Redemption</span></span><input name="addredemption" type="submit"/></span>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                                <input type="hidden" name="curdate" value="<?=date("d/m/Y");?>" />
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

    </body>
</html>