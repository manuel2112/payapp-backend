<?php
	
class horario_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
	public function insertHorario($idEmpresa,$diaApertura,$horaApertura,$diaCierre,$horaCierre)
    {
		$data = array(
						'EMPRESA_ID'	        => $idEmpresa,
						'HORARIO_DIA_OPEN'      => $diaApertura,
						'HORARIO_HORA_OPEN'	    => $horaApertura,
						'HORARIO_DIA_CLOSE'     => $diaCierre,
						'HORARIO_HORA_CLOSE'    => $horaCierre
					);
		$this->db->insert('horario', $data);
    }   
	
	public function getHorarioPorEmpresa($idEmpresa)
	{
		  $where = array(
							  "EMPRESA_ID" => $idEmpresa,
							  'HORARIO_FLAG' => TRUE
						  );
		  $query = $this->db
						  ->select("*")
						  ->from("horario")
						  ->where($where)
						  ->order_by("HORARIO_DIA_OPEN ASC, HORARIO_HORA_OPEN ASC")
						  ->get();
		  return $query->result();    
	}

    public function getHorarioHasta($idEmpresa)
    {
        $where = array(
						"EMPRESA_ID" 	=> $idEmpresa,
						"HORARIO_OPEN"	=> TRUE
					  );
        $query = $this->db
                        ->select("HORARIO_HORA_CLOSE")
                        ->from("horario")
                        ->where($where)
                        ->get();
        return $query->row();
    }

	public function updateHorarioDelete($idHorario)
	{
		  $array = array(
							'HORARIO_FLAG' => FALSE
						);
		  $this->db->where('HORARIO_ID', $idHorario);
		  $this->db->update('horario', $array);
	}

	public function updateResetHorario($idEmpresa)
	{
		  $array = array(
							'HORARIO_OPEN' => FALSE
						);
		  $this->db->where('EMPRESA_ID', $idEmpresa);
		  $this->db->update('horario', $array);
	}

	public function updateOpenHorario($idHorario)
	{
		  $array = array(
							'HORARIO_OPEN' => TRUE
						);
		  $this->db->where('HORARIO_ID', $idHorario);
		  $this->db->update('horario', $array);
	}
	
} 