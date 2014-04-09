<?php

include("../../config/config.inc.php");
$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
if (!$db) {
    die('Could not connect: ' . db_error());
}

db_select_db($DATABASENAME, $db);


   $sql = "select * from sitesetting where name='defaultlanguage';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            $lang = $obj->value;
        } else {
            $lang = "english";
        }
   $sql = "select * from sitesetting where name='adminemail';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            $email = $obj->value;
        }
        
if (!defined('CTXTRA'))
		die ('Hacking attempt...');

/* general configuration */
$ct_db_user							= $USERNAME;
$ct_db_pass							= $PASSWORD;
$ct_email								= $email;
$ct_atack_email						= 'no';
$ct_lang								= $lang;
$ct_htaccess							= 'no';
$ct_htaccess_error					= 'yes';
$ct_ref_loggen						= 'no';
$ct_auto_iplist						= 'yes';
$ct_auto_spamlist						= 'no';
$ct_bbc_spam							= 'no';
$ct_iploggen_spam						= 'no';
$ct_spamprotector1					= 'no';
$ct_spamprotector						= '';
$ct_spam_protector_submit_other		= @'';
$ct_spam_protector_content_other		= @'';
$ct_spam_protector_submit_other_print	= '';
$ct_spam_protector_content_other_print= '';

/* path configuration */
$ct_borddir	= $SITE_URL . 'include/addons/ctracker';
$ct_filedir 	= getcwd();

/* module width in pixel */
$ct_block_space = 8;

/* Footer Theme */
$ct_footer_theme = 7;

?>