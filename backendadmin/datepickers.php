                                                               <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Please Select Date:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <input type="hidden" name="paymentstatus" value="0"/>
                                                                            <input type="text" name="datefrom" id="datefrom" size="12" value="<?php if(!empty($_REQUEST['datefrom'])){ echo $_REQUEST['datefrom']; }else{ echo date($globalDateformat); } ?>"/>
                                                                            <strong>&nbsp;To&nbsp;</strong>
                                                                            <input type="text" name="dateto" size="12" id="dateto" value="<?php if(!empty($_REQUEST['dateto'])){ echo $_REQUEST['dateto']; }else{ echo date($globalDateformat); } ?>"/>
                                                                        </span>
									
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                
                                                                
                                                                        <script type="text/javascript">
											$(function() {
									    <?php 
										      
											    
											  
											  switch($globalDateformat){

												  case 'm/d/Y':
											      
												  $jsdateFormat = 'mm/dd/yy';
												  break;
												  case 'd/m/Y':
											    
												  $jsdateFormat = 'dd/mm/yy';
												  break;
												  
											    }

											?>
										    
											    $("#datefrom").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true, "dateFormat": '<?php echo $jsdateFormat;?>'});
											    $("#dateto").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true, "dateFormat": '<?php echo $jsdateFormat;?>'});
											      });
										    </script>