<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

    require_once $BASE_DIR . '/common/dbmysql.php';

/**
 * Description of paypalinfo
 *
 *
 */
class PayGateway {
    private $db;
    //put your code here
    public function  __construct($db) {
        if($db==null) {
            $this->db =new DBMysql();
        }else {
            $this->db=$db;
        }
                       
    }
 
    public function get_em_all($status = null){
      $these_gateways = array();
	    
	  $sql="select * from paypal_info ";
	  if(!empty($status)){
	      $sql .= "where enabled = $status";
	      
	    }
	  $qry = db_query($sql);  
	    
	  while($gateways = db_fetch_array($qry)){
      
	    $these_gateways[] = $gateways;

				    
	    }
	  
	   echo db_error();
	    return $these_gateways;
	   
      }

      public function getPaypal() {
        $paypalInfo=new PaypalInfo();
        $result=$this->select($paypalInfo->getName());
        if(db_num_rows($result)==0) {
            $this->insert($paypalInfo->getName(), '', '', '', '');
            return $paypalInfo;
        }else {
            $obj=db_fetch_object($result);
            $paypalInfo->setBusinessId($obj->business_id);
            $paypalInfo->setToken($obj->token);
            $paypalInfo->setEnabled($obj->enabled);
            $paypalInfo->setTestMode($obj->testmode);
            return $paypalInfo;
        }
    }
    public function getDalPay() {
        $paypalInfo=new DalPayInfo();
        $result=$this->select($paypalInfo->getName());
        if(db_num_rows($result)==0) {
            $this->insert($paypalInfo->getName(), '', '', '', '');
            return $paypalInfo;
        }else {
            $obj=db_fetch_object($result);
            $paypalInfo->setBusinessId($obj->business_id);
            $paypalInfo->setToken($obj->token);
            $paypalInfo->setEnabled($obj->enabled);
            $paypalInfo->setTestMode($obj->testmode);
            $paypalInfo->setPassword($obj->additional1);
            return $paypalInfo;
        }
    }
    public function getDalPayDirect() {
        $paypalInfo=new DalPayDirectInfo();
        $result=$this->select($paypalInfo->getName());
        if(db_num_rows($result)==0) {
            $this->insert($paypalInfo->getName(), '', '', '', '');
            return $paypalInfo;
        }else {
            $obj=db_fetch_object($result);
            $paypalInfo->setBusinessId($obj->business_id);
            $paypalInfo->setToken($obj->token);
            $paypalInfo->setEnabled($obj->enabled);
            $paypalInfo->setTestMode($obj->testmode);
            $paypalInfo->setPassword($obj->additional1);
            return $paypalInfo;
        }
    }
      public function getHipay() {
        $hipayInfo=new HipayInfo();
        $result=$this->select($hipayInfo->getName());
        if(db_num_rows($result)==0) {
            $this->insert($hipayInfo->getName(), '', '', '', '');
            return $hipayInfo;
        }else {
            $obj=db_fetch_object($result);
            $hipayInfo->setBusinessId($obj->business_id);
	    $hipayInfo->setToken($obj->token);
            $hipayInfo->setEnabled($obj->enabled);
            $hipayInfo->setTestMode($obj->testmode);
            return $hipayInfo;
        }
    }

    public function getPaypalPro() {
        $paypalPro=new PaypalProInfo();
        $result=$this->select($paypalPro->getName());
        if(db_num_rows($result)==0) {
            $this->insert($paypalPro->getName(), '', '','','');
            return $paypalPro;
        }else {
            $obj=db_fetch_object($result);
            $paypalPro->setUsername($obj->business_id);
            $paypalPro->setPassword($obj->token);
            $paypalPro->setSignature($obj->additional1);
            $paypalPro->setEnabled($obj->enabled);
            $paypalPro->setTestMode($obj->testmode);
            return $paypalPro;
        }
    }

