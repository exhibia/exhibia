<?php
function fopen_utf8 ($filename) {
    $file = @fopen($filename, "r");
    $bom = fread($file, 3);
    if ($bom != b"\xEF\xBB\xBF")
    {
        return false;
    }
    else
    {
        return true;
    }
}

function file_array($path, $exclude = ".|..|design", $recursive = true) {
    $path = rtrim($path, "/") . "/";
    $folder_handle = opendir($path);
    $exclude_array = explode("|", $exclude);
    $result = array();
    while(false !== ($filename = readdir($folder_handle))) {
        if(!in_array(strtolower($filename), $exclude_array)) {
            if(is_dir($path . $filename . "/")) {
                                // Need to include full "path" or it's an infinite loop
                if($recursive) $result[] = file_array($path . $filename . "/", $exclude, true);
            } else {
                if ( fopen_utf8($path . $filename) )
                {
                    //$result[] = $filename;
                    echo ($path . $filename . "<br>");
                }
            }
        }
    }
    return $result;
}

$files = file_array(".");
?>