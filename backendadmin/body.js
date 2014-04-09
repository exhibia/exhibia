/*function framecheck(section)
{
	if( self == top )
	{
		var url = "/webadmin/home.aspx";
		
		switch(section)
		{
			case "home":
				url = '/webadmin/home.aspx';
				break;
			case "contacts":
				url = '/webadmin/contacts.aspx';
				break;
			case "accounts":
				url = '/webadmin/accounts.aspx';
				break;
			case "settings":
				url = '/webadmin/settings.aspx';
				break;
			case "site":
				url = '/webadmin/site.aspx';
				break;
		}	
		this.location = url ;
	}
}*/
function openWin(pageToLoad, winName, width, height, center,scrollbar){
	  if ((parseInt(navigator.appVersion) >= 4 ) && (center)){
		        xposition = (screen.width - width) / 2;
		        yposition = (screen.height - height) / 2;
	args = "width=" + width + "," + "height=" + height + "," + "location=0," + "menubar=0," + "resizable=1," + "scrollbars=" + scrollbar + "," + "status=1," + "titlebar=0," + "toolbar=0," + "hotkeys=0," + "screenx=" + xposition + "," + "screeny=" + yposition + "," + "left=" + xposition + "," + "top=" + yposition;
	newWindow = window.open(pageToLoad,winName,args)
	window.focus
	}
}
function deleteconfirm(str,strurl)
{
	if (confirm(str)) 
	{
		this.location=strurl;
	}
}	
function displaysub(the_sub)
{
	var my_sub = document.getElementById('idd' + the_sub);
	var my_img = document.getElementById('img' + the_sub);
	
	var img_plus = 'images/plus.gif';
	var img_minus = 'images/minus.gif';
	
	if (my_sub.style.display=="none")
	{
		my_sub.style.display="inline";
		my_img.src = img_minus ;
		return
	}
	else
	{
		my_sub.style.display="none";
		my_img.src = img_plus ;
		return
	}
}