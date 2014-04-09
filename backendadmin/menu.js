function mnpMenuDir()
{
	return "LTR";
}

function mnpMenuCT()
{
	
	return true;
}

var mnpMenuTop = null;
var mnpMenuKill = null;
var mnpMenuPopup = null;
var mnpMenuUrl = null;
var mnpMenuParent = null;
var mnpMenuScrollTimer = null;
var mnpMenuShadows = new Array();
var mnpMenuDirSave = "LTR";
var mnpMenuCTSave = false;

window.attachEvent("onload", mnpMenuInit);

function mnpMenuInit()
{
	try
	{
		mnpMenuDirSave = mnpMenuDir();
		mnpMenuCTSave = mnpMenuCT();
	}
	catch(e)
	{
		return;
	}
	mnpMenuTop = document.getElementById("mnpMenuTop");
	mnpMenuUrl = mnpMenuTop.getAttribute("url");
	mnpMenuParent = mnpMenuTop.getAttribute("parent");
	mnpMenuAttach(mnpMenuTop);
}

function mnpPage(label, url, target, menu, linkID)
{
	this.label = label;
	this.url = url;
	this.target = target;
	this.menu = menu;
	this.linkID = linkID;
}

function mnpLabel(label)
{
	this.label = label;
}

function mnpMenuEnter()
{
	if (mnpMenuKill)
	{
		window.clearTimeout(mnpMenuKill);
		mnpMenuKill = null;
	}
}

function mnpMenuLeave()
{
	mnpMenuKill = window.setTimeout("mnpMenuKiller()", 200);
}

function mnpMenuKiller()
{
	mnpKillMenu(mnpMenuTop.getAttribute("currentMenu"));
	mnpMenuTop.removeAttribute("currentMenu");
}

function mnpMenuAttach(el)
{
	el.attachEvent("onmouseenter", mnpMenuEnter);
	el.attachEvent("onmouseleave", mnpMenuLeave);
	var divs = el.getElementsByTagName("DIV");
	for (var i=0; i < divs.length; i++)
	{
		var div = divs.item(i);
		if (div.className == "mnpMenuRow")
		{
			div.attachEvent("onmouseenter", mnpMenuMouseover);
			div.attachEvent("onmouseleave", mnpMenuMouseout);
			div.attachEvent("onmousedown", mnpMenuMousedown);
			div.attachEvent("onmouseup", mnpMenuMouseup);
			div.setAttribute("save-background", div.style.background);
			div.setAttribute("save-border", div.style.borderColor);
			var a = div.getElementsByTagName("A");
			if (a.length > 0)
			{
				var a0 = a[0];
				if (a0.getAttribute("aoff"))
					a0.outerHTML = a0.innerHTML;
				else
				{
					div.setAttribute("status", a0.href);
					div.attachEvent("onclick", mnpMenuClick);
				}
			}
			if (div.getAttribute("menu"))
			{
				var imgs = div.getElementsByTagName("IMG");
				if (imgs.length > 0)
				{
					var img = imgs[0];
					img.style.visibility = "visible";
				}
				else
				{
					var x;
					if (mnpMenuDirSave == "LTR")
						x = (div.offsetWidth - 10) + "px";
					else if (mnpMenuTop.contains(div))
						x = "4px";
					else
						x = "6px";
					var img = "<IMG src='/library/mnp/2/gif/arrow" + mnpMenuDirSave + ".gif' width='4' height='7' border='0' class='mnpMenuArrow' style='left: " + x + "' />";
					div.insertAdjacentHTML("afterBegin", img);
				}
			}
		}
	}
}

function mnpMenuClick()
{
	var div = window.event.srcElement;
	var a = div.getElementsByTagName("A");
	if (a.length == 0) return;
	if (window.event.shiftKey)
	{
		var target = a[0].target;
		a[0].target = "_new";
		a[0].click();
		a[0].target = target;
	}
	else
		a[0].click();
}

function mnpKillMenu(id)
{
	if (id == null) return;
	var menu = document.getElementById(id);
	var current = menu.getAttribute("currentMenu");
	if (current) 
	{
		mnpKillMenu(current);
		menu.removeAttribute("currentMenu");
	}
	var temp = mnpMenuShadows[id];
	if (temp)
	{
		var i;
		for (i=1; i<=4; i++)
			document.body.removeChild(temp[i]);
		mnpMenuShadows[id] == null;
	}
	var parent = document.getElementById(menu.getAttribute("parentMenu"));
	var rows = parent.getElementsByTagName("DIV");
	for (var i=0; i<rows.length; i++)
	{
		var row = rows.item(i);
		var m = row.getAttribute("menu");
		if (m == id)
		{
			row.style.background = row.getAttribute("save-background");
			row.style.borderColor = row.getAttribute("save-border");
		}
	}
	show_elements("SELECT", menu);
	show_elements("OBJECT", menu);
	menu.style.display = "none";
}

