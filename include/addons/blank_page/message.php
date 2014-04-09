<?php
session_start();
include_once("admin.config.inc.php");
include("connect.php");

$success = "Success!!!<Br>";
$error = "Sorry!!!<br>";
if(!empty($_REQUEST['msg_set'])){
        $Message1 = $unsuccess;
        $Message2 = urldecode($_REQUEST['msg_set']);
     }else{
switch ( $_REQUEST['msg'] ) {
    case 1:
        $Message1 = $success;
        $Message2 = "User Deleted Successfully!!!<a href=manage_members.php> Click Here </a> to go back";
        break;
    case 2:
        $Message1 = $success;
        $Message2 = "User Added Successfully!!!<a href='manage_members.php'> Click Here </a> to go back";
        break;
    case 3:
        $Message1 = $success;
        $Message2 = "User Information Updated Successfully!!!<a href='manage_members.php'> Click Here </a> go back";
        break;
    case 4:
        $Message1 = $error;
        $Message2 = "Username or Email Already Exists!!!<a href='addmembers.php'> Click Here </a> go back";
        break;
    case 5:
        $Message1 = $success;
        $Message2 = "Category Added Successfully!!!<a href='managecat.php'> Click Here </a> to go back";
        break;
    case 6:
        $Message1 = $success;
        $Message2 = "Category Updated Successfully!!!<a href='managecat.php'> Click Here </a> to go back";
        break;
    case 7:
        $Message1 = $success;
        $Message2 = "Product Added Successfully!!!<a href='manageproducts.php'> Click Here </a> to go back";
        break;
    case 8:
        $Message1 = $success;
        $Message2 = "Product Updated Successfully!!!<a href='manageproducts.php'> Click Here </a> to go back";
        break;
    case 9:
        $Message1 = $success;
        $Message2 = "Product Edited Successfully!!!<a href='manageproducts.php'> Click Here </a> to go back";
        break;
    case 10:
        $Message1 = $success;
        $Message2 = "This Product Already Exists!!!<a href='manageproducts.php'> Click Here </a> to go back";
        break;
    case 11:
        $Message1 = $error;
        $Message2 = "This Category Linked to Products!!!<a href='managecat.php'> Click Here </a> to go back";
        break;
    case 12:
        $Message1 = $success;
        $Message2 = "Category Deleted Successfully!!!<a href='managecat.php'> Click Here </a> to go back";
        break;
    case 13:
        $Message1 = $success;
        $Message2 = "Auction Deleted Successfully!!!<a href='manageauction.php'> Click Here </a> to go back";
        break;
    case 14:
        $Message1 = $success;
        $Message2 = "Auction Added Successfully!!!<a href='javascript:add_auction();'> Click Here </a> to go add another";
        break;
    case 15:
        $Message1 = $success;
        $Message2 = "Auction Updated Successfully!!!<a href='manageauction.php'> Click Here </a> to go back";
        break;
    case 16:
        $Message1 = $error;
        $Message2 = "This Auction Is Running!!!<a href='manageauction.php'> Click Here </a> to go back";
        break;
    case 17:
        $Message1 = $error;
        $Message2 = "This Bid Pack Already Exists!!!<a href='managebidpack.php'> Click Here </a> to go back";
        break;
    case 18:
        $Message1 = $success;
        $Message2 = "Bid Pack Added Successfully!!!<a href='managebidpack.php'> Click Here </a> to go back";
        break;
    case 19:
        $Message1 = $success;
        $Message2 = "Bid Pack Updated Successfully!!!<a href='managebidpack.php'> Click Here </a> to go back";
        break;
    case 20:
        $Message1 = $success;
        $Message2 = "Bid Pack Deleted Successfully!!!<a href='managebidpack.php'> Click Here </a> to go back";
        break;
    case 21:
        $Message1 = $error;
        $Message2 = "This Help Topic Already Exists!!!<a href='managehelptopic.php'> Click Here </a> to go back";
        break;
    case 22:
        $Message1 = $success;
        $Message2 = "Help Topic Added Successfully!!!<a href='managehelptopic.php'> Click Here </a> to go back";
        break;
    case 23:
        $Message1 = $success;
        $Message2 = "Help Topic Updated Successfully!!!<a href='managehelptopic.php'> Click Here </a> to go back";
        break;
    case 24:
        $Message1 = $success;
        $Message2 = "Help Topic Deleted Successfully!!!<a href='managehelptopic.php'> Click Here </a> to go back";
        break;
    case 25:
        $Message1 = $success;
        $Message2 = "FAQ Added Successfully!!!<a href='manageFAQ.php'> Click Here </a> to go back";
        break;
    case 26:
        $Message1 = $success;
        $Message2 = "FAQ Updated Successfully!!!<a href='manageFAQ.php'> Click Here </a> to go back";
        break;
    case 27:
        $Message1 = $error;
        $Message2 = "This FAQ Already Exists!!!<a href='manageFAQ.php'> Click Here </a> to go back";
        break;
    case 28:
        $Message1 = $success;
        $Message2 = "FAQ Deleted Successfully!!!<a href='manageFAQ.php'> Click Here </a> to go back";
        break;
    case 29:
        $Message1 = $success;
        $Message2 = "Content Updated Successfully!!!<a href='staticpages.php?id=".$_GET["id"]."'> Click Here </a> to go back";
        break;
    case 30:
        $Message1 = $success;
        $Message2 = "News Added Successfully!!!<a href='managenews.php'> Click Here </a> to go back";
        break;
    case 31:
        $Message1 = $success;
        $Message2 = "News Exist For This Date!!!<a href='managenews.php'> Click Here </a> to go back";
        break;
    case 32:
        $Message1 = $success;
        $Message2 = "News Updated Successfully!!!<a href='managenews.php'> Click Here </a> to go back";
        break;
    case 33:
        $Message1 = $success;
        $Message2 = "News Deleted Successfully!!!<a href='managenews.php'> Click Here </a> to go back";
        break;
    case 34:
        $Message1 = $success;
        $Message2 = "Product Time Already Exist !!!<a href='manageauctiontime.php'> Click Here </a> to go back";
        break;
    case 35:
        $Message1 = $success;
        $Message2 = "Product Time Added Successfully!!!<a href='manageauctiontime.php'> Click Here </a> to go back";
        break;
    case 36:
        $Message1 = $success;
        $Message2 = "Product Time Updated Successfully!!!<a href='manageauctiontime.php'> Click Here </a> to go back";
        break;
    case 37:
        $Message1 = $success;
        $Message2 = "Product Time Deleted Successfully!!!<a href='manageauctiontime.php'> Click Here </a> to go back";
        break;
    case 38:
        $Message1 = $success;
        $Message2 = "Auction Setting Updated Successfully!!!<a href='manageauctiontime.php'> Click Here </a> to go back";
        break;
    case 39:
        $Message1 = $success;
        $Message2 = "Shipping Charge Updated Successfully!!!<a href='manageshippingcharge.php'> Click Here </a> to go back";
        break;
    case 40:
        $Message1 = $success;
        $Message2 = "Auction Pause Time Updated Successfully!!!<a href='manageauctionpause.php'> Click Here </a> to go back";
        break;
    case 41:
        $Message1 = $success;
        $Message2 = "This Product Was Successfully Added";
        break;
    case 42:
        $Message1 = $success;
        $Message2 = "newsletter Deleted Successfully!!!<a href='manageNewsletters.php'> Click Here </a> to go back";
        break;
    case 43:
        $Message1 = $success;
        $Message2 = "newsletter Send Successfully!!!<a href='manageNewsletters.php'> Click Here </a> to go back";
        break;
    case 44:
        $Message1 = $success;
        $Message2 = "Bids Cr/Dr Successfully!!!<a href='addbonusbid.php'> Click Here </a> to go back";
        break;
    case 45:
        $Message1 = $success;
        $Message2 = "Shipping Charge Added Successfully!!!<a href='manageshippingcharge.php'> Click Here </a> to go back";
        break;
    case 46:
        $Message1 = $success;
        $Message2 = "Shipping Charge Deleted Successfully!!!<a href='manageshippingcharge.php'> Click Here </a> to go back";
        break;
    case 47:
        $Message1 = $error;
        $Message2 = "This Shipping Charge Already Exists !!!<a href='manageshippingcharge.php'> Click Here </a> to go back";
        break;
    case 48:
        $Message1 = $success;
        $Message2 = "Shipping Charge Updated Successfully !!!<a href='manageshippingcharge.php'> Click Here </a> to go back";
        break;
    case 49:
        $Message1 = $error;
        $Message2 = "This Shipping Charge Added In Auction !!!<a href='manageshippingcharge.php'> Click Here </a> to go back";
        break;
    case 50:
        $Message1 = $success;
        $Message2 = "Email Verification Re-Sent Successfully!!!<a href='manage_members.php'> Click Here </a> to go back";
        break;
    case 51:
        $Message1 = $success;
        $Message2 = "Password Changed Successfully!!!<a href='editaccount.php'> Click Here </a> to go back";
        break;
    case 52:
        $Message1 = $success;
        $Message2 = "Referall Bonus Commission Updated Successfully!!!<a href='managereferralbid.php'> Click Here </a> to go back";
        break;
    case 53:
        $Message1 = $success;
        $Message2 = "Referall Bonus Commission Added Successfully!!!<a href='managereferralbid.php'> Click Here </a> to go back";
        break;
    case 54:
        $Message1 = $success;
        $Message2 = "Paypal Setting Updated Successfully!!!<a href='paypalsetting.php'> Click Here </a> to go back";
        break;
    case 55:
        $Message1 = $error;
        $Message2 = "This Voucher Already Exists!!!<a href='managevoucher.php'> Click Here </a> to go back";
        break;
    case 56:
        $Message1 = $success;
        $Message2 = "Voucher Added Successfully!!!<a href='managevoucher.php'> Click Here </a> to go back";
        break;
    case 57:
        $Message1 = $success;
        $Message2 = "Voucher Updated Successfully!!!<a href='managevoucher.php'> Click Here </a> to go back";
        break;
    case 58:
        $Message1 = $success;
        $Message2 = "Voucher Deleted Successfully!!!<a href='managevoucher.php'> Click Here </a> to go back";
        break;
    case 59:
        $Message1 = $success;
        $Message2 = "Voucher Issued Successfully!!!<a href='voucherissue.php'> Click Here </a> to go back";
        break;
    case 60:
        $Message1 = $success;
        $Message2 = "New User Voucher Set Successfully!!!<a href='voucherissue.php'> Click Here </a> to go back";
        break;
    case 61:
        $Message1 = $success;
        $Message2 = "newsletter Send and Saved Successfully!!!<a href='manageNewsletters.php'> Click Here </a> to go back";
        break;
    case 62:
        $Message1 = $success;
        $Message2 = "newsletter Saved Successfully!!!<a href='manageNewsletters.php'> Click Here </a> to go back";
        break;
    case 63:
        $Message1 = $error;
        $Message2 = "This product have not enough quantity!!!<a href='addauction.php'> Click Here </a> to go back";
        break;
    case 64:
        $Message1 = $success;
        $Message2 = "Commission withdrawal Successfully!!!<a href='manageaffiliatepayment.php'> Click Here </a> to go back";
        break;
    case 65:
        $Message1 = $success;
        $Message2 = "Members News Added Successfully!!!<a href='managemembersnews.php'> Click Here </a> to go back";
        break;
    case 66:
        $Message1 = $success;
        $Message2 = "Members News Exist For This Date!!!<a href='managemembersnews.php'> Click Here </a> to go back";
        break;
    case 67:
        $Message1 = $success;
        $Message2 = "Members News Updated Successfully!!!<a href='managemembersnews.php'> Click Here </a> to go back";
        break;
    case 68:
        $Message1 = $success;
        $Message2 = "Members News Deleted Successfully!!!<a href='managemembersnews.php'> Click Here </a> to go back";
        break;
    case 69:
        $Message1 = $success;
        $Message2 = "Bidding user added successfully!!!<a href='managebiddinguser.php'> Click Here </a> to go back";
        break;
    case 70:
        $Message1 = $error;
        $Message2 = "Username or Email Already Exists!!!<a href='managebiddinguser.php'> Click Here </a> go back";
        break;
    case 71:
        $Message1 = $success;
        $Message2 = "Bidding user information updated successfully!!!<a href='managebiddinguser.php'> Click Here </a> to go back";
        break;
    case 72:
        $Message1 = $success;
        $Message2 = "Bidding user deleted successfully!!!<a href='managebiddinguser.php'> Click Here </a> to go back";
        break;
    case 73:
        $Message1 = $success;
        $Message2 = "Minimum Bid Price Updated Successfully!!!<a href='generalsetting.php'> Click Here </a> to go back";
        break;
    case 74:
        $Message1 = $success;
        $Message2 = "Redemption Added Successfully!!!<a href='manageredemption.php'> Click Here </a> to go back";
        break;
    case 75:
        $Message1 = $success;
        $Message2 = "Redemption Updated Successfully!!!<a href='manageredemption.php'> Click Here </a> to go back";
        break;
    case 76:
        $Message1 = $success;
        $Message2 = "Redemption Deleted Successfully!!!<a href='manageredemption.php'> Click Here </a> to go back";
        break;
    case 77:
        $Message1 = $success;
        $Message2 = "This Product Purchase By User You Can't Delete It!!!<a href='manageredemption.php'> Click Here </a> to go back";
        break;
    case 78:
        $Message1 = $success;
        $Message2 = "Community Added Successfuly!!!<a href='managecommunity.php'> Click Here </a> to go back";
        break;
    case 79:
        $Message1 = $success;
        $Message2 = "Community Update Successfuly!!!<a href='managecommunity.php'> Click Here </a> to go back";
        break;
    case 80:
        $Message1 = $success;
        $Message2 = "Community Delete Successfuly!!!<a href='managecommunity.php'> Click Here </a> to go back";
        break;
    case 81:
        $Message1 = $error;
        $Message2 = "This Community Already Exists!!!<a href='managecommunity.php'> Click Here </a> to go back";
        break;
    case 82:
        $Message1 = $error;
        $Message2 = "This Forum Already Exists!!!<a href='manageforum.php'> Click Here </a> to go back";
        break;
    case 83:
        $Message1 = $success;
        $Message2 = "Forums Added Successfully!!!<a href='manageforum.php'> Click Here </a> to go back";
        break;
    case 84:
        $Message1 = $success;
        $Message2 = "Forum Category Added Successfully!!!<a href='manageforumcategory.php'> Click Here </a> to go back";
        break;
    case 85:
        $Message1 = $success;
        $Message2 = "Forum Category Update Successfully!!!<a href='manageforumcategory.php'> Click Here </a> to go back";
        break;
    case 86:
        $Message1 = $success;
        $Message2 = "Forum Category Delete Successfully!!!<a href='manageforumcategory.php'> Click Here </a> to go back";
        break;
    case 87:
        $Message1 = $success;
        $Message2 = "Forums Updated Successfully!!!<a href='manageforum.php'> Click Here </a> to go back";
        break;
    case 88:
        $Message1 = $success;
        $Message2 = "Forums Deleted Successfully!!!<a href='manageforum.php'> Click Here </a> to go back";
        break;
    case 89:
        $Message1 = $success;
        $Message2 = "Reply Update Successfully!!!<a href='managereply.php'> Click Here </a> to go back";
        break;
    case 90:
        $Message1 = $success;
        $Message2 = "Reply Deleted Successfully!!!<a href='managereply.php'> Click Here </a> to go back";
        break;
    case 91:
        $Message1 = $success;
        $Message2 = "Topic Update Successfully!!!<a href='managetopics.php'> Click Here </a> to go back";
        break;
    case 92:
        $Message1 = $success;
        $Message2 = "Topic Deleted Successfully!!!<a href='managetopics.php'> Click Here </a> to go back";
        break;
    case 93:
        $Message1 = $success;
        $Message2 = "User Verified Successfully!!!<a href='manage_members.php'> Click Here </a> to go back";
        break;
    case 94:
        $Message1 = $success;
        $Message2 = "Login Free Points Setting Updated Successfully!!!<a href='loginfreepoints.php'> Click Here </a> to go back";
        break;
    case 95:
        $Message1 = $success;
        $Message2 = "Rating Free Points Setting Updated Successfully!!!<a href='loginfreepoints.php'> Click Here </a> to go back";
        break;
    case 96:
        $Message1 = $success;
        $Message2 = "Welcome Bid Points Setting Updated Successfully!!!<a href='regfreepoints.php'> Click Here </a> to go back";
        break;
    case 97:
        $Message1 = $error;
        $Message2 = "This Coupon Title Already Exists!!!<a href='managecoupon.php'> Click Here </a> to go back";
        break;
    case 98:
        $Message1 = $success;
        $Message2 = "Coupon Added Successfully!!!<a href='managecoupon.php'> Click Here </a> to go back";
        break;
    case 99:
        $Message1 = $error;
        $Message2 = "Edit Error, The Coupon is not Exists!!!<a href='managecoupon.php'> Click Here </a> to go back";
        break;
    case 100:
        $Message1 = $error;
        $Message2 = "Edit error, The Coupon was assigned!!!<a href='managecoupon.php'> Click Here </a> to go back";
        break;
    case 101:
        $Message1 = $success;
        $Message2 = "Coupon Deleted Successfully!!!<a href='managecoupon.php'> Click Here </a> to go back";
        break;
    case 102:
        $Message1 = $success;
        $Message2 = "Assign Coupon Failed!!!<a href='managecoupon.php'> Click Here </a> to go back";
        break;
    case 103:
        $Message1 = $success;
        $Message2 = "Assign Coupon Successfully!!!<a href='managecoupon.php'> Click Here </a> to go back";
        break;
    case 104:
        $Message1 = $success;
        $Message2 = "Cancel Assign Coupon Successfully!!!<a href='managecoupon.php'> Click Here </a> to go back";
        break;
    case 105:
        $Message1 = $success;
        $Message2 = "Cancel Assign Coupon Failed!!!<a href='managecoupon.php'> Click Here </a> to go back";
        break;
    case 106:
        $Message1 = $success;
        $Message2 = "Assign Coupon To Member Failed!!!<a href='manage_members.php'> Click Here </a> to go back";
        break;
    case 107:
        $Message1 = $success;
        $Message2 = "Assign Coupon To Member Successfully!!!<a href='manage_members.php'> Click Here </a> to go back";
        break;
    case 108:
        $Message1 = $success;
        $Message2 = "Change Site Settings Successfully!!!<a href='sitesetting.php'> Click Here </a> to go back";
        break;

    case 109:
        $Message1 = $success;
        $Message2 = "Add AutoBidder Successfully!!!<a href='manageautobidder.php'> Click Here </a> to go back";
        break;

    case 110:
        $Message1 = $success;
        $Message2 = "Add Advertise Group Successfully!!!<a href='manageadvertgroup.php'> Click Here </a> to go back";
        break;

    case 111:
        $Message1 = $success;
        $Message2 = "Edit Advertise Group Successfully!!!<a href='manageadvertgroup.php'> Click Here </a> to go back";
        break;

    case 112:
        $Message1 = $error;
        $Message2 = "This Advertise Group is not empty!!!<a href='manageadvertgroup.php'> Click Here </a> to go back";
        break;
    case 113:
        $Message1 = $success;
        $Message2 = "Advertise Group Deleted Successfully!!!<a href='manageadvertgroup.php'> Click Here </a> to go back";
        break;
    case 114:
        $Message1 = $success;
        $Message2 = "Edit Email Template Successfully!!!<a href='emailtemplateeditor.php?name={$_GET['name']}> Click Here </a> to go back";
        break;

    case 115:
        $Message1 = $success;
        $Message2 = "Plugin General Settings Successfully!!!<a href='plugingeneral.php'> Click Here </a> to go back";
        break;

    case 116:
        $Message1 = $success;
        $Message2 = "OpenInviter Setting is saved Successfully!!!<a href='invitersetting.php'> Click Here </a> to go back";
        break;

    case 117:
        $Message1 = $success;
        $Message2 = "Social is saved Successfully!!!<a href='managesocial.php'> Click Here </a> to go back";
        break;

    case 118:
        $Message1 = $success;
        $Message2 = "Delete Social Successfully!!!<a href='managesocial.php'> Click Here </a> to go back";
        break;

     case 119:
        $Message1 = $success;
        $Message2 = "Language Setting is saved Successfully!!!<a href='languagesetting.php'> Click Here </a> to go back";
        break;
     case 'refer':
        $Message1 = $success;
        $Message2 = "Referrall points are saved Successfully!!!<a href='managereferralbid.php'> Click Here </a> to go back";
        break;
     case 'badadmin':
        $Message1 = "You Are Not Allowed to Perform This Action";
        $Message2 = "You do not have permission to use this page!!!";
        break;
     case 'added_level':
        $Message1 = $success;
        $Message2 = "User Levels are saved Successfully!!!<a href='edit_user_levels.php'> Click Here </a> to go back";
        break;
 
        
}

}
?>


            <!--[if !IE]>start content<![endif]-->
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">


                    <div style="margin:100px auto;width:50%;">
                        <ul class="system_messages">
                            <li class="blue"><span class="ico"></span>
                                <strong style="text-align:center;" class="system_title">
                                    <?=$Message1;?><br/>
                                    <?=$Message2;?>
                                </strong></li>
                        </ul>
                    </div>


                </div>

            </div>
            <!--[if !IE]>end content<![endif]-->

        
