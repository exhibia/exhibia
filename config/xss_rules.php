<?php
foreach($_GET as $key => $value){

    if(preg_match("/script(.*)/", $_GET[$key])){
	$xss = true;
	}

}
if(isset($xss)){
if($xss == true){
foreach($_GET as $key => $value){
$_GET[$key] = '';
//unset($_GET[$key]);
}
echo "bug off with your outdated attempts at xss...try better, if successful then please brag to support@pennyauctionsoft.com. What that's the best you got? Come on try harder";
die();
}
}
foreach($_POST as $key => $value){

    if(preg_match("/<script(.*)/", $_POST[$key])){
	$xss = true;
	}

}
if(isset($xss)){
if($xss == true){
foreach($_POST as $key => $value){
//unset($_POST[$key]);
}
echo "bug off with your outdated attempts at xss...try better, if successful then please brag to support@pennyauctionsoft.com. What that's the best you got? Come on try harder";
die();
}
}
if(empty($installer) & empty($json_script) & empty($position)){
foreach($_POST as $key => $value){

    //$_POST[$key] = mysql_real_escape_string($value);
}
foreach($_GET as $key => $value){

   // $_GET[$key] = mysql_real_escape_String($_GET[$key]);
}
}

@define('db_type', 'mysql');
//define('db_type', 'mysqli');
//define('db_type', 'postgres');

if(!function_exists('db_select_db')){
function db_select_db($DATABASENAME, $db_connection = null){

global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;
 
    switch(db_type){
	case('mysqli'):
	  if(!mysqli_ping()){
	    $db = mysqli_connect($DBSERVER, $USERNAME, $PASSWORD);
	  }
	    $ob = mysqli_select_db($db, $DATABASENAME);
	 
	break;
	case('mysql'):
	
	    $db = mysql_connect($DBSERVER, $USERNAME, $PASSWORD);
	 
	    $ob = mysql_select_db($DATABASENAME, $db);
	 
	break;
	case('postgres'):
	if(!pg_ping()){
	  $ob = pg_connect("host=$DATABASENAME port=5432 dbname=$DATABASENAME user=$USERNAME password=$PASSWORD");
	
	}else{
	  $ob = $db;
	  
	}
	break;

    }


return $ob; 

}
function db_fetch_field($qry){ global $db;
global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;

    switch(db_type){
	case('mysqli'):
	if(!mysqli_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
	    
	  }
	  $ob = mysqli_fetch_field($qry);
	break;
	case('mysql'):
	if(!mysql_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	    db_select_db($DATABASENAME, $db);
	    
	  }
	  $ob = mysql_fetch_field($qry);
	break;
	case('postgres'):

	break;

    }
        
 
 return $ob; 
}

function db_result($qry, $re, $field = 0){
global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;

    switch(db_type){
	case('mysqli'):
	if(!mysqli_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD,$DATABASENAME);
	    
	  }
	  $ob = mysql_result($qry, $re);
	break;
	case('mysql'):
	if(!mysql_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	    db_select_db($DATABASENAME, $db);
	    
	  }
	  $ob = mysql_result($qry, $re);
	break;
	case('postgres'):

	break;

    }
        
 
 return $ob; 
}
function db_fetch_assoc($qry){

global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;
    switch(db_type){
	case('mysqli'):
	if(!mysqli_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
	    
	  }
	  $ob = mysqli_fetch_assoc($qry);
	break;
	case('mysql'):
	if(!mysql_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	    db_select_db($DATABASENAME, $db);
	    
	  }
	  $ob = mysql_fetch_assoc($qry);
	break;
	case('mysqlnd'):
	  $ob = mysql_fetch_assoc($qry);
	break;
	case('postgres'):

	break;

    }
        
 
 return $ob; 
}

function db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME = null){
global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;



    switch(db_type){
	case('mysqli'):
	  if(!$db){
	      $ob = mysqli_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
	  }else{
	      $ob = $db;
	  }
	break;
	case('mysql'):
	  if(!$db){
	    $ob = mysql_connect($DBSERVER, $USERNAME, $PASSWORD);
	  }else{
	    $ob = $db;
	  }
	
	break;
	case('postgres'):

	break;

    }
 return $ob; 
}
function db_real_escape_string($str){
global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;

    switch(db_type){
	case('mysqli'):
	    
	if(!mysql_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
	    
	  }	    
	    $ob = mysqli_real_escape_string($str);
	break;
	case('mysql'):
	if(!mysql_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	    db_select_db($DATABASENAME, $db);
	    
	  }
	    $ob = mysql_real_escape_string($str);
	break;
	case('postgres'):

	break;

    }
  
 return $ob; 



}
function db_fetch_array($qry, $assoc = null){

global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;
if(!empty($qry)){
    switch(db_type){
	case('mysqli'):
	    if(!mysqli_ping()){
	      $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	      db_select_db($DATABASENAME, $db);
	    }	    
	    
	    $ob = mysqli_fetch_array($qry, MYSQLI_BOTH);
	break;
	case('mysql'):
	    if(!mysql_ping()){
	      $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	      db_select_db($DATABASENAME, $db);
	    }
	    if($assoc){
	      $ob = @mysql_fetch_array($qry, $assoc);
	    }else{
	      $ob = @mysql_fetch_array($qry);
	    }
	break;
	case('postgres'):

	break;

    }
  echo db_error();
     
 
 return $ob; 
 }

}
function db_num_rows($qry){
if(!empty($qry)){
global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;

    switch(db_type){
	case('mysqli'):
	if(!mysqli_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
	    
	  }
	    $ob = mysqli_num_rows($qry);
	break;
	case('mysql'):
	if(!mysql_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	    db_select_db($DATABASENAME, $db);
	    
	  }
	 
	    $ob = mysql_num_rows($qry);
	break;
	case('postgres'):

	break;

    }
        //
 
 return $ob;
 }
}
function db_fetch_object($qry){
global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;
if(!empty($qry)){

    switch(db_type){
	case('mysqli'):
	if(!mysqli_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
	    
	  }
	    $ob = mysqli_fetch_object($qry);
	break;
	case('mysql'):
	if(!mysql_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	    db_select_db($DATABASENAME, $db);
	    
	  }
	    $ob = mysql_fetch_object($qry);
	break;
	case('postgres'):

	break;

    }
    
        
 
 return $ob; 
 }
}
function db_close($obj){
global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;

    switch(db_type){
	case('mysqli'):
	if(!mysqli_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
	    
	  }
	  $ob = mysqli_close($obj);
	break;
	case('mysql'):
	if(!mysql_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	    db_select_db($DATABASENAME, $db);
	    
	  }
	  $ob = mysql_close($obj);
	break;
	case('postgres'):

	break;

    }
 return $ob; 
}
function db_affected_rows($qry){
global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;

    switch(db_type){
	case('mysqli'):
	if(!mysqli_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
	    
	  }
	  $ob = mysqli_affected_rows($qry);
	break;
	case('mysql'):
	if(!mysql_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	    db_select_db($DATABASENAME, $db);
	    
	  }
	  $ob = mysql_affected_rows($qry);
	break;
	case('postgres'):

	break;

    }
        
 
 return $ob; 
}

