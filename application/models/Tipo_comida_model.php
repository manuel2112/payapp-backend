<?php
	
class tipo_comida_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    public function getTiposComida()
    {
        $query = $this->db
                        ->select("*")
                        ->from("tipo_comida")
                      	->order_by("TIPO_COMIDA_FLAG DESC, TIPO_COMIDA_ORDEN ASC, TIPO_COMIDA_NOMBRE ASC")
                        ->get();
        return $query->result();       
    }
	
    public function getTiposComidaActive()
    {
        $where = array(
						"TIPO_COMIDA_FLAG" => 1
					  );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_comida")
                        ->where($where)
                      	->order_by("TIPO_COMIDA_NOMBRE ASC")
                        ->get();
        return $query->result();       
    }
	
	public function insertTipoComida($tipoComida,$rutaImg)
    {
		$data = array(
						'TIPO_COMIDA_NOMBRE' => $tipoComida,
						'TIPO_COMIDA_IMAGEN' => $rutaImg
					);
		$this->db->insert('tipo_comida', $data);
		return $this->db->insert_id();
    }
	
    public function getTipoComidaExiste($tipoComida)
    {
        $where = array(
							"TIPO_COMIDA_NOMBRE" => $tipoComida
						);
        $query = $this->db
                        ->select("*")
                        ->from("tipo_comida")
                        ->where($where)
                        ->count_all_results();
        return $query;      
    }	
	
    public function getTipoComidaExisteEdit($idTipoComida,$tipoComida)
    {
        $where = array(
							"TIPO_COMIDA_ID != " => $idTipoComida,
							"TIPO_COMIDA_NOMBRE" => $tipoComida
						);
        $query = $this->db
                        ->select("*")
                        ->from("tipo_comida")
                        ->where($where)
                        ->count_all_results();
        return $query;      
    }
	
	public function updateTipoComidaEstado($idTipoComida,$estado)
    {
		$array = array(
						'TIPO_COMIDA_FLAG' => $estado
					   );
		$this->db->where('TIPO_COMIDA_ID', $idTipoComida);
		$this->db->update('tipo_comida', $array);
    }
	
	public function updateTipoComidaOrden($idTipoComida,$orden)
    {
		$array = array(
						'TIPO_COMIDA_ORDEN' => $orden
					   );
		$this->db->where('TIPO_COMIDA_ID', $idTipoComida);
		$this->db->update('tipo_comida', $array);
    }
	
	public function updateTipoComidaCampo($idTipoComida,$campo,$valor)
    {
		$array = array(
						$campo => $valor
					   );
		$this->db->where('TIPO_COMIDA_ID', $idTipoComida);
		$this->db->update('tipo_comida', $array);
    }
	
    public function getTiposComidaOrden($upDown,$ordenTipoComida)
    {
		if( $upDown == 1 ){
			$where = "TIPO_COMIDA_ORDEN < ".$ordenTipoComida;
			$order = "DESC";
		}else{
			$where = "TIPO_COMIDA_ORDEN > ".$ordenTipoComida;
			$order = "ASC";
		}
		
        $query = $this->db
                        ->select("*")
                        ->from("tipo_comida")
                        ->where($where)
                      	->order_by("TIPO_COMIDA_ORDEN ".$order)
                        ->get();
        return $query->row();
    }
	
    public function getTipoComidaRow($idTipoComida)
    {
        $where = array(
							"TIPO_COMIDA_ID" => $idTipoComida
						);
        $query = $this->db
                        ->select("*")
                        ->from("tipo_comida")
                        ->where($where)
                        ->get();
        return $query->row();    
    }

	/*=============================================
	EMPRESA / TIPO COMIDA
	=============================================*/
	public function insertTipoComidaEmpresa($idEmpresa,$idTipoComida)
    {
		$data = array(
						'EMPRESA_ID' 		=> $idEmpresa,
						'TIPO_COMIDA_ID' 	=> $idTipoComida
					);
		$this->db->insert('empresa_tipo_comida', $data);
    }
	
	public function deleteTipoComidaEmpresa($idEmpresa)
    {
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->delete('empresa_tipo_comida');
    }
	
	public function getTipoComidaEmpresa($idEmpresa)
    {
        $where = array(
						"empresa_tipo_comida.EMPRESA_ID" => $idEmpresa
					  );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_comida")
					    ->join('empresa_tipo_comida', 'empresa_tipo_comida.TIPO_COMIDA_ID = tipo_comida.TIPO_COMIDA_ID')
                        ->where($where)
                      	->order_by("TIPO_COMIDA_NOMBRE ASC")
                        ->get();
        return $query->result();  
    }		
	
} 