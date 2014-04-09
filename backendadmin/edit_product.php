<?php
    $qryselcat = "select * from products where productID='" . $_POST['edit'] . "'";
    $resselcat = db_query($qryselcat);
    $objcat = db_fetch_object($resselcat);

    $pcode = $_POST['productcode'];
    $categoryID = $_REQUEST["category"];
    $name = addslashes($_REQUEST['productname']);
    $productstatus = $_REQUEST["status"];

    /* selection for short_desc
      $long_desc = addslashes($_POST["content"]);
      $length=160;
      $totallen = strlen($long_desc);
      for($i=$length;$i<$totallen;$i++){
      if(substr($long_desc,$i,1)==" "){
      $length = $i;
      break;
      }
      }
      if(strlen($long_desc)>$length){
      $short_desc = nl2br(substr($long_desc,0,$length));
      $short_desc .= "...";
      }else{
      $short_desc = nl2br($long_desc);
      }
      //selection over */
    $msrp = $_REQUEST['msrp'];
    $actualcost = $_REQUEST["actualcost"];
    $tax1 = $_REQUEST['tax1'];
    $tax2 = $_REQUEST['tax2'];
    $shippingmethod = $_REQUEST['shippingmethod'];


    $actualcost = $_REQUEST["actualcost"];

    $actualcost = $_REQUEST["actualcost"];


$metatags =implode(", ", top_words( strip_tags( $_REQUEST["description"] ) ) );

    $metadescription = strip_tags($_REQUEST["description"]);


    $long_desc = $_REQUEST["description"];


    $long_desc = $_REQUEST["description"];
$long_desc_stripped = strip_tags($long_desc);
      $length=160;
      $totallen = strlen($long_desc_stripped);
      for($i=$length;$i<$totallen;$i++){
      if(substr($long_desc_stripped,$i,1)==" "){
      $length = $i;
      break;
      }
      }
      if(strlen($long_desc_stripped)>$length){
      $short_desc = nl2br(substr($long_desc_stripped,0,$length));
      $short_desc .= "...";
      }else{
      $short_desc = nl2br($long_desc_stripped);
      }
  


    $aucstartprice = $_REQUEST["aucstartprice"];
    $aucstartdate = $_REQUEST["aucstartyear"] . "-" . $_REQUEST["aucstartmonth"] . "-" . $_REQUEST["aucstartdate"];
    $aucenddate = $_REQUEST["aucendyear"] . "-" . $_REQUEST["aucendmonth"] . "-" . $_REQUEST["aucenddate"];
    $aucstarttime = $_REQUEST["aucstarthours"] . ":" . $_REQUEST["aucstartminutes"] . ":" . $_REQUEST["aucstartseconds"];
    $aucendtime = $_REQUEST["aucendhours"] . ":" . $_REQUEST["aucendminutes"] . ":" . $_REQUEST["aucendseconds"];
    $aucstatus = $_REQUEST["aucstatus"];
    $auctype = $_REQUEST["auctype"];
    $picture = addslashes($_REQUEST[""]);
    $picture_thumb = addslashes($_REQUEST[""]);
    $product_qty = $_REQUEST['product_qty'];
    $winnertitle = $_POST["winnertitle"];
$reserve = $_POST['reserve'];
    if (isset($_POST["check_product_qty"]) == "checked") {
        $qty_flag = 1;
    } else {
        $qty_flag = 0;
    }

    if (!isset($_POST["price"]) || !$_POST["price"] || $_POST["price"] < 0)
        $_POST["price"] = 0; //price can not be negative
	  $price = $_POST['price'];

//		duplication check
    $pid = $_POST['edit'];

    $qryselect = "select * from products where product_code='$pcode' and categoryID='$categoryID' and productID<>" . $pid;
    $resselect = db_query($qryselect);
    $totalcount = db_affected_rows();

    if ($totalcount > 0) {
       // header("location: message.php?msg=10");
       // exit;
    }
    $name = str_replace("\"", "&quote;", $name);
    
    
    $qryupd = "update products set categoryID='$categoryID', name='" . db_real_escape_string($name) . "', custmer_rating='', price='$price',enabled='$productstatus', product_code='$pcode', short_desc='" . db_real_escape_string($short_desc) . "',
long_desc='" . db_real_escape_string($long_desc) ."',metatags='" . db_real_escape_string($metatags) . "',metadescription='" . db_real_escape_string($metadescription) . "',actual_cost='$actualcost',product_qty='$product_qty',qty_flag='$qty_flag',winner_title='$winnertitle', 
msrp='$msrp', default_tx1='$tax1', default_tx2='$tax2', default_shippingmethod='$shippingmethod', default_reserve = '$reserve' where
productID=" . $pid;
    db_query($qryupd) or die(db_error());
    $pid = $_POST['edit'];
    update_products_Count_Value_For_Categories_Delete($objcat->categoryID);
    update_products_Count_Value_For_Categories($categoryID);


    $tempsql = "select picture1,picture2,picture3,picture4 from products where productID='$pid'";
    $tempret = db_query($tempsql);
    $tempobj = db_fetch_array($tempret);

include("uploader.php");



    	  foreach($addons as $key => $value){ 
	  if(file_exists("../include/addons/$value/functions_s.php")){
	  include_once("../include/addons/$value/functions_s.php");
	    }
	    
	    if(file_exists("../include/addons/$value/edit_product.php")){
	      include_once("../include/addons/$value/edit_product.php");
	      
	      }
	      
	   }
	 