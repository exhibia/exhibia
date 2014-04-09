<?php
ini_set('display_errors', 1);
$active = 'Add Game'; 
 include_once $BASE_DIR . '/include/addons/games/admin/games.txt.php';
 include($BASE_DIR . "/include/addons/games/admin/imgsize.php");
 
$msg = "";

function update_games_Count_Value_For_Categories_Delete($catid) {
    $qrysel = "select games_categoriesfrom categories where gameID='$catid'";
    $ressel = db_query($qrysel);
    $totalsel = db_affected_rows();
    if ($totalsel > 0) {
        $rowsel = db_fetch_object($ressel);
        $totproduct = $rowsel->games_count;
        $totgames = $totgames = $totproduct - 1;
        $qryupd = "update categories set games_count=" . $totgames . " where gameID='$catid'";
        db_query($qryupd) or die(db_error());
    }
}

function update_games_Count_Value_For_Categories($catid) {
    $qrysel = "select games_categories from categories where gameID='$catid'";
    $ressel = db_query($qrysel);
    $totalsel = db_affected_rows();
    if ($totalsel > 0) {
        $rowsel = db_fetch_object($ressel);
        $totproduct = $rowsel->games_count;
        $totgames = $totproduct + 1;
        $qryupd = "update categories set games_count=" . $totgames . " where gameID='$catid'";
        db_query($qryupd) or die(db_error());
    }
}




