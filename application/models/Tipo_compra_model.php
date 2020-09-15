<?php
	
class tipo_compra_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    public function getTiposCompraActive()
    {
        $where = array(
						"TIPO_COMPRA_FLAG" => 1
					  );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_compra")
                        ->where($where)
                      	->order_by("TIPO_COMPRA_ID ASC")
                        ->get();
        return $query->result();       
    }
} 