function db_query($sql, $db = null){
global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;

    switch(db_type){
	case('mysqli'):
	
	  $db = mysqli_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
	
	  $ob = mysqli_query($db, $sql);
	break;
	case('mysql'):
	
	      $db = mysql_connect($DBSERVER, $USERNAME, $PASSWORD);
	
	      mysql_select_db($DATABASENAME, $db);
	    
	      $ob = mysql_query($sql);
	      
	      
	break;
	case('postgres'):

	break;

    }
    
 return $ob; 
}
function db_error($db = null){

global $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME, $SITE_NM, $db;
    switch(db_type){
	case('mysqli'):
	if(!mysqli_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
	    
	  }
	  $ob = mysqli_error($db);
	break;
	case('mysql'):
	if(!mysql_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	    db_select_db($DATABASENAME, $db);
	    
	  }
	  $ob = ''; 
	break;
	case('postgres'):

	break;

    }
    if(!empty($ob)){
//	mail('edward.goodnow@gmail.com', 'Error in program', 'Hey guys ' . $SITE_NM . ' experienced a SQL error the text of the error was ' . $ob . ' he is using ' . db_type . ' for his db engine'); 
      //$fp = fopen('error_log.txt', 'a+');
     // fwrite($fp, 'Error in program', 'Hey guys ' . $SITE_NM . ' experienced a SQL error the text of the error was ' . $ob . ' he is using ' . db_type . ' for his db engine');
     // fclose($fp);

    }
 return $ob; 
}
function db_fetch_row($qry){
global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;

    switch(db_type){
	case('mysqli'):
	if(!mysqli_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
	    
	  }
	  $ob = mysqli_fetch_row($qry, MYSQLI_BOTH);
	break;
	case('mysql'):
	if(!mysql_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	    db_select_db($DATABASENAME, $db);
	    
	  }
	  $ob = mysql_fetch_row($qry);
	break;
	case('postgres'):

	break;

    }
    
 
 return $ob; 
}
function db_free_result($obj = null){
global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;
if(!empty($obj)){

    switch(db_type){
	case('mysqli'):
	if(!mysqli_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
	    
	  }
	  $ob = mysqli_free_result($obj);
	break;
	case('mysql'):
	if(!mysql_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	    db_select_db($DATABASENAME, $db);
	    
	  }
	  $ob = mysql_free_result($obj);
	break;
	case('postgres'):

	break;

    }
 return $ob;
 }
}
function pg_insert_id($tablename,$fieldname)
{
$query = "SELECT currval('${tablename}_${fieldname}_seq')";
$result=pg_exec($this->_connectionID, $query);
if ($result) {
$arr = @pg_fetch_row($result,0);
pg_freeresult($result);
if (isset($arr[0])) return $arr[0];
}
return false;
}
function db_insert_id($obj = null){
global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;

    switch(db_type){
	case('mysqli'):
	if(!$obj){
	  $obj = mysqli_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
	}
	   $ob = mysqli_insert_id($obj);
	break;
	case('mysql'):
	if(!mysql_ping()){
	    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
	    db_select_db($DATABASENAME, $db);
	    
	  }
	    $ob = mysql_insert_id();
	break;
	case('postgres'):

	break;

    }
 return $ob; 
}
function db_pconnect($DBSERVER, $USERNAME, $PASSWORD){
global $DATABASENAME, $DBSERVER, $USERNAME, $PASSWORD, $db;

    switch(db_type){
	case('mysqli'):
	  if(!$db){
	    $ob = mysql_pconnect("p:" . $DBSERVER, $USERNAME, $PASSWORD);
	  }else{
	    $ob = $db;
	  }
	break;
	case('mysql'):
	  if(!$db){
	    $ob = mysql_pconnect($DBSERVER, $USERNAME, $PASSWORD);
	   }else{
	    $ob = $db;
	  }
	break;
	case('postgres'):
	  if(!$db){
	    $ob = pg_pconnect("host=$DATABASENAME port=5432 dbname=$DATABASENAME user=$USERNAME password=$PASSWORD");
	  }else{
	    $ob = $db;
	  }
	break;

    }
 return $ob; 
}
}