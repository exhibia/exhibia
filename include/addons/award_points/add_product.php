<?php
$free_points = $_REQUEST['free_points'];
$bid_points = $_REQUEST['bid_points'];
$credit_back = $_REQUEST['credit_back'];
            @db_query("alter table payment_order add column auction_id int(11) not null");
            @db_query("alter table payment_order_history add column auction_id int(11) not null");
db_query("update products set free_points = '$free_points' where productID = '$pid'");
db_query("update products set bid_points = '$bid_points' where productID = '$pid'");
db_query("update products set credit_back = '$credit_back' where productID = '$pid'");