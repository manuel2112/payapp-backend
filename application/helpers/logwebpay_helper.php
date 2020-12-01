<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('crearLog'))
{    
	function crearLog($log)
	{
        $ci = &get_instance();
        $ci->load->helper('file');
        $ci->load->model('pedido_model');
        $mdlPedido = $ci->pedido_model->getPedidoRow( 'PEDIDO_ORDEN', $log->buyOrder );
        if( $mdlPedido ){
            $ci->pedido_model->insertPedidoRequest( $mdlPedido->PEDIDO_ID, $log->accountingDate, $log->buyOrder, $log->cardDetail->cardNumber, $log->cardDetail->cardExpirationDate, $log->detailOutput->sharesNumber, $log->detailOutput->amount, $log->detailOutput->commerceCode, $log->detailOutput->buyOrder, $log->detailOutput->authorizationCode, $log->detailOutput->paymentTypeCode, $log->detailOutput->responseCode, $log->sessionId, $log->transactionDate, $log->urlRedirection, $log->VCI );
        }

        $var  = 'accountingDate: ' . $log->accountingDate ."\n";
        $var .= 'buyOrder: ' . $log->buyOrder ."\n";
        $var .= 'cardDetail-cardNumber: ' . $log->cardDetail->cardNumber ."\n";
        $var .= 'cardDetail-cardExpirationDate: ' . $log->cardDetail->cardExpirationDate ."\n";
        $var .= 'detailOutput->sharesNumber: ' . $log->detailOutput->sharesNumber ."\n";
        $var .= 'detailOutput-amount: ' . $log->detailOutput->amount ."\n";
        $var .= 'detailOutput-commerceCode: ' . $log->detailOutput->commerceCode ."\n";
        $var .= 'detailOutput-buyOrder: ' . $log->detailOutput->buyOrder ."\n";
        $var .= 'detailOutput-authorizationCode: ' . $log->detailOutput->authorizationCode ."\n";
        $var .= 'detailOutput-paymentTypeCode: ' . $log->detailOutput->paymentTypeCode ."\n";
        $var .= 'detailOutput-responseCode: ' . $log->detailOutput->responseCode ."\n";
        $var .= 'sessionId: ' . $log->sessionId ."\n";
        $var .= 'transactionDate: ' . $log->transactionDate ."\n";
        $var .= 'urlRedirection: ' . $log->urlRedirection ."\n";
        $var .= 'VCI: ' . $log->VCI ."\n";

        $ruta = "upload/logs/log_". $log->buyOrder .".txt";
        write_file($ruta, $var);
        return $ruta;
	}
}