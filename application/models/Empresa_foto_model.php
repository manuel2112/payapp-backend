<?php
	
class empresa_foto_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    public function getEmpresaFotoActive($idEmpresa)
    {
        $where = array(
							"EMPRESA_ID" => $idEmpresa,
							"FOTO_FLAG" => TRUE
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_foto")
                        ->where($where)
                      	->order_by("FOTO_ID ASC")
                        ->get();
        return $query->result();    
    }
	
    public function getEmpresaFotoRow($idFoto)
    {
        $where = array(
							"FOTO_ID" => $idFoto
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_foto")
                        ->where($where)
                        ->get();
        return $query->row();
    }

	public function insertEmpresaFoto($idEmpresa,$ruta,$fechaIngreso)
    {
		$data = array(
						'EMPRESA_ID'	=> $idEmpresa,
						'FOTO_URL' 		=> $ruta,
						'FOTO_DATE'		=> $fechaIngreso
					);
		$this->db->insert('empresa_foto', $data);
    }
	
	public function deleteEmpresaFoto($idFoto)
    {
		$this->db->where('FOTO_ID', $idFoto);
		$this->db->delete('empresa_foto');
    }

	public function updateEmpresaFotoEstado($idEmpresa,$estado)
    {
		$array = array(
						'FOTO_FLAG' => $estado
					   );
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->update('empresa_foto', $array);
    }
	
} 