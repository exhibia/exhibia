<?php
if(empty($t_menu)){
?>
<div id="navigation" >

  
<?php

if(in_array('topmenu', $addons)){
?>

    
   <?php 
	  echo get_menu('top_menu'); 
    ?>

<?php
}
?>
   
  

  
</div>

<?php $t_menu = 'set'; } ?>