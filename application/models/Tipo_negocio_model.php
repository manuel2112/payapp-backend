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
	
    public function getTiposNegocioExiste($tipoNegocio)
    {
        $where = array(
							"TIPO_NEGOCIO_NOMBRE" => $tipoNegocio
						);
        $query = $this->db
                        ->select("*")
                        ->from("tipo_negocio")
                        ->where($where)
                        ->count_all_results();
        return $query;      
    }	
	
    public function getTiposNegocioEditExiste($idTipoNegocio,$txtTipoNegocio)
    {
        $where = array(
							"TIPO_NEGOCIO_ID !=" 	=> $idTipoNegocio,
							"TIPO_NEGOCIO_NOMBRE" 	=> $txtTipoNegocio
						);
        $query = $this->db
                        ->select("*")
                        ->from("tipo_negocio")
                        ->where($where)
                        ->count_all_results();
        return $query;
    }
	
    public function getTipoNegocioRow($idTipoNegocio)
    {
        $where = array(
							"TIPO_NEGOCIO_ID" => $idTipoNegocio
						);
        $query = $this->db
                        ->select("*")
                        ->from("tipo_negocio")
                        ->where($where)
                        ->get();
        return $query->row();    
    }
	
	public function insertTiposNegocio($tipoNegocio)
    {
		$data = array(
						'TIPO_NEGOCIO_NOMBRE' => $tipoNegocio
					);
		$this->db->insert('tipo_negocio', $data);
    }
	
	public function updateTipoNegocio($idTipoNegocio, $estado)
    {
		$array = array(
						'TIPO_NEGOCIO_FLAG' => $estado
					   );
		$this->db->where('TIPO_NEGOCIO_ID', $idTipoNegocio);
		$this->db->update('tipo_negocio', $array);
    }
	
	public function updateTipoNegocioTxt($idTipoNegocio,$txtTipoNegocio)
    {
		$array = array(
						'TIPO_NEGOCIO_NOMBRE' => $txtTipoNegocio
					   );
		$this->db->where('TIPO_NEGOCIO_ID', $idTipoNegocio);
		$this->db->update('tipo_negocio', $array);
    }

	/*=============================================
	EMPRESA / TIPO NEGOCIO
	=============================================*/		
	public function insertTipoNegocioEmpresa($idEmpresa,$idTipoNegocio)
    {
		$data = array(
						'EMPRESA_ID' 		=> $idEmpresa,
						'TIPO_NEGOCIO_ID' 	=> $idTipoNegocio
					);
		$this->db->insert('empresa_tipo_negocio', $data);
    }
	
	public function deleteTipoNegocioEmpresa($idEmpresa)
    {
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->delete('empresa_tipo_negocio');
    }
	
	public function getTipoNegocioEmpresa($idEmpresa)
    {
        $where = array(
						"empresa_tipo_negocio.EMPRESA_ID" => $idEmpresa
					  );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_negocio")
					    ->join('empresa_tipo_negocio', 'empresa_tipo_negocio.TIPO_NEGOCIO_ID = tipo_negocio.TIPO_NEGOCIO_ID')
                        ->where($where)
                      	->order_by("TIPO_NEGOCIO_NOMBRE ASC")
                        ->get();
        return $query->result();  
    }	
	
} 