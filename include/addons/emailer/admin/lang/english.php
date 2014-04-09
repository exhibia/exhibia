<?php
/*
 * english.php
 *
 * Description:	 W3MAIL - Language File.
 * Developed by: Alexander Djourik <sasha@iszf.irk.ru>
 *		 Anton Gorbunov <anton@iszf.irk.ru>
 *		 Pavel Zhilin <pzh@iszf.irk.ru>
 *
 * Copyright (c) 2002,2003,2004,2005 Alexander Djourik. All rights reserved.
 *
 * Initially based on code from 6XMailer - A PHP POP3 mail reader,
 * Copyright 2001 6XGate Systems, Inc. All rights reserved.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License.
 *
 * Please see the file LICENSE in this directory for full copyright
 * information.
 *
 */

// Titles
// -----------------------------------
// The titles used for the mail pages.

$TITLE_System = "Mail System";
$TITLE_SystemName = "W3MAIL SYSTEM";
$TITLE_Login = "Login";
$TITLE_Interface = "Interface";
$TITLE_Compose = "Sending a Message";
$TITLE_Settings = "User Settings";
$TITLE_Help = "Help";
$TITLE_About = "About";
$TITLE_Addresses = "Address Book";

// Login Prompt Texts
// ----------------------------------------------------------
// These are used to label the login forms and message boxes.

$PROMPT_Username = "Username:";
$PROMPT_Password = "Password:";
$PROMPT_Language = "Language:";

// Buttons
// ---------------------------------------
// These are used to label varius buttons.

$BUTTON_OK = "OK";
$BUTTON_Cancel = "Cancel";
$BUTTON_Login = "Sign In";
$BUTTON_About = "About...";
$BUTTON_Reply = "Reply";
$BUTTON_Forward = "Forward";
$BUTTON_Redirect = "Redirect";
$BUTTON_Delete = "Delete";
$BUTTON_Headers = "Headers";
$BUTTON_Attachments = "Attachments";
$BUTTON_Yes = "Yes";
$BUTTON_No = "No";
$BUTTON_Send = "Send Mail";
$BUTTON_Edit = "Edit";
$BUTTON_ContactAdd = "Add a New Contact";
$BUTTON_ContactSave = "Save Contact";
$BUTTON_SendTo = "Send To";
$BUTTON_Settings = "User Settings";
$BUTTON_SettingsSave = "Save Settings";

// Icons
// -------------------------------
// These are labels for the icons.

$ICON_Compose = "Compose";
$ICON_Inbox = "Inbox";
$ICON_Sent = "Sent";
$ICON_Delete = "Delete";
$ICON_Addresses = "Addresses";
$ICON_Settings = "Settings";
$ICON_Help = "Help";
$ICON_Logoff = "Logoff";

// Headers
// ---------------------------------------------------------
// These are message, frame, e-mail forms, and list headers.

$HEAD_To = "To";
$HEAD_From = "From";
$HEAD_Subject = "Subject";
$HEAD_Recieved = "Received";
$HEAD_Sent = "Sent";
$HEAD_Attachment = "Attachment";
$HEAD_Name = "Name";
$HEAD_EMail = "E-Mail";
$HEAD_Info = "Additional Info";
$HEAD_Actions = "Actions";
$HEAD_DisName = "Display Name";
$HEAD_Signature = "Signature";
$HEAD_Error = "Error:";

// Status Bar
// ------------------------------------------------------------------
// These are text displayed on the browsers status bar when the mouse
// rolls over a button or link

$STATBAR_Reply = "Reply to this message";
$STATBAR_Forward = "Forward this message to someone";
$STATBAR_Redirect = "Redirect this message to someone";
$STATBAR_Headers = "Show this message headers";
$STATBAR_Attachments = "List this messages attachments";
$STATBAR_ComposeMessage = "Send a new message";
$STATBAR_DeleteMessage = "Delete selected messages";
$STATBAR_Inbox = "Show or refresh the inbox folder";
$STATBAR_Sent = "Show the sent folder";
$STATBAR_AddressBook = "Display the addresss book";
$STATBAR_About = "Display information about this program";
$STATBAR_SendTo = "Send an e-mail to this person";
$STATBAR_AddAddress = "Add a new person";
$STATBAR_EditAddress = "Edit this persons information";
$STATBAR_DeleteAddress = "Delete this person";
$STATBAR_Send = "Send this message";
$STATBAR_Settings = "Change your settings";
$STATBAR_Link = "Open link in new window";
$STATBAR_Logoff = "Close the session";

// Error Message
// --------------------------------------------------------------
// These are error messages displayed in case of a malfunction of
// user mistake.

