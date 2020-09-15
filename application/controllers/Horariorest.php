<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class HorarioRest extends REST_Controller {
	
	public function __construct()
	{
		
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
	
		parent::__construct();
				
	}
	
	public function index_get( $idEmpresa = 0 )
	{
		$arreglo = array();
		$arreglo['horario']		= $this->horario_model->getHorarioPorEmpresa($idEmpresa);

		if( count($arreglo) == 0 ){
			$respuesta = array(
								'error'		=> TRUE,
								'mensaje'	=> 'NO EXISTE HORAS DE ATENCIÓN'
							   );
			$this->response($respuesta);
			return;
		}

		$respuesta = array(
							'error'		=> FALSE, 
							'data'	=> $arreglo
						   );
		$this->response($respuesta);
	}
	
}
