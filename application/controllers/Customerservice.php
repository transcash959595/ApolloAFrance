<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customerservice extends CI_Controller {

public function index(){







$username = $this->session->userdata('username');
$password = $this->session->userdata('password');
if(isset($username)&&isset($password))
{
$this->load->model('Accountmodel');

$data['account'] = $this->Accountmodel->getAccountDetails();
$data['startdate'] = '';
$data['enddate'] = '';
$data['accountActive'] = '';
$this->load->helper('url');
$this->load->view('account');
$this->load->view('content/accountVerticalTabs',$data);
$this->load->view('content/account',$data);
//print_r($data);

}


 
else
{



$this->load->view('login');
//print_r($this->session->all_userdata());
}




}

public function pageview($page)

{


$username = $this->session->userdata('username');
$password = $this->session->userdata('password');
if(isset($username)&&isset($password))
{
$page = 'csa/'.$page;
$this->load->helper('url');
$this->load->view($page);
//print_r($data);

}


 
else
{



$this->load->view('login');
//print_r($this->session->all_userdata());
}




}



public function userCredential()
{
$soapUrl = "https://ws-test.globalprocessing.ae:10000/hyperion_its/Service.asmx";
$soapUser = "GPSDUMMY";
$soapPassword = "1nT3gr4t10N";




/*
this is the how web site from gps web service is given 
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Header>
    <AuthSoapHeader xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <strUserName>".$soapUser."</strUserName>
      <strPassword>".$soapPassword."</strPassword>
    </AuthSoapHeader>
  </soap:Header>"; */
  
  
//$this->load->helper('array');
$userArray =array(array('soapUrl'=> $soapUrl, 'soapUser' =>$soapUser, 'soapPassword' =>$soapPassword));
return $userArray;


}


public function curlcall($xml_post_string,$url,$soapUser,$soapPassword,$callfunc)
{

$headers = array(
                        "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "SOAPAction: http://www.globalprocessing.ae/HyperionWeb/".$callfunc, 
                        "Content-length: ".strlen($xml_post_string),
                    ); //SOAPAction: your op URL

            
		

            // PHP cURL  for https connection with auth
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // converting
            $response = curl_exec($ch); 
            curl_close($ch);

            
			
			
			return  $response;


}



public function strip_soap_envelope_covert_xml_format($response)
{

//this function is to stip the soap envelope part from the response of the web service call 
// its also returning the expected result in xml format
$response  =  str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>', '', $response);
$response  = str_ireplace('</soap:Body></soap:Envelope>', '', $response);
			if ($response === false) {
				$error_occurred = true;
				}
				else {

					$xml =  simplexml_load_string($response);

					
				}


return $xml;
}



public function Ws_Activate()
{

$soapUrl = "https://ws-test.globalprocessing.ae:10000/hyperion_its/Service.asmx"; // asmx URL of WSDL
        $soapUser = "GPSDUMMY";  //  username
        $soapPassword = "1nT3gr4t10N"; // password

$xml_post_string = "
<soapenv:Envelope xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/' xmlns:hyp='http://www.globalprocessing.ae/HyperionWeb'>
<soapenv:Header>
<hyp:AuthSoapHeader>
<hyp:strUserName>".$soapUser."</hyp:strUserName>
<hyp:strPassword>".$soapPassword."</hyp:strPassword>
</hyp:AuthSoapHeader>
</soapenv:Header>
<soapenv:Body>
<hyp:Ws_Activate>
<hyp:WSID>454545</hyp:WSID>
<hyp:IssCode>PMT</hyp:IssCode>
<hyp:TxnCode>0</hyp:TxnCode>
<hyp:ClientCode></hyp:ClientCode>
<hyp:Title>Mr</hyp:Title>
<hyp:LastName>Lastname</hyp:LastName>
<hyp:FirstName>Firstname</hyp:FirstName>
<hyp:Addrl1>Office 13, Telfords Yard </hyp:Addrl1>
<hyp:Addrl2>6-8 The Highway, Wapping</hyp:Addrl2>
<hyp:City>London</hyp:City>
<hyp:PostCode>E1W 2BS</hyp:PostCode>
<hyp:Country>826</hyp:Country>
<hyp:ActMethod>6</hyp:ActMethod>
<hyp:PAN></hyp:PAN>
<hyp:Track2></hyp:Track2>
<hyp:PublicToken>123456789</hyp:PublicToken>
<hyp:DOB></hyp:DOB>
<hyp:CVV></hyp:CVV>
<hyp:AccCode></hyp:AccCode>
<hyp:ExpDate></hyp:ExpDate>
<hyp:LocDate>2013-01-01</hyp:LocDate>
<hyp:LocTime>120000</hyp:LocTime>
<hyp:Reason></hyp:Reason>
<hyp:ItemSrc>2</hyp:ItemSrc>
<hyp:SecID>0</hyp:SecID>
<hyp:SecVal></hyp:SecVal>
<hyp:SecValPos>0</hyp:SecValPos>
<hyp:SMSBalance>0</hyp:SMSBalance>
</hyp:Ws_Activate>
</soapenv:Body>
</soapenv:Envelope>


"; 

$arrayReturnedUserCredential = $this->userCredential();

$callfunc = "Ws_Activate";



$response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc);





}


