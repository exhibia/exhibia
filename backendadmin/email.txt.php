<?php

$MainLinksArray = array(
    array("Auction Email Template", "#", 1),
    array("User Email Template", "#", 1),
);


/* element 3, dashboard class, 4. horizontal  submenu class */
$ChildLinksArray = array(
    array("Accept Auction Email(No Pay)", "emailtemplateeditor.php?name=acceptauction_notpay", 0, 'email1', 'sm1'),
    array("Accept Auction Email", "emailtemplateeditor.php?name=acceptauction_pay", 0, 'email2', 'sm1'),
    array("Deny Auction Email", "emailtemplateeditor.php?name=denyauction", 0, 'email3', 'sm1'),
    array("Won Auction Email", "emailtemplateeditor.php?name=wonauction", 0, 'email4', 'sm1'),
    array("Inviter Email", "emailtemplateeditor.php?name=inviter", 0, 'email5', 'sm1'),

    array("Registration Email", "emailtemplateeditor.php?name=registration", 1, 'email6', 'sm1'),
    array("Affiliate Email", "emailtemplateeditor.php?name=affiliate", 1, 'email7', 'sm1'),
    array("Feedback Email", "emailtemplateeditor.php?name=feedback", 1, 'email8', 'sm1'),
    array("Forget Password Email", "emailtemplateeditor.php?name=forgetpassword", 1, 'email9', 'sm1'),
   array("Add Email Template", "emailtemplateeditor.php?name=addemail", 1, 'email10', 'sm1'),
    );
$i = 12;
	$emailQ = db_query("select name from emailtemplate where id >= 32 and name != '' and subject != '' and content != ''");
	while($rowE = db_fetch_array($emailQ)){
	
	      array_push($ChildLinksArray, array($rowE[0], 'emailtemplateeditor.php?name=' . $rowE[0], 2, 'email10', 'sm1'));
	
	$i++;
	
	}
if(!empty($_SESSION['user_level']) & is_numeric($_SESSION['user_level'])){
$m = 0;
foreach($ChildLinksArray as $menu_key =>  $menu_value){

    
   
    
	   if(db_num_rows(db_query("select * from user_levels where allowed_pages like '%" . getcwd() . "/" .$ChildLinksArray[$menu_key][1] . "%' and id = '$_SESSION[user_level]'")) == 0){
    
		
    
	    $ChildLinksArray[$m] =  array($ChildLinksArray[$menu_key][0], "#", $ChildLinksArray[$menu_key][2], 'unauthorised', $ChildLinksArray[$menu_key][4]);
    
    }


$m++;


}

}
?>
