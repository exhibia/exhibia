<?php
ini_set('display_errors', 1);
session_start();

$active = "Database";
include("../../../config/config.inc.php");
$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
if (!$db) {
    die('Could not connect: ' . db_error());
}

db_select_db($DATABASENAME, $db);
include("$BASE_DIR/common/sitesetting.php");

include("$BASE_DIR/backendadmin/functions.php");
include("$BASE_DIR/backendadmin/admin.config.inc.php");

include("$BASE_DIR/backendadmin/gd.inc.php");
include("$BASE_DIR/backendadmin/imgsize.php");

if(db_num_rows(db_query("SHOW COLUMNS FROM products WHERE Field = 'msrp'")) ==0 ){

@db_query("alter table products add column msrp varchar(20) null");

}

@db_query("alter table products add column default_tx1 varchar(20) null");
@db_query("alter table products add column default_tx2 varchar(20) null");
@db_query("alter table products add column default_shippingmethod varchar(20) null");
@db_query("alter table products add column default_reserve varchar(20) null");

function top_words($str, $limit=100, $ignore=""){

	if(!$ignore) $ignore = "the of to and a in for is The that on said with be was by him her theirs where when how not into then not be he his hers";
	
	
	$ignore_arr = explode(" ", $ignore);

	$str = trim($str);
	$str = preg_replace("#[&].{2,7}[;]#sim", " ", $str);
	$str = preg_replace("#[()Â°^!\"Â§\$%&/{(\[)\]=}?Â´`,;.:\-_\#'~+*]#", " ", $str);
	$str = preg_replace("#\s+#sim", " ", $str);
	$arraw = explode(" ", $str);
	
	foreach($arraw as $v){
		$v = trim($v);
		if(strlen($v)<3 || in_array($v, $ignore_arr)) continue;
		$arr[$v]++;
	}
	
	arsort($arr);
	
	return array_keys( array_slice($arr, 0, $limit) );
}

function update_products_Count_Value_For_Categories_Delete($catid) {
    $qrysel = "select products_count from categories where categoryID='$catid'";
    $ressel = db_query($qrysel);
    $totalsel = db_affected_rows();
    if ($totalsel > 0) {
        $rowsel = db_fetch_object($ressel);
        $totproduct = $rowsel->products_count;
        $totproducts = $totproducts = $totproduct - 1;
        $qryupd = "update categories set products_count=" . $totproducts . " where categoryID='$catid'";
        db_query($qryupd) or die(db_error());
    }
}

function update_products_Count_Value_For_Categories($catid) {
    $qrysel = "select products_count from categories where categoryID='$catid'";
    $ressel = db_query($qrysel);
    $totalsel = db_affected_rows();
    if ($totalsel > 0) {
        $rowsel = db_fetch_object($ressel);
        $totproduct = $rowsel->products_count;
        $totproducts = $totproduct + 1;
        $qryupd = "update categories set products_count=" . $totproducts . " where categoryID='$catid'";
        db_query($qryupd) or die(db_error());
    }
}
?>
<?php


$ex = '';
$msg = '';
$parents = $_GET['parents'];
if (!isset($parents) || $parents == "") {
    $parents = 0;
}

