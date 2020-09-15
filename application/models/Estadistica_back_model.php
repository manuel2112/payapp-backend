<?php
	
class estadistica_back_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function insertEstadisticaBack($idEmpresa,$idCampo,$date)
    {
		$data = array(
						'EMPRESA_ID'			=> $idEmpresa,
						'EST_CAMPO_BACK_ID'		=> $idCampo,
						'ESTADISTICA_BACK_DATE'	=> $date
					);
		$this->db->insert('estadistica_back', $data);
    }
	
    public function getEstadisticaBackUltimasAcciones()
    {
        $query = $this->db
                        ->select("*")
                        ->from("estadistica_back")
					    ->join('empresa', 'empresa.EMPRESA_ID = estadistica_back.EMPRESA_ID')
					    ->join('est_campo_back', 'est_campo_back.EST_CAMPO_BACK_ID = estadistica_back.EST_CAMPO_BACK_ID')
						->limit(500)
                      	->order_by("estadistica_back.ESTADISTICA_BACK_ID DESC")
                        ->get();
        return $query->result();       
    }
	
} 