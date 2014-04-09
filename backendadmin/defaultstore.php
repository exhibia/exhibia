<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8"><LINK 
href="main.css" type=text/css rel=stylesheet>

        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
<SCRIPT language=javascript src="body.js"></SCRIPT>

</HEAD>
<BODY bgColor=#ffffff leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">


<TABLE cellSpacing=10 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
      <TD class=H1>Auctions</TD>
    </TR>
  <TR>
    <TD background="images/vdots.gif"><IMG height=1 
      src="images/spacer.gif" width=1 border=0></TD></TR>
  <TR>
    <TD><!--content-->
      <TABLE cellSpacing=5 cellPadding=0 width="100%" border=0 height="10">
        <TBODY>
		 <?php
  include("store.txt.php");

  $MainLinksSize = sizeof($MainLinksArray);

  for($i=0;$i<$MainLinksSize;$i++)
  {
    //$LayerId= $i+2;
    $LinkTitle = $MainLinksArray[$i][0];
    $HREF = $MainLinksArray[$i][1];
    $HasChild = $MainLinksArray[$i][2];
    if($HasChild==1)
    { 
	  $ChildLinksSize = sizeof($ChildLinksArray);
      
      for($j=0;$j<$ChildLinksSize;$j++)
      {
        $MainLinkID= $ChildLinksArray[$j][2];
        if($MainLinkID == $i)
        {
        	$ChildLinkTitle = $ChildLinksArray[$j][0];
        	$ChildHREF = $ChildLinksArray[$j][1];
			break;
		}
	  }
	?>
        <TR>
          <TD vAlign=top align=right width="1%" height="13"><IMG height=11 
            src="images/001.gif" width=8 border=0></TD>
          <TD vAlign=top height="13"><A 
            href="<?php echo $ChildHREF; ?>" 
            target=body><B><?php echo $LinkTitle; ?></B></A></TD></TR>
        <TR>
          <TD colSpan=2 height="13"></TD></TR>
		<?
		}
	}
	
	//===========================================================================
	
	?>
       
        </TBODY></TABLE><!--//content--></TD></TR></TBODY></TABLE></BODY></HTML>