<?php
header("Access-Control-Allow-Origin: *");
header("Accept: text/html, text/javascript, text/json");
	    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
	    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	    header("Cache-Control: post-check=0, pre-check=0", false);
	    header("Pragma: no-cache");
	    
ini_set('display_errors', 1);
include("../../../config/config.inc.php");
$_REQUEST['domain'] = str_replace("www.", "", $_REQUEST['domain']);


@db_query("CREATE TABLE IF NOT EXISTS `chat` (
  `id` bigint(20) NOT NULL auto_increment,

  `domain` varchar(200) default NULL,
  `username` varchar(200) NOT NULL,
  `recipient` varchar(200) NOT NULL,
  `message` text not null,
  `read` int(1) not null default '0',
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");


if(!empty($_REQUEST['msg'])){

    db_query("insert into chat values(null, '$_REQUEST[domain]', '" . addslashes($_REQUEST['username']) . "', '" . addslashes($_REQUEST['him']) . "', '" . addslashes($_REQUEST['msg']) . "', 0, NOW());");
}

    
    if(db_num_rows(db_query("select * from chat where `read` !='1' and recipient = '" . addslashes($_REQUEST['username']) . "' and domain = '" . addslashes($_REQUEST['domain']) . "'")) >= 1){
    
	$alert = db_fetch_array(db_query("select * from chat where `read` !='1' and recipient = '" . addslashes($_REQUEST['username']) . "' and domain = '" . addslashes($_REQUEST['domain']) . "'"));
	
	echo "<li id=\"alert_$row[id]\" style=\"display:none;\"><script>highlight($_REQUEST[box]);</script></li>";
    
    
    }
    $sql = db_query("select * from chat where recipient = '" . addslashes($_REQUEST['username']) . "' and domain = '" . addslashes($_REQUEST['domain']) . "' order by id asc limit 50");
    
    
    while($row = db_fetch_array($sql)){
	db_query("update chat set `read`='1' where id = '$row[id]'");
    
	
    
    }
