<?php
ini_set('display_errors', 1);


if($_REQUEST['ajax'] != 'true'){

session_start();
$active = "";
include_once("admin.config.inc.php");

include("connect.php");
}else{

include("../config/connect.php");

}
if(!empty($_POST['submit'])){

  foreach($_POST as $key => $value){
  
      if(!is_array($value) & $key != 'submmit'){
	  if(db_num_rows(db_query("select * from autolister_settings where setting = '$key'")) >= 1){
	  
	      db_query("update autolister_settings set value = '$value' where setting = '$key'"); 
	  
	  }else{
	  
	      db_query("insert into autolister_settings values(null, '$key', '$value');");
	  
	  }
  
      }else{
	  if($key == 'cats'){
	  
	  
		foreach($_POST['cats'] as $key2 => $value2){
		
		  if(!empty($value2)){
		    db_query("update categories set set_and_forget = '1' where categoryID = '$key2'");
		  }else{
		  
		  db_query("update categories set set_and_forget = '0' where categoryID = '$key2'");
		  
		  }
		
		}
	  
	  
	  
	  }
      
      
      }
	
  }



}
@db_query("alter table categories add column set_and_forget tinyint(1) default'0' null;");
@db_query("alter table products add column set_and_forget tinyint(1) default'0' null;");


$qry = db_query("select * from autolister_settings");
if(db_num_rows($qry) <= 1){
db_query("insert into autolister_settings values(null, 'reserve', '1'), (null, 'runtime', '300'), (null, 'delay', '60');");
}

    while($row = db_fetch_array($qry)){
    
	$$row['setting'] = $row['value'];
    
    
    }
    
if($_REQUEST['ajax'] == 'true'){
?>

<?php
}
if($_REQUEST['ajax'] != 'true'){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Set And Forget-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        

        <script  type="text/javascript">
    
        </script>
        

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
                                <h2>Set and Forget</h2>
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

                                                    <ul class="system_messages">
                                                        <?php if (isset($msg)) {
                                                        ?>
                                                            <li class="red"><span class="ico"></span><strong class="system_title"><?= $msg; ?></strong></li>
                                                        <?php } ?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>
                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <br/>

                                                   
<?php }

if($_REQUEST['ajax'] == 'true'){
    
    ?>  
<h2>You must also be logged into the backend for this to work</h2>
<form id="sitesetting" id="form1" class="settings_form">
<center>
<table width="100%" align="center"><tr>

<?php }else{ ?>  
 <form id="form1" action="set_and_forget.php" method=post enctype="multipart/form-data" class="search_form general_form">
						      <fieldset>
						      <div class="forms">

<?php } ?><!--[if !IE]>start fieldset<![endif]-->
                                                       
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            
                                                                <!--[if !IE]>start row<![endif]-->
                                      <?php
                                      if($_REQUEST['ajax'] == 'true'){
                                      ?>
                                    
                                      <td align="left">
                                      <?php
                                      }
                                      ?>
                                                                <div class="row">
                                                                    <label>Number of Auctions to Keep Active</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="max_auctions" id="max_auctions" size="32" maxlength="256" class="text" value="<?php echo $max_auctions; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        
                                                                        
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Allow Buy Now:</label>
                                                                    <div class="inputs">
                                                                       
                                                                            <input type="checkbox" name="allowbuynow" id="allowbuynow" size="32" maxlength="256" value="1" <?php if($allowbuynow == '1'){ echo 'checked'; } ?>/>
                                                                        
                                                                        <span class="currency"><?= $Currency; ?></span>
									
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Set Reserves:</label>
                                                                    <div class="inputs">
                                                                    
                                                                            <input type="checkbox" name="reserve" id="reserve" size="32" maxlength="256" value="1" <?php if($reserve == '1'){ echo 'checked'; } ?>/>
                                                                    
                                                                        <span class="currency">*</span>
									
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Run Time For Auctions:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="runtime" id="runtime" size="32" maxlength="256" class="text" value="<?php echo $runtime; ?>" />
                                                                        </span>
                                                                        <span class="currency">Seconds</span>
									
                                                                    </div>
                                                                </div>
                                                                 <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Delay Between Auctions:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="delay" id="delay" size="32" maxlength="256" class="text" value="<?php echo $delay; ?>" />
                                                                        </span>
                                                                        <span class="currency">Seconds</span>
									
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]--> 
                                                                
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Enable For Categories:</label>
                                                                    <div class="inputs">
                                                                    <ul>
                                                                    <?php
                                                                    
                                                                    $cats = db_query("select * from categories where categoryID != 1");
                                                                    
                                                                    while($rowC = db_fetch_array($cats)){
                                                                    ?>
                                                                    <li><?php echo $rowC['name'];?>:      <input type="checkbox" name="cats[<?php echo $rowC['categoryID'];?>]" id="cats[<?php echo $rowC['categoryID'];?>]" value="cats[<?php echo $rowC['categoryID'];?>]" <?php if($rowC['set_and_forget'] == '1'){ echo 'checked'; } ?>/>
                                                                    <?php } ?>
                                                                        <span class="currency">*</span>
									
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
								<!--[if !IE]>end row<![endif]-->                                                                
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Enable Bid Packs:</label>
                                                                    <div class="inputs">
                                                                    
                                                                            <input type="checkbox" name="bidpacks" id="bidpacks" size="32" maxlength="256" value="1" <?php if($bidpacks == '1'){ echo 'checked'; } ?>/>
                                                                    
                                                                        <span class="currency">*</span>
									
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->			       
				      <?php
				      if($_REQUEST['ajax'] == 'true'){
                                      ?>
                                      
                                                               <input id="ajax" value="true" type="hidden" />
                                                                 <input name="submit" type="button" onclick="javascript: submit_test_ajax_form_settings('form1', '<?php echo $SITE_URL . 'backendadmin/set_and_forget.php' ;?>', 'ajax', 'get');" value="Save" />
                                                               
                                                              </td>
                                                            </tr>
                                                          </table>
                                                       </center>
                                                     </form>

                                      <?php
                                      }else{
                                      ?>
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
                                                         
                                                                <!--[if !IE]>end row<![endif]-->
                                                     </div>
                                                            <!--[if !IE]>end forms<![endif]-->

                                                        </fieldset>
                                                        
				   
                                  
                                                        <!--[if !IE]>end fieldset<![endif]-->
                                                    </form>
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
    
<!--[if !IE]>start section<![endif]-->
<div class="section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h4>Auto Lister</h4>
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
			  
			  <ul style="list-style-type:none;margin-left:-40px;margin-top:0px;"><h3 style="text-align:center;">Features</h3>
			    <li>A Constant Stream Of Auctions</li>
			  </li>
			  
			</ul>
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

<?php }

?>
 
