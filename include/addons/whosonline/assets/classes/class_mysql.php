<?php

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2010 Dynno.net . All Rights Reserved.                    #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	#                                                                    #
	# Developed by: $ID: 1 $UNI: Imad Jomaa                              #
	# ----------------------- THIS FILE PREFORMS ----------------------- #
	#                                                                    #
	# MySQL Class                                                        #
	######################################################################
	\*==================================================================*/


//lets first check if IN_WOL is defined
if (!defined("IN_WOL")) { die(header("Location: ../index.php")); }

Class Db_mysql {
  protected $db_host;
  protected $db_user;
  protected $db_pass;
  protected $db_name;
  protected $db; //db handler
  
  /******
   * @method N/A
   * Constructs the class
   */
  
  function __construct($db_host, $db_user, $db_pass, $db_name)
  {
    //define 'em all!
    $this->host = $db_host;
    $this->user = $db_user;
    $this->pass = $db_pass;
    $this->name = $db_name;
  }

  /******
   * @method public
   * @return db_connect
   * Initiates the connection to the db
   */
  
  public function connect()
  {
    $this->db = db_connect($this->host, $this->user, $this->pass) or die(db_error()."<br>".$this->db);
    
    //check if we have connected, otherwise run this function again
    if(!$this->db)
    {
      $this->connect();
    }
    //since we're connected, let's select the db
    else
    {
      $this->db = db_select_db($this->name, $this->db) or die(db_error()."<br>".$this->db);
      return $this->db;
    }
  }
  
  /******
   * @method public
   * @return db_query
   * @param object
   * This handles all queries
   */
  
  public function query($query)
  {
    //check if we have a db connection
    if(!$this->db)
    {
      $this->connect();
    }
    
    //since we know we have a db connection, run the query
    $result = db_query($query) or die(db_error()."<br>".$result);
    return $result;
  }
  
  /******
   * @method public
   * @return db_real_escape_string
   * @param string
   * This handles all real escape
   */
  
  public function realEscape($string)
  {
    //check if we have a db connection
    if(!$this->db)
    {
      $this->connect();
    }
    
	//escape the string
	$string = db_real_escape_string($string);
	
    //return the string :D
    return $string;
  }
  
  /******
   * @method public
   * @return db_num_rows
   * @param object
   * This counts the num rows
   */
  
  public function numRows($query)
  {
    $result = db_num_rows($query);
    return $result;
  }

  /******
   * @method public
   * @return db_fetch_assoc
   * @param object
   * This handles the MySQL fetch assoc
   */
  
  public function fetchAssoc($query)
  {

	$result = db_fetch_assoc($query);
	return $result;
  }
  
}

?>
