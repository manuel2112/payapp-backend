<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class ClienteRest extends REST_Controller {
	
	public function __construct()
	{
		
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
	
		parent::__construct();
				
	}
	
	public function index_get( $idEmpresa = 1 )
	{
		$arreglo = array();
		updateHorario($idEmpresa);
		$arreglo['empresa']	= $this->empresa_model->getEmpresaRow($idEmpresa);
		$valor	= $this->horario_model->getHorarioHasta($idEmpresa);
		$arreglo['hora']		= is_null ( $valor ) ? '' : $valor ;
		$arreglo['segundos']	= horarioPorEmpresaSingle($idEmpresa);

		if( count($arreglo) == 0 ){
			$respuesta = array(
								'error'		=> TRUE,
								'mensaje'	=> 'No existen empresa solicitada'
							   );
			$this->response($respuesta);
			return;
		}

		$respuesta = array(
							'error'		=> FALSE, 
							'info' 		=> $arreglo
						   );
		$this->response($respuesta);
	}
	
	public function apertura_get( $idEmpresa = 0 )
	{
		$arreglo = array();
		updateHorario($idEmpresa);
		$arreglo['empresa']		= $this->empresa_model->getEmpresaAperturaRow($idEmpresa);
		
		$valor	= $this->horario_model->getHorarioHasta($idEmpresa);
		$arreglo['hora']		= is_null ( $valor ) ? '' : $valor ;
		
		$arreglo['segundos']	= horarioPorEmpresaSingle($idEmpresa);

		if( count($arreglo) == 0 ){
			$respuesta = array(
								'error'		=> TRUE,
								'mensaje'	=> 'No existen empresa solicitada'
							   );
			$this->response($respuesta);
			return;
		}

		$respuesta = array(
							'error'		=> FALSE, 
							'info' 		=> $arreglo
						   );
		$this->response($respuesta);
	}
	
}
