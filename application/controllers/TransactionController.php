<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transaction extends CI_Controller {





public function index($cardnumber){
$username = $this->session->userdata('username');
$password = $this->session->userdata('password');
if(isset($username))
{
$this->load->model('Transactionmodel');

$data['transactiondetails'] = $this->Transactionmodel->getTransactionDetails($cardnumber);
$this->load->helper('url');
$this->load->view('transaction',$data);

$this->load->view('content/transaction');

}

else
{
$this->load->view('login');
//print_r($this->session->all_userdata());
}
}


}




















?>