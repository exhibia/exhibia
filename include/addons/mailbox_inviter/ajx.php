<?php
include("inc.init.php"); 

$inviter = new inviter();
?>

<?php     
  switch( $_REQUEST["mod"] ){
      
    case "contacts" :    
         $inviter->set_mail( $_REQUEST["mail"] );
         $inviter->set_pass( $_REQUEST["pass"] );
         $inviter->set_title( $_REQUEST["title"] );
         $inviter->set_subject( $_REQUEST["subject"] );
         $inviter->set_from( $_REQUEST["from"] );
         
         $contacts = $inviter->get_contacts();
         
         include("tpl/tpl.contact.list.php");
    break;
    
    case "send_invite" :
        $inviter->set_subject( $_REQUEST["subject"] );
        $inviter->set_title( $_REQUEST["title"] );
        $inviter->set_message( $_REQUEST["message"] );
        $inviter->set_from( $_REQUEST["from"] );
        $inviter->sent_invites( $_REQUEST["mails"] );
    break;
        
  }
  
?>