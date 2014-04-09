<?php
db_query("CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) NOT NULL DEFAULT '0',

  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;");
@db_query("alter table registration add column vendors text");

$vendor_qry = db_query("select * from vendors");



?>

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Vendor(optional):</label>
                                                                    <div class="inputs">
                                                                        
                                                                            <select name="vendors" id="vendors">
                                                                            <option value=""></option>
                                                                            <?php 
                                                                            while($row_v = db_fetch_array($vendor_qry)){
                                                                            ?>
                                                                            <option value="<?php echo $row_v['company_name'];?>" <?php if($row_v['company_name'] == $row->vendors){ echo 'selected'; } ?>><?php echo $row_v['company_name'];?></option>
                                                                            
                                                                            <?php } ?>
                                                                            </select>
                                                                   
                                                                    
                                                                    </div>
                                                                </div>
                                                                <br />
                                                                <!--[if !IE]>end row<![endif]-->
                                                                
                                                                <div class="row">
                                                                 <div class="inputs">
								<label>OR</label>
                                                          </div>
								</div>
                                                          <br />
                                                           <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Add Vendor</label>
                                                                    <div class="inputs">
                                                                        
                                                                          <input type="text" name="add_vendor" id="add_vendor" value="" />
                                                                   
                                                                      
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->