<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class PaletaRest extends REST_Controller {
	
	public function __construct()
	{
		
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
	
		parent::__construct();
				
	}

	public function index_get( $idEmpresa = 0 )
	{
		$arreglo 			= array();
		$arreglo['paleta'] 	= $this->paleta_model->getPaletaRow( $idEmpresa );

		if( count($arreglo) == 0 ){
			$respuesta = array(
								'error'		=> TRUE,
								'mensaje'	=> 'ERROR EN EL SERVIDOR'
							   );
			$this->response($respuesta);
			return;
		}

		$respuesta = array(
							'error'		=> FALSE, 
							'info'		=> $arreglo
						   );
		$this->response($respuesta);
	}
	
}
