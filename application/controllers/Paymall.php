<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymall extends CI_Controller {
	
	public function __construct() 
    {
        parent::__construct();
        $this->load->library('transbankmall');
        
        $this->transbankmall->transaction();
    }

    public function index()
    {
        $data		= array();
		$hash 		= $_GET['token'];
		$mdlPedido 	= $this->pedido_model->getPedidoRow( 'PEDIDO_HASH', $hash );
		if( $mdlPedido ){
			
			$session_id  	= 'sessionLocalFoodAPP';		
			$buy_order   	= $mdlPedido->PEDIDO_ORDEN;
			$buyOrderStore 	= $buy_order + 1;
			$amount		 	= $mdlPedido->PEDIDO_TOTAL;
			$idEmpresa   	= $mdlPedido->EMPRESA_ID;
			
			$mdlEmpresa  = $this->empresa_model->getEmpresaRow($idEmpresa);
			$codCommerce = $mdlEmpresa->EMPRESA_COD_COMERCIO;
				
		}else{
			echo "ERROR DE LECTURA, FAVOR VOLVER A INTENTAR";
			exit();			
		}
		//exit();
        $return_url  = 'paymall/result';
        $final_url   = 'paymall/exito';
        $stores = [
            [
                "storeCode" => $codCommerce,
                "amount" 	=> $amount,
                "buyOrder"  => $buyOrderStore
            ]
        ];        
        $this->transbankmall->buyOrder($buy_order);
        $this->transbankmall->stores($stores);
        $this->transbankmall->session($session_id);
        $this->transbankmall->setReturnUrl($return_url);
        $this->transbankmall->setEndUrl($final_url);     

        // /** Iniciamos Transaccion */
        $transaccion = $this->transbankmall->startTransaction();
        $data['formAction'] = $transaccion->url;
        $data['tokenWs']    = $transaccion->token;
		$this->pedido_model->updatePedidoToken($hash, $data['tokenWs']);
		
        $this->load->view('paymall/index',$data);

    }

    public function result()
    {
        $ws_token =  filter_input(INPUT_POST, 'token_ws');
        $result = $this->transbankmall->getTransactionResult($ws_token);
        
        if ( $result->detailOutput->responseCode === 0 ) {
			$this->pedido_model->updatePedidoPay($ws_token);
            $data["authorizationCode"]  = $result->detailOutput->authorizationCode;
            $data["amount"]             = $result->detailOutput->amount;
            $data["responseCode"]       = $result->detailOutput->responseCode;
            $data["urlRedirection"]     = $result->urlRedirection;
            $data["tokenWs"]            = $ws_token;

            var_dump($result);
			
            echo '<a href="'.base_url().crearLog($result).'" target="_blank">LOG</a><br>';
            echo 'hola';

            //$this->load->view('paymall/result',$data);
        } else {
            redirect(base_url().'paymall/error','refresh');           
        }
    }

    public function exito()
    {
        $this->load->view('paymall/exito');
    }

    public function error()
    {
        $this->load->view('paymall/error');
    }
	
}
