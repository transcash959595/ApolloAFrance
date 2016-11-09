<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Xml extends CI_Controller {

	function __construct()
  {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
  
  public function index() {

		$this->load->helper('xml');
    
    //get the raw textdata of sample.xml
  	$xmlRaw = file_get_contents("./application/sample.xml");
		//load the simplexml library NOTE, this is a userdefined library @See libraries/simplexml.php
		$this->load->library('simplexml');
		
		//use the method to parse the data from xml
		$xmlData = $this->simplexml->xml_parse($xmlRaw);
		//set the data
		$data["xmlData"] = $xmlData;
		//load the view/xmlparcer.php along with the data
		$this->load->view('xml', $data);
		

	}
	}
	
	