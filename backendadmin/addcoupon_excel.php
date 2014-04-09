<?php
session_start();
$active="Database";
include_once '../../../backendadmin/security.php';
include_once "../../../backendadmin/admin.config.inc.php";
include_once '../../../data/coupon.php';
include("../../../functions.php");



require_once 'Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');
$data->read('exceltestsheet.xls');
 print_r($data->sheets[0]);

 /*
for ($x = 2; $x < = count($data->sheets[0]["cells"]); $x++) {
    $name = $data->sheets[0]["cells"][$x][1];
    $extension = $data->sheets[0]["cells"][$x][2];
    $email = $data->sheets[0]["cells"][$x][3];
    $sql = "INSERT INTO mytable (name,extension,email) 
        VALUES ('$name',$extension,'$email')";
    echo $sql."\n";
    db_query($sql);
}
*/
?>

 <script type="text/javascript">
            $(function() {
                $.datepicker.setDefaults({dateFormat:'<?php echo $globalDateformat=='d/m/Y'?'dd/mm/yy':'mm/dd/yy'; ?>'});
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
                                                      
							<tr>
							    <td  style="width:290px;">
                                                        
								<!--[if !IE]>start forms<![endif]-->
								

								    <!--[if !IE]>start row<![endif]-->
								    
								  
									
									   
										<input class="text" id="title" type="text" name="title" value="<?=$title!=""?stripslashes($title):""; ?>" />
									  
									    <span class="system required">*</span>
									
								    
							      </td>
							     
							      <td style="width:80px;">
							        <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                
                                                                   
                                                                   
                                                                       
                                                                            <input class="text" type="text" id="discount" size="3" name="discount" value="<?=$discount!=""?$discount:"100"; ?>" />
                                                                       
                                                                        <span class="currency">% / $</span>
                                                                  
                                                                <!--[if !IE]>end row<![endif]-->
							      </td>
							     
							      <td style="width:70px;">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                
                                                                    
                                                                   
                                                                       
                                                                            <input class="text" id="freebids" type="text" size="5" name="freebids" value="<?=$freebids!=""?$freebids:"0"; ?>" />
                                                                     
                                                               
							      </td>
							      
							      
							     <td style="width:75px;">
							     </td>
							     							     
							      <td style="width:95px;" align="center">
                                                                <?php if(!$_REQUEST["coupon_edit"]) {?>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                
                                                                   
                                                                   
                                                                                <input type="checkbox" id="isuniversal" class="checkbox" <?php echo $isuniversal?'checked':''; ?> name="isuniversal" />
                                                                       
                                                                
                                                               
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <?php }?>
							     </td>
							      <td style="width:85px;">                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                
                                                                    
                                                                   
                                                                        <span class="input_wrapper_custom">
                                                                            <input type="text" name="fromdate" id="fromdate" class="fromdate" value="<?=$fromdate!=""?date("d/m/Y",strtotime($fromdate)):"";?>" />
                                                                            
                                                                            <input type="text" size="12" name="enddate" id="enddate" class="enddate" value="<?=$enddate!=""?date("d/m/Y",strtotime($enddate)):"";?>" />
                                                                            <span class="required">*</span>
                                                                        </span>
                                                                   
                                                                <!--[if !IE]>end row<![endif]-->
							      </td>

							     
							      <td style="width:170px;">
					  
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
						</table>
                                                       
                                                        <!--[if !IE]>end fieldset<![endif]-->
                                                    </form>
                                        </fieldset>
                                                    <?php
                                                      if(!empty($_GET['coupon_delete']) | !empty($_GET['coupon_edit'])){
                                                    
                                                    echo "</td>";
                                                    
                                                    }
                                                    ?>