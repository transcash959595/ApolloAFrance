<?php
class Parser extends CI_Controller {





public function simple_xml(){
$username = $this->session->userdata('username');
$password = $this->session->userdata('password');
if(isset($username))
{
$this->load->helper('xml');
$dom =xml_dom();
$book = xml_add_child($dom, 'book');
xml_add_child($book,'tittle','Hyperion');
$author = xml_add_child($book,'author','Dan Simmons');
xml_add_attribute($author,'birthdate', '1948-04-04');
xml_print($dom);



}

else
{
$this->load->view('headerlogin');
$this->load->view('login');
//print_r($this->session->all_userdata());
}
}


public function read_xml_file()

{
$username =$this->session->userdata('username');
$password = $this->session->userdata('password');

if(isset($username))
{
$this->load->helper('xml');
$doc = new DOMDocument("1.0");
$doc->validateOnParse = true;
$doc->load->xmlSample( 'Processor/TCFtxnexp20150701.xml' );//xml file loading here

$authoriZations = $doc->getElementsByTagName( "AUTHADV" );
foreach($authoriZations as $authoriZation )
{
  $localdate = $authoriZation->getElementsByTagName( "LOCALDATE" );
  $localDate = $localdate->item(0)->nodeValue;

  $amttxn = $authoriZation->getElementsByTagName( "AMTTXN" );
  $amtTxn = $amttxn->item(0)->nodeValue;

  $cardid = $authoriZation->getElementsByTagName( "CARDID" );
  $carDid = $cardid->item(0)->nodeValue;
  echo "<b>$localDate - $amtTxn - $carDid\n</b><br>";
  
  }






}


else
{




}


}








}



