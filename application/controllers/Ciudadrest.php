<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class CiudadRest extends REST_Controller {
	
	public function __construct()
	{
		
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
	
		parent::__construct();
				
	}
	
	public function index_get()
	{
		$arreglo = $this->ciudad_model->getCiudad();
		
		$respuesta = array(
							'error' =>FALSE, 
							'ciudades' => $arreglo 
						   );
		
		$this->response($respuesta);
	}
	
	public function suma_empresas_get()
	{
		$arreglo = $this->ciudad_model->getEmpresasPorCiudad();
		
		$respuesta = array(
							'error' =>FALSE, 
							'ciudades' => $arreglo 
						   );
		
		$this->response($respuesta);
	}
	
	public function estadistica_ciudad_get( $idCiudad = 0 )
	{
		$date	= fechaNow();
		
		if( $idCiudad != 0 ){			
			
			$this->ciudad_model->insertCiudadEstRest($idCiudad, $date);
			$respuesta = array(
								'error'		=> TRUE, 
								'mensaje'	=> 'Estadística ingresada'
							   );		
			$this->response($respuesta);
			
		}else{
		
			$respuesta = array(
								'error'		=> FALSE, 
								'mensaje'	=> 'ERROR de ingreso' 
							   );		
			$this->response($respuesta);
			
		}		
	}
	
}
