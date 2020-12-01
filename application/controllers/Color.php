<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Color extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('adminapppay')) {
			$this->session->set_userdata('', current_url());
			redirect(base_url('login'));
		}        
        $this->session_id = $this->session->userdata('adminapppay');
	}

	public function index()
	{
		$data["colores"]	= $this->color_model->getColor();
		$this->layout->view('index',$data);
	}
    
	public function insert()
	{
		$data  = array();
		$error = '';
		$nmbColor = trim($this->input->post('txtColorNombre'));
		$hexaColor = trim($this->input->post('txtColorHexa'));
		$nmbColorExiste = $this->color_model->getCampoExisteColor('COLOR_NOMBRE',$nmbColor);
		$hexaColorExiste = $this->color_model->getCampoExisteColor('COLOR_HEX', '#'.$hexaColor);		

		if( $nmbColor == '' ){
			$error .= 'NOMBRE CAMPO OBLIGATORIO - ';
		}
		if( $nmbColor != '' && $nmbColorExiste ){
			$error .= 'NOMBRE YA EXISTE - ';
		}
		if( $hexaColor == '' ){
			$error .= 'N° HEXADECIMAL CAMPO OBLIGATORIO';
		}
		if( $hexaColor != '' && $hexaColorExiste ){
			$error .= 'N° HEXADECIMAL YA EXISTE';
		}

		if( $error ){
			$data['ok'] = '2';
			$data['msn'] = $error;
		}else{
			//INGRESAR COLOR
			$nmbColor = mb_strtoupper($nmbColor);
			$hexaColor = '#' . strtolower($hexaColor);
			$this->color_model->insertColor($nmbColor, $hexaColor);
			
			$data['ok'] = '1';
			$data['msn'] = 'Color '.$nmbColor.' ingresado exitosamente.';
		}
		
		echo json_encode($data);
	}

	public function geteditar()
	{
		$data = array();
		$idColor 	   = trim($this->input->post('idColor'));
		$data['color'] = $this->color_model->getColorRow($idColor);
		echo json_encode($data);
	}

	public function editar()
	{
		$data  = array();
		$error = '';
		$idColor = trim($this->input->post('idEditColor'));
		$nmbColor = trim($this->input->post('nmbEditColor'));
		$hexaColor = trim($this->input->post('hexaEditColor'));
		$nmbColorExiste = $this->color_model->updateCampoExisteColor($idColor,'COLOR_NOMBRE',$nmbColor);
		$hexaColorExiste = $this->color_model->updateCampoExisteColor($idColor,'COLOR_HEX', '#'.$hexaColor);		

		if( $nmbColor == '' ){
			$error .= 'NOMBRE CAMPO OBLIGATORIO - ';
		}
		if( $nmbColor != '' && $nmbColorExiste ){
			$error .= 'NOMBRE YA EXISTE - ';
		}
		if( $hexaColor == '' ){
			$error .= 'N° HEXADECIMAL CAMPO OBLIGATORIO';
		}
		if( $hexaColor != '' && $hexaColorExiste ){
			$error .= 'N° HEXADECIMAL YA EXISTE';
		}

		if( $error ){
			$data['ok'] = '2';
			$data['msn'] = $error;
		}else{
			//INGRESAR COLOR
			$nmbColor = mb_strtoupper($nmbColor);
			$hexaColor = '#' . strtolower($hexaColor);
			$this->color_model->updateColor($idColor,$nmbColor,$hexaColor);
			
			$data['ok'] = '1';
			$data['msn'] = 'Color '.$nmbColor.' actualizado exitosamente.';
		}
		
		echo json_encode($data);
	}

	public function delete()
	{
		$data  = array();
		$error = '';
		$idColor = trim($this->input->post('idColor'));
		$this->color_model->deleteColor($idColor);
	}

}
