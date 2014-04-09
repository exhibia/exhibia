<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (file_exists('common/Security.php')) {
    include_once 'common/Security.php';
} else {
    include_once '../common/Security.php';
}

function RemoveXSS($val) {
    $security = new Security();
    $val = $security->xss_clean($val);
    return $val;
}

function inject_check($sql_str) {
    return $sql_str = preg_replace('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', '', $sql_str);    // 进行过滤
}

function escapeMysql($el) {
    if (is_array($el)) {
        return array_map("escapeMysql", $el);
    } else {
        /* 如果Magic Quotes功用启用    */
        if (!get_magic_quotes_gpc()) {
            $el = db_real_escape_string(trim($el));
        }
        $el = str_ireplace("%5d%5c", "'", $el);
        $el = str_replace("_", "\_", $el);    // 把 '_'过滤掉
        $el = str_replace("%", "\%", $el);    // 把 '%'过滤掉
        $el = nl2br($el);    // 回车转换
        return $el;
    }
}

function var_filter_deep($value) {
    if (is_array($value)) {
        return $value = array_map("var_filter_deep", $value);
    } else {
        $value = RemoveXSS($value);
        //$value = inject_check($value);
        $value = escapeMysql($value);
        return $value;
    }
}

function verify_id($id=null) {
    if (!$id) {
        exit('没有提交参数！');
    }    // 是否为空判断
    elseif (inject_check($id)) {
        exit('提交的参数非法！');
    }    // 注射判断
    elseif (!is_numeric($id)) {
        exit('提交的参数非法！');
    }    // 数字判断
    $id = intval($id);    // 整型化
    return $id;
}

function varFilter() {
    $_SERVER = array_map("var_filter_deep", $_SERVER);
    $_REQUEST = array_map("var_filter_deep", $_REQUEST);
    $_POST = array_map("var_filter_deep", $_POST);
    $_GET = array_map("var_filter_deep", $_GET);
    $_COOKIE = array_map("var_filter_deep", $_COOKIE);
}

?>
