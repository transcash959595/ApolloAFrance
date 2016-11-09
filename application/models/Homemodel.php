<?php

class HomeModel extends CI_Model {

public function getCardDetails($pan)
{

			 
			 
			 
			 
$this->db->select('userprofile.pan, userprofile.cardnumberdetails, cardnumber.balance, userprofile.status');
$this->db->from('userprofile');
$this->db->join('cardnumber', 'userprofile.cardnumberdetails = cardnumber.cardnumberdetails','inner');
$this->db->where('userprofile.pan',$pan);
$queryCardDetails = $this->db->get();
			   
$result = $queryCardDetails->result();			   
return $queryCardDetails->result();
//echo "<pre>";
//print_r($result);



}


}