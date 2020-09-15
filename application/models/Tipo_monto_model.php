<?php
	
class tipo_monto_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    public function getTiposMontoActive()
    {
        $where = array(
						"TIPO_MONTO_FLAG" => 1
					  );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_monto")
                        ->where($where)
                      	->order_by("TIPO_MONTO_NOMBRE ASC")
                        ->get();
        return $query->result();       
    }
} 