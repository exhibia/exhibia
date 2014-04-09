<?php

db_connect('localhost', 'root', '');

$sql = db_query("show databases like '%'");

while($row = db_fetch_array($sql)){

echo $row[0];
    db_select_db($row[0]);
    
    
      $sql2  = db_query("select distinct table_name, column_name, column_type
  from information_schema.columns
  where table_schema = '$row[0]' 
    and column_type like 'float%'");
      
      echo $sql2;
      while($row2 = db_fetch_array($sql2)){
    db_query("alter table $row2[0] modify column $row2[1] decimal(9,2) not null default '0.00'");
      
	echo db_error();    
      
      
      }



}
