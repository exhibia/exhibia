<?php
session_start();
$active="Database";
include_once 'security.php';
include_once "admin.config.inc.php";
include_once '../data/coupon.php';
include("functions.php");

@db_query("alter table coupon add column multiply int(2) null;");

$globalDateformat = db_fetch_array(db_query("select value from sitesetting where name  = 'dateformat' limit 1"));
$globalDateformat = $globalDateformat[0];

$msg='';

function valdation($title,$discount,$freebids,$fromdate,$enddate) {
    if(strlen($title)<=0) {
        $msg+="incorrect title<br/>";
    }
    if(!is_numeric($discount)) {
        $msg+="incorrect discount<br/>";
    }

    if(!is_numeric($freebids)) {
        $msg+="incorrect freebids<br/>";
    }
    if(!validDate($fromdate)) {
        $msg+="incorrect from date<br/>";
    }
    if(!validDate($enddate)) {
        $msg+="incorrect enddate<br/>";
    }

    if(validDate($fromdate)&&validDate($enddate)) {
        if(dmyToDate($fromdate)<dmyToDate($enddate)) {
            $msg+="fromdate must be less then enddate<br/>";
        }
    }
}

//logic for add edit and delete
if($_REQUEST['addcoupon'] || $_REQUEST['editcoupon'] || $_REQUEST['deletecoupon']) {
    $title=$_REQUEST['title'];
    $discount=$_REQUEST['discount'];
    $freebids=$_REQUEST['freebids'];
    $fromdate=$_REQUEST['fromdate'];
    $enddate=$_REQUEST['enddate'];
    $isuniversal=$_REQUEST['isuniversal'];
    $combinable=$_REQUEST['combinable'];
    $max_per_user=$_REQUEST['max_per_user'];
    $max_overall=$_REQUEST['max_overall'];
    $operand=$_REQUEST['operand'];
    $multiply=$_REQUEST['multiply'];

$globalDateformat = db_fetch_array(db_query("select value from sitesetting where name  = 'dateformat' limit 1"));
$globalDateformat = $globalDateformat[0];



		    $from = explode("/", $fromdate);
                    $end = explode("/", $enddate);
                    
                    
                    if($globalDateformat=='d/m/Y'){
			$from_d = $from[2] . "-" . $from[1] . "-" . $from[0];
			$end_d = $end[2] . "-" . $end[1] . "-" . $end[0];
                    
                    }else{
			$from_d = $from[2] . "-" . $from[0] . "-" . $from[1];
			$end_d = $end[2] . "-" . $end[0] . "-" . $end[1];
                    
                    }


    //add coupon
    if($_REQUEST['addcoupon']) {

        $coupondb=new Coupon(null);
        $query=$coupondb->selectByTitle($title);
        if($query!=FALSE && db_num_rows($query)>0) {
            header("location: message.php?msg=97");
            exit;
        }else {
            db_free_result($query);
            valdation($title,$discount,$freebids,$fromdate,$enddate);
            if(strlen($msg)=='') {
                $coupondb->insert($title, $discount, $freebids, $isuniversal, $from_d, $end_d, $combinable, $max_per_user, $max_overall, $operand, $multiply);
                header("location: message.php?msg=98");
                exit;
            }
        }
    }else if($_REQUEST['editcoupon']) {
        $id=$_REQUEST['editid'];
        $coupondb=new Coupon(null);
        $query=$coupondb->selectByTitle($title);
        if($query!=FALSE && db_num_rows($query)>1) {
            header("location: message.php?msg=97");
            exit;
        }else {
            $query=$coupondb->selectById($id);
            if($query) {
                $row=db_fetch_object($query);
                db_free_result($query);
                if($row->assigned) {
                    header("location: message.php?msg=100");
                    exit;
                }else {
                    valdation($title,$discount,$freebids,$fromdate,$enddate);
                    if($msg=='') {
                    $from = explode("/", $fromdate);
                    $end = explode("/", $enddate);
                    
                    
                    if($globalDateformat=='d/m/Y'){
			$from_d = $from[2] . "-" . $from[1] . "-" . $from[0];
			$end_d = $end[2] . "-" . $end[1] . "-" . $end[0];
                    
                    }else{
			$from_d = $from[2] . "-" . $from[0] . "-" . $from[1];
			$end_d = $end[2] . "-" . $end[0] . "-" . $end[1];
                    
                    }
                        $coupondb->update($id,$title, $discount, $freebids, $from_d, $end_d, $combinable, $max_per_user, $max_overall, $operand, $multiply);
                        header("location: message.php?msg=98");
                        exit;
                    }
                }
            }else {
                header("location: message.php?msg=99");
                exit;
            }
        }
    }else if($_REQUEST['deletecoupon']) {
        $id=$_REQUEST['delid'];
        $coupondb=new Coupon(null);
        $coupondb->delete($id);
        header("location: message.php?msg=101");
    }
}

