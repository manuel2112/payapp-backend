<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class DeviceRest extends REST_Controller {
	
	public function __construct()
	{
		
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
	
		parent::__construct();
				
	}
	
	public function index_post()
	{
		$data = json_decode( file_get_contents("php://input") );		
		
		if( $data ){
			$uuid 		= $data->uuid;
			$model		= $data->model;
			$token		= $data->token;
			$idEmpresa	= $data->idEmpresa;
			
			//COMPROBAR EXISTENCIA DISPOSITIVO
			$mdlDevice 	= $this->device_model->getDeviceRow( $uuid );
			if( $mdlDevice ){
				$idDevice = $mdlDevice->DEVICE_ID;
			}else{
				$idDevice = $this->device_model->insertDevice($uuid, $model);
			}			
			//AGREGAR TOKEN
			$mdlToken = $this->token_model->getTokenRow( $token );
			if( !$mdlToken ){
				$this->token_model->insertToken($token, $idEmpresa, $idDevice);
			}
			//AGREGAR VISTA
			$mdlVista = $this->vista_model->getVistaRow( $idEmpresa, $idDevice );
			if( !$mdlVista ){
				$this->vista_model->insertVista($idEmpresa, $idDevice);
			}else{
				$idVista = $mdlVista->VISTA_ID;
				$counter = $mdlVista->VISTA_COUNTER + 1;
				$this->vista_model->updateVistaCounter($idVista,$counter);
			}
			//AGREGAR HORA DE VISITA
			$this->vista_model->insertVistaFecha($idEmpresa, $idDevice, fechaNow());
			/*
			delete from device;
			delete from token;
			delete from vista;
			delete from vista_fecha;
			*/
			$respuesta = array(
								'error'		=> FALSE, 
								'info' 		=> $idDevice
							   );
			$this->response($respuesta);
		}else{		
			$respuesta = array(
								'error'		=> TRUE, 
								'info' 		=> 0
							   );
			$this->response($respuesta);
		}
	}
	
}
