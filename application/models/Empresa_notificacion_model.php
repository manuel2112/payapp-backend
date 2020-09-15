<?php
	
class empresa_notificacion_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	public function insertClienteNotificacion($idEmpresa,$txtDescripcion,$fechaIngreso,$fechaEnvio)
    {
		$data = array(
						'EMPRESA_ID'			=> $idEmpresa,
						'NOTIFICACION_TEXTO'	=> $txtDescripcion,
						'NOTIFICACION_INGRESO'	=> $fechaIngreso,
						'NOTIFICACION_ENVIO'	=> $fechaEnvio
					);
		$this->db->insert('empresa_notificacion', $data);
		return $this->db->insert_id();
    }

	public function updateImagenClienteNotificacion($idNotificacion, $ruta)
    {
		$array = array(
						'NOTIFICACION_IMG' => $ruta
					   );
		$this->db->where('NOTIFICACION_ID', $idNotificacion);
		$this->db->update('empresa_notificacion', $array);
    }

    public function getClienteNotificacionAll()
    {
        $query = $this->db
                        ->select("*")
                        ->from("empresa_notificacion")
					    ->join('empresa', 'empresa.EMPRESA_ID = empresa_notificacion.EMPRESA_ID')
					    ->join('tipo_compra', 'tipo_compra.TIPO_COMPRA_ID = empresa_notificacion.TIPO_COMPRA_ID', 'left')
					    ->join('tipo_monto', 'tipo_monto.TIPO_MONTO_ID = empresa_notificacion.TIPO_MONTO_ID', 'left')
                      	->order_by("NOTIFICACION_ID DESC")
                        ->get();
        return $query->result();
    }

    public function getNotificacionesPorCliente($idEmpresa)
    {
        $where = array(
							"EMPRESA_ID"		=> $idEmpresa,
							"NOTIFICACION_FLAG" => true
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_notificacion")
                        ->where($where)
                      	->order_by("NOTIFICACION_ID DESC")
                        ->get();
        return $query->result();
    }

    public function getClienteNotificacionRow($idNotificacion)
    {
        $where = array(
							"NOTIFICACION_ID" => $idNotificacion
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_notificacion")
					    ->join('empresa', 'empresa.EMPRESA_ID = empresa_notificacion.EMPRESA_ID')
					    ->join('tipo_compra', 'tipo_compra.TIPO_COMPRA_ID = empresa_notificacion.TIPO_COMPRA_ID', 'left')
					    ->join('tipo_monto', 'tipo_monto.TIPO_MONTO_ID = empresa_notificacion.TIPO_MONTO_ID', 'left')
                        ->where($where)
                        ->get();
        return $query->row();
    }

	public function updateEstadoCampo($idNotificacion, $campo, $estado)
    {
		$array = array(
							$campo => $estado
					   );
		$this->db->where('NOTIFICACION_ID', $idNotificacion);
		$this->db->update('empresa_notificacion', $array);
    }

	public function updateNotificacionTipoPago($idNotificacion, $idTipoCompra, $idTipoMonto, $observacion)
    {
		$array = array(
							'TIPO_COMPRA_ID'		=> $idTipoCompra,
							'TIPO_MONTO_ID'			=> $idTipoMonto,
							'NOTIFICACION_TIPO_OBS'	=> $observacion
					   );
		$this->db->where('NOTIFICACION_ID', $idNotificacion);
		$this->db->update('empresa_notificacion', $array);
    }

	public function updateNotificacionAll($idNotificacion, $txtNotificacion, $dateSendNotificacion, $idTipoCompra, $idTipoMonto, $txtNotificacionObs, $numNotificacionEnviados, $numNotificacionAperturas)
    {
		$array = array(
							'NOTIFICACION_TEXTO'		=> $txtNotificacion,
							'NOTIFICACION_ENVIO'		=> $dateSendNotificacion,
							'TIPO_COMPRA_ID'			=> $idTipoCompra,
							'TIPO_MONTO_ID'				=> $idTipoMonto,
							'NOTIFICACION_TIPO_OBS'		=> $txtNotificacionObs,
							'NOTIFICACION_ENVIADOS'		=> $numNotificacionEnviados,
							'NOTIFICACION_APERTURA'		=> $numNotificacionAperturas
					   );
		$this->db->where('NOTIFICACION_ID', $idNotificacion);
		$this->db->update('empresa_notificacion', $array);
    }

	public function updateNotificacionDarBaja($idNotificacion)
    {
		$array = array(
							'NOTIFICACION_ENVIO'		=> null,
							'NOTIFICACION_PROGRAMADA'	=> null,
							'TIPO_MONTO_ID'				=> null,
							'NOTIFICACION_APERTURA'		=> null,
							'NOTIFICACION_CLICKS'		=> null,
							'NOTIFICACION_FLAG'			=> false
					   );
		$this->db->where('NOTIFICACION_ID', $idNotificacion);
		$this->db->update('empresa_notificacion', $array);
    }

	public function updateNotificacionEmpresaDown($idEmpresa)
    {
		$array = array(
							'NOTIFICACION_FLAG'	=> FALSE
					   );
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->update('empresa_notificacion', $array);
    }
	
////////////////////////////////////////////////////////////////////////
//REST	
////////////////////////////////////////////////////////////////////////	
    public function getClienteNotificacionRest()
    {
        $where = array(
							"NOTIFICACION_ENVIO <" => fechaNow(),
							"NOTIFICACION_FLAG" => TRUE
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_notificacion")
					    ->join('empresa', 'empresa.EMPRESA_ID = empresa_notificacion.EMPRESA_ID')
                        ->where($where)
                      	->order_by("NOTIFICACION_ENVIO DESC")
						->limit(20)
                        ->get();
        return $query->result();
    }

    public function getClienteNotificacionRowRest($idNotificacion)
    {
        $where = array(
							"NOTIFICACION_ID" => $idNotificacion
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_notificacion")
					    ->join('empresa', 'empresa.EMPRESA_ID = empresa_notificacion.EMPRESA_ID')
                        ->where($where)
                        ->get();
        return $query->row();
    }

    public function getClienteNotificacionRowIdOneSignalRest($idOneSignal)
    {
        $where = array(
							"NOTIFICACION_TEXTO" 	=> $idOneSignal,
							"NOTIFICACION_FLAG"		=> TRUE
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_notificacion")
					    ->join('empresa', 'empresa.EMPRESA_ID = empresa_notificacion.EMPRESA_ID')
                        ->where($where)
                        ->get();
        return $query->row();
    }
}