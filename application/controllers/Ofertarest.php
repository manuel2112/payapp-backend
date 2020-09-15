<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class OfertaRest extends REST_Controller {
	
	public function __construct()
	{
		
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
	
		parent::__construct();
				
	}
	
	public function index_get( $idEmpresa = 0 )
	{
		$arreglo 	= array();
		$ofertas	= $this->producto_model->getOfertaAPI($idEmpresa);
		
		$i = 0 ;
		foreach( $ofertas as $oferta ){
			
			$arreglo[$i]['oferta'] = $oferta;
			$valorbase = $this->producto_variable_model->getPVBaseAPIRow($oferta->PRODUCTO_ID);
			$valor =  count_array($this->producto_variable_model->getPVBaseAPIResult($oferta->PRODUCTO_ID)) > 0 ? $valorbase->PROVAR_VALOR : 0;
			$arreglo[$i]['valor'] = $valor;
			
			$i++;
		}

		if( count($arreglo) == 0 ){
			$respuesta = array(
								'error'		=> TRUE,
								'mensaje'	=> 'No existen ofertas solicitadas'
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
	
	public function destacado_get( $idEmpresa = 0 )
	{
		$arreglo 	= array();
		$destacados	= $this->producto_model->getDestacadoAPI($idEmpresa);
		
		$i = 0 ;
		foreach( $destacados as $destacado ){
			
			$arreglo[$i]['destacado'] = $destacado;
			$valorbase = $this->producto_variable_model->getPVBaseAPIRow($destacado->PRODUCTO_ID);
			$valor =  count_array($this->producto_variable_model->getPVBaseAPIResult($destacado->PRODUCTO_ID)) > 0 ? $valorbase->PROVAR_VALOR : 0;
			$arreglo[$i]['valor'] = $valor;
			
			$i++;
		}

		if( count($arreglo) == 0 ){
			$respuesta = array(
								'error'		=> TRUE,
								'mensaje'	=> 'No existen ofertas solicitadas'
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
