<?php
function logo($obj){

$logo = '';
if(file_exists("img/my_site_logo.png")){

$logo = "my_site_logo.png";

}else{

$logo = "img/logo.png";
}
return $logo;
}
