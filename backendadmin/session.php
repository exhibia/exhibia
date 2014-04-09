<?
	
	if(!isset($_SESSION["UsErOfAdMiN"])){
		echo "<script language='javascript'>window.parent.location.href='index.php';";
				echo "</script>";
		exit;
	}


if(!empty($_SESSION['user_level'])){
if(is_numeric($_SESSION['user_level'])){
    if(db_num_rows(db_query("select * from user_levels where allowed_pages like '%" . $_SERVER['SCRIPT_FILENAME'] . "%' and id = '$_SESSION[user_level]'")) == 0){
    
    header("location: message.php?msg=badadmin");
    exit;
    
    
    
    }

}


}
?>