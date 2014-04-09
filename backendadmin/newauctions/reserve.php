							      <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Reserve Price:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper">
                                                                                <input disabled name="reserve" type="text" class="text" id="reserve" value="<?= $reserve ?>" size="12" maxlength="20"/>
                                                                            </span>
                                                                            <span class="currency"><?= $Currency; ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->
                                                                    
                                                                    
                                                                    
                                                                     <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Enable Reserve:</label>
                                                                        <div class="inputs">
                                                                         
                                                                                <input name="use_reserve" type="checkbox" class="text" id="use_reserve" value="1" />
                                                                           
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->
                                                                    
                                                                    <script>
                                                                    $('#use_reserve').change(function(){
                                                                    if($(this).prop('checked') == true){
									$('#reserve').prop('disabled', false);
									}else{
									
									$('#reserve').prop('disabled', true);
								    }
                                                                    
                                                                    });
                                                                    </script>