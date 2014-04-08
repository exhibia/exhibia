<?php
require("config/connect.php");
if(!empty($_REQUEST['id'])){
    $qry = db_query("select * from bidpack where id = '$_REQUEST[id]'");
    $data = db_fetch_array($qry);
    $data['bidpackid'] = base64_encode($data['id']);
    echo json_encode($data);
}
  