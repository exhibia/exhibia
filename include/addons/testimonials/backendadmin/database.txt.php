<?php

$count = count($MainLinksArray);
$MainLinksArray[$count] = array("Manage Testimonials", "#", $count);


/*element 3, dashboard class, 4. horizontal  submenu class*/
array_push($ChildLinksArray,  array ("Edit Testimonials", "getplugin.php?plugin=testimonials", $count,'database1','sm1'));

?>


