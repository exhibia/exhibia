<?php

if(db_num_rows(db_query("select * from categories where vendor_reqired = '1'")) >= 1){


    if(empty($_POST['vendor'])){
    
      header("location: message.php?msg_set=" . urlencode("This category needs a vendor Id to complete this action"));
      exit;
      }



}
