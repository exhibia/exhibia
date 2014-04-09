<?php
session_start();
$active="Database";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("functions.php");

$msg = "";
if(!empty($_POST['do_me'])){
foreach($addons as $key => $value){ 
	
	    if(file_exists("../include/addons/$value/category/validation.php")){
	      include_once("../include/addons/$value/category/validation.php");
	      
	      }
	      
	   }



}
include("imgsize.php");
if ( isset($_POST["addcategory"]) ) {	// Add new category
    $category = chkSQL($_POST["categoryname"], 255);
    $desc = chkSQL($_POST["description"]);
    $status = chkInput($_POST["status"], 'i');

    // CHECK DUBPLICATE
    $result = db_query("SELECT 1 FROM categories WHERE name='$category'");
    $row = db_num_rows($result) > 0 ? (db_result($result, 0) == 1 ? TRUE : FALSE) : FALSE;
    db_free_result($result);

    if ( $row ) {
        $msg = "Category '$category' already exists!";
    } else {
        db_query("INSERT INTO categories (language_id, name, products_count, description, status) VALUES ('1','$category','0','$desc','$status')") or die ("Insert error ".db_error());
        $id = db_insert_id();
        foreach($addons as $key => $value){ 
	
	    if(file_exists("../include/addons/$value/category/addcategory_now.php")){
	      include_once("../include/addons/$value/category/addcategory_now.php");
	      
	      }
	      
	   }
	   
	
  

        if (!empty($_FILES["image1"]["name"])) {





            
            if (isset($_FILES["image1"]) && preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $_FILES["image1"]["name"]) && preg_match('/\.(php|asp|jsp)$/i', $_FILES["image1"]["name"]) == false) {
                if ($_FILES["image1"]){
	      $target_path = "../uploads/test/" . basename( $_FILES['image1']['name']);
	      if(move_uploaded_file($_FILES['image1']['tmp_name'], $target_path)) {
		// echo "The file ".  basename( $_FILES['image' .$i]['name'])." has been uploaded";
	      } else{
		  echo "There was an error uploading the file, please try again!";

	      }
                   
		    $logo_temp = $target_path;

                    $time = time();
                    $logo = $time . "_" . str_replace(" ", "_", $_FILES["image1"]["name"]);
		    $name = basename( $_FILES['image1']['name']);



                    categoryimage($logo, $pid, $logo_temp);

                    db_query("update categories set picture='" . $logo . "' where categoryID=$id") or die(db_error());
                }
            }
        }
   
   
        header("location: message.php?msg=5");
        exit;
    }
} elseif ( isset($_POST["editcategory"]) ) {		// Update exists category
    $category = chkSQL($_POST["categoryname"], 255);
    $desc = chkSQL($_POST["description"]);
    $status = chkInput($_POST["status"], 'i');

    if ( isset($_POST["edit"]) ) {
        // CHECK DUBPLICATE
        $edit = chkInput($_POST["edit"], 'i');
        $result = db_query("SELECT 1 FROM categories WHERE name='$category' and categoryID<>'$edit'");
        $row = db_num_rows($result) > 0 ? (db_result($result, 0) == 1 ? TRUE : FALSE) : FALSE;
        db_free_result($result);

        if ( $row ) {
            $msg = "Category '$category' Already Exists !";
        } elseif ( $edit >= 0 ) {
            $category = htmlspecialchars(stripslashes($category), ENT_QUOTES);
            db_query("UPDATE categories SET name='$category', description='$desc', status='$status' WHERE categoryID=$edit") or die (db_error());
            $id = $edit;
          foreach($addons as $key => $value){ 
	
	    if(file_exists("../include/addons/$value/category/editcategory_now.php")){
	   
	      include_once("../include/addons/$value/category/editcategory_now.php");
	  
	      }
	      
	   }
	   
	     if (!empty($_FILES["image1"]["name"])) {





            
            if (isset($_FILES["image1"]) && preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $_FILES["image1"]["name"]) && preg_match('/\.(php|asp|jsp)$/i', $_FILES["image1"]["name"]) == false) {
                if ($_FILES["image1"]){
	      $target_path = "../uploads/test/" . basename( $_FILES['image1']['name']);
	      if(move_uploaded_file($_FILES['image1']['tmp_name'], $target_path)) {
		// echo "The file ".  basename( $_FILES['image' .$i]['name'])." has been uploaded";
	      } else{
		  echo "There was an error uploading the file, please try again!";

	      }
                   
		    $logo_temp = $target_path;

                    $time = time();
                    $logo = $time . "_" . str_replace(" ", "_", $_FILES["image1"]["name"]);
		    $name = basename( $_FILES['image1']['name']);



                    categoryimage($logo, $pid, $logo_temp);

                    db_query("update categories set picture='" . $logo . "' where categoryID=$id") or die(db_error());
                }
            }
        }
        
        
            header("location: message.php?msg=6");
            exit;
        }
    }
} else {

    if ( isset($_GET['delete']) ) {		// Delete exists category
    
 
        $delete = chkInput($_GET["delete"], 'i');
        $result = db_query("SELECT count(*) FROM categories WHERE categoryID='$delete' and categoryID<>1");
        $row = db_result($result, 0);
        db_free_result($result);

        if ( $row > 0 ) {
            $result = db_query("select count(*) from products where categoryID=$delete");
            $num_products = db_result($result, 0);
            db_free_result($result);

            if ( $num_products > 0 ) {

                header("location: message.php?msg=11");
            } else {
            
        
                db_query("delete from categories where categoryID=$delete") or die(db_error());
                header("location: message.php?msg=12");
            }
            exit;
        }else{
            $msg="you can't delete this category";
        }
    }

    // EXIST FETCH THE VALUE FOR GET EDIT TIME FROM MANAGE CATEGORY
    if ( isset($_GET["category_edit"]) || isset($_GET["category_delete"]) ) {
        $cid = FALSE;
        if ( isset($_GET["category_edit"]) ) $cid = chkInput($_GET["category_edit"], 'i');
        if ( isset($_GET["category_delete"]) ) $cid = chkInput($_GET["category_delete"], 'i');

        $row = FALSE;
        if ( $cid >= 0 ) {
            $result = db_query("SELECT * FROM categories WHERE categoryID=$cid");
           $row = db_fetch_array($result);
   
                $category=stripslashes($row['name']);
                $desc=stripslashes($row['description']);
                $logo=$row['picture'];
                $status=$row['status'];
		$picture=$row['picture'];
            db_free_result($result);
        }

        if ( $cid === 0 || !$row ) {
            echo "<center><font color=red>ERROR CAN NOT FIND REQUIRED PAGE</font>\n<br><br>\n";
            exit;
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?
            if ( isset($_GET["category_edit"]) ) {
                echo "Edit Categories";
            } elseif ( isset($_GET["category_delete"]) ) {
                echo "Confirm Delete Categories";
            } else {
                echo "Add Categories";
            }
            ?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
                <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript">
            function delconfirm(loc) {
                if ( confirm("Are you sure do you want to delete this?") ) {
                    window.location.href=loc;
                }

                return false;
            }

            function checkform(f1) {
                if ( f1.categoryname.value == "" ) {
                    alert("Please enter category name.");
                    f1.categoryname.focus();

                    return false;
                }
                if ( f1.status.value == "" ) {
                    alert("Please select category status.");
                    f1.status.focus();

                    return false;
                }
            }
        </script>
    </head>

    <body>
        <!--[if !IE]>start wrapper<![endif]-->
        <div id="wrapper">
            <!--[if !IE]>start head<![endif]-->
            <div id="head">
                <?php include('include/header.php'); ?>
            </div>
            <!--[if !IE]>end head<![endif]-->

            <!--[if !IE]>start content<![endif]-->
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">
                    <div class="inner">
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>
                                    <?
                                    if ( isset($_GET["category_edit"]) ) {
                                        echo "Edit Categories";
                                    } elseif ( isset($_GET["category_delete"]) ) {
                                        echo "Confirm Delete Categories";
                                    } else {
                                        echo "Add Categories";
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
	
	    if(file_exists("../include/addons/$value/category/addcategory.php")){
	      include_once("../include/addons/$value/category/addcategory.php");
	      
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
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Attach file:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <input name="image1" type="file" class="solidinput"  value="<?php echo $image; ?>" size="35"/>
                                                                            
                                                                        </span>

                                                                        <input type="hidden" name="editimage" value="<?= $_GET['product_edit'] ?>"/>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <div class="row">
                                                                    <label>Image:</label>
                                                                    <div class="buttons" style="padding:0px 0px 20px 0px;">
                                                                        <ul style="text-align:left;">

<?php if (isset($picture) && file_exists('../uploads/products/thumbs_big/thumbbig_' . $picture)) {
?>
                                                                                    <li>
                                                                                        <img alt="" src="../uploads/products/thumbs_big/thumbbig_<?php echo $picture; ?>"/><br/>
                                                                                        </li>
<?php } ?>
                                                                        </ul>
                                                                        </div>
                                                                    </div>

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <?php
                                                                                if ( isset($_GET['category_delete']) && $cid > 0 ) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete Category</span></span><input name="deletecategory" type="button" onClick="delconfirm('addcategory.php?delete=<?=$cid;?>')" /></span>

                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span><?=((isset($_GET["category_edit"]) || $cid > 0) ? "Edit Category" : "Add Category");?></span></span><input type="submit" name="<?=((isset($_GET["category_edit"]) || $cid > 0) ? "editcategory" : "addcategory");?>" /></span>

                                                                                    <?php
                                                                                }
                                                                                ?>

                                                                                <?
                                                                                if ( isset($_GET['category_edit']) ) {
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
                        <?php include 'include/leftside.php' ?>
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

    </body>
</html>