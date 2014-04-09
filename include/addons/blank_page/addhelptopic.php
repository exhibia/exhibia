<?
ini_set('display_errors', 1);
session_start();

$active = "Database";
include("../../../config/config.inc.php");
$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
if (!$db) {
    die('Could not connect: ' . db_error());
}

db_select_db($DATABASENAME, $db);
include("$BASE_DIR/common/sitesetting.php");

include("$BASE_DIR/backendadmin/functions.php");
include("$BASE_DIR/backendadmin/admin.config.inc.php");

include("$BASE_DIR/backendadmin/gd.inc.php");
include("$BASE_DIR/backendadmin/imgsize.php");

$title = $_REQUEST["title"];

if($_REQUEST["addhelptopic"]!="") {

    $qrysel = "select * from topic_title where title='$title'";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if($totalrow>0) {
       
    }
    else {
        $qryins = "insert into helptopic (topic_title) values ('$title')";
      
        db_query($qryins);
          echo "added new help topic<a href=\"javascript: add_help(" . db_insert_id() . ");\">Add Help page</a>";
    }

}

if($_REQUEST["edithelptopic"]!="") {
    $id = $_REQUEST["editid"];
    $qrysel = "select * from helptopic where topic_title='$title' and topic_id<>$id";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if($totalrow>0) {
       
    }
    else {
        $qryupd = "update helptopic set topic_title='$title' where topic_id='$id'";
        db_query($qryupd);
        
        echo "added new help topic<a href=\"add_help(" . db_insert_id() . ");\">Edit Help page</a>";
    }
}

if($_GET["delid"]!="") {
    $qryd = "delete from helptopic where topic_id='".$_GET["delid"]."'";
    db_query($qryd) or die(db_error());
    header("location: message.php?msg=24");
    exit;
}

if($_REQUEST["help_edit"]!="" || $_REQUEST["help_delete"]!="") {
    if($_REQUEST["help_edit"]!="") {
        $id = $_REQUEST["help_edit"];
    }
    else {
        $id = $_REQUEST["help_delete"];
    }
    $qrysel = "select * from helptopic where topic_id=$id";
    $res = db_query($qrysel);
    $totalrow = db_affected_rows();
    $row = db_fetch_object($res);
}
?>
  <?php include("$BASE_DIR/include/addons/blank_page/page_headers.php"); ?>

        <script type="text/javascript">
            function Check()
            {
                if($('#title').val()=="")
                {
                    alert("Please Enter Help Topic Title");
                  
                    return false;
                }else{
               submit_test_ajax_form('backend_form', '<?php echo $SITE_URL;?>include/addons/blank_page/index.php?edit_page=true&add_new_page=addhelptopic', 'container');
                
                }
            }
        </script>

                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>
                                    <?php if($_GET['help_edit']!="") { ?> Edit Help Topic<?php } else {
                                        if($_GET['help_delete']!="") { ?> Confirm Delete Help Topic <?php }else { ?> Add Help Topic <?php }
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
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>

                                                    <br/>
                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="backend_form" id="backend_form" method="post" action="javascript: Check();" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Topic Title:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="50" name="title" id="title" value="<?=$row->topic_title;?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <?
                                                                                if($_REQUEST["help_edit"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Edit Help Topic</span></span><input name="submit" type="submit" /></span>
                                                                                <input type="hidden" name="editid" value="<?=$id?>" />
                                                                                <input type="hidden" id="edithelptopic" name="edithelptopic" value="true" />
                                                                                    <?
                                                                                }
                                                                                elseif($_REQUEST["help_delete"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete Help Topic</span></span><input name="deletehelptopic" type="button" onclick="javascript: window.location.href='addhelptopic.php?delid=<?=$id?>';"/></span>
                                                                                    <?
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                    <input type="hidden" id="addhelptopic" name="addhelptopic" value="true" />
                                                                                <span class="button send_form_btn"><span><span>Add Help Topic</span></span><input name="submit" type="submit" /></span>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </li>

                                                                        </ul>

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
