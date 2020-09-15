<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }	

	public function index()
	{
		$idEmpresa 			= $this->uri->segment(3);
		$data['empresa'] 	= $this->empresa_model->getEmpresaRow($idEmpresa);
		//var_dump($data);
		$this->load->view('map/index',$data);
	}
}