<?php
$str = '';
$versions_sql = db_query("select * from sitesetting where name= 'version'");

while($row = db_fetch_array($versions_sql)){

    $info_ver = explode(":", $row['value']);

    $str .= $info_ver[0] . "=" . $info_ver[1] . "&";
}


?>


<script>

      $.get('<?php echo $SITE_URL;?>include/addons/notifications/curl.php?function=checkupdates&<?php echo $str;?>', function(response){

	    $("#notifications_area").html(response);

	  }
      );

</script>