    public function getAuthnet() {
        $authnetInfo=new AuthnetInfo();
        $result=$this->select($authnetInfo->getName());
        if(db_num_rows($result)==0) {
            $this->insert($authnetInfo->getName(), '','','','');
            return $authnetInfo;
        }else {
            $obj=db_fetch_object($result);
            $authnetInfo->setLoginId($obj->business_id);
            $authnetInfo->setTransKey($obj->token);
            $authnetInfo->setEnabled($obj->enabled);
            $authnetInfo->setTestMode($obj->testmode);
            return $authnetInfo;
        }
    }
    
    
    public function getGoogleCheckOut() {
        $googleInfo=new GoogleCheckoutInfo();
        $result=$this->select($googleInfo->getName());
        if(db_num_rows($result)==0) {
            $this->insert($googleInfo->getName(),'','','','');
            return $googleInfo;
        }else {
            $obj=db_fetch_object($result);
            $googleInfo->setMerchantId($obj->business_id);
            $googleInfo->setMerchantKey($obj->token);
            $googleInfo->setEnabled($obj->enabled);
            $googleInfo->setTestMode($obj->testmode);
            return $googleInfo;
        }
    }
    public function getMoneyBooker(){
        $mbinfo=new MoneyBookerInfo();
        $result=$this->select($mbinfo->getName());
        if(db_num_rows(($result))==0){
            $this->insert($mbinfo->getName(), '', '', '', '');
            return $mbinfo;
        }else{
            $obj=db_fetch_object($result);
            $mbinfo->setMerchantEmail($obj->business_id);
            $mbinfo->setSecretword($obj->token);
            $mbinfo->setEnabled($obj->enabled);
            $mbinfo->setTestMode($obj->testmode);
            return $mbinfo;
        }
    }    
   public function getPayflowLink(){
        $payflowlink=new PayflowLinkInfo();
        $result=$this->select($payflowlink->getName());
        if(db_num_rows($result)==0){
            $this->insert($payflowlink->getName(),'','','','');
            return $payflowlink;
        }else{
            $obj=db_fetch_object($result);
            $payflowlink->setLogin($obj->business_id);
            $payflowlink->setParter($obj->token);
            $payflowlink->setEnabled($obj->enabled);
            $payflowlink->setTestMode($obj->testmode);
            return $payflowlink;
        }
    }

    public function getPaymentasia(){
        $paymentasia=new PaymentasiaInfo();
        $result=$this->select($paymentasia->getName());
        if(db_num_rows($result)==0){
            $this->insert($paymentasia->getName(), '', '', '', '');
            return $paymentasia;
        }else{
            $obj=db_fetch_object($result);
            $paymentasia->setMerchantID($obj->business_id);
            $paymentasia->setMerchantEmail($obj->token);
            $paymentasia->setEnabled($obj->enabled);
            $paymentasia->setTestMode($obj->testmode);
            $paymentasia->setReferenceTitle($obj->additional1);
            return $paymentasia;
        }        
    }

    public function getPaymentCCAvenue(){
        $ccavenue=new CCAvenueInfo();
        $result=$this->select($ccavenue->getName());
        if(db_num_rows($result)==0){
            $this->insert($ccavenue->getName(), '', '', '', '');
            return $ccavenue;
        }else{
            $obj=db_fetch_object($result);
            $ccavenue->setMerchantID($obj->business_id);
            $ccavenue->setWorkingKey($obj->token);
            $ccavenue->setEnabled($obj->enabled);
            $ccavenue->setTestMode($obj->testmode);
            return $ccavenue;
        }
    }

    public function getPaymentMyGate(){
        $mygate=new CMyGateInfo();
        $result=$this->select($mygate->getName());
        if(db_num_rows($result)==0){
            $this->insert($mygate->getName(),'','','','');
            return $mygate;
        }else{
            $obj=db_fetch_object($result);
            $mygate->setMerchantID($obj->business_id);
            $mygate->setApplicationID($obj->token);
            $mygate->setEnabled($obj->enabled);
            $mygate->setTestMode($obj->testmode);
            return $mygate;
        }
    }
    public function getPagseguro(){
        $pageseguro=new CPagseguro();
        $result=$this->select($pageseguro->getName());
        if(db_num_rows($result)==0){
            $this->insert($pageseguro->getName(),'','','EN','');
            return $pageseguro;
        }else{
            $obj=db_fetch_object($result);
            $pageseguro->setEmail($obj->business_id);
            $pageseguro->setToken($obj->token);
            $pageseguro->setFreightType($obj->additional1);
            $pageseguro->setEnabled($obj->enabled);
            $pageseguro->setTestMode($obj->testmode);
            return $pageseguro;
        }
    }
      public function getPaysitecash(){
        $paysitecash=new CPaysitecash();

        $result=$this->select($paysitecash->getName());
        if(db_num_rows($result)==0){
            $this->insert($paysitecash->getName(),'','','EN','');
            return $paysitecash;
        }else{
            $obj=db_fetch_object($result);
            $paysitecash->setEmail($obj->business_id);
            $paysitecash->setToken($obj->token);
            $paysitecash->setFreightType($obj->additional1);
            $paysitecash->setEnabled($obj->enabled);
            $paysitecash->setTestMode($obj->testmode);


            return $paysitecash;
        }

    }
     public function getPesapal() {
        $paypalInfo=new PesapalInfo();
        $result=$this->select($paypalInfo->getName());
        if(db_num_rows($result)==0) {
            $this->insert($paypalInfo->getName(), '', '', '', '');
            return $paypalInfo;
        }else {
            $obj=db_fetch_object($result);
            $paypalInfo->setBusinessId($obj->business_id);
            $paypalInfo->setToken($obj->token);
            $paypalInfo->setEnabled($obj->enabled);
            $paypalInfo->setTestMode($obj->testmode);
            return $paypalInfo;
        }
    }  
    
