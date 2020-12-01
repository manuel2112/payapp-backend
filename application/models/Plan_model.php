<?php
	
class plan_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    public function getPlan()
    {
        $query = $this->db
                        ->select("*")
                        ->from("plan")
                      	->order_by("PLAN_ID ASC")
                        ->get();
        return $query->result();       
    }

	/*=============================================
	EMPRESA / PLAN
	=============================================*/	
	
    public function getEmpresaPlan($idEmpresa)
    {
        $where = array(
							"EMPRESA_ID" => $idEmpresa
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_plan")
                        ->join('plan', 'plan.PLAN_ID = empresa_plan.PLAN_ID')
                        ->where($where)
                      	->order_by("EMPRESA_PLAN_ID DESC")
                        ->get();
        return $query->result();       
    }
	
    public function getEmpresaPlanRow($idEmpresa)
    {
        $where = array(
							"EMPRESA_ID"		=> $idEmpresa,
							"EMPRESA_PLAN_FLAG" => TRUE
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_plan")
                        ->where($where)
                        ->get();
        return $query->row();       
    }

	public function insertEmpresaPlan( $idEmpresa, $idPlan, $fechaComienzo, $fechaFin )
    {
		$data = array(
						'EMPRESA_ID' 			=> $idEmpresa,
						'PLAN_ID'				=> $idPlan,
						'EMPRESA_PLAN_COMIENZO'	=> $fechaComienzo,
						'EMPRESA_PLAN_FIN'		=> $fechaFin
					);
		$this->db->insert('empresa_plan', $data);
    }

	public function updateEmpresaPlan($idEmpresa)
    {
		$array = array(
						'EMPRESA_PLAN_FLAG' => FALSE
					   );
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->update('empresa_plan', $array);
    }
	
    public function getEmpresaPlanLastRow($idEmpresa)
    {
        $where = array(
							"EMPRESA_ID"		=> $idEmpresa,
							"EMPRESA_PLAN_FLAG" => TRUE
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_plan")
                        ->where($where)
                        ->get();
        return $query->row();       
    }

	public function updateEmpresaPlanLastRow($idEmpresaPlan,$fecha)
    {
		$array = array(
						'EMPRESA_PLAN_FIN' => $fecha
					   );
		$this->db->where('EMPRESA_PLAN_ID', $idEmpresaPlan);
		$this->db->update('empresa_plan', $array);
    }
	
} 