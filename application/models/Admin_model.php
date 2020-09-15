<?php
	
class admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function editaPassAdmin($password)
    {
		$array = array(
						'PASS_ADMIN' => $password
					   );
		$this->db->where('ID_ADMIN', 1);
		$this->db->update('admin', $array);
    }
	
	//EXISTE ADMINISTRADOR
	public function existeAdministrador($user,$pass)
    {
		$where = array("USER_ADMIN" => $user, "PASS_ADMIN" => $pass);
        $query = $this->db
                      ->select("*")
                      ->from("admin")
                      ->where($where)
                      ->count_all_results();
        //return $query;
		if( $query > 0 ){
			return true;
		}else{
			return false;
		}
    }
	
	//SELECCIONAR ROW ADMIN 
	public function getSingleAdminResult($user,$pass)
    {
		$where = array("USER_ADMIN" => $user, "PASS_ADMIN" => $pass);
        $query = $this->db
                      ->select("*")
                      ->from("admin")
                      ->where($where)
                      ->get();
		return $query->result();
    }
	public function getSingleAdminRow($user,$pass)
    {
		$where = array("USER_ADMIN" => $user, "PASS_ADMIN" => $pass);
        $query = $this->db
                      ->select("*")
                      ->from("admin")
                      ->where($where)
                      ->get();
		return $query->row();
    }
	
	//SELECCIONAR ROW ADMIN  POR ID
	public function getSingleAdminId($idAdmin)
    {
		$where = array( "ID_ADMIN" => $idAdmin );
        $query = $this->db
                      ->select("*")
                      ->from("admin")
                      ->where($where)
                      ->get();
		return $query->row();
    }

}