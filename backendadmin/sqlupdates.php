<?php


db_query("CREATE TABLE IF NOT EXISTS `user_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_level` varchar(50) NOT NULL DEFAULT '0',
  `allowed_pages` longblob,
  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;");
@db_query("alter table user_levels add column addons longblob");
if(db_num_rows(db_query("select * from user_levels")) == 0){

$this_dir = getcwd();
$master_directory = str_replace("/backendadmin", "", $this_dir);

    db_query("insert into user_levels values(null, 'admin', 'insert into user_levels (id, admin_level, pages) values(null, 'admin', '$this_dir/manageauctiontime.php,$this_dir/manageNewsletters.php,$this_dir/set_and_forget.php,$this_dir/assigncoupontouser.php,$this_dir/managereferralbid.php,$this_dir/templates.sql.php,$this_dir/managecommunity.php,$this_dir/config_setting.php,$this_dir/innerstore.php,$this_dir/edit_member.php,$this_dir/main.css,$this_dir/defaultdatabase.php,$this_dir/designsuite.php,$this_dir/headlinks.txt.php,$this_dir/managenews.php,$this_dir/order_report_print.php,$this_dir/managetax.php,$this_dir/manage_members.php,$this_dir/specialauction.php,$this_dir/sendmail.php,$this_dir/inneraccount.php,$this_dir/perhourreport.php,$this_dir/addauction.php,$this_dir/view_member_status.php,$this_dir/admincreditreport.php,$this_dir/addshippingcharge.php,$this_dir/addlanguage.php,$this_dir/endauction.php,$this_dir/forum.txt.php,$this_dir/productdetail.php,$this_dir/unsoldauction.php,$this_dir/
paypalsetting.php,$this_dir/managebuynow.php,$this_dir/confirmpayment.php,$this_dir/soldauction.php,$this_dir/registrationreport.php,$this_dir/banipaddress.php,$this_dir/config.inc.php,$this_dir/sitesetting.php,$this_dir/addhelptopic.php,$this_dir/view_member_statistics.php,$this_dir/redemptiondetails.php,$this_dir/editaccount.php,$this_dir/addadvertslide.php,$this_dir/changeauctiontime.php,$this_dir/session.php,$this_dir/addFAQ.php,$this_dir/manageredemption.php,$this_dir/order_buyitnow.php,$this_dir/finincialreport.php,$this_dir/example2csv.php,$this_dir/system.php,$this_dir/addcommunity.php,$this_dir/ioncube_encoder5,$this_dir/managehelptopic.php,$this_dir/useraddress.php,$this_dir/forumtopicedit.php,$this_dir/addbidpack.php,$this_dir/addauctiontime.php,$this_dir/addbiddinguser.php,$this_dir/regfreepoints.php,$this_dir/innerpayment.php,$this_dir/forumreplyedit.php,$this_dir/example_advanced.css,$this_dir/managevoucher.php,$this_dir/addcoupon_excel.php,$this_dir/logo.php,$this_dir/addforumcat.php,$this_dir/
rte.css,$this_dir/store.txt.php,$this_dir/addmembers.php,$this_dir/addvoucher.php,$this_dir/static.txt.php,$this_dir/style.css,$this_dir/menu.css,$this_dir/report.txt.php,$this_dir/ioncube_encoder53,$this_dir/voucherissue.php,$this_dir/bidderuseravatar.php,$this_dir/managebiddinguser.php,$this_dir/leftstore.php,$this_dir/autolister.enc.php,$this_dir/leftreport.php,$this_dir/manageautobidder.php,$this_dir/background.php,$this_dir/exportcsvcount.php,$this_dir/ajaxauction.php,$this_dir/process_background.php,$this_dir/leftstatic.php,$this_dir/manageadvertposition.php,$this_dir/pauseauction.php,$this_dir/addshippingstatus.php,$this_dir/leftside.php,$this_dir/users.txt.php,$this_dir/message.php,$this_dir/addcoupon.php,$this_dir/editor.js,$this_dir/defaultreport.php,$this_dir/manageFAQ.php,$this_dir/loginfreepoints.php,$this_dir/get_help.php,$this_dir/plugingeneral.php,$this_dir/design.txt.php,$this_dir/liveauctionreport.php,$this_dir/addforum.php,$this_dir/buynowsetting.php,$this_dir/page_headers.php,$this_dir/
defaultstatic.php,$this_dir/defaultforum.php,$this_dir/managereply.php,$this_dir/add_product.php,$this_dir/listuniversalcoupon.php,$this_dir/addredemption.php,$this_dir/examplecsv.php,$this_dir/process_logo.php,$this_dir/innerhome.php,$this_dir/download.php,$this_dir/defaultaccount.php,$this_dir/emailtemplateeditor.php,$this_dir/manageshippingtype.php,$this_dir/ipaddresshistory.php,$this_dir/member_stats.php,$this_dir/manageauctionpause.php,$this_dir/admin.config.inc.php,$this_dir/plugin.txt.php,$this_dir/innerdatabase.php,$this_dir/innerusers.php,$this_dir/addcategory.php,$this_dir/menu.js,$this_dir/pandl.php,$this_dir/pages.php,$this_dir/viewaffiliaterefferal.php,$this_dir/peddingorder.php,$this_dir/addavatar.php,$this_dir/defaultstore.php,$this_dir/managecoupon.php,$this_dir/function.js,$this_dir/autolister.php,$this_dir/framehead.php,$this_dir/addbonusbid.php,$this_dir/logout.php,$this_dir/managesocial.php,$this_dir/functions_s.php,$this_dir/addnews.php,$this_dir/html2xhtml.js,$this_dir/payment.txt.php,
$this_dir/main1.css,$this_dir/ratingfreepoints.php,$this_dir/innerforum.php,$this_dir/manageaffiliatepayment.php,$this_dir/account.txt.php,$this_dir/richtext.js,$this_dir/auctiondetails.php,$this_dir/reverse_registrationreport.php,$this_dir/addmembersnews.php,$this_dir/customizelanguage.php,$this_dir/manageadvertslide.php,$this_dir/languagesetting.php,$this_dir/error_log,$this_dir/validation.js,$this_dir/managespecial.php,$this_dir/getproductlist.php,$this_dir/gd.inc.php,$this_dir/getprice.php,$this_dir/curl.php,$this_dir/referralwonauctionreport.php,$this_dir/imgsize.php,$this_dir/video-help.png,$this_dir/defaulthome.php,$this_dir/export.csv,$this_dir/assigncoupon.php,$this_dir/makepayment.php,$this_dir/getcategorylist.php,$this_dir/addautobidder.php,$this_dir/inneremail.php,$this_dir/addshippingtype.php,$this_dir/affiliatereport.php,$this_dir/staticpages.php,$this_dir/auctionwisereport.php,$this_dir/innerplugin.php,$this_dir/manageforumcategory.php,$this_dir/password.php,$this_dir/generalsetting.php,$this_
dir/uploader.php,$this_dir/main.js,$this_dir/addspecial.php,$this_dir/autocredits.php,$this_dir/header.php,$this_dir/database_commands.sql,$this_dir/addsocial.php,$this_dir/edit_product.php,$this_dir/newsletter.php,$this_dir/order_wonauction.php,$this_dir/managebidpack.php,$this_dir/database.txt.php,$this_dir/edit_user_levels.php,$this_dir/invitersetting.php,$this_dir/getUserList.php,$this_dir/leftforum.php,$this_dir/manageforum.php,$this_dir/usercoupon.php,$this_dir/addproducts.php,$this_dir/leftaccount.php,$this_dir/manageproducts.php,$this_dir/innerreport.php,$this_dir/managescharge.php,$this_dir/leftdatabase.php,$this_dir/onlineuser.php,$this_dir/userdetail.php,$this_dir/addadvertgroup.php,$this_dir/manageavatar.php,$this_dir/delproducts.php,$this_dir/functions.php,$this_dir/security.php,$this_dir/managetopics.php,$this_dir/innerstatic.php,$this_dir/manageadvertgroup.php,$this_dir/process_addlanguage.php,$this_dir/email.txt.php,$this_dir/addauction2.php,$this_dir/body.js,$this_dir/managecat.php,$this_dir/
productwisereport.php,$this_dir/managemembersnews.php,$this_dir/connect.php,$this_dir/admin.cookie.php,$this_dir/manageauction.php,$this_dir/index.php,$this_dir/manageshippingcharge.php,$this_dir/popupimage.js,$this_dir/printingoutput.php,$this_dir/message.php,$this_dir/index.php,$this_dir/innerhome.php');");
    db_query("insert into user_levels values(null, 'designer', '');");
    db_query("insert into user_levels values(null, 'auctioneer', '$this_dir/innerstore.php,$this_dir/addauction.php,$this_dir/manageauction.php,$this_dir/soldauction.php,$this_dir/unsoldauction.php,$this_dir/managebuynow.php,,$this_dir/message.php,$this_dir/index.php,$this_dir/innerhome.php');");



}
$r=db_num_rows(db_query("SHOW columns from 'shipping' where field='shippingtypeid'"));
if ($r==0){

@db_query("alter table shipping add column shippingtypeid int(11) not null default '7';");

//db_query("delete from shipping");



}


