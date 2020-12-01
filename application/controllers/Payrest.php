<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class PayRest extends REST_Controller {
	
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
		//USUARIO_LAT 	float(10,6)
		$fecha 		= fechaNow();
		$buyOrder 	= time();
		$hash		= generaRandom();
		$idEmpresa	= $data->idEmpresa;
		$uuid		= $data->uuid ? $data->uuid : '3a9adc6881595303';
		$model		= $data->model ? $data->model : 'HUAWEI';
		$persona	= $data->persona->res;
		$obs		= mb_strtoupper($data->obs);
		$tipo		= $data->tipo;
		$subtotal	= $data->subtotal;
		$propina	= $data->propina;
		$delivery	= 0;
		$total		= $data->total;
		$sectordelivery	= $data->sectordelivery;
		$valorDelivery	= $data->sectordelivery->SECTOR_VALOR;
		$idSector		= $data->sectordelivery->SECTOR_ID;
		$ubicacion		= $data->ubicacion->res;
		$productos		= $data->productos;
		
		//COMPROBAR EXISTENCIA DISPOSITIVO
		$mdlDevice 	= $this->device_model->getDeviceRow( $uuid );
		if( $mdlDevice ){
			$idDevice = $mdlDevice->DEVICE_ID;
		}else{
			$idDevice = $this->device_model->insertDevice($uuid, $model);
		}
		
		//COMPROBAR EXISTENCIA USUARIO
		$mdlUsuario 	= $this->usuario_model->getUsuarioRow( $idDevice );
		if( $mdlUsuario ){
			$idUsuario = $mdlUsuario->USUARIO_ID;
			$this->usuario_model->updateUsuario($idUsuario,$persona->nombre,$persona->email,$persona->fono,$persona->direccion,$persona->ciudad);
		}else{
			$idUsuario = $this->usuario_model->insertUsuario($persona->nombre,$persona->email,$persona->fono,$persona->direccion,$persona->ciudad,$fecha,$idDevice);
		}
		
		//INGRESAR PEDIDO
		$idPedido = $this->pedido_model->insertPedido($idEmpresa,$hash,$buyOrder,$fecha,$idUsuario,$obs,$tipo,$subtotal,$propina,$valorDelivery,$total);
		
		//SI ES DELIVERY GUARDAR DATOS
		if( $tipo == 1 ){
			$this->pedido_model->insertPedidoDelivery($idPedido,$idSector,$ubicacion->latitude,$ubicacion->longitude);
		}
		
		//AGREGAR DETALLE DEL PEDIDO
		foreach( $productos as $producto ){
			$idProducto = $producto->varPro->PRODUCTO_ID;
			$idProVar 	= $producto->varPro->PROVAR_ID;
			$cantidad 	= $producto->cantidad;
			$valor 		= $producto->varPro->PROVAR_VALOR;
			$total 		= $producto->cantidad * $producto->varPro->PROVAR_VALOR;

			$this->pedido_model->insertPedidoDetalle($idPedido,$idProducto,$idProVar,$cantidad,$valor,$total);
		}

		if( false ){
			$respuesta = array(
								'error'		=> TRUE,
								'mensaje'	=> 'ESTA EMPRESA NO HA REALIZADO NOTIFICACINES'
							   );
			$this->response($respuesta);
			return;
		}

		$respuesta = array(
							'error'		=> FALSE, 
							'info'		=> $hash
						   );
		$this->response($respuesta);
	}
	
}
