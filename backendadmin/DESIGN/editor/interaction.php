 
<?php
    include($_SERVER['DOCUMENT_ROOT']. '/config/config.inc.php');
    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
      if (!$db) {
	  die('Could not connecttest: ' . db_error());
      }

      db_select_db($DATABASENAME, $db);


?>
<script>

  

</script>