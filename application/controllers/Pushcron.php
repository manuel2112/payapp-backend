<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PushCron extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//TRAER PUSH EN CURSO
		$push		= $this->push_model->getPushEnCurso();
		if( !empty($push) ){
			$idPush 		= $push->PUSH_ID;
			$idEmpresa 		= $push->EMPRESA_ID;
			$txtPushTitle 	= $push->PUSH_TITLE;
			$txtPushTexto 	= $push->PUSH_TEXTO;
			$idProducto 	= $push->PRODUCTO_ID;
			$maxSend		= 30;
			$entro = '';
			
			//INSERT COUNT TOKEN
			$countToken = $this->token_model->countTokenPorEmpresa( $idEmpresa );
			$package = $countToken->COUNTER;
			//UPDATE PACKAGE 
			$this->push_model->updatePushPorCampo( $idPush, 'PUSH_PACKAGE', $package );
		
			$tokens = $this->token_model->getTokenSendAll( $idEmpresa );
			$empresaRow	= $this->empresa_model->getEmpresaRow( $idEmpresa );
			$apiKey = $empresaRow->EMPRESA_KEY_PUSH;
			
			if( !$tokens ){
				$this->push_model->updatePushPorCampo( $idPush, 'PUSH_FLAG', false );
			}
			
			$i = 0;
			foreach( $tokens as $token ){
				
				//COMPROBAR SI YA FUE ENVIADO
				$existe = $this->push_model->getPushTokenRow( $idPush, $token->TOKEN_ID );
				if( !empty($existe) ){
					
					$i++;
					//ENVIAR PUSH
					$boolPush = sendPush($apiKey , $token->HASH_TOKEN, $txtPushTitle, $txtPushTexto, $idPush, $idProducto);
					if( isset($boolPush["results"][0]['error']) ){
						if( $boolPush["results"][0]['error'] == 'NotRegistered' ){
							$this->token_model->updateTokenPorCampo( $token->TOKEN_ID, 'FLAG_TOKEN', false );
						}						
					}
					//INSERT PUSH TOKEN
					$this->push_model->insertPushToken( $idPush, $token->TOKEN_ID, fechaNow() );
					//COMPROBAR SI SE ENVIARON TODOS
					$pushEnviados = $this->push_model->countPushSend( $idPush );
					$packagePush = $pushEnviados->COUNTER;
					if($packagePush >= $package){
						$this->push_model->updatePushPorCampo( $idPush, 'PUSH_FLAG', false );
						$entro = '1';
						break;
					}
					if( $i >= $maxSend ){
						$entro = '2';
						break;
					}
				}
					
			}
		}
		
	}

	public function test()
	{
		$data = array();	
		$idEmpresa  = $this->input->post('idEmpresa');
		$empresaRow	= $this->empresa_model->getEmpresaRow($idEmpresa);
		
		$apiKey = $empresaRow->EMPRESA_KEY_PUSH;
		$devices = $this->device_model->getDeviceTest();	

		foreach( $devices as $device ){
			$token = $this->token_model->getTokenTest( $idEmpresa, $device->DEVICE_ID );
			$tokenHash = $token->HASH_TOKEN;
			sendPush($apiKey , $tokenHash, 'TÍTULO TEST', 'CUERPO TEST', '', '');
		}
		
		$data['ok']	= '1';
		$data['msn']	= 'PUSH ENVIADO EXITOSAMENTE A '.$empresaRow->EMPRESA_NOMBRE;
		echo json_encode($data);
	}
	
}
