<?php 
db_connect($DBSERVER, $USERNAME, $PASSWORD);
db_select_db($DATABASENAME);

if(!empty($_REQUEST['domain'])){
$domain = $_REQUEST['domain'];
}
$trivia  = array();
$trivia_qry = "select * from sitesetting where name like '%$domain:games:trivia:%'";

$trivia_sql = db_query($trivia_qry);


if(db_num_rows($trivia_sql) < 4){
            $trivia_qry = "select * from sitesetting where name like 'games:trivia:%'";
	   if(db_num_rows(db_query($trivia_qry)) == 0){
	      db_query("insert into sitesetting(id, name, value) values(null, 'games:trivia:take', 10), (id, name, value) ,(null, 'games:trivia:reward', 10),(null, 'games:trivia:take_from', 'free_bids'),(null, 'games:trivia:reward_with', 'final_bids');");

	   
	   }
	   
	   $trivia_sql = db_query($trivia_qry);
	    while($trivia_row = db_fetch_array($trivia_sql)){

		$setting = explode(":", $trivia_row['name']);
		$trivia[$setting[2]] = $trivia_row['value'];



	  }
	 
}else{
    $trivia_sql = db_query($trivia_qry);
    while($trivia_row = db_fetch_array($trivia_sql)){

	$setting = explode(":", $trivia_row['name']);
	$trivia[$setting[3]] = $trivia_row['value'];



    }


}

?>