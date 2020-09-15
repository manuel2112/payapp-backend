<?php
	
class base_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    public function getBase()
    {
        $where = array(
							"BASE_ID " => 1
						);
        $query = $this->db
                        ->select("*")
                        ->from("base")
                        ->where($where)
                        ->get();
        return $query->row();
    }
		
	public function updateBase($intDescarga)
    {
		$array = array(
						'BASE_DESCARGAS' => $intDescarga
					   );
		$this->db->where('BASE_ID', 1);
		$this->db->update('base', $array);
    }
	
	
} 