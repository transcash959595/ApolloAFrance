<?php

class TransactionModel extends CI_Model {

public function getTransactionDetails($cardnumber)
{

			 
			 
			 
			 
$this->db->select('transactions.cardnumberdetails, transactions.description, transactions.date , transactions.amount, transactions.credit, transactions.debit, cardnumber.balance');
$this->db->from('transactions');
$this->db->join('cardnumber', 'transactions.cardnumberdetails = cardnumber.cardnumberdetails','inner');
$this->db->where('transactions.cardnumberdetails',$cardnumber);
$queryTransactionsDetails = $this->db->get();
			   
$result = $queryTransactionsDetails->result();			   
return $queryTransactionsDetails->result();
$queryTransactionsDetails = $this->db->get();
			   
$result = $queryTransactionsDetails->result();			   
return $queryTrasactionsDetails->result();
//echo "<pre>";
//print_r($result);



}


}

