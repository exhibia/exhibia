<?php
include("config/connect.php");
include("functions.php");

$extra = array(
        "form_subject"	=> true,
        "form_cc"		=> true,
        "ip"				=> true,
        "user_agent"	=> true
);

// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {

    
    // Send back the contact form HTML
    $output = "<div style='display:none'>
	<script language='JavaScript'>
function TrackCount(fieldObj,maxChars){
  var countField = eval('fieldObj.form.textcount1');
  var diff = maxChars - fieldObj.value.length;
	
  if (diff < 0)
  {
    fieldObj.value = fieldObj.value.substring(0,maxChars);
    diff = maxChars - fieldObj.value.length;
  }
  countField.value = diff;
}

function LimitText(fieldObj,maxChars){
  var result = true;
  if (fieldObj.value.length >= maxChars)
    result = false;
  
  if (window.event)
    window.event.returnValue = result;
  return result;
}
</script>
	<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>
	<div class='contact-top'></div>
	<div class='contact-content'>
		<h1 class='contact-title'>".ADD_COMMENT.":</h1>
		<div class='contact-loading' style='display:none'></div>
		<div class='contact-message' style='display:none'></div>
		<form action='#' name='form1' style='display:none'>";


    $output .= "
			<label for='contact-message'>*".MESSAGE.":</label>
			<textarea id='contact-message' class='contact-input' name='message' cols='40' rows='4' ONKEYUP='TrackCount(this,600)' ONKEYPRESS='LimitText(this,600)' tabindex='1004'></textarea>
			<input type='hidden' size='2' value='600' name='textcount1' class='textbox'>
			<br/>";

    $output .= "
			<label>&nbsp;</label>
			<button type='submit' class='contact-send contact-button' tabindex='1006'>".ADD."</button>
			<button type='submit' class='contact-cancel contact-button simplemodal-close' tabindex='1007'>".CANCEL."</button>
			<br/><br/>
			
		</form>
	</div>
	
</div>";

    echo $output;


}
else if ($action == "send") {

    $qrydup = "select * from community_comment where user_id='".$user_id."' and community_id='".$communityid."'";
    $resdup = db_query($qrydup);
    $totaldup = db_num_rows($resdup);

    if($totaldup<=0) {
        $subject = isset($_POST["title"]) ? chkInput($_POST["title"],'s') : "";
        $message = isset($_POST["message"]) ? chkInput($_POST["message"],'s') : "";

        $commenttime = time();
        $user_id = $_SESSION['userid'];
        //$community = explode("_",$_GET["com_id"]);
        $communityid = chkInput($_GET["com_id"],'i');

        $insertQuery = "INSERT INTO community_comment (user_id,community_id,com_description,com_date) VALUES('".$user_id."','".$communityid."','".$_POST["message"]."','".$commenttime."')";


        $resultQuery = db_query($insertQuery) or die(db_error());


        if(!$_GET['pgno']) {
            $PageNo = 1;
        }
        else {
            $PageNo = chkInput($_GET['pgno'],'i');
        }

        $StartRow =   $PRODUCTSPERPAGE * ($PageNo-1);


        $query="SELECT * FROM community_comment where community_id = '".$communityid."' order by id desc";
        $rs=db_query($query);
        $totalrows=db_num_rows($rs);
        $totalpages=ceil($totalrows/$PRODUCTSPERPAGE);
        //echo $query;
        $query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
        $resultus = db_query($query);


        $i = 0;
        $detail = "";
        while($row =db_fetch_object($resultus)) {
            $communityrating = explode("|",GetCommunityRating($row->id));
            if($i==0) {
                $firstuname = getUserName($row->user_id);
            }
            $post1 = getPostcomment($row->community_id,$row->user_id);
            $post = explode("|",$post1);
            $totalpost = $post[0];
            $joindate = $post[1];
            $commentdate = date("M d, Y", $row->com_date);
            $commenttime = date ("h:i A",$row->com_date);
            $detail .="<div class='commentdate'>";
            $detail .=$commentdate."&nbsp;&nbsp".$commenttime;
            $detail .="</div>";
            $detail .="<div class='commentbox'>";
            $detail .="<div class='commentdesc'>";
            $detail .="<div><span>".USER.":</span>".getUserName($row->user_id)."</div>";
            $detail .="<div class='clear'>&nbsp;</div>";
            $detail .="<div><span>".JOINT_DATE.":</span>".arrangedate($joindate)."</div>";
            $detail .="</div>";
            $detail .="<div class='commentdetail'>".stripslashes($row->com_description);
            $detail .="<div style='float: left; padding-top: 5px; width: 50px; padding-top: 20px;'>Rate It:</div>
							   <div style='padding-top: 15px;'>
							   <div style='float: left; width: 28px;'><img src='images/thumbup_01.png' align='left' border='0' style='cursor: pointer;' onclick='GiveRating(0,".$row->id.")'/></div><div class='thumb_uprate'><div style='padding-top: 4px;'><span id='thumbuprateup_".$row->id."'>".$communityrating[0]."</span>%</div></div>
								</div>
								<div style='float: left; width: 120px;'>
            		        	<div style='float: left; width: 28px;'><img src='images/thumbdown_01.png' align='left' border='0' style='cursor: pointer;' onclick='GiveRating(1,".$row->id.")' /></div><div class='thumb_downrate'><div style='padding-top: 4px;'><span id='thumbupratedown_".$row->id."'>".$communityrating[1]."</span>%</div></div>
			                    </div>
							   
							   </div>";
            $detail .="</div>";
            $detail .="</div>";
            $detail .="<div class='clear'>&nbsp;</div>";
            $i++;
        }

        echo $detail."|".$firstuname."|".$totalrows;
    }
}
exit;

?>