<?php    
    include_once("inviter/abi.php");
   
      
    $email = base64_decode( $_GET["mail"] ); 
    $pass  = base64_decode( $_GET["pass"]); 
    
    $res = _inviter_fetch_contacts($email,$pass);
    
    if ($res==_INVITER_AUTHENTICATION_FAILED) {
        echo 'Mail adresi veya şifre yanlış';
    }
    else if ($res==_INVITER_FAILED) {
        echo 'Server error';
    }
    else if ($res==_INVITER_UNSUPPORTED) {
        echo 'Geçici süreliğine bu mail sağlayıcısından kişi listesi çekilemiyor.';
    }
    else if ($res==_INVITER_CAPTCHA_RAISED) {
        echo 'Hata Oluştu';
    }
    else if ($res==_INVITER_USER_INPUT_REQUIRED) {
        echo 'Webmail Sağlayıcınız bilgilerinizle giriş yapmamıza müsade etmiyor.';
    }
    else if (is_array($res)) {
                $contactlist = $res;
                $contactlist = _inviter_dedupe_contacts_by_email($contactlist);
               // $contactlist = _inviter_sort_contacts_by_name($contactlist);
                              

        
        echo base64_encode( serialize(  $contactlist ) );
    }
    else {
        echo 'Bilinmeyen hata oluştu';
    }    
?>