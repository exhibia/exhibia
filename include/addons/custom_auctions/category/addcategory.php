                                                              <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Featured Status:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="featuredstatus" id="featuredstatutus">
                                                                                <option value="1" <?= ($row['featured'] == 1 ? " selected" : ""); ?>>Enable</option>
                                                                                <option value="0" <?= ($row['featured'] == 0 ? " selected" : ""); ?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->  
