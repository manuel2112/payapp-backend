<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class ComidaRest extends REST_Controller {
	
	public function __construct()
	{
		
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
	
		parent::__construct();
				
	}
	
//	public function index_get()
//	{
//		$arreglo = $this->ciudad_model->getCiudad();
//		
//		$respuesta = array(
//							'error' =>FALSE, 
//							'ciudades' => $arreglo 
//						   );
//		
//		$this->response($respuesta);
//	}
	
	public function suma_comida_ciudad_get( $idCiudad = 0 )
	{
		$arreglo = $this->ciudad_model->getComidasPorCiudad($idCiudad);

		if( count($arreglo) == 0 ){
			$respuesta = array(
								'error'		=> TRUE, 
								'mensaje'	=> 'No existen productos en esta categoría'
							   );		
			$this->response($respuesta);	
			return;		
		}
		
		$respuesta = array(
							'error'		=> FALSE, 
							'comidas' 	=> $arreglo 
						   );		
		$this->response($respuesta);
	}
	
	public function comida_empresa_ciudad_get( $idCiudad = 0, $idTipoComida = 0 )
	{		
		$arreglo = $this->ciudad_model->getEmpresaPorComidaCiudad($idCiudad,$idTipoComida);

		if( count($arreglo) == 0 ){
			$respuesta = array(
								'error'		=> TRUE, 
								'mensaje'	=> 'No existen productos en esta categoría'
							   );		
			$this->response($respuesta);	
			return;		
		}
		
		$respuesta = array(
							'error'		=> FALSE, 
							'comidas' 	=> $arreglo 
						   );		
		$this->response($respuesta);
	}
	
}
