<?php
ini_set('display_errors', 1);

 $PATH = realpath(dirname(__FILE__));
 
 
include("../../../../config/connect.php");
if(db_num_rows(db_query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'rc_$DATABASENAME'")) == 0 ){

db_query("CREATE DATABASE IF NOT EXISTS rc_$DATABASENAME");
db_query("GRANT ALL PRIVILEGES ON rc_$DATABASENAME.* TO $USERNAME@localhost
    IDENTIFIED BY '$PASSWORD'");
   
    shell_exec("mysql -u $USERNAME -p$PASSWORD rc_$DATABASENAME < $PATH/SQL/mysql.initial.sql");
    
    
    
    }
    
    
    
    $email_info = explode("@", $adminemailadd);
    

    
    
    db_select_db('rc_' . $DATABASENAME);
    if(db_num_rows(db_query("select * from users where username = '$email_info[0]' and mail_host = '$email_info[1]'")) == 0){
    
    
	db_query("insert into users values(null, '$email_info[0]', '$email_info[1]', '$adminemailadd', '" . date("Y-m-d H:i:s") . "', NOW(), '', '');;");
	
	}
$PATH = str_replace('backendadmin', '', realpath(dirname(__FILE__)));
define('INSTALL_PATH', $PATH);


    include("$PATH/index.php");
    
   
    db_select_db($DATABASENAME);
?>

