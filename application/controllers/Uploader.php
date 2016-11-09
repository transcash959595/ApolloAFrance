<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploader extends CI_Controller //
{
/* Standalone Elfinder */
    public function uploader_files()
    {
        $this->load->view('elfinder_view');
    }

    /* Popup Elfinder in TinyMCE */
    public function uploader_popup()
    {
        $this->load->view('uploader_popup_view');   
    }

    /* Elfinder initialization */
    public function uploader_init()
    {
        $this->load->helper('path');
        $opts = array(
            'debug' => true,
            'roots' => array(
                array(
                    'driver' => 'LocalFileSystem',
                    'path' => FCPATH.'/Application/views/directory/uploads/marketing/files/', // Change this!
                    'URL' => site_url('/Application/views/directory/uploads/marketing/files/') . '/' //Change this!
                )   
            )
            );
        $this->load->library('Elfinder_lib', $opts);
    }
    
}
