<?php

include("connect.php");


$sql = db_query("select * from sub_categories where category = $_REQUEST[category]");

    while($row = db_fetch_array($sql)){
    
      echo "<option value=\"$row[id]\">$row[name]</option>";
    
    
    }
