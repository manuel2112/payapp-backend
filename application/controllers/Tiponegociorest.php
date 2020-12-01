<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class TipoNegocioRest extends REST_Controller {
	
	public function __construct()
	{
		
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
	
		parent::__construct();
				
	}

	public function index_get( $idEmpresa = 0 )
	{
		$arreglo 			    = array();
		$arreglo['tiponegocio'] = $this->empresa_negocio_model->getEmpresaNegocioActive($idEmpresa);
		$arreglo['montoMinimo']	= $this->empresa_negocio_model->getEmpresaNegocioMontoActiveRow($idEmpresa);
		$arreglo['sectores']    = $this->empresa_negocio_model->getSector($idEmpresa);

		if( count($arreglo) == 0 ){
			$respuesta = array(
								'error'		=> TRUE,
								'mensaje'	=> 'ESTA EMPRESA NO HA INGRESADO TIPOS DE NEGOCIO'
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