public function Ws_CreateCard()

{
$this->load->helper('date');
$timezone = 'UM8';
$daylight_saving = TRUE;
$now = time();

$locTmeConversion = gmt_to_local($now, $timezone, $daylight_saving);


//$time = time();
$locTime =  mdate("%H%i%s", $locTmeConversion);
$locDate =  mdate("%Y-%m-%d", $locTmeConversion);





$soapUrl = "https://ws-test.globalprocessing.ae:10000/hyperion_its/Service.asmx"; // asmx URL of WSDL
        $soapUser = "GPSDUMMY";  //  username
        $soapPassword = "1nT3gr4t10N"; // password

$xml_post_string = "<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Header>
    <AuthSoapHeader xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <strUserName>GPSDUMMY</strUserName>
      <strPassword>1nT3gr4t10N</strPassword>
    </AuthSoapHeader>
  </soap:Header>
  <soap:Body>
    <Ws_CreateCard xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <WSID>500085</WSID>
      <IssCode>PMT</IssCode>
      <TxnCode>10</TxnCode>
      <ClientCode></ClientCode>
      <Title></Title>
      <LastName>Ankit</LastName>
      <FirstName>Pandey</FirstName>
      <Addrl1>Unit 4, Midleton Gate</Addrl1>
      <Addrl2>Guildford</Addrl2>
      <Addrl3></Addrl3>
      <City>Guildford</City>
      <PostCode>GU2 8SG</PostCode>
      <Country>826</Country>
      <Mobile>1483303666</Mobile>
      <CardDesign>1628</CardDesign>
      <ExternalRef></ExternalRef>
      <DOB>1984-01-01</DOB>
      <LocDate>".$locDate."</LocDate>
      <LocTime>".$locTime."</LocTime>
      <TerminalID></TerminalID>
      <LoadValue>0</LoadValue>
      <CurCode>GBP</CurCode>
      <Reason></Reason>
      <AccCode></AccCode>
      <ItemSrc>2</ItemSrc>
      <LoadFundsType>4</LoadFundsType>
      <LoadSrc>10</LoadSrc>
      <LoadFee>0.0</LoadFee>
      <LoadedBy>Admin</LoadedBy>
      <CreateImage>0</CreateImage>
      <CreateType>2</CreateType>
      <CustAccount></CustAccount>
      <ActivateNow>0</ActivateNow>
      <Source_desc></Source_desc>
      <ExpDate></ExpDate>
      <CardName></CardName>
      <LimitsGroup>PMT-VL-001</LimitsGroup>
      <MCCGroup></MCCGroup>
      <PERMSGroup>PMT-CU-001</PERMSGroup>
      <ProductRef></ProductRef>
      <CarrierType></CarrierType>
      <Fulfil1></Fulfil1>
      <Fulfil2></Fulfil2>
      <DelvMethod>0</DelvMethod>
      <ThermalLine1></ThermalLine1>
      <ThermalLine2></ThermalLine2>
      <EmbossLine4></EmbossLine4>
      <ImageId></ImageId>
      <LogoFrontId></LogoFrontId>
      <LogoBackId></LogoBackId>
      <Replacement>0</Replacement>
      <FeeGroup></FeeGroup>
      <PrimaryToken></PrimaryToken>
      <Delv_AddrL1> </Delv_AddrL1>
      <Delv_AddrL2></Delv_AddrL2>
      <Delv_AddrL3></Delv_AddrL3>
      <Delv_City></Delv_City>
      <Delv_County></Delv_County>
      <Delv_PostCode></Delv_PostCode>
      <Delv_Country>826</Delv_Country>
      <Delv_Code></Delv_Code>
      <Lang>En</Lang>
      <Sms_Required>0</Sms_Required>
      <SchedFeeGroup></SchedFeeGroup>
      <WSFeeGroup></WSFeeGroup>
      <CardManufacturer></CardManufacturer>
      <CoBrand></CoBrand>
      <PublicToken></PublicToken>
      <ExternalAuth>0</ExternalAuth>
      <LinkageGroup></LinkageGroup>
      <VanityName>Ankit</VanityName>
      <PBlock></PBlock>
      <PINMailer>0</PINMailer>
      <FxGroup></FxGroup>
      <Email>ankitp@transcash.com</Email>
      <MailOrSMS>0</MailOrSMS>
      <AuthCalendarGroup></AuthCalendarGroup>
      <Quantity>1</Quantity>
      <LoadToken></LoadToken>
    </Ws_CreateCard>
  </soap:Body>
</soap:Envelope>
"; 

$arrayReturnedUserCredential = $this->userCredential();



$callfunc = "Ws_CreateCard";



$response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc);
//$xml_formated_response = $this->strip_soap_envelope_covert_xml_format($response);
		  // print($xml_formated_response);
	//echo $response;	  
		  
		  $response  =  str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>', '', $response);
