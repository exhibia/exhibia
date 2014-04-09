<?php

@db_query("alter table categories add column vendor_reqired varchar(20)");
?>
						  <!--[if !IE]>start row<![endif]-->
  
                                                                <div class="row">
                                                                    <label>Products Require Vendor Id:</label>
                                                                    <div class="inputs">
                                                                   
                                                                            <input class="checkbox"  type="checkbox" name="vendor_required" id="vendor_required" size="32" value="1" <?php if($row['vendor_reqired'] == 1){ ?> checked<?php } ?> />
                                                                    
                                                                       
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]--> 
