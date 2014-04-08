<?php
if(!function_exists('SendHTMLMail2')){
function SendHTMLMail2($to, $subject, $mailcontent, $from) {
global $SITE_NM, $SITE_URL, $Currency;
    $array = explode("@", $from, 2);
    $SERVER_NAME = $array[1];
    $username = $array[0];
    $headers = "From: $array[0]@$array[1]\r\nReply-To:$username@$SERVER_NAME\r\n";
    $headers .= "To: $to \r\n";
    $headers .= "Return-Path: $array[0]@$array[1]\r\n";
    $headers .= "X-Mailer: Drupal\r\n";
    $headers .= "Date: " . date("l j F Y, G:i") . "\r\n";
   
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $objsel = mysql_fetch_array(mysql_query("select * from registration where email = '$to'"));
    
    $subject = str_replace("[[SITE_NM]]", $SITE_NM, $subject);
    $subject = str_replace("[[SITE_URL]]", $SITE_URL, $subject);
    $subject = str_replace("[[auctionid]]", base64_encode($objsel['auctionID']), $subject);
    $subject = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $subject);
    $subject = str_replace("[[won_date]]", arrangedate(substr($objsel['won_date'], 0, 10)), $subject);
    $subject = str_replace("[[currency]]", $Currency, $subject);
    $subject = str_replace("[[winprice]]", number_format($winprice, 2), $subject);
    $subject = str_replace("[[firstname]]", $objsel['firstname'], $subject);
    $subject = str_replace("[[name]]", $objsel['name'], $subject);
    
    
    
    $mailcontent = str_replace("[[SITE_NM]]", $SITE_NM, $mailcontent);
    $mailcontent = str_replace("[[SITE_URL]]", $SITE_URL, $mailcontent);
    $mailcontent = str_replace("[[auctionid]]", base64_encode($objsel['auctionID']), $mailcontent);
    $mailcontent = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $mailcontent);
    $mailcontent = str_replace("[[won_date]]", arrangedate(substr($objsel['won_date'], 0, 10)), $mailcontent);
    $mailcontent = str_replace("[[currency]]", $Currency, $mailcontent);
    $mailcontent = str_replace("[[winprice]]", number_format($winprice, 2), $mailcontent);
    $mailcontent = str_replace("[[firstname]]", $objsel['firstname'], $mailcontent);
    $mailcontent = str_replace("[[verifycode]]", $objsel['verifycode'], $mailcontent);
    $mailcontent = str_replace("[[name]]", $objsel['name'], $mailcontent);
    

    
    mail($to, $subject, "<html><body>" . $mailcontent . "</body></html>", $headers, '-f' . $array[0] . '@' . $array[1]);
   
}
}
if(!function_exists('SendHTMLMail')){
function SendHTMLMail($to, $subject, $mailcontent, $from) {
global $SITE_NM, $SITE_URL, $Currency;
    $array = explode("@", $from, 2);
    $SERVER_NAME = $array[1];
    $username = $array[0];
    $headers = "From: $array[0]@$array[1]\r\nReply-To:$username@$SERVER_NAME\r\n";
    $headers .= "Return-Path: $array[0]@$array[1]\r\n";
    $headers .= "X-Mailer: Drupal\r\n";
    $headers .= "Date: " . date("l j F Y, G:i") . "\r\n";
   
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    
    $objsel = mysql_fetch_array(mysql_query("select * from registration where email = '$to'"));
    
    $subject = str_replace("[[SITE_NM]]", $SITE_NM, $subject);
    $subject = str_replace("[[SITE_URL]]", $SITE_URL, $subject);
    $subject = str_replace("[[auctionid]]", base64_encode($objsel['auctionID']), $subject);
    $subject = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $subject);
    $subject = str_replace("[[won_date]]", arrangedate(substr($objsel['won_date'], 0, 10)), $subject);
    $subject = str_replace("[[currency]]", $Currency, $subject);
    $subject = str_replace("[[winprice]]", number_format($winprice, 2), $subject);
    $subject = str_replace("[[firstname]]", $objsel['firstname'], $subject);
    $subject = str_replace("[[name]]", $objsel['name'], $subject);
    
    
    
    $mailcontent = str_replace("[[SITE_NM]]", $SITE_NM, $mailcontent);
    $mailcontent = str_replace("[[SITE_URL]]", $SITE_URL, $mailcontent);
    $mailcontent = str_replace("[[auctionid]]", base64_encode($objsel['auctionID']), $mailcontent);
    $mailcontent = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $mailcontent);
    $mailcontent = str_replace("[[won_date]]", arrangedate(substr($objsel['won_date'], 0, 10)), $mailcontent);
    $mailcontent = str_replace("[[currency]]", $Currency, $mailcontent);
    $mailcontent = str_replace("[[winprice]]", number_format($winprice, 2), $mailcontent);
    $mailcontent = str_replace("[[firstname]]", $objsel['firstname'], $mailcontent);
    $mailcontent = str_replace("[[name]]", $objsel['name'], $mailcontent);
    
    
    
    mail($to, $subject, "<html><body>" . $mailcontent . "</body></html>", $headers, '-f' . $array[0] . '@' . $array[1]);
}
}


