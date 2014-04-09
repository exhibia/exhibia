<?php
ini_set('display_errors', 1);

$active = "Database";
include("../../../config/config.inc.php");
$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);

db_select_db($DATABASENAME, $db);
include("$BASE_DIR/common/sitesetting.php");

include("$BASE_DIR/backendadmin/functions.php");
include("$BASE_DIR/backendadmin/admin.config.inc.php");


$msg = "";
if(!empty($_REQUEST['do_me'])){
foreach($addons as $key => $value){ 
	
	    if(file_exists("$BASE_DIR/include/addons/$value/category/validation.php")){
	      include_once("$BASE_DIR/include/addons/$value/category/validation.php");
	      
	      }
	      
	   }



}
if ( isset($_REQUEST["addcategory"]) ) {	// Add new category
    $category = chkSQL($_REQUEST["categoryname"], 255);
    $desc = chkSQL($_REQUEST["description"]);
    $status = chkInput($_REQUEST["status"], 'i');

    // CHECK DUBPLICATE
    $result = db_query("SELECT 1 FROM categories WHERE name='$category'");
    $row = db_num_rows($result) > 0 ? (db_result($result, 0) == 1 ? TRUE : FALSE) : FALSE;
    db_free_result($result);

    if ( $row ) {
        $msg = "Category '$category' already exists!";
    } else {
        db_query("INSERT INTO categories (language_id, name, products_count, description, status) VALUES ('1','$category','0','$desc','$status')") or die ("Insert error ".db_error());
        
        echo "Your New Category Was Added<a href=\"javascript: submit_test_ajax_form('backend_form', '$SITE_URL/include/addons/blank_page/index.php?edit_page=true&add_new_page=addproducts', 'container');\">Add Product To $category</a>";
        
        $_REQUEST['editcategory'] = db_insert_id();
        foreach($addons as $key => $value){ 
	
	    if(file_exists("$BASE_DIR/include/addons/$value/category/addcategory_now.php")){
	      include_once("$BASE_DIR/include/addons/$value/category/addcategory_now.php");
	      
	      }
	      
	   }
      
    }
} elseif ( isset($_REQUEST["editcategory"]) ) {		// Update exists category
    $category = chkSQL($_REQUEST["categoryname"], 255);
    $desc = chkSQL($_REQUEST["description"]);
    $status = chkInput($_REQUEST["status"], 'i');

    if ( isset($_REQUEST["edit"]) ) {
        // CHECK DUBPLICATE
        $edit = chkInput($_REQUEST["edit"], 'i');
        $result = db_query("SELECT 1 FROM categories WHERE name='$category' and categoryID<>'$edit'");
        $row = db_num_rows($result) > 0 ? (db_result($result, 0) == 1 ? TRUE : FALSE) : FALSE;
        db_free_result($result);

        if ( $row ) {
            $msg = "Category '$category' Already Exists !";
        } elseif ( $edit >= 0 ) {
            $category = htmlspecialchars(stripslashes($category), ENT_QUOTES);
            db_query("UPDATE categories SET name='$category', description='$desc', status='$status' WHERE categoryID=$edit") or die (db_error());
        echo "Updated Category Was Added<a href=\"javascript: submit_test_ajax_form('backend_form', '$SITE_URL/include/addons/blank_page/index.php?edit_page=true&add_new_page=addproducts', 'container');\">Add Product To $category</a>";
        
        $_REQUEST['editcategory'] = db_insert_id();           
          foreach($addons as $key => $value){ 
	
	    if(file_exists("$BASE_DIR/include/addons/$value/category/editcategory_now.php")){
	   
	      include_once("$BASE_DIR/include/addons/$value/category/editcategory_now.php");
	  
	      }
	      
	   }
           
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
            
            db_free_result($result);
        }

        if ( $cid === 0 || !$row ) {
            echo "<center><font color=red>ERROR CAN NOT FIND REQUIRED PAGE</font>\n<br><br>\n";
            exit;
        }
    }
}
?>
  <?php include("$BASE_DIR/include/addons/blank_page/page_headers.php"); ?>
        <script type="text/javascript">
            function delconfirm(loc) {
                if ( confirm("Are you sure do you want to delete this?") ) {
                    window.location.href=loc;
                }

                return false;
            }

            function checkform(f1) {
                if ( $('#categoryname').val() == "" ) {
                    alert("Please enter category name.");
                    $('#categoryname').focus();

                    return false;
                }else
                if ( $('#status').val() == "" ) {
                    alert("Please select category status.");
                    $('#status').focus();

                    return false;
                }else{
                submit_test_ajax_form('backend_form', '<?php echo $SITE_URL;?>include/addons/blank_page/index.php?edit_page=true&add_new_page=addcategory', 'container');
              
                
                
                }
            }
        </script>

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
                                                    <form  action="javascript: checkform(this);" id="backend_form" method="POST" enctype="multipart/form-data" class="search_form general_form">
                                                        <!--[if !IE]>s"checkform(this);tart fieldset<![endif]-->
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
	
	    if(file_exists("$BASE_DIR/include/addons/$value/category/addcategory.php")){
	      include_once("$BASE_DIR/include/addons/$value/category/addcategory.php");
	      
	      }
	      
	   }
	   
	   ?>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Description:</label>
                                                                    <div class="inputs">
                                                                        <span class="textarea_wrapper">
                                                                            <textarea name="description" id="description" rows="" cols="" class="text"><?=$desc;?></textarea>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

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
                                                                                <input type="hidden" id="<?=((isset($_GET["category_edit"]) || $cid > 0) ? "editcategory" : "addcategory");?>" name="<?=((isset($_GET["category_edit"]) || $cid > 0) ? "editcategory" : "addcategory");?>" />
                                                                                <span class="button send_form_btn"><span><span><?=((isset($_GET["category_edit"]) || $cid > 0) ? "Edit Category" : "Add Category");?></span></span><input type="submit" name="submit" /></span>

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
<script>
CKEDITOR.replace('description');
</script>