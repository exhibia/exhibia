<?php
session_start();
$adminuser		='admin';	// configure admin user here
$adminpass		='admin';	// configure admin pass here
$whois			='ban/whois.php?ip=';
#$whois			='http://www.db.ripe.net/whois?form_type=simple&full_query_string=&searchtext=';

#####################################################
##												   ##
## Dynamic contact form, Copyright Adrian Petcu    ##
##			 All rights reserved 2010			   ##
## 												   ##
#####################################################
include "ban/functions_ban.php";
if($_SESSION['is_logged']){
$content1 	= file('ban/data.txt');
$continut	= explode("$#",$content1[0]);

if(isset($_POST['delete'])){
$fp 						=fopen('ban/data.txt','w');
unset($continut[$_POST['formid']]);
$string=@implode("$#",$continut);
		fwrite($fp, $string);
		fclose($fp);
}

if(isset($_POST['addfield'])){
if(!is_ip($_POST['ip'])){
	$_POST['ip']='';
	$err="<div class='eroare'><img src='ban/images/cross.png'/> String entered is not an IP</div>";
}
elseif (preg_match("/".$_POST['ip']."/i", $content1[0])) {
	$_POST['ip']='';
	$err="<div class='eroare'><img src='ban/images/cross.png'/> Ip Already banned!</div>";
}




	if($_POST['ip']){
		if($_POST['duration']){
				if($_POST['duration']=='permanent')
					$timestamp='permanent';
				else
					$timestamp	=	time() + ($_POST['duration']*3600);
				
				$fp 		=	fopen('ban/data.txt','w');
				$continut[]	=	$_POST['ip']."|".$timestamp.'|'.$_POST['duration'];
				$string=implode("$#",$continut);
						fwrite($fp, $string);
						fclose($fp);
				$err="<div class='success'><img src='ban/images/apply.png' alt=''/> Ip Banned</div>";
		}
	}		
}

$content1 	= file('ban/data.txt');
$content	= explode("$#",$content1[0]);
$to			= $content['0'];

foreach($content as $i=>$val){
	if($content[$i]){
		$forms[]=$content[$i];
	}	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>
<title>Simple Ban IP</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css" media="screen">@import url(ban/style.css);</style>
<link rel="stylesheet" href="ban/thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="ban/jquery.js"></script>
<script type="text/javascript" src="ban/thickbox.js"></script>

</head>
<body>
<div id='container'>
<table width='100%' cellspacing='0' cellpadding='0'>
	<tr>
		<td width='70%' valign='top'>
<table width='100%' cellspacing='0' cellpadding='0'>
	<tr>
		<td class='tablehead'>ID</td>
		<td class='tablehead'>IP</td>
		<td class='tablehead'>Duration</td>
		<td class='tablehead' style='width:190px;'>Expires</td>
		<td class='tablehead' style='width:120px;'>Actions</td>
	</tr>
<?
if($forms){
$i=1;
foreach($forms as $tag=>$val){
	$z=explode('|',$val);
		list($ip,$timestamp,$type)=$z;
		?>
		<form action='' method='POST'>
			<tr bgcolor='white' onmouseover="this.bgColor='#faffea'" onmouseout="this.bgColor='#ffffff'">
				<td style='padding-left:4px;'><?=$i?></td>
				<td class='td1'><a href="<?=$whois.$ip?>&keepThis=true&TB_iframe=true&height=450&width=480" title="Viw IP info <b><?=$ip?></b>" class="thickbox"><?=$ip?></a></td>
				<td class='td3'><?=time2type($type)?></td>
				<td class='td2'><?if($timestamp!='permanent') echo countdown($timestamp); else echo '-';?></td>
				<td class='td4' align='right'><div class='buttons'><button type="submit" class="negative" name="delete"> <img src="ban/images/cross.png" alt=""/> Remove</button> <input type='hidden' name='formid' value='<?=$tag?>'></div></td>
			</tr>
		</form>	
		<?
$i++;}
}else echo "<tr><td colspan='5' align='center'>No IP's banned Yet!</td></tr>";
?>
</table><br><br>
</td>
<td style='border-left:1px solid #3b3b3b; padding:5px;' valign='top'>
<?=$err?>
	<span class='title'>Ban IP</span>
		<form action='' method='POST'>	
	<table width='100%'>
		<tr>
			<td>IP</td>
			<td><input type='text' class='text' name='ip'></td>
		</tr>		
		<tr>
			<td>Duration</td>
			<td>
				<select name='duration' class='select'>
					<option value=''>Select</option>
					<option value='12'>12 Hours</option>
					<option value='24'>One Day</option>
					<option value='48'>Two Days</option>
					<option value='72'>Three Days</option>
					<option value='168'>One Week</option>
					<option value='336'>Two Weeks</option>
					<option value='744'>A Month</option>
					<option value='8760'>A Year</option>
					<option value='permanent'>Permanent</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				<div class='buttons'><button type="submit" class="positive" name="addfield"> <img src="ban/images/apply.png" alt=""/> Ban IP</button></div></td>
		</tr>
			</form>	
	</table>
</td>
</tr>
</table>
</div>
</body>
</html>
<?}else{
if(isset($_POST['login'])){
	if($_POST['user']==$adminuser && $_POST['pass']==$adminpass){
		$_SESSION['is_logged']=1;
		$err='<meta http-equiv="refresh" content="0;url='.$_SERVER['PHP_SELF'].'">';
	}else{
		$err='<font color="red">Wrong username/password!</font>';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>
<title>Welcome to the Administration Area</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css" media="screen">@import url(ban/style.css);</style>
</head>
<body>
<div id='container' style='width:300px; height:150px;'>
<center><?=$err?></center><br><br>
<div class='buttons'>
<form action='' method='POST'>
<table align='center'>
<tr>
	<td>User: </td>
	<td><input type='text' class='text' name='user' style='width:200px;'></td>
</tr>
<tr>
	<td>Pass: </td>
	<td><input type='password' class='text' name='pass' style='width:200px;'></td>
</tr>
<tr>
	<td colspan='2' align='center'><button type="submit" class="positive" name="login"> <img src="ban/images/apply.png" alt=""/> Login</button></td>
</tr>

</table>
</form>
</div>
</div>
</body>
</html>
<?}?>