$response  = str_ireplace('</soap:Body></soap:Envelope>', '', $response);
			if ($response === false) {
				$error_occurred = true;
				}
				else {

					$xml =  simplexml_load_string($response);

					
				}
				
					print_r($xml);
				

}




public function Ws_Load()

{



$credentials = $this->userCredential();

foreach($credentials as $userdata)
{
$soapUrl = $userdata['soapUrl'];
$soapUser = $userdata['soapUser'];
$soapPassword = $userdata['soapPassword'];

}
 

 $xml_post_string = "<soapenv:Envelope xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/' xmlns:hyp='http://www.globalprocessing.ae/HyperionWeb'>
<soapenv:Header>
<hyp:AuthSoapHeader>
<hyp:strUserName>".$soapUser."</hyp:strUserName>
<hyp:strPassword>".$soapPassword."</hyp:strPassword>
</hyp:AuthSoapHeader>
</soapenv:Header>
<soapenv:Body>
<hyp:Ws_Load>
<hyp:WSID>123477</hyp:WSID>
<hyp:IssCode>PMT</hyp:IssCode>
<hyp:TxnCode>1</hyp:TxnCode>
<hyp:ClientCode></hyp:ClientCode>
<hyp:AuthType>1</hyp:AuthType>
<hyp:PAN></hyp:PAN>
<hyp:Track2></hyp:Track2>
<hyp:PublicToken>123456789</hyp:PublicToken>
<hyp:DOB></hyp:DOB>
<hyp:CVV></hyp:CVV>
<hyp:AccCode></hyp:AccCode>
<hyp:LastName></hyp:LastName>
<hyp:LocDate>2016-02-02</hyp:LocDate>
<hyp:LocTime>120000</hyp:LocTime>
<hyp:TerminalID></hyp:TerminalID>
<hyp:LoadValue>10</hyp:LoadValue>
<hyp:CurrCode>USD</hyp:CurrCode>
<hyp:LoadFundsType>4</hyp:LoadFundsType>
<hyp:LoadSrc>10</hyp:LoadSrc>
<hyp:LoadFee>0.0</hyp:LoadFee>
<hyp:SecID>0</hyp:SecID>
<hyp:SecVal></hyp:SecVal>
<hyp:SecValPos>0</hyp:SecValPos>
<hyp:LoadedBy>Admin</hyp:LoadedBy>
<hyp:Description>Test Load</hyp:Description>
<hyp:BrnCode>Branch 12</hyp:BrnCode>
</hyp:Ws_Load>
</soapenv:Body>
</soapenv:Envelope>";   // data from the form, e.g. some ID number


$callfunc = "Ws_Load";

           $response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc);
		   
		   





}





public function Ws_WebServiceResult($webserviceId)

{


$credentials = $this->userCredential(); 
//fetching the credentials for the call from different function

foreach($credentials as $userdata)
{
//returned is the array from the userCredential function, userCredential has the credential provided by the Processor.
// running a loop to fetch the required information for the final call 
$soapUrl = $userdata['soapUrl'];
$soapUser = $userdata['soapUser'];
$soapPassword = $userdata['soapPassword'];

}
		
		
$xml_post_string = "<soapenv:Envelope xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/' xmlns:hyp='http://www.globalprocessing.ae/HyperionWeb'>
<soapenv:Header>
<hyp:AuthSoapHeader>
<hyp:strUserName>".$soapUser."</hyp:strUserName>
<hyp:strPassword>".$soapPassword."</hyp:strPassword>
</hyp:AuthSoapHeader>
</soapenv:Header>
<soapenv:Body>
<hyp:Ws_WebServiceResult>
<hyp:WSID>".$webserviceId."</hyp:WSID>
<hyp:Isscode>PMT</hyp:Isscode>
</hyp:Ws_WebServiceResult>
</soapenv:Body>
</soapenv:Envelope>
";  





           $callfunc = "Ws_WebServiceResult"; // Naming the parameter to define the type of call in the soap request

           $response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc); //making a curl call to 
		   //echo $response;
           $response  =  str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>', '', $response);
           $response  =  str_ireplace('</soap:Body></soap:Envelope>', '', $response);
			

					$xml =  simplexml_load_string($response);

					
			

              print_r($xml);


}
//-------------------------------------------------------------------------


public function Ws_Activate_Load()

