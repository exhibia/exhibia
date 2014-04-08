<?php


class pasAffilliates {
    public $user;
    public $password;

    public function validAff($user, $password){
    
	
    
    
    }
    public function getLinks($user = '', $password = ''){
	if($this->validAff() == true){
	
	
	
	}else{


	  return false;
      }
    }
    
    public function xDomain($aff_website){
 	if($this->validAff() == true){
	
	
	
	}else{


	  return false;
      }   
 
    }

    public function javaScript($aff_website){
 	if($this->validAff() == true){
	
	
	
	}else{


	  return false;
      }   
 
    }
    public function xDomainJson($aff_website){
 	if($this->validAff() == true){
	
	
	
	}else{


	  return false;
      }   
 
    }
    public function query($aff_website){
 	if($this->validAff() == true){
	
	
	
	}else{


	  return false;
      }   
 
    }
    public function registerAff($userDataArray){
 	if($this->validAff() == true){
	
	
	
	}else{


	  return false;
      }   
    }
 
    public function login($aff_website){
 	if($this->validAff() == true){
	
	
	
	}else{


	  return false;
      }   
 
    }
    public function registerSite($aff_website){
 
 
    }
    
    
    public function registerAffiliate($aff_website){
 	if($this->validAff() == true){
	
	
	
	}else{


	  return false;
      }   
 
    }
    public function createLead($aff_website){
 	if($this->validAff() == true){
	
	
	
	}else{


	  return false;
      }   
 
    }
    public function validConnect(){
    
	///check that the server is actually the affiliate server
    
    
    }
    public function validFunction($function){
    
      if(function_exists($function)){
	  return true;
      }else{
	  return false;
      }
    
    }
    public function handleCallback($callback_function, $callback_data){
 	if($this->validAff() == true && $this->validConnect() && $this->validFunction($callback_function)){
	
	
	
	}else{


	  return false;
      }   
 
    }
    public function createCampaign($aff_website){
 	if($this->validAff() == true){
	
	
	
	}else{


	  return false;
      }   
 
    }
 
}
$pasAff = new pasAffilliates();