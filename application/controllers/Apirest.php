<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apirest extends CI_Controller {
	
	public function __construct()
	{	
		parent::__construct();
		if (!$this->session->userdata('adminappchan')) {
			$this->session->set_userdata('', current_url());
			redirect(base_url('login'));
		}        
        $this->session_id = $this->session->userdata('adminappchan');
	}
	
	public function index()
	{
		$this->layout->view('index');
	}

}
