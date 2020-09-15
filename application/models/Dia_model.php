<?php
	
class dia_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    public function getDias()
    {
        $query = $this->db
                        ->select("*")
                        ->from("dia")
                      	->order_by("DIA_ID ASC")
                        ->get();
        return $query->result();       
    }
	
} 