if(!empty($_POST['do_me'])){
foreach($addons as $key => $value){ 
	
	    if(file_exists("../include/addons/$value/games/addgame/validation.php")){
	      include_once("../include/addons/$value/games/addgame/validation.php");
	      
	      }
	      
	   }



}
if(!empty($_REQUEST['imageid']) & !empty($_REQUEST['game_edit'])){
      db_query("update games set picture". $_REQUEST['imageid'] . " = '' where gameID = $_REQUEST[game_edit]");
      deleteImage('picture' . $_REQUEST['imageid']);



}
if ( isset($_POST["addGame"]) ) {	// Add new Game
    $name = chkSQL($_POST["name"], 255);
    $desc = chkSQL($_POST["description"]);
    $status = chkInput($_POST["status"], 'i');
    $min_players = $_POST['min_players'];
    $max_players = $_POST['max_players'];
    $url = $_POST['game_url'];
    $categoryID = $_POST['categoryID'];    
    // CHECK DUBPLICATE
    $result = db_query("SELECT 1 FROM games WHERE name='$name'");
    $row = db_num_rows($result) > 0 ? (db_result($result, 0) == 1 ? TRUE : FALSE) : FALSE;
    db_free_result($result);

    if ( $row ) {
        $msg = "Game '$name' already exists!";
    } else {
	db_query("insert into sitesetting values(null, 'games', '" . addslashes($name) . "', '', '', '');");

        db_query("INSERT INTO games (language_id, name, description, status, min_players, max_players, url, pointer) VALUES ('1','$name','$desc','$status', '$min_players', '$max_players', '$url', '" . strtolower(str_replace(" ", "", $name)) . "')") or die ("Insert error ".db_error());
        $cat_id = db_insert_id();
        $_REQUEST["game_edit"] = $cat_id;
        
        
        foreach($addons as $key => $value){ 
	
	    if(file_exists($BASE_DIR . "/include/addons/$value/games/Game/addgame_now.php")){
	      include_once($BASE_DIR . "/include/addons/$value/games/Game/addgame_now.php");
	      
	      }
	      
	   }
	   update_games_Count_Value_For_Categories($cat_id);
        // PRODUCT IMAGE UPLOAD FILE //
        
	  $pointer = 'Game';
	  $table = 'games';
	  include($BASE_DIR . "/include/addons/games/admin/uploader_games.php");
	  if(db_num_rows(db_query("select * from siteseting where name = 'games' and value = '$_REQUEST[name]'")) == 0){
	      db_query("insert into siteseting (null, 'games', '$_REQUEST[name]', '', '', '');");
	  
	  }
	 ?>
          <script>
          
          window.location.href = '<?php echo $SITE_URL;?>backendadmin/get_addon.php?addon=games&page=admin/addgame.php&game_edit=<?php echo $cat_id;?>';
          </script>
          <?php
       // header("location: message.php?msg=5");
       // exit;
    }
} else if ( isset($_POST["editGame"]) ) {		// Update exists Game
    $name = chkSQL($_POST["name"], 255);
    $desc = chkSQL($_POST["description"]);
    $status = chkInput($_POST["status"], 'i');
    $min_players = $_POST['min_players'];
    $max_players = $_POST['max_players'];
    $url = $_POST['game_url'];
    $categoryID = $_POST['categoryID'];
    
    
    if ( isset($_POST["edit"]) ) {
        // CHECK DUBPLICATE
        $edit = chkInput($_POST["edit"], 'i');
        $result = db_query("SELECT 1 FROM games WHERE name='$name' and gameID<>'$edit'");
        $row = db_num_rows($result) > 0 ? (db_result($result, 0) == 1 ? TRUE : FALSE) : FALSE;
        db_free_result($result);

        if ( $row ) {
            $msg = "Game '$name' Already Exists !";
        } elseif ( $edit >= 0 ) {
            $name = htmlspecialchars(stripslashes($name), ENT_QUOTES);
            db_query("UPDATE games SET name='$name', url = '$url', min_players = '$min_players', max_players='$max_players', description='$desc', categoryID=$categoryID, status='$status' WHERE gameID=$edit") or die (db_error());
            $cat_id = $edit;
          foreach($addons as $key => $value){ 
	
	    if(file_exists($BASE_DIR . "/include/addons/$value/games/Game/editgame_now.php")){
	   
	      include_once($BASE_DIR . "/include/addons/$value/games/Game/editgame_now.php");
	  
	      }
	      
	   }
	 update_games_Count_Value_For_Categories($cat_id);
        // PRODUCT IMAGE UPLOAD FILE //
	  $table = 'games';
	   $pointer = 'Game';
	   
	  include($BASE_DIR . "/include/addons/games/admin/uploader_games.php");
          ?>
          <script>
          
          window.location.href = '<?php echo $SITE_URL;?>backendadmin/get_addon.php?addon=games&page=admin/addgame.php&game_edit=<?php echo $cat_id;?>';
          </script>
          <?php
        }
    }
} else {

    if ( isset($_REQUEST['delete']) ) {		// Delete exists Game
    
 if(db_num_rows(db_query("select * from games where gameID = $_REQUEST[delete]")) == 0){
?>
<script>
window.location.href = 'get_addon.php?addon=games&page=admin/managegames.php';
</script>
<?php
 
 exit;
 }
        $delete = chkInput($_REQUEST["delete"], 'i');
        $result = db_query("SELECT count(*) FROM games WHERE gameID='$delete' and gameID<>1");
        $row = db_result($result, 0);
        db_free_result($result);

        if ( $row > 0 ) {
            $result = db_query("select count(*) from games where gameID=$delete");
            $num_games = db_num_rows($result);
            db_free_result($result);

            if ( $num_games > 0 ) {
?>
<script>
window.location.href = 'message.php?msg=11&addon=games';
</script>
<?php

} else {
            
        
                db_query("delete from games where gameID=$delete") or die(db_error());
         
            update_games_Count_Value_For_Categories_Delete($delete);
        // PRODUCT IMAGE UPLOAD FILE //
?>
<script>
window.location.href = 'message.php?msg=12&addon=games';
</script>
<?php
	 
            }
             ?>
          <script>
          
          window.location.href = '<?php echo $SITE_URL;?>backendadmin/get_addon.php?addon=games&page=admin/managegames.php';
          </script>
          <?php
        }else{
            $msg="you can't delete this Game";
        }
    }

    // EXIST FETCH THE VALUE FOR GET EDIT TIME FROM MANAGE Game

}

if ( isset($_REQUEST["game_edit"]) || isset($_REQUEST["game_delete"]) ) {

        $cid = FALSE;
       if(!empty($_REQUEST["game_edit"])){
       $cid = $_REQUEST["game_edit"];
       
       }
       else if(!empty($_REQUEST["game_delete"])){
       
       $cid = $_REQUEST["game_delete"];
       }
 
        $row = FALSE;
        if ( $cid >= 0 ) {
        
            $result = db_query("SELECT * FROM games WHERE gameID=$cid");
            $row = db_fetch_array($result);
		$cat_id = $cid;
                $name=stripslashes($row['name']);
                $desc=stripslashes($row['description']);
                $logo=$row['picture'];
                $status=$row['status'];
                $game_url = $row['url'];
                $categoryID = $row['categoryID'];
                $min_players = $row['min_players'];
                $max_players = $row['max_players'];
                $picture[1] = $row['picture1'];
		$picture[2] = $row['picture2'];
		$picture[3] = $row['picture3'];
		
            db_free_result($result);
        }

        if ( $cid === 0 || !$row ) {
            echo "<center><font color=red>ERROR CAN NOT FIND REQUIRED PAGE</font>\n<br><br>\n";
            exit;
        }
    }
