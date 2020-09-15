<?php
	
class tipo_pago_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    public function getTiposPago()
    {
        $query = $this->db
                        ->select("*")
                        ->from("tipo_pago")
                      	->order_by("TIPO_PAGO_NOMBRE ASC")
                        ->get();
        return $query->result();       
    }
	
    public function getTiposPagoActive()
    {
        $where = array(
						"TIPO_PAGO_FLAG" => 1
					  );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_pago")
                        ->where($where)
                      	->order_by("TIPO_PAGO_NOMBRE ASC")
                        ->get();
        return $query->result();       
    }
	
	

	/*=============================================
	EMPRESA / TIPO PAGO
	=============================================*/		
	public function insertTipoPagoEmpresa($idEmpresa,$idTipoPago)
    {
		$data = array(
						'EMPRESA_ID'	=> $idEmpresa,
						'TIPO_PAGO_ID' 	=> $idTipoPago
					);
		$this->db->insert('empresa_tipo_pago', $data);
    }
	
	public function deleteTipoPagoEmpresa($idEmpresa)
    {
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->delete('empresa_tipo_pago');
    }
	
	public function getTipoPagoEmpresa($idEmpresa)
    {
        $where = array(
						"empresa_tipo_pago.EMPRESA_ID" => $idEmpresa
					  );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_pago")
					    ->join('empresa_tipo_pago', 'empresa_tipo_pago.TIPO_PAGO_ID = tipo_pago.TIPO_PAGO_ID')
                        ->where($where)
                      	->order_by("TIPO_PAGO_NOMBRE ASC")
                        ->get();
        return $query->result();  
    }			
	
} 