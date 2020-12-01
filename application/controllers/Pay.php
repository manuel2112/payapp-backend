<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pay extends CI_Controller {
	
	public function __construct() 
    {
        parent::__construct();
        $this->load->library('transbank');
        
        $this->transbank->transaction();
        // var_dump($transaction);
    }

    public function index()
    {
        $data       = array();
        $amount     = 2000;
        $sessionId  = 'sessionId';
        $buyOrder   = strval(rand(10000,999999));
        $returnUrl  = 'pay/result';
        $finalUrl   = 'pay/exito';
        $errorUrl   = 'pay/error';
        
        $this->transbank->setMonto($amount);
        $this->transbank->setReturnUrl($returnUrl);
        $this->transbank->setEndUrl($finalUrl);
        $this->transbank->setErrorUrl($errorUrl);

        $transaccion = $this->transbank->startTransaction();

        $formAction = $transaccion->url;
        $tokenWs    = $transaccion->token;
        
        // REALIZAR IF SI VIENE TOKEN
        $data["amount"] = $amount;
        $data["buyOrder"] = $buyOrder;
        $data["formAction"] = $formAction;
        $data["tokenWs"]    = $tokenWs;
        $this->layout->view('index',$data);

        // $initResult = $transaction->initTransaction(
        //     $amount, $sessionId, $buyOrder, $returnUrl, $finalUrl
        // );

        // $formAction = $initResult->url;
        // $tokenWs    = $initResult->token;
        
        // if ( isset( $transaccion->token ) && ! empty ( $transaccion->token ) )
        // {
        //     $data = [
        //         'monto' =>  $monto,
        //         'token' =>  $transaccion->token,
        //         'url'   =>  $transaccion->url
        //     ];

        //     $this->layout->view('confirmar', $data);
            
        // } else {
        //     redirect(base_url().'pay/error');
        // }
    }

    public function result()
    {
        $ws_token =  filter_input(INPUT_POST, 'token_ws');
        $result = $this->transbank->getTransactionResult($ws_token);
        
        if ( $result->detailOutput->responseCode === 0 ) {
            $data["authorizationCode"]  = $result->detailOutput->authorizationCode;
            $data["amount"]             = $result->detailOutput->amount;
            $data["responseCode"]       = $result->detailOutput->responseCode;
            $data["urlRedirection"]     = $result->urlRedirection;
            $data["tokenWs"]            = $ws_token;
            $this->layout->view('result',$data);
        } else {
            redirect(base_url().'pay/error','refresh');           
        }
    }

    public function exito()
    {
        $this->layout->view('exito');
    }

    public function error()
    {
        $this->layout->view('error');
    }
	
}
