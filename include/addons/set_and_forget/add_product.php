<?php


if($_REQUEST['set_and_forget'] == '1'){


db_query("update products set set_and_forget = '1' where productID = '$pid'");



}else{


db_query("update products set set_and_forget = '3' where productID = '$pid'");



}


if($_REQUEST['enable_reserve'] == '1'){


db_query("update products set enable_reserve = '1' where productID = '$pid'");



}else{


db_query("update products set enable_reserve = '3' where productID = '$pid'");



}
