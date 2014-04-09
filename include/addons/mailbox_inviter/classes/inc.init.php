<?php
  class inviter extends Base {
    
    private $width;
    
    private $bgcolor;
    
    public function set_width($w){
         $this->width = $w;        
    }
    
    public function set_bgcolor($clr){
         $this->bgcolor = $clr;
    }    
    
    public function create_inviter(){
      
      $form = file_get_contents(dirname(__FILE__)."/../tpl/tpl.iniviter_form.php");
                  
  
    }   
    
    public function sent_invites($contacts){
        
        $msg_format = file_get_contents(dirname(__FILE__)."/../tpl/tpl.mail_message.php");
        
        foreach( $contacts as $contact ){
            
        }
    }
      
  } 
?>