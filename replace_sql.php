<?php

   $DBSERVER  = 'localhost';
$DATABASENAME  = 'pennyauc_auction';
$USERNAME  = 'root';
$PASSWORD  = 'Apor80@Ross';

$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);

db_select_db($DATABASENAME, $db);

$row = db_query("select * from style_sheets where value like '%../img/%' or value like '%../images/%' and template = 'pas'");

  while($sql = db_fetch_array($row)){


      $value = str_replace("../img/", "pas/", $sql['value']);
      $value = str_replace("../images/", "pas/", $value);
echo "update style_sheets set value = '" . addslashes($value) . "' where id = '$sql[id]'";
    db_query("update style_sheets set value = '" . addslashes($value) . "' where id = '$sql[id]'");


} 
