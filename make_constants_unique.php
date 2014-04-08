<?php
ini_set('max_execution_time', 0);
shell_exec("rm new_languages.sql -f");
@unlink("rm new_languages.sql");
shell_exec("touch new_languages.sql");
include("config/connect.php");
$f = fopen("new_languages.sql", "a");


		  if(php_sapi_name() != 'cli'){

		      echo "<html><head></head><body><pre>";
		  }
	$text = "\n";
	$text .= "-- NEXT_QUERY --\n";
	$text .= "\n";
	
	$text .= "delete from language;\n";
	
	$text .= "\n";
	$text .= "-- NEXT_QUERY --\n";
	$text .= "\n";
	
	$text .= "delete from languages;\n";
	
	echo $text;
	fwrite($f, $text);
	if(!empty($_REQUEST['lang'])){
	    $lang_in = " language = '$_REQUEST[lang]'";
	  }else{
	  $lang_in = "  enable >= 1 ";
	  }
$sql_ls = db_query("select * from language where $lang_in");

while($row_ls = db_fetch_array($sql_ls)){

	$text = "\n";
	$text .= "-- NEXT_QUERY --\n";
	$text .= "\n";
	
	$text .= "INSERT INTO `language` (`id`, `language`, `languagename`, `enable`, `flag`) values ($row_ls[id],'$row_ls[language]','$row_ls[languagename]',1,'$row_ls[flag]');\n";
	
	echo $text;
	fwrite($f, $text);




$sql_l = db_query("select distinct(language) from languages where language = '$row_ls[languagename]'");

while($row_l = db_fetch_array($sql_l)){



$sql  = db_query("select distinct(constant) from languages where language = '$row_l[language]' order by constant asc");


    while($row  = db_fetch_array($sql)){
    
      $sql2 = db_query("select * from languages where constant = '$row[constant]' and language = '$row_l[language]' order by id desc limit 1");
      
	while($row2 = db_fetch_array($sql2)){
	
	
	$text = "\n";
	$text .= "-- NEXT_QUERY --\n";
	$text .= "\n";
	
	$text .= "INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, '$row_l[language]', '$row[constant]', '". addslashes(str_replace("\"", "&quote;", str_replace("'", "`", stripslashes($row2['value'])))) . "');\n";
	echo $text;
	fwrite($f, $text);
	
	
	}
	
}


}
}
echo db_error();
if(php_sapi_name() != 'cli'){
	echo "</pre></body></html>";
	}

fclose($f);