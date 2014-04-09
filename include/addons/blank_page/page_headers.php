
	<link rel="stylesheet" href="<?php echo $SITE_URL;?>/backendadmin/css/cupertino/jquery-ui-1.7.3.custom.css" media="screen,projection" type="text/css" />
	<link rel="stylesheet" href="<?php echo $SITE_URL;?>/backendadmin/css/ui.datepicker.css" type="text/css"/>

   
     


	
 <link media="screen" rel="stylesheet" type="text/css" href="<?php echo $SITE_URL;?>/include/addons/blank_page/forms.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
 
 

<script>


function create_date_picker(id, options, format, thisYear){
if(!thisYear | thisYear == 'thisYear'){
thisYear = '-20:+0';
}

//jQuery('input[type=datetime]').datepicker();
if(!format){
<?php

$jsDate = explode("/", strtolower(Sitesetting::getDateFormat()));
 $realJsDateFormat = '';
$realJsDateFormat = $jsDate[0] . $jsDate[0] . "/" . $jsDate[1] . $jsDate[1] . "/" .$jsDate[2] . $jsDate[2];




?>
format = "<?php echo $realJsDateFormat;?>";
}

if(jQuery(document.getElementById(id))){
try{
jQuery(document.getElementById(id)).datepicker( {     yearRange:thisYear,  dateFormat: format, changeMonth: true, changeYear: true  });
}catch(oops){}
}
}
</script>







    

               