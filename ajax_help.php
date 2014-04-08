               <?php
		include("config/config.inc.php");
                    $qr2 = "select * from faq where id = '$_REQUEST[id]'";
                    
                    $resqr2 = db_query($qr2);
                    $totalqr = db_num_rows($resqr2);
                    $counterans = 1;
                    while($v=db_fetch_array($resqr2)) {
                  
                      
                            ?>
              
                        <h2 id="help-title"><?=stripslashes($v["que_title"]);?></h2>
                        <p><?=stripslashes($v["que_content"]);?></p>
              
                            <?php
                        }
                       
                    
                    ?>