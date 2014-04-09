<?php
  class inviter extends Base {
    
    private $width;
    
    private $bgcolor;
    
    private $subject;
    
    private $title;
    
    private $message;
    
    private $from;
    
    public function set_width($w){
         $this->width = $w;        
    }
    
    public function set_bgcolor($clr){
         $this->bgcolor = $clr;
    }    
    
    public function create_inviter_form(){
        
        $msg_format = file_get_contents(dirname(__FILE__)."/../tpl/tpl.iniviter_form.php");
        
        $msg_format = str_replace( "<%color%>", $this->bgcolor, $msg_format );
        
        $msg_format = str_replace( "<%width%>", $this->width, $msg_format );   
        
        $msg_format .= "<input type='hidden' id='subject' value='".$this->subject."'><input type='hidden' id='title' value='".$this->title."'><input type='hidden' id='from' value='".$this->from."'>";
        
        echo $msg_format;     
            
  
    }
    
    
    public function sent_invites($contacts){
           
        $msg_format = file_get_contents("tpl/tpl.mail_message.php");
        $msg = str_replace("<%message%>", $this->message, $msg_format);            
        $msg = str_replace("<%title%>", $this->title, $msg );           
        $header = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $header.= "From: ".$this->from."\r\n";
        $contacts = explode(",", $contacts );
        
        foreach( $contacts as $contact ){       
            mail( $contact, $this->subject, $msg, $header  );
        }
    }
    
    public function set_title($title){
        $this->title = $title;
    }
    
    public function set_subject($sbj){
        $this->subject = $sbj;
    }
    
    public function set_message($msg){
        $this->message = $msg;
    }
    
    public function set_from($frm){
        $this->from = $frm;
    }
      
  } 
?>