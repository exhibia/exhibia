<?php
$active = 'Game Categories'; 
 include_once $BASE_DIR . '/include/addons/games/admin/games.txt.php';
 include($BASE_DIR . "/include/addons/games/admin/imgsize.php");
 
$msg = "";

function update_games_Count_Value_For_Categories_Delete($catid) {
    $qrysel = "select games_count from categories where categoryID='$catid'";
    $ressel = db_query($qrysel);
    $totalsel = db_affected_rows();
    if ($totalsel > 0) {
        $rowsel = db_fetch_object($ressel);
        $totproduct = $rowsel->games_count;
        $totgames = $totgames = $totproduct - 1;
        $qryupd = "update categories set games_count=" . $totgames . " where categoryID='$catid'";
        db_query($qryupd) or die(db_error());
    }
}

function update_games_Count_Value_For_Categories($catid) {
    $qrysel = "select games_count from categories where categoryID='$catid'";
    $ressel = db_query($qrysel);
    $totalsel = db_affected_rows();
    if ($totalsel > 0) {
        $rowsel = db_fetch_object($ressel);
        $totproduct = $rowsel->games_count;
        $totgames = $totproduct + 1;
        $qryupd = "update categories set games_count=" . $totgames . " where categoryID='$catid'";
        db_query($qryupd) or die(db_error());
    }
}




