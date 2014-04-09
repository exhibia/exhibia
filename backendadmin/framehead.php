<?php
  include("session.php");
  include_once("admin.config.inc.php");
if(isset($_SESSION['UsErOfAdMiN']))
$UsErOfAdMiN=$_SESSION['UsErOfAdMiN'];
$active=$_GET['active'];
?>


<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8"><LINK 
href="main.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2600.0" name=GENERATOR>
<SCRIPT LANGUAGE="JavaScript">
<!-- Original:  Tomleung (monitor@Pennyauctionsoft.com) This tag should not be removed-->
<!--Server time ticking clock v2.0 Updated by js-x.com-->
function MakeArrayday(size)
{
  this.length = size;
  for(var i = 1; i <= size; i++)
    this[i] = "";
  return this;
}
function MakeArraymonth(size)
{
  this.length = size;
  for(var i = 1; i <= size; i++)
    this[i] = "";
  return this;
}

var hours;
var minutes;
var seconds;
var timer=null;
function sClock(hours1,minutes1,seconds1)
{
  hours=parseInt(hours1);
  minutes=parseInt(minutes1);
  seconds=parseInt(seconds1);
  if(timer){clearInterval(timer);timer=null;}
  timer=setInterval("work();",1000);
}

function twoDigit(_v)
{
  if(_v<10)_v="0"+_v;
  return _v;
}

function work()
{
  if (!document.layers && !document.all && !document.getElementById) return;
  var runTime = new Date();
  var dn = "AM";
  var shours = hours;
  var sminutes = minutes;
  var sseconds = seconds;
  if (shours >= 12)
  {
    dn = "PM";
    shours-=12;
  }
  if (!shours) shours = 12;
  sminutes=twoDigit(sminutes);
  sseconds=twoDigit(sseconds);
  shours  =twoDigit(shours  );
  movingtime = ""+ shours + ":" + sminutes +":"+sseconds+" " + dn;
  if (document.getElementById)
    document.getElementById("clock").innerHTML=movingtime;
  else if (document.layers)
  {
    document.layers.clock.document.open();
    document.layers.clock.document.write(movingtime);
    document.layers.clock.document.close();
  }
  else if (document.all)
    clock.innerHTML = movingtime;

  if(++seconds>59)
  {
    seconds=0;
    if(++minutes>59)
    {
      minutes=0;
      if(++hours>23)
      {
        hours=0;
      }
    }
  }
}
</script>
</HEAD>
<BODY bgColor=<?=$ADMIN_HEADER_BG_COLOR1?> leftMargin=0 topMargin=0 marginheight="0" marginwidth="0" onLoad="sClock('<?=date("G");?>','<?=date("i");?>','<?=date("s");?>');">
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
      <TD align=right height=5></TD></TR>
  <TR>
     <TD>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
          
            <TR> 
              
            <TD width="80%" height="42"><font class="sitename">Welcome To 
              <?php echo $ADMIN_MAIN_SITE_NAME ?>
              </font><BR>
             </TD>
          <TD class=w noWrap align=middle><span id=clock style="position:relative;"></span>&nbsp;</TD>
		  <td style="display: none;" id="onlinetime"><?=date("H:i:s");?></td>
          <TD noWrap align=middle width="1%"><IMG height=25 
            src="images/divdots.gif" width=3></TD>
          <TD class=w noWrap align=middle><?php echo date("l, F d, Y"); ?></TD>
          <TD noWrap align=middle width="1%"><IMG height=25 
            src="images/divdots.gif" width=3></TD>
          <TD class=w noWrap align=middle>current user: <B><?php echo $UsErOfAdMiN; ?></B></TD>
          <TD noWrap align=middle width="1%"><IMG height=25 
            src="images/divdots.gif" width=3></TD>
          <TD noWrap align=middle><A class=w 
            href="logout.php" 
            target=_top><B>Logout</B></A></TD>
          <TD width="1%">&nbsp;</TD></TR></TABLE></TD></TR>
  <TR>
      <TD>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
          <TBODY>
        <TR>
              <TD width=202><IMG height=1 src="images/spacer.gif" width=200 
            border=0></TD>
			 <?php
			  include("headlinks.txt.php");

  		$MainLinksSize = sizeof($HeadLinksArray);

		  for($i=0;$i<$MainLinksSize;$i++)
		  {
			
			$LinkTitle = $HeadLinksArray[$i][0];
			$HREF = $HeadLinksArray[$i][1];
   		 ?>
          <TD width="15">
            <TABLE width="100%" border=0 cellPadding=5 cellSpacing=0>
                  <TBODY>
              <TR>
                <TD align="middle" noWrap 
					class="<?php if($active==$LinkTitle) echo "tab_on"; else echo "tab_s";?>">
					<A class="<?php if($active==$LinkTitle) echo "tab_o"; else echo "tab";?>" 
                  href="<?php echo $HREF ?>" 
                  target="_top"><?php echo $LinkTitle; ?></A></TD>
              </TR>
			  </TBODY>
			</TABLE>
		</TD>
	<?
  }
  ?>
          
       
              <TD >&nbsp;</TD>
		    </TR>
          </TBODY></TABLE>
        <p class="sitename">&nbsp;</p></TD></TR></TBODY></TABLE></BODY></HTML>
