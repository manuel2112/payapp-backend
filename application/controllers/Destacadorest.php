<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class DestacadoRest extends REST_Controller {
	
	public function __construct()
	{
		
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
	
		parent::__construct();
				
	}
	
	public function index_get( )
	{
		$destacados	= $this->destacado_model->getDestacadosActivas();

		if( count($destacados) == 0 ){
			$respuesta = array(
								'error'		=> TRUE,
								'mensaje'	=> 'No existen destacados'
							   );
			$this->response($respuesta);
			return;
		}

		$respuesta = array(
							'error'		=> FALSE, 
							'info' 		=> $destacados
						   );
		$this->response($respuesta);
	}
	
	public function single_get( $idDestacado = 0 )
	{
		$destacado	= $this->destacado_model->getDestacadoEmpresaRow($idDestacado);
		$idEmpresa 	= $destacado->EMPRESA_ID;
		
		$arreglo = array();
		$arreglo['destacado']		= $this->destacado_model->getDestacadoEmpresaRow($idDestacado);
		$arreglo['fotos']			= $this->destacado_imagen_model->getDestacadoImagen($idDestacado);
		$arreglo['tiposdecomida']	= $this->tipo_comida_model->getTipoComidaEmpresa($idEmpresa);
		$arreglo['tiposdenegocio']	= $this->tipo_negocio_model->getTipoNegocioEmpresa($idEmpresa);
		$arreglo['tiposdepago']		= $this->tipo_pago_model->getTipoPagoEmpresa($idEmpresa);

		if( count($arreglo) == 0 ){
			$respuesta = array(
								'error'		=> TRUE,
								'mensaje'	=> 'No existen destacados asociado'
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
