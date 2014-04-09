<?php 

include("../../../../config/config.inc.php");

$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);


db_select_db($DATABASENAME, $db);


if(db_num_rows(db_query("select * from products where productID = '$_REQUEST[update_record]'")) >= 1){



    db_query("update products set $_REQUEST[row] = '" . addslashes(urldecode($_REQUEST['value'])) . "'");
    echo db_error();


    echo "Updated $_REQUEST[row] for product Id $_REQUEST[update_record]";

}
