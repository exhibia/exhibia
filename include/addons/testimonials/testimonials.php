<?php





db_select_db($DATABASENAME, $db);




db_query("CREATE TABLE IF NOT EXISTS `testimonials` (
  
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `picture` text null,
  `date` date not null,
  `text` text not null,
  `status` tinyint(1) not null default'0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;");
@mkdir("../../../uploads/testimonials/");


echo db_error();

$uid = $_SESSION["userid"];

$changeimage = "myaccount";
$PRODUCTSPERPAGE_MYACCOUNT=5;

if (isset($_GET['avatarid'])) {
    $avatarid = chkInput($_GET['avatarid'], 'i');
    $regdb = new Registration(null);
    $regdb->setUserAvatar($uid, $avatarid);
}

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



$qryselauc = "select * from testimonials left join registration as r on testimonials.user_id=r.id left join avatar as a on a.id=r.avatarid where testimonials.status=1";


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



                                                if ($totalauc >= 1) {
                                                
                                                ?>
												
						<div id="testimonials_form">
						    <div id="testimonials_form_inner">
						    <h3><?php echo TESTIMONIALS; ?></h3>
						    
			  
						<ul style="list-style-type:none;">

						  <?php
                                                    $counter = 0;
                                                    while ($obj = db_fetch_array($resselauc)) {
                                                    $counter++;
                                                    
                                                  
                         if($obj['picture'] == ''){
			    $obj['picture'] = $UploadImagePath . "avatars/$obj[avatar]";
                         
                         }else{
                         
			    $obj['picture'] = $UploadImagePath . "testimonials/$obj[picture]";
                         
                         }
                                ?>

                                                
                                                            <li>
                                                          
                                                                
                                                          
                                                                
                                                                    <span <?php if($counter % 2 == 0){ ?> class="left_img thumb" <?php }else{ ?> class="right_img thumb" <?php } ?>>
                                                                     
									<img src="<?php echo $obj['picture'];?>"   />
								
                                                                   &quot;<?php echo stripslashes(replaceText($obj["text"])); ?>&quot;
                                                                    
                                                                    <p>
                                                                        <?php echo $obj['username']; ?>
                                                                    </p>
                                                                    
                                                                       
									
                                                                    </span>
                                                                    
                                                                
                                                              </li>
                                                    
							  

                                <?php } 
                                ?>
                               </ul>
                                  </div>
                                </div>
                           
                                
                                
                                <?php
                                echo db_error();
                                }else{
                                
                                }
                                ?>
                                    
                                     