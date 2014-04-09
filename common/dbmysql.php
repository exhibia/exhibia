<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of DBMysql
 *
 * @author fedora
 */
class DBMysql {
    //private $conn;
    //put your code here
    public function  __construct() {
   
    if(file_exists('config.inc.php')) {
    
    
            require("config.inc.php");
    
    
    }else if(file_exists('config/config.inc.php')) {
        
            require("config/config.inc.php");
            
            
        }else if(file_exists('../config/config.inc.php')) {
            
            
            require("../config/config.inc.php");
            
            
        }else if(file_exists('../../config/config.inc.php')) {
            require("../../config/config.inc.php");
        }
        
        $this->conn=db_connect($DBSERVER, $USERNAME, $PASSWORD);
        
        db_select_db($DATABASENAME,$this->conn);
    }

    /**
     * start a transaction
     */
    public function begin() {
        return db_query('BEGIN');
    }

    /**
     * commit the transaction
     */
    public function commit() {
        return db_query('COMMIT');
    }

    /**
     * rollback the transaction
     * @return <type>
     */
    public function rollback() {
        return db_query('ROLLBACK');
    }

    /**
     * execute a query
     * @param <type> $sql
     * @return <type>
     */
    public function executeQuery($sql) {
        return db_query($sql);
    }

    /**
     * execute a transaction
     * @param <type> $sqlArray
     * @return <type>
     */
    public function transaction($sqlArray) {
        $retval=1;
        $this->begin();
        foreach($sqlArray as $sql) {
            $result = db_query($sql);
            if(db_affected_rows() == 0) {
                $retval = 0;
            }
        }

        if($retval == 0) {
            $this->rollback();
            return false;
        }else {
            $this->commit();
            return true;
        }
    }

    /**
     * get the affected rows
     * @return <type>
     */
    public function affectedRows() {
        return db_affected_rows();
    }
}
?>
