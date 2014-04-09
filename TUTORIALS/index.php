<?php

include("../config/connect.php");

$obj = db_fetch_object(db_query("select * from tutorials where element = '$_REQUEST[element]' and page = '$_REQUEST[page]' order by id desc limit 1"));

if(!empty($obj->text)){
echo json_encode($obj);

}else{

$obj2 = array("page" => $_REQUEST['page'],
	      "element" => $_REQUEST['element'],
	      "tect" => "We have not added a tutorial for this yet. If you would like to see one here then please let us know"
	      );
echo json_encode($obj2);
}