<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$controllers = array();
	    $this->load->helper('file');

	    // Scan files in the /application/controllers directory
	    // Set the second param to TRUE or remove it if you 
	    // don't have controllers in sub directories
	    $files = get_dir_file_info(APPPATH.'controllers', FALSE);

	    // Loop through file names removing .php extension
	    foreach ( array_keys($files) as $file ) {
	        if ( $file != 'index.html' )
	            $controllers[] = str_replace('.php', '', $file);
	    }
	    print_r($controllers); // Array with all our controllers

		

		if (in_array("Productos", $controllers)) {
	    	echo "found";

		}else
		{
			echo "No found";
		}
	}
}
