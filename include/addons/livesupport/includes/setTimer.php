<?php
@session_start();

if(!empty($_GET['user'])) {
// mysql
include "base.php";

db_query("UPDATE users SET keepAlive = '".time()."', available = 'yes' WHERE username = '".$_GET['user']."' ");

}
?>
