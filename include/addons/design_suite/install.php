<?php
if(empty($BASE_DIR)){
include("../../../config/config.inc.php");

}else{
$backend = 'set';
include("$BASE_DIR/config/config.inc.php");

}



if(!empty($yes_do_it_for_real)){
if(empty($backend)){
?>

<script>

window.open("<?php echo $SITE_URL;?>/css/styles.php?template=<?php echo $template;?>&page=<?php echo $template;?>.css", "css installer","height=100,width=100", true);


</script>

<?php

}else{
$ds_enabled = 1;
$backend = 'set';
include("$BASE_DIR/css/styles.php");


}
}