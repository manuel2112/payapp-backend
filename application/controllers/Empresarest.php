<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class EmpresaRest extends REST_Controller {
	
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
		$arreglo['empresa']			= $this->empresa_model->getEmpresaRow($idEmpresa);

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
	
	public function buscar_get( $texto = "" )
	{
		$cadena = str_replace("%20"," ",$texto);
		
		$arreglo = '';
		if( $cadena ){
			$arreglo = $this->empresa_model->getEmpresaSearch($cadena);
		}
		
		$respuesta = array(
							'error'		=> FALSE,
							'termino'	=> $texto, 
							'empresas'	=> $arreglo 
						   );
		
		$this->response($respuesta);
		
	}
	
}
