<?php
$game_server = 'http://pennyauctionsoftdemo.com';
include("$BASE_DIR/include/addons/games/api/connect4.config.inc.php");
$_REQUEST['domain'] = str_replace("www.", "", $_REQUEST['domain']);



?>

[
<?php
    $sql = db_query("SELECT id FROM trivia_questions ORDER BY RAND() LIMIT 25;");
    while($row = db_fetch_array($sql)){
    $sql_c = db_fetch_array(("select * from trivia_answers where q_id = $row[id] where correct = 1"));
    ?>
   {"que":"<?php echo addslashes($row['question']); ?>", 
    "ca":"<?php echo $sql_c['answer']; ?>",
	"ia":[
    <?php
	$sql_2 = db_query("select * from trivia_answers where q_id = $row[id] where correct != 1");
	
    ?>

 
	<?php
	$str = '';
	    while($row_s = db_fetch_array($sql_2)){
		?>
		 <?php $str .= "\"$row_s[answer]\","; ?> 
	   <?php } ?>
	   
	  <?php echo rtrim($str, "," ); ?> ]},
    <?
    
    }
?>
{ result: "success"} ]