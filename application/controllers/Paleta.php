<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paleta extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('clienteapppay')) {
			$this->session->set_userdata('', current_url());
			redirect(base_url('login'));
		}
		
		$this->session_id 	= $this->session->userdata('clienteapppay');
	}

	public function index()
	{
		$data = array();
		$data["colores"] = $this->color_model->getColor();
		$data["paleta"]  = $this->paleta_model->getPaletaRow( $this->session_id );
		$this->layout->view('index',$data);
	}
	
	public function update()
	{
		$data  = array();
		$error = '';

		$posicion	= trim($this->input->post("posicion",true));
		$idColor	= trim($this->input->post("idColor",true));
		
		if( $idColor == 1 ){
			$nmbColor = 'primary';
		}elseif( $idColor == 2 ){
			$nmbColor = 'secondary';
		}elseif( $idColor == 3 ){
			$nmbColor = 'light';
		}else{
			$color = $this->color_model->getColorRow($idColor);
			$nmbColor = strtolower(str_replace(' ', '', $color->COLOR_NOMBRE));
		}

		if( $posicion == 'btn-color-01' ){
			$campo01 = 'COLOR_ID_01';
			$campo02 = 'COLOR_NMB_01';
			$tipo = 'PRIMARIO';
		}elseif( $posicion == 'btn-color-02' ){
			$campo01 = 'COLOR_ID_02';
			$campo02 = 'COLOR_NMB_02';
			$tipo = 'SECUNDARIO';
		}elseif( $posicion == 'btn-color-03' ){
			$campo01 = 'COLOR_ID_03';
			$campo02 = 'COLOR_NMB_03';
			$tipo = 'TERCIARIO';
		}else{}

		$this->paleta_model->updatePaleta($this->session_id, $campo01, $campo02, $idColor, $nmbColor);

		$data['txt'] = 'CAMBIO DE COLOR '.$tipo.' REALIZADO';
		echo json_encode($data);
	}
	
	public function getcolor()
	{
		$data  = array();
		$error = '';
		$idColor	= trim($this->input->post("idColor",true));

		$data['color'] = $this->color_model->getColorRow($idColor);
		echo json_encode($data);
	}
	
}
