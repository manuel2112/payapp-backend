<?php
	
class estadistica_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function insertEstadistica($idEmpresa,$idVista,$idCampo,$date)
    {
		$data = array(
						'EMPRESA_ID'		=> $idEmpresa,
						'EST_VISTA_ID'		=> $idVista,
						'EST_CAMPO_ID'		=> $idCampo,
						'ESTADISTICA_DATE'	=> $date
					);
		$this->db->insert('estadistica', $data);
    }
	
	public function countEstadisticaCampo($idEmpresa,$idCampo,$fecha)
    {
		$where = 'EMPRESA_ID = '.$idEmpresa.' AND EST_CAMPO_ID = '.$idCampo.' AND DATE(ESTADISTICA_DATE) = "'.$fecha.'"';
        $query = $this->db
                      ->select("*")
                      ->from("estadistica")
                      ->where($where);
        return $this->db->count_all_results();
    }
	
    public function getEstadisticaUltimasAcciones()
    {
        $query = $this->db
                        ->select("*")
                        ->from("estadistica")
					    ->join('empresa', 'empresa.EMPRESA_ID = estadistica.EMPRESA_ID')
					    ->join('est_vista', 'est_vista.EST_VISTA_ID = estadistica.EST_VISTA_ID')
					    ->join('est_campo', 'est_campo.EST_CAMPO_ID = estadistica.EST_CAMPO_ID')
						->limit(500)
                      	->order_by("estadistica.ESTADISTICA_ID DESC")
                        ->get();
        return $query->result();       
    }

	/*=============================================
	EMPRESA ESTADISTICA
	=============================================*/	

	public function getEmpresaGraph( $fechaInicio )
    {
        $where = array(
							"estadistica.EST_CAMPO_ID" 			=> 1,
							"estadistica.ESTADISTICA_DATE >="	=> $fechaInicio
						);
        $query = $this->db
                        ->select("empresa.EMPRESA_NOMBRE AS NOMBRE, COUNT(estadistica.EMPRESA_ID) AS VALOR")
                        ->from("empresa")
					    ->join('estadistica', 'estadistica.EMPRESA_ID = empresa.EMPRESA_ID')
                        ->where($where)
						->group_by("estadistica.EMPRESA_ID")
                      	->order_by("VALOR DESC")
                        ->get();
        return $query->result();   
    }
	
} 