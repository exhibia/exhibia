<script type="text/javascript">
function CheckSearch()
{
	if(document.searchform.searchtext.value=="")
		return false;
	else
		return true; 
}
</script>

<form accept-charset="utf-8" id="searchForm" name="searchform" action="allauctions.php" onsubmit="return CheckSearch();" method="post" style="background:url(img/search-bg.jpg) repeat-x; height:54px;">       
    <input style="border: 2px solid #F68B09;
color: #ffffff!important;
font-size: 16px;
height: 31px;
margin: 8px 0 0 10px;
padding-left: 5px;
width: 850px;" type="text" name="searchtext" id="keywords" value="<?=htmlspecialchars(stripcslashes($searchdata), ENT_QUOTES);?>"/>
    <button type="submit" style="background:url(img/search-btn.jpg) repeat-x; height:35px; color:#FFF; text-shadow: 1px 1px #F84C00; font-weight:bold;"><?php echo SEARCH;?></button>
</form>
