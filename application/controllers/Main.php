<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller {





public function index(){
$username = $this->session->userdata('username');
$password = $this->session->userdata('password');
if(isset($username))
{

$this->load->helper('url');
$this->load->view('main');


}

else
{
$this->load->view('login');
//print_r($this->session->all_userdata());
}








}






}























?>