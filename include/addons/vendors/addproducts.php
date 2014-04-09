<?php
@db_query("alter table products add column vendor varchar(20)");
?>
							    <div class="row">
                                                                    <label>Golf Course(Required For Golf Course Vouchers):</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="vendor" id="vendor">
                                                                               <option value=""></option>
                                                                                <?
                                                                                $qryshipping = "select * from vendors";
                                                                                
                                                                                
                                                                            if(db_num_rows(db_query("select * from user_levels where id = $_SESSION[user_level] and ( admin_level = 'Golf Biddy Vendor' or admin_level = 'Vendor' )")) >= 1){
                                                                          
                                                                                  
        
											$vendor_info = db_fetch_array(db_query("select vendors from registration where username = '$_SESSION[UsErOfAdMiN]' or id = '$_SESSION[userid]'"));
											
											if($vendor_info[0] != ''){
											  $qrr .= " where vendor = '$vendor_info[0]'";
										      }
										      }
										      
                                                                                $resshipping = db_query($qryshipping);
                                                                                while ($objvendor = db_fetch_object($resshipping)) {
                                                                                ?>
										  <option <?= $objvendor->company_name == $row->vendor ? "selected" : ""; ?> value="<?= $objvendor->company_name; ?>"><?= $objvendor->company_name; ?></option>
                                                                                <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div> 
