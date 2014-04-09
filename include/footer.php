<?php
include('config/config.inc.php'); 
if(file_exists("$BASE_DIR/include/$template/footer.php")){

include("$BASE_DIR/include/$template/footer.php");

}else{
?>
<div id="footer">
<?php 
       get_menu('footer_menu'); 
?>

 <span id="copyright" style="float:right;">Copyright &copy;<?php echo date("Y");?>
<?php echo $SITE_NM;?>.com. <?php echo ALL_RIGHTS_RESERVED; ?>.</span>

</div><!-- /footer --> 

<?php 
  foreach($addons as $key => $value){

      if(file_exists("include/addons/$value/footer.php")){
	?><?php
	include_once("include/addons/$value/footer.php");
      }
  }
  
}
?>




