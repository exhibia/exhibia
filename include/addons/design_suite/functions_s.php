<?php
if(!empty($_SERVER['SERVER_NAME'])){

}
if(db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and admin_user_flag >= '1'")) >= 1 & empty($_COOKIE['nodesign'])){
setcookie('design_suite', 'yes', time()+3600, '/');
}