if($_GET['coupon_edit']!=''||$_GET['coupon_delete']!='') {
    if($_GET['coupon_edit']!='') {
        $id=$_GET['coupon_edit'];
    }else {
        $id=$_GET['coupon_delete'];
    }
    $coupondb=new Coupon(null);
    $query=$coupondb->selectById($id);
    $totalrow = db_num_rows($query);
    $coupon = db_fetch_object($query);

    $title=$coupon->title;
    $discount=$coupon->discount;
    $freebids=$coupon->freebids;
    $fromdate=$coupon->startdate;
    $enddate=$coupon->enddate;
    $isuniversal=$coupon->isuniversal;
    $operand=$coupon->operand;
    $combinable=$coupon->combinable;
    $max_per_user=$coupon->max_per_user;
    $max_overall=$coupon->max_overall;
    $multiply=$coupon->multiply;
    
    
    db_free_result($query);
}

?>

 <script type="text/javascript">
            $(function() {
                $.datepicker.setDefaults({dateFormat:'<?php if($globalDateformat=='d/m/Y'){
                 echo 'dd/mm/yy'; }else{ echo 'mm/dd/yy'; } ?>'});
                $(".fromdate").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                $(".enddate").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});

                $("#form1").submit(function(){
                    if($("#title").val().length<=0){
                        alert("Title can't be empty!");
                        $('#title').focus();
                        return false;
                    }

                    var discount=$('#discount').val();
                    var freebids=$("#freebids").val();

                    if(isNaN(discount)){
                        alert("discount must be a numerical");
                        $('#discount').focus();
                        return false;
                    }

                    if(isNaN(freebids)){
                        alert('freebids must be a numerical');
                        $('#freebids').focus();
                        return false;
                    }

                    var fromdate=$('#fromdate').val();
                    var enddate=$('#enddate').val();

                    //if(!isDDMMYY(fromdate)){
//                        alert('The Format of From Coupon Date Is Incorrect.');
//                        return false;
//                    }
//
//                    if(!isDDMMYY(enddate)){
//                        alert('The Format of End Coupon Date Is Incorrect .')
//                        return false;
//                    }

                    if(toDate(fromdate)>toDate(enddate)){
                        alert('the end date must come after the start date');
                        return false;
                    }
                    return true;
                });
            });
        </script>

        
                                                    <?php
                                                    if(!empty($_GET['coupon_delete']) | !empty($_GET['coupon_edit'])){
                                                    
                                                    echo "<td colspan=\"7\" width=\"100%\">";
                                                    
                                                    }
                                                    ?>  

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    
                                                    <form id="form1" action="addcoupon.php" method="post" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                    <fieldset> 

                                                      <table>
                                                      <tbody>
                                                                        <tr>
                                                                            <th style="width:190px;">Title</th>
                                                                            <th style="text-align:center;">Discount</th>
                                                                            <th style="text-align:center;">Free bids</th>
                                                                           
                                                                            <th style="text-align:center;">Is Universal</th>
                                                                            <th style="text-align:center;">Combinable</th>
                                                                            <th style="text-align:center;">Max Per User</th>
                                                                            <th style="text-align:center;">Max Overall</th>
                                                                            <th style="text-align:center;">Multiply Bids</th>
                                                                            <th style="text-align:center;">Useful life</th>
                                                                            <th >Action</th>
                                                                        </tr>
                                                                        
							<tr>
							    <td>
                                                        
								<!--[if !IE]>start forms<![endif]-->
								

								    <!--[if !IE]>start row<![endif]-->
								    
								  
									
									   
										<input class="text" id="title" type="text" name="title" value="<?=$title!=""?stripslashes($title):""; ?>" />
									  
									    <span class="system required">*</span>
									
								    
							      </td>
							     
							      <td>
							        <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                
                                                                   
                                                                   
                                                                       
                                                                            <input class="text" type="text" id="discount" size="3" name="discount" value="<?=$discount!=""?$discount:"100"; ?>" />
                                                                       
                                                                        <select name="operand" id="operand">
									    <option value="$" 
									    <?php if($operand == '$') { ?>selected <?php } ?>>$</option>
									    <option value="%" <?php if($operand != '$') { ?>selected <?php } ?>>%</option>
                                                                        </select>
                                                                  
                                                                <!--[if !IE]>end row<![endif]-->
							      </td>
							     
							      <td>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                
                                                                    
                                                                   
                                                                       
                                                                            <input class="text" id="freebids" type="text" size="3" name="freebids" value="<?=$freebids!=""?$freebids:"0"; ?>" />
                                                                     
                                                               
							      </td>
							      
							      
							  
							     							     
							      <td  align="center">
                                                                <?php //if(!$_REQUEST["coupon_edit"]) {?>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                
                                                                   
                                                                   
                                                                                <input type="checkbox" id="isuniversal" class="checkbox" <?php echo $isuniversal?'checked':''; ?> name="isuniversal" />
                                                                       
                                                                
                                                               
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <?php //}?>
							     </td>
							      <td  align="center">
                                                               
                                                                <!--[if !IE]>start row<![endif]-->
                                                                
                                                                   
                                                                   
                                                                                <input type="checkbox" id="combinable" class="checkbox" <?php echo $combinable?'checked':''; ?> name="combinable" value="true" />
                                                                       
                                                                
                                                               
                                                                <!--[if !IE]>end row<![endif]-->
                                                              
							     </td>
							     <td  align="center">
                                                              
                                                                <!--[if !IE]>start row<![endif]-->
                                                                
                                                                   
                                                                   
                                                                                <input type="numerical" id="max_per_user" class="text" name="max_per_user" value="<?php echo $max_per_user?$max_per_user:'1'; ?>" size="3" />
                                                                       
                                                                
                                                               
                                                                <!--[if !IE]>end row<![endif]-->
                                                               
							     </td>
						             <td  align="center">
                                                                <input type="numerical" id="max_overall" class="text" name="max_overall" value="<?php echo $max_overall?$max_overall:'Unlimited'; ?>" size="3" />
                                                                       
							     </td>
							      <td  align="center">
                                                                <select  id="multiply" name="multiply">
								   
								    <?php
								    $m = 1;
								    while($m >= 10){
								    ?>
								    <option value="<?php echo $max_overall?$max_overall:'Unlimited'; ?>" <?php if($multiply == $m){ echo 'selected'; }?>></option>
								    <?php $m++; } ?>
                                                                </select>
                                                                       
							     </td>
							      <td>                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                
                                                                    <?php
                                                                    
                                                                    
								//y m d	
								if(!empty($enddate)){
								$end_d = explode("-", $enddate);
								    $from_d = explode("-", $fromdate);
                                                                    if($globalDateformat == 'd/m/Y'){
                                                                    
                                                                     $end_d = $end_d[2] . "/" . $end_d[1] . "/" . $end_d[0];
                                                                     $from_d = $from_d[2] . "/" . $from_d[1] . "/" . $from_d[0];
									
								      }else{
								      
								      $end_d = $end_d[1] . "/" . $end_d[2] . "/" . $end_d[0];
								      $from_d = $from_d[1] . "/" . $from_d[2] . "/" . $from_d[0];
								      
								      
								    }
                                                                    
                                                                    
                                                                    }
                                                                    
                                                                    ?>
                                                                   
                                                                        <span class="input_wrapper_custom">
                                                                            <input type="text" name="fromdate" id="fromdate" class="fromdate" value="<?php echo $from_d;?>" />
                                                                            
                                                                            <input type="text" size="12" name="enddate" id="enddate" class="enddate" value="<?php echo $end_d;?>" />
                                                                            <span class="required">*</span>
                                                                        </span>
                                                                   
                                                                <!--[if !IE]>end row<![endif]-->
							      </td>

							     
							      <td>
					  
                                                                <!--[if !IE]>start row<![endif]-->
                                                                
                                                             
                                                                        <ul style="display:inline;list-style-type:none;">
                                                                            <li>
                                                                                <?
                                                                                if($_REQUEST["coupon_edit"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Edit Coupon</span></span><input name="editcoupon" type="submit"/></span>
                                                                                <input type="hidden" name="editid" value="<?=$id?>" />
                                                                                    <?
                                                                                }
                                                                                elseif($_REQUEST["coupon_delete"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete Coupon</span></span><input name="deletecoupon" type="submit"/></span>
                                                                                <input type="hidden" name="delid" value="<?=$id?>" />
                                                                                    <?
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Add Coupon</span></span><input name="addcoupon" type="submit"/></span>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </li>

                                                                        </ul>

                                                                  
                                                          
                                                                <!--[if !IE]>end row<![endif]-->
                                                          
							<!--[if !IE]>end forms<![endif]-->
							</td>
							     
						</tr>
						</tbody>
						</table>
                                                       
                                                        <!--[if !IE]>end fieldset<![endif]-->
                                                    </form>
                                        </fieldset>
                                                    <?php
                                                      if(!empty($_GET['coupon_delete']) | !empty($_GET['coupon_edit'])){
                                                    
                                                    echo "</td>";
                                                    
                                                    }
                                                    ?>