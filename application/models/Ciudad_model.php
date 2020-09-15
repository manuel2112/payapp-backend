<?php
	
class ciudad_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    public function getCiudad()
    {
        $where = array(
						"CIUDAD_FLAG" => 1
					  );
        $query = $this->db
                        ->select("*")
                        ->from("ciudad")
                        ->where($where)
                      	->order_by("CIUDAD_NOMBRE ASC")
                        ->get();
        return $query->result();       
    }
	
    public function getCiudadAll()
    {
        $query = $this->db
                        ->select("*")
                        ->from("ciudad")
                      	->order_by("CIUDAD_FLAG DESC, CIUDAD_NOMBRE ASC")
                        ->get();
        return $query->result();       
    }
	
    public function getCiudadExiste($ciudad)
    {
        $where = array(
							"CIUDAD_NOMBRE" => $ciudad
						);
        $query = $this->db
                        ->select("*")
                        ->from("ciudad")
                        ->where($where)
                        ->count_all_results();
        return $query;      
    }
	
	public function insertCiudad($ciudad,$rutaImg)
    {
		$data = array(
						'CIUDAD_NOMBRE' => $ciudad,
						'CIUDAD_IMAGEN' => $rutaImg
					);
		$this->db->insert('ciudad', $data);
    }
	
	public function updateCiudadEstado($idCiudad,$estado)
    {
		$array = array(
						'CIUDAD_FLAG' => $estado
					   );
		$this->db->where('CIUDAD_ID', $idCiudad);
		$this->db->update('ciudad', $array);
    }
	
    public function getCiudadRow($idCiudad)
    {
        $where = array(
							"CIUDAD_ID" => $idCiudad
						);
        $query = $this->db
                        ->select("*")
                        ->from("ciudad")
                        ->where($where)
                        ->get();
        return $query->row();    
    }	
	
    public function getCiudadExisteEdit($idCiudad,$ciudad)
    {
        $where = array(
							"CIUDAD_ID != " => $idCiudad,
							"CIUDAD_NOMBRE" => $ciudad
						);
        $query = $this->db
                        ->select("*")
                        ->from("ciudad")
                        ->where($where)
                        ->count_all_results();
        return $query;      
    }
	
	public function updateCiudadCampo($idCiudad,$campo,$valor)
    {
		$array = array(
						$campo => $valor
					   );
		$this->db->where('CIUDAD_ID', $idCiudad);
		$this->db->update('ciudad', $array);
    }	
	
    public function getEmpresasPorCiudad()
    {
        $where = "CIUDAD_FLAG = 1 AND EMPRESA_FLAG = 1";
        $query = $this->db
                        ->select("ciudad.CIUDAD_ID, CIUDAD_NOMBRE, COUNT(*) AS SUMA, CIUDAD_IMAGEN")
                        ->from("ciudad")
					    ->join('empresa', 'empresa.CIUDAD_ID = ciudad.CIUDAD_ID')
                        ->where($where)
						->group_by(array("empresa.CIUDAD_ID"))
                      	->order_by("SUMA DESC")
                        ->get();
        return $query->result();       
    }
	
    public function getComidasPorCiudad($idCiudad)
    {
        $where = array(
						"c.CIUDAD_ID" 			=> $idCiudad,
						"c.CIUDAD_FLAG" 		=> 1,
						"e.EMPRESA_FLAG" 		=> 1,
						"tc.TIPO_COMIDA_FLAG"	=> 1
					  );
        $query = $this->db
                        ->select("tc.TIPO_COMIDA_ID, tc.TIPO_COMIDA_NOMBRE AS COMIDA, COUNT(*) AS SUMA, tc.TIPO_COMIDA_IMAGEN")
                        ->from("ciudad c")
					    ->join('empresa e', 'e.CIUDAD_ID = c.CIUDAD_ID')
					    ->join('empresa_tipo_comida etc', 'etc.EMPRESA_ID = e.EMPRESA_ID')
					    ->join('tipo_comida tc', 'tc.TIPO_COMIDA_ID = etc.TIPO_COMIDA_ID')
                        ->where($where)
						->group_by(array("tc.TIPO_COMIDA_ID"))
                      	->order_by("SUMA DESC, COMIDA ASC")
                        ->get();
        return $query->result();       
    }
	
    public function getEmpresaPorComidaCiudad($idCiudad,$idTipoComida)
    {
        $where = array(
						"c.CIUDAD_ID" 			=> $idCiudad,
						"etc.TIPO_COMIDA_ID"	=> $idTipoComida,
						"c.CIUDAD_FLAG" 		=> 1,
						"e.EMPRESA_FLAG" 		=> 1,
						"tc.TIPO_COMIDA_FLAG"	=> 1
					  );
        $query = $this->db
                        ->select("e.*")
                        ->from("ciudad c")
					    ->join('empresa e', 'e.CIUDAD_ID = c.CIUDAD_ID')
					    ->join('empresa_tipo_comida etc', 'etc.EMPRESA_ID = e.EMPRESA_ID')
					    ->join('tipo_comida tc', 'tc.TIPO_COMIDA_ID = etc.TIPO_COMIDA_ID')
                        ->where($where)
                      	->order_by("e.EMPRESA_ABIERTO DESC, rand()")
                        ->get();
        return $query->result();       
    }

	/*=============================================
	CIUDAD ESTADISTICA
	=============================================*/	

	public function insertCiudadEstRest( $idCiudad,$date )
    {
		$data = array(
						'CIUDAD_ID'			=> $idCiudad,
						'CIUDAD_EST_DATE'	=> $date
					);
		$this->db->insert('ciudad_est', $data);
    }

	public function getCiudadGraph( $fechaInicio )
    {
        $where = array(
							"ciudad_est.CIUDAD_EST_DATE >=" => $fechaInicio
						);
        $query = $this->db
                        ->select("ciudad.CIUDAD_NOMBRE AS NOMBRE, COUNT(ciudad_est.CIUDAD_ID) AS VALOR")
                        ->from("ciudad")
					    ->join('ciudad_est', 'ciudad_est.CIUDAD_ID = ciudad.CIUDAD_ID')
                        ->where($where)
						->group_by("ciudad_est.CIUDAD_ID")
                      	->order_by("VALOR DESC")
                        ->get();
        return $query->result();   
    }
	
} 