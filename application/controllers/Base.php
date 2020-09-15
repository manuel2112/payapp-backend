<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('clienteapppay') && !$this->session->userdata('adminapppay') ) {
			$this->session->set_userdata('', current_url());
			redirect(base_url('login'));
		}

		if($this->session->userdata('adminapppay')){
			$this->session_id 	= $this->session->userdata('adminapppay');
		}
		if($this->session->userdata('clienteapppay')){
			$this->session_id 	= $this->session->userdata('clienteapppay');
		}
	}
	
	public function index()
	{
		echo "Estoy en el home";
	}
	
	public function updatedescarga()
	{
		$valor		= trim($this->input->post('newvalor'));		
		$this->base_model->updateBase($valor);
		echo '1';		
	}
    
	public function showdate()
	{
		zonaHoraria();
		$data	= array();

		if( $this->session_id ){
			$data['ok'] = '1';
			$data['fecha'] = date("Y-m-d H:i:s");
		}else{
			$data['ok'] = '2';
		}
		//$data['ok'] = '1';
		echo json_encode($data);
	}
	
}
