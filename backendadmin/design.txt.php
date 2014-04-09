<?php





echo db_error();
$Active = "Design Suite";

$MainLinksArray = array (
        // (item name, link, haschild)
        array ("Design Suite", "#", 1),
        
        /*array ("Shipping Management", "#", 1),
        array ("Manage Newsletter", "#", 1),
        array ("Manage Communities", "#", 1),
        array("Coupon Manage","#",1)*/
);
/*element 3, dashboard class, 4. horizontal  submenu class*/
$ChildLinksArray = array (
        // (subitem name, script name, item's position)
        array ("Logo", "designsuite.php?a_page=logo.php&type=logo", 0,'design1','sm1'),
        array ("Slider Images", "designsuite.php?a_page=slider.php&type=slider", 0,'design1','sm1'),
        array ("Comment Box", "designsuite.php?a_page=special.php&type=special", 0,'design1','sm1'),
        array ("Constants", "designsuite.php?a_page=edit_text.php&type=edit_text", 0,'design1','sm1'),
        array ("Menus", "designsuite.php?a_page=menus.php&type=menus", 0,'design1','sm1'),
        array ("Background", "designsuite.php?a_page=background.php&type=background", 0,'design1','sm1'),
       //  array ("Style Sheets", "designsuite.php?page=stylesheets.php", 0,'design3','sm2'),
       // array ("Modules", "designsuite.php?a_page=modules.php&type=modules", 0,'design1','sm1'),
      //  array ("Modules", "designsuite.php?a_page=modules.php&type=modules", 0,'design1','sm1'),
        
      /* array ("Templates", "designsuite.php?page=background.php", 0,'design2','sm1'),
       
        array ("JQuery", "designsuite.php?page=managejquery.php", 0,'design4','sm3'),
        array ("Languages", "designsuite.php?page=addlanguage.php", 0,'design5','sm4'),
*/
);

$m=count($ChildLinksArray);
if($_SERVER['SERVER_NAME'] == 'pennyauctionsoftdemo.com'){

$ChildLinksArray[$m] = array ("Create Language", "designsuite.php?a_page=addlanguage.php", 0,'design1','sm1');

}
$m++;
//$ChildLinksArray[$m] = array ("Slider Images", "designsuite.php?a_page=slider.php", 0,'design1','sm1');
?>