                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Enable Set And Forget:</label>
                                                                    <div class="inputs">
                                                                    <?php $set_and_forget = get_set_and_forget($categoryID, $productID, $DATABASENAME, $DBSERVER,  $DBUSER, $DBPASSWORD); ?>
                                                                            <input type="checkbox" name="set_and_forget" id="set_and_forget" size="32" maxlength="256" value="1" <?php if($set_and_forget == '1'){ echo 'checked'; } ?>/>
                                                                    
                                                                        
									
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <!--[if !IE]>end row<![endif]--> 
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Enable Reserve For Set And Forget:</label>
                                                                    <div class="inputs">
                                                                    <?php $set_and_forget = get_reserve($categoryID, $productID, $DATABASENAME, $DBSERVER,  $DBUSER, $DBPASSWORD); ?>
                                                                            <input type="checkbox" name="enable_reserve" id="enable_reserve" size="32" maxlength="256" value="1" <?php if($set_and_forget == '1') { echo 'checked'; } ?>/>
                                                                    
                                                                        
									
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <!--[if !IE]>end row<![endif]-->
