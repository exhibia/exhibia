<?
include("connect.php");
include("admin.config.inc.php");

$parentid = $_GET['parentid'];
$sql = "select * from categories where parents!='0' and parents='".$parentid."' and status='1' order by name";
$result = db_query($sql) or die(db_error());
$total = db_num_rows($result);
if($total>0)
{
	$content = "";
	$content .= '<select name="parents" class="solidinput">
				<option value="" selected="selected">Select one.</option>';
	while($row=db_fetch_array($result))
	{
		$content .= '<option value="'.$row['categoryID'].'">'.$row['name'].'</option>';
	}
	$content .="</select>";	
	
	echo $content;
}
else
{
	$content = "";
	$content .= '<select name="parents" class="solidinput"><option value="" selected="selected" style="">Select one.</option>';
	$content .="</select>";	
	
	echo $content;
}

?>