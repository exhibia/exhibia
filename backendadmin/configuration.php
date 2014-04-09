<?php

if($_REQUEST['ajax'] != 'true'){

session_start();
$active = "Admin User";
include_once("admin.config.inc.php");

include("connect.php");
}else{

include("../config/connect.php");

}

if(db_num_rows(db_query("select * from templates")) == 0 & empty($_POST['submit'])){

db_query("insert into templates(id, template) values(null, 'default');");
db_query("insert into templates(id, template) values(null, 'pas');");

    db_query("insert into sitesetting values(null, 'master_settings', 'template:pas');");
}

if(!empty($_POST['submit'])){



  foreach($_POST['setting'] as $key => $value){
      if(db_num_rows(db_query("select * from sitesetting where name = 'master_settings' and value like '$key:%'")) >= 1){
      
      
	db_query("update sitesetting set value = '$key:$value' where name = 'master_settings' and value like '$key:%'");
	
	
	}else{
	
	    db_query("insert into sitesetting (id, name, value) values(null, 'master_settings', '$key:$value');");
	
	}
  
  
  
    }



include("connect.php");




}
db_query("CREATE TABLE IF NOT EXISTS `settings_array` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `text` text,
  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;");

$settings_array = array('ADMIN_MAIN_SITE_NAME' => 'Site Full Name', 
'SITE_NM' => 'Site Short Name', 
'AllPageTitle' => 'Default Page Title', 
'MetaTagskeywords' => 'Default Keywords',
'MetaTagsdescripton' => 'Default Site Description',
'defaultlanguage' => 'Default Language(overridden in language settings',
'Currency' => 'Currency Symbol',
'CurrencyName' => 'Currency Text',
'PlusPointValue' => 'Plus Point Value',
'googleverification' => 'Google Key',
'customtags' => 'Extra Meta Tags', 
'PRODUCTSPERPAGE' => 'Products Per Page)', 
'PRODUCTSPERPAGE_MYACCOUNT' => 'Products Per Page for Account Pages', 
'SiteCity' => 'Site City', 
'SiteState' => 'Site State', 
'SiteCountry' => 'Site Country',
'template' => 'Template'
);
if(!empty($_REQUEST['setting'])){

    if(!empty($_POST['setting'])){
    
      foreach($_POST['setting'] as $key => $value){
      
	if(db_num_rows(db_query("select * from sitesetting where name = 'master_settings' and value like '$key:%'")) >= 1){
      
      
	    db_query("update sitesetting set value = '$key:$value' where name = 'master_settings' and value like '$key:%'");
	
	
	}else{
	
	    db_query("insert into sitesetting (id, name, value) values(null, 'master_settings', '$key:$value');");
	
	}
    if($key == 'template'){
	db_query("update sitesetting set value = '$value' where name = 'template'");
      
      }
      
      }
    
    
    }else if(!empty($_GET['setting'])){
    
      foreach($_GET['setting'] as $key => $value){
      
	if(db_num_rows(db_query("select * from sitesetting where name = 'master_settings' and value like '$key:%'")) >= 1){
      
      
	    db_query("update sitesetting set value = '$key:$value' where name = 'master_settings' and value like '$key:%'");
	
	
	}else{
	
	    db_query("insert into sitesetting (id, name, value) values(null, 'master_settings', '$key:$value');");
	
	}
      
      } 
      
      if($key == 'template'){
	db_query("update sitesetting set value = '$value' where name = 'template'");
      
      }
    
    }
  /*  if($key == 'template'){
	if(!file_exists($BASE_DIR . "/css/$value.css")){
	    shell_exec("cd $BASE_DIR/css");
	    shell_exec("wget $download_server/css/$value.css");
	
	
	}
    
    
    
    }*/
 //   echo "update sitesetting set value = '$key:" . $value. "' where value like '$key:%' and name = 'master_settings'";
echo db_error();
}else{
if(db_num_rows(db_query("select * from settings_array")) == 0){

foreach($settings_array as $setting => $text){
    if(!is_numeric($setting)){
	      if(db_num_rows(db_query("select * from settings_array where name = '$setting'")) == 0){
	      
		  db_query("insert into settings_array(id, name, value) values(null, '$setting', '$text');");
	      
	      }

	      if(db_num_rows(db_query("select * from sitesetting where value like '$setting:%' and name = 'master_settings'")) == 0){

		    db_query("insert into sitesetting (id, name, value) values(null, 'master_settings', '$setting:" . $$setting . "');");
		  

		}
	  }
    }

}else{

   foreach($settings_array as $setting => $text){

 	      if(db_num_rows(db_query("select * from sitesetting where value like '$setting:%' and name = 'master_settings'")) == 0){

		    db_query("insert into sitesetting (id, name, value) values(null, 'master_settings', '$setting:" . $$setting . "');");
		  

		}else{
		
		db_query("update sitesetting set value = '$setting:" . $$setting . "' where value like '$setting:%' and name = 'master_settings'");
		
		
		}
   
   
   }

}

}
if($_REQUEST['ajax'] != 'true'){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Site Configuration-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <style>
        .hide_me{
        display:none;
        }
        </style>

       

    </head>

    <body>
    
        <!--[if !IE]>start wrapper<![endif]-->
        <div id="wrapper">
            <!--[if !IE]>start head<![endif]-->
            <div id="head">
                <?php include('include/header.php'); ?>
            </div>
            <!--[if !IE]>end head<![endif]-->

            <!--[if !IE]>start content<![endif]-->
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">
                    <div class="inner">
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Site Configuration</h2>
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>
                            <!--[if !IE]>end title wrapper<![endif]-->
                            <!--[if !IE]>start section content<![endif]-->
                            <div class="section_content">
                                <!--[if !IE]>start section content top<![endif]-->
                                <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">
                                                    <!--[if !IE]>start system messages<![endif]-->

                                                

                                                   
<?php }
?>

<?php
$setting = db_query("select * from settings_array");
?>
<table>
    <tr>
      <td valign="top" height="100%">
<?php
if(!empty($_REQUEST['ajax'])){
    
    ?>  

<form id="sitesetting" id="form1" class="settings_form" action="javascript: post_config();">
<center>
<table width="100%" align="center">

<?php }else{ ?>  
 <form id="form1" action="configuration.php" method=post enctype="multipart/form-data" class="search_form general_form">
						      <fieldset>
						      <div class="forms">

<?php } ?><!--[if !IE]>start fieldset<![endif]-->
                                                       
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            
                                                                <!--[if !IE]>start row<![endif]-->
                                    
                                      
                                      
                                      <?php
                                       $i = 0;
                                      
                                      while($row_s = db_fetch_array($setting)){
                                      
                                    
                                     
                                      if(!empty($_REQUEST['ajax'])){
                                      ?>
                                    
                                      <td align="left">
                                      <?php
                                      }
                                      ?>
                                      
                                         <?php if(empty($_REQUEST['ajax'])){ ?>
                                                                    <div class="row">
                                                                    
                                                                    <label <?php if(empty($_REQUEST['ajax'])){ ?> style="font-size:11px; font-weight:bold;" <?php } ?>>
                                                                    <?php }else { ?>
                                                                    <h2>
                                                                    
                                                                    <?php } ?>
                                                                    <?php echo $row_s['text'];?>:
                                                                    <?php if(empty($_REQUEST['ajax'])){ ?>
                                                                    </label>
                                                                    
                                                                      <?php }else { ?>
                                                                    </h2>
                                                                    
                                                                    <?php } ?>
                                      
                                                                <!--[if !IE]>start row<![endif]-->
                                                                
                                                                 
                                                                       
                                                                         
                                    <?php
                                    
                                    $qry_settings = db_query("select * from sitesetting where name = 'master_settings' and value like '$row_s[name]:%' order by id desc limit 1");
					  while($row_settings = db_fetch_array($qry_settings)){

					      $this_setting = explode(":", $row_settings['value']);
					      
					     
					      $$this_setting[0] = $this_setting[1];
					     
					    
					      if(db_num_rows(db_query("SHOW TABLES LIKE '".$row_s['name']."s'"))==1) {
					      ?>
							     <select name="setting[<?php echo $row_s['name'];?>]" id="setting[<?php echo $row_s['name'];?>]" class="setting_<?php echo $row_s['name'];?>">
							     
							      </select>
							      <script>
							          $(document).ready(function(){ $.get('<?php echo $SITE_URL;?>/backendadmin/curl.php?type=templates&just_list=true', function(response){
   
								    $('.setting_<?php echo $row_s['name'];?>').html(response);
								   
								    $('.setting_<?php echo $row_s['name'];?>').val('<?php echo $$this_setting[0];?>');
								  // $('#alert_message').dialog('open');
								});
								});
								</script>
					      
					      <?php 
					      
					      
					      }else{
					      
					      
					       
								    ?>
								    
								    
                                                                   
                                                                    
                                                                    <div class="inputs">
								      <textarea name="setting[<?php echo $row_s['name'];?>]" id="setting[<?php echo $row_s['name'];?>]" size="32" maxlength="256"><?php echo $this_setting[1];?></textarea>
								      
								      <?php
								      
						}

					  }
				      ?>
                                                                    </div>
                                                                    
                                                                     </div>
                                                                
                                    <?php 
					    $i++;
                              
						      
					  if(!empty($_REQUEST['ajax'])){
					  
						
					    ?>
					   
					    </td>
					
					    
					    
					    <?php 
					    
						  if($i % 6 ==0){
						  echo "</tr><tr>";
						  }
					    
					    }
					    
					    ?>
					 
					    
					    <?php
					
					} 
                                    
                                    
                                     if(!empty($_REQUEST['ajax'])){
                                    
                                     ?>     
                                     
                                     
                                      <tr>
					  <td colspan="6" align="right">
                                    
					<?php }
					?><!--[if !IE]>end row<![endif]$avatarfeature-->
			       
			        <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Save</span></span><input name="submit" type="submit"  /></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                         <?php
                                                          if(!empty($_REQUEST['ajax'])){
					  
						
							    ?>
							    </td></tr>
							    
							    <?php } ?>
                                                                <!--[if !IE]>end row<![endif]-->
                                                         
                                                            <!--[if !IE]>end forms<![endif]-->

                                                        </fieldset>
                                                        
				   
                                  
                                                        <!--[if !IE]>end fieldset<![endif]-->
                                                    </form>
                                                    
                                              
                                             
                                             <?php if(empty($_REQUEST['ajax'])){
                                             ?>
                                             
                                               </td>
                                                
                                               </tr>
                                             </table>
                                               <!--[if !IE]>end forms<![endif]-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
                        <!--[if !IE]>end section<![endif]-->

                    </div>
                </div>
                <!--[if !IE]>end page<![endif]-->
                <!--[if !IE]>start sidebar<![endif]-->
                <div id="sidebar">
                    <div class="inner">
                        <?php include 'include/leftside.php' ?>
                                                                                    </div>
                                                                                </div>
                                                                                <!--[if !IE]>end sidebar<![endif]-->

                                                                            </div>
                                                                            <!--[if !IE]>end content<![endif]-->

                                                                        </div>
                                                                        <!--[if !IE]>end wrapper<![endif]-->

                                                                        <!--[if !IE]>start footer<![endif]-->
                                                                        <div id="footer">
                                                                            <div id="footer_inner">
                <?php include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

    </body>
</html>

<?php 
}else{
?>
</table>
</td>
</tr>
</table>
<?php } ?>

