<html>
<head>
	<title>Whois IP <?=$_GET['ip']?></title>
<style type="text/css" media="screen">
body{
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#404040;
}
.desc{
	font-weight:bold;
	font-size:12px;
}

.val{
	font-size:12px;
	padding-left:10px;
}


</style>
<table width='100%' cellspacing='0' cellpadding='0'>
<?php
$myip=$_GET['ip'];
include("functions_ban.php");
$ipology = new ipology(array($myip));
$out = $ipology->out();

    if(is_array($out[$myip]))
    {
		foreach($out[$myip] as $tag=>$val){
			?>
				<tr bgcolor='#ffffff' onmouseover="this.bgColor='#ffeee0'" onmouseout="this.bgColor='#ffffff'">
					<td valign='top' class='desc'><?=$tag?></td>
					<td class='val'><?if(is_array($val)) echo implode('<br>',$val);else echo $val;?></td>
				</tr>
			<?
		}
    }else{
		echo "No values returned!";
	}
?>
</table>