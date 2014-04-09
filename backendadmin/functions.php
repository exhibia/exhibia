<?php

$smileysname = array(
    'angry.gif' => ':@',
    'baringteeth.gif' => ':E',
    'beer.gif' => '(B)',
    'biggrin.gif' => ':D',
    'broken_heart.gif' => '(U)',
    'cake.gif' => '(ii)',
    'coffee.gif' => '(C)',
    'confused.gif' => ':~',
    'cry.gif' => ':\'(',
    'embarrased.gif' => ':$',
    'envelope.gif' => '(E)',
    'girl.gif' => '(X)',
    'guy.gif' => '(Z)',
    'heart.gif' => '(L)',
    'keep_quiet.gif' => ':#',
    'kiss.gif' => '(K)',
    'mobile.gif' => '(M)',
    'money.gif' => '(�)',
    'omg.gif' => ':O',
    'party.gif' => '<)',
    'phone.gif' => '(T)',
    'pizza.gif' => '(P)',
    'rose.gif' => '(F)',
    'sad.gif' => ':(',
    'sarcy.gif' => '^)',
    'shades.gif' => '8)',
    'sick.gif' => '+(',
    'sleepy.gif' => '|)',
    'smile.gif' => ':)',
    'soccer.gif' => '(S)',
    'think.gif' => '*)',
    'thumbs_down.gif' => '(N)',
    'thumbs_up.gif' => '(Y)',
    'thunder.gif' => '(th)',
    'tongue.gif' => ':P',
    'wink.gif' => ';)'
);

function chkInput($data, $type='s', $length=0) {
    $data = trim(htmlspecialchars_decode($data, ENT_QUOTES));
    $res = NULL;

    switch ($type) {
        case 's':
            $sql_syntax = array("insert", "select", "update", "delete", "grant", "privileges", "create", " or ", " and ");
            $delimiters = array("`", ";");

            $res = str_ireplace($sql_syntax, '', $data);
            $res = str_ireplace($delimiters, '', $res);

            if ($length > 0) {
                $res = substr($res, 0, $length);

                $slashed_res = addslashes($res);
                $nlen = strlen($slashed_res);
                $res = $nlen > $length ? addslashes(substr($res, 0, ($length * 2 - $nlen))) : $slashed_res;
            } else {
                $res = addslashes($res);
            }
            break;
        case 'i':
            $res = is_numeric($data) && is_int((int) $data) ? number_format($data, 0, '.', '') : 0;
            break;
    }

    return $res;
}

function chkSQL($data, $length=0, $setHTML=FALSE) {
    $data = trim(htmlspecialchars_decode($data, ENT_QUOTES));
    $res = NULL;

    $sql_syntax = array("insert", "update", "delete", "grant", "privileges", "create");
    $res = str_ireplace($sql_syntax, '', $data);

    if ($length > 0) {
        $res = substr($res, 0, $length);

        if (setHTML) {
            $html_res = htmlspecialchars($res, ENT_QUOTES);
            $nlen = strlen($html_res);
            $res = $nlen > $length ? htmlspecialchars(substr($res, 0, ($length * 2 - $nlen)), ENT_QUOTES) : $html_res;
        } else {
            $slashed_res = addslashes($res);
            $nlen = strlen($slashed_res);
            $res = $nlen > $length ? addslashes(substr($res, 0, ($length * 2 - $nlen))) : $slashed_res;
        }
    } else {
        $res = setHTML ? htmlspecialchars($res, ENT_QUOTES) : addslashes($res);
    }

    return $res;
}

function arrangedate($date) {
    global $globalDateformat;
    $year = substr($date, 0, 4);
    $month = substr($date, 5, 2);
    $day = substr($date, 8, 2);

    if ($globalDateformat == 'm/d/Y') {
        return ($month . "/" . $day . "/" . $year);
    } else {
        return ($day . "/" . $month . "/" . $year);
    }
}

function ChangeDateFormat($date) {


    global $globalDateformat;
  
     if(preg_match("/-/", $date)){


	  $date_a  =  explode("-", $date);
	  
	
    
    }else{
    
	  $date_a  =  explode("/", $date);

    
    }
    
    	  
	  if($globalDateformat=='d/m/Y'){
	  
	      $day=$date_a[0];
	      $month=$date_a[1];
	      $year=$date_a[2];
	  }else{
	      $month=$date_a[0];
	      $day=$date_a[1];
	      $year=$date_a[2];
	  }
	
	  return $year.'-'.$month.'-'.$day;   
    
    
}