function mnpMenuOpen(id, parentId, x, y)
{
	var parent;
	try
	{
		parent = document.getElementById(parentId);
	}
	catch(e)
	{
		return;
	}
	var current = parent.getAttribute("currentMenu");
	if (id == current) return;
	mnpKillMenu(current);
	if (id)
		parent.setAttribute("currentMenu", id);
	else
	{
		parent.removeAttribute("currentMenu");
		return;
	}
	
	var div = document.getElementById(id);
	if (div == null)
	{
		var menu = eval("new " + id + "()");
		var html = "<DIV id='" + id + "' class='mnpMenuSub' dir='" + mnpMenuDirSave + "'>";
		html += "<DIV class='mnpMenuScroller' style='display: none; background: #F1F1F1; border-color: #F1F1F1' onmouseenter='mnpStartScroll(-1)' onmouseleave='mnpStopScroll()'><IMG src='/library/mnp/2/gif/up_disabled.gif' width='7' height='9' /></DIV>";
		html += "<DIV class='mnpMenuScrollArea'>";
		var isThisPage = false;
		for (var i=0; i<menu.items.length; i++)
		{
			var item = menu.items[i];
			var url = item.url;
			if (url == mnpMenuUrl)
			{
				isThisPage = true;
				break;
			}
		}
		for (var i=0; i<menu.items.length; i++)
		{
			var item = menu.items[i];
			var label = item.label;
			var url = item.url;
			var target = item.target;
			var submenu = item.menu;
			var linkID = item.linkID;
			html += "<DIV";
			if (submenu)
				html += " menu='" + submenu + "'";
			if (url)
			{
				html += " class='mnpMenuRow'";
				if (url == mnpMenuUrl)
					html += " style='border-color: #999999; background: white; cursor: default";
				else if (!isThisPage && (url == mnpMenuParent))
					html += " style='border-color: #999999; background: #F1F1F1";
				else
					html += " style='border-color: #F1F1F1; background: #F1F1F1";
				if (mnpMenuDirSave == "LTR")
					html += "; padding-left: 11px";
				else
					html += "; padding-right: 11px";
				html += "'";
			}
			else
				html += " class='mnpMenuLabel'";
			html += ">";
			if (url && (url != mnpMenuUrl))
			{
				var targetAttr = target == "" ? "" : " target='" + target + "'";
				if (mnpMenuCTSave)
					html += "<A href='" + url + "'" + targetAttr + " LinkArea='Left Nav' LinkID='Flyout" + linkID + "' onclick='trackInfo(this)'>" + label + "</A>";
				else
					html += "<A href='" + url + "'" + targetAttr + ">" + label + "</A>";
			}
			else
				html += "<SPAN>" + label + "</SPAN>";
			html += "</DIV>";
		}
		html += "</DIV>";
		html += "<DIV class='mnpMenuScroller' style='display:none; background: #F1F1F1; border-color: #F1F1F1' onmouseenter='mnpStartScroll(+1)' onmouseleave='mnpStopScroll()'><IMG src='/library/mnp/2/gif/down_enabled.gif' width='7' height='9' /></DIV>";
		html += "</DIV>";
		document.body.insertAdjacentHTML("beforeEnd", html);
		var div = document.getElementById(id);
		var sa = div.childNodes.item(1);
		var max = 0;
		for (var i=0; i<sa.childNodes.length; i++)
		{
			var it = sa.childNodes.item(i).childNodes.item(0);
			var w = it.offsetWidth;
			if (w > max) max = w;
		}
		max += 34;
		if (max < 100) max = 100;
		else if (max > 410) max = 410;
		div.style.width = max + "px";
		for (var i=0; i<sa.childNodes.length; i++)
		{
			var it = sa.childNodes.item(i);
			if (it.className == "mnpMenuRow")
				it.style.width = (max - 6) + "px";
		}
		mnpMenuAttach(div);
		div.setAttribute("parentMenu", parentId);
	}
	else
	{
		div.style.display = "";
	}
	var bodyHeight = document.body.clientHeight;
	var bodyTop = document.body.scrollTop;
	var bodyWidth = document.body.clientWidth;
	var bodyLeft = document.body.scrollLeft;
	var up = div.children.item(0);
	var box = up.nextSibling;
	var down = box.nextSibling;
	up.style.display = "none";
	down.style.display = "none";
	box.style.height = "";
	if (div.offsetHeight > bodyHeight)
	{
		up.style.display = "";
		up.childNodes.item(0).src = "/library/mnp/2/gif/up_disabled.gif";
		down.style.display = "";
		down.childNodes.item(0).src = "/library/mnp/2/gif/down_enabled.gif";
		box.style.height = (bodyHeight - up.offsetHeight - down.offsetHeight - 6) + "px";
	}
	var bodyBottom = bodyTop + bodyHeight;
	if (y + div.offsetHeight > bodyBottom)
		y -= div.offsetHeight - 25;
	if (y < bodyTop)
		y = bodyTop + (bodyHeight - div.offsetHeight) / 2;
	if (mnpMenuDirSave == "RTL")
		x -= div.offsetWidth;
	div.style.left = x + "px";
	div.style.top = y + "px";
	div.style.zIndex = parent.style.zIndex + 10;
	if (div.offsetLeft + div.offsetWidth > bodyWidth + bodyLeft)
		document.body.scrollLeft = div.offsetLeft + div.offsetWidth - bodyWidth;
	mnpMenuShadows[id] = mnpMenuShadow(div, "#666666", 4);
	hide_elements("SELECT", div);
	hide_elements("OBJECT", div);
}

