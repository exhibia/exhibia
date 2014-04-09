<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    require_once($BASE_DIR . "/config/connect.php");

/**
 * Description of emailtemplate
 *
 * @author fedora
 */
class EmailTemplate {

    //put your code here
    public $name='';
    public $subject='';
    public $content='';

    //put your code here
    public function __construct() {
        
    }

    public static function getEmailTemplate($name) {
        global $BASE_DIR;
        include("$BASE_DIR/config/connect.php");
        $sql = "select * from emailtemplate where name='$name'";
        $result = db_query($sql);
        $emailtemplate=new EmailTemplate();
        if (db_num_rows($result) > 0) {
            $obj=db_fetch_array($result);
            $emailtemplate->name=$obj['name'];
            $emailtemplate->subject=$obj['subject'];
            $emailtemplate->content=$obj['content'];
        }else{
            $sql="insert into emailtemplate set name='$name'";
            db_query($sql);
        }
        db_free_result($result);

        return $emailtemplate;

    }
    public static function addEmailTemplate($name, $subject, $content) {
        global $BASE_DIR;
        include("$BASE_DIR/config/connect.php");
        $sql="insert into emailtemplate values(null, '$name', '" . mysql_real_escape_string($subject) . "', '" . mysql_real_escape_string($content) . "');";
        db_query($sql);
        echo db_error();
    }
    public static function updateEmailTemplate($name, $subject, $content) {
    global $BASE_DIR;
    include("$BASE_DIR/config/connect.php");
        $sql="update emailtemplate set subject='" . mysql_real_escape_string($subject) . "',content='" . mysql_real_escape_string($content) . "' where name='$name';";
        
       
        db_query($sql);
        echo db_error();
      
    }

}
?>
