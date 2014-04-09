<!-- saved from url=(0022)http://internet.e-mail -->
//*************************************************************************<br>
//Author:       Jay Mendiola <br>
//Date Written: October 98   <br>
//Purpose:      Reusable client-side Javascript validation functions <br>
//<B>Do not modify in design view. Switch to source view.</B><BR>
//*************************************************************************<br>
// <SCRIPT language="JavaScript">
<!--

function isUserNm(obj, field)
{
    if ((obj.value.length <= 0) || (obj.value == null) || (obj.value.charAt(0)
        == " "))
        {
        errorMsg = field + " should not be blank!";
        return true;
    }
    else if((obj.value.length > 0) || (obj.value != null))
    {
        for(i=0;i<obj.value.length;i++)
        {
            if(obj.value.charAt(i)== " ")
            {
                errorMsg = "In " + field + " space are not allowed!";
                return true;
            }
        }
    }
    return false;
}
function isEmpty(obj, field)
{
    if ((obj.value.length <= 0) || (obj.value == null) || (obj.value.charAt(0)
        == " "))
        {
        errorMsg = field + " entry is required!";
        return true;
    }
    return false;
}
function isValidCode(obj, field, mask)
{
    var str = obj.value;
	
    errorMsg = field + " entry must be of the format: " + mask;

    if (str.length != mask.length)
        return false;
    else
    {
        for (i=0; i<mask.length; i++)
        {
            if (mask.charAt(i) == 9)
            {
                if ((str.charAt(i) > 0) || (str.charAt(i) < 9))
                    return false;
            }
            else if (mask.charAt(i) == "A")
            {
                if ((str.charAt(i) < "A") || (str.charAt(i) > "Z"))
                    return false;
            }
            else
            {
                if (str.charAt(i) != mask.charAt(i))
                    return false;
            }
        }
    }
    return true;
}
function isNumeric(obj, field)
{
    var str = obj.value;
    errorMsg = field + " entry must be numeric!";

    if (str.length <= 0)
        return false;

    for (i=0; i<str.length; i++)
    {
        if ((str.charAt(i) > 0) || (str.charAt(i) < 9) || (str.charAt(i)=="-"))
            return false;
    }
    return true;
}
function isMDY(obj, field)
{
    if(obj.value.length<=0)
    {
        errorMsg = field + "should not be blank!";
        return true;
    }
	
    str = obj.value;

    if  (isValidCode(obj, field, "99999999"))
        obj.value = str.substring(0, 2) + "/" + str.substring(2, 4) + "/" +
        str.substring(4, 8);
    else if (isValidCode(obj, field, "9/9/9999"))
        obj.value = "0" + str.substring(0, 2) + "0" + str.substring(2, 8);
    else if (isValidCode(obj, field, "9/99/9999"))
        obj.value = "0" + str.substring(0, 9);
    else if (isValidCode(obj, field, "99/9/9999"))
        obj.value = str.substring(0, 3) + "0" + str.substring(3, 9);

    if (!isValidCode(obj, field, "99/99/9999"))
        return false;

    var str = obj.value;
    var month = str.charAt(0) == "0" ? parseInt(str.substring(1, 2)) :
    parseInt(str.substring(0, 2));
    var day = str.charAt(3) == "0" ? parseInt(str.substring(4, 5)) :
    parseInt(str.substring(3, 5));
    var year = str.charAt(8) == "0" ? parseInt(str.substring(9, 10)) :
    parseInt(str.substring(8, 10));
    var cent = str.charAt(6) == "0" ? parseInt(str.substring(7, 8)) :
    parseInt(str.substring(6, 8));
    errorMsg = field + " entry is invalid!";

    if (day == 0)
        return false;

    if (month == 0 || month > 12)
        return false;

    if (cent != 19 && cent != 20)
        return false;

    if (month == 1 || month == 3 || month == 5 || month == 7 || month == 8 ||
        month == 10 || month == 12)
        {
        if (day > 31)
            return false;
    }
    else if (month == 4 || month == 6 || month == 9 || month == 11)
    {
        if (day > 30)
            return false;
    }
    else if (year % 4 == 0)
    {
        if (day > 29)
            return false;
    }
    else if (day > 28)
        return false;

    return true;
}
function isMoney(obj, field)
{
    var str = obj.value;
    errorMsg = field + " entry must be in money format!";

    if (str.length <= 0)
        return false;

    i = 0;
    for (j=0; j<str.length; j++)
    {
        if ((str.charAt(j) != ".") && (str.charAt(j) != ",") && ((str.charAt(j) >
            0) || (str.charAt(j) < 9)))
            return false;
        if (str.charAt(j) == ".")
        {
            i += 1;
            if (i > 1)
                return false;
            else if ((str.length - j) > 3)
                return false;
        }
    }
    return true;
}
function isPostalCode(obj, field)
{
    obj.value = obj.value.toUpperCase();
    if (isValidCode(obj, field, "A9A9A9"))
    {
        str = obj.value;
        obj.value = str.substring(0, 3) + " " + str.substring(3, 6);
        return true;
    }
    else if (isValidCode(obj, field, "A9A 9A9"))
        return true;

    return false;
}
function isPhone(obj, field)
{
    errorMsg = field + " entry must be of the format (999) 999-9999!";

    //alert(obj.value);
	
    if (obj.value.length < 10)
    {
        errorMsg = "Please include area code.";
        return false;
    }
    if (isValidCode(obj, field,"9999999999"))
    {
        str = obj.value;
        obj.value = "(" + str.substring(0, 3) + ") " + str.substring(3, 6) + "-" +
        str.substring(6, 10);
        return true;
    }
    else if (isValidCode(obj, field, "999 9999999"))
    {
        str = obj.value;
        obj.value = "(" + str.substring(0, 3) + ") " + str.substring(4, 7) + "-" +
        str.substring(7, 11);
        return true;
    }
    else if (isValidCode(obj, field, "999 999 9999"))
    {
        str = obj.value;
        obj.value = "(" + str.substring(0, 3) + ") " + str.substring(4, 7) + "-" +
        str.substring(8, 12);
        return true;
    }
    else if (isValidCode(obj, field, "999 999-9999"))
    {
        str = obj.value;
        obj.value = "(" + str.substring(0, 3) + ") " + str.substring(4, 12);
        return true;
    }
    else if (isValidCode(obj, field, "999999-9999"))
    {
        str = obj.value;
        obj.value = "(" + str.substring(0, 3) + ") " + str.substring(3, 11);
        return true;
    }
    else if (isValidCode(obj, field, "999-999-9999"))
    {
        str = obj.value;
        obj.value = "(" + str.substring(0, 3) + ") " + str.substring(4, 12);
        return true;
    }
    else if (isValidCode(obj, field, "(999)999-9999"))
    {
        str = obj.value;
        obj.value = str.substring(0, 5) + " " + str.substring(5, 13);
        return true;
    }
    else if (isValidCode(obj, field, "(999)9999999"))
    {
        str = obj.value;
        obj.value = str.substring(0, 5) + " " + str.substring(5, 8) + "-" +
        str.substring(8, 12);
        return true;
    }
    else if (isValidCode(obj, field, "(999) 9999999"))
    {
        str = obj.value;
        obj.value = str.substring(0, 6) + str.substring(6, 9) + "-" +
        str.substring(9, 13);
        return true;
    }
    else if (isValidCode(obj, field, "(999)999 9999"))
    {
        str = obj.value;
        obj.value = str.substring(0, 5) + " " + str.substring(5, 8) + "-" +
        str.substring(9, 13);
        return true;
    }
    else if (isValidCode(obj, field, "(999) 999 9999"))
    {
        str = obj.value;
        obj.value = str.substring(0, 6) + str.substring(6, 9) + "-" +
        str.substring(10, 14);
        return true;
    }
    else if (isValidCode(obj, field, "(999) 999-9999"))
        return true;

    return false;
}
function emailInvalid(s){
    if(!(s.match(/^[\w]+([_|\.-][\w]{1,})*@[\w]{2,}([_|\.-][\w]{1,})*\.([a-z]{2,4})$/i) ))
    {
        //alert("Invalid");
        errorMsg="Invalid Email Id !";
        return false;
    }
    else
        //alert("valid");
        return true;
}
function isCountryNm(obj,field)
{
    if(obj.value=="")
    {
        errorMsg = field + " should be selected!";
        return false;
		
    }
    return true;
	
}
function madeSelection(elem, field)
{
	
    if(elem.value=="Select" || elem.value=="")
    {
        errorMsg=field + " Please Select !";
        return false;
    }else{
        return true;
    }
}

