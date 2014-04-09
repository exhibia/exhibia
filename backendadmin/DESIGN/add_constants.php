<?php
include("../../config/config.inc.php");
if(empty($_REQUEST['constant'])){

?>
Constant:
      <input id="constant_<?php echo $_REQUEST['idx'];?>" name= "constant[]" value="" onkeyup="add_value($(this).val(), '<?php echo $_REQUEST['idx'];?>');" />
    

<?php
}else{

 if(db_num_rows(db_query("select * from languages where constant = '$_REQUEST[constant]' and language = '$_REQUEST[lang]'")) >= 1){
    
	echo "<b>That constant already exists, Please edit it above</b>";
    
    }else{
    echo $_REQUEST['constant'];
    
	?>
	
=> Value:	<textarea id="value[<?php echo $_REQUEST['constant']; ?>]"  name="value[<?php echo $_REQUEST['constant']; ?>]"></textarea>
    
	<?php
    }
    echo db_error();
    
 }