//*** ADD PRODUCT ***//
if (!empty($_POST['addproduct'])) {
	foreach($addons as $key => $value){ 
	  if(file_exists("$BASE_DIR/include/addons/$value/product/validation.php")){
	  include_once("$BASE_DIR/include/addons/$value/product/validation.php");
	    }
	    
	 
	      
	   }
	 
include("$BASE_DIR/backendadmin/add_product.php");
   ?>
        <script type="text/javascript">
            window.location.href="message.php?msg=41";
        </script>
<?php
//				header("location: message.php?msg=41");
        exit;

}
//*** UPDATE PRODUCT****//
elseif (!empty($_POST['editproduct'])) {


foreach($addons as $key => $value){ 
	  if(file_exists("$BASE_DIR/include/addons/$value/product/validation.php")){
	  include_once("$BASE_DIR/include/addons/$value/product/validation.php");
	    }
	    
	 
	      
	   }
include("$BASE_DIR/backendadmin/edit_product.php");
   ?>
        <script type="text/javascript">
            window.location.href="message.php?msg=9";
        </script>
<?php
//				header("location: message.php?msg=41");
        exit;
}
else
if ($_REQUEST["product_delete"] != "") {
//delete from products

    $selauc = "select * from auction where productID='" . $_REQUEST["product_delete"] . "'";
    $resauc = db_query($selauc);
    $totalauc = db_num_rows($resauc);

    if ($totalauc >= 1) {
?>
        <script type="text/javascript">
            window.location.href="message.php?msg=41";
        </script>
<?
//				header("location: message.php?msg=41");
        exit;
    }else{
    $categoryID = $_REQUEST["product_cid"];
    update_products_Count_Value_For_Categories_Delete($categoryID);
    $productid = $_REQUEST["product_delete"];
    $prosql = "select * from products where productID='$productid'";
    $proret = db_query($prosql);
    $proobj = db_fetch_array($proret);
    for ($i = 1; $i <= 4; $i++) {
        deleteImage($proobj['picture' . $i]);
    }
    $qrydel = "delete from products where productID=" . $_REQUEST["product_delete"];
    db_query($qrydel) or die(db_error());
   ?>
        <script type="text/javascript">
            window.location.href="message.php?msg=9";
        </script>
<?php
//				header("location: message.php?msg=41");
        exit;
    }
}

//selection for edit
if ($_REQUEST["product_edit"] != "" or $_REQUEST["product_delete"] != "") {
    if ($_REQUEST["product_edit"] != "") {
        $pid = $_REQUEST["product_edit"];
    }
    if ($_REQUEST["product_delete"] != "") {
        $pid = $_REQUEST["product_delete"];
    }
    $qry = "select * from products where productID=" . $pid;
    $resqry = db_query($qry);
    $row = db_fetch_object($resqry);

    $msrp = $row->msrp;
    $actualcost = $row->actual_cost;
    $pcode = $row->product_code;
    $ccode = $row->categoryID;
    $name = stripslashes($row->name);
    $winnertitle = stripslashes($row->winner_title);
    $status = $row->enabled;
    $metatags = $row->metatags;
    $metadescription = $row->metadescription;
    $price = $row->price;
    $short_desc = stripslashes($row->short_desc);
    $long_desc = stripslashes($row->long_desc);
    $aucstartprice = $row->auc_start_price;
    $aucstartdate = $row->auc_start_date;
    $aucstmonth = substr($aucstartdate, 8);
    $aucstdate = substr($aucstartdate, 5, 2);
    $aucstyear = substr($aucstartdate, 0, 4);
    $aucenddate = $row->auc_end_date;
    $aucendyear = substr($aucenddate, 0, 4);
    $aucendmonth = substr($aucenddate, 8);
    $aucenddate = substr($aucenddate, 5, 2);
    $aucstarttime = $row->auc_start_time;
    $aucsthours = substr($aucstarttime, 0, 2);
    $aucstmin = substr($aucstarttime, 3, 2);
    $aucstsec = substr($aucstarttime, 6, 2);
    $aucendtime = $row->auc_end_time;
    $aucendhours = substr($aucstarttime, 0, 2);
    $aucendmin = substr($aucstarttime, 3, 2);
    $aucendsec = substr($aucstarttime, 6, 2);
    $aucstatus = $row->auct_status;
    $auctype = $row->auction_type;
    $productQty = $row->product_qty;
    $qty_check = $row->qty_flag;
    $picture1 = $row->picture1;
    $picture2 = $row->picture2;
    $picture3 = $row->picture3;
    $picture4 = $row->picture4;
      $tax1 = $row->tax1;
      $reserve = $row->default_reserve;
      
      $tax2 = $row->tax;
      $shippingmethod =  $row->shippingmethod;
    $categoryID = $row->categoryID;
    if (isset($_GET['imageid'])) {
        $imageid = $_GET['imageid'];
        if ($imageid >= 1 && $imageid <= 4) {
            $imagefiled='picture'.$imageid;
            $imagename='';
            $upimagesql="update products set $imagefiled='' where productID=$pid";
            db_query($upimagesql);
            if($imageid==1){
                deleteImage($picture1);
                $picture1='';
            }
            else if($imageid==2){
                deleteImage($picture2);
                $picture2='';
            }
            else if($imageid==3){
                deleteImage($picture3);
                $picture3='';
            }
            else if($imageid==4){
                deleteImage($picture4);
                $picture4='';
            }
        }
    }
}

