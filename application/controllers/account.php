<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account extends CI_Controller {

public function index()
{
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



public function revenue()
{
$this->load->helper('url'); // Loading the url helper
$this->load->model('Accountmodel'); // Loading the Accountmodel 
$data['rowrevenue']  = $this->Accountmodel->getRevenue(); // Calling appropriate  the function from the model 
$this->load->view('revenue',$data); // Loading the required view with the appropriate data recieved from the model

}





public function loading()
{
$this->load->helper('url'); // Loading the url helper
$this->load->model('Accountmodel'); // Loading the Accountmodel 
$data['loading']  = $this->Accountmodel->getLoading('2015-07-01','2015-12-31'); // Calling appropriate  the function from the model 
$this->load->view('loading',$data); // Loading the required view with the appropriate data recieved from the model

}



public function chart()
{

$this->load->helper('url');
$this->load->view('content/chart');

}



public function phoneserver()
{



redirect('http://10.0.1.128/');

}



public function accountfetch()

{
$startdate = $this->input->post('startdate');
$enddate = $this->input->post('enddate');
$account = $this->input->post('account');

 //$startdate ='01/01/2010'; 

//$enddate ='01/31/2010';
//$account = 'income';  

$datetime_start = strtotime($startdate);
$datetime_end   = strtotime($enddate);	
$newdate_startdate = date('Y/m/d', $datetime_start);	
$getdate_start = str_replace("/","-",$newdate_startdate);

$newdate_enddate = date('Y/m/d', $datetime_end);	
$getdate_end = str_replace("/","-",$newdate_enddate);



$this->load->model('Accountmodel');



$data  = $this->Accountmodel->getAccountTransactions($getdate_start,$getdate_end,$account);
//$data['startdate'] = $startdate;
//$data['enddate'] = $enddate;
//$data['accountActive'] = $account;
//$this->load->helper('url');
//$this->load->view('account');

//$this->load->view('content/transaction',$data);


$accountdetails = " <div class='label' > 
<input type='submit' class='changetittle' readonly='readonly' value='Change'/> <input type='submit' class ='fieldsbankrecon' readonly='readonly' value='Date' /> 
<input type='submit' class ='fieldsbankrecon' readonly='readonly' value='Description'/> <input type='submit' class ='fieldsbankrecon' readonly='readonly' value='ReqCode'/> 
<input type='submit' class ='fieldsbankrecon' readonly='readonly' value='Debit' /> <input type='submit' class ='fieldsbankrecon' readonly='readonly' value='Credit' />
 <input type='submit' class ='fieldsbankrecon' readonly='readonly' value='Balance'/> </div></br>";

 foreach($data as $transactiondetails)
 
 {




$Description = $transactiondetails['Description']; 	
$Req_code = $transactiondetails['Req_code'];
$phpdate = strtotime( $transactiondetails['Date'] );
$date = date( 'm-d-Y ', $phpdate );

if($Description=='Sub Total Fees')

{

$accountdetails = $accountdetails."<div class='row".$account."'>
	
		<input type='text'  readonly='readonly' value='*************' style='background:#BD7162; width:113px; float:left;'> 
		 <input type='text' class='fieldsbankreconDate' readonly='readonly' value='$date ' style='background:#BD7162'> 
		 <input type='text' class='fieldsbankreconDes' readonly='readonly' value='$Description' style='background:#BD7162'> 
		 <input type='text' class='fieldsbankreconReq' readonly='readonly' value='$Req_code' style='background:#BD7162'> 
		 <input type='text' class='fieldsbankreconDebit' readonly='readonly' value='FEES' style='background:#BD7162' > 
		 <input type='text' class='fieldsbankreconCredit' readonly='readonly' value='$account' style='background:#BD7162'> 	 
         <input class='fieldsbankreconnot' type='text' style='background:#BD7162' value='*************' readonly='readonly' ></input>
		 <input class='ckboxsubtotal.$account' type='checkbox' value='ckboxsubtotal.$account.$date' name='checkedsubtotal' style='background:#BD7162'></input>
	
	</div></br> "; 




}


else

{

   if($transactiondetails['debit']=='' && $transactiondetails['credit'] !='')
	{
	
	$amount = $transactiondetails['credit'];
    

	
	$accountdetails = $accountdetails."<div class='row".$account."'>
	<input type='checkbox' name='checked' value ='$amount ' class='ckbox".$account."'><input type='text' class='chng".$account."' readonly='readonly' value='Change'> 
		<input type='text' class='confirm".$account."' readonly='readonly' value='Confirm' style='display:none'> 
		 <input type='text' class='fieldsbankreconDate' readonly='readonly' value='$date '> 
		 <input type='text' class='fieldsbankreconDes' readonly='readonly' value='$Description'> 
		 <input type='text' class='fieldsbankreconReq' readonly='readonly' value='$Req_code'> 
		 <input type='text' class='fieldsbankreconDebit' readonly='readonly' value='' > 
		 <input type='text' class='fieldsbankreconCredit' readonly='readonly' value='$$amount' style='color:green;'> 
		 <input type='hidden' class='notreconciled' readonly='readonly' value=''> 
		 <input type='text' class='fieldsbankreconnot' readonly='readonly' value=''> 
		 <input type='hidden' class='checkboxretain' readonly='readonly' value=''> 
	
	</div></br> "; 
	 }
	 
	 else 
	
	
	{
	
	
	if($transactiondetails['credit'] =='' && $transactiondetails['debit'] !='')
	
	{$amount= $transactiondetails['debit'];
   
	
	$accountdetails = $accountdetails. "<div class='row".$account."'>
	<input type='checkbox' name='checked' value ='-$amount ' class='ckbox".$account."'><input type='text' class='chng$account' readonly='readonly' value='Change'> 
		<input type='text' class='confirm".$account."' readonly='readonly' value='Confirm' style='display:none'> 
		 <input type='text' class='fieldsbankreconDate' readonly='readonly' value='$date '> 
		 <input type='text' class='fieldsbankreconDes' readonly='readonly' value='$Description'> 
		 <input type='text' class='fieldsbankreconReq' readonly='readonly' value='$Req_code'> 
		 <input type='text' class='fieldsbankreconDebit' readonly='readonly' value='$$amount' style='color:red;' > 
		 <input type='text' class='fieldsbankreconCredit' readonly='readonly' value='' > 
		 <input type='hidden' class='notreconciled' readonly='readonly' value=''> 
		 <input type='text' class='fieldsbankreconnot' readonly='readonly' value=''> 
		 <input type='hidden' class='checkboxretain' readonly='readonly' value=''> 
	</div></br> "; 
	
	}
	
     }
	
	
	



}


}









echo json_encode(array(array("startdate" =>"$startdate","enddate" =>"$enddate","accountdetails"=>"$accountdetails")));






}

}




















?>