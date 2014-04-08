<?php
include("config/config.inc.php");
db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
db_select_db($DATABASENAME);


echo "fixing dbase $row[0]" . "\n";
//    db_select_db($row[0]);
    
    
      $sql2  = db_query("select distinct table_name, column_name, column_type from information_schema.columns where table_schema = '$row[0]' and column_type like 'float%' or column_type like 'decimal%'");
      echo "Finding tables with floats on $row[0]\n\n";

      echo "select distinct table_name, column_name, column_type from information_schema.columns where table_schema = '$row[0]' and column_type like 'float%' or column_type like 'decimal%'\n";
     

		 while($row2 = db_fetch_array($sql2)){

		echo "Fixing table $row2[0] on dbase $row[0]\n\n";
   			 db_query("alter table $row[0].$row2[0] modify column $row2[1] decimal(9,2) not null default '0.00'");
      
				echo db_error();    
      
      
      			}