$ERROR_Title = "Error";
$ERROR_AtLogin = "Login Error";
$ERROR_Auth = "Authentification failed.";
$ERROR_NoSession = "Session expired or no session. Please do login.";
$ERROR_SessionErr = "Session Error";
$ERROR_SQLErr = "SQL Error";
$ERROR_AddUser = "Error adding new user.";
$ERROR_SQLGetData = "Could not retrieve the data.";
$ERROR_SQLConnect = "Could not connect to SQL server.";
$ERROR_SQLSave = "Could not save the data.";
$ERROR_SQLUpdate = "Could not update the data.";
$ERROR_SQLDelete = "Could not remove the data.";
$ERROR_FileTooBig = "The file attachment you tries to send was too big for this mailer.";
$ERROR_NoFile = "The file attachment you tries to send was not accepted by the server.";
$ERROR_NoEMail = "You must include an email address.";
$ERROR_NoMessage = "You must include a message to post.";
$ERROR_EmailChars = "Email address contains invalid characters:";
$ERROR_EmailStruct = "Email address seems incorrect:";
$ERROR_Send = "Could not send this message.";

// Misc
// -------------------------------
// Other sets of important labels.

$MISC_SideNote = "NOTE";
$MISC_AddressBook = "from Address Book";
$MISC_NoMessage = "No new messages available.";
$MISC_Sent = "Message was sent to the SMTP server...";
$MISC_BackToMsg = "Return to your message";
$MISC_DemoWarning = "<b>NOTE:</b> This mailer is in demo mode and will not send any mail, only check mail.  The address book and per-user settings features are also disabled in this mode.";
$MISC_Entries = "Number of entries";
$MISC_AskDelete = "Are you sure you wish to delete selected messages?";
$MISC_Contact_AskDelete = "Are you sure you want to delete this entry?";
$MISC_Select = "No messages selected!";
$MISC_NoEmail = "Please enter an email address.";
$MISC_Settings = "Settings Saved.";
$MISC_Quote = "---- Original Message ----";

// Help Items
// -------------------------------

$HELP_Item[0] = 'About this program';
$HELP_Text[0] = 'This web-based mail reader in its current form is developed by: Alexander Djourik <a href="mailto:adju@iszf.irk.ru">adju@iszf.irk.ru</a> Pavel Zhilin <a href="mailto:pzh@iszf.irk.ru">pzh@iszf.irk.ru</a> and Anton Gorbunov <a href="mailto:anton@iszf.irk.ru">anton@iszf.irk.ru</a>. W3mail project is based on code and ideas from 6XMail web-based mail reader from 6XGate Systems, Inc. This program is powered by PHP 4. Graphics were borrowed from various programs. For more information please visit the project homepage: <a target="_blank" href="http://w3mail.sourceforge.net">w3mail.sourceforge.net</a>.';

$HELP_Item[1] = 'Checking for new mail, and refreshing the mail list';
$HELP_Text[1] = 'You can bring up or refresh the inbox to check for new mail by clicking on the <b>Inbox</b> icon in the <b>Folders List</b> or by clicking on the <b>Check Mail</b> icon on the <b>Toolbar</b>.';

$HELP_Item[2] = 'View a message';
$HELP_Text[2] = 'Simply click on the message you wish to view in the <b>Mail List</b>.';

$HELP_Item[3] = 'Listing and downloading attachments';
$HELP_Text[3] = 'Click on the message you wish to get an attachment from in the <b>Mail List</b>. When the message appears, then click on the <b>Attachments</b> button on the <b>Action Bar</b> if it appears. Then a list of attachments will appear in the message area. Simplely click on the attachment you wish to download.';

$HELP_Item[4] = 'Reply to a message';
$HELP_Text[4] = 'Click on the message you wish to reply to in the <b>Mail List</b>. When the message appears, then click on the <b>Reply</b> button on the <b>Action Bar</b>. When the compose message form appears, it will have the <b>To:</b> and <b>Subject:</b> fields filled out. Just click on the message body area and type in your message before the original message.';

$HELP_Item[5] = 'Forward a message';
$HELP_Text[5] = 'Click on the message you wish to forward in the <b>Mail List</b>. When the message appears, then click on the <b>Forward</b> button on the <b>Action Bar</b>. When the compose message form appears, it will have the <b>From:</b> and <b>Subject:</b> fields filled out. Just click <b>To:</b> feild and fill it in as well as the message body area and type in your message before the original message.';

$HELP_Item[6] = 'Redirect a message';
$HELP_Text[6] = 'Click on the message you wish to redirect to in the <b>Mail List</b>. When the message appears, then click on the <b>Redirect</b> button on the <b>Action Bar</b>.';

$HELP_Item[7] = 'Delete a message';
$HELP_Text[7] = 'Click on the message you wish to delete to in the <b>Mail List</b>. When the message appears, then click on the <b>Delete</b> button on the <b>Action Bar</b>.';

$HELP_Item[8] = 'View the RFC-822 headers of a message';
$HELP_Text[8] = 'Click on the message you wish to view the RFC-822 headers of in the <b>Mail List</b>. When the message appears, then click on the <b>View Headers</b> button on the <b>Action Bar</b>. The messages headers will appear below the <b>Action Bar</b>.';

$HELP_Item[9] = 'Logoff';
$HELP_Text[9] = 'You can logoff clicking on the <b>Logoff</b> icon in the <b>Folder List</b>.';
?>