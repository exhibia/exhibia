<?
	include("connect.php") ;
	include_once("admin.config.inc.php");
	include("security.php");
	include("functions.php");
	
	if($_POST['editreply'])
	{
		$post_body=addslashes($_POST["post_body"]);
		$replystatus = $_POST["replystatus"];
		if ($ex!=1)
		{	
			if(isset($_POST['edit']))
			{
					db_query("UPDATE forum_reply SET reply_body = '".$post_body."',reply_status='".$replystatus."' WHERE reply_id='".$_POST['edit']."'") or die (db_error());
	?>
			<script language="javascript">
				window.location.href="message.php?msg=89";
			</script>				
			<?
			exit;
			}
		
		} //end if $ex
	}
	else
	{
		//*** THIRD CATEGORY DELETE ****//			
			if(isset($_GET['delete']))
			{
				$q = db_query("SELECT * FROM forum_reply WHERE reply_id = '".$_GET['delete']."' and reply_id<>0") or die (db_error());
				$row = db_fetch_row($q);
				$totalrow = db_affected_rows();
				if($totalrow>0)
				{
					$qryd = "delete from forum_reply where reply_id=".$_GET['delete'];
					db_query($qryd) or die(db_error());
					header("location: message.php?msg=90");
					exit;
				
				}
			}

	// EXIST FETCH THE VALUE FOR GET EDIT TIME FROM MANAGE CATEGORY //
	if($_GET["post_id"] || $_GET["post_id_delete"])
	{
		
		if(isset($_GET["post_id"]))
		{
			$post_id=$_GET["post_id"];
		}
		if(isset($_GET["post_id_delete"]))
		{
			$post_id=$_GET["post_id_delete"];
		}
		
		$q = db_query("select * from forum_reply where reply_id = '".$post_id."'") or die (db_error());
		$row = db_fetch_object($q);
		if (!$row) //can't find category....
		{
			echo "<center><font color=red>ERROR CAN NOT FIND REQUIRED PAGE</font>\n<br><br>\n";
			exit;
		}
		$posts_body = stripslashes($row->reply_body);
		
	}
}
?>
<HTML>
<HEAD>
<TITLE></TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="main.css" type="text/css" rel="stylesheet">
  
  
          <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/ui/ui.accordion.min.js"></script>
<script type="text/javascript" language="javascript">

function delconfirm(loc)
{
	if(confirm("Are you sure do you want to delete this?"))
	{
		window.location.href=loc;
	}
	return false;
}

function checkform(f1)
{
	if(f1.post_body.value=="")
	{
		alert("Please enter Reply.");
		f1.post_body.focus();
		return false;
	}
}
function PutSmileys(value)
{
	document.f1.post_body.value += value;
	document.f1.post_body.focus();
}
</script>
</HEAD>
<BODY>      
<form action='' method='POST' name="f1" onSubmit="return checkform(this);">
<table width="100%" cellpadding="0" cellSpacing="10">
	<tr>
		<td class="H1"><?php if($_GET['post_id']!="") { ?> Edit Forum Reply<?php } elseif($_GET['post_id_delete']!=""){ ?> Confirm Delete Forum Reply <?php }?></td>
	</tr>
	<TR>
		<TD background="images/vdots.gif"><IMG height=1 src="images/spacer.gif" width=1 border=0></TD>
	</TR>
	
	<?php if($msg!="") {?>
	<tR>
		<td align="center"><font color="#FF0000"><?=$msg;?></font></td>
	</tR>
	<?php } ?>
	<tr>
		<td class="a" align="right" colspan="2">* Required Information</td>
	</tr>
	
	<tr>
		<td>
			<table cellpadding="2" cellspacing="2" border="0" width="50%">
            <tr>
            	<td class="f-c" align="right">Enabled/Disabled: </td>
                <td>
                	<select name="replystatus">
                    	<option value="0">Enabled</option>
                        <option value="1" <?=$row->reply_status=="1"?"selected":"";?>>Disabled</option>
                    </select>
                </td>
            </tr>
			<tr>
				<td class="f-c" align="right"><font class="a">*</font>Reply :</td>
				<TD><textarea name="post_body" rows="12" cols="75"><?=stripslashes($posts_body);?></textarea> </TD>
            </tr>
			
			 <tr>
			<td>&nbsp;</td>
			</tr>
			<tr valign="middle">
				<td>&nbsp;</td>
				<td>
					<div style="width:450px;">
					<?
						foreach ($smileysname as $key => $value)
						{
					?>
						<a href='javascript:PutSmileys(" <?=$value;?> ")'><img src="../images/smileys/<?=$key;?>" border="0" alt=""/></a>
					<?
						}
					?>
					</div>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr> 
			<tr>	
				<td>&nbsp;</td>
					
					<td>
					<?php
					if($_GET['post_id_delete']!="" and $post_id!="")
					{ 
					
					?>
					<input type='button' name='<?php if($_GET['post_id_delete']!="" or $post_id!=""){?>deletereply<?php }?>' value='<?php if($_GET['post_id_delete']!="" or $post_id!="") {?> Delete Reply <?php }?>' class="bttn" onClick="delconfirm('forumreplyedit.php?delete=<?=$post_id?>')">
					<?php 
					}
					else
					{ 
					
					?>
					<input type='submit' name='<?php if($_GET['post_id']!="" or $post_id!=""){?>editreply<?php }?>' value='<?php if($_GET['post_id']!="" or $post_id!="") {?> Edit Reply <?php } ?>' class="bttn">
					<?php 
					}
					?>
					</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			</table>
			
<?php if($_GET['post_id']!="") {?>
<input type="hidden" name="edit" value="<?=$_GET['post_id']?>">
<?php } ?>

		</td>
	</tr>
</table>
</form>
<br><br>
</BODY>
</HEAD>
</HTML>
