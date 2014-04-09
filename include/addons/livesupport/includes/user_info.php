<?php
include "base.php";


if($_GET['info'] != "open") {
$query = db_query("SELECT * FROM sessions where convoID = '".$_GET['info']."' ");
$result = db_fetch_array($query);
$ts = $result['initiated'];
$ts = strftime("%X %P",$ts);
?>
<table>
<tr>
<th><h4><img src="images/user.png" alt="Name" title="Name"/> Name</h4></th>
<th><h4><img src="images/furthercontact.png" alt="Wants to be contacted?" title="Wants to be contacted?" /> Wants to be contacted?</h4></th>
<th><h4><img src="images/emailaddress.png" alt="Email address" title="Email address" /> Email address</h4></th>
<th><h4><img src="images/icons/crossb.png" width="18" alt="Terminate Conversation" title="Terminate Conversation" /> Terminate</h4></th>
</tr><tr>
<td><?=$result['name'];?></td>
<td><?=$result['contact'];?></td>
<td><?=$result['email'];?></td>
<td><a href="#" onclick='parent.$.fn.colorbox({href:"includes/delConvo.php?id=<?=$result['convoID'];?>",opacity:0.9}); return false;' class="delete_convo">Click to end</a></td>
</tr>
</table>
<?
} else {
echo '<h3>No conversation selected</h3>';
}

?>
