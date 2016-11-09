<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AdminController extends CI_Controller {





public function index(){
/*$username = $this->session->userdata('username');
//$password = $this->session->userdata('password');
//if(isset($username))
//{

$this->load->helper('url');
$this->load->view('admin');


}

else
{
$this->load->view('login');
//print_r($this->session->all_userdata());
}

*/
$this->load->helper('url');
$this->load->view('admin');
$this->load->view('content/createtable');

}


public function add_keys($account)

{
$this->load->model('CreateTableModel');
$this->CreateTableModel->alterTable($account);
}

public function NoOfAccount()
{

$this->load->model('CreateTableModel');
$this->CreateTableModel->createNoOfAccount();
}
public function createtable()

{
$account = $this->input->post('account');

$this->load->model('CreateTableModel');

$data['account'] = $this->CreateTableModel->createtable($account);
}




}




















?>