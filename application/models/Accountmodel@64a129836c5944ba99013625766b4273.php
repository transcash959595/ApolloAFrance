<?php

class AccountModel extends CI_Model {

public function getAccountDetails()
{

	$table = 'noofaccounts';		 
			 
			 
			 
$this->db->select('noofaccounts.accountname');
$this->db->from($table);


$queryCardDetails = $this->db->get();
			   
//$result = $queryCardDetails->result();			   
return $queryCardDetails->result();
//echo "<pre>";
//print_r($result);



}



public function getAccountTransactions($startdate,$enddate,$account)
{
$table = $account.'_temp';
$this->db->where('Date >=',$startdate);
$this->db->where('Date <=',$enddate);

$this->db->select('Date,Description,Req_code,debit,credit');
$this->db->from($table);
$queryTransactionDetails = $this->db->get();

return $queryTransactionDetails->result_array();


//echo "<pre>";
//print_r($result);


}





}