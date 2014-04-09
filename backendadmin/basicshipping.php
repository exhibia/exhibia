<?php
ini_set('display_errors', 1);
session_start();

include_once("config.inc.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");
include_once 'functions.php';
include_once '../data/paymentorder.php';
require_once '../data/userhelper.php';
require_once '../data/paymenthelper.php';
include_once '../data/emailtemplate.php';
include_once("../Functions/SendWinnerMail.php");


    if(!empty($_REQUEST['submit'])){
    
    
    

    ?><?php
      //db_query("update user_product set status = 1 where id = $_GET[orderid];");
     // db_query("update shippingstatus set status = '2' where id = $_GET[orderid]");
    // echo "select orderid from shippingstatus  where orderid = '$_GET[orderid]' and ordertype = $_REQUEST[ordertype]";
	    if(db_num_rows(db_query("select orderid from shippingstatus  where orderid = '$_GET[orderid]' and ordertype = $_REQUEST[ordertype]")) == 0){
	    
	    
	      if(db_query("insert into shippingstatus values(null, '" . urldecode($_GET['shippingtypeid']) . "', '$_GET[orderid]', '$_GET[ordertype]', '" . urldecode($_GET['trackingnumber']) ."', NOW(), '$_GET[shippingstatus]');")){
	      
		  
		$trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $_GET['orderid']));
                                                                                       
                $resc = db_fetch_object(db_query("select * from shipping where id = " . $trackingnumber->shippingtypeid ));
                                                                                     
                  $str = $resc->shipping_title ."<br />";
                  $str .= $trackingnumber->tracknumber . "<br />" . "" . $trackingnumber->adddate;
                  
                  echo "[{\"message\": \"$str\", \"status\" : \"Shipped\" }]";
                                                                                       
                                                                                       
                 $template = new EmailTemplate();                                
                 $emailtemplate = $template->getEmailTemplate('shipping');                              
                 if(!empty($emailtemplate)){                
                   SendHTMLMail2($user_data->email, $emailtemplate->subject . " " . $user_data->name, $emailtemplate->content . $emailtemplate->content ."<br />Shipping Agent" . $resc->shipping_title ."<br />Tracking Info"  .$trackingnumber->tracknumber . "<br />", "sales@" . $_SERVER['SERVER_NAME']); 
		    
		 }      
               }else{
			      echo db_error();
		  
	    }
	    
	    
	    }else{
	    
	      
	      if(db_query("update shippingstatus set adddate = NOW(), tracknumber = '" . urldecode($_GET['trackingnumber']) ."', shippingtypeid = '" . urldecode($_GET['shippingtypeid']) . "', ordertype = '$_REQUEST[ordertype]', status=$_GET[shippingstatus] where orderid = '$_GET[orderid]' and ordertype = $_REQUEST[ordertype]")){
		$trackingnumber = db_fetch_object(db_query("select * from shippingstatus where orderid = " . $_GET['orderid'] . "  and ordertype = $_REQUEST[ordertype]"));
                                                                                       
                 $resc = db_fetch_object(db_query("select * from shipping where id = " . $trackingnumber->shippingtypeid ));
                                                                                     
                  $str = $resc->shipping_title ."<br />";
                  $str .= $trackingnumber->tracknumber . "<br />" . "" . $trackingnumber->adddate;
                  
                  echo "[{\"message\": \"$str\", \"status\" : \"Shipped\" }]";
                  
                  $template = new EmailTemplate();                                
                  $emailtemplate = $template->getEmailTemplate('shipping');                              
                  if(!empty($emailtemplate)){                
                    
		    SendHTMLMail2($user_data->email, $emailtemplate->subject . " " . $user_data->name, $emailtemplate->content . $emailtemplate->content ."<br />Shipping Agent" . $resc->shipping_title ."<br />Tracking Info"  .$trackingnumber->tracknumber . "<br />", "sales@" . $_SERVER['SERVER_NAME']); 
		    
		   }                                                                                	  
		  
		  }else{
		  
		      echo db_error();
		  
		  }
	    
	    
	    }
      ?><?php
    }else{
        $row = db_fetch_object(db_query("select * from shippingstatus where orderid = '$_GET[orderid]' and ordertype = $_REQUEST[ordertype]"));
      
      ?>
	<span style="position:relative;width:180px;">
		<form id="form[<?php echo $_GET['orderid']?>]" name="form[<?php echo $_GET['orderid']?>]">
			<ul>
								    
			   <li>Provider:</li>
			   <li>
				<select name="shippingtypeid[<?php echo $_GET['orderid'];?>]" id="shippingtypeid[<?php echo $_GET['orderid'];?>]" style="font-size:10px;">
                                    <option value="none">select one</option>
                                          <?php
						 $resc = db_query("select * from shipping");
						    while ($obj = db_fetch_array($resc)) {
                                                    ?>
                                                         <option <?php echo isset($row->shippingtypeid) && $row->shippingtypeid == $obj['id'] ? "selected" : ""; ?> value="<?php echo $obj["id"]; ?>"><?php echo $obj["shipping_title"]; ?></option>
                                                    <?php
                                                                                   
                                                      }
                                                       db_free_result($resc);
                                           ?>
                               </select>
			   </li>
			   <li>Tracking Number:</li>
			   <li class="clear"></li>
			   <li> <input type="text" name="trackingnumber[<?php echo $_GET['orderid'];?>]" id="trackingnumber[<?php echo $_GET['orderid'];?>]" value="<?php echo $row->tracknumber;?>" style="font-size:10px;" size="15" /></li>
			   <li>
				<select name="shippingstatus[<?php echo $_GET['orderid'];?>]" id="shippingstatus[<?php echo $_GET['orderid'];?>]" style="font-size:10px;">
				      <option value="0" <?php if($row->status == 0){ echo 'selected'; } ?>>Not shipped</option>
				      <option value="1" <?php if($row->status == 1){ echo 'selected'; } ?>>Waiting Agent Pickup</option>
				      <option value="2" <?php if($row->status == 2){ echo 'selected'; } ?>>Shipped</option>
				      <option value="3" <?php if($row->status == 3){ echo 'selected'; } ?>>Confirmed</option>
				</select>
			   </li>			   
			   <li><input type="button" value="submit" onclick="javascript:ajaxupdateshipping<?php echo $_REQUEST['bn']; //added specifically for the new control panel code ?>('<?php echo $_GET['orderid'];?>', <?php echo $_REQUEST['ordertype'];?>);" style="font-size:10px;" /></li>
		       </ul>
		</form>
									  
	    </span>
<?php
    }