{


$credentials = $this->userCredential();

foreach($credentials as $userdata)
{
$soapUrl = $userdata['soapUrl'];
$soapUser = $userdata['soapUser'];
$soapPassword = $userdata['soapPassword'];

}
		
		
$xml_post_string = "<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Header>
    <AuthSoapHeader xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <strUserName>".$soapUser."</strUserName>
      <strPassword>".$soapUser."</strPassword>
    </AuthSoapHeader>
  </soap:Header>
  <soap:Body>
    <Ws_Activate_Load xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <WSID>45454522</WSID>
      <IssCode>string</IssCode>
      <TxnCode>string</TxnCode>
      <ClientCode>string</ClientCode>
      <Title>string</Title>
      <LastName>string</LastName>
      <FirstName>string</FirstName>
      <Addrl1>string</Addrl1>
      <Addrl2>string</Addrl2>
      <City>string</City>
      <PostCode>string</PostCode>
      <Country>string</Country>
      <ActMethod>string</ActMethod>
      <AuthType>string</AuthType>
      <PAN>string</PAN>
      <Track2>string</Track2>
      <PublicToken>string</PublicToken>
      <CardDesign>string</CardDesign>
      <ExternalRef>string</ExternalRef>
      <DOB>string</DOB>
      <CVV>string</CVV>
      <AccCode>string</AccCode>
      <LocDate>string</LocDate>
      <LocTime>string</LocTime>
      <TerminalID>string</TerminalID>
      <LoadValue>double</LoadValue>
      <CurCode>string</CurCode>
      <Reason>string</Reason>
      <ExpDate>string</ExpDate>
      <ItemSrc>int</ItemSrc>
      <LoadFundsType>string</LoadFundsType>
      <LoadSrc>string</LoadSrc>
      <LoadFee>double</LoadFee>
      <SecID>int</SecID>
      <SecVal>string</SecVal>
      <SecValPos>int</SecValPos>
      <LoadedBy>string</LoadedBy>
      <ActivateOrNot>int</ActivateOrNot>
      <PANorToken>int</PANorToken>
      <CustAccount>string</CustAccount>
      <SMSBalance>string</SMSBalance>
      <Description>string</Description>
      <BrnCode>string</BrnCode>
    </Ws_Activate_Load>
  </soap:Body>
</soap:Envelope>";  





$callfunc = "Ws_Activate_Load";

           $response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc);

$response  =  str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>', '', $response);
$response  = str_ireplace('</soap:Body></soap:Envelope>', '', $response);
			if ($response === false) {
				$error_occurred = true;
				}
				else {

					$xml =  simplexml_load_string($response);

					print_r($xml);
				}




}







public function Ws_Balance_Enquiry()

{


$credentials = $this->userCredential();

foreach($credentials as $userdata)
{
$soapUrl = $userdata['soapUrl'];
$soapUser = $userdata['soapUser'];
$soapPassword = $userdata['soapPassword'];

}
		
		
$xml_post_string = "<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Header>
    <AuthSoapHeader xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <strUserName>".$soapUser."</strUserName>
      <strPassword>".$soapPassword."</strPassword>
    </AuthSoapHeader>
  </soap:Header>
  <soap:Body>
    <Ws_Balance_Enquiry xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <WSID></WSID>
      <IssCode>string</IssCode>
      <TxnCode>string</TxnCode>
      <ClientCode>string</ClientCode>
      <ItemSrc>int</ItemSrc>
      <AuthType>string</AuthType>
      <PAN>string</PAN>
      <Track2>string</Track2>
      <PublicToken>string</PublicToken>
      <DOB>string</DOB>
      <CVV>string</CVV>
      <AccCode>string</AccCode>
      <LastName>string</LastName>
      <LocDate>string</LocDate>
      <LocTime>string</LocTime>
      <TerminalID>string</TerminalID>
      <GetLimits>string</GetLimits>
      <SecID>int</SecID>
      <SecVal>string</SecVal>
      <SecValPos>int</SecValPos>
    </Ws_Balance_Enquiry>
  </soap:Body>
</soap:Envelope>";  





$callfunc = "Ws_Balance_Enquiry";

           $response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc);

$response  =  str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>', '', $response);
$response  = str_ireplace('</soap:Body></soap:Envelope>', '', $response);
			if ($response === false) {
				$error_occurred = true;
				}
				else {

					$xml =  simplexml_load_string($response);

					print_r($xml);
				}




}





public function Ws_BalanceTransfer()