if(!empty($_POST['do_me'])){
foreach($addons as $key => $value){ 
	
	    if(file_exists("../include/addons/$value/games/category/validation.php")){
	      include_once("../include/addons/$value/games/category/validation.php");
	      
	      }
	      
	   }



}
if(!empty($_REQUEST['imageid']) & !empty($_REQUEST['category_edit'])){
      db_query("update game_categories set picture". $_REQUEST['imageid'] . " = '' where categoryID = $_REQUEST[category_edit]");
      deleteImage('picture' . $_REQUEST['imageid']);



}
if ( isset($_POST["addcategory"]) ) {	// Add new category
    $category = chkSQL($_POST["categoryname"], 255);
    $desc = chkSQL($_POST["description"]);
    $status = chkInput($_POST["status"], 'i');

    // CHECK DUBPLICATE
    $result = db_query("SELECT 1 FROM game_categories WHERE name='$category'");
    $row = db_num_rows($result) > 0 ? (db_result($result, 0) == 1 ? TRUE : FALSE) : FALSE;
    db_free_result($result);

    if ( $row ) {
        $msg = "Category '$category' already exists!";
    } else {
        db_query("INSERT INTO game_categories (language_id, name, games_count, description, status) VALUES ('1','$category','0','$desc','$status')") or die ("Insert error ".db_error());
        $cat_id = db_insert_id();
        $_REQUEST["category_edit"] = $cat_id;
        
        
        foreach($addons as $key => $value){ 
	
	    if(file_exists($BASE_DIR . "/include/addons/$value/games/category/addcategory_now.php")){
	      include_once($BASE_DIR . "/include/addons/$value/games/category/addcategory_now.php");
	      
	      }
	      
	   }
	   update_games_Count_Value_For_Categories($cat_id);
        // PRODUCT IMAGE UPLOAD FILE //
        
	  $pointer = 'category';
	  $table = 'game_categories';
	  include($BASE_DIR . "/include/addons/games/admin/uploader.php");
	 ?>
          <script>
          
          window.location.href = '<?php echo $SITE_URL;?>backendadmin/get_addon.php?addon=games&page=admin/addcategory.php&category_edit=<?php echo $cat_id;?>';
          </script>
          <?php
       // header("location: message.php?msg=5");
       // exit;
    }
} elseif ( isset($_POST["editcategory"]) ) {		// Update exists category
    $category = chkSQL($_POST["categoryname"], 255);
    $desc = chkSQL($_POST["description"]);
    $status = chkInput($_POST["status"], 'i');

    if ( isset($_POST["edit"]) ) {
        // CHECK DUBPLICATE
        $edit = chkInput($_POST["edit"], 'i');
        $result = db_query("SELECT 1 FROM game_categories WHERE name='$category' and categoryID<>'$edit'");
        $row = db_num_rows($result) > 0 ? (db_result($result, 0) == 1 ? TRUE : FALSE) : FALSE;
        db_free_result($result);

        if ( $row ) {
            $msg = "Category '$category' Already Exists !";
        } elseif ( $edit >= 0 ) {
            $category = htmlspecialchars(stripslashes($category), ENT_QUOTES);
            db_query("UPDATE game_categories SET name='$category', description='$desc', status='$status' WHERE categoryID=$edit") or die (db_error());
            $cat_id = $edit;
          foreach($addons as $key => $value){ 
	
	    if(file_exists($BASE_DIR . "/include/addons/$value/games/category/editcategory_now.php")){
	   
	      include_once($BASE_DIR . "/include/addons/$value/games/category/editcategory_now.php");
	  
	      }
	      
	   }
	 update_games_Count_Value_For_Categories($cat_id);
        // PRODUCT IMAGE UPLOAD FILE //
	  $table = 'game_categories';
	   $pointer = 'category';
	   
	  include($BASE_DIR . "/include/addons/games/admin/uploader.php");
          ?>
          <script>
          
          window.location.href = '<?php echo $SITE_URL;?>backendadmin/get_addon.php?addon=games&page=admin/addcategory.php&category_edit=<?php echo $cat_id;?>';
          </script>
          <?php
        }
    }
} else {

    if ( isset($_REQUEST['delete']) ) {		// Delete exists category
    
 if(db_num_rows(db_query("select * from game_categories where categoryID = $_REQUEST[delete]")) == 0){
?>
<script>
window.location.href = 'get_addon.php?addon=games&page=admin/managecat.php';
</script>
<?php
 
 exit;
 }
        $delete = chkInput($_REQUEST["delete"], 'i');
        $result = db_query("SELECT count(*) FROM game_categories WHERE categoryID='$delete' and categoryID<>1");
        $row = db_result($result, 0);
        db_free_result($result);

        if ( $row > 0 ) {
            $result = db_query("select count(*) from games where categoryID=$delete");
            $num_games = db_num_rows($result);
            db_free_result($result);

            if ( $num_games > 0 ) {
?>
<script>
window.location.href = 'message.php?msg=11&addon=games';
</script>
<?php

} else {
            
        
                db_query("delete from game_categories where categoryID=$delete") or die(db_error());
         
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
          
          window.location.href = '<?php echo $SITE_URL;?>backendadmin/get_addon.php?addon=games&page=admin/managecat.php';
          </script>
          <?php
        }else{
            $msg="you can't delete this category";
        }
    }

    // EXIST FETCH THE VALUE FOR GET EDIT TIME FROM MANAGE CATEGORY
    if ( isset($_REQUEST["category_edit"]) || isset($_REQUEST["category_delete"]) ) {
        $cid = FALSE;
        if ( isset($_REQUEST["category_edit"]) ) $cid = chkInput($_REQUEST["category_edit"], 'i');
        if ( isset($_REQUEST["category_delete"]) ) $cid = chkInput($_REQUEST["category_delete"], 'i');

        $row = FALSE;
        if ( $cid >= 0 ) {
            $result = db_query("SELECT * FROM game_categories WHERE categoryID=$cid");
           $row = db_fetch_array($result);
		$cat_id = $cid;
                $category=stripslashes($row['name']);
                $desc=stripslashes($row['description']);
                $logo=$row['picture'];
                $status=$row['status'];
                $picture[1] = $row['picture1'];
		$picture[2] = $row['picture2'];
		$picture[3] = $row['picture3'];
		//$picture4 = $row['picture4'];
            db_free_result($result);
        }

        if ( $cid === 0 || !$row ) {
            echo "<center><font color=red>ERROR CAN NOT FIND REQUIRED PAGE</font>\n<br><br>\n";
            exit;
        }
    }
}
?>
<script>
    function ondeleteimage(pid,imageid){
                
                if(imageid==1){
                    alert('the first image is not allowed to delete');
                    return;
                }
                var loc="get_addon.php?addon=games&page=admin/addcategory.php&category_edit="+pid+"&imageid="+imageid;
                
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

            function gotocategory(cat)
            {
                if(trim(cat)!="")
                {
                    window.location.href="get_addon.php?addon=games&page=admin/addcategory.php&parents="+cat;
                }
            }
 </script>

       
                            <div class="title_wrapper">
                                <h2>
                                    <?
                                    if ( isset($_REQUEST["category_edit"]) ) {
                                        echo "Edit Game Categories";
                                    } elseif ( isset($_REQUEST["category_delete"]) ) {
                                        echo "Confirm Delete Game Categories";
                                    } else {
                                        echo "Add Game Categories";
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
                                                    <form  action="" method="POST" enctype="multipart/form-data" onSubmit="return checkform(this);" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Category Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text"  type="text" name="categoryname" size="32" value="<?=$category;?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Category Status:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="status">
                                                                                <option value="1" <?= ($status == 1 ? " selected" : ""); ?>>Enable</option>
                                                                                <option value="0" <?= ($status == 0 ? " selected" : ""); ?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->                                                              
<?php foreach($addons as $key => $value){ 
	
	    if(file_exists("../include/addons/$value/games/category/addcategory.php")){
	      include_once("../include/addons/$value/games/category/addcategory.php");
	      
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
                                                                                if ( isset($_REQUEST['category_delete']) && $cid > 0 ) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete Category</span></span><input name="deletecategory" type="button" onClick="delconfirm('get_addon.php?addon=games&page=admin/addcategory.php&delete=<?=$cid;?>')" /></span>

                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span><?=((isset($_REQUEST["category_edit"]) || $cid > 0) ? "Edit Category" : "Add Category");?></span></span><input type="submit" name="<?=((isset($_REQUEST["category_edit"]) || $cid > 0) ? "editcategory" : "addcategory");?>" /></span>

                                                                                    <?php
                                                                                }
                                                                                ?>

                                                                                <?
                                                                                if ( isset($_REQUEST['category_edit']) ) {
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