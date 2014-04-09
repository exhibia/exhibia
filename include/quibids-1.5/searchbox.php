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
    <input style="width:850px; height:31px; border:2px solid #F68B09; margin:58px 0px 0px 10px; font-size:16px; color:#666; padding-left:5px;" type="text" name="searchtext" id="keywords" value="<?=htmlspecialchars(stripcslashes($searchdata), ENT_QUOTES);?>"/>
    <button type="submit" style="background:url(img/search-btn.jpg) repeat-x; height:35px; color:#FFF; text-shadow: 1px 1px #F84C00; font-weight:bold;"><?php echo SEARCH;?></button>
</form>