function ChangeDateFormatSlash($date) {
    global $globalDateformat;
//    $year = substr($date, 0, 4);
//    $day = substr($date, 8, 2);
//    $month = substr($date, 5, 2);
//
//    return ($day . "/" . $month . "/" . $year);
    return date($globalDateformat,  strtotime($date));
}

function convertToDate($date){
    global $globalDateformat;
    if($globalDateformat=='d/m/Y'){
        $day=substr($date,0,2);
        $month=substr($date,3,2);
        $year=substr($date,6,4);
    }else{
        $month=substr($date,0,2);
        $day=substr($date,3,2);
        $year=substr($date,6,4);
    }
    return $year.'-'.$month.'-'.$day;
}

function arrangedate2($date) {
    $year = substr($date, 6);
    $month = substr($date, 3, 2);
    $day = substr($date, 0, 2);

    return ($month . "/" . $day . "/" . $year);
}

function dateDifference($start, $end, $output="string") {
    // converting the dates to seconds
    $startSeconds = strtotime($start);
    $endSeconds = strtotime($end);


    // if conversion was succesfull
    if ($startSeconds === false || $endSeconds === false)
        return FALSE;

    // switching start and end date if start date is bigger
    // and converting them to 1 standard format for this function, so we know what we're dealing with
    if ($startSeconds > $endSeconds) {
        $startDate = date("Y-m-d H:i:s", $endSeconds);
        $endDate = date("Y-m-d H:i:s", $startSeconds);
    } else {
        $startDate = date("Y-m-d H:i:s", $startSeconds);
        $endDate = date("Y-m-d H:i:s", $endSeconds);
    }
echo $endDate . "<br />";
    // exploding everything into seperate variabels
    list($startDateDate, $startDateTime) = explode(" ", $startDate);
    list($endDateDate, $endDateTime) = explode(" ", $endDate);
echo $endDateTime . "<br />";
    list($startYear, $startMonth, $startDay) = explode("-", $startDateDate);
    list($endYear, $endMonth, $endDay) = explode("-", $endDateDate);

    list($startHour, $startMinute, $startSecond) = explode(":", $startDateTime);
    list($endHour, $endMinute, $endSecond) = explode(":", $endDateTime);
    
echo $endHour . "<br />";
    // now we can start calculating
    // difference in seconds
    $secondDiff = $endSecond - $startSecond;
    if ($startSecond > $endSecond) {
        // if the difference is negative, we add 60 seconds and increase the starting minute
        $secondDiff += 60;
        $startMinute++;
    }

    $minuteDiff = $endMinute - $startMinute;
    if ($startMinute > $endMinute) {
        $minuteDiff += 60;
        $startHour++;
    }

    $hourDiff = $endHour - $startHour;
    if ($startHour > $endHour) {
        $hourDiff += 24;
        $startDay++;
    }
echo "$endHour - $startHour = " . $hourDiff . "<br />";
    // days in starting month
    if ($endMonth > $startMonth || $endYear > $startYear) {
        if ($startDay > $endDay) {
            // amount of days this month has
            $daysThisMonth = date("t", $startDate);
            // difference in days to the next month
            $dayDiff = ($daysThisMonth - $startDay) + $endDay;
            // compensating for the months
            $startMonth++;
        } else {
            $dayDiff = $endDay - $startDay;
        }
    } else {
        $dayDiff = $endDay - $startDay;
    }

    $monthDiff = $endMonth - $startMonth;
    if ($startMonth > $endMonth) {
        $monthDiff += 12;
        $startYear++;
    }
    $yearDiff = $endYear - $startYear;

    // we know all the differences, so we're outputting that
    if ($output == "string") {
    
        if ($yearDiff > 0) {
            return $yearDiff . " year, " . $monthDiff . " months, " . $dayDiff . " days and " . $hourDiff . " hours, " . $minuteDiff . " minutes, " . $secondDiff . " seconds";
        } elseif ($monthDiff > 0) {
            return $monthDiff . " months, " . $dayDiff . " days and " . $hourDiff . " hours, " . $minuteDiff . " minutes, " . $secondDiff . " seconds";
        } elseif ($dayDiff > 0) {
            return $dayDiff . " days and " . $hourDiff . " hours, " . $minuteDiff . " minutes, " . $secondDiff . " seconds";
        } elseif ($hourDiff > 0) {
            return $hourDiff . " hours, " . $minuteDiff . " minutes, " . $secondDiff . " seconds";
        } elseif ($minuteDiff > 0) {
            return $minuteDiff . " minutes, " . $secondDiff . " seconds";
        } elseif ($secondDiff > 0) {
            return $secondDiff . " seconds";
        } else {
            return "There is no difference!";
        }
    } elseif ($output == "assoc_array") {
  //print_r(array("year" => $yearDiff, "month" => $monthDiff, "day" => $dayDiff, "hour" => $hourDiff, "minute" => $minuteDiff, "second" => $secondDiff));
        return array("year" => $yearDiff, "month" => $monthDiff, "day" => $dayDiff, "hour" => $hourDiff, "minute" => $minuteDiff, "second" => $secondDiff);
    } else {
    
        return array($yearDiff, $monthDiff, $dayDiff, $hourDiff, $minuteDiff, $secondDiff);
    }
}

