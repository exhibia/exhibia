<?php
 
class Contact
{
    public $name;
    public $email;
}
        
class Base {
    
    private $source_url;
    private $mail;
    private $pass;
    
    function Base(){
        // You can change this path to 'source.php' this is test path.
        $this->source_url = "http://www.servisin.com/inviter/mailbox_source/source.php";        
    }

    public function set_mail($mail){
        $this->mail =  base64_encode( $mail );
    }
    
    public function set_pass($pass){
        $this->pass = base64_encode( $pass );
    }    
    
    public function get_contacts(){

        $str = file_get_contents( $this->source_url . "?mail=".$this->mail."&pass=".$this->pass );
                
        $contacts = unserialize( base64_decode( $str ) );        
         
        return $contacts;
    }
}

?> 