function mnpMenuPt(el)
{
	this.left = 0;
	this.top = 0;
	while (el)
	{
		this.left += el.offsetLeft;
		this.top += el.offsetTop;
		el = el.offsetParent;
	}
}

function mnpMenuMouseover()
{
	var div = window.event.srcElement;
	var status = div.getAttribute("status");
	if (status) window.status = status;
	div.style.background = "#F8F4F7";
	div.style.borderColor = "#999999";
	var pt = new mnpMenuPt(div);
	var x;
	if (mnpMenuDirSave == "LTR")
		x = pt.left + div.offsetWidth - 1;
	else
		x = pt.left + 2;
	var y = pt.top - 3;
	var menu = div.getAttribute("menu");
	if (menu)
		menu = "'" + menu + "'";
	else
		menu = "null";
	if (mnpMenuPopup)
		window.clearTimeout(mnpMenuPopup);
	var parent = div.parentElement.parentElement;
	mnpMenuPopup = window.setTimeout("mnpMenuOpen(" + menu + ", '" + parent.id + "', " + x + ", " + y + ")", 200);
}

function mnpMenuMouseout()
{
	var div = window.event.srcElement;
	window.status = "";
	var menu = div.getAttribute("menu");
	if (menu != null && menu == div.parentElement.parentElement.getAttribute("currentMenu"))
	{
		div.style.background = "#CCCCCC";
		div.style.borderColor = "#CCCCCC";
	}
	else
	{
		div.style.background = div.getAttribute("save-background");
		div.style.borderColor = div.getAttribute("save-border");
	}
	if (mnpMenuPopup)
	{
		window.clearTimeout(mnpMenuPopup);
		mnpMenuPopup = null;
	}
}

function mnpMenuMousedown()
{
	var div = window.event.srcElement;
	if (div.tagName != "DIV") div = div.parentElement;
	div.style.background = "#CECFCE";
	div.style.borderColor = "#848294";
}

function mnpMenuMouseup()
{
	var div = window.event.srcElement;
	if (div.tagName != "DIV") div = div.parentElement;
	div.style.background = div.getAttribute("save-background");
}

function mnpMenuTime()
{
	var time = new Date();
	return time.valueOf();
}

function mnpStartScroll(dy)
{
	var src = window.event.srcElement;
	src.style.background = "#CCCCCC";
	src.style.borderColor = "#999999";
	var div = src.parentElement;
	div.setAttribute("scrollTime0", mnpMenuTime());
	div.setAttribute("scrollTop0", div.childNodes.item(1).scrollTop);
	mnpMenuScrollTimer = window.setInterval("mnpMenuScroll('" + div.id + "', " + dy + ")", 35);
}

function mnpStopScroll()
{
	var src = window.event.srcElement;
	src.style.background = "#F1F1F1";
	src.style.borderColor = "#F1F1F1";
	if (mnpMenuScrollTimer)
		window.clearInterval(mnpMenuScrollTimer);
	mnpMenuScrollTimer = null;
}

