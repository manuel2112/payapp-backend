<?php
	
class usuario_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function insertUsuario($nombre,$email,$fono,$direccion,$ciudad,$date,$idDevice)
    {
		$data = array(
						'USUARIO_NOMBRE'	=> $nombre,
						'USUARIO_EMAIL'		=> $email,
						'USUARIO_FONO'		=> $fono,
						'USUARIO_DIRECCION'	=> $direccion,
						'USUARIO_CIUDAD'	=> $ciudad,
						'USUARIO_INGRESO'	=> $date,
						'DEVICE_ID'	=> $idDevice
					);
		$this->db->insert('usuario', $data);
		return $this->db->insert_id();
    }
    
    public function getUsuarioRow( $idDevice )
    {
        $where = array(
						"DEVICE_ID"	=> $idDevice
					   );
        $query = $this->db
                        ->select("*")
                        ->from("usuario")
                        ->where($where)
                        ->get();
        return $query->row();
    }

	public function updateUsuario($idUsuario,$nombre,$email,$fono,$direccion,$ciudad)
	{
		$array = array(
						'USUARIO_NOMBRE'	=> $nombre,
						'USUARIO_EMAIL'		=> $email,
						'USUARIO_FONO'		=> $fono,
						'USUARIO_DIRECCION'	=> $direccion,
						'USUARIO_CIUDAD'	=> $ciudad
					);
		$this->db->where('USUARIO_ID', $idUsuario);
		$this->db->update('usuario', $array);
	}
	
} 