<?php
	
class empresa_horario_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    public function getEmpresaHorarioRow($idEmpresa)
    {
        $where = array(
							"EMPRESA_ID" => $idEmpresa
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_horario e")
					    ->join('dia', 'dia.DIA_ID = e.DIA_INICIO_ID')
                        ->where($where)
                      	->order_by("DIA_INICIO_ID ASC, HORARIO_APERTURA ASC")
                        ->get();
        return $query->result();    
    }
	
    public function getEmpresaHorarioHoyAll($dia)
    {
        $where = array(
							"DIA_INICIO_ID" => $dia
						);
        $query = $this->db
                        ->select("*")
                        ->from("empresa_horario")
                        ->where($where)
                      	->order_by("HORARIO_ID ASC")
                        ->get();
        return $query->result();    
    }

	public function insertEmpresaHorario( $idEmpresa, $diaInicio, $horaInicio, $diaCierre, $horaCierre )
    {
		$data = array(
						'EMPRESA_ID' 			=> $idEmpresa,
						'DIA_INICIO_ID' 		=> $diaInicio,
						'HORARIO_APERTURA' 		=> $horaInicio,
						'DIA_CIERRE_ID' 		=> $diaCierre,
						'HORARIO_CIERRE' 		=> $horaCierre
					);
		$this->db->insert('empresa_horario', $data);
    }
	
	public function deleteEmpresaHorario($idHorario)
    {
		$this->db->where('HORARIO_ID', $idHorario);
		$this->db->delete('empresa_horario');
    }
	
	public function deleteEmpresaAllHorario($idEmpresa)
    {
		$this->db->where('EMPRESA_ID', $idEmpresa);
		$this->db->delete('empresa_horario');
    }
	
	public function updateEmpresaHorarioFalseAll()
    {
		$array = array(
						'HORARIO_OPEN' => FALSE
					   );
		$this->db->where('HORARIO_OPEN', TRUE);
		$this->db->update('empresa_horario', $array);
    }
	
	public function updateEmpresaHorarioOpen($idHorario)
    {
		$array = array(
						'HORARIO_OPEN' => TRUE
					   );
		$this->db->where('HORARIO_ID', $idHorario);
		$this->db->update('empresa_horario', $array);
    }
	
} 