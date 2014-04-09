<?php
header("Access-Control-Allow-Origin: *");

//echo 'here we are';
 $qry_g = db_query("select * from sitesetting where name like 'master_game_settings%'");
 
 if(db_num_rows($qry_g) == 0){
    db_query("insert into sitesetting (id, name, value) values(null, 'master_game_settings:which_to_use', 'free_');");
    db_query("insert into sitesetting (id, name, value) values(null, 'master_game_settings:allow_user_bid_price', '');");
    db_query("insert into sitesetting (id, name, value) values(null, 'master_game_settings:price_per_bid', '1');");
 }

 



 
 $master_game_settings = array();
 if(db_num_rows($qry_g) == 0){
	  echo "Please Fill out your game settings in the backend";
 }else{
      while($row = db_fetch_array($qry_g)){
    
	    $setting = explode(":", $row['name']);
	    
	    $master_game_settings[$setting[1]] = $row['value']; 
      
      }
// $master_game_settings['which_to_use'] = 'free_';

 
      }
 
 
 
 
 if($master_game_settings['which_to_use'] == 'free_'){
 
    $table_selector = 'free_';
    $table_selector_two = 'free_';
    $html_element_prefix = 'free_';
    
 }else{
 
    $table_selector = '';
    $table_selector_two = '';
    $html_element_prefix = '';
 
 }
 if($master_game_settings['which_to_pay_out'] == 'free_'){
 
    $table_selector_po = 'free_';
    $table_selector_two_po = 'free_';
    $html_element_prefix_po = 'free_';
    $pre = 'free_';
 }else{
 
    $table_selector_po = 'bid_';
    $table_selector_two_po = '';
    $html_element_prefix_po = '';
    $pre = 'final_';
 
 }
 