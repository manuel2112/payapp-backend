<?php
	
class empresa_negocio_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    public function getEmpresaNegocioActive($idEmpresa)
    {
        $where = array(
						"empresa_tipo_negocio.EMPRESA_ID" => $idEmpresa,
						"empresa_tipo_negocio.EMPRESA_TIPO_NEGOCIO_FLAG" => TRUE,
						"tipo_negocio.TIPO_NEGOCIO_FLAG" => TRUE
						);
        $query = $this->db
                        ->select("*")
                        ->from("tipo_negocio")
					    ->join('empresa_tipo_negocio', 'empresa_tipo_negocio.TIPO_NEGOCIO_ID = tipo_negocio.TIPO_NEGOCIO_ID')
                        ->where($where)
                      	->order_by("tipo_negocio.TIPO_NEGOCIO_NOMBRE ASC")
                        ->get();
        return $query->result();  
    }
	
    public function getEmpresaNegocioRow($idTipo,$idEmpresa)
    {
        $where = array(
							"TIPO_NEGOCIO_ID"           => $idTipo,
							"EMPRESA_ID"                => $idEmpresa,
							"EMPRESA_TIPO_NEGOCIO_FLAG" => TRUE
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_tipo_negocio")
                        ->where($where)
                        ->get();
        return $query->row();
    }

	public function insertEmpresaNegocio($idTipo, $idEmpresa, $obsTipo)
    {
		$data = array(
						'TIPO_NEGOCIO_ID'	        => $idTipo,
						'EMPRESA_ID' 		        => $idEmpresa,
						'EMPRESA_TIPO_NEGOCIO_OBS'  => $obsTipo
					);
		$this->db->insert('empresa_tipo_negocio', $data);
    }

	public function updateEmpresaNegocio($idEmpresa)
    {
		$array = array(
						'EMPRESA_TIPO_NEGOCIO_FLAG' => FALSE
					   );
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->update('empresa_tipo_negocio', $array);
    }
	
} 