function mnpMenuScroll(id, dy)
{
	var div = document.getElementById(id);
	var current = div.getAttribute("currentMenu");
	if (current)
	{
		mnpKillMenu(current);
		div.removeAttribute("currentMenu");
	}
	var box = div.childNodes.item(1);
	var y = div.getAttribute("scrollTop0") + Math.round((mnpMenuTime() - div.getAttribute("scrollTime0")) * 0.150) * dy
	box.scrollTop = y;
	if (y != box.scrollTop)
	{
		window.clearInterval(mnpMenuScrollTimer);
		mnpMenuScrollTimer = null;
		if (box.scrollTop == 0)
			div.childNodes.item(0).childNodes.item(0).src = "/library/mnp/2/gif/up_disabled.gif";
		else
			div.childNodes.item(2).childNodes.item(0).src = "/library/mnp/2/gif/down_disabled.gif";
	}
	else if (dy < 0)
		div.childNodes.item(2).childNodes.item(0).src = "/library/mnp/2/gif/down_enabled.gif";
	else
		div.childNodes.item(0).childNodes.item(0).src = "/library/mnp/2/gif/up_enabled.gif";
}

function mnpMenuShadow(el, color, size)
{
	var temp = new Array();
	var i;
	for (i=size; i>0; i--)
	{
		var rect = document.createElement('div');
		var rs = rect.style
		rs.position = 'absolute';
		rs.left = (el.style.posLeft + i) + 'px';
		rs.top = (el.style.posTop + i) + 'px';
		rs.width = el.offsetWidth + 'px';
		rs.height = el.offsetHeight + 'px';
		rs.zIndex = el.style.zIndex - i;
		rs.backgroundColor = color;
		var opacity = 1 - i / (i + 1);
		rs.filter = 'alpha(opacity=' + (100 * opacity) + ')';
		document.body.appendChild(rect);
		temp[i] = rect;
	}
	return temp;
}

var mnpgtCurrent = null;
var mnpgtTimer = null;
var mnpgtKill = null;
var mnpMHCT = false;

window.attachEvent("onload", mnpInitMasthead);

function mnpInitMasthead()
{
	var mnpMastheadTable = document.getElementById("mnpMastheadTable");
	if (mnpMastheadTable)
		if (mnpMastheadTable.getAttribute("clickTrax"))
			mnpMHCT = true;
		
	var tds = document.getElementsByTagName("TD");
	for (var tdi=0; tdi<tds.length; tdi++)
	{
		var td = tds[tdi];
		if (td.className == "mnpGlobalToolbar" || td.className == "mnpLocalToolbar")
		{
			var as = td.getElementsByTagName("A");
			for (var ai=0; ai<as.length; ai++)
			{
				var a = as[ai];
				a.attachEvent("onmouseover", MNPGT_onmouseover);
				a.attachEvent("onmouseout", MNPGT_onmouseout);
			}
		}
	}
}

function ToolbarItem(label, url, target)
{
	this.label = label;
	this.url = url;
	this.target = target;
}

function MNPGT_enterRegion(toolbar)
{
	if (mnpgtKill)
	{
		window.clearTimeout(mnpgtKill);
		mnpgtKill = null;
	}
}

function MNPGT_exitRegion(toolbar)
{
	mnpgtKill = window.setTimeout("MNPGT_kill()", 200);
}

function MNPGT_kill()
{
	mnpgtKill = null;
	if (mnpgtCurrent)
	{
		MNPGT_hideCurrent();
		mnpgtCurrent = null;
	}
}

function MNPGT_hideCurrent()
{
	var div = document.getElementById(mnpgtCurrent);
	show_elements("SELECT", div);
	show_elements("OBJECT", div);
	div.style.display = "none";
}

function MNPGT_onmouseover()
{
	MNPGT_enterRegion();
	var el = window.event.srcElement;
	el.style.color = el.parentNode.getAttribute("hover");
	var guid = el.getAttribute("guid");
	if (mnpgtTimer)
		window.clearTimeout(mnpgtTimer);
	if (guid == null || guid == "m") 
		guid = "null";
	else
		guid = "'" + guid + "'";
	var rect = new MNPGT_clientRect(el);
	mnpgtTimer = window.setTimeout("MNPGT_open(" + guid + ", " + rect.left + ", " + rect.width + ", " + rect.bottom + ")", 200);
}

