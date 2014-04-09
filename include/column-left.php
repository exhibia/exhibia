<?php
if(empty($dont_show_left)){
$dont_show_left = array();
}
//Uncomment items below to remove them from ALL PAGES for ALL TEMPLATES SO LONG AS THEY ARE 100% USING THE NORMAL FRAMEWORK...IF NOT THEN LETS FIX THAT FIRST
//Skinny column
//$dont_show_left[] = 'testimonials';
//$dont_show_left[] = 'last_winner';
//$dont_show_left[] = 'right_social';
//$dont_show_left[] = 'coupon_menu';
//$dont_show_left[] = 'bidpack_menu';
//$dont_show_left[] = 'user_menu';
//$dont_show_left[] = 'help_menu';
//$dont_show_left[] = 'faq_menu';
//$dont_show_left[] = 'top_menu';
//$dont_show_left[] = 'search_box';
//$dont_show_left[] = 'category_menu';



array_push($dont_show_left, $dont_show);

load_addon_by_position('column-left', $addons, $admin, basename($_SERVER['PHP_SELF']), $dont_show_left);
?>



