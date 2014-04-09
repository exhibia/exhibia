<?php
if(file_exists('../../../../config/config.inc.php')){

    include_once '../../../../config/config.inc.php';

    }
else
if(file_exists('../../../config/config.inc.php')){

    include_once '../../../config/config.inc.php';

    }
else if(file_exists('../../config/config.inc.php')){
  
    include_once '../../config/config.inc.php';
}else if(file_exists('../config/config.inc.php')){
	require '../config/config.inc.php';
    }else{
    require 'config/config.inc.php';
    
    
    }


$dbhost = $DBSERVER;
$dbuser = $USERNAME;
$dbpass = $PASSWORD;
$dbname = $DATABASENAME;
//echo $dbname;
$conn = db_connect($dbhost, $dbuser, $dbpass);
db_select_db($dbname, $conn);

?>
