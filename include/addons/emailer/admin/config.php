<?php
ini_set('display_errors', 1);
include("../../../../../config/config.inc.php");
$EMail = $adminemailadd;
// ===========================================================================
// W3MAIL Configuation Script/File
// All settings concerning the mailer should be set here and not by modifying
// the scripts themselves.
// ===========================================================================

// Language
// ---------------------------------------------------------------------------
// This helps to determine the default language strings to use
$Language = "english";

// Server information
// ---------------------------------------------------------------------------
$IMAPHostname = 'mail.' . $_SERVER['SERVER_NAME'];         // Server's hostname (or IP address)
$IMAPPort = "143";                   // Port to connect to the server
$IMAPFlags = "";    // IMAP optional connect flags
$SMTPDomain = $_SERVER['SERVER_NAME'];      // Domain part of e-mail addresses
$DEFCharset = "utf-8";               // System default charset
$SENTFolder = "/var/spool/webmail";  // Sent folders location

// Frame sizes
// ---------------------------------------------------------------------------
$FolderListWidth = 80;       // The width of the folder icon area (folder.php)
$DefaultPreviewSize = "90%"; // The height of the message list (list.php)
$LineSize = 23;              // The default line size (header.php,send.php)
$ActionsSize = 33;           // The height of the actoin bar (header.php)

// Refresh time
// ---------------------------------------------------------------------------
// The number of seconds for the list page to wait before automaticly
// refreshing itself. The default is 10 minutes (600 seconds).
$RefreshList = "600";

// File Attachments Size Limit
// ---------------------------------------------------------------------------
// This lets the administrator limit the size of the files that can
// be attached to mail.  If this size ends in a "M", or "k" then the
// the size will be based on a Megabyte or kilobyte.  If no ending
// exists then the size is in bytes.  The ending is case insensitive.
// No setting or a setting of 0 with any ending means no limit.
$AttachmentSize = "8M";

// Database Information
// ---------------------------------------------------------------------------
// These settings contain information on the database name and stuff.
// SQLHostname default settings for PostgreSQL: 'localhost:5432';
// for MySQL: 'localhost:3306' or ':/var/run/mysql/mysql.sock'
$SQLHostname = 'localhost';
$SQLUsername = $USERNAME;
$SQLPassword = $PASSWORD;
$SQLDatabase = $DATABASENAME . "_email_prefs";
$SQLDriver = 'mysql';
$_SESSION['Username'] = 'support';

?>