?>
<script>
    function ondeleteimage(pid,imageid){
                
                if(imageid==1){
                    alert('the first image is not allowed to delete');
                    return;
                }
                var loc="get_addon.php?addon=games&page=admin/addgame.php&game_edit="+pid+"&imageid="+imageid;
                
                window.location.href=loc;
            }

            function delconfirm(loc)
            {
                if(confirm("Are you sure do you want to delete this?"))
                {
                    window.location.href=loc;
                }
                return false;
            }

            function gotoGame(cat)
            {
                if(trim(cat)!="")
                {
                    window.location.href="get_addon.php?addon=games&page=admin/addgame.php&parents="+cat;
                }
            }
            function checkform(formid){
		$('input[type="text"], select').each(function(){
		
		    if($(this).hasAttribute('required') & $(this).val() == ''){
		    
			prompt($(this).attr('title') + ' Can not be empty');
		    
		    }
		 });
             }
 </script>

       
                            <div class="title_wrapper">
                                <h2>
                                    <?
                                    if ( isset($_REQUEST["game_edit"]) ) {
                                        echo "Edit Game";
                                    } elseif ( isset($_REQUEST["game_delete"]) ) {
                                        echo "Confirm Delete Game";
                                    } else {
                                        echo "Add Game";
                                    }
                                    ?>
                                </h2>                               
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>
                            <!--[if !IE]>end title wrapper<![endif]-->
                            <!--[if !IE]>start section content<![endif]-->
                            <div class="section_content">
                                <!--[if !IE]>start section content top<![endif]-->
                                <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">                                                   
                                                    <!--[if !IE]>start system messages<![endif]-->

                                                    <ul class="system_messages">
                                                        <?php if ( $msg != "" ) {
                                                            ?>
                                                        <li class="red"><span class="ico"></span><strong class="system_title"><?=$msg;?></strong></li>
                                                            <?php }?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                     <form  action="get_addon.php" method="POST" enctype="multipart/form-data"  class="search_form general_form">
                                                         <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Game Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text"  type="text" name="name" id="name" size="32" value="<?=$name;?>" title="Game Name" required />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Game Status:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="status" id="status" title="Status" required>
                                                                                <option value="1" <?= ($status == 1 ? " selected" : ""); ?>>Enable</option>
                                                                                <option value="0" <?= ($status == 0 ? " selected" : ""); ?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]--> 
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Category:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="categoryID" id="categoryID" title="Category" required>
                                                                            <?php
                                                                            $sql = db_query("select * from game_categories order by name asc");
                                                                            while($row = db_fetch_array($sql)) {
                                                                            ?>
                                                                                <option value="<?php echo $row['categoryID']; ?>" <?php
                                                                                if(!empty($_REQUEST['Game_edit']) & $_REQUEST['Game_edit'] ==  $row['categoryID']){  echo " selected"; }else if($row['categoryID'] == $categoryID){ echo " selected";
                                                                                }
                                                                                ?>><?php echo $row['name']; ?></option>
                                                                            <?php } ?>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->   
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Minimum Number of Players:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="min_players" id="min_players" title= "Minimum Player" required>
                                                                            <?php $d = 1; 
                                                                            while($d <= 4) {
                                                                            ?>
                                                                                <option value="1" <?= ($min_players == $d ? " selected" : ""); ?>><?php echo $d; ?></option>
                                                                           <?php $d++; } ?>
                                                                           </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Maximum Number of Players:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="max_players" id="max_players" title="Maximum Players" required>
                                                                            <?php $d = 1; 
                                                                            while($d <= 4) {
                                                                            ?>
                                                                                <option value="1" <?= ($max_players == $d ? " selected" : ""); ?>><?php echo $d; ?></option>
                                                                           <?php $d++; } ?>
                                                                           </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                               <!--[if !IE]>start row<![endif]-->
                                                              
								      
                                                                <div class="row">
                                                                    <label>Game URL:(optional:used with API, leave empty if game is hosted locally)</label>
                                                                    <div class="inputs">
                                                                        <input type="text" name="game_url" id="game_url" value="<?php echo $game_url;?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
