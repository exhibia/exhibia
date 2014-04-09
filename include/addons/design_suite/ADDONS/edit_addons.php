


<?php

if(!function_exists('menu_input_globals')){
function menu_input_globals($menu, $link, $value = null, $key, $id, $table, $js_action = null, $container){

  

}
}
if(!function_exists('menu_input')){
function menu_input($menu, $link, $value = null, $key, $id, $table, $js_action = null, $container){
    ?>
	
    <?php
}
}
if(!function_exists('menu_select')){



function menu_select($menu, $link, $value, $key, $id, $table, $js_action, $container){

$conds = array(
      '' => ''
      , '>' => '&gt;'
      , '!=' => '!='
      , '<' => '&lt;'
      , '>=' => '&gt;&#061;' 
      , '<=' => '&lt;&#061;'
      , '<>' => '&lt;&gt;'
      , '==' => '&#061;&#061;'
      , 'in_array' => 'in_array'
      , '!in_array' => '!in_array'
      , 'empty' => 'empty'
      , '!empty' => '!empty'
      , 'isset' => 'isset'
      , '!isset' => '!isset'
);
    ?>

    <?php

}
}
if(!function_exists('list_addon_conditionals')){

function list_addon_conditionals($addon, $menu){
$id = uniqid();
  

}
}

if(db_num_rows(db_query("select * from nav_conditionals where link_name = '$addon' and menu_name = 'addons'")) >= 1){

      if(check_addons_conditionals($sql_check, $value) >= 1){
      ?>

      <?php
      }else{
      ?>

      <?php

      }

}else{
?>


<?php
}

list_addon_conditionals($addon, 'addons');

?>
