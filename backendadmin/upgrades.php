<?php
ini_set('display_errors', 1);
session_start();
$active="Admin User";
include("connect.php");
$PRODUCTSPERPAGE=20;

if($_POST['from'] != $license_server & $_POST['from'] != str_replace("www.", "", $license_server)){
include("security.php");
include('../sendmail.php');
}


function insertAddon($addon, $license_key, $status, $settings){

include("../config/config.inc.php");
$db = db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
if (!$db) {
    die('Could not connect: ' . db_error());
}
//if($status == 1){
db_select_db($DATABASENAME, $db);
if(db_num_rows(db_query("select * from sitesetting where value= '$addon' and name = 'addons'"))>=1){
db_query("delete from sitesetting  where value= '$addon' and name = 'addons'");

}
  $query1 = "insert into sitesetting(id, name, value, license_key, status) values(null, 'addons', '$addon', '$license_key', '$status');";

    db_query($query1);
    echo db_error();

    if(is_array($settings)){
    $setting = '';
	foreach($settings as $key => $value){
	 
	  
	      $setting_str .= $value . ":";
	  
	}
	
    db_query("insert into sitesetting(id, name, value) values(null, '$addon', '$setting_str');");
    }
    if(!file_exists($BASE_DIR . "/include/addons/$addon/") & $status == '1'){
    
	shell_exec("cd ". $BASE_DIR . "/include/addons/$addon/");
	shell_exec("wget $download_server/addons/$value.zip");
	shell_exec("unzip ". $BASE_DIR . "/include/addons/$addon/");
    
    
    }
    
    if(file_exists($BASE_DIR . "/include/addons/$addon/uninstall.php") & $addon != 'livesuppport' & $status == 0){
    
	include_once($BASE_DIR . "/include/addons/$addon/uninstall.php");
    
    
    }
    
    //}
    
    if(file_exists($BASE_DIR . "/include/addons/$addon/install.php") & $addon != 'livesuppport' & $status == 1){
    
	include_once($BASE_DIR . "/include/addons/$addon/install.php");
    
    
    }

}



	if(!empty($_POST['add'])){
	//print_r($_POST);
	    foreach($_POST['addons'] as $key => $value){
	  
	    //echo "delete from sitesetting where name = 'addons' and value = '$value'";
	    
	    if($value != 'design_suite' & $value != 'facebook' & $value != 'vendors'){
		db_query("delete from sitesetting where name = 'addons' and value = '$value'");
		db_query("delete from sitesetting where name = '$value'");
		}
			
		if($value == 'design_suite'){		
		    if(db_num_rows(db_query("select * from sitesetting where name = 'design_suite'")) >= 1 ){
			db_query("delete from sitesetting where name = 'design_suite'");
			}
			  db_query("insert into sitesetting (id, name, value) values(null, 'design_suite', '" . $_POST[$value]['status']. "');");
		}	
		
		
		
		foreach($_POST[$value] as $key2 => $value2){
		    $l_key = $_POST[$value]['license_key'];
		    
		 
				    $ch = curl_init();
				      $url = "$license_server/licenseadminpanel/upgrades.php?script=$value&license=$l_key&domain=$_SERVER[SERVER_NAME]";

				      curl_setopt($ch, CURLOPT_URL,"$url");
				      curl_setopt($ch, CURLOPT_VERBOSE, 1);

				      //turning off the server and peer verification(TrustManager Concept).
				      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
					      curl_setopt($ch, CURL_HTTP_VERSION_1_1, 1);
				      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				      curl_setopt($ch, CURLOPT_REQUEST, 1);
				      curl_setopt($ch,CURLOPT_REQUESTFIELDS,REQUESTVARSCOMPLETE);
				      $response = curl_exec($ch);
				      
				      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				      curl_close($ch);
				      
				      
				$response = json_decode($response);
				
		  if($response[0] == 'true'){
		 
	
	
			    if(!empty($l_key)){
				
					
					insertAddon($value, $l_key, $_POST[$value]['status'], $_POST[$value]['settings']);
				
				  
			    }else{
			    
				  insertAddon($value, $l_key, $_POST[$value]['status'], $_POST[$value]['settings']);
				
			    }
			 
			 
			 }else{
			 
			// echo "Curl Request Failed";
			 }
		
		    }
		
		  }
		   if($_POST['from'] == $license_server){
		  echo "Installed and Enabled $value for " . $_SERVER['SERVER_NAME'];
		  }
		
		}
	    
	    