function SendWinnerMail($auctionid, $test = false) {
    global $SITE_URL, $Currency, $adminemailadd, $SITE_NM, $DATABASENAME, $USERNAME, $PASSWORD, $DBSERVER, $BASE_DIR ;

    
    $db = mysql_pconnect($DBSERVER, $USERNAME, $PASSWORD);
    mysql_select_db($DATABASENAME, $db);
    
    
    if(!$test){
    $qrysel = "select * from won_auctions w left join auction a on w.auction_id=a.auctionID left join registration r on w.userid=r.id left join products p on a.productID=p.productID where w.auction_id='" . $auctionid . "'";
    $ressel = mysql_query($qrysel);
    $objsel = mysql_fetch_array($ressel);
    mysql_free_result($ressel);

    if ($objsel['fixedpriceauction'] == 1) {
        $winprice = $objsel['auc_fixed_price'];
    } elseif ($objsel['offauction'] == 1) {
        $winprice = "0.00";
    } else {
        $winprice = $objsel['auc_final_price'];
    }
      
 $email_template = mysql_fetch_array(mysql_query("select * from emailtemplate where name = 'wonauction' limit 1"));


     $content2 = str_replace("[[SITE_NM]]", $SITE_NM, $email_template['subject']);
    $content2 = str_replace("[[SITE_URL]]", $SITE_URL, $content2);
    $content2 = str_replace("[[auctionid]]", $objsel['auctionID'], $content2);
    $content2 = str_replace("[[winid]]", base64_encode($objsel['auctionID']), $content2);
    $content2 = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $content2);
    $content2 = str_replace("[[won_date]]", arrangedate(substr($objsel['won_date'], 0, 10)), $content2);
    $content2 = str_replace("[[currency]]", $Currency, $content2);
    $content2 = str_replace("[[winprice]]", number_format($winprice, 2), $content2);
    $content2 = str_replace("[[firstname]]", $objsel['firstname'], $content2);
    $content2 = str_replace("[[name]]", $objsel['name'], $content2);
    
    
    
    $content1 = str_replace("[[SITE_NM]]", $SITE_NM, $email_template['content']);
    $content1 = str_replace("[[SITE_URL]]", $SITE_URL, $content1);
    $content1 = str_replace("[[auctionid]]", $objsel['auctionID'], $content1);
    $content1 = str_replace("[[winid]]", base64_encode($objsel['auctionID']), $content1);
    $content1 = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $content1);
    $content1 = str_replace("[[won_date]]", arrangedate(substr($objsel['won_date'], 0, 10)), $content1);
    $content1 = str_replace("[[currency]]", $Currency, $content1);
    $content1 = str_replace("[[winprice]]", number_format($winprice, 2), $content1);
    $content1 = str_replace("[[firstname]]", $objsel['firstname'], $content1);
    $content1 = str_replace("[[name]]", $objsel['name'], $content1);
    
  


    $from = $adminemailadd;
    
    $subject = $content2; 
      
    $email = $objsel['email'];
  
    SendHTMLMail2($email, $subject, $content1, $from);
    
    }
    else{
    
     $qrysel = "select * from won_auctions w left join auction a on w.auction_id=a.auctionID left join registration r on w.userid=r.id left join products p on a.productID=p.productID where userid=11 order by auction_id desc limit 1";
      $ressel = mysql_query($qrysel);
    $objsel = mysql_fetch_array($ressel);
    mysql_free_result($ressel);

    if ($objsel['fixedpriceauction'] == 1) {
        $winprice = $objsel['auc_fixed_price'];
    } elseif ($objsel['offauction'] == 1) {
        $winprice = "0.00";
    } else {
        $winprice = $objsel['auc_final_price'];
    }
      
 $email_template = mysql_fetch_array(mysql_query("select * from emailtemplate where name = 'wonauction' order by id asc limit 1"));
echo mysql_error();

     $content2 = str_replace("[[SITE_NM]]", $SITE_NM, $email_template['subject']);
    $content2 = str_replace("[[SITE_URL]]", $SITE_URL, $content2);
    $content2 = str_replace("[[auctionid]]", $objsel['auctionID'], $content2);
    $content2 = str_replace("[[winid]]", base64_encode($objsel['auctionID']), $content2);
    $content2 = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $content2);
    $content2 = str_replace("[[won_date]]", arrangedate(substr($objsel['won_date'], 0, 10)), $content2);
    $content2 = str_replace("[[currency]]", $Currency, $content2);
    $content2 = str_replace("[[winprice]]", number_format($winprice, 2), $content2);
    $content2 = str_replace("[[firstname]]", $objsel['firstname'], $content2);
    $content2 = str_replace("[[name]]", $objsel['name'], $content2);
    
    
    
    $content1 = str_replace("[[SITE_NM]]", $SITE_NM, $email_template['content']);
    $content1 = str_replace("[[SITE_URL]]", $SITE_URL, $content1);
    $content1 = str_replace("[[auctionid]]", $objsel['auctionID'], $content1);
    $content1 = str_replace("[[winid]]", base64_encode($objsel['auctionID']), $content1);
    $content1 = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $content1);
    $content1 = str_replace("[[won_date]]", arrangedate(substr($objsel['won_date'], 0, 10)), $content1);
    $content1 = str_replace("[[currency]]", $Currency, $content1);
    $content1 = str_replace("[[winprice]]", number_format($winprice, 2), $content1);
    $content1 = str_replace("[[firstname]]", $objsel['firstname'], $content1);
    $content1 = str_replace("[[name]]", $objsel['name'], $content1);
    
  


    $from = $adminemailadd;
    
    $subject = $content2; 
      
    $email = $objsel['email'];
    

    SendHTMLMail2($email, 'test email from ' . $SITE_NM . $subject, $content1, $from);
    SendHTMLMail2('support@pennyauctionsoft.com', 'test email from ' . $SITE_NM . $subject, $content1, $from);
    
    }


}


    

