<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="Lang" content="en"/>
<meta name="author" content="Bahadır Çelebi"/>

<title>Inviter Test</title>
<script type="text/javascript" src="lib/jquery-1.4.2.min.js" ></script>     
<script type="text/javascript" src="lib/thickbox.js" ></script>    
<script type="text/javascript" src="lib/lib.js" ></script>
<link rel="stylesheet" type="text/css" href="lib/css1.css" /> 
<link rel="stylesheet" type="text/css" href="lib/thickbox.css" />  
</head>
<body>        

<?php

 include("inc.init.php");
 
 $inviter = new inviter();
 
 $inviter->set_width(190); // İnvite form width.
 
 $inviter->set_bgcolor("#EFEFEF"); // İnvite form bgcolor.
 
 $inviter->set_subject("You are invited ..."); // invite message subject.
 
 $inviter->set_title("You are invited to yourwebsite.com"); // Message title.
 
 $inviter->set_from("info@yourwebsite.com");
 
 $inviter->create_inviter_form();
     
?>
    
</body>
</html>