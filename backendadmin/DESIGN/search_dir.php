<?php
require("../../config/config.inc.php");
if(!empty($_REQUEST['delete'])){
   if(file_exists("$BASE_DIR/include/addons/slider/$template/img/$_REQUEST[delete]")){
    unlink("$BASE_DIR/include/addons/slider/$template/img/$_REQUEST[delete]");
   }else{
   unlink("$BASE_DIR/uploads/banner/$_REQUEST[delete]");
   
   }

}
function searchDir($base_dir="./",$p="",$f="",$allowed_depth=-1){
	$contents=array();

	$base_dir=trim($base_dir);
	$p=trim($p);
	$f=trim($f);

	if($base_dir=="")$base_dir="./";
	if(substr($base_dir,-1)!="/")$base_dir.="/";
	$p=str_replace(array("../","./"),"",trim($p,"./"));
	$p=$base_dir.$p;
	
	if(!is_dir($p))$p=dirname($p);
	if(substr($p,-1)!="/")$p.="/";

	if($allowed_depth>-1){
		$allowed_depth=count(explode("/",$base_dir))+ $allowed_depth-1;
		$p=implode("/",array_slice(explode("/",$p),0,$allowed_depth));
		if(substr($p,-1)!="/")$p.="/";
	}

	$filter=($f=="")?array():explode(",",strtolower($f));

	$files=@scandir($p);
	if(!$files)return array("contents"=>array(),"currentPath"=>$p);

	for ($i=0;$i<count($files);$i++){
		$fName=$files[$i];
		$fPath=$p.$fName;

		$isDir=is_dir($fPath);
		$add=false;
		$fType="folder";
		
		if(!$isDir){
			$ft=strtolower(substr($files[$i],strrpos($files[$i],".")+1));
			$fType=$ft;	
			if($f!=""){
				if(in_array($ft,$filter))$add=true;
			}else{
				$add=true;
			}
		}else{
			if($fName==".")continue;
			$add=true;
			
			if($f!=""){
				if(!in_array($fType,$filter))$add=false;
			}

			if($fName==".."){
				if($p==$base_dir){
					$add=false;
				}else $add=true;
				
				$tempar=explode("/",$fPath);
				array_splice($tempar,-2);
				$fPath=implode("/",$tempar);
				if(strlen($fPath)<= strlen($base_dir))$fPath="";
			}
		}

		if($fPath!="")$fPath=substr($fPath,strlen($base_dir));
		$size = getimagesize($base_dir . "/" . $fName);
		$ftime = date("Y-m-d H:i:s", filemtime($base_dir . "/" . $fName));
		
		if($add)$contents[]=array("fPath"=>$fPath,"fName"=>$fName,"fType"=>$fType,"fWidth"=>$size[0], "fHeight"=>$size[1], "fTime"=>$ftime);
	}
	
	$p=(strlen($p)<= strlen($base_dir))?$p="":substr($p,strlen($base_dir));
	return array("contents"=>$contents,"currentPath"=>$p);
}

$p=isset($_POST["path"])?$_POST["path"]:"";
$f=isset($_POST["filter"])?$_POST["filter"]:"";
if(file_exists("$BASE_DIR/include/addons/slider/$template/img/")){
echo json_encode(searchDir("$BASE_DIR/include/addons/slider/$template/img/",$p,$f,-1));
}else{
echo json_encode(searchDir("$BASE_DIR/uploads/banner/",$p,$f,-1));

}
?>