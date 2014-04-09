<?
	include("connect.php");
	include_once("admin.config.inc.php");
	include("security.php");
	include("config_setting.php");
	include("functions.php");

	if(!$_GET['order'])
	$order = "";
	else
	$order = $_GET['order'];
	if(!$_GET['pgno'])
	{
		$PageNo = 1;
	}
	else
	{
		$PageNo = $_GET['pgno'];
	}
/********************************************************************
     Get how many products  are to be displayed according to the  Events
********************************************************************/
	$StartRow =   $PRODUCTSPERPAGE * ($PageNo-1);
/***********************************************/
		if($order!="")
		{
			$query = "select * from member_news where news_title like '$order%' order by news_date desc";
		}
		else
		{
			$query = "select * from member_news order by news_date desc";
		}
			$result=db_query($query) or die (db_error());
			$totalrows=db_num_rows($result);
			$totalpages=ceil($totalrows/$PRODUCTSPERPAGE);
			$query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
			$result =db_query($query);
			$total = db_num_rows($result);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link rel="stylesheet" href="main.css" type="text/css">
</head>

<body bgcolor="#ffffff" style="padding-left:10px">
<table width="100%" cellPadding="0" cellSpacing="10">
  <TR> 
    <TD class="H1">Manage Members News</TD>
  </TR>
  <TR>
    <TD background="images/vdots.gif"><IMG height=1 src="images/spacer.gif" width=1 ></TD>  </TR>
  <TR>
    <TD><!--content-->
	    <TABLE cellSpacing="2" cellPadding="2" width="100%" >
    	 <TBODY>
           <TR>
             <TD colspan="2"> 
           <!--options-->
             <IMG height=11 src="images/001.gif" width=8 ><A class=la href="addmembersnews.php"> Add a New Members News. </A> 
           <!--/options-->
        	 </TD>
          </TR>
	    </TBODY>
	   </TABLE>
	 </TD>
  </TR>
<Tr>
<td>
	<FORM id="form1" name="form1" action="managemembersnews.php" method="post">
      <TABLE cellSpacing="0" cellPadding="1">
        <TBODY>
        <TR>
          <TD><a class="la" href="managemembersnews.php">All</a></TD>
          <TD class="lg">|</TD>
          <TD><a class="la" href="managemembersnews.php?order=A">A</a></TD>
          <TD class="lg">|</TD>
          <TD><a class="la" href="managemembersnews.php?order=B">B</a></TD>
          <TD class="lg">|</TD>
          <TD><a class="la" href="managemembersnews.php?order=C">C</a></TD>
          <TD class="lg">|</TD>
          <TD><a class="la" href="managemembersnews.php?order=D">D</a></TD>
          <TD class="lg">|</TD>
          <TD><a class="la" href="managemembersnews.php?order=E">E</a></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=F">F</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=G">G</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=H">H</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=I">I</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=J">J</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=K">K</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=L">L</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=M">M</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=N">N</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=O">O</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=P">P</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=Q">Q</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=R">R</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=S">S</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=T">T</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=U">U</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=V">V</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=W">W</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=X">X</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=Y">Y</A></TD>
          <TD class="lg">|</TD>
          <TD><A class="la" href="managemembersnews.php?order=Z">Z</A></TD>
		  </TR></TBODY></TABLE>
		</form>
<?
	if($total<=0)
	{
?>
	<table width="70%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#000000">
      <tr> 
        <td> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr> 
             <td class=th-a> 
              <div align="center">No Members News To Display</div>
             </td>
           </tr>
         </table>
        </td>
      </tr>
    </table>
<?
	}
	else
	{
?>
	<table cellpadding="0" cellspacing="0" width="100%" border="0">
	  <tr>
		<td>
		<form id="form2" name="form2" action="" method="post">  
          <table width="100%"  cellSpacing="0" class="t-a" border="1">
           <tbody>
		    <TR class="th-a"> 
			  <td width="2%">No</td>
			  <td width="20%">Title</td>
			  <td width="35%">Content</td>
			  <td width="10%">Date</td>
			  <td width="10%" align="center">Action</td>
			</TR>
<?
			  for($i=0;$i<$total;$i++)
			  {
				 if($PageNo>1)
				 {
					$srno = ($PageNo-1)*$PRODUCTSPERPAGE+$i+1;
				 }
				 else
				 {
					$srno = $i+1;
				 }
			  
			  
				$row = db_fetch_object($result);
				$id=$row->id;
				$newstitle=$row->news_title;
				$newsdate=$row->news_date;
				$newscontent=$row->news_short_content;

				$cellColor = "";
				$cellColor = ConfigcellColor($i);
				?>
		  	<tr class="<?=$cellColor?>">
			  <td align="center"><?=$srno;?></td>	
			  <td><?=stripslashes($newstitle)?></td>
			  <td><?=stripslashes($newscontent)?></td>
			  <td><?=arrangedate($newsdate);?></td>
			  <td align="center">
			<input class="bttn-s" onClick="window.location.href='addmembersnews.php?news_edit=<?=$id;?>'" type="button" value="Edit">
			  
			<input name="button" type="button" class="bttn-s" value="Delete" onClick="window.location.href='addmembersnews.php?news_delete=<?=$id;?>'">
			
			</td>
			</tr>
				 <?
			  }
				 ?>
		  </tbody>
		  </table>
		</form>
	</td>
	</tr>
</table>
<?
	}
?>
	  <?php
		if($PageNo>1)
		{
                  $PrevPageNo = $PageNo-1;

	    ?>
	  <A class="paging" href="managemembersnews.php?order=<?php echo $iid ?>&pgno=<?php echo $PrevPageNo; ?>">&lt; Previous Page</A>
	  <?
	   }
	  ?> &nbsp;&nbsp;&nbsp;
	  <?php
        if($PageNo<$totalpages)
        {
         $NextPageNo = 	$PageNo + 1;
      ?>
	  <A class="paging" href="managemembersnews.php?order=<?php echo $iid ?>&pgno=<?php echo $NextPageNo;?>">Next Page &gt;</A>
	  <?
       }
      ?>
</table>
</body>
</html>
