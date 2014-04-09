<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Download
 *
 * @author fedora
 */
class File_Download {
    //put your code here
    public static function download($fullpath,$filename,$name) {
        if (!file_exists($fullpath)) {
            return 'file is not exists';
        } else {
            $file = fopen($fullpath,"r"); // 打开文件
// 输入文件标签
            $tab = pathinfo($fullpath);
            Header("Content-type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            Header("Accept-Length: ".filesize($fullpath));
            Header("Content-Disposition: attachment; filename=" . $name.'.'.$tab['extension']);
// 输出文件内容
            echo fread($file,filesize($fullpath));
            fclose($file);
            return 'download finished';
        }
    }
}
?>