$ch = curl_init();

$url = "$license_server/licenseadminpanel/upgrades.php?user=$_SESSION[username]";



	curl_setopt($ch, CURLOPT_URL,"$url");
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
	//turning off the server and peer verification(TrustManager Concept).
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, TRUE);
	curl_setopt($ch, CURL_HTTP_VERSION_1_1, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_REQUEST, 1);
	curl_setopt($ch,CURLOPT_REQUESTFIELDS,REQUESTVARSCOMPLETE);


	curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);


	$response = curl_exec($ch);
	
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		    
	echo curl_error($ch);
	
	
	
	
if($_POST['from'] != $license_server){	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Upgrades-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
 
	
	<script type="text/javascript" src="js/ui/ui.dialog.min.js"></script>
        <!--[if lte IE 6]>
        <link href="css/menu_ie.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <script language="javascript">
            function BidHistoryPlus(id,plus,minus)
            {
                document.getElementById(plus).style.display = 'none';
                document.getElementById(minus).style.display = 'block';
                document.getElementById(id).style.display = 'block';
            }

            function BidHistoryMinus(id,plus,minus)
            {
                document.getElementById(plus).style.display = 'block';
                document.getElementById(minus).style.display = 'none';
                document.getElementById(id).style.display = 'none';
            }
        </script>
      
    </head>

    <body>
    <div id="user_info"></div>
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
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Manage Upgrades</h2>
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
                                                    
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                
                                                                <form id="form2" name="form2" action="" method="post">
                                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                               
                                                                                <th>Addon Name:</th>
                                                                                <th>License Type:</th>
                                                                                <th>Status:</th>
                                                                             
                                                                                <th>License Key:</th>
                                                                                 <th>Settings:</th>
                                                                            </tr>
                                                                           
                                                                            
                                                                                <?php
                                                                              $response = json_decode($response);
                                                                                $colorflg=0;
                                                                                $i = 0;
                                                                                foreach($response as $key => $value){
                                                                                
                                                                                
                                                                                $info = db_fetch_array(db_query("select * from sitesetting where name = 'addons' and value ='" . $response[$key]->value . "' order by id desc limit 1"));
                                                                                
										      ?>
											<tr>
											    <td style="font-weight:bold;"><?php echo ucwords(str_replace("_", " ",$response[$key]->value)); ?>
											    </td>
											    <td>
											    <input type="hidden" value="<?php echo $response[$key]->value;?>" name="addons[<?php echo $i;?>]" id="addons[<?php echo $i;?>]" />
											    <?php echo $response[$key]->license; ?>
											    </td>
											    <td>
											    
											    <?php 
											    $extra = '';
											   
											    if($response[$key]->license != 'free'){
												$extra = "  and license_key = '$info[license_key]'";
											    }
											    if(!file_exists('../include/addons/' . $response[$key]->value . '/')){
											    
											    echo "Contact PAS For This Upgrade";
											    
											    
											    }else{
											   
											    if(file_exists('../include/addons/' . $response[$key]->value . '/')){
											    echo "<p style=\"color:green;\">Installed</p>";
											    ?>
											    <select id="<?php echo $response[$key]->value; ?>[status]"
											    name="<?php echo $response[$key]->value; ?>[status]"
											    onchange="enable_addon('<?php echo $response[$key]->value; ?>');">
											    
											    <?php
											    if(db_num_rows(db_query("select * from sitesetting where value ='" . $response[$key]->value . "' and status = 1")) >= 1){
												$status = 1;
												
											    }else{
											    
												$status = 0;
											    
											    }
											    ?>
											    <option value="1" <?php if($status == 1){ echo 'selected'; } ?> >Enabled</option>
											    <option value="0" <?php if($status == 0){ echo 'selected'; } ?> >Disabled</option>
											    </select>
											    <?php
											    }else{
											    
												 echo "<p style=\"color:red;\">Not Installed</p>";
											    
											    }
											    
											    }
											    
											    ?>
											    </td>
											    <td>
											    <?php
											    if($response[$key]->license == 'nonfree'){
											    ?>
											    Never share your license keys...<br />Doing so can cause site interuptions<br />
												 <input type="text" value="<?php echo $info['license_key'];?>" name="<?php echo $response[$key]->value;?>[license_key]" id="<?php echo $response[$key]->value;?>[license_key]" />
											    <?php } ?>
											    
											    </td>
											    <td>
											    <?php
											
											    if(!empty($response[$key]->settings)){
											    $m = 0;
												foreach($response[$key]->settings as $s_key => $setting){
				$sql_s = db_fetch_array(db_query("select distinct(value) from sitesetting where name = '" . $response[$key]->value . "' order by id desc limit 1"));
												
				$my_site = explode(":", $sql_s['value']);
				  
					?>
					<span style="font-weight:bold;"><?php echo $setting; ?>: <input type="text" value="<?php echo $my_site[$m];?>" name="<?php echo $response[$key]->value;?>[settings][<?php echo $s_key;?>]" id="<?php echo $response[$key]->value;?>[settings][<?php echo $s_key;?>]" /></span>
												    <br />
												
					<?php
												$m++;
												}
												
											    }
											    
											    ?>
											    </td>
											</tr>
                                                                               <?php
                                                                               $i++;
                                                                                }
                                                                                ?>
                                                                            <tr>
										<td colspan="4" align="right">
								<!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>                                                                               
                                                                                <span class="button send_form_btn"><span><span>Update</span></span><input name="add" type="submit"/></span>


                                                                            </li>

                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
										</td>
									    </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </form>
                                                                  
                                                            </div>
                                                        </div>
                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                    </div>

                                                    <?php if($total) { ?>
                                                    <!--[if !IE]>start pagination<![endif]-->
                                                    <div class="pagination">
                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpage; ?></span>
                                                        <ul class="pag_list">
                                                                <?php
                                                                if($PageNo>1) {
                                                                    $PrevPageNo = $PageNo-1;
                                                                    ?>
                                                            <li><a href="manage_members.php?pgno=<?=$PrevPageNo; ?>&order=<?=$order?>&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                    <?php } ?>

                                                                <?php
                                                                $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                $pageTo=$PageNo+3>$totalpage?$totalpage:$PageNo+3;
                                                                for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                    ?>
                                                                    <?php if($i==$PageNo) { ?>
                                                            <li><a href="manage_members.php?pgno=<?=$i;?>&order=<?=$order?>&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                        <?php }else {?>
                                                            <li><a href="manage_members.php?pgno=<?=$i;?>&order=<?=$order?>&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>"><?php echo $i; ?></a></li>
                                                                        <?php }
                                                                }
                                                                ?>
                                                                <?php
                                                                if($PageNo<$totalpage) {
                                                                    $NextPageNo = 	$PageNo + 1;
                                                                    ?>
                                                            <li><a href="manage_members.php?pgno=<?=$NextPageNo;?>&order=<?=$order?>&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                    <?php } ?>
                                                        </ul>

                                                    </div>
                                                    <!--[if !IE]>end pagination<![endif]-->
                                                        <?php }?>

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
									  <script>
                                                                            $('a[title]').qtip();
                                                                               </script>
    </body>
</html> 
<?php } ?>