{


$credentials = $this->userCredential();

foreach($credentials as $userdata)
{
$soapUrl = $userdata['soapUrl'];
$soapUser = $userdata['soapUser'];
$soapPassword = $userdata['soapPassword'];

}
		
		
$xml_post_string = "<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Header>
    <AuthSoapHeader xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <strUserName>".$soapUser."</strUserName>
      <strPassword>".$soapPassword."</strPassword>
    </AuthSoapHeader>
  </soap:Header>
  <soap:Body>
    <Ws_BalanceTransfer xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <WSID>long</WSID>
      <IssCode>string</IssCode>
      <TxnCode>string</TxnCode>
      <ClientCode>string</ClientCode>
      <AuthType>string</AuthType>
      <PAN>string</PAN>
      <Track2>string</Track2>
      <PublicToken>string</PublicToken>
      <DOB>string</DOB>
      <CVV>string</CVV>
      <AccCode>string</AccCode>
      <LastName>string</LastName>
      <LocDate>string</LocDate>
      <LocTime>string</LocTime>
      <TerminalID>string</TerminalID>
      <NewPAN>string</NewPAN>
      <NewToken>string</NewToken>
      <AmtTxn>double</AmtTxn>
      <CurrCode>string</CurrCode>
      <LoadSrc>string</LoadSrc>
      <SecID>int</SecID>
      <SecVal>string</SecVal>
      <SecValPos>int</SecValPos>
      <Description>string</Description>
      <LoadedBy>string</LoadedBy>
      <FeeWaiver>string</FeeWaiver>
      <BrnCode>string</BrnCode>
    </Ws_BalanceTransfer>
  </soap:Body>
</soap:Envelope>
";  





$callfunc = "Ws_BalanceTransfer";

           $response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc);

$response  =  str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>', '', $response);
$response  = str_ireplace('</soap:Body></soap:Envelope>', '', $response);
			if ($response === false) {
				$error_occurred = true;
				}
				else {

					$xml =  simplexml_load_string($response);

					print_r($xml);
				}




}






public function Ws_BulkCreation()

{


$credentials = $this->userCredential();

foreach($credentials as $userdata)
{
$soapUrl = $userdata['soapUrl'];
$soapUser = $userdata['soapUser'];
$soapPassword = $userdata['soapPassword'];

}
		
		
$xml_post_string = "<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Header>
    <AuthSoapHeader xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <strUserName>".$soapUser."</strUserName>
      <strPassword>".$soapPassword."</strPassword>
    </AuthSoapHeader>
  </soap:Header>
  <soap:Body>
    <Ws_BulkCreation xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <doc>xml</doc>
    </Ws_BulkCreation>
  </soap:Body>
</soap:Envelope>
";  





$callfunc = "Ws_BulkCreation>";

           $response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc);

$response  =  str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>', '', $response);
$response  = str_ireplace('</soap:Body></soap:Envelope>', '', $response);
			if ($response === false) {
				$error_occurred = true;
				}
				else {

					$xml =  simplexml_load_string($response);

					print_r($xml);
				}




}






public function Ws_UnLoad()

{


$credentials = $this->userCredential();

foreach($credentials as $userdata)
{
$soapUrl = $userdata['soapUrl'];
$soapUser = $userdata['soapUser'];
$soapPassword = $userdata['soapPassword'];

}
		
		
$xml_post_string = "<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Header>
    <AuthSoapHeader xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <strUserName>".$soapUser."</strUserName>
      <strPassword>".$soapPassword."</strPassword>
    </AuthSoapHeader>
  </soap:Header>
  <soap:Body>
    <Ws_UnLoad xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <WSID>long</WSID>
      <IssCode>string</IssCode>
      <TxnCode>string</TxnCode>
      <ClientCode>string</ClientCode>
      <AuthType>string</AuthType>
      <PAN>string</PAN>
      <Track2>string</Track2>
      <PublicToken>string</PublicToken>
      <DOB>string</DOB>
      <CVV>string</CVV>
      <AccCode>string</AccCode>
      <LastName>string</LastName>
      <LocDate>string</LocDate>
      <LocTime>string</LocTime>
      <TerminalID>string</TerminalID>
      <LoadFundsType>string</LoadFundsType>
      <LoadSrc>string</LoadSrc>
      <AmtUnLoad>double</AmtUnLoad>
      <CurrCode>string</CurrCode>
      <SecID>int</SecID>
      <SecVal>string</SecVal>
      <SecValPos>int</SecValPos>
      <LoadedBy>string</LoadedBy>
      <Description>string</Description>
    </Ws_UnLoad>
  </soap:Body>
</soap:Envelope>
";  





$callfunc = "Ws_UnLoad";

           $response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc);

$response  =  str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>', '', $response);
$response  = str_ireplace('</soap:Body></soap:Envelope>', '', $response);
			if ($response === false) {
				$error_occurred = true;
				}
				else {

					$xml =  simplexml_load_string($response);

					print_r($xml);
				}




}






public function Ws_Transaction_Void()

