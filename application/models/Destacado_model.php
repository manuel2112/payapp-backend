<?php
	
class destacado_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getDestacadosAll()
    {
        $query = $this->db
                        ->select("*")
                        ->from("empresa_destacado")
					    ->join('empresa', 'empresa.EMPRESA_ID = empresa_destacado.EMPRESA_ID')
                      	->order_by("empresa_destacado.DESTACADO_INGRESO DESC")
                        ->get();
        return $query->result();       
    }

    public function getDestacadosActivas()
    {
        $where = array(
							"empresa_destacado.DESTACADO_FLAG" => TRUE
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_destacado")
					    ->join('empresa', 'empresa.EMPRESA_ID = empresa_destacado.EMPRESA_ID')
                        ->where($where)
                      	->order_by("empresa_destacado.DESTACADO_INGRESO DESC")
                        ->get();
        return $query->result();
    }
	
	public function insertDestacado($idEmpresa, $txtDescripcion, $orden, $fechaIngreso)
    {
		$data = array(
						'EMPRESA_ID' 			=> $idEmpresa,
						'DESTACADO_DESCRIPCION'	=> $txtDescripcion,
						'DESTACADO_ORDEN'		=> $orden,
						'DESTACADO_INGRESO'		=> $fechaIngreso
					);
		$this->db->insert('empresa_destacado', $data);
		return $this->db->insert_id();
    }

	public function updateDestacadoEstado($idEmpresa,$estado)
    {
		$array = array(
						'DESTACADO_FLAG' => $estado
					   );
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->update('empresa_destacado', $array);
    }

	public function deleteDestacado($idDestacado)
    {
		$array = array(
						'DESTACADO_FLAG' => FALSE
					   );
		$this->db->where('DESTACADO_ID', $idDestacado);
		$this->db->update('empresa_destacado', $array);
    }

    public function getDestacadoEmpresaRow($idDestacado)
    {
        $where = array(
							"DESTACADO_ID" => $idDestacado
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa")
					    ->join('empresa_destacado', 'empresa_destacado.EMPRESA_ID = empresa.EMPRESA_ID')
                        ->where($where)
                        ->get();
        return $query->row();    
    }

    public function getDestacadoEmpresaClienteRow($idEmpresa)
    {
        $where = array(
							"empresa.EMPRESA_ID"	=> $idEmpresa,
							"DESTACADO_FLAG"		=> TRUE
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa")
					    ->join('empresa_destacado', 'empresa_destacado.EMPRESA_ID = empresa.EMPRESA_ID')
                        ->where($where)
                        ->get();
        return $query->row();    
    }
	
} 