function isValidNumber(obj){

    val = obj;
    cur  = /^-?\d{1,3}(,\d{3})*(\.\d{1,2})?$/;
    anum=/(^-?\d+$)|(^-?\d+\.\d+$)/;
    ret = false;

    if(val.indexOf(",")>-1)
        ret = cur.test(val);
    else
        ret = anum.test(val);

    if(!ret){
        alert("Invalid number format");
        return false;
    }
    else
        return true;
}


function trim(value)
{
    startpos=0;
    while((value.charAt(startpos)==" ") && (startpos<value.length))
    {
        startpos++;
    }
    if(startpos==value.length)
    {
        value="";
    }
    else
    {
        value=value.substring(startpos,value.length);
        endpos=(value.length)-1;
        while(value.charAt(endpos)==" ")
        {
            endpos--;
        }
        value=value.substring(0,endpos+1);
    }
    return(value);
}

// FOR USE THE EXTRA FIELD TYPE VALUE BLOCK  USE PAGE editextrafield.php//
function extrafieldblock(postid) 
{
    if(postid=='OPTION')
    {
        var whichpost = document.getElementById(postid);
	
        if (whichpost!=null)
        {
            if (whichpost.className=="noneextratypeblock")
            {
                whichpost.className="yesextratypeblock";
            }
            else
            {
                whichpost.className="noneextratypeblock";
            }
        }
    }
    else
    {
        var whichpost = document.getElementById('OPTION');
        whichpost.className="noneextratypeblock";
    }
}
//

// USE FOR AJAX //
function GetXmlHttpObject()
{
    var xmlHttp=null;
    try
    {
        // Firefox, Opera 8.0+, Safari
        xmlHttp=new XMLHttpRequest();
    }
    catch (e)
    {
        // Internet Explorer
        try
        {
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}

function isDDMMYY(adDate) {
    var pattern = /^(([0-2]\d|[3][0-1])\/([0]\d|[1][0-2])\/[2][0]\d{2})$|^(([0-2]\d|[3][0-1])\/([0]\d|[1][0-2])\/[2][0]\d{2}\s([0-1]\d|[2][0-3])\:[0-5]\d\:[0-5]\d)$/;
    return pattern.test(adDate);
}

function toDate(dmy){
    var arr=dmy.split('/');
    return new Date(arr[2],arr[1],arr[0]);
}

/*
//<![CDATA[
	HpCore.locale  = 'en';
	HpCore.locales = new Array('en');
	HpResource.decimalSeparator  = '.';
	HpResource.groupingSeparator = ',';
//]]>*/

//-->
