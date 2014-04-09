<?php
ini_set('display_errors' , 1);
require("../../../../config/config.inc.php");
db_connect($DBSERVER, $USERNAME, $PASSWORD);


db_select_db($DATABASENAME);

//print_r($_GET);

if(isset($_REQUEST['sitenm'])){

$text = "<?php
@session_start();
// Example of connection settings

\$DBSERVER  = \"$_REQUEST[hostname]\";
\$DATABASENAME  = \"$_REQUEST[database]\";
\$USERNAME  = \"$_REQUEST[username]\";
\$PASSWORD  = \"$_REQUEST[password]\";

\$ADMIN_MAIN_SITE_NAME=\"$_REQUEST[sitename]\";

\$SITE_NM=\"$_REQUEST[sitenm]\";

\$AllPageTitle = \"$_REQUEST[pagetitle]\";
\$SITE_URL=\"$_REQUEST[siteurl]\";
\$subfolder='';

\$MetaTagskeywords = \"$_REQUEST[metatagskeywords]\";
//MetaTag keywords for SEO

\$MetaTagsdescripton = \"$_REQUEST[metatagskeywords]\";
//MetaTag Description

// Other information from the installer
\$defaultlanguage = \"$_REQUEST[language]\";

\$UploadImagePath =\"$_REQUEST[uploads]\";
\$openinviter_cookiepath=\"$_REQUEST[tmp]\";

//How may items to show in a user account
\$Currency = \"$_REQUEST[currencycode]\";
\$CurrencyName=\"$_REQUEST[currencyname]\";

\$PlusPointValue = \"$_REQUEST[pluspoints]\";
//Bonus Points Value

//$lastaucseconds = 60;
//Auction ending seconds

//$onlineperbidvalue = 0.20;
//Bid value

\$ZX14317801374018374verification = \"$_REQUEST[google]\";
//Google verification code

\$customtags = '';


\$PRODUCTSPERPAGE = \"$_REQUEST[perpage]\";
//How many items on the main page
\$PRODUCTSPERPAGE_MYACCOUNT = \"$_REQUEST[my_account]\";


//Currency symbol
\$SMSrate = 1.50;
//SMS Rate, you must have the SMS plugin for this
\$SMSsendnumber = \"1065\";
//SMS Clicktell account number
\$paymentFolder='payment';
\$topbidercount=4;
?>";
    $handle = "../../../../config/config.inc.php";


	file_put_contents($handle, $text);

   

require("../../../../config/config.inc.php");

}

  ?>
  
  
    <form name="config" action="javascript: submit_test_ajax_form('config', '<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/configuration.php?');" id="config">
  

    <table align="center" style="padding-top:10px;padding-bottom:10px;margin:0 auto;" width="1200px;">
      <tr>
	<td colspan="2" align="left">
	  <b> Database </b>
	  
		<table>
		  <tr>
		    <td>
		      Hostname: <br /><input type="text" name="hostname" id="hostname" value="<?php echo $DBSERVER; ?>" />
		
		    </td>
		  </tr>
		  <tr>
		    <td>
		     RESTRICTED INFO
		    </td>
		  </tr>
		  <tr>
		    <td>
		    RESTRICTED INFO
		    </td>
		  </tr>
		</table>
	  </td>

	  <td colspan="2" align="left">
	  <b> Meta Tag Info </b>
	  
		<table>
		  <tr>
		    <td>
		      Site Name: <br /><input type="text" name="sitename" id="sitename" value="<?php echo $ADMIN_MAIN_SITE_NAME; ?>" />
		
		    </td>
		  </tr>
		  <tr>
		    <td>
		      Short Name: <br /><input type="text" name="sitenm" id="sitenm" value="<?php echo $SITE_NM; ?>" />
		
		    </td>
		  </tr>

		  <tr>
		      <td>
			Site Title: <br /><input type="text" name="pagetitle" id="pagetitle" value="<?php echo $AllPageTitle; ?>" />
		  
		      </td>
		    </tr>
		  <tr>
		    <td>
		      Site Description: <br /><input type="text" name="metatagsdescription" id="metatagsdescription" value="<?php echo $MetaTagsdescripton; ?>" />
		
		    </td>
		  </tr>
		  <tr>
		    <td>
		      Keywords: <br /><input type="text" name="metatagskeywords" id="metatagskeywords" value="<?php echo $MetaTagskeywords; ?>" />
		
		    </td>
		  </tr>
		</table>	    
	  </td>

	  <td colspan="2" align="left">
	      <b>Paths</b>
	      <table>
		  <tr>
		    <td>
		      Site Url: <br /><input type="text" name="siteurl" id="siteurl" value="<?php echo $SITE_URL; ?>" />
		
		    </td>
		  </tr>
		  <tr>
		    <td>
		      Upload Path: <br /><input type="text" name="uploads" id="uploads" value="<?php echo $UploadImagePath; ?>" />
		
		    </td>
		  </tr>
		  <tr>
		    <td>
		      Cookie Path: <br /><input type="text" name="tmp" id="tmp" value="<?php echo $openinviter_cookiepath; ?>" />
		
		    </td>
		  </tr>
		  <tr>
		    <td>
		      Google API Key: <br /><input type="text" name="google" id="google" value="<?php echo $googleverification; ?>" />
		
		    </td>
		  </tr>
	      </table>
	  </td>






	  <td colspan="2" align="left">
	      <b>Miscellaneous</b>
	      <table>
		  <tr>
		    <td>
		      Currency Symbol: <br /><input type="text" name="currencysymbol" id="currencysymbol" value="<?php echo $Currency; ?>" />
		
		    </td>
		  </tr>
		  <tr>
		    <td>
		      Currency Name: <br /><input type="text" name="currencyname" id="currencyname" value="<?php echo $CurrencyName; ?>" />
		
		    </td>
		  </tr>
		  <tr>
		    <td>
		      Products Per Page: <br /><input type="text" name="perpage" id="perpage" value="<?php echo $PRODUCTSPERPAGE; ?>" />
		
		    </td>
		  </tr>
		  <tr>
		    <td>
		      Products Per Page (user pages): <br /><input type="text" name="my_account" id="my_account" value="<?php echo $PRODUCTSPERPAGE_MYACCOUNT; ?>" />
		
		    </td>
		  </tr>
		  <tr>
		    <td>
		     <input type="submit" name="submit" id="submit" value="Submit" />
		
		    </td>
		  </tr>
	      </table>
	  </td>
	</tr>
      </table>

</form>