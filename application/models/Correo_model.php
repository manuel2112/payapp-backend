<?php
	
class correo_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function insertCorreo($correo, $idCiudad)
    {
		$data = array(
						'CORREO_NOMBRE'	=> $correo,
						'CIUDAD_ID'		=> $idCiudad
					);
		$this->db->insert('correo', $data);
    }
	
    public function getCorreo($correo)
    {
        $where = array(
							"CORREO_NOMBRE" => $correo
						);
        $query = $this->db
                        ->select("*")
                        ->from("correo")
                        ->where($where)
                        ->get();
        return $query->row();
    }
	
    public function getCorreosPorCiudad($idCiudad)
    {
        $where = array(
							"CIUDAD_ID" => $idCiudad
						);
        $query = $this->db
                        ->select("*")
                        ->from("correo")
                        ->where($where)
                      	->order_by("CORREO_FLAG DESC, CORREO_NOMBRE ASC")
                        //->limit(10)
                        ->get();
        return $query->result();
    }
	
    public function getCorreosPorCiudadExport($idCiudad)
    {
        $where = array(
							"CIUDAD_ID"		=> $idCiudad,
							"CORREO_FLAG"	=> 1
						);
        $query = $this->db
                        ->select("*")
                        ->from("correo")
                        ->where($where)
                      	->order_by("CORREO_NOMBRE ASC")
                        ->limit(2000)
                        ->get();
        return $query->result();
    }

	public function updateCorreoCampo($idcorreo, $campo, $estado)
    {
		$array = array(
							$campo => $estado
					   );
		$this->db->where('CORREO_ID', $idcorreo);
		$this->db->update('correo', $array);
    }

	public function updateCorreoDown($correo)
    {
		$array = array(
							'CORREO_FLAG' => FALSE
					   );
		$this->db->where('CORREO_NOMBRE', $correo);
		$this->db->update('correo', $array);
    }
	
} 