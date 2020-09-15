<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class EstadisticaRest extends REST_Controller {
	
	public function __construct(){
		
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
	
		parent::__construct();
				
	}
	
	public function index_get()
	{
	}
	
	public function estadistica_perfil_get( $idEmpresa = 0, $idVista = 0, $idCampo = 0  )
	{
		$date	= fechaNow();
		
		if( $idEmpresa != 0 && $idVista != 0 && $idCampo != 0 ){			
			
			$this->estadistica_model->insertEstadistica($idEmpresa,$idVista,$idCampo,$date);
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
