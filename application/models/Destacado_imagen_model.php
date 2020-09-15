<?php
	
class destacado_imagen_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function insertDestacadoImagen($idDestacado, $ruta)
    {
		$data = array(
						'DESTACADO_ID'	=> $idDestacado,
						'EMP_DES_IMG'	=> $ruta
					);
		$this->db->insert('empresa_destacado_imagen', $data);
    }	
	
    public function getDestacadoImagen($idDestacado)
    {
        $where = array(
							"DESTACADO_ID" => $idDestacado
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_destacado_imagen")
                        ->where($where)
                      	->order_by("EMP_DES_ID ASC")
                        ->get();
        return $query->result();    
    }
	
} 