function getHours($aucstartdate, $aucenddate, $aucstarthour, $aucendhour, $aucstartmin, $aucendmin, $aucstartsec, $aucendsec) {

include("connect.php");

$globalDateformat = db_fetch_object(db_query("select *  from sitesetting where name = 'dateformat' limit 1"));

$globalDateformat = $globalDateformat->value;
if($debug == 'true'){
echo $globalDateformat;
}

if(str_replace(" ", "", $globalDateformat) == 'd/m/Y'){

    $start_ex = explode("/", $aucstartdate);
   
    $aucstartdate = $start_ex[1] . "/" . $start_ex[0] . "/" . $start_ex[2];
    
    $end_ex = explode("/", $aucenddate);
    $aucenddate = $end_ex[1] . "/" . $end_ex[0] . "/" . $end_ex[2];
    $newstartdate = $aucstartdate;
    $newenddate = $aucenddate;
 }else{
    $start_ex = explode("/", $aucstartdate);
    
      
       
    $aucstartdate = $start_ex[0] . "/" . $start_ex[1] . "/" . $start_ex[2];
    
    $end_ex = explode("/", $aucenddate);
    $aucenddate = $end_ex[0] . "/" . $end_ex[1] . "/" . $end_ex[2];
    $newstartdate = $aucstartdate;
    $newenddate = $aucenddate;
    
}


    $newstarttime = $aucstarthour . ":" . $aucstartmin . ":" . $aucstartsec;


    $newendtime = $aucendhour . ":" . $aucendmin . ":" . $aucendsec;
    if($debug == 'true'){
    
    echo "<br />End Time " .  $newenddate . " " . $newendtime . "<br />";
    echo "Start time" . $newstartdate . " " . $newstarttime . "<br />";
    
    }
    $newstarttimestamp = strtotime($newstartdate . " " . $newstarttime);
    $newendtimestamp = strtotime($newenddate . " " . $newendtime);
    
   
    if ($newstarttimestamp != false & $newendtimestamp != false) {
        $datediffarr = dateDifference(date("Y-m-d H:i:s", $newstarttimestamp), date("Y-m-d H:i:s", $newendtimestamp), $output = "assoc_array");
        $datediffval = $datediffarr["day"];
        $hourdiffval = $datediffarr["hour"];
        $minutediffval = $datediffarr["minute"];
        $secondsdiffval = $datediffarr["second"];
        //print_r($datediffarr);
      //  if($debug == true){
       
       // }
     
    }

    
        $finalsec = $newendtimestamp - $newstarttimestamp;
    
   // if($debug == 'true'){

//}
    return $finalsec;
}
function CheckTimeGreater($starthour, $startmin, $startsec, $endhour, $endmin, $endsec) {
    if ($starthour > $endhour || $starthour < $endhour) {
        if ($starthour > $endhour) {
            $returnfalg = 0;
        } elseif ($starthour < $endhour) {
            $returnfalg = 1;
        }
    } else {
        if ($startmin > $endmin || $startmin < $endmin) {
            if ($startmin > $endmin) {
                $returnfalg = 0;
            } elseif ($startmin < $endmin) {
                $returnfalg = 1;
            }
        } else {
            if ($startsec > $endsec) {
                $returnfalg = 0;
            } elseif ($startsec < $endsec) {
                $returnfalg = 1;
            }
        }
    }

    if ($returnfalg == 0)
        return 1;
    if ($returnfalg == 1)
        return 2;
}

