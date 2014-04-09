<?php 
db_connect($DBSERVER, $USERNAME, $PASSWORD);
db_select_db($DATABASENAME, $db);

if(!empty($_REQUEST['domain'])){
$domain = $_REQUEST['domain'];
}
$connect4  = array();
$connect4_qry = "select * from sitesetting where name like '%$domain:games:connect4:%'";

$connect4_sql = db_query($connect4_qry);


if(db_num_rows($connect4_sql) < 4){
            $connect4_qry = "select * from sitesetting where name like 'games:connect4:%'";
	   if(db_num_rows(db_query($connect4_qry)) == 0){
	      db_query("insert into sitesetting(id, name, value) values(null, 'games:connect4:take', 10), (id, name, value) ,(null, 'games:connect4:reward', 10),(null, 'games:connect4:take_from', 'free_bids'),(null, 'games:connect4:reward_with', 'final_bids');");

	   
	   }
	   
	   $connect4_sql = db_query($connect4_qry);
	    while($connect4_row = db_fetch_array($connect4_sql)){

		$setting = explode(":", $connect4_row['name']);
		$connect4[$setting[2]] = $connect4_row['value'];



	  }
	 
}else{
    $connect4_sql = db_query($connect4_qry);
    while($connect4_row = db_fetch_array($connect4_sql)){

	$setting = explode(":", $connect4_row['name']);
	$connect4[$setting[3]] = $connect4_row['value'];



    }


}

?>