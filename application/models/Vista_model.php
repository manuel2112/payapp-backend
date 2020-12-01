<?php
	
class vista_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	public function insertVista($idEmpresa, $idDevice)
    {
		$data = array(
						"EMPRESA_ID"	=> $idEmpresa,
						"DEVICE_ID"		=> $idDevice
					);
		$this->db->insert('vista', $data);
    }

    public function getVistaRow( $idEmpresa, $idDevice )
    {
        $where = array(
						"EMPRESA_ID"	=> $idEmpresa,
						"DEVICE_ID"		=> $idDevice
					   );
        $query = $this->db
                        ->select("*")
                        ->from("vista")
                        ->where($where)
                        ->get();
        return $query->row();       
    }

	public function updateVistaCounter($idVista,$counter)
	{
		$array = array(
					'VISTA_COUNTER' => $counter
				);
		$this->db->where('VISTA_ID', $idVista);
		$this->db->update('vista', $array);
	}

/**************************/
/******VISTA/FECHA*********/
/**************************/

	public function insertVistaFecha($idEmpresa, $idDevice, $date)
    {
		$data = array(
						"EMPRESA_ID"		=> $idEmpresa,
						"DEVICE_ID"			=> $idDevice,
						"VIS_FECHA_DATE"	=> $date
					);
		$this->db->insert('vista_fecha', $data);
    }
	
} 