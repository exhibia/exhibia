<?php
/*
 * functions.php
 *
 * Description:	 W3MAIL - A PHP IMAP mail reader.
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

// Functions
// ---------

function get_lang_list() {
    global $langs;

    $langs_count = 0;
    if ($dh = @opendir("lang")) {
        while (($file = readdir($dh)) !== false) {
	    if (!is_dir("lang/$file")) {
		$file = preg_replace("'\.php'", '', $file);
		$langs[$langs_count] = $file;
		$langs_count++;
	    }
	}
	closedir($dh);
    }

    return $langs_count;
}

function self_entitles($str) {
    $search = array (
	"[\x82]","[\x83]","[\x84]","[\x85]","[\x86]","[\x87]","[\x88]","[\x89]","[\x8A]",
	"[\x8B]","[\x8C]","[\x91]","[\x92]","[\x93]","[\x94]","[\x95]","[\x96]","[\x97]",
	"[\x98]","[\x99]","[\x9A]","[\x9B]","[\x9C]","[\x9F]","[\xA0]","[\xA1]","[\xA2]",
	"[\xA3]","[\xA4]","[\xA5]","[\xA6]","[\xA7]","[\xA8]","[\xA9]","[\xAA]","[\xAB]",
	"[\xAC]","[\xAD]","[\xAE]","[\xAF]","[\xB0]","[\xB1]","[\xB2]","[\xB3]","[\xB6]",
	"[\xB7]","[\xB8]","[\xB9]","[\xBA]","[\xBB]","[\xBC]","[\xBD]","[\xBE]","[\xBF]");
    $replace = array (
	"&#130;","&#131;","&#132;","&#133;","&#134;","&#135;","&#136;","&#137;","&#138;",
	"&#139;","&#140;","&#145;","&#146;","&#147;","&#148;","&#149;","&#150;","&#151;",
	"&#152;","&#153;","&#154;","&#155;","&#156;","&#159;","&#160;","&#161;","&#162;",
	"&#163;","&#164;","&#165;","&#166;","&#167;","&#168;","&#169;","&#170;","&#171;",
	"&#172;","&#173;","&#174;","&#175;","&#176;","&#177;","&#178;","&#179;","&#182;",
	"&#183;","&#184;","&#185;","&#186;","&#187;","&#188;","&#189;","&#190;","&#191;");
    $str = preg_replace ($search, $replace, $str);
    return $str;
}

function header_encode($value, $charset) {
    if ($value)
	return "=?" . $charset . "?B?" . base64_encode($value) . "?=";
    return "";
}

function text_convert ($text, $charset) {
    global $DEFCharset;

    if ($charset) {
	$text = iconv($charset, $DEFCharset, $text);
	if ($text) return ($text);
    }

    return ($text);
}

function header_decode($value, $charset) {
    $text = "";

    if ($value) {
	$rawvalue = imap_mime_header_decode($value);
	for ($i=0; $i<count($rawvalue); $i++) {
	    if ($rawvalue[$i]->charset != 'default')
		$text .= text_convert($rawvalue[$i]->text, $rawvalue[$i]->charset);
	    else $text .= text_convert($rawvalue[$i]->text, $charset);
	}
    }

    return ($text);
}

function echo_info ($info) {
    echo "<html><head><title></title>\n";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/main.css\"></head>\n";
    echo "<body><table class=\"header\"><tr><td>$info</td></tr></table></body></html>\n";
    exit ();
}

function echo_error ($title, $error) {
    echo "<html><head><title>$title</title>\n";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/main.css\"></head>\n";
    echo "<body><table class=\"header\"><tr><th align=\"left\"><h1>$title</h1></th></tr><tr><td>$error</td></tr></table></body></html>\n";
    exit ();
}

function html2html($text, $msgnum) {
    global $STATBAR_Link, $STATBAR_SendTo;

    $remove = array (
	"'<(meta|base)[^>]*>'si",
	"'<frame[^>]*>.*?</frame[^>]*>'si",
	"'<iframe[^>]*>.*?</iframe[^>]*>'si",
	"'<script[^>]*>.*?</script[^>]*>'si",
	"'<object[^>]*>.*?</object[^>]*>'si",
	"'<embed[^>]*>.*?</embed[^>]*>'si",
	"'<applet[^>]*>.*?</applet[^>]*>'si");

    $text = preg_replace($remove, '', $text);

    $text = preg_replace("'href=\"mailto:([^\"]+)([^>]*)'i",	// double quoted
	'target="Message" title="'.$STATBAR_SendTo.'" href="send.php?to=\1"', $text);
    $text = preg_replace("'href=\'mailto:([^\']+)([^>]*)'i",	// single quoted
	'target="Message" title="'.$STATBAR_SendTo.'" href="send.php?to=\1"', $text);
    $text = preg_replace("'href=mailto:([^\s>]+)([^>]*)'i",	// unquoted
	'target="Message" title="'.$STATBAR_SendTo.'" href="send.php?to=\1"', $text);

    $text = preg_replace("'href=\"(http|https|ftp)://([^\"]+)([^>]*)'i",// double quoted
	'target="_blank" title="'.$STATBAR_Link.'" href="\1://\2"', $text);
    $text = preg_replace("'href=\'(http|https|ftp)://([^\']+)([^>]*)'i",// single quoted
	'target="_blank" title="'.$STATBAR_Link.'" href="\1://\2"', $text);
    $text = preg_replace("'href=(http|https|ftp)://([^\s>]+)([^>]*)'i",	// unquoted
	'target="_blank" title="'.$STATBAR_Link.'" href="\1://\2"', $text);

    // Replace all src="cid:***" with a php script that will retreive the data
    $text = preg_replace("'(src|background)=[\"\']?cid:([^\s\"\'>]+)'i",
	'\1="getpartbyid.php?msg='.$msgnum.'&cid=\2"', $text);

    return ($text);
}

function unhtmlentities ($text) {
    $search = array (
	"'&(quot|#34);'i",
	"'&(amp|#38);'i",
	"'&(lt|#60);'i",
	"'&(gt|#62);'i",
	"'&(nbsp|#160);'i");

    $replace = array ('"','&','<','>',' ');
    $text = preg_replace ($search, $replace, $text);

    $trans_table = get_html_translation_table(HTML_ENTITIES);
    $trans_table['å'] = '&#179;';
    $trans_table['Å'] = '&#184;';
    $trans_table = array_flip($trans_table);
    $text = strtr($text, $trans_table);

    // remove unknown entitles
    $text = preg_replace ("'&#[0-9]{3};'", '', $text);

    return ($text);
}

function html2text($text) {
    $text = unhtmlentities ($text);

    $search = array (
	"'[[:cntrl:][:space:]]'",		// Prepare html
	"'<frame[^>]*>.*?</frame[^>]*>'si",
	"'<comment[^>]*>.*?</comment[^>]*>'si",
	"'<script[^>]*>.*?</script[^>]*>'si",
	"'<object[^>]*>.*?</object[^>]*>'si",
	"'<embed[^>]*>.*?</embed[^>]*>'si",
	"'<applet[^>]*>.*?</applet[^>]*>'si",
	"'<style[^>]*>.*?</style[^>]*>'si",
	"'<head[^>]*>.*?</head[^>]*>'si",
	"'<(br|p|h\d|div|tr)[^>]*>'si",	// Convert breakes
	"'<(th|td|span)[^>]*>'si",		// Restore spaces
	"'<(li|option)[^>]*?>'si",		// Restore lists
	"'<[\/\!]*?[^<>]*?>'si",		// Strip out html tags
	"'\n+[ ]+'s",			// Strip out white space
	"'[ ]+'s");

    $replace = array (
	' ','','','','','','','','',"\n",
	' ',"\n- ",'',"\n",' ');

    $text = preg_replace ($search, $replace, $text);

    // Convert obscene number of breaks to doublebreak
    $text = ereg_replace("[\n]{3,}", "\n\n", $text);

    // Trim breaks
    $text = trim($text)."\n";

    return ($text);
}

function text2html($text) {
    global $STATBAR_Link, $STATBAR_SendTo;

    $text = wordwrap(htmlspecialchars ($text), 80, "\n");
    $text = preg_replace("'([^\w\d])(mailto:)?([\w&_\.-]+)@([\w_\.-]+)'i",
	'\1<a target="Message" title="'.$STATBAR_SendTo.'" href="send.php?to=\3@\4">\3@\4</a>', $text);
    $text = preg_replace("'([^\w\d])(http|https|ftp)://([\w/=?%#&_\.-]+)'i",
	'\1<a target="_blank" title="'.$STATBAR_Link.'" href="\2://\3">\2://\3</a>', $text);
    $text = preg_replace("'([^/])(www\.)([\w/=?%#&_\.-]+)'i",
	'\1<a target="_blank" title="'.$STATBAR_Link.'" href="http://\2\3">\2\3</a>', $text);

    return ($text);
}

function get_encoding (&$structure) {
    $encode_types = array ("7bit", "8bit", "binary", "base64", "quoted-printable", "none");
    return $encode_types[(int) $structure->encoding];
}

function uudecode($code) {
    $b64chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
    if (eregi ("^begin ([0-7]{3}) ([^\n]+)\n(.*)end$", trim($code), $regs)) {
	$code = preg_replace("/^./m","",$regs[3]);
	$code = preg_replace("/[\n\r]{1,2}/m","",$code);
	for ($i = 0; $i < strlen($code); $i++) {
	    if ($code[$i] == '`') $code[$i] = ' ';
	    $code[$i] = $b64chars[ord($code[$i])-32];
	}
	while (strlen($code) % 4) $code .= "=";
	return base64_decode($code);
    }
    return $code;
}

function mimetype ($mime) {
    switch ($mime) {
    case TYPEVIDEO:		return "video"; break;
    case TYPEIMAGE:		return "image"; break;
    case TYPEAUDIO:		return "audio"; break;
    case TYPEAPPLICATION:	return "application"; break;
    case TYPEMESSAGE:		return "message"; break;
    case TYPETEXT:
    default:			return "text"; break;
    }
}

function full_mime_type (&$structure, $delim){
    $full_type = mimetype($structure->type);
    if ($structure->ifsubtype)
	$full_type .= $delim . strtolower($structure->subtype);
    return $full_type;
}

function num_attach ($stream, $msg_number) {
    $structure = imap_fetchstructure($stream, $msg_number);
    return sizeof($structure->parts);
}

function get_part (&$stream, &$msg_number, $mime_type, $structure = false, $part_number = false) {
    if (!$structure) $structure = imap_fetchstructure($stream, $msg_number); 
    if ($structure) {
	$data_type = full_mime_type($structure, "/");
	if ($mime_type == $data_type) {
	    if (!$part_number) $part_number = "1";
	    if ($structure->ifdisposition &&
		strtoupper ($structure->disposition) == "ATTACHMENT")
		return false;
	    $text = imap_fetchbody($stream, $msg_number, $part_number); 
	    if ($structure->encoding == ENCBASE64) 
		$text = imap_base64($text); 
	    else if ($structure->encoding == ENCQUOTEDPRINTABLE)
		$text = imap_qprint($text);
	    if ($structure->parameters[0]->attribute == "CHARSET" &&
		$structure->parameters[0]->value != "US-ASCII") {
		$charset = $structure->parameters[0]->value;
	    } else $charset = false;
	    return array ($text, $charset);
	} 
	if($structure->type == TYPEMULTIPART) { 
	    while (list($index, $sub_structure) = each($structure->parts)) { 
		if ($part_number) $prefix = $part_number . '.';
		$data = get_part($stream, $msg_number, $mime_type, $sub_structure, $prefix . ($index + 1));
		if ($data) return $data;
	    }
	} 
    } 
    return false; 
}

function get_cid_part (&$stream, &$msg_number, $msgcid, $structure = false, $part_number = false) {
    if (!$structure) $structure = imap_fetchstructure($stream, $msg_number);
    if ($structure) {
	if ($msgcid == $structure->id) {
	    if (!$part_number) $part_number = "1";
	    $text = imap_fetchbody ($stream, $msg_number, $part_number);
	    if ($structure->encoding == ENCBASE64)
		$text = imap_base64($text);
	    else if($structure->encoding == ENCQUOTEDPRINTABLE)
		$text = imap_qprint($text);
	    $mime_type = full_mime_type($structure, "/");
	    $data = array ($text, $mime_type, get_encoding ($structure));
	    return $data;
	}
	if ($structure->type == TYPEMULTIPART) {
	    while (list ($index, $sub_structure) = each ($structure->parts)) {
		if ($part_number) $prefix = $part_number . '.';
		$data = get_cid_part ($stream, $msg_number, $msgcid, $sub_structure, $prefix . ($index + 1));
		if ($data) return $data;
	    }
	}
    }
    return false;
}

function echo_part_data (&$stream, &$msg_number, $structure = false, $part_number = false) {
    if (!$structure) $structure = imap_fetchstructure($stream, $msg_number);
    if ($structure) {
	$mime_type = full_mime_type($structure, "/");
	if ($structure->type != TYPEMULTIPART) {
	    if ($structure->ifdisposition &&
		strtoupper ($structure->disposition) == "ATTACHMENT") {
		if ($structure->ifdparameters) {
		    while (list ($Name, $Disposition) = each ($structure->dparameters)) {
			if (strtoupper ($Disposition->attribute) == "FILENAME") {
			    $name = header_decode($Disposition->value, false);
			    break;
			}
		    }
		}
		if (empty($name) && $structure->ifparameters) {
		    while (list ($Name, $Disposition) = each ($structure->parameters)) {
			if (strtoupper ($Disposition->attribute) == "NAME") {
			    $name = header_decode($Disposition->value, false);
			    break;
			}
		    }
		}
		if (!$part_number) $part_number = 1;
	    }
	    if ($structure->type != TYPETEXT) {
		if (empty($name) || ($name == "UNKNOWN_PARAMETER_VALUE")) {
		    $name = full_mime_type($structure, "-")."($part_number)";
		    if ($mime_type == "message/delivery-status") $mime_type = "text/plain";
		    if ($mime_type == "text/plain") $name .= ".txt";
		    if ($mime_type == "message/rfc822") $name .= ".msg";
		}
		$url = "getattach.php?msg=" . urlencode (htmlspecialchars($msg_number)).
		    "&part=" . urlencode(htmlspecialchars($part_number)) . "&file=".
		    urlencode (htmlspecialchars($name)) . "&enc=".
		    urlencode (htmlspecialchars($structure->encoding)).
		    "&mime=" . urlencode (htmlspecialchars($mime_type));
		echo "<div><a href=\"" . $url . "\">" . $name . "</a></div>";
	    }
	} else {
	    while (list ($index, $sub_structure) = each ($structure->parts)) {
		if ($part_number) $prefix = $part_number . '.';
		echo_part_data ($stream, $msg_number, $sub_structure, $prefix . ($index + 1));
	    }
	}
    }
    return true;
}

// Echos text with HTML entities
function echohtml ($string) {
    echo htmlspecialchars (stripcslashes($string));
}

session_cache_limiter ("nocache");

// The version numbering.
$MajorVersion = "01";
$MinorVersion = "00";
$BuildVersion = "00";
?>