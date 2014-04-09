<?php
if(in_array('design_suite', $addons) & $admin >= 1){
?>
<h3>Advertising narrow</h3>
<?php
}
?>
<div style="margin:auto;">
    <div style="float:left;">
<?php

showAdvertise(3);
?>

    </div>
    <div style="float:right;">
        <?php showAdvertise(4);?>
    </div>

    <div class="clear"></div>
</div> 
