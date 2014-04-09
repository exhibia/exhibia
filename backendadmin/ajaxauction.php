<?php

session_start();
$active="Auctions";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");

$i = $_REQUEST['id'] + 1;
$id = $i;
 ?>
 <form name="f<?=$i?>" action="changeauctiontime.php" enctype="multipart/form-data" method="post">
									 
   <script>
   function change_clock_live(id){
   src = $('#minaucplustime_' + id).val();
      $('#live_clock_' + id).attr('src', '<?php echo $UploadImagePath.'aucflag/clock.php?time=';?>' + src);
   
   }
   </script>
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                 <table cellpadding="0" cellspacing="0" width="100%">
                                                                    
                                                                            
                                                                       
                                                                            <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                                <td style="text-align:center;width:20px;">
										  <?php echo $i; ?>
										  </td>

                                                                                <td style="width:258px;">
                                                                                            
                                                                                    <input id="auctitle_<?php echo $id;?>" type="text" value="<?=$aname?>" name="auctitle" />
                                                                                              
                                                                                </td>
                                                                                <td style="text-align:center;width:105px;">
                                                                                            <?=$Currency;?>&nbsp;<input type="text" value="<?=$price?>" name="aucplusprice" size="5" />
                                                                                </td>
                                                                                <td style="text-align:center;width:183px;"><input type="text" value="<?=$time?>" id="minaucplustime_<?php echo $id;?>" name="minaucplustime" size="5" onkeyup="change_clock_live(<?php echo $id;?>);" /></td>
                                                                                <td style="text-align:center;width:172px;"><input type="text" value="<?=$time1?>" name="maxaucplustime" size="5" /></td>
                                                                                <td style="text-align:right;width:95px;">
                                                                                       
										      <img src="<?php echo $UploadImagePath.'aucflag/clock.php?time='; ?>"
style="vertical-align:middle;margin-right:10px" id="live_clock<?php echo $id;?>" />
                                                                                     
                                                                                     
                                                                                </td>

                                                                                <td style="text-align:center;">
                                                                                    <input type="hidden" name="editid" value="<?=$i;?>" />
                                                                                    <span class="button send_form_btn"><span><span>Edit</span></span><input name="edit" type="submit"  /></span>
                                                                                </td>

                                                                            </tr>
									

                                                                    </tbody>
                                                                </table>


                                                </div>
                                            </div>
                               
                                          </form>