<?php
	
class paleta_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function insertPaleta($idEmpreas)
    {
		$data = array(
						'EMPRESA_ID'	=> $idEmpreas,
						'COLOR_ID_01'	=> 1,
						'COLOR_NMB_01'	=> 'primary',
						'COLOR_ID_02'	=> 2,
						'COLOR_NMB_02'	=> 'secondary',
						'COLOR_ID_03'	=> 3,
						'COLOR_NMB_03'	=> 'light'
					);
		$this->db->insert('empresa_colores', $data);
    }

	public function updatePaleta($idEmpresa, $campo01, $campo02, $valor01, $valor02)
    {
		$array = array(
                        $campo01	=> $valor01,
                        $campo02	=> $valor02
					   );
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->update('empresa_colores', $array);
    }
    
    public function getPaletaRow( $idEmpresa )
    {
        $where = array(
						"EMPRESA_ID"	=> $idEmpresa
					   );
        $query = $this->db
                        ->select("*")
                        ->from("empresa_colores")
                        ->where($where)
                        ->get();
        return $query->row();       
    }
	
} 