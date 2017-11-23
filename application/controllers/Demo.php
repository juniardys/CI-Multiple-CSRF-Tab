<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Demo for csrf multiple tab
class Demo extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// Load CSRF library
		$this->load->library('csrf');

		// Submitted
		if (isset($_POST['btnSubmit'])) {
			if(!$this->csrf->valid_token($this->input->post('csrf_token'))){ 
				// Do Something if token not valid

				show_error('CSRF TOKEN NOT VALID'); // For Debug
			} else {
				// Do Something if token not valid

				show_error('CSRF TOKEN VALID'); // For Debug
			}
		}
		// Generate CSRF token
		$content['csrf_token'] = $this->csrf->gen_token();
		// Load View
		$this->load->view('demo', $content);
	}
}