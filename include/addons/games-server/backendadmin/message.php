<?php
switch($_REQUEST['msg']){

    case 11:
        $Message1 = $error;
        $Message2 = "This Category Linked to Games!!!<a href='get_addon.php?addon=games&page=admin/managecat.php'> Click Here </a> to go back";
        break;
    case 12:
        $Message1 = $success;
        $Message2 = "Game Category Deleted Successfully!!!<a href='get_addon.php?addon=games&page=admin/managecat.php'> Click Here </a> to go back";
        break;



}