       public function getGlobalPay() {
        $paysiteInfo=new GlobalPayInfo();
        $result=$this->select($paysiteInfo->getName());
        if(db_num_rows($result)==0) {
            $this->insert($paypalInfo->getName(), '', '', '', '');
            return $paysiteInfo;
        }else {
            $obj=db_fetch_object($result);
            $paysiteInfo->setBusinessId($obj->business_id);
            $paysiteInfo->setToken($obj->token);
            $paysiteInfo->setPassword($obj->additional1);
            $paysiteInfo->setPhone($obj->additional2);
            $paysiteInfo->setEnabled($obj->enabled);
            $paysiteInfo->setTestMode($obj->testmode);
            return $paysiteInfo;
        }
    }  

    
    public function getIdealing(){
        $ideal=new CIdealing();
        $result=$this->select($ideal->getName());
        if(db_num_rows($result)==0){
            $this->insert($ideal->getName(),'','','','');
            return $ideal;
        }else{
            $obj=db_fetch_object($result);
            $ideal->setEnabled($obj->enabled);
            $ideal->setTestMode($obj->testmode);
            return $ideal;
        }
    }
    
    public function updateIdealing($ideal){
        $this->update($ideal->getName(), '', '', $ideal->isEnabled(), $ideal->isTestMode(), '', '');
    }
    
    
    public function getIdealPro(){
        $pro=new CIdealPro();
        $result=$this->select($pro->getName());
        if(db_num_rows($result)==0){
            $this->insert($pro->getName(), '', '', '', '');
            return $pro;
        }else{
            $obj=db_fetch_object($result);
            $pro->setEnabled($obj->enabled);
            $pro->setTestMode($obj->testmode);
            return $pro;
        }
    }
    
    public function updateIdealPro($pro){
        $this->update($pro->getName(), '', '', $pro->isEnabled(), $pro->isTestMOde(), '', '');
    }

    public function updateGlobalPay($paypalInfo) {
  
        $this->update($paypalInfo->getName(),$paypalInfo->getBusinessId(),$paypalInfo->getToken(),$paypalInfo->isEnabled(), $paypalInfo->isTestMode(), $paypalInfo->getPassword(), $paypalInfo->getPhone());
    }    
   public function updatePaysitecash($paysitecash){

        $this->update($paysitecash->getName(), $paysitecash->getEmail(), $paysitecash->getToken(), $paysitecash->isEnabled(), $paysitecash->isTestMode(), '', '');
    }
    
    
    public function updateHipay($hipayInfo) {
        $this->update($hipayInfo->getName(),$hipayInfo->getBusinessId(),$paypalInfo->getToken(),$paypalInfo->isEnabled(), $paypalInfo->isTestMode(), '','');

    }        
    
