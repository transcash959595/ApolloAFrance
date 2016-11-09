<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {




public function index(){
$user = $this->session->userdata('username');
$pan = $this->session->userdata('password');
if(isset($user))
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


function logout()
{
    $newdata = array(
                'username'  =>'',
                'password' => '',
                
               );

     $this->session->unset_userdata($newdata);
     $this->session->sess_destroy();

     redirect('login/');
}



public function checkLogin()

{
$this->form_validation->set_rules('username','Username','required');
$this->form_validation->set_rules('password','Password','required|callback_verifyUser');
if($this->form_validation->run() == false)
{
$user = $this->session->userdata('username');
$password = $this->session->userdata('password');
if(isset($user))
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
else
{

}




}


public function verifyUser()
{
/*
The function VerifyUser is the callback function from checklogin function after 
the form validation is successfully completed  
It  also post the variable from the login view to the loginController

*/

$name = $this->input->post('username');

$pass = $this->input->post('password');

$this->load->model('Loginmodel');



/*
loginModel is loaded and above and one of the function in the loginModel login  is called with arguments username and password.
LoginModel calling is done in (if) statement to check if the user is present in the database. 
The below lines of code are to check if the user is present in the database and if the returned result is  not null 
Variable $data captures the result returned from the login model for this call.
foreach loop fetches and stores the data from $data array.
*/
if($this->Loginmodel->login($name,$pass))
{




/*

Session variables are initiated and saved.
Homemodel is loaded and called with the argument pan.


*/

$this->session->set_userdata('username',$name);
$this->session->set_userdata('password',$pass);



$this->load->helper('url');

$this->load->view('main');




}
else
{
$this->form_validation->set_message('verifyUser','Incorrect Username or Password. Please try again.');
return false;
}


}




}




?>