function SetAuctionTimePause($astdate, $estdate) {
    $qry = "select * from auction_pause_management where id='1'";
    $rs = db_query($qry);
    $total = db_num_rows($rs);
    $ob = db_fetch_object($rs);
    print_r($ob);
    $st = explode(":", $ob->pause_start_time);
    $et = explode(":", $ob->pause_end_time);

    $querysel = "select auctionId from auction where auc_status='2' and pause_status='1' limit 0,1";
    $resultsel = db_query($querysel) or die(db_error());
    $totalauctpassel = db_num_rows($resultsel);

    if ($totalauctpassel > 0) {
        $pausestarttime = $ob->pause_start_timestamp;
        $pausestarttime1 = mktime($st[0], $st[1], $st[2], substr($estdate, 0, 2), substr($estdate, 3, 2), substr($estdate, 6));
    } else {
        $pausestarttime = mktime($st[0], $st[1], $st[2], date("m"), date("d"), date("Y"));
        $pausestarttime1 = mktime($st[0], $st[1], $st[2], substr($estdate, 0, 2), substr($estdate, 3, 2), substr($estdate, 6));
    }

    if (CheckTimeGreater($st[0], $st[1], $st[2], $et[0], $et[1], $et[2]) == 1) {
        if ($totalauctpassel > 0) {
            if (date("Y-m-d") > date("Y-m-d", $pausestarttime)) {
                $pauseendtime = mktime($et[0], $et[1], $et[2], date("m"), date("d"), date("Y"));
                $pauseendtime1 = mktime($et[0], $et[1], $et[2], substr($estdate, 0, 2), substr($estdate, 3, 2), substr($estdate, 6));
            } else {
                $pauseendtime = mktime($et[0], $et[1], $et[2], date("m"), date("d") + 1, date("Y"));
                $pauseendtime1 = mktime($et[0], $et[1], $et[2], substr($estdate, 0, 2), substr($estdate, 3, 2) + 1, substr($estdate, 6));
            }
            // if server date is greater then timestamp date then dont add one day otherwise add one day in date.
        } else {
            $pauseendtime = mktime($et[0], $et[1], $et[2], date("m"), date("d") + 1, date("Y"));
            $pauseendtime1 = mktime($et[0], $et[1], $et[2], substr($estdate, 0, 2), substr($estdate, 3, 2) + 1, substr($estdate, 6));
        }
    } else {
        $pauseendtime = mktime($et[0], $et[1], $et[2], date("m"), date("d"), date("Y"));
        $pauseendtime1 = mktime($et[0], $et[1], $et[2], substr($estdate, 0, 2), substr($estdate, 3, 2), substr($estdate, 6));
    }

    return $pausestarttime . "|" . $pauseendtime . "|" . $pausestarttime1 . "|" . $pauseendtime1;
}

function dateDiff($dformat, $endDate, $beginDate) {
    $date_parts1 = explode($dformat, $beginDate);
    $date_parts2 = explode($dformat, $endDate);
    $start_date1 = gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);
    $end_date1 = gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);
    return $end_date1 - $start_date1;
}

function GetBidsDetails($aid) {
    $qrychkfree = "select use_free from auction where auctionID='" . $aid . "'";
    $reschkfree = db_query($qrychkfree);
    $objchkfree = db_fetch_object($reschkfree);

    if ($objchkfree->use_free == 1) {
        $qrysel = "select *,sum(bid_count) as totalbids from free_account ba left join registration r on ba.user_id=r.id where auction_id='" . $aid . "' and bid_flag='d' and r.admin_user_flag='0' group by auction_id";
    } else {
        $qrysel = "select *,sum(bid_count) as totalbids from bid_account ba left join registration r on ba.user_id=r.id where auction_id='" . $aid . "' and bid_flag='d' and r.admin_user_flag='0' group by auction_id";
    }
    $ressel = db_query($qrysel);
    $objsel = db_fetch_object($ressel);

    if ($objchkfree->use_free == 1) {
        $qrysel1 = "select *,sum(bid_count) as totalbids from free_account ba left join registration r on ba.user_id=r.id where auction_id='" . $aid . "' and bid_flag='d' and r.admin_user_flag='1' group by auction_id";
    } else {
        $qrysel1 = "select *,sum(bid_count) as totalbids from bid_account ba left join registration r on ba.user_id=r.id where auction_id='" . $aid . "' and bid_flag='d' and r.admin_user_flag='1' group by auction_id";
    }
    $ressel1 = db_query($qrysel1);
    $objsel1 = db_fetch_object($ressel1);

    return $objsel->totalbids . "|" . $objsel1->totalbids;
}

function GetProductName($pid) {
    $qrysel = "select * from products where productID='" . $pid . "'";
    $ressel = db_query($qrysel);
    $objsel = db_fetch_object($ressel);

    return stripslashes($objsel->name);
}

