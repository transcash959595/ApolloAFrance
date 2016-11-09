

<?php



if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class elfinderController extends CI_Controller {


public function view_elfinder($directoryName)
    {
	    $data = array('directoryName' => $directoryName);
        $this->load->view('elfinder', $data);
		$this->load->view('content/elfinder'.$directoryName);
		
		
    }
	
	

	
function elfinder_($directoryName)
{
  $this->load->helper('path');
  $opts = array(
    // 'debug' => true, 
    'roots' => array(
      array( 
        'driver' => 'LocalFileSystem', 
        'path'   => FCPATH.'/directory/'.$directoryName, 
        'URL'    => site_url('/directory/'.$directoryName) . '/'
        // more elFinder options here
      ) 
    )
  );
  $this->load->library('elfinder_lib', $opts);
}










}


?>