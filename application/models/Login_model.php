<?php
	
class login_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function getUsuarioExiste( $correo, $password )
    {
        $where = array(
						"correo" => $correo,						
						"contrasena" => $password
					   );
        $query = $this->db
                        ->select("*")
                        ->from("login")
                        ->where($where)
                        ->get();
        return $query->row();       
    }
    
    public function getUsuarioTokenExiste( $idUser, $token )
    {
        $where = array(
						"id"	=> $idUser,						
						"token"	=> $token
					   );
        $query = $this->db
                        ->select("*")
                        ->from("login")
                        ->where($where)
                        ->get();
        return $query->row();       
    }
	
	//ACTUALIZAR TOKEN
	public function updateUsuarioToken($idUser,$token)
    {
		$array = array(
					   	'token'	=> $token
					   );
		$this->db->where('id', $idUser);
		$this->db->update('login', $array);
    }
	
} 