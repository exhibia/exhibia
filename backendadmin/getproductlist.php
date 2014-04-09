<?php

include("connect.php");
include("functions.php");
if ($_REQUEST["crid"] != "") {
    if ($_REQUEST['crid'] != '1') {
    
        $crid = $_REQUEST["crid"];
	  
	  
        $content = '<option value="none">select one</option>';
 
        $qryp = "select productID, name from products where categoryID='" . $crid . "'";
	
        $resp = db_query($qryp);

        $totalp = db_num_rows($resp);
	
       
            while ($objp = db_fetch_array($resp)) {
             
                    $content .= '<option value="' . $objp["productID"] . '">' . stripslashes($objp["name"]) . '</option>';
                
            }
    
       
    } else {
        $sql="select bidpack_name,id from bidpack";
        $result=db_query($sql);
        $content = '<option value="none">select one</option>';
        while($obj=  db_fetch_array($result)){
            $content .= '<option value="' . $obj["id"] . '">' . stripslashes($obj["bidpack_name"]) . '</option>';
        }
      
    }
    
      echo $content;
}
?>