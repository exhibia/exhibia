<?php
if(db_num_rows(db_query("select * from sitesetting where name = '$_REQUEST[game]:max_players'")) == 0){
    db_query("insert into sitesetting values(null, '$_REQUEST[game]:max_players', '2', '', '', '');");
    db_query("insert into sitesetting values(null, '$_REQUEST[game]:min_players', '2', '', '', '');");

}

$sql_1 = db_fetch_array(db_query("select * from sitesetting where name = '$_REQUEST[game]:max_players' order by id desc limit 1"));
$sql_2 = db_fetch_array(db_query("select * from sitesetting where name = '$_REQUEST[game]:max_players' order by id desc limit 1"));

echo "[{ \"$_REQUEST[game]\" : {\"min_players\":\"$sql_1[value]\", \"max_players\": \"$sql_2[value]\"}}]";