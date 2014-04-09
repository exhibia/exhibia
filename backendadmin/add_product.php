<?php
//echo 'test';
    $pcode = $_POST['productcode'];
    $categoryID = $_REQUEST["category"];
    $name = addslashes($_POST['productname']);
    $productstatus = $_REQUEST["status"];

    $product_qty = $_POST['product_qty'];

    if (isset($_POST["check_product_qty"]) == "checked") {
        $qty_flag = 1;
    } else {
        $qty_flag = 0;
    }


    $msrp = $_REQUEST['msrp'];
    $tax1 = $_REQUEST['tax1'];
    $tax2 = $_REQUEST['tax2'];
    $shippingmethod = $_REQUEST['shippingmethod'];

    $actualcost = $_REQUEST["actualcost"];

    $metatags =implode(", ", top_words( strip_tags( $_REQUEST["description"] ) ) );

    

     $metadescription = strip_tags($_REQUEST["description"]);


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
    $winnertitle = $_POST["winnertitle"];
    $default_reserve=$_POST['reserve'];
    $price = $_POST['price'];
    
    
    
    
    
    
    

    if (empty($_POST['price'])){
        $_POST["price"] = 0; //price can not be negative
	

         ?>
   
	 <?php
			header("location: message.php?msg=120");
        exit;


    }


    // CHECK DUBPLICATE //
    $q = db_query("SELECT * from products WHERE categoryID='" . $parents . "' and product_code='" . $pcode . "'");

    $row = db_fetch_row($q);
    $ex = 0;
    if ($row) {
        $ex = 1;
        $msg = "This Product : " . $pcode . " Already Exists in " . getcategory($parents) . " !";
    }

    if ($ex != 1) {
    $name = str_replace("\"", "&quote;", $name);
     
        $qry = "INSERT INTO products
(categoryID,name,custmer_rating,price,enabled,product_code,short_desc,long_desc,picture1,picture2,picture3,picture4,picture_thumb,metatags,metadescription,actual_cost,product_qty,qty_flag,winner_title
, msrp, default_tx1, default_tx2, default_shippingmethod, default_reserve)  VALUES(" . $categoryID . ",'" . $name . "','','" . $price . "','" . $productstatus . "','" . $pcode . "','" . db_real_escape_string($short_desc) . "','" . db_real_escape_string($long_desc) .
"','','','','','','" . db_real_escape_string($metatags) ."','" . db_real_escape_string($metadescription) . "','$actualcost','$product_qty','$qty_flag','$winnertitle', '$msrp', '$tax1', '$tax2', '$shippingmethod', '$default_reserve')";
      

      if(!db_query($qry)){
	    echo db_error();
	    
	  	
        
        }else{
        

        $pid = db_insert_id();
	$productid = $pid;
        update_products_Count_Value_For_Categories($categoryID);
        // PRODUCT IMAGE UPLOAD FILE //

	  include("uploader.php");


    }
    	  foreach($addons as $key => $value){ 
	  if(file_exists("../include/addons/$value/functions_s.php")){
	  include_once("../include/addons/$value/functions_s.php");
	    }
	    
	    if(file_exists("../include/addons/$value/add_product.php")){
	      include_once("../include/addons/$value/add_product.php");
	      
	      }
	      
	   }
	 
    
 
    }