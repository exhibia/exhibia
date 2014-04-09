<?php
$Active = "Bingo";

$MainLinksArray = array (
        // (item name, link, haschild)
        array ("Admin", "#", 1),
        
        /*array ("Shipping Management", "#", 1),
        array ("Manage Newsletter", "#", 1),
        array ("Manage Communities", "#", 1),
        array("Coupon Manage","#",1)*/
);
/*element 3, dashboard class, 4. horizontal  submenu class*/
$ChildLinksArray = array (
        // (subitem name, script name, item's position)
        array ("Schedule Games", "getplugin.php?page=schedule.php&plugin=bingo", 0,'design1','sm1'),
       // array ("Past Games", "getplugin.php?page=schedule_past.php&plugin=bingo", 0,'design1','sm1'),
        
        );