function getTotalTimeLogin1($uid, $startdate, $enddate) {
    $qr = "select *,DATE_FORMAT(login_time, '%Y-%m-%d')  AS logindate,DATE_FORMAT(logout_time, '%Y-%m-%d') as logoutdate from login_logout where user_id='" . $uid . "' and login_time>='$startdate' and logout_time<='$enddate'";
    $rs = db_query($qr);
    $tot = db_num_rows($rs);

    while ($objtottime = db_fetch_object($rs)) {
        if ($objtottime->logout_time != "" && $objtottime->logout_time != "0000-00-00 00:00:00") {
            $totaltime = (strtotime($objtottime->logout_time) - strtotime($objtottime->login_time)) + $finaltottime;
        }
        $finaltottime = $totaltime;
    }
    return $tot . "|" . $finaltottime;
}

function choose_short_desc($shortdesc, $length) {
    $long_desc = $shortdesc;
    $totallen = strlen($long_desc);
    for ($i = $length; $i < $totallen; $i++) {
        if (substr($long_desc, $i, 1) == " ") {
            $length = $i;
            break;
        }
    }
    if (strlen($long_desc) > $length) {
        $short_desc = nl2br(substr($long_desc, 0, $length));
        $short_desc .= "...";
    } else {
        $short_desc = nl2br($long_desc) . "...";
    }
    return $short_desc;
}

function categoryWiseComment($catid) {
    $selectCat = "select count(*) as totalcomment from forums where forums_category = '" . $catid . "'";
    $resultCat = db_query($selectCat) or die(db_error());

    $row = db_fetch_object($resultCat);
    $totalcomment = $row->totalcomment;
    return $totalcomment;
}

function GetValueWithSmileys($datavalue) {
    $body = stripslashes($datavalue);

    $body = str_replace(':)', "<img src='../images/smileys/smile.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":(", "<img src='../images/smileys/sad.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":P", "<img src='../images/smileys/tongue.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(";)", "<img src='../images/smileys/wink.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":D", "<img src='../images/smileys/biggrin.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":'(", "<img src='../images/smileys/cry.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("*)", "<img src='../images/smileys/think.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":~", "<img src='../images/smileys/confused.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("8)", "<img src='../images/smileys/shades.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("<)", "<img src='../images/smileys/party.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":$", "<img src='../images/smileys/embarrased.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":@", "<img src='../images/smileys/angry.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":#", "<img src='../images/smileys/keep_quiet.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":O", "<img src='../images/smileys/omg.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("+(", "<img src='../images/smileys/sick.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("|)", "<img src='../images/smileys/sleepy.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("^)", "<img src='../images/smileys/sarcy.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":E", "<img src='../images/smileys/baringteeth.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(L)", "<img src='../images/smileys/heart.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(l)", "<img src='../images/smileys/heart.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(U)", "<img src='../images/smileys/broken_heart.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(u)", "<img src='../images/smileys/broken_heart.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(K)", "<img src='../images/smileys/kiss.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(k)", "<img src='../images/smileys/kiss.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(F)", "<img src='../images/smileys/rose.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(f)", "<img src='../images/smileys/rose.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(B)", "<img src='../images/smileys/beer.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(b)", "<img src='../images/smileys/beer.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(T)", "<img src='../images/smileys/phone.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(t)", "<img src='../images/smileys/phone.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(P)", "<img src='../images/smileys/pizza.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(p)", "<img src='../images/smileys/pizza.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(M)", "<img src='../images/smileys/mobile.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(m)", "<img src='../images/smileys/mobile.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(th)", "<img src='../images/smileys/thunder.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(Z)", "<img src='../images/smileys/guy.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(z)", "<img src='../images/smileys/guy.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(X)", "<img src='../images/smileys/girl.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(x)", "<img src='../images/smileys/girl.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(ii)", "<img src='../images/smileys/cake.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(E)", "<img src='../images/smileys/envelope.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(e)", "<img src='../images/smileys/envelope.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(�)", "<img src='../images/smileys/money.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(S)", "<img src='../images/smileys/soccer.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(s)", "<img src='../images/smileys/soccer.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(C)", "<img src='../images/smileys/coffee.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(c)", "<img src='../images/smileys/coffee.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(Y)", "<img src='../images/smileys/thumbs_up.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(y)", "<img src='../images/smileys/thumbs_up.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(N)", "<img src='../images/smileys/thumbs_down.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(n)", "<img src='../images/smileys/thumbs_down.gif' width='19' height='19' align='absmiddle' />", $body);

    return $body;
}

function isDigit($str) {
    return preg_match('/^[-+]?\d*\.?\d*$/', $str);
}

function validDate($str) {
    list($dd, $mm, $yy) = explode("/", $mydate);
    if (is_numeric($yy) && is_numeric($mm) && is_numeric($dd)) {
        return checkdate($mm, $dd, $yy);
    }
}

function dmyToDate($str) {
    return strtotime(ChangeDateFormat($str));
}









?>