{


$credentials = $this->userCredential();

foreach($credentials as $userdata)
{
$soapUrl = $userdata['soapUrl'];
$soapUser = $userdata['soapUser'];
$soapPassword = $userdata['soapPassword'];

}
		
		
$xml_post_string = "<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Header>
    <AuthSoapHeader xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <strUserName>".$soapUser."</strUserName>
      <strPassword>".$soapPassword."</strPassword>
    </AuthSoapHeader>
  </soap:Header>
  <soap:Body>
    <Ws_Transaction_Void xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <WSID>long</WSID>
      <IssCode>string</IssCode>
      <TxnCode>string</TxnCode>
      <ClientCode>string</ClientCode>
      <AuthType>string</AuthType>
      <PAN>string</PAN>
      <Track2>string</Track2>
      <PublicToken>string</PublicToken>
      <DOB>string</DOB>
      <CVV>string</CVV>
      <AccCode>string</AccCode>
      <LastName>string</LastName>
      <LocDate>string</LocDate>
      <LocTime>string</LocTime>
      <OrgItemId>int</OrgItemId>
      <Note>string</Note>
      <SecID>int</SecID>
      <SecVal>string</SecVal>
      <SecValPos>int</SecValPos>
    </Ws_Transaction_Void>
  </soap:Body>
</soap:Envelope>";  





$callfunc = "Ws_Transaction_Void";

           $response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc);

$response  = str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>', '', $response);
$response  = str_ireplace('</soap:Body></soap:Envelope>', '', $response);
			if ($response === false) {
				$error_occurred = true;
				}
				else {

					$xml =  simplexml_load_string($response);

					print_r($xml);
				}




}




public function Ws_StatusChange($webserviceId)

{


$credentials = $this->userCredential();

foreach($credentials as $userdata)
{
$soapUrl = $userdata['soapUrl'];
$soapUser = $userdata['soapUser'];
$soapPassword = $userdata['soapPassword'];

}
		
		
$xml_post_string = "<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Header>
    <AuthSoapHeader xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <strUserName>".$soapUser."</strUserName>
      <strPassword>".$soapPassword."</strPassword>
    </AuthSoapHeader>
  </soap:Header>
  <soap:Body>
    <Ws_StatusChange xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <WSID>long</WSID>
      <IssCode>string</IssCode>
      <TxnCode>string</TxnCode>
      <ClientCode>string</ClientCode>
      <AuthType>string</AuthType>
      <PAN>string</PAN>
      <Track2>string</Track2>
      <PublicToken>string</PublicToken>
      <DOB>string</DOB>
      <CVV>string</CVV>
      <AccCode>string</AccCode>
      <LastName>string</LastName>
      <LocDate>string</LocDate>
      <LocTime>string</LocTime>
      <NewStatCode>string</NewStatCode>
      <Reason>string</Reason>
      <ItemSrc>int</ItemSrc>
      <TerminalID>string</TerminalID>
      <SecID>int</SecID>
      <SecVal>string</SecVal>
      <SecValPos>int</SecValPos>
      <Sms_Required>string</Sms_Required>
    </Ws_StatusChange>
  </soap:Body>
</soap:Envelope>
";  





$callfunc = "Ws_StatusChange";

           $response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc);

$response  =  str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>', '', $response);
$response  = str_ireplace('</soap:Body></soap:Envelope>', '', $response);
			if ($response === false) {
				$error_occurred = true;
				}
				else {

					$xml =  simplexml_load_string($response);

					print_r($xml);
				}




}



public function Ws_Update_Cardholder_Details()

