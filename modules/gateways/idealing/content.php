 <form action="" method="POST" class="idealform">

<?php if ($error == true) { ?>
                                <div>
                                    <div>
    <?php echo ERROR_CODE; ?>:<?php echo $errorCode; ?>
                                    </div>
                                    <div>
    <?php echo ERROR_MESSAGE; ?>:<?php echo $errorMsg; ?>
                                    </div>
                                    <div>
    <?php echo CONSUMER_MESSAGE; ?>:<?php echo $consumerMessage; ?>
                                    </div>
                                </div>
<?php } else { ?>
                                        <?php //if ($type == 1) { ?>
                                   
                                        <table width="100%" cellpading="1" cellspacing="1">
                                            <tr>
                                                <td width="100"><?php echo ITEM_NAME; ?></td>
                                                <td>
                                                    <input type="text" value="<?php echo $itemname; ?>" name="itemname" readonly="true"/>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
        <?php echo SELECT_BANK; ?>
                                                </td>
                                                <td>
                                                    <select name="IssuerID">
        <?php echo $issuerList; ?>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><?php echo AMOUNT; ?></td>
                                                <td>
                                                    <input type="text" value="<?php echo $amount; ?>" name="amount" readonly="true"/>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2">
						 <?php foreach($_POST as $key => $value){ ?>
						 <input type="text" value="<?php echo $value; ?>" name="<?php echo $key;?>"/>
						 <?php } ?>
                                                    <input type="text" value="<?php echo $orderid; ?>" name="orderid"/>
                                                    <input type="hidden" value="<?php echo $itemdescription; ?>" name="itemdescription"/>
                                                    <input type="hidden" value="2" name="step"/>
                                                <input name ="submit" type='Submit' value="<?php echo PAYMENT; ?>"></input>
                                                </td>
                                            </tr>

                                        </table>

    <?php // } ?>
<?php } ?>
              </form>