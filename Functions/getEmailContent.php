<?php

function getEmailContent($id, $referid = null) {
    global $SITE_URL, $SITE_NM, $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    //This is for affiliate.php page mail content
 
    if ($id == 1) {
        $content = str_replace("[[userid]]", $referid, EmailTemplate::getEmailTemplate('affiliate')->content);
	$content = str_replace("[[SITE_NM]]", $SITE_NM, $content);
	$content = str_replace("[[SITE_URL]]", $SITE_URL, $content);		
    }
    // This is for feedback.php page mail content
    if ($id == 2) {
        $content = '<p>'.$content = EmailTemplate::getEmailTemplate('feedback')->content.'</p>';
        $content.= "<font style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>Dear Admin," . "</font><br>" . "<br>" . "<p align='center' style='font-size: 14px;font-family: Arial, Helvetica, sans-serif;font-weight:bold;'>Email Information</p>" . "<br>" .
                "<table border='0' cellpadding='3' cellspacing='0' width='500' align='left' class='style13'>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Here is the email information: </td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Name: %1\$s</td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Email Address: %2\$s</td>
			</tr>";
        $auctionid = "%3\$s";
        if ($auctionid != "") {
            $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Auction ID: %3\$s</td>
				</tr>";
        }

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>&nbsp;</td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>%4\$s</td>
			</tr>
			</table>";
    }

    // This is for Accepted wonauctionaccept.php page mail content
    if ($id == 3) {
        $content = '';

        $content.= "<font style='font-size: 12x;font-family: Arial, Helvetica, sans-serif;color: #333333;'>" . "</font><br>" . "<br>" . "<p align='center' style='font-size: 14px;font-family: Arial, Helvetica, sans-serif;font-weight:bold;'>Won Auction Information</p>" . "<br>" .
                "<table border='0' cellpadding='3' cellspacing='0' width='500' align='center' class='style13'>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Hi %1\$s, </td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>";
        $content .= "You have won and accepted the following item.";
        "</td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Auction ID: %3\$s</td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Name: %4\$s</td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Price: %5\$s</td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Acceptance date: %6\$s</td>
			</tr></table>";
    }

    // This is for Denied wonauctionaccept.php page mail content
    if ($id == 4) {
        $content = '';

        $content.= "<font style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>" . "</font><br>" . "<br>" . "<p align='center' style='font-size: 14px;font-family: Arial, Helvetica, sans-serif;font-weight:bold;'>Won Auction Information</p>" . "<br>" .
                "<table border='0' cellpadding='3' cellspacing='0' width='500' align='center' class='style13'>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Hi %1\$s, </td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>";
        $content .= "You have won and denied the following item.";
        "</td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Auction ID: %3\$s</td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Name: %4\$s</td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Price: %5\$s</td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Denial date: %6\$s</td>
			</tr></table>";
    }

    // This is for Accept And mailpayflag = 1 wonauctionaccept.php page mail content
    if ($id == 5) {
        $content1 = '';

        $content.= "<font style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>" . "</font><br>" . "<br>" . "<p align='center' style='font-size: 14px;font-family: Arial, Helvetica, sans-serif;font-weight:bold;'>Won Auction Information</p>" . "<br>" .
                "<table border='0' cellpadding='3' cellspacing='0' width='500' align='center' class='style13'>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Hi %1\$s, </td>
				</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>";
        $content .= "You have won and accepted the following item.";
        "</td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Auction ID: %3\$s</td>
				</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Name: %4\$s</td>
				</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Price: %5\$s</td>
				</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Acceptance date: %6\$s</td>
				</tr>";


        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>The auction price must be paid within 7 days from the acceptance date.</td>
				</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>To make the payment <a href='" . $SITE_URL . "login.php?wid=" . base64_encode("%3\$s") . "'>Click here</a></td>
				</tr>
				</table>";
    }


    // This is for registration.php page mail content
    if ($id == 6) {
        $content = '<p>'.$content = EmailTemplate::getEmailTemplate('registration')->content.'</p>';
        $content.= "" .
                "<table border='0' cellpadding='3' cellspacing='0' width='500' align='left' class='style13'>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Dear %1\$s, </td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Welcome to " . $SITE_NM . "!  We are pleased and proud that you have decided to join us. </td>
			</tr>";
        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Below is your new account information </td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Name:%1\$s,%2\$s</td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Email: %3\$s</td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Your UserID for " . $SITE_NM . ": %5\$s</td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Your Username for " . $SITE_NM . ": %4\$s</td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Please click on the link below to Activate Your Account Now: <a href='" . $SITE_URL . "password.php?auc_key=%6\$s'>Click Here</a></td>
			</tr>
			<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Thanks and Welcome to this great auction!</td></tr>
			<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Customer Support<br>" . $SITE_NM . "</td></tr>
			<tr><td></td></tr>
			</table>";

    }

    // This is for paymentsuccess.php page mail content
    if ($id == 7) {
        $content='<p>'.$content = EmailTemplate::getEmailTemplate('wonauction')->content.'</p>';

        $content.= "<table border='0' cellpadding='0' width='500' align='left' cellspacing='0'>";

        $content .="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'><td>Dear %1\$s,</td></tr><tr><td height='10'></td><tr>";

        $content .="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'><td>We have received your payment for the auction you won and your item will<br>Now be set to be shipped!</b></td></tr><tr><td height='10'></td><tr>";
        $content .="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'><td>Here are the details of the Auction you won. </b></td></tr><tr><td height='10'></td><tr>";
        $content .="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'><td>Name of the Item you Won:&nbsp; %2\$s </td></tr>";
        $content .="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'><td>Price You Paid For the Item You Won:&nbsp; %3\$s </td></tr>";
        $content .="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'><td>Auction View:&nbsp; %4\$s </td></tr><tr><td height='10'></td><tr>";

        $content .="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'><td>Thank you and have a great day!</td></tr><tr><td height='10'></td><tr>";

        $content .="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'><td>Customer Support<br>" . $SITE_NM . "</td></tr>";

        $content.="</table>";
    }

    // This is for newsletter.php page mail content
    if ($id == 8) {

        $content='<p>'.$content = EmailTemplate::getEmailTemplate('newsletter')->content.'</p>';
        $content.= "<table border='0' cellpadding='3' cellspacing='0' width='500' align='left' class='style13'>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Hi %1\$s,</td>
			</tr></tr><tr><td height='10'></td><tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Thanks for your interest in our newsletter.</td>
			</tr></tr><tr><td height='10'></td><tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>You are now successfully subscribe to our newsletter.</td>
			</tr></tr><tr><td height='10'></td><tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Be sure and check out the <a href='" . $SITE_URL . "'>" . $SITE_NM . "</a> every day to see the new and exciting auctions that are starting.</td>
			</tr></tr><tr><td height='10'></td><tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Have fun and good luck!</td>
			</tr></tr><tr><td height='10'></td><tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Customer Support<br>" . $SITE_NM . "</td></tr></table>";
    }

    // This is for Accept acceptordenied.php page mail content
    if ($id == 9) {
        $emailtemplate=EmailTemplate::getEmailTemplate('acceptauction_notpay');
        $content='<p>'.$emailtemplate->content.'</p>';

        $content.= "<table border='0' cellpadding='3' cellspacing='0' width='500' align='left' class='style13'>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Hi %7\$s, </td></tr><tr><td height='10'></td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>";
        $content .= "Congratulations on Winning the Following Auction at " . $SITE_NM . "</td></tr><tr><td height='10'></td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Auction ID: %2\$s</td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Name Of The Item Won : %3\$s</td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Price You Won The Auction For : %4\$s</td></tr><tr><td height='10'></td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>To Start the claim process you have to either Claim or Deny this win</td></tr>";
        $content.="</table>";
    }

    // This is for Denied acceptordenied.php page mail content
    if ($id == 10) {
        $content = '<p>'.EmailTemplate::getEmailTemplate('denyauction')->content.'</p>';

        $content.= "<table border='0' cellpadding='3' cellspacing='0' width='500' align='left' class='style13'>";        

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Hi %7\$s, </td></tr><tr><td height='10'></td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>";
        $content .= "Congratulations on Winning the Following Auction at " . $SITE_NM . "</td></tr><tr><td height='10'></td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Auction ID: %2\$s</td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Name Of The Item Won : %3\$s</td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Price You Won The Auction For : %4\$s</td></tr><tr><td height='10'></td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>To Start the claim process you have to either Claim or Deny this win</td></tr>";
        $content.="</table>";
    }

    // This is for Accept and mailpayflag = 1 acceptordenied.php page mail content
    if ($id == 11) {
        $content = '<p>'.EmailTemplate::getEmailTemplate('acceptauction_pay')->content.'</p>';

        $content.= "<table border='0' cellpadding='3' cellspacing='0' width='500' align='left' class='style13'>";
      

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Hi %1\$s, </td></tr><tr><td height='10'></td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>";
        $content .= "Congratulations on Winning the Following Auction at " . $SITE_NM . "</td></tr><tr><td height='10'></td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Auction ID: %2\$s</td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Name Of The Item Won : %3\$s</td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>Price You Won The Auction For : %4\$s</td></tr><tr><td height='10'></td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>To claim your auction item, the price you won the item for must be paid within 7 days</td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
				<td>To claim and pay for your won item, please click the link here :<br> <a href='" . $SITE_URL . "login.php?wid=%5\$s'>" . $SITE_URL . "login.php?wid=%5\$s</a></td></tr></table>";
    }
    // This is for forgotpassword.php page mail content
    if ($id == 12) {
        $content = '<p>'.EmailTemplate::getEmailTemplate('forgetpassword')->content.'</p>';
        $content.= "<table border='0' cellpadding='3' cellspacing='0' width='500' align='left' class='style13'>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Dear Member,</td></tr><tr><td height='10'></td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Here is the login information that you requested:</td>
			</tr><tr><td height='10'></td></tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Your Username for " . $SITE_NM . ": %2\$s</td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>To reset your password, please click here: <a href='" . $SITE_URL . "password.php?ud=%5\$s&pd=%3\$s&key=%4\$s'>HERE</a></td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td><br>Thanks %1\$s and have a great day!<br></td>
			</tr>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td><br>Customer Support<br>" . $SITE_NM . "</td>
			</tr>
			</table>";
    }

    if ($id == 13) {
        $content = '';
        $content.= "<table border='0' cellpadding='3' cellspacing='0' width='500' align='left' class='style13'>";

        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Dear %4\$s,</td></tr><tr><td height='10'></td></tr>";

        $content.="<tr><td><font style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>Hey, have you heard of this auction? I became a Member for Free and thought you might want to check it out too! " . "</font></td></tr><tr><td height='5'></td></tr><tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>This is not a typical auction, they auction brand new, brand name products at up to 90 percent off retail!  The prices on the auctions start at just 10 Cents and every time a bid is placed the price goes up 10 cents.  When the countdown clock gets to zero, whoever placed the last bid, wins.  The deals they have are unbelievable.  It's really unique and really cool. </td>
			</tr>";

        $content.="<tr><td height='5'></td></tr><tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>All of the auctions are for  brand new, name brand products, all selling for less than 10% of the retail price!  You won't believe these prices, I've seen 42 Inch Plasma Tv's sell for less than $15.00, an iPod Nano sold for $1.38 and a PlayStation 3 sold for just $7.34! 
check it out at <a href='" . $SITE_URL . "registration.php?ref=%1\$s'>" . $SITE_NM . "</a>
</td>
			</tr>";

        $content.="<tr><td height='5'></td></tr><tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>It's free to join, it's really cool and really addictive.</td>
			</tr>";

        $content.="<tr><td height='5'></td></tr><tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>Thanks,</td>
			</tr>";
        $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
			<td>%3\$s</td>
			</tr>
			</table>";
    }

    return $content;
}

