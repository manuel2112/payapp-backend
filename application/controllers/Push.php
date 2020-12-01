<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Push extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('clienteapppay')) {
			$this->session->set_userdata('', current_url());
			redirect(base_url('login'));
		}
		
		$this->session_id 	= $this->session->userdata('clienteapppay');
	}

	public function index()
	{
		$data = array();
		$data['pushs']		= $this->push_model->getPush($this->session_id);
		$data['productos']	= $this->producto_model->getProductoPorEmpresa($this->session_id);
		$this->layout->view('index',$data);
	}
	
	public function insertpush()
	{
		$data  = array();
		$error = '';

		$txtPushTitle	= trim($this->input->post("txtPushTitle",true));
		$txtPushTexto	= trim($this->input->post("txtPushTexto",true));
		$idProducto		= trim($this->input->post("idProducto",true));

		if( !$txtPushTitle || !$txtPushTexto ){
			$error .= 'TÍTULO Y MENSAJE SON CAMPOS OBLIGTORIOS';
		}

		if( $error ){
			$data['ok'] = '2';
			$data['msn'] = $error;
		}else{
			$idPush = $this->push_model->insertPush($txtPushTitle, $txtPushTexto, $idProducto, $this->session_id, fechaNow());
			//INSERT COUNT TOKEN
			$countToken = $this->token_model->countTokenPorEmpresa( $this->session_id );
			$package = $countToken->COUNTER;
			//INSERT PACKAGE 
			$this->push_model->updatePushPorCampo( $idPush, 'PUSH_PACKAGE', $package );

			//SCRIPT PARA ENVIAR PUSH
			//$push = $this->push_model->getPushRow($idPush);
			if( $idPush ){
				$tokens = $this->token_model->getTokenSend( $this->session_id );
				$empresaRow	= $this->empresa_model->getEmpresaRow( $this->session_id );
				$apiKey = $empresaRow->EMPRESA_KEY_PUSH;
				
				if( !$tokens ){
					$this->push_model->updatePushPorCampo( $idPush, 'PUSH_FLAG', false );
				}
				foreach( $tokens as $token ){
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
						break;
					}
				}
			}
			$data['ok'] = '1';
			$data['msn'] = 'TU NOTIFICACIÓN ESTÁ SIENDO ENVIADA';
		}
		
		echo json_encode($data);
	}
	
}
