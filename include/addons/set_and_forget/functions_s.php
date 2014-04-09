<?php


function  get_set_and_forget($categoryID, $productID, $DATABASENAME, $DBSERVER,  $DBUSER, $DBPASSWORD){
    db_connect($DBSERVER,  $DBUSER, $DBPASSWORD);
    db_select_db($DATABASENAME);

      if(db_num_rows(db_query("select * from categories where categoryID = '$categoryID' and set_and_forget = '1'")) >= 1){
	if(db_num_rows(db_query("select * from products where productID = '$productID' and set_and_forget = '3'")) == 0){
	  return '1';
	}else{
	  
	    return '0';
	  
	  
	  }
      
      }else{
      
	  if(db_num_rows(db_query("select * from products where productID = '$productID' and set_and_forget = '1'")) >= 1){
	  
	      return '1';
	  
	  }else{
	  
	    return '0';
	  
	  
	  }
      
      
      }


}


function get_reserve($categoryID, $productID, $DATABASENAME, $DBSERVER,  $DBUSER, $DBPASSWORD){


    db_connect($DBSERVER,  $DBUSER, $DBPASSWORD);
    db_select_db($DATABASENAME);
@db_query("alter table products add column enable_reserve tinyint(1) default'0' null;");

    if(db_num_rows(db_query("select * from products where productID = '$productID' and enable_reserve = '1'")) >= 1){
    
    return '1';
    }



}