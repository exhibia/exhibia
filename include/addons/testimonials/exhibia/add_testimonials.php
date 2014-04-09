<?php
@session_start();
include('../../../config/config.inc.php');

$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);


db_select_db($DATABASENAME, $db);



$uid = $_SESSION["userid"];

$changeimage = "myaccount";


$qrysel = "select * from bidpack order by id";

$rssel = db_query($qrysel);

$totalbpack = db_num_rows($rssel);

if ($totalbpack > 0) {

    $selected = ceil($totalbpack / 2);
}



if (!$_GET['pgno']) {

    $PageNo = 1;
} else {

    $PageNo = $_GET['pgno'];
}



$qryselauc = "select * from testimonials left join registration as r on testimonials.user_id=r.id left join avatar as a on a.id=r.avatarid where user_id = '$uid'";


$resselauc = db_query($qryselauc);

$totalauc = db_num_rows($resselauc);

$total = $totalauc;

$totalpage = ceil($totalauc / $PRODUCTSPERPAGE_MYACCOUNT);



if ($totalpage >= 1) {

    $startrow = $PRODUCTSPERPAGE_MYACCOUNT * ($PageNo - 1);

    $qryselauc.=" LIMIT $startrow,$PRODUCTSPERPAGE_MYACCOUNT";

//echo $sql;

    $resselauc = db_query($qryselauc);

    $totalauc = db_num_rows($resselauc);
}
echo db_error();
?>

<div id="testimonials_form">
    <div id="testimonials_form_inner">
    
	                     <div class="clear"></div>

                            <div id="myqb-auctions">
                                <div id="myqb-auctions-head">
                                    <div id="product_title"><?php echo INFORMATION; ?></div>
                                    <div id="price_title"></div>
                                    <div id="countdown_title"><?php echo DATE_POSTED; ?></div>
                                </div>
    
    
                                <?php
                                                if ($totalauc >= 1) {
                                                    $counter = 1;
                                                    while ($obj = db_fetch_array($resselauc)) {
                                                  
                         if($obj['picture'] == ''){
			    $obj['picture'] = $UploadImagePath . "avatars/$obj[avatar]";
                         
                         }else{
                         
			    $obj['picture'] = $UploadImagePath . "testimonials/$obj[picture]";
                         
                         }
                                ?>

                                                 <div title="<?php echo $obj["id"]; ?>" id="test_<?php echo $obj["id"]; ?>">
                                                            <div class="live-auction" style="background-color: white;">
                                                            
                                                            
                                                                <img src="<?php echo $obj['picture'];?>" class="thumb" />
                                                                
                                                                
                                                                <div class="live-a-content">
                                                                
                                                                    <h2>
                                                                        <?php echo $obj['username']; ?>
                                                                    </h2>
                                                                    <?php echo stripslashes($obj["text"]); ?>
                                                                    
                                                                </div>
                                                                <div class="price-bidder">
                                                                    
                                                                </div>
                                                                <div class="countdown" style="font-size:12px;">
                                                                    <?php echo $obj['date'];?>
                                                                    <div class="buttonoffset">
                        
								      <?php switch($obj['status']){
								      
									    case('0'):
									    $status = 'Awaiting Approval';
									    break;
									    case('1'):
									    $status = 'Approved';
									    break;
									    case('2'):
									    $status = 'Removed';
									    break;
									    
									    }
									    
									    ?>
								      <?php echo $status; ?>

                                                                    </div>
                                                                </div>
                                                                
                                                          </div>
                                                    
         

                                <?php } 
                                
                                echo db_error();
                                }else{
                                ?>
                                <div class="live-auction" style="background-color: white;">
                                                            
                                                            
                                                                
                                                                
                                                                
                                                                <div class="live-a-content">
                                                                
                                <?php
				  echo "<h1>You have not added a testimonial yet</h1>";
                                 ?>
							      </div>
							      
							      
					</div>		      
                                <?php
                                
                                }
                                ?>
				  <div id="live-auctions-end">
                                
                                    <?php if ($totalpage > 0) {
                                    ?>
                                                    <table align="right">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="middle">
                                                                    <div style="margin-top: 15px;" id="pagenumber_display"><?php echo TOTAL . ' ' . $total . ' ' . AUCTIONS ?>, <?php echo $PageNo . ' ' . OF . ' ' . $totalpage . ' ' . PAGES; ?> </div>
                                                                </td>
                                                                <td width="30">&nbsp;</td>
                                                                <td valign="middle">
                                                                    <span id="pagination">
                                                        <?php if ($PageNo > 1) {
                                                        ?>
                                                            <a style="width: 50px;" id="prev" href="myaccount.php?pgno=<?php echo $PageNo - 1; ?>"><?php echo PREVIOUS; ?></a>
                                                        <?php } else {
                                                        ?>
                                                            <a style="width: 50px;" id="prev"><span style="color: rgb(192, 192, 192);"><?php echo PREVIOUS; ?></span></a>
                                                        <?php } ?>

                                                        &nbsp;

                                                        <?php
                                                        $pagestart = $PageNo - 3;
                                                        if ($pagestart < 1) {
                                                            $pagestart = 1;
                                                        }

                                                        $pageend = $pagestart + 7;
                                                        if ($pageend > $totalpage) {
                                                            $pageend = $totalpage;
                                                        }

                                                        for ($page = $pagestart; $page <= $pageend; $page++) {
                                                        ?>
                                                            <a href="myaccount.php?pgno=<?php echo $page; ?>" class="<?php echo $page == $PageNo ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                                                        <?php } ?>


                                                        <?php if ($PageNo < $totalpage) {
                                                        ?>
                                                            <a id="next" href="myaccount.php?pgno=<?php echo $PageNo + 1; ?>"><?php echo NEXT; ?></a>
                                                        <?php } else {
                                                        ?>
                                                            <a id="next"><span style="color: rgb(192, 192, 192);"><?php echo NEXT; ?></span></a>
                                                        <?php } ?>

                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php } 
                                    
                                    
                                    
                                    ?>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    <br />
                                    <br />
                                    <?php
                                    
                                    if(db_num_rows(db_query("select * from testimonials where user_id = '$uid' and date = '" .date("Y-m-d") . "'")) == 0){
                                    ?>
                                    <form name="testimonials_form" id="testimonials_form" action="myaccount.php" enctype="multipart/form-data" method="post">
                                    <table align="center">
				      <tr>
					<td>
                                    
					    <label><?php echo TESTIMONIAL; ?>:</label>
					    <br />
					    <textarea name="text" id="text" class="ckeditor"></textarea>
					</td>
				      </tr>
				      <tr>
					<td>
					    <label><?php echo PHOTO; ?>:</label>
					    <input id="picture" name="picture" type="file"/>
					 </td>
				      </tr>
				      <tr>
					<td>  
					    <input class="loginfirst_orange bid-button-link buttons medium orange" type="submit" value="<?php echo SUBMIT;?>" />
					  </td>
				      </tr>
				      </table>
				  </form>
					<script>
					    $('.ckeditor').ckeditor();
					    
					    
					</script>
					
					<?php
					}else{
					if(!empty($_REQUEST['thankyou'])){
					    echo "<h1>Thank You For Your Post!</h1>";
					
					}else{
					    echo "<h1>You have already Submitted a Testimonial, Only one is allowed each day</h1>";
					    
					    }
					
					}
					?>
    </div>
</div>
			   
  