    public function updateGoogleCheckOut($googleCheckOut) {
        $this->update($googleCheckOut->getName(),$googleCheckOut->getMerchantId(),$googleCheckOut->getMerchantKey(), $googleCheckOut->isEnabled(),$googleCheckOut->isTestMode(), '','');

    }    
    public function updateDalPay($paypalInfo) {
  
        $this->update($paypalInfo->getName(),$paypalInfo->getBusinessId(),$paypalInfo->getToken(),$paypalInfo->isEnabled(), $paypalInfo->isTestMode(),$_POST['password'],'');
    }    
    public function updatePaypal($paypalInfo) {
        $this->update($paypalInfo->getName(),$paypalInfo->getBusinessId(),$paypalInfo->getToken(),$paypalInfo->isEnabled(), $paypalInfo->isTestMode(), '','');
    }   
    public function updateDalPayDirect($paypalInfo) {
        $this->update($paypalInfo->getName(),$paypalInfo->getBusinessId(),$paypalInfo->getToken(),$paypalInfo->isEnabled(), $paypalInfo->isTestMode(), $_POST['password'],'');
    }  
    public function updatePaypalPro($paypalPro) {
        $this->update($paypalPro->getName(),$paypalPro->getUsername(),$paypalPro->getPassword(),$paypalPro->isEnabled(), $paypalPro->isTestMode(),$paypalPro->getSignature(), '');
    }
    public function updateAuthnet($authnetInfo) {
        $this->update($authnetInfo->getName(),$authnetInfo->getLoginId(),$authnetInfo->getTransKey(),$authnetInfo->isEnabled(),$authnetInfo->isTestMode(), '','');
    }
    public function updateMoneyBooker($mbinfo){
        $this->update($mbinfo->getName(),$mbinfo->getMerchantEmail(),$mbinfo->getSecretword(),$mbinfo->isEnabled(),$mbinfo->isTestMode(), '','');
    }

    public function updatePayflowLink($payflowlink){
        $this->update($payflowlink->getName(),$payflowlink->getLogin(),$payflowlink->getParter(),$payflowlink->isEnabled(),'0','','');
    }
 
    public function updatePaymentasia($paymentasia){
        $this->update($paymentasia->getName(), $paymentasia->getMerchantID(), $paymentasia->getMerchantEmail(),$paymentasia->isEnabled(),$paymentasia->isTestMode(), $paymentasia->getReferenceTitle(), '');
    }

    public function updatePaymentCCAvenue($ccavenue){
        $this->update($ccavenue->getName(), $ccavenue->getMerchantID(), $ccavenue->getWorkingKey(), $ccavenue->isEnabled(), $ccavenue->isTestMode(), '', '');
    }

    public function updatePaymentMyGate($mygate){
        $this->update($mygate->getName(), $mygate->getMerchantID(), $mygate->getApplicationID(), $mygate->isEnabled(), $mygate->isTestMode(), '', '');
    }

    public function updatePagseguro($pageseguro){
        $this->update($pageseguro->getName(), $pageseguro->getEmail(), $pageseguro->getToken(), $pageseguro->isEnabled(), $pageseguro->isTestMode(), $pageseguro->getFreightType(), '');
    }      
    
    public function updatePesapal($paypalInfo) {
        $this->update($paypalInfo->getName(),$paypalInfo->getBusinessId(),$paypalInfo->getToken(),$paypalInfo->isEnabled(), $paypalInfo->isTestMode(), '','');
    }   
    
	
	
	
	
	
	
	
	
	
	
	
	
	
    private function select($name) {
        $sql="select * from paypal_info where name='$name'";
        return $this->db->executeQuery($sql);
    }

    private function insert($name,$businessid,$token,$additional1,$additional2) {
        $sql="insert into paypal_info(name,business_id,token,enabled,testmode,additional1,additional2) values('$name','$businessid','$token',0,1,'$additional1','$additional2');";
        //echo $sql;
        $this->db->executeQuery($sql);
    }

    private function update($name,$businessid,$token,$enabled,$testMode,$additional1,$additional2) {
        $sql="update paypal_info set business_id='$businessid',token='$token',enabled=".($enabled=='1'?1:0).",testmode=".($testMode=='1'?1:0).",additional1='$additional1',additional2='$additional2' where name='$name'";
        //echo $sql;
        $this->db->executeQuery($sql);

    }

}

 
class PayMethod {
    private $name;
    private $enabled;
    private $testmode;

    public function  __construct($name) {
        $this->name=$name;
    }

    public function getName() {
        return $this->name;
    }

    public function setEnabled($enabled) {
        $this->enabled=$enabled;
    }

    public function isEnabled() {
        return $this->enabled;
    }

    public function setTestMode($testMode) {
        $this->testmode=$testMode;
    }

    public function isTestMode() {
        return $this->testmode;
    }
}
$gateway=new PayGateway(null);



 $gateways = $gateway->get_em_all();
 
                        foreach($gateways as $this_gateway){
                 
                   	  if(file_exists("../modules/gateways/admin/classes/$this_gateway[name].php")){
                   	 
				include_once("../modules/gateways/admin/classes/$this_gateway[name].php");
			  }else{
			  
				include_once("modules/gateways/admin/classes/$this_gateway[name].php");
			  
			  }
			}
 

?>
