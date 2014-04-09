
<?php
include("../../../config/config.inc.php");

$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);


db_select_db($DATABASENAME, $db);


if(empty($_REQUEST['send_to_server'])){

    $custom  = db_fetch_array(db_query("select * from custom_content where id='$content' limit 1"));
    if(!empty($custom['content'])){
    echo $custom['content'];
    ?>
    <script>
	$('#custom_box_content_<?php echo $content; ?>').css('display', 'block');
    
    
    </script>
    <?php
    }
    
    
}else{
    if(db_num_rows(db_query("select * from custom_content where id = '$_REQUEST[id]'")) == 0){
	db_query("insert into custom_content values('$_REQUEST[id]', '" . db_real_escape_string($_REQUEST['text']) . "');");
      
      echo "Added a new Custom Box";
    }else{
    
	db_query("update custom_content set content = '" . db_real_escape_string($_REQUEST['text']) . "' where id='$_REQUEST[id]' limit 1");
    echo "Updated this custom box";
    
    }
    echo db_error();
}
