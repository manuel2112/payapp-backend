<?php
	
class tipo_negocio_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    public function getTiposNegocio()
    {
        $query = $this->db
                        ->select("*")
                        ->from("tipo_negocio")
                      	->order_by("TIPO_NEGOCIO_NOMBRE ASC")
                        ->get();
        return $query->result();       
    }
	
    public function getTiposNegocioActive()
    {
        $where = array(
						"TIPO_NEGOCIO_FLAG" => 1
					  );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_negocio")
                        ->where($where)
                      	->order_by("TIPO_NEGOCIO_NOMBRE ASC")
                        ->get();
        return $query->result();       
    }

    public function getTipoNegocioEmpresaRow($idEmpresa,$idTipo)
    {
        $where = array(
                        "TIPO_NEGOCIO_ID" => $idTipo,
                        "EMPRESA_ID" => $idEmpresa,
                        "TIPO_NEGOCIO_FLAG" => 1
                      );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_negocio")
                        ->where($where)
                        ->get();
        return $query->row();       
    }    
	
} 