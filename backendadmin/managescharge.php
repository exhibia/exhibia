<?
include_once("admin.config.inc.php");
include("connect.php");
include("security.php");

$Error=0;
$flag=1;

if(isset($_POST['submit'])){
	$charge = $_POST["charge"];
	if(trim($charge)==""){
		$Error = 1;
	}else{
		$query = "Update shipping set charge='$charge' where id=1";
		db_query($query) or die(db_error());
		header("location:message.php?msg=59");
		exit;
	}
}else{
	$query = "select * from shipping where id=1";
	$result = db_query($query) or die(db_error());
	$row = db_fetch_object($result);
	$charge = $row->charge;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML><HEAD>
<LINK 
href="main.css" type=text/css rel=stylesheet>
<SCRIPT language=javascript src="body.js"></SCRIPT>
<script language="javascript">
	function check_form(f1){
		if(f1.charge.value==""){
			alert("Please insert shipping charge");
			f1.charge.select();
			return false;
		}
	}
</script>
<META content="MSHTML 6.00.2600.0" name=GENERATOR></HEAD>
<BODY bgColor=#ffffff leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
<TABLE cellSpacing=10 cellPadding=0  border=0 width="697">
<TR>
	<TD class=H1>Manage Shipping Charge</TD>
</TR>
<TR>
    <TD background="images/vdots.gif"><IMG height=1 src="images/spacer.gif" width=1 border=0></TD>
</TR>
<!--content-->
<tr>
<td>
 <form name=addcat action="#" method=post enctype="multipart/form-data" onSubmit="return check_form(this)">

	<?php
	      if($Error)
          {
            if($Error==1)
            {
              $msg = "Form Is Not Completely Filled Up !!!";
            }


        ?>
		<table width="80%" bordercolor="#000000" bgcolor="#ffffff" cellspacing="0" cellpadding="0" align="center" border="1">
          <tr>
          <td>
		  <table border="0" cellpadding="0" cellspacing="0" align="center">
		  <tr>
          <td>
            <div align="center"><font face="Verdana" size="2" color="#990000"><?php echo $msg; ?></font></div>
          </td>
        </tr>
		
			  </table>
          </td>
        </tr>
      </table>
		 <?php

          }

        ?>
      <TABLE cellSpacing=2 cellPadding=2 width="100%" border=0>
        <TBODY>
        </TBODY></TABLE>
        <TABLE cellSpacing=2 cellPadding=1 width="100%" border=0>
          <TBODY>
            <TR> 
              <TD colSpan=2></TD>
              <TD class=a align=right colSpan=2 nowrap>* Required Information</TD>
            </TR>
            <TR> 
              <TD class=th-d noWrap colSpan=4>Basic Information</TD>
            </TR>
            <TR> 
              <TD width="192" align=right noWrap class=f-c><FONT class=a>*</FONT>Shipping Charge:</TD>
              <TD width="331" noWrap class=a> <input name="charge" type="text" class="solidinput" value="<?php echo $charge;?>" size="12" maxlength="4">&nbsp;<font class="a"><?=$Currency;?></font></TD>
              <td nowrap bordercolor="#000000" bgcolor="#FFFFFF">&nbsp;</td>
            </TR>
           
            <TR> 
              <TD colSpan=4>&nbsp;</TD>
            </TR>
            <tr> 
              <td colspan="2" align="center"> <INPUT type="submit" value="Update" name="submit" class="bttn"> 
              </TD>
              <TD width="64" align=right>&nbsp;</TD>
              <TD width="72">&nbsp;</TD>
            </TR>
            
          </TBODY>
        </TABLE>
        
</FORM>
</td></tr></table><!--/content--></TD></TR></TBODY></TABLE></BODY></HTML>