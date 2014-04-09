<?php
session_start();
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


$topic = $_REQUEST["topic"];
$quetitle = addslashes($_REQUEST["quetitle"]);
$content = addslashes($_REQUEST["description"]);

if($_REQUEST["addfaq"]!="") {
    $qrys = "select * from faq where que_title='$quetitle'";
    $ress = db_query($qrys);
    $totals = db_affected_rows();
    if($totals>0) {
        header("location: message.php?msg=27");
        exit;
    }
    else {
        $qryins = "insert into faq (parent_topic, que_title, que_content) values('$topic','$quetitle','$content')";
        db_query($qryins) or die(db_error());
echo "added new help page<a href=\"help.php\">View page</a>";
       $_GET["faq_edit"] = db_insert_id();
    }
}

if($_REQUEST["editfaq"]!="") {
    $id = $_REQUEST["editid"];
    $qrys = "select * from faq where que_title='$quetitle' and id<>'$id'";
    $ress = db_query($qrys);
    $totals = db_affected_rows();
    if($totals>0) {
   
    }
    else {
        $qryupd = "Update faq set parent_topic='$topic', que_title='$quetitle', que_content='$content' where id='$id'";
        db_query($qryupd) or die(db_error());
echo "updated help page<a href=\"help.php\">View page</a>";
    }
}

if($_GET["delid"]!="") {
    $id = $_GET["delid"];
    $qryd = "delete from faq where id='$id'";
    db_query($qryd) or die(db_error());
    header("location: message.php?msg=28");
}

if($_GET["faq_edit"]!="" || $_GET["faq_delete"]!="") {
    if($_GET["faq_edit"]!="") {
        $id = $_GET["faq_edit"];
    }
    else {
        $id = $_GET["faq_delete"];
    }

    $qrysel = "select * from faq where id='$id'";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    $rows = db_fetch_object($ressel);
}
?>
  <?php include("$BASE_DIR/include/addons/blank_page/page_headers.php"); ?>
        <script type="text/javascript" src="<?php echo $SITE_URL;?>/backendadmin/js/ui/ui.datepicker.min.js"></script>

        <script type="text/javascript">
            function Check(f1)
            {
                if(document.f1.topic.value=="none")
                {
                    alert("Please select help topic");
                    document.f1.topic.focus();
                    return false;
                }else

                if(document.f1.quetitle.value=="")
                {
                    alert("Please Enter Question Title");
                    document.f1.quetitle.focus();
                    return false;
                }else{
                
                submit_test_ajax_form('backend_form', '<?php echo $SITE_URL;?>include/addons/blank_page/index.php?edit_page=true&add_new_page=addFAQ', 'container');
                
                }

                /*	if(document.f1.description.value=="")
                {
                        alert("Please Enter Question Content");
                        //document.f1.description.focus();
                        return false;
                }
                 */}
        </script>

                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>
                                    <?php if($_GET['faq_edit']!="") { ?> Edit FAQ<?php } else {
                                        if($_GET['faq_delete']!="") { ?> Confirm Delete FAQ <?php }else { ?> Add FAQ <?php }
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
                                                    <form name="f1" id="backend_form" action="javascript:Check(f1);" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Help Topic:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="topic" id="topic">
                                                                                <option value="none">select one</option>
                                                                                <?
                                                                                $qry = "select * from helptopic";
                                                                                $res = db_query($qry);
                                                                                $totalrow = db_affected_rows();
                                                                                while($tp = db_fetch_array($res)) {
                                                                                    ?>
                                                                                <option <?=$rows->parent_topic==$tp["topic_id"]?"selected":"";?> value="<?=$tp["topic_id"];?>"><?=$tp["topic_title"];?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Question Content:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="50" name="quetitle" id="quetitle" value="<?=$rows->que_title!=""?stripslashes($rows->que_title):""; ?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Answer:</label>
                                                                    <div class="inputs">
                                                                        <span class="">
                                                                            <textarea class="text" name="description" id="description" cols="80" rows="25"><?=$rows->que_content!=""?stripslashes($rows->que_content):"";?></textarea>
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
                                                                                if($_REQUEST["faq_edit"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Edit FAQ</span></span>
                                                                                <input type="hidden"  id="editfaq"  name="editfaq" value="true" />
                                                                                <input name="submit" type="submit"/></span>
                                                                                <input type="hidden" name="editid" value="<?=$id?>" />
                                                                                    <?
                                                                                }
                                                                                elseif($_REQUEST["faq_delete"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete FAQ</span></span><input name="deletefaq" type="button" onclick="javascript: window.location.href='addFAQ.php?delid=<?=$id?>';"/></span>
                                                                                    <?
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                    <input type="hidden"  id="addfaq"  name="addfaq" value="true" />
                                                                                <span class="button send_form_btn"><span><span>Add FAQ</span></span><input id="submit" type="submit"/></span>
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
                        
                        <script>
CKEDITOR.replace('description');
</script>
