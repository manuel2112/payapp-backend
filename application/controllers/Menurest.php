<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class MenuRest extends REST_Controller {
	
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
		
		$tipoProducto	= $this->tipo_producto_model->getTipoProductoPorEmpresaAPI($idEmpresa);
		
		$i = 0 ;
		foreach( $tipoProducto as $tipo ){
			
			$arreglo[$i]['TIPO_PRODUCTO_ORDEN'] = $tipo->TIPO_PRODUCTO_ORDEN;
			$arreglo[$i]['TIPO_PRODUCTO_ID'] = $tipo->TIPO_PRODUCTO_ID;
			$arreglo[$i]['TIPO_PRODUCTO_NOMBRE'] = $tipo->TIPO_PRODUCTO_NOMBRE;

			$productos	= $this->producto_model->getProductoPorTipoAPI($tipo->TIPO_PRODUCTO_ID);

			foreach( $productos as $producto ){
				$valorbase = $this->producto_variable_model->getPVBaseAPIRow($producto->PRODUCTO_ID);
				$valor =  count_array($this->producto_variable_model->getPVBaseAPIResult($producto->PRODUCTO_ID)) > 0 ? $valorbase->PROVAR_VALOR : 0;
				$arreglo[$i]['productos'][] = array( 
								'PRODUCTO_ORDEN'=> $producto->PRODUCTO_ORDEN, 
								'PRODUCTO_ID'=> $producto->PRODUCTO_ID, 
								'PRODUCTO_NOMBRE' => $producto->PRODUCTO_NOMBRE, 
								'PRODUCTO_IMG' => $producto->PRODUCTO_IMG, 
								'PRODUCTO_DESC' => $producto->PRODUCTO_DESC, 
								'PRODUCTO_VALOR_BASE' => $valor 
				); 
			}
			
			$i++;
		}

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
	
	public function producto_get( $idProducto = 0 )
	{
		$arreglo = array();
		
		$arreglo["producto"]	= $this->producto_model->getProductoRow($idProducto);
		$arreglo["precios"]		= $this->producto_variable_model->getProductoVariableAPI($idProducto);
		$arreglo["imagenes"]	= $this->producto_foto_model->getProductoFotoActive($idProducto);

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
	
}