{


$credentials = $this->userCredential();

foreach($credentials as $userdata)
{
$soapUrl = $userdata['soapUrl'];
$soapUser = $userdata['soapUser'];
$soapPassword = $userdata['soapPassword'];

}
		
		
$xml_post_string = "<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Header>
    <AuthSoapHeader xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <strUserName>".$soapUser."</strUserName>
      <strPassword>".$soapPassword."</strPassword>
    </AuthSoapHeader>
  </soap:Header>
  <soap:Body>
    <Ws_Update_Cardholder_Details xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <WSID>long</WSID>
      <IssCode>string</IssCode>
      <TxnCode>string</TxnCode>
      <ClientCode>string</ClientCode>
      <AuthType>string</AuthType>
      <PAN>string</PAN>
      <Track2>string</Track2>
      <DOB>string</DOB>
      <CVV>string</CVV>
      <accCode>string</accCode>
      <newAccCode>string</newAccCode>
      <crdProduct>string</crdProduct>
      <lastName>string</lastName>
      <Title>string</Title>
      <firstName>string</firstName>
      <addr1>string</addr1>
      <addr2>string</addr2>
      <city>string</city>
      <postcode>string</postcode>
      <country>string</country>
      <tel>string</tel>
      <Workaddr1>string</Workaddr1>
      <Workaddr2>string</Workaddr2>
      <Workaddr3>string</Workaddr3>
      <Workcity>string</Workcity>
      <Workpostcode>string</Workpostcode>
      <Workcounty>string</Workcounty>
      <Workcountry>string</Workcountry>
      <Worktel>string</Worktel>
      <pobox>string</pobox>
      <email>string</email>
      <fax>string</fax>
      <mobTel>string</mobTel>
      <maritalStatus>string</maritalStatus>
      <sex>string</sex>
      <embossName>string</embossName>
      <refuseCheck>string</refuseCheck>
      <mailShots>string</mailShots>
      <discret>string</discret>
      <userdata>string</userdata>
      <userdata1>string</userdata1>
      <userdata2>string</userdata2>
      <userdata3>string</userdata3>
      <userdata4>string</userdata4>
      <pin>string</pin>
      <imageID>string</imageID>
      <brncode>string</brncode>
      <renew>string</renew>
      <dlvMethod>string</dlvMethod>
      <denyMCC>string</denyMCC>
      <denySvc>string</denySvc>
      <accType>string</accType>
      <memo>string</memo>
      <memoScope>int</memoScope>
      <memoUser>string</memoUser>
      <itemSrc>int</itemSrc>
      <dlvTitle>string</dlvTitle>
      <dlvfirstName>string</dlvfirstName>
      <dlvlastName>string</dlvlastName>
      <dlvaddr1>string</dlvaddr1>
      <dlvaddr2>string</dlvaddr2>
      <dlvaddr3>string</dlvaddr3>
      <dlvcity>string</dlvcity>
      <dlvpostcode>string</dlvpostcode>
      <dlvcounty>string</dlvcounty>
      <dlvcountry>string</dlvcountry>
      <dlvtel>string</dlvtel>
      <dlvEffDate>string</dlvEffDate>
      <dlvDaysValid>int</dlvDaysValid>
      <crdprogram>string</crdprogram>
      <crddesign>string</crddesign>
      <feeTier>string</feeTier>
      <isoLang>string</isoLang>
      <fundcrdPAN>string</fundcrdPAN>
      <fundCrdEffDate>string</fundCrdEffDate>
      <fundCrdExpDate>string</fundCrdExpDate>
      <fundCrdType>string</fundCrdType>
      <fundCrdIssNum>int</fundCrdIssNum>
      <fundCrdCVC>int</fundCrdCVC>
      <svcSrc>int</svcSrc>
      <svcType>int</svcType>
      <svcStatus>int</svcStatus>
      <secID>int</secID>
      <SecVal>string</SecVal>
      <SecValPos>int</SecValPos>
      <PublicToken>string</PublicToken>
      <SmsBalance>int</SmsBalance>
      <CustAccount>string</CustAccount>
      <VanityName>string</VanityName>
      <addr3>string</addr3>
      <CarrierType>string</CarrierType>
    </Ws_Update_Cardholder_Details>
  </soap:Body>
</soap:Envelope>
";  





$callfunc = "Ws_Update_Cardholder_Details";

           $response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc);

$response  =  str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>', '', $response);
$response  = str_ireplace('</soap:Body></soap:Envelope>', '', $response);
			if ($response === false) {
				$error_occurred = true;
				}
				else {

					$xml =  simplexml_load_string($response);

					print_r($xml);
				}




}





public function Ws_Card_TransactionXML()

{


$credentials = $this->userCredential();

foreach($credentials as $userdata)
{
$soapUrl = $userdata['soapUrl'];
$soapUser = $userdata['soapUser'];
$soapPassword = $userdata['soapPassword'];

}
		
		
$xml_post_string = "<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Header>
    <AuthSoapHeader xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <strUserName>".$soapUrl."</strUserName>
      <strPassword>".$soapPassword."</strPassword>
    </AuthSoapHeader>
  </soap:Header>
  <soap:Body>
    <Ws_Card_TransactionXML xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <WSID>long</WSID>
      <IssCode>string</IssCode>
      <TxnCode>string</TxnCode>
      <ClientCode>string</ClientCode>
      <ItemSrc>int</ItemSrc>
      <AuthType>string</AuthType>
      <PAN>string</PAN>
      <Track2>string</Track2>
      <PublicToken>string</PublicToken>
      <DOB>string</DOB>
      <CVV>string</CVV>
      <AccCode>string</AccCode>
      <LastName>string</LastName>
      <LocDate>string</LocDate>
      <LocTime>string</LocTime>
      <TerminalID>string</TerminalID>
      <SecID>int</SecID>
      <SecVal>string</SecVal>
      <SecValPos>int</SecValPos>
      <StartDate>string</StartDate>
      <EndDate>string</EndDate>
      <NumTxn>int</NumTxn>
      <DataSrc>int</DataSrc>
    </Ws_Card_TransactionXML>
  </soap:Body>
";  





$callfunc = "Ws_Card_TransactionXML";

           $response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc);

