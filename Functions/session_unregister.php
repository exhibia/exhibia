<?php

if(!function_exists('session_unregister')){
    function session_unregister($session_handle){

      unset($_SESSION[$session_handle]);



    }
}

if(!function_exists('session_register')){
    function session_register($session_value){

      $_SESSION[$session_value] = '';



    }
}

if(!function_exists('session_destroy')){
    function session_destroy($session_array){

	  foreach($session_array as $key => $value){
	    unset($_SESSION[$key]);

	  }

    }
}