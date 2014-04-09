<?php

if(!empty($_REQUEST['change_template'])){

db_query("update sitesetting set value = '$_REQUEST[change_template]' where name = 'template'");
db_query("update sitesetting set value = 'template:$_REQUEST[change_template]' where value like 'template:%'");

	    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
	    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	    header("Cache-Control: post-check=0, pre-check=0", false);
	    header("Pragma: no-cache");
	   // header("location: index.php?bust_cache=true");


}