$response  =  str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>', '', $response);
$response  = str_ireplace('</soap:Body></soap:Envelope>', '', $response);
			if ($response === false) {
				$error_occurred = true;
				}
				else {

					$xml =  simplexml_load_string($response);

					print_r($xml);
				}




}


public function Ws_CardHolder_Details_EnquiryResponse()

{


$credentials = $this->userCredential();

foreach($credentials as $userdata)
{
$soapUrl = $userdata['soapUrl'];
$soapUser = $userdata['soapUser'];
$soapPassword = $userdata['soapPassword'];

}
		
		
$xml_post_string = "<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
<soap:Header>
    <AuthSoapHeader xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <strUserName>".$soapUrl."</strUserName>
      <strPassword>".$soapPassword."</strPassword>
    </AuthSoapHeader>
  </soap:Header>
  <soap:Body>
    <Ws_CardHolder_Details_EnquiryResponse xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <Ws_CardHolder_Details_EnquiryResult>
        <WSID>long</WSID>
        <IssCode>string</IssCode>
        <TxnCode>string</TxnCode>
        <LocDate>string</LocDate>
        <LocTime>string</LocTime>
        <ClientCode>string</ClientCode>
        <PublicToken>string</PublicToken>
        <DOB>string</DOB>
        <StatCode>string</StatCode>
        <Title>string</Title>
        <FirstName>string</FirstName>
        <LastName>string</LastName>
        <Addrl1>string</Addrl1>
        <Addrl2>string</Addrl2>
        <City>string</City>
        <PostCode>string</PostCode>
        <Country>string</Country>
        <Tel>string</Tel>
        <WorkAddrl1>string</WorkAddrl1>
        <WorkAddrl2>string</WorkAddrl2>
        <WorkAddrl3>string</WorkAddrl3>
        <WorkCity>string</WorkCity>
        <WorkPostCode>string</WorkPostCode>
        <WorkCounty>string</WorkCounty>
        <WorkCountry>string</WorkCountry>
        <WorkTel>string</WorkTel>
        <EMail>string</EMail>
        <Fax>string</Fax>
        <POBox>string</POBox>
        <MobTel>string</MobTel>
        <MaritalStatus>string</MaritalStatus>
        <Sex>string</Sex>
        <AccNo>string</AccNo>
        <CrdProduct>string</CrdProduct>
        <EmbossName>string</EmbossName>
        <RefuseCheck>string</RefuseCheck>
        <MailShots>string</MailShots>
        <Discret>string</Discret>
        <UsrData>string</UsrData>
        <UsrData1>string</UsrData1>
        <UsrData2>string</UsrData2>
        <UsrData3>string</UsrData3>
        <UsrData4>string</UsrData4>
        <CurrCode>string</CurrCode>
        <ExpDate>string</ExpDate>
        <EffDate>string</EffDate>
        <SvcCode>string</SvcCode>
        <AdditionalNo>int</AdditionalNo>
        <DateCreated>string</DateCreated>
        <DateActivated>string</DateActivated>
        <CrdDesign>string</CrdDesign>
        <PIN>string</PIN>
        <DlvMethod>string</DlvMethod>
        <ImageID>string</ImageID>
        <BrnCode>string</BrnCode>
        <ReNew>string</ReNew>
        <DenyMCC>string</DenyMCC>
        <DenySVC>string</DenySVC>
        <AccType>string</AccType>
        <CVC2>string</CVC2>
        <DlvTitle>string</DlvTitle>
        <DlvFirstName>string</DlvFirstName>
        <DlvLastName>string</DlvLastName>
        <DlvAddrL1>string</DlvAddrL1>
        <DlvAddrL2>string</DlvAddrL2>
        <DlvAddrL3>string</DlvAddrL3>
        <DlvCity>string</DlvCity>
        <DlvCounty>string</DlvCounty>
        <DlvCountry>string</DlvCountry>
        <DlvTel>string</DlvTel>
        <DlvEffDate>string</DlvEffDate>
        <DlvExpDate>string</DlvExpDate>
        <IsoLang>string</IsoLang>
        <SysDate>string</SysDate>
        <ActionCode>string</ActionCode>
      </Ws_CardHolder_Details_EnquiryResult>
    </Ws_CardHolder_Details_EnquiryResponse>
  </soap:Body>
</soap:Envelope>
";  





$callfunc = "Ws_CardHolder_Details_EnquiryResponse";

           $response = $this->curlcall($xml_post_string,$soapUrl,$soapUser,$soapPassword,$callfunc);

$response  =  str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>', '', $response);
$response  = str_ireplace('</soap:Body></soap:Envelope>', '', $response);
			if ($response === false) {
				$error_occurred = true;
				}
				else {

					$xml =  simplexml_load_string($response);

					print_r($xml);
				}




}


	
	
	






}






































?>