//end email content for affiliate email

function getEmailSubject($id) {
    // This is for affiliate.php page mail subject
    if ($id == 1) {
        $subject = EmailTemplate::getEmailTemplate('affiliate')->subject;
    }

    // This is for feedback.php page mail subject
    if ($id == 2) {
        $subject = EmailTemplate::getEmailTemplate('feedback')->subject;
        //$subject = "Question about ";
    }

    // This is for Accept wonauctionaccept.php page mail subject
    if ($id == 3) {
        $subject = "Auction Accept - Item Won!";
    }

    // This is for Denied wonauctionaccept.php page mail subject
    if ($id == 4) {
        $subject = "Auction Denied - Item Won!";
    }

    // This is for Accept and mailpayflag = 1 wonauctionaccept.php page mail subject
    if ($id == 5) {
        $subject = "Auction Accept - Item Won!";
    }

    // This is for registration.php page mail subject
    if ($id == 6) {
        $subject = EmailTemplate::getEmailTemplate('registration')->subject;

        $subject = "Welcome to our auction";
    }

    // This is for paymentsuccess.php page mail subject
    if ($id == 7) {
        $subject = EmailTemplate::getEmailTemplate('wonauction')->subject;
        $subject = "Thank You For Paying for your Auction Win";
    }

    // This is for newsletter.php page mail subject
    if ($id == 8) {
        $subject = EmailTemplate::getEmailTemplate('newsletter')->subject;
    }

    // This is for Accept acceptordenied.php page mail subject
    if ($id == 9) {
        $subject = EmailTemplate::getEmailTemplate('acceptauction_notpay')->subject;
    }

    // This is for Denied acceptordenied.php page mail subject
    if ($id == 10) {
        $subject=EmailTemplate::getEmailTemplate('denyauction')->subject;
    }

    // This is for Accept and mailpayflog = 1 acceptordenied.php page mail subject
    if ($id == 11) {
        $subject=EmailTemplate::getEmailTemplate('acceptauction_pay')->subject;
    }

    // This is for forgotpassword.php page mail subject
    if ($id == 12) {
        $subject=EmailTemplate::getEmailTemplate('forgetpassword')->subject;
    }
    if ($id == 13) {
        $subject = "Have you heard of this?";
    }
    return $subject;
}
