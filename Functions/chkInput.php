<?php


function chkInput($data, $type='s', $length=0) {
    $data = RemoveXSS($data);
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