function MNPGT_open(guid, x, w, y)
{
	mnpgtTimer = null;
	if (mnpgtCurrent == guid)
		return;
	if (mnpgtCurrent)
		MNPGT_hideCurrent();
	mnpgtCurrent = guid;
	if (!guid) 
		return;
	var div = document.getElementById(guid);
	if (!div)
	{
		var menu;
		try
		{
			menu = eval("new " + guid + "()");
		}
		catch(e)
		{
			mnpgtCurrent = null;
			return;
		}
		var html = "<div onmouseover='MNPGT_menu_onmouseover(this)' onmouseout='MNPGT_menu_onmouseout(this)' class='" + menu.classname + "'";
		html += " style='position: absolute; background: " + menu.backColor + "; display: none;' id='" + guid + "' dir='";
		html += mnpToolbarDir() + "'><nobr>";
		var linkIdNum = 0;
		for (var g=0; g<menu.items.length; g++)
		{
			var group = menu.items[g];
			html += "<div style='background: inherit; padding: 5px 8px 7px 8px; border-top: solid 1px " + menu.foreColor + "'><nobr>";
			for (var i=0; i<group.items.length; i++)
			{
				var item = group.items[i];
				html += "<a onmouseout='style.color=\"" + menu.foreColor + "\"' onmouseover='style.color=\"" + menu.hoverColor + "\"' href='";
				html += item.url + "' style='text-decoration: none; color: " + menu.foreColor + "'";
				if (item.target)
					html += " target='" + item.target + "'";
				if (mnpMHCT)
				{
					linkIdNum++;
					html += " LinkArea='" + menu.linkArea + "' LinkID='" + menu.linkId + "_Node" + linkIdNum + "' onclick='trackInfo(this)'";
				}
				html += ">" + item.label + "</a><br />";
			}
			html += "</nobr></div>";
		}
		html += "</nobr></div>";
		document.body.insertAdjacentHTML("beforeEnd", html);
		div = document.getElementById(guid);
	}
	div.style.top = (y + 4) + "px";
	div.style.display = "";
	if (div.dir.toUpperCase() == "LTR")
		div.style.left = (x - 8) + "px";
	else
		div.style.left = (x + w + 8 - div.offsetWidth) + "px";
	if (div.offsetLeft + div.offsetWidth >= document.body.scrollLeft + document.body.clientWidth)
	{
		div.style.left = "";
		var h = document.body.scrollLeft + document.body.clientWidth - div.offsetWidth;
		div.style.left = h + "px";
	}
	if (div.offsetLeft < 0)
		div.style.left = "0px";
	hide_elements("SELECT", div);
	hide_elements("OBJECT", div);
}

function MNPGT_onmouseout()
{
	MNPGT_exitRegion();
	var el = window.event.srcElement;
	el.style.color = el.parentNode.style.color;
	if (mnpgtTimer)
	{
		window.clearTimeout(mnpgtTimer);
		mnpgtTimer = null;
	}
}

function MNPGT_menu_onmouseover()
{
	MNPGT_enterRegion();
}

function MNPGT_menu_onmouseout()
{
	MNPGT_exitRegion();
}

function MNPGT_clientRect(el)
{
	this.left = el.offsetLeft;
	this.top = el.offsetTop;
	var temp = el.offsetParent;
	while (temp)
	{
		this.left += temp.offsetLeft;
		this.top += temp.offsetTop;
		temp = temp.offsetParent;
	}
	this.width = el.offsetWidth;
	this.right = this.left + this.width;
	this.height = el.offsetHeight;
	this.bottom = this.top + this.height;
	return this;
}

function hide_elements(tagName, menu)
{
	windowed_element_visibility(tagName, -1, menu)
}

function show_elements(tagName, menu)
{
	windowed_element_visibility(tagName, +1, menu)
}

function windowed_element_visibility(tagName, change, menu)
{
	var els = document.getElementsByTagName(tagName)
	var i
	var rect = new element_rect(menu)
	for (i=0; i < els.length; i++)
	{
		var el = els.item(i)
		if (elements_overlap(el, rect))
		{
			if (el.visLevel)
				el.visLevel += change
			else
				el.visLevel = change
			if (el.visLevel == -1)
			{
				el.visibilitySave = el.style.visibility
				el.style.visibility = "hidden"
			}
			else if (el.visLevel == 0)
				el.style.visibility = el.visibilitySave
		}
	}
}

function element_rect(el)
{
	var left = 0
	var top = 0
	this.width = el.offsetWidth
	this.height = el.offsetHeight
	while (el)
	{
		left += el.offsetLeft
		top += el.offsetTop
		el = el.offsetParent
	}
	this.left = left;
	this.top = top;
}

function elements_overlap(el, rect)
{
	var r = new element_rect(el);
	return ((r.left < rect.left + rect.width) && (r.left + r.width > rect.left) && (r.top < rect.top + rect.height) && (r.top + r.height > rect.top))
}
function gomenu()
{
	
}