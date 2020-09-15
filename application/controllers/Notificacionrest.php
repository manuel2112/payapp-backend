<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class NotificacionRest extends REST_Controller {
	
	public function __construct()
	{
		
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
	
		parent::__construct();
				
	}
	
	public function index_get()
	{
		$arreglo = $this->empresa_notificacion_model->getClienteNotificacionRest();
		//echo $this->db->last_query();
		
		$respuesta = array(
							'error' =>FALSE, 
							'info' => $arreglo 
						   );
		
		$this->response($respuesta);
	}
	
	public function single_get( $idNotificacion = 0 )
	{
		$notificacion	= $this->empresa_notificacion_model->getClienteNotificacionRowRest($idNotificacion);
		$idEmpresa 		= $notificacion->EMPRESA_ID;
		
		$arreglo = array();
		$arreglo['notificacion']	= $this->empresa_notificacion_model->getClienteNotificacionRowRest($idNotificacion);
		$arreglo['tiposdecomida']	= $this->tipo_comida_model->getTipoComidaEmpresa($idEmpresa);
		$arreglo['tiposdenegocio']	= $this->tipo_negocio_model->getTipoNegocioEmpresa($idEmpresa);
		$arreglo['tiposdepago']		= $this->tipo_pago_model->getTipoPagoEmpresa($idEmpresa);

		if( count($arreglo) == 0 ){
			$respuesta = array(
								'error'		=> TRUE,
								'mensaje'	=> 'No existen notificaciones.'
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
	
	public function search_get( $idOneSignal = '' )
	{
		$arreglo = array();
		$arreglo['notificacion']	= $this->empresa_notificacion_model->getClienteNotificacionRowIdOneSignalRest($idOneSignal);

		if( count($arreglo) == 0 ){
			$respuesta = array(
								'error'		=> TRUE,
								'mensaje'	=> 'No existen notificaciones.'
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