<?php foreach($addons as $key => $value){ 
	
	    if(file_exists("../include/addons/$value/games/Game/addgame.php")){
	      include_once("../include/addons/$value/games/Game/addgame.php");
	      
	      }
	      
	   }
	   
	   ?>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Description:</label>
                                                                    <div class="inputs">
                                                                        <span class="textarea_wrapper">
                                                                            <textarea name="description" rows="" cols="" class="text"><?=$desc;?></textarea>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
								

                                                                <div class="row">
                                                                    <label>Image:</label>
                                                                    <div class="buttons" style="padding:0px 0px 20px 0px;">
                                                                        <ul style="text-align:left;">


                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Attach files:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                          Banner(680X240):  <input name="image1" type="file" class="solidinput"  value="<?php echo $image; ?>" size="35"/>
                                                                          Icon (Main Page 250X250):  <input name="image2" type="file" class="solidinput"  value="<?php echo $image; ?>" size="35"/>
                                                                          Icon Small (Chat Preview Icon 25X25):  <input name="image3" type="file" class="solidinput"  value="<?php echo $image; ?>" size="35"/>
                                                                       
                                                                       </span>
                                                                        <input type="hidden" name="editimage" value="<?= $_GET['product_edit'] ?>"/>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <div class="row">
                                                                    <label>Image:</label>
                                                                    <div class="buttons" style="padding:0px 0px 20px 0px;">
                                                                        <ul style="text-align:left;">

<?php
$i = 1;
while($i <=3 ){
    if (!empty($picture[$i])) {
?>
                                                                                    <li>
                                                                                        <img alt="" src="../uploads/games/<?php 
                                                                                        switch($i){
											    case(1):
												echo 'banner/' . $picture[$i];
											    break;
											    case(2):
												echo 'page/' . $picture[$i];
											    break;
											    case(3):
												echo 'icon/' . $picture[$i];
											    break;
											}
                                                                                         ?>"/><br/>
                                                                                        <span class="button send_form_btn"><span><span>Delete Image</span></span><input type="button" name="" onclick="javascript:ondeleteimage(<?php echo $cat_id; ?>,<?php echo $i;?>);"/></span>
                                                                                    </li>
<?php } 
$i++;
}
?>
                                                                       
                                                                        </div>
                                                                    </div>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <?php
                                                                                if ( isset($_REQUEST['game_delete']) && $cid > 0 ) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete Game</span></span><input name="deleteGame" type="button" onClick="delconfirm('get_addon.php?addon=games&page=admin/addgame.php&delete=<?=$cid;?>')" /></span>

                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span><?=((isset($_REQUEST["game_edit"]) || $cid > 0) ? "Edit Game" : "Add Game");?></span></span><input type="submit" name="<?=((isset($_REQUEST["game_edit"]) || $cid > 0) ? "editGame" : "addGame");?>" /></span>

                                                                                    <?php
                                                                                }
                                                                                ?>

                                                                                <?
                                                                                if ( isset($_REQUEST['game_edit']) ) {
                                                                                    ?>
                                                                                <input type="hidden" name="edit" value="<?=$cid;?>" />
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </li>

                                                                        </ul>
<input type="hidden" name="do_me" value="do_me" />
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                            </div>
                                                            <!--[if !IE]>end forms<![endif]-->

                                                        </fieldset>
                                                        <!--[if !IE]>end fieldset<![endif]-->
                                                        <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />
                                                        <input type="hidden" name="addon" value="<?php echo $_REQUEST['addon']; ?>" />
                                                    </form>
                                                    <!--[if !IE]>end forms<![endif]-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
                        <!--[if !IE]>end section<![endif]-->

                           

                    </div>
                </div>
                <!--[if !IE]>end page<![endif]-->
                <!--[if !IE]>start sidebar<![endif]-->
                <div id="sidebar">
                    <div class="inner">
              
                        <?php require($BASE_DIR . '/backendadmin/include/leftside.php'); ?>
                    </div>
                </div>
                <!--[if !IE]>end sidebar<![endif]-->

            </div>
            <!--[if !IE]>end content<![endif]-->

        </div>
        <!--[if !IE]>end wrapper<![endif]-->

        <!--[if !IE]>start footer<![endif]-->
        <div id="footer">
            <div id="footer_inner">
                <?php include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

            </div>
            <!--[if !IE]>end content<![endif]-->