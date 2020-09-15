<?php
	
class temp_empresa_horario_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	public function insertTempEmpresaHorario($idHorario, $idEmpresa, $idDiaInicio, $dateInicio, $timeInicio, $idDiaCierre, $dateCierre, $timeCierre)
    {
		$data = array(
						'HORARIO_ID'					=> $idHorario,
						'EMPRESA_ID'					=> $idEmpresa,
						'DIA_INICIO_ID'					=> $idDiaInicio,
						'TEMP_HORARIO_APERTURA_DATE'	=> $dateInicio,
						'TEMP_HORARIO_APERTURA_TIME'	=> $timeInicio,
						'DIA_CIERRE_ID'					=> $idDiaCierre,
						'TEMP_HORARIO_CIERRE_DATE'		=> $dateCierre,
						'TEMP_HORARIO_CIERRE_TIME'		=> $timeCierre
					);
		$this->db->insert('empresa_horario_temp', $data);
    }
	
    public function getTempEmpresaHorarioRow($idEmpresa,$now)
    {
        $where = "EMPRESA_ID = ".$idEmpresa." AND TEMP_HORARIO_APERTURA_TIME < ".$now." AND TEMP_HORARIO_CIERRE_TIME > ".$now;
        $query = $this->db
                        ->select("*")
                        ->from("empresa_horario_temp")
                        ->where($where)
                        ->get();
        return $query->row();  
    }
	
    public function getTempEmpresaHorarioAll()
    {
        $query = $this->db
                        ->select("*")
                        ->from("empresa_horario_temp")
                      	->order_by("TEMP_HORARIO_ID ASC")
                        ->get();
        return $query->result();  
    }
	
    public function getTempEmpresaHorarioCount($idHorario)
    {
        $where = "HORARIO_ID = ".$idHorario;
        $query = $this->db
                        ->select("*")
                        ->from("empresa_horario_temp")
                        ->where($where)
                        ->count_all_results();
        return $query;  
    }
	
	public function deleteTempEmpresaHorario($idTemp)
    {
		$this->db->where('TEMP_HORARIO_ID', $idTemp);
		$this->db->delete('empresa_horario_temp');
    }
	
	public function truncateTempEmpresaHorario()
    {
		$this->db->truncate('empresa_horario_temp');
    }
	
} 