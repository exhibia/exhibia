function framecheck(section)
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
}
function openWin(pageToLoad, winName, width, height, center,scrollbar){
	  if ((parseInt(navigator.appVersion) >= 4 ) && (center)){
		        xposition = (screen.width - width) / 2;
		        yposition = (screen.height - height) / 2;
	args = "width=" + width + "," + "height=" + height + "," + "location=0," + "menubar=0," + "resizable=1," + "scrollbars=" + scrollbar + "," + "status=0," + "titlebar=0," + "toolbar=0," + "hotkeys=0," + "screenx=" + xposition + "," + "screeny=" + yposition + "," + "left=" + xposition + "," + "top=" + yposition;
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
function wprint()
{
	alert("T");
	parent.body.print();
}