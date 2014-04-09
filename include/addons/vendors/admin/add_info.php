<?php
if(empty($_REQUEST['id'])){
$id=db_insert_id();
}else{
$id = $_REQUEST['id'];
}
if(!empty($_REQUEST['add_vendor'])){


    $sqlu="update registration set vendors = '$_REQUEST[add_vendor]' where id='$id'";
    if(db_num_rows(db_query("select * from vendors where company_name = '$_REQUEST[vendor]'")) == 0){
    
	db_query("insert into vendors(id, company_name) values(null, '" . addslashes($_REQUEST['add_vendor']) . "');");
    
    }
}else{

    $sqlu="update registration set vendor = '$_REQUEST[vendor]', admin_user_flag = '6' where id='$id'";
    
    
    
}

    db_query($sqlu);