?>
  <?php include("$BASE_DIR/include/addons/blank_page/page_headers.php"); ?>
          <script type="text/javascript">
            function TrackCount(fieldObj,countFieldName,maxChars){
                var countField = eval("fieldObj.form."+countFieldName);
                var diff = maxChars - fieldObj').val().length;

                // Need to check & enforce limit here also in case user pastes data
                if (diff < 0)
                {
                    fieldObj').val() = fieldObj').val().substring(0,maxChars);
                    diff = maxChars - fieldObj').val().length;
                }
                countField').val() = diff;
            }

            function LimitText(fieldObj,maxChars){
                var result = true;
                if (fieldObj').val().length >= maxChars)
                    result = false;

                if (window.event)
                    window.event.returnValue = result;
                return result;
            }
       
            function showProductQty()
            {
                /*	if($('#check_product_qty.checked==true)
                {
                        document.getElementById("productQty").style.display="block";
                }
                else
                {
                        document.getElementById("productQty").style.display="none";
                }
                 */}
      

            /*function checknumber(num)
        {
                //alert(num').val());
                //a=substring(num').val());
                //alert(a);
                var str=num').val();
                var c=str.length;
                if(isNaN(str.charAt(c-1)))
                {
                        str.length=str.length-1
                }

        }*/

            function checknumber(e)
            {
                // 46 and 49 to 57
                var keynum;
                var keychar;
                var numcheck;
                if(window.event) // IE
                {
                    keynum = e.keyCode;
                }
                else if(e.which) // Netscape/Firefox/Opera
                {
                    keynum = e.which;
                }

                keychar = String.fromCharCode(keynum);
                numcheck = /\d/;
                return numcheck.test(keychar);
            }

            function ondeleteimage(pid,imageid){
                
                if(imageid==1){
                    alert('the first image is not allowed to delete');
                    return;
                }
                var loc="addproducts.php?product_edit="+pid+"&imageid="+imageid;
                
                window.location.href=loc;
            }

            function delconfirm(loc)
            {
                if(confirm("Are you sure do you want to delete this?"))
                {
                    window.location.href=loc;
                }
                return false;
            }

            function gotocategory(cat)
            {
                if(trim(cat)!="")
                {
                    window.location.href="addproducts.php?parents="+cat;
                }
            }

            function Check(form)
            {
	    var f1 = document.getElementById('f1');
	    
                if($('#productcode').val()=="")
                {
                    alert("Please Enter Product code!!!");
                    document.f1.productcode.focus();
                    return false;
                }else

                if($('#category').val()=="none")
                {
                    alert("Please Select Category!!!");
                    document.f1.category.focus();
                    return false;
                }else

                if($('#productname').val()=="")
                {
                    alert("Please Enter Product Name!!!");
                    document.f1.productname.focus();
                    return false;
                }else

               
                if($('#price').val()=="")
                {
                    alert("Please Enter Product Price!!!");
                    document.f1.price.focus();
                    return false;
                }else
                if($('#editimage').val()=="")
                {
                    if($('#image1').val()=="")
                    {
                        alert("Please enter upload file name!!!");
                        document.f1.image1.focus();
                        return false;
                    }
                }else{
                
              
                
                submit_test_ajax_form('backend_form', '<?php echo $SITE_URL;?>include/addons/blank_page/index.php?edit_page=true&add_new_page=addproduct', 'container');
                
                }
            }
        </script>



                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>
<?php if ($_GET['product_edit'] != "") {
?> Edit Products<?
                                } else {
                                    if ($_GET['product_delete'] != "") {
?> Confirm Delete Products <?php } else {
?> Add Products <?
                                    }
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
<?php if ($msg != "") {
?>
                                                        <li class="red"><span class="ico"></span><strong class="system_title"><?= $msg; ?></strong></li>
<?php } ?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="backend_form" id="backend_form" action="javascript: Check('f1');" method='POST' enctype="multipart/form-data" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label id="pdcode-label">Product Code:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" id="productcode" name="productcode" size="12" value="<?php echo $pcode; ?>" />
                                                                        </span>
                                                                        <span class="system required">*</span><br /><font style="font-size:10px;">We reccomend using the manufacturers UPC code when available</font>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Category:</label>
                                                                    <div class="inputs">
                                                                        <span id="AddCategoryList" class="input_wrapper blank">
                                                                            <select name="category" id="category">
                                                                                <option value="none" selected="selected">Select one.</option>
<?php
                                                    $qrycat = "select * from categories where categoryID!=1";
                                                    $rescat = db_query($qrycat);
                                                    while ($catval = db_fetch_array($rescat)) {
?>
                                                                                <option <?= $ccode == $catval["categoryID"] ? "selected" : ""; ?> value="<?= $catval["categoryID"]; ?>"><?= $catval["name"]; ?></option>
<?php
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
                                                                    <label>Product Name:</label>
<?php
                                                                            $lengthname = strlen($name);
                                                                            $newlength = 40 - $lengthname;
?>
                                                                            <div class="inputs">
                                                                                <span class="input_wrapper">
                                                                                    <input type="text" name="productname" id="productname" size="32" class="text" value="<?php echo stripslashes($name); ?>" maxlength="40" ONKEYUP="TrackCount(this,'textcount1',40)" ONKEYPRESS="LimitText(this,40)" />
                                                                                </span>
                                                                                <span>Remain Characters: <input type="text" readonly size="2" value="<?= $newlength; ?>" name="textcount1" id="textcount1" class="text" /></span>
                                                                                <span class="required">*</span>
                                                                            </div>
                                                                        </div>
                                                                        <!--[if !IE]>end row<![endif]-->

<?php /* ?>
                                                                              <!--[if !IE]>start row<![endif]-->
                                                                              <div class="row">
                                                                              <label>Winner Title:</label>
                                                                              <?php $lengthname = strlen($winnertitle);
                                                                              $newlength = 40 - $lengthname;
                                                                              ?>
                                                                              <div class="inputs">
                                                                              <span class="input_wrapper">
                                                                              <input type="text" name="winnertitle" size="32" class="text" value="<?php echo stripslashes($winnertitle); ?>" maxlength="40" ONKEYUP="TrackCount(this,'textcount2',40)" ONKEYPRESS="LimitText(this,40)"/>
                                                                              Remain Characters:  <input type="text" readonly size="2" value="<?=$newlength;?>" name="textcount2" class="textbox"/>
                                                                              </span>
                                                                              <span class="system required">*</span>
                                                                              </div>
                                                                              </div>
                                                                              <!--[if !IE]>end row<![endif]-->
                                                                              <?php */ ?>

                                                                            <!--[if !IE]>start row<![endif]-->
                                                                            <div class="row">
                                                                                <label>Product Status:</label>
                                                                                <div class="inputs">
                                                                                    <span class="input_wrapper blank">
                                                                                        <select name="status" id="status">
                                                                                            <option value="1" <?php
                                                                            if ($status == 1) {
                                                                                echo " selected";
                                                                            }
?> selected="selected">Enable</option>
                                                                                <option value="0" <?php
                                                                                if ($status != "" and $status == 0) {
                                                                                    echo " selected";
                                                                                }
?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Default Buy It Now Price:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input name="price" type="text" class="text" id="member_name" value="<?= $price ?>" size="12" maxlength="10"/>
                                                                        </span>
                                                                        <span class="currency"><?= $Currency; ?></span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Your Actual Cost:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input name="actualcost" id="actualcost" type="text" class="text" value="<?= $actualcost ?>" size="12" maxlength="10" />
                                                                        </span>
                                                                        <span class="currency"><?= $Currency; ?></span>
                                                                        <span class="system required">*</span>
									<br /><font style="font-stye:10px;">(for generating reports)</font>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label>MSRP:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input name="msrp" id="msrp" type="text" class="text" value="<?= $msrp ?>" size="12" maxlength="10" />
                                                                        </span>
                                                                        <span class="currency"><?= $Currency; ?></span>
                                                                        <span class="system required">*</span>
									<br /><font style="font-stye:10px;">(for generating reports)</font>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label>Enable Federal Taxes:</label>
                                                                    <div class="inputs">
                                                                 
                                                                           <select name="tax1" id="tax1">
									      <option value="0" <?php if($tax1 != '1'){ echo "selected"; } ?>>No</option>
									      <option value="1" <?php if($tax1 == '1'){ echo "selected"; } ?>>Yes</option>
									   </select>
                                                                      
                                                                        
                                                                     
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label>Enable State / Provincial Taxes:</label>
                                                                    <div class="inputs">
                                                                     
                                                                           <select name="tax2" id="tax2">
									      <option value="0" <?php if($tax2 != '1'){ echo "selected"; } ?>>No</option>
									      <option value="1" <?php if($tax2 == '1'){ echo "selected"; } ?>>Yes</option>
									   </select>
                                                                       
                                                                        
                                                                        
									
                                                                    </div>
                                                                </div>
                                                                 <div class="row">
                                                                    <label>Default Reserve Price:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input name="reserve" id="reserve" type="text" class="text" value="<?= $reserve ?>" size="12" maxlength="10" />
                                                                        </span>
                                                                        <span class="currency">%</span>
                                                                       
									
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label>Shipping Method:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="shippingmethod" id="shippingmethod">
                                                                               
                                                                                <?
                                                                                $qryshipping = "select * from shipping";
                                                                                $resshipping = db_query($qryshipping);
                                                                                while ($objshipping = db_fetch_object($resshipping)) {
                                                                                ?>
										  <option <?= $objshipping->id == $row->shippingmethod ? "selected" : ""; ?> value="<?= $objshipping->id; ?>"><?= $objshipping->shipping_title; ?></option>
                                                                                <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
	  <?php foreach($addons as $key => $value){ 
	  if(file_exists("$BASE_DIR/include/addons/$value/functions_s.php")){
	  include_once("$BASE_DIR/include/addons/$value/functions_s.php");
	    }
	    
	    if(file_exists("$BASE_DIR/include/addons/$value/addproducts.php")){
	      include_once("$BASE_DIR/include/addons/$value/addproducts.php");
	      
	      }
	      
	   }
	  ?>

							
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <!--<div class="row">
                                                                    <label>Short Description:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper textarea_wrapper">
                                                                            <textarea name="short_desc" rows="5" cols="" class="text"><?php echo $short_desc; ?></textarea>
                                                                        </span>
                                                                    </div>
                                                                </div>-->
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Description:</label>
                                                                    <div class="inputs">
<font style="font-size:10px;">Meta Description, Short Description and Keywords are now automatically added from the text provided here</font><br />
                                                                        <span class="">
                                                                            <textarea onclick="CKEDITOR.replace(this.id);" name="description" id="description" rows="20" cols="" class="text"><?php echo $long_desc; ?></textarea>
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <!--<div class="row">
                                                                    <label>Meta Tags(Keywords):</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper textarea_wrapper">
                                                                            <textarea name="metatags" rows="3" cols="" class="text"><?php echo $metatags; ?></textarea>
                                                                        </span>
                                                                    </div>
                                                                </div>-->
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                               <!-- <div class="row">
                                                                    <label>Meta Tags(Description):</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper textarea_wrapper">
                                                                            <textarea name="metadescription" rows="3" cols="" class="text"><?php echo $metadescription; ?></textarea>
                                                                        </span>
                                                                    </div>
                                                                </div>-->
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Attach files:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <input name="image1" type="file" class="solidinput"  value="<?php echo $image; ?>" size="35"/>
                                                                            <input name="image2" type="file" class="solidinput"  value="<?php echo $image; ?>" size="35"/>
                                                                            <input name="image3" type="file" class="solidinput"  value="<?php echo $image; ?>" size="35"/>
                                                                            <input name="image4" type="file" class="solidinput"  value="<?php echo $image; ?>" size="35"/>
                                                                            <span class="system required">(Recommended Image Size: 350 &times; 275)</span>
                                                                        </span>

                                                                        <input type="hidden" name="editimage" value="<?= $_GET['product_edit'] ?>"/>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <div class="row">
                                                                    <label>Image:</label>
                                                                    <div class="buttons" style="padding:0px 0px 20px 0px;">
                                                                        <ul style="text-align:left;">

<?php if (isset($picture1) && file_exists($BASE_DIR . '/uploads/products/thumbs_big/thumbbig_' . $picture1)) {
?>
                                                                                    <li>
                                                                                        <img alt="" src="<?php echo $SITE_URL;?>uploads/products/thumbs_big/thumbbig_<?php echo $picture1; ?>"/><br/>
                                                                                        <span class="button send_form_btn"><span><span>Delete Image</span></span><input type="button" name="" onclick="javascript:ondeleteimage(<?php echo $pid; ?>,1);"/></span>
                                                                                    </li>
<?php } ?>
                                                                            <?php if (isset($picture2) && file_exists($BASE_DIR . '/uploads/products/thumbs_big/thumbbig_' . $picture2)) {
                                                                            ?>
                                                                                    <li><img alt="" src="<?php echo $SITE_URL;?>uploads/products/thumbs_big/thumbbig_<?php echo $picture2; ?>"/><br/>
                                                                                        <span class="button send_form_btn"><span><span>Delete Image</span></span><input type="button" name="" onclick="avascript:ondeleteimage(<?php echo $pid; ?>,2);"/></span>
                                                                                    </li>
<?php } ?>
                                                                            <?php if (isset($picture3) && file_exists($BASE_DIR . 'uploads/products/thumbs_big/thumbbig_' . $picture3)) {
                                                                            ?>
                                                                                    <li><img alt="" src="<?php echo $SITE_URL;?>uploads/products/thumbs_big/thumbbig_<?php echo $picture3; ?>"/><br/>
                                                                                        <span class="button send_form_btn"><span><span>Delete Image</span></span><input type="button" name="" onclick="ondeleteimage(<?php echo $pid; ?>,3);"/></span>
                                                                                    </li>
<?php } ?>
                                                                            <?php if (isset($picture4) && file_exists($BASE_DIR . '/uploads/products/thumbs_big/thumbbig_' . $picture4)) {
                                                                            ?>
                                                                                    <li><img alt="" src="<?php echo $SITE_URL;?>uploads/products/thumbs_big/thumbbig_<?php echo $picture4; ?>"/><br/>
                                                                                        <span class="button send_form_btn"><span><span>Delete Image</span></span><input type="button" name="" onclick="ondeleteimage(<?php echo $pid; ?>,4);"/></span>
                                                                                    </li>
<?php } ?></ul>
                                                                        </div>
                                                                    </div>

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <div class="buttons">
                                                                            <ul>
                                                                                <li>
                                                                                
                                                                                <input type="hidden" id="<?php echo ($_GET['product_edit'] != "") ? 'editproduct' : 'addproduct'; ?>" name="<?php echo ($_GET['product_edit'] != "") ? 'editproduct' : 'addproduct'; ?>" value="" />
<?php
                                                                                if ($_GET['product_delete'] != "" and $pid != "") {
?>
                                                                                    <span class="button send_form_btn"><span><span><?php echo $_GET['product_delete'] != "" ? 'Delete Product' : 'Add Product'; ?></span></span><input name="<?php echo ($_GET['product_delete'] != "") ? 'deleteproduct' : 'addproduct'; ?>" type="button" onClick="delconfirm('addproducts.php?delete=<?= $pid ?>&product_cid=<?= $_REQUEST["product_cid"]; ?>')" /></span>

<?php
                                                                                } else {
?>
                                                                                    <span class="button send_form_btn"><span><span><?php echo ($_GET['product_edit'] != "") ? 'Edit Product' : 'Add Product'; ?></span></span><input type="submit" name="submit" /></span>

<?php
                                                                                }
?>

<?php if ($_GET['product_edit'] != "" || $_GET["product_cid"] != "") {
?>
                                                                                    <input type="hidden" name="edit" value="<?= $_GET['product_edit'] ?>"/>
<?php } ?>
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

<script>
CKEDITOR.replace('description');
</script>
