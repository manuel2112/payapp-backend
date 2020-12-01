<?php
	
class pedido_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function insertPedido($idEmpresa,$hash,$orden,$date,$idUsuario,$obs,$tipo,$subtotal,$propina,$delivery,$total)
    {
		$data = array(
						'EMPRESA_ID'		=> $idEmpresa,
						'PEDIDO_HASH'		=> $hash,
						'PEDIDO_ORDEN'		=> $orden,
						'PEDIDO_FECHA'		=> $date,
						'USUARIO_ID'		=> $idUsuario,
						'PEDIDO_OBS'		=> $obs,
						'TIPO_NEGOCIO_ID'	=> $tipo,
						'PEDIDO_SUBTOTAL'	=> $subtotal,
						'PEDIDO_PROPINA'	=> $propina,
						'PEDIDO_DELIVERY'	=> $delivery,
						'PEDIDO_TOTAL'		=> $total
					);
		$this->db->insert('pedido', $data);
		return $this->db->insert_id();
    }
    
    public function getPedidoRow( $campo, $value )
    {
        $where = array(
						$campo	=> $value
					   );
        $query = $this->db
                        ->select("*")
                        ->from("pedido")
                        ->where($where)
                        ->get();
        return $query->row();
    }
	
	public function updatePedidoToken($hash, $token)
    {
		$array = array(
						'PEDIDO_TOKEN' => $token
					   );
		$this->db->where('PEDIDO_HASH', $hash);
		$this->db->update('pedido', $array);
    }
	
	public function updatePedidoPay($token)
    {
		$array = array(
						'PEDIDO_PAY' => true
					   );
		$this->db->where('PEDIDO_TOKEN', $token);
		$this->db->update('pedido', $array);
    }
	
/**************************/
/******PEDIDO/DELIVERY*****/
/**************************/
	
	public function insertPedidoDelivery($idPedido,$idSector,$latitud,$longitud)
    {
		$data = array(
						'PEDIDO_ID'		=> $idPedido,
						'SECTOR_ID'		=> $idSector,
						'PED_DEL_LAT'	=> $latitud,
						'PED_DEL_LGT'	=> $longitud
					);
		$this->db->insert('pedido_delivery', $data);
    }
	
/**************************/
/******PEDIDO/DETALLE*****/
/**************************/
	
	public function insertPedidoDetalle($idPedido,$idProducto,$idProVar,$cantidad,$valor,$total)
    {
		$data = array(
						'PEDIDO_ID'				=> $idPedido,
						'PRODUCTO_ID'			=> $idProducto,
						'PROVAR_ID'				=> $idProVar,
						'PEDIDO_DETALLE_CANT'	=> $cantidad,
						'PEDIDO_DETALLE_UNIDAD'	=> $valor,
						'PEDIDO_DETALLE_TOTAL'	=> $total
					);
		$this->db->insert('pedido_detalle', $data);
    }
	
	/**************************/
	/******PEDIDO/REQUEST*****/
	/**************************/
		
	public function insertPedidoRequest( $idPedido, $accountingDate, $buyOrder, $cardNumber, $cardExpirationDate, $sharesNumber, $amount, $commerceCode, $buyOrder2, $authorizationCode, $paymentTypeCode, $responseCode, $sessionId, $transactionDate, $urlRedirection, $VCI )
	{
		$data = array(
						'PEDIDO_ID'					=> $idPedido,
						'PED_REQ_ACCOUNTING_DATE'	=> $accountingDate,
						'PED_REQ_BUY_ORDER'			=> $buyOrder,
						'PED_REQ_CARD_NUMBER'		=> $cardNumber,
						'PED_REQ_CARD_EXPIRATION'	=> $cardExpirationDate,
						'PED_REQ_SHARES'			=> $sharesNumber,
						'PED_REQ_AMOUNT'			=> $amount,
						'PED_REQ_COMMERCE_CODE'		=> $commerceCode,
						'PED_REQ__BUY_ORDER_2'		=> $buyOrder2,
						'PED_REQ_AUTHORIZATION'		=> $authorizationCode,
						'PED_REQ_PAY_TYPE_CODE'		=> $paymentTypeCode,
						'PED_REQ_RESPONSE'			=> $responseCode,
						'PED_REQ_SESSIONID'			=> $sessionId,
						'PED_REQ_DATE'				=> $transactionDate,
						'PED_REQ_URL_REDIREC'		=> $urlRedirection,
						'PED_REQ_VCI'				=> $VCI
					);
		$this->db->insert('pedido_request